<?php

/**
 * Map Class file.
 * 
 * @version $Id: map.class.php,v 1.21 2009/09/06 00:07:09 cs1559 Exp $ 
 * @author Chris Strieter
 * @copyright (c) 2008 Firestorm Technologies, LLC.  All Rights Reserved 
 * @package Maps
 * @filesource 
 * @license See license.html
*/

// Disallow direct access to this file
defined('_FSTLIB') or die('Restricted access');


/**
 * The Map object is the representation of the map itself.  It is used in the actual rendering
 * of the map.  It provides functionality to add/set specific properties (i.e. height, width,
 * maptyps, etc.) as well as various marker types. 
 * @package Maps  
 */

class fsMap extends fsBaseObject {
	
	public static $DEFAULT_CENTER_LATITUDE_KEY = "default_center_latitude";
	public static $DEFAULT_CENTER_LONGITUDE_KEY = "default_center_longitude";
	public static $ZOOM_KEY = "zoom";
	
	var $id = null;
	var $type = null;
	var $title = null;
	var $description = null;
	var $overlay1 = null;
	var $overlay2 = null;
	var $overlay3 = null;
	var $overlay4 = null;
	var $overlay5 = null;
	var $overlay6 = null;
	var $overlay7 = null;		
	var $markers = null;   //array
	var $published = null;
	var $edit = false;
	var $owner = null;
	var $lastupdate = null;
	var $lastupdatedby = null;
	var $access = null;
	var $hits = 0;
	var $categories = null;
	var $draggableCursor = 'default';
	var $draggingCursor = 'default';
	var $template;
	var $contentmap = false;
	
	/**
	 * Constructs the base map object and initializes default property value
	 *
	 */
	function __construct() {
// 		self::addProperty(gDOUBLECLICK,true);
// 		self::addProperty(gSHOWMAPTYPE,true);
// 		self::addProperty(gHEIGHT,"360px");
// 		self::addProperty(gWIDTH,"100%");
// 		self::addProperty(gMAPOVERVIEW,true);
// 		self::addProperty(gLOCALSEARCH,false);
// 		self::addProperty(gMAPTYPE,"Normal");
// 		self::addProperty(gTEMPLATE,null);
// 		self::addProperty(gZOOM,12);
// 		self::addProperty(gZOOMTYPE,"Large");
// 		self::addProperty(gAUTOOPENMARKER,0);
// 		self::addProperty(gAUTOLOADMARKERS,true);
		//self::addProperty(gINFOWINDOWEVENT,"click");
		$this->addProperty(self::$DEFAULT_CENTER_LATITUDE_KEY,39.739318);
		$this->addProperty(self::$DEFAULT_CENTER_LONGITUDE_KEY,-89.266507);
		$this->addProperty(self::$ZOOM_KEY, 12);
		//https://maps.google.com/maps?q=Family+Sports+Park,+O%27Fallon,+IL&hl=en&sll=39.739318,-89.266507&sspn=10.182689,21.643066&oq=ofallon+family+sports+park&t=h&z=16&iwloc=A
		$this->markers = array();
		$this->categories = array();
		$this->systemmap = false;
	}
	
	/**
	 * Sets the map id.
	 *
	 * @param int $inParm
	 */
 	function setId($inParm) {
 		$this->id = $inParm;
 	}
 	/**
 	 * Returns the map id
 	 *
 	 * @return int
 	 */
 	function getId() {
 		if ($this->id == null) {
 			return 0;
 		}
 		return $this->id;
 	}
 	
