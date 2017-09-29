<?php
?>

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
<!-- 				<div class="teamprofile-heading">
					<h1><strong><?php echo $team->getName();?></strong></h1>
				</div>
 -->
				<?php
					if ($submenu != null) {
				?>
					<div id="teamprofile-menu-wrapper" class="span3 offset4 center-block"><?php echo $submenu; ?> </div>
				<?php
					}
				?>	
			</div>
			<!--  Row 1 -->
			<div class="row-fluid">

				<div class="span5 col-md-6">
					<div id="profile-card-logo ">
						<img class="teamprofile-team-logo img-polaroid"
							src="<?php echo JURI::base() . DS . $config->getProperty('logo_folder') . $team->getLogo();?>"
							alt="SWIBL Team Logo" />

					</div>
				</div>
				<div class="span7 col-md-6">
					<div class="teamprofile-geninfo">
						<div class="teamprofile-teamname">
							<h1><?php echo $team->getName();?></h1>
						</div>
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
						<!-- 
							<tr>
								<td class="teamprofile-info-col1"><?php echo $team->getFieldName("FLD_USSSA_NUMBER"); ?></td>
								<td class="teamprofile-info-col2">
								<?php echo $_view->getUSSSAProfileUrl($teamview); ?>
							</td>
							</tr>
 						-->							
							<!-- 
							<tr>
								<td class="teamprofile-info-col1"><?php echo $team->getFieldName("FLD_CLASSIFICATION"); ?></td>
								<td class="teamprofile-info-col2"><?php echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
							</tr>
							 -->
							<tr>
								<td class="teamprofile-info-col1">Age Group:</td>
								<td class="teamprofile-info-col2"><?echo $team->getAgeGroup(); ?> <?php // echo $team->getFieldValue("FLD_CLASSIFICATION"); ?></td>
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
		
		<?php 
			$arec = $teamview->getActiveRecord();
			try {
				$year = $arec->getSeason();
				$found = true;
			} catch (Exception $e) {
				$found = false;
			}
		?>
		<div class="row-fluid teamprofile-row">
			<div id="teamprofile-record" class="teamprofile-component">
				<div class="teamprofile-component-header">
					<h3><?php echo $arec->getSeason();?> Statistics</h3>
				</div>
				<div class="teamprofile-component-content">
					<table class="teamprofile-table teamprofile-record-table swibl-table-max table-responsive">
						<thead>
							<tr>
								<th>Division Name</th>
								<th>Wins</th>
								<th>Losses</th>
								<th>Ties</th>
								<th class="hidden-phone">WinPct</th>
								<th class="hidden-phone">Runs Scored</th>
								<th class="hidden-phone">Runs Allowed</th>
								<th class="hidden-phone">Avg Runs Allowed</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php 
									If ($publishstandings) {
										echo $arec->getDivisionName(); 
									} else {
										echo "TBD Division";
									}?></td>
								<td><?php echo $arec->getWins();?></td>
								<td><?php echo $arec->getLosses();?> </td>
								<td><?php echo $arec->getTies();?></td>
								<td class="hidden-phone"><?php echo number_format($arec->getWinningPercentage(),4);?></td>
								<td class="hidden-phone"><?php echo $arec->getRunsScored();?></td>
								<td class="hidden-phone"><?php echo $arec->getRunsAllowed();?></td>
								<td class="hidden-phone"><?php echo $arec->getAverageRunsAllowed();?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		
		<!--  Row 2 -->
		<div class="row-fluid teamprofile-row">

						<div class="teamprofile-col1 col-md-6 span6">
							<?php echo $standingsHtml; ?>
						</div>
						
						<div class="teamprofile-col2 col-md-6 span6">

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
						

					</div>
					<!--  End of Row 2 -->
		</div>
		
		<div class="row-fluid teamprofile-row">
			<div id="teamprofile-contacts" class="teamprofile-component">
				<div class="teamprofile-component-header">
					<h3>Team Contacts</h3>
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
		
	

	<div class="row-fluid teamprofile-row">
		<?php
			$span = 12; 
			if (isset($rosterHtml)) { 
		?>
		<div id="teamprofile-roster" class="teamprofile-component span6">
			<div class="teamprofile-component-header">
				<h3>Roster</h3>
			</div>
			<div class="teamprofile-component-content">
					<?php
					echo $rosterHtml;
					?>
			</div>
		</div>
		<?php
				$span = 6; 
			} 
		?>
	
		
		<div class="teamprofile-component span<?php echo $span;?>">
			<div id="teamprofile-recordhistory" class="teamprofile-component-header ">
				<h3>Record History</h3>
			</div>
			<div class="teamprofile-component-content">
				<div id="teamprofile-recordhistory-detail">
					<table class="teamprofile-table teamprofile-record-table swibl-table-max table-responsive">
						<thead>
							<tr>
								<th class=""><?php echo JLText::getText('Season'); ?></th>
								<th class=""><?php echo JLText::getText('Division'); ?></th>
								<th class=""><?php echo JLText::getText('Wins'); ?></th>
								<th class=""><?php echo JLText::getText('Losses'); ?></th>
								<th class=""><?php echo JLText::getText('Ties'); ?></th>
								<th class="hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo JLText::getText('RS'); ?></th>
								<th class="hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo JLText::getText('RA'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ( $recordhistory as $obj ) {
								if ($i < 1) {
									$i++;
									continue;
								}
								
							?>
								<tr>
									<td class=""><?php echo $obj->getSeason();?></td>
									<td class=""><?php echo $obj->getDivisionName();?></td>
									<td class=""><?php echo $obj->getWins();?></td>
									<td class=""><?php echo $obj->getLosses();?></td>
									<td class=""><?php echo $obj->getTies();?></td>
									<td class="hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo $obj->getRunsScored();?></td>
									<td class="hidden-sm hidden-xs hidden-tablet hidden-phone"><?php echo $obj->getRunsAllowed();?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
					
	</div>

	
	<div class="row-fluid teamprofile-row">
		<div id="teamprofile-schedule" class="teamprofile-component">
			<div class="teamprofile-component-header">
				<h3><?php echo $arec->getSeason();?> Schedule</h3>
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

