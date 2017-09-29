<?php

/**
 * @version		$Id: address.class.php 53 2010-02-24 23:27:08Z Chris Strieter $
 * @package 	FSTCore
 * @subpackage	Objects
 * @copyright 	(C) 2008,2009 Chris Strieter
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	Commercial
 * 
 */

defined('_JEXEC') or die('Restricted access');

require_once(FST_CORE_OBJECTS_PATH . '/document/document.class.php');

class FSTHtmlDocument extends FSTDocument {

	var $noHtmltag = false;
	var $articles = array();
	
	function __construct() {
		parent::__construct();
		$this->noHtmltag = false;
		$this->setHeader("This is the header");
		//$this->setBody("this is the body");
		$this->setFooter("this is the footer");
	}
	
	function render() {
		$this->writeLn($this->getHeader());
		$this->writeLn($this->getFooter());
	}

}
?>