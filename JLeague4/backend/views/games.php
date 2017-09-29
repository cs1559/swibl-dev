<?php
/**
 * @version		$Id: games.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


require_once('componentbackendview.php');

class JLGamesView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
	}
	
	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Games' ), 'games');
		JToolBarHelper::apply();
		JToolBarHelper::save();
 		JToolBarHelper::cancel( 'cancelGame','Cancel' );	
	}	
	
	function getDefaultToolbar() {
		JToolBarHelper::title( JLText::getText( 'Games' ), 'games');
//		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague');
		JToolBarHelper::addNew( 'newgame' , JLText::getText( 'New' ) );
		// 		JToolBarHelper::editList();
		//		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		//		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		//		JToolBarHelper::deleteList();
	}

	function bindRequestToObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'game.class.php');
		$game = new JLGame();
		if (isset($_REQUEST["id"])) {
			$game->setId($_REQUEST["id"]);
		} else {
			$game->setId(0);
		}
		
		if (isset($_REQUEST["division_id"])) {
			$game->setDivisionId($_REQUEST["division_id"]);
		} else {
			throw new Exception(JLText::getText('JL_UNKNOWN_DIVISION_ID'));
		}
		if (isset($_REQUEST["season_id"])) {
			$game->setSeason($_REQUEST["season_id"]);
		} else {
			throw new Exception(JLText::getText('JL_UNKNOWN_SEASON_ID'));
		}		

		if (isset($_REQUEST["gamedate"])) {
			$game->setGameDate($_REQUEST["gamedate"]);
		} else {
			throw new Exception(JLText::getText('JL_MISSING_GAMEDATE'));
		}
				
		if (isset($_REQUEST["conference_game"])) {
			$game->setConferenceGame($_REQUEST["conference_game"]);
		} else {
			throw new Exception(JLText::getText('JL_MISSING_CONFGAME_INDICATOR'));
		}		
		
    	if (isset($_REQUEST['cb_league_hometeam'])) {
    		if ($_REQUEST['cb_league_hometeam']  == "on") {
    			$game->setHomeLeagueFlag("Y");
    		} else {
    			$game->setHomeLeagueFlag("N");
    		}
    	} else {
    		$game->setHomeLeagueFlag("N");
    	}
    	if (isset($_REQUEST['cb_league_awayteam'])) {
    		if ($_REQUEST['cb_league_awayteam']  == "on") {
    			$game->setAwayLeagueFlag("Y");
    		} else {
    			$game->setAwayLeagueFlag("N");
    		}
    	} else {
    		$game->setAwayLeagueFlag("N");
    	}  

    	if (isset($_REQUEST["hometeam_id"])) {
			$game->setHometeamId($_REQUEST["hometeam_id"]);
		} 
    	if (isset($_REQUEST["hometeam_name"])) {
			$game->setHometeam($_REQUEST["hometeam_name"]);
		} 		
    	if (isset($_REQUEST["awayteam_id"])) {
			$game->setAwayteamId($_REQUEST["awayteam_id"]);
		} 
    	if (isset($_REQUEST["awayteam_name"])) {
			$game->setAwayteam($_REQUEST["awayteam_name"]);
		} 			
		
		if (isset($_REQUEST["hometeam_score"])) {
			$game->setHometeamScore($_REQUEST["hometeam_score"]);
		} else {
			$game->setHometeamScore(0);
		}
		
		if (isset($_REQUEST["awayteam_score"])) {
			$game->setAwayteamScore($_REQUEST["awayteam_score"]);
		} else {
			$game->setAwayteamScore(0);
		}
		
		if (isset($_REQUEST["location"])) {
			$game->setLocation($_REQUEST["location"]);
		} 		
		if (isset($_REQUEST["highlights"])) {
			$game->setHighlights($_REQUEST["highlights"]);
		} 
				
		return $game;
		
	}
}

?>