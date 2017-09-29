<?php
/**
 * @version		$Id: preferenceservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');

class JLPreferenceService  extends JLBaseService  {

	protected function __construct() {
		parent::__construct();
	}
	
	function getDao() {
		require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'userpreferencesdao.class.php');
		$dao = & JLUserPreferencesDAO::getInstance();
		return $dao;
	}
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLPreferenceService();
		}
		return $instance;
	}		
	
	/**
	 * This function will retrieve a users preferences. 
	 *
	 * @return JLUserPreferences
	 */
	public function getUserPreferences() {
		require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'userpreferencesdao.class.php');
		require_once(JLEAGUE_SERVICES_PATH . DS .'securityservice.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'userpreferences.class.php');		
		
		$sservice = & JLSecurityService::getInstance();
		if (!$sservice->isLoggedIn()) {
			return new JLUserPreferences();
		}
		$dao = & JLUserPreferencesDAO::getInstance();
		$user = JLApplication::getUser();
		// 01/09/2011 - added try/catch to resolve the Fatal Error from being thrown when no preference record is found.
		try {
			$row = $dao->findById($user->id);
			if (!is_object($row)) {
				return new JLUserPreferences();
			}
		} catch (Exception $e) {
			return new JLUserPreferences();
		}
		return $row;
	}
	
	/**
	 * This function will save an UserPreference object.  The SAVE function is handled differently from other objects
	 * as the underlying table structure does not support an incremented key id.
	 *
	 * @param JLUserPreferences $obj
	 * @return boolean
	 */
	public function saveUserPreferences(JLUserPreferences $obj) {
		require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'userpreferencesdao.class.php');
		$dao = & JLUserPreferencesDAO::getInstance();
		try {
			$row = $dao->findById($obj->getId());
			return $dao->update($obj);
		} catch (Exception $e) {
			return $dao->insert($obj);
		}
	}
		
}

?>