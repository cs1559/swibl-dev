<div>

<script type="text/javascript">
//<![CDATA[
	var randomnumber = Math.floor(Math.random()*1000);
		
	function updateCaptcha() {
		document.getElementById("captcha-value").innerText=randomnumber;
		document.getElementById("captcha-value").innerHTML=randomnumber;
	}
			
	function validateForm() {
	
		var form = document.registrationform;
		
		ageIdx = form.agegroup.selectedIndex;
		agegroup = form.agegroup.options[ageIdx].value;
		
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
//]]>	
</script>

<div>

<form name="registrationform" method="post" action="index.php">

	<table class="registrationform-table">
		<tr><td>IP Address:</td><td><?php echo $_SERVER['REMOTE_ADDR'];?></td></tr>
		<tr><td class="registrationform-input width-30">Team Id:</td><td><?php echo $_view->getTeamIdValue($reg); ?></td></tr>
		<tr><td class="registrationform-input">Select Age Group you plan to play in:</td>
			<td>
				<?php 
					echo mHtmlHelper::getAgeGroupSelectList("agegroup", $reg->getAgeGroup());
				 	//echo JLHtml::getAgeGroupSelectList('agegroup',$reg->getAgeGroup(),''); 
				 ?> 
			</td>
		</tr>
		<tr>
			<td class="registrationform-input">Select Division Classification:</td>
			<td><?php echo mHtmlHelper::getDivisionClassList('divisionclass',''); ?> </td>
		</tr>
			<tr><td class="registrationform-input width-30">Team Name:</td><td><?php echo mHtmlHelper::getInputElement('teamname',$reg->getTeamName(),50,50); ?></td></tr>
			<tr><td class="registrationform-input">Head Coach Name:</td><td><?php echo mHtmlHelper::getInputElement('coachname',$reg->getName(),40,40); ?></td></tr>
			<tr><td class="registrationform-input">Address:</td><td><?php echo mHtmlHelper::getInputElement('address',$reg->getAddress(),40,40); ?></td></tr>		
			<tr><td class="registrationform-input">City:</td><td><?php echo mHtmlHelper::getInputElement('city',$reg->getCity()); ?></td></tr>		
			<tr><td class="registrationform-input">State:</td><td><?php echo mHtmlHelper::getInputElement('state',$reg->getState(),15,2); ?></td></tr>		
			<tr><td class="registrationform-input">Phone:</td><td><?php echo mHtmlHelper::getInputElement('coachphone',$reg->getPhone(),25,12); ?></td></tr>
			<tr><td class="registrationform-input">Cell Phone:</td><td><?php echo mHtmlHelper::getInputElement('coachcellphone',$reg->getCellPhone(),25,12); ?></td></tr>		
			<tr><td class="registrationform-input">Coach Email:</td><td><?php echo mHtmlHelper::getInputElement('coachemail',$reg->getEmail(),65,65); ?></td></tr>
					<tr>
			<td class="registrationform-input">Are you planning on playing in the league tournament:</td>
			<td><?php echo mHtmlHelper::getYesNoSelectList('tournament',$reg->isPlayingInTournament()); ?> </td>
		</tr>
		<tr><td class="registrationform-input">Your Name (if different than coach):</td><td><?php echo mHtmlHelper::getInputElement('enteredby',"",40,40); ?></td></tr>
		<tr><td class="registrationform-input">Anti-spam value: [ <span id="captcha-value"></span> ]</td><td><?php echo mHtmlHelper::getInputElement('antispamvalue',"",10,10); ?> (Enter the value you see to the left)</td></tr>
		<tr>
			<td class="registrationform-input"></td>
			<td><br/>
				<input type="hidden" name="option" value="com_jleague"/>
				<input type="hidden" name="controller" value="registrations"/>
				<input type="hidden" name="seasonid" value="<?php echo $seasonid; ?>"/>		
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

<script type="text/javascript">
//<![CDATA[
	updateCaptcha();
//]]>	
</script>
