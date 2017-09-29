<?php
/**
 * @version		$Id: controller.php 320 2011-12-24 11:08:14Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controller
 * @copyright 	(C) 2008,2011 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
jimport('joomla.template.template');
jimport('joomla.language.language');

require_once (JLEAGUE_CLASSES_OBJECTS_PATH  . DS . 'basecontroller.class.php');

class JLeagueControllerAdmin extends JLBaseController
{
	protected $service = null;
	var $redirectUrl = null;
	var $_redirectArray = array();
	
	
	function __construct() {
		parent::__construct();
				
		// Add some javascript that may be needed
		$document	=& JFactory::getDocument();
		// Attach the back end css
		$css		= JLEAGUE_ASSETS_URL . '/default.css';
		$document->addStyleSheet( $css );	
		$this->loadLanguage();	
	}
	
	private function loadLanguage() {
	    // Load Language File
		$language	=& JFactory::getLanguage();
		$language->load( 'com_jleague' , JPATH_ROOT );
	}	
	
	function execute() {
		parent::execute();
	}
	
   	function display()
    {
		require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'controlpanel.php');		
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');		
   		require_once(JLEAGUE_SERVICES_PATH . DS. 'seasonservice.class.php');
    	require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');		

//		$language	=& JFactory::getLanguage();
//		$language->load( 'com_jleague' , JPATH_ROOT );
		
    	$config = &JLConfig::getInstance();
    	$ssvc = &JLSeasonService::getInstance();
    	$season = $ssvc->getRow($config->getPropertyValue("current_season"));
    	
		$view = new JLControlPanelView();
		$tmpl = new JLTemplate("controlpanel");
		
		$tmpl->setObject('config',$config);
		$tmpl->setObject('season',$season);
		$view->addTemplate($tmpl);
        $view->display();
    	
    }
	
	
    //Method to display the view    
    function display2()
    {
  	
   		$viewName	= JRequest::getCmd( 'view' , 'jleague' );

		// Set the default layout and view name
		$layout		= JRequest::getCmd( 'layout' , 'default' );

		// Get the document object
		$document	=& JFactory::getDocument();

		// Get the view type
		$viewType	= $document->getType();
		
		// Get the view
		$view		=& $this->getView( $viewName , $viewType );
		$model		=& $this->getModel( $viewName );
		
		if( $model )
		{
			$view->setModel( $model , $viewName );
		}

		// Set the layout
		$view->setLayout( $layout );

		// Display the view
		$view->display();
		
		// Display Toolbar. View must have setToolBar method
		if( method_exists( $view , 'setToolBar') )
		{
			$view->setToolBar();
		}
    	if( method_exists( $view , 'showSubmenu') )
		{
			if ($view->showSubmenu()) {
				$this->renderSubmenu($view);
			}
		}
    }
    

	function setService($svc) {
		$this->service = $svc;
	}
	function getService() {
		return $this->service;
	}
	

	function cancel()
	{
		$lang = &JFactory::getLanguage();
		$lang->load("com_jleague",JPATH_COMPONENT.DS);
		
		$msg = JLText::getText( 'JL_OPERATION_CANCELLED' );
		$link = $this->redirectUrl;
		$this->setRedirect($link, $msg);
	
	}
	
	
	
	function remove() {
		$service = $this->getService();
		if ($service == null) {
			JError::raiseError( 500, "Invalid controller service");
		}
		$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
		$fail = false;
		try {		
			for ($y=0; $y<(sizeof($cid)); $y++) {
				$id = intval($cid[$y]);
				try {
					$service->delete($id);
				} catch (Exception $e) {
					$fail = true;
				}			
			}		
			if ($fail) {
				$msg = "One or more records were not deleted due to error";
			} else {
				$msg = count($cid) . " record(s) were deleted";
			}
		} catch (Exception $e) {
			$msg = $e->getMessage();
		}
		$this->setRedirect($this->redirectUrl,$msg);		
	}
	
	function togglePublish() {
		$redirectUrl = $this->getFunctionRedirect(__FUNCTION__);
		echo "Redirecting to " . $redirectUrl;
		$service = $this->getService();
		if ($service == null) {
			JError::raiseError( 500, "Invalid controller service");
		}
		
		$cid	= JRequest::getVar('cid');
		try {
			$service->togglePublished($cid);
			//$this->setRedirect($this->redirectUrl,"Record(s) successfully published/unpublished");
			$this->setRedirect($redirectUrl,"Record(s) successfully published/unpublished");
		} catch (Exception $e) {
			throw $e;
		}
		$this->redirect();
	}

	/**
	 * This function will publish the selected rows
	 *
	 */
	function publish() {
		$service = $this->getService();
		if ($service == null) {
			JError::raiseError( 500, "Invalid controller service");
		}
		
		$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
		$fail = false;		
		for ($y=0; $y<(sizeof($cid)); $y++) {
			$id = intval($cid[$y]);
			$rc = $service->publish($id);
			if (!$rc) {
				$fail = true;
			}			
		}		
		if ($fail) {
			$msg = "One or more records were not published";
		} else {
			$msg = count($cid) . " record(s) were published";
		}
		$this->setRedirect($this->redirectUrl,$msg);
	}
		
	/**
	 * This function will unpublish the selected rows.
	 *
	 */
	function unpublish() {
		$service = $this->getService();
		if ($service == null) {
			JError::raiseError( 500, "Invalid controller service");
		}
		$cid	= JRequest::getVar('cid', array(0), 'method', 'array');
		$fail = false;		
		for ($y=0; $y<(sizeof($cid)); $y++) {
			$id = intval($cid[$y]);
			$rc = $service->unpublish($id);
			if (!$rc) {
				$fail = true;
			}			
		}		
		if ($fail) {
			$msg = "One or more records were not unpublished";
		} else {
			$msg = count($cid) . " record(s) were unpublished";
		}
		$this->setRedirect($this->redirectUrl,$msg);
		
	}	

	function setFunctionRedirect($func, $url) {
		$this->_redirectArray[$func] = $url;
	}
	function getFunctionRedirect($func) {
		return $this->_redirectArray[$func];
	}
	
	function setRedirectURL($url) {
		$this->redirectUrl = $url;
	}
		
} ?>
 