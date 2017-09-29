<?php
/**
 * @version		$Id: league.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLLeague extends JLBaseObject  {

	var $id = null;
	var $name=null;
	var $abbr = null;
	var $description = null;	
	var $published = null;
	var $propertykeys = 
		array(
			'',
			'current_season',
			'registration_open',
			'email_from_addr',
			'email_from_name',
			'copyright_notice',
			'sanctioning_body_team_url',
			'logo_folder',
			'max_logo_height',
			'max_logo_width',
			'logo_thumbnail_prefix',
			'max_thumbnail_height',
			'max_thumbnail_width',
			'games_on_frontpage_scoreboard',
			'games_on_league_scoreboard',
			'submit_scores_enabled',
			'edit_game_scores_enabled',
			'schedules_enabled',
			'rosters_enabled',
			'rosters_locked',
			'game_notifications',
			'show_position_in_standings',
			'use_gmaps_for_venues',
			'seo_enabled',
			'frontpage_format',
			'frontpage_upcoming_games_days',
			'frontpage_upcoming_games_games',
			'frontpage_upcoming_games_readmoreitemid',
			'twitter_enabled',
			'twitter_consumer_key',
			'twitter_consumer_secret',
			'twitter_access_token',
			'twitter_access_token_secret'	
		);

	function __construct() {
		parent::__construct();
		$this->id = 0;	
	}
	
	/**
	 * This function will set the league ID
	 *
	 * @param int $inParm
	 */
	function setId($inParm) {
		$this->id = $inParm;
	}
	/**
	 * This function will return the ID of the league
	 *
	 * @return int
	 */
	function getId() {
		return $this->id;
	}

	function setName($inParm) {
		$this->name = $inParm;
	}

	function getName() {
		return $this->name;
	}
	
	function setDescription($inParm) {
		$this->description = $inParm;
	}

	function getDescription() {
		return $this->description;
	}
	
	/**
	 * This will set the published indicator
	 *
	 * @param boolean $inParm
	 */
	function setPublished($inParm) {
		$this->published = $inParm;
	}
	
	/**
	 * This will return a boolean indicating whether or not the league is published
	 *
	 * @return boolean
	 */
	function getPublished() {
		return $this->published;
	}

	function setAbbrName($name) {
		$this->abbr = $name;
	}
	function getAbbrName() {
		return $this->abbr;
	}


}
