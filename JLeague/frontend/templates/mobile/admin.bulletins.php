		
	
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Team Bulletins</h4>
	      </div>
	      <div class="modal-body">
				<div id="managebulletin-form">
					<form id="team-bulletin-input-form" name="bulletinForm" class="form-horizontal"  method="post" action="index.php">
	
					<div class="form-group">
					  <label class="col-sm-3 control-label" for="role">Bulletin Type:</label>
					  <div class="controls">
					  	<?php echo mHtmlHelper::getBulletinTypeList("bulletin_type","0"); ?>
					   </div>
					</div>	
					
					<div class="form-group">
					  <label class="col-sm-3 control-label" for="bulletintitle">Title/Short Desc:</label>
					  <div class="controls">
					    <input id="bulletintitle" name="bulletintitle" class="input-lg" type="text"  value="<?php  isset($bulletin) ? PRINT ($bulletin->getTitle()) :"";  ?>">
					   </div>
					</div>
					
					<div class="form-group">
					  <label class="col-sm-3 control-label" for="bulletindesc">Description:</label>
					  <div class="controls">
					  
							<?php // echo $editor->display( 'bulletindesc',  isset($bulletin) ? PRINT ($bulletin->getDescription()) :"", '100', '75', '5', '5', false ) ;?>  
					  	 <textarea id="bulletindesc" name="bulletindesc" class="input-lg form-control" rows="6"><?php isset($bulletin) ? PRINT ($bulletin->getDescription()) :"";  ?></textarea>
					   </div>
					</div>
					
					<div class="form-group">
					  <label class="col-sm-3 control-label" for="contactname">Contact Name:</label>
					  <div class="controls">
					    <input id="contactname" name="contactname" class="input-lg" type="text"  value="<?php isset($bulletin) ? PRINT ($bulletin->getContactName()) :"";  ?>">
					   </div>
					</div>
					
					<div class="form-group">
					  <label class="col-sm-3 control-label" for="contactemail">Contact Email:</label>
					  <div class="controls">
					    <input id="contactemail" name="contactemail" class="input-lg" type="text"  value="<?php isset($bulletin) ? PRINT ($bulletin->getContactEmail()) :"";  ?>">
					    <span class="help-block col-sm-offset-3">NOTE:  Please enter only ONE (1) email address.</span>
					    
					   </div>
					</div>
				
					<div class="form-group">
					  <label class="col-sm-3 control-label" for="contactphone">Contact Phone:</label>
					  <div class="controls">
					    <input id="contactphone" name="contactphone" class="input-sm" type="text"  value="<?php isset($bulletin) ? PRINT ($bulletin->getPhone()) :"";  ?>">
					   </div>
					</div>
					
					
					<input type="hidden" name="option" value="com_jleague"/>
					<input type="hidden" name="controller" value="ajax"/>
					<input type="hidden" name="task" value="doSaveAdminBulletin"/>
					<input type="hidden" name="bulletinid" value="<?php isset($bulletin) ? PRINT ($bulletin->getId()) : 0; ?>"/>
					<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
				
					</form>
				</div>
			</div>  <!-- /.modal-body -->
	      <div class="modal-footer">
			<span id="modal_status_message" class="pull-left"></span>	
	       	<button type="button" class="btn btn-primary" aria-hidden="true" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" onClick="javascript: saveAdminBulletin(document.bulletinForm.bulletinid);">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
		
		
	<form class="button-form">
	<fieldset>
	
	<!-- Form Name -->
	<legend>Manage Admin Bulletins</legend>	
	
		<div class="teamprofile-toolbar">
		
       <button type="button" class="btn btn-primary btn-xs" onClick="javascript:addBulletin(0,0,true);">Add Bulletin</button>
	   
	   <button id="cancelButton" 
	    	name="cancelButton" 
	    	class="btn btn-primary btn-xs"
	    	formmethod="post"
	    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=admin&task=dashboard'); ?>"
	    	value="Return">Return to Dashboard</button>
	    	
	    </div>
	    	
		<div id="team-current-bulletin-list">
			<?php echo $bulletinstable; ?>
		</div>
		
	
	</fieldset>
	</form>