<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {

		alert('inside submitbutton');
		
		var form = document.adminForm;
		if (pressbutton == 'cancelLeague') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.name.value == '') {
			alert('League name is required');
			form.name.focus();
			return;
		}
		if (form.abbrname.value == '') {
			alert('Abbreviated League name is required');
			form.abbrname.focus();
			return;
		}
		
		submitform( pressbutton );
		
	}
</script>

<form method="post" id="adminForm" name="adminForm" action="index.php">

<ul class="nav nav-tabs" id="myTabTabs">
	<li class=""><a href="#league" data-toggle="tab">League Information</a></li>
	<li class=""><a href="#config" data-toggle="tab">Configuration</a></li>
	<li class=""><a href="#frontpage" data-toggle="tab">Front Page Settings</a></li>
	<li class=""><a href="#twitter" data-toggle="tab">Twitter</a></li>
</ul>

<div class="tab-content" id="myTabContent">

	<div id="league" class="tab-pane active">
		<div class="span8">
			<fieldset>
			<legend>League Information</legend>
			<table class="jl-admin-table">
				<tbody>
					<tr>
						<td class="key"><?php echo JLText::getText('Id'); ?></td>
						<td><?php echo $league->getId(); ?><input type="hidden" name="id" value="<?php echo $league->getId(); ?>"/></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Name'); ?></td>
						<td><input type="text" name="name" value="<?php echo $league->getName(); ?>" size="50" /></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Abbreviated Name'); ?></td>
						<td><input type="text" name="abbrname" value="<?php echo $league->getAbbrName(); ?>" size="20" /></td>
					</tr>				
					<tr>
						<td class="key"><?php echo JLText::getText('Description'); ?></td>
						<td><textarea class="jl-admin-textarea" name="description"><?php echo $league->getDescription(); ?></textarea></td>
					</tr>
					
					<tr>
						<td class="key"><?php echo JLText::getText('Published'); ?></td>
						<td><?php echo JLHtml::getPublishedSelectList('published',$league->getPublished()); ?></td>
					</tr>				
				</tbody>
			</table>
			</fieldset>	
		</div>
	</div>	

	<div id="config" class="tab-pane">
		<div class="span8">
			<fieldset>
			<legend>Configuration Settings</legend>
			<table class="admintable">
				<tbody>
					<tr>
						<td class="key"><?php echo JLText::getText('Current Season'); ?></td>
						<td><?php echo JLHtml::getSeasonSelectList('current_season', $league->getPropertyValue('current_season')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Registration Open'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('registration_open',$league->getPropertyValue('registration_open')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Email FROM Address'); ?></td>
						<td><?php echo JLHtml::getInputElement('email_from_addr',$league->getPropertyValue('email_from_addr'),75,75); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Email FROM Name'); ?></td>
						<td><?php echo JLHtml::getInputElement('email_from_name',$league->getPropertyValue('email_from_name'),30,30); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Copyright Notice'); ?></td>
						<td><?php echo JLHtml::getInputElement('copyright_notice',$league->getPropertyValue('copyright_notice'),75,75); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Sanctioning Body Team URL'); ?></td>
						<td><?php echo JLHtml::getInputElement('sanctioning_body_team_url',$league->getPropertyValue('sanctioning_body_team_url'),75,75); ?></td>
					</tr>				
					<tr>
						<td class="key"><?php echo JLText::getText('Team Logo Folder'); ?></td>
						<td><?php echo JLHtml::getInputElement('logo_folder',$league->getPropertyValue('logo_folder'),75,75); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Logo Height (Max)'); ?></td>
						<td><?php echo JLHtml::getInputElement('max_logo_height',$league->getPropertyValue('max_logo_height'),15,15); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Logo Width (Max)'); ?></td>
						<td><?php echo JLHtml::getInputElement('max_logo_width',$league->getPropertyValue('max_logo_width'),15,15); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Thumbnail Prefix'); ?></td>
						<td><?php echo JLHtml::getInputElement('logo_thumbnail_prefix',$league->getPropertyValue('logo_thumbnail_prefix'),25,25); ?></td>
					</tr>											
					<tr>
						<td class="key"><?php echo JLText::getText('Thumbnail Height (Max)'); ?></td>
						<td><?php echo JLHtml::getInputElement('max_thumbnail_height',$league->getPropertyValue('max_thumbnail_height'),15,15); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Thumbnail Width (Max)'); ?></td>
						<td><?php echo JLHtml::getInputElement('max_thumbnail_width',$league->getPropertyValue('max_thumbnail_width'),15,15); ?></td>
					</tr>													
					<tr>
						<td class="key"><?php echo JLText::getText('Games on Frontpage'); ?></td>
						<td><?php echo JLHtml::getInputElement('games_on_frontpage_scoreboard',$league->getPropertyValue('games_on_frontpage_scoreboard'),15,15); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Games on Scoreboard'); ?></td>
						<td><?php echo JLHtml::getInputElement('games_on_league_scoreboard',$league->getPropertyValue('games_on_league_scoreboard'),15,15); ?></td>
					</tr>				
									
					<tr>
						<td class="key"><?php echo JLText::getText('Submit Game Scores'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('submit_scores_enabled',$league->getPropertyValue('submit_scores_enabled')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Edit Game Scores'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('edit_game_scores_enabled',$league->getPropertyValue('edit_game_scores_enabled')); ?></td>
					</tr>						
					<tr>
						<td class="key"><?php echo JLText::getText('Schedules Enabled'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('schedules_enabled',$league->getPropertyValue('schedules_enabled')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Bulletins Enabled'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('bulletins_enabled',$league->getPropertyValue('bulletins_enabled')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Events Enabled'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('events_enabled',$league->getPropertyValue('events_enabled')); ?></td>
					</tr>										
					<tr>
						<td class="key"><?php echo JLText::getText('Rosters Enabled'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('rosters_enabled',$league->getPropertyValue('rosters_enabled')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Rosters Frozen'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('rosters_locked',$league->getPropertyValue('rosters_locked')); ?></td>
					</tr>											
					<tr>
						<td class="key"><?php echo JLText::getText('Enable Game Notifications'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('game_notifications',$league->getPropertyValue('game_notifications')); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Show Standings Position'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('show_position_in_standings',$league->getPropertyValue('show_position_in_standings')); ?></td>
					</tr>		
					<tr>
						<td class="key"><?php echo JLText::getText('Use GMAPS for Venues'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('use_gmaps_for_venues',$league->getPropertyValue('use_gmaps_for_venues')); ?></td>
					</tr>																								
					<tr>
						<td class="key"><?php echo JLText::getText('SEO Support'); ?></td>
						<td><?php echo JLHtml::getYesNoSelectList('seo_enabled',$league->getPropertyValue('seo_enabled')); ?></td>
					</tr>																
	
				</tbody>
			</table>		
			</fieldset>
		</div>
	</div>

	<div id="frontpage" class="tab-pane">
		<div class="span8">
			<fieldset>
			<legend>Frontpage Display</legend>
			<table class="jl-admin-table">
				<tbody>
					<tr>
						<td class="key"><?php echo JLText::getText('Frontpage Format'); ?></td>
						<td><?php echo JLHtml::getInputElement('frontpage_format',$league->getPropertyValue('frontpage_format'),30,30); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('No. of Upcoming Games (Days)'); ?></td>
						<td><?php echo JLHtml::getInputElement('frontpage_upcoming_games_days',$league->getPropertyValue('frontpage_upcoming_games_days'),15,15); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('No. of Upcoming Games (Games)'); ?></td>
						<td><?php echo JLHtml::getInputElement('frontpage_upcoming_games_games',$league->getPropertyValue('frontpage_upcoming_games_games'),15,15); ?></td>
					</tr>
					<tr>
						<td class="key"><?php echo JLText::getText('Read More ITEM ID'); ?></td>
						<td><?php echo JLHtml::getInputElement('frontpage_upcoming_games_readmoreitemid',$league->getPropertyValue('frontpage_upcoming_games_readmoreitemid'),15,15); ?></td>
					</tr>
					<tr>
				</tbody>
			</table>		
			</fieldset>
	</div>
	</div>

	<div id="twitter" class="tab-pane">
		<div class="span8">			
			<fieldset>
				<legend>Twitter Integration</legend>
				<table class="jl-admin-table">
					<tbody>
						<tr>
							<td class="key"><?php echo JLText::getText('Twitter Enabled'); ?></td>
							<td><?php echo JLHtml::getYesNoSelectList('twitter_enabled',$league->getPropertyValue('twitter_enabled')); ?></td>
						</tr>				
						<tr>
							<td class="key"><?php echo JLText::getText('Consumer Key'); ?></td>
							<td><?php echo JLHtml::getInputElement('twitter_consumer_key',$league->getPropertyValue('twitter_consumer_key'),75,75); ?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Consumer Secret'); ?></td>
							<td><?php echo JLHtml::getInputElement('twitter_consumer_secret',$league->getPropertyValue('twitter_consumer_secret'),75,75); ?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Access Token'); ?></td>
							<td><?php echo JLHtml::getInputElement('twitter_access_token',$league->getPropertyValue('twitter_access_token'),75,75); ?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Access Token Secret'); ?></td>
							<td><?php echo JLHtml::getInputElement('twitter_access_token_secret',$league->getPropertyValue('twitter_access_token_secret'),75,75); ?></td>
						</tr>
						<tr>
					</tbody>
				</table>
			</fieldset>			
		</div>
	</div>
	 
</div>  <!-- END OF MYTABS CONTENT -->

		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="leagues"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>

</form>


