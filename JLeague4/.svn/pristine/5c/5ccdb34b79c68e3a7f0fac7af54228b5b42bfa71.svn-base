<div class="gameresults-wrapper">

<style>

.scoreboard_box_content {
    margin-bottom: 10px;
	border: 1px solid;
	width: 100%;
}
.scoreboard_game_header {
    background-color: #0000FF;
    color: #FFFFFF;
    width: 100%;
}
.game_header_date {
    float: left;
}
.scoreboard_content_wrapper {
padding: 5px;
}
.table-cell-80 {
width: 80%;
}
.division-name {
width: 100%;
text-align: center;
color: red;
}
.scoreboard_team_name {
float: left;
}
.scoreboard_team_name {
float: left;
}

</style>
<h3>Game Results <?php echo $season->getDescription(); ?></h3>

<?php 
	foreach ($games as $game) {
?>
		<div class="col-md-6">
			<div class="scoreboard_box_content">

				<div class="scoreboard_game_header">
						<?php echo $game->getGameDate() . " - Game #: " . $game->getId(); ?>
				</div>
				<div class="division-name scoreboard_content_wrapper">
					<?php 
						$div = $game->getDivision();
						echo $div->getName() . " Division";
					?>
				</div>
				<div class="team_away scoreboard_content_wrapper">
					<div class="scoreboard_team_name table-cell-80">
						<?php echo $game->getHometeam();?>
					</div>
					<div class="scoreboard_home_score">
						<?php echo $game->getHometeamScore(); ?>
					</div>
				</div>
				<div class="team_home scoreboard_content_wrapper">
					<div class="scoreboard_team_name table-cell-80">
						<?php echo $game->getAwayteam();?>
					</div>
					<div class="scoreboard_home_score">
						<?php echo $game->getAwayteamScore(); ?>
					</div>
					
				</div>
			</div>
		</div>
<?php 
	}
?>

</div>