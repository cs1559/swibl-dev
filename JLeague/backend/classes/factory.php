<?php

require_once('config.php');
//require_once(FST_LIBRARY_PATH . DS . 'google' . DS . 'googleservice.php');
require_once(FST_LIBRARY_PATH . DS . 'database' . DS . 'database.php');

class mFactory {
	
	/**
	 * This function will return a CONFIGURATION object.  This can also be obtained from the APP object.
	 * @return mConfig
	 */
	function getConfig() {
		return mConfig::getInstance();
	} 
	/**
	 * This function will return an instance of an APP object
	 * 
	 * @return Ambigous <mJoomlaApp, mApp>
	 */
	static function getApp() {
		if (FS_JOOMLA) {
			$app = mJoomlaApp::getInstance();
		} else {
			$app = &mApp::getInstance();
		}
		return $app;
	}
	/**
	 * This function will return an instance of an object use for database access
	 * @return unknown|Ambigous <unknown, fsDatabase>
	 */
	static function getDBO() {
		/**
		 * If this is running within Joomla, then retrieve the sites configuration information
		 */
		if (FS_JOOMLA) {
			$config = &JFactory::getConfig();		
			$host 		= $config->get('config.host');
			$user 		= $config->get('config.user');
			$password 	= $config->get('config.password');
			$database	= $config->get('config.db');
			$prefix 	= $config->get('config.dbprefix');
			$driver 	= $config->get('config.dbtype');
			$debug 		= $config->get('config.debug');
			$db			=& JFactory::getDBO();
			return $db;
		} else {
			$config = self::getConfig();
			$host 		= $config->getPropertyValue("db.host");
			$user 		= $config->getPropertyValue("db.user");
			$password 	= $config->getPropertyValue("db.password");
			$database	= $config->getPropertyValue("db.database");
		}
		$options = array(
				"database"=>$database,
				"host"=>$host,
				"user"=>$user,
				"password"=>$password);
		$db = &fsDatabase::getInstance($options);
		$db->setPrefix("jos");
		return $db;
	}
	
	/**
	 * This function will return a Document object.
	 * @deprecated
	 * @return unknown
	 */
	function &getDocument() {
		$document =& JFactory::getDocument();
		return $document;
	}
	
	/**
	 * This function will return an instance of Google Geocoder
	 * @return fsGoogleGeocoder
	 */
	function getGeocoder() {
		$svc = &fsGoogleService::getInstance();
		return $svc->getGeocoder();
	}
	
	function getUrlShortener() {
		$svc = &fsGoogleService::getInstance();
		return $svc->getUrlShortener();
	}
	
	/**
	 * This function will create and return a new instance of a Game
	 * @return JLGame
	 */
	static function createGame() {
		$instance = new JLGame();
		$instance->setId(0);
		$instance->setAwayLeagueFlag("Y");
		$instance->setHomeLeagueFlag("Y");
		return $instance;
	}
}