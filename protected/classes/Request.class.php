<?php
class Request {
  public $format = 'html';
  public $remote_ip = '';
  public $host = '';
  public $port = '';
  public $host_and_port = '';
  public $request_method = '';
  public $request_uri = '';
  public $server_software = '';
  public $url = '';
  public $query_string = '';
  public $params = array();
  public $get = array();
  public $post = array();
  public $protocol = '';
  public $ssl = '';
  public $headers = array();
  public $accepts = '';
  public $controller = '';
  public $action = '';
  public $path = '';
  public $path_elements = array();
  public $webroot = '';
  public $session = null;
  public $cookies = null;
  public $env = RUNTIME_ENV;

  private static $instance;

  protected function __construct() {
    foreach($_SERVER as $key => $value) {
      if(preg_match('/^(CONTENT|HTTP)_([A-Z_]+)/', $key, $matches)) {
        # $matches[2]
        $header = $matches[1] == 'CONTENT' ? $matches[0] : $matches[2];
        $headerparts = explode('_', $header);
        $parts = array();
        foreach($headerparts as $part) {
          $parts[] = $part == 'IP' ? $part : ucfirst(strtolower($part));
        }
        $header = implode('-', $parts);
        $this->headers[$header] = $value;
      } 
    }

    if(isset($this->headers['X-Forwarded-For'])) {
      $remote_ips = explode(',', $this->headers['X-Forwarded-For']);
      if(isset($_SERVER['HTTP_CLIENT_IP'])) {
        if(array_search($this->headers['Client-IP'], $remote_ips)) {
          die();
        } else {
          $this->remote_ip = $this->headers['Client-IP'];
        }
      } else {
        $this->remote_ip = array_pop($remote_ips);
      }
    } else {
      $this->remote_ip = $_SERVER['REMOTE_ADDR'];
    }

    $this->port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80;
    $this->server_software = $_SERVER['SERVER_SOFTWARE'];
    $this->request_method = $_SERVER['REQUEST_METHOD'];
    $this->ssl = isset($_SERVER['HTTPS']);
    $this->protocol = $this->ssl ? 'https://' : 'http://';


    $this->host = isset($this->headers['Host']) ?
                  $this->headers['Host'] :
                  (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'localhost');
    $hostparts = explode(':', $this->host);
    $this->host = $hostparts[0];
    $this->host_and_port = $this->host;
    if($this->protocol == 'http://' && $this->port != 80) {
      $this->host_and_port .= ':' . $this->port;
    } else if($this->protocol == 'https://' && $this->port != 443) {
      $this->host_and_port .= ':' . $this->port;
    }


    $this->query_string = $_SERVER['QUERY_STRING'];

    $this->params = $this->get = $_GET;
    $this->post = $_POST;
    
    
    if($this->headers['Content-Type'] == 'application/json') {
      $json = file_get_contents("php://input");
      $postvals = json_decode($json);
      foreach($postvals as $key => $value) {
        if($key !== 'controller' && $key !== 'action') {
          $this->params[$key] = $value;
        }
      }
    } else {
      foreach($_POST as $key => $value) {
        if($key !== 'controller' && $key !== 'action') {
          $this->params[$key] = $value;
        }
      }
    }

    $uri = $_SERVER['REQUEST_URI'];
    if(preg_match("/^\w+\:\/\/[^\/]+(\/.*|$)$/", $uri, $matches)) {
      $uri = $matches[1];
    }
    $this->request_uri = $uri;

    $this->url = $this->protocol . $this->host_and_port . $this->request_uri;
    if(isset($_SERVER['REDIRECT_URL'])) {
      $this->path = $_SERVER['REDIRECT_URL'];
    } else if(isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
      $this->path = $_SERVER['PATH_INFO'];
    } else {
      $pathelems = explode('?', $this->request_uri);
      $this->path = $pathelems[0];
    }

    //$this->webroot = dirname($_SERVER['PHP_SELF']);
    $this->webroot = dirname($_SERVER['SCRIPT_NAME']);
    if($this->webroot !== '/') {
      $this->path = str_replace($this->webroot, "", $this->path);
    }
# Trying parse path as REST-like URL
    // if(preg_match("/^\/(.+)\/(.+)(\/(.+)(\.[a-z0-9]+)?)?$/i", $this->path, $matches)) {
    //             print_r($matches); echo "\n\n";
    //             $this->controller = $matches[1];
    //             $this->action = $matches[2];
    //             $this->params['id'] = $matches[3];
    //             $this->format = isset($matches[4]) ? $matches[4] : '.html';
    //         }

    $pathelems = explode('/', $this->path);
    array_shift($pathelems);
    //print_r($pathelems); echo "\n\n";
    if(count($pathelems) > 0) {
      $this->controller = trim(isset($pathelems[0]) ? $pathelems[0] : $config['default_controller']);
      $this->action = trim(isset($pathelems[1]) ? $pathelems[1] : 'index');
    }

    if(count($pathelems) > 2) {
      // Rolling out controller and action
      array_shift($pathelems);
      array_shift($pathelems);

      $lastelem = array_pop($pathelems);

      $elemslices = explode('.', $lastelem);
      // Handling if element has a multiple dot
      if(count($elemslices) > 1) {
        $this->format = array_pop($elemslices);
        $lastelem = implode('.', $elemslices);
      }
      array_push($pathelems, $lastelem);

      $this->path_elements = $pathelems;
    }
    // Provide id as parameter if it is
    if(!isset($this->params['id']) && count($this->path_elements) > 0) {
      $this->params['id'] = $this->path_elements[0];
    }

    $this->session = new Session();
    $this->cookies = new Cookies();
  }

  public static function instance() {
    if(!self::$instance) {
      self::$instance = new Request();
    }
    return self::$instance;
  }
}
