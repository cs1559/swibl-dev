	<p>
		NOTE:  Game details are always subject to change.  Please contact your coach for any late updates that may not have been posted to this site.
	</p>
	
	<div id="teamprofile-gamehistory-detail">
	<?php
		if (sizeof($games)==0) {
			echo JLText::getText('No games have been played/scheduled');;
		} else {		
	 ?>	
			<table id="games-table" style="font-size: 10px;">
				<thead>
						<tr class="games-table-header-row">
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_GAMEID'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_DATE'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_GAME_TIME'); ?></th>
							<th class="games-table-cell-header"><?php echo JLText::getText('JL_HOMETEAM'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_SCORE'); ?></th>
							<th class="games-table-cell-header"><?php echo JLText::getText('JL_AWAYTEAM'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_SCORE'); ?></th>
							<th class="games-table-cell-header "><?php echo JLText::getText('JL_LOCATION'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_CONFERENCE'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_STATUS'); ?></th>
						</tr>				
				</thead>
				<tbody>
			<?php
				$x = 0;
				foreach($games as $obj)
				{
					if ($x % 2) {
						$rowclass = "game-table-row-even";
					} else {
						$rowclass = "game-table-row-odd";
					}
					$x = $x + 1;
			?>
					<tr class="<?php echo $rowclass; ?>">
						<td class="games-table-cell-center"><?php echo $obj->getId();?></td>				
						<td class="games-table-cell-center"><?php echo $obj->getGameDate();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getGameTime();?></td>											
						<td class="games-table-cell"><?php echo $obj->getHometeam();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getHometeamScore();?></td>
						<td class="games-table-cell"><?php echo $obj->getAwayteam();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getAwayteamScore();?></td>
						<td class=""><?php echo $obj->getLocation();?></td>
						<td class="games-table-cell-center"><?php echo $obj->getConferenceGame();?></td>						
						<td class="games-table-cell-center"><?php echo $obj->getGameStatus();?></td>																
					</tr>
		<?php
				}
		?>
			</tbody>
		</table>
	
			<?php
				}
			?>				
 			
	</div>	
