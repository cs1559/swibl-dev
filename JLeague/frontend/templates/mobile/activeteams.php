<div class="listteams-wrapper">

<h3>Teams for <?php echo $season->getDescription(); ?></h3>

<?php 
	foreach ($teams as $team) {
?>
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<img class="teamprofile-team-logo-mini"
				src="<?php echo $config->getProperty('logo_folder') . $team->getLogo();?>"
				alt="SWIBL Team Logo" />
		</div>
		<div class="col-md-4">
		<h4><?php echo $team->getName();?></h4>
		Head Coach:  <?php echo $team->getCoachName();?><br/>
		</div>
		<div class="col-md-2 vcenter">
			<br/>
	   <a id="viewButton" href="javascript:void(0);"
	    	name="viewButton" 
	    	class="btn btn-primary btn-xs"
	    	onClick="window.location='<?php echo mRouter::translateUrl('index.php?option=com_jleague&amp;controller=teams&amp;task=viewTeamProfile&amp;teamid='. $team->getSlug()); ?>';"
	    	>View Profile</a>			
	
		</div>
	</div>
</div>
<?php 
	}
?>

</div>