<?php
/**
 * @version		$Id: standingsengine.class.php 448 2012-12-16 12:17:06Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */
defined('_JEXEC') or die('Restricted access');

/**
 * The JLStandingsEngine drives the creation of the League Standings for a seasion and/or division
 *
 */
class JLStandingsEngine {

	var $season = null;
	var $inClause = null;
	var $position = 0;
	var $debug = true;

	/**
	 * This function is the driver for generating the league standings.  This can generate standings for every division
	 * within the league or it can also filter based on a specific division id.
	 *
	 * @param int $season
	 * @param int $divid
	 * @return array
	 */
	function generateStandings($season, $divid = null, $debug=false) {
		
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
		
		$this->season = $season;
		
		$divsvc = & JLDivisionService::getInstance();
		$divisions = $divsvc->getDivisionsForSeason($season,$divid);
		
		$allstandings = array();
		
		foreach ($divisions as $division) {
			$divstdgs = $this->getDivisionalStandings($division->getId(),$season, false, $debug);
	//		$divstdgs = $this->getDivisionalStandings(23,6);
			if ($debug) {
				echo "**** " . $division->getName(). " ****";
				print_r($divstdgs);
			}
			if ($divstdgs != null) {
				$allstandings = array_merge($allstandings,$divstdgs);
			}
		}
		return $allstandings;
	}
	
