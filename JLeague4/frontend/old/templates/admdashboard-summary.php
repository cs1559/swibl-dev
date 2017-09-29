
<div id="admindashboard-summary">

<h3>Season Summary </h3>

	<table style="width: 100%">
		<tr>
			<td>League:</td>
			<td><?php echo $league->getDescription(); ?></td>
		</tr>
		<tr>
			<td>Current Season:</td>
			<td><?php echo $season->getDescription(); ?></td>
		</tr>
		<tr>
			<td>Registration Status:</td>
			<td><?php echo ($config->getPropertyValue("registration_open") ? "Open" : "Closed");?></td>
		</tr>
		<tr>
			<td>Total Registered Teams:</td>
			<td><?php echo $season->getTotalRegistrations();?></td>
		</tr>
		<tr>
			<td>Total Teams Paid:</td>
			<td><?php echo $season->getTeamsPaid();?></td>
		</tr>
		<tr>
			<td>Total Divisions:</td>
			<td><?php echo $season->getTotalDivisions();?></td>
		</tr>		
		<tr>
			<td>Total Games Scheduled:</td>
			<td><?php echo $season->getTotalScheduledGames(); ?></td>
		</tr>		
		<tr>
			<td>Total Games Played:</td>
			<td><?php echo $season->getTotalGames();?></td>
		</tr>
		<tr>
			<td>Total Teams with Rosters:</td>
			<td><?php echo $totalrosters;?></td>
		</tr>			
		<tr>
			<td>Total Players:</td>
			<td><?php echo $totalplayers;?></td>
		</tr>					
	</table>
</div>


