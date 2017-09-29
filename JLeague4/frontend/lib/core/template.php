<?php
/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Framework
 * @subpackage	Core
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL
 */
// Disallow direct access to this file
defined('_FSTLIB') or die('Restricted access');

// include_once('exception.php');

class fsTemplate  {

	var $objects = null;
	var $name = null;
	var $alias = null;
	var $folder = null;
	var $nestedtemplates = null;
	var $_container = null;

	function __construct($file = null, $folder = null) {
// 		parent::__construct();
		$this->objects = array();
		$this->nestedtemplates = array();
		$this->name = $file;
		$this->folder = $folder;
	}
		
	
	function setObject($key,$obj) {
		if ($obj instanceof fsTemplate) {
			$this->addTemplate($obj);
			return;
		}
		$this->objects[$key]=$obj;
	}
	function getObject($key) {
		return $this->objects[$key];
	}
	function getName() {
		return $this->name;
	}
	function getAlias() {
		return $this->alias;
	}	
	function setAlias($aliasname) {
		$this->alias = $aliasname;
	}
	function setFolder($folder) {
		$this->folder = $folder;
		if (self::hasNestedTemplates()) {
			foreach ($this->nestedtemplates as $template) {
				$template->setFolder($folder);
			}
		}
	}
	function getFolder() {
		return $this->folder;
	}
	function parse() {
		foreach ($this->nestedtemplates as $template) {
			if (is_null($template->getAlias())) {
				$this->setObject($template->getName(),$template->getContent());
			} else {
				$this->setObject($template->getAlias(),$template->getContent());
			}
		}
		if (count($this->objects) > 0) {
			extract($this->objects);	
		}
		if ($this->getContainer() != null) {
			$_view = $this->getContainer();
		}
		if (defined(JPATH_COMPONENT)) {
			if ($this->folder == null) {
				include(JPATH_COMPONENT  . DS. 'templates'. DS . $this->getName() . '.php');
			} else {
				include($this->getFolder() . DS . $this->getName() . '.php');					
			}
		} else {
			$fn = $this->getFolder() . $this->getName() . '.php';
			if (file_exists($fn)) {
				include($fn);
			} else {
				throw new fsException("Template File Not Found [" . $fn . "]");	
			}			
		}
	
	}
	

	function getContent() {
		ob_start ();
		$this->parse();
		$contenHTML = ob_get_contents ();
		ob_end_clean ();
		return $contenHTML;
	}
	
	function addTemplate(fsTemplate $tmpl) {
		$this->nestedtemplates[] = $tmpl;
	}
	
	/**
	 * This function returns a boolean if the template has any nested templates.
	 *
	 * @return boolean
	 */
	function hasNestedTemplates() {
		if (count($this->nestedtemplates) > 0) {
			return true;
		}
		return false;
	}
	
	function getNestedTemplates() {
		return $this->nestedtemplates;
	}
	
	function setContainer(fsView $input) {
		$this->_container = $input;
	}
	function getContainer() {
		return $this->_container;
	}
	function __toString() {
		try {
			return $this->getContent();
		} catch (Exception $e) {
			$html =  "ERROR:  UNABLE TO PARSE TEMPLATE [" . $this->getFolder() . "]<br/>";
			$html .= $e->getMessage();
			return $html;
		}
	}
}
?>