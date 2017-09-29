<?php

/**
 * @version		$Id: baseview.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2008-2012 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license See license.html
 * 
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JLEAGUE_CLASSES_OBJECTS_PATH  . DS . 'htmldocument.class.php');

/**
 * The JLBaseView is the foundation view that all views (frontend/backend) extend from.
 *
 */
abstract class JLBaseView extends JLHtmlDocument {
	
	var $title = null;
	var $viewObject = null;
	//var $template = null;
	protected $templates = null;
	var $folder = null;
	var $objects = null;	
	var $stylesheets = null;
	var $applscripts = null;
	var $scripts = null;
	var $includecommonlibs = true;
	
	/**
	 * JLBaseView constructor function.  This initializes all of the needed arrays and
	 * sets an instance of the components configuration settings as an instance variable.
	 * The baseview will support multiple templates within one view. 
	 *
	 */
	public function __construct() {
		require_once(JLEAGUE_CLASSES_PATH . DS. 'helpers' . DS . 'html.php');
		$this->objects = array();
		$this->stylesheets = array();
		$this->scripts = array();
		$config = JLApplication::getConfig();
		$this->setObject('config',$config);
		$this->templates = array();				
	}
	
	function setFolder($folder) {
		$this->folder = $folder;
	}
	function getFolder() {
		return $this->folder;
	}
	/*
	function setTemplate($tmpl) {
		$this->template = $tmpl;
	}
	function getTemplate() {
		if ($this->template == null) {
			$tmpl = get_class($this);
			$len = strlen($tmpl) - 6;
			return substr($tmpl,2,$len);
		}
		return $this->template;
	}
	*/

	/**
	 * This function sets an object within the view.  These objects then become accessible within the
	 * view and all internal templates.
	 *
	 * @param String $key
	 * @param Object $obj
	 */
	function setObject($key,$obj) {
		$this->objects[$key]=$obj;
	}
	/**
	 * Returns an object that is contained within the view.
	 *
	 * @param String $key
	 * @return Object
	 */
	function getObject($key) {
		return $this->objects[$key];
	}
	/**
	 * This function sets an attribute that can be accessible within a template.  This is used
	 * for NON-OBJECTS.
	 *
	 * @param String $key
	 * @param String $val
	 */
	function setAttribute($key,$val) {
		$this->$key = $val;
	}

	/**
	 * The display function is an abstract function that all subclasses must implement.
	 *
	 */
	abstract function display();
	
	/**
	 * This function will enable clients to add stylesheets to the view.  The parameter should be 
	 * passed as a URL string. 
	 *
	 * @param String $sheet
	 */
	function addStylesheet($sheet) {
		$this->stylesheets[] = $sheet;
	}
	
	/**
	 * This function will enable clients to add javascript libraries to the view.  The parameter 
	 * should be passed as a URL string. 
	 *
	 * @param String $script
	 */	
	function addScript($script) {
		$this->scripts[] = $script;
	}
	
	function addApplicationScript($script) {
		$this->applscripts[] = $script;
	}
	
	/**
	 * This is a protected function that will generate the necessary LINK HTML elements that are 
	 * included as part of the page header.
	 *
	 */
	protected function generateStylesheetLinks() {
		if ($this->includecommonlibs) {
			if (count($this->stylesheets)>0) {
			 	foreach ($this->stylesheets as $entry) { 
			 		// In J2.5 - addCustomHeadTag is not part of the $mainframe.  have to access it via the document.
					parent::addStyleSheet($entry);	 		
		 		}
			}
		}
	}
	
	/**
	 * This is a protected function that will generate the necessary SCRIPT elements that are 
	 * generated when rendering the page.
	 *
	 */
	protected function generateJavascriptLinks() {
		if ($this->includecommonlibs) {
			$mainframe	=& JFactory::getApplication();
			if (count($this->applscripts)>0) {
			 	foreach ($this->applscripts as $entry) { 
			 		JLApplication::addScript($entry);
		 		}
			}
			
			if (count($this->scripts)>0) {
			 	foreach ($this->scripts as $entry) { 
			 		JLApplication::addScript($entry);
		 		}
			}
		}
	}
	
	function suppressCommonLibraries() {
		$this->includecommonlibs = false; 
	}
	
	/**
	 * Sets the title which will be rendered as part of the TITLE element of the page.  The title
	 * will appear in the browser window.
	 * 
	 * @param String $title
	 */
	function setTitle($title) {
		$this->title = $title;
	}
	/**
	 * Returns the current value of the views Title.
	 *
	 * @return String
	 */
	function getTitle() {
		return $this->title;
	}
	
	/**
	 * This function will add a template object to the views array of templates.   This function
	 * will in turn invoke a private function that injects the view into each of the template.  This 
	 * enables the view to have methods that can then be invoked within the templates.
	 *
	 * @param JLTemplate $tmpl
	 */
	function addTemplate(JLTemplate $tmpl) {
		//$tmpl->setObject("_view",$this);
    	$this->loadView($tmpl,$this);
		$this->templates[] = $tmpl;
	}	 
	
	/**
	 * This function injects the current view into any nested templates that may exist within
	 * the core template associated with the view.
	 *
	 * @param JLTemplate $tmpl
	 * @param JLBaseView $view
	 */
	private function loadView(JLTemplate $tmpl, $view) {
		$tmpl->setObject("_view",$view);
	    foreach ($tmpl->getNestedTemplates() as $template) {
    		$this->loadView($template,$view);
    	}		
	}
	
}
?>