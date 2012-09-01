<?php
if(!defined('RUNTIME_ENV')) {
  define('RUNTIME_ENV', 'production');
}
define('APPLICATION_PATH', dirname(__FILE__));
define('TEMPLATES_PATH', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'views');
define('HELPERS_PATH', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'helpers');
define('CACHE_PATH', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'cache');

// Disable AR autoload because we doing an another way to load classes
define('PHP_ACTIVERECORD_AUTOLOAD_DISABLE', TRUE);


// Manual loads
require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'config.php');
require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'libs/utils.php');
require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'classes/Errors.php');
require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'libs/Smarty-3.0.6/libs/Smarty.class.php');

//// You need to choose only one DB framework:
// DB.class:
require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'classes/DB.php');

// or ActiveRecord (uncomment Configure AR section too):
// require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'libs/ActiveRecord-1.0/ActiveRecord.php');

// Configure AR
// define('PHP_ACTIVERECORD_AUTOLOAD_DISABLE', TRUE);
//
// ActiveRecord\Config::initialize(function($cfg) use($config) {
//   $cfg->set_model_directory(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'models');
//   $cfg->set_connections($config['db-params']);
//   $cfg->set_default_connection(RUNTIME_ENV);
// });

// Note: you need to set up matching DB config too in config.php


// Configure Timezone $$$ You may want to change this otherwise php will complain
// TODO make it as variable
// date_default_timezone_set('America/Los_Angeles');


spl_autoload_register(function ($className) {
	// Lookup possibilities
	$chances = array(
	   APPLICATION_PATH . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $className . ".class.php",
	   APPLICATION_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . $className . ".class.php",
	   APPLICATION_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $className . ".class.php",
	   APPLICATION_PATH . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . strtolower($className) . ".class.php",
	   APPLICATION_PATH . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . strtolower($className) . ".class.php",
	   APPLICATION_PATH . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . strtolower($className) . ".class.php",

	);
	foreach($chances as $file) {
	    
	    if(file_exists($file)) {
	        require_once($file);
	        return true;
	    }
	}
  throw new Exception('Class not found: ' . $className);
	return false;
});

// configure error reporting and PHP stuff
ini_set('error_reporting', ($config['debug'] ? E_ALL & ~E_NOTICE : 0));
ini_set('display_errors', ($config['debug'] ? '1' : '0'));
ini_set('log_errors', ($config['debug'] ? '1' : '0'));
ini_set('error_log', $config['logfile']);

// use W3C-conforming URLS when parameters are appended
ini_set('arg_separator.output', '&amp');

$request = Request::instance();

$params = $request->params;


?>
