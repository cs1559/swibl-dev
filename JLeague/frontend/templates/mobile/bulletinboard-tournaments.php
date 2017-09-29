<?php
?>

<h1>SWIBL - Tournament Listing</h1>

<div class="row">
	<div class="col-md-6">

		<div class="well media">
			<a class="pull-left" href="#">
    			<img class="media-object teamprofile-team-logo-mini" src="http://www.usssa.com/sports/images/reskin/usssa_logo.png" alt="USSSA">
  			</a>
	
			<div class="media-body">
				<h3>2015 USSSA Illinois State Tournament</h3>
				<p>
					Class A 10U-14U, June 19-21, 2015 - O'fallon Illinois<br/>
					Class AA 10U,12U, June 26-28, 2015 - Bethalto Illinois<br/>
					<br/>
					Website:  <a href="http://usssaillinoisbaseball.com/il_state_2015">Click here for More information </a><br/>
					<!--  Entry Form:  <a href="http://r.b5z.net/i/u/10181276/f/2014_IL_State_Tournament_Entry_Form.doc">Click here to download form</a> -->
				</p>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="well media">
			<a class="pull-left" href="#">
    			<img class="media-object teamprofile-team-logo-mini" src="images/final-logo.gif" alt="SWIBL">
  			</a>
	
			<div class="media-body">
				<h3>2015 SWIBL Championship Tournament</h3>
				<p>
					Date:  July 6-12, 2015<br/>
					This years tournament will be played in O'fallon, Collinsville and Bethalto<br/>
				</p>
			</div>
	</div>
</div>

</div>

<table class="swibl-table-max table-striped table-responsive">
			<thead>
				<tr>
					<th>Title</th>
					<th>Date Posted</th>
					<th class="hidden-xs hidden-sm">Posted By</th>
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
					<td class="hidden-xs hidden-sm vtop"><?php echo $bulletin->getUpdatedBy(); ?></td>
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