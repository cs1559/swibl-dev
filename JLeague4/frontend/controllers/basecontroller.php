<?php
require_once(FST_LIB_CORE . 'controller.php');

class mBaseController  extends fsController {

	var $app = null;
	var $user = null;
	var $config = null;
	var $admin = false;
	
	function __construct() {
		parent::__construct();
		$app = &mFactory::getApp();
		$this->config = $app->getConfig();
	}
	
	function getApp() {
		$app = &mFactory::getApp();
		return $app;
	}
	function getConfig() {
		return $this->config;
	}
	function getDocument() {
		$app = &mFactory::getApp();
		return $app->getDocument();
	}
	
	function writeDebug($debugtxt, $html=true) {
		if (_APPDEBUG) {
			$app = &mFactory::getApp();
			$app->writeDebug($debugtxt);
		}
	}
	function getUser() {
		$ssvc = & JLSecurityService::getInstance();
		$user = $ssvc->getUser();
		return $user;
	}
	
	/**
	 * isAdmin - returns a boolean if the user is an administrator
	 * @return boolean
	 */
	function isAdmin() {
		$ssvc = & JLSecurityService::getInstance();
		return $ssvc->isAdmin();
	}
	/**
	 * isLoggedIn - returns a boolean identifying if the user is logged in or not
	 * @return boolean
	 */
	function isLoggedIn() {
		$ssvc = & JLSecurityService::getInstance();
		return $ssvc->isLoggedIn();
	}
	function getVariable($name) {
		$req = &fsRequest::getInstance();
		return $req->getValue($name);
	}
}
?>
