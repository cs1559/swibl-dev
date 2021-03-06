<?php

defined('_JEXEC') or die('Restricted access');

class gmInstallerHelper {

	private $component = 'com_jleague';
	private $backendPath = null;
	private $frontendPath = null;
	private $languagePath = null;
	
	function __construct() {
		jimport( 'joomla.filesystem.folder' );
		jimport( 'joomla.filesystem.file' );
		jimport( 'joomla.filesystem.archive' );
		$this->backendPath   = JPATH_ROOT . '/administrator/components/com_jleague/';
		$this->frontendPath  = JPATH_ROOT . '/components/com_jleague/';
		//$this->languagePath   = JPATH_ROOT . '/administrator/components/com_jleague/';
		//$this->languagePath  = JPATH_ROOT . '/components/com_jleague/';
		
		/*
		require_once(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . $this->component . DS . 'defines.php');
		require_once(JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . $this->component . DS . 'classes' . DS . 'objects' . DS . 'config.class.php');

		$conf1 = &JLConfig::getInstance();
		//$conf1->__destruct();	
		
		$config = &JLConfig::getInstance();
		echo "Configuration file has been rereshed!";
		print_r($config);
		*/
		
		$language	=& JFactory::getLanguage();
		$this->languagePath   = JPATH_ROOT . '/language/' . $language->getDefault() . '/';
		
	}

	function unzipFiles() {
						
		$this->installFrontEnd();
		$this->installBackend();
				
		$this->installLanguage();
	}
	
	function installFrontEnd() {
		$zip = $this->frontendPath . "frontend.zip";

		if(!file_exists($zip)) {
			echo "FRONTEND.ZIP file cannot be found";
		}
		if (!$this->extractArchive($zip,$this->frontendPath)) {
			echo "<STRONG>ERROR: An error occured installing the FRONTEND components<br/></STRONG>";
		}
	}
	function installBackend() {
		$zip = $this->backendPath . "backend.zip";		
		if(!file_exists($zip)) {
			echo "BACKEND.ZIP file cannot be found";
		}
		if (!$this->extractArchive($zip,$this->backendPath)) {
			echo "<STRONG>ERROR: An error occured installing the BACKEND components<br/></STRONG>";
		}
	}
	
	function installLanguage() {
		$zip = $this->backendPath . "language/language.zip";
		echo "language path = " . $this->languagePath;
		echo "__ Zipfile = " . $zip . "__";
		if(!file_exists($zip)) {
			echo "LANGUAGE.ZIP file cannot be found";
		}
		if (!$this->extractArchive($zip,$this->languagePath)) {
			echo "<STRONG>ERROR: An error occured installing the LANGUAGE file<br/></STRONG>";
		}
	}
	
	function extractArchive( $source , $destination )
	{
		// Cleanup path
		$destination	= JPath::clean( $destination );
		$source			= JPath::clean( $source );
	
		return JArchive::extract( $source , $destination );
	}	
	
	/*
	 * 
	 *   $fields = $database->getTableFields(array('#__jleague_scores') );
  $fldArray = $fields['#__jleague_scores'];
  $flag = false;
  if (array_key_exists('properties',$fldArray) ) {
		$flag=true;
  }
  if (!$flag) {
		$query = 'alter table #__jleague_scores add column properties text';
		$database->setQuery($query);
		if (!$database->query()) {
			JLErrorHandler::displayError($database->getErrorMsg());
			exit();
		}  
  }
	 */
	
	
}
?>