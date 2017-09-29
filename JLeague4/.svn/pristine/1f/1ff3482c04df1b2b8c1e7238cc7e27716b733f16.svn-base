<?php

/**
 * Geocoder Class File
 * 
 * @version $Id: geocoder.class.php,v 1.1 2009/01/22 11:42:59 cs1559 Exp $ 
 * @package Geocoder
 * @author Chris Strieter
 * @copyright 2008 Firestorm Technologies, LLC. All Rights Reserved
 * @filesource 
 * @license Commercial 
 */

/**
 * Include Geocode Service class
 */
require_once('geocodeservice.class.php');
/**
 * Include Geocoder Configuration class
 */
require_once('geocoderconfig.class.php');

/**
 * The Geocoder class is a geocoding engine that enables you to define one-to-many
 * geocoding services.  Services like Yahoo, Google, Multi-map, etc.  This enables
 * you to define an order of execution in which the services geocode a specific value.
 * @package Geocoder
 */

class fsGeocoder {
	
	private $services = null;
	private $debug = false;
	
	/**
	 * Constructs the object with an option to turn on DEBUG mode
	 *
	 * @param boolean $debug
	 */
	public function __construct($debug = false) {
		$this->services = array();
		$this->debug = $debug;
	}
	
	/**
	 * Enables you to add a defined Geocoding service to the engine.  
	 *
	 * @param fsGeocodeService $service
	 */
	public function addService(fsGeocodeService $service) {
		$service->setDebug($this->debug);
		$this->services[sizeof($this->services)] = $service;
	}
	
	/**
	 * This function will accept a geocodeValue as an argument and will then iterate 
	 * through the defined geocoding services and geocode that value.  Once the value has successfully
	 * been geocoded, the additional defined services (if applicable) will not be invoked.
	 *
	 * @param fsGeocodeValue $value
	 * @return fsGeocodeReponse
	 */
	public function geocodeValue(fsGeocodeValue $value) {
		for ($i = 0; $i < sizeof($this->services); $i++) {
			//if ($this->debug) {
				echo "DEBUG:  Attempting to geocode with the " . $this->services[$i]->getServiceName() . " service ";
			//}
			try {
				$resp = $this->services[$i]->geocodeValue($value);
				return $resp;
			} catch (fsGeocoderException $e) {
				if ($this->debug) {
					echo "DEBUG: " . $e->getMessage();
				}
			}
		}
	}
}
?>