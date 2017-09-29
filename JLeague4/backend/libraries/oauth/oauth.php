<?php

class fsOAuth {
	
	var $_consumerKey = null;
	var $_consumerSecret = null;
	var $_accessKey = null;
	var $_accessSecret = null;

	function __construct($key = null, $secret = null) {
		$this->_consumerKey = $key;
		$this->_consumerSecret = $secret;
	}
	
	public function getConsumerKey() {
		return $this->_consumerKey;
	}
	public function getConsumerSecret() {
		return $this->_consumerSecret;
	}
	public function setAccessKey($input) {
		$this->_accessKey = $input;
	}
	public function getAccessKey() {
		return $this->_accessKey;
	}
	public function setAccessSecret($input) {
		$this->_accessSecret = $input;
	}
	public function getAccessSecret() {
		return $this->_accessSecret;
	}	
	
}