			<table class="team-current-contacts-table">
			<thead>
				<tr>
					<th><?php echo JLText::getText('COM_JLEAGUE_NAME'); ?></th>
					<th><?php echo JLText::getText('COM_JLEAGUE_EMAIL'); ?></th>
					<th><?php echo JLText::getText('COM_JLEAGUE_PHONE'); ?></th>
					<th><?php echo JLText::getText('COM_JLEAGUE_ROLE'); ?></th>
					<th><?php echo JLText::getText('COM_JLEAGUE_ACTIONS'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($contacts) > 0 ) {	
				foreach ($contacts as $contact) {
				?><tr>
					<td><?php echo $contact->getName(); ?></td>
					<td><?php echo $contact->getEmail(); ?></td>
					<td><?php echo $contact->getPhone(); ?></td>
					<td><?php echo $contact->getRole(); ?></td>
					<td><a href="javascript:void(0);" onClick="removeTeamContact(<?php echo $contact->getId();?>,<?php echo $contact->getTeamId();?>);">Remove</a></td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6"><?php echo JLText::getText('COM_JLEAGUE_NO_CONTACTS_DEFINED'); ?></td></tr>
				<?php
			}
			?>			
			</tbody>
			</table>
