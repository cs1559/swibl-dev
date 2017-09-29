<?php
/**
 * @version		$Id: template.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'fieldrenderer.class.php');

class JLTemplate extends JLBaseObject {

	var $objects = null;
	var $name = null;
	var $alias = null;
	var $folder = null;
	var $nestedtemplates = null;

	function __construct($file = null, $folder = null) {
		parent::__construct();
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		require_once(JLEAGUE_SERVICES_PATH . DS. 'securityservice.class.php');
		
		//place an instance object into the template doesn't need to handle this 
		$config = JLConfig::getInstance();
		$this->objects = array();
		$this->setObject('_config',$config);				
		$this->name = $file;
		$this->folder = $folder;
		$this->nestedtemplates = array();
		$svc = JLSecurityService::getInstance();
		$this->setObject('security',$svc);
		// @todo check for existence of file/folder
	}
		
	
	function setObject($key,$obj) {
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
		if ($this->folder == null) {
			include(JPATH_COMPONENT  . DS. 'templates'. DS . $this->getName() . '.php');
		} else {
			include($this->getFolder() . DS . $this->getName() . '.php');					
		}		
	}
	
	function getInputElement($name,$value,$size=30,$length=30) {
		if (!strlen($size) > 0) {
			$size = 30;
		}
		if (!strlen($length) > 0) {
			$length = 30;
		}
		
		return "<input id='" . $name . "' name='".$name."' value='".$value."' size='".$size."' maxlength='".$length."'/>";
	}
	
	function getTextAreaElement($name,$value,$rows=30,$cols=30) {
		if (!strlen($rows) > 0) {
			$rows = 30;
		}
		if (!strlen($cols) > 0) {
			$cols = 30;
		}
		
		return "<textarea name='".$name."' rows='".$rows."' cols='".$cols."'>" . $value . "</textarea>";
	}	
	function getContent() {
		ob_start ();
		$this->parse();
		$contenHTML = ob_get_contents ();
		ob_end_clean ();
		return $contenHTML;
	}
	
	function addTemplate(JLTemplate $tmpl) {
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
}
?>