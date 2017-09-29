<?php
/**
 * @version		$Id: defines.php 43 2010-02-24 02:27:41Z Chris Strieter $
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

define('DS',DIRECTORY_SEPARATOR);
define( 'JLEAGUE_ADMIN_PATH',	JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague');
define( 'JLEAGUE_ASSETS_PATH' 		, JLEAGUE_ASSETS_PATH . DS . 'assets' );
define( 'JLEAGUE_ASSETS_URL' 		, JURI::base() . 'components/com_jleague/assets' );
define( 'JLEAGUE_BASE_PATH'			, dirname( JPATH_BASE ) . DS . 'components' . DS . 'com_jleague' );
define( 'JLEAGUE_BASE_ASSETS_PATH'	, JPATH_BASE . DS . 'components' . DS . 'com_jleague' . DS . 'assets' );
define( 'JLEAGUE_BASE_ASSETS_URL'	, JURI::root() . 'components/com_jleague/assets' );
define( 'JLEAGUE_CONTROLLERS' 		, JPATH_COMPONENT . DS . 'controllers' );
define( 'JLEAGUE_CLASSES_PATH'		, JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'classes');
define( 'JLEAGUE_CLASSES_OBJECTS_PATH'		, JLEAGUE_CLASSES_PATH . DS . 'objects');
define( 'JLEAGUE_CLASSES_DAO_PATH'		, JLEAGUE_CLASSES_PATH . DS . 'dao');
define( 'JLEAGUE_VIEWS_PATH'		,JPATH_COMPONENT . DS . 'views');
define( 'JLEAGUE_SERVICES_PATH'  , JLEAGUE_ADMIN_PATH . DS . 'services');
define( 'JLEAGUE_CLASSES_VIEWOBJECTS_PATH'		, JLEAGUE_CLASSES_PATH . DS . 'viewobjects');
define( 'JLEAGUE_JOMSOCIAL_MODELS_PATH', JURI::root() . 'components'. DS . 'com_community' . DS . 'models');
define( 'JLEAGUE_LIBRARIES_PATH' , JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries');
