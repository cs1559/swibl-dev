<?php
?>

<div id="teamprofile-standings" class="teamprofile-component">

	<div class="teamprofile-component-header">
		<h3>Division Standings</h3>
	</div>
	<div class="teamprofile-component-content teamprofile-component-scrollable-content">
		<div class="teamprofile-division-name">
			<?php  if ($publishstandings) {
						echo $division->getName();
					} else {
						echo "TBD Division";
					}
			?></div>
		<table class="teamprofile-table swibl-table-max">
				<thead>
					<tr>
						<th>Team Name</th>
						<th class="" >Record</th>
						<th class="">Points</th>
					</tr>
				</thead>
			<?php 
				if ($publishstandings) {
					foreach($standings as $obj)
					{
			?>
					<tr>
						<td><a href="<?php echo mRouter::translateUrl('index.php?option=com_jleague&amp;controller=teams&amp;task=viewTeamProfile&amp;teamid='. $obj->getSlug()); ?>"><?php echo $obj->getTeamName();?></a></td>
						<td class=""><?php echo $obj->getRecord();?></td>
						<td class=""><?php echo $obj->getPoints();?></td>
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
</div>

