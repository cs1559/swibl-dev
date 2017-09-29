<div class="standings-container">

	<div id="standings-body">
		
		<h3>League Standings - <?php echo $season->getDescription(); ?></h3>
		<span class="system_message"><?php echo $season_note; ?></span>
		
		<div class="panel-group standings-accordion" id="accordion">
		<?php
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
							 	<h4 class="panel-title">
									<!--  <a class="xaccordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $divobj->getId();?>">   -->
										<?php echo $divobj->getName(); ?>
									<!--  </a>   -->
								</h4>
							</div>
							<div id="xcollapse-<?php echo $divobj->getId();?>" class="xpanel-collapse collapse">
								<div class="panel-body">
									<table class="table table-condensed">
										<thead>
											<tr>
												<th>Team Name</th>
												<th>Record</th>
												<th  class="hidden-phone">GP</th>	
												<th>Points</th>
												<th  class="hidden-phone">RS</th>	
												<th  class="hidden-phone">RA</th>
												<th  class="hidden-phone">Diff</th>
												<th  class="hidden-phone">Win Pct</th>			
											</tr>
										</thead>
				<?php 
					$prevdiv = $obj->getDivisionId();
					$first = false;
				}
				?>
				<tr>
					<td><?php echo $obj->getTeamName();?></td>
					<td><?php echo $obj->getRecord();?></td>
					<td class="hidden-phone"><?php echo $obj->getTotalGames(); ?></td>
					<td><?php echo $obj->getPoints();?></td>
					<td class="hidden-phone"><?php echo $obj->getRunsScored();?></td>
					<td class="hidden-phone"><?php echo $obj->getRunsAllowed();?></td>
					<td class="hidden-phone"><?php echo $obj->getRunsScored() - $obj->getRunsAllowed();?></td>					
					<td class="hidden-phone"><?php echo number_format($obj->getWinningPercentage(),4);?></td>
				</tr>
				<?php 
			}
			?>	
			</table>
					</div>   <!--  panel body -->
				</div>   <!--  panel collapse -->
			</div> <!--  panel -->						
		</div>  <!--  panel group -->
	</div>  <!--  standings body -->
	
</div> <!--  container -->