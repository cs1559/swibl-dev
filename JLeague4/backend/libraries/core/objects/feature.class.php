<?php

require_once('baseobject.class.php');

class FSTFeature extends FSTBaseObject {
	
//	var $id = null;
	var $name = null;
	var $desc = null;
	var $featurecode = null;
	
//	public function getId() {
//		return $this->id;
//	}
//	public function setId($id) {
//		$this->id = $id;
//	}
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
	public function getFeatureCode() {
		return $this->featurecode;		
	}
	public function setFeatureCode($code) {
		$this->featurecode = $code;
	}

}

?>