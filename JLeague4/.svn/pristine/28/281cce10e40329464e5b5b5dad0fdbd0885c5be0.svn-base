<?php
/**
 * @version 		$Id: userpreferencesdao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'userpreferences.class.php');

class JLUserPreferencesDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_userprefs';
	
	
	protected function __construct() {
		parent::__construct();
	}
	

	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLUserPreferencesDAO();
		}
		return $instance;
	}	
		
	/**
	 * 
	 * This function will insert a row into the LEAGUE table.
	 *
	 * @param JLLeague $league
	 * @return boolean
	 */
   	function insert(JLUserPreferences $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, uname, properties) '
			. ' VALUES ('
			. '"' . $obj->getId() . '",'
			. '"' . $obj->getUserName() . '",' 
			. '"' . $obj->getFormattedProperties() . '"'
			.  ')';
		if (!$this->_insertRow($query)) {
			throw new Exception("Error creating user preference");
		} 			
    }
    
    /**
     * This function will enable someone to delete a row from the LEAGUE table.
     *
     * @param JLLeague $league
     * @return boolean
     */
    function update(JLUserPreferences $obj) {
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' uname = "' . $obj->getUserName(). '", '
			. ' properties = "' . $obj->getFormattedProperties(). '" '
			. ' where id = ' . $obj->getid();
		if (!$this->_updateRow($query)) {
			throw new Exception("Error updating user preferences");
		} 			
    }
	
	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'userpreferences.class.php');
		$obj = new JLUserPreferences();
		$obj->setId($row->id);
		$obj->setUserName($row->uname);
		$obj->parseDatabaseObjectProperties($row->properties);
		return $obj;
	}

}
