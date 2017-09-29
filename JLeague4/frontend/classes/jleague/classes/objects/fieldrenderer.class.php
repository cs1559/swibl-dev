<?php
/**
 * @version		$Id: fieldrenderer.class.php 468 2013-01-19 11:29:37Z cs1559 $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class JLFieldRenderer {

	/**
	 * This funciton is the public interface for rendering a custom field.
	 *
	 */
	public function render(JLField $fld) {
		require_once(JLEAGUE_SERVICES_PATH . DS . 'securityservice.class.php');
		$ssvc = & JLSecurityService::getInstance();
		if ($ssvc->isAdmin()) {
			$fld->setEditable(true);
		}
		switch ($fld->getType()) {
			case "1":
				return self::renderInputTag($fld);
				break;
			case "500":
				return self::renderClassificationList($fld);
				break;
				
			default:
				return "ERROR:  Renderer unavailable";
		}
	}
	
	/**
	 * This function will render a generic input tag
	 *
	 * @param unknown_type $fld
	 * @return unknown
	 */
	private function renderInputTag(JLField $fld) {
		if (!$fld->isEditable()) {
			return self::renderHiddenInput($fld);
		}
		$size = $fld->getPropertyValue('size');
		$length = $fld->getPropertyValue('maxlength');
		if (!strlen($size) > 0) {
			$size = 30;
		}
		if (!strlen($length) > 0) {
			$length = 30;
		}
		return "<input name='".$fld->getKeycode()."' value='".$fld->getValue()."' size='".$size."' maxlength='".$length."'/>";		
	}
	
	/**
	 * 
	 */
	private function renderClassificationList($fld) {
		if (!$fld->isEditable()) {
			return self::renderHiddenInput($fld);
		}
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
		return JLHtml::getClassification($fld->getKeycode(),$fld->getValue());
	}
	
	private function renderHiddenInput(JLField $fld) {
		return "<input type='hidden' name='".$fld->getKeycode()."' value='".$fld->getValue()."' />" . $fld->getValue();
	}
}
?>