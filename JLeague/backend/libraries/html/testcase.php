<?php
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'select.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'html.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'textarea.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'link.php');
include_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'input.php');


echo fsHtml::getTextArea("textarea1", "This is a test", 5, 60);
echo fsHtml::getLink("http://www.yahoo.com","Yahooooo!");
echo fsHtml::getInputElement("inputtext","Hello World","text", 75,75);

$obj = new fsSelectList("testelement");
$obj->setHeader("-- Select Option --");
$obj->setAttribute("class","input");
$obj->setAttribute("onChange","javascript:alert('hello world');");
$obj->addOption("test","Test Option");
$obj->addOption("test 1","Test Option 1", true);
$obj->addOption("test 2","Test Option 2");
echo $obj->toHtml();

$recipient = array("cs1559@sbcglobal.net","chris@swibl-baseball.org");
			foreach ($recipient as $to) {
				echo $to;
			}


?>