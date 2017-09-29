
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelRegistration') {
			submitform( pressbutton );
			return;
		}
		if (form.season_id.value == 0) {
			alert('Season must be specified');
			return;
		}
		if (form.division_id.value == 0) {
			alert('Division must be specified');
			return;
		}
		submitform( pressbutton );
		//document.adminForm.submit();
	}
</script>

<form method="post" id="adminForm" name="adminForm" action="index.php">

	<div class="col width-55">
		<fieldset>
		<legend>Registration Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('Season'); ?></td>
					<td><?php echo $season->getTitle(); ?><input type="hidden" name="season_id" value="<?php echo $season->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Team'); ?></td>
					<td><?php echo $team->getName(); ?><input type="hidden" name="team_id" value="<?php echo $team->getId(); ?>"/></td>
				</tr>
				
				<tr>
					<td class="key"><?php echo JLText::getText('Division'); ?></td>
					<td><?php echo JLHtml::getDivisionSelectList('division_id',0, $season->getId()); ?></td>
				</tr>		

				<tr>
					<td class="key"><?php echo JLText::getText('Published'); ?></td>
					<td><?php echo JLHtml::getYesNoSelectList('published',0); ?></td>
				</tr>		

			</tbody>
		</table>
		</fieldset>		
		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="teams"/>
		<input type="hidden" name="task" value="saveRegistration"/> 
		<input type="hidden" name="boxchecked" value="0"/>
		
	</div>

</form>

