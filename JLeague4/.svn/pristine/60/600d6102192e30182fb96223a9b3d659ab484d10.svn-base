<script type="text/javascript">

	jfst(function() {
		jfst("#tabs").tabs();
	});

 
 	function updateFields(id,teamname,city,state) {
 		document.getElementById("teamid-div").innerHTML = id;
 		document.adminForm.teamid.value = id;
 		document.adminForm.teamname.value = teamname;
 		document.adminForm.city.value = city;
 		document.adminForm.state.value = state;
 		document.adminForm.returning_team.options[1].selected = true;
 		
	}

	function submitbutton(pressbutton) {
	
		var form = document.adminForm;
		if (pressbutton == 'cancelRegistration') {
			submitform( pressbutton );
			return;
		}
		if (form.seasonid.value == 0) {
			alert('A Season must be specified');
			return;
		}		
		
		selIdx = form.returning_team.selectedIndex;
		retteam = form.returning_team.options[selIdx].value;
				
		if (form.teamid.value == 0 && retteam == 1) {
			alert('No existing team selected and you stated the team is a RETURNING team');
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
//	height: 300px;
//	width: 350px;
}
.width-75 {
width: 75%;
}
</style>


<form method="post" id="adminForm" name="adminForm" action="index.php">

<ul class="nav nav-tabs" id="myTabTabs">
	<li class=""><a href="#registration" data-toggle="tab">Team Registration</a></li>
	<li class=""><a href="#attributes" data-toggle="tab">Other Attributes</a></li>
</ul>

<div class="tab-content" id="myTabContent">

	<div id="registration" class="tab-pane active">
		<div class="span8"> 
				<fieldset>
				<legend>Team Registration Information</legend>
				<table  class="admintable"  width="100%">
					<tbody>
						<tr>
							<td class="key"><?php echo JLText::getText('Team Id'); ?>:</td>
							<td><div id="teamid-div"><?php echo $registration->getTeamId(); ?></div>
								<input type="hidden" name="teamid" value="<?php echo $registration->getTeamId(); ?>"/>
							</td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Season'); ?>:</td>
							<td><?php echo JLHtml::getRegistrationOpenSeasonList("seasonid",$registration->getSeasonId()); ?></td>
						</tr>			
						<tr>
							<td class="key"><?php echo JLText::getText('Returning Team'); ?>:</td>
							<td><?php JLHtml::getYesNoSelectList("returning_team",$registration->getExistingTeam()); ?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Team Name'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("teamname",$registration->getTeamName(),50,40); ?></td>
						</tr>								
						<tr>
							<td class="key"><?php echo JLText::getText('City'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("city",$registration->getCity(),30,30); ?></td>
						</tr>	
						<tr>
							<td class="key"><?php echo JLText::getText('State'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("state",$registration->getState(),5,2); ?></td>
						</tr>									
						<tr>
							<td class="key"><?php echo JLText::getText('Age Group'); ?>:</td>
							<td><?php echo JLHtml::getAgeGroupSelectList("agegroup",$registration->getAgeGroup()); ?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Contact Name'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("contactname",$registration->getName(),50,40); ?></td>
						</tr>					
						<tr>
							<td class="key"><?php echo JLText::getText('Contact Phone'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("contactphone",$registration->getPhone(),20,15); ?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Contact Cell Phone'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("contactcellphone",$registration->getCellPhone(),20,15); ?></td>
						</tr>				
						<tr>
							<td class="key"><?php echo JLText::getText('Contact Email'); ?>:</td>
							<td><?php echo JLHtml::getInputElement("contactemail",$registration->getEmail(),100,40); ?></td>
						</tr>															
		
					</tbody>
				</table>	
				</fieldset>
		</div>
	</div>

	<div id="attributes" class="tab-pane">
		<div class="span8"> 
				<fieldset>
				<legend>Other Information/Attributes</legend>
						<table  class="admintable"  width="100%">
						<tr>
							<td class="key"><?php echo JLText::getText('COM_JLEAGUE_ASSIGNED_DIVISION'); ?>:</td>
							<td><?php echo JLHtml::getDivisionSelectList('divisionid',$registration->getDivisionId(),$season->getId(),true);?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Published'); ?>:</td>
							<td><?php echo JLHtml::getPublishedSelectList("published",$registration->getPublished());?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Confirmed'); ?>:</td>
							<td><?php echo JLHtml::getYesNoSelectList("confirmed",$registration->isConfirmed());?></td>
						</tr>												
						<tr>
							<td class="key"><?php echo JLText::getText('Paid'); ?>:</td>
							<td><?php echo JLHtml::getPublishedSelectList("paid",$registration->isPaid());?></td>
						</tr>
						<tr>
							<td class="key"><?php echo JLText::getText('Playing in Tournament'); ?>:</td>
							<td><?php echo JLHtml::getYesNoSelectList("tournament",$registration->isPlayingInTournament());?></td>
						</tr>												
					
						<tr>
							<td class="key"><?php echo JLText::getText('Registered By'); ?>:</td>
							<td><?php echo $registration->getRegisteredBy();?></td>
						</tr>												
						<tr>
							<td class="key"><?php echo JLText::getText('Registration Date'); ?>:</td>
							<td><?php echo $registration->getRegistrationDate();?></td>
						</tr>	
						<tr>
							<td class="key"><?php echo JLText::getText('Requested Division'); ?>:</td>
							<td><?php echo JLHtml::getDivisionClassList("divclass",$registration->getDivisionClass());?></td>
						</tr>																
						<tr>
							<td class="key"><?php echo JLText::getText('Confirmation #'); ?>:</td>
							<td><?php echo $registration->getConfirmationNumber();?></td>
						</tr>												
				
						</table>
				</fieldset>
		</div>
	</div>
	
</div>


		<input type="hidden" name="id" value="<?php echo $registration->getId(); ?>"/>
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="registrations"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>



</form>
