<?php
/**
 * @version		$Id: gameslist.php 389 2012-02-12 11:40:19Z Chris Strieter $
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
	<table class="jl-admin-filter-row" width="100%">
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
				<th width="1%"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
				<th width="5%" style="text-align: left;">
					<?php echo JLText::getText( 'GameID' ); ?>
				</th>				
				<th width="15%" style="text-align: left;">
					<?php echo JLText::getText( 'Game Date' ); ?>
				</th>
				
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Hometeam' ); ?>
				</th>
				<th style="width: 30px; text-align: left;">
					<?php echo JLText::getText( 'Score' ); ?>
				</th>
				<th style="text-align: left;">
					<?php echo JLText::getText( 'Awayteam' ); ?>
				</th>
				<th style="width: 30px; text-align: left;">
					<?php echo JLText::getText( 'Score' ); ?>
				</th>
				<th style="width: 30px; text-align: left;">
					<?php echo JLText::getText( 'Conf?' ); ?>
				</th>
				
			</tr>		
		</thead>
<?php
		$i		= 0;
		
		foreach($rows as $game)
		{
?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo JHTML::_('grid.id', $i++, $game->id); ?></td>
				<td>
					<?php 
						$link		= JRoute::_( 'index.php?option=com_jleague&controller=games&task=edit&cid[]=' .$game->getId()  );
						echo JHTML::_('link', $link , $game->getId(), array('id' => $game->getId() )); 
					
					?>
				
					<?php // echo $game->getId();?>
				</td>
				
				<td>
					<?php echo $game->getGameDate();?>
				</td>
				<td >
					<?php echo $game->getHometeam();?>
				</td>
				
				<td >
					<?php echo $game->getHometeamScore();?>
				</td>
				<td >
					<?php echo $game->getAwayteam();?>
				</td>	
				<td >
					<?php echo $game->getAwayteamScore();?>
				</td>							
				<td >
					<?php echo $game->getConferenceGame();?>
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
	<input type="hidden" name="view" value="games" />
	<input type="hidden" name="option" value="com_jleague" />
	<input type="hidden" name="controller" value="games"/>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	</form>
