<script type="text/javascript">

	jfst(function() {
		jfst("#scheduledgameform").dialog({
			bgiframe: true,
			width: 550,
			modal: true,
			resizable: false,
			close: function(event, ui) {
				resetGameForm();
				jfst("#playerform-message").html(""); 
			 },
			autoOpen: false
		});
	});
	
	function switchtab(tab) {
		var $tabs = jfst('#tabs').tabs(); 
	    $tabs.tabs('select', tab); 
	    return false;
	}

	function changeStatus(val) {
		document.getElementById("gamestatus").value = val;
		return;
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

<?php include('teamprofile.edit.miniheader.php'); ?>

<div class="clr"/></div>

<div class="jleague-title">
<h2>Team Schedule</h2> 
</div>
<a href="javascript:void(0);" onClick="openGameForm('insert');">Add Game</a>
<div id="scheduledgameform" title="Edit Game">
<form id="scheduled-game-form" name="scheduledgameform" method="post" action="index.php">
	<table>
		<tr>
			<td class="key width-25"><?php echo JLText::getText('JL_GAMEID'); ?>:</td>
			<td><span id="game-id-display">&nbsp;<?php //echo $game->getId(); ?></span><input type="text" name="id" value="0" readonly/></td>
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
		<td class="valign-top width-25">Game Status:</td>
		<td><?php echo $helper->getGameStatus('gamestatus_sl','onClick="javascript:changeStatus(this.value);"'); ?></td>
	</tr>							
	<tr>
		<td class="valign-top width-25">Notes:</td>
		<td><textarea name="highlights" rows="5" cols="55"><?php echo $game->getHighlights(); ?></textarea></td>
	</tr>
	</table>
	
	<strong>Game Results:</strong>
	<table id="games-table">
		<th class="games-table-cell-header boxscore-col1 leftjust"></th>
		<th class="games-table-cell-header boxscore-col2 centerjust">LeagueTeam</th>
		<th class="games-table-cell-header boxscore-col3 centerjust"  style="width: 312px;">Team</th>
		<th class="games-table-cell-header boxscore-col4 centerjust">Score</th>
			
		<tr>			
			<td class="left-pad10">Home</td>									
 			<td class="centerjust"><?php echo $helper->getHomeTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
			<td>
				<span id="hometeam_name" class="<?php echo $helper->getHomeTeamInputClass(); ?>"><?php echo $helper->getHomeTeamInput(); ?></span>
				<span id="hometeam_selectlist" class="<?php echo $helper->getHomeTeamSelectListClass(); ?>"><?php echo $helper->getHomeTeamSelectList(); ?></span>
			</td>
			<td><input type="text" name="hometeam_score" value="<?php echo $game->getHometeamScore(); ?>"  size="10" maxlength="7"/></td>
		</tr>
		<tr>			
			<td class="left-pad10">Away</td>									
 			<td class="centerjust"><?php echo $helper->getAwayTeamLeagueFlag('onClick="javascript:switchToNonLeague(this);"'); ?></td>
			<td>
				<span id="awayteam_name" class="<?php echo $helper->getAwayTeamInputClass(); ?>"><?php echo $helper->getAwayTeamInput(); ?></span>
				<span id="awayteam_selectlist" class="<?php echo $helper->getAwayTeamSelectListClass(); ?>"><?php echo $helper->getAwayTeamSelectList(); ?></span>
			</td>
			<td><input type="text" name="awayteam_score" value="<?php echo $game->getAwayteamScore(); ?>" size="10" maxlength="7"/></td>
		</tr>
	</table>

	<br/>
	<input type="button" value="Save" onclick="addGame(document.scheduledgameform);"/>				
	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="ajax"/>
	<input type="hidden" id="gamestatus" name="gamestatus" value="S"/>				
	<input type="hidden" name="season_id" value="<?php echo $season->getId(); ?>"/>
	<input type="hidden" name="task" value="doScheduleGame"/>
	<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
</form>

</div>

<div id="current-seasons-games">
	<?php echo $currentseasonsgames; ?>
</div>