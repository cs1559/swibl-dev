	<?php

/**
 * @version			$Id: address.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		SWIBL Mobile
 * @subpackage		Conrollers
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL
 */

defined( '_FSTLIB' ) or die( 'Restricted access' );

require_once(FST_LIB_CORE . 'controller.php');

class mController extends fsController {
	
	public $_routes = array(
			'displayStandings' => array( // Default controller
					'controller' => 'standings',
					'method' => 'viewStandings',
					'number' => '',
					'param' => ''
			),
			'viewTeams' => array( 
					'controller' => 'teams',
					'method' => 'viewTeams',
					'number' => '',
					'param' => ''
			),
			'viewProfile' => array(
					'controller' => 'teams',
					'method' => 'viewTeamProfile',
					'number' => '',
					'param' => ''
			),	
			'viewBulletinBoard' => array(
					'controller' => 'bulletins',
					'method' => 'viewBulletinBoard',
					'number' => '',
					'param' => ''
			),
			'viewTournaments' => array(
					'controller' => 'bulletins',
					'method' => 'viewCategory',
					'number' => '',
					'param' => array("catid" => 4)
			),			
			'viewTryouts' => array(
					'controller' => 'bulletins',
					'method' => 'viewCategory',
					'number' => '',
					'param' => array("catid" => 2)
			),			
			'error404' => array(
					'controller' => 'errors',
					'method' => 'error404'
			)
	);
	
	function run() {
		$app = & mFactory::getApp();
		$config = $app->getConfig();

		if (_APPDEBUG) {
			$app->writeDebug("Running application request");
		}
		
		
		// Get the REQUEST/RESPONSE object
		$req = &fsRequest::getInstance();
		
		if ($config->getPropertyValue("seo_enabled")) {
			if (_APPDEBUG) {
				$app->writeDebug("SEO Enabled - parsing route");
				$app->writeDebug("URI: " . $req->getUri());
			}
		}
		
	//	echo "Checking for path: " . $req->getPath();
	//	exit;
		
		$resp = &fsResponse::getInstance();
		$action = $req->getValue("action");
		
		/* Map the view parameter to one of the routes */
		if (isset($this->_routes[$action])) {
			$route = $this->_routes[$action];
			$req->addParameter("controller", $route["controller"]);
			$req->addParameter("task", $route["method"]);
			if ($action == "viewTournaments") {
				$params = $route["param"];
				if (is_array($params)) {
					foreach ($params as $key => $value) {
			
						if (_APPDEBUG) {
							$app->writeDebug("adding parameter: " . $key . " value: " . $value);
						}
						$req->addParameter($key, $value);
					}
				}
			}			
		}
		
		if (!$task = $req->getValue("task")) {
			$req->addParameter("task", "displayFrontPage");
		}
		
		
		$map = new JLRouteMap();
		try {
			
			$route = $map->findRoute($req->getPath());
			//echo "Route Found [" . $req->getPath() . " - " . $route->getMethod();
			$req->addParameter("controller", $route->getController());
			$req->addParameter("task", $route->getMethod());
			$params = $route->getQueryParameters();
			if (is_array($params)) {
				foreach ($params as $key => $value) {
					if (_APPDEBUG) {
						$app->writeDebug("adding parameter: " . $key . " value: " . $value);
					}
					$req->addParameter($key, $value);
				}
			}
		} catch (Exception $e) {
			if (_APPDEBUG) {
				$app->writeDebug("Route could not be found - using raw URL");
			}
		}
		
		
		
		if (!$task = $req->getValue("task")) {
			$req->addParameter("task", "displayFrontPage");
		}
		
		// if NO controller is defined as part of the request, this will execute the default method
		// otherwise, it will be dispatched to the appropriate controller
// 		if (!$controller = $req->getValue("controller")) {
// 			$content = $this->viewDefault();
// 			$resp->setBody($content);
// 		} else {		
	  			ob_start ();
	 			// Dispatch the request
	  			if (_APPDEBUG) {
	  				$app->writeDebug("Dispatching Request [QUERY: " . $req->getQueryParms()."]");
	  			}
				$dispatcher = new fsDispatcher();
				$dispatcher->dispatch($req, $resp);
				$content = ob_get_contents ();
				ob_end_clean ();
				
				$config = $app->getConfig();
				
				if (!FS_JOOMLA) {
					
					$tfolder = $config->getPropertyValue("template_folder");
					
					$doc = $app->getDocument();
					$doc->appendBody($content);
					
					if (file_exists($tfolder . "header.php")) {
						ob_start ();
						$view = new fsView($tfolder);
						$tmpl = new fsTemplate("header");
						$view->addTemplate($tmpl);
						$view->render();
						$content = ob_get_contents ();
						ob_end_clean ();
						$doc->setHeader($content);
					}
					
					if (file_exists($tfolder . "footer.php")) {
						ob_start ();
						$view = new fsView($tfolder);
						$tmpl = new fsTemplate("footer");
						$view->addTemplate($tmpl);
						$view->render();
						$content = ob_get_contents ();
						ob_end_clean ();
						$doc->setFooter($content);
					}
				}
// 			}

			if (!FS_JOOMLA) {
				$resp->setBody(fsHtmlDocumentRenderer::render($doc));		
			} else {
				if (_APPDEBUG) {
					$app->writeDebug("Execution complete");
				}
				ob_start ();
				
				/*
				$view = new fsView(APP_TEMPLATES_PATH);
				$tmpl = new fsTemplate("footer2");
				$tmpl->setObject("config",$config);
				$view->addTemplate($tmpl);
				$view->render();
				*/
				if (_APPDEBUG) {
					fsHtmlDocumentRenderer::outputDebugMessages($app->getDebugMessages());
				} 
				$debug = ob_get_contents ();
				ob_end_clean ();
				$resp->setBody($content . $debug);
			}
			
			

		if (_APPDEBUG) {
			$app->writeDebug("Execution complete");
		}
				
		// Output the response
		echo $resp;
	}

