<script>
function changeLandingPage() {
	// landingpage-value
	landingpage = document.getElementById("landingpage-type");
	selectlistvalue = document.getElementById("landingpage-value");
	if (landingpage.value == 'STANDINGS') {
		selectlistvalue.options[0].selected = true;
	}
}
</script>

<div id="userpreferences-status"></div>
<h1>User Preferences</h1>
<p>
Use this page to specify specific preferences to enhance your experience on the website.
</p>
<form id="userpreferences-form" action="index.php" method="post">
<table>
	<tr>
		<td>Landing Page:</td>
		<td><?php echo $_view->getLandingPageList('landingpage-type',$prefs->getPropertyValue('landingpage-type'),'onchange="changeLandingPage();"');?></td>
		<td>Value:</td>
		<td><?php echo $_view->getTeamList('landingpage-value',$prefs->getPropertyValue('landingpage-value'));?></td>  
	</tr>
</table>
<br/><br/>
<input type="button" value="Save" onclick="updateUserPreferences(document.userpreferences-form);"/>
<input type="submit" value="Cancel"/>	
</form>

