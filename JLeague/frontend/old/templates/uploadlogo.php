<?php include('teamprofile.edit.miniheader.php'); ?>

<div class="clr"/></div>
			
<div class="jleague-title">
<h2>Change Team Logo</h2>
</div>
<div>
	<?php echo JLText::getText('JL_PROFILE_SUBMENU_UPLOAD_NOTE'); ?>
	<br/><br/>
	<form id="uploadForm" enctype="multipart/form-data" method="post" action="index.php">
	<input id="file-upload" class="inputbox button" type="file" style="color: rgb(102, 102, 102);" name="Filedata"/>
	<input id="file-upload-submit" class="button" type="submit" value="Upload" size="30"/>
	<input type="hidden" value="executeUploadLogo" name="task"/>
	<input type="hidden" value="teams" name="controller"/>
	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="teamid" value="<?php echo $team->getId(); ?>"/>
	</form>
</div>
<div class="jleague-title">
<h2>Current Image</h2>
</div>
<br/>
	<div id="teamprofile-logo">
		<img src="<?php echo $_config->getProperty('logo_folder') . $team->getLogo();?>"/>
	</div>
