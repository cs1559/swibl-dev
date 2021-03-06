<?php
/**
 * @version		$Id: controlpanel.php 389 2012-02-12 11:40:19Z Chris Strieter $
 * @package 	GMapsPRO
 * @subpackage	Classes
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */
// Disallow direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<div class="span6">
<div id="jleague-dashboad-overview" class="well well-small">
<table width="100%" border="0">
	<tr>
		<td valign="top">
			<table >
				<tr>
					<td>
						<div style="font-weight:700;">
							<h3>JLeague - <?php echo JLText::getText('Sports League Management');?> </h3>
						</div>
						<p>
							<img class="jl-logo-image" src="components/com_jleague/assets/images/trophy-48x48.png"/>JLeague is a sports league management extension for Joomla.  This extension was written
							for a select baseball league within the United States.  It should be capable of supporting 
							an sport where there are two teams per game/event and are scored only based on a FINAL score
							(e.g. baseball, soccer, basketball, etc.).   
						</p>
						Joomla Compatibility:<br/>
						<ul>
							<li>Joomla 3.1</li>
						</ul>
						<p>
							Software developed by Chris Strieter<br/>
							(c) 2006-2012, Firestorm Technologies, LLC<br/>
							<a href="http://www.firestorm-technologies.com">http://www.firestorm-technologies.com</a>
						</p>
						
					</td>
				</tr>
			</table>
		</td>
</tr>
</table>
</div>
</div>

<div class="span5">
<div id="jleague-dashboad-statistics" class="well well-small">
	<h3>Statistics</h3>
			<table width="100%">
				<tr>
					<td >Current Season:</td>
					<td><?php echo $season->getDescription() . " ( ID: " . $season->getId() . " ) "; ?></td>
				<tr>
					<td>Total Teams Registered:</td>
					<td><?php echo $season->getTotalRegistrations(); ?></td>
				</tr>
				<tr>
					<td>Total Teams:</td>
					<td><?php echo $season->getTotalTeams(); ?></td>
				</tr>
				<tr>
					<td>Total Divisions:</td>
					<td><?php echo $season->getTotalDivisions(); ?></td>
				</tr>
				<tr>
					<td>Total Games Scheduled:</td>
					<td><?php echo $season->getTotalScheduledGames(); ?></td>
				</tr>			
				<tr>
					<td>Total Games Played:</td>
					<td><?php echo $season->getTotalGames();?></td>
				</tr>					

			</table>
</div>
<div class="well well-small">
	<h3>Configuration</h3>
		<table width="100%">
				<tr><td>Registration Open:</td><td><?echo ($config->getPropertyValue("registration_open") ? "Yes" : "No"); ?></td>
				<tr><td>Score Submission Enabled:</td><td><?echo ($config->getPropertyValue("submit_scores_enabled") ? "Yes" : "No"); ?></td>				
				<tr><td>Rosters Enabled:</td><td><?echo ($config->getPropertyValue("rosters_enabled") ? "Yes" : "No"); ?></td>				
				<tr><td>Rosters Locked:</td><td><?echo ($config->getPropertyValue("rosters_locked") ? "Yes" : "No"); ?></td>				
				<tr><td>Schedules Enabled:</td><td><?echo ($config->getPropertyValue("schedules_enabled") ? "Yes" : "No"); ?></td>				
				<tr><td>SEO Support Enabled:</td><td><?echo ($config->getPropertyValue("seo_enabled") ? "Yes" : "No"); ?></td>				
		</table>
</div>
</div>