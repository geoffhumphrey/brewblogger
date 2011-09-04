<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data-icon"><img src="<?php echo $imageSrc; ?>clock.png" align="absmiddle"></span><span class="data"><?php if ($row_pref['mode'] == "2") echo $row_user2['realFirstName']."'s "; ?>Brew Status</span></div>
    <div id="sidebarInnerWrapper">
      	<table width="100%">
        <?php do { 
		echo "<tr><td class=\"listLeftAlign\">"; if ($row_status['id'] != $id) echo "<a href=\"index.php?page=brewBlogDetail&filter=".$row_status['brewBrewerID']."&id=".$row_status['id']."\">"; echo truncate_string($row_status['brewName'],25,'...'); if ($row_status['id'] != $id) echo "</a>"; echo "</td><td class=\"listRightAlign\">".$row_status['brewStatus']."</td></tr>\n";
		} while ($row_status = mysql_fetch_assoc($status));  ?>
		</table>
     </div>
</div>
