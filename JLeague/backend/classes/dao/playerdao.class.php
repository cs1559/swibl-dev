<?php
/**
 * @version 		$Id: playerdao.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'player.class.php');

class JLPlayerDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_players';
	var $selectquery = 'select * from #__jleague_players ' ;
	
	function findById($id) {
		$iid = (int) $id;
		$query = $this->selectquery . " where id = " . $iid;
		return parent::_getRow($query);
	}
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLPlayerDAO();
		}
		return $instance;
	}	
		
	/**
	 * 
	 * This function will insert a row into the PLAYERS table.
	 *
	 * @param JLDivision
	 * @return boolean
	 */
   	function insert(JLPlayer $obj) {
    	require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers'. DS . 'util.php');
    	$newDate = JLUtil::dateConvert($obj->getDateOfBirth(),1);
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, firstname, lastname, date_of_birth,city,state) '
			. ' VALUES (0,'
			. '"' . $obj->getFirstName() . '",' 
			. '"' . $obj->getLastName() . '",'			
			. ' date("' . $newDate. '"),'
			. '"' . $obj->getCity() . '",'
			. '"' . $obj->getState() . '"'															
			.  ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to update a row from the PLAYERS table.
     *
     * @param JLLeague $league
     * @return boolean
     */
    function update(JLPlayer $obj) {
    	require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers'. DS . 'util.php');
    	$newDate = JLUtil::dateConvert($obj->getDateOfBirth(),1);    	
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' firstname = "' . $obj->getFirstName(). '", '
			. ' lastname = "' . $obj->getlastName(). '", '			
			. ' date_of_birth =  date("' . $newDate. '"), '
			. ' city = "' . $obj->getCity(). '", '
			. ' state = "' . $obj->getState(). '" '						
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);			
			
		/*						
		$baseupdate = $this->_updateRow($query);
		$fieldupdate = $this->updateFields($obj);
		$rc = true;
		if (!$baseupdate && !$fieldupdate) {
			$rc = false;
		}
		return $rc;
		*/
    }
    

    /*
    function updateFields(JLTeam $team) {
    	$db	=& JLApp::getDBO();
    	$status = true;
    	$fields = $team->getCustomFields();
   		if (!empty($fields))	{    	
			foreach($fields as $fld){
				// Check if field value exists before inserting or updating
				$strSQL	= "SELECT COUNT(*) FROM #__jleague_fields_values"
						. " WHERE fieldid=" . $db->Quote($fld->getId()) . " AND teamid=" . $db->Quote($team->getId());
				$db->setQuery( $strSQL );
				$isNew	= ($db->loadResult() <= 0) ? true : false;
	
				$query = 'INSERT INTO ' .$this->getNameQuote( '#__jleague_fields_values'  ) . ' (teamid,fieldid,value) values ( '
					. $team->getId() . ', ' .  $fld->getId() . ', ' . $db->Quote($fld->getValue()) . ' )';
				
				if(!$isNew){
					$query = 'update ' .$this->getNameQuote( '#__jleague_fields_values'  ) . '  set '
						. ' teamid = ' . $team->getId() . ', '
						. ' fieldid = ' . $fld->getId() . ', '
						. ' value = "' . $fld->getValue() . '"';
				}
				$db->setQuery( $query );
				if (!$db->query()) {
					if ($status) {
						$status = false;
					}
				} 
			}
   		}
		return $status;    	
    }
	*/

    function getUnassignedPlayers($season) {
    	$query = "SELECT * FROM #__jleague_players where id not in ( "
			.	"SELECT playerid FROM #__jleague_rosterplayers as rp, #__jleague_roster r "
			.	" where r.id = rp.rosterid and r.season = " . $season . " ) order by lastname, firstname";
		return parent::_getRows($query);			
    }
    
    /**
     * This function will return an array of TEAM objects based on any filter conditions
     *
     * @param int $start
     * @param int $stop
     * @param String $orderby
     * @param String $filter
     * @return array
     */
	function getRecords($start, $stop, $orderby = '', $filter = '') {
		if (strlen($filter)>0) {
//			$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as t, #__jleague_divmap as dm '
//				. $filter . ' and t.id = dm.team_id ' . $orderby . ' LIMIT ' . $start . ',' . $stop;
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . $filter . ' ' . $orderby .' LIMIT ' . $start . ',' . $stop;
			return parent::_getRows($query);						
		} else {
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . ' ' . $orderby .' LIMIT ' . $start . ',' . $stop;			
			return parent::_getRows($query);
		}
 	} 	    
    
	function getTableSize($filter=null) {
		if (strlen($filter)>0) {		
			$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as t, #__jleague_divmap as dm '
				. $filter . ' and t.id = dm.team_id ';
		} else {
			return parent::getTableSize($filter);
		}
	 	$db			=& JLApp::getDBO();
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return sizeof($rows); 
  } 	

 
	/**
	 * This function retrieves the defined custom fields associated with a team profile
	 *
	 * @param unknown_type $id
	 */
  /*
	private function getCustomFields($id) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'field.class.php');
		$query = "select * from #__jleague_fields as q1 "
		 	. " left join (select fieldid,teamid,value from #__jleague_fields_values "
		 	. " where teamid = " . $id . " ) as q2 on (q1.id = q2.fieldid) where q1.published = 1";
		$db			=& JLApp::getDBO();
		$db->setQuery($query);		 	
		$result	= $db->loadObjectList();
	
		$fields = array();
		foreach ($result as $field) {
		   	$fld = new JLField();
		   	$fld->setId($field->id);
		   	$fld->setKeycode($field->keycode);
		   	$fld->setName($field->name);
		   	$fld->setType($field->type);
		   	$fld->setValue($field->value);
			if (strlen($field->properties)>0) {
			   $proparray = split("\n",$field->properties);
			   foreach ($proparray as $prop) {
			   		$property = split("=",$prop);
			   		$fld->addProperty($property[0],$property[1]);
			   }
			}
		   	$fields[$field->keycode] = $fld; 
		}
		return $fields;
	}
	*/
	
	/**
	 * This will map the the database row to the Team Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'player.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'factory.php');
		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'util.php');

		$obj = new JLPlayer();
		$obj->setId($row->id);
		$obj->setFirstName($row->firstname);
		$obj->setLastName($row->lastname);
		$obj->setDateOfBirth(JLUtil::dateconvert($row->date_of_birth,2));
		$obj->setCity($row->city);
		$obj->setState($row->state);

		/*
		$customfields = $this->getCustomFields($row->id);
		$obj->setCustomFields($customfields);
		*/
		return $obj;
	}

    
}
