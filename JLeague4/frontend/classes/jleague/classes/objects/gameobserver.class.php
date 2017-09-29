<?php

/**
 * @version		$Id: gameobserver.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * The JLObserverIF is an interface class for any Observer object.
 */

class JLGameObserver extends JLBaseObserver  {
	
	public function __construct() {
		
	}
	
	/**
	 * This function is executed AFTER someone has posted a game score.  It first validates that the object
	 * passed as the $args variable is an instance of JLGame.
	 * 
	 * NOTE:  Currently the signature of the function enforces this and this could be a problem due to 
	 * wrong code and could trigger a FATAL error at run-time. 
	 *
	 * @param JLGame $args
	 */
	static public function afterPostScore(JLGame $args) {
		if (!$args instanceof JLGame  ) {
			return;
		}
		if (!$args->isComplete()) {
			return;
		}
		if ($args->isLeagueGame()) {
			require_once(JLEAGUE_SERVICES_PATH .DS . 'teamservice.class.php');
			$teamsvc = & JLTeamService::getInstance();			
			$hometeam = $teamsvc->getRow($args->getHometeamId());
			$awayteam = $teamsvc->getRow($args->getAwayteamId());
			
			$homeemails = $teamsvc->getTeamEmailAddresses($hometeam->getId());
			$awayemails = $teamsvc->getTeamEmailAddresses($awayteam->getId());
			$emails = array_merge($homeemails, $awayemails);	

			$config = &JLConfig::getInstance();
			
			$fromemail = $config->getPropertyValue('email_from_addr');
			$fromname = $config->getPropertyValue('email_from_name');
			$emailtmpl = new JLTemplate("gamescorenotification");
			$emailtmpl->setObject('game',$args);
			$emailmsg = $emailtmpl->getContent();

			JLUtil::sendMail($fromemail,$fromname,$emails, "SWIBL - Game Score Posted", $emailmsg, true,null,"chris@swibl-baseball.org");
			
			if ($config->getPropertyValue('twitter_enabled')) {
				$game = $args;
				require_once(JLEAGUE_LIBRARIES_PATH . DS . 'oauth'. DS . 'oauth.php');
				require_once(JLEAGUE_LIBRARIES_PATH . DS . 'twitter'. DS . 'twitterservice.php');
				require_once(JLEAGUE_SERVICES_PATH . DS . 'divisionservice.class.php');
				
				$ao = new fsOAuth($config->getPropertyValue('twitter_consumer_key'), $config->getPropertyValue('twitter_consumer_secret'));
				$ao->setAccessKey($config->getPropertyValue('twitter_access_token'));
				$ao->setAccessSecret($config->getPropertyValue('twitter_access_token_secret'));
				$svc = & fsTwitterService::getInstance($ao);
				$twitter = $svc->getTwitterHandle();
				
				$dsvc = &JLDivisionService::getInstance();
				$division = $dsvc->getRow($game->getDivisionId());
				
				if ($game->getHometeamScore() > $game->getAwayteamScore()) {
					$msg = $game->getHometeam() . " def. " . $game->getAwayteam() . " Score: " . $game->getHometeamScore() . " - " . $game->getAwayteamScore();
				} else if ($game->getHometeamScore() < $game->getAwayteamScore()) {
					$msg = $game->getAwayteam() . " def. " . $game->getHometeam() . " Score: " . $game->getAwayteamScore() . " - " . $game->getHometeamScore();
				} else {
					$msg = $game->getHometeam() . " TIED " . $game->getAwayteam();
				}
				
				date_default_timezone_set("UTC");
				$d = getdate();
				$hashtag = "#SWIBL" . $d["year"] ."_" . str_replace(' ', '', $division->getName());
				$hashtag = str_replace('-','_',$hashtag);
				
				$msg = $msg . " " . $hashtag;
								
				//$msg = "SCORE: " . $game->getHometeam() . " " . $game->getHometeamScore() . " - " . 
					//	$game->getAwayteam() . " " . $game->getAwayteamScore();
				try {
					$status = $twitter->send($msg);
				} catch (Exception $e) {
					echo "TWITTER WARNING: " . $e->getMessage();
				}
			}
			
		}
	}
	
	static public function onSaveGame(JLGame $args) {
		//echo "onSaveGame executed";
		return null;
	}
	
}

?>
