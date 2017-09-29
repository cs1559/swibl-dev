<?php
?>

<h1>SWIBL Frontpage</h1>

<div class="row">


<div class="col-md-6">
<h3>Bulletins</h3>
<table class="swibl-table-max table-striped table-responsive">
			<thead>
				<tr>
					<th>Title</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($bulletins) > 0 ) {	
				foreach ($bulletins as $bulletin) {
				?><tr>
					<td>
							<a class="bulletin-toggle" key="tp-collapse<?php echo $bulletin->getId(); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a> 
							<span class="bulletin-title"><?php echo $bulletin->getTitle(); ?></span>
							<div id="tp-collapse<?php echo $bulletin->getId(); ?>" class="bulletin-desc" style="display:none">
								<p><?php echo nl2br($bulletin->getDescription()); ?></p>
							</div>
					</td>
					<td class="vtop" ><?php echo $bulletin->getCreateDate(); ?></td>
				  </tr>
				<?php
				}
			} else {
				?>
				<tr><td colspan="6">No bulletins on file</td></tr>
				<?php
			}
			?>			
			</tbody>

			</table>
</div>


</div>    