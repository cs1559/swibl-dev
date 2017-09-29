<?php
/**
 * @version		$Id: standingslist.php 389 2012-02-12 11:40:19Z Chris Strieter $
 * @package 	GMapsPRO
 * @subpackage	Classes
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */


defined('_JEXEC') or die('Restricted access');

?>
<script type="text/javascript" language="javascript">
/**
 * This function needs to be here because, Joomla calls it
 **/ 
 
function submitbutton(action)
{
		submitform(action);
}

</script>

	
	<form action="index.php" method="post" id="adminForm" name="adminForm">
	<table  class="jl-admin-filter-row" cellspacing="1">
		<tbody>
		<tr>
			<td style="text-align: right;">
			<?php  echo JLText::getText( 'League Filter'); ?>
			<?php  echo JLHtml::getLeagueSelectList('filter_league',$filter_league,true,'onchange="document.adminForm.submit();"'); ?>
			<?php  echo JLText::getText( 'Season Filter'); ?>
			<?php  echo JLHtml::getSeasonSelectList('filter_season',$filter_season,true,'onchange="document.adminForm.filter_divisionid.value=0; document.adminForm.submit();"'); ?>
			<?php  echo JLText::getText( 'Division Filter'); ?>
			<?php  echo JLHtml::getDivisionSelectList('filter_divisionid',$filter_divisionid,$filter_season,true,'onchange="document.adminForm.submit();"'); ?>
			</td>
		</tr>
		</tbody>
	</table>
		
	<table class="table table-striped" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
				<th width="10%" style="text-align: left;">
					<?php echo JLText::getText( 'League' ); ?>
				</th>
				<th style="text-align: left; width='10%'">
					<?php echo JLText::getText( 'Season' ); ?>
				</th>
				<th width="20%">
					 <?php echo JLText::getText( 'Division' );?>
				</th>
				<th width="10%">
					 <?php echo JLText::getText( 'Position' );?>
				</th>
				<th width="20%">
					 <?php echo JLText::getText( 'Team Name' );?>
				</th>
				<th width="10%">
					 <?php echo JLText::getText( 'Wins' );?>
				</th>				
				<th width="10%">
					 <?php echo JLText::getText( 'Losses' );?>
				</th>				
				<th width="10%">
					 <?php echo JLText::getText( 'Ties' );?>
				</th>				
				<th width="10%">
					 <?php echo JLText::getText( 'Points' );?>
				</th>				
								
			</tr>		
		</thead>
<?php
		$i		= 0;
		$prevdiv = 0;
		foreach($standings as $obj)
		{
			if ($obj->getDivisionId() != $prevdiv) {
				$dao = &JLFactory::getDivisionDao();
				$divobj = $dao->findById($obj->getDivisionId());
				?>
				<tr style="background-color: #f7f7f7;"><td colspan=99><strong>DIVISION: <?php echo $divobj->getName(); ?></strong></td></tr>
				<?php
				$prevdiv = $obj->getDivisionId();
				$i = 0;
			}
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $obj->getId()); ?></td>
				<td>
					<?php echo $obj->getLeagueName();?>
				</td>
				<td>
					<?php echo $obj->getSeasonName();?>
				</td>					
				<td>
					<?php echo $obj->getDivisionName();?>
				</td>					
				<td>
					<?php echo $obj->getPosition();?>
					<img height="16" border="0" width="16" alt="Move Up" src="images/uparrow.png"/>
					<img height="16" border="0" width="16" alt="Move Up" src="images/downarrow.png"/>
				</td>										
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=standings&task=edit&cid[]=' .$obj->getId()  );
						echo JHTML::_('link', $link , $obj->getTeamName(), array('id' => $obj->getId() )); 
					
					?>
				</td>
		
				<td>
					<?php echo $obj->getWins();?>
				</td>				
				<td>
					<?php echo $obj->getLosses();?>
				</td>
				<td>
					<?php echo $obj->getTies(); ?>
				</td>				
				<td>
					<?php echo $obj->getPoints();?>
				</td>
				
			</tr>
<?php
		}
?>
		<tfoot>
		<tr>
			<td colspan="99">
				<?php  echo $pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
	</table>
	<input type="hidden" name="view" value="standings" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="standings"/>
	<input type="hidden" name="task" value="display" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
