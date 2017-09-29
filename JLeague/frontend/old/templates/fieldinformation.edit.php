<div id="teamprofile-header" class="jleague-section-block">
	<div id="teamprofile-abbr-logo">
		<img src="<?php echo $_config->getProperty('logo_folder') . "thumb-" . $team->getLogo();?>"/>
	</div>
	<div id="teamprofile-abbr-info">
		<div id="teamprofile-info-teamname"><?php echo $team->getName(); ?></div></br>
			<?php echo $team->getCity() . ", " . $team->getState(); ?>
	</div>
</div>

<br />
<div class="clr"/></div>
<?php echo $submenu2; ?>

<form name="editfieldinfo" method="post" action="index.php">
	
<div class="jleague-title">
<h2>Field Information</h2>
</div>
<div>
	<table class="teamprofile-edit-table">
		<tr><td class="teamprofile-input">Field Name:</td><td><?php echo $this->getInputElement('fieldname',$team->getHomeField(),50,50); ?></td></tr>
		<tr><td class="teamprofile-input">Address:</td><td><?php echo $this->getInputElement('fieldaddress',$team->getFieldAddress(),50,50); ?></td></tr>		
		<tr><td class="teamprofile-input">Directions:</td><td><?php echo $this->getTextAreaElement('fielddirections',$team->getFieldDirections(),15,50); ?></td></tr>		
	</table>
</div>

	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="teams"/>
	<input type="hidden" name="task" value="doUpdate"/>
	<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
	<input type="submit" name="submit" value="Save"/>
		
</form>