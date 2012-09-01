<?php

function smarty_modifier_yesno($string) {
  $truevalues = array(
    '1',
    'y',
    'yes',
    'true',
    'on',
  );
  $needle = strtolower($string);

  if(in_array($needle, $truevalues)) {
    return 'Igen';
  } else {
    return 'Nem';
  }
}
