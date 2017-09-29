<?php
?>

<div class="teamprofile-wrapper">

	<div style="">

		<!--  Row 1 -->
		<div class="row teamprofile-header">
			
			<div class="col-md-3">
				<div id="profile-card-logo">
					<img class="teamprofile-team-logo"
						src="<?php echo $config->getProperty('logo_folder') . $team->getLogo();?>"
						alt="SWIBL Team Logo" />

				</div>
			</div>
			<div class="col-md-9">
				<div class="teamprofile-heading">
					<h1><?php echo $team->getName();?></h1>
				</div>
				<div class="teamprofile-geninfo">
					<table id="teaminfo-profile-table" class="">
						<?php
						if ($submenu != null) {
							?>
						<tr>
							<td colspan="2">
								<div id="teamprofile-menu-wrapper" class="center-block"><?php echo $submenu; ?> </div>
							</td>
						</tr>
							
						<?php
						}
						?>				
						<tr>
							<td class="teamprofile-info-col1">City:</td>
							<td class="teamprofile-info-col2"><?php echo $team->getCity() . ", " .$team->getState(); ?></td>
						</tr>
						<tr>
							<td class="teamprofile-info-col1"><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></td>
							<td class="teamprofile-info-col2">
								<?php echo $_view->getUSSSAProfileUrl($teamview); ?>
							</td>
						</tr>
						<tr>
							<td class="teamprofile-info-col1"><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></td>
							<td class="teamprofile-info-col2"><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
						</tr>
						<tr>
							<td class="teamprofile-info-col1">Age Group:</td>
							<td class="teamprofile-info-col2"><?echo $team->getAgeGroup(); ?></td>
						</tr>
						<tr>
							<td class="teamprofile-info-col1">Head Coach:</td>
							<td class="teamprofile-info-col2"><?php echo $team->getCoachName(); ?></td>
						</tr>
						<tr>
							<td class="teamprofile-info-col1">Phone:</td>
							<td class="teamprofile-info-col2"><?php echo $team->getCoachPhone(); ?></td>
						</tr>
						<tr>
							<td class="teamprofile-info-col1">Website:</td>
							<td class="teamprofile-info-col2"><?php echo $team->getWebsite(); ?></td>
						</tr>					
					</table>
				</div>
			</div>
		</div>
		<!--  End of Row 1 -->

		<hr class="teamprofile-hr"/>
		
		<!--  Row 2 -->
		<div class="row teamprofile-row">

			<div class="col-md-6">
				<h3><?php echo $teamview->getSeason()->getTitle();?> Season</h3>
				<h4><?php echo $division->getName();?></h4> 
					<?php $arec = $teamview->getActiveRecord();?>
					<table id="teamprofile-record-table" class="gridtable">
					<thead>
						<tr>
							<th>W</th>
							<th>L</th>
							<th>T</th>
							<th>RS</th>
							<th>RA</th>
						</tr>
						<tr>
							<td><?php echo $arec->getWins();?></td>
							<td><?php echo $arec->getLosses();?></td>
							<td><?php echo $arec->getTies();?></td>
							<td><?php echo $arec->getRunsScored();?></td>
							<td><?php echo $arec->getRunsAllowed();?></td>
						</tr>
					</thead>
				</table>
<?php
						$i = 0;
						foreach($upcominggames as $game)
						{
							if ($i == 0) {
								echo "<h3>Upcoming Games</h3>";
							}
								?>
								<div class="profile-upcominggame-entry">
								<?php
								 echo "<strong>" . $game->getGameDate() ."</strong>" . "<br/>" .$_view->getOpponent($team,$game) . "<br/>";
								  ?>
								 </div>
								<?php
							$i++;
						}
				
				?>				
			</div>
			<div class="col-md-6">
				<?php echo $standingsHtml; ?>
			</div>
		</div>
		<!--  End of Row 2 -->
	</div>

	<div class="row teamprofile-row">
		<!--  Row 3 -->
		<div class="col-md-4">
			
			</div>
	</div>
	<!--  End of Row 2 -->


	<!--  End of Group -->
	<div class="panel-group" id="accordion">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse"
						data-parent="#accordion" data-target="#collapse-currentschedule">
						Schedule </a>
				</h4>
			</div>
			<div id="collapse-currentschedule" class="panel-collapse collapse">
				<div class="panel-body">
	<?php
	echo $scheduleHtml;
	?>
				</div>
				<!--  panel-body -->
			</div>
			<!--  panel-collapse -->
		</div>
		<!-- panel -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse"
						data-parent="#accordion" href="#collapse-contacts"> Team Contacts
					</a>
				</h4>
			</div>
			<div id="collapse-contacts" class="panel-collapse collapse">
				<div class="panel-body">
	<?php 
		echo $contactsHtml;
	?>
				</div>
				<!--  panel-body -->
			</div>
			<!--  panel-collapse -->
		</div>
		<!-- panel -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse"
						data-parent="#accordion" href="#collapse-gamehistory"> Game
						history </a>
				</h4>
			</div>
			<div id="collapse-gamehistory" class="panel-collapse collapse">
				<div class="panel-body">			
	<?php 
		echo "Game History"; 
	?>
				</div>
				<!--  panel-body -->
			</div>
			<!--  panel-collapse -->
		</div>
		<!-- panel -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a class="accordion-toggle" data-toggle="collapse"
						data-parent="#accordion" href="#collapse-recordhistory"> Record
						history </a>
				</h4>
			</div>
			<div id="collapse-recordhistory" class="panel-collapse collapse">
				<div class="panel-body">
	<?php 
		echo "Record History"; 
	?>
				</div>
				<!--  panel-body -->
			</div>
			<!--  panel-collapse -->
		</div>
		<!-- panel -->


	</div>
	<!--  End of Group -->

</div>
