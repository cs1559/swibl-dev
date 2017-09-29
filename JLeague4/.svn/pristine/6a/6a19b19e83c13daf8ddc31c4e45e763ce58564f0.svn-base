	
	<div id="standings-body">
		<span id="standings-league-description">League Standings - <?php echo $season->getDescription(); ?></span>
		<br/>
		<span class="system_message"><?php echo $season_note; ?></span>
		<!-- <br/>   --> <br/>
		<!--  <table id="standings-table">-->
		<?php
			$x		= 0;
			$prevdiv = 0;
			$first = true;
			foreach($standings as $obj)
			{
				if ($x % 2) {
					$rowclass = "game-table-row-even";
				} else {
					$rowclass = "game-table-row-odd";
				}
				$x  += 1;
				if ($obj->getDivisionId() != $prevdiv) {
					$divobj = $divdao->findById($obj->getDivisionId());
					if ($first) {
						?>
							<table id="standings-table">
						<?php
					}  				
					?>
					<tr class="standings-table-division-header-row"><td class="standings-table-division-header" colspan="99"><a name="divid-<?php echo $divobj->getId();?>"><?php echo $divobj->getName(); ?></a></td></tr>
					
					<!--  <tr><td colspan="9"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#top"><span>Back to top</span></a></td></tr> -->
					<tr class="standings-table-division-subheader-row">
						<?php if ($_config->getProperty('show_position_in_standings')) { ?>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_POSITION'); ?></td>
						<?php } ?>
						<td><?php echo JLText::getText('JL_TEAM'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_WINS'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_LOSSES'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_TIES'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_GAMESPLAYED'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_POINTS'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_RUNSSCORED_ABBR'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_RUNSALLOWED_ABBR'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_DIFF'); ?></td>
						<td class="standings-table-stats-cell-header"><?php echo JLText::getText('JL_WINPCT'); ?></td>
					</tr>				
					<?php
					$prevdiv = $obj->getDivisionId();
				}
	?>
				<tr class="<?php echo $rowclass; ?>">
					<?php 
					if ($_config->getProperty('show_position_in_standings')) {
					?>
				
					<td class="standings-table-stats-cell">
						<?php echo $obj->getPosition();?>
					</td>	
					<?php } ?>									
					<td>
						<?php 
//							$link		= JRoute::_( 'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=' .$obj->getTeamId() );						
							$link		= JRoute::_( 'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=' .$obj->getSlug() . "&Itemid=9999999" );
							echo JHTML::_('link', $link , $obj->getTeamName(), array('id' => "team".$obj->getTeamId() ));
							//echo $obj->getTeamName(); 
						
						?>
					</td>
			
					<td class="standings-table-stats-cell">
						<?php echo $obj->getWins();?>
					</td>				
					<td class="standings-table-stats-cell">
						<?php echo $obj->getLosses();?>
					</td>
					<td class="standings-table-stats-cell">
						<?php echo $obj->getTies(); ?>
					</td>			
					<td class="standings-table-stats-cell">
						<?php echo $obj->getTotalGames(); ?>
					</td>			
					<td class="standings-table-stats-cell">
						<?php echo $obj->getPoints();?>
					</td>
					<td class="standings-table-stats-cell">
						<?php echo $obj->getRunsScored();?>
					</td>
					<td class="standings-table-stats-cell">
						<?php echo $obj->getRunsAllowed();?>
					</td>
					<td class="standings-table-stats-cell">
						<?php echo $obj->getRunsScored() - $obj->getRunsAllowed();?>
					</td>					
					<td class="standings-table-stats-cell">
						<?php
							echo number_format($obj->getWinningPercentage(),4);
						?>
					</td>
				</tr>
	<?php
			}
	?>
			</table>
	
	</div>