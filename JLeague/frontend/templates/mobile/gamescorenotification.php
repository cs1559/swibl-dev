<p>
A league game score has been posted for a team you are associated with.   The game score is listed 
below:
</p>
<br/>
<table width="80%">
<tr>
<td><strong>ID:</strong><?php echo $game->getId(); ?></td>
<td><strong>Date:</strong><?php echo $game->getGameDate(); ?><br/><br/></td>
</tr>
<tr>
<td>(H) <?php echo $game->getHometeam(); ?></td><td><?php echo $game->getHometeamScore(); ?></td>
</tr>
<tr>
<td>(A) <?php echo $game->getAwayteam(); ?></td><td><?php echo $game->getAwayteamScore(); ?></td>
</tr>
</table>
<br/>
<p>
Please notify the league if there are any discrepancies with the score that has been posted.
</p>
<br/>
SWIBL <br/>
Email:  info@swibl-baseball.org<br/>
<br/>
