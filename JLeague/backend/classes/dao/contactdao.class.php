<?php
/**
 * @version 		$Id: contactdao.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'contact.class.php');

class JLContactsDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_contacts';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLContactsDAO();
		}
		return $instance;
	}		
	/**
	 * 
	 * This function will insert a row into the DIVISION table.
	 *
	 * @param JLDivision
	 * @return boolean
	 */
   	
	function insert(JLContact $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, name, email, phone,cellphone, properties) '
			. ' VALUES (0,'
			. '"' . $obj->getName() . '",' 
			. '"' . $obj->getEmail() . '",'
			. '"' . $obj->getPhone(). '",'
			. '"' . $obj->getCellPhone() . '",'
			. '"' . $obj->getFormattedProperties() . '"'									
			.  ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to delete a row from the LEAGUE table.
     *
     * @param JLLeague $league
     * @return boolean
     */
    function update(JLContact $obj) {
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' name = "' . $obj->getName(). '", '
			. ' email = "' . $obj->getEmail(). '", '
			. ' phone = "' . $obj->getPhone(). '", '
			. ' cellphone = "' . $obj->getCellPhone(). '", '			
			. ' properties = "' . $obj->getFormattedProperties(). '" '
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);		
    }
        
	/**
	 * This will map the the database row to the Contact Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'contact.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'factory.php');
		$obj = new JLContact();
		$obj->setId($row->id);
		$obj->setName($row->name);
		$obj->setEmail($row->email);
		$obj->setPhone($row->phone);
		$obj->setCellPhone($row->cellphone);
		$obj->parseDatabaseObjectProperties($row->properties);
// 		//$proparray = split("\n",$row->properties);
// 		$proparray = preg_split("/[\n]+/",$row->properties);
// 		for ($y=0; $y<(sizeof($proparray)); $y++) {
// 			//$prop = split("=",$proparray[$y]);
// 			$prop = preg_split("/[=]+/",$proparray[$y]);
// 			//TODO:  Revisit this.  This is a quick work around.  need to investigate origin of
// 			// why this $prop[1] would generate an undefined offset on the $prop array
// 			if (key_exists(1,$prop)) {
// 				$obj->addProperty($prop[0],$prop[1]);
// 			}
// 		}
		return $obj;
	}

}
