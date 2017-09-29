<?php

/**
 * InfoWindow Class file.
*
* @version $Id: map.class.php,v 1.21 2009/09/06 00:07:09 cs1559 Exp $
* @author Chris Strieter
* @copyright (c) 2008 Firestorm Technologies, LLC.  All Rights Reserved
* @package Maps
* @filesource
* @license See license.html
*/

// Disallow direct access to this file
defined('_FSTLIB') or die('Restricted access');


/**
 * The Map object is the representation of the map itself.  It is used in the actual rendering
 * of the map.  It provides functionality to add/set specific properties (i.e. height, width,
 * maptyps, etc.) as well as various marker types.
 * @package Maps
*/

class fsInfoWindow extends fsBaseObject {
	private $_content = null;
	private $_maxwidth = null;

	function __construct() {
		parent::__construct();
	}
	
	public function setContent($content) {
		$this->_content = $content;
	}
	public function getContent() {
		return $this->_content;
	}
	
	function setMaxWidth($width) {
		$this->_maxwidth = $width;
	}
	function getMaxWidth() {
		return $this->_maxwidth;
	}
	
}
