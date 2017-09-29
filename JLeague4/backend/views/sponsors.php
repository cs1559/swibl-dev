<?php
/**
 * @version		$Id: sponsors.php 398 2012-02-12 15:34:18Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Views
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */

require_once(JLEAGUE_CLASSES_VIEW_PATH . DS. 'componentbackendview.php');

class JLSponsorsView extends JLComponentBackendView {
	
	function __construct($task=null) {
		parent::__construct($task);
		$this->setTitle("Sponsor Management");
	}

	/**
	 * This function binds an HTTP request object to the JLSponsor object.
	 *
	 * @return JLSponsor
	 */
	function bindRequestToObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'sponsor.class.php');
		$obj = new JLSponsor();
		if (isset($_REQUEST["id"])) {
			$obj->setId($_REQUEST["id"]);
		} else {
			$obj->setId(0);
		}
		if (isset($_REQUEST["sponsorname"])) {
			$obj->setName($_REQUEST["sponsorname"]);
		}
		if (isset($_REQUEST["contactname"])) {
			$obj->setContactName($_REQUEST["contactname"]);
		}
		if (isset($_REQUEST["contactphone"])) {
			$obj->setContactPhone($_REQUEST["contactphone"]);
		}		
		if (isset($_REQUEST["contactemail"])) {
			$obj->setContactEmail($_REQUEST["contactemail"]);
		}		
		if (isset($_REQUEST["address1"])) {
			$obj->setAddress1($_REQUEST["address1"]);
		}
		if (isset($_REQUEST["address2"])) {
			$obj->setAddress2($_REQUEST["address2"]);
		}			
		if (isset($_REQUEST["city"])) {
			$obj->setCity($_REQUEST["city"]);
		}			
		if (isset($_REQUEST["state"])) {
			$obj->setState($_REQUEST["state"]);
		}			
		if (isset($_REQUEST["zipcode"])) {
			$obj->setZipcode($_REQUEST["zipcode"]);
		}					
		return $obj;		
	}

	
	/**
	 * Bind a request to a Campaign Object
	 *
	 * @return JLCampaign
	 */
	function bindRequestToCampaignObject() {
		require_once(JLEAGUE_CLASSES_OBJECTS_PATH . DS. 'campaign.class.php');
		$obj = new JLCampaign(); 
		if (isset($_REQUEST["id"])) {
			$obj->setId($_REQUEST["id"]);
		} else {
			$obj->setId(0);
		}
		if (isset($_REQUEST["campaignname"])) {
			$obj->setName($_REQUEST["campaignname"]);
		}
		if (isset($_REQUEST["notes"])) {
			$obj->setNotes($_REQUEST["notes"]);
		}
		if (isset($_REQUEST["startdate"])) {
			$obj->setStartDate($_REQUEST["startdate"]);
		}		
		if (isset($_REQUEST["enddate"])) {
			$obj->setEndDate($_REQUEST["enddate"]);
		}		
		if (isset($_REQUEST["clickthru"])) {
			$obj->setClickThru($_REQUEST["clickthru"]);
		}
		if (isset($_REQUEST["published"])) {
			$obj->setPublished($_REQUEST["published"]);
		}			
		if (isset($_REQUEST["sponsorid"])) {
			$obj->setSponsorId($_REQUEST["sponsorid"]);
		}			
		return $obj;		
	}
	
	
	function getEditToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
		JToolBarHelper::apply();
		JToolBarHelper::save();
		//JToolBarHelper::back('Back' , 'index.php?option=com_jleague&controller=sponsors');
		JToolBarHelper::custom( 'createCampaign', 'copy.png', 'copy_f2.png', 'Create Campaign', false );
 		JToolBarHelper::cancel( 'cancelSponsor','Cancel' );	
	}	
	
	function getDefaultToolbar() {
// 		JToolBarHelper::back('Dashboard' , 'index.php?option=com_jleague');
		JToolBarHelper::addNew( 'newsponsor' , JLText::getText( 'New' ) );
		JToolBarHelper::editList();
// 		JToolBarHelper::publishList( 'publish' , JLText::getText( 'Publish' ) );
// 		JToolBarHelper::unpublishList( 'unpublish' , JLText::getText( 'Unpublish' ) );
		JToolBarHelper::deleteList();

	}	
	
	/**
	 * This function sets the EDIT toolbar.
	 *
	 */
	function getEditCampaignToolbar() {
		JRequest::setVar( 'hidemainmenu', 1 );
 		JToolBarHelper::cancel( 'cancelCampaign','Cancel' );	
		JToolBarHelper::save('saveCampaign','Save');	
	}	

	/**
	 * This helper function returns the EDIT link for a given campaign.
	 *
	 * @param JLCampaign $campaign
	 * @return String
	 */
	function getEditCampaignUrl(JLCampaign $campaign) {
		//http://www.swibl-baseball.org/j15/index.php?option=com_jleague&controller=sponsors&task=click&cid=1
		return JLApplication::getSiteUrl()  . "administrator/index.php?option=com_jleague&controller=sponsors&task=editCampaign&cid=" . $campaign->getId();
	}
	
	/**
	 * This helper function will provide the Click Thru URL.  This URL is used to incremenet the 
	 * click count for a given campaign.
	 *
	 * @param JLCampaign $campaign
	 * @return String
	 */
	function getClickThruUrl(JLCampaign $campaign) {
		//http://www.swibl-baseball.org/j15/index.php?option=com_jleague&controller=sponsors&task=click&cid=1
		return JLApplication::getSiteUrl()  . "index.php?option=com_jleague&controller=sponsors&task=click&cid=" . $campaign->getId();
	}
	
	/**
	 * This is a helper function that will return a delete option link on the campaign list
	 * for only those campaigns that have clicks equal to ZERO (0).
	 *
	 * @param JLCampaign $campaign
	 * @return String
	 */
	function getDeleteCampainUrl(JLCampaign $campaign) {
		if ($campaign->getClicks() > 0) {
			$link = JLApp::getSiteUrl()  . "administrator/index.php?option=com_jleague&controller=sponsors&task=deleteCampaign&cid=" . $campaign->getId() . "&sid=" . $campaign->getSponsorId();
			return $link;
		}
		return "";
	}	
}

?>