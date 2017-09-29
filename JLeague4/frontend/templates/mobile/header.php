<?php
?>



    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?controller=controller&task=getPage&page=home">SWIBL</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li><a href="index.php?controller=controller&task=about">About</a></li>
              <li><a href="index.php?controller=controller&task=getPage&page=news">News</a></li>
              <li><a href="index.php?controller=controller&task=getPage&page=documents">Documents</a></li>
              <!--  <li><a href="index.php?controller=standings&task=viewStandings">Standings</a></li>  -->
          </ul>
		<form class="navbar-form navbar-right">
			<div class="form-group">
				<?php echo mHtmlHelper::getTeamQuickLinks("quicklink",null); ?>
			</div>
		</form>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    


