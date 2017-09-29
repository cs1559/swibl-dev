<?php
/**
 * @version		$Id: listtemplate.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Objects
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license		GNU/GPL, see LICENSE.php
 */

require_once('template.class.php');

class JLListTemplate extends FSTTemplate {

	private $_pagination;
	private $_total = 0;
	private $_limit = 0;
	private $_limitstart = 0;
	
	function __construct($file = null, $folder = null) {
		parent::__construct($file, $folder);
	}
	
	function setPagination($pag) {
		$this->_pagination = $pag;
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
	
	function parse() {
		$pagination = $this->getPagination();
		$this->setObject('pagination',$pagination);
		parent::parse();
	}

		
	function getPublish( &$row , $type)
	{
		$controller = $_REQUEST["controller"];
		$coreurl = JURI::base() . "index.php?option=com_jleague&controller=".$controller."&task=togglePublish";
		$link = JRoute::_( $coreurl. '&cid=' . $row->id);
		$imgY	= 'tick.png';
		$imgX	= 'publish_x.png';

		$image	= $row->$type ? $imgY : $imgX;

		$alt	= $row->$type ? JLText::getText( 'published' ) : JLText::getText( 'unpublished' );

		$href = '<a href="javascript:void(0);" onclick="location.href=\'' . $link . '\'";>';
		$href  .= '<span><img src="images/' . $image . '" border="0" alt="' . $alt . '" /></span></a>';

		return $href;
	}	
}
?>