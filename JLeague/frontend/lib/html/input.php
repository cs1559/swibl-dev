<?php

include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'htmlelement.php');

class fsInput extends fsHtmlElement {
	
	var $hidden = false;
	
	/**
	 * Input Contructor.
	 *
	 * @param String $name
	 * @param String $value
	 * @param String $text
	 * @param int $size
	 * @param int $maxlength
	 */
	public function __construct($name, $value, $type='text', $size=40, $maxlength=40) {
		$this->setTagName("input");
		$this->setId($name);
		$this->setName($name);
		$this->setAttribute("type",$type);
		$this->setAttribute("value",$value);
		$this->setAttribute("size",$size);
		$this->setAttribute("maxlenght", $maxlength);
		$this->hidden = false;
	}
		
	function setHidden(boolean $bool) {
		$this->hidden = $bool;
	}
	
	function toHtml() {
		if ($this->hidden) {
			$this->setAttribute("type","hidden");
		} 
		return parent::toHtml();
	}
}

?>