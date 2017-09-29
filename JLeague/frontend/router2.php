<?php
/**
* @version		$Id: router2.php 43 2010-02-24 02:27:41Z Chris Strieter $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

function JLeagueBuildRoute(&$query)
{
	require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
	
	static $items;

	$segments	= array();
	$itemid		= null;
	
	// Get the menu items for this component.
//	if (!$items) {
//		$component	= &JComponentHelper::getComponent('com_gmapspro2');
//		$menu		= &JSite::getMenu();
//		$items		= $menu->getItems('componentid', $component->id);
//	}

	// Segment 0
    if(isset($query['controller']))
    {
       $segments[] = $query['controller'];
       unset( $query['controller'] );
    } else {
    	if (isset($query['task'])) {
    		switch ($query['task']) {
    			case 'listteams':
    				$segments[] = "teams";
    				break;
    			case 'listupcominggames':
    				$segments[] = "games";
    				break;    				
    		}		 
    	}
    }
     
    // Segment 1	
    if(isset($query['task']))
    {
       $segments[] = $query['task'];
       unset( $query['task'] );
    }
	// Segment 2
    if(isset($query['teamid']))
    {
  		$svc = & JLTeamService::getInstance();
  		$team = $svc->getRow($query['teamid']);
       	$segments[] = str_replace(" ","",$team->getName()) . ":" . $query['teamid'];
       	unset( $query['teamid'] );
    }
    if(isset($query['Itemid']))
    {
       $segments[] = $query['Itemid'];
       unset( $query['Itemid'] );
    }          
    
	return $segments;
}

function JLeagueParseRoute($segments)
{
	//Get the active menu item
	$menu	=& JSite::getMenu();
	$item	=& $menu->getActive();

	$vars = array();
	$count = count($segments);
	
	if ($count == 2) {
		if (isset($segments[0]))
		{
			$vars['controller'] = $segments[0];
		}
		if (isset($segments[1]))
		{
			$vars['task'] = $segments[1];
		}
	}
	if ($count == 3) {
		if (isset($segments[0]))
		{
			$vars['controller'] = $segments[0];
		}
		if (isset($segments[1]))
		{
			$vars['task'] = $segments[1];
		}
		if (isset($segments[2]))
		{
			$val = explode(":",$segments[2]);
			$x = sizeof($val) - 1;
			$vars['teamid'] = $val[$x];
		}
	}
	
	return $vars;
	
}
?>
