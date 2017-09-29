<?php
/**
 * @version		$Id: teams.php 232 2011-01-09 22:18:38Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */
 
// No direct access
 
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * JLCache is a helper class that acts as a facade to the underlying caching system.
 *
 */
class JLCache  {
	
	var $cacheArray = null;
	var $group = 'com_jleague';
	
	protected function __construct() {
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLCache();
			$this->cacheArray = array();
		}
		return $instance;
	}		
	
	function get($template,$teamid) {
		$key = $this->getKey($template,$teamid);
		$cache = &JFactory::getCache($this->group, 'output');
		//if (!$data = $cache->get('menu_items')) {
		if ($data = $cache->get($key)) {
			$content = unserialize($data);
		} 
		throw new Exception ("Cache data not found");
	}
	
	function store($template, $teamid, $content) {
		$key = $this->getKey($template,$teamid);
		$cache = &JFactory::getCache($this->group, 'output');
		//if (!$data = $cache->get('menu_items')) {
		$cache->store(serialize($content), $key);
	}
	
	function getKey($template, $teamid) {
		$key = $teamid . "_" . $template;
		return $key;
	}

}


?>