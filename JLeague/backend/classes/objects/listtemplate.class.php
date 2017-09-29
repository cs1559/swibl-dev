<?php
/**
 * @version $Id: listtemplate.class.php 298 2011-11-20 13:00:20Z Chris Strieter $ 
 * @author Chris Strieter 
 * @copyright (c) 2008 Firestorm Technologies, LLC.  All Rights Reserved 
 * @package Maps
 * @filesource 
 * @license See license.html
*/


require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'template.class.php');

class JLListTemplate extends JLTemplate {

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
		//$imgY	= 'tick.png';
		//$imgX	= 'publish_x.png';
		$imgY = 'icon-publish';
		$imgX = 'icon-unpublish';

		$image	= $row->$type ? $imgY : $imgX;

		$alt	= $row->$type ? JLText::getText( 'published' ) : JLText::getText( 'unpublished' );

		$href  = '<a class="btn btn-micro" href="javascript:void(0);" onclick="location.href=\'' . $link . '\';">';
		// Modified for Joomla3
	//	$href .= '<span><img src="images/' . $image . '" border="0" alt="' . $alt . '" /></span>';
		$href .= '<l class="' . $image . '"></l>';
		$href .= '</a>';

		return $href;
	}	
}
?>