<?php

/**
 * @version		$Id: baseview.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	FST Framework
 * @subpackage	Core
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL
 */
// Disallow direct access to this file
defined('_FSTLIB') or die('Restricted access');

class fsAutoload
{
	public function __construct($class, $paths, $prefixes = array("fs")) {
		
		foreach ($prefixes as $prefix) {
			foreach ($paths as $path) {
				//$class = str_replace("_","/",$class);
				$classname = strtolower(substr($class,strlen($prefix)));
				$file = $path.$classname.'.php';
				if(file_exists($file)) {
					include_once($file);	
					//return;
				} 
				$file = $path.$classname.'.class.php';
				if(file_exists($file)) {
					include_once($file);
					//return;
				}			
			}
		}
	}
}