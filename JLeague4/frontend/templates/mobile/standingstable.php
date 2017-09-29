<div class="standings-container">

	<div id="standings-body">
		
		<h3>League Standings - <?php echo $season->getDescription(); ?></h3>
		<div class="alert alert-info"><?php echo $season_note; ?></div>
		
		<div class="standings-inner-wrapper">
		<?php
		
			if ($publishstandings) {
				$x		= 0;
				$prevdiv = 0;
				$first = true;
				foreach($standings as $obj)
				{
					$x  += 1;
					// Check to see if a new division
					if ($obj->getDivisionId() != $prevdiv) {
						$divobj = $divdao->findById($obj->getDivisionId());
						if (!$first) {
						?>	
											</table>
										</div> <!--  panel body -->
									</div>  <!--  accordion-colapseX -->
								</div> <!--  panel -->
						<?php 
						}
						?>
							<div class="panel panel-default">
								<div class="swibl-panel-heading panel-heading ">
								 	<h4 id="div-<?php echo $divobj->getId();?>" class="panel-title">
										<!--  <a class="xaccordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $divobj->getId();?>">   -->
											<?php echo $divobj->getName(); ?>
										<!--  </a>   -->
									</h4>
								</div>
								<div >
									<div class="panel-body">
										<table class="table table-condensed">
											<thead>
												<tr>
													<th class="standings-column1">Team Name</th>
													<th  class="standings-column2 hidden-sm hidden-xs hidden-phone">Coach</th>
													<th  class="standings-column3">Record</th>
													<th  class="standings-column4 hidden-sm hidden-xs hidden-phone">GP</th>	
													<th  class="standings-column5">Points</th>
													<th  class="standings-column6 hidden-sm hidden-xs hidden-phone">RS</th>	
													<th  class="standings-column7 hidden-sm hidden-xs hidden-phone">RA</th>
													<th  class="standings-column8 hidden-sm hidden-xs hidden-phone">ARA</th>
													<th  class="standings-column9 hidden-sm hidden-xs hidden-phone">Win Pct</th>			
												</tr>
											</thead>
					<?php 
						$prevdiv = $obj->getDivisionId();
						$first = false;
					}
					?>
					<tr>
						<td>
							<a href="<?php echo $_view->getUrl("index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid=" . $obj->getTeamId()); ?>">
							<?php echo $obj->getTeamName();?>
							</a>
						</td>
						<td class="hidden-sm hidden-xs hidden-phone"><?php echo $obj->getHeadCoach();?></td>
						<td><?php echo $obj->getRecord();?></td>
						<td class="hidden-sm hidden-xs hidden-phone"><?php echo $obj->getTotalGames(); ?></td>
						<td><?php echo $obj->getPoints();?></td>
						<td class="hidden-sm hidden-xs hidden-phone"><?php echo $obj->getRunsScored();?></td>
						<td class="hidden-sm hidden-xs hidden-phone"><?php echo $obj->getRunsAllowed();?></td>
						<td class="hidden-sm hidden-xs hidden-phone">
							<?php 
								// echo $obj->getRunsScored() - $obj->getRunsAllowed();
								if ($obj->getTotalGames() > 0) {
									$avgra = $obj->getRunsAllowed() / $obj->getTotalGames();
								} else {
									$avgra = 0;
								}
								echo number_format($avgra,3);
							?>
						</td>					
						<td class="hidden-sm hidden-xs hidden-phone"><?php echo number_format($obj->getWinningPercentage(),4);?></td>
					</tr>
					<?php 
				}

			?>	
			</table>
					</div>   <!--  panel body -->
				</div>   <!--  panel collapse -->
			</div> <!--  panel -->
			
			<?php 			
			} else {
				?><h3>Standings for this season have not been published</h3><?php 
			}			
			?>
		</div>  <!--  standings-inner-wrapper -->
	</div>  <!--  standings body -->
	
</div> <!--  standings container -->