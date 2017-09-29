<?php

	$task = $_REQUEST['task'];
	switch ($task) {
		case 'manageContacts':
			$function = "Manage Contacts";
			break;
		case 'manageRoster':
			$function = "Manage Roster";
			break;
		case 'manageschedule':
			$function = "Manage Schedule";
			break;						
		case 'uploadlogo':
			$function = "Upload Logo";
			break;					
		default:
			$function = 'Edit';
	}
?>

<div id="teamprofile-header" class="jleague-section-block">
<!-- <div id="teamprofile-abbr-logo">
		<img src="<?php echo $_config->getProperty('logo_folder') . "thumb-" . $team->getLogo();?>" height="48" width="48"/>
	</div>
-->
	<div id="teamprofile-abbr-info">
		<table class="width-100">
			<tr>
				<td><div id="teamprofile-info-teamname"><?php echo $team->getName(); ?> - <?php echo $function; ?></div>
				<td class="rightjust"><?php echo $submenu2; ?><?php //echo $submenu; ?></td>
			</tr>
		</table>
	</div>
</div>