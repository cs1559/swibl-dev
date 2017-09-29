<?php
/**
 * @version		$Id: standingslistview.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */
require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLStandingsListView extends JLListView {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		JToolBarHelper::title( JLText::getText( 'Standings' ), 'standings');
// 		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
//		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
//		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::divider();
//		JToolBarHelper::deleteList();
//		JToolBarHelper::editListX();
//		JToolBarHelper::addNew( 'create' , JLText::getText( 'New' ) );
	}
	
	/*
	function getPublish( &$row , $type)
	{
		$coreurl = JURI::base() . "index.php?option=com_jleague&controller=divisions&task=togglePublish";
		$link = JRoute::_( $coreurl. '&cid=' . $row->id);
		$imgY	= 'tick.png';
		$imgX	= 'publish_x.png';

		$image	= $row->$type ? $imgY : $imgX;

		$alt	= $row->$type ? JLText::getText( 'published' ) : JLText::getText( 'unpublished' );

		$href = '<a href="javascript:void(0);" onclick="location.href=\'' . $link . '\'";>';
		$href  .= '<span><img src="images/' . $image . '" border="0" alt="' . $alt . '" /></span></a>';

		return $href;
	}
	*/	
	
}

?>