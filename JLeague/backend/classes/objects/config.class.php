<?php

/**
 * @version		$Id: config.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'property.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

/**
 * JLConfig is the configuration object for the component.  This implements the singleton pattern.  The 
 * configuration is on a per LEAGUE instance.   The configuration properties are stored as part of the 
 * LEAGUE database row.   The configuration is a wrapper class for the configuration properties associated
 * with the league.
 *
 */
class JLConfig extends JLBaseObject {
	
	private $leagueid = null;
	public $league = null;
	var $id = null;
	var $properties = null;
	
	public function __construct() {
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'leagueservice.class.php');
   		$lsvc = &JLLeagueService::getInstance();
   		$league = $lsvc->getActiveLeague();
		$this->setLeagueId($league->getId());
		$this->league = $league;
		/*
		$this->addProperty('logo_folder','images/jleague/');   //done
		$this->addProperty('logo_thumbnail_prefix','thumb');   //done
		$this->addProperty('current_season',9);   // done
		$this->addProperty('submit_scores_enabled',true);   //done
		$this->addProperty('edit_game_scores_enabled',true);   //done
		$this->addProperty('max_logo_height',150);   //done
		$this->addProperty('max_logo_width',150);   //done
		$this->addProperty('max_thumbnail_height',75);   //done
		$this->addProperty('max_thumbnail_width',75);		  //done
		$this->addProperty('community_profiletype_fieldid',17);   // not needed
		$this->addProperty('registration_open',1);   // done
		$this->addProperty('frontpage_format','upcominggames');	// DONE.   also can be scoreboard.
		$this->addProperty('games_on_frontpage_scoreboard',8);   // done
		$this->addProperty('games_on_league_scoreboard',24);  // done
		$this->addProperty('frontpage_upcoming_games_days',45);  // done
		$this->addProperty('frontpage_upcoming_games_games',10); // done
		$this->addProperty('frontpage_upcoming_games_readmoreitemid',190);  // done
		$this->addProperty('show_position_in_standings',false);   // done
		$this->addProperty('schedules_enabled',false);   // done
		$this->addProperty('rosters_enabled',true);   //done
		$this->addProperty('rosters_locked',false);  //done
		$this->addProperty('standings_frozen',false);   //not used
		$this->addProperty('use_gmaps_for_venues',true);   // done
		$this->addProperty('sanctioning_body_team_url','http://www.usssa.com/sports/Team3.asp?TeamID=');   // done
		$this->addProperty('copyright_notice','(c)2006-2012 Southwestern Illinois Baseball League');   // done
		$this->addProperty('game_notifications',false);   // done
		$this->addProperty('sms_notifications',false);   // done
		$this->addProperty('seo_enabled',true);  // done
		$this->addProperty('email_from_addr','chris@swibl-baseball.org');  // done
		$this->addProperty('email_from_name','SWIBL');   // done
		*/
	}
	
	function __destruct() {
		//echo "Configuration object destroyed";
	}
	
	/**
	 * Returns an instance of the configuration file.
	 *
	 * @param boolean $refresh
	 * @return JLConfig
	 */
	function getInstance($refresh = false) {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLConfig();
		} else {
			if ($refresh) {
				$instance->__destruct();
				$instance = new JLConfig();
			}
		}
		return $instance;
	}

	/**
	 * Returns the ID of the configuration
	 *
	 * @return int
	 */
	function getId() {
		return $this->id;
	}
	/**
	 * Sets the ID of the configuration.
	 *
	 * @param int $id
	 */
	function setId($id) {
		$this->id = $id;
	}
	/**
	 * Returns the LEAGUE ID.
	 *
	 * @return int
	 */
	function getLeagueId() {
		return $this->leagueid;
	}
	/**
	 * Sets the LEAGUE ID
	 *
	 * @param int $lid
	 */
	function setLeagueId($lid) {
		$this->leagueid = $lid;
	}
	
	/**
	 * Returns the value of a specific object property.
	 *
	 * @param String $key
	 * @return Mixed
	 * @deprecated Use the getProperty method. 
	 */
 	function getPropertyValue($key) {
 		return $this->league->getPropertyValue($key);
 		/*
 		if ($this->properties == null) 
 			return null;
 		if (isset($this->properties[$key])) {
 			return $this->properties[$key];
 		} else {
 			return null;
 		}
		*/
 	}
 	/**
 	 * Returns a value of a specific object property.
 	 *
 	 * @param String $key
 	 * @return Mixed
 	 */
 	function getProperty($key) {
 		$league = $this->league;
 		return $league->getPropertyValue($key);
 	}

 	function getProperties() {
 		return $this->league->getProperties();
 	}
}

?>