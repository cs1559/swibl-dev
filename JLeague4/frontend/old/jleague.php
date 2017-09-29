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

define('DS',DIRECTORY_SEPARATOR);
include('defines.php');
 

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
 
// Create the controller
$classname    = 'JLeagueController'.$controller;
$controller   = new $classname( );
 
// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );
 
// Redirect if set by the controller
$controller->redirect();

?>