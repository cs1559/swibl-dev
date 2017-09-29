<div id="teamprofile-recordhistory" class="jleague-section-block">
<?php 
	if (!isset($showheader)) {
		$showheader = true;
	}
	if ($showheader) { 
?>
	<div class="teamprofile-sectionheader teamprofile-sectionheader-left">
	<div class="teamprofile-sectionheader-right">
		Field Directions
	</div>
	</div>

<?php } ?>	
	<div id="teamprofile-field-detail">
	
	<?php
		if (sizeof($venues)==0) {
			echo JLText::getText('JL_NO_VENUES_DEFINED');;
		} else {		
	 ?>
			<table id="venues-table" class="width-100">
				<thead>
						<tr class="venues-header-row">
							<th class="leftjust"><?php echo JLText::getText('JL_NAME'); ?></th>
							<th class="leftjust"><?php echo JLText::getText('JL_ADDRESS'); ?></th>
							<th/>
						</tr>				
				</thead>
				<tbody>
			<?php
				foreach($venues as $venue)
				{
			?>
					<tr>
						<td class="venues-cell"><?php echo $venue->getName();?></td>
						<td class="venues-cell"><?php echo $venue->getAddress();?></td>
						<td class="venues-cell">
							<a href="javascript:void(0);" onClick="openWindow('<?php echo "http://maps.google.com/?daddr=" . $venue->getName() 
								. "@" . $venue->getLatitude() . "," . $venue->getLongitude(); ?>');">Get Directions</a>
						</td>
					</tr>
			<?php
				}
			?>
			</tbody>
		</table>
		<?php 
			}
		 ?>
	</div>		
	
</div> 