<?php

/**
 * @version 		$Id: util.php 468 2013-01-19 11:29:37Z cs1559 $
 * @package 		JLeague
 * @subpackage 		Helpers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * JLUtil is a generic Utility class.
 *
 */
class JLUtil {
	
	
	function isCrawler() {
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		$crawlers = 'Google|msnbot|Rambler|bingbot|Baiduspider|Yahoo|AbachoBOT|accoona|' .
			'AcioRobot|ASPSeek|CocoCrawler|Dumbot|FAST-WebCrawler|' .
			'GeonaBot|Gigabot|Lycos|MSRBOT|Scooter|AltaVista|IDBot|eStyle|Scrubby';
		$isCrawler = (preg_match("/$crawlers/", $userAgent) > 0);
		return $isCrawler;
	}
	
	/**
	 * A Helper function that will utilize built-in Joomla funcitonality to retrieve a parameter
	 * from the HTTP Request object.  The idea is to abstract any Joomla functionality from the core
	 * extension and isolate any Joomla dependencies.
	 *
	 * @param string $parm
	 * @param string $default_value
	 * @param string $allowhtml
	 * @return string
	 * @deprecated 
	 */
	function getRequestParam($parm, $default_value = '', $allowhtml='') {
		//return JRequest::getVar($parm, $default_value,$allowhtml);	
		return fsRequest::getVar($parm, $default_value,$allowhtml);
	}
	
	/**
	 * A Helper function that will utilize built-in Joomla funcitonality to retrieve a parameter array
	 * from the HTTP Request object.  The idea is to abstract any Joomla functionality from the core
	 * extension and isolate any Joomla dependencies.
	 *
	 * @param string $parm
	 * @param string $default_value
	 * @param string $allowhtml
	 * @return array
	 */
	function getArrayRequestParam($parm, $default_value = '', $allowhtml='') {
		//$c =  JRequest::getVar( $parm, array(0), 'request', 'array' );
		$c =  fsRequest::getVar( $parm, array(0), 'request', 'array' );
		return $c;
	}

	/**
	 * This is a helper function that is used by input views that require a date field.  This 
	 * function can be used to convert the date from MM/DD/YYYY to YYYY/MM/DD.  Dates should be
	 * converted to YYYY/MM/DD prior to updating MySQL.
	 * 
	 * Use "1" as the second argument if you wish to convert the MySQL value into MM/DD/YYYY
	 * Use "2" as the second argument to convert to YYYY/MM/DD prior to updating the database.
	 *
	 * @param string $date
	 * @param int $func
	 * @return string
	 */
	function dateconvert($date,$func) {
		if ($date == null)
			return null;	
       if ($func == 1){ //insert conversion
           list($month, $day, $year) = preg_split('/\/|-/', $date);
           $date = $year . "-" . $month . "-" . $day;
           return $date;
       }
       if ($func == 2){ //output conversion
           list($year, $month, $day) = preg_split('/[-.]/', $date);
           $date = "$month/$day/$year";
           return $date;
       }

	}
	
	function getUserName($uid)
	{
		// Initialize some variables
		$db = & JLApp::getDBO();
		$query = 'SELECT username FROM #__users WHERE id = ' . $db->Quote( $uid );
		$db->setQuery($query, 0, 1);
		return $db->loadResult();
	}

	/**
	 * Generates a random string of a given type and length.
	 *
	 * @param   string   a type of pool, or a string of characters to use as the pool
	 * @param   integer  length of string to return
	 * @return  string
	 *
	 * @tutorial  alnum    - alpha-numeric characters
	 * @tutorial  alpha    - alphabetical characters
	 * @tutorial  numeric  - digit characters, 0-9
	 * @tutorial  nozero   - digit characters, 1-9
	 * @tutorial  distinct - clearly distinct alpha-numeric characters
	 */
	//public static function random($type = 'alnum', $length = 8)
	public function getConfirmation($type = 'alnum', $length = 8)
	{
		$utf8 = FALSE;

		switch ($type)
		{
			case 'alnum':
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
			case 'alpha':
				$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
			case 'numeric':
				$pool = '0123456789';
			break;
			case 'nozero':
				$pool = '123456789';
			break;
			case 'distinct':
				$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
			break;
			default:
				$pool = (string) $type;
				$utf8 = ! utf8::is_ascii($pool);
			break;
		}

		$str = '';

		$pool_size = ($utf8 === TRUE) ? utf8::strlen($pool) : strlen($pool);

		for ($i = 0; $i < $length; $i++)
		{
			$str .= ($utf8 === TRUE)
				? utf8::substr($pool, mt_rand(0, $pool_size - 1), 1)
				:       substr($pool, mt_rand(0, $pool_size - 1), 1);
		}

		return $str;
	}
	
	
	/**
	 * Enter description here...
	 *
	 * @param String $mailfrom FROM Address
	 * @param String $fromname FROM Name	
	 * @param String $recipient Recipient
	 * @param String $subject Email Subject
	 * @param String $body Email Message
	 * @param String $mode Format 1=HTML
	 * @param String $cc Carbon Copy
	 * @param String $bcc Blind CC
	 * @param String $attachment
	 * @param String $replyto
	 * @param String $replytoname
	 */
	function sendMail($mailfrom, $fromname, $recipient, $subject, $body, $mode=1, $cc=null, $bcc=null, $attachment=null, $replyto=null, $replytoname=null ) {
		JUtility::sendMail($mailfrom, $fromname, $recipient, $subject, $body, $mode, $cc, $bcc);
	}
	
	
	function convertToYesNo($value) {
		if ($value) {
			return "Yes";
		} else {
			return "No";
		}
	}
}

?>