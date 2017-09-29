<?php
/**
 * @version		$Id: teamlist.php 298 2011-11-20 13:00:20Z Chris Strieter $
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

	
	<form action="index.php?option=com_jleague" method="post" name="adminForm">
	<table width="100%">
		<tr><td style="text-align: right;">
			<?php  echo JLText::getText( 'Season Filter'); ?>
			<?php  echo JLHtml::getSeasonSelectList('filter_season',$filter_season,true,'onchange="document.adminForm.filter_divisionid.value=0; document.adminForm.submit();"'); ?>
			<?php  echo JLText::getText( 'Division Filter'); ?>
			<?php  echo JLHtml::getDivisionSelectList('filter_divisionid',$filter_divisionid,$filter_season,true,'onchange="document.adminForm.submit();"'); ?>
			</td>
		</tr>
		
	</table>	
	<table class="adminlist" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php  echo count( $teams ); ?>);" /></th>
				<th width="15%" style="text-align: left;">
					<?php echo JLText::getText( 'Name' ); ?>
				</th>
				<th style="text-align: left; width='20%'">
					<?php echo JLText::getText( 'City' ); ?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'State' );?>
				</th>
				<th width="15%">
					 <?php echo JLText::getText( 'Website' );?>
				</th>
				<th width="15%">
					 <?php echo JLText::getText( 'Season' );?>
				</th>
				<th width="15%">
					 <?php echo JLText::getText( 'Division' );?>
				</th>				
								
			</tr>		
		</thead>
<?php
		$i		= 0;
		
	//	foreach($this->leagues as $league)
		foreach($teams as $team)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $team->getId()); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=teams&task=edit&cid[]=' .$team->getId()  );
						echo JHTML::_('link', $link , $team->getName(), array('id' => $team->getId() )); 
					
					?>
				</td>
				<td class="team-city">
					<?php echo $team->getCity();?>
				</td>				
				<td class="team-state">
					<?php echo $team->getState();?>
				</td>				
				<td class="team-website">
					<?php echo $team->getWebsite();?>
				</td>
				<td class="team-season">
					<?php $season = $team->getSeason(); 
						if (isset($season)) {
							echo $season->getTitle();
						}	
					?>
				</td>				
				<td class="team-division">
					<?php $div = $team->getDivision(); 
						if (isset($div)) {
							echo $div->getName();
						}	
					?>
				</td>
				
			</tr>
<?php
		}
?>
		<tfoot>
		<tr>
			<td colspan="6">
				<?php  echo $pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
	</table>
	<input type="hidden" name="view" value="teams" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="teams"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
