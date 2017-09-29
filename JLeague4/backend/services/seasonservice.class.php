<?php

/**
 * @version		$Id: seasonservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');

class JLSeasonService  extends JLBaseService  {

	private $active_season = null;
	
	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function will return an instance of this service object.
	 *
	 * @return JLSeasonService
	 */	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSeasonService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = &JLFactory::getSeasonDao();
		return $dao;
	}

	function getRow($id) {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'season.class.php');
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'cache.class.php');
				
		$cache = & JLCache::getInstance();
		$cache_key = 'SeasonService_getRow';
		try {
			$row = $cache->get($cache_key);
		} catch (Exception $e) {
			$row = parent::getRow($id);
			$cache->store($cache_key,$id,$row);
		}
		return $row;		
		
		//return parent::getRow($id);
	}
	
	/**
	 * This function will return an instance of the most recent season object.
	 *
	 * @return JLSeason
	 */
	function getMostRecentSeason() {
		$dao = $this->getDao();
		return $dao->getMostRecentSeason();
	}
	
	/**
	 * this funtion will return the currently ACTIVE season.  There is an instance variable
	 * that cached in order to prevent an unnecessary database query.  If it is null, then
	 * the database will be queried; otherwise, the cached value will be returned.
	 *
	 * @return JLSeason
	 */
	function getActiveSeason() {
		if ($this->active_season == null) {
			try {
				$dao = $this->getDao();
				$this->active_season = $dao->getActiveSeason();
			} catch (Exception $e) {
				throw $e;
			}
		}
		return $this->active_season;
	}

	/**
	 * This is a function that will determine if registration is currently avaialble.  this
	 * will be determined by the extensions configuration setting and whether or not there are 
	 * seasons that have the enable registration indicator set. 
	 *
	 * @return boolean
	 */
	function isRegistrationOpen() {
		$config = JLApplication::getConfig();
		if (!$config->getProperty('registration_open')) {
			return false;
		}
		$seasons = $this->getSeasonsOpenForRegistration();
		if (count($seasons)<= 0) {
			return false;
		} else {
			return true;		
		}
		return false;		
	}
	
	/**
	 * This function will return an array of Season objects that have its registration open
	 * flag set to true. 
	 *
	 * @return array
	 */
	function getSeasonsOpenForRegistration() {
		$dao = $this->getDao();
		return $dao->getSeasonsOpenForRegistration();
	}
	
    /**
     * This function will perform the necessary tasks to close out a season.
     *
     */
    function closeSeason(JLSeason $season) {
    	require_once(JLEAGUE_SERVICES_PATH . DS . 'standingsservice.class.php');
    	
    	$config = JLConfig::getInstance();
    	
    	//TODO:  Authorization Check
   	    if (!JLSecurityService::isAuthorizedTask($context=null)) {
        	throw new Exception("Not Authorized to CLOSE season");
			return;
   	    }    	

   	    // Migrate STANDINGS data to the Standings Row
    	$svc = JLStandingsService::getInstance();
    	try {
    		$svc->migrateStandings($config->getLeagueId(), $season->getId());
    	} catch (Exception $e) {
    		throw $e;
    		return;
    	}
    	
    	/**
    	 * Migrate ACTIVE RECORD for current season to the record history table.
    	 */
    	// @TODO:  Need to add logic/code to add record to history table.
    	
    	/* The seasons ACTIVE status should not be set to false prior to migrating the standings.  The
    	 * reason is that the getStandings function in the standings service pulls data from the history
    	 * table when the season isn't active.  Only active seasons standings are pulled based on existing data.
    	 */
        $season->setActive(false);
        $season->setStatus("C");
        $season->setRegistrationOpen(false);
        $season->publishstandings(true);
        $this->save($season);
            	
		return;
    	
    }	
    
    /**
     * (non-PHPdoc)
     * @see JLBaseService::delete()
     */
    public function delete($id) {
    	$dao = $this->getDao();
    	if (!is_numeric($id)) {
    		throw new  Exception("ID is not numeric");
    	}
    	try {
    		$season = self::getRow($id);
    		if ($season->getStatus() == "C") {
    			throw new Exception("Cannot delete a CLOSED season");
    		}
    		$dao->delete($id);
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
    
}

?>