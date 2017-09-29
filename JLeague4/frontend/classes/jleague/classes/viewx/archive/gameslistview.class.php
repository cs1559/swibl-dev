<?php

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'listview.class.php');

class JLGamesListView extends JLListView {
	
	function __construct() {
		parent::__construct();
	}
	
	function getToolbar() {
		JToolBarHelper::title( JLText::getText( 'Games' ), 'games');
		JToolBarHelper::back('Home' , 'index.php?option=com_jleague');
		JToolBarHelper::divider();
		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNew( 'newgame' , JLText::getText( 'New' ) );
	}
	
}

?>