
var jfst = jQuery.noConflict();


function gotoPage(url) {
	window.location = url;
}

function openWindow(url)
{
    var w = window.open (url, "win", "fullscreen,location,menubar,resizable,scrollbars,status,toolbar");
}

function updateDivisionSelectList() {
	var id=jfst("#season_id").attr("value");	
	jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getDivisionListForSeason',{ seasonid: id },function(j) {
    	  var options = '';
	      for (var i = 0; i < j.length; i++) {
	      	sel = '';
	      	if (i == 0) {
	      		sel = 'selected';
	      	} 
	        options += '<option value="' + j[i].optionValue + '" ' + sel + '>' + j[i].optionDisplay + '</option>';
	      }
	      jfst("select#division_id").html(options);
	      updateTeamsSelectList();
	});
}

function updateTeamsSelectList() {
	var id=jfst("#division_id").attr("value");
	jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getDivisionCompetingTeams',{ divid: id },function(j) {
    	  var options = '';
	      for (var i = 0; i < j.length; i++) {
	        options += '<option value="' + j[i].optionValue + '">' + j[i].optionDisplay + '</option>';
	      }
	      jfst("select#hometeam_id").html(options);
	      jfst("select#awayteam_id").html(options);
	});
}

function getTeamsForSeason(seasonid) {
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=ajaxListTeams',
	    data: 'seasonid=' + seasonid,
	    type: 'POST',
		dataType: 'html',
		beforeSend: function() {
			jfst('#standings-activity-image').html("<strong><span class='ajax-loading-text'>Loading .... </span></strong>"); 
		},				
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
       		jfst("#results-wrapper").html(textStatus);
   		},
   		success: function(data){
   			jfst("#results-wrapper").html(data);
   		},
   		complete: function() {
 			jfst("#standings-activity-image").html("");   
   		}	    		
	});		
	
}

function getStandings(leagueid,seasonid) { 

			jfst.ajax({
			    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=standings&task=ajaxGetStandings',
			    data: 'leagueid=' + leagueid + '&seasonid=' + seasonid,
			    type: 'POST',
				dataType: 'html',
				beforeSend: function() {
					jfst('#standings-activity-image').html("<strong><span class='ajax-loading-text'>Loading .... </span></strong>"); 
				},				
	    		error: function (XMLHttpRequest, textStatus, errorThrown) {
	        		jfst("#standings-wrapper").html(textStatus);
	    		},
	    		success: function(data){
	    			jfst("#standings-wrapper").html(data);
	    		},
	    		complete: function() {
	  				jfst("#standings-activity-image").html("");   
	    		}	    		
			});		
			
}

function getGameHistory(teamid,seasonid) { 

			jfst.ajax({
			    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxGetGameHistory',
			    data: 'teamid=' + teamid + '&seasonid=' + seasonid,
			    type: 'POST',
				dataType: 'html',
	    		error: function (XMLHttpRequest, textStatus, errorThrown) {
	        		jfst("#teamprofile-gamehistory-detail").html(textStatus);
	    		},
	    		success: function(data){
	    			jfst("#teamprofile-gamehistory-detail").html(data);
	    		},
	    		complete: function() {
	    		}	    		
			});		
			
}

function getRosterHistory(teamid,seasonid) { 

			jfst.ajax({
			    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxGetRosterHistory',
			    data: 'teamid=' + teamid + '&seasonid=' + seasonid,
			    type: 'POST',
				dataType: 'html',
	    		error: function (XMLHttpRequest, textStatus, errorThrown) {
	        		jfst("#teamprofile-roster-detail").html(textStatus);
	    		},
	    		success: function(data){
	    			jfst("#teamprofile-roster-detail").html(data);
	    		},
	    		complete: function() {
	    		}	    		
			});		
			
}

function removeTeamContact(id,teamid) {
	if (!confirm("Confirm DELETE request")) {
		return;
	}
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxRemoveTeamContact',
	    data: 'id=' + id + '&teamid=' + teamid,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
       		jfst("#team-current-contacts-list").html(textStatus);
   		},
   		success: function(data){
   			jfst("#team-current-contacts-list").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
}


