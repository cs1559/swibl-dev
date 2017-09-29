<?php
?>

<div id="teamprofile-standings" class="profile-box profile-box-dark">

	<h3>Division Standings</h3>
	<table class="swibl-table-max">
			<thead>
				<tr>
					<th>Team Name</th>
					<th>Record</th>
					<th>Points</th>
				</tr>
			</thead>
<?php 
	if ($publishstandings) {
		foreach($standings as $obj)
		{
?>
		<tr>
			<td><a href="<?php echo mRouter::translateUrl('index.php?option=com_jleague&amp;controller=teams&amp;task=viewTeamProfile&amp;teamid='. $obj->getSlug()); ?>"><?php echo $obj->getTeamName();?></a></td>
			<td><?php echo $obj->getRecord();?></td>
			<td><?php echo $obj->getPoints();?></td>
		</tr>	
<?php 
		}
	} else {
		?>
			<tr><td colspan="3">Standings have not been published</td></tr>
		<?php 
	}
?>	
	</table>
</div>