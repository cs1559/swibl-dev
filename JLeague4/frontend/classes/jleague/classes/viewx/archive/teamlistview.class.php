<?php

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLTeamsListView extends JLListView {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		JToolBarHelper::title( JLText::getText( 'Teams' ), 'teams');
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'create' , JLText::getText( 'New' ) );
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