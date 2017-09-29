<?php
/**
 * @version		$Id: season.class.php 441 2012-10-20 22:16:19Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JLRoute extends fsRoute  {

	private $_uri = null;
	
	function __construct($inArray) {
    	parent::__construct($inArray);
    }
    
    function getPath() {
    	return $this->getParameter("path");
    }
    
    function getController() {
    	return $this->getParameter("controller");
    }
    
    function getMethod() {
    	return $this->getParameter("method");
    }
    
    /**
     * This function returns an array of parameters for the route
     * @return array
     */
    function getQueryParameters() {
    	$params = $this->getParameter("param");
    	if (!is_array($params)) {
    		return null;
    	}
    	return $params;
    }
    
    public function setUri(fsURI $uri) {
    	$this->_uri = $uri;
    }
    public function getUri() {
    	return $this->_uri;
    }
	
}
?>