	function generateTournamentStandings($season, $divid = null, $debug=false) {
		$this->season = $season;
		
		echo "inside generate tournament standings for season = " . $season;
		$divsvc = & JLDivisionService::getInstance();
		$divisions = $divsvc->getParentDivisionsForSeason($season, $divid);
		
		$allstandings = array();
		
		foreach ($divisions as $division) {
			$divstdgs = $this->getDivisionalStandings($division->getId(),$season, true, $debug);
			//		$divstdgs = $this->getDivisionalStandings(23,6);
			if ($debug) {
				echo "**** " . $division->getName(). " ****";
				print_r($divstdgs);
			}
			if ($divstdgs != null) {
				$allstandings = array_merge($allstandings,$divstdgs);
			}
		}
		return $allstandings;
	}
	
	
	/**
	 * This function will return the standings for a given division/season.
	 *
	 * @param int $divid
	 * @param int $season
	 * @return array
	 */
	private function getDivisionalStandings($divid, $season, $tourney=false, $debug=false) {
		//$debug = false;
		$divsvc = JLDivisionService::getInstance();
		$teams = $divsvc->getTeamsInDivision($divid);
		$div = $divsvc->getRow($divid);
		if ($tourney) {
			$standingRecords = $this->retrieveTournamentData($divid,$season, $div->getLeagueId());
		} else {
			$standingRecords = $this->retrieveData($divid,$season, $div->getLeagueId());
		}
		$standings = array();
		$this->position = 1;
		$conflict=false;
		$pending=null;
		$x=0; $z=0;
		 
		//echo '# of standing records found ... ' . sizeof($standingRecords) . '<br/>';
		if (sizeof($standingRecords) == 0) {
			return null;
		}
		//if the top team has a 0 winpct, return the standings based on the SQL
		/**
		 * If the first record within the division has a winning percentage of ZERO, then no games have been
		 * played so just return the entire array.
		 */
		if ($standingRecords[0]->getWinningPercentage() == 0) {
			return $standingRecords;
		}

		$leaderWins = $standingRecords[0]->getWins();
		$leaderLosses = $standingRecords[0]->getLosses();
		 
		$match = false;
		for ($y=0; $y < sizeof($standingRecords); $y++) {

			if ($debug)
				echo 'TEAM:  '. $standingRecords[$y]->getTeamName() . '<br/>';

			$gamesback = (($leaderWins-$standingRecords[$y]->getWins())*.5)+(($standingRecords[$y]->getLosses() - $leaderLosses)* .5);
			//echo "GAMES BACK = " . $gamesback;
			$match = false;

			// COMPARE CURRENT ROW WITH NEXT ROW
			if (($y+1)< sizeof($standingRecords)) { 
				if ($debug) {
					echo "*** Evaluating current row and next";
				}
				/* 07/03/2015 if (($standingRecords[$y]->getPoints() == $standingRecords[$y+1]->getPoints()) &&
				($standingRecords[$y]->getWinningPercentage() == $standingRecords[$y+1]->getWinningPercentage()) &&
				($standingRecords[$y]->getTotalGames()== $standingRecords[$y+1]->getTotalGames())) {  */
				if (($standingRecords[$y]->getPoints() == $standingRecords[$y+1]->getPoints()) &&
				($standingRecords[$y]->getWinningPercentage() == $standingRecords[$y+1]->getWinningPercentage()) ) {
					if ($debug) {
						//echo $this->getTotalGames($standingRecords[$y]);
						echo '*** NEXT TEAM MATCHES in points and winpct and games<br/>';
						//echo $this->getTotalGames($standingRecords[$y+1]);
					}
					$pending[$x]=$standingRecords[$y];
					if ($debug) {
						echo "+++ Adding " . $standingRecords[$y]->getTeamName() . " to pending # " . $x;
					}
					$x++;
					$conflict = true;
					$match = true;
				} else {
					
				}
			}
			 
			// COMPARE CURRENT ROW WITH PREVIOUS ROW
			if ($y==0) {
				$xpts = 0;
				$xwinpct = 0;
			} else {
				$xpts = $standingRecords[$y-1]->getPoints();
				$xwinpct = $standingRecords[$y-1]->getWinningPercentage();
			}
			
			if (($standingRecords[$y]->getPoints() == $xpts) &&($standingRecords[$y]->getWinningPercentage() == $xwinpct) && !$match) {
				if ($debug) {
					echo '*** PREVIOUS TEAM MATCHES in points and winpct<br/>';
				}
				// IF THIS TEAMS WINPCT <> NEXT TEAMS WINPCT BUT HAS THE SAME PTS AND WINPCT AS PREV TEAM
				if (($y+1)< sizeof($standingRecords)) {
					if ($standingRecords[$y]->getWinningPercentage() != $standingRecords[$y+1]->getWinningPercentage()) {
						if ($debug) {
							echo '   *** NEXT TEAM DOES NOT MATCH - PROCESS PENDING ROWS<br/>';
						}
						$pending[$x]=$standingRecords[$y];
						if ($debug) {
							echo "+++ Adding " . $standingRecords[$y]->getTeamName() . " to pending # " . $x;
						}
						$x++;
						$match = true;
						$conflict = true;
						if ($debug) {
							echo '        processing conflicts .... ' . sizeof($pending) . '<br/>';
						}
						//$this->processConflicts(&$pending,&$standings,&$standingRecords,$season);
						$this->processConflicts($pending,$standings,$standingRecords,$season);
						$conflict = false;
						$x = 0;
						// IF TEAM HAS SAME WINPCT THEN CHECK # OF GAMES
					} else if ($y+1 < sizeof($standingRecords)) {

						if ($standingRecords[$y]->getPoints()!= $standingRecords[$y+1]->getPoints()) {
							if ($debug) {
								echo '   *** NEXT TEAM HAS DIFFERNT AMOUNT OF POINTS - PROCESS PENDING ROWS<br/>';
							}
							$pending[$x]=$standingRecords[$y];
							if ($debug) {
								echo "+++ Adding " . $standingRecords[$y]->getTeamName() . " to pending # " . $x;
							}
								
							$x++;
							$match = true;
							$conflict = true;
							$this->processConflicts($pending,$standings,$standingRecords,$season);
							$conflict = false;
							$x = 0;
						}
						if ($standingRecords[$y]->getTotalGames()!= $standingRecords[$y+1]->getTotalGames()) {
							// DO NOTHING 07/03/2014
							/*
							if ($debug)
							echo '   *** NEXT TEAM HAS DIFFERNT AMOUNT OF GAMES - PROCESS PENDING ROWS<br/>';
							$pending[$x]=$standingRecords[$y];
							$x++;
							$match = true;
							$conflict = true;
							$this->processConflicts($pending,$standings,$standingRecords,$season);
							//$this->processConflicts(&$pending,&$standings,&$standingRecords,$season);
							$conflict = false;
							$x = 0;
							END 07/03/2015 */	
						} else {
							if ($debug)
							echo "SAME # OF GAMES .... <br/>";
						}
						
					}
				} else {
					$pending[$x] = $standingRecords[$y];
					if ($debug) {
						echo "+++ Adding " . $standingRecords[$y]->getTeamName() . " to pending # " . $x . " (Last Standings Record)";
					}
				}
			} else {
				if (($y+1)==count($standingRecords)) {
					$xgames = 999999999;
				} else {
					$xgames = $standingRecords[$y+1]->getTotalGames();
				}
				if ($standingRecords[$y]->getTotalGames()!= $xgames && !$match) {
					/* 07/03/2015
					$pending[$x]=$standingRecords[$y];
					$x++;
					$match = true;
					$conflict = true;
					if ($debug)
					echo '   *** NEXT TEAM HAS DIFFERNT AMOUNT OF GAMES - PROCESS PENDING ROWS<br/>';
					$this->processConflicts($pending,$standings,$standingRecords);
					//$this->processConflicts($pending,$standings,$standingRecords);
					$conflict = false;
					$x = 0;
					*/
				} else {
					$match = false;
					//echo "NOmatch<br/>";
				}
			}
			if (!$conflict && !$match) {
				//echo '*** ADDING STANDINGS ROW<br/>';
				$standingRecords[$y]->setPosition($this->position);
				array_push($standings,$standingRecords[$y]);
				$this->position++;
			}

		}

		// 04.14.2010 - changed to test for > 1.  
		if (sizeof($pending)>1) {
			for ($y=0; $y<sizeof($pending); $y++) {
				$pending[$y]->setPosition($this->position);
				array_push($standings,$pending[$y]);
			}
		}
		return $standings;
	}
	
	
	/**
	 * The retrieveData function retrieves the base standings data from the database.  Once the data has been retrieved,
	 * the array of standings records will be processed to identify any conflicts (i.e. teams with same pts, win, losses).
	 *
	 * @param int $id  (DivisionId)
	 * @param int $season
	 * @return array
	 */
     function retrieveData($id, $season, $leagueid=0) {
//      	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'standing.class.php');	
	    
     	$database = &mFactory::getDBO();
     	
	    $dataArray = array();
    	$winpts = 2;
    	$losspts = 0;
    	$tiepts = 1;
    	
    	// =================================================================================
    	// 	NOTE:  The ORDER BY clause in this query is used to ensure that teams that 
    	//	haven't played games appears last in the standings list. 
    	// =================================================================================    	
			$query = "select * from ( "
			. "\n select division_id, id, season, teamname, wins,losses, ties, wins+losses+ties total_games, ( wins * " . $winpts . ") + (losses * " . $losspts . ") + (ties * " . $tiepts . ") points, " .
			 " runs_scored, runs_allowed, (wins / (wins + losses + ties)) winpct from "
			. "\n ( " 
			. "\n select division_id, id, season, teamname,sum(wins) wins,sum(losses) losses, sum(ties) ties, sum(points) points, sum(runs_scored) runs_scored, sum(runs_allowed) runs_allowed from"
			. "\n ( " 
			. "\n select m.division_id, team.id, " . $season . " season, team.name teamname, 0 wins, 0 losses, 0 ties, 0 points, 0 runs_allowed, 0 runs_scored, 'nogame' game from #__jleague_divmap m, #__jleague_teams team where m.division_id = " . $id  . "  and m.published = 1 	and season = " . $season . " and m.team_id = team.id "
			. "\n UNION"
			. "\n select  m.division_id, hometeam_id id, score.season, team.name teamname, sum(if(hometeam_score > awayteam_score,1,0)) wins, sum(if(hometeam_score < awayteam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(hometeam_points) points, sum( awayteam_score ) runs_allowed, sum( hometeam_score ) runs_scored,'homegame' game"
			. "\n from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m " 
			. "\n where score.hometeam_id = team.id and score.hometeam_id = m.team_id  and m.published = 1 and score.season = " . $season . " and gamestatus = 'C' and conference_game = 'Y' and m.division_id = " . $id . " "
			. "\n group by division_id, id, team.name, season "
			. "\n UNION "
			. "\n select  m.division_id, awayteam_id id, score.season, team.name teamname, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(awayteam_points) points, sum( hometeam_score ) runs_allowed, sum( awayteam_score ) runs_scored, 'awaygame' game "
			. "\n from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m " 
			. "\n where score.awayteam_id = team.id and score.awayteam_id = m.team_id and m.published = 1 and score.season = " . $season . " and gamestatus = 'C' and conference_game = 'Y'  and m.division_id = " . $id . " "
			. "\n group by division_id, id, team.name, season"
			. "\n ) as recordtbl"
			. "\n group by division_id, id, teamname, season"
			. "\n ) as stdgs "
			. "\n ) as stdgstable "
			. "\n order by points desc, wins desc, runs_allowed, teamname";
			/*  . "\n order by points desc, wins desc, losses desc, ties desc, teamname"; */
				
    	
			$database->setQuery($query);
			
		if (!$database->query()) {
			echo $database->stderr();
			//Logger::log('StandingsGenerator.retrieveData',$database->stderr());
			//Utility::handleError('StandingsGenerator.retrieveData',$database->stderr());			
			return;
		}		
			$rows = $database->loadObjectList();	

	    for ($i = 0; $i < sizeof($rows); $i++) {
       		//TODO:  Need to change record to a base class and then two extended class
       		// one for team record and another for DivisionStandingRecord
			$record = new JLStanding();
			$record->setLeagueId($leagueid);
			$record->setTeamId($rows[$i]->id);
			$record->setDivisionId($rows[$i]->division_id);
			$record->setTeamName($rows[$i]->teamname);
			$record->setSeason($rows[$i]->season);
			$record->setWins($rows[$i]->wins);
			$record->setLosses($rows[$i]->losses);
			$record->setTies($rows[$i]->ties);
			$record->setPoints($rows[$i]->points);
			$record->setRunsAllowed($rows[$i]->runs_allowed);
			$record->setRunsScored($rows[$i]->runs_scored);
			//$this->calculatePoints(& $record);	
	 		$dataArray[]=$record;
	     }	
	    return $dataArray;	    	
    }

