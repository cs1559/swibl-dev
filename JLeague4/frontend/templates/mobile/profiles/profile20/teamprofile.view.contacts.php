

		<table class="teamprofile-table swibl-table-max table-striped table-responsive">
				<thead>
					<tr>
						<th>Name</th>
						<th class="hidden-sm hidden-xs hidden-tablet hidden-phone">Email</th>
						<th>Phone</th>
						<th>Primary</th>
						<th class="hidden-sm hidden-xs hidden-tablet hidden-phone">Role</th>
					</tr>
				</thead>
				<tbody>
				<?php 		
				if (count($contacts) > 0 ) {	
					foreach ($contacts as $contact) {
					?><tr>
						<td><?php echo $contact->getName(); ?></td>
						<td class="hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo $_view->displayPrivateField($contact->getEmail()); ?></td>
						<td><?php echo $_view->displayPrivateField($contact->getPhone()); ?></td>
						<td><?php 
								if ($contact->isPrimary()) {
									echo "Yes";
								} else {
									echo "No";
								}
						?></td>
						<td class="hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo $contact->getRole(); ?></td>
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
