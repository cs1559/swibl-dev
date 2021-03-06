<?php

/**
 * Marker Class file.
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
 * The Marker object represents the base marker object.
 * 
 * @package Maps
*/

class fsMarker extends fsBaseObject {
	private $_id = null;
	private $_title = null;
	private $_latitude = null;
	private $_longitude = null;
	private $_infowindow = null;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Sets the marker id.
	 *
	 * @param int $inparm
	 */
	public function setId($inparm) {
		$this->_id = $inparm;
	}
	/**
	 * Returns the marker id.
	 *
	 * @return int
	 */
	public function getId() {
		return $this->_id;
	}
	
	/**
	 * Sets the Map Title
	 *
	 * @param string $inParm
	 */
	function setTitle($inParm) {
		$this->_title = $inParm;
	}
	/**
	 * Returns the map title
	 *
	 * @return string
	 */
	function getTitle() {
		return $this->_title;
	}
	
	function setLatitude($lat) {
		$this->_latitude = $lat;
	}
	function getLatitude() {
		return $this->_latitude;
	}
	function setLongitude($lng) {
		$this->_longitude = $lng;
	}
	function getLongitude() {
		return $this->_longitude;
	}
	
}

