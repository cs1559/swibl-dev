<?php
/**
 * @version 		$Id: core.php 330 2011-12-28 12:10:38Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Library
 * @copyright 		(C) 2006-2011 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

include_once(JLEAGUE_LIBRARIES_PATH . DS . 'text.php');

class JLApplication {

	/**
	 * returns an isntance of the JLConfig object
	 *
	 * @return unknown
	 */
	function &getConfig() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . "config.class.php");
		$config = JLConfig::getInstance();
		return $config;
	}
	
	/**
	 * This is a function that will return the applications event dispatcher object
	 *
	 * @return JLEventDispatcher
	 */
	function getEventDispatcher() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . "eventdispatcher.class.php");
		$dispatcher = & JLEventDispatcher::getInstance();
		return $dispatcher;
	}
	
	function getSiteUrl() {
		return JURI::root();
	}
	
	/**
	 * Returns a configuration property value
	 *
	 * @param String $property
	 * @return string
	 */
	function getConfigProperty($property) {
		$config = JLConfig::getInstance();
		return $config->getPropertyValue($property);
	}
	
	static function loadLanguage($file='com_jleague') {
		
		$lang = JFactory::getLanguage();
		$tag = $lang->getTag();
		if (!$tag)
			$tag = 'en-GB' ;
				
        // Load Language File
		$lang->load($file, JPATH_COMPONENT , $tag);

	}
	
	
	function addPathwayItem( $text , $link = '' )
	{
		// Set pathways
		$mainframe		=& JFactory::getApplication();
		$pathway		=& $mainframe->getPathway();
		
		$pathwayNames	= $pathway->getPathwayNames();
		
		// Test for duplicates before adding the pathway
		if( !in_array( $text , $pathwayNames ) )
		{
			$pathway->addItem( $text , $link );
		}
	}	
	
	/**
	 * This function returns an instance of the database object.
	 *
	 * @return unknown
	 */
	function getDatabase() {
		$db			=& JFactory::getDBO();
		return $db;
	}
	
	function getDBO() {
		return self::getDatabase();
	}
	
	/**
	 * This function is a helper function that can be used to load core libraries
	 *
	 * @param String $type
	 * @param String $name
	 */
	function load($type,$name) {
		
		switch ($type) {
			case 'service':
				include_once(JPATH_ROOT.DS.'components'.DS.'com_jleague'.DS.$type.DS.$name.'service.php');
				break;
		}
	}
	
	
	function &getDocument() {
		$document =& JFactory::getDocument();
		return $document;
	}

	function setMetaTag( $name, $content, $prepend = '', $append = '' ) {
		$doc = JLApplication::getDocument();
		if ($name == 'keywords') {
			$keywords = $doc->getMetaData('keywords');
			$content = $content . ',' . $keywords;
		}
		$doc->setMetaData($name, $content, $prepend, $append );
		
	}
	
	function &getMainframe() {
		$mainframe =& JFactory::getApplication();
		return $mainframe;
	}
	
	function addScript($entry) {
		$doc = JLApplication::getDocument();
 		$doc->addScript($entry);		
	}

	function getUser($id = null) {
		$user    = JFactory::getUser($id);
		return $user;
	}

	/**
	 * This function will CLOAK and email string if it is to be rendered on a page.  This is to prevent
	 * bots from capturing email addresses.
	 *
	 * @param String $email
	 * @param unknown_type $mode
	 * @param unknown_type $mailText
	 * @return String
	 */
	function cloakEmail($email,$mode=1,$mailText='') {
		if (strlen($email) == 0) {
			return "Unavailable";
		}
		$replacement = JHTML::_('email.cloak', $email, $mode, $mailText);
		return $replacement;
	}
	
	function redirect($url,$msg=null, $msgType='message') {
		$mainframe = JLApplication::getMainframe();
		$link = JRoute::_( $url );
        $mainframe->redirect( $link , $msg );			
	}
	
	/*
	function canEditTeam($teamid=null) {
		// @todo need to code this function
		return true;
	}
	*/
	
	/**
	 * A Helper function that will utilize built-in Joomla funcitonality to retrieve a parameter
	 * from the HTTP Request object.  The idea is to abstract any Joomla functionality from the core
	 * extension and isolate any Joomla dependencies.
	 *
	 * @param string $parm
	 * @param string $default_value
	 * @param string $allowhtml
	 * @return string
	 */
	function getRequestParam($parm, $default_value = '', $allowhtml='') {
		return JRequest::getVar($parm, $default_value,$allowhtml);	
	}
		
	function getUserStateFromRequest( $key, $request, $default = null, $type = 'none') {
		
	}
}

class JLApp extends JLApplication {
	
}

?>