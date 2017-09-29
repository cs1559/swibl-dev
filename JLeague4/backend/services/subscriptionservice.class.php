<?php
/**
 * @version		$Id: subscriptionservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'factory.php');
require_once(JLEAGUE_SERVICES_PATH . DS . 'baseservice.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');

class JLSubscriptionService  extends JLBaseService  {

	private $active_season = null;
	
	protected function __construct() {
		parent::__construct();
	}
	
	/**
	 * This function will return an instance of this service object.
	 *
	 * @return JLSeasonService
	 */	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSeasonService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = &JLSubscriptionDAO::getInstance();
		return $dao;
	}

	/**
	 * Returns an array of subscriptions for a given user
	 *
	 * @return array
	 */
	function getUserSubscriptions() {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
		$ssvc = &JLSecurityService::getInstance();
		if (!$ssvc->isRegisteredUser()) {
			throw new Exception("User is not recgonized as being a registered user");
		}
		$user = $ssvc->getUser();
		$dao = &JLSubscriptionsDAO::getInstance();
		try {
			$subcriptions = $dao->getSubscriptionsForUser($user->id);
			return $subscriptions;
		} catch (Exception $e) {
			throw $e;
		}
		return null;
	}

	
	function subscribe($context) {
		
	}
	
	function unsubscribe($context) {
		
	}
	
	function notifySubscribers($context) {
		// extract event context from the arguments
		// locate all subscriptions to the event
		// send notifications
	}

}

?>