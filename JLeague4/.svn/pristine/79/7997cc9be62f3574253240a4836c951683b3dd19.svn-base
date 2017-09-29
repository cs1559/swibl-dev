<?php

/**
 * @version		$Id: baseservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


abstract class mBaseService {
	
	protected function __construct() {
	}
	
	abstract protected function getDao();
	
	/**
	 * Retrieve an Object
	 *
	 * @param int $id
	 * @return Object
	 */
	public function getRow($id) {
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric (BaseService::getRow)");
		}
		
		$dao = $this->getDao();
		try {
			$obj = $dao->findById($id);
			if (!is_object($obj)) {
				throw new Exception("No Row Found");
			}
		} catch (Exception $e) {
			throw $e;
		}
		return $obj;
	}
	
	/**
	 * Returns the total # of rows. 
	 *
	 * @param String $filter
	 * @return int
	 */
	public function getTotalRows($filter=null) {
		
		$dao = $this->getDao();
		return $dao->getTableSize($filter);
	}
	
	/**
	 * Retrieves and returns an array of objects based on the DAO.
	 *
	 * @return array
	 */
	public function getRows() {
		$dao = $this->getDao();
		return $dao->getRows();
	}

	/**
	 * Returns an array of Objects/records 
	 *
	 * @param int $start
	 * @param int $stop
	 * @param String $sortorder
	 * @param String $filter
	 * @return array
	 */
	public function getRecords($start,$stop,$sortorder, $filter=null) {
		$dao = $this->getDao();
		try {
			$records = $dao->getRecords($start,$stop,$sortorder, $filter);
		} catch (Exception $e) {
			throw $e;
		}
		return $records;
	}
	
	/**
	 * Changes the published state for a given row
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function togglePublished($id) {
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric");
		}
	
		try {
			$dao = $this->getDao();
			$dao->togglePublished($id);
		} catch (Exception $e) {
			throw $e;
		}
	}
		
	/**
	 * Publishes an individual row
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function publish($id) {
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric");
		}
		try {
			$dao = $this->getDao();
			$dao->publish($id);
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Unpublishes an indiviaul row
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function unpublish($id) {
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric");
		}
		try {		
			$dao = $this->getDao();
			$dao->unpublish($id);
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Saves an bject to the database.  If the ID is zero, it is assumed
	 * to be an insert.  Otherwise, an update will be performed.
	 *
	 * @param Object $obj
	 * @return boolean
	 */
	public function save(&$obj) {
		$dao = $this->getDao();
		if ($obj->getId()>0) {
			return $dao->update($obj);
		} else {
			$rc = $dao->insert($obj);
			$newid = $dao->getInsertId();
			if (method_exists($obj,'setid')) {
				$obj->setId($newid);
			}
			return $rc;
		}
	}
	
	/**
	 * Deletes an individual row
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function delete($id) {
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric");
		}
		$dao = $this->getDao();
		try {
			$dao->delete($id);
		} catch (Exception $e) {
			throw $e;			
		}
	}
		
}

?>