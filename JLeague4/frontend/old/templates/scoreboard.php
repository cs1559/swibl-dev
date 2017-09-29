<!--  The style element forces the breadcrumbs off if the small scoreboard is on the frontpage. -->
<style>#breadcrumbs { display: none; }</style>
<div id="scoreboard-wrapper">
<div class="scoreboard-header"><img src="images/scoreboard.png"/></div>
<!--<span class="scoreboard-message" style="float: clear;"><?php echo $message; ?></span> -->
<?php $ctr=1; 
	$max = $_config->getProperty('games_on_league_scoreboard');
	foreach ($games as $game) { 
	
		if ($ctr % 2) {
			$class = "odd";	
		} else {
			$class = "even";
		}
		$ctr = $ctr + 1;
?>
	<style>
		.winner {
			font-weight: bold;
		}
	</style>
<?php
		$homescore = (int) $game->getHomeTeamScore();
		$awayscore = (int) $game->getAwayTeamScore();
		if ($homescore > $awayscore) {
			$homeclass = "winner";
		} else {
			$homeclass = "";
		}
		if ($awayscore > $homescore) {
			$awayclass = "winner";
		} else {
			$awayclass = "";
		}
		if (!$game->isLeagueGame()) {
			$leaguegame = "(Non-League Game)";
		} else {
			$leaguegame = "";
		}
	?>
	<div style="float: left;width: 275px; border: 1px solid #000000; margin: 10px;">
	<table class="scoreboard-table scorboard-table-<?php echo $class ?>" cellspacing="0" cellpadding="0">
		<tr style="background-color: #0000a0; color: #ffffff; border-bottom: 1px solid #000000;">
			<td colspan="3" class="scoreboard-gamedate">Game #: <?php echo $game->getId() . ' - Date: ' . $game->getGameDate(); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="scoreboard-division"><?php echo $game->getDivision()->getName() . " "  . $leaguegame; ?></td>
		</tr>		
		<tr>
			<td class="scoreboard-team <?php echo $homeclass;?>" ><?php echo $game->getHomeTeam(); ?></td>
			<td class="scoreboard-score"><?php echo $game->getHomeTeamScore(); ?></td>		
		</tr>
		<tr>
			<td class="scoreboard-team <?php echo $awayclass;?>"> <?php echo $game->getAwayTeam(); ?></td>
			<td class="scoreboard-score"><?php echo $game->getAwayTeamScore(); ?></td>
		</tr>
	</table>
	</div>
<?php 
		if ($ctr > $max) {
			break;
		}
	} 
?>

</div>


