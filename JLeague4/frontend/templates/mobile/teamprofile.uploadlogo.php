<?php
?>

<form id="uploadForm" enctype="multipart/form-data" method="post" action="index.php" onsubmit="return validateUploadLogoForm(this);">
<fieldset>

<!-- Form Name -->
<legend><?php echo $team->getName(); ?> - Upload Team Logo</legend>
<div class="row">
	<div class="col-md-5" >
		<div id="teamprofile-logo">
			<h5>Current Image</h5>
			<img src="<?php echo JURI::base() . DS .  $config->getProperty('logo_folder') . $team->getLogo();?>"/>
		</div>
	</div>
	<div class="col-md-7">
		<p>You can upload a new logo for your team from this page.  Images will automatically be resized.</p>
		<input id="file-upload" class="" type="file" style="color: rgb(102, 102, 102);" name="Filedata"/>

		<!-- 
		<input type="hidden" value="executeUploadLogo" name="task"/>
		<input type="hidden" value="teams" name="controller"/>
		<input type="hidden" name="option" value="com_jleague"/>
		 -->		
		<input type="hidden" name="teamid" value="<?php echo $team->getId(); ?>"/>
		
<p>		
<!-- Button (Double) -->
<div class="control-group">
  <div class="controls">
    <button id="saveButton" 
    	name="saveButton"
    	class="btn btn-success"
    	type="submit"
    	formmethod="post"
    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=executeUploadLogo&teamid='. $team->getSlug()); ?>"
    	value="Upload">Upload
    </button>
    <button id="cancelButton" 
    	name="cancelButton" 
    	class="btn btn-primary btn-xs"
    	type="button" 
    	onClick="window.location='<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='. $team->getSlug()); ?>'"
    	value="Return">Return to Profile</button>
    	
    </div>
    
  </div>
</div>
</p>		
		
	</div>
</div>


</fieldset>

</form>
