<?php
/**
 * @version		$Id: players.php 102 2010-03-28 11:45:02Z Chris Strieter $
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

class JLeagueControllerSponsors  extends JLeagueController {

	function __construct() {
		parent::__construct();
	}

	/**
	 * This function will display the registration form and enable the user to enter the appropriate
	 * data to submit their registration.
	 *
	 */
	public function click() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'sponsorservice.class.php');

		if (isset($_REQUEST["cid"])) {
			$campaignid = $_REQUEST["cid"];
			$ssvc = & JLSponsorService::getInstance();
			$url = $ssvc->clickThru($campaignid);
			JLApplication::redirect($url);
		} else {
			echo "ERROR:  Invalid Campaign ID";
			return;
		}
		
	}	
	
}