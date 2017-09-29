<?php
?>

<div class="" >

<form name="form-inline editprofile" method="post" role="form" action="index.php">
<fieldset>

<!-- Form Name -->
<legend><?php echo $team->getName(); ?> - Edit Team Profile</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="teamid">Team Id:</label>
  <div class="controls">
  <?php 
  $ssvc = &JLSecurityService::getInstance();
  if ($ssvc->isAdmin()) { 
  	$editname = "";
  } else {
  	$editname = "readonly";
  }
  ?>
    <input id="teamid" name="teamid" placeholder="<?php echo $team->getId(); ?>" class="input-sm form-control" type="text" value="<?php echo $team->getId(); ?>" readonly>
   </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="teamname">Team Name:</label>
  <div class="controls">
    <input id="teamname" name="teamname" placeholder="" class="input-lg form-control" required="" type="text" value="<?php echo $team->getName(); ?>" <?php echo $editname;?>>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="city">City</label>
  <div class="controls">
    <input id="city" name="city" placeholder="" class="input-sm form-control" type="text" value="<?php echo $team->getCity(); ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="state">State</label>
  <div class="controls">
    <input id="state" name="state" placeholder="" class="input-sm form-control" required="" type="text" value="<?php echo $team->getState(); ?>">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="website">Website</label>
  <div class="controls">
    <input id="website" name="website" placeholder="" class="input-lg form-control" type="text" value="<?php echo $team->getWebsite(); ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="coachname">Coach Name</label>
  <div class="controls">
    <input id="coachname" name="coachname" placeholder="" class="input-med form-control" required="" type="text"  value="<?php echo $team->getCoachName(); ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="coachemail">Coach Email</label>
  <div class="controls">
    <input id="coachemail" name="coachemail" placeholder="" class="input-lg form-control" required="" type="text"  value="<?php echo $team->getCoachEmail(); ?>">
    <span class="help-block col-sm-offset-3">NOTE:  Please ony enter ONE email address</span>    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="coachphone">Coach Phone</label>
  <div class="controls">
    <input id="coachphone" name="coachphone" placeholder="" class="input-med form-control" required="" type="text"  value="<?php echo $team->getCoachPhone(); ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-sm-3 control-label" for="ownerid">Owner</label>
  <div class="controls">
		<?php echo mHtmlHelper::getTeamOwnerSelectList("ownerid", $team->getOwnerId(),"select-ownerlist form-control"); ?>
  </div>
</div>

<?php  
	foreach ($team->getCustomFields() as $fld) {
?>
<div class="form-group">
	<label class="col-sm-3 control-label" for="customfield<?php echo $fld->getId(); ?>"><?php echo $fld->getName(); ?></label>
	<div class="controls">
		  <?php 
			if ($fld->isEditable()) {
				switch ($fld->getType()) {
					case 500:  
						echo mHtmlHelper::getClassification($fld->getKeycode(), $fld->getValue(), "customfield" . $fld->getId());
						break;
					default:
						?>
						<input id="customfield<?php echo $fld->getId(); ?>" name="<?php echo $fld->getKeycode(); ?>" class="input-lg  form-control" type="text" value="<?php echo $fld->getValue(); ?>">
						<?php 
				}
			} else {
?>
	<input id="customfield<?php echo $fld->getId(); ?>" type="hidden" name="<?php echo $fld->getKeycode(); ?>" value="<?php echo $fld->getValue(); ?>"/> <?php echo $fld->getValue();?>
<?php 
			}
?>
	</div>
</div>
<?php
	}
 ?>	


<!-- Button (Double) -->
<div class="control-group">
  <div class="controls">
    <button id="saveButton" 
    	name="saveButton" 
    	class="btn btn-success"
    	formmethod="post"
    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&amp;controller=teams&amp;task=doUpdate&amp;teamid='. $team->getSlug()); ?>"
    	value="Save">Save</button>
    <button id="cancelButton" 
    	name="cancelButton" 
    	class="btn btn-danger"
    	formmethod="post"
    	formaction="<?php echo mRouter::translateUrl('index.php?option=com_jleague&amp;controller=teams&amp;task=viewTeamProfile&amp;teamid='. $team->getSlug()); ?>"
    	value="Cancel">Cancel</button>
  </div>
</div>

	<input type="hidden" name="teamid" value="<?php echo $team->getId();?>"/>

	</fieldset>
</form>


</div>
