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

class mVenues  extends fsController {

	function __construct() {
		parent::__construct();
	}


	
	/**
	 * This function will render the Sponsors profile page
	 */
	public function viewMap() {
		$app = mFactory::getApp();
		$config = $app->getConfig();
			
		$req = &fsRequest::getInstance();
			
		$doc = $app->getDocument();
		$doc->setTitle("SWIBL - Venue/Field Map");
// 		$doc->addScript("http://maps.googleapis.com/maps/api/js?key=AIzaSyAX7_btMPYXh7xSWrgPBCEbVkkF3SWkp5Q&sensor=false&extension=.js&output=embed");
// 		$doc->addScript("components/com_jleague/assets/js/gmaphelper.js");

		/* Build Map Object */
		$map = new fsMap();
		$svc = &fsGoogleService::getInstance();
		$geocoder = $svc->getGeocoder();
		$response = $geocoder->geocode("Edwardsville, IL");
		if (isset($response)) {
			$map->setCenter($response["lat"], $response["lng"]);
		}
		$map->addProperty(fsMap::$ZOOM_KEY, 16);

		$marker = new fsMarker();
		$marker->setId(0);
		$marker->setTitle("Edwardsville, IL");
		$marker->setLatitude($response["lat"]);
		$marker->setLongitude($response["lng"]);
		
		$map->addMarker($marker);
		
		$generator = new fsMapGenerator();
		$code= $generator->renderJS($map);
		$doc->addScriptDeclaration($code);
		
		/* Create the view */
		$view = new mSponsorView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("venues.map");
		$tmpl->setObject("config", $config);
		$view->addTemplate($tmpl);
		$view->render();
	}
	
}