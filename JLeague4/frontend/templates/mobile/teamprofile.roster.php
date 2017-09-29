

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Player Information</h4>
      </div>
      <div class="modal-body">
			<div id="manageplayer-form">
			
				<form id="team-player-input-form" name="playerForm" method="post" role="form" action="index.php">
				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="playerfname">First Name:</label>
				  <div class="controls">
				    <input id="playerfname" name="playerfname" class="input-lg form-control" type="text" value="<?php isset($player) ? PRINT ($player->getFirstName()) :"";  ?>">
				   </div>
				</div>
				
				<div class="form-group">
				  <label class="col-sm-3 control-label" for="playerlname">Last Name:</label>
				  <div class="controls">
				    <input id="playerlname" name="playerlname" class="input-lg form-control" type="text" value="<?php isset($player) ? PRINT ($player->getLastName()) :"";  ?>">
				   </div>
				</div>
				
				<input type="hidden" name="option" value="com_jleague"/>
				<input type="hidden" name="controller" value="ajax"/>
				<input type="hidden" name="task" value="doSavePlayerToRoster"/>
				<input type="hidden" name="id" value="<?php isset($player) ? PRINT ($player->getId()) : 0; ?>"/>
				<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>
				<input type="hidden" name="seasonid" value="<?php echo $roster->getSeason(); ?>"/>
			
				</form>
				
			</div>
		</div>  <!-- /.modal-body -->
      <div class="modal-footer">
      	<span id="modal_status_message" class="pull-left"></span>
        <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>   -->
		<span><button type="button" class="btn btn-primary" aria-hidden="true" data-dismiss="modal">Close</button></span>
        <span><button type="button" class="btn btn-primary" onClick="javascript: savePlayerOnRoster(document.playerForm.id);">Save changes</button></span>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form class="button-form">
<fieldset>

<!-- Form Name -->
<legend><?php echo $team->getName(); ?> - Manage Rosters</legend>	

<div class="teamprofile-toolbar">

<?php $roster_locked = $config->getPropertyValue('rosters_locked');
//$roster_locked = true;
//if (!$config->getProperty('rosters_locked') || $ssvc->isAdmin()) { 
$ssvc = &JLSecurityService::getInstance();
	if (!$roster_locked || $ssvc->isAdmin()) {
?>
	<button type="button" class="btn btn-primary btn-xs" onClick="javascript:editPlayerOnRoster(0,<?php echo $team->getId();  ?>, <?php echo  $roster->getSeason(); ?>);">Add Player</button>
<?php 
	}
?> 
   <button id="cancelButton" 
    	name="cancelButton" 
    	class="btn btn-primary btn-xs"
    	formmethod="post"
    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&controller=teams&task=viewTeamProfile&teamid='. $team->getSlug()); ?>"
    	value="Return">Return to Profile</button>
    	
</div>

<div id="seasons-roster-table">
	<?php  echo $rostertable; ?>
</div>


</fieldset>
</form>
