	

	<div id="teamprofile-schedule-detail">

		<?php if (isset($message)) { ?>
	<div class="alert alert-danger alert-dismissable">
  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  		<strong>Warning!</strong> <?php echo $message; ?>
	</div>
	<?php } ?>
	
	
			<h3>Schedule for <?php echo $season->getTitle(); ?> Season</h3>
	
			<table id="games-table" class="table table-striped swibl-table-max" style="font-size: 12px;">
				<thead>
						<tr class="games-table-header-row hidden-xs hidden-sm visible-md visible-lg">
							<th class="games-table-cell-header games-table-cell-center">ID</th>
							<th class="games-table-cell-header games-table-cell-center">Date</th>
							<th class="games-table-cell-header games-table-cell-center">Game Time</th>
							<th class="games-table-cell-header">Opponent</th>
							<!--  <th class="games-table-cell-header games-table-cell-center">W/L</th>  -->
							<th class="games-table-cell-header games-table-cell-center">Score</th>
							<!--  <th class="games-table-cell-header">Away Team</th> -->
							<!--  <th class="games-table-cell-header games-table-cell-center">Away Score</th>  -->   
							<th class="games-table-cell-header games-table-cell-center">League</th>
							<!-- <th class="games-table-cell-header games-table-cell-center">Location</th>  -->
							<th class="games-table-cell-header games-table-cell-center">Status</th>
							<th class="games-table-cell-header games-table-cell-center">Action</th>							
						</tr>		
				</thead>
				<tbody>
			<?php
			if (count($games) > 0 ) {
				foreach($games as $obj)
				{
			?>
					<tr class="game-table-row hidden-xs hidden-sm visible-md visible-lg" >
						<td class="games-table-cell-center"><?php echo $obj->getId();?></td>				
						<td class="games-table-cell-center"><?php echo $obj->getGameDate();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getGameTime();?></td>						
						<td class="games-table-cell">
							<?php echo $_view->getOpponent($team,$obj);?><br/>
							<?php echo $obj->getLocation();?>
						</td>
						<!--  <td class="games-table-cell-center"><?php echo $_view->getWinLoss($team,$obj);?></td>   -->
						<td class="games-table-cell-center"><?php echo $_view->getGameScore($team,$obj);?></td>
<!-- 						<td class="games-table-cell-center"><?php echo $obj->getHometeamScore();?></td>  -->
<!-- 						<td class="games-table-cell"><?php echo $obj->getAwayteam();?></td>  -->
<!-- 						<td class="games-table-cell-center"><?php echo $obj->getAwayteamScore();?></td>  -->
						<td class="games-table-cell-center"><?php echo $obj->getConferenceGame();?></td>
						<!--  <td class="games-table-cell-center"><?php echo $obj->getLocation();?></td>   -->
						<td class="games-table-cell-center"><?php echo JLGameViewHelper::getGameStatusDesc($obj->getGameStatus());?></td>	
						<td class="games-table-cell">
							<div class="teamprofile-action-buttons" style="margin-top: 3px; margin-bottom: 3px;">
							<?php 
								$ssvc = &JLSecurityService::getInstance();
								if (!$ssvc->isAdmin()) {
							?>
							
								<button type="button" class="btn btn-primary btn-xs btn-mini" onClick="editGame(<?php echo $obj->getId();?>);">Edit</button>
								<?php if ($obj->getGameStatus() != "C" && $config->getProperty('submit_scores_enabled')) { ?>
								<button type="button" class="btn btn-primary btn-xs btn-mini" onClick="postScore(<?php echo $obj->getId() . ",'" . $team->getId() . "'"; ?>);">Post Score</button>
							  	<?php } ?>
								<?php if ($obj->getGameStatus() != "C" || !$obj->isLeagueGame()) { ?>
								<button type="button" class="btn btn-primary btn-xs btn-mini" onClick="deleteGame(<?php echo $obj->getId() . ",'" . $team->getId() . "'"; ?>);">Delete</button>
							  	<?php } ?>
							<?php 
								} else {
							?>
								<button type="button" class="btn btn-primary btn-xs btn-mini" onClick="editGame(<?php echo $obj->getId();?>);">Edit</button>
								<?php if ($obj->getGameStatus() != "C" && $config->getProperty('submit_scores_enabled')) { ?>
								<button type="button" class="btn btn-primary btn-xs btn-mini" onClick="postScore(<?php echo $obj->getId() . ",'" . $team->getId() . "'"; ?>);">Post Score</button>
							  	<?php } ?>
								<button type="button" class="btn btn-primary btn-xs btn-mini" onClick="deleteGame(<?php echo $obj->getId() . ",'" . $team->getId() . "'"; ?>);">Delete</button>
							<?php 									
								}
							?>
							  	
							</div>
						</td>
					</tr>

		<?php
								}
			} else {
				?>
				<tr><td colspan="3">No Games Scheduled</td></tr>
				<?php
			}
		?>
			</tbody>
		</table>
				
	
	</div>	
