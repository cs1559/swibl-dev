<div id="registration-wrapper" style="height: 750px;">

	<div class="jleague-title">
	<h2>Online Registration - Select Season</h2>
	</div>

	<form name="registrationform-seasonselect" method="post" action="index.php">
	<br/>
	SWIBL registration is open for the following season.  Please select your season and click "Next".
	
	<?php
		$jstring =  'getRegistrationForm(this.value,' . $reg->getTeamId() . ');';
		$jstring = '';
		//echo JLHtml::getRegistrationOpenSeasonList('seasonid','',null,'onchange="' . $jstring . '"'); 
		echo mHtmlHelper::getRegistrationOpenSeasonRadio('seasonid', '', 'registrationOpenSelectList',false);
	?>
					
	<div id="entryform"></div>
		<input type="hidden" name="option" value="com_jleague"/>
		<input type="hidden" name="controller" value="registrations"/>
		<input type="hidden" name="task" value="displayForm"/>
		<input type="hidden" name="Itemid" value="999999999"/>
		<input type="hidden" name="teamid" value="<?php echo $reg->getTeamId();?>"/>
					
	</form>

</div>