	function displayFrontPage() {
		
		$app = &mFactory::getApp();
		$app->redirect("index.php?option=com_jleague&action=viewTournaments&Itemid=459");
		
		/*
		$doc = $app->getDocument();
		$doc->setTitle("League Front Page");
		
		$req = &fsRequest::getInstance();

		if (_APPDEBUG) {
			$app->writeDebug("Executing displayFrontPage", true);
		}
		$config = $app->getConfig();
		$leagueid = $config->getLeagueId();

		$bsvc = &JLBulletinsService::getInstance();
		$bulletins = $bsvc->getLeagueBulletins(90,10);

		$view = new mStandingsView(APP_TEMPLATES_PATH);
		$tmpl = new fsTemplate("frontpage");
		$tmpl->setObject("bulletins",$bulletins);
		$view->addTemplate($tmpl);
		$view->render();
		*/		
	}

	function about() {
		$app = & mFactory::getApp();
		$config = $app->getConfig();
		$folder = $config->getPropertyValue("template_folder");
		$content = self::renderTemplate($folder, "about");
		echo $content;
	}
	
	function getPage() {
		$app = & mFactory::getApp();
		$config = $app->getConfig();
		$req = &fsRequest::getInstance();
		$page = $req->getValue("page");
		$folder = $config->getPropertyValue("template_folder");

		if (_APPDEBUG) {
			$app->writeDebug("PAGE: " . $page);
			$app->writeDebug("Template Folder: " . $folder);
		}
		
		$content = self::renderTemplate($folder, $page);
		
		echo $content;
		
	}
	
	private function viewDefault() { 
		$req = &fsRequest::getInstance();
		if (!$task = $req->getValue("task")) {
			$task = "displayFrontPage";
		}
		header('Location: index.php?controller=controller&task=' . $task);
		/*
		$app = & mFactory::getApp();
		$config = $app->getConfig();
		$req = &fsRequest::getInstance();
		$folder = $config->getPropertyValue("template_folder");
		$content = self::renderTemplate($folder, "home");
		echo $content;
		*/
// 		$homepage = file_get_contents(FST_BASE_PATH . DS . 'html' . DS . 'index.html');
// 		return $homepage;
	}
	
	private function renderTemplate($folder, $inName) {
		ob_start ();
		$view = new fsView($folder);
		$tmpl = new fsTemplate($inName);
		$view->addTemplate($tmpl);
		$view->render();
		$content = ob_get_contents ();
		ob_end_clean ();
		return $content;
	}

	
}  
