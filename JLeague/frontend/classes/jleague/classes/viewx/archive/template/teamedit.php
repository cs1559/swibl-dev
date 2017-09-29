<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
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

<form method="post" name="adminForm" action="index2.php">

	<div class="col width-55">
		<fieldset>
		<legend>Team Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('Id'); ?></td>
					<td><?php echo $team->getId(); ?><input type="hidden" name="id" value="<?php echo $team->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Name'); ?></td>
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
			</tbody>
		</table>
		</fieldset>		
		
		<?php 
			if ($team->getId()) {
		
		?>
		<fieldset>
			<legend>Contact Information</legend>
		</fieldset>
		<?php 
			}
		?>
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="teams"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>
		
	</div>

</form>


