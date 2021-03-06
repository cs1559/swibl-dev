<?php


include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'textarea.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'link.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'input.php');

/**
 * The fsHtml class is a helper/factory class used for rendering or generating the 
 * HTML elements.
 *
 */
class fsHtml {
	
	static function getSelectList($name, array $options, $defaultvalue, $header, $class, $event) {
		include_once('select.php');
		$obj = new fsSelectList($name);
		foreach ($options as $option) {
			if ($option->getValue() == $defaultvalue) {
				$option->setSelected(true);
			}
			if ($option instanceof fsSelectOption ) {
				$obj->addOption($option->getValue(),
					$option->getText(),
					$option->isSelected(),
					$option->isDisalbed()
					);
			}
		}
		return $obj;
	}
	
	static function getInputElement($name, $value, $size=40, $maxlength=40) {
		$obj = new fsInput($name, $value, 'text', $size, $maxlength);
		return $obj->toHtml();
	}
	static function getHiddenInputElement($name, $value) {
		$obj = new fsInput($name, $value, 'hidden', 0,0);
		return $obj->toHtml();
	}
	static function getLink($url, $text=null, $name = null) {
		$obj = new fsLink($url, $text, $name);
		return $obj->toHtml();
	}
	static function getTextArea($name, $value, $rows=10, $cols=50) {
		$obj1 = new fsTextAreaInput($name, $value, $rows, $cols);
		return $obj1->toHtml();
	}
	
	static function getTextAreaElement($name, $value, $rows=10, $cols=50) {
		if (strlen($value) < 1) {
			$value = "  ";
		}
		$obj1 = new fsTextAreaInput($name, $value, $rows, $cols);
		return $obj1->toHtml();
	}
	

	
	
	
}

?>