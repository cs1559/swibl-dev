			
			<h3>Roster for <?php echo $season->getTitle(); ?> Season</h3>
			
			<table class="roster-table col-md-6">
			<thead>
				<tr>
					<th class="leftjust left-pad10 roster-table-cell-header">Last Name</th>
					<th class="leftjust left-pad10 roster-table-cell-header">First Name</th>
			<?php if (!$config->getProperty('rosters_locked')) { ?>					
					<th class="centerjust roster-table-cell-header">Actions</th>
			<?php } ?>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($players) > 0 ) {	
				foreach ($players as $player) {
				?><tr>
					<td class="leftjust left-pad10 "><?php echo $player->getLastName() ; ?></td>
					<td class="leftjust left-pad10 "><?php echo $player->getFirstName() ; ?></td>
					<?php
						$ssvc = &JLSecurityService::getInstance();
						if (!$config->getProperty('rosters_locked') || $ssvc->isAdmin()) { ?>
						<td class="centerjust">
						  <a href="javascript:void(0);" role="button" onClick="removePlayerFromRoster(<?php echo $player->getId();?>,<?php echo $roster->getTeamId();?>,<?php echo $roster->getSeason();?>);">Delete</a>
						  <a href="javascript:void(0);" role="button" onClick="editPlayerOnRoster(<?php echo $player->getId() ;?>,<?php echo $roster->getTeamId();?>,<?php echo $roster->getSeason();?>);">Edit</a>
						</td>						
					<?php }	

					?>					
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
