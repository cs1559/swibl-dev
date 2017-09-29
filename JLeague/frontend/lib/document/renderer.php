<?php


class fsDocumentRenderer {
	
	public static $_lineEnd = "\n";
	
	static function render() {
	
	}
	
	private function getLineEnd() {
		return self::$_lineEnd;
	}
	private function writeLine($txt) {
		echo $txt . self::getLineEnd();
	}
	
}