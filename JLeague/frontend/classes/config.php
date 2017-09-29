<?php

require_once(FST_LIB_CORE. 'config.php');

class mConfig extends fsConfig  {
	
	var $_league = null;
	
	function __construct() {
		if (self::isInTest()) {
			echo "IS IN TEST";
			$this->addProperty("db.host", "localhost");
			$this->addProperty("db.user", "root");
			$this->addProperty("db.password", "");
			$this->addProperty("db.database","swibl");
		} else {
			$this->addProperty("db.host", "localhost");
			$this->addProperty("db.user", "swibl_jo151");
			$this->addProperty("db.password", "o1[VkOPQH2pr");
			$this->addProperty("db.database","swibl_jo151");
		}
// 		$this->addProperty("current_season",12);
// 		$this->addProperty("registration_open",0);
// 		$this->addProperty("rosters_enabled",0);
		//$this->addProperty("game_notifications_enabled",0);
		$this->addProperty("template_folder",APP_BASE_PATH . 'templates' . DS . 'mobile' . DS);
	
		// db: swibl_jo151 pwd:o1[VkOPQH2pr
	} 
	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new self();
		}
		return $instance;
	}
	
	function setLeague(JLLeague $obj) {
		$this->_league = $obj;
	}
	function getLeague() {
		return $this->_league;
	}
	function getLeagueId() {
		return $this->_league->getId();
	}
	
	/**
	 * Returns the value of a specific object property.
	 *
	 * @param String $key
	 * @return Mixed
	 * @deprecated Use the getProperty method.
	 */
	function getPropertyValue($key) {
		$val = parent::getPropertyValue($key);
		if ($val === null) {
			if (!isset($this->_league)) {
				throw new Exception("League has not been set");
			}
			return $this->_league->getPropertyValue($key);
		} else {
			return $val;
		}
	}
	/**
	 * Returns a value of a specific object property.
	 *
	 * @param String $key
	 * @return Mixed
	 */
	function getProperty($key) {
		$league = $this->_league;
		return $league->getPropertyValue($key);
	}
	
	function getProperties() {
		return $this->_league->getProperties();
	}
	
	function isInTest() {
		if ($_SERVER["SERVER_NAME"] == "localhost" ||
		    substr($_SERVER["SERVER_NAME"],0,3) == "192") {
			return true;
		} else {
			return false;
		}
	}
}

?>
