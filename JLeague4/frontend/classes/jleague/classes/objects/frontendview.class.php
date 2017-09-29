<?php
/**
 * @version $Id: frontendview.class.php 280 2011-10-04 01:00:23Z Chris Strieter $ 
 * @author Chris Strieter 
 * @copyright (c) 2008 Firestorm Technologies, LLC.  All Rights Reserved 
 * @package Maps
 * @filesource 
 * @license See license.html
*/


require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseview.class.php');

class JLFrontendBaseView extends JLBaseView {

	function __construct() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'config.class.php');
		parent::__construct();
		//place an instance object into the view array so each template doesn't need to handle this 
		$config = JLConfig::getInstance();
		parent::setObject('_config',$config);
	}
	/**
	 * This function is used to set common CSS and Javascript libraries for all of the front-end
	 * views.
	 *
	 */
	function initDisplay() {
		$document = JLApplication::getDocument();
		if ($this->getTitle() != null) {
			$document->setTitle($this->getTitle());
		}
		
		$this->addStylesheet(JURI::root() . 'components/com_jleague/css/jleague.css');
		$this->addStylesheet(JURI::root() . 'administrator/components/com_jleague/assets/jquery-theme/smoothness/jquery-ui-1.7.2.custom.css');
		$this->addApplicationScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-1.6.2.min.js');
//		$this->addApplicationScript(JURI::root() . 'components/com_jleague/js/jquery-ui-1.7.2.custom.min.js');
		$this->addApplicationScript(JURI::root() . 'components/com_jleague/assets/jquery/jquery-ui-1.8.16.custom.min.js');
		$this->addApplicationScript(JURI::root() . 'components/com_jleague/js/jleague.js');
		$this->addApplicationScript(JURI::root() . 'components/com_jleague/js/jquery.validate.pack.js');
//		$this->addApplicationScript(JURI::root() . 'components/com_jleague/js/jquery.tools.min.js');
		$this->generateStylesheetLinks();
		$this->generateJavascriptLinks();
	}
	
	/**
	 * This function is a function used to display the views template.
	 *
	 */
	function display() {

		$this->initDisplay();
		
		foreach ($this->templates as $template) {
			if (is_object($template)) {
				$template->parse();
			}
		}
	}
	
	function getContent() {
		$_content = "";
		ob_start ();
		foreach ($this->templates as $template) {
			if (is_object($template)) {
				$template->parse();
			}
		}
		$contenHTML = ob_get_contents ();
		ob_end_clean ();
		$_content .= $contenHTML;
		return $_content;
	}
	
	function addPathway( $text , $link = '' )
	{
		JLApplication::addPathwayItem($text, $link);
	}
	
}

?>