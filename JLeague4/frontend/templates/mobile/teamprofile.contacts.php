	


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Information</h4>
      </div>
      <div class="modal-body">
			<div id="managecontacts-form">
				<form id="team-contact-input-form" name="contactForm" class="form-horizontal"  method="post" role="form" action="index.php">
				
				<div class="form-group">
				  <label class="col-sm-3 form-control control-label form-control" for="contactname">Contact Name:</label>
				  <div class="controls">
				    <input id="contactname" class="form-control" name="contactname" placeholder="ex. John Doe" class="input-lg" type="text"  value="<?php isset($contact) ? PRINT ($contact->getName()) :"";  ?>">
				   </div>
				</div>
					
				<div class="form-group">
				  <label class="col-sm-3 control-label form-control" for="contactemail">Email:</label>
				  <div class="controls">
				    <input id="contactemail"  class="form-control" name="contactemail" placeholder="ex. john.doe@domain.com" class="input-lg" type="text"  value="<?php isset($contact) ? PRINT ($contact->getEmail()) :"";  ?>">
				    
				    
				   </div>
				</div>
			
				<div class="form-group">
				  <label class="col-sm-3 control-label form-control" for="contactphone">Phone:</label>
				  <div class="controls">
				    <input id="contactphone"  class="form-control" name="contactphone" placeholder="ex. 618-555-1212" class="input-sm" type="text"  value="<?php isset($contact) ? PRINT ($contact->getPhone()) :"";  ?>">
				   </div>
				</div>
				
				<div class="form-group">
				  <?php 
				  	if (isset($contact)) {
						if ($contact->isPrimary()) {
							$checked1 = "";
							$checked2 = "checked";
						} else {
							$checked1 = "checked";
							$checked2 = "";
						}
					} else {
							$checked1 = "checked";
							$checked2 = "";
					}
				  ?>
				  <label class="col-sm-3 control-label form-control" for="contactphone">Primary Contact:</label>
				  <div class="controls">
						<div class="radio col-sm-1">
						  <label>
						    <input type="radio" name="primarycontact"  class="form-control" id="optionsRadios1" value="0" <?php echo $checked1; ?>>
						    No
						  </label>
						</div>
						<div class="radio  col-sm-1">
						  <label>
						    <input type="radio" name="primarycontact"  class="form-control" id="optionsRadios2" value="1" <?php echo $checked2?>>
						    Yes
						  </label>
						</div>
				   </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-3 control-label form-control" for="role">Role:</label>
				  <div class="controls">
				  	<?php echo mHtmlHelper::getTeamContactRolesList("role","Coach"); ?>
				   </div>
				</div>				
	
				<div class="form-group">
				  <label class="col-sm-3 control-label form-control" for="role">Username:</label>
				  <div class="controls">
				  	<?php echo mHtmlHelper::getTeamOwnerSelectList("userid", 0); ?>
				  	<span class="help-block col-sm-offset-3">NOTE:  Assigning a user to a contact gives them permission to edit Team Profile.</span>
				   </div>
				</div>	
				
				<input type="hidden" name="option" value="com_jleague"/>
				<input type="hidden" name="controller" value="ajax"/>
				<input type="hidden" name="task" value="doSaveTeamContact"/>
				<input type="hidden" name="contactid" value="<?php isset($contact) ? PRINT ($contact->getId()) : 0; ?>"/>
				<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
			
				</form>
			</div>
		</div>  <!-- /.modal-body -->
      <div class="modal-footer">
      	<span id="modal_status_message" class="pull-left"></span>
       	<span><button type="button" class="btn btn-primary" aria-hidden="true" data-dismiss="modal">Close</button></span>
        <span><button type="button" class="btn btn-primary" onClick="javascript: saveTeamContact(document.contactForm.id);">Save changes</button></span>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	
<form class="button-form">
<fieldset>

<!-- Form Name -->
<legend><?php echo $team->getName(); ?> - Manage Contacts</legend>	

	<div class="teamprofile-toolbar">
	
	<button type="button" class="btn btn-primary btn-xs" 	onClick="javascript:editTeamContact(0,<?php echo $team->getId();?>);">Add Contact</button>
    	
   <button id="cancelButton" 
    	name="cancelButton" 
    	class="btn btn-primary btn-xs"
    	formmethod="post"
    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='. $team->getSlug()); ?>"
    	value="Return">Return to Profile</button>
    	
    </div>
     
	<p>
		<strong>NOTE:  At least ONE person should be identified as a PRIMARY contact.  This contact represents someone an opposing coach
		can contact for scheduling issues or if a game has to be canceled due to weather.
	    </strong>
	</p>
	
	<div id="team-current-contacts-list">
		<?php echo $contactstable; ?>
	</div>
	

</fieldset>
</form>