 	function setType($type) {
 		$this->type = $type;
 	}
 	function getType() {
 		return $this->type;
 	}
 	/**
 	 * Sets the Map Title
 	 *
 	 * @param string $inParm
 	 */
 	function setTitle($inParm) {
 		$this->title = $inParm;
 	}
 	/**
 	 * Returns the map title
 	 *
 	 * @return string
 	 */
 	function getTitle() {
 		return $this->title;
 	}
 	/**
 	 * Sets the map description
 	 *
 	 * @param string $inParm
 	 */ 	
 	function setDescription($inParm) {
 		$this->description = $inParm;
 	}
 	/**
 	 * Returns the maps description
 	 *
 	 * @return string
 	 */
 	function getDescription() {
 		return $this->description;
 	}
 	/**
 	 * Sets the array of markers for this specific map.
 	 *
 	 * @param array $inParm
 	 */  	
 	function setMarkers($inParm) {
 		unset($this->markers);
 		$this->markers = array();
 		foreach ($inParm as $i => $marker) {
 			$this->addMarker($marker);
 		}
 	}
 	/**
 	 * Returns an array of markers associated with the map.
 	 *
 	 * @return array
 	 */
 	function getMarkers() {
 		return $this->markers;
 	}
 	function getMarkerCount() {
 		return count($this->markers);
 	}
 	/**
 	 * Returns a specific marker object associated with the map.
 	 *
 	 * @param int $idx
 	 * @return fsMarker
 	 */
 	function getMarker($idx) {
 		$marker = $this->markers[$idx];
 		return $marker;
 	}
 	/**
 	 * This is a helper function that returns an array of all overlay maps
 	 */
 	function getOverlays() {
 		$tmp = null;
 		$tmp = self::getOverlay1() . "," . self::getOverlay2() . "," . self::getOverlay3() . "," . self::getOverlay4()
 			. "," . self::getOverlay5() . "," . self::getOverlay6() . "," . self::getOverlay7();
 		$arr = explode(",",$tmp);
 		return $arr;	
 	}
 	/**
 	 * Sets the first map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	function setOverlay1($inParm) {
 		$this->overlay1 = $inParm;
 	}
 	/**
 	 * Sets the second map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	
 	function setOverlay2($inParm) {
 		$this->overlay2 = $inParm;
 	}
 	/**
 	 * Sets the 3rd map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	
 	function setOverlay3($inParm) {
 		$this->overlay3 = $inParm;
 	}
 	/**
 	 * Sets the 4th map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	
 	function setOverlay4($inParm) {
 		$this->overlay4 = $inParm;
 	}
 	/**
 	 * Sets the 5th map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	
 	function setOverlay5($inParm) {
 		$this->overlay5 = $inParm;
 	}
 	/**
 	 * Sets the 6th map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	
 	function setOverlay6($inParm) {
 		$this->overlay6 = $inParm;
 	} 
 	/**
 	 * Sets the 7th map id that has been defined as an overlay map
 	 *
 	 * @param int $inParm
 	 */
 	
 	function setOverlay7($inParm) {
 		$this->overlay7 = $inParm;
 	}  	
 	/**
 	 * Returns the 1st overlay map id
 	 *
 	 * @return int
 	 */
 	function getOverlay1() {
 		return $this->overlay1;
 	}
 	/**
 	 * Returns the 2nd overlay map id
 	 *
 	 * @return int
 	 */
 	
 	function getOverlay2() {
 		return $this->overlay2;
 	}
 	/**
 	 * Returns the 3rd overlay map id
 	 *
 	 * @return int
 	 */
 	
 	function getOverlay3() {
 		return $this->overlay3;
 	}
 	/**
 	 * Returns the 4th overlay map id
 	 *
 	 * @return int
 	 */
 	
 	function getOverlay4() {
 		return $this->overlay4;
 	}
 	/**
 	 * Returns the 5th overlay map id
 	 *
 	 * @return int
 	 */
 	function getOverlay5() {
 		return $this->overlay5;
 	}
 	/**
 	 * Returns the 6th overlay map id
 	 *
 	 * @return int
 	 */
 	function getOverlay6() {
 		return $this->overlay6;
 	}
 	/**
 	 * Returns the 7th overlay map id
 	 *
 	 * @return int
 	 */
 	function getOverlay7() {
 		return $this->overlay7;
 	} 	

 	/**
 	 * Sets the PUBLISHED flag.  This flag should be used to determine if a flag is available to
 	 * front-end clients.
 	 *
 	 * @return boolean
 	 */
  	function setPublished($inParm) {
  		$this->published = $inParm;
  	}
  	/**
  	 * Returns the published flag.
  	 *
  	 * @return boolean
  	 */
  	function getPublished() {
  		return $this->published;
  	}
  	
  	function inEditMode() {
  		return $this->edit;
  	}
  	
  	/**
  	 * Returns the OWNER attribute associated with the map
  	 *
  	 * @return string
  	 */
  	function getOwner() {
  		return $this->owner;
  	}
  	/**
  	 * Sets the OWNER attribute
  	 *
  	 * @param string $inParm
  	 */
  	function setOwner($inParm) {
  		$this->owner = $inParm;
  	}
  	/**
  	 * Returns the date in which the maps was last updated
  	 *
  	 * @return string
  	 */
  	function getLastUpdate() {
  		return $this->lastupdate;
  	}
  	/**
  	 * Sets the date attribute of when the map was last updated
  	 *
  	 * @param string $inParm
  	 */
  	function setLastUpdate($inParm) {
  		$this->lastupdate = $inParm;
  	}
  	/**
  	 * Returns the name/user who last updated the map.
  	 *
  	 * @return string
  	 */
  	function getLastUpdatedBy() {
  		return $this->lastupdatedby;
  	}
  	/**
  	 * Sets the name/user of the person who last updated the map.
  	 * NOTE:  May need to abstract this a "JoomlaMap"
  	 * 
  	 * @param string $inParm
  	 */
  	function setLastUpdatedBy($inParm) {
  		$this->lastupdatedby = $inParm;
  	}
  	
