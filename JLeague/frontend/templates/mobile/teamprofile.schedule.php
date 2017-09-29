

<!-- Modal -->

<div class="modal fade" id="gameModal" tabindex="-1" role="dialog" aria-labelledby="gameModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="gameModalLabel">
						Game Information
						<!--  <span id="division_name" name="division_name">   -->
					  	<?php if (isset($game)) {
					  		echo "- " . $helper->getDivisionName();
					  	} else {
							echo "";  
					  	}?>
					  	(Game#: <span id="game-id-display">&nbsp;</span>)

					</h4>
				</div><!-- /.modal-header -->
				<div class="modal-body">
					<div id="scheduledgameform" title="Edit Game">
						<form id="scheduled-game-form" name="scheduledgameform" method="post" role="form" action="index.php">
	
							<div class="form-group">
								<label class="col-sm-3 control-label" for="conference_game">Game
									Type:</label>
								<div class="controls">
									<span id="conference_game_element">				  
					 				  <?php echo  $helper->getConferenceGame();  ?>
					 				</span>
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-3 control-label form-control" for="gamedate">Game Date:</label>
								<div class="controls">
									<input id="gamedate" name="gamedate" class="input-sm form-control"
										type="text"
										value="<?php isset($game) ? PRINT ($game->getGameDate()) :"";  ?>">
								</div>
							</div>
						
							<div class="form-group">
								<label class="col-sm-3 control-label" for="gametime">Game Time:</label>
								<div class="controls">
									<input id="gametime" name="gametime" class="input-sm form-control" type="text" value="<?php isset($game) ? PRINT ($game->getGameTime()) :"";  ?>">
								</div>
							</div>
												
							<div class="form-group">
								<label class="col-sm-3 control-label" for="gamestatus_sl">Game Status:</label>
								<div class="controls">
				    				<?php echo $helper->getGameStatus('gamestatus_sl','onClick="javascript:changeStatus(this.value);"'); ?>
				   				</div>
							</div>						
	
							<div class="form-group">
								<label class="col-sm-3 control-label" for="location">Location:</label>
								<div class="controls">
									<input class="form-control game-form-location" placeholder="Enter venue or use dropdown" id="location" name="location" type="text">	
									    <div class="btn-group">
	      										<button class="btn dropdown-toggle" data-toggle="dropdown">
        										<span class="caret"></span>
      										</button>
       										<?php echo mHtmlHelper::getVenueUnorderedList("ul-venues", "", "dropdown-menu scrollable-menu venue-list-dropdown", "menu")?>
    									</div>									
				   				</div>
							</div>		

							<div class="form-group">
								<label class="col-sm-3 control-label" for="highlights">Notes:</label>
								<div class="controls">
									<textarea id="highlights" name="highlights"
										class="input-lg form-control" rows="2"><?php isset($game) ? PRINT ($game->getHighlights()) :"";  ?></textarea>
								</div>
							</div>
						
							<div> <!--  Scoreboard -->
								<table id="scoreboard-table">
								<thead>
									<tr>						
										<th class="games-table-cell-header boxscore-col1 leftjust"></th>
										<th class="games-table-cell-header boxscore-col2 centerjust">LeagueTeam</th>
										<th class="games-table-cell-header boxscore-col3 centerjust" style="width: 312px;">Team</th>
										<th class="games-table-cell-header boxscore-col4 centerjust">Score</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="left-pad10">Home</td>
										<td class="centerjust"><?php echo $helper->getHomeTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
										<td><span id="hometeam_name"
											class="<?php echo $helper->getHomeTeamInputClass(); ?>"><?php echo $helper->getHomeTeamInput(); ?></span>
											<span id="hometeam_selectlist"
											class="<?php echo $helper->getHomeTeamSelectListClass(); ?>"><?php echo $helper->getHomeTeamSelectList(); ?></span>
										</td>
										<td><input type="text" class="game-score-input  form-control"
											name="hometeam_score"
											value="<?php echo $game->getHometeamScore(); ?>" size="5"
											maxlength="7" /></td>
									</tr>
									<tr>
										<td class="left-pad10">Away</td>
										<td class="centerjust"><?php echo $helper->getAwayTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
										<td><span id="awayteam_name"
											class="<?php echo $helper->getAwayTeamInputClass(); ?>"><?php echo $helper->getAwayTeamInput(); ?></span>
											<span id="awayteam_selectlist"
											class="<?php echo $helper->getAwayTeamSelectListClass(); ?>"><?php echo $helper->getAwayTeamSelectList(); ?></span>
										</td>
										<td><input type="text" class="game-score-input form-control"
											name="awayteam_score"
											value="<?php echo $game->getAwayteamScore(); ?>" size="5"
											maxlength="7" /></td>
									</tr>
									</tbody>
								</table>
							</div>
							
							<div id="game-attributes">
								<table id="game-attributes-table">
									<tr>
										<td class="valign-top width-25">Short game:</td>
										<td><?php echo mHtmlHelper::getYesNoSelectList('shortgame',$game->getShortgame());?></td>
									</tr>
								</table>
							</div>
							
							<span id="ajax_status_message" style="width: 100%; text-align: center"></span>
								
								<input type="hidden" name="option" value="com_jleague" /> <input
									type="hidden" name="controller" value="ajax" /> <input
									type="hidden" id="gamestatus" name="gamestatus" value="S" /> <input
									type="hidden" name="season_id"
									value="<?php echo $season->getId(); ?>" /> <input type="hidden"
									name="task" value="doScheduleGame" /> <input type="hidden"
									name="teamid" value="<?php echo $team->getId();?>" /> <input
									type="hidden" name="id"
									value="<?php isset($game) ? PRINT ($game->getId()) : 0; ?>" /> <input
									type="hidden" name="division_id"
									value="<?php isset($game) ? PRINT ($game->getDivisionId()) :"";  ?>" />
							
						</form>
					</div>
				</div> <!-- /.modal-body -->
				<div class="modal-footer">
					<span id="modal_status_message" class="pull-left"></span>
					<span><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></span>
					<!--  <input type="button" value="Save" onclick="addGame(document.scheduledgameform);"/>		-->
					<span><button type="button" class="btn btn-primary"
						onClick="javascript: addGame(document.scheduledgameform);">Save Changes</button></span>
				</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<form class="button-form">
	<fieldset>

		<!-- Form Name -->
		<legend><?php echo $team->getName(); ?> - Manage Schedule</legend>

		<div class="teamprofile-toolbar">
			<!--  hidden-xs hidden-sm -->
			
			<button type="button" class="btn btn-primary btn-xs" onClick="openGameForm('insert');">Add Game</button>				
				
			<button id="cancelButton" name="cancelButton"
				class="btn btn-primary btn-xs" formmethod="post"
				formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='. $team->getSlug()); ?>"
				value="Return">Return to Profile</button>

		</div>

		<div id="current-seasons-games">
		<?php  echo $scheduletable; ?>
</div>

	</fieldset>
</form>

















