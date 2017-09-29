<div id="teamprofile-recordhistory" class="jleague-section-block">
<?php 
	if (!isset($showheader)) {
		$showheader = true;
	}
	if ($showheader) { 
?>
	<div class="teamprofile-sectionheader teamprofile-sectionheader-left">
	<div class="teamprofile-sectionheader-right">
		Contacts
	</div>
	</div>

<?php } ?>	
	<div id="teamprofile-contacts-detail">
	<?php
		if (sizeof($contacts)==0) {
			echo JLText::getText('JL_NO_CONTACTS_DEFINED');;
		} else {		
	 ?>
			<table id="contacts-table" class="width-100">
				<thead>
						<tr class="contacts-header-row">
							<th class="leftjust"><?php echo JLText::getText('JL_NAME'); ?></th>
							<th class="leftjust"><?php echo JLText::getText('JL_PHONE'); ?></th>
							<th class="leftjust"><?php echo JLText::getText('JL_ROLE'); ?></th>
						</tr>				
				</thead>
				<tbody>
			<?php
				foreach($contacts as $contact)
				{
			?>
					<tr>
						<td class="contacts-cell"><?php echo $contact->getName();?></td>
						<td class="contacts-cell"><?php echo $contact->getPhone();?></td>
						<td class="contacts-cell"><?php echo $contact->getRole();?></td>
						<td class="contacts-cell"><?php echo $helper->getTeamContactUserIndicator($contact); ?></td>
					</tr>
			<?php
				}
			?>
			</tbody>
		</table>
		<?php 
			}
		 ?>
	</div>		

</div> 