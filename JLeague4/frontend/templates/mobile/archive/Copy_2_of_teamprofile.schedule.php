

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Game Information</h4>
				</div>
				<div class="modal-body">
					<div id="scheduledgameform" title="Edit Game">
						<form class="form-horizontal" id="scheduled-game-form"
							name="scheduledgameform" method="post" action="index.php">
							
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="id">Game Id:</label>
				  <div class="controls">
				    <input id="id" name="id" class="input-sm" type="text"  value="<?php isset($game) ? PRINT ($game->getId()) :"";  ?>">
				   </div>
				</div>
			
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="id">Division:</label>
				  <div class="controls">
				  	<span id="division_name" name="division_name">
				  	<?php if (isset($game)) {
				  		echo $helper->getDivisionName();
				  	} else {
						echo "N/A";  
				  	}?>
				    </span>
				   </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="conference_game">Game Type:</label>
				  <div class="controls">
				  	<span id="conference_game" name="conference_game">				  
				   <?php echo  $helper->getConferenceGame();  ?>
				   </div>
				</div>
				
				<!-- 
				<div class="form-group">
					<label class="col-sm-3 control-label" for="league-game-group">Game Type:</label>
				  <div id="league-game-group" class="btn-group" data-toggle="buttons">
				    <label class="btn btn-default">
				      <input name="conference_game" id="rb-league-game" type="radio" value="Y"> League Game
				    </label>	
				    <label class="btn btn-default">
				      <input name="conference_game" id="rb-nonleague-game" type="radio" value="N"> Non-League
				    </label>
				  </div>
				</div>
 				-->
 				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="gamedate">Game Date:</label>
				  <div class="controls">
				    <input id="gamedate" name="gamedate" class="input-sm" type="text"  value="<?php isset($game) ? PRINT ($game->getGameDate()) :"";  ?>">
				   </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="gametime">Game Time:</label>
				  <div class="controls">
				    <input id="gametime" name="gametime" class="input-sm" type="text"  value="<?php isset($game) ? PRINT ($game->getGameTime()) :"";  ?>">
				   </div>
				</div>
												

				<div class="form-group">
				  <label class="col-sm-3 control-label" for="gametime">Game Status:</label>
				  <div class="controls">
				    	<?php echo $helper->getGameStatus('gamestatus_sl','onClick="javascript:changeStatus(this.value);"'); ?>
				   </div>
				</div>
												
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="location">Location:</label>
				  <div class="controls">
				    <input id="location" name="location" class="input-lg" type="text"  value="<?php isset($game) ? PRINT ($game->getLocation()) :"";  ?>">
				   </div>
				</div>								
												
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="highlights">Notes:</label>
				  <div class="controls">
				  	<textarea id="highlights" name="highlights" class="input-lg form-control" rows="2"><?php isset($game) ? PRINT ($game->getHighlights()) :"";  ?></textarea>
				   </div>
				</div>	
							
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="hometeam_id">Home Team:</label>
				  <div class="controls">
				  	<?php echo $helper->getHomeTeamSelectList(); ?>
				  	<input id="hometeam_score" name="hometeam_score" class="input-sm col-sm-2" type="text"  value="">
				   </div>
				</div>	
				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="awayteam_id">Away Team:</label>
				  <div class="controls">
				  	<?php echo $helper->getAwayTeamSelectList(); ?>
				  	<input id="awayteam_score" name="awayteam_score" class="input-sm col-sm-2" type="text"  value="">
				   </div>
				</div>	
														
						<input type="hidden" name="option" value="com_jleague" /> <input
								type="hidden" name="controller" value="ajax" /> <input
								type="hidden" id="gamestatus" name="gamestatus" value="S" /> <input
								type="hidden" name="season_id" 	value="<?php echo $season->getId(); ?>" /> <input type="hidden"
								name="task" value="doScheduleGame" /> <input type="hidden"
								name="teamid" value="<?php echo $team->getId();?>" />
						</form>

					</div>

				</div>
				<!-- /.modal-body -->
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
				    <input id="ps-id" name="ps-id" class="inputds-sm" type="text"  value="<?php isset($game) ? PRINT ($game->getId()) :"";  ?>">
				   </div>
				</div>
			
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="gamedate">Game Date:</label>
				  <div class="controls">
				    <input id="ps-gamedate" name="ps-gamedate" class="input-sm" type="text"  value="<?php isset($game) ? PRINT ($game->getGameDate()) :"";  ?>">
				   </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="gametime">Game Time:</label>
				  <div class="controls">
				    <input id="ps-gametime" name="ps-gametime" class="input-sm" type="text"  value="<?php isset($game) ? PRINT ($game->getGameTime()) :"";  ?>">
				   </div>
				</div>
												
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="highlights">Notes:</label>
				  <div class="controls">
				  	<textarea id="ps-highlights" name="ps-highlights" class="input-lg form-control" rows="2"><?php isset($game) ? PRINT ($game->getHighlights()) :"";  ?></textarea>
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
								type="hidden" name="season_id" 	value="<?php echo $season->getId(); ?>" /> <input type="hidden"
								name="task" value="doScheduleGame" /> <input type="hidden"
								name="teamid" value="<?php echo $team->getId();?>" />
						</form>

					</div>

				</div>
				<!-- /.modal-body -->
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
	
	
	

<form class="button-form">
<fieldset>

<!-- Form Name -->
<legend><?php echo $team->getName(); ?> - Manage Schedule</legend>	

<div class="teamprofile-toolbar">
   <button id="addButton" 
    	name="addButton" 
    	class="btn btn-primary btn-xs hidden-xs hidden-sm"
    	data-toggle="modal"
    	data-target="#myModal"
		onClick="javascript:editPlayerOnRoster(0);"
    	value="Add Game">Add Game	</button>

   <button id="postScoreButton" 
    	name="postScoreButton" 
    	class="btn btn-primary btn-xs hidden-xs hidden-sm"
    	data-toggle="modal"
    	data-target="#postScoreModal"
		onClick=""
    	value="Post Score">Post Game Score</button>
    	
    	
   <button id="cancelButton" 
    	name="cancelButton" 
    	class="btn btn-primary btn-xs"
    	formmethod="post"
    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='. $team->getSlug()); ?>"
    	value="Return">Return to Profile</button>
    	
</div>

<div id="current-seasons-games">
		<?php  echo $scheduletable; ?>
</div>


</fieldset>
</form>

