
<form class="button-form">
<div id="admindashboard-config">

	   <button id="cancelButton" 
	    	name="cancelButton" 
	    	class="btn btn-primary btn-xs"
	    	formmethod="post"
	    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=admin&task=dashboard'); ?>"
	    	value="Return">Return to Dashboard</button>
</form>
</div>
	    
<h3>Team Profiles Status Updates</h3>


<div class="admin-dashboard-report admin-report-noowner">
<table class="table table-striped">
<thead>  
	<tr>  
    	<th>Team Name</th>  
        <th>Division</th>  
        <th>Coach</th>  
        <th>Coach Email</th>
        <th>Tournament</th>  
        <th>Paid</th>    
   </tr>  
</thead>  

<?php 
	foreach ($teams as $team) {
?>
<tr>
	<td><?php echo $team->teamname;?></td>
	<td><?php echo $team->division_name;?></td>
	<td><?php echo $team->coachname;?></td>
	<td><?php echo $team->coachemail;?></td>
	<td><?php echo $team->tournament;?></td>
	<td><?php echo $team->paid;?></td>
</tr>
<?php 
	}
?>
</table>

</div>

