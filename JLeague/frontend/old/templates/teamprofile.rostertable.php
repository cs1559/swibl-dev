	

	<div id="teamprofile-roster-detail">
			<a href="javascript:void(0);" title="Create Printer Friendly Version of Roster" onClick="openWindow('<?php echo JRoute::_('index.php?option=com_jleague&controller=rosters&tmpl=component&task=printroster&teamid=' . $roster->getTeamId() . '&season='.$roster->getSeason());?>')">Print Roster</a>
			<table id="roster-table" style="width: 100%">
				<thead>
						<tr class="games-table-header-row">
							<th class="games-table-cell-header "><?php echo JLText::getText('JL_LASTNAME'); ?></th>
							<th class="games-table-cell-header "><?php echo JLText::getText('JL_FIRSTNAME'); ?></th>
						</tr>				
				</thead>
				<tbody>
			<?php
				$x = 0;
				foreach($players as $player)
				{
					if ($x % 2) {
						$rowclass = "game-table-row-even";
					} else {
						$rowclass = "game-table-row-odd";
					}
					$x = $x + 1;
			?>
					<tr class="<?php echo $rowclass; ?>">
						<td class=""><?php echo $player->getLastName();?></td>
						<td class=""><?php echo $player->getFirstName(); ?></td>
					</tr>
		<?php
				}
		?>
			</tbody>
		</table>
	
			<?php
				if (sizeof($players) == 0) {
			?> 
					<p><strong>No roster has been defined</strong></p>
			<?php 
				}
			?>				
 			
	</div>	
