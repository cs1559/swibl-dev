<?php

/**
 * Geocoder - uses the Google Geocoding API v3. 
 */

include_once("googleapi.php");
include_once(FST_LIB_PATH . "interfaces/igeocoder.php");

class fsGoogleGeocoder extends fsGoogleApi implements iGeocoder {
	
	var $_apiURL = null;
	var $_key = null;

/**
 * Constructor that sets some of the internal variables.
 *
 */
public function __construct($key,$apiURL = 'http://maps.googleapis.com/maps/api/geocode/json') {
	$this->_key = $key;
	$this->_apiURL = $apiURL;
}

/**
 * This is the actual implementation to call the Google geocoding service.
 *
 * @param fsGeocodeValue $value
 * @return fsGeocodeResponse
 * @exception fsGeocoderException
 */
public function geocode($invalue) {
	$value =urlencode($invalue);
	$response = array();

	$_response = self::sendRequest($this->_apiURL .'?address=' . $value .'&sensor=false');

	if (isset($_response["results"][0]["geometry"]["location"]["lng"])) {
		$response["lng"] = 	$_response["results"][0]["geometry"]["location"]["lng"];
	}
	if (isset($_response["results"][0]["geometry"]["location"]["lat"])) {
		$response["lat"] = 	$_response["results"][0]["geometry"]["location"]["lat"];
	}	
	
	return $response;
}


}
?>