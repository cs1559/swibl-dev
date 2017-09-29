<?php
/**
 * @version		$Id: fieldrenderer.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

class FSTFieldRenderer {

	/**
	 * This funciton is the public interface for rendering a custom field.
	 *
	 */
	public function render(JLField $fld) {
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
	private function renderInputTag($fld) {
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
		require_once(JLEAGUE_CLASSES_PATH . DS . 'helpers' . DS . 'html.php');
		return JLHtml::getClassification($fld->getKeycode(),$fld->getValue());
	}
}
?>