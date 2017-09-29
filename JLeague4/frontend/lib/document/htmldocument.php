<?php

include_once('document.php');

class fsHtmlDocument extends fsDocument {
	
	var $_javascripts = null;
	var $_stylesheets = null;
	var $_keywords = null;
	var $_meta = null;
	var $_scriptdeclarations = null;
	
	function __construct() {
		$this->_javascripts = array();
		$this->_stylesheets = array();
		$this->_scriptdeclarations = array();
		$this->setType("html");
	}
	
	function addJavascript($url) {
		$this->_javascripts[] = $url;
	}
	
	function addStylesheet($url) {
		$this->_stylesheets[] = $url;
	}
	
	function addScriptDeclaration($content) {
		$this->_stylesheets[] .= chr(13) . $content;
	}
	
	function getJavascripts() {
		return $this->_javascripts;
	}
	function getStylesheets() {
		return $this->_stylesheets;
	}
	
}
