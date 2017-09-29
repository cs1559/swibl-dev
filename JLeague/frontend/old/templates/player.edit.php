<form name="editprofile" method="post" action="index.php">
	
<div class="jleague-title">
<h2>Player Profile Information</h2>
</div>
<div>
	<table class="teamprofile-edit-table">
		<tr><td class="teamprofile-input">ID:</td><td><?php echo $player->getId() ?></td></tr>
		<tr><td class="teamprofile-input">First Name:</td><td><?php echo $this->getInputElement('firstname',$player->getFirstName(),50,50); ?></td></tr>
		<tr><td class="teamprofile-input">Last Name:</td><td><?php echo $this->getInputElement('lastname',$player->getLastName(),50,50); ?></td></tr>		
		<tr><td class="teamprofile-input">City:</td><td><?php echo $this->getInputElement('city',$player->getCity()); ?></td></tr>		
		<tr><td class="teamprofile-input">State:</td><td><?php echo $this->getInputElement('state',$player->getState(),15,2); ?></td></tr>		
	</table>
</div>

	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="players"/>
	<input type="hidden" name="returnurl" value="<?php echo $returnurl; ?>"/>
	<input type="hidden" name="task" value="doUpdate"/>
	<input type="hidden" name="playerid" value="<?php echo $player->getId();?>"/>
	<input type="submit" name="submit" value="Save"/>	

</form>