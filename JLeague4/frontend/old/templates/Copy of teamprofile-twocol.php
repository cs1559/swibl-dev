
<script type="text/javascript">
	var $j = jQuery.noConflict();

	jQuery(function() {
		jQuery("#tabs").tabs();
	});

</script>


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
				<td><strong>Age Group:</strong></td>
				<td><?php echo $mostrecentdivision->getAgeGroup(); ?></td>
			</tr>
			<tr>
				<td><strong><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></strong></td>
				<td><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
			</tr>
			<tr>
				<td><strong>SWIBL ID:</strong></td>
				<td><?php echo $team->getId(); ?></td>
			</tr>			
			<tr>
				<td><strong><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></strong></td>
				<td><?php echo $team->getFieldValue("FLD_USSSA_NUMBER"); ?></td>
			</tr>		
			</table>
			</div>
			<div id="teamprofile-info-about-col2">
			<table>

			<tr>
				<td><strong>Head Coach:</strong></td>
				<td><?php echo $team->getCoachName(); ?></td>
			</tr>
			<tr>
				<td><strong>Phone:</strong></td>
				<td><?php echo $team->getCoachPhone(); ?></td>
			</tr>
			<tr>
				<td><strong>Email:</strong></td>
				<td><?php echo "Not available"; //echo $team->getCoachEmail(); ?></td>
			</tr>			
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
	
	
<div id="teamprofile-column1" class="width-75">

	<div id="tabs">
		<ul class="tabs">
			<li><a href="#tabs-1" onClick="javascript:void(0);">Team Contacts</a></li>
			<li><a href="#tabs-2" onClick="javascript:alert('hi world'); return false;" >Record History</a></li>
			<li><a href="#tabs-3" onClick="javascript:void(0);" >Game History</a></li>
		</ul>
		<div class="tab_container">
			<div id="tabs-1" class="tab_content">
				<?php 	echo $teamcontacts; ?>	
			</div>
			<div id="tabs-2" class="tab_content">
				<?php 	echo $recordhistoryhtml; ?>	
			</div>
			<div id="tabs-3" class="tab_content">
				<?php 	echo $gamehistoryhtml; ?>	
			</div>
		</div>		
	</div>


</div>

<div id="teamprofile-column2" class="width-25">
	<div id="teamprofile-additional-info">
		<div class="teamprofile-sectionheader teamprofile-sectionheader-left">
		<div class="teamprofile-sectionheader-right">
			Additional Info
		</div>
		</div>	
		<strong>Website:</strong><br/>
		<?php 
			$_val = $team->getWebsite();
			if (strlen($_val)==0) {
				echo "Unavailable";
			} else {
		echo $team->getWebsite(); 
			}
		?>
		<br/><br/>
		<strong>Season:</strong><br/>
		<?php echo $mostrecentseason->getDescription(); ?><br/><br/>
		<strong>Division:</strong><br/>
		<?php echo $mostrecentdivision->getName(); ?><br/><br/>
		<strong>Years in League:</strong><br/>
		<?php echo $yearsinleague;?><br/><br/>
	</div>
	

	<?php echo $standings; ?>
		
</div>

