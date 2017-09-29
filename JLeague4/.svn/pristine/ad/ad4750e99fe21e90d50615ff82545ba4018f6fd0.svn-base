<?php

include_once('renderer.php');

class fsHtmlDocumentRenderer extends fsDocumentRenderer {
	
	static function render(fsHtmlDocument $doc)	 {
		$_content = "";
		ob_start();
		self::writeLine("<!DOCTYPE " . $doc->getType() . ">");
		self::writeLine("<html lang=\"en\">");
		
		// BEGIN - HEAD
		self::writeLine("<head>");
			self::writeLine("<title>"  . $doc->getTitle() . "</title>");
			if ($doc->getAuthor() != null) {
				self::writeLine("<meta name=\"author\" content=\"" . $doc->getAuthor() . "\">");		
			}
			self::writeLine("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">");
		
		$styles = $doc->getStylesheets();
		foreach ($styles as $style) {
			self::writeLine("<link href=\"" . $style . "\" rel=\"stylesheet\">");
		}
		$scripts = $doc->getJavascripts();
		foreach ($scripts as $script) {
			self::writeLine("<script src=\"" . $script . "\"></script>");
		}
		self::writeLine("</head>");
		// END - HEAD 
		
		// BEGIN - BODY
		self::writeLine("<body>");
		self::writeLine("<div class=\"container fs-content-wrapper\">");
		$layout = $doc->getLayout();
		
		if ($doc->getHeader() != null) {
			self::writeLine($doc->getHeader());
		}
		if ($doc->getBody()!= null) {
			self::writeLine($doc->getBody());
		}
		
		if ($doc->getFooter() != null) {
			self::writeLine($doc->getFooter());
		}
		self::outputDebug($doc);
		
		self::writeLine("</div>");
		self::writeLine("</body>");
		// END - BODY
		self::writeLine("</html>");
		$contenHTML = ob_get_contents ();
		ob_end_clean ();
		$_content .= $contenHTML;
		echo $_content;
	}
	
	private function outputDebug(fsDocument $doc) {
		if (_APPDEBUG) {
			$doc->addDebugMessage("End of Debug");
		}
		$msgs = $doc->getDebugMessages();
		self::writeLine("<div id='debug_messages'>");
		foreach ($msgs as $msg) {
			self::writeLine($msg);
		}
		
		self::writeLine("</div>");
	}
	
	static public function outputDebugMessages(array $msgs) {
		$req = fsRequest::getInstance();
		if ($req->getValue("nodebug")){
			return;
		}
		self::writeLine("<div id='debug_messages'>");
		foreach ($msgs as $msg) {
			self::writeLine($msg);
		}
		self::writeLine("</div>");
	}	
	private function getLineEnd() {
		return self::$_lineEnd;
	}
	private function writeLine($txt) {
		echo $txt . self::getLineEnd();
	}
	
}