<?php

class fsDocument {
	
	var $_header = null;
	var $_footer = null;
	var $_body = null;
	var $_type = null;
	var $_title = null;
	var $_author = null;
	var $_layout = null;
	var $_debug = array();

	public function setHeader($input) {
		$this->_header = $input;
	}
	
	public function getHeader() {
		return $this->_header;
	}
	
	public function setFooter($input) {
		$this->_footer = $input;
	}
	
	public function getFooter() {
		return $this->_footer;
	}
	
	public function setType($type) {
		$this->_type = $type;
	}
	public function getType() {
		return $this->_type;
	}
	
	public function setBody($input) {
		$this->_body = $input;
	}
	
	public function getBody() {
		return $this->_body;
	}
	
	public function setTitle($title) {
		$this->_title = $title;
	}
	public function getTitle() {
		return $this->_title;
	}
	public function setAuthor($author) {
		$this->_author = $author;
	}
	public function getAuthor() {
		return $this->_author;
	}
	public function setLayout($layout) {
		$this->_layout = $layout;
	}
	public function getLayout() {
		return $this->_layout;
	}
	
	public function appendBody($content) {
		$this->_body = $this->_body . $content;
	}
	
	public function addDebugMessage($msg) {
		date_default_timezone_set("America/Chicago");
		
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$d = new DateTime( date('Y-m-d H:i:s.'.$micro,$t) );
		
		$newmsg = "[DEBUG][" . $d->format("Y-m-d H:i:s.u") . "]" . $msg;
		$this->_debug[] = $newmsg;
	}
	public function resetDebugMessages() {
		unset($this->_debug);
		$this->_debug = array();
	}
	public function getDebugMessages() {
		return $this->_debug;
	}
	
}