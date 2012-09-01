<?php
function smarty_function_link($vars, Smarty_Internal_Template &$template) {
  if(!isset($vars['class'])) {
    $vars['class'] = '';
  }

  if($vars['target'] == Request::instance()->path) {
    $vars['class'] .= " active";
  }

  $target = $vars['target'];

  if(!preg_match('/^http[s]?:\/\//', $target)) {
    $target_arr = explode('/', $target);
    if($target_arr[0] == '') array_shift($target_arr);

    array_unshift($target_arr, Request::instance()->webroot);

    $target = implode('/', $target_arr);
    $target = preg_replace('/\/+/', '/', $target);
  }

  $link = '<a';
  if($vars['class']) {
    $link .= ' class="' . $vars['class'] . '"';
  }

  if($vars['id']) {
    $link .= 'id="' . $vars['id'] . '"';
  }

  foreach($vars as $key => $val) {
    $k = str_replace('_', '-', $key);
    $v = htmlentities($val);
    if(in_array($key, array('target', 'class', 'id'))) {
      continue;
    }

    $link .= " {$k}=\"{$v}\"";
  }

  $link .= ' href="' . htmlentities($target) . '">' . $vars['title'] . '</a>';
  return $link;
}
