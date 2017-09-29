<div class="btn-season-dropdown">
      <div class="btn-group">
        <button id="season-select-btn" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Season <span class="caret"></span></button>
        <ul class="dropdown-menu" role="menu">
        <li><a href="javascript: getStandings(1,20);">2017</a></li>
        <li><a href="javascript: getStandings(1,18);">2016</a></li>
          <li><a href="javascript: getStandings(1,16);">2015</a></li>
          <li><a href="javascript: getStandings(1,14);">2014</a></li>
          <li><a href="javascript: getStandings(1,12);">2013</a></li>
          <li><a href="javascript: getStandings(1,9);">2012</a></li>
          <li><a href="javascript: getStandings(1,8);">2011</a></li>
          <li><a href="javascript: getStandings(1,6);">2010</a></li>
        </ul>
      </div>
<span id="standings-activity-image">&nbsp;</span>
</div>

	<div id="standings-wrapper">
	<?php
		echo $standingstable; 
	?>
	</div>
