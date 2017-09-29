<?php

include_once('layout.php');

class fsDefaultLayout extends fsLayout {
	
	function __construct() {
		$this->setName("DefaultLayout");
		$this->addPostion("header");
		$this->addPostion("left-column");
		$this->addPostion("main");
		$this->addPostion("right-column");
		$this->addPostion("footer");
	}
	
}