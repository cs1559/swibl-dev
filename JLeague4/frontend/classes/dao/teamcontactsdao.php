<?php
/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Framework
 * @subpackage	Core
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL
 */


class JLTeamContactsDAO extends fsBaseDAO {
	
	var $tablename = '#__jleague_teamcontacts';

		/**
	 * This function will find a specific team.
	 *
	 * @param int $id
	 * @return JLTeam
	 */
	function findById($id) {
		$iid = (int) $id;
		$query = $this->selectquery . " where id = " . $iid;
		return parent::_getRow($query);
	}
	
	protected function __construct() {
		//parent::__construct();
	}
	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLTeamContactsDAO();
		}
		$db = mFactory::getDBO();
		$instance->setDatabase($db);
		return $instance;
	}	
		
   
	/**
	 * This will map the the database row to the Team Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
    	$contact = new JLTeamContact();
    	$contact->setId($row->id);
    	$contact->setTeamId($row->teamid);
    	$contact->setName($row->name);
    	$contact->setEmail($row->email);
    	$contact->setPhone($row->phone);
    	$contact->setUserid($row->userid);
    	$contact->setPrimary($row->primarycontact);
    	$contact->setRole($row->role);   		
    	return $contact;
	}

	/*
	function getTeamEmailAddresses($teamid) {
		if (!is_numeric($teamid)) {
			throw new  Exception("Team Id is not numeric (TEAMDAO::getTeamContacts)");
		}
		$query = 'SELECT * FROM #__jleague_teamcontacts WHERE teamid = ' . $teamid;
		
		$query = 'select distinct email from ( ' 
			. ' SELECT coachemail as email from #__jleague_teams where id = ' . $teamid 
			. ' UNION '
			. ' select email from #__jleague_teamcontacts where teamid = ' . $teamid 
			. ') as tmp1 '
			. ' where length(email)>0 '
			. ' and LOCATE(\';\', email) <= 0 '
			. ' and LOCATE(\'@\', email) > 0 '
			. ' and LOCATE(\' or \', email) <= 0 '
			. ' group by email ';
    	$rows = $this->_execute($query); 
    	$emails = array();
    	foreach ($rows as $row) {
    		if (substr_count($row->email, '@')<=1) {
    			$emails[] = $row->email;
    		}
    	}
		return $emails;				
	}
	*/
	
	/**
	 * This function will return an array of Contacts fora specific team.
	 *
	 * @param int $teamid
	 * @return array
	 */
	function getTeamContacts($teamid) {
		if (!is_numeric($teamid)) {
			throw new  Exception("Team Id is not numeric (JLTeamContactsDAO::getTeamContacts)");
		}
    	$iid = (int) $teamid;
    	$query = 'SELECT * FROM #__jleague_teamcontacts WHERE teamid = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		$contacts = array();
    		foreach ($rows as $row) {
    			$contact = $this->loadObject($row);
    			$contacts[] = $contact;
    		}
    		return $contacts;
    	}
    	return null;
    } 
    
    /**
     * This function will return an array of Contacts fora specific team.
     *
     * @param int $teamid
     * @return array
     */
    function isPrimaryContactDefined($teamid) {
    	if (!is_numeric($teamid)) {
    		throw new  Exception("Team Id is not numeric (JLTeamContactsDAO::getTeamContacts)");
    	}
    	$iid = (int) $teamid;
    	$query = 'SELECT * FROM #__jleague_teamcontacts WHERE primarycontact = 1 and teamid = ' . $iid;
    	$rows = $this->_execute($query);
		if (count($rows)>0) {
			return true;
		} else {
			return false;
		}
    }
        
    
    /**
     * This function will remove a contact from a team by its uniquue identifier.  
     *
     * @param int $id
     * @return boolean
     */
    /*
    function delete($id) {
    	if (!is_numeric($id)) {
			throw new  Exception("Team Id is not numeric (TEAMDAO::removeTeamContact)");
		}    	
		$iid = (int) $id;
		$query	= 'delete from #__jleague_teamcontacts where id = ' . $iid	;
		return self::_deleteRow($query);    	
    }
    */
    
    /**
     * This funciton will associate a contact object to a specific team.
     *
     * @param JLTeamContact $obj
     * @return boolean
     */
    function insert(JLTeamContact $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( '#__jleague_teamcontacts'  ) . ' (id, teamid, name, email, phone, role, primarycontact,userid) '
			. ' VALUES (0,'
			. '"' . $obj->getTeamId() . '",'			
			. '"' . $obj->getName() . '",' 
			. '"' . $obj->getEmail(). '",'
			. '"' . $obj->getPhone() . '",'
			. '"' . $obj->getRole(). '",'
			. '"' . $obj->isPrimary(). '",'
			. '"' . $obj->getUserid(). '"'
			.  ')';
		return $this->_insertRow($query);			
    }
     

    function update(JLTeamContact $contact) {
    	$query = 'update ' .$this->getNameQuote( $this->tablename  ) . ' set ' 
      		. ' teamid = "' . $contact->getTeamId() .'", '
			. ' name = "' . $contact->getName() .'", '
			. ' email = "' . $contact->getEmail() .'", '					
			. ' phone = "' . $contact->getPhone() .'", '
			. ' role = "' . $contact->getRole() .'", '
			. ' primarycontact = "' . $contact->isPrimary() .'", '
			. ' userid = "' . $contact->getUserid() .'" '
			. ' where id = ' . $contact->getId();		
    	return $this->_updateRow($query);
    }
    
}
