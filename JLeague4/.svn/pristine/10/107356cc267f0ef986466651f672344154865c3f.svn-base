  
<p>
<strong>NOTE:</strong> The "Get Directions" function uses Google Maps to locate the field.  It will not be completely accurate as it computes the
destination based on street address.  Always discuss directions with your coach.
</p>

<table class="swibl-table-max table table-responsive">
			<thead>
				<tr>
					<th>Field/Venue Name</th>
					<th>Address</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($venues) > 0 ) {	
				foreach ($venues as $venue) {
				?><tr>
					<td><?php echo $venue->getName();?></td>
					<td><?php echo $venue->getAddress();?></td>
					<td>
						<a href="javascript:void(0);" onClick="openWindow('<?php echo "http://maps.google.com/?daddr=" . $venue->getName() 
							. "@" . $venue->getLatitude() . "," . $venue->getLongitude(); ?>');">Get Directions</a>
					</td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No fields/venues defined for this team</td></tr>
				<?php
			}
			?>			
			</tbody>
</table>
