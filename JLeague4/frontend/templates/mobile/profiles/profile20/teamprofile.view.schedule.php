	<div id="teamprofile-gamehistory-detail" class="hidden-xs hidden-phone">
	
			<table id="teamprofile-schedule-table" class="teamprofile-schedule-table table-striped swibl-table-max" style="font-size: 12px;">
				<thead>
						<tr class="games-table-header-row hidden-xs hidden-sm hidden-tablet hidden-phone">
							<th class="games-table-cell-header games-table-cell-center">ID</th>
							<th class="games-table-cell-header games-table-cell-center">Date</th>
							<th class="games-table-cell-header games-table-cell-center">Game Time</th>
							<th class="games-table-cell-header">Opponent</th>
							<th class="games-table-cell-header games-table-cell-center">W/L</th>
							<th class="games-table-cell-header games-table-cell-center">Score</th>
							<!--  <th class="games-table-cell-header">Away Team</th> -->
							<!--  <th class="games-table-cell-header games-table-cell-center">Away Score</th>  -->   
							<th class="games-table-cell-header games-table-cell-center">League</th>
							<th class="games-table-cell-header games-table-cell-center">Location</th>
							<th class="games-table-cell-header games-table-cell-center">Status</th>
						</tr>		
				</thead>
				<tbody>
			<?php
			if (count($games) > 0 ) {
				foreach($games as $obj)
				{
			?>
					<tr class="game-table-row">
						<td class="games-table-cell-center  hidden-xs hidden-sm hidden-tablet hidden-phone"><?php echo $obj->getId();?></td>				
						<td class="games-table-cell-center"><?php echo $obj->getGameDate();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getGameTime();?></td>						
						<td class="games-table-cell "><?php echo $_view->getOpponent($team,$obj);?></td>
						<td class="games-table-cell-center"><?php echo $_view->getWinLoss($team,$obj);?></td>
						<td class="games-table-cell-center"><?php echo $_view->getGameScore($team,$obj);?></td>
						<td class="games-table-cell-center"><?php echo $obj->getConferenceGame();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getLocation();?></td>
						<td class="games-table-cell-center"><?php echo JLGameViewHelper::getGameStatusDesc($obj->getGameStatus());?></td>	
					</tr>
		<?php
					}
			} else {
				?>
				<tr><td colspan="12">No Games Scheduled</td></tr>
				<?php
			}
		?>
			</tbody>
		</table>
				
	
	</div>	

	
	
	<div id="teamprofile-gamehistory-detail" class="visible-xs visible-phone hidden-sm hidden-md hidden-lg hidden-tablet hidden-desktop">
	
			<table id="games-table" class="table table-striped swibl-table-max" style="font-size: 12px;">
				<thead>
						<tr class="games-table-header-row hidden-xs hidden-sm hidden-tablet hidden-phone">
							<th class="games-table-cell-header games-table-cell-center">Date</th>
							<th class="games-table-cell-header">Opponent</th>
						</tr>		
				</thead>
				<tbody>
			<?php
			if (count($games) > 0 ) {
				foreach($games as $obj)
				{
			?>
					<tr class="game-table-row">
						<td class="games-table-cell-center">
							<?php echo $obj->getGameDate() . " - " . $obj->getGameTime();?> <br/>
							<?php echo JLGameViewHelper::getGameStatusDesc($obj->getGameStatus());?>
						</td>
						<td class="games-table-cell ">
							<?php echo $_view->getOpponent($team,$obj);?><br/>

							<?php if ($obj->isComplete()) { ?>
							<?php echo $_view->getWinLoss($team,$obj) . " (" . $_view->getGameScore($team,$obj) . ")";?>
							<?php } else { ?>
							<?php echo $obj->getLocation();?>
							<?php } ?>
						</td>
					</tr>
		<?php
					}
			} else {
				?>
				<tr><td colspan="12">No Games Scheduled</td></tr>
				<?php
			}
		?>
			</tbody>
		</table>
				
	
	</div>	
	