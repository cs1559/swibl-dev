<?php
/**
 * @version 		$Id: venuedao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'league.class.php');

class JLVenueDAO extends JLBaseDAO{
	
	//var $tablename = '#__jleague_venues';
	var $tablename = '#__gmaps_markers';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLVenueDAO();
		}
		return $instance;
	}	

	function getRow($id) {
		return $this->findById($id);
	}
	function findById($id) {
		$iid = (int) $id;
		$query = "select * from #__gmaps_markers where id = " . $iid;
		return parent::_getRow($query);
	}
	
  	function getRows() {
		$query = 'SELECT * FROM #__gmaps_markers where published = 1 order by name'; 
		return parent::_getRows($query);
	}	
		
	/**
	 * 
	 * This function will insert a row into the VENUE table.
	 *
	 * @param JLVenue $venue
	 * @return boolean
	 */
   	function insert(JLVenue $venue) {
   		throw new Exception("Operation Not Available");
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, name, address1, address2, city, state, zipcode, description, latitude, longitude, published) '
			. ' VALUES (0,'
			. '"' . $obj->getTitle() . '",' 
			. '"' . $obj->getDescription() . '",'
			. '"' . $obj->getActive() . '",'
			. '"' . $obj->isRegistrationOpen() . '",'
			. '"P",'
			. $obj->getPublished() . ')';
		return $this->_insertRow($query);	
   	}
    
    /**
     * This function will enable someone to update a row from the VENUE table.
     *
     * @param JLVenue $venue
     * @return boolean
     */
    function update(JLVenue $venue) {
    	throw new Exception("Operation Not Available");
			$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' title = "' . $obj->getTitle(). '", '
			. ' description = "' . $obj->getDescription(). '", '
			. ' active = "' . $obj->getActive(). '", '
			. ' registrationopen = "' . $obj->isRegistrationOpen(). '", '
			. ' status = "' . $obj->getStatus(). '", '
			. ' published = ' . $obj->getPublished()
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);	
    }
    
	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'venue.class.php');
		$obj = new JLVenue();
		$obj->setId($row->id);
		$obj->setName($row->name);
		$obj->setDescription($row->description);
		$obj->setPublished($row->published);
		$obj->setAddress1($row->address1);
		$obj->setAddress2($row->address2);
		$obj->setCity($row->city);
		$obj->setState($row->state);
		$obj->setZipcode($row->zipcode);
		$obj->setLatitude($row->latitude);
		$obj->setLongitude($row->longitude);
		return $obj;
	}

}
