<?php
/**
 * @version		$Id: defines.php 389 2012-02-12 11:40:19Z Chris Strieter $
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

define('_FSTLIB', true);
define('DS',DIRECTORY_SEPARATOR);
define( 'JLEAGUE_ASSETS_PATH' 		, JPATH_COMPONENT . DS . 'assets' );
define( 'JLEAGUE_ASSETS_URL' 		, JURI::base() . 'components/com_jleague/assets' );
define( 'JLEAGUE_BASE_PATH'			, dirname( JPATH_BASE ) . DS . 'components' . DS . 'com_jleague' );
define( 'JLEAGUE_BASE_ASSETS_PATH'	, JPATH_BASE . DS . 'components' . DS . 'com_jleague' . DS . 'assets' );
define( 'JLEAGUE_BASE_ASSETS_URL'	, JURI::root() . 'components/com_jleague/assets' );
define( 'JLEAGUE_CONTROLLERS' 		, JPATH_COMPONENT . DS . 'controllers' );
define( 'JLEAGUE_CLASSES_PATH'		, JPATH_ROOT . DS . 'administrator' . DS .'components'. DS . 'com_jleague' . DS . 'classes');
define( 'JLEAGUE_CLASSES_OBJECTS_PATH'		, JLEAGUE_CLASSES_PATH . DS . 'objects');
define( 'JLEAGUE_CLASSES_DAO_PATH'		, JLEAGUE_CLASSES_PATH . DS . 'dao');
define( 'JLEAGUE_CLASSES_VIEW_PATH', JPATH_BASE . DS . 'components'. DS . 'com_jleague' . DS . 'views');
//define( 'JLEAGUE_SERVICES_PATH'  , JPATH_ROOT . DS . 'administrator' . DS . 'components'. DS . 'com_jleague' . DS . 'services');
define( 'JLEAGUE_SERVICES_PATH'  , JPATH_ROOT . DS . 'administrator' . DS . 'components'. DS . 'com_jleague' . DS . 'services');
define( 'JLEAGUE_PLUGIN_PATH'  , JPATH_ROOT . DS . 'administrator' . DS . 'components'. DS . 'com_jleague' . DS . 'plugins');
define( 'JLEAGUE_CLASSES_VIEWOBJECTS_PATH'		, JLEAGUE_CLASSES_PATH . DS . 'viewobjects');
define( 'JLEAGUE_VIEWS_PATH', JPATH_BASE . DS . 'components'. DS . 'com_jleague' . DS . 'views');
define( 'JLEAGUE_JOMSOCIAL_MODELS_PATH', JURI::root() . 'components'. DS . 'com_community' . DS . 'models');
define( 'JLEAGUE_LIBRARIES_PATH' , JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries');
define( 'FSTCORE_OBJECTS_PATH' , JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries' . DS . 'core' . DS .'objects');
define( 'FST_LIBRARY_PATH' , JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_jleague' . DS . 'libraries');

defined( 'FST_LIB_CORE') ? null : define('FST_LIB_CORE',JLEAGUE_BASE_PATH . DS . 'lib' . DS . 'core' . DS);



require_once( JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
