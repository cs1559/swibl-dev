<div>

<script>
	var randomnumber = Math.floor(Math.random()*1000);
	
	function validateForm() {
		var form = document.registrationform;
		
		selIdx = form.seasonid.selectedIndex;
		seasonid = form.seasonid.options[selIdx].value;
		ageIdx = form.agegroup.selectedIndex;
		agegroup = form.agegroup.options[selIdx].value;
		
		if (seasonid == '') {
			form.seasonid.focus();
			alert("You must select a season");
			return;
		}
		if (ageIdx == 0) {
			form.agegroup.focus();
			alert("You must select an age group");
			return;
		}
		
		if (form.teamname.value == '') {
			form.teamname.focus();
			alert("Team name is required");
			return;
		}
		if (form.coachname.value == '') {
			form.coachname.focus();
			alert("The name of the head coach is required");
			return;
		}
		if (form.city.value == '') {
			form.city.focus();
			alert("City is a required field");
			return;
		}
		if (form.state.value == '') {
			form.state.focus();
			alert("State is a required field");
			return;
		}		
		if (form.coachphone.value == '') {
			form.coachphone.focus();
			alert("Coaches phone number is required");
			return;
		}
		if (form.coachemail.value == '') {
			form.coachemail.focus();
			alert("Email address is required");
			return;
		}
		if (form.enteredby.value == '') {
			form.enteredby.focus();
			alert("The name of the person completing this form is required");
			return;
		}
		if (form.antispamvalue.value != randomnumber) {
			alert("Anti Spam value is not the same");
			return;
		}
		
		if (!confirm("Please confirm your registration request")) {
			return;
		}				
		form.submit();
	}
	
	jfst(document).ready(function() {
	
		document.getElementById("captcha-value").innerHTML=randomnumber;
		var form = document.registrationform;
		form.returningteam.focus();
	});

</script>

<div class="jleague-title">
<h2>Team Registration</h2>
</div>

<p>
<strong>IMPORTANT - PLEASE READ:</strong><br/>
Please complete ALL fields and press the SAVE button.  
You will receive an email to confirm your registration.  Please follow the insructions in the email.
If your team played previously in SWIBL, please log in first, go to your team profile and select the registration menu option to 
register for the upcoming season. 
</p>

<div>
<form name="registrationform" method="post" action="index.php">

	<table class="registrationform-table">
		<tr><td class="registrationform-input width-30">Team Id:</td><td><?php echo $_view->getTeamIdValue($reg); ?></td></tr>
		<tr><td class="registrationform-input width-30">Season:</td><td><?php echo JLHtml::getRegistrationOpenSeasonList('seasonid',''); ?></td></tr>
		<tr><td class="registrationform-input">Age Group you plan to play in:</td><td><?php echo JLHtml::getAgeGroupSelectList('agegroup',$reg->getAgeGroup(),''); ?> </td></tr>
		<tr><td class="registrationform-input width-30">Team Name:</td><td><?php echo $this->getInputElement('teamname',$reg->getTeamName(),50,50); ?></td></tr>
		<tr><td class="registrationform-input">Head Coach Name:</td><td><?php echo $this->getInputElement('coachname',$reg->getName(),40,40); ?></td></tr>
		<tr><td class="registrationform-input">Address:</td><td><?php echo $this->getInputElement('address',$reg->getAddress(),40,40); ?></td></tr>		
		<tr><td class="registrationform-input">City:</td><td><?php echo $this->getInputElement('city',$reg->getCity()); ?></td></tr>		
		<tr><td class="registrationform-input">State:</td><td><?php echo $this->getInputElement('state',$reg->getState(),15,2); ?></td></tr>		
		<tr><td class="registrationform-input">Phone:</td><td><?php echo $this->getInputElement('coachphone',$reg->getPhone(),25,12); ?></td></tr>
		<tr><td class="registrationform-input">Cell Phone:</td><td><?php echo $this->getInputElement('coachcellphone',$reg->getCellPhone(),25,12); ?></td></tr>		
		<tr><td class="registrationform-input">Coach Email:</td><td><?php echo $this->getInputElement('coachemail',$reg->getEmail(),65,65); ?></td></tr>
		<tr><td class="registrationform-input">Are you planning on playing in the league tournament:</td><td><?php echo JLHtml::getYesNoSelectList('tournament',$reg->isPlayingInTournament()); ?></td></tr>
		<tr><td class="registrationform-input">Your Name (if different than coach):</td><td><?php echo $this->getInputElement('enteredby',"",40,40); ?></td></tr>
		<tr><td class="registrationform-input">Anti-spam value: [ <span id="captcha-value"></span> ]</td><td><?php echo $this->getInputElement('antispamvalue',"",10,10); ?> (Enter the value you see to the left)</td></tr>
		<tr>
			<td class="registrationform-input"></td>
			<td><br/>
				<input type="hidden" name="option" value="com_jleague"/>
				<input type="hidden" name="controller" value="registrations"/>
				<input type="hidden" name="task" value="save"/>
				<input type="hidden" name="Itemid" value="999999999"/>
				<input type="hidden" name="teamid" value="<?php echo $reg->getTeamId();?>"/>
				<input type="button" value="Save" onclick="validateForm();"/>	
			</td>
		</tr>		
									
	</table>
	
</form>
</div>

</div>
