<?php
define('_FSTLIB',true);
define('FST_LIB_PATH','C:\dev\workspaces\swibl\JLeague4\frontend\lib\\');


// echo dirname(__FILE__);
// exit;

include_once('../core/filter.php');
$email = "cs1559@sbcglobal.net/**/";
echo "-- " . fsFilter::filterEmail($email);



exit;


//include_once('../google/shorturl.php');
include_once('../google/googleservice.php');
// include_once('../document/document.html.php');
// include_once('../document/renderer.html.php');
// include_once('../document/defaultlayout.php');
// include_once('../core/view.php');
// include_once('../core/template.php');

/*
$tmpldir = dirname(__FILE__) . "\\templates\\";

$view = new fsView($tmpldir);
$view->setTitle("Test View");
$tmpl1 = new fsTemplate("test1");
$view->addTemplate($tmpl1);

$tmpl2 = new fsTemplate("test2");
$tmpl2->setObject("testmsg","This is the test message");
$view->addTemplate($tmpl2);
$view->render();
exit;

$doc = new fsHtmlDocument();
$doc->setAuthor("Chris Strieter");
$doc->addJavascript("http://localhost/js/test.js");
$doc->addJavascript("http://localhost/js/jquery.js");
$doc->addStylesheet("http://localhost/css/default.css");
$doc->setLayout(new fsDefaultLayout());
fsHtmlDocumentRenderer::render($doc);
exit;
*/

$svc = &fsGoogleService::getInstance();
// $shortner = $svc->getUrlShortener();
// $shortName = $shortner->shorten("http://www.swibl-baseball.org/j15/index.php?option=com_jleague&controller=sponsors&task=click&cid=12");
// echo "SHORT NAME = " . $shortName . "\n" ;
$geocoder = $svc->getGeocoder();
//$response = $geocoder->geocode("1325 Schiller Ave, Edwardsville, IL 62025");
$response = $geocoder->geocode("8767 State Rte 4, Staunton IL");
print_r($response);
echo $response[lat] . "," . $response[lng]; 

// exit;
/*
Array
(
		[lng] => -89.9398919
		[lat] => 38.8150407
)
*/
// $key = 'AIzaSyCwyCTcCrYwCNM1rE-Fxbbxh2fqUbvBXPk';
// $googer = new GoogleURLAPI($key);

// // Test: Shorten a URL

