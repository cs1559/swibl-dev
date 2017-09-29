<h2>League Contacts</h2>

The following are the SWIBL League Contacts by Divisions.   For questions about the League, its 
management and operation of the league, please contact Andy Maushbaugh at 618-304-0668. 

<div id="teamlist-body">
<br/>	
<?php foreach ($divisions as $division) { 
		$contact = $division->getPrimaryContact();
		?>
		<div class="teamlist-row">
			<table id="teamlist-table" width="100%">
			<thead>
			</thead>
			<tbody>
			<tr>
				<td class="" style="width: 150px; vertical-align: top;"><strong><?php echo $division->getName(); ?></strong></td>
				<td>
					<?php if (empty($contact)) { 
						 echo JLText::getText('JL_NO_LEAGUE_CONTACT_DEFINED'); 
					 } else { 
						 echo $contact->getName() . "<br/>";
						 echo $contact->getCellPhone() . "<br/>";
						echo JLApplication::cloakEmail($contact->getEmail()) . "<br/>";
					 } ?>
				</td>
				<?php
				$contact = $division->getSecondaryContact(); 
				if (!empty($contact)) {
				?>
				<td>
					<?php if (empty($contact)) { 
						 echo JLText::getText('JL_NO_LEAGUE_CONTACT_DEFINED'); 
					 } else { 
						 echo $contact->getName() . "<br/>";
						 echo $contact->getCellPhone() . "<br/>";
						echo JLApplication::cloakEmail($contact->getEmail()) . "<br/>";
					 } ?>
				</td>
			<?php } ?>				
				
			</tr>
			</tbody>
			</table>
		</div>
		<?php
		}
	?>
</div>




