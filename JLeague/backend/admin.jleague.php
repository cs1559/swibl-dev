<?php
/**
 * @version		$Id: admin.jleague.php 43 2010-02-24 02:27:41Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Administration
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

// @todo: Do some check if user is really allowed to access this section of the back end.
// Just in case we need to impose ACL on the component

// During ajax calls, the following constant might not be called
if( !defined('JPATH_COMPONENT') )
{
	define( 'JPATH_COMPONENT' , dirname( __FILE__ ) );
}

// Load necessary language file since we dont store it in the language folder
$lang =& JFactory::getLanguage();
$lang->load( 'com_jleague', JPATH_COMPONENT );

$view 	 = JRequest::getVar('view', '', 'GET');
$task	 = JRequest::getVar( 'task' , '' , 'REQUEST');

//Require the base controller
require_once( JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries'.DS.'core.php' );
require_once( JPATH_COMPONENT.DS.'controllers'.DS.'controller.php' ); //Require specific controller if requested
if($controller = JRequest::getWord('controller')) { 	//Find the controller
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    
    //Checking the existence of the path
    if (file_exists($path)) {     	// Include the path of the controller
        require_once $path;
    } else {
		JError::raiseError( 500 , 'Invalid Controller Object. Class definition does not exists in this context.' );
    }
}

// Load any defined properties
require_once( JPATH_COMPONENT . DS . 'defines.php' );

$classname    = 'JLeagueController'.$controller;
$controller   = new $classname( ); 					//Get and execute the task
$controller->execute( $task ); 						//Redirect if set by the controller
$controller->redirect();
