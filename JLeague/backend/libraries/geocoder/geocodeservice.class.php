<?php

/**
 * GeocodeService Class File (abstract)
 * 
 * @version $Id: geocodeservice.class.php,v 1.1 2009/01/22 11:42:59 cs1559 Exp $ 
 * @package Geocoder
 * @author Chris Strieter
 * @copyright 2008 Firestorm Technologies, LLC.  All Rights Reserved
 * @filesource 
 * @license Commercial 
 */

/**
 * Include required objects
 */
require_once('geocoderexception.class.php');
require_once('geocoderesponse.class.php');
require_once('geocoderconfig.class.php');


/**
 * The fsGeocodeService is an abstract class that provides base functionality to be extended
 * for the implementation of specific geocoding service classes.
 * @package Geocoder
 */


abstract class fsGeocodeService {
	
	private $name = null;
	private $url = null;
	private $debug = true;
	private $config = null;

	/**
	 * Construction that will invoke the init function.
	 *
	 */
	public function __construct() {
		$this->init();
	}
	
	/**
	 * A helper function that returns a specific property value 
	 * for the geocoding service.
	 *
	 * @param string $key
	 * @return object
	 */
	protected function getProperty($key) {
		return $this->config->getProperty($key);
	}
	
	/**
	 * Returns the Geocoding Service Name (if populated)
	 *
	 * @return string
	 */
	public function getServiceName() {
		return $this->name;
	}
	
	/**
	 * Function to return an instance of a geocode configuration object.
	 *
	 * @returns fsGeocoderConfig
	 */
	private function init() {
		$this->config = fsGeocoderConfig::getInstance();
	}
	
	/**
	 * Sets the geocoder service name.
	 *
	 * @param string $svcname
	 */
	public function setServiceName($svcname) {
		$this->name = $svcname;
	} 
	
	/**
	 * Turns debug on.  The Geocoding engine will turn this on automatically.
	 *
	 * @param boolean $parm
	 */
	public function setDebug($parm) {
		$this->debug = $parm;
	}
	
	/**
	 * Defines the function that all classes must implement.  This function
	 * will be called automatically by the geocoding engine.
	 *
	 * @param fsGeocodeValue $inparm
	 */
	abstract function geocodeValue(fsGeocodeValue $inparm);
	
	/**
	 * Invokes the geocoding service request.
	 *
	 * @param string $url
	 * @return unknown
	 */
	function sendRequest($url) {
		//if ($this->debug) {
			echo "DEBUG:  request url = " . $url . "<br/>";
		//}
		if(ini_get("allow_url_fopen")) {
			$gm=@fopen("$url",'r');
			$tmp=@fread($gm,30000);
			@fclose($gm);
		} else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "$url");
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 	15);
			$tmp= curl_exec($ch);
			curl_close($ch);
		}
		return $tmp;
	}
}

?>