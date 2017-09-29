
<div id="teamprofile-gamehistory"  class="jleague-section-block">

<?php 
	if (!isset($showheader)) {
		$showheader = true;
	}
	if ($showheader) { 
?>
	<div class="teamprofile-sectionheader teamprofile-sectionheader-left">
	<div class="teamprofile-sectionheader-right">
		Game History
	</div>
	</div>
<?php } ?>
	<table class="jleague-filter-table">
		<tbody>
			<tr>
				<td><strong>NOTE: Change the season in the select list to see past history game information.</strong></td>
				<td>
					<?php  echo JLText::getText( 'Season'); ?>
					<?php  echo JLHtml::getSeasonSelectList('filter_season',$mostrecentseason->getId(),true,'onchange="getGameHistory(' . $team->getId() . ',this.value);"'); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<br/>
<?php
	echo $gamehistorytablehtml;
?>
</div>
