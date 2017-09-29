<?php
?>
<style>
.teamprofile-wrapper {
	padding: 10px;
	background: #F9F9F9;
}
.teamprofile-heading {
    font-size: 26px !important;
    font-weight: bold !important;
    margin-bottom: 10px;
    margin-top: 10px;
    padding: 10px;
    border: 2px solid #a1a1a1;
    padding: 10px 40px; 
    background: #778899;
    border-radius: 10px;
}
.teamprofile-component {
    border: 1px solid #778899;
    margin-bottom: 15px;
    background: #fff;
}
.teamprofile-component-header > h3 {
	margin: 0px !important;	
	text-align: center;
	color: #ffffff;
}
.teamprofile-component-header {
	/* background-color: #008dd5; */
	background-color: #778899;
}
.teamprofile-component-content {
	padding: 10px;
}
.swibl-table-max {
	/*line-height: 8px; */
}	
.teamprofile-schedule-table {
	line-height: 18px;
}
#teamprofile-standings {
	max-height: 350px;
}
.teamprofile-component-scrollable-content {
	overflow-y: scroll;
	height: 280px;
	max-height: 280px; 
}

</style>
<div class="teamprofile-wrapper">

	<div style="">
		<?php if (isset($messages)) { ?>
		<div class="alert alert-danger alert-dismissable">
	  		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  		<?php echo $messages; ?>
		</div>
		<?php } ?>
	
		<div class="teamprofile-header">
			<!--  Row 0 -->
			<div class="row-fluid">
				<div class="teamprofile-heading">
					<h1><strong><?php echo $team->getName();?></strong></h1>
					<?php
						if ($submenu != null) {
					?>
						<div id="teamprofile-menu-wrapper" class="center-block"><?php echo $submenu; ?> </div>
					<?php
						}
					?>				
					
				</div>
			</div>
			<!--  Row 1 -->
			<div class="row-fluid">

				<div class="span5 col-md-6">
					<div id="profile-card-logo ">
						<img class="teamprofile-team-logo img-polaroid"
							src="/<?php echo $config->getProperty('logo_folder') . $team->getLogo();?>"
							alt="SWIBL Team Logo" />

					</div>
				</div>
				<div class="span7 col-md-6">
					<div class="teamprofile-geninfo">
						<h4>Team Information</h4>
						<table id="teaminfo-profile-table" class="">
						<?php
						/*
						if ($submenu != null) {
							?>
						<tr>
								<td colspan="2">
									<div id="teamprofile-menu-wrapper" class="center-block"><?php echo $submenu; ?> </div>
								</td>
							</tr>
							
						<?php
						}
						*/
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
							<!-- 
							<tr>
								<td class="teamprofile-info-col1"><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></td>
								<td class="teamprofile-info-col2"><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
							</tr>
							 -->
							<tr>
								<td class="teamprofile-info-col1">Age Group:</td>
								<td class="teamprofile-info-col2"><?echo $team->getAgeGroup(); ?> - <?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
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

		</div>

		<hr class="teamprofile-hr" />

		<!--  Row 2 -->
		<div class="row-fluid teamprofile-row">

						<div class="col-md-6 span6">
							<div class="teamprofile-component">
								<div id="teamprofile-recodhistory" class="teamprofile-component-header">
									<h3>Record History</h3>
								</div>
								<div class="teamprofile-component-content">
									<div id="teamprofile-recordhistory-detail">
										<table id="recordhistory-table" style="width: 100%">
											<thead>
												<tr class="recordhistory-header-row">
													<th class=""><?php echo JLText::getText('Season'); ?></th>
													<th class=""><?php echo JLText::getText('Division'); ?></th>
													<th class="centerjust"><?php echo JLText::getText('Wins'); ?></th>
													<th class="centerjust"><?php echo JLText::getText('Losses'); ?></th>
													<th class="centerjust"><?php echo JLText::getText('Ties'); ?></th>
													<th class="centerjust hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo JLText::getText('RS'); ?></th>
													<th class="centerjust hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo JLText::getText('RA'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ( $recordhistory as $obj ) {
												?>
													<tr>
														<td class=""><?php echo $obj->getSeason();?></td>
														<td class=""><?php echo $obj->getDivisionName();?></td>
														<td class="centerjust"><?php echo $obj->getWins();?></td>
														<td class="centerjust"><?php echo $obj->getLosses();?></td>
														<td class="centerjust"><?php echo $obj->getTies();?></td>
														<td class="centerjust  hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo $obj->getRunsScored();?></td>
														<td class="centerjust  hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo $obj->getRunsAllowed();?></td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<div  id="teamprofile-upcomgingames" class="teamprofile-component">
								<?php
								$i = 0;
								?>
								<div class="teamprofile-component-header">
									<h3>Upcoming Games</h3>
								</div>
								<div class="teamprofile-component-content">
									<table class="swibl-table-max">
										<?php
										if (count ( $upcominggames ) > 0) {
											foreach ( $upcominggames as $game ) {
												?>
												<tr>
															<td class="vcenter">
																<?php echo $game->getGameDate(); ?>
																<!-- 
																<div class="date">
																	<p><?php echo date('d',$game->getGameDate());?>
																		<span><?php echo date('M',$game->getGameDate());?></span>
																	</p>
																</div>
																 -->
						
															</td>
															<td class="hidden-xs hidden-phone"><img class="teamprofile-team-logo-mini"
																src="<?php echo $config->getProperty('logo_folder') . $_view->getOpponentLogo($team, $game);?>"
																alt="SWIBL Team Logo" /></td>
															<td class="vcenter"><?php echo $_view->getOpponent($team, $game); ?><br />
																<span class="teamprofile-subtext"><?php echo $game->getLocation(); ?></span>
															</td>
														</tr>
											<?php
												$i ++;
											}
										} else {
											echo "No Upcoming Games scheduled for the current season";
										}
										?>	
									</table>
								</div>
							</div>
						</div>
						
						
						<div class="col-md-6 span6">
							<?php echo $standingsHtml; ?>
						</div>
					</div>
					<!--  End of Row 2 -->
		</div>

		<div class="row-fluid teamprofile-row">
			<div id="teamprofile-contacts" class="teamprofile-component">
				<div class="teamprofile-component-header">
					<h3>Contacts</h3>
				</div>
				<div class="teamprofile-component-content">
			<?php
				echo $contactsHtml;
			?>
				</div>
			</div>
	</div>

	<div class="row-fluid teamprofile-row">
		<div id="teamprofile-venues" class="teamprofile-component">
			<div class="teamprofile-component-header">
				<h3>Fields/Venues</h3>
			</div>
			<div class="teamprofile-component-content">
					<?php
					echo $venuesHtml;
					?>
			</div>
		</div>
	</div>
		
	
<?php if (isset($rosterHtml)) { ?>
	<div class="row-fluid teamprofile-row">
		<div id="teamprofile-roster" class="teamprofile-component">
			<div class="teamprofile-component-header">
				<h3>Fields/Venues</h3>
			</div>
			<div class="teamprofile-component-content">
					<?php
					echo $rosterHtml;
					?>
			</div>
		</div>
	</div>
<?php } ?>
	
	<div class="row-fluid teamprofile-row">
		<div id="teamprofile-schedule" class="teamprofile-component">
			<div class="teamprofile-component-header">
				<h3>Schedule</h3>
			</div>
			<div class="teamprofile-component-content">
					<?php
					echo $scheduleHtml;
					?>
			</div>
		</div>
	</div>



</div>
<!--  End of Group -->

