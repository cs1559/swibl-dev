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

<form method="post" id="adminForm" name="adminForm" action="index.php">

<ul class="nav nav-tabs" id="myTabTabs">
	<li class=""><a href="#general" data-toggle="tab">Season Configuration</a></li>
	<li class=""><a href="#registration" data-toggle="tab">Registration Options</a></li>
</ul>

<div class="tab-content" id="myTabContent">
	<div id="general" class="tab-pane active">
		<div class="span8">
		<fieldset>
		<legend>Season Configuration</legend>
		<table class="jl-admin-table">
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
					<td><textarea name="description" class="jl-admin-textarea"><?php echo $season->getDescription(); ?></textarea></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Status'); ?></td>
					<td><?php echo JLHtml::getSeasonStatus('status',$season->getStatus()); ?></td>				
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Active?'); ?></td>
					<td><?php echo JLHtml::getYesNoSelectList('active',$season->getActive()); ?></td>
				</tr>								
				<tr>
					<td class="key"><?php echo JLText::getText('Publish Standings'); ?></td>
					<td><?php echo JLHtml::getPublishedSelectList('publishstandings',$season->getPublishStandings()); ?></td>
				</tr>	
				<tr>
					<td class="key"><?php echo JLText::getText('Setup Final'); ?></td>
					<td><?php echo JLHtml::getPublishedSelectList('setupfinal',$season->isSetupFinal()); ?></td>
				</tr>							
				<tr>
					<td class="key"><?php echo JLText::getText('Published'); ?></td>
					<td><?php echo JLHtml::getPublishedSelectList('published',$season->getPublished()); ?></td>
				</tr>	
			</tbody>
		</table>
		</fieldset>
		</div>
		
		<div class='jl-admin-block span4'>
	
			<fieldset>
				<legend><?php echo JLText::getText('Statistics'); ?></legend>
				<table style="width: 100%">
					<tr>
						<td class="key"><?php echo JLText::getText('Total Registrations'); ?></td>
						<td><?php echo $season->getTotalRegistrations(); ?></td>
					</tr>				
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
			
	</div>

	<div id="registration" class="tab-pane">
		<div class="span8">
			<fieldset>
			<legend>Registration Settings</legend>
			<table class="jl-admin-table">
				<tbody>
					<tr>
						<td class="key"><?php echo JLText::getText('Registration Only?'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('registrationonly',$season->isRegistrationOnly()); ?> (Set to YES if used only for online registration)</td>
					</tr>			
					<tr>
						<td class="key"><?php echo JLText::getText('Registration Open'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('registrationopen',$season->isRegistrationOpen()); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Open to EXISTING teams only?'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('regexistingonly',$season->getPropertyValue("regexistingonly")); ?></td>
					</tr>				
					<tr>
						<td class="key"><?php echo JLText::getText('Template Name'); ?></td>
						<td><input type="text" name="registrationtemplate" value="<?php echo $season->getRegistrationTemplate(); ?>" size="50" /></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Email Template Name'); ?></td>
						<td><input type="text" name="registrationemailtemplate" value="<?php echo $season->getRegistrationEmailTemplate(); ?>" size="50" /></td>
					</tr>					
					<tr>
						<td class="key"><?php echo JLText::getText('Notes'); ?> <br/>(Appears on registration page)</td>
						<td><textarea  class="jl-admin-textarea" name="registrationnotes" rows="5" cols="55"><?php echo $season->getRegistrationNotes(); ?></textarea></td>
					</tr>				
				</tbody>
			</table>
			
			</fieldset>	
		</div>
	</div>
</div>	
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="seasons"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>
	
</form>


