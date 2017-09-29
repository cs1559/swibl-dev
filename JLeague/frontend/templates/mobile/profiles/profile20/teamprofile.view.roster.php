

<table class="teamprofile-table swibl-table-max table-striped table-responsive">
			<thead>
				<tr>
					<th>Last Name</th>
					<th>First Name</th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($players) > 0 ) {	
				foreach ($players as $player) {
				?><tr>
						<td class=""><?php echo $player->getLastName();?></td>
						<td class=""><?php echo $player->getFirstName(); ?></td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No roster on file</td></tr>
				<?php
			}
			?>			
			</tbody>
</table>

