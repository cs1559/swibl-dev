<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once('componentbackendview.php');

class JLGamesView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
	}
	
	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::title( JLText::getText( 'Games' ), 'games');		
 		JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=games');
 		JToolBarHelper::cancel( 'cancelGame','Cancel' );	
 		JToolBarHelper::divider();
// 		JToolBarHelper::apply();
		JToolBarHelper::save();	}	
	
	function getDefaultToolbar() {
		JToolBarHelper::title( JLText::getText( 'Games' ), 'games');
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
//		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
//		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
//		JToolBarHelper::divider();
//		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'newgame' , JLText::getText( 'New' ) );
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