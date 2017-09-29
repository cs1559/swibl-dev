<?php
/**
 * @version 		$Id: campaigndao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JLCampaignDAO extends fsBaseDAO {
	
	var $tablename = '#__jleague_campaign';
	
	protected function __construct() {
		parent::__construct();
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLCampaignDAO();
		}
		$db = mFactory::getDBO();
		$instance->setDatabase($db);
		return $instance;
	}	

    function getSponsorCampaigns($sponsorid) {
    	return $this->getRecords(0,99999999999,' order by startdate, campaign_name ',' where sponsor_id = ' . $sponsorid);
    }	
    
    function getSponsorActiveCampaigns($sponsorid) {
    	return $this->getRecords(0,99999999999,' order by startdate, campaign_name ',' where sponsor_id = ' . $sponsorid . ' and now() >= startdate and now() <= enddate');
    }
	
	/**
	 * 
	 * This function will insert a row into the SEASON table.
	 *
	 * @param JLSeason $league
	 * @return boolean
	 */
   	function insert(JLCampaign $obj) {
		$newStartDate = JLUtil::dateConvert($obj->getStartDate(),1);
		$newEndDate = JLUtil::dateConvert($obj->getEndDate(),1);    	   		
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, sponsor_id, campaign_name, notes, startdate, enddate, clickthru, clicks, published) '
			. ' VALUES (0,'
			. '"' . $obj->getSponsorId(). '",' 
			. '"' . $obj->getName() . '",'
			. '"' . $obj->getNotes() . '",'
			. '"' . $newStartDate . '",'
			. '"' . $newEndDate . '",'
			. '"' . $obj->getClickthru() . '",'
			. '"' . $obj->getClicks() . '",'									
			. $obj->getPublished() . ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to update a row from the Season table.
     *
     * @param JLSeason $obj
     * @return boolean
     */
    function update(JLCampaign $obj) {
		$newStartDate = JLUtil::dateConvert($obj->getStartDate(),1);
		$newEndDate = JLUtil::dateConvert($obj->getEndDate(),1);    	
		$query = 'update' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' sponsor_id = "' . $obj->getSponsorId(). '", '
			. ' campaign_name = "' . $obj->getName(). '", '
			. ' notes = "' . $obj->getNotes() . '", '
			. ' startdate = date("' . $newStartDate. '"), '
			. ' enddate = date("' . $newEndDate. '"), '						
			. ' clickthru = "' . $obj->getClickthru() . '", '
			. ' published = "' . $obj->getPublished(). '" '
			. ' where id = ' . $obj->getId();
		return $this->_updateRow($query);		
    }
	
    function click(JLCampaign $obj) {
    	$query = "update #__jleague_campaign set clicks=clicks+1 where id = " . $obj->getId();
    	return $this->_updateRow($query);
    }
        
    
	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		$obj = new JLCampaign();
		$obj->setId($row->id);
		$obj->setSponsorId($row->sponsor_id);
		$obj->setName($row->campaign_name);
		$obj->setNotes($row->notes);
		$obj->setPublished($row->published);
		$obj->setStartDate(JLUtil::dateconvert($row->startdate,2));
		$obj->setEndDate(JLUtil::dateconvert($row->enddate,2));
		$obj->setClicks($row->clicks);
		$obj->setClickthru($row->clickthru);
		return $obj;
	}

}
