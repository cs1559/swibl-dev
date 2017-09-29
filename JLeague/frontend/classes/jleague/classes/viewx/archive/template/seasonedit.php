<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelSeason') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.title.value == '') {
			alert('Season title is required');
			form.title.focus();
			return;
		} else {
			submitform( pressbutton );
		}
	}
</script>

<form method="post" name="adminForm" action="index2.php">

	<div class="col width-55">
		<fieldset>
		<legend>Season Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('Id'); ?></td>
					<td><?php echo $season->getId(); ?><input type="hidden" name="id" value="<?php echo $season->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Title'); ?></td>
					<td><input type="text" name="title" value="<?php echo $season->getTitle(); ?>" size="50" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Description'); ?></td>
					<td><textarea rows="5" cols="50" name="description"><?php echo $season->getDescription(); ?></textarea></td>
				</tr>
				
				<tr>
					<td class="key"><?php echo JLText::getText('Published'); ?></td>
					<td><?php echo JLHtml::getPublishedSelectList('published',$season->getPublished()); ?></td>
				</tr>				
			</tbody>
		</table>
		</fieldset>		
		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="seasons"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>
		
	</div>
	
	<div class='col width-45'>
		<fieldset>
			<legend><?php echo JLText::getText('Statistics'); ?></legend>
			<table style="width: 100%">
				<tr>
					<td class="key"><?php echo JLText::getText('Total Divisions'); ?></td>
					<td><?php echo $season->getTotalDivisions(); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Total Teams'); ?></td>
					<td><?php echo $season->getTotalTeams(); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Total Games Played'); ?></td>
					<td><?php echo $season->getTotalGames(); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Total League Games'); ?></td>
					<td><?php echo $season->getTotalLeagueGames(); ?></td>
				</tr>				
			</table>
		</fieldset>
	</div>
</form>


