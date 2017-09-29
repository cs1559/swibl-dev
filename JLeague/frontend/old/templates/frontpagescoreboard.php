<!--  The style element forces the breadcrumbs off if the small scoreboard is on the frontpage. -->
<style>#breadcrumbs { display: none; }</style>
<div id="scoreboard-wrapper">
<div class="scoreboard-header"><img src="images/scoreboard.png"/></div>
<span class="scoreboard-message"><?php echo $message; ?></span>
<?php $ctr=1; 
	$max = $_config->getProperty('games_on_frontpage_scoreboard');
	foreach ($games as $game) { 
	
		if ($ctr % 2) {
			$class = "odd";	
		} else {
			$class = "even";
		}
		$ctr = $ctr + 1;
?>

	<table class="scoreboard-table scorboard-table-<?php echo $class ?>">
		<tr>
			<td class="scoreboard-gamedate"><?php echo $game->getGameDate(); ?></td>
			<td class="scoreboard-team" ><?php echo $game->getHomeTeam(); ?></td>
			<td class="scoreboard-score"><?php echo $game->getHomeTeamScore(); ?></td>		
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td class="scoreboard-team"> <?php echo $game->getAwayTeam(); ?></td>
			<td class="scoreboard-score"><?php echo $game->getAwayTeamScore(); ?></td>
		</tr>
	</table>
<?php 
		if ($ctr > $max) {
			break;
		}
	} 
?>

</div>


