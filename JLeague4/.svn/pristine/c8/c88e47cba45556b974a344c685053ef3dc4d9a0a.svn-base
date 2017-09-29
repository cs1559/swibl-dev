<?php
/**
 * GeocodeResponse Class File
 * 
 * @version $Id: geocoderesponse.class.php,v 1.1 2009/01/22 11:42:59 cs1559 Exp $ 
 * @package Geocoder
 * @author Chris Strieter
 * @copyright 2008 Firestorm Technologies, LLC.  All Rights Reserved
 * @filesource 
 * @license Commercial 
 */

/**
 * The GeocodeResponse object is what is returned by a geocoding service.  This object will contain
 * the latitude, longitude, altitude and other data that might be available from the given geocoding service.
 * @package Geocoder
 */

class fsGeocodeResponse {

	var $latitude = null;
	var $longitude = null;
	var $altitude = null;
	var $statuscode = null;
	var $success = false;
	var $source = null;
	
	/**
	 * This returns the actual response from the service (if it has been populated)
	 *
	 * @return unknown
	 */
	function getSource() {
		return $this->source;
	}
	/**
	 * Sets the actual response returned by the geocoding service.  This is optional.
	 *
	 * @param unknown $src
	 */
	function setSource($src) {
		$this->source = $src;
	} 

	/**
	 * Returns the latitude value
	 *
	 * @return unknown
	 */
    function getLatitude() {
    	return $this->latitude;
    }
    /**
     * Sets the latitude value
     *
     * @param unknown $lat
     */
    function setLatitude($lat) {
		$this->latitude = $lat;
    }
    
    /**
     * Returns the longitude
     *
     * @return unknown
     */
    function getLongitude() {
    	return $this->longitude;
    }
    /**
     * Sets the longitude
     *
     * @param unknown $lon
     */
    function setLongitude($lon) {
		$this->longitude = $lon;
    }    
    
    /**
     * Returns the altitude
     *
     * @return unknown
     */
    function getAltitude() {
    	return $this->altitude;
    }
    
    /**
     * Sets the altitude
     *
     * @param unknown $alt
     */
    function setAltitude($alt) {
    	$this->altitude = $alt;
    }
    
    /**
     * Returns the status code of the geocoding service request
     *
     * @return unknown
     */
	function getStatusCode() {
		return $this->statuscode;
	}
	
	/**
	 * Sets the requests status code
	 * 
	 * @param unknown $code  
	 */
	function setStatusCode($code) {
		return $this->statuscode = $code;
	}

}
?>