<?php

/**
 * Yahoo Geocoder Implementation Class File
 * 
 * @version $Id: hostipgeocodeservice.class.php,v 1.1 2009/05/24 15:16:30 cs1559 Exp $ 
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
class fsHostIpGeocodeService extends fsGeocodeService {

	/**
	 * Constructor that sets some of the internal variables.
	 *
	 */	
	public function __construct() {
		parent::__construct();
		$this->setServiceName("HostIP");
	
	}
		
	public function geocodeValue(fsGeocodeValue $value) {
		$url = 'http://api.hostip.info/get_html.php?ip='.$ip.'&position=true';
		if(ini_get("allow_url_fopen")) {
			$gm=@fopen("$url",'r');
			$fp=@fread($gm,30000);
			@fclose($gm);
		} else {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "$url");
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 	15);
			$fp= curl_exec($ch);
			curl_close($ch);
		}

		list($nada, $country, $city, $strLat, $strLon) = split(":", $fp);
		$hostLon = trim($strLon);
		$strLat = trim($strLat);
		$strLat = self::parseLatitude($strLat);
		$data = explode(":", $strLat);
		$hostLat = $data[0];
		
		$response = new fsGeocodeResponse(null);
		$response->setSource($this->getServiceName());

		if (($hostLat == 0.000000) || ($hostLon == 0.000000)) {
			return null;
		} else {
			$response->setLatitude($hostLat);
			$response->setLongitude($hostLon);
		}
		return $response;		
	}

	function parseLatitude($string) {
		for ($i=0;$i<strlen($string);$i++) {
			$chr = $string{$i};
			$ord = ord($chr);
			if ($ord<32 or $ord>126) {
				$chr = ":";
				$string{$i} = $chr;
			}
		}
		return $string;
	}
	
}

?>