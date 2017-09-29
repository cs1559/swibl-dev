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

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once(FST_CORE_OBJECTS_PATH . DS . 'baseobject.class.php');

abstract class FSTDocument extends FSTBaseObject {
	
	private $_title = null;
	private $_header = null;
	private $_body = null;
	private $_footer = null;
	private $_scripts = array();
	private $_stylesheets = array();
	private $_metatags = array();
	public $_lineEnd = "\12";
	
	
	function __construct() {
		parent::__construct();
	}
	
	function getTitle() {
		return $this->title;	
	}
	function setTitle($title) {
		$this->title = $title;
	}
	function getHeader() {
		return $this->header;
	}
	function setHeader($hdr) {
		$this->header = $hdr;
	}
	function getFooter() {
		return $this->footer;
	}
	function setFooter($ftr) {
		$this->footer = $ftr;
	}
	abstract function render();
	
	function getLineEnd() {
		return $this->_lineEnd;
	}
	
	protected function writeLn($ln) {
		echo $ln . self::getLineEnd();
	}
}
?>