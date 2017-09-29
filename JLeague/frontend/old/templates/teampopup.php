
<div id="teamprofile-header" class="jleague-section-block">
	<div id="teamprofile-logo">
		<img src="<?php echo $_config->getProperty('logo_folder') . $team->getLogo();?>"/>
	</div>
	
	<div id="teamprofile-info">
		<div id="teamprofile-info-teamname"><?php echo $team->getName(); ?></div>
		<div id="teamprofile-info-about">
				<table>
				<tbody>
				<tr>
					<td><strong>Coach:</strong></td>
					<td><?php echo $team->getCoachName(); ?></td>
				</tr>
				<tr>
					<td><strong>Coach Phone:</strong></td>
					<td><?php echo $team->getCoachPhone(); ?></td>
				</tr>
				<tr>
					<td><strong>Years in League:</strong></td>
					<td><?php echo $yearsinleague; ?></td>
				</tr>
				<tr>
					<td><strong><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></strong></td>
					<td><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
				</tr>			
				<tr>
					<td><strong>SWIBL ID:</strong></td>
					<td><?php echo $team->getId(); ?></td>
				</tr>			
				<tr>
					<td><strong><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></strong></td>
					<td><?php echo $team->getFieldValue("FLD_USSSA_NUMBER"); ?></td>
				</tr>	
				</tbody>		
				</table>
		</div>
	</div>
</div>
			<h3>Record History</h3>
			<table id="recordhistory-table">
				<thead>
						<tr class="recordhistory-header-row">
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_SEASON'); ?></th>
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_DIVISION'); ?></th>
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_WINS'); ?></th>
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_LOSSES'); ?></th>
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_TIES'); ?></th>
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_RUNSSCORED'); ?></th>
							<th class="recordhistory-cell-header"><?php echo JLText::getText('JL_RUNSALLOWED'); ?></th>
						</tr>				
				</thead>
				<tbody>
			<?php
				foreach($recordhistory as $obj)
				{
			?>
					<tr>
						<td class="recordhistory-cell-center"><?php echo $obj->getSeason();?></td>
						<td class="recordhistory-cell"><?php echo $obj->getDivisionName();?></td>
						<td class="recordhistory-cell-center"><?php echo $obj->getWins();?></td>
						<td class="recordhistory-cell-center"><?php echo $obj->getLosses();?></td>
						<td class="recordhistory-cell-center"><?php echo $obj->getTies();?></td>
						<td class="recordhistory-cell-center"><?php echo $obj->getRunsScored();?></td>
						<td class="recordhistory-cell-center"><?php echo $obj->getRunsAllowed();?></td>
					</tr>
		<?php
				}
		?>
			</tbody>
		</table>				
 
<hr>
<a href="javascript:closePopup();" class="jqmClose">Close</a>
<?php
	$link		= JRoute::_( 'index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=' .$team->getSlug() . "&Itemid=9999999" );
?>
| <a href="<?php echo $link; ?>">View Profile</a>
