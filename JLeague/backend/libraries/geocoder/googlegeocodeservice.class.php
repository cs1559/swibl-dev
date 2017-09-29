<?php

/**
 * Google Geocoder Implementation Class File
 * 
 * @version $Id: googlegeocodeservice.class.php,v 1.1 2009/01/22 11:42:59 cs1559 Exp $ 
 * @package Geocoder
 * @author Chris Strieter
 * @copyright 2008 Firestorm Technologies, LLC.  All Rights Reserved
 * @filesource 
 * @license Commercial 
 */

/**
 *  GeocodeService Definition 
 */
require_once('geocodeservice.class.php');

/**
 * This is an implementation of the geocoding service for Google.  This class will require
 * the Geocoder configuration to contain a value for <b>google.key</b>
 * @package Geocoder
 */

class fsGoogleGeocodeService extends fsGeocodeService {
	
	private $googleurl = 'http://maps.google.com/maps/geo';
	private $googlekey = '';

	/**
	 * Constructor that sets some of the internal variables.
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->setServiceName("Google");
		$this->googlekey = $this->getProperty("google.key");
	}
	
	/**
	 * This is the actual implementation to call the Google geocoding service.
	 *
	 * @param fsGeocodeValue $value
	 * @return fsGeocodeResponse
	 * @exception fsGeocoderException
	 */
	public function geocodeValue(fsGeocodeValue $value) {
		
		$tmp = $this->sendRequest($this->googleurl.'?q=' . $value->getValue() .'&key='.$this->googlekey. '&output=csv');
		$tmpcoords = explode(',',$tmp);
		list($status,$accuracy,$lat,$lng) = $tmpcoords;
		if ($status != 200) {
			throw new fsGeocoderException("Google Geocode Service did not find a response");
		} else {
			$response = new fsGeocodeResponse(null);
			$response->setSource($this->getServiceName());
			$response->setLatitude($lat);
			$response->setLongitude($lng);
			$response->setStatusCode($status);
		}
		return $response;
				
	}
}
?>