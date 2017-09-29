		
			<table class="swibl-table-max">
			<thead>
				<tr>
					<th class="table-heading-left">Venue Name</th>
					<th class="table-heading-left">Address</th>
					<th class="table-heading-left">Action</th>
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
				<tr><td colspan="6">No Venues defined</td></tr>
				<?php
			}
			?>			
			</tbody>
			</table>
