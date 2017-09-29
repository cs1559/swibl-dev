<?php
/**
 * @version		$Id: divisionlist.php 298 2011-11-20 13:00:20Z Chris Strieter $
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
			<?php echo JLText::getText( 'Season Filter'); ?>
			<?php echo JLHtml::getSeasonSelectList('filter_season',$filter_season,true,'onchange="document.adminForm.submit();"'); ?>
			</td>
		</tr>
	</table>	
	<table class="adminlist" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php  echo count( $divisions ); ?>);" /></th>
				<th width="15%" style="text-align: left;">
					<?php echo JLText::getText( 'Name' ); ?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Age Group' );?>
				</th>				
				<th style="text-align: left; width='20%'">
					<?php echo JLText::getText( 'League' ); ?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Season' );?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Published' );?>
				</th>
			</tr>		
		</thead>
<?php
		$i		= 0;
		
	//	foreach($this->leagues as $league)
		foreach($divisions as $division)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $division->id); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=divisions&task=edit&cid[]=' .$division->id  );
						echo JHTML::_('link', $link , $division->name, array('id' => $division->id )); 
					
					?>
				</td>
				<td class="division-agegroup">
					<?php echo $division->getAgeGroup();?>
				</td>				
				<td id="division-league-<?php echo $division->id; ?>">
					<?php echo $division->getLeague()->getName();?>
				</td>				
				<td id="division-season-<?php echo $division->id; ?>">
					<?php echo $division->getSeason()->getTitle();?>
				</td>
				<td id="published<?php echo $division->id;?>" align="center">
					<?php echo $this->getPublish( $division , 'published'  );?>
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
	<input type="hidden" name="view" value="divisions" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="divisions"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
