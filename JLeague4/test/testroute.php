<?php

$expires = new DateTime('NOW');
$expires->add(new DateInterval('PT01H'));

echo var_dump($expires);
exit;

if(!function_exists('hash_equals')) {
	function hash_equals($str1, $str2) {
		if(strlen($str1) != strlen($str2)) {
			return false;
		} else {
			$res = $str1 ^ $str2;
			$ret = 0;
			for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
			return !$ret;
		}
	}
}

function time_elapsed_B($secs){
	$bit = array(
			' year'        => $secs / 31556926 % 12,
			' week'        => $secs / 604800 % 52,
			' day'        => $secs / 86400 % 7,
			' hour'        => $secs / 3600 % 24,
			' minute'    => $secs / 60 % 60,
			' second'    => $secs % 60
	);
	 
	foreach($bit as $k => $v){
		if($v > 1)$ret[] = $v . $k . 's';
		if($v == 1)$ret[] = $v . $k;
	}
	array_splice($ret, count($ret)-1, 0, 'and');
	$ret[] = 'ago.';
	 
	return join(' ', $ret);
}

echo date("Y/m/d") . "\n";
// echo time() . "\n";



//1451835057
$nowtime = time();
$nowtime = 1451835000;
$starttime = 1451835057;
$endtime = $starttime + 36000;

$var = "&expiry=" . $endtime . "&adminOverride=1&teamid=555," . crypt("key=bas3!ball","sw1bl");
$evar = base64_encode($var);
$dvar = base64_decode($evar);

echo $evar;
echo "\n";
echo $dvar;
echo "\n";
$pwd=split(",", $dvar);
echo $pwd[1];
echo "\n";
$myToken = bin2hex(openssl_random_pseudo_bytes(24));

echo $myToken;
exit;


$expected = crypt("key=bas3!ball","sw1bl"); 
if (hash_equals($expected, $pwd[1])) {
	echo "its a match!\n";
}
		
		
if (($nowtime > $starttime) && ($nowtime < $endtime)) {
	echo "good to authorize\n";
} else {
	echo "not authorized\n";
}

die;


define('_FSTLIB',true);
define('_JEXEC', true);

include ('../frontend/lib/core/uri.php');
include ('../frontend/lib/core/baseobject.php');
include ('../frontend/lib/core/route.php');
include ('../frontend/classes/objects/route.php');
include ('../frontend/classes/objects/router.php');
include ('../frontend/classes/objects/routemap.php');


$url1 = fsURI::getInstance("http://swibl-baseball.org/j3/league/viewTournaments");

$url2 = fsURI::getInstance("http://swibl-baseball.org/j3/index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=355:Bethalo-Eagles");
$url3 = fsURI::getInstance("http://swibl-baseball.org/j3/index.php?option=com_jleague&task=displayStandings");

$urlx = "http://swibl-baseball.org/j3/league/viewTeamProfile/355:Bethalo-Eagles";
$urly = "http://swibl-baseball.org/j3/index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=355:Bethalo-Eagles";

//print_r($uri);


// Test building URL
$router = new mRouter();
$route = $router->match($urlx);
print_r($route);

exit;


echo "\n";
$newUrl = $router->translateUrl($urlx);
echo $newUrl;

exit;


//x`$url = mRouter::translateUrl($url3);
echo $url;
exit;


try {
	$route = $map->findRouteByUrl($url2);
	print_r($route);
} catch (Exception $e) {
	$route = $url2;
}

// Identify the route components
try {
	$route = $map->findRoute($url1->getPath());
} catch (Exception $e) {
	echo $e->getMessage();
}



//print_r($uri->getFragments());

exit;






$url = "http://swibl-baseball.org/j3/index.php?option=com_jleague&controller=batch&task=generateStandings&tmpl=component&format=raw";

	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);

	echo $data;
	echo "Done ..";
	die;


$url = "index.php?option=com_jleague&controller=teams&task=uploadLogo&teamid=333";
$date = "2014/01/01 03:00:23:00";
$dt = substr($date,0,10);

           list($year, $month, $day) = preg_split('/\/|-/', $dt);
           $date = $month . "/" . $day . "/" . $year;
echo $date;


exit;

$arr = explode("?",$url);






echo $url;
