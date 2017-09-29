<?php
/**
 * @version		$Id: teamlist.php,v 1.4 2010/01/11 23:59:32 cs1559 Exp $
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

	
	<form action="index.php?option=com_jtourney" method="post" name="adminForm">
	<table width="100%">
		<tr><td style="text-align: right;">
			<?php  echo JText::_( 'Season Filter'); ?>
			<?php  // echo JTHtml::getSeasonSelectList('filter_season',$filter_season,true,'onchange="document.adminForm.filter_divisionid.selectedIndex=0; document.adminForm.submit();"'); ?>
			<?php  echo JText::_( 'Division Filter'); ?>
			<?php  // echo JTHtml::getDivisionSelectList('filter_divisionid',$filter_divisionid,$filter_season,true,'onchange="document.adminForm.submit();"'); ?>
			</td>
		</tr>
		
	</table>	
	<table class="adminlist" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JText::_( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php  echo count( $events ); ?>);" /></th>
				<th width="25%" style="text-align: left;">
					<?php echo JText::_( 'Event Name' ); ?>
				</th>
				<th width="5%">
					 <?php echo JText::_( 'Published' );?>
				</th>				
				<th style="text-align: left; width='150%'">
					<?php echo JText::_( 'Type' ); ?>
				</th>
				<th width="15%">
					 <?php echo JText::_( 'Product' );?>
				</th>
				<th width="20%">
					 <?php echo JText::_( 'Contact Name' );?>
				</th>					
				<th width="10%">
					 <?php echo JText::_( 'Start Date' );?>
				</th>
				<th width="10%">
					 <?php echo JText::_( 'End Date' );?>
				</th>	
				<th width="5%" style="text-align: left;">
					<?php echo JText::_( 'ID' ); ?>
				</th>	

			</tr>		
		</thead>
<?php
		$i		= 0;
		
		if (sizeof($events) == 0) {

?>			
		<tr>
			<td colspan="99">
				<?php  echo "NO EVENTS FOUND"; ?>
			</td>
		</tr>

<?php			
		}

		foreach($events as $event)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php  echo JHTML::_('grid.id', $i++, $event->getId()); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jtourney&controller=tournaments&task=edit&cid[]=' .$event->getId()  );
						echo JHTML::_('link', $link , $event->getName(), array('id' => $event->getId() )); 
					?>
				</td>
				<td>
					<?php echo $this->getPublish( $event , 'published'  );?>
				</td>
				<td class="tourney-type">
					<?php // echo JTUtil::getEventType($tournament->getType());?>
				</td>				
				<td class="tourney-product">
					<?php // echo $tournament->getProduct()->getName();?>
				</td>				
				<td class="tourney-contactname">
					<?php // echo $tournament->getContactName();?>
				</td>
				<td class="tourney-startdate">
					<?php // echo $tournament->getStartDate();?>
				</td>
				<td class="tourney-enddate">
					<?php // echo $tournament->getEndDate();?>
				</td>				
			
				<td><?php echo $event->getId(); ?>				
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
	<input type="hidden" name="view" value="teams" />
	<input type="hidden" name="option" value="com_jtourney" />
	<input type="hidden" name="controller" value="events"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
