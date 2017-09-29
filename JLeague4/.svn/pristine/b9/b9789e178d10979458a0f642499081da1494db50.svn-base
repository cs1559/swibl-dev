
var jfst = jQuery.noConflict();


function getAdminView(viewname) {
	selIdx = viewname.selectedIndex;
	view = viewname.options[selIdx].value;
	switch(view) {
		case 'gamecompletion':
		  task = 'getGameCompletionReport';
		  break;
		case 'newteams':
		  task = 'getNewTeamsList';
		  break;
		case 'notregistered':
		  task = 'getNotRegistered';
		  break;
		case 'rosterreport':
		  task = 'getRosterReport';
		  break;
		case 'unpaidteam':
		  task = 'getUnpaidReport';
		  break;			  		  		  
		default:
		  task = 'getSeasonSummary';
		  break;
}
	
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=admin&task=' + task,
	    //data: 'seasonid=' + seasonid,
	    type: 'POST',
		dataType: 'html',
		beforeSend: function() {
			jfst('#status-message').html("<strong><span class='ajax-loading-text'>Loading .... </span></strong>"); 
		},				
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
       		jfst("#status-message").html(textStatus);
   		},
   		success: function(data){
   			jfst("#admindashboard-content").html(data);
   		},
   		complete: function() {
 			jfst("#status-message").html("");   
   		}	    		
	});		
	
}
