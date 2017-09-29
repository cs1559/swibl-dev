<?php
/**
 * @version		$Id: seasonslist.php 298 2011-11-20 13:00:20Z Chris Strieter $
 * @package 	GMapsPRO
 * @subpackage	Classes
 * @copyright 	(C) 2008,2009 Chris Strieter 
 * 				Firestorm Technologies, LLC
 * 				http://www.firestorm-technologies.com
 * @license 	http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 * 
 */


defined('_JEXEC') or die('Restricted access');

//$leagues = $this->getObject('leagues');
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
	<table class="adminlist" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php  echo count( $seasons ); ?>);" /></th>
				<th width="15%" style="text-align: left;">
					<?php echo JLText::getText( 'Title' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Description' ); ?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Active' );?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Published' );?>
				</th>
			</tr>		
		</thead>
<?php
		$i		= 0;
		
	//	foreach($this->leagues as $league)
		foreach($seasons as $season)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $season->id); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=seasons&task=edit&cid[]=' .$season->id  );
						echo JHTML::_('link', $link , $season->title, array('id' => $season->id )); 
					
					?>
				</td>
				<td id="season-description-<?php echo $season->id; ?>">
					<?php echo $season->description;?>
				</td>
				<td id="season-active-<?php echo $season->id; ?>">
					<?php //echo $season->description;?>
				</td>				
				<td id="published<?php echo $season->id;?>" align="center">
					<?php echo $this->getPublish( $season , 'published'  );?>
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
	<input type="hidden" name="view" value="seasons" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="seasons"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
