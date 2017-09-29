
<div id="teamprofile-header" class="jleague-section-block">
	<div id="teamprofile-logo">
		<img src="<?php echo $_config->getProperty('logo_folder') . $team->getLogo();?>"/>
	</div>
	
	<div id="teamprofile-info">
		<div id="teamprofile-info-teamname"><?php echo $team->getName(); ?></div>
		<div id="teamprofile-info-about">
			<div id="teamprofile-info-about-col1">
			<table>
			<tr>
				<td><strong>Hometown:</strong></td>
				<td><?php echo $team->getCity() . ", " .$team->getState(); ?></td>
			</tr>
			<tr>
				<td><strong>Website:</strong></td>
				<td><?php echo $team->getWebsite(); ?></td>
			</tr>
			<tr>
				<td><strong>Age Group:</strong></td>
				<td><?php echo $mostrecentdivision->getAgeGroup(); ?></td>
			</tr>
			<tr>
				<td><strong><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></strong></td>
				<td><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
			</tr>			
			<tr>
				<td><strong>Coach:</strong></td>
				<td><?php echo $team->getCoachName(); ?></td>
			</tr>
			<tr>
				<td><strong>Coach Phone:</strong></td>
				<td><?php echo $team->getCoachPhone(); ?></td>
			</table>
			</div>
			<div id="teamprofile-info-about-col2">
			<table>
			<tr>
				<td><strong>SWIBL ID:</strong></td>
				<td><?php echo $team->getId(); ?></td>
			</tr>			
			<tr>
				<td><strong><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></strong></td>
				<td><?php echo $team->getFieldValue("FLD_USSSA_NUMBER"); ?></td>
			</tr>			
			<tr>
				<td><strong>Current Season:</strong></td>
				<td><?php echo $mostrecentseason->getDescription(); ?></td>
			</tr>
			<tr>
				<td><strong>Current Division:</strong></td>
				<td><?php echo $mostrecentdivision->getName(); ?></td>
			</tr>
<!--
			<tr>
				<td><strong>Years in League:</strong></td>
				<td><?php echo $yearsinleague;?></td>
			</tr>
-->
			<tr>
				<td><strong>Community Page:</strong></td>
				<td><?php echo $_view->isCommunityGroupAvailable();?></td>
			</tr>			
			</table>
			</div>			
		</div>
	</div>
</div> 
	<div class="clr"></div>
	<br/>
	<?php echo $submenu; ?>
	<br/>
<div id="teamprofile-column1">

<?php
	echo $recordhistoryhtml;
	echo $gamehistoryhtml;
?>	


</div>

<!-- 
<div id="teamprofile-column2">
	<div id="teamprofile-lastgame"  class="jleague-section-block">
		<div id="teamprofile-gamehistory-header" class="jleague-section-block jleague-section-header">
			<h3>Last Game</h3>
		</div>
	</div>
	
	<div id="teamprofile-standings"  class="jleague-section-block">
		<div id="teamprofile-gamehistory-header" class="jleague-section-block jleague-section-header">
			<h3>Standings</h3>
		</div>
	</div>
</div>
 -->
