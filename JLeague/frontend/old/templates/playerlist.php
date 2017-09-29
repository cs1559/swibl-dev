<script type="text/javascript">
var t = new ScrollableTable(document.getElementById('player-selectlist-table'),300,475);
</script>
	<style>
		#player-selectlist-table table {
			text-align: left;
			font-size: 12px;
			font-family: verdana;
			background: #c0c0c0;
			border: 1px solid #000000;
			margin-left: 5px;
		}
 
		#player-selectlist-table thead  {
			cursor: pointer;
		}
 
		#player-selectlist-table thead tr,
		#player-selectlist-table tfoot tr {
			background: #c0c0c0;
		}
 
		#player-selectlist-table tbody tr {

		}
 
		#player-selectlist-table td, th {
			border: 0px solid white;
		}
		.player-table-row-even {
			background-color: #f6f6f6 !important;
		}
		.player-table-row-odd {
			background-color: #ffffff !important;
		}
	</style>


	<div id="teamprofile-playerlist">
			<table id="player-selectlist-table">
				<thead>
						<tr class="table-header-row">
							<th class="table-cell-header"><?php echo JLText::getText('Sel'); ?></th>						
							<th class="table-cell-header"><?php echo JLText::getText('JL_ID'); ?></th>
							<th class="table-cell-header"><?php echo JLText::getText('JL_NAME'); ?></th>
							<!--   <th class="table-cell-header"><?php echo JLText::getText('JL_BIRTHDAY'); ?></th>-->
							<th class="table-cell-header"><?php echo JLText::getText('JL_HOMETOWN'); ?></th>
						</tr>				
				</thead>
				<tbody>
			<?php
				$x = 0;
				foreach($players as $player)
				{
					if ($x % 2) {
						$rowclass = "player-table-row-even";
					} else {
						$rowclass = "player-table-row-odd";
					}
					$x = $x + 1;			
			?>
					<tr class="<?php echo $rowclass; ?>">
						<td class="table-cell" style="text-align: center"><a href="javascript:void(0);" onClick="addPlayerToRoster(<?php echo $player->getId();?>,'<?php echo $player->getFirstName() . " " . $player->getLastName();?>');">Add</a></td>					
						<td class="table-cell"><?php echo $player->getId();?></td>				
						<td class="table-cell"><?php echo $player->getLastName() . ", " . $player->getFirstName();?></td>										
						<!--  <td class="table-cell"><?php echo $player->getDateOfBirth();?></td> -->
						<td class="table-cell"><?php echo $player->getCity() . ", " . $player->getState();?></td>
					</tr>
		<?php
				}
		?>
			</tbody>
		</table>
	
	
	</div>	


