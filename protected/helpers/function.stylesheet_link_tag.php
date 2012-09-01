<?php

function smarty_function_stylesheet_link_tag($vars, Smarty_Internal_Template $template) {
  $src = $vars['src'];
  $media = (isset($vars['media']) && !empty($vars['media'])) ? $vars['media'] : '';

  if(!preg_match('/^http[s]?:\/\//', $src)) {
    $src_arr = explode('/', $src);
    if($src_arr[0] == '') array_shift($src_arr);

    array_unshift($src_arr, Request::instance()->webroot);

    $src = implode('/', $src_arr);
    $src = preg_replace('/\/+/', '/', $src);
  }

  $code = '<link rel="stylesheet" type="text/css" href="' . htmlentities($src) . '"' . (!empty($media) ? ' media="'.$media.'"' : '') . ' />';
  return $code;
    
}
