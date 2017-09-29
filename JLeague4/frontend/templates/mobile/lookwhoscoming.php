<div class="standings-container">

	<div id="standings-body">
	
		<h3>Look who's coming - <?php echo $season->getDescription(); ?></h3>
		<div class="alert alert-info"><?php echo $season_note; ?></div>
		
		<div class="standings-inner-wrapper">
		<p>
		The following teams have REGISTERED to participate in SWIBL during the <?php echo $season->getTitle(); ?> season.  Once all registrations have been 
		processed and the divisions been set, this page will be updated with the most recent information.
		</p>

		<?php 
			$seasoncount= 0;
			$divcount = 0;
			$x = 0;
			$i		= 0;
			$prevage = 0;
			$prevdiv = null;
			$first = true;
			foreach($registrations as $obj)
			{
				
				if ($obj->getAgeGroup() != $prevage) {
					if (!$first) {
					?>
										</table>
										<div class="alert alert-info">Total Teams in Age Group: <?php echo $divcount; $divcount = 0; ?></div>
									</div> <!--  panel body -->
								</div>  <!--  accordion-colapseX -->
							</div> <!--  panel -->
					<?php 
					}
					?>
					<div class="panel panel-default">
					<div class="swibl-panel-heading panel-heading ">
					<h4 class="panel-title"><?php echo $obj->getAgeGroup() . "U"; ?> Age Group</h4>
												</div>
												<div >
													<div class="panel-body">
														<table class="table table-condensed">
															<thead>
																<tr>
																	<th>Team Name</th>
																	<th>Contact Name</th>
																	<th  class="hidden-phone">City/State</th>
																	<!-- <th  class="hidden-phone">Tournament</th>
																	 <th  class="hidden-phone">Requested<br/>Division</th> -->	
																	<!--  <th  class="hidden-phone">Assigned<br/>Division</th>  -->
																</tr>
															</thead>
									<?php 
										$prevage = $obj->getAgeGroup();
										$first = false;
									}
									if ($obj->getTeamId() > 0) {
										$tname = $obj->getTeamName();
									} else {
										$tname = $obj->getTeamName() . " (NEW) ";
									}
									?>
									<tr>
										<td>
											<?php if ($obj->getTeamId() > 0) {	?>
												<a href="<?php echo $_view->getUrl("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $obj->getTeamId()); ?>">
													<?php echo $obj->getTeamName();?>
												</a>
											<?php 
												} else {
													echo $tname; 
												}?>
										</td>
										<td><?php echo $obj->getName(); ?></td>
										<td class="hidden-phone"><?php echo $obj->getCity() . "," . $obj->getState(); ?></td>
										<!--  <td class="hidden-phone"><?php echo $_view->getYesNo($obj->isPlayingInTournament()); ?></td>
										<td class="hidden-phone"><?php echo $obj->getDivisionClass();  ?></td>   -->
										<td><?php //echo $obj->getDivisionName(); ?></td>											
													</tr>
									<?php
									$seasoncount++;
									$divcount++;
								}
								?>	
								</table>
								<div class="alert alert-info">Total Teams in Age Group: <?php echo $divcount; $divcount = 0; ?></div>
								<div class="alert alert-info">
									<strong>Total Teams: <?php echo $seasoncount; ?></strong>
								</div>
										</div>   <!--  panel body -->
									</div>   <!--  panel collapse -->
								</div> <!--  panel -->						
							</div>  <!--  panel group -->
						</div>  <!--  standings body -->
						
					</div> <!--  container -->