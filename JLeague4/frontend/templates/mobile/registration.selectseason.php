
<script type="text/javascript">
	//<![CDATA[
	
		function validateSelectSeasonForm() {
			var form = document.seasonselectForm;
		    var cnt = -1;
		    btn = form.seasonid;
		    var btnSelected = false;

		    if (false) {
			    var i = 0;
		    	while (!btnSelected && i < btn.length) {
			        if (btn[i].checked) { 
				        btnSelected = true;
				        i++;
       			    }
		    	}
			} 

			if (btn.checked) {
				btnSelected = true;
			}
				
			
		    if (btnSelected) {
				form.submit();
		    } else {
		    	alert( "You must select a season to register for");
		    }
		}
		
	//]]>		
	</script>

<div id="registration-wrapper" style="height: 750px;">

	<div class="jleague-title">
		<h2>Online Registration - Select Season</h2>
	</div>

	<form name="seasonselectForm" method="post" action="index.php">
		<br /> SWIBL registration is open for the following season. Please
		select your season and click "Continue". <br /> <br />
		<?php
			$jstring =  'getRegistrationForm(this.value,' . $reg->getTeamId() . ');';
			$jstring = '';
			//echo JLHtml::getRegistrationOpenSeasonList('seasonid','',null,'onchange="' . $jstring . '"'); 
			echo mHtmlHelper::getRegistrationOpenSeasonRadio('seasonid', '', 'registrationOpenSelectList',false);
		?>
		
		<br /> <br /> <input type="button" value="Continue"
			onclick="validateSelectSeasonForm();" /> <input type="hidden"
			name="option" value="com_jleague" /> <input type="hidden"
			name="controller" value="registrations" /> <input type="hidden"
			name="task" value="displayform" /> <input type="hidden" name="teamid"
			value="<?php echo $reg->getTeamId(); ?>" /> <input type="hidden"
			name="Itemid" value="999999" />

		<div id="entryform"></div>

	</form>

</div>
