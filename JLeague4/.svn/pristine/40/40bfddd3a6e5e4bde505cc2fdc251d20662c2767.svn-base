
<script language="javascript" type="text/javascript">

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


	function submitbutton(pressbutton) {

		if (pressbutton == 'cancelGame') {
			submitform( pressbutton );
			return;
		}

		var form = document.adminForm;
				
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
	
		// If both scores are 0, then prompt to confirm correct score
		if (form.hometeam_score.value == 0 &&
			form.awayteam_score.value == 0) {
			if (!confirm("Both scores were 0, is this correct? (press Cancel for 'NO')")) {
				return;
			}
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
			submitform( pressbutton );
		}
			
	}
	
</script>

<form method="post" id="adminForm" name="adminForm" action="index.php">
	<div class="col width-55">
		<fieldset>
		<legend>Game Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('JL_GAMEID'); ?>:</td>
					<td><?php echo $game->getId(); ?><input type="hidden" name="id" value="<?php echo $game->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('JL_CONFERENCE_GAME'); ?>:</td>
					<TD><?php echo $helper->getConferenceGame(); ?> </TD>
				</tr>				
				<tr>
					<td class="key"><?php echo JLText::getText('JL_DATE'); ?>:</td>
					<td><input type="text" name="gamedate" value="<?php echo $game->getGameDate(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('JL_SEASON'); ?>:</td>
					<td><?php echo $helper->getSeasonTitle(); ?></td>
				</tr>						
				<tr>
					<td class="key"><?php echo JLText::getText('JL_DIVISION'); ?>:</td>
					<td><?php echo $helper->getDivisionName(); ?></td>
				</tr>		
				<tr>
					<td class="key"><?php echo JLText::getText('JL_LOCATION'); ?>:</td>
					<td><input type="text" name="location" value="<?php echo $game->getLocation(); ?>" size="60"/></td>
				</tr>
				<tr>
					<td colspan="9">
						<fieldset><legend><?php echo JLText::getText('JL_SCORE_DETAILS'); ?></legend>
							<table width="100%">
							<th>H/A</ht>
							<th>LeagueTeam</th>
							<th>Team</th>
							<th>Score</th>
								
							<tr>			
								<td>Home</td>									
				 				<td><?php echo $helper->getHomeTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
								<td>
									<span id="hometeam_name" class="<?php echo $helper->getHomeTeamInputClass(); ?>"><?php echo $helper->getHomeTeamInput(); ?></span>
									<span id="hometeam_selectlist" class="<?php echo $helper->getHomeTeamSelectListClass(); ?>"><?php echo $helper->getHomeTeamSelectList(); ?></span>
								</td>
								<td><input type="text" name="hometeam_score" value="<?php echo $game->getHometeamScore(); ?>"/></td>
							</tr>
							<tr>			
								<td>Away</td>									
				 				<td><?php echo $helper->getAwayTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
								<td>
									<span id="awayteam_name" class="<?php echo $helper->getAwayTeamInputClass(); ?>"><?php echo $helper->getAwayTeamInput(); ?></span>
									<span id="awayteam_selectlist" class="<?php echo $helper->getAwayTeamSelectListClass(); ?>"><?php echo $helper->getAwayTeamSelectList(); ?></span>
								</td>					
								<td><input type="text" name="awayteam_score" value="<?php echo $game->getAwayteamScore(); ?>"/></td>
							</tr>
							
							</table>	
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		</fieldset>		
		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="games"/>
		<input type="hidden" name="task" value="save"/> 
		
	</div>

	<div class='col width-45'>
		<fieldset>
			<legend><?php echo JLText::getText('Game Highlights'); ?></legend>
		
		<table  class="admintable">
				<tr>
					<td class="key"><?php echo JLText::getText('JL_HIGHLIGHTS'); ?>:</td>
					<td colspan="5"><textarea name="highlights" rows="10" cols="60"><?php echo $game->getHighlights(); ?></textarea></td>
				</tr>									
		
		</table>
		</fieldset>
		
	</div>
</form>

