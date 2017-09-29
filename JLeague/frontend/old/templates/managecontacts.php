<?php include('teamprofile.edit.miniheader.php'); ?>

<div class="clr"/></div>
<br />

<strong>NOTE:  The head coach should be added by editing the TEAM PROFILE.  It should not be added as a contact. </strong>
	
<div class="jleague-title">
<h2>Contacts</h2>
</div>

<br/>

<div id="managecontacts-form">
	<form id="team-contact-input-form" name="contactForm" method="post" action="index.php">
		<table  class="admintable" width="100%">
			<tbody>
				<tr>
					<td class="key">Name:</td><td><input type="text" name="contactname" size="40"/></td>
				</tr>
				<tr>
					<td class="key">Email (One Email please):</td><td> <input type="text" name="contactemail" size="70"/></td>
				</tr>
				<tr>
					<td class="key">Phone:</td><td><input type="text" name="contactphone"/ size="20"></td>
				</tr>					
				<tr>
					<td class="key">Role:</td><td><?php echo JLHtml::getTeamContactRolesList('role',JLText::getText('JL_COACH')); ?></td>
				</tr>
				<tr>
					<td class="key">Website Username:</td><td><?php echo JLHtml::getUserSelectList('userid',0); ?><br/>
						NOTE:  Associating the contact to a user account enables that user to EDIT your team profile.
					</td>
				</tr>
				
			</tbody>
		</table>
		<br/>
		<input type="button" value="Add Contact" onClick="addTeamContact(document.contactForm);"/>

	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="teams"/>
	<input type="hidden" name="task" value="ajaxAddTeamContact"/>
	<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>

	</form>
</div>
<div class="jleague-title">
<h2>Existing Contacts</h2>
</div>
<br/>
<div id="team-current-contacts-list">
	<?php echo $currentcontactstable; ?>
</div>
