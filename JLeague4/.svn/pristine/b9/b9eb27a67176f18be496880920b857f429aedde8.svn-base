<?php
/**
 * @version 		$Id: leaguedao.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Data Access Objects
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class JLUserDAO extends fsBaseDAO{
	
	var $tablename = '#__users';
	
	
	protected function __construct() {
		parent::__construct();
		$db = mFactory::getDBO();
		$this->setDatabase($db);
	}
	
	function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLLeagueDAO();
		}
		return $instance;
	}	
		
	/**
	 * 
	 * This function will insert a row into the LEAGUE table.
	 *
	 * @param JLLeague $league
	 * @return boolean
	 */
   	function insert(JLLeague $league) {
		$query = 'INSERT INTO ' .$this->getNameQuote( $this->tablename  ) . ' (id, name, description, abbr, configuration, published) '
			. ' VALUES (0,'
			. '"' . $league->getName() . '",' 
			. '"' . $league->getDescription() . '",'
			. '"' . $league->getAbbrName(). '",'
			. '"' . $league->getFormattedProperties() . '",'
			. $league->getPublished() . ')';
		return $this->_insertRow($query);			
    }
    
    /**
     * This function will enable someone to update a row from the LEAGUE table.
     *
     * @param JLLeague $league
     * @return boolean
     */
    function update(JLLeague $league) {
 		$query = 'update ' .$this->getNameQuote( $this->tablename  ) . ' set '
			. ' name = "' . $league->getName(). '", '
			. ' description = "' . $league->getDescription(). '", '
			. ' abbr = "' . $league->getAbbrName() . '", '
			. ' configuration = "' . $league->getFormattedProperties() . '", '
			. ' published = ' . $league->getPublished()
			. ' where id = ' . $league->getId();
		return $this->_updateRow($query);		
    }
	
	/**
	 * This will map the the database row to the League Object
	 *
	 * @param unknown_type $row
	 * @return unknown
	 */	
	function loadObject($row) {
		$league = new JLLeague();
		$league->setId($row->id);
		$league->setName($row->name);
		$league->setAbbrName($row->abbr);
		$league->parseDatabaseObjectProperties($row->configuration);
		$league->setDescription($row->description);
		$league->setPublished($row->published);
		return $league;
	}
	
	/**
	 * This function returns the number of leagues that are published.
	 *
	 * @return int
	 */
    function getTotalPublishedLeagues() {
    	$query = 'SELECT * FROM #__jleague_leagues WHERE published = 1';
    	$rows = $this->_execute($query); 
    	if (is_array($rows)) {
    		return count($rows);
    	}
    	return 0;
    } 	


	function togglePublished($id) {
		$iid = (int) $id;
		$obj = $this->findById($id);
		if ($obj->getPublished()==0) {
			if ($this->getTotalPublishedLeagues()) {
				throw new Exception("You can only have ONE league published at a time");
				return;
			}
			$obj->setPublished(1);
		}  else
			$obj->setPublished(0);
		$query	= 'update ' .$this->getNameQuote( $this->tablename  ) . ' set published=' . $obj->getPublished() . ' where id = ' . $iid	;
		try {
			self::_updateRow($query);	
		} catch (Exception $e) {
			throw $e;
		}
	}

    function getActiveLeague() {
    	$query = 'SELECT * FROM #__jleague_leagues WHERE published = 1';
    	$rows = $this->_execute($query);
    	if (sizeof($rows) > 0) {
    	return $this->loadObject($rows[0]);
    	} else {
    		throw new Exception("No Active League found");
    	}
    } 	
    
}
