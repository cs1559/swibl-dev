<?php

require_once('baseobject.class.php');

class FSTProduct extends FSTBaseObject {
	
	var $id = null;
	var $name = null;
	var $desc = null;
	var $featured = null;
	var $features = array();
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
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
	public function getFeatured() {
		return $this->featured;		
	}
	public function setFeatured($featured) {
		$this->featured = $featured;
	}
	public function setFeatures(array $features) {
		$this->features = $features;
	}
	public function addFeature(FSTFeature $feature) {
		// Check to see if the product already has the feature.
		if (!self::hasFeature($feature->getFeatureCode())) {
			$this->features[] = $feature;
		}
	}
	public function getFeatures() {
		return $this->features;
	}
	public function hasFeature($code) {
		foreach ($this->features as $feature) {
			if ($feature->getFeatureCode() == $code) {
				return true;
			}
		}
		return false;
	}
	public function getFeature($code) {
		foreach ($this->features as $feature) {
			if ($feature->getFeatureCode() == $code) {
				return $feature;
			}
		}
		throw new Exception ("Feature Not Found");
	}

}

?>