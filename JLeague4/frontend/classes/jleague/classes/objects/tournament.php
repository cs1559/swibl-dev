<?php

/**
 * @version		$Id: tournament.php 417 2012-02-19 17:13:59Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

//require_once(FSTCORE_OBJECTS_PATH . DS . 'baseobject.class.php');

class JTTournament extends JLBaseObject {
	
	var $id = null;
	var $ownerid = null;
	var $type = null;
	var $ptype = null;
	var $product = null;
	var $name = null;
	var $desc = null;
	var $start_date = null;
	var $end_date = null;
	var $cost = null;
	var $contactname = null;
	var $contactphone = null;
	var $contactemail = null;
	var $locationaddress = null;
	var $locationcity = null;
	var $locationstate = null;
	var $locationzipcode = null;
	var $latitude = null;
	var $longitude = null;
	var $hits = null;
	var $events;

	function __construct() {
		parent::__construct();
		$this->events = array();
	}
		
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getOwnerid() {
		return $this->ownerid;
	}
	public function setOwnerid($ownerid) {
		$this->ownerid = $ownerid;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
	}
	public function getProductType() {
		return $this->ptype;
	}
	public function setProductType($ptype) {
		$this->ptype = $ptype;
	}
	public function getProduct() {
		return $this->product;
	}
	public function setProduct(JTProduct $prod) {
		$this->product = $prod;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getDescription() {
		return $this->desc;
	}
	public function setDescription($desc) {
		$this->desc = $desc;
	}
	public function getContactName() {
		return $this->contactname;
	}
	public function setContactName($cname) {
		$this->contactname = $cname;
	}
	public function getContactPhone() {
		return $this->contactphone;
	}
	public function setContactPhone($phone) {
		$this->contactphone = $phone;
	}
	public function getContactEmail() {
		return $this->contactemail;
	}
	public function setContactEmail($email) {
		$this->contactemail = $email;
	}
	public function getStartDate() {
		return $this->start_date;
	}
	public function setStartDate($sdate) {
		$this->start_date = $sdate;
	}
	public function getEndDate() {
		return $this->end_date;
	}
	public function setEndDate($edate) {
		$this->end_date = $edate;
	}
	public function getCost() {
		return $this->cost;
	}
	public function setCost($cost) {
		$this->cost = $cost;
	}
	public function getLocationAddress() {
		return $this->locationaddress;
	}
	public function setLocationAddress($addr) {
		$this->locationaddress = $addr;
	}
	public function getLocationCity() {
		return $this->locationcity;
	}
	public function setLocationCity($city) {
		$this->locationcity = $city;
	}
	public function getLocationState() {
		return $this->locationstate;
	}
	public function setLocationState($state) {
		$this->locationstate = $state;
	}
	public function getLocationZipcode() {
		return $this->locationzipcode;
	}
	public function setLocationZipcode($zipcode) {
		$this->locationzipcode = $zipcode;
	}
	public function getLatitude() {
		return $this->latitude;
	}
	public function setLatitude($lat) {
		$this->latitude = $lat;
	}
	public function getLongitude() {
		return $this->longitude;
	}
	public function setLongitude($lng) {
		$this->longitude = $lng;
	}
	public function getHits() {
		return $this->hits;
	}
	public function setHits($hits) {
		$this->hits = $hits;
	}
	
	public function getEvents() {
		return $this->events;
	}
	
	public function addEvent(JTEvent $event) {
		$this->events[] = $event;
	}
}

?>