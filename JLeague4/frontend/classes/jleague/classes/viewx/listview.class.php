<?php

/**
 * @version 		$Id: basedao.class.php 312 2011-12-05 02:41:50Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		View
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once('componentbackendview.php');

class JLListView extends JLComponentBackendView  {
	
	var $_pagination;
	var $_total = 0;
	var $_limit = 0;
	var $_limitstart = 0;
	
	function __construct() {
		parent::__construct();
	}
	
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if ( empty( $this->_pagination ) )
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getLimitStart(), $this->getLimit() );
		}
		return $this->_pagination;
	}
	
	function setLimit($limit) {
		$this->_limit = $limit;
	}
	function getLimit() {
		return $this->_limit;
	}
	function setLimitStart($start) {
		$this->_limitstart = $start;
	}
	function getLimitStart() {
		return $this->_limitstart;
	}
	function setTotal($total) {
		$this->_total = $total;
	}
	function getTotal() {
		return $this->_total;
	}
	
	function display() {
		$pagination = $this->getPagination();
		$this->setObject('pagination',$pagination);
		parent::display();
	}

}
?>