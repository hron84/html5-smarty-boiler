<?php
class AbstractController {
  protected $template;
  protected $request;
  protected $response_headers;

  protected function pre_render_hook() { }

  public function render($tplfile) {
    $this->pre_render_hook();
    $this->send_headers();

    $tplfile = $this->_fixpath($tplfile);

    $chances = array(
      TEMPLATES_PATH . DIRECTORY_SEPARATOR . $tplfile,
      TEMPLATES_PATH . DIRECTORY_SEPARATOR . $tplfile . "." . $this->request->format . ".tpl",
      TEMPLATES_PATH . DIRECTORY_SEPARATOR . $tplfile . ".tpl",

    );

    foreach($chances as $chance) {
      if(file_exists($chance)) {
        $this->template->display($chance);
        return true;
      }
    }
    throw new TemplateNotFoundException("Template {$tplfile} is not found!");
  }

  public function renderJSON($array) {
    $this->response_headers['content_type'] = 'application/json';
    $this->send_headers();
    print json_encode($array);
    return true;
  }

  public function assign($key, $variable = '') {
    if(is_array($key)) {
      $this->template->assign($key);
    } else {
      $this->template->assign($key, $variable);
    }
  }

  public function redirect_to($url) {
    if(!preg_match('/^https?:/', $url) &&  preg_match('/^\/index\.php/', $this->request->request_uri)) {
      $url = '/index.php' . $url;
    }
    header('Location: ' . $url);
    exit;
  }

  public function __construct() {
    global $config;
    $this->request = Request::instance();
    $this->response_headers = array();

    $this->template = smarty_setup();
    // assign request variable to base template
    $this->template->assign('request', $this->request);
  }

  private function send_headers() {
    foreach($this->response_headers as $key => $value) {
      $keyparts = explode('_', $key);
      $hdrparts = array();
      foreach($keyparts as $part) {
        $hdrparts[] = ucfirst($part);
      }
      $header = implode('-', $hdrparts);
      header("{$header}: $value");
    }
  }

  private function _fixpath($path) {
    return str_replace('/', DIRECTORY_SEPARATOR, $path);
  }
}
