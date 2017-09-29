			
			<table class="roster-table width-100">
			<thead>
				<tr>
					<!-- <th class="centerjust width-10 roster-table-cell-header"><?php echo JLText::getText('JL_PLAYER_NUMBER'); ?></th> -->				
					<th class="leftjust left-pad10 roster-table-cell-header"><?php echo JLText::getText('JL_PLAYER_NAME'); ?></th>
					<!-- <th class="leftjust left-pad10 roster-table-cell-header"><?php echo JLText::getText('JL_PLAYER_DOB'); ?></th> -->  					
<?php if (!$_config->getProperty('rosters_locked')) { ?>					
					<th class="centerjust roster-table-cell-header"><?php echo JLText::getText('JL_ACTIONS'); ?></th>
<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($players) > 0 ) {	
				foreach ($players as $player) {
				?><tr>
					<!--  <td class="centerjust width-10"><?php echo $player->getNumber(); ?></td> -->				
					<td class="leftjust left-pad10 "><?php echo $player->getFirstName() . " " . $player->getLastName(); ?></td>
					<!-- <td class="leftjust left-pad10 "><?php echo $player->getDateOfBirth(); ?></td>  -->
					<?php if (!$_config->getProperty('rosters_locked')) { ?>
						<td class="centerjust">
							<a href="javascript:void(0);" onClick="removePlayerFromRoster(<?php echo $player->getId() ;?>);">Remove</a>
						</td>
					<?php } ?>					
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No Players on file</td></tr>
				<?php
			}
			?>			
			</tbody>
			</table>
