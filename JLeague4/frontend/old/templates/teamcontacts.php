<style type="text/css">
@media print {
	input#btnPrint {
		display: none;
	}
}
</style>

<?php 

if (isset($_REQUEST["format"])) {
	if ($_REQUEST["format"] == "raw") {
 ?>
 
<SCRIPT LANGUAGE="JavaScript"> 
// This script was supplied free by Hypergurl 
// http://www.hypergurl.com <!-- 
	if (window.print) { 
		document.write('<form>' + '<input id="btnPrint" type=button name=print value="Print this page" ' + 'onClick="javascript:window.print()"> </form>'); 
	} 
// End hide --> 
</script>
<?php
	}
} else {
?>
	<p>
	<a href="javascript:void(0);" title="Create Printer Friendly Version" onClick="openWindow('<?php echo JRoute::_('index.php?option=com_jleague&controller=teams&task=getteamcontactlist&format=raw'); ?>');">Create Printer Friendly Version</a>
	</p>
<?php	
}
?>

<div class="jleague-title">
	<h2><?php echo $season->getTitle(); ?> SWIBL Team Contacts</h2>
</div>
<p>	NOTE:  The contact list is limited to only those teams that play within the same age group as your team(s).  If additional contact
	information is needed, please contact the League Commissioner.</p>
<br/>
	<table id="team-contact-list">
		<tbody>
			<tr>
				<th class="contact-list-header"><?php echo JLText::getText('JL_TEAM'); ?></th>
				<th class="contact-list-header"><?php echo JLText::getText('JL_COACH'); ?></th>
				<th class="contact-list-header"><?php echo JLText::getText('JL_PHONE'); ?></th>
				<th class="contact-list-header"><?php echo JLText::getText('JL_EMAIL'); ?></th>
				<th class="contact-list-header"><?php echo JLText::getText('JL_DIVISION'); ?></th>				
			</tr>
	
<?php
	foreach ($teams as $team) {
?>	
		<tr>
			<td><?php echo $team->getName(); ?></td>
			<td><?php echo $team->getCoachName(); ?></td>
			<td><?php echo $team->getCoachPhone(); ?></td>
			<td><?php echo JLApplication::cloakEmail($team->getCoachEmail()); ?></td>
			<td><?php echo $team->getDivision()->getName(); ?></td>			
		</tr>			
<?php		
	}
?>
		</tbody>
	</table>	

<div id="printroster-message" class="centerjust">
<br/><hr/>
<?php echo $_config->getProperty('copyright_notice'); ?>
</div>
