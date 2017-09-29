<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelTournament') {
			submitform( pressbutton );
			return;
		}
		
		// Validate that the start date is valid
		if (isDate(form.start_date.value)==false){
			form.start_date.focus();
			return false;
		}	
			
		// do field validation
		if (form.start_date.value == '') {
			alert('A START DATE is required');
			form.start_date.focus();
			return;
		}

		// Validate that the start date is valid
		if (isDate(form.end_date.value)==false){
			form.end_date.focus();
			return false;
		}	
		if (form.end_date.value == '') {
			alert('An END DATE is required');
			form.start_date.focus();
			return;
		}				
		if (form.contact_name.value == '') {
			alert('A CONTACT NAME is required');
			form.start_date.focus();
			return;
		}		
		if (!isNumeric(form.cost.value)) {
			alert('COST needs to be numeric');
			form.cost.focus();
			return;
		}
		if (form.name.value == '') {
			alert('TOURNAMENT NAME is required');
			form.name.focus();
			return;
		} else {
			submitform( pressbutton );
		}
	}
</script>

<form method="post" id="adminForm" name="adminForm" action="index.php">

	<div class="col width-55">
		<fieldset>
		<legend>Tournament Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JText::_('Id'); ?></td>
					<td><?php echo $tournament->getId(); ?><input type="hidden" name="id" value="<?php echo $tournament->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Tournament Name'); ?></td>
					<td><?php echo JTHtml::getInputElement('name',$tournament->getName(),50,50); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Event Type'); ?></td>
					<td><?php echo JTHtml::getEventType('event_type',$tournament->getType(),"onChange='alert(\"Function Not Implemented\");'"); ?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Product'); ?></td>
					<td><?php echo JTHtml::getProductList('producttype',$tournament->getProductType()); ?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Description'); ?></td>
					<td><?php echo JTHtml::getTextAreaElement('description',$tournament->getDescription(),5,50); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Start Date'); ?></td>
					<td><?php echo JTHtml::getInputElement('start_date',$tournament->getStartDate(),20); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('End Date'); ?></td>
					<td><?php echo JTHtml::getInputElement('end_date',$tournament->getEndDate(),20); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Contact Name'); ?></td>
					<td><?php echo JTHtml::getInputElement('contact_name',$tournament->getContactName(),30); ?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Contact Email'); ?></td>
					<td><?php echo JTHtml::getInputElement('contact_email',$tournament->getContactEmail(),70); ?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Contact Phone'); ?></td>
					<td><?php echo JTHtml::getInputElement('contact_phone',$tournament->getContactPhone(),20); ?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Cost'); ?></td>
					<td><?php echo JTHtml::getInputElement('cost',$tournament->getCost(),10);?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Published'); ?></td>
					<td><?php echo JTHtml::getPublishedSelectList('published',$tournament->getPublished()); ?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Hits'); ?></td>
					<td><?php echo $tournament->getHits(); ?></td>
				</tr>																			
			</tbody>
		</table>
		</fieldset>		
		
		<fieldset>
			<legend><?php echo JText::_('Attachments');  ?></legend>
<div>
<!-- 
	<form id="uploadForm" enctype="multipart/form-data" method="post" action="index.php">
	<input id="file-upload" class="inputbox button" size="100" type="file" style="color: rgb(102, 102, 102);" name="Filedata"/>
	<input id="file-upload-submit" class="button" type="submit" value="Upload" size="30"/>
	<input type="hidden" value="executeUploadFile" name="task"/>
	<input type="hidden" value="teams" name="controller"/>
	<input type="hidden" name="option" value="com_jtourney"/>
	<input type="hidden" name="eventid" value="<?php echo $tournament->getId(); ?>"/>
	</form>
	
	-->
</div>			
			<?php 
				$_view->listAttachments($tournament->getId());
			?>
			<table style="width: 100%"  class="admintable">		
			</table>
		</fieldset>
		
		<input type="hidden" name="option" value="com_jtourney"/> 
		<input type="hidden" name="controller" value="tournaments"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>
		
	</div>
	
	<div class='col width-45'>
		<fieldset>
			<legend><?php echo JText::_('Location Information');  ?></legend>
			<table style="width: 100%"  class="admintable">			
				<tr>
					<td class="key"><?php echo JText::_('Location Address'); ?></td>
					<td><?php echo JTHtml::getInputElement('location_address',$tournament->getLocationAddress(),50);?></td>
				</tr>
				<tr>
					<td class="key"><?php echo JText::_('Location City'); ?></td>
					<td><?php echo JTHtml::getInputElement('location_city',$tournament->getLocationCity(),30);?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Location State'); ?></td>
					<td><?php echo JTHtml::getInputElement('location_state',$tournament->getLocationState(),2);?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Location Zipcode'); ?></td>
					<td><?php echo JTHtml::getInputElement('location_zipcode',$tournament->getLocationZipcode(),10);?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Latitude'); ?></td>
					<td><?php echo JTHtml::getInputElement('latitude',$tournament->getLatitude(),30);?></td>
				</tr>				
				<tr>
					<td class="key"><?php echo JText::_('Longitude'); ?></td>
					<td><?php echo JTHtml::getInputElement('longitude',$tournament->getLongitude(),30);?></td>
				</tr>				
			</table>
		</fieldset>
		<fieldset>
			<legend><?php echo JText::_('Custom Properties'); ?></legend>
			<div id="tournament-customproperties">
			<table style="width: 100%"  class="admintable">
				<?php
					$fields = $tournament->getCustomFields();
					foreach ($fields as $field) {
				?>
				<tr>
					<td class="key"><?php echo $field->getLabel(); ?></td>
					
					<td><?php 
					echo $this->renderField($field); ?></td>
				</tr> 
				<?php
					}
				?>				
			</table>
			</div>
		</fieldset>
		
		<!-- 
		<fieldset>
			<legend><?php echo JText::_('Feature Set'); ?></legend>
			<?php
				$features = $tournament->getProduct()->getFeatures();
				foreach ($features as $feature) {
					echo "Feature: " . $feature->getName();
				}
			?>
		</fieldset>
		 -->		
	</div>
</form>


