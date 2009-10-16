<?php 
		mysql_select_db($database_brewing, $brewing);
		$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_awardsList['brewStyle']);
		$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
		$row_styles = mysql_fetch_assoc($styles);
		$totalRows_styles = mysql_num_rows($styles);
		?>
		<div id="contentWide">
		<?php
		 
		if ($total == 0) 
		{ ?>
		<table class="dataTable">
            <tr>
			<td class="dataHeadingList">There are currently no awards/competition entries in the database <?php if ($filter != "all") echo "for this member"; ?>.<br><br></td>
			</tr>
		</table>
		</div>
		<?php } else { ?>
		<table class="dataTable">
            <tr>
           <?php if (isset($_SESSION["loginUsername"])) echo "<td class=\"dataList\"><img src=\"".$imageSrc."pencil.png\" border=\"0\" align=\"absmiddle\"></td>"; ?>
              <td class="dataHeadingList">Entered Name&nbsp;<a href="?page=awardsList&sort=awardBrewName&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=awardsList&sort=awardBrewName&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td>
              <td class="dataHeadingList">Style&nbsp;<a href="?page=awardsList&sort=awardStyle&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=awardsList&sort=awardStyle&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td>
              <td class="dataHeadingList">Competition&nbsp;<a href="?page=awardsList&sort=awardContest&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=awardsList&sort=awardContest&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td>
              <td class="dataHeadingList">Date&nbsp;<a href="?page=awardsList&sort=awardDate&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=awardsList&sort=awardDate&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td>
              <td class="dataHeadingList" colspan="2">Place&nbsp;<a href="?page=awardsList&sort=awardPlace&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=awardsList&sort=awardPlace&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td>
              <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td class="dataHeadingList">Brewer&nbsp;<a href="?page=awardsList&sort=brewBrewerID&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=awardsList&sort=brewBrewerID&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td><?php } ?>	
            </tr>
            <?php do { ?>
			<?php 
			// Get brew style information for all listed styles
			mysql_select_db($database_brewing, $brewing);
			$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_awardsList['awardStyle']);
			$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
			$row_styles = mysql_fetch_assoc($styles);
			$totalRows_styles = mysql_num_rows($styles);
			// Get real user names
			mysql_select_db($database_brewing, $brewing);
			$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_awardsList['brewBrewerID']);
			$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
			$row_user2 = mysql_fetch_assoc($user2);
			$totalRows_user2 = mysql_num_rows($user2);
					
			?>
            <tr <?php echo "style=\"background-color:$color\""; ?>>
            <?php if (isset($_SESSION["loginUsername"])) { if (($row_user['userLevel'] == "1") || ($row_recipeList['brewBrewerID'] == $loginUsername)) echo "<td class=\"dataList\"><a href=\"admin/index.php?action=edit&dbTable=awards&id=".$row_awardsList['id']."\"><img src=\"".$imageSrc."pencil.png\" alt=\"Edit ".$row_awardsList['awardBrewName']."\" title=\"Edit ".$row_awardsList['awardBrewName']."\" border=\"0\" align=\"absmiddle\"></a></td>"; else echo "<td>&nbsp;</td>"; } ?>
              <td class="dataList"><a href="index.php?page=<?php $dbGo = rtrim($row_awardsList['awardBrewID'], "0123456789"); if ($dbGo == "r") echo "recipe"; else echo "brewBlog";  ?>Detail&filter=<?php echo $row_awardsList['brewBrewerID']; ?>&id=<?php $brewID = ltrim ($row_awardsList['awardBrewID'], "rb"); echo $brewID; ?>"><?php echo $row_awardsList['awardBrewName']; ?></a></td>
              <td class="dataList">
			  <div id="moreInfo"><a href="#"><?php echo $row_awardsList['awardStyle']; ?>
			  <span>
			  <div id="wideWrapper">
			  <?php include ('reference/styles.inc.php'); ?>
			  </div>
			  </span>
			  </a>
			  </div>
			  </td>
              <td class="dataListLeft"><?php if ($row_awardsList['awardContestURL'] != "") { ?><a href="<?php echo $row_awardsList['awardContestURL']; ?>" target="_blank"><?php } echo $row_awardsList['awardContest']; if ($row_awardsList['awardContestURL'] != "") { ?></a><?php } ?></td>
              <td class="dataList" nowrap="nowrap"><?php  $date = $row_awardsList['awardDate']; $realdate = dateconvert2($date,3); echo $realdate; ?></td>
			  <td class="dataList" width="16"><img src="<?php echo $imageSrc; ?><?php if ($row_awardsList['awardPlace'] == "best") echo "award_star_gold_3.png"; elseif ($row_awardsList['awardPlace'] == "1") echo "medal_gold_3.png"; elseif ($row_awardsList['awardPlace'] == "2") echo "medal_silver_3.png"; elseif ($row_awardsList['awardPlace'] == "3") echo "medal_bronze_3.png"; elseif ($row_awardsList['awardPlace'] == "entry") echo "tag_blue.png";  else echo "star.png";  ?>" border="0"/></td>
			  <td class="dataList" nowrap="nowrap"><?php if ($row_awardsList['awardPlace'] == "best") echo "Best In Show"; elseif ($row_awardsList['awardPlace'] == "1") echo "1st (Gold)"; elseif ($row_awardsList['awardPlace'] == "2") echo "2nd (Silver)"; elseif ($row_awardsList['awardPlace'] == "3") echo "3rd (Bronze)"; elseif ($row_awardsList['awardPlace'] == "honMen") echo "Honorable Mention"; else echo "Entry Only"; ?></td>
              <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td  class="dataList"><a href="?page=awardsList&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $row_user2['user_name']; ?>&view=limited"><?php echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></a></td><?php } ?>
            </tr>
            <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
            <?php } while ($row_awardsList = mysql_fetch_assoc($awardsList)); ?>
			<tr>
			<td colspan="<?php if ($filter != "default") echo "8"; else echo "7"; ?>"><div id="paginate"><?php echo $total." Total Awards/Competition Entries"; if ($total > $display) echo "&nbsp;&nbsp;&nbsp;&#8226"; if ($view == "all") echo "&nbsp;&nbsp;&nbsp&#8226;&nbsp;&nbsp;&nbsp;"; if ($total > $display) { echo "&nbsp;&nbsp;&nbsp;"; paginate($display, $pg, $total);  if ($view == "limited") { ?>&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;<a href="">Entire List of <?php if ($filter != "all") echo $row_user2['realFirstName']."'s "; if (($row_pref['mode'] == "2") && ($filter == "all")) echo "Club&nbsp;"; ?>Awards/Competition Entries</span></a><?php } } if ($view == "all") { ?><a href="">Limited List of <?php if (($row_pref['mode'] == "2") && ($filter != "all")) echo $row_user2['realFirstName']."'s "; if (($row_pref['mode'] == "2") && ($filter == "all")) echo "Club&nbsp;"; ?>Award/Competition Entries</a><?php } ?></div></td>
			</tr>
          </table>
		  </div>
		<?php }  ?>
