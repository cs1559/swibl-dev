<script type="text/javascript">

/*
	jQuery(function() {
		jQuery("#tabs").tabs();
	});
	
				height: 215,
			width: 450,
*/
	
	jQuery(function() {
		jQuery("#scheduledgameform").dialog({
			bgiframe: true,
			width: 550,
			modal: true,
			resizable: false,
			close: function(event, ui) {
				resetGameForm();
				jQuery("#playerform-message").html(""); 
			 },
			autoOpen: false
		});
	});
	
	function switchtab(tab) {
		var $tabs = jQuery('#tabs').tabs(); 
	    $tabs.tabs('select', tab); 
	    return false;
	}

	function switchToNonLeague(elem) {
		if (elem.name == "cb_league_hometeam") {
			if (elem.checked == false) {
				document.getElementById("hometeam_name").className = "inputOn"; 
				document.getElementById("hometeam_selectlist").className = "inputOff";	
			} else {
				document.getElementById("hometeam_name").className = "inputOff"; 
				document.getElementById("hometeam_selectlist").className = "inputOn";			
			}
		}
		if (elem.name == "cb_league_awayteam") {
			if (elem.checked == false) {
				document.getElementById("awayteam_name").className = "inputOn"; 
				document.getElementById("awayteam_selectlist").className = "inputOff";	
			} else {
				document.getElementById("awayteam_name").className = "inputOff"; 
				document.getElementById("awayteam_selectlist").className = "inputOn";			
			}
		}	
	} 

	function validateScheduledGameForm() {

		var form = document.scheduledgameform;
				
		var dt=form.gamedate;
		
		// Validate that a division was selected
		if (isDate(dt.value)==false){
			dt.focus();
			return;
		}	
	
		// Validate that if the hometeam league checkbox is checked that the hometeam_id != 0
		if (form.cb_league_hometeam.checked == true) {
				// Validate that both a home team have been selected
				if (form.hometeam_id.value == 0) {
					form.hometeam_id.focus();
					alert("You must select a home team");
					return;
				}
		}
		// Validate that if the hometeam league checkbox is NOT checked that hometeam_name != ''
		if (form.cb_league_hometeam.checked == false) {
				// Validate that both a home team have been selected
				form.conference_game.value = 'N';	
				if (form.hometeam_name.value == '') {
					form.hometeam_name.focus();
					alert("You must enter the name of the home team");
					return;
				}
		}
				
		// Validate that if the awayteam league checkbox is checked that the awayteam_id != 0
		if (form.cb_league_awayteam.checked == true) {
				// Validate that both a home team have been selected
				if (form.awayteam_id.value == 0) {
					form.awayteam_id.focus();
					alert("You must select a away team");
					return;
				}
		}		
		// Validate that if the awayteam league checkbox is NOT checked that awayteam_name != ''
		if (form.cb_league_awayteam.checked == false) {
				form.conference_game.value = 'N';			
				// Validate that both a home team have been selected
				if (form.awayteam_name.value == '') {
					form.awayteam_name.focus();
					alert("You must enter the name of the away team");
					return;
				}
		}		

		// Validate the home team and away team are not the same
		if (form.hometeam_id.value ==
			form.awayteam_id.value) {
			alert("The home and away teams cannot be the same");
			form.hometeam_id.focus();
			return;
		}
	
	/*
		// If both scores are 0, then prompt to confirm correct score
		if (form.hometeam_score.value == 0 &&
			form.awayteam_score.value == 0) {
			if (!confirm("Both scores were 0, is this correct? (press Cancel for 'NO')")) {
				return;
			}
		}
	*/
	
		if (form.hometeam_id.value != form.teamid.value && form.awayteam_id.value != form.teamid.value) {
			alert("You have not selected your team as either the home team or the away team");
			return;
		}
		if (form.season_id == 0) {
			alert("Season hasn't been defined");
			return;
		}
		if (form.division_id == 0) {
			alert("Division hasn't been defined");
			return;
		}
	
		if (confirm("Are you sure you wish to continue?")) {
			form.submit();
		}	
	}
	
	function openScheduledGameForm() {
		jQuery('#scheduledgameform').dialog('open');
	}
	
</script>

<style>
.boxscore-table {
	/* width: 80%; */
}
.boxscore-col1 {
	width: 3%;
}
.boxscore-col2 {
	width: 15%;
}
.boxscore-col3 {
	width: 130px;
}.boxscore-col4 {
	width: 40px;
}
</style>

<!--  <link type="text/css" href="http://localhost/j15/administrator/components/com_jleague/assets/jquery-theme/smoothness/ui.tabs.css" rel="stylesheet">  -->

