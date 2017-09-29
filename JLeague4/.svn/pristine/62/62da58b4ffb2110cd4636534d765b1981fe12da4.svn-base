<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelCampaign') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.campaignname.value == '') {
			alert('Campaign Name is required');
			form.campaignname.focus();
			return;
		} else {
			submitform( pressbutton );
		}
	}
</script>



	<div class="col" style="width: 75%;">
	
		<form method="post" id="adminForm" name="adminForm" action="index.php">
	
		<fieldset>
		<legend>Campaign Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('Id'); ?></td>
					<td><?php echo $campaign->getId(); ?><input type="hidden" name="id" value="<?php echo $campaign->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Campaign Name'); ?></td>
					<td><input type="text" name="campaignname" value="<?php echo $campaign->getName(); ?>" size="50" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Notes'); ?></td>
				<td colspan="5"><textarea name="notes" rows="10" cols="60"><?php echo $campaign->getNotes(); ?></textarea></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Start Date'); ?></td>
					<td><input type="text" name="startdate" value="<?php echo $campaign->getStartDate(); ?>" size="20" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('End Date'); ?></td>
					<td><input type="text" name="enddate" value="<?php echo $campaign->getEndDate(); ?>" size="20" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Click Thru URL'); ?></td>
					<td><input type="text" name="clickthru" value="<?php echo $campaign->getClickThru(); ?>" size="100" /></td>
				</tr>					
				<tr>
					<td class="key"><?php echo JLText::getText('Clicks'); ?></td>
					<td><?php echo $campaign->getClicks(); ?></td>
				</tr>							
											
				<tr>
					<td class="key"><?php echo JLText::getText('Published'); ?></td>
					<td><?php echo JLHtml::getPublishedSelectList('published',$campaign->getPublished()); ?></td>
				</tr>					
			</tbody>
		</table>
		</fieldset>		
		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="sponsors"/>
		<input type="hidden" name="sponsorid" value="<?php echo $campaign->getSponsorId(); ?>"/>
		<input type="hidden" name="task" value="saveCampaign"/> 

		</form>

	</div>

<!-- 	
	<div class='col width-55'>
	</div>
 -->


