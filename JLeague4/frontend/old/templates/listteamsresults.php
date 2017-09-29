
<div class="jleague-title">
	<h2><?php echo $season->getTitle(); ?> League Teams</h2>
</div>
<br/>	
	<?php foreach($teams as $team)
		{	?>
		<div class="teamlist-row">
			<table id="teamlist-table">
			<thead>
			</thead>
			<tbody>
			<tr>
				<td class="teamlist-col1 teamlist-logo"><div id="teamprofile-abbr-logo"><img src="<?php echo $_config->getProperty('logo_folder') . "thumb-" . $team->getLogo();?>"/></div></td>
				<td class="teamlist-col2 teamlist-column left-pad10">
			<a class="team-popup" rel="<?php echo $team->getId();?>" href="javascript:void(0);" onClick="callPopup(<?php echo $team->getId();?>);">
						<span class="teamlist-teamname"><?php echo $team->getName();?></span>
					</a>
					<br/>
					<strong><?php echo $team->getDivision()->getName(); ?></strong><br/>
					<?php echo $team->getCity() . " " . $team->getState(); ?><br/>
				</td>
				<td class="teamlist-col3" >
					<strong><?php echo $team->getCoachName(); ?></strong><br/>
					<?php echo $team->getCoachPhone(); ?><br/>
					
				</td>
				<td class="teamlist-col4">
					<?php echo $team->getFieldValue("FLD_CLASSIFICATION") ; ?>
				</td>				
				<td class="teamlist-col4">
					<a href="javascript:void(0);" title="View USSSA Page" onclick="openWindow('<?php echo $_config->getProperty('sanctioning_body_team_url') . $team->getFieldValue("FLD_USSSA_NUMBER");  ?>');">
					<?php echo $team->getFieldValue("FLD_USSSA_NUMBER"); ?>
					</a>
				</td>
				<td class="teamlist-col5" >
					<?php
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=' .$team->getSlug() . "&Itemid=9999999" );
					?>
					<a href="<?php echo $link; ?>">View Profile 	</a>
				</td>
			</tr>
			</tbody>
			</table>
		</div>
		<?php
		}
	?>
<br/>
<?php echo $totalteams; ?> teams listed ...

