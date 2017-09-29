<?php
/**
 * GeocodeValue Class File (abstract)
 * 
 * @version $Id: geocodevalue.class.php,v 1.2 2009/03/06 22:08:22 cs1559 Exp $ 
 * @package Geocoder
 * @author Chris Strieter
 * @copyright 2008 Firestorm Technologies, LLC.  All Rights Reserved
 * @filesource 
 * @license Commercial 
 */

/**
 * This class composes all of the data attributes (i.e. address information) used for 
 * geocoding an address into latitude/longitude.  The class provides a helper function
 * that concatenates all of the values into a string that gets passed to a geocoding
 * service.
 * @package Geocoder
 */

class fsGeocodeValue {
	
	private $address1 = null;
	private $address2 = null;
	private $city = null;
	private $state = null;
	private $zipcode = null;
	private $country = null;
	private $urlencode = true;
	private $valid = false;
	
	/**
	 * Constructor.  An argument may be passed to prevent urlencoding when returning its 
	 * value.  By default, all values will be encoded.
	 *
	 * @param boolean $urlencode
	 */
	public function __construct($urlencode=true) {
		$this->urlencode = $urlencode;
	}
	/**
	 * Sets the first address value
	 *
	 * @param string $addr1
	 */
	public function setAddress1($addr1) {
		$this->address1=$addr1;
		if ($addr1 != null)
			$this->valid = true;
	}
	
	/**
	 * Sets the second address value
	 *
	 * @param string $addr2
	 */
	public function setAddress2($addr2) {
		$this->address2=$addr2;
		if ($addr2 != null)
			$this->valid = true;		
	}
	
	/**
	 * Sets the city
	 *
	 * @param string $city
	 */
	public function setCity($city) {
		$this->city = $city;
		if ($city != null)
			$this->valid = true;		
	}
	
	/**
	 * Sets the State value
	 *
	 * @param string $state
	 */
	public function setState($state) {
		
		$this->state = $state;
		if ($state != null)		
			$this->valid = true;		
	}
	/**
	 * Sets the zipcode values
	 *
	 * @param string $zipcode
	 */
	public function setZipcode($zipcode) {
		$this->zipcode = $zipcode;
		if ($zipcode != null)
			$this->valid = true;		
	}
	
	/**
	 * Sets the country value.
	 *
	 * @param string $country
	 */
	public function setCountry($country) {
		$this->country = $country;
		if ($country != null)
			$this->valid = true;		
	}
	
	public function isValid() {
		return $this->valid;
	}
	/**
	 * Returns the concatenated value that is used by the geocoding service.  The order
	 * is address1, address2, city, state, zipcode and then country.  The return value
	 * will be encoded (by default).  
	 *
	 * @return string
	 */
	public function getValue() {
	
		$addr = $this->address1 . " " . $this->address2 . " " .
				$this->city . " " . $this->state . " " . $this->zipcode . " " . $this->country;		
		if ($this->urlencode) {
			return urlencode($addr);
		} else {
			return $addr;
		}
	}
	
}

?>