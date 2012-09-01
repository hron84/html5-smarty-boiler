<?php


/**
 * This function translates C-style controller path
 * to CamelCase controller class name
 *
 * @param string $controller Name of the controller
 *
 * @return string Controller class name
 */
function controller_translate($controller) {

    // Convert C-style names to CamelCase
    $arr = explode('_', $controller);
    $resarr = array();

    foreach($arr as $elem) {
        $resarr[] = ucfirst($elem);
    }
    
    return implode('', $resarr) . 'Controller';
}
/**
 * Checks whether controller can or cannot handle the request
 *
 * @param string $controller Name of the controller
 * @param string $action Name of the action
 *
 * @return bool|string If controller can handle the request,
 * returns with the controller class name, otherwise returns
 * with false
 */
function check_controller($controller, $action) {

  $controller_class = controller_translate($controller);
  
  try {
    if(class_exists($controller_class)) {
      $rc = new ReflectionClass($controller_class);
      try {
        $rc->getMethod($action);
        return $controller_class; // Controller and action is exists
      } catch(Exception $e) {
        return false; // Controller exists, no action
      }
    } else {
      return false; // Neither controller and action exists
    }
  } catch(Exception $e) {
    return false;
  }

}
/**
 * Builds Smarty template engine object and sets up
 *
 * @return Smarty The smarty object
 */
function smarty_setup() {
    global $config;

    $smarty = new Smarty();
    
    $smarty->template_dir = TEMPLATES_PATH;
    $smarty->compile_dir = CACHE_PATH . DIRECTORY_SEPARATOR . 'templates_c' ;
    $smarty->cache_dir = CACHE_PATH . DIRECTORY_SEPARATOR . 'templates' ;
    $smarty->addPluginsDir(HELPERS_PATH);

    // assign app variables to base template
    $smarty->assign('debug', $config['debug']);
    $smarty->assign('app_title', $config['app_title']);
    $smarty->debugging = $config['debug'];
    $smarty->allow_php_tag = true;
    return $smarty;
}

/**
 *    Writes a custom message to the log file for debugging purposes.
 *    The message is prepended with a current timestamp and file identifier.
 *
 *    @param string $info_message The message to write to the log file.    
 *
 */
// @TODO refactor it to a pluggable stuff
function log_entry($info_message) { 
    global $config;
    
    if (!$info_message || trim($info_message) == '') {
        return;
    }
       
    error_log('PHP '.$config['app_name'].' Message: ('.$_SERVER['PHP_SELF'].') '.str_replace("\n", "", $info_message));
}

function paginate($currpage, $pages) {
  $currpage = (int)$currpage;
  $pages = (int) ceil($pages);

  $arr = array(
    'first' => ($currpage != 1), 
    'prev'  => ($currpage >  1), 
    'next'  => ($currpage <  $pages), 
    'last'  => ($currpage != $pages), 

    'active' => $currpage
  );

  $range_start = $range_end = 0;
  if($pages > 15) {
    if($currpage < 15) {
      // First page
      $range_start = 1;
      $range_end = 15;
    } else if($currpage >= $pages - 15) {
      // Last page
      $range_start = $pages - 15;
      $range_end = $pages;
    } else {
      $range_start = $currpage - 7;
      $range_end = $currpage + 7;
    }
  } else {
    $range_start = 1;
    $range_end = $pages;
  }

  $arr['pages'] = range($range_start, $range_end);
  
  if($arr['prev']) {
    $arr['prev_page'] = $currpage - 1;
  }

  if($arr['next']) {
    $arr['next_page'] = $currpage + 1;
  }

  $arr['last_page'] = $pages;

  return $arr;
}

function password_crypt($password, $salt = '') {
  if(!isset($salt) || empty($salt)) {
    $salt = '';
    for($i = 0; $i < 20; $i++) {
      $salt .= chr(mt_rand(32, 127));
    }
  }

  return crypt($password, $salt);
}
