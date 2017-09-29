			<table class="team-current-venues-table">
			<thead>
				<tr>
					<th><?php echo JLText::getText('JL_NAME'); ?></th>
					<th width="45%"><?php echo JLText::getText('JL_ADDRESS'); ?></th>
					<th><?php echo JLText::getText('JL_ACTIONS'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($venues) > 0 ) {	
				foreach ($venues as $venue) {
				?><tr>
					<td><?php echo $venue->getName(); ?></td>
					<td><?php echo $venue->getAddress(); ?></td>
					<td><a href="javascript:void(0);" onClick="removeTeamVenue(<?php echo $teamid; ?>,<?php echo $venue->getId();?>);">Remove</a></td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No Fields/Venues on file</td></tr>
				<?php
			}
			?>			
			</tbody>
			</table>
