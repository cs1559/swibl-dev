<?php 
	defined( '_JEXEC' ) or die( 'Restricted access' );
     
	require_once (JLEAGUE_CLASSES_OBJECTS_PATH  . DS . 'basecontroller.class.php');
	require_once (JLEAGUE_CONTROLLERS  . DS . 'admincontroller.php');
	
    class JLeagueControllerDefault extends JLeagueControllerAdmin
    {
	    public function execute()
	    {
		    // Get the application
		    $app = $this->getApplication();
		     
		    // Get the document object.
		    //$document = $app->getDocument();
		    $document = $this->getDocument();
		    		    
		    /*
		    $viewName = $app->input->getWord('view', 'dashboard');
		    $viewFormat = $document->getType();
		    $layoutName = $app->input->getWord('layout', 'default');
		     
		    $app->input->set('view', $viewName);
		     
		    // Register the layout paths for the view
		    $paths = new SplPriorityQueue;
		    $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');
		     
		    $viewClass = 'LendrViews' . ucfirst($viewName) . ucfirst($viewFormat);
		    $modelClass = 'LendrModels' . ucfirst($viewName);
		     
		    if (false === class_exists($modelClass))
		    {
		    $modelClass = 'LendrModelsDefault';
		    }
		     
		    $view = new $viewClass(new $modelClass, $paths);
		    $view->setLayout($layoutName);
		     
		    // Render our view.
		    echo $view->render();
		    */

		    
 		    require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'controlpanel.php');
 		    require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS .  'template.class.php');
 		    require_once(JLEAGUE_SERVICES_PATH . DS. 'seasonservice.class.php');
 		    require_once(JLEAGUE_CLASSES_PATH . DS. 'viewfactory.class.php');
		    
		    $config = &JLConfig::getInstance();
		    $ssvc = &JLSeasonService::getInstance();
		    $season = $ssvc->getRow($config->getPropertyValue("current_season"));
		     
		    $view = new JLControlPanelView();
		    $tmpl = new JLTemplate("controlpanel");
		    
		    $tmpl->setObject('config',$config);
		    $tmpl->setObject('season',$season);
		    $view->addTemplate($tmpl);
		    $view->display();
		    
		    return true;
	    }
 }
 
?>