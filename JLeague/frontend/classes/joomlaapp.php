<?php

/**
 * @version			$Id: address.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		SWIBL Mobile
 * @subpackage		Conrollers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL
 */

class mJoomlaApp extends mApp  {

	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new self();
			$instance->init();
		}
		return $instance;
	}
	
	/**
	 * This function initializes the app by setting configuration settings and the
	 * database connection.
	 */
	function init() {
	
		$this->_config = &mConfig::getInstance();
		$this->_db = &mFactory::getDBO();
	
		$this->setDocument();
	
		if (_APPDEBUG) {
			$this->writeDebug("Initializing application - running on " . $_SERVER['SERVER_NAME']);
		}
	
		try {
			$lsvc = &JLLeagueService::getInstance();
			$league = $lsvc->getActiveLeague();
			$this->_config->setLeague($league);
			$this->setLeague($league);
			$ssvc = &JLSeasonService::getInstance();
			$season = $ssvc->getActiveSeason();
			$this->setCurrentSeason($season);
		} catch (Exception $e) {
			$ssvc = &JLSeasonService::getInstance();
			$season = $ssvc->getMostRecentSeason();
			$this->setCurrentSeason($season);
		}
		
		// Get Joomla User
		$user    = JFactory::getUser();
		$this->setUser($user);
		
		if (_APPDEBUG) {
			if ($user->id > 0) {
				$this->writeDebug("Logged in as " . $user->username . " [" . $user->id . "]");
			}
		}
			
	}
	
	
	function setDocument() {
		
		$this->_document = &JFactory::getDocument();
		
 
		$this->_document->addStyleSheet(JURI::base() . "components/com_jleague/assets/css/bootstrap-overrides.css");
// 		$this->_document->addStyleSheet(JURI::base() . "components/com_jleague/assets/css/bootstrap.min.css");

		//$this->_document->addStylesheet(JURI::base() . "components/com_jleague/assets/css/bootstrap-responsive.css");
//		$this->_document->addScript(JURI::base() . "components/com_jleague/assets/js/bootstrap.min.js");
		
		$this->_document->addStyleSheet(JURI::base() . "components/com_jleague/assets/css/swibl.css");

		$this->_document->addScript(JURI::base() . "components/com_jleague/assets/js/jleague.js",null,true);
	}
	
	function redirect($url, $message = null, $type="message") {
		$app = JFactory::getApplication();
		$app->redirect($url, $message, $type);
	}
	
	function getSitePath() {
		return JPATH_ROOT;
	}
	
	static function cloakEmail($email,$mode=1,$mailText='') {
		if (strlen($email) == 0) {
			return "Unavailable";
		}
		$replacement = JHTML::_('email.cloak', $email);
		return $replacement;
		
		return fsEmail::cloak($mail, $mode, $mailText);
		return $replacement;
	}
	
	function addScript($lib) {
		$this->_document->addScript(JURI::base() . $lib,null,true);
	}
	function addStyleSheet($sheet) {
		$this->_document->addStyleSheet($sheet);	
	}
	
}

?>