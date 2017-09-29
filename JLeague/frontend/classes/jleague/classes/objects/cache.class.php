<?php

/**
 * @version		$Id: cache.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'cachedao.class.php');

class JLCache  {
	
	var $cacheArray = null;
	var $group = 'com_jleague';
	var $usedb = false;
	
	protected function __construct() {
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLCache();
			$this->cacheArray = array();
		}
		if ($instance->usedb) {
			$dao = &JLCacheDAO::getInstance();
			$dao->deleteExpired();
		}
		return $instance;
	}		
	
	/**
	 * This function will retrieve data from the cache
	 *
	 * @param string $template
	 * @param string $teamid
	 * @return mixed
	 */
	function get($key,$context=null) {
		$key = $this->getKey($key,$context);
		if ($this->usedb) {
			require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'cachedao.class.php');
			$dao = &JLCacheDAO::getInstance();
			if ($cache_entry = $dao->get($key)) {
				return unserialize(base64_decode($cache_entry->cache_value));
			}
			throw new Exception ("Cache data not found");
		} else {
			$cache = &JLFactory::getCache($this->group, 'output');
			if ($data = $cache->get($key)) {
				$content = unserialize($data);
				return $content;
			} 
			throw new Exception ("Cache data not found");
		}		
	}
	
	/**
	 * This function stores the data in the caching system
	 *
	 * @param unknown_type $template
	 * @param unknown_type $teamid
	 * @param mixed $content
	 */
	function store($template, $teamid, $content) {
		
		if ($this->usedb) {
			require_once(JLEAGUE_CLASSES_DAO_PATH . DS . 'cachedao.class.php');
			$key = $this->getKey($template,$teamid);
			$dao = &JLCacheDAO::getInstance();
			$_content = base64_encode(serialize($content));
			try {
				$content = $dao->insert($key, $_content);
			} catch (Exception $e) {
				throw $e;
			}
		} else {
			$key = $this->getKey($template,$teamid);
			$cache = &JLFactory::getCache($this->group, 'output');
			$cache->store(serialize($content), $key);
		}
	}
	
	/**
	 * This function will remove an item from cache
	 *
	 * @param unknown_type $template
	 * @param unknown_type $teamid
	 */
	function remove($template, $teamid) {
		$key = $this->getKey($template,$teamid);
		$cache = &JLFactory::getCache($this->group, 'output');
		$cache->remove($key);
	}
	
	function getKey($template, $teamid) {
		$key = $teamid . "_" . $template;
		return $key;
	}

}