  	/**
  	 * Returns the maps access permissions
  	 * NOTE:  May need to abstract this a "JoomlaMap"
  	 * 
  	 * @return unknown
  	 */
  	function getAccess() {
  		return $this->access;
  	}
  	/**
  	 * Sets the maps access permissions
  	 * NOTE:  May need to abstract this a "JoomlaMap" 
  	 *
  	 * @param unknown_type $inParm
  	 */
  	function setAccess($inParm) {
  		$this->access = $inParm;
  	}

  	/**
  	 * Returns the number of times the specific map has been accessed from the front-end.  
  	 * NOTE:  May need to abstract this a "JoomlaMap"
  	 *
  	 * @return unknown
  	 */
     function getHits() {
    	if ($this->hits == null)
    		return 0;
    	else
    		return $this->hits;
    }
    /**
     * Sets the value for the number of times the map has been accessed.
  	 * NOTE:  May need to abstract this a "JoomlaMap"
     *
     * @param unknown_type $inparm
     */
    function setHits($inparm) {
    	$this->hits = $inparm;
    }

	/**
	 * Adds a marker to the array of markers associated with the map.  This 
	 *
	 * @param fsMarker Marker
	 */
    function addMarker(fsMarker $inparm) {
    	$this->markers[]=$inparm;
    	/*
    	$cats = $inparm->getCategories();
    	for ($i=0; $i < sizeof($cats); $i++) {
    		$this->addCategory($cats[$i]);
    	}
    	*/
    }
    /**
     * This function adds a category to the array of categories for the markers associated 
     * with it.
     *
     * @param fsCategory $cat
     */
    function addCategory(fsCategory $cat) {
    	if (!array_key_exists($cat->getCategoryId(),$this->categories)) {
			$this->categories[$cat->getCategoryId()] = $cat;
    	}
    }
    
    /**
     * Returns the array of categories of markers assigned to the map. THIS IS NOT a list of categories
     * to filter on.
     *
     * @return unknown
     */
    function getCategories() {
    	$categories = null;
    	$categories = array_values($this->categories);
    	// SORT CATEGORIES BY THEIR NAME
		usort($categories,array("fsMap","cmp_categories"));    	
    	return $categories;
    }
    
	private function cmp_categories($a, $b) {
        $al = strtoupper($a->group . $a->order . $a->name);
        $bl = strtoupper($b->group . $b->order . $b->name);
        if ($al == $bl) {
            return 0;
        }
        return ($al > $bl) ? +1 : -1;
	}    
    /**
     * Adds a GROUP/ARRAY of markers to the map.  The array needs to contain fsMarker objects.
     *
     * @param array $markers
     */
    function addMarkers($markers) {
    	if (is_array($this->markers)) {
	    	foreach ($markers as $key => $marker) {
	    		$this->addMarker($marker);	
	    	}
    	} 
    }
    
    function getTotalMarkers() {
    	if (is_array($this->markers)) {
    		return sizeof($this->markers);
    	} else {
    		return 0;
    	}
    }
    function showMarkers() {
    	print_r($this->markers);
    }

	// THE FOLLOWING ARE HELPER "GETTER" METHODS TO RETRIEVE SPECIFIC PROPERTIES

  	function getDoubleClickZoom() {
		return $this->getPropertyValue(gDOUBLECLICK);
  	}
  	function getShowMapType() {
		return $this->getPropertyValue(gSHOWMAPTYPE);
  	}
  	function getMapType() {
		return $this->getPropertyValue(gMAPTYPE);
  	}	 	 	 	 	
  	function getZoomType() {
		return $this->getPropertyValue(gZOOMTYPE);
  	}
  	function getHeight() {
		return $this->getPropertyValue(gHEIGHT);
  	}
  	function getWidth() {
		return $this->getPropertyValue(gWIDTH);
  	}
 	function getZoom() {
		return $this->getPropertyValue(gZOOM);
 	}
 	function getMapOverview() {
		return $this->getPropertyValue(gMAPOVERVIEW);
 	}
 	function getLocalSearch() {
		return $this->getPropertyValue(gLOCALSEARCH);
 	}
 	function getKmlUrl() {
		return $this->getPropertyValue(gKMLURL);
 	}
    function getTemplate() {
   		return $this->getPropertyValue(gTEMPLATE);
    }
    function setContentMap($bool) {
    	$this->contentmap = $bool;
    }
    function getContentMap() {
    	return $this->contentmap;
    }

    /**
     * This function will set the center of the map.
     * @param unknown $lat
     * @param unknown $lng
     */
    function setCenter($lat,$lng) {
    	$this->addProperty(self::$DEFAULT_CENTER_LATITUDE_KEY, $lat);
    	$this->addProperty(self::$DEFAULT_CENTER_LONGITUDE_KEY, $lng);
    }
    
}
?>