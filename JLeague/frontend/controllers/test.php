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

	
	/**
	 * Test Controller.  This is just a controller to test certain functions
	 */
	class mTest  extends fsController {
	
		function __construct() {
			parent::__construct();
		}
		
		function userLoginRedirect() {
			$app = &mFactory::getApp();
			$config = $app->getConfig();
			$itemid = 104;
			
			$req = &fsRequest::getInstance();
			$id = $req->getValue("userid");
			
			if ($id == null) {
				echo "no userid was profided";
				return;
			}
			$app->writeDebug("ID = " . $id, true);
			$svc = &JLUserService::getInstance();
			try {
				$teams = $svc->getUserTeams($id);
				if (count($teams)>0) {
					$team = $teams[0];			
					$app->redirect(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $team->getSlug()));
				} else {
					$app->redirect(mRouter::translateUrl("index.php?option=com_jleague&controller=standings&task=viewStandings&Itemid=" . $itemid ));
				
				}
			} catch (Exception $e) {
				$app->redirect(mRouter::translateUrl("index.php?option=com_jleague&controller=standings&task=viewStandings&Itemid=" . $itemid ));
			}	
		}
		

	
	}