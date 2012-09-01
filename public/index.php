<?php

require_once('../protected/setup.php');

$default_controller = $config['default_controller'];

// Global variable
$request = Request::instance();

// TODO move trim to Request.class
$controller = trim($request->controller);

if(empty($controller)) {
  $controller = $default_controller;
}

$action = $request->action;

if(empty($action)) {
  $action = 'index';
}

try {
  if($controller_class = check_controller($controller, $action)) {
    $controller = new $controller_class();
  } else {
    header('404 Not Found');
    $smarty = smarty_setup();
    $smarty->display('404.tpl');
  }
} catch (Exception $e) {
  header('500 Internal Server error');
  $smarty = smarty_setup();
  $smarty->assign('exception', $e);
  $smarty->display('500.tpl');
}


// load and render template
try {   
  call_user_func_array(array($controller, $action), array());
}

catch (TemplateNotFoundException $e) {    
  header('404 Not Found');
  $smarty = smarty_setup();
  $smarty->assign('notemplate', true);
  $smarty->assign('tplexception', $e);
  $smarty->display('404.tpl');
}

catch (Exception $e) {
  header('500 Internal Server error');
  $smarty = smarty_setup();
  $smarty->assign('exception', $e);
  $smarty->display('error-500.tpl');
}
?>
