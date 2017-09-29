
<div id="admindashboard-summary">

<h3>Unpaid Registrations - <?php  echo $season->getDescription();?> </h3>

<?php
	if (count($registrations)>0) {
?>
	<table style="width: 100%">

		<thead>
			<tr>
				<td>RegId</td>
				<td>Team Name</td>
				<td>Contact Name</td>
				<td>Phone</td>
				<td>Division</td>
				<td>Registration Date</td>
			</tr>
		</thead>
<?php		

		foreach($registrations as $registration)
		{
?>
			<tr>
				<td><?php echo $registration->getId(); ?>
				<td><?php echo $registration->getTeamName(); ?></td>
				<td ><?php echo $registration->getName();?></td>
				<td ><?php echo $registration->getPhone();?></td>														
				<td ><?php echo $registration->getDivisionName();?></td>
				<td><?php echo $registration->getRegistrationDate(); ?></td>
			</tr>
<?php
		}
?>

	</table>
<?php
	} else {
		echo "ALL REGISTERED TEAMS HAVE PAID!";
	}
?>	
	
</div>


