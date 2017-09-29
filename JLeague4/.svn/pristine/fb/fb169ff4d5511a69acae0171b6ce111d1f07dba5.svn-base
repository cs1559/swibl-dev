<?php


defined('_APPEXEC') or die('Restricted access');

class mSponsorView extends mBaseView {
	
	
	/**
	 * This funciton will return the Sponsor menu select list
	 * @param unknown $element_name
	 * @param unknown $default_value
	 * @param unknown $classname
	 * @param unknown $sponsorid
	 * @return string
	 */
	function getSponsorMenu($element_name, $default_value, $classname, $sponsorid) {
		$app = &mFactory::getApp();
		$config = $app->getConfig();
		
		if ($slug == null) {
			$slug = $teamid;
		}
		
		$obj = new fsSelectList($element_name, $default_value);
		$obj->setHeader("------- Select Menu Option -------");
		$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $slug), "View Team Profile");
		$obj->addOption(mRouter::translateUrl("index.php?option=com_jleague&controller=teams&task=editTeamProfile&teamid=" . $slug), "Edit Profile");
		$obj->setAttribute("onchange", "window.location	= this.value;");
		if ($classname != null) {
			$obj->setAttribute("class", $classname);
		}
		return $obj->toHtml();
	}
	
	function getFormattedAddress(JLSponsor $sponsor) {
		$html = "<address>";
		$html = $sponsor->getAddress1() . "<br/>";
		$html .= $sponsor->getCity() . ", " . $sponsor->getState() . "  " . $sponsor->getZipcode() ."<br/>";
		$html .= $sponsor->getPhone();
		$html .= "</address>";		
		return $html;
	}
}