    /**
     * The retrieveData function retrieves the base standings data from the database.  Once the data has been retrieved,
     * the array of standings records will be processed to identify any conflicts (i.e. teams with same pts, win, losses).
     *
     * @param int $id  (DivisionId)
     * @param int $season
     * @return array
     */
    function retrieveTournamentData($id, $season, $leagueid=0) {
    	
     	$database = &mFactory::getDBO();
     	
	    $dataArray = array();
    	$winpts = 2;
    	$losspts = 0;
    	$tiepts = 1;
    
    	// =================================================================================
    	// 	NOTE:  The ORDER BY clause in this query is used to ensure that teams that
    	//	haven't played games appears last in the standings list.
    	// =================================================================================
    	$query = "select * from ( "
    			. "\n select division_id, parent_divid, id, season, teamname, wins,losses, ties, wins+losses+ties total_games, ( wins * " . $winpts . ") + (losses * " . $losspts . ") + (ties * " . $tiepts . ") points, " .
    			" runs_scored, runs_allowed, (wins / (wins + losses + ties)) winpct from "
    		. "\n ( "
    		. "\n  select division_id, parent_divid, id, season, teamname,sum(wins) wins,sum(losses) losses, sum(ties) ties, sum(points) points, sum(runs_scored) runs_scored, sum(runs_allowed) runs_allowed from"
    		. "\n ( "
    		. "\n select m.division_id, d.parent_divid, team.id, " . $season . " season, team.name teamname, 0 wins, 0 losses, 0 ties, 0 points, 0 runs_allowed, 0 runs_scored, 'nogame' game from #__jleague_divmap m, #__jleague_division d, #__jleague_teams team where m.division_id = d.id and m.published = 1  	and m.season = " . $season . " and m.team_id = team.id "
    		. "\n UNION"
    		. "\n select  m.division_id, d.parent_divid, hometeam_id id, score.season, team.name teamname, sum(if(hometeam_score > awayteam_score,1,0)) wins, sum(if(hometeam_score < awayteam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(hometeam_points) points, sum( awayteam_score ) runs_allowed, sum( hometeam_score ) runs_scored,'homegame' game"
    		. "\n from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m, joom_jleague_division d "
    		. "\n where score.hometeam_id = team.id and score.hometeam_id = m.team_id and score.season = m.season and m.division_id = d.id  and m.published = 1 and score.season = " . $season . " and gamestatus = 'C' and conference_game = 'Y' "
    		. "\n group by division_id, parent_divid, id, teamname, score.season "
    		. "\n UNION "
    		. "\n select  m.division_id, d.parent_divid, awayteam_id id, score.season, team.name teamname, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(awayteam_points) points, sum( hometeam_score ) runs_allowed, sum( awayteam_score ) runs_scored, 'awaygame' game "
    		. "\n from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m, joom_jleague_division d "
    		. "\n where score.awayteam_id = team.id and score.awayteam_id = m.team_id and score.season = m.season and m.division_id = d.id  and m.published = 1 and score.season = " . $season . " and gamestatus = 'C' and conference_game = 'Y' "
    		. "\n group by division_id, parent_divid, id, teamname, score.season"
    		. "\n ) as recordtbl"
    		. "\n group by division_id, parent_divid, id, teamname, season"
    		. "\n ) as stdgs "
    		. "\n ) as stdgstable "
    		. "\n where parent_divid = " . $id . " "
    		. "\n order by points desc, wins desc, runs_allowed, teamname";
    																																							
    	$database->setQuery($query);
    	if (!$database->query()) {
    		echo $database->stderr();
    		//Logger::log('StandingsGenerator.retrieveData',$database->stderr());
    		//Utility::handleError('StandingsGenerator.retrieveData',$database->stderr());
    		return;
    	}
    	$rows = $database->loadObjectList();
    	for ($i = 0; $i < sizeof($rows); $i++) {
    		//TODO:  Need to change record to a base class and then two extended class
    		// one for team record and another for DivisionStandingRecord
    		$record = new JLStanding();
    		$record->setLeagueId($leagueid);
    		$record->setTeamId($rows[$i]->id);
    		$record->setDivisionId($rows[$i]->parent_divid);
    		$record->setTeamName($rows[$i]->teamname);
    		$record->setSeason($rows[$i]->season);
    		$record->setWins($rows[$i]->wins);
    		$record->setLosses($rows[$i]->losses);
    		$record->setTies($rows[$i]->ties);
    		$record->setPoints($rows[$i]->points);
    		$record->setRunsAllowed($rows[$i]->runs_allowed);
    		$record->setRunsScored($rows[$i]->runs_scored);
    		//$this->calculatePoints(& $record);
    		$dataArray[]=$record;
    	}
    	return $dataArray;
    }
        
    
    
    
	/**
	 * This is a helper function to calculate points to be award to each team based on their record
	 *
	 * @deprecated 
	 */
    private function calculatePoints($record) {
    	$winpts = 2;
    	$losspts = 0;
    	$tiepts = 1;
    	
    	$w = $record->getWins() * $winpts;
    	$l = $record->getLosses() * $losspts;
    	$t = $record->getTies() * $tiepts ;
    	
    	$total = $w + $l + $t;
    	$record->setPoints($total);
    }
    
