<?php
/**
 * @version		$Id: players.php 102 2010-03-28 11:45:02Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Controllers
 * @copyright 	(C) 2008,2009 Chris Strieter
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 *
 */

// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');

class mSponsors  extends mBaseController {

	function __construct() {
		parent::__construct();
	}

	/**
	 * This function will display the registration form and enable the user to enter the appropriate
	 * data to submit their registration.
	 *
	 */
	public function click() {

		$app = mApp::getInstance();
		
		if (isset($_REQUEST["cid"])) {
			$campaignid = $_REQUEST["cid"];
			$ssvc = & JLSponsorService::getInstance();
			$url = $ssvc->clickThru($campaignid);
			$app->redirect($url);
			
		} else {
			echo "ERROR:  Invalid Campaign ID";
			return;
		}
		
	}	
	
	/**
	 * This function will render the Sponsors profile page
	 */
	public function profile() {
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$req = &fsRequest::getInstance();
			
		$id = $req->getValue("id");
		if ($id == null) {
			echo "Missing Sponsor ID";
		}
		
		//@TODO:  Add Security Check
			
		$svc = &JLSponsorService::getInstance();
		
		try {
			$sponsor = $svc->getRow($id);
		} catch (Exception $e) {
			print_r($e);
		}
			
		if (!$sponsor->isActive()) {
			echo "ERROR:  Sponsor is unknown";
			return;
		}
		
		$doc = $app->getDocument();
		$doc->setTitle("SWIBL - " . $sponsor->getName() . " Profile");
// 		$doc->addScript("http://maps.googleapis.com/maps/api/js?key=AIzaSyAX7_btMPYXh7xSWrgPBCEbVkkF3SWkp5Q&sensor=false&extension=.js&output=embed");
// 		$doc->addScript("components/com_jleague/assets/js/gmaphelper.js");

		/* Build Map Object */
		$map = new fsMap();
		$svc = &fsGoogleService::getInstance();
		$geocoder = $svc->getGeocoder();
		$response = $geocoder->geocode($sponsor->getAddress1() . ", " . $sponsor->getAddress2() . ", " . $sponsor->getCity() . ", " . $sponsor->getZipcode());
		if (isset($response)) {
			$map->setCenter($response["lat"], $response["lng"]);
		}
		$map->addProperty(fsMap::$ZOOM_KEY, 16);

		$marker = new fsMarker();
		$marker->setId($sponsor->getId());
		$marker->setTitle($sponsor->getName());
		$marker->setLatitude($response["lat"]);
		$marker->setLongitude($response["lng"]);
		$map->addMarker($marker);
		
		$generator = new fsMapGenerator();
		$code= $generator->renderJS($map);
		$doc->addScriptDeclaration($code);
		
		/* Create the view */
		$view = new mSponsorView(APP_TEMPLATES_PATH);
		
		//if ($ssvc->canEditSponsorProfile($sponsor)) {
		//$submenu = $view->getSponsorMenu("sponsorprofile_menu", "", "input-block-level center-block", $sponsor->getId());
		//} else {
		//$submenu = null;
		//}
				
		$ssvc = JLSecurityService::getInstance();
		$editable = $ssvc->canEditSponsorPage($sponsor);
		
		$tmpl = new fsTemplate("sponsor.profile");
		$tmpl->setObject("sponsor",$sponsor);
		$tmpl->setObject("config", $config);
		$tmpl->setObject("editable", $editable);
		$tmpl->setObject("submenu",$submenu);
		$view->addTemplate($tmpl);
		$view->render();
	}
	
	/**
	 *  This fucntion will display a list of sponsors
	 */
	public function display() {
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$req = &fsRequest::getInstance();
			
		$svc = &JLSponsorService::getInstance();
		
		try {
			$sponsors = $svc->getRows();
		} catch (Exception $e) {
		}
		
		$doc = $app->getDocument();
		$doc->setTitle("SWIBL - League Sponsors");
		
		$view = new fsView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("sponsor.list");
		$tmpl->setObject("sponsors",$sponsors);
		$tmpl->setObject("config", $config);
		$view->addTemplate($tmpl);
		$view->render();		
	}
	
	/**
	 * Add Content
	 * 
	 */
	public function content() {
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$doc = $app->getDocument();
		$doc->setTitle("SWIBL - League Sponsors");
		
		$editor = &JFactory::getEditor();
		// parameters : areaname, content, hidden field, width, height, rows, cols
		//public function display($name, $html, $width, $height, $col, $row, $buttons = true, $id = null, $asset = null, $author = null, $params = array())
		//htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8')
		
		$desc = $editor->display( 'description', "", '200', '175', '10', '10', false ) ;
		
		$view = new fsView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("sponsor.add.content");
		$tmpl->setObject("desc",$desc);
		$tmpl->setObject("sponsors",$sponsors);
		$tmpl->setObject("config", $config);
		$view->addTemplate($tmpl);
		$view->render();
	}

	
	function manageBulletins() {

		$app = &mFactory::getApp();
		$config = $app->getConfig();
		$ssvc = &JLSecurityService::getInstance();
	
		$editor = &JFactory::getEditor();
	
		$req = &fsRequest::getInstance();
			
		$id = $req->getValue("id");
		if ($id == null) {
			echo "Missing Sponsor ID";
		}
		
		$svc = &JLSponsorService::getInstance();
		try {
			$sponsor = $svc->getRow($id);
		} catch (Exception $e) {
			print_r($e);
			return;
		}
		$bsvc = &JLBulletinsService::getInstance();
		$bulletins = $bsvc->getSponsorBulletins($id);
	
		$view = new mTeamView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("sponsor.bulletins");
		$tmpl->setObject("sponsor", $sponsor);
		$tmpl->setObject("editor",$editor);
		$ttmpl = new fsTemplate("sponsor.bulletins.table");
		$ttmpl->setAlias("bulletinstable");
		$ttmpl->setObject("bulletins", $bulletins);
		$tmpl->addTemplate($ttmpl);
		$view->addTemplate($tmpl);
		$view->render();
	}

}