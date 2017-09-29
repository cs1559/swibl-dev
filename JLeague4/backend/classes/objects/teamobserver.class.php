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
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobserver.class.php');

class JLTeamObserver extends JLBaseObserver  {
	
	public function __construct() {
		
	}
	
	/**
	 * This function/event will generate an email to the "owner" of the team profile 
	 *
	 * @param Object $args
	 */
	static public function onChangeOwner(&$args) {
		$afterTeam = $args["afterTeam"];
		$beforeTeam = $args["beforeTeam"];
		
		if (!$afterTeam instanceof JLTeam ) {
			return;
		}
		
		if ($afterTeam->getOwnerId() > 0) {
			require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');
			$user = JLApplication::getUser($afterTeam->getOwnerId());
			$config = JLApplication::getConfig();
			$fromemail = $config->getPropertyValue('email_from_addr');
			$fromname = $config->getPropertyValue('email_from_name');
			$emailtmpl = new JLTemplate("changeowneremail");
			$emailtmpl->setObject('team',$afterTeam);
			$emailtmpl->setObject("username",$user->username);
			$emailmsg = $emailtmpl->getContent();

			if ($beforeTeam->getOwnerId() > 0) {
				$originalowner = JLApplication::getUser($beforeTeam->getOwnerId());
				$originalowner_email = $originalowner->email;
			} else {
				$originalowner_email = null;
			}

			JLUtil::sendMail($fromemail,$fromname,$user->email, "SWIBL - Team Profile Owner Change", $emailmsg, true,$originalowner_email,"chris@swibl-baseball.org");
		}
	}
	
}

?>
