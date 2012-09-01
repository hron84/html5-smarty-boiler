<?php

function smarty_function_javascript_include_tag($vars, Smarty_Internal_Template $template) {
  $src = $vars['src'];

  if(!preg_match('/^http[s]?:\/\//', $src)) {
    $src_arr = explode('/', $src);
    if($src_arr[0] == '') array_shift($src_arr);

    array_unshift($src_arr, Request::instance()->webroot);

    $src = implode('/', $src_arr);
    $src = preg_replace('/\/+/', '/', $src);
  }

  $code = '<script type="text/javascript" src="'.htmlentities($src) . '"></script>';
  return $code;
    
}
