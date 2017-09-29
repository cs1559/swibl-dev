
<div class="">
<table class="swibl-table-max table-striped table-responsive">
			<thead>
				<tr>
					<th>Title</th>
					<th class="hidden-xs hidden-phone">Date</th>
					<th class="hidden-xs hidden-sm hidden-tablet hidden-phone">Type</th>
					<th class="hidden-xs hidden-sm hidden-tablet hidden-phone">Created By</th>
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($bulletins) > 0 ) {	
				foreach ($bulletins as $bulletin) {
				?><tr>
					
					<td style="width: 70%;" class="">
						<a class="bulletin-toggle" key="tp-collapse<?php echo $bulletin->getId(); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a> 
						<span class="bulletin-title"><?php echo $bulletin->getTitle(); ?></span>
						<div id="tp-collapse<?php echo $bulletin->getId(); ?>" class="bulletin-desc" style="display:none">
							<span class="visible-xs visible-phone">Posted on:  <?php echo $bulletin->getCreateDate(); ?><br/></span>
							<p><?php echo nl2br($bulletin->getDescription()); ?></p>
						</div>
					</td>
				
					<td class="hidden-xs hidden-tablet hidden-phone vtop" ><?php echo $bulletin->getCreateDate(); ?></td>
					<td class="hidden-xs hidden-sm hidden-tablet hidden-phone vtop"><?php echo $bulletin->getTypeDesc(); ?></td>
					<td class="hidden-xs hidden-sm hidden-tablet hidden-phone vtop"><?php echo $bulletin->getUpdatedBy(); ?></td>
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

<script>

jQuery('.bulletin-toggle').click(function(){
	var collapse_content_selector = "#" + jQuery(this).attr('key');
	var toggle_switch = jQuery(this);
	jQuery(collapse_content_selector).toggle("fast",function(){
		if(jQuery(this).css('display')=='none'){
			toggle_switch.html('<span class="glyphicon glyphicon-plus-sign"></span>');//change the button label to be 'Show'
		}else{
			toggle_switch.html('<span class="glyphicon glyphicon-minus-sign"></span>');//change the button label to be 'Hide'
		}
	});
});

</script>
