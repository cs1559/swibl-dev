<?php
/**
 * @version 		$Id: userpreferences.php 297 2011-11-20 12:58:45Z Chris Strieter $
 * @package 		JLeague
 * @subpackage 		Views
 * @copyright 		(C) 2006-2007 Chris Strieter, Firestorm-Technologies
 * @license 		Commercial License (see license file contained within distribution file)
 */

require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS . 'frontendview.class.php');

class JLUserPreferencesView extends JLFrontendBaseView {
	
	function __construct() {
		parent::__construct();
	}
	
  /**
   * This function will generate a list of LANDING page.
   *
   * @param string $element_name
   * @param string $default_value
   * @param string $event
   * @return string
   */
	function getLandingPageList($element_name, $default_value, $event = '') {
		$options = array (
//			JHTML::_('select.option', '', JLText::getText('-- Select Type --')),
			JHTML::_('select.option', 'TEAMPAGE', JLText::getText('JL_TEAMPAGE')),
//			JHTML::_('select.option', 'COMMUSER', JLText::getText('JL_COMMUNITYUSER')),
//			JHTML::_('select.option', 'COMMGROUP', JLText::getText('JL_COMMUNITYGROUP')),
			JHTML::_('select.option', 'STANDINGS', JLText::getText('JL_STANDINGS')),			
		);
		return JHTML::_('select.genericlist' , $options, $element_name , ' class="input" '. $event, 'value', 'text', $default_value  ); 		
	}	
	
	function getTeamList($element_name, $default_value, $event = '') {
		require_once(JLEAGUE_SERVICES_PATH . DS. 'teamservice.class.php');
		$svc = &JLTeamService::getInstance();
		$rows = $svc->getActiveTeams();
		$teamlist[] =JHTML::_('select.option','' , '-- Select Team --       ' );
		foreach ($rows as $row) {
			$teamlist[] = JHTML::_('select.option', $row->getId(), JLText::getText($row->getName()) . " (" . $row->getCoachName() . ")");
		}
		return JHTML::_('select.genericlist' , $teamlist, $element_name , ' class="input" '. $event, 'value', 'text', $default_value  );
	}
		
}

?>