<?php

/**
 * Yahoo Geocoder Implementation Class File
 * 
 * @version $Id: yahoogeocodeservice.class.php,v 1.2 2009/03/14 14:39:10 cs1559 Exp $ 
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
 * This is an implementation of the geocoding service for Yahoo.  This class will require
 * the Geocoder configuration to contain a value for <b>yahoo.appid</b>
 * @package Geocoder
 */
class fsYahooGeocodeService extends fsGeocodeService {
	
	private $yahoourl = 'http://api.local.yahoo.com/MapsService/V1/geocode?appid=';
	private $appid = null;
	private $debug = false;
	
	/**
	 * Constructor that sets some of the internal variables.
	 *
	 */	
	public function __construct() {
		parent::__construct();
		$this->setServiceName("Yahoo");
		$this->appid = $this->getProperty("yahoo.appid");		
	}
	
	/**
	 * This is the actual implementation to call the Yahoo geocoding service.
	 *
	 * @param fsGeocodeValue $value
	 * @return fsGeocodeResponse
	 * @exception fsGeocoderException
	 */	
	public function geocodeValue(fsGeocodeValue $value) {
		if ($this->debug) {
			echo "DEBUG:  geocoding using Yahoo" . "<br/>";;
			echo "DEBUG:  address = " . $loc . "<br/>";
		}
		$tmp = $this->sendRequest($this->yahoourl.$this->appid.'&location='.$value->getValue());
		$parser = xml_parser_create();
		xml_parse_into_struct($parser, $tmp, $vals, $index);
		xml_parser_free($parser);
		$response = new fsGeocodeResponse(null);
		$response->setSource($this->getServiceName());
		if (sizeof($vals)>0) {
			var_dump($vals);
			$response->setLatitude($vals[2]["value"]);
			$response->setLongitude($vals[3]["value"]);
		} else {
			return null;
			//throw new fsGeocoderException("Unable to geocode");
		}
		return $response;
	}
}
?>