function addTeamContact(form) {

	if (form.contactname.value == '') {
			alert('Contact Name is required');
			form.contactname.focus();
			return;
	}
	if (!confirm("Confirm ADD request")) {
		return;
	}
	var str = jfst("#team-contact-input-form").serialize();
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxAddTeamContact',
	    data: str,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#team-current-contacts-list").html(data);
   			form.contactname.value="";
   			form.contactemail.value="";
   			form.contactphone.value="";
   		},
   		complete: function() {
   		}	    		
	});		
}


function removePlayerFromRoster(id,teamid,season) {
	if (!confirm("Confirm DELETE request")) {
		return;
	}
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxRemovePlayerFromRoster',
	    data: 'id=' + id + '&teamid=' + teamid + '&seasonid=' + season,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
       		jfst("#roster-players-list").html(textStatus);
   		},
   		success: function(data){
   			jfst("#roster-players-list").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
}


/**
  This function will open GAME form.
  */
function openGameForm() {
	jfst('#scheduledgameform').dialog('open');
	form = document.getElementById("scheduled-game-form");
	form.conference_game.focus();
}

/**
 This function is used to reset the game form after an add/edit has been performed.
 */
function resetGameForm() {
	form = document.getElementById("scheduled-game-form");
	form.gamestatus_sl.disabled = false;
	form.gamestatus_sl.selectedIndex = 0;	
	form.task.value='doSaveGame';
	form.id.value = "0";
	form.gamedate.value = "";
	form.gametime.value = "";
	form.location.value = "";
	form.hometeam_id.selectedIndex = 0;
	form.hometeam_name.value = "";
	form.awayteam_id.selectedIndex = 0
	form.awayteam_name.value = "";
	form.conference_game.value = "Y";
	form.gamestatus.value = "S";	
	form.hometeam_score.value = 0;
	form.awayteam_score.value = 0;	
	form.highlights.value = "";
}

/**
 This function is used to validate the input on the game form.
 */
function validateForm() {
		form = document.getElementById("scheduled-game-form");
		
		var dt=form.gamedate;
		
		// Validate that a division was selected
		if (isDate(dt.value)==false){
			dt.focus();
			return false;
		}	
	
		// Validate that if the hometeam league checkbox is checked that the hometeam_id != 0
		if (form.cb_league_hometeam.checked == true) {
				// Validate that both a home team have been selected
				if (form.hometeam_id.value == 0) {
					form.hometeam_id.focus();
					alert("You must select a home team");
					return false;
				}
		}
		// Validate that if the hometeam league checkbox is NOT checked that hometeam_name != ''
		if (form.cb_league_hometeam.checked == false) {
				// Validate that both a home team have been selected
				form.conference_game.value = 'N';	
				if (form.hometeam_name.value == '') {
					form.hometeam_name.focus();
					alert("You must enter the name of the home team");
					return false;
				}
		}
				
		// Validate that if the awayteam league checkbox is checked that the awayteam_id != 0
		if (form.cb_league_awayteam.checked == true) {
				// Validate that both a home team have been selected
				if (form.awayteam_id.value == 0) {
					form.awayteam_id.focus();
					alert("You must select a away team");
					return false;
				}
		}		
		// Validate that if the awayteam league checkbox is NOT checked that awayteam_name != ''
		if (form.cb_league_awayteam.checked == false) {
				form.conference_game.value = 'N';			
				// Validate that both a home team have been selected
				if (form.awayteam_name.value == '') {
					form.awayteam_name.focus();
					alert("You must enter the name of the away team");
					return false;
				}
		}		

		// Validate the home team and away team are not the same
		if (form.hometeam_id.value ==
			form.awayteam_id.value) {
			alert("The home and away teams cannot be the same");
			form.hometeam_id.focus();
			return false;
		}
	
		if (form.hometeam_id.value != form.teamid.value && form.awayteam_id.value != form.teamid.value) {
			alert("You have not selected your team as either the home team or the away team");
			return false;
		}
		if (form.season_id == 0) {
			alert("Season hasn't been defined");
			return false;
		}
		if (form.division_id == 0) {
			alert("Division hasn't been defined");
			return false;
		}
		return true;
}

/**
 This function is called when adding a game to the database.  It will validate the form data and then call
 an AJAX function to store/update the game data.
 */
function addGame(form) {

		if (!validateForm()) {
			return;
		}
		
		if (confirm("Are you sure you wish to continue?")) {
			var str = jfst("#scheduled-game-form").serialize();
			jfst.ajax({
			    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doSaveGame',
			    data: str,
			    type: 'POST',
				dataType: 'html',
		   		error: function (XMLHttpRequest, textStatus, errorThrown) {
		   		},
		   		success: function(data){
		   			jfst("#current-seasons-games").html(data);
		   			jfst('#scheduledgameform').dialog('close');
		   			resetGameForm();
		   		},
		   		complete: function() {
		   		}	    		
			});
		}		
}


