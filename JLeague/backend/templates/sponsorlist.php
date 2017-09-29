<?php
/**
 * @version		$Id: sponsorlist.php 389 2012-02-12 11:40:19Z Chris Strieter $
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
	<form action="index.php?option=com_jleague" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
				<th width="30%" style="text-align: left;">
					<?php echo JLText::getText( 'Title' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Contact Name' ); ?>
				</th>
				<th>
					 <?php echo JLText::getText( 'Phone' );?>
				</th>						
				<th>
					 <?php echo JLText::getText( 'Email' );?>
				</th>
				<th>
					 <?php echo JLText::getText( 'Campaigns' );?>
				</th>									
			</tr>		
		</thead>
<?php
		$i		= 0;

		foreach($sponsors as $sponsor)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $sponsor->getId()); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=sponsors&task=edit&cid[]=' .$sponsor->getId() );
						echo JHTML::_('link', $link , $sponsor->getName(), array('id' => $sponsor->getId())); 
					
					?>
				</td>
				<td id="sponsor-contactname-<?php echo $sponsor->getId(); ?>">
					<?php echo $sponsor->getContactName();?>
				</td>
				<td id="sponsor-contactphone-<?php echo $sponsor->getId(); ?>">
					<?php echo $sponsor->getContactPhone(); ?>
				</td>
				<td id="sponsor-contactemail-<?php echo $sponsor->getId(); ?>">
					<?php echo $sponsor->getContactEmail(); ?>
				</td>	
				<td id="sponsor-contactemail-<?php echo $sponsor->getId(); ?>">
					<?php echo $sponsor->getNumberOfCampaigns(); ?>
				</td>								
			</tr>
<?php
		}
?>
		<tfoot>
		<tr>
			<td colspan="9">
				<?php  echo $pagination->getListFooter(); ?>
			</td>
		</tr>
		</tfoot>
	</table>
	<input type="hidden" name="view" value="sponsors" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="sponsors"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
