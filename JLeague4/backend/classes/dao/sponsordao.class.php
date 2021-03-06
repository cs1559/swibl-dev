<?php
/**
 * @version 		$Id: sponsordao.class.php 440 2012-10-07 11:31:00Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
//require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'division.class.php');

class JLSponsorDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_sponsor';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSponsorDAO();
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
   	function insert(JLSponsor $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, sponsorname, contactname, contactemail, contactphone) '
			. ' VALUES (0,'
			. '"' . $obj->getName() . '",' 
			. '"' . $obj->getContactName() . '",'
			. '"' . $obj->getContactEmail() . '",'
			. '"' . $obj->getContactPhone() . '"' 
			. ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to delete a row from the LEAGUE table.
     *
     * @param JLLeague $league
     * @return boolean
     */
    function update(JLSponsor $obj) {
		$query = 'update ' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' sponsorname = "' . $obj->getName() . '", '
			. ' contactname = "' . $obj->getContactName(). '", '
			. ' contactphone = "' . $obj->getContactPhone(). '", '
			. ' contactemail = "' . $obj->getContactEmail(). '" '
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
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'sponsor.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'factory.php');
		require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'campaigndao.class.php');
		
		$obj = new JLSponsor();
		$obj->setId($row->id);
		$obj->setName($row->sponsorname);
		$obj->setContactName($row->contactname);
		$obj->setContactPhone($row->contactphone);
		$obj->setContactEmail($row->contactemail);
		
		$cdao = &JLCampaignDAO::getInstance();
		$campaigns = $cdao->getSponsorCampaigns($row->id);
		$obj->setCampaigns($campaigns);
		return $obj;
	}

}
