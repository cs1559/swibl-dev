<script type="text/javascript">
	var $j = jQuery.noConflict();

	jQuery(function() {
		jQuery("#tabs").tabs();
	});

    	jQuery().ready(function() {  
    
	jQuery('#select1').transfer({
		to:'#select2',//selector of second multiple select box
		addId:'#addT',//add buttong id
		removeId:'#removeT' // remove button id
	});
    
    
    
    });  


	function submitbutton(pressbutton) {
	
		var form = document.adminForm;
		if (pressbutton == 'cancelRegistration') {
			submitform( pressbutton );
			return;
		}
		submitform( pressbutton );

	}
	
</script>

<style>
	.hidden{display:none;}
	.added{color:#CCCCCC;}
	#select2 .added{color: red;}

select {
	height: 300px;
	width: 350px;
}
.width-75 {
width: 75%;
}
</style>


<form method="post" name="adminForm" action="index2.php">

<div class="col width-75"> 



<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Setup</a></li>
		<li><a href="#tabs-2">Select Teams</a></li>
	</ul>
	<div id="tabs-1">
		<p>
			Registration is for the <?php echo $season->getTitle(); ?> season.	<input type="hidden" name="seasonid" value="<?php echo $season->getId(); ?>"/>	
		</p>
	</div>
	<div id="tabs-2">
<table width="100%">
<tr>
<td>
<select multiple="multiple" id="select1">
		<?php foreach($teams as $team) {
			$line = str_pad($team->getName(),30) . "[" . $team->getCoachName() . "]<br/>" ;
			echo "<option value='" . $team->getId() . "'> " . $line . "</option>";
		}
		 ?>
</select>
</td>
<td>
<a href="#" id="addT" class="button"><input type="button"    value="Add  >>" style="width:'100px';"/></a>
<a href="#" id="removeT" class="button"><input type="button" value="<< Button" style="width:'100px';"/></a>
</td>
<td>
<select multiple="multiple" id="select2">
</select>
</td>
</tr>
</table> 


	</div>
</div>

</div>

		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="registrations"/>
		<input type="hidden" name="task" value="saveRegistration"/> 
		<input type="hidden" name="boxchecked" value="0"/>



</form>
