<div id="standings-adspace">
	ads go here
</div>

<div id="standings-filter">
	<span id="standings-activity-image">&nbsp;</span><span id="standings-filter-season"><?php echo JLText::getText('JL_SEASON') . ": "; echo $filter; ?></span>
</div>
<div id="standings-note">
	<?php echo JLText::getText('JL_STANDINGS_NOTE'); ?>
</div>
<div id="standings-wrapper">
<?php
	echo $standingstable; 
?>
</div>