/**
  The editGame function will retrieve a specific game from the database based on its id.  It is an ajax call to the
  backend.  The return value is a JSON object.  The objected is parsed on the form is populated.
  */  
function editGame(id) {
	resetGameForm();
	form = document.getElementById("scheduled-game-form");
	jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getGameJSON',{ id: id },function(game) {
		form.task.value='doSaveGame';
		form.id.value = game.id;
		form.gamedate.value = game.game_date;
		form.location.value = game.location;
		form.hometeam_id.value = game.hometeam_id;
		form.hometeam_name.value = game.hometeam;
		form.awayteam_id.value = game.awayteam_id;
		form.awayteam_name.value = game.awayteam;
		form.conference_game.value = game.conference_game;
		form.gamestatus.value = game.status;
		form.gamestatus_sl.value = game.status;
		form.highlights.value = game.highlights;
		if (game.status == 'C') {
			form.gamestatus_sl.disabled = true;
		} else {
			form.gamestatus_sl.disabled = false;
		}
		form.hometeam_score.value = game.hometeam_score;
		form.awayteam_score.value = game.awayteam_score;
		if (game.hometeaminleague == 'Y') {
			form.cb_league_hometeam.checked = true;
			document.getElementById("hometeam_name").className = "inputOff"; 
			document.getElementById("hometeam_selectlist").className = "inputOn";					
		} else {
			document.getElementById("hometeam_name").className = "inputOn"; 
			document.getElementById("hometeam_selectlist").className = "inputOff";
			form.cb_league_hometeam.checked = false;
		}
		
		if (game.awayteaminleague == 'Y') {
			form.cb_league_awayteam.checked = true;
			document.getElementById("awayteam_name").className = "inputOff"; 
			document.getElementById("awayteam_selectlist").className = "inputOn";					
			
		} else {
			form.cb_league_awayteam.checked = false;
			document.getElementById("awayteam_name").className = "inputOn"; 
			document.getElementById("awayteam_selectlist").className = "inputOff";					
		}
		openGameForm();
		gameid = document.getElementById("game-id-display");
		gameid.innerHtml = game.id;		
	});		
}

function postScore(id) {
	resetGameForm();
	form = document.getElementById("scheduled-game-form");
	jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getGameJSON',{ id: id },function(game) {
		form.task.value='doPostScore';
		form.id.value = game.id;
		form.gamedate.value = game.game_date;
		form.location.value = game.location;
		form.hometeam_id.value = game.hometeam_id;
		form.hometeam_name.value = game.hometeam;
		form.awayteam_id.value = game.awayteam_id;
		form.awayteam_name.value = game.awayteam;
		form.conference_game.value = game.conference_game;
		
		form.gamestatus.value = 'C';
		form.gamestatus_sl.value = 'C';
		form.highlights.value = game.highlights;
		
		form.gamestatus_sl.selectedIndex = 1;
		form.gamestatus_sl.disabled = true;
		
		form.hometeam_score.value = game.hometeam_score;
		form.awayteam_score.value = game.awayteam_score;
		if (game.hometeaminleague == 'Y') {
			form.cb_league_hometeam.checked = true;
			document.getElementById("hometeam_name").className = "inputOff"; 
			document.getElementById("hometeam_selectlist").className = "inputOn";					
		} else {
			document.getElementById("hometeam_name").className = "inputOn"; 
			document.getElementById("hometeam_selectlist").className = "inputOff";
			form.cb_league_hometeam.checked = false;
		}
		
		if (game.awayteaminleague == 'Y') {
			form.cb_league_awayteam.checked = true;
			document.getElementById("awayteam_name").className = "inputOff"; 
			document.getElementById("awayteam_selectlist").className = "inputOn";					
			
		} else {
			form.cb_league_awayteam.checked = false;
			document.getElementById("awayteam_name").className = "inputOn"; 
			document.getElementById("awayteam_selectlist").className = "inputOff";					
		}
		openGameForm();
		gameid = document.getElementById("game-id-display");
		gameid.innerHtml = game.id;		
	});		
}


/**
 This function is used to remove a game.
 */
function deleteGame(gameid,teamid) {
	if (confirm("Are you sure you wish to continue?")) {
		var str = jfst("#scheduled-game-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doDeleteGame',
		    data: 'gameid=' + gameid + '&teamid=' + teamid,
		    type: 'POST',
			dataType: 'html',
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	   		},
	   		success: function(data){
	   			jfst("#current-seasons-games").html(data);
	   			resetGameForm();
	   		},
	   		complete: function() {
	   		}	    		
		});
	}		
}


function updateUserPreferences(form) {

	var str = jfst("#userpreferences-form").serialize();
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=updateUserPreferences',
	    data: str,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#userpreferences-status").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
} 

	function refreshRoster() {
		teamid = document.getElementById("teamid").value;
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getTeamRoster',
		    data: 'teamid=' + teamid,
		    type: 'POST',
			dataType: 'html',
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	   		},
	   		success: function(data){
	   			jfst("#roster-players-list").html(data);
	   		},
	   		complete: function() {
	   		}	    		
		});	
	}

/**
This function will return the list of available players to a team when
creating their roster.
*/ 
function getAvailablePlayerList(form) {

	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getavailableplayers',
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#playerlist-table").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
}


function addPlayerToRoster(pid,name) {
	var rosterid = document.getElementById("rosterid").value; 
	if (!confirm("Add " + name + " to the roster?")) {
		return;
	}
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=ajaxAddPlayerToRoster',
	    data: 'rosterid=' + rosterid + '&playerid=' + pid,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
  			jfst("#manage-roster-status").html(data);
   			refreshRoster();
   			getAvailablePlayerList();
   		},
   		complete: function() {
   		}	    		
	});		
	
}

function removePlayerFromRoster(pid) {
	if (!confirm("Confirm DELETE request?")) {
		return;
	}
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=ajaxRemovePlayerFromRoster',
	    data: 'playerid=' + pid,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#manage-roster-status").html(data);
   			refreshRoster();
   			getAvailablePlayerList();
   		},
   		complete: function() {
   		}	    		
	});		
}

function editPlayerOnRoster(rid, pid) {
	alert('edit player on roster');
	return;
	
	if (!confirm("Confirm DELETE request?")) {
		return;
	}
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=ajaxRemovePlayerFromRoster',
	    data: 'rosterid=' + rid + '&playerid=' + pid,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#manage-roster-status").html(data);
   			refreshRoster();
   			getAvailablePlayerList();
   		},
   		complete: function() {
   		}	    		
	});		
}


function addTeamVenue(form) {

/*	if (form.contactname.value == '') {
			alert('Contact Name is required');
			form.contactname.focus();
			return;
	}
*/

	if (form.venueid.value == 0) {
		alert('A VENUE/FIELD must be specified');
		return;
	}		
		
	if (!confirm("Confirm ADD request")) {
		return;
	}
	var str = jfst("#team-venue-input-form").serialize();
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxAddTeamVenue',
	    data: str,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#team-current-venues-list").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
}

function removeTeamVenue(teamid, venueid) {

/*	if (form.contactname.value == '') {
			alert('Contact Name is required');
			form.contactname.focus();
			return;
	}
*/
	if (!confirm("Confirm REMOVE request")) {
		return;
	}
	var str = jfst("#team-venue-input-form").serialize();
	jfst.ajax({
	    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&task=ajaxRemoveTeamVenue',
	    data: 'teamid=' + teamid + '&venueid=' + venueid,
	    type: 'POST',
		dataType: 'html',
   		error: function (XMLHttpRequest, textStatus, errorThrown) {
   		},
   		success: function(data){
   			jfst("#team-current-venues-list").html(data);
   		},
   		complete: function() {
   		}	    		
	});		
}

function initSubscribeNotificationForm() {
	jfst(function() {
		jfst("#subscribe-notification-dialog").dialog({
			bgiframe: true,
			width: 550,
			modal: true,
			resizable: false,
			close: function(event, ui) {
			 },
			autoOpen: false
		});
	});
}

function subscribeGameNotification() {
	jfst('#subscribe-notification-dialog').dialog('open');
//	form = document.getElementById("scheduled-game-form");
//	form.conference_game.focus();
	
	jfst("#game-notification-signup-image").attr('src','http://localhost/j15/components/com_jleague/assets/images/unsubscribe-blue.gif');
}
