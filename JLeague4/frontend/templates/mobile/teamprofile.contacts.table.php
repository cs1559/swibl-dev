		
			<table class="swibl-table-max">
			<thead>
				<tr>
					<th  class="table-heading-left">Name</th>
					<th class="hidden-sm hidden-xs table-heading-left">Email</th>
					<th  class="table-heading-left table-heading-left">Phone</th>
					<th  class="table-heading-left">Primary</th>
					<th class="hidden-sm hidden-xs table-heading-left">Role</th>
					<th class="hidden-sm hidden-xs table-heading-left">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($contacts) > 0 ) {	
				foreach ($contacts as $contact) {
				?><tr>
					<td><?php echo $contact->getName(); ?></td>
					<td class="hidden-sm hidden-xs"><?php echo $contact->getEmail(); ?></td>
					<td><?php echo $contact->getPhone(); ?></td>
					<td><?php 
							if ($contact->isPrimary()) {
								echo "Yes";
							} else {
								echo "No";
							}
					?></td>
					<td class="hidden-sm hidden-xs"><?php echo $contact->getRole(); ?></td>
					<td class="hidden-sm hidden-xs">
						<a href="javascript:void(0);" role="button" onClick="removeTeamContact(<?php echo $contact->getId();?>,<?php echo $contact->getTeamId();?>);">Remove</a>
						<a href="javascript:void(0);" role="button" onClick="editTeamContact(<?php echo $contact->getId();?>,<?php echo $contact->getTeamId();?>);">Edit</a>
					</td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No Contacts on file</td></tr>
				<?php
			}
			?>			
			</tbody>
			</table>
