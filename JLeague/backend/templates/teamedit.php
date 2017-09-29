<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelTeams') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.name.value == '') {
			alert('Team Name is required');
			form.name.focus();
			return;
		} else {
			submitform( pressbutton );
		}
	}
	
</script>

<div class="col width-55">

<ul class="nav nav-tabs" id="myTabTabs">
	<li class=" active"><a href="#team-details" data-toggle="tab">Team Information</a></li>
	<li class=""><a href="#team-current-contacts" data-toggle="tab">Contacts</a></li>
</ul>

<div class="tab-content" id="myTabContent">

	<div id="team-details" class="tab-pane active">
		<form method="post" id="adminForm" name="adminForm" action="index.php">
			<fieldset>
			<legend><?php echo JLText::getText('COM_JLEAGUE_TEAM_INFORMATION'); ?></legend>
			<table class="admintable">
				<tbody>
					<tr>
						<td class="key"><?php echo JLText::getText('COM_JLEAGUE_ID'); ?></td>
						<td><?php echo $team->getId(); ?><input type="hidden" name="id" value="<?php echo $team->getId(); ?>"/></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('COM_JLEAGUE_NAME'); ?></td>
						<td><input type="text" name="name" value="<?php echo $team->getName(); ?>" size="50" /></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Home City'); ?></td>
						<td><input type="text" name="city" value="<?php echo $team->getCity(); ?>" size="30" /></td>
					</tr>	
					<tr>
						<td class="key"><?php echo JLText::getText('Home State'); ?></td>
						<td><input type="text" name="state" value="<?php echo $team->getState(); ?>" size="15" /></td>
					</tr>				
					<tr>
						<td class="key"><?php echo JLText::getText('Team Website'); ?></td>
						<td><input type="text" name="website" value="<?php echo $team->getWebsite(); ?>" size="100" /></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('COM_JLEAGUE_COACHES_NAME'); ?></td>
						<td><input type="text" name="coachname" value="<?php echo $team->getCoachName(); ?>" size="50" /></td>
					</tr>													
					<tr>
						<td class="key"><?php echo JLText::getText('COM_JLEAGUE_COACHES_EMAIL'); ?></td>
						<td><input type="text" name="coachemail" value="<?php echo $team->getCoachEmail(); ?>" size="70" /></td>
					</tr>													
					<tr>
						<td class="key"><?php echo JLText::getText('COM_JLEAGUE_COACHES_PHONE'); ?></td>
						<td><input type="text" name="coachphone" value="<?php echo $team->getCoachPhone(); ?>" size="25" /></td>
					</tr>		
					<tr>
						<td class="key"><?php echo JLText::getText('COM_JLEAGUE_TEAMPROFILE_OWNER'); ?></td>
						<td><?php echo JLHtml::getTeamOwnerSelectList('ownerid',$team->getOwnerId()); ?></td>
					</tr>
					
				</tbody>
			</table>
			</fieldset>		
			<input type="hidden" name="option" value="com_jleague"/> 
			<input type="hidden" name="controller" value="teams"/>
			<input type="hidden" name="task" value="save"/> 
			<input type="hidden" name="boxchecked" value="0"/>
	</form>
	</div>
	
	<div id="team-current-contacts" class="tab-pane">
		<fieldset>
			<legend><?php echo JLText::getText('COM_JLEAGUE_CURRENT_CONTACTS'); ?></legend>
			<div id="team-current-contacts-list">
				<?php echo $currentcontactstable; ?>
			</div>
		</fieldset>
	</div>
	
		
	<?php if ($team->getId() > 0 ) {?>
	
	<div id="team-contact-input" class="tab-pane">
		<form id="team-contact-input-form" method="post" name="contactForm" onSubmit='return false;' action="index.php">
		<fieldset>
			<legend>Add <?php echo JLText::getText('COM_JLEAGUE_CONTACT_INFORMATION'); ?></legend>
			<table  class="admintable" width="100%">
				<tbody>
					<tr>
						<td class="key">Name:</td><td><input type="text" name="contactname" size="40"/></td>
					</tr>
					<tr>
						<td class="key">Email:</td><td> <input type="text" name="contactemail" size="70"/></td>
					</tr>
					<tr>
						<td class="key">Phone:</td><td><input type="text" name="contactphone"/ size="20"></td>
					</tr>					
					<tr>
						<td class="key">Role:</td><td><?php echo JLHtml::getTeamContactRolesList('role',JLText::getText('JL_COACH')); ?></td>
					</tr>
				</tbody>
			</table>
			<input type="button" value="Add Contact" onClick="addTeamContact(document.contactForm);"/>
			<input type="hidden" name="teamid" value="<?php echo $team->getId(); ?>"/> 
			<input type="hidden" name="option" value="com_jleague"/> 
			<input type="hidden" name="controller" value="teams"/>
			<input type="hidden" name="task" value="ajaxAddTeamContact"/> 
			<input type="hidden" name="boxchecked" value="0"/>		
		</fieldset>
		</form>
	</div>
	
<?php } ?>

</div>