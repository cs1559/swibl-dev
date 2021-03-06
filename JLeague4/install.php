<?php
class com_jleagueInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		require_once('installhelper.class.php');
	
		$helper = new gmInstallerHelper();
		$helper->unzipFiles();
	
		echo "Component Installed!!";
	
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo "Uninstall executed";
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		require_once('installhelper.class.php');
		
		$helper = new gmInstallerHelper();
		$helper->unzipFiles();
	
		echo "Component Updated!!";

	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
	}
}
?>