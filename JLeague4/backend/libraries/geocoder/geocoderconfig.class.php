<?php

/**
 * Geocoder Configuration Class File
 * 
 * @version $Id: geocoderconfig.class.php,v 1.1 2009/01/22 11:42:59 cs1559 Exp $ 
 * @package Geocoder
 * @author Chris Strieter
 * @copyright 2008 Firestorm Technologies, LLC. All Rights Reserved
 * @filesource 
 * @license Commercial 
 */

/**
 * The GeocoderConfig class is a container for properties that maybe required to utilize
 * specific geocoding services.  For instance, to use the Yahoo geocoder, you must have a
 * Yahoo App id.
 * 
 * <b>Example:</b><br/>
 * $config = fstGeocoderConfig::getInstance();<br/>
 * $config->setProperty("google.key"," .... ");<br/>
 * $config->setProperty("yahoo.appid"," .... ");  
 * @package Geocoder
 */


class fsGeocoderConfig {

	// $instance holds a single instance of the object
	private static $instance;
	private $properties = null;

	/**
	 *  Constructions the object and initializes an internal array of properties
	 */
	private function __construct() {
		$this->properties = array();
	}
	
	/**
	 * 	Returns an instance of the fsGeocoderConfig object.
	 * 
	 * @returns fsGeocoderConfig
	 */
	public static function getInstance(){
		if(!isset(self::$instance)){
			$object= __CLASS__;
			self::$instance=new $object;
		}
		return self::$instance;
	}
	
	/**
	 * Sets a property value 
	 *
	 * @param string $key
	 * @param object $value
	 */
	public function setProperty($key, $value) {
		$this->properties[$key] = $value;
	}
	/**
	 * Returns a property based on the key.  If the key does not exist, NULL will be returned.
	 *
	 * @param string $key
	 * @return object
	 */
	public function getProperty($key) {
		if (key_exists($key, $this->properties)) {
			return $this->properties[$key];
		} else {
			return null;
		}
	}
}

?>