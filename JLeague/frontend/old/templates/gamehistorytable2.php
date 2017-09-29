	<div id="teamprofile-gamehistory-detail">
	<?php
		if (sizeof($games)==0) {
			echo JLText::getText('No games have been played');;
		} else {		
	 ?>		
			<table id="games-table">
				<thead>
						<tr class="games-table-header-row">
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_GAMEID'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_DATE'); ?></th>
							<th class="games-table-cell-header"><?php echo JLText::getText('JL_OPPONENT'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_WL'); ?></th>
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_SCORE'); ?></th>														
							<th class="games-table-cell-header games-table-cell-center"><?php echo JLText::getText('JL_CONFERENCE'); ?></th>
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
						<td class="games-table-cell"><?php echo $_view->getOpponent($team,$obj); ?></td>
						<?php
							if ($obj->getGameStatus() == "C") { 
						 ?>
								<td class="games-table-cell-center"><?php echo "**";?></td>						 
								<td class="games-table-cell-center"><?php echo $obj->getHometeamScore() . "-" . $obj->getAwayteamScore();?></td>
								<td class="games-table-cell-center"><?php echo $obj->getConferenceGame();?></td>
						<?php 
							} else {
								$gamestatus = "";
								if ($obj->getGameStatus() == "R") {
									$gamestatus = "Rained Out";
								}
								if ($obj->getGameStatus() == "X") {
									$gamestatus = "Cancelled";
								}
								if ($obj->getGameStatus() == "D") {
									$gamestatus = "Suspended";
								}								
								
						?>
							<td class="games-non-complete-message" colspan="2"><?php echo '** ' . $gamestatus . ' **'; ?></td>
						<?php
							}
						?>												
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
