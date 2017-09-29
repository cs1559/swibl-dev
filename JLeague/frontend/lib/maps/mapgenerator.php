<?php

defined('_FSTLIB') or die('Restricted access');

class fsMapGenerator {
	
	function renderJS(fsMap $map=null) {
		
		if (!isset($map)) {
			throw new Exception("No Map Defined/provided");
		}
		
		$codeJS = "
				

function initialize() {
  var mapOptions = {
    zoom: " . $map->getPropertyValue(fsMap::$ZOOM_KEY) . ",
    center: new google.maps.LatLng(" . $map->getPropertyValue(fsMap::$DEFAULT_CENTER_LATITUDE_KEY) . "," . $map->getPropertyValue(fsMap::$DEFAULT_CENTER_LONGITUDE_KEY) . ")
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions); "

    . $this->genMarkerCode($map) .	
    		
  "  		
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;
			
				";
		
		return $codeJS;
	}
	
	
	/**
	 * This function generates Javascript code to create the marker(s) and add it to a map.
	 * @param fsMap $map
	 * @return string
	 */
	private function genMarkerCode(fsMap $map) {
		/*
		 *         	  var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map, 
                title:address
        	  }); 
        	  
		 */
		$idx = 0;
		$markers = $map->getMarkers();
		foreach ($markers as $marker) {
			$idx++;
			$code =  "var marker_".$map->getId()."_".$idx." = new google.maps.Marker({";
			$code .= "   position: new google.maps.LatLng(" . $marker->getLatitude() . "," . $marker->getLongitude() . "),";
			$code .= "   map: map,";
			$code .= "   title: '" . $marker->getTitle() . "'";
			$code .= " });";
		}	
		return $code;	
	}
	
}