

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Venue Information</h4>
			</div>
			<div class="modal-body">
				<div id="managevenue-form">
					<form id="team-venue-input-form" name="venueForm" method="post" role="form"	action="index.php">
						<br />
						<table class="admintable" width="100%">
							<tbody>
								<tr>
									<td class="key">Select Field/Venue:</td>
									<td><?php echo mHtmlHelper::getVenueSelectList("venueid",0,"select-venue form-control"); ?></td>
								</tr>
							</tbody>
						</table>

						<input type="hidden" name="option" value="com_jleague" /> <input
							type="hidden" name="controller" value="teams" /> <input
							type="hidden" name="teamid" value="<?php echo $team->getId();?>" />

					</form>
				</div>
			</div>
			<!-- /.modal-body -->
			<div class="modal-footer">
				<span id="modal_status_message" class="pull-left"></span>
				<span><button type="button" class="btn btn-primary" aria-hidden="true"
					data-dismiss="modal">Close</button></span>
				<span><button type="button" class="btn btn-primary"
					onClick="javascript: addTeamVenue(document.venueForm);">Save
					changes</button></span>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<form class="button-form">
	<fieldset>

		<!-- Form Name -->
		<legend><?php echo $team->getName(); ?> - Manage Fields/Venues</legend>

		<div class="teamprofile-toolbar">
		
			<button type="button" class="btn btn-primary btn-xs" onClick="openVenueForm(<?php echo $team->getId();?>);">Add Venue</button>


			<button id="cancelButton" name="cancelButton"
				class="btn btn-primary btn-xs" formmethod="post"
				formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='. $team->getSlug()); ?>"
				value="Return">Return to Profile</button>

		</div>

		<p>
			<strong>NOTE: You can define more than one field where your team may
				play. If the field, or venue, is not listed in the drop-down select
				list, please notify the league and it will be added. </strong>
		</p>

		<div id="team-current-venues-list">
		<?php echo $currentvenuestable; ?>
	</div>


	</fieldset>
</form>


