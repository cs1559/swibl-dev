<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * components/com_hello/hello.php
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
*/
 
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

ini_set('display_errors', '0');
//error_reporting(E_ALL ^ E_NOTICE);

define('DS',DIRECTORY_SEPARATOR);

include dirname(__FILE__). DS . 'defines.php';
 
/*
// Load any defined properties
require_once( JPATH_ADMINISTRATOR . DS .'components' . DS . 'com_jleague' . DS . 'defines.php' );
require_once( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries'.DS.'core.php' );
require_once( JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');

// Require the base controller
require_once( JPATH_COMPONENT.DS.'controllers'.DS.'controller.php' );
require_once( JPATH_COMPONENT.DS.'router.php' );
 
// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}
*/

if (defined('__DIR__')) {
	define('APP_BASE_PATH', __DIR__ . DS);
} else {
	define('APP_BASE_PATH',dirname(__FILE__) . DS);
}

define('_APPEXEC',true);

// Bootstrap the application
if (file_exists(APP_BASE_PATH . 'bootstrap.php'))
{
	include_once APP_BASE_PATH . DS . 'bootstrap.php';
} 

$app = &mFactory::getApp();

$controller = new mController();
$controller->run();

?>
