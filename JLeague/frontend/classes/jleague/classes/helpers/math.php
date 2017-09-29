<?php

/**
 * @version 		$Id: math.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Helpers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * JLMath is a helper class that is used to perform calculations and perform formatting for numeric
 * values.
 *
 */
class JLMath {
	
	function format_number($str,$decimal_places='4',$decimal_padding="0"){
	       /* firstly format number and shorten any extra decimal places */
	       /* Note this will round off the number pre-format $str if you dont want this fucntionality */
	       $str          =  number_format($str,$decimal_places,'.','');    // will return 12345.67
	       $number      = explode('.',$str);
	       $number[1]    = (isset($number[1]))?$number[1]:''; // to fix the PHP Notice error if str does not contain a decimal placing.
	       $decimal    = str_pad($number[1],$decimal_places,$decimal_padding);
	       return (float) $number[0].'.'.$decimal;
	}
	
}

?>