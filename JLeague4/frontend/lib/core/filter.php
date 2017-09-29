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


/**
 * The fsFilter is a class to filter/sanitize data input
 *
 */
class fsFilter {

	function filterString($input) {
	
	}
	
	/**
		Filter/Sanitize Email address
	*/
	function filterEmail($email) {
		if (isset($email)) {
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Email is valid";
		} else {
			echo "Email is invalid";
		}
		return $email;
	}
}