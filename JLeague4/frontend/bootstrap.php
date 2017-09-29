<?php

/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	SWIBL Mobile
 * @subpackage	
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GP
 */

defined('_APPEXEC') or die('Restricted access');

/**
 * This is the bootstrap code for the SWIBL mobile application
 */

defined('_FSTLIB') ? null : define('_FSTLIB',true);
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('_JEXEC') ? null : define('_JEXEC',false);

if (defined('__DIR__')) {
	define('APP_BASE_PATH', __DIR__ . DS);
} else {
	define('APP_BASE_PATH',dirname(__FILE__) . DS);
}


defined('APP_CLASSES_PATH') ? null : define('APP_CLASSES_PATH',APP_BASE_PATH . 'classes' . DS);
defined('APP_TEMPLATES_PATH') ? null : define('APP_TEMPLATES_PATH',APP_BASE_PATH . 'templates' . DS . 'mobile' . DS);

defined('FST_LIB_CORE') ? null : define('FST_LIB_CORE',APP_BASE_PATH . DS . 'lib' . DS . 'core' . DS);
defined('FST_BASE_PATH') ? null : define('FST_BASE_PATH', APP_BASE_PATH. DS);
defined('FST_LIB_PATH') ? null : define('FST_LIB_PATH',FST_BASE_PATH . 'lib' . DS);
defined('FST_LIB_DOC_PATH') ? null : define('FST_LIB_DOC_PATH',FST_BASE_PATH . 'lib' . DS . 'document' . DS);
defined('FST_LIBRARY_PATH') ? null : define('FST_LIBRARY_PATH',FST_BASE_PATH . 'lib' . DS);

defined('FS_JOOMLA') ? null : define('FS_JOOMLA',true);
defined('_APPDEBUG') ? null : define('_APPDEBUG',false);
defined('_APPDEBUG_LEVEL') ? null : define('_APPDEBUG_LEVEL',1);


// Set magic auto loader class
function mAutoload($classname) {
	$inc = null;
	require_once APP_BASE_PATH . DS . 'lib' . DS . 'core' . DS . 'autoload.php';

	// set the library paths to search when loading a class file
	$paths[] = APP_BASE_PATH .  "classes" . DS ;
	$paths[] = APP_BASE_PATH .  "classes" . DS . "dao" . DS;
	$paths[] = APP_BASE_PATH .  "classes" . DS . "objects" . DS;	
	$paths[] = APP_BASE_PATH .  "controllers" . DS ;
	$paths[] = APP_BASE_PATH .  "services" . DS ;
	$paths[] = APP_BASE_PATH .  "views" . DS;
	$paths[] = FST_LIBRARY_PATH . 'core' . DS;
	$paths[] = FST_LIBRARY_PATH . 'html' . DS;
	$paths[] = FST_LIBRARY_PATH . 'maps' . DS;
	$paths[] = FST_LIBRARY_PATH . 'google' . DS;
	$paths[] = FST_LIBRARY_PATH . 'document' . DS;

	$prefixes = array("m","fs","JL");
	
	$inc = new fsAutoload($classname, $paths, $prefixes);
}

spl_autoload_register('mAutoload');

// Instantiate the application
$app = &mFactory::getApp();
$app->setName("SWIBL");
$app->setServer($_SERVER["SERVER_NAME"]);


