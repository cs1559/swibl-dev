
<div id="admindashboard">

	<h1>Administrative Dashboard</h1>

	<form name="dashboardform">
	Select the desired view:  <?php echo JLHtml::getDashboardViews("viewname","summary"); ?>
		<input type="button" name="goto_view" value="Go"/ onClick="getAdminView(document.dashboardform.viewname);">
		<span id="status-message"></span>
	</form>
	
	<div id="admindashboard-content">
		<?php echo $dashboardcontent; ?>
	</div>
	
</div>


