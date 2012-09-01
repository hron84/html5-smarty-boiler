<?php
function smarty_block_menu($vars, $content, Smarty_Internal_Template $template, &$repeat) {
  if(!isset($vars['class'])) {
    $vars['class'] = '';
  }

  if(!$repeat) {
    $ul = '<ul';

    if(isset($vars['id'])) {
      $ul .= ' id="' . $vars['id'] . '"';
    }

    if(isset($vars['class'])) {
      $ul .= ' class="' .  $vars['class'] . '"';
    }

    $ul .= '>';

    return $ul . $content . '</ul>';
  }
}




