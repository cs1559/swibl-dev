<?php
/**
 * @version		$Id: leaguelist.php 389 2012-02-12 11:40:19Z Chris Strieter $
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
 
function Joomla.submitbutton(action)
{
		submitform(action);
}

</script>
	<form action="index.php?option=com_jleague" method="post" id="adminForm" name="adminForm">
	
	<table class="table table-striped" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this);" /></th>
				<th width="15%" style="text-align: left;">
					<?php echo JLText::getText( 'Name' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'League Description' ); ?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Published' );?>
				</th>
			</tr>		
		</thead>
<?php
		$i		= 0;
		
	//	foreach($this->leagues as $league)
		foreach($leagues as $league)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $league->id); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=leagues&task=edit&cid[]=' .$league->id  );
						echo JHTML::_('link', $link , $league->name, array('id' => $league->id )); 
					
					?>
				</td>
				<td id="league-description-<?php echo $league->id; ?>">
					<?php echo $league->description;?>
				</td>
				<td id="published<?php echo $league->id;?>" class="jl-center">
					<?php echo $this->getPublish( $league , 'published'  );?>
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
	<input type="hidden" name="view" value="leagues" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="leagues"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
