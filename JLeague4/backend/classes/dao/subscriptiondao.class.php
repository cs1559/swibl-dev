<?php
/**
 * @version 		$Id: subscriptiondao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'subscription.class.php');

class JLSubscriptionDAO extends JLBaseDAO{
	
	var $tablename = '#__jleague_subscripttion';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSubscriptionDAO();
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
   	function insert(JLSubscription $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, userid, type, properties) '
			. ' VALUES (0,'
			. '"' . $obj->getUserid() . '",' 
			. '"' . $obj->getType() . '",'
			. '"' . $obj->getFormattedProperties() . '"'									
			.  ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to update a row from the Season table.
     *
     * @param JLSeason $obj
     * @return boolean
     */
    function update(JLSubscription $obj) {
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' userid = "' . $obj->getTitle(). '", '
			. ' type = "' . $obj->getDescription(). '", '
			. ' properties = "' . $obj->getFormattedProperties(). '" '
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);		
    }
        
    /**
     * This will return an array of subscription objects for a given user.
     *
     * @return array
     */
    function getSubscriptionsForUser($id) {
    	if (!is_numeric($teamid)) {
			throw new  Exception("User ID is not numeric");
		}
		$query = "select * from #__jleague_subscription where userid = " . $id;
    	return parent::_getRows($query);
    }    

	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'subscription.class.php');
		$obj = new JLSubscription();
		$obj->setId($row->id);
		$obj->setUserid($row->userid);
		$obj->setType($row->type);
		$obj->parseDatabaseObjectProperties($row->properties);
		return $obj;
	}

}