     private function loadObject($row) {
     	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'standing.class.php');
		$obj = new JLStanding();
		$obj->setId($row->id);
		$obj->setTeamId($row->id);
		$obj->setPosition($row->position);
		$obj->setDivisionId($row->division_id);
		$obj->setSeason($row->seasonid);
		$obj->setTeamName($row->teamname);
		$obj->setWins($row->wins);
		$obj->setLosses($row->losses);		
		$obj->setTies($row->ties);
		$obj->setPoints($row->points);
		return $obj;
		
    }	
	
    /**
     * The processConflicts function will take an array of standing records and resequence them
     * based on defined business rules.
     *
     * @param unknown_type $pending
     * @param unknown_type $standings
     * @param unknown_type $standingRecords
     */
	private function processConflicts(&$pending, &$standings, &$standingRecords,$season=null) {
			
		if ($this->debug) {
			if (sizeof($pending)>1) {
				var_dump($pending);
			}
		}
		while (sizeof($pending) > 0) {
			if (sizeof($pending) > 1) {
				//$nextteamId = $this->resolveConflict(&$pending,$season);
				$nextteamId = $this->resolveConflict($pending,$season);
			} else
				$nextteamId = $pending[0]->getTeamId();
			if ($nextteamId == null) {
				//echo 'NO TEAM CAN BE DETERMINED -- teams share current position = ' . $this->position . '<br/>';
				// Add rows for each "conflicting" position as a 'tie'
				$nextposition = $this->position + sizeof($pending);
				//echo "NExST POSITION = " . $nextposition;
				for ($z=0; $z<sizeof($pending);$z++) {
					$nextStandingRow = $this->getItemFromOriginalArray($pending[$z]->getTeamId(), $standingRecords);
					$nextStandingRow->setPosition($this->position);
					//echo "Adding new standings row<br/>";
					array_push($standings,$nextStandingRow);
				}
				$pending = array();
				$this->position = $nextposition;
				//echo "+++ next position is " . $this->position . '<br/>';
				break;
			} else {
				$nextStandingRow = $this->getItemFromOriginalArray($nextteamId, $standingRecords);
				$nextStandingRow->setPosition($this->position);
				array_push($standings,$nextStandingRow);
				$this->position++;
				//$this->removeItemFromArray($nextteamId, &$pending);
				$this->removeItemFromArray($nextteamId, $pending);
			}
		}
	}
	
	/**
	 *
	 */
	private function getItemFromOriginalArray($id, $inArray) {
		$returnVal = null;
		for ($y=0; $y<sizeof($inArray); $y++) {
			$obj = $inArray[$y];
			if ($obj->getTeamId() == $id) {
				$returnVal=$obj;
			}
		}
		return $returnVal;
	}
	
	/*
	 * This function removes an item from the "conflict" array after it has been determined that
	 * an item in the array is the next row to display in the standings
	 */
	private function removeItemFromArray($id, &$inArray) {
		$newArray = array();
		$x=0;
		for ($y=0; $y<sizeof($inArray); $y++) {
			$obj = $inArray[$y];
			if ($obj->getTeamId() != $id) {
				$newArray[$x] = $obj;
				$x++;
			}
		}
		$inArray = $newArray;
	}    
	
	private function resolveConflict(&$inArray,$season=null) {
		echo "resolving conflict";
		
		print_r($inArray);
		
		//var_dump($inArray);
		// If there is only one row, then that obviously will be the last row
		if (sizeof($inArray) == 1) {
			return $inArray[0];
		}

		// Build the "IN" portion of the WHERE clause
		for ($y=0; $y < sizeof($inArray); $y++) {
			if ($y == 0) {
				$this->inClause = $inArray[$y]->getTeamId();
			} else {
				$this->inClause .= ',' . $inArray[$y]->getTeamId();
			}
		}

		if ($this->debug) {
			echo ' inclause = ' . $this->inClause;
		}
		//		for ($i=0; $i < sizeof($inArray); $i++) {
		//echo "Processing " . $inArray[$i]->getName().'<br/>';
		//		}
		// Apply Ordering Rules
		/*
		$config = new LMConfig();
		$rules = $config->getTieBreakerRules();
		foreach ($rules as $id) {
			//echo 'Rule # ' . $id;
		}
		*/

		$newteamId = $this->testHeadToHeadRecord($inArray,$season);
		//$newteamId = $this->testHeadToHeadRecord(&$inArray,$season);
		if ($this->debug) {
			echo "After head to head ... " . $newteamId . "<br/>";
		}
		if ($newteamId == null) {
			echo "testing Runs Allowed";
			//$newteamId = $this->testRunsAllowed(&$inArray);
			$newteamId = $this->testRunsAllowed($inArray);
		} else {
			echo "not testing runs allowed";
		}
		if ($newteamId == null) {
			//$newteamId = $this->testRunsScored(&$inArray);
			$newteamId = $this->testRunsScored($inArray);
		}
		if ($this->debug) {
			echo "After runs scored ... " . $newteamId . "<br/>";
		}
		if ($this->debug) {
			echo "After runs allowed ... " . $newteamId . "<br/>";
		}
		return $newteamId;

	}
	
	/**
	 * The checkNumberOfGamesPlayed rule processes an array of teams to determine whose played the more games.  The team
	 * who has played the more games is given the lead in the standings.
	 *
	 * @deprecated
	 * @param array $inArray
	 * @return int
	 */
	private function checkNumberOfGamesPlayed($inArray) {
		$neworder = null;
		$id = $inArray[0]->getTeamId();
		$games = $this->getGameCount($id);
		//echo 'THE TEAM IS ' . $id . ' GP = '.  $games . '<br/>';
		// Set the initial "leader" to the first row
		$currentLeader = $id;
		$minPlayed = $games;
		$morethanone = false;
		for ($y=1; $y < sizeof($inArray); $y++) {
			$id = $inArray[$y]->getTeamId();
			$games = $this->getGameCount($id);
			//echo "TEAM = " . $id . " xGP = " . $games . '<br/>';
			if ($games < $minPlayed) {
				$currentLeader = $id;
				$minPlayed = $runs;
				$morethanone = false;
			} elseif ( $games == $minPlayed ) {
				$morethanone = true;
			}
		}

		if ($morethanone == true) {
			return null;
		}
		else {
			//echo "RETURNING " . $currentLeader . "<br/>";
			return $currentLeader;
		}
	}

	/**
	 * The testHeadToHeadRecord will iterate through an array of standings records and determine who has the best
	 * head-to-head record between the group.
	 *
	 * @param array $inArray
	 * @param int $season
	 * @return int
	 */
	private function testHeadToHeadRecord(&$inArray,$season=null) {
		$database = &mFactory::getDBO();
		$change = false;
		$newarray = null;
		if ($this->debug) {
			echo "processing head-to-head record";
		}
		
		/**
		 * 			. "\n select  m.division_id, awayteam_id id, score.season, team.name teamname, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(awayteam_points) points, 'awaygame' game "
			. "\n from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m " 
			. "\n where score.awayteam_id = team.id and score.awayteam_id = m.team_id and score.season = " . $season . " and gamestatus = 'C' and conference_game = 'Y'  and m.division_id = " . $id . " "
			. "\n group by division_id, id, team.name, season"
			. "\n ) as recordtbl"
		 */
		$query = 'select division_id, id, season, teamname, wins, losses, ties, (wins / (wins + losses + ties)) winpct from ('
		. 	'select division_id, id, ' . $this->season . ' season, teamname,sum(wins) wins,sum(losses) losses, sum(ties) ties from '
		.	' ( select  m.division_id, hometeam_id id, score.season, team.name teamname, sum(if(hometeam_score > awayteam_score,1,0)) wins, sum(if(hometeam_score < awayteam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties,  "homegame" game '
		.	' from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m  '
		.	' where score.hometeam_id = m.team_id and m.season = score.season and hometeam_id = team.id and hometeam_id in (' . $this->inClause . ') and  awayteam_id in (' . $this->inClause . ') and score.season = '.$season. ' and conference_game = "Y" and gamestatus = "C" '
		. 	' group by team.name, score.season '
		.	' UNION '
		.	' select  m.division_id, awayteam_id id, score.season, team.name teamname, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, "awaygame" game '
		.	' from #__jleague_scores score, #__jleague_teams team, #__jleague_divmap m  '
		.	' where score.awayteam_id = m.team_id and m.season = score.season and awayteam_id = team.id and hometeam_id in (' . $this->inClause . ') and  awayteam_id in (' . $this->inClause . ')  and score.season = '.$season. ' and conference_game = "Y" and gamestatus = "C" '
		.	' group by team.name, score.season '
		.	' )  as recordtbl group by teamname, season '
		.	' ) as stdgs group by wins desc, id, teamname ';
		
		echo $query;
		
		
		$database->setQuery($query);
		if (!$database->query()) {
			throw new Exception($database->stderr());
		}
		$rows = $database->loadObjectList();
			
		if (sizeof($rows) == 0) {
			return null;
		}
		// Set the initial "leader" to the first row
		//$currentLeader = $this->loadObject($rows[0]);
		$currentLeader = $rows[0];
		if ($this->debug) {
			echo ' current leader = ' . $currentLeader->teamname . '<br/>';
		}
		$morethanone = false;

		print_r($rows);
		// 	If the first two rows in the array have the same # of wins, we can't determine "winner" based on this
		//	rule so return NULL
		if ($this->debug) {
			echo ' current leaders # of wins ' . $currentLeader->wins  . ' - next rows # of wins ' .$rows[1]->wins . '<br/>';
		}
		if ($currentLeader->wins == $rows[1]->wins) {
			return null;
		}
		//TODO:  May need to test for out of range error with the array.  assume that there are multiple rows
		for ($y=1; $y < sizeof($rows); $y++) {
			//$obj = $this->loadObject($rows[$y]);
			$obj = $rows[$y];
			if ($this->debug) {
				echo 'h2h:  current leader winpct = ' . $currentLeader->winpct . ' Current row = ' . $obj->winpct . '<br/>';
			}
			if ($obj->wins> $currentLeader->wins) {
				$currentLeader = $obj;
				$morethanone = false;
			} elseif ( $obj->wins == $currentLeader->wins) {
				$morethanone = true;
			}
			/*
			 if ($obj->getWinningPct()> $currentLeader->getWinningPct()) {
				$currentLeader = $obj;
				$morethanone = false;
				} elseif ( $obj->getWinningPct() == $currentLeader->getWinningPct()) {
				$morethanone = true;
				}
				*/
		}
		if ($this->debug) {
			echo 'Current Leader = ' . $currentLeader->teamname . ' --- More than one?' . $morethanone . '<br/>';
		}
		if ($morethanone == true) {
			return null;
		}
		else {
			return $currentLeader->id;
		}
	}

	/**
	 * This routine will return the team with the most runs scored within the entire group
	 * It will return null if there are two or more teams are tied with the number of runs scored
	 */
	private function testRunsScored(&$inArray) {
		$neworder = null;
		$id = $inArray[0]->getTeamId();
		$runs = $this->getRunCounts($id);
		// Set the initial "leader" to the first row
		$currentLeader = $runs["ID"];
		$maxScored = $runs["SCORED"];
		$morethanone = false;
		for ($y=1; $y < sizeof($inArray); $y++) {
			$id = $inArray[$y]->getTeamId();
			$runs = $this->getRunCounts($id);
			if ($runs["SCORED"] > $maxScored) {
				$currentLeader = $runs["ID"];
				$morethanone = false;
			} elseif ( $runs["SCORED"] == $maxScored ) {
				$morethanone = true;
			}
		}

		if ($morethanone == true) {
			return null;
		}
		else {
			return $currentLeader;
		}
	}



	private function testRunsAllowed(&$inArray) {
		$neworder = null;
		$id = $inArray[0]->getTeamId();
		$runs = $this->getRunsAllowed($id);
		// Set the initial "leader" to the first row
		$currentLeader = $id;
		$minAllowed = $runs;
		$morethanone = false;
		for ($y=1; $y < sizeof($inArray); $y++) {
			$id = $inArray[$y]->getTeamId();
			$runs = $this->getRunsAllowed($id);
			if ($runs < $minAllowed) {
				$currentLeader = $id;
				$minAllowed = $runs;
				$morethanone = false;
			} elseif ( $runs == $minAllowed ) {
				$morethanone = true;
			}
		}

		if ($morethanone == true) {
			return null;
		}
		else {
			return $currentLeader;
		}
	}

	private function getGameCount($id) {
		$database = &mFactory::getDBO();
		$query = 'select id, count(*) total_games from ('
		. 	'SELECT hometeam_id id, id as game_id '
		.	' FROM #__jleague_scores WHERE hometeam_id = ' . $id
		.	' and conference_game = "Y" and gamestatus = "C" and season = ' . $this->season . ' group by hometeam_id,game_id '
		.	' UNION '
		. 	' SELECT awayteam_id id, id as game_id '
		.	' FROM #__jleague_scores WHERE awayteam_id = ' . $id
		.	' and conference_game = "Y" and gamestatus = "C" and season = ' . $this->season . ' group by awayteam_id, game_id '
		.	' ) as summary group by id';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		//echo $database->stderr();
		return $rows[0]->total_games;
	}
	private function getRunCounts($id) {
		$database = &mFactory::getDBO();
		$query = 'select id, sum(runs_score) runs_scored, sum(runs_allowed) runs_allowed from ( '
		. 	'SELECT hometeam_id id,sum( hometeam_score ) runs_score, sum( awayteam_score ) runs_allowed '
		.	' FROM #__jleague_scores WHERE hometeam_id = ' . $id . ' AND awayteam_id IN ( ' . $this->inClause . ' ) '
		.	' and conference_game = "Y" and gamestatus = "C" and season = ' . $this->season . ' group by hometeam_id '
		.	' UNION '
		. 	' SELECT awayteam_id id,sum( awayteam_score ) runs_scored, sum( hometeam_score ) runs_allowed '
		.	' FROM #__jleague_scores WHERE awayteam_id = ' . $id . ' AND hometeam_id IN ( ' . $this->inClause . ' ) '
		.	' and conference_game = "Y" and gamestatus = "C" and season = ' . $this->season . ' group by awayteam_id '
		.	' ) as summary group by id';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		if (sizeof($rows)>0) {
			$runs = array("ID"=> $rows[0]->id,"SCORED" => $rows[0]->runs_scored, "ALLOWED"=> $rows[0]->runs_allowed);
		} else {
			$runs = array("ID"=> 0,"SCORED" => 0, "ALLOWED"=> 0);
		}
		return $runs;
	}


	private function getRunsAllowed($id) {
		$database = &mFactory::getDBO();
		$query = 'select id, sum(runs_score) runs_scored, sum(runs_allowed) runs_allowed from ( '
		. 	'SELECT hometeam_id id,sum( hometeam_score ) runs_score, sum( awayteam_score ) runs_allowed '
		.	' FROM #__jleague_scores WHERE hometeam_id = ' . $id
		.	' and conference_game = "Y" and gamestatus = "C" and season = ' . $this->season . ' group by hometeam_id '
		.	' UNION '
		. 	' SELECT awayteam_id id,sum( awayteam_score ) runs_scored, sum( hometeam_score ) runs_allowed '
		.	' FROM #__jleague_scores WHERE awayteam_id = ' . $id
		.	' and conference_game = "Y" and gamestatus = "C" and season = ' . $this->season . ' group by awayteam_id '
		.	' ) as summary group by id';
		$database->setQuery($query);
		$rows = $database->loadObjectList();
		if (sizeof($rows)>0) {
			$runs = array("ID"=> $rows[0]->id,"SCORED" => $rows[0]->runs_scored, "ALLOWED"=> $rows[0]->runs_allowed);
		} else {
			$runs = array("ID"=> 0,"SCORED" => 0, "ALLOWED"=> 0);
		}
		return $runs["ALLOWED"];
	}	
	
	
}
?>

