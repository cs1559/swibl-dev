<?php

include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'element.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'selectoption.php');

class fsSelectList extends fsHtmlElement {
	
	var $options;
	var $header = null;
	var $default_value = null;
	var $disabled = false;
	
	/**
	 * This is the constructor.
	 *
	 * @param String $name
	 */
	public function __construct($name, $default_value = null) {
		$this->setTagName("select");
		$this->options = array();	
		$this->setId($name);
		$this->setName($name);
		$this->setDefaultValue($default_value);
	}
	
	function setDefaultValue($val) {
		$this->default_value = $val;
	}
	function initOptions() {
		$this->options = array();
	}

	/**
	 * The addOption function will add a selectable option to the select list.
	 *
	 * @param string $value
	 * @param string $text
	 * @param boolean $selected
	 * @param boolean $disabled
	 */
	function addOption($value,$text, $selected = false, $disabled = false) {
		if ($value === $this->default_value) {
			$selected = true;
		} 
		$obj = fsSelectOption::create($value,$text,$selected,$disabled);
		$this->options[] = $obj;
	}

	/*
	static function createOption($value,$text, $selected = false, $disabled = false) {
		$obj = new stdClass();
		$obj->value = $value;
		$obj->text = $text;
		$obj->disabled = $disabled;
		$obj->selected = $selected;
		return $obj;
	}
	*/
	
	/**
	 * The setHeader function sets the text for a header that will appear at the top of the
	 * select list.
	 *
	 * @param String $text
	 */
	function setHeader($text) {
		$this->header = $text;
	}
	
	/**
	 * 
	 */
	function setDisabled() {
		$this->disabled = true;
	}
	/**
	 * The toHtml returns the actual HTML
	 *
	 * @return String
	 */
	function toHtml() {
		$le = $this->lineEnd;
		$this->setContent(" ");
		if ($this->disabled) {
			$this->setAttribute("disabled", null);
		}
		$html = $this->getStartTag() . $le;
		if ($this->header != null) {
			$html .= "<option value=\"\">" . $this->header . "</option>" . $le;
		}
		foreach ($this->options as $option) {			
				$html .= $option->toHtml() . $le;
		}
		$html .= "</select>" . $le;
		return $html;
	}
	
}

?>