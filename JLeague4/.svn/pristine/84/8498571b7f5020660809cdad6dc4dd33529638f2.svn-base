			<table class="team-current-roster-table">
			<thead>
				<tr>
					<th><?php echo JLText::getText('JL_PLAYER_NUMBER'); ?></th>
					<th><?php echo JLText::getText('JL_PLAYER_NAME'); ?></th>
					<th><?php echo JLText::getText('JL_ACTIONS'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($players) > 0 ) {	
				foreach ($players as $player) {
				?><tr>
					<td><?php echo $player->getName(); ?></td>
					<td><?php echo $contact->getNumber(); ?></td>
					<td><a href="javascript:void(0);" onClick="removeRosterPlayer(<?php echo $contact->getId();?>,<?php echo $contact->getTeamId();?>);">Remove</a></td>
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
