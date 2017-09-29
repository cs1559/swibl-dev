<?php JLApplication::setMetaTag('description', $team->getName() . ' Team Profile - SWIBL'); ?>
<?php JLApplication::setMetaTag('keywords', $team->getName() . ',' . $team->getCity()); ?>
<link
	type="text/css"
	href="http://localhost/j15/administrator/components/com_jleague/assets/jquery-theme/smoothness/ui.tabs.css"
	rel="stylesheet">

<script type="text/javascript">

	jfst(function() {
		jfst("#tabs").tabs();
	});

</script>

<div id="teamprofile-wrapper">
<div id="teamprofile-header" class="jleague-section-block">
<div id="teamprofile-logo"><img
	src="<?php echo $_config->getProperty('logo_folder') . $team->getLogo();?>" />
</div>

<div id="teamprofile-info">
<!-- <div id="teamprofile-info-teamname"><?php echo $team->getName(); ?></div> -->
<div id="teamprofile-info-about">
<div id="teamprofile-info-about-col1">
<table>
	<tr>	
	<td colspan="2"><span id="teamprofile-info-teamname"><?php echo $team->getName(); ?></span></td>
	</tr>
	<tr>
		<td><strong>Hometown:</strong></td>
		<td><?php echo $team->getCity() . ", " .$team->getState(); ?></td>
	</tr>
	<tr>
		<td><strong><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></strong></td>
		<td>
			<a href="javascript:void(0);" title="View USSSA Page" onclick="openWindow('<?php echo $_config->getProperty('sanctioning_body_team_url') . $team->getFieldValue("FLD_USSSA_NUMBER");  ?>');">
			<?php echo $team->getFieldValue("FLD_USSSA_NUMBER"); ?>
			</a>
		</td>
	</tr>
	<tr>
		<td><strong><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></strong></td>
		<td><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
	</tr>
	<tr>
		<td><strong>Age Group:</strong></td>
		<td><?php echo $mostrecentdivision->getAgeGroup(); ?></td>
	</tr>
	<tr>
		<td><strong>Head Coach:</strong></td>
		<td><?php echo $team->getCoachName(); ?></td>
	</tr>
	<tr>
		<td><strong>Phone:</strong></td>
		<td><?php echo $team->getCoachPhone(); ?></td>
	</tr>	

	
</table>
</div>
<div id="teamprofile-info-about-col2">
<table>
	<tr>
		<td colspan="2"><?php echo $submenu2; ?></td>
	</tr>	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><strong>SWIBL ID:</strong></td>
		<td><?php echo $team->getId(); ?></td>
	</tr>
	<tr>
		<td><strong>Profile Owner:</strong></td>
		<td><?php echo JLUtil::getUserName($team->getOwnerId()) . " [#" . $team->getOwnerid() . "]";?></td>
	</tr>
	<tr>
		<td><strong>Hits:</strong></td>
		<td><?php echo $team->getHits();?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
			
</table>

</div>
</div>
</div>
</div>
<div class="clr"></div>

<div id="game-notification-signup"><?php echo $_view->getGameNotificationLink(); ?></div>
<?php //echo $submenu2; ?>
<br/>

<div id="teamprofile-column1" class="width-75">

<div id="tabs-wrapper">

<div id="tabs">
<ul>
	<li><a href="#tabs-1">Game History</a></li>
	<li><a href="#tabs-2">Record History</a></li>
	<li><a href="#tabs-3">Team Contacts</a></li>
	<li><a href="#tabs-4">Field Information</a></li>
	<li><a href="#tabs-5">Schedule</a></li>
	<li><a href="#tabs-6">Roster</a></li>
</ul>
<div id="tabs-1"><?php 	echo $gamehistoryhtml; ?></div>
<div id="tabs-2"><?php 	echo $recordhistoryhtml; ?></div>
<div id="tabs-3"><?php 	echo $teamcontacts; ?></div>
<div id="tabs-4"><?php 	echo $fieldinformation; ?></div>
<div id="tabs-5"><?php 	echo $scheduleinformation; ?></div>
<div id="tabs-6"><?php 	echo $rosterinformation; ?></div>
</div>

</div>

</div>


<div id="teamprofile-column2" class="width-25"
	style="padding-left: 5px; border-left: 1px solid #e6e6e6">

<div id="teamprofile-additional-info">
<div class="teamprofile-sectionheader teamprofile-sectionheader-left">
<div class="teamprofile-sectionheader-right">Additional Info</div>
</div>
<strong>Website:</strong><br />
<?php echo $_view->getWebsiteLink(); ?>
<br />
<br />
<strong>Season:</strong><br />
<?php echo $mostrecentseason->getDescription(); ?><br />
<br />
<strong>Division:</strong><br />
<?php echo $mostrecentdivision->getName(); ?><br />
<br />
<strong>Years in League:</strong><br />
<?php echo $yearsinleague;?><br />
<br />
</div>

<?php echo $standings; ?></div>

</div>
