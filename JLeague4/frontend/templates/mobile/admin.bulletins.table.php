		
			<table class="swibl-table-max"">
			<thead>
				<tr>
					<th>ID</th>
					<th>Type</th>
					<th>Date/Timestamp</th>
					<th>Title</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($bulletins) > 0 ) {	
				foreach ($bulletins as $bulletin) {
				?><tr>
					<td><?php echo $bulletin->getId(); ?></td>
					<td><?php echo $bulletin->getType(); ?></td>
					<td><?php echo $bulletin->getDateInserted(); ?>
					<td><?php echo $bulletin->getTitle(); ?></td>
					<td class="hidden-sm">
						<a href="javascript:void(0);" role="button" onClick="removeTeamBulletin(<?php echo $bulletin->getId();?>,<?php echo $bulletin->getTeamId();?>);">Remove</a>
						<a href="javascript:void(0);" role="button" onClick="editTeamBulletin(<?php echo $bulletin->getId();?>,<?php echo $bulletin->getTeamId();?>);">Edit</a>
					</td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No Bulletins on file</td></tr>
				<?php
			}
			?>			
			</tbody>
			</table>
