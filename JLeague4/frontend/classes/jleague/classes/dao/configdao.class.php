<?php
/**
 * @version 		$Id: configdao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'campaign.class.php');

class JLConfigDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_config';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLConfigDAO();
		}
		return $instance;
	}	

	/**
	 * 
	 * This function will insert a row into the SEASON table.
	 *
	 * @param JLSeason $league
	 * @return boolean
	 */
   	function insert(JLConfig $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, leagueid, properties) '
			. ' VALUES ('
			. '"' . $obj->getId() . '",'
			. '"' . $obj->getLeagueId() . '",' 
			. '"' . $obj->getFormattedProperties() . '"'
			.  ')';
		if (!$this->_insertRow($query)) {
			throw new Exception("Error creating configuration");
		} 			
    }
    
    /**
     * This function will enable someone to update a row from the Season table.
     *
     * @param JLSeason $obj
     * @return boolean
     */
    function update(JLConfig $obj) {
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' leagueid = "' . $obj->getUserName(). '", '
			. ' properties = "' . $obj->getFormattedProperties(). '" '
			. ' where id = ' . $obj->getid();
		if (!$this->_updateRow($query)) {
			throw new Exception("Error updating configuration");
		} 	    }
	
   
	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
		$obj = &JLConfig::getInstance(true);
		$obj->setId($row->id);
		$obj->setLeagueId($row->league_id);
		$obj->parseDatabaseObjectProperties($row->properties);
		return $obj;
	}

}
