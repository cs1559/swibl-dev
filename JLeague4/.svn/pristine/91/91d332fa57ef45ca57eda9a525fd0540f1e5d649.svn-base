<?php include('teamprofile.edit.miniheader.php'); ?>

<div class="clr"/></div>

<form name="editprofile" method="post" action="index.php">
	
<div class="jleague-title">
<h2>Basic Profile Information</h2>
</div>
<div>
	<table class="teamprofile-edit-table">
		<tr><td class="teamprofile-input">ID:</td><td><?php echo $team->getId() ?></td></tr>
		<tr><td class="teamprofile-input">Team Name:</td><td><?php echo $this->getInputElement('teamname',$team->getName(),50,50); ?></td></tr>
		<tr><td class="teamprofile-input">City:</td><td><?php echo $this->getInputElement('city',$team->getCity()); ?></td></tr>		
		<tr><td class="teamprofile-input">State:</td><td><?php echo $this->getInputElement('state',$team->getState(),15,2); ?></td></tr>		
		<tr><td class="teamprofile-input">Website:</td><td><?php echo $this->getInputElement('website',$team->getWebsite(),75,100); ?></td></tr>
		<tr><td class="teamprofile-input">Head Coach:</td><td><?php echo $this->getInputElement('coachname',$team->getCoachName(),40,40); ?></td></tr>
		<tr><td class="teamprofile-input">Coach Email:</td><td><?php echo $this->getInputElement('coachemail',$team->getCoachEmail(),100,100); ?></td></tr>
		<tr><td class="teamprofile-input">Coach Phone:</td><td><?php echo $this->getInputElement('coachphone',$team->getCoachPhone(),25,12); ?></td></tr>
		<?php if ($security->isOwner($team)) { ?>
			<tr><td class="teamprofile-input">Owner:</td><td><?php echo JLHtml::getUserSelectList('ownerid',$team->getOwnerId()); ?></td></tr>
		 <?php } ?>
	</table>
</div>

<div class="jleague-title">
<h2>Custom Properties</h2>
</div>

<div>
<table>
<?php  
	foreach ($team->getCustomFields() as $fld) {
		?>
		<tr>
			<td class="teamprofile-input"><?php echo $fld->getName(); ?>:</td>
			<td>
		<?php
			echo JLFieldRenderer::render($fld);
		 ?>
		 	</td>
		 </tr>
<?php
	}
 ?>	
</table>
</div>

<br/>

	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="teams"/>
	<input type="hidden" name="task" value="doUpdate"/>
	<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
	<input type="submit" name="submit" value="Save"/>	
</form>