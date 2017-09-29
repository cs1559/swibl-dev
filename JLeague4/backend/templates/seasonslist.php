<?php
/**
 * @version		$Id: seasonslist.php 389 2012-02-12 11:40:19Z Chris Strieter $
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
	if (pressbutton == 'closeSeason') {
		if (confirm("Are you sure you wish to close the selected season?")) {
			submitform( pressbutton );
			return;
		}
	}

	submitform(action);
}

</script>
	<form action="index.php" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
				<th width="15%" style="text-align: left;">
					<?php echo JLText::getText( 'Title' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Description' ); ?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Status' );?>
				</th>						
				<th width="5%">
					 <?php echo JLText::getText( 'Active' );?>
				</th>				
				<th width="5%">
					 <?php echo JLText::getText( 'Registration Open' );?>
				</th>
				<th width="5%">
					 <?php echo JLText::getText( 'Published' );?>
				</th>
			</tr>		
		</thead>
<?php
		$i		= 0;
		
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
				<td id="season-description-<?php echo $season->id; ?>" >
					<?php echo $season->description;?>
				</td>
				<td id="season-status-<?php echo $season->id; ?>">
					<?php echo $season->getStatus();?>
				</td>
				<td id="season-active" class="jl-center">
					<?php 
						if ($season->isActive()) {
							echo "Yes";
						} else {
							echo "No";
						}
					?>
				</td>				
				<td id="season-registrationopen" class="jl-center">
					<?php 
						if ($season->isRegistrationOpen()) {
							echo "Yes";
						} else {
							echo "No";
						}
					?>
				</td>				
				<td id="published<?php echo $season->id;?>" class="jl-center">
					<?php echo $this->getPublish( $season , 'published'  );?>
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
	<input type="hidden" name="view" value="seasons" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="seasons"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
