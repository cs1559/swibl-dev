
<script>

	jfst(function() {
		jfst("#player-form").dialog({
			bgiframe: true,
			height: 200,
			width: 450,
			modal: true,
			resizable: false,
			close: function(event, ui) {
				//getAvailablePlayerList();
				refreshRoster();
				jfst("#playerform-message").html(""); 
			 },
			autoOpen: false
		});
		
	});

	
	function validatePlayerForm() {
		var form = document.playerForm;
		if (form.playerfname.value.length <= 0) {
			alert('Player first name is required');
			form.playerfname.focus();
			return;
		}
		
		if (form.playerlname.value.length <= 0) {
			alert('Player last name is required');
			form.playerlname.focus();
			return;
		}
	
		if (!confirm("Confirm SAVE request")) {
			return;
		}

		var str = jfst("#modify-player-input-form").serialize();
		jfst.ajax({
		    url: 'index.php?option=com_jleague&tmpl=component&format=raw',
		    data: str,
		    type: 'POST',
			dataType: 'html',
	   		error: function (XMLHttpRequest, textStatus, errorThrown) {
	       		jfst("#playerform-message").html(textStatus);
	   		},
	   		success: function(data){
	   			jfst("#playerlist-message").html(data);
	   			jfst('#player-form').dialog('close');
	   		},
	   		complete: function() {
	   			// reset input fields
	   			//document.playerForm.playerid.value="0";
	   			document.playerForm.playerfname.value="";
	   			document.playerForm.playerlname.value="";
//	   			document.playerForm.city.value="";
//	   			document.playerForm.state.value="";
//	   			document.playerForm.dateofbirth.value="";
	   		}	    		
		});		
			
	}
	
	function createPlayer() {
		//document.playerForm.func.value=func;
		/*
		if (func == 'insert') {
			document.getElementById("addtorostercb").style.display = 'inline';
		} else {
			document.getElementById("addtorostercb").style.display = 'none';
		}
		*/
		jfst('#player-form').dialog('open');
	}
	
	function addPlayers() {
		getAvailablePlayerList();
		jfst('#manageroster-playerlist').dialog('open');
	}

	function closePlayerWindow() {
		jfst('#player-form').dialog('close');
	}
/*	
jfst(document).ready(function() {
	getAvailablePlayerList();
});
 */
	
</script>


<?php include('teamprofile.edit.miniheader.php'); ?>

<div class="clr"/></div>
<br />

<div class="jleague-title">
<h2>Roster Management</h2>
</div>


<div id="manage-roster-status"></div>

<div style="width: 45%;  float: left;">
	<div id="player-form" title="Modify Player Form">
	<p>
	Enter the players FIRST and LAST name and then press SAVE.  Press CANCEL to close the window without
	adding the player to the roster.
	</p>
	<form id="modify-player-input-form" name="playerForm" method="post" action="index.php">
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key">First Name:</td><td><input id="playerfname" type="text" name="playerfname" size="20"/></td>
				</tr>
				<tr>
					<td class="key">Last Name:</td><td><input id="playerlname" type="text" name="playerlname" size="40"/></td>
				</tr>
				<tr>
					<td>
						<br/>
						<input type="button" value="Save" onClick="validatePlayerForm(document.playerForm);"/>
						<input type="button" value="Cancel" onClick="closePlayerWindow();"/>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="option" value="com_jleague"/>
		<input type="hidden" name="controller" value="ajax"/>
		<input type="hidden" name="task" value="ajaxAddPlayerToRoster"/>
		<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
		<input type="hidden" name="seasonid" value="<?php echo $roster->getSeason(); ?>"/>
		<span id="playerform-message"></span>
	</form>
	</div>
</div>

<input id="teamid" type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>

<div style="width: 50%; float: left; margin-left: 15px;">	
<a href="javascript:createPlayer();">Create New Player</a>
  	<h3>Current Players on <?php echo $season->getTitle(); ?>  Roster</h3>
	<div id="roster-players-list">
		<?php echo $currentrostertable; ?>
	</div>
</div>

