<?php

include_once("googleapi.php");
include_once(FST_LIBRARY_PATH ."/interfaces/igeocoder.php");

class fsGoogleGeocoder extends fsGoogleApi implements iGeocoder {
	
	var $_apiURL = null;
	var $_key = null;

/**
 * Constructor that sets some of the internal variables.
 *
 */
public function __construct($key,$apiURL = 'http://maps.google.com/maps/geo') {
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

	$_response = self::sendRequest($this->_apiURL .'?q=' . $value .'&key='.$this->_key. '');
	if (isset($_response["Placemark"][0]["Point"]["coordinates"][0])) {
		$response["lng"] = 	$_response["Placemark"][0]["Point"]["coordinates"][0];
	}
	if (isset($_response["Placemark"][0]["Point"]["coordinates"][0])) {
		$response["lat"] = 	$_response["Placemark"][0]["Point"]["coordinates"][1];
	}	

	return $response;
}


}
?>