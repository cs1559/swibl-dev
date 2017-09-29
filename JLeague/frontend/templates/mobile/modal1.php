
<div class="modal fade" id="postScoreModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Post Score</h4>
			</div>
			<div class="modal-body">
				<div id="ps-gameform" title="Post Score">
					<form class="form-horizontal" id="post-score-form"
						name="postscoreform" method="post" action="index.php">

						<div class="form-group">
							<label class="col-sm-3 control-label" for="id">Game Id:</label>
							<div class="controls">
								<input id="ps-id" name="ps-id" class="inputds-sm" type="text"
									value="<?php isset($game) ? PRINT ($game->getId()) :"";  ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="gamedate">Game Date:</label>
							<div class="controls">
								<input id="ps-gamedate" name="ps-gamedate" class="input-sm"
									type="text"
									value="<?php isset($game) ? PRINT ($game->getGameDate()) :"";  ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="gametime">Game Time:</label>
							<div class="controls">
								<input id="ps-gametime" name="ps-gametime" class="input-sm"
									type="text"
									value="<?php isset($game) ? PRINT ($game->getGameTime()) :"";  ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="highlights">Notes:</label>
							<div class="controls">
								<textarea id="ps-highlights" name="ps-highlights"
									class="input-lg form-control" rows="2"><?php isset($game) ? PRINT ($game->getHighlights()) :"";  ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="highlights">Home Team:</label>
							<div class="controls">
							  	<?php echo $helper->getHomeTeamSelectList(); ?>
						   </div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="highlights">Away Team:</label>
							<div class="controls">
				  	<?php echo $helper->getAwayTeamSelectList(); ?>
				   </div>
						</div>

						<input type="hidden" name="option" value="com_jleague" /> <input
							type="hidden" name="controller" value="ajax" /> <input
							type="hidden" id="gamestatus" name="gamestatus" value="S" /> <input
							type="hidden" name="season_id"
							value="<?php echo $season->getId(); ?>" /> <input type="hidden"
							name="task" value="doScheduleGame" /> <input type="hidden"
							name="teamid" value="<?php echo $team->getId();?>" />
					</form>

				</div>

			</div>
			<!-- /.modal-body -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!--  <input type="button" value="Save" onclick="addGame(document.scheduledgameform);"/>		-->
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
