<?php
?>

<div class="" >

<div style="text-align: center;">
	<div class="row">
		<div class="col-md-3">
			<div id="profile-card" class="swibl-box">
				<h2><?php echo $team->getName();?></h2> 
				<!--  <h5>Coach: <?php echo $team->getCoachName();?></h5>   -->
				<div id="profile-card-logo">
					<img class="img-polaroid" src="http://swibl-baseball.org/j15/images/jleague/<?php echo $team->getLogo();?>"/>
				</div>
				<h3><?php echo $teamview->getSeason()->getTitle() . " - " . $division->getName();?></h3> 
				<!-- <h3 style="color: red"><?php echo $teamview->getFormattedRecord(); ?></h3>   -->
				<?php 
					if ($submenu != null) {
  				?>
  					<div id="teamprofile-menu"><?php echo $submenu; ?> </div>
  				<?php  
					}
  				?>
			</div>
		</div>
		<div class="col-md-3">
			<div class="swibl-profile-geninfo">
			<div class="panel panel-default">
			  <div class="swibl-panel-heading panel-heading"><h4>Team Information</h4></div>
	  			<div class="panel-body">
			    	<table class="tablex">
						<tbody>
							<tr>
								<td>Hometown:</td>
								<td><?echo $team->getCity() . " " . $team->getState(); ?></td>
							</tr>
							<tr>
								<td>Website:</td>
								<td><?echo $_view->getWebsiteUrl($teamview); ?></td>
							</tr>
							<tr>
								<td>Age Group:</td>
								<td><?echo $team->getAgeGroup(); ?></td>
							</tr>
							<tr>
								<td><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></td>
								<td><?php echo $_view->getUSSSAProfileUrl($teamview); ?></td>
							</tr>
							<tr>
								<td><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></td>
								<td><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
							</tr>
						</tbody>
					</table>
	  			</div>
			</div>
	</div>

</div>

</div>
</div>

<div class="panel-group" id="accordion">
	
	<div class="panel panel-default">
		 <div class="panel-heading">
		 	<h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-currentseason">
				Current Season
				</a>
			</h4>
		</div>
		<div id="collapse-currentseason" class="panel-collapse collapse">
			<div class="panel-body">
<?php 
	$currentrecord = $teamview->getActiveRecord();
echo $currentrecord->getWins() . "-" . $currentrecord->getLosses() . "-" . $currentrecord->getTies(); 
?>
			</div>   <!--  panel-body -->
		</div>  <!--  panel-collapse -->
	</div> <!-- panel -->

	<div class="panel panel-default">
		 <div class="panel-heading">
		 	<h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-contacts">
				Team Contacts
				</a>
			</h4>
		</div>
		<div id="collapse-contacts" class="panel-collapse collapse">
				<div class="panel-body">
<?php 
	echo "Team Contacts"; 
?>
			</div>   <!--  panel-body -->
		</div>  <!--  panel-collapse -->
	</div> <!-- panel -->


	<div class="panel panel-default">
		 <div class="panel-heading">
		 	<h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-gamehistory">
				Game history
				</a>
			</h4>
		</div>
		<div id="collapse-gamehistory" class="panel-collapse collapse">
				<div class="panel-body">			
<?php 
	echo "Game History"; 
?>
			</div>   <!--  panel-body -->
		</div>  <!--  panel-collapse -->
	</div> <!-- panel -->
	
	<div class="panel swibl-panel-heading">
		 <div class="panel-heading">
		 	<h4 class="panel-title">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-recordhistory">
				Record history
				</a>
			</h4>
		</div>
		<div id="collapse-recordhistory" class="panel-collapse collapse">
			<div class="panel-body">
<?php 
	echo "Record History"; 
?>
			</div>   <!--  panel-body -->
		</div>  <!--  panel-collapse -->
	</div> <!-- panel -->	
	
	
	
</div> <!--  panel group -->

</div>
