<?php

?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancelSponsor') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.sponsorname.value == '') {
			alert('Sponsor Name is required');
			form.sponsorname.focus();
			return;
		} else {
			submitform( pressbutton );
		}
	}
</script>



	<div class="col" style="width: 75%;">
	
		<form method="post" id="adminForm" name="adminForm" action="index.php">
	
		<fieldset>
		<legend>Sponsor Information</legend>
		<table class="admintable">
			<tbody>
				<tr>
					<td class="key"><?php echo JLText::getText('Id'); ?></td>
					<td><?php echo $sponsor->getId(); ?><input type="hidden" name="id" value="<?php echo $sponsor->getId(); ?>"/></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Sponsor Name'); ?></td>
					<td><input type="text" name="sponsorname" value="<?php echo $sponsor->getName(); ?>" size="50" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Contact Name'); ?></td>
					<td><input type="text" name="contactname" value="<?php echo $sponsor->getContactName(); ?>" size="50" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Contact Phone'); ?></td>
					<td><input type="text" name="contactphone" value="<?php echo $sponsor->getContactPhone(); ?>" size="20" /></td>
				</tr>
				<tr>
					<td class="key"><?php echo JLText::getText('Contact Email'); ?></td>
					<td><input type="text" name="contactemail" value="<?php echo $sponsor->getContactEmail(); ?>" size="75" /></td>
				</tr>								
			</tbody>
		</table>
		</fieldset>		
		
		<input type="hidden" name="option" value="com_jleague"/> 
		<input type="hidden" name="controller" value="sponsors"/>
		<input type="hidden" name="task" value="save"/> 
		<input type="hidden" name="boxchecked" value="0"/>

		</form>

		<fieldset>
			<legend><?php echo JLText::getText('Campaigns'); ?></legend>
			<table style="width: 100%" class="adminlist">
				<thead>
					<tr class="title">
						<th><?php echo JLText::getText('Id'); ?></th>
						<th><?php echo JLText::getText('Campaign Name'); ?></th>
						<th><?php echo JLText::getText('Click thru URL'); ?></th>
						<th><?php echo JLText::getText('Link URL'); ?></th>
						<th><?php echo JLText::getText('Clicks'); ?></th>
						<th><?php echo JLText::getText('Action'); ?></th>
					</tr>
				</thead>
			<?php 
				$campaigns = $sponsor->getCampaigns();
				foreach ($campaigns as $campaign) {
			?>
				<tr>
					<td class="key"><?php echo $campaign->getId(); ?></td>
					<td class="key"><a href="<?php echo $_view->getEditCampaignUrl($campaign); ?>"><?php echo $campaign->getName(); ?></a></td>
					<td class="key"><?php echo $campaign->getClickthru(); ?></td>
					<td class="key"><a href="<?php echo $_view->getClickThruUrl($campaign); ?>">Click Thru Link</a></td>
					<td class="key" style="text-align: center;"><?php echo $campaign->getClicks(); ?></td>
					<td class="key" style="text-align: center;"><a href="javascript:void(0);" onclick="location.href='<?php echo $_view->getDeleteCampainUrl($campaign); ?>'">Delete</a></td>		
				</tr>				
			<?php
				}
			 ?>
			</table>
		</fieldset>
		
		
	</div>

<!-- 	
	<div class='col width-55'>
	</div>
 -->


