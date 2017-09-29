<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelDivision') {
			submitform( pressbutton );
			return;
		}
		if (form.league_id.value == 0) {
			alert('League must be specified');
			return;
		}
		if (form.season_id.value == 0) {
			alert('Season must be specified');
			return;
		}
		// do field validation
		if (form.name.value == '') {
			alert('Division Name is required');
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
		<legend>Division Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('Id'); ?></td>
					<td><?php echo $division->getId(); ?><input type="hidden" name="id" value="<?php echo $division->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Name'); ?></td>
					<td><input type="text" name="name" value="<?php echo $division->getName(); ?>" size="50" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Age Group'); ?></td>
					<td><?php echo JLHtml::getAgeGroupSelectList('agegroup',$division->getAgeGroup()); ?></td>
				</tr>
				
				<tr>
					<td class="key"><?php echo JLText::getText('League'); ?></td>
					<td><?php echo JLHtml::getLeagueSelectList('league_id',$division->getLeagueId()); ?></td>
				</tr>					
				<tr>
					<td class="key"><?php echo JLText::getText('Season'); ?></td>
					<td><?php echo JLHtml::getSeasonSelectList('season_id',$division->getSeasonId()); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Primary Contact'); ?></td>
					<td><?php echo JLHtml::getLeagueContactSelectList('primarycontactid',$division->getPrimaryContactId()); ?></td>
				</tr>		
				<tr>
					<td class="key"><?php echo JLText::getText('Order'); ?></td>
					<td><input type="text" name="order" value="<?php echo $division->getOrder(); ?>" size="10" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Published'); ?></td>
					<td><?php echo JLHtml::getPublishedSelectList('published',$division->getPublished()); ?></td>
				</tr>				
			</tbody>
		</table>
		</fieldset>		
		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="divisions"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>
		
	</div>

</form>


