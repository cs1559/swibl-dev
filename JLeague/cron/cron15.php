<?php

/*
 *   Generate the standings
 */
echo "** BEGIN - Generating Standings";
$url = "http://swibl-baseball.org/v1/index.php?option=com_jleague&controller=batch&task=generateStandings&tmpl=component&format=raw";

$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$data = curl_exec($ch);
curl_close($ch);

echo $data;
echo "** END - Generating Standings ..";
die;
