<?php
        // No direct access
    defined( '_JEXEC' ) or die( 'Restricted access' );

    //sessions
    jimport( 'joomla.session.session' );

    include(dirname(__FILE__) . DIRECTORY_SEPARATOR .'defines.php');
    
    include(JPATH_COMPONENT. DIRECTORY_SEPARATOR.'libraries/util/loader.php');
    
    
    $lang = JFactory::getLanguage();
    $tag = $lang->getTag();
    if (!$tag)
    	$tag = 'en-GB' ;

   JLApplication::loadLanguage("com_jleague");
    
    
    /*
    $extension = "com_jleague";
    $lang->load('com_jleague', JPATH_COMPONENT, $tag);
    
    $path = &JLanguage::getLanguagePath(JPATH_COMPONENT, $tag);
    
    $internal = $extension == 'joomla' || $extension == '';
    $filename = $internal ? $tag : $tag . '.' . $extension;
    $filename = "$path/$filename.ini";

    echo $filename;
      */  
    
    //load tables
    //JTable::addIncludePath(JPATH_COMPONENT.'/tables');

    //load classes
    //JLoader::registerPrefix('Lendr', JPATH_COMPONENT);

    //Load plugins
    //JPluginHelper::importPlugin('lendr');

    //application
    $app = &JFactory::getApplication();

    // Require specific controller if requested
    if($controller = $app->input->get('controller','default')) {
        require_once (JPATH_COMPONENT.'/controllers/'.$controller.'.php');
    }

    // Create the controller
    $classname = 'JLeagueController'.$controller;
    $controller = new $classname();

    // Perform the Request task
    $controller->execute();

   ?>
