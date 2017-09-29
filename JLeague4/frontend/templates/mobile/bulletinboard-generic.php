<?php
?>

<h1>SWIBL - Bulletin Board</h1>

<p>
<strong>NOTE:  The SWIBL bulletin board is a private bulletin board and public postings are currently prohibited.  Only coaches 
and contacts associated with a league team may post to the board.</strong>
</p>

<table class="swibl-table-max table-striped table-responsive">
			<thead>
				<tr>
					<th>Title</th>
					<th>Date Posted</th>
					<!-- <th class="hidden-xs hidden-sm">Posted By</th>  -->
				</tr>
			</thead>
			<tbody>
			<?php 		
			if (count($bulletins) > 0 ) {	
				foreach ($bulletins as $bulletin) {
				?><tr>
					
					<td style="width: 70%;">
							<a class="bulletin-toggle" key="tp-collapse<?php echo $bulletin->getId(); ?>" ><span class="glyphicon glyphicon-plus-sign"></span></a> 
							<span class="bulletin-title"><?php echo $bulletin->getTitle(); ?></span>
							<div id="tp-collapse<?php echo $bulletin->getId(); ?>" class="bulletin-desc" style="display:none">
								<p><?php echo nl2br($bulletin->getDescription()); ?></p>
								<p>
									CONTACT: <?php echo $bulletin->getContactName();?><br/>
									EMAIL:  <?php echo mJoomlaApp::cloakEmail($bulletin->getContactEmail(),false);?><br/>
									PHONE:  <?php echo $bulletin->getContactPhone();?>
								</p>
							</div>
					</td>
					<td class="vtop" ><?php echo $bulletin->getCreateDate(); ?></td>
					<!-- <td class="hidden-xs hidden-sm vtop"><?php echo $bulletin->getUpdatedBy(); ?></td> -->
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