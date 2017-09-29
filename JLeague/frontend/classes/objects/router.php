<?php


class mRouter {
	
	/*
	 * 
	 * 	/:module/:task|:action/
	 * 
	 */
	
	/**
	 * This function will translate the URL based on the path. 
	 * @param unknown $url
	 * @return unknown
	 */
	static function translateUrl($url) {
		return $url;
// 		$app = &mFactory::getApp();
// 		$config = $app->getConfig();
// 		if ($config->getProperty('seo_enabled')) {
		$uri = fsURI::getInstance($url);
			try {
				$route = self::findPathByUrl($uri);
				return $route->getPath();
// 				$url = self::generate($route);
			} catch (Exception $e) {
				$route = $url;
			}
// 		}		
		return $url;
	}
	
	function match($url) {
		$uri = fsURI::getInstance($url);
		$path = $uri->getPath();
		echo "PATH=".$path;
		try {
			$route = self::findRoute($path);
		} catch (Exception $e) {
			// if we can't find the path, assume raw URL
			$route = self::findPathByUrl($uri);
		}
		return $route->getPath();
	}
	
	
	/**
	 * This function maps a URI path to a specific route
	 * @param unknown $path
	 * @throws Exception
	 * @return JLRoute
	 */
	public function findRoute($path) {
		$map = new JLRouteMap();
		$routes = $map->getRoutes();
		$entry = $this->array_multi_search($routes, $path);
		if (sizeof($entry) != 1) {
			throw new Exception("Cannot determine route.  More than ONE path found in map");
		}
		$route = new JLRoute($entry[0]);
		return $route;
	}
	

	public function findPathByUrl(fsURI $url, $key = "task") {
		$map = new JLRouteMap();
		$routes = $map->getRoutes();
		
		$parmKey = $url->getQueryParameter($key);
		$route = null;
		try {
			$entry = self::array_multi_search($routes, $parmKey);
			if (sizeof($entry) > 1) {
				throw new Exception("Cannot determine route.  More than ONE path found in map");
			}
			$route = new JLRoute($entry[0]);
			$route->setUri($url);
	
		} catch (Exception $e) {
			throw $e;
		}
		return $route;
	}	
	
	
	/**
	 * This function is the main driver to determine the correct URL string
	 * @param JLRoute $route
	 */
	function generate(JLRoute $route) {

	
		print_r($route);
		
		$rule = "rule_" . $route->getMethod();
		
// 		$val = self::$rule;	
		if (method_exists('mRouter', $rule)) {
			$cmd = '$val = mRouter::'.$rule . '($route);';
			eval($cmd);
			return $val;
		}

		return $url;
	}
	
	private function rule_viewTeamProfile(JLRoute $route) {
		return "http://swibl-baseball.org/index.php?controller=". $route->getController();
	}
	
	
	/*******************************
	 *   array_multi_search
	*
	*   @array  array to be searched
	*   @input  search string
	*
	*   @return array(s) that match
	******************************/
	function array_multi_search($array, $input){
		$iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));
		$outputArray = null;
		foreach($iterator as $id => $sub){
			$subArray = $iterator->getSubIterator();
			if(@strstr(strtolower($sub), strtolower($input))){
				$subArray = iterator_to_array($subArray);
				$outputArray[] = array_merge($subArray, array('Matched' => $id));
			}
		}
		if (is_null($outputArray)) {
			throw new Exception("Route could not be found in map");
			return;
		}
		return $outputArray;
	}
	
	
	
}
