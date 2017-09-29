<?php
/**
 * @version		$Id: ajax.php 234 2011-01-16 12:40:21Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controllers
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.controller' );

/**
 * AJ AX Controller.  This controller should be used for AJAX calls only.
 */
class JLeagueControllerBatch  extends JLeagueController {

	function __construct() {
		parent::__construct();
	}
	
	/**
	 * This is an AJAX function that will obtain all of the divisions for a given season.  This typically
	 * would be used on an event for a select list.
	 *
	 * @return JSON
	 */
	function calcRecordHistory() {
		
		die('inside calc');
		$db = &JLApplication::getDatabase();
		
		$query = "
create table jos_jleague_recordhistory 		
  ENGINE=MyISAM
	select id as team_id, season, season_title, division_id, division_name, teamname, runs_scored, runs_allowed, wins, losses, ties, ( wins *  2 ) + (losses *  0 ) + (ties *  1 ) points from ( 
				select id, season, season_title, division_id, division_name, teamname, sum(runs_scored) runs_scored, sum(runs_allowed) runs_allowed, sum(wins) wins,sum(losses) losses, sum(ties) ties, sum(points) points from
				( 
				select  hometeam_id id, score.season, seastbl.title season_title, divmap.division_id, divtbl.name division_name, team.name teamname,  sum(hometeam_score) runs_scored, sum(awayteam_score) runs_allowed, sum(if(hometeam_score > awayteam_score,1,0)) wins, sum(if(hometeam_score < awayteam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(hometeam_points) points, 'homegame' game 
				from jos_jleague_scores score, jos_jleague_teams team, jos_jleague_seasons seastbl, jos_jleague_divmap divmap, jos_jleague_division divtbl  
				where hometeam_id = team.id and score.season = seastbl.id and team.id = divmap.team_id 
						and score.season = divmap.season and divmap.division_id = divtbl.id 
						and conference_game like 'Y' and score.gamestatus = 'C'
					group by team.name, season, divmap.division_id 
				UNION 
				select  awayteam_id id, score.season, seastbl.title season_title,divmap.division_id,divtbl.name division_name, team.name teamname, sum(awayteam_score) runs_scored, sum(hometeam_score) runs_allowed, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(awayteam_points) points, 'awaygame' game 
				from jos_jleague_scores score, jos_jleague_teams team, jos_jleague_seasons seastbl, jos_jleague_divmap divmap, jos_jleague_division divtbl  
				where awayteam_id = team.id and score.season = seastbl.id and team.id = divmap.team_id 
						and score.season = divmap.season and divmap.division_id = divtbl.id 
						and conference_game like 'Y' and score.gamestatus = 'C'
						group by team.name, season, divmap.division_id
				) as recordtbl
				group by teamname, season, division_id
				) as stdgs 
		";
		$db->setQuery($query);
		$db->query();
		$query = "alter table jos_jleague_recordhistory add PRIMARY KEY  (team_id, season);";
		$db->setQuery($query);
		$db->query();

	}

}