<?php

include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'element.php');

class fsLink extends fsHtmlElement {
	
	/**
	 * Textarea Input Contructor.
	 *
	 * @param String $name
	 * @param int $rows
	 * @param int $cols
	 */
	public function __construct($value, $text=null, $name = null) {
		$this->setTagName("a");
		$this->setId($name);
		$this->setName($name);
		if ($text == null) {
			$text = $value;
		}
		$this->setContent($text);
		$this->setAttribute("href",$value);
	}

}

?>