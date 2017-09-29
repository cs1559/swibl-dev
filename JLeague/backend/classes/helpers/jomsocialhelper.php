<?php

/**
 * @version 		$Id: jomsocialhelper.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Classes
 * @copyright 		(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC
 * @license			GNU/GPL, see LICENSE.php
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class JLJomSocialHelper {

	function createGroupForTeam($team) {
		include_once(JLEAGUE_JOMSOCIAL_MODELS_PATH . 'groups.php');
		
		$default_owner = 0;
		$default_categoryid = 0;
		$default_description = "This is a team page for the {TEAMNAME}.";
		
		$group 		= new stdClass();
		$group->id = 0;
		$group->published = 0;
		$group->ownerid = $default_owner;
		$group->categoryid = $default_categoryid;
		$group->name = $team->getName();
		$group->description = $default_description; 
		$group->email = '';
		$group->website = $team->getWebsite();
		$group->approvals = null;
		$group->created = null;
		$group->avatar = null;
		$group->thumb = null;
		$group->discusscount = 0;
		$group->wallcount = 0;
		$group->membercount = 0;
		$group->params = null;
		
		$grpid = CommunityModelGroups::updateGroup($group);
		return $grpid;
		
	}
	
	function getProfileTypeFieldId() {
		return 17;
	}
	function getProfileFieldFilter($uid) {
		$typefield = self::getProfileTypeFieldId();
		$db	=& JLApp::getDBO();		
		
		$strSQL	= 'SELECT field.*, value.value '
				. 'FROM ' . $db->nameQuote('#__community_fields') . ' AS field '
				. 'LEFT JOIN ' . $db->nameQuote('#__community_fields_values') . ' AS value '
 				. 'ON field.id=value.field_id AND value.user_id=' . $db->Quote($uid) . ' '
				. 'WHERE field.id = ' . $typefield; 

		$db->setQuery( $strSQL );

		$result	= $db->loadObjectList();

		$value = $result[0]->value;
		return self::getFilterFieldsByType($value);

	}
	
	function getFilterFieldsByType($type = null) {
		switch ($type) {
			case 'Sponsor':
				return "7,8,9,10,11,12,13,17,19,20,21,22,23,25";				
				break;
			case 'Coach':
				return "5,10,11,17,26,27,31";				
				break;
			case 'Player':
				return "17,5,4,32,29,30,31,32,26,27";				
				break;	
			case 'Fan':
				return "17,5,4,26,27,33,34";				
				break;						
			default:
				return self::getProfileTypeFieldId();
				break;
		}
		
	}
	
	function getFieldItem($fieldcode,$data) {
		
	}
	

}
?>
