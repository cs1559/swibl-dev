<div id="teamprofile-recordhistory" class="jleague-section-block">
<?php 
	if (!isset($showheader)) {
		$showheader = true;
	}
	if ($showheader) { 
?>
	<div class="teamprofile-sectionheader teamprofile-sectionheader-left">
	<div class="teamprofile-sectionheader-right">
		Record History
	</div>
	</div>
	
<?php } ?>

	<div id="teamprofile-recordhistory-detail">
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
	</div>	
</div> 