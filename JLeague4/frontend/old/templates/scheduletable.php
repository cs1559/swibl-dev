	<div id="teamprofile-gamehistory-detail">
			<table id="games-table">
				<thead>
						<tr class="games-table-header-row">
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_GAMEID'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_DATE'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_GAME_TIME'); ?></th>
							<th class="games-table-cell-header"><?php echo JLText::getText('JL_HOMETEAM'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_SCORE'); ?></th>
							<th class="games-table-cell-header"><?php echo JLText::getText('JL_AWAYTEAM'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_SCORE'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_CONFERENCE'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_LOCATION'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_STATUS'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_ACTION'); ?></th>							
						</tr>				
				</thead>
				<tbody>
			<?php
				foreach($games as $obj)
				{
			?>
					<tr>
						<td class="games-table-cell-center"><?php echo $obj->getId();?></td>				
						<td class="games-table-cell-center"><?php echo $obj->getGameDate();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getGameTime();?></td>						
						<td class="games-table-cell"><?php echo $obj->getHometeam();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getHometeamScore();?></td>
						<td class="games-table-cell"><?php echo $obj->getAwayteam();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getAwayteamScore();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getConferenceGame();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getLocation();?></td>
						<td class="games-table-cell-center"><?php echo JLGameViewHelper::getGameStatusDesc($obj->getGameStatus());?></td>	
						<td class="games-table-cell-center">
							<a href="javascript:void(0);" onClick="editGame(<?php echo $obj->getId();?>);">Edit</a>
							<?php if ($obj->getGameStatus() != "C" && $_config->getProperty('submit_scores_enabled')) { ?>
						  | <a href="javascript:void(0);" onClick="postScore(<?php echo $obj->getId() . ",'" . $teamid . "'"; ?>);">Post Score</a>
						  	<?php } ?>
							
							<?php if ($obj->getGameStatus() != "C" || !$obj->isLeagueGame()) { ?>
						  | <a href="javascript:void(0);" onClick="deleteGame(<?php echo $obj->getId() . ",'" . $teamid . "'"; ?>);">Delete</a>
						  	<?php } ?>
						</td>
					</tr>
		<?php
				}
		?>
			</tbody>
		</table>
				
	
	</div>	
