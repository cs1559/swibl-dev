<?php
/**
 * @version		$Id: registrationlist.php 448 2012-12-16 12:17:06Z cs1559 $
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
	<table class="jl-admin-filter-row" width="100%">
		<tr><td style="text-align: right;">
			<?php  echo JLText::getText( 'Season Filter'); ?>
			<?php  echo JLHtml::getSeasonSelectList('filter_season',$filter_season,true,'onchange="document.adminForm.filter_divisionid.value=0; document.adminForm.submit();"'); ?>
			<?php  echo JLText::getText( 'Division Filter'); ?>
			<?php  echo JLHtml::getDivisionSelectList('filter_divisionid',$filter_divisionid,$filter_season,true,'onchange="document.adminForm.submit();"'); ?>
			</td>
		</tr>
		
	</table>	
	<table class="table table-striped" cellspacing="1">
		<thead>
			<tr class="title">
				<th width="1%"><?php echo JLText::getText( 'Num' ); ?></th>
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Reg #' ); ?>
				</th>				
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Team Name' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Name' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Phone' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Season' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Age Group' ); ?>
				</th>				
				<th>
					 <?php echo JLText::getText( 'Division' );?>
				</th>
				<th>
					 <?php echo JLText::getText( 'Returning' );?>
				</th>
				
				<th>
					 <?php echo JLText::getText( 'Published' );?>
				</th>
				<th>
					 <?php echo JLText::getText( 'Paid' );?>
				</th>
				<th>
					 <?php echo JLText::getText( 'Registration Date' );?>
				</th>				
								
			</tr>		
		</thead>
<?php
		$i		= 0;
		
		foreach($registrations as $registration)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $registration->getId()); ?></td>
				<td class="jl-center"><?php echo $registration->getId(); ?>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=registrations&task=edit&cid[]=' .$registration->getId()  );
						echo JHTML::_('link', $link , $registration->getTeamName(), array('id' => $registration->getId() ));
//						echo $registration->getTeamName(); 
					
					?>
				</td>
				<td >
					<?php echo $registration->getName();?>
				</td>
				<td class="jl-center">
					<?php echo $registration->getPhone();?>
				</td>														
				<td >
					<?php echo $registration->getSeasonTitle();?>
				</td>
				<td class="jl-center">
					<?php echo $registration->getAgeGroup();?>
				</td>								
				<td >
					<?php echo $registration->getDivisionName();?>
				</td>
				<td class="jl-center">
					<?php 
						echo JLUtil::convertToYesNo($registration->getExistingTeam()); 
					?>
				</td>								
				<td class="jl-center">
					<?php 
						echo $this->getPublish( $registration , 'published'  );
					?>
				</td>
				<td class="jl-center">
					<?php echo $_view->getPaid($registration); ?>
				</td>
				<td class="jl-center">
					<?php echo $registration->getRegistrationDate(); ?>				
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
	<input type="hidden" name="view" value="registration" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="registrations"/>
	<input type="hidden" name="task" value="display" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
