<?php
/**
 * @version		$Id: divisionservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Libraries
 * @subpackage	twitter
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL
 */


include_once(FST_LIBRARY_PATH .'/oauth/oauth.php');
include_once('twitter.php');


class fsTwitterService    {
	
	var $_auth = null;
	
	protected function __construct($auth) {
		//parent::__construct();
		$this->_auth = $auth;
		/*
		 * $consumerKey =  "tUGoQ3w0r2CYulWRvhbNQ";
$consumerSecret = "KktRT96O1wv7IP0eWYR0ID7WdrnGCLb4c4tyO5wSHk";
$accessToken="1103585197-zdo4MYa1mEPnLTuehgTlfQbkaSuKfULDFrd0iIn";
$accessTokenSecret="QsuHPkYWyOHR6d5VWTJq5GWXoKLRdDlWXzkEBNmDFo";
		 */
	}
	
	function getInstance(fsOAuth $auth) {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new fsTwitterService($auth);
		}
		return $instance;
	}

	function getTwitterHandle() {
		$consumerKey = $this->_auth->getConsumerKey();
		$consumerSecret = $this->_auth->getConsumerSecret();
		$accessToken = $this->_auth->getAccessKey();
		$accessTokenSecret = $this->_auth->getAccessSecret();
		$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
		return $twitter;
	}
	
}

?>