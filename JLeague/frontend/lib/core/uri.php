<?php

/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Framework
 * @subpackage	Core
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL
 */
// Disallow direct access to this file
defined('_FSTLIB') or die('Restricted access');

class fsURI
{

	protected $_scheme = null;
	protected $_server = null;
	protected $_host = null;
	protected $_query = null;
	protected $_path = null;
	protected $_port = null;
	protected $_absolute = null;
	protected $_uri = null;
	protected $_fragments = null;
	protected $_queryparms = null;
	
	/**
	 * This constructor allows for a URL value to be passed.  This will allow the class to be re-usable
	 * instead of using everything from the server.
	 * 
	 * @param string $uri
	 */
	protected function __construct($uri = null) {
		if (!is_null($uri))
		{
			$this->setAbsolute($uri);
			$this->parse($uri);
		}
	}
	
	/**
	 * This function will return an instance of fsUri
	 * @param string $uri
	 * @return fsURI
	 */
	static function getInstance($uri = 'SERVER') {
		if ($uri == 'SERVER') {
			if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off'))
			{
				$https = 's://';
			}
			else
			{
				$https = '://';
			}
			
			$uri = "http" . $https . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		} 
		return new fsURI($uri);		
	} 
	
	/**
	 * Private fucntion that will set the absolute URI.
	 * 
	 * @param unknown $uri
	 */
	private function setAbsolute($uri) {
		$this->_absolute = $uri;
	}
	
	/**
	 * Returns the Absolute URI
	 * @return string
	 */
	public function getAbsolute() {
		return $this->_absolute;
	}
	
	/**
	 * Private function that will parse the URI and set instance variables such as scheme, host, etc. 
	 * 
	 * @param string $uri
	 */
	private function parse($uri) {
		$this->_uri = $uri;
		$components = parse_url($uri);
		$this->_scheme = isset($components['scheme']) ? $components['scheme'] : null;
		$this->_host = isset($components['host']) ? $components['host'] : null;
		$this->_query = isset($components['query']) ? $components['query'] : null;
		$this->_path = isset($components['path']) ? $components['path'] : null;
		$this->_port = isset($components['port']) ? $components['port'] : null;
		$this->_fragments = isset($components['fragment']) ? $components['fragment'] : null;
		$this->parseQuery();
	}

	/**
	 * This function will return the base part of the url
	 * @throws fsException
	 * @return string
	 */
	public function getBase() {
		if ($this->_scheme != null && $this->_host != null) {
			if ($this->_port != null) {
				return $this->_scheme . "://" . $this->_host . ":" . $this->_port;
			}
			return $this->_scheme . "://" . $this->_host;
		} else {
			throw new fsException("Unable to determine BASE URI");
		}
	}
	public function getPort() {
		return $this->_port;
	}
	public function getHost() {
		return $this->_host;
	}
	public function getScheme() {
		return $this->_scheme;
	}
	public function getQuery() {
		return $this->_query;
	}
	public function getPath() {
		return $this->_path;
	}
	public function getFragments() {
		return $this->_fragments;
	}
	private function parseQuery() {
		if (is_null($this->_query)) {
			return;
		}
		$parms = preg_split("/[&]+/",$this->_query);
		foreach ($parms as $parm) {
			$namevalue = preg_split("/[=]+/",$parm);
			$this->_queryparms[$namevalue[0]] = $namevalue[1];
		}
	}
	public function getQueryParameter($key) {
		return $this->_queryparms[$key];
	}
	public function __toString() {
		return $this->_absolute;
	}
	
}