<div id="teamprofile-header" class="jleague-section-block">
	<div id="teamprofile-abbr-logo">
		<img src="<?php echo $_config->getProperty('logo_folder') . "thumb-" . $team->getLogo();?>"/>
	</div>
	<div id="teamprofile-abbr-info">
		<div id="teamprofile-info-teamname"><?php echo $team->getName(); ?></div></br>
			<?php echo $team->getCity() . ", " . $team->getState(); ?>
	</div>
</div>

<div class="clr"/></div>

<br/>
<?php echo $submenu; ?>


<div class="jleague-title">
<h2>Team Schedule</h2> 
</div>
<input type="button" value="Add Game" onClick="openScheduledGameForm('insert');"/>
<div id="scheduledgameform" title="Edit Scheduled Game">
<form id="scheduled-game-form" name="scheduledgameform" method="post" action="index.php">
						<table>
							<tr>
								<td class="key width-25"><?php echo JLText::getText('JL_GAMEID'); ?>:</td>
								<td><span id="game-id-display"><?php echo $game->getId(); ?></span><input type="hidden" name="id" value="0"/></td>
							</tr>						
							<tr>
								<td class="key width-25"><?php echo JLText::getText('JL_DIVISION'); ?>:</td>
								<td><?php echo $helper->getDivisionName(); ?></td>
							</tr>						
							<tr>
								<td class="key width-25"><?php echo JLText::getText('JL_GAME_TYPE'); ?>:</td>
								<TD><?php echo $helper->getConferenceGame(); ?> </TD>
							</tr>							
							<tr>
								<td class="key width-25"><?php echo JLText::getText('JL_DATE'); ?>:</td>
								<td><input type="text" name="gamedate" value="<?php echo $game->getGameDate(); ?>" size="20"/> (MM/DD/YYYY)</td>
							</tr>			
							<tr>
								<td class="key"><?php echo JLText::getText('JL_GAME_TIME'); ?>:</td>
								<td><input type="text" name="gametime" value="<?php echo $game->getGameTime(); ?>" size="10"/></td>
							</tr>											
							<tr>
								<td class="key"><?php echo JLText::getText('JL_LOCATION'); ?>:</td>
								<td><input type="text" name="location" value="<?php echo $game->getLocation(); ?>" size="60"/></td>
							</tr>
						<tr>
						<td colspan="5">
						<table class="boxscore-table">
							<th class="boxscore-col1 leftjust"></ht>
							<th class="boxscore-col2 leftjust">LeagueTeam</th>
							<th class="boxscore-col3 leftjust">Team</th>
							<th class="boxscore-col4 leftjust">Score</th>
								
							<tr>			
								<td>Home</td>									
				 				<td class="centerjust"><?php echo $helper->getHomeTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
								<td>
									<span id="hometeam_name" class="<?php echo $helper->getHomeTeamInputClass(); ?>"><?php echo $helper->getHomeTeamInput(); ?></span>
									<span id="hometeam_selectlist" class="<?php echo $helper->getHomeTeamSelectListClass(); ?>"><?php echo $helper->getHomeTeamSelectList(); ?></span>
								</td>
								<td><input type="text" name="hometeam_score" value="<?php echo $game->getHometeamScore(); ?>"  size="10" maxlength="7"/></td>
							</tr>
							<tr>			
								<td>Away</td>									
				 				<td class="centerjust"><?php echo $helper->getAwayTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
								<td>
									<span id="awayteam_name" class="<?php echo $helper->getAwayTeamInputClass(); ?>"><?php echo $helper->getAwayTeamInput(); ?></span>
									<span id="awayteam_selectlist" class="<?php echo $helper->getAwayTeamSelectListClass(); ?>"><?php echo $helper->getAwayTeamSelectList(); ?></span>
								</td>
								<td><input type="text" name="awayteam_score" value="<?php echo $game->getAwayteamScore(); ?>" size="10" maxlength="7"/></td>
							</tr>
							
							</table>
							</td>
						</tr>
						<tr>
							<td class="valign-top width-25">Notes:</td>
							<td><textarea name="highlights" rows="7" cols="45"><?php echo $game->getHighlights(); ?></textarea></td>
						</tr>
						</table>
				<table>
				<!-- 
				<tr>
					<td class="valign-top width-25">You may provide any specific highlights that may have taken place during the game.</td>
					<td><textarea name="highlights" rows="10" cols="60"><?php echo $game->getHighlights(); ?></textarea></td>
				</tr>
				 -->
				</table>
								
				<br/>
				<input type="button" value="Save" onclick="addGame(document.scheduledgameform);"/>				
				<input type="hidden" name="option" value="com_jleague"/>
				<input type="hidden" name="controller" value="ajax"/>
				<input type="hidden" name="gamestatus" value="S"/>				
				<input type="hidden" name="season_id" value="<?php echo $season->getId(); ?>"/>
				<input type="hidden" name="task" value="doScheduleGame"/>
				<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
</form>

</div>

<div id="current-seasons-games">
	<?php echo $currentseasonsgames; ?>
</div>