

<div id="printroster-wrapper">

<table id="printroster-table">
	<thead>
		<tr class="printroster-header">
			<td colspan="2" style="vertical-align: top; padding-left: 15px;">
				<div id="teamprofile-info-teamname" style="font-size: 150%"><?php echo $team->getName(); ?></div>
				Coach: <?php echo $team->getCoachName(); ?><br/>
				Phone: <?php echo $team->getCoachPhone(); ?><br/>
				As of: <?php echo date('m/j/Y'); ?>
			</td>
			<td><div style="float: right;"><img src="<?php echo $_config->getProperty('logo_folder') . "thumb-" .  $team->getLogo();?>"/></div></td>			
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td colspan="4" class="centerjust" style="padding-bottom: 10px; font-size: 16px;"><strong><?php echo $season->getTitle(); ?> Roster</strong><br/> </td>
		</tr>
		<tr class="printroster-column-headers">
			<td style="padding-left: 10px; width: 45%;"><?php echo JLText::getText('JL_LASTNAME'); ?></td>
			<td><?php echo JLText::getText('JL_FIRSTNAME'); ?></td>
			<td>&nbsp;</td>
		</tr>
	</thead>
	<tbody>
	<?php
		$players = $roster->getPlayers();
		if (count($players) > 0 ) {	
				foreach ($players as $player) {
				?><tr>
					<td style="padding-left: 10px"><?php echo $player->getLastName(); ?></td>
					<td><?php echo $player->getFirstName(); ?></td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No Players on file</td></tr>
				<?php
			}		
	?>
	</tbody>

</table>

<div id="printroster-message" class="centerjust">
<br/><hr/>
<?php echo $_config->getProperty('copyright_notice'); ?>
</div>

</div>