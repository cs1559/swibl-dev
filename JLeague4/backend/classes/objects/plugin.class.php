<?php
/**
 * @version		$Id: plugin.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */
require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'baseobject.class.php');

abstract class JLPlugin extends JLBaseObject  {
	
	private $context  = null;
	
	abstract function init(array $context = null);

	abstract function exec();
	
	private function getContext() {
		return $this->context;
	}
	
}
?>