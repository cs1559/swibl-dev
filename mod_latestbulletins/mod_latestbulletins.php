<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

if (!defined('_APPEXEC')) {
	define('_APPEXEC',true);
	include_once(JPATH_SITE.'/components/com_jleague/defines.php');
	include_once(JPATH_SITE.'/components/com_jleague/bootstrap.php');
}

define('MODULE_TEMPLATE_PATH',dirname(__FILE__) . DS . "tmpl" . DS);

$days = $params->get('days',90);
$itemsToDisplay = $params->get('itemsToDisplay',10);

//	error_reporting(E_ALL);

	$app = &mFactory::getApp();
	$config = $app->getConfig();
	$doc = $app->getDocument();
	$doc->addStylesheet(JURI::base().DS.'modules'.DS.'mod_latestbulletins'.DS.'css'.DS.'latestbulletins.css');
	
	$leagueid = $config->getLeagueId();

	$bsvc = &JLBulletinsService::getInstance();
	$bulletins = $bsvc->getLeagueBulletins($days,$itemsToDisplay);
	
	$url = mRouter::translateUrl("index.php?option=com_jleague&action=viewBulletinBoard");

 	$view = new fsView(MODULE_TEMPLATE_PATH);
 	
 	//echo "adding stylesheet = " . dirname(__FILE__).DS.'css'.DS.'latestbulletins.css';
	$tmpl = new fsTemplate("latestbulletins");
	$tmpl->setObject("bulletins",$bulletins);
	$tmpl->setObject("bulletinboardUrl", $url);
//	echo $tmpl->getContent();
	
 	$view->addTemplate($tmpl);
 	$view->render();	
		
?>


