<?php
include_once('shorturl.php');
include_once('googleservice.php');

$svc = &fsGoogleService::getInstance();
echo $svc->getKey();
echo "Done";
exit;

$key = 'AIzaSyCwyCTcCrYwCNM1rE-Fxbbxh2fqUbvBXPk';
$googer = new GoogleURLAPI($key);

// Test: Shorten a URL
$shortDWName = $googer->shorten("http://swibl-baseball.org");
echo "SHORT NAME = " . $shortDWName;

