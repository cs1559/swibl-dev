<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

class JLHtmlDocument {

	function addStyleSheet($entry) {
		$doc = &JFactory::getDocument();
		$doc->addCustomTag("<link type=\"text/css\" href=\"" . $entry . "\" rel=\"stylesheet\"/>");
	}
}