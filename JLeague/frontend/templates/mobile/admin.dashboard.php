<?php
?>

<h1>League Admin Dashboard</h1>

<div class="admin-dashboard-menu">
<div class="container">
	<ul class="nav nav-pills">
		  <li class="active"><a href="index.php?option=com_jleague&controller=admin">Dashboard</a></li>
		  <li><a href="index.php?option=com_jleague&controller=admin&task=manageBulletins">Bulletins</a></li>
		  
		  <!-- 
		  <li class="dropdown">
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			      Updates <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu" role="menu">
			    	<li><a href="index.php?option=com_jleague&controller=admin&task=updateTournamentAndPaid">Tournament/Paid Status</a></li>
			    </ul>
		  </li>
		   -->
		  
		  <li class="dropdown">
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			      Reports <span class="caret"></span>
			    </a>
			    <ul class="dropdown-menu" role="menu">
			    	<li><a href="index.php?option=com_jleague&controller=admin&task=getSiteConfig">Site Config</a></li>
			    	<li><a href="index.php?option=com_jleague&controller=admin&task=getNoOwnerReport">Teams With No Onwer</a></li>
			    </ul>
		  </li>
	</ul>
</div>
</div>

<div class="admin-dashboard-detail">
<div class="container">
<div class="row">

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="swibl-panel-heading panel-heading ">
			 	<h4 class="panel-title">General Information</h4>
			</div>
			<div class="panel-body" style="width: 100%">
				<table class="table table-condensed">
					<tr>
						<td>Season:</td>
						<td><?php echo $season->getDescription(); ?>
					</tr>
					<tr>
						<td>Status:</td>
						<td><?php echo $season->getStatus(); ?>
					</tr>					
					<tr>
						<td>Total Divisions:</td>
						<td><?php echo $season->getTotalDivisions(); ?>
					</tr>
					<tr>
						<td>Total Teams:</td>
						<td><?php echo $season->getTotalTeams(); ?>
					</tr>		
					<tr>
						<td>Total Games Scheduled:</td>
						<td><?php echo $season->getTotalScheduledGames(); ?>
					</tr>
					<tr>
						<td>Total Teams with Invalid Rosters:</td>
						<td><?php echo $invalidRostersCount; ?>
					</tr>		
				</table>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="swibl-panel-heading panel-heading ">
			 	<h4 class="panel-title">Team Count by Division</h4>
			</div>
			<div class="panel-body" style="width: 100%">
				<table class="table table-condensed table-striped">
					<?php foreach ($divisionTeamCounts as $division) { ?>
						<tr>
							<td><?php echo $division->division_name; ?></td>
							<td><?php echo $division->team_count; ?> </td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>	
	
</div>

</div>
</div>
