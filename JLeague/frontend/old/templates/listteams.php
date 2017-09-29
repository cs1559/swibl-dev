
<script>
function closePopup() {
	jfst('#dialog').jqmHide();
}
function callPopup(teamid) {
	jfst('#dialog').jqm();
	jfst('#dialog').html("Loading team profile ....");
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxGetTeamPopup',
	    data: 'teamid=' + teamid,
	    type: 'get',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
     			jfst('#dialog').html("Error retrieving Team Information");
   		},
   		success: function(data){
   			html = data ;
   			jfst('#dialog').html(html);
   		}		
	});		
	jfst('#dialog').jqmShow(); 
}
</script>


<div id="teamlist-body">
<div id="standings-filter">
	<span id="standings-activity-image">&nbsp;</span><span id="standings-filter-season"><?php echo JLText::getText('JL_SEASON') . ": "; echo $filter; ?></span>
</div>
<div id="results-wrapper">
<?php
	echo $listteamsresults;
?>
</div>
</div>

<div class="jqmWindow" id="dialog">
</div>