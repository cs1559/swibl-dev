<?php
/**
 * @version		$Id: userservice.class.php 410 2012-02-12 16:21:58Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');

class JLUserService  extends JLBaseService  {

	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function will return an instance of this service object.
	 *
	 * @return JLVenueService
	 */	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLUserService();
		}
		return $instance;
	}		
	public function getDao() {
		return null;	
	}
	public function getInterestedAgeGroups($seasonid) {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
		$array = array();
		$user = JLApplication::getUser();
		if ($user->id == 0) {
			return $array;
		}
	 	$db			=& JLApplication::getDatabase();
	 	
	 	$ssvc = & JLSecurityService::getInstance();
	 	if ($ssvc->isAdmin()) {
		 	$query = " SELECT distinct d1.agegroup "
		 		. " FROM jos_jleague_teamcontacts c, jos_jleague_teams t, jos_jleague_divmap d, jos_jleague_division d1 "
		 		. " WHERE c.teamid = t.id and t.id = d.team_id and d1.id = d.division_id and d.season = " . $seasonid;
			$db->setQuery($query);
			$rows = $db->loadObjectList();
	 	} else {
		 	$query = "SELECT distinct d1.agegroup FROM ( SELECT t1.id, t1.name, t1.ownerid, t2.userid FROM `jos_jleague_teams` AS t1 
					LEFT JOIN jos_jleague_teamcontacts AS t2 ON ( t1.id = t2.teamid )
					) AS x1, jos_jleague_divmap d, jos_jleague_division d1
					WHERE x1.id = d.team_id
					AND d1.id = d.division_id
					AND d.season =" . $seasonid . "
					and (x1.userid = ". $user->id . " or x1.ownerid = " .$user->id . ")";
//					echo $query;
//					exit;
			$db->setQuery($query);
			$rows = $db->loadObjectList();
//		 	$query = " SELECT distinct d1.agegroup "
//		 		. " FROM jos_jleague_teamcontacts c, jos_jleague_teams t, jos_jleague_divmap d, jos_jleague_division d1 "
//		 		. " WHERE c.teamid = t.id and t.id = d.team_id and d1.id = d.division_id and d.season = " . $seasonid . " and c.userid = " . $user->id ;
//			$db->setQuery($query);
//			$rows2 = $db->loadObjectList();
//			$rows = array_merge(rows1, rows2);
			
//		 	$query = " SELECT distinct d1.agegroup "
//		 		. " FROM jos_jleague_teamcontacts c, jos_jleague_teams t, jos_jleague_divmap d, jos_jleague_division d1 "
//		 		. " WHERE c.teamid = t.id and t.id = d.team_id and d1.id = d.division_id and d.season = " . $seasonid . " and (c.userid = " . $user->id . " or t.ownerid = " . $user->id . " )";
//		 	$query = " SELECT d.team_id, d.season, c.*, t.ownerid, d1.agegroup "
//		 		. " FROM jos_jleague_teamcontacts c, jos_jleague_teams t, jos_jleague_divmap d, jos_jleague_division d1 "
//		 		. " WHERE c.teamid = t.id and t.id = d.team_id and d1.id = d.division_id and d.season = " . $seasonid . " and (c.userid = " . $user->id . " or t.ownerid = " . $user->id . " )";
		 		
	 	}
		if (sizeof($rows)>0) {
			foreach ($rows as $row) {
				$array[] = $row->agegroup;
			}
		}
		return $array;
	}
}

?>
