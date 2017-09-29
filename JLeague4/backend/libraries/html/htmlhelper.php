<?php


include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'textarea.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'link.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'input.php');

/**
 * The fsHtml class is a helper/factory class used for rendering or generating the 
 * HTML elements.
 *
 */
class fsHtmlHelper {
	
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
	static function getTextAreaElement($name, $value, $rows=10, $cols=50) {
		if (strlen($value) < 1) {
			$value = "  ";
		}
		$obj1 = new fsTextAreaInput($name, $value, $rows, $cols);
		return $obj1->toHtml();
	}
	
	static function getMonthSelectList($element_name, $defaultvalue=null, $header=null, $class=null, $event=null) {
		include_once('select.php');
		$obj = new fsSelectList($element_name, $default_value);
		$obj->setHeader($header);
		$obj->addOption("1", "January");
		$obj->addOption("2", "February");
		$obj->addOption("3", "March");
		$obj->addOption("4", "April");
		$obj->addOption("5", "May");
		$obj->addOption("6", "June");
		$obj->addOption("7", "July");
		$obj->addOption("8", "August");
		$obj->addOption("9", "September");
		$obj->addOption("10", "October");
		$obj->addOption("11", "November");
		$obj->addOption("12", "December");
		return $obj->toHtml();
	}

	function getYesNoSelectList($name, $default_value=null) {
		include_once('select.php');
		$obj = new fsSelectList($name, $default_value);
		$obj->addOption("0","No");
		$obj->addOption("1","Yes");
		return $obj->toHtml();
	}
	
	
	
}

?>