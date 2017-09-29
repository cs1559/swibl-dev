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
	   		success: function(data){v
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
						/* jfst('#loading-indicator').show(); */ 
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
	
	function getGameHistory(teamid) {
		getGameHistory(teamid,0);
	}
	
	
	/* Deprecated */
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
	
	
	/* ++++++++++++++++++++++++++   UPLOAD LOGO FUNCTIONS +++++++++++++++++++++++++++++++ */
	function validateUploadLogoForm(form) {
		fileName = form.Filedata.value;
		var ext = fileName.substr(fileName.lastIndexOf('.') + 1);
		var lc_ext = ext.toLowerCase();
		if (lc_ext == "pdf") {
			alert("PDF files are NOT valid graphic files.  Please use JPG, PNG, BMP or GIF files");
			return false;
		}
		if (lc_ext != "png" && lc_ext != "gif" && lc_ext != "jpg" && lc_ext !="bmp" ) {
			alert("Unsupported logo format. Please use JPG, PNG, BMP or GIF files")
			return false;
		}
		return true;
	}
	
	/* ++++++++++++++++++++++++++   TEAM CONTACT FUNCTIONS +++++++++++++++++++++++++++++++ */
	
	function validateTeamContactForm() {
		form = document.getElementById("team-contact-input-form");
		if (form.contactname.value == '') {
			alert('Contact Name is required');
			form.contactname.focus();
			return false;
		}
		if (form.contactemail.value == '') {
			alert('Contact email is required');
			form.contactemail.focus();
			return false;
		}
		if (form.contactphone.value == '') {
			alert('Contact phone is required');			
			form.contactphone.focus();
			return false;
		}	
		return true;
	}
	
	function saveTeamContact() {
		if (!validateTeamContactForm()) {
			return;
		}
		var str = jfst("#team-contact-input-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doSaveTeamContact&nodebug=1',
		    data: str,
		    type: 'POST',
			dataType: 'html',
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Saving contact .... </strong>"); 
			},	
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	   		},
	   		success: function(data){
	   			jfst("#team-current-contacts-list").html(data);
	   			jfst('#myModal').modal('hide');
	   			resetTeamContactForm();
	   		},
	   		complete: function() {
				jfst('#modal_status_message').html("");
	   		}	    		
		});
				
	}
	
	function removeTeamContact(id, teamid) {
		if (!confirm("Confirm DELETE request")) {
			return;
		}
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doRemoveTeamContact',
		    data: 'contactid=' + id + '&teamid=' + teamid,
		    type: 'POST',
			dataType: 'html',
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Deleting contact .... </strong>"); 
			},				
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
		if (form.contactemail.value == '') {
				alert('Contact email is required');
				form.contactemail.focus();
				return;
		}
		if (form.contactphone.value == '') {
				alert('Contact phone is required');
				form.contactphone.focus();
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
	
	function editTeamContact(id, teamid) {
		resetTeamContactForm(); 
		if (id > 0) {
			jfst('#modal_status_message').html("<strong>Loading Contact .... </strong>");
			form = document.getElementById("team-contact-input-form");
			jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getTeamContactJSON&nodebug=1',{ id: id },function(contact) {
				form.task.value='doSaveTeamContact';
				form.contactid.value = contact.id;
				form.contactname.value = contact.name;
				form.contactphone.value = contact.phone;
				form.contactemail.value = contact.email;
				form.role.value = contact.role;
				form.teamid.value = contact.teamid;
				form.primarycontact.value = contact.primary;
				form.userid.value = contact.userid;
			})
			.done(function() {
				jfst('#modal_status_message').html("");
			})
			.fail(function() {
				jfst('#modal_status_message').html("Error occurred loading Contact ..");
			});
		}
		jfst('#myModal').modal('show');		
		
	}
	
	function resetTeamContactForm() {
		form = document.getElementById("team-contact-input-form");
		form.contactid.value = 0;
		form.contactname.value = "";
		form.contactphone.value = "";
		form.contactemail.value = "";
		form.userid.selectedIndex = 0;
		form.primarycontact[0].checked = true;
		form.role.value = "";
	}
	
	/* ++++++++++++++++++++++++++   ROSTER FUNCTIONS +++++++++++++++++++++++++++++++ */
	
	
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
	
	function resetPlayerForm() {
		form = document.getElementById("team-player-input-form");
		form.task.value='doSavePlayerOnRoster';
		form.id.value = "0";
		form.playerfname.value = "";
		form.playerlname.value = "";
	}
	
	/**
	 * @deprecated 
	 * @param pid
	 * @param name
	 */
	/*
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
	*/
	function removePlayerFromRoster(pid) {
		if (!confirm("Confirm DELETE PLAYER request?")) {
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
	   			jfst("#seasons-roster-table").html(data);
	   			//jfst('#myModal').modal('hide');	
	   			//refreshRoster();
	   			//getAvailablePlayerList();
	   		},
	   		complete: function() {
	   		}	    		
		});		
	}
	
	/**
	 * This function will invoke an ajax call to retrieve player info and then automatically show the modal
	 * dialog window.
	 * 
	 * @param pid
	 */
	
	function editPlayerOnRoster(pid,  teamid, seasonid) {
		if (pid == 0) {
			resetPlayerForm();
			form = document.getElementById("team-player-input-form");
			form.task.value='doSavePlayerOnRoster';
			form.teamid.value = teamid;
			form.seasonid.value = seasonid;
		} else {
			jfst('#modal_status_message').html("<strong>Loading Player .... </strong>");
			form = document.getElementById("team-player-input-form");
			jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getPlayerJSON&nodebug=1',{ playerid: pid },function(player) {
				form.task.value='doSavePlayerOnRoster';
				form.id.value = player.id;
				form.playerfname.value = player.firstname;
				form.playerlname.value = player.lastname;
				form.teamid.value = player.properties.teamid;
				form.seasonid.value = player.properties.seasonid;
				})
				.done(function() {
					jfst('#modal_status_message').html("");
				})
				.fail(function() {
					jfst('#modal_status_message').html("Error occurred loading players ..");
				});
		}
		jfst('#myModal').modal('show');	
	}

	function addPlayerOnRoster(pid, seasonid, teamid) {
		form = document.getElementById("team-player-input-form");
		form.task.value='doSavePlayerOnRoster';
		form.id.value = 0;
		form.playerfname.value = "";
		form.playerlname.value = "";
		form.teamid.value = teamid;
		form.seasonid.value = seasonid;
		jfst('#myModal').modal('show');	
	}
	
	
	/**
	 * This function validates the Player Input form
	 * @returns {Boolean}
	 */
	function validatePlayerForm() {
		form = document.getElementById("team-player-input-form");
		if (form.playerfname.value == '') {
			alert('Player First Name is required');
			form.playerfname.focus();
			return false;
		}
		if (form.playerlname.value == '') {
				alert('Contact email is required');
				form.playerlname.focus();
				return false;
		}
		return true;
	}
	
	/**
	 * 
	 */
	function savePlayerOnRoster() {
	
		if (!validatePlayerForm()) {
			return;
		}
	
		if (confirm("Are you sure you wish to continue?")) {
			var str = jfst("#team-player-input-form").serialize();
			jfst.ajax({
			    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doSavePlayerOnRoster&nodebug=1',
			    data: str,
			    type: 'POST',
				dataType: 'html',
				beforeSend: function() {
					jfst('#modal_status_message').html("<strong>Saving player .... </strong>"); 
				},	
		   		error: function (XMLHttpRequest, textStatus, errorThrown) {
		   		},
		   		success: function(data){
		   			jfst("#seasons-roster-table").html(data);
		   			jfst('#myModal').modal('hide');	
		   			resetPlayerForm();
		   		},
		   		complete: function() {
					jfst('#modal_status_message').html("");
		   		}	    		
			});
		}	
	}
	
	/* ++++++++++++++++++++++++++   GAME/SCHEDULE FUNCTIONS +++++++++++++++++++++++++++++++ */
	
	
	/**
	  This function will open GAME form.
	  */
	function openGameForm(action) {
		if (action == 'insert') {
			resetGameForm(); 	
		}
		jfst('#gameModal').modal('show');
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
		form.location.value = "";
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
		form.awayteam_score.value = 0;
		form.shortgame.selectedIndex = 0;
		form.highlights.value = "";
		jfst('#modal_status_message').html("");
	}
	
	function setLocation(parm) {
		form = document.getElementById("scheduled-game-form");
		form.location.value = parm;
		return false;
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
				    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&nodebug=1&task=doSaveGame',
				    data: str,
				    type: 'POST',
					dataType: 'html',
					beforeSend: function() {
						jfst('#modal_status_message').html("<strong>Saving Game .... </strong>"); 
					},	
			   		error: function (XMLHttpRequest, textStatus, errorThrown) {
			   		},
			   		success: function(data){
			   			jfst("#teamprofile-schedule-detail").html(data);
			   			jfst('#gameModal').modal('hide');
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
		openGameForm();
		elem = document.getElementById("ajax_status_message");
		elem.innerHTML="Loading game ..";
		form = document.getElementById("scheduled-game-form");
		jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&nodebug=1&task=getGameJSON',{ id: id },function(game) {
			form.task.value='doSaveGame';
			form.id.value = game.id;
			form.shortgame.value = game.shortgame;
			form.gamedate.value = game.game_date;
			form.gametime.value = game.game_time;
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
			
			gameid = document.getElementById("game-id-display");
			gameid.innerHTML = game.id;
		})
		 .done(function() {
			 elem = document.getElementById("ajax_status_message");
			 elem.innerHTML = "";
		})
		.fail(function() {
			elem = document.getElementById("ajax_status_message");
			elem.innerHTML="Error occurred loading game ..";
		})
		;		
	}
	
	function postScore(id) {
		resetGameForm();
		openGameForm();
		elem = document.getElementById("ajax_status_message");
		elem.innerHTML="Loading game ..";
		
		form = document.getElementById("scheduled-game-form");
		jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&nodebug=1&task=getGameJSON',{ id: id },function(game) {
			form.task.value='doPostScore';
			form.id.value = game.id;
			form.gamedate.value = game.game_date;
			form.gametime.value = game.game_time;
			form.location.value = game.location;
			form.hometeam_id.value = game.hometeam_id;
			form.hometeam_name.value = game.hometeam;
			form.awayteam_id.value = game.awayteam_id;
			form.awayteam_name.value = game.awayteam;
			form.conference_game.value = game.conference_game;
			
			form.gamestatus.value = 'C';
			form.gamestatus_sl.value = 'C';
			form.highlights.value = game.highlights;
			
			form.gamestatus_sl.selectedIndex = 3;
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
			gameid = document.getElementById("game-id-display");
			gameid.innerHTML = game.id;

		})
		.done(function() {
			 elem = document.getElementById("ajax_status_message");
			 elem.innerHTML = "";
		})
		.fail(function() {
			elem = document.getElementById("ajax_status_message");
			elem.innerHTML="Error occurred loading game ..";
		})

		;

		
	}
	
	
	/**
	 This function is used to remove a game.
	 */
	function deleteGame(gameid,teamid) {
		if (confirm("Are you sure you wish to DELETE game?")) {
			var str = jfst("#scheduled-game-form").serialize();
			jfst.ajax({
			    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doDeleteGame',
			    data: 'gameid=' + gameid + '&teamid=' + teamid,
			    type: 'POST',
				dataType: 'html',
				beforeSend: function() {
					jfst('#modal_status_message').html("<strong>Deleting Game .... </strong>"); 
				},	
		   		error: function (XMLHttpRequest, textStatus, errorThrown) {
		   		},
		   		success: function(data){
		   			jfst("#current-seasons-games").html(data);
		   			jfst('#modal_status_message').html("");
		   			resetGameForm();
		   		},
		   		complete: function() {
		   		}	    		
			});
		}		
	}
	
	

	/*
		jfst(function() {
			jfst("#scheduledgameform").dialog({
				bgiframe: true,
				width: 550,
				modal: true,
				resizable: false,
				close: function(event, ui) {
					resetGameForm();
					jfst("#playerform-message").html(""); 
				 },
				autoOpen: false
			});
		});
		 */	
		function switchtab(tab) {
			var $tabs = jfst('#tabs').tabs(); 
		    $tabs.tabs('select', tab); 
		    return false;
		}

		function changeStatus(val) {
			document.getElementById("gamestatus").value = val;
			return;
		}
		
		function switchToNonLeague(elem) {
			if (elem.name == "cb_league_hometeam") {
				if (elem.checked == false) {
					document.getElementById("hometeam_name").className = "inputOn"; 
					document.getElementById("hometeam_selectlist").className = "inputOff";	
				} else {
					document.getElementById("hometeam_name").className = "inputOff"; 
					document.getElementById("hometeam_selectlist").className = "inputOn";			
				}
			}
			if (elem.name == "cb_league_awayteam") {
				if (elem.checked == false) {
					document.getElementById("awayteam_name").className = "inputOn"; 
					document.getElementById("awayteam_selectlist").className = "inputOff";	
				} else {
					document.getElementById("awayteam_name").className = "inputOff"; 
					document.getElementById("awayteam_selectlist").className = "inputOn";			
				}
			}	
		} 
	
	
	
	
	
	/* +++++++++++++++++++++++++++++++++++++++++  USER PREFRENCES ++++++++++++++++++++++++++++++++++++++++++ */
	
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
	
	/* +++++++++++++++++++++++++++++++++++++++++  ROSTER PREFRENCES ++++++++++++++++++++++++++++++++++++++++++ */
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
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Saving Player .... </strong>"); 
			},		   		
	   		success: function(data){
	  			jfst("#manage-roster-status").html(data);
	   			refreshRoster();
	   			getAvailablePlayerList();
	   		},
	   		complete: function() {
	   			jfst('#modal_status_message').html("");
	   		}	    		
		});		
		
	}
	
	function removePlayerFromRoster(pid, teamid, seasonid) {
		if (!confirm("Confirm DELETE request?")) {
			return;
		}
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=ajaxRemovePlayerFromRoster',
		    data: 'playerid=' + pid + '&teamid=' + teamid + '&seasonid=' + seasonid,
		    type: 'POST',
			dataType: 'html',
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Removing Player .... </strong>"); 
			},		   		
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	   		},
	   		success: function(data){
	   			jfst("#seasons-roster-table").html(data);
//	   			refreshRoster();
//	   			getAvailablePlayerList();
	   		},
	   		complete: function() {
	   			jfst('#modal_status_message').html("");
	   		}	    		
		});		
	}
	

	/* +++++++++++++++++++++++++++++++++++++++++  VENUE FUNCTIONS ++++++++++++++++++++++++++++++++++++++++++ */
	function openVenueForm(teamid) {
		//if (action == 'insert') {
		//	resetGameForm(); 	
		//}
		jfst('#myModal').modal('show');
		form = document.getElementById("team-venue-input-form");
		form.teamid.value = teamid;
	}
	
	function addTeamVenue(form) {
	
		if (form.venueid.value == 0) {
			alert('A VENUE/FIELD must be specified');
			return;
		}		
			
		if (!confirm("Confirm ADD request")) {
			return;
		}
		var str = jfst("#team-venue-input-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&nodebug=1&task=addTeamVenue',
		    data: str,
		    type: 'POST',
			dataType: 'html',
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Adding venue .... </strong>"); 
			},		   					
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	   		},
	   		success: function(data){
	   			jfst("#team-current-venues-list").html(data);
	   			jfst('#myModal').modal('hide');
	   		},
	   		complete: function() {
	   			jfst('#modal_status_message').html("");
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
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=teams&nodebug=1&task=removeTeamVenue',
		    data: 'teamid=' + teamid + '&venueid=' + venueid,
		    type: 'POST',
			dataType: 'html',
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Removing venue .... </strong>"); 
			},		   					
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	   		},
	   		success: function(data){
	   			jfst("#team-current-venues-list").html(data);
	   		},
	   		complete: function() {
				jfst('#modal_status_message').html("");
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
	
	function getRegistrationForm(seasonid,teamid) { 
	
				jfst.ajax({
				    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=registrations&task=ajaxGetForm',
				    data: 'seasonid=' + seasonid + '&teamid=' + teamid,
				    type: 'POST',
					dataType: 'html',
		    		error: function (XMLHttpRequest, textStatus, errorThrown) {
		        		jfst("#entryform").html(textStatus);
		    		},
		    		success: function(data){
		    			jfst("#entryform").html(data);
		    		}
				});					
	}
	
	
	function subscribeGameNotification() {
		jfst('#subscribe-notification-dialog').dialog('open');
	//	form = document.getElementById("scheduled-game-form");
	//	form.conference_game.focus();
		
		jfst("#game-notification-signup-image").attr('src','http://localhost/j15/components/com_jleague/assets/images/unsubscribe-blue.gif');
	}
	
	
	
	/**
	 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
	 */
	// Declaring valid date character, minimum year and maximum year
	var dtCh= "/";
	var minYear=1900;
	var maxYear=2100;

	function isInteger(s){
		var i;
	    for (i = 0; i < s.length; i++){   
	        // Check that current character is number.
	        var c = s.charAt(i);
	        if (((c < "0") || (c > "9"))) return false;
	    }
	    // All characters are numbers.
	    return true;
	}

	function stripCharsInBag(s, bag){
		var i;
	    var returnString = "";
	    // Search through string's characters one by one.
	    // If character is not in bag, append to returnString.
	    for (i = 0; i < s.length; i++){   
	        var c = s.charAt(i);
	        if (bag.indexOf(c) == -1) returnString += c;
	    }
	    return returnString;
	}

	function daysInFebruary (year){
		// February has 29 days in any year evenly divisible by four,
	    // EXCEPT for centurial years which are not also divisible by 400.
	    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
	}
	function DaysArray(n) {
		for (var i = 1; i <= n; i++) {
			this[i] = 31
			if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
			if (i==2) {this[i] = 29}
	   } 
	   return this
	}	
	function isDate(dtStr){
		var daysInMonth = DaysArray(12)
		var pos1=dtStr.indexOf(dtCh)
		var pos2=dtStr.indexOf(dtCh,pos1+1)
		var strMonth=dtStr.substring(0,pos1)
		var strDay=dtStr.substring(pos1+1,pos2)
		var strYear=dtStr.substring(pos2+1)
		strYr=strYear
		if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
		if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
		for (var i = 1; i <= 3; i++) {
			if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
		}
		month=parseInt(strMonth)
		day=parseInt(strDay)
		year=parseInt(strYr)
		if (pos1==-1 || pos2==-1){
			alert("The date format should be : mm/dd/yyyy")
			return false
		}
		if (strMonth.length<1 || month<1 || month>12){
			alert("Please enter a valid month")
			return false
		}
		if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
			alert("Please enter a valid day")
			return false
		}
		if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
			alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
			return false
		}
		if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
			alert("Please enter a valid date")
			return false
		}
	return true
	}

	
	/* ++++++++++++++++++++++++++++++++++++++ BULLETIN FUNCTIONS ++++++++++++++++++++++++++++++++++ */
	function validateBulletinForm() {
		form = document.getElementById("team-bulletin-input-form");
		if (form.bulletintitle.value == '') {
			alert('A bulletin title is required');
			form.bulletinTitle.focus();
			return false;
		}
		if (form.bulletindesc.value == '') {
			alert('A bulletin description is required');
			form.contactemail.focus();
			return false;
		}
		return true;		
	}
	
	function resetBulletinForm() {
		form = document.getElementById("team-bulletin-input-form");
		form.bulletinid.value = 0;
		form.bulletintitle.value = "";
		form.bulletindesc.value = "";
		form.contactname.value = "";
		form.contactphone.value = "";
		form.contactemail.value = "";
		form.bulletin_type.selectedIndex = 0;
		jfst('#modal_status_message').html("");
	}	
	function saveTeamBulletin(bulletinid) {
		if (!validateBulletinForm()) {
			return;
		}
		var str = jfst("#team-bulletin-input-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doSaveBulletin&nodebug=1',
		    data: str,
		    type: 'POST',
			dataType: 'html',
				error: function (XMLHttpRequest, textStatus, errorThrown) {
				},
				beforeSend: function() {
					jfst('#modal_status_message').html("<strong>Saving Bulletin .... </strong>"); 
				},	
		   		success: function(data){
		   			jfst("#team-current-bulletin-list").html(data);
		   			jfst('#myModal').modal('hide');
		   			resetBulletinForm();
		   		},
		   		complete: function() {
		   		}	    		
			});		
	}
	
	function saveAdminBulletin(bulletinid) {
		if (!validateBulletinForm()) {
			return;
		}
		var str = jfst("#team-bulletin-input-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doSaveAdminBulletin&nodebug=1',
		    data: str,
		    type: 'POST',
			dataType: 'html',
				error: function (XMLHttpRequest, textStatus, errorThrown) {
				},
				beforeSend: function() {
					jfst('#modal_status_message').html("<strong>Saving Bulletin .... </strong>"); 
				},	
		   		success: function(data){
		   			jfst("#team-current-bulletin-list").html(data);
		   			jfst('#myModal').modal('hide');
		   			resetBulletinForm();
		   		},
		   		complete: function() {
		   		}	    		
			});		
	}
	
	function saveNewBulletin(bulletinid) {
		if (!validateBulletinForm()) {
			return;
		}
		var str = jfst("#team-bulletin-input-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=doSaveNewBulletin&nodebug=1',
		    data: str,
		    type: 'POST',
			dataType: 'html',
				error: function (XMLHttpRequest, textStatus, errorThrown) {
				},
				beforeSend: function() {
					jfst('#modal_status_message').html("<strong>Saving Bulletin .... </strong>"); 
				},	
		   		success: function(data){
		   			jfst("#team-current-bulletin-list").html(data);
		   			jfst('#myModal').modal('hide');
		   			resetBulletinForm();
		   		},
		   		complete: function() {
		   		}	    		
			});		
	}
	
	function addNewBulletin(bullintinid, category, ownerid ) {
		if (category == '') {
			alert('A CATEGORY is required');
			return false;
		}
		if (ownerid == '') {
			alert('An OWNERID is required');
			return false;
		}
		resetBulletinForm();
		form = document.getElementById("team-bulletin-input-form");
		form.bulletinid.value = 0;
		if (category=="T") {
			form.teamid.value=ownerid;
			form.ownerid.value=ownerid;
		}
		if (category=="S") {
			form.sponsorid.value=ownerid;
			form.ownerid.value=ownerid;
		}
		if (category=="A") {
			form.sponsorid.value=0;
			form.teamid.value=0;
			form.ownerid.value=ownerid;
		}
		jfst('#myModal').modal('show');		
	}
	
	
	function addTeamBulletin(bulletinid, teamid) {
		addBulletin(bulletinid, teamid, false);
	}
	
	function addBulletin(bulletinid, teamid, admin) {
		admin = typeof admin !== 'undefined' ? admin : false;
		resetBulletinForm();
		form = document.getElementById("team-bulletin-input-form");
		if (admin) {
			form.task.value='doSaveAdminBulletin';
		} else {
			form.task.value='doSaveBulletin';	
		}
		
		form.bulletinid.value = 0;
		form.teamid.value = teamid;
		jfst('#myModal').modal('show');
	}
	
	function editTeamBulletin(bulletinid, teamid) {
		resetBulletinForm(); 
		form = document.getElementById("team-bulletin-input-form");
		if (bulletinid > 0) {
			jfst('#modal_status_message').html("<strong>Loading Bulletin .... </strong>");
		}
		jfst.getJSON('index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&task=getBulletinJSON&nodebug=1',{ bulletinid: bulletinid },function(bulletin) {
			form.task.value='doSaveBulletin';
			form.bulletinid.value = bulletin.id;
			form.bulletintitle.value = bulletin.title;
			form.bulletindesc.value = bulletin.description;
			form.contactname.value = bulletin.contactname;
			form.contactphone.value = bulletin.contactphone;
			form.contactemail.value = bulletin.contactemail;
			form.teamid.value = bulletin.teamid;
			form.bulletin_type.value = bulletin.type;
			form.bulletin_category.value = bulletin.category;
		})
		.done(function() {
			jfst('#modal_status_message').html("");
		})
		.fail(function() {
			jfst('#modal_status_message').html("Error occurred loading bulletin ..");
		});		
		jfst('#myModal').modal('show');			
	}
	
	function removeTeamBulletin(bulletinid,teamid) {
		removeBulletin(bulletinid, teamid, false);
	}
		
	function removeBulletin(bulletinid,teamid, admin) {
		admin = typeof admin !== 'undefined' ? admin : false;
		if (!confirm("Confirm DELETE request")) {
			return;
		}
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&nodebug=1&task=doRemoveBulletin',
		    data: 'bulletinid=' + bulletinid + '&teamid=' + teamid,
		    type: 'POST',
			dataType: 'html',
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {	
	       		jfst("#team-current-bulletin-list").html(textStatus);
	   		},
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Deleting Bulletin .... </strong>"); 
			},	
	   		success: function(data){
	   			jfst("#team-current-bulletin-list").html(data);
	   		},
	   		complete: function() {
	   		}	    		
		});		
	}

	function promoteBulletin(bulletinid,teamid, admin) {
		admin = typeof admin !== 'undefined' ? admin : false;
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&nodebug=1&task=doPromoteBulletin',
		    data: 'bulletinid=' + bulletinid + '&teamid=' + teamid,
		    type: 'POST',
			dataType: 'html',
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {	
	       		jfst("#team-current-bulletin-list").html(textStatus);
	   		},
	   		success: function(data){
	   			jfst("#team-current-bulletin-list").html(data);
	   			alert('Bulletin Successfully Promoted');
	   		},
	   		complete: function() {
	   		}	    		
		});		
	}
	
	function removeNewBulletin(bulletinid, sponsorid) {
		if (!confirm("Confirm DELETE request")) {
			return;
		}
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw&controller=ajax&nodebug=1&task=doRemoveNewBulletin',
		    data: 'bulletinid=' + bulletinid + '&sponsorid=' + sponsorid,
		    type: 'POST',
			dataType: 'html',
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {	
	       		jfst("#team-current-bulletin-list").html(textStatus);
	   		},
			beforeSend: function() {
				jfst('#modal_status_message').html("<strong>Deleting Bulletin .... </strong>"); 
			},	
	   		success: function(data){
	   			jfst("#team-current-bulletin-list").html(data);
	   		},
	   		complete: function() {
	   		}	    		
		});		
	}
	