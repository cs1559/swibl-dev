<?php
/**
 * @version		$Id: venueservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'venuedao.class.php');

class JLVenueService  extends JLBaseService  {

	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function will return an instance of this service object.
	 *
	 * @return JLVenueService
	 */	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLVenueService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = &JLVenueDAO::getInstance();
		return $dao;
	}
	
	public function getVenues() {
		$dao = $this->getDao();
		$rows = $dao->getRows();
		return $rows;
	}
	
}

?>