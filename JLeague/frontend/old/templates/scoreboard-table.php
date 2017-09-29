<!--  The style element forces the breadcrumbs off if the small scoreboard is on the frontpage. -->
<style>#breadcrumbs { display: none; }</style>
<div id="scoreboard-wrapper" style="">
<div class="scoreboard-header"><img src="images/scoreboard.png"/></div>
<!--<span class="scoreboard-message" style="float: clear;"><?php echo $message; ?></span> -->
<?php $ctr=1; 
	$max = $_config->getProperty('games_on_league_scoreboard');
?>
	<style>
		.winner {
			font-weight: bold;
			color: red;
		}
	</style>
	* = Non-League Game;  WINNER is shown in RED
	<table class="scoreboard-table scorboard-table-<?php echo $class ?>" width="100%" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Id</th>
					<th>Date</th>
					<th>AgeGroup</th>
					<th>Home Team</th>
					<th>Score</th>
					<th>Away Team</th>
					<th>Score</th>
				</tr>
			</thead>	
<?php
	
	foreach ($games as $game) { 
	
		if ($ctr % 2) {
			$class = "odd";	
		} else {
			$class = "even";
		}
		$ctr = $ctr + 1;
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
			$leaguegame = " * ";
		} else {
			$leaguegame = "";
		}
	?>
	
		<tr class="scorboard-table-<?php echo $class ?>">
			<td><?php echo $game->getId(); ?></td>
			<td class="games-table-cell-center"><?php echo $game->getGameDate(); ?></td>
			<td class="width10 games-table-cell-center"><?php echo $game->getDivision()->getAgeGroup() . " "  . $leaguegame; ?></td>
			<td class="width25 <?php echo $homeclass;?>" ><?php echo $game->getHomeTeam(); ?></td>
			<td class="games-table-cell-center width15"><?php echo $game->getHomeTeamScore(); ?></td>
			<td class="width25 <?php echo $awayclass;?>"> <?php echo $game->getAwayTeam(); ?></td>
			<td class="games-table-cell-center width15"><?php echo $game->getAwayTeamScore(); ?></td>											
		</tr>

<?php 
		if ($ctr > $max) {
			break;
		}
	} 
?>

	</table>

</div>


