	
	<div id="standings-body">
		<span id="standings-league-description">Look Who's Coming - <?php echo $season->getDescription(); ?></span>
		<br/>
		<span class="system_message"><?php echo $season_note; ?></span>
		<br/><br/>

		The following teams have REGISTERED to participate in SWIBL during the <?php echo $season->getTitle(); ?> season.  Once all registrations have been 
		processed and the divisions been set, this page will be updated with the most recent information.
		<br/><br/>
		<table id="standings-table">
		<?php 
			$X = 0;
			$i		= 0;
			$prevage = 0;
			$prevdiv = null;
			$isfirstdiv = false;
			foreach($registrations as $obj)
			{
				if ($x % 2) {
					$rowclass = "game-table-row-even";
				} else {
					$rowclass = "game-table-row-odd";
				}
				$x  += 1;				
				if ($obj->getAgeGroup() != $prevage) {
					?>
					<tr class="standings-table-division-header-row"><td  class="standings-table-division-header" colspan=4><?php echo $obj->getAgeGroup() . "U Age Group";?></td></tr>
					<tr class="standings-table-division-subheader-row">
						<td><?php echo JLText::getText('JL_TEAM'); ?></td>
						<td><?php echo JLText::getText('Contact Name'); ?></td>
						<td><?php echo JLText::getText('City/St'); ?></td>
						<td><?php echo JLText::getText('Division'); ?></td>
					</tr>			
					
					<?php
					$isfirstdiv = true;
					$prevage = $obj->getAgeGroup();
					$i = 0;
				}
				if ($obj->getDivisionName() != $prevdiv)  {
					if (!$isfirstdiv) {
					?>
					<tr><td colspan=5><hr/></td></tr>
					<?php 
					}
					$isfirstdiv = false;
					$prevdiv = $obj->getDivisionName();
				}
				if ($obj->getTeamId() > 0) {
					$tname = $obj->getTeamName();
				} else {
					$tname = $obj->getTeamName() . " (NEW) ";
				}
		?>
				<tr class="<?php echo $rowclass; ?>">
					<td><?php echo $tname; ?></td>
					<td><?php echo $obj->getName(); ?></td>
					<td><?php echo $obj->getCity() . "," . $obj->getState(); ?></td>
					<td><?php echo $obj->getDivisionName(); ?></td>					
				</tr>
				
		<?php
			}
		?>
		</table>
	
	</div>