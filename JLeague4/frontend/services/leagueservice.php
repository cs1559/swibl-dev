<?php
/**
 * @version		$Id: leagueservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */



// require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
// require_once(JLEAGUE_SERVICES_PATH .DS . 'baseservice.class.php');

class JLLeagueService extends mBaseService {

	
	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function will return an instance of the JLGameService service object.
	 *
	 * @return JLLeagueService
	 */	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLLeagueService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = JLLeagueDAO::getInstance();
		return $dao;
	}
	
	function getActiveLeague() {
		$dao = $this->getDao();
		try {
			return $dao->getActiveLeague();
		} catch (Exception $e) {
			throw $e;
		}
		
	}
	
	/**
	 * Unpublishes an indiviaul row
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function unpublish($id) {
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric");
		}
		try {
			// @TODO:  Add check to ensure there is at least ONE league published
			parent::unpublish($id);
		} catch (Exception $e) {
			throw $e;
		}
	}
	

	
}

?>