
<script type="text/javascript" language="javascript">
jfst(document).ready(function() {
	initSubscribeNotificationForm();
});
</script>

<div id="subscribe-notification-dialog" title="Subscribe to Event Notification">

	<form id="subscribe-notification-form" name="subscribeform" method="post" action="index.php">
	<table>
		<tr>
			<td class="key width-25"><?php echo JLText::getText('Event'); ?>:</td>
			<td><?php //echo $helper->getDivisionName(); ?></td>
		</tr>						
		<tr>
			<td class="key width-25"><?php echo JLText::getText('Notification Type'); ?>:</td>
			<TD><?php //echo $helper->getConferenceGame(); ?> </TD>
		</tr>							
		<tr>
			<td class="key width-25"><?php echo JLText::getText('Send To:'); ?>:</td>
			<td><input type="text" name="sendto" value="<?php //echo $game->getGameDate(); ?>" size="20"/> </td>
		</tr>			
		<tr>
			<td class="key"><?php echo JLText::getText('Terms and Conditions'); ?>:</td>
			<td>
				<ol>
					<li>You agree that the information provide has been verified and accurate.</li>
					<li>You understand and agree to pay for all/any charges applied by your carrier as a result of any SMS messages generated from this subscription.</li>
					<li>SWIBL will remove this subscription after each season and you will be required to re-subscribe</li>
					<li>SWIBL will not use this information for purposes other than distribution of the event information you are subscribing to</li>
					<li>See the SWIBL websits terms and conditions for further information</li>
				</ol>
			</td>
		</tr>
		<tr>
			<td class="key width-25"><?php echo JLText::getText('Accept T&Cs'); ?>:</td>
			<td><input type="checkbox" name="acceptterms" value="<?php //echo $game->getGameDate(); ?>" /></td>
		</tr>			
		
	</table>
	
	<br/>
	<input type="button" value="Save" onclick="addGame(document.scheduledgameform);"/>				
	<input type="hidden" name="option" value="com_jleague"/>
	<input type="hidden" name="controller" value="ajax"/>
	<input type="hidden" id="gamestatus" name="gamestatus" value="S"/>				
	<input type="hidden" name="season_id" value="<?php //echo $season->getId(); ?>"/>
	<input type="hidden" name="task" value="doScheduleGame"/>
	<input type="hidden" name="teamid" value="<?php //echo $team->getId();?>"/>
</form>

	
</div>
