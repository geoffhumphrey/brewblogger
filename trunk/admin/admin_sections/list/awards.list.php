<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<table class="dataTable">
	<tr>
	<?php if ($row_pref['mode'] == "1") { ?>
		<td colspan="2"><?php if ($totalRows_awards > 0) { echo $row_user['realFirstName'].", there "; if ($totalRows_awards > 1 )  echo "are "; else echo "is ";  echo $totalRows_awards; if ($totalRows_awards > 1 ) echo " awards/contest entries "; else echo " award/contest entry "; if ($filter == "all") echo "in the database.<br><br>"; else echo "under ".$row_awards['brewBrewerID']."'s User ID.<br><br>"; } else echo "There are no awards/contest entries found in the database. To add an award or contest entry, access the <a href=\"index.php?action=list&dbTable=brewing\">".$row_pref['menuBrewBlogs']." list</a> or the <a href=\"index.php?action=list&dbTable=recipes\">".$row_pref['menuRecipes']." list</a> and click the medal icon. <img src=\"".$imageSrc."medal_gold_3.png\" align=\"absmiddle\"><br><br>"; ?></td>
	<?php } ?>
	<?php if ($row_pref['mode'] == "2") { ?>
		<td colspan="2"><?php if (($row_user['userLevel'] == "1") && ($totalRows_awards > 0))  { echo "There "; if ($totalRows_awards > 1 )  echo "are "; else echo "is ";  echo $totalRows_awards; if ($totalRows_awards > 1 ) echo " awards/contest entries "; else echo " award/contest entry ";  echo "in the database.<br><br>"; } elseif (($row_user['userLevel'] == "2") && ($totalRows_awards > 0)) { echo $row_user['realFirstName'].", there "; if ($totalRows_awards > 1 ) echo "are "; else echo "is ";  echo $totalRows_awards; if ($totalRows_awards > 1 ) echo " awards/contest entries "; else echo " award/contest entry "; echo  "in your personal database.<br><br>"; } else echo "There are no awards/contest entries found in the database. To add an award or contest entry, access the <a href=\"index.php?action=list&dbTable=brewing\">".$row_pref['menuBrewBlogs']." list</a> or the <a href=\"index.php?action=list&dbTable=recipes\">".$row_pref['menuRecipes']." list</a> and click the medal icon. <img src=\"".$imageSrc."medal_gold_3.png\" align=\"absmiddle\"><br><br>"; ?><td>
	<?php } ?>
	</tr>
</table>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<?php if ($totalRows_awards != 0) { ?>
<table class="dataTable">
 <tr>
  <td class="dataHeadingList">Brew Name</td>
  <td class="dataHeadingList">Competition</td>
  <td class="dataHeadingList">Date</td>
  <td class="dataHeadingList">Style</td>
  <td class="dataHeadingList">Source</td>
  <td class="dataHeadingList" colspan="2">Place</td>
  <?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
  <td class="dataHeadingList">Brewer ID</td>
  <?php } ?>
  <td class="dataHeadingList">&nbsp;</td>
  <td class="dataHeadingList">&nbsp;</td>
  <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
 </tr>
 <?php do { ?>
 <tr <?php echo " style=\"background-color:$color\"";?>>
  <td class="dataList"><?php echo $row_awards['awardBrewName']; ?></td>
  <td class="dataList"><?php if ($row_awards['awardContestURL'] != "") { ?><a href="<?php echo $row_awards['awardContestURL']; ?>" target="_blank"><?php } echo $row_awards['awardContest']; if ($row_awards['awardContestURL'] != "") { ?></a><?php } ?></td>
  <td nowrap="nowrap" class="dataList" ><?php  $date = $row_awards['awardDate']; $realdate = dateconvert2($date,3); echo $realdate; ?></td>
  <td class="dataList"><?php echo $row_awards['awardStyle']; ?></td>
  <td class="dataList"><?php $dbGo = rtrim($row_awards['awardBrewID'], "1234567890"); if ($dbGo == "r") echo $row_pref['menuRecipes']; else echo $row_pref['menuBrewBlogs'];  ?></td>
  <td class="data_icon_list"><img src="<?php echo $imageSrc; ?><?php if ($row_awards['awardPlace'] == "best") echo "award_star_gold_3.png"; elseif ($row_awards['awardPlace'] == "1") echo "medal_gold_3.png"; elseif ($row_awards['awardPlace'] == "2") echo "medal_silver_3.png"; elseif ($row_awards['awardPlace'] == "3") echo "medal_bronze_3.png"; elseif ($row_awards['awardPlace'] == "entry") echo "tag_blue.png";  else echo "star.png";  ?>" border="0"/></td>
  <td class="dataList" ><?php if ($row_awards['awardPlace'] == "best") echo "Best In Show"; elseif ($row_awards['awardPlace'] == "1") echo "1st (Gold)"; elseif ($row_awards['awardPlace'] == "2") echo "2nd (Silver)"; elseif ($row_awards['awardPlace'] == "3") echo "3rd (Bronze)"; elseif ($row_awards['awardPlace'] == "honMen") echo "Honorable Mention"; else echo "Entry Only"; ?></td>
  <?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
  <td class="dataList"><?php if ($filter == "all") { ?><a href="index.php?action=list&dbTable=awards&filter=<?php echo $row_awards['brewBrewerID']; ?>"><?php } echo $row_awards['brewBrewerID']; ?></a></td>
  <?php } ?>
  <td class="data_icon_list"><a href="../index.php?page=<?php $dbGo = rtrim($row_awards['awardBrewID'], "1234567890"); if ($dbGo == "r") echo "recipe"; else echo "brewBlog";  ?>Detail&filter=<?php echo $row_awards['brewBrewerID']; ?>&id=<?php $brewID = ltrim($row_awards['awardBrewID'], "rb"); echo $brewID; ?>"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View <?php echo $row_awards['awardBrewName']; ?>" title="View <?php echo $row_awards['awardBrewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="index.php?action=edit&dbTable=awards&assoc=<?php $dbGo = ltrim($row_awards['awardBrewID'], "1234567890"); if ($dbGo == "r") echo "recipes"; else echo "brewing";  ?>&id=<?php echo $row_awards['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_awards['awardBrewName']; ?>" title="Edit <?php echo $row_awards['awardBrewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=awards','id',<?php echo $row_awards['id']; ?>,'Are you sure you want to delete this award?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_awards['awardsBrewName']; ?>" title="Delete <?php echo $row_awards['awardsBrewName']; ?>"></a></td>
  </tr>
  <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_awards = mysql_fetch_assoc($awards)); ?>
</table>
<?php } else echo ""; ?>