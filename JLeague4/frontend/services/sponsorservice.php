<?php
/**
 * @version		$Id: sponsorservice.class.php 391 2012-02-12 12:23:06Z Chris Strieter $
 * @package 	JLeague
 * @subpackage	Services
 * @copyright 	(C) 2006-2012 Chris Strieter, Firestorm Technologies, LLC - All Rights Reserved
 * @license		GNU/GPL, see LICENSE.php
 */


class JLSponsorService  extends mBaseService  {
	
	
	protected function __construct() {
		parent::__construct();
	}
	
	static function getInstance() {
		static $instance;
		if (!is_object( $instance )) {
			$instance = new JLSponsorService();
		}
		return $instance;
	}		
		
	protected function getDao() {
		$dao = &JLSponsorDAO::getInstance();
		return $dao;
	}

	/**
	 * This function increases the CLICK counter for a given campaign and returns the URL that
	 * the client should be redirected to.
	 *
	 * @param int $id Campaign Id
	 * @return String Click thru URL
	 */
	function clickThru($id) {
		$cdao = &JLCampaignDAO::getInstance();
		$campaign = $cdao->findById($id);
		$cdao->click($campaign);
		return $campaign->getClickthru();
	}
	
	function getCampaign($cid) {
		$cdao = &JLCampaignDAO::getInstance();
		$campaign = $cdao->findById($cid);		
		return $campaign;
	}
	
	function saveCampaign(JLCampaign $obj) {

		$dao = &JLCampaignDAO::getInstance();
		if ($obj->getId()>0) {
			return $dao->update($obj);
		} else {
			$rc = $dao->insert($obj);
			$newid = $dao->getInsertId();
			if (method_exists($obj,'setid')) {
				$obj->setId($newid);
			}
			return $rc;
		}
	}
	
	function deleteCampaign($id) {

		$dao = &JLCampaignDAO::getInstance();
		if (!is_numeric($id)) {
			throw new  Exception("ID is not numeric");
		}
		try {
			$dao->delete($id);
		} catch (Exception $e) {
			throw $e;			
		}
	}
	
}

?>