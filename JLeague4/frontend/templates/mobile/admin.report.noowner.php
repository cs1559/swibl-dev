
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
	    
<h3>Team Profiles with no identified owner</h3>


<div class="admin-dashboard-report admin-report-noowner">
<table class="table table-striped">
<thead>  
	<tr>  
    	<th>Team Name</th>  
        <th>Division</th>  
        <th>Coach</th>  
        <th>Coach Email</th>  
   </tr>  
</thead>  

<?php 
	foreach ($teams as $team) {
?>
<tr>
	<td><?php echo $team->name;?></td>
	<td><?php echo $team->division_name;?></td>
	<td><?php echo $team->coachname;?></td>
	<td><?php echo $team->coachemail;?></td>
</tr>
<?php 
	}
?>
</table>

</div>

