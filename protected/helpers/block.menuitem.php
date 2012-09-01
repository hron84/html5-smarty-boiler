<?php
function smarty_block_menuitem($vars, $content, Smarty_Internal_Template $template, &$repeat) {
  if(!$repeat) {
    $li = '<li';
    if(isset($vars['id'])) {
      $li .= ' id="' . $vars['id'] . '"';
    }

    if(isset($vars['class'])) {
      $li .= ' class="' . implode(' ', $vars['class']) . '"';
    }

    $li .= '>';
    return $li . $content . '</li>';
  }
}