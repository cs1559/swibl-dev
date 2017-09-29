<form class="button-form">
<div id="admindashboard-config">

	   <button id="cancelButton" 
	    	name="cancelButton" 
	    	class="btn btn-primary btn-xs"
	    	formmethod="post"
	    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=admin&task=dashboard'); ?>"
	    	value="Return">Return to Dashboard</button>
	    	
	    </div>
</form>

<h3>Current Site Configurations</h3>
The following is a display of the current configurations used on this site.  To change any of these properties, you need
to access the backend administration section of the website.  Certain property values are TRUE or FALSE and are represented
by their numeric value.  0 = False, 1 = True.
<pre>
<?php
	print_r($properties);
?>
</pre>

</div>
