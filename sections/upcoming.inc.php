<?php 
if ($row_upcoming['upcoming'] !="") { 
if ($row_pref['mode'] == "2") { 
	  	mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		}
?>
<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data-icon"><img src="<?php echo $imageSrc; ?>time.png" align="absmiddle"></span><span class="data"><?php if ($row_pref['mode'] == "2") echo $row_user2['realFirstName']."'s "; ?>Upcoming Brews</span></div>
    <div id="sidebarInnerWrapper" >
      <table>
	  <?php  
	  do { 
	    // Get brewer ids
			mysql_select_db($database_brewing, $brewing);
			$query_brewerID = sprintf("SELECT * FROM recipes WHERE id = '%s'", $row_upcoming['upcomingRecipeID']);
			$brewerID = mysql_query($query_brewerID, $brewing) or die(mysql_error());
			$row_brewerID = mysql_fetch_assoc($brewerID);
			$totalRows_brewerID = mysql_num_rows($brewerID);
	  ?>
		  <tr>
    	     <td class="listLeftAlign"><?php if ($row_upcoming['upcomingRecipeID'] != "") { ?><a href="index.php?page=recipeDetail&filter=<?php echo $row_brewerID['brewBrewerID']; ?>&id=<?php echo $row_upcoming['upcomingRecipeID']; ?>"><?php } echo truncate_string($row_upcoming['upcoming'],25,'...'); if ($row_upcoming['upcomingRecipeID'] != "") echo "</a>"; ?></td>
			 <td class="listRightAlign"><?php if ($row_upcoming['upcomingDate'] != "")  { $date = $row_upcoming['upcomingDate']; $realdate = dateconvert($date,3); echo $realdate; } else echo "&nbsp;"; ?></td>
		  </tr>
	  <?php } while ($row_upcoming = mysql_fetch_assoc($upcoming)); ?>
	  </table>
     </div>
</div>
<?php } ?>

