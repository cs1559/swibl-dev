<?php
/**
 * @version		$Id: teamobserver.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The JLObserverIF is an interface class for any Observer object.
 */

class JLTeamObserver extends JLBaseObserver  {
	
	public function __construct() {
		
	}
	
	/**
	 * This function/event will generate an email to the "owner" of the team profile 
	 *
	 * @param Object $args
	 */
	static public function onChangeOwner(&$args) {
		$app = &mFactory::getApp();
		$config = $app->getConfig();
		
		$afterTeam = $args["afterTeam"];
		$beforeTeam = $args["beforeTeam"];
	
		if (!$afterTeam instanceof JLTeam ) {
			return;
		}
		
		if ($afterTeam->getOwnerId() > 0) {
		//	require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
			$usvc = &JLUserService::getInstance();
			// New User
			$newowner = $usvc->getUser($afterTeam->getOwnerId());
			
			$fromemail = $config->getPropertyValue('email_from_addr');
			$fromname = $config->getPropertyValue('email_from_name');
			
			$emailtmpl = new fsTemplate("changeowneremail",APP_TEMPLATES_PATH);
			$emailtmpl->setObject('team',$afterTeam);
			$emailtmpl->setObject("username",$newowner->getUsername());
			$emailmsg = $emailtmpl->getContent();

			if ($beforeTeam->getOwnerId() > 0) {
				$originalowner = $usvc->getUser($beforeTeam->getOwnerId());
				$originalowner_email = $originalowner->getEmail();
			} else {
				$originalowner_email = null;
			}
			
		JLUtil::sendMail($fromemail,$fromname,$newowner->getEmail(), "SWIBL - Team Profile Owner Change", $emailmsg, true,$originalowner_email,"chris@swibl-baseball.org");
		}
	}
	
}

?>
