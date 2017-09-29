<script type="text/javascript">
	var $j = jfst.noConflict();

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


<form method="post" name="adminForm" action="index2.php">

<div class="col width-55"> 
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
				<tr>
					<td class="key"><?php echo JLText::getText('JL_DIVISION'); ?>:</td>
					<td><?php echo JLHtml::getDivisionSelectList('divisionid',$registration->getDivisionId(),$season->getId(),true);?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Published'); ?>:</td>
					<td><?php echo JLHtml::getPublishedSelectList("published",$registration->getPublished());?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Paid'); ?>:</td>
					<td><?php echo JLHtml::getPublishedSelectList("published",$registration->isPaid());?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Registered By'); ?>:</td>
					<td><?php echo $registration->getRegisteredBy();?></td>
				</tr>												
				<tr>
					<td class="key"><?php echo JLText::getText('Registration Date'); ?>:</td>
					<td><?php echo $registration->getRegistrationDate();?></td>
				</tr>												

			</tbody>
		</table>	
		</fieldset>
</div>

<div class="col width-45"> 
		<fieldset>
		<legend>Previous League Teams</legend>
			<div id="available-teams" style="height: 300px;overflow-x: hidden; overflow-y: scroll; position: relative;">
				<?php 
				
					foreach($teams as $team)
					{	
				?>	<div style="background-color:#EEEEEE;border:thin solid black;margin:2px;padding-bottom:3px;padding-left:5px;padding-top:3px;"> 
					<table>
						<tr><td><a href="javascript:updateFields(<?php echo $team->getId() . ',\'' . $team->getName() . '\',\'' . $team->getCity() . '\',\'' . $team->getState() . '\''; ?>);">Select</a></td><td>
				<?php
						echo "<strong>" . $team->getName() . "</strong><br/>";
						echo "Age Group: " . $team->getAgeGroup() . " Season: " . $team->getLastSeason() . " Coach: " . $team->getCoachName();
				?>  
						</td></tr>
					</table>
					</div> <?php
					}
				?>
			</div>
		</fieldset>
</div>
		<input type="hidden" name="id" value="<?php echo $registration->getId(); ?>"/>
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="registrations"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>



</form>
