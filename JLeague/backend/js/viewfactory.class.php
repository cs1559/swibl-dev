<?php
/**
 * @version 		$Id:viewfactory.class.php 111 2010-03-31 03:07:48Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Classes
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');

class JLViewFactory {
	
	function getView($viewName) {
		$view = null;
		switch ($viewName) {
			case 'LeagueListView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'leaguelistview.class.php');
				return new JLLeagueListView();
				break;
			case 'LeagueEditView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'leagueeditview.class.php');
				return new JLLeagueEditView();
				break;
			case 'SeasonsListView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasonslistview.class.php');
				return new JLSeasonsListView();
				break;	
			case 'SeasonEditView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'seasoneditview.class.php');
				return new JLSeasonEditView();
				break;
			case 'DivisionsListView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisionlistview.class.php');
				return new JLDivisionsListView();
				break;	
			case 'DivisionEditView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'divisioneditview.class.php');
				return new JLDivisionEditView();
				break;
			case 'TeamsListView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teamlistview.class.php');
				return new JLTeamsListView();
				break;	
			case 'TeamEditView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'teameditview.class.php');
				return new JLTeamEditView();
				break;			
			case 'StandingsListView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'standingslistview.class.php');
				return new JLStandingsListView();
				break;	
			case 'StandingsEditView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'standingseditview.class.php');
				return new JLStandingsEditView();
				break;			
			case 'GamesListView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'gameslistview.class.php');
				return new JLGamesListView();
				break;	
			case 'GamesEditView':
				require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'gameseditview.class.php');
				return new JLGamesEditView();
				break;															
			default:
				return null;
				break;
		}
		return $view;
	}
	
}

?>