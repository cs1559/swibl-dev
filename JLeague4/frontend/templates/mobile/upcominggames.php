<?php if (!isset($showlocation)) {
		$showlocation = true;
	}	
	if (!isset($showtime)) {
		$showtime = true;
	}		
?>


<style>#breadcrumbs { display: none; }</style>
<div id="upcoming-games-wrapper">
<div class="upcoming-games-header"><img src="components/com_jleague/templates/images/upcoming-games.png"/></div>

<table class="upcoming-games-table">
	<thead>
	<tr>
		<th>Date</th>
		<?php if ($showtime) { ?>		
		<th>Time</th>
		<?php } ?>		
		<th>Teams</th>
		<th>Age Group</th>
		<?php if ($showlocation) { ?>		
		<th>Location</th>
		<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php $ctr=1; 
	$max = $config->getProperty('games_on_frontpage_scoreboard');
	
	foreach ($games as $game) { 
	
		if ($ctr % 2) {
			$class = "odd";	
		} else {
			$class = "even";
		}
		$ctr = $ctr + 1;
				$hlink = JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $game->getHometeamId() );
				$vlink = JRoute::_("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $game->getAwayteamId() );
				
?>
		<tr class="scorboard-table-<?php echo $class; ?>">
			<td class="upcoming-games-cell"><?php echo $game->getGameDate(); ?></td>
			<?php if ($showtime) { ?>
			<td class="upcoming-games-cell"><?php echo $game->getGameTime(); ?>
			<?php } ?>
			<td>
				<a href="<?php echo $hlink; ?>"><?php echo $game->getHomeTeam() ?></a> vs <a href="<?php echo $vlink; ?>"><?php echo $game->getAwayTeam(); ?></a>
			</td>
			<td><?php echo $game->getDivision()->getAgeGroup(); ?>
			</td>
			<?php if ($showlocation) { ?>
			<td><?php echo $game->getLocation(); ?>
			<?php } ?>		
		</tr>
		
<?php 
	
	} 
?>
	</tbody>
	</table>
	<div id="upcoming-games-readmore"><?php echo $readmore; ?></div>
</div>


