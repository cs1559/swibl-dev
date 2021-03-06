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

class JLSponsorDAO extends fsBaseDAO {
	
	var $tablename = '#__jleague_sponsor';
	
	protected function __construct() {
		parent::__construct();
	}
	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSponsorDAO();
		}
		$db = mFactory::getDBO();
		$instance->setDatabase($db);
		return $instance;
	}		
	
	function getSponsorByUser($uname) {
		if (!is_numeric($catid)) {
			throw new  Exception("Category ID is not numeric");
		}
		 
		$query = "SELECT * from #__jleague_sponsors where users like '%" . $uname . "%'";
		
		$cache = & JLCache::getInstance();
		$cache_key = 'getBulletinItemsByCategory_' . $catid . '_' . $limit;
		$rows = $this->_execute($query);
		$sponsor = $this->loadObject($rows[0]);
		return $retArray;
	}
	
	function getCurrentSponsors() {
		$query = "SELECT * from #__jleague_sponsors where id in ( select sponsor_id from #__jleague_campaign where now() >= startdate and now() <= enddate)";
		$cache = & JLCache::getInstance();
		$cache_key = 'getCurrentSponsors';
		$rows = $this->_execute($query);
		return $rows;
	}
	
	/**
	 * 
	 * This function will insert a row into the DIVISION table.
	 *
	 * @param JLDivision
	 * @return boolean
	 */
   	function insert(JLSponsor $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, sponsorname, address1, address2, city, state, zipcode, phone, users, contactname, contactemail, contactphone) '
			. ' VALUES (0,'
			. '"' . $obj->getName() . '",' 
			. '"' . $obj->getAddress1(). '",'
			. '"' . $obj->getAddress2(). '",'
			. '"' . $obj->getCity(). '",'
			. '"' . $obj->getState(). '",'
			. '"' . $obj->getZipcode(). '",'
			. '"' . $obj->getPhone(). '",'
			. '"' . $obj->getUsers() . '", '
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
			. ' address1 = "' . $obj->getAddress1() . '", '
			. ' address2 = "' . $obj->getAddress2() . '", '
			. ' city = "' . $obj->getCity() . '", '
			. ' state = "' . $obj->getState() . '", '
			. ' zipcode = "' . $obj->getZipcode() . '", '
			. ' phone = "' . $obj->getPhone() . '", '						
			. ' users = "' . $obj->getUsers() . '", '																																
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
		$obj = new JLSponsor();
		$obj->setId($row->id);
		$obj->setName($row->sponsorname);
		$obj->setAddress1($row->address1);
		$obj->setAddress2($row->address2);
		$obj->setContactName($row->contactname);
		$obj->setCity($row->city);
		$obj->setState($row->state);
		$obj->setZipcode($row->zipcode);
		$obj->setPhone($row->phone);
		$obj->setContactPhone($row->contactphone);
		$obj->setContactEmail($row->contactemail);
		$obj->setUsers($row->users);
	//	$obj->setActive($row->active);
		
		$cdao = &JLCampaignDAO::getInstance();
		$campaigns = $cdao->getSponsorCampaigns($row->id);
		$obj->setCampaigns($campaigns);
		
		$activecampaign = $cdao->getSponsorActiveCampaigns($row->id);
		$obj->setActiveCampaign($activecampaign);
		return $obj;
	}

}
