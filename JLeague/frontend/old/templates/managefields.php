<?php include('teamprofile.edit.miniheader.php'); ?>

<div class="clr"/></div>
<br />

<strong>
NOTE:  You can define more than one field where your team may play.  If the field, or venue, is not listed in 
the drop-down select list, please notify the league and it will be added. 

</strong>
	
<div class="jleague-title">
<h2>Fields/Venues</h2>
</div>

<div id="managefields-form">
	<form id="team-venue-input-form" name="venueForm" method="post" action="index.php">
		<br/>
		<table  class="admintable" width="100%">
			<tbody>
				<tr>
					<td class="key">Select Field/Venue:</td>
					<td><?php echo JLHtml::getVenueSelectList("venueid",0); ?></td>
					<td><input type="button" value="Add Field/Venue" onClick="addTeamVenue(document.venueForm);"/></td>
				</tr>
			</tbody>
		</table>

	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="teams"/>
	<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>

	</form>
</div>
<div class="jleague-title">
<h2>Current Fields/Venues</h2>
</div>
<div id="team-current-venues-list">
	<?php echo $currentvenuestable; ?>
</div>
