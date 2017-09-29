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
	//require_once(JLEAGUE_SERVICES_PATH . DS . 'teamservice.class.php');
	
	static $items;

	$segments	= array();
	$itemid		= null;

/*
	Segment Order:
	1) component:  jleague
	2) controller: 
	3) task
	4) teamid

http://www.swibl-baseball.org/j15/index.php?option=com_jleague&controller=teams&task=listteams&Itemid=216


 */

    if(isset($query['controller'])) {
	    $segments[] = $query['controller'];
	    unset($query['controller']);
    }

	if(isset($query['task'])) {
	    switch ($query['task']) {
		    case 'viewTeamProfile':
			    $segments[] = 'profile';
			    break;
		    case 'displayStandings':
			    $segments[] = 'display';
			    break;
		    case 'listteams':
			    $segments[] = 'list';
			    break;
		    default:
				$segments[] = $query['task'];
				break;
		}
	    unset($query['task']);
	   
    }
    if(isset($query['teamid'])) {
	    $segments[] = $query['teamid'];
	    unset($query['teamid']);
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

/*
	Segment Order:
	1) component:  jleague
	2) controller: 
	3) task
	4) teamid

 */
	if ($segments[0] == 'registrations') {
		$vars['controller'] = $segments[0];
		$vars['task'] = $segments[1];
		if ($vars['task'] == 'register') {
			if (isset($segments[2])) {
				$vars['teamid'] = $segments[2];
			}
		}
		if ($vars['task'] == 'confirm') {
			if (isset($segments[2])) {
				$vars['id'] = $segments[2];
			}
			if (isset($segments[3])) {
				$vars['confirmation'] = $segments[3];
			}
			
		}
		
		return $vars;
	}

	if ($segments[0] == 'teams' && $segments[1] == 'list') {
		$vars['controller'] = $segments[0];
		$vars['task'] = 'listteams';
		return $vars;
	}	
		
	if ($segments[0] == 'standings') {
		$vars['controller'] = $segments[0];
		$vars['task'] = 'displayStandings';
		return $vars;
	}
	
	
	if ($count > 2) {
		// Set Controller
		if (isset($segments[0])) {
			$vars['controller'] = $segments[0];
		}
		
		// Set TASK
		if (isset($segments[1])) {
			switch ($segments[1]) {
			case 'profile':
				$vars['task'] = 'viewTeamProfile';
				break;
			default:
				$vars['task'] = $segments[1];
			}
		}
		// Set SLUG
		if (isset($segments[2])) {
			$slug = $segments[2];
			$slug_array = explode(":", $slug);
			$teamid = $slug_array[0];
			$vars['teamid'] = $teamid; 
		}
		return $vars;
	} else {
		if (isset($segments[0])) {
			switch ($segments[0]) {
			case 'profile':
				$vars['task'] = 'viewTeamProfile';
				break;
			default:
				$vars['task'] = $segments[0];
			}
		}
		if (isset($segments[1])) {
			$slug = $segments[1];
			$slug_array = explode(":", $slug);
			$teamid = $slug_array[0];
			$vars['teamid'] = $teamid; 
		}

	}

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


