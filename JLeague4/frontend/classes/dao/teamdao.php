<?php
/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Framework
 * @subpackage	Core
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL
 */


// require_once(JLEAGUE_CLASSES_PATH . DS. 'dao' . DS. 'basedao.class.php');
// require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'division.class.php');

class JLTeamDAO extends fsBaseDAO {
	
	var $tablename = '#__jleague_teams';
	/*
	 var $selectquery = "select * from (SELECT t.*, dm.season, dm.division_id, dm.divorder,dm.registered
			from #__jleague_teams t
			LEFT JOIN
			(
			SELECT dm1.team_id, dm1.season, dm1.division_id, dm1.published as registered, divt.sort_order as divorder
			FROM `#__jleague_divmap` dm1, (
				SELECT id, team_id,max(season) as maxseason FROM `#__jleague_divmap` 
				group by team_id
			) as dm2, `#__jleague_division` as divt
			where dm1.team_id = dm2.team_id and dm1.season = dm2.maxseason and dm1.published = 1 and dm1.division_id = divt.id
			order by team_id
			) as dm
			on t.id = dm.team_id) as tmptbl1 ";
	 */
	/* 08/20/21 - added where publihed = 1 in the subselect */
	var $selectquery = "select * from (SELECT t.*, dm.season, dm.division_id,dm.registered
			from #__jleague_teams t
			LEFT JOIN
			(
			SELECT dm1.team_id, dm1.season, dm1.division_id, dm1.published as registered
			FROM `#__jleague_divmap` dm1, (
				SELECT id, team_id,max(season) as maxseason FROM `#__jleague_divmap` where published = 1
				group by team_id
			) as dm2
			where dm1.team_id = dm2.team_id and dm1.season = dm2.maxseason and dm1.published = 1 
			order by team_id
			) as dm
			on t.id = dm.team_id) as tmptbl1 ";
		
	
	/**
	 * This function will find a specific team.
	 *
	 * @param int $id
	 * @return JLTeam
	 */
	function findById($id) {
		$iid = (int) $id;
		$query = $this->selectquery . " where id = " . $iid;
		return parent::_getRow($query);
	}
	
	protected function __construct() {
		//parent::__construct();
	}
	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLTeamDAO();
		}
		$db = mFactory::getDBO();
		$instance->setDatabase($db);
		return $instance;
	}	
		
	/**
	 * 
	 * This function will insert a row into the TEAM table.
	 *
	 * @param JLDivision
	 * @return boolean
	 */
   	function insert(JLTeam $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, name, shortname, website_url, city, state, logo, coachname, coachemail, coachphone, ownerid, '
			. 'homefield, field_directions, field_latitude, field_longitude, field_address, hits,properties) '
			. ' VALUES (0,'
			. '"' . $obj->getName() . '",'
			. '"' . $obj->getShortName() . '",'  
			. '"' . $obj->getWebsite() . '",'
			. '"' . $obj->getCity(). '",'
			. '"' . $obj->getState() . '",'
			. '"' . $obj->getLogo() . '",'
			. '"' . $obj->getCoachName(). '",'
			. '"' . $obj->getCoachEmail(). '",'
			. '"' . $obj->getCoachPhone(). '",'												
			. '"' . $obj->getOwnerId(). '",'
			. '"' . $obj->getHomeField(). '",'
			. '"' . $obj->getFieldDirections(). '",'	
			. '"' . $obj->getFieldLatitude(). '",'	
			. '"' . $obj->getFieldLongitude(). '",'
			. '"' . $obj->getFieldAddress(). '",'
			. '0,'																	
			. '"' . $obj->getFormattedProperties() . '"'									
			.  ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to UPDATE a row from the TEAM table.
     *
     * @param JLTeam $league
     * @return boolean
     */
    function update(JLTeam $obj) {
    	//$user = JLApplication::getUser();
    	$app = &mFactory::getApp();
    	$user = $app->getUser();
		$query = 'update ' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' name = "' . $obj->getName(). '", '
			. ' shortname = "' . $obj->getShortName(). '", '
			. ' website_url = "' . $obj->getWebsite(). '", '
			. ' city = "' . $obj->getCity(). '", '
			. ' state = "' . $obj->getState(). '", '	
			. ' logo = "' . $obj->getLogo(). '", '		
			. ' coachname = "' . $obj->getCoachName() .'", '
			. ' coachemail = "' . $obj->getCoachEmail() .'", '
			. ' coachphone = "' . $obj->getCoachPhone() .'", '
			. ' homefield = "' . $obj->getHomeField() .'", '
			. ' field_directions = "' . $obj->getFieldDirections() .'", '
			. ' field_latitude = "' . $obj->getFieldLatitude() .'", '
			. ' field_longitude = "' . $obj->getFieldLongitude() .'", '
			. ' field_address = "' . $obj->getFieldAddress() .'", '
			. ' ownerid = "' . $obj->getOwnerId() .'", '
			. ' dateupdated = NOW(), '
			. ' updatedby = "' . $user->username . '", '																																							
			. ' properties = "' . $obj->getFormattedProperties(). '" '
			. ' where id = ' . $obj->getId();
		$baseupdate = $this->_updateRow($query);
		$fieldupdate = $this->updateFields($obj);
		$rc = true;
		if (!$baseupdate && !$fieldupdate) {
			$rc = false;
		}
		return $rc;
    }

    /**
     * This function will increment a teams HIT counter.
     *
     * @param JLTeam $team
     * @return boolean
     */
    function hit(JLTeam $team) {
    	$query = "update #__jleague_teams set hits=hits+1 where id = " . $team->getId();
    	return $this->_updateRow($query);
    }
    
    /**
     * This function will update the custom TEAM fields.
     *
     * @param JLTeam $team
     * @return boolean
     */
    function updateFields(JLTeam $team) {
//     	require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
    	$ssvc = & JLSecurityService::getInstance();
    	$db = &mFactory::getDBO();

    	$status = true;
    	$fields = $team->getCustomFields();
   		if (!empty($fields))	{    	
			foreach($fields as $fld){
				if ($fld->isEditable() || $ssvc->isAdmin()) {
					// Check if field value exists before inserting or updating
					$strSQL	= "SELECT COUNT(*) FROM #__jleague_fields_values"
							. " WHERE fieldid=" . $db->Quote($fld->getId()) . " AND teamid=" . $db->Quote($team->getId());
					$db->setQuery( $strSQL );
					$isNew	= ($db->loadResult() <= 0) ? true : false;
		
					$query = 'INSERT INTO ' .$this->getNameQuote( '#__jleague_fields_values'  ) . ' (teamid,fieldid,value) values ( '
						. $team->getId() . ', ' .  $fld->getId() . ', ' . $db->Quote($fld->getValue()) . ' )';
					
					if(!$isNew){
						$query = 'update ' .$this->getNameQuote( '#__jleague_fields_values'  ) . '  set '
							. ' value = "' . $fld->getValue() . '"'
							. ' where teamid = ' . $team->getId() . ' and '
							. ' fieldid = ' . $fld->getId()
							;
					}
					$db->setQuery( $query );
					if (!$db->query()) {
						if ($status) {
							$status = false;
						}
					}
				} 
			}
   		}
		return $status;    	
    }
        
    /**
     * This function will return an array of TEAM objects based on any filter conditions
     *
     * @param int $start
     * @param int $stop
     * @param String $orderby
     * @param String $filter
     * @return array
     */
	function getRecords($start, $stop, $orderby = '', $filter = '') {
		if (strlen($filter)>0) {
//			$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as t, #__jleague_divmap as dm '
//				. $filter . ' and t.id = dm.team_id ' . $orderby . ' LIMIT ' . $start . ',' . $stop;
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . $filter . ' ' . $orderby .' LIMIT ' . $start . ',' . $stop;
			return parent::_getRows($query);						
		} else {
			$query = 'SELECT * from (' . $this->selectquery . ') as tmp ' . ' ' . $orderby .' LIMIT ' . $start . ',' . $stop;			
			return parent::_getRows($query);
		}
 	} 	    
    
	function getTableSize($filter=null) {
		if (strlen($filter)>0) {		
			$query = 'SELECT t.* from ' . $this->getNameQuote($this->tablename) . ' as t, #__jleague_divmap as dm '
				. $filter . ' and t.id = dm.team_id ';
		} else {
			return parent::getTableSize($filter);
		}
    	$db = &mFactory::getDBO();
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return sizeof($rows); 
  } 	

  	/**
  	 * this funtion will return an integer representing the number of years a team has been 
  	 * in the league.
  	 *
  	 * @param int $teamid
  	 * @return int
  	 */
    function getYearsInLeague($teamid) {
    	$iid = (int) $teamid;
    	$query = 'SELECT team_id FROM #__jleague_divmap WHERE team_id = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    }   
	
    /**
     * This function will return an array of teams within a given division.  Since a division
     * is tied to a season, there is no need to pass the season id.  
     *
     * @param int $divisionid
     * @return array
     */
    function getTeamsInDivision($divisionid) {
    	return $this->getRecords(0,99999999999,' order by name ',' where registered = 1 and division_id = ' . $divisionid);
    }

    /**
     * This function will return an array of teams within a group of divisions.  The argument to the
     * function is an array of JLDivision objects.  The function will sort the data based on team name
     *
     * @param array $divisions
     * @return array
     */
    function getTeamsInDivisions(array $divisions) {
    	$divids = array();
    	foreach ($divisions as $division) {
    		$divids[] = $division->getId();
    	}
    	$str_divids = implode(",",$divids);
    	return $this->getRecords(0,99999999999,' order by name ',' where registered = 1 and division_id in (' . $str_divids . ')'); 
    }
    
    function getTeamsOutsideDivisionInAgeGroup(JLDivision $div) {
/*    	SELECT t.name
FROM #__jleague_teams t, #__jleague_divmap dm, #__jleague_division as d
WHERE dm.team_id = t.id
AND dm.season =8
AND d.agegroup = 9
and d.id = dm.division_id
AND dm.division_id NOT
IN ( 31 )
order by t.name
LIMIT 0 , 30
*/
    	$season = $div->getSeasonId();
    	$age = $div->getAgeGroup();
    	$divids = array();
    	foreach ($divisions as $division) {
    		$divids[] = $division->getId();
    	}
    	$str_divids = implode(",",$divids);
    	return $this->getRecords(0,99999999999,' order by name ',' where registered = 1 and division_id not in (' . $str_divids . ')'); 
    }
    
    
    /**
     * this function returns a record object for a team and a specific season
     *
     * @param int $teamid
     * @param int $season
     * @param boolean $conferenceonly
     * @return JLRecordHistoryItem
     */
    function getRecordForSeason($teamid, $season, $conferenceonly = true) {
//         require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'recordhistoryitem.class.php');
    	if ($conferenceonly) {
    		$confflag = "Y";
    	} else {
    		$confflag = '%';
    	}    	
    	$query = "
			select id, season, season_title, division_id, division_name, teamname, wins, losses, ties, ( wins *  2 ) + (losses *  0 ) + (ties *  1 ) points, runs_scored, runs_allowed  from ( 
				select id, season, season_title, division_id, division_name, teamname, sum(runs_scored) runs_scored, sum(runs_allowed) runs_allowed, sum(wins) wins,sum(losses) losses, sum(ties) ties, sum(points) points from
				( 
				select team.id, seasons.id season, seasons.title season_title, divmap.division_id, divtbl.name division_name, team.name teamname, 0 wins, 0 losses, 0 ties, 0 points, 0 runs_scored, 0 runs_allowed, 'nogame' game 
				from #__jleague_divmap divmap, #__jleague_teams team, #__jleague_seasons seasons, #__jleague_division divtbl where divmap.team_id = team.id 
				and divmap.season = seasons.id and divmap.division_id = divtbl.id and seasons.id = " . $season . " and team.id = " . $teamid . "
					group by team.name, season, divmap.division_id 
				UNION				
				select  hometeam_id id, score.season, seastbl.title season_title, divmap.division_id, divtbl.name division_name, team.name teamname,  sum(if(hometeam_score > awayteam_score,1,0)) wins, sum(if(hometeam_score < awayteam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(hometeam_points) points, sum(hometeam_score) runs_scored, sum(awayteam_score) runs_allowed, 'homegame' game 
				from #__jleague_scores score, #__jleague_teams team, #__jleague_seasons seastbl, #__jleague_divmap divmap, #__jleague_division divtbl  
				where hometeam_id = team.id and score.season = seastbl.id and team.id = divmap.team_id 
						and score.season = divmap.season and divmap.division_id = divtbl.id 
						and conference_game like '" . $confflag . "' and score.gamestatus = 'C' and score.season = '" . $season . "' and hometeam_id = " . $teamid . "
					group by team.name, season, divmap.division_id 
				UNION 
				select  awayteam_id id, score.season, seastbl.title season_title,divmap.division_id,divtbl.name division_name, team.name teamname, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(awayteam_points) points, sum(awayteam_score) runs_scored, sum(hometeam_score) runs_allowed, 'awaygame' game 
				from #__jleague_scores score, #__jleague_teams team, #__jleague_seasons seastbl, #__jleague_divmap divmap, #__jleague_division divtbl  
				where awayteam_id = team.id and score.season = seastbl.id and team.id = divmap.team_id 
						and score.season = divmap.season and divmap.division_id = divtbl.id 
						and conference_game like '" . $confflag . "' and score.gamestatus = 'C' and score.season = '" . $season ."' and awayteam_id = " . $teamid . "
						group by team.name, season, divmap.division_id
				) as recordtbl
				group by teamname, season, division_id
				) as stdgs 
				where id = " . $teamid . " 
				order by season desc  	
		";    	
    	
    	
   		$result = self::_execute($query);
    	
   		if (sizeof($result) > 0) {
	    	$row = $result[0];
	    	$record = new JLRecordHistoryItem();
			$record->setTeamId($teamid);				
			$record->setTeamName($row->teamname);
			$record->setDivisionId($row->division_id);
			$record->setDivisionName($row->division_name);
			$record->setSeasonId($row->season);
			$record->setSeason($row->season_title);
			$record->setWins($row->wins);
			$record->setLosses($row->losses);
			$record->setTies($row->ties);
			$record->setRunsScored($row->runs_scored);
			$record->setRunsAllowed($row->runs_allowed);
			return $record; 
   		} else {
   			throw new Exception ("Record Unavailable");
   		}
    }
    
    /**
     * This function will return an array of record history objects based on the teamid supplied by
     * the client.  It can be filtered to include only conference games or all games played by the
     * team.
     *
     * @param int $teamid
     * @param boolean $conferenceonly
     * @return array
     */
    function getRecordHistory($teamid,$conferenceonly=false) {
//     	require_once(JLEAGUE_CLASSES_PATH . DS. 'objects' . DS. 'recordhistoryitem.class.php');
    	if ($conferenceonly) {
    		$confflag = "Y";
    	} else {
    		$confflag = '%';
    	}
		
    	$query = "
			select id, season, season_title, division_id, division_name, teamname, runs_scored, runs_allowed, wins, losses, ties, ( wins *  2 ) + (losses *  0 ) + (ties *  1 ) points from ( 
				select id, season, season_title, division_id, division_name, teamname, sum(runs_scored) runs_scored, sum(runs_allowed) runs_allowed, sum(wins) wins,sum(losses) losses, sum(ties) ties, sum(points) points from
				( 
				select  hometeam_id id, score.season, seastbl.title season_title, divmap.division_id, divtbl.name division_name, team.name teamname,  sum(hometeam_score) runs_scored, sum(awayteam_score) runs_allowed, sum(if(hometeam_score > awayteam_score,1,0)) wins, sum(if(hometeam_score < awayteam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(hometeam_points) points, 'homegame' game 
				from #__jleague_scores score, #__jleague_teams team, #__jleague_seasons seastbl, #__jleague_divmap divmap, #__jleague_division divtbl  
				where hometeam_id = team.id and score.season = seastbl.id and team.id = divmap.team_id 
						and score.season = divmap.season and divmap.division_id = divtbl.id 
						and conference_game like '" . $confflag . "' and score.gamestatus = 'C'
					group by team.name, season, divmap.division_id 
				UNION 
				select  awayteam_id id, score.season, seastbl.title season_title,divmap.division_id,divtbl.name division_name, team.name teamname, sum(awayteam_score) runs_scored, sum(hometeam_score) runs_allowed, sum(if(awayteam_score > hometeam_score,1,0)) wins, sum(if(awayteam_score < hometeam_score,1,0)) losses, sum(if(hometeam_score = awayteam_score,1,0)) ties, sum(awayteam_points) points, 'awaygame' game 
				from #__jleague_scores score, #__jleague_teams team, #__jleague_seasons seastbl, #__jleague_divmap divmap, #__jleague_division divtbl  
				where awayteam_id = team.id and score.season = seastbl.id and team.id = divmap.team_id 
						and score.season = divmap.season and divmap.division_id = divtbl.id 
						and conference_game like '" . $confflag . "' and score.gamestatus = 'C'
						group by team.name, season, divmap.division_id
				) as recordtbl
				group by teamname, season, division_id
				) as stdgs 
				where id = " . $teamid . " 
				order by season desc
		";    	
    	
    	$query = "select * from #__jleague_recordhistory where team_id = " . $teamid . " order by season desc";
    	$result = self::_execute($query);
    	
    	$dataArray = array();
    	foreach ($result as $k => $row) {
				$record = new JLRecordHistoryItem();
				$record->setTeamId($teamid);				
				$record->setTeamName($row->teamname);
				$record->setDivisionId($row->division_id);
				$record->setDivisionName($row->division_name);
				$record->setSeasonId($row->season);
				$record->setSeason($row->season_title);
				$record->setWins($row->wins);
				$record->setLosses($row->losses);
				$record->setTies($row->ties);
				$record->setRunsScored($row->runs_scored);
				$record->setRunsAllowed($row->runs_allowed);
		 		$dataArray[]=$record;
        }
        return $dataArray;
    }
    
	/**
	 * This function will return an array of objects for ALL rows within the underlying
	 * table.
	 *
	 * @return array
	 */
  	function getRows() {
		return self::_getRows($this->selectquery);
	}	
  
	/**
	 * This function retrieves the defined custom fields associated with a team profile
	 *
	 * @param unknown_type $id
	 */
	private function getCustomFields($id) {
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'field.class.php');
		$db	= $this->database;
		
		$ssvc = &JLSecurityService::getInstance();
		$isAdmin = $ssvc->isAdmin();
		
		$query = "select * from #__jleague_fields as q1 "
		 	. " left join (select fieldid,teamid,value from #__jleague_fields_values "
		 	. " where teamid = " . $id . " ) as q2 on (q1.id = q2.fieldid) where q1.published = 1";
		
		$db->setQuery($query);		 	
		$result	= $db->loadObjectList();
	
		$fields = array();
		foreach ($result as $field) {
		   	$fld = new fsField();
		   	$fld->setId($field->id);
		   	$fld->setKeycode($field->keycode);
		   	$fld->setName($field->name);
		   	$fld->setType($field->type);
		   	$fld->setValue($field->value);
		   	$fld->setEditable($field->editable);
		   	if ($isAdmin) {
		   		$fld->setEditable(true);
		   	}
		   	$fld->parseDatabaseObjectProperties($field->properties);
		   	
// 			if (strlen($field->properties)>0) {
// 			   $proparray = split("\n",$field->properties);
// 			   foreach ($proparray as $prop) {
// 			   		$property = split("=",$prop);
// 			   		$fld->addProperty($property[0],$property[1]);
// 			   }
// 			}
		   	$fields[$field->keycode] = $fld; 
		}
		return $fields;
	
	}
	
	/**
	 * This function will return an array of TEAMS within a given season.
	 *
	 * @param int $season
	 * @param string $orderby
	 * @param boolean $registeredonly
	 * @return array
	 */
	function getTeamsInSeason($season, $orderby=0,$registeredonly = true) {
		/*
		 *  NEW QUERY 
		 * select * from (SELECT t.*, dm.season, dm.division_id, dm.registered, dm.agegroup
			from #__jleague_teams t, 
			(
			SELECT dm1.team_id, dm1.season, dm1.division_id,d.agegroup, dm1.published as registered
			FROM `#__jleague_divmap` dm1, 
			#__jleague_division d,

			(
				SELECT id, team_id,max(season) as maxseason FROM `#__jleague_divmap` where season = 8
				group by team_id
			) as dm2
			where dm1.team_id = dm2.team_id and dm1.season = dm2.maxseason and dm1.division_id = d.id and dm1.published = 1  
			order by team_id
			) as dm
			where t.id = dm.team_id) as tmptbl1 

		 */
		/*
		 * OLD QUERY
		 * 		$selectquery = "select * from (SELECT t.*, dm.season, dm.division_id, dm.registered
			from #__jleague_teams t
			LEFT JOIN
			(
			SELECT dm1.team_id, dm1.season, dm1.division_id, d.agegroup, dm1.published as registered
			FROM `#__jleague_divmap` dm1,
				`#__jleague_division` d, 
			(
				SELECT id, team_id,max(season) as maxseason FROM `#__jleague_divmap` where season = " . $season . "
				group by team_id
			) as dm2
			where dm1.team_id = dm2.team_id and dm1.season = dm2.maxseason and dm1.division_id = d.id and dm1.published = 1  
			order by team_id
			) as dm
			on t.id = dm.team_id) as tmptbl1 ";
		 * 
		 */
		$selectquery = "select * from (SELECT t.*, dm.season, dm.division_id, dm.agegroup, dm.registered
			from #__jleague_teams t
			LEFT JOIN
			(
			SELECT dm1.team_id, dm1.season, dm1.division_id, d.agegroup, dm1.published as registered
			FROM `#__jleague_divmap` dm1,
				`#__jleague_division` d, 
			(
				SELECT id, team_id,max(season) as maxseason FROM `#__jleague_divmap` where season = " . $season . "
				group by team_id
			) as dm2
			where dm1.team_id = dm2.team_id and dm1.season = dm2.maxseason and dm1.division_id = d.id and dm1.published = 1  
			order by team_id
			) as dm
			on t.id = dm.team_id) as tmptbl1 ";
		$iid = (int) $season;
		$orderbyclause = "";
		if ($registeredonly) {
			//$rfilter = " and registered = 1 ";
			$rfilter = " and published = 1";
		}
		switch ($orderby) {
			case "0":
				break;
			case "1":
				$orderbyclause = " order by name, agegroup ";
				//$orderbyclause = " order by name, divorder ";
				break;
			case "2":
				$orderbyclause = " order by division_id, name ";
				break;
			default:
				$orderbyclause = " order by name ";
		}
		$query = $selectquery . " where id in ( select team_id from #__jleague_divmap where season = " . $iid . " " . $rfilter . ")" . $orderbyclause;
		return parent::_getRows($query);
		
	}
	
	/**
	 * This will map the the database row to the Team Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'team.class.php');
// 		require_once(JLEAGUE_CLASSES_PATH . DS .'helpers'. DS . 'factory.php');

		$obj = new JLTeam();
		$obj->setId($row->id);
		$obj->setName($row->name);
		$obj->setShortName($row->shortname);
		$obj->setWebsite($row->website_url);
		$obj->setCity($row->city);
		$obj->setState($row->state);
		$obj->setLogo($row->logo);
		$obj->setCoachName($row->coachname);
		$obj->setCoachEmail($row->coachemail);
		$obj->setCoachPhone($row->coachphone);
		$obj->setHits($row->hits);
		$oid = (int) $row->ownerid;
		$obj->setOwnerId($oid);
		$obj->setCommunityItem($row->communityitem);
		$obj->setHomeField($row->homefield);
		$obj->setFieldDirections($row->field_directions);
		$obj->setFieldLatitude($row->field_latitude);
		$obj->setFieldLongitude($row->field_longitude);
		$obj->setFieldAddress($row->field_address);

		$ddao = &JLDivisionDao::getInstance();
		$sdao = &JLSeasonDao::getInstance();

		if (isset($row->season)) {
			if ($row->season > 0) {
				$season = $sdao->findById($row->season);
				$obj->setSeason($season);
				$obj->setLastSeason($season->getYear());
			}
		}
		if (isset($row->division_id)) {
			if ($row->division_id > 0) {
				$div = $ddao->findById($row->division_id);
				$obj->setDivision($div);
			} else {
				$div = new JLDivision();
				$div->setId(0);
				$div->setName("Division Unassigned");
				$obj->setDivision($div);
			}
		}  else {
			$div = new JLDivision();
			$div->setId(0);
			$div->setName("Division Unassigned");
			$obj->setDivision($div);
		}
		
		$customfields = $this->getCustomFields($row->id);
		$obj->setCustomFields($customfields);

		$obj->parseDatabaseObjectProperties($row->properties);

		return $obj;
	}

	function getTeamEmailAddresses($teamid) {
		if (!is_numeric($teamid)) {
			throw new  Exception("Team Id is not numeric (TEAMDAO::getTeamContacts)");
		}
		$query = 'SELECT * FROM #__jleague_teamcontacts WHERE teamid = ' . $teamid;
		
		$query = 'select distinct email from ( ' 
			. ' SELECT coachemail as email from #__jleague_teams where id = ' . $teamid 
			. ' UNION '
			. ' select email from #__jleague_teamcontacts where teamid = ' . $teamid 
			. ') as tmp1 '
			. ' where length(email)>0 '
			. ' and LOCATE(\';\', email) <= 0 '
			. ' and LOCATE(\'@\', email) > 0 '
			. ' and LOCATE(\' or \', email) <= 0 '
			. ' group by email ';
    	$rows = $this->_execute($query); 
    	$emails = array();
    	foreach ($rows as $row) {
    		/* Eliminate any field thaat may have multiple @ signs */
    		if (substr_count($row->email, '@')<=1) {
    			$emails[] = $row->email;
    		}
    	}
		return $emails;				
	}
	
	function getTeamContact($id) {
		if (!is_numeric($id)) {
			throw new  Exception("Id is not numeric (TEAMDAO::getTeamContact)");
		}		
    	$query = 'SELECT * FROM #__jleague_teamcontacts WHERE id = ' . $id;
    	$row = $this->_execute($query);
    	if ($row != null) {
 	   		return $this->loadTeamContactObject($row[0]);
    	}
    	return null;
	}
	
	/**
	 * This function will return an array of Contacts fora specific team.
	 *
	 * @param int $teamid
	 * @return array
	 */
	function getTeamContacts($teamid, $filtered=false) {
		if (!is_numeric($teamid)) {
			throw new  Exception("Team Id is not numeric (TEAMDAO::getTeamContacts)");
		}
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamcontact.class.php');
    	$iid = (int) $teamid;
    	$query = 'SELECT * FROM #__jleague_teamcontacts WHERE teamid = ' . $iid;
    	if ($filtered) {
    		$query .= " and role <> 'All-Star Contact'";
    	}
    	
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		$contacts = array();
    		foreach ($rows as $row) {
    			$contact = $this->loadTeamContactObject($row);
    			$contacts[] = $contact;
    		}
    		return $contacts;
    	}
    	return null;
    } 
    
    /**
     * This function will instantiate and populate a JLTeamContact object based on the database row provided
     * as an input.
     *
     * @param array $row
     * @return JLTeamContact
     */
    private function loadTeamContactObject($row) {
//     	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamcontact.class.php');
    	$contact = new JLTeamContact();
    	$contact->setId($row->id);
    	$contact->setTeamId($row->teamid);
    	$contact->setName($row->name);
    	$contact->setEmail($row->email);
    	$contact->setPhone($row->phone);
    	$contact->setUserid($row->userid);
    	$contact->setPrimary($row->primarycontact);
    	$contact->setRole($row->role);   
    	return $contact;
    }
    
    /**
     * This function will remove a contact from a team by its uniquue identifier.  
     *
     * @param int $id
     * @return boolean
     */
    function removeTeamContact($id) {
    	if (!is_numeric($id)) {
			throw new  Exception("Team Id is not numeric (TEAMDAO::removeTeamContact)");
		}    	
		$iid = (int) $id;
		$query	= 'delete from #__jleague_teamcontacts where id = ' . $iid	;
		return self::_deleteRow($query);    	
    }
    
    /**
     * This funciton will associate a contact object to a specific team.
     *
     * @param JLTeamContact $obj
     * @return boolean
     */
    function addTeamContact(JLTeamContact $obj) {
		$query = 'INSERT INTO ' .$this->getNameQuote( '#__jleague_teamcontacts'  ) . ' (id, teamid, name, email, phone, role, primarycontact,userid) '
			. ' VALUES (0,'
			. '"' . $obj->getTeamId() . '",'			
			. '"' . $obj->getName() . '",' 
			. '"' . $obj->getEmail(). '",'
			. '"' . $obj->getPhone() . '",'
			. '"' . $obj->getRole(). '",'
			. '"' . $obj->isPrimary(). '",'
			. '"' . $obj->getUserid(). '"'
			.  ')';
		return $this->_insertRow($query);			
    }
     
    /**
     * This function will return an array of Team Id's in which a specific user is defined as the
     * 'owner'.
     *
     * @param int $id
     * @return array 
     */
    function getTeamIdsForUser($id,$seasonid) {
    	if (!is_numeric($id)) {
			throw new  Exception("Userid Id is not numeric (TEAMDA0::getTeamIdsForUser)");
		}     	
		if (!is_numeric($seasonid)) {
			throw new  Exception("Season Id is not numeric (TEAMDA0::getTeamIdsForUser)");
		}
    	$query = "select * from (SELECT id as teamid FROM `#__jleague_teams` WHERE ownerid = " . $id . 
    		" union select teamid from `#__jleague_teamcontacts` where userid = " . $id .
    		" ) tmp1 where teamid in (select team_id from `#__jleague_divmap` where season = " . $seasonid . ")";
    	$rows = $this->_execute($query);
    	return $rows;
    }
    
    
    

	/**
	 * This function will return an array of Contacts fora specific team.
	 *
	 * @param int $teamid
	 * @return array
	 */
	function getTeamVenues($teamid) {
// 		require_once(JLEAGUE_SERVICES_PATH . DS . 'venueservice.class.php');
		if (!is_numeric($teamid)) {
			throw new  Exception("Team Id is not numeric (TEAMDAO::getTeamContacts)");
		}
// 		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'teamcontact.class.php');
    	$iid = (int) $teamid;
    	$query = 'SELECT * FROM #__jleague_team_venues WHERE teamid = ' . $iid;
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		$venues = array();
    		$vsvc = &JLVenueService::getInstance();
    		foreach ($rows as $row) {
    			if ($row->venueid > 0) {
    				$vobj = $vsvc->getRow($row->venueid);
    				$venues[] = $vobj;
    			} else {
    				return $venues;
    				//throw new Exception("ERROR:  Team Venues entry has a Venue ID of ZERO for team # " . $teamid);
    			}
    		}
    		return $venues;
    	}
    	return null;
    } 
    
    /**
     * This function will remove a VENUE from a team by its uniquue identifier.  
     *
     * @param int $id
     * @return boolean
     */
    function removeTeamVenue($teamid, $venueid) {
    	if (!is_numeric($teamid)) {
			throw new  Exception("Team Id is not numeric [" . $teamid . "](TEAMDAO::removeTeamVenue)");
		}    	
		$tid = (int) $teamid;
    	if (!is_numeric($venueid)) {
			throw new  Exception("Venue Id is not numeric [" . $venueid . "] (TEAMDAO::removeTeamVenue)");
		}    	
		$vid = (int) $venueid;
		
		$query	= 'delete from #__jleague_team_venues where teamid = ' . $tid . ' and venueid = ' . $vid;
		
		return self::_deleteRow($query);    	
    }
    
    /**
     * This funciton will associate a VENUE object to a specific team.
     *
     * @param JLTeamContact $obj
     * @return boolean
     */
    function addTeamVenue($teamid, $venueid) {
		$query = 'INSERT INTO ' .$this->getNameQuote( '#__jleague_team_venues'  ) . ' (id, teamid, venueid) '
			. ' VALUES (0,'
			. '"' . $teamid . '",'			
			. '"' . $venueid. '"'
			.  ')';
		return $this->_insertRow($query);			
    }    

    /**
     * This function will return an array of ID's for a teams opponents within a specified season. 
     *
     * @param int $teamid
     * @param int $season
     * @return int
     */          
    function getOpponentTeamIdsForSeason($teamid, $season) {
    	
    	$query = "
			select distinct team_id from
			(SELECT hometeam_id as team_id
			FROM #__jleague_scores
			WHERE season = " . $season . " and conference_game = 'Y' and awayteam_id = " . $teamid ."
			union 
			SELECT awayteam_id as team_id
			FROM #__jleague_scores
			WHERE season = " . $season . " and conference_game = 'Y' and hometeam_id = " . $teamid . "
			) temp
			order by team_id
			";
    	$rows = $this->_execute($query);
		return $rows;    	
    }

    /**
     * This function will calculate the winning percentage for all opponents of a specified team within a given season. 
     *
     * @param int $teamid
     * @param int $season
     * @return int
     */      
    function getOpponentsWinningPercentage($teamid, $season) {
    	$query = "select avg((s.wins + (s.ties/2)) / (s.losses + s.wins + s.ties)) winpct from 
			(select distinct team_id from
			(SELECT hometeam_id as team_id
			FROM #__jleague_scores
			WHERE season = " . $season . " and conference_game = 'Y' and awayteam_id = " . $teamid ."
			union 
			SELECT awayteam_id as team_id
			FROM #__jleague_scores
			WHERE season = " . $season . " and conference_game = 'Y' and hometeam_id = " . $teamid . "
			) temp
			order by team_id
			) temp2, #__jleague_standings s
			where temp2.team_id = s.team_id
			and s.season = " . $season;
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return $rows[0]->winpct;
    	}
    	return 0;    	
    }
    
    /**
     * This function will calculate the average run differential for the games in which the team WON within a given season.
     *
     * @param int $teamid
     * @param int $season
     * @return int
     */    
    function getAverageWinRunDifferential($teamid, $season) {
    	$query = "select avg(win_diff) windiff from 
			(
			SELECT hometeam_id as teamid,hometeam_score - awayteam_score win_diff, 0 loss_diff FROM `#__jleague_scores`
			where hometeam_id = " . $teamid . "
			and season = " . $season . "
			and (hometeam_score - awayteam_score) > 0
			and conference_game = 'Y'
			and gamestatus = 'C'
			union
			SELECT awayteam_id as teamid, awayteam_score - hometeam_score win_diff, 0 loss_diff FROM `#__jleague_scores`
			where awayteam_id = " . $teamid . "
			and season = " . $season . "
			and (awayteam_score - hometeam_score) > 0
			and conference_game = 'Y'
			and gamestatus = 'C'
			) win1 ";
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return $rows[0]->windiff;
    	}
    	return 0;    	
    }
    
    /**
     * This function will calculate the average run differential for the games in which the team LOSS within a given season.
     *
     * @param int $teamid
     * @param int $season
     * @return int
     */
    function getAverageLossRunDifferential($teamid, $season) {
    	$query = "select avg(win_diff) windiff from 
			(
			SELECT id,hometeam_score - awayteam_score win_diff FROM `#__jleague_scores`
			where hometeam_id = " . $teamid . "
			and season = " . $season . "
			and (hometeam_score - awayteam_score) < 0
			and conference_game = 'Y'
			and gamestatus = 'C'
			union
			SELECT id, awayteam_score - hometeam_score win_diff FROM `#__jleague_scores`
			where awayteam_id = " . $teamid . "
			and season = " . $season . "
			and (awayteam_score - hometeam_score) < 0
			and conference_game = 'Y'
			and gamestatus = 'C'
			) win1 ";
    	$rows = $this->_execute($query);
    	if (is_array($rows)) {
    		return $rows[0]->windiff;
    	}
    	return 0;    	
    }
    
    function getNumberOfLeagueGames($teamid, $seasonid) {
    	$query = "
    	select (home_game_count + away_game_count) as  gamecount, games as required_games from
    	(
    	SELECT count(*) as home_game_count  FROM `#__jleague_scores` WHERE `season` = " . $seasonid . " AND `hometeam_id` = ".$teamid." and conference_game = 'Y' and gamestatus not in ('R','X') 
    	) as tmp1,
    	(
    	SELECT count(*) as away_game_count FROM `#__jleague_scores` WHERE `season` = " . $seasonid . " AND `awayteam_id` = ".$teamid." and conference_game = 'Y'  and gamestatus not in ('R','X') 
    	) as tmp2,
    	(
    	SELECT games from
    	#__jleague_division where id in (select division_id FROM `#__jleague_divmap` WHERE `season` = " . $seasonid . " AND `team_id` = ".$teamid." )
    	) as tmp3";
    	$rows = $this->_execute($query);
    	return $rows[0];
   	   	
    }
    
    /**
     * This function will return an array of teams that do not have rosters online.
     * 
     * @param unknown $seasonid
     * @throws Exception
     * @return unknown
     */
    function getTeamsWithoutRoster($seasonid) {
    	$query = "select t.id, t.name, d.name
    			from #__jleague_teams t, #__jleague_divmap dm, #__jleague_division d
    			where t.id not in
    			(
    				SELECT teamid
			    	FROM #__jleague_simple_roster r
    				WHERE r.season = " . $seasonid . "
    			)
		    	and dm.season = " . $seasonid . " 
		    	and t.id = dm.team_id
		    	and dm.division_id = d.id";
    	try {
    		$rows = $this->_execute($query);
    		return $rows;
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
    
    
    /**
     * This function will return an array of TEAM objects for a given user id and season
     */
    function getUserTeams($userid, $seasonid) {
    	$ids = $this->getTeamIdsForUser($userid, $seasonid);
    	
    	$ids_arr = array();
    	foreach ($ids as $idObj) {
    		$ids_arr[] = $idObj->teamid;
    	}
    	if (count($ids) > 0 ) { 
	    	$ids_str = implode(",",$ids_arr);
	    	$query = $this->selectquery . " where id in ( " . $ids_str . ")";
		   	try {
	     		return parent::_getRows($query);	
	     	} catch (Exception $e) {
	    		throw $e;
	    	}
    	} else {
    		throw new Exception("No Teams Associated with User");
    	}
    }
    
    /**
     * This function will return an array of teams that do not have rosters online.
     *
     * @param unknown $seasonid
     * @throws Exception
     * @return unknown
     */
    function getTeamsWithNoOwner($seasonid) {
    	//SELECT * FROM `jos_jleague_teams` where ownerid = 0 and id in (select team_id from jos_jleague_divmap where season = 9)
    	$query = "select t.*, d.name as 'division_name'
    			from #__jleague_teams t, #__jleague_divmap dm, #__jleague_division d
    			where t.id in
    			(
    				SELECT team_id
			    	FROM #__jleague_divmap r
    				WHERE r.season = " . $seasonid . "
    			)
		    	and dm.season = " . $seasonid . "
		    	and t.id = dm.team_id
		    	and t.ownerid = 0
		    	and dm.division_id = d.id
		    	order by d.sort_order,t.name ";
    	try {
    		$rows = $this->_execute($query);
    		return $rows;
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
    
    /**
     * 
     */
    function getStandingsWithRegistrationData( $seasonid) {
    	$query = "SELECT s.*, d.name as 'division_name', dm.tournament, dm.paid 
FROM `#__jleague_temp_standings` as s , #__jleague_division as d, #__jleague_divmap dm
WHERE s.division_id = d.id
and s.team_id = dm.team_id 	";
    	try {
    		$rows = $this->_execute($query);
    		return $rows;
    	} catch (Exception $e) {
    		throw $e;
    	}
    }
    
}
