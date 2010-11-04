<div class="headerContentAdmin">Featured <?php echo $dbName; ?></div>
<table class="dataTable">
<tr>
<?php if (isset($_SESSION["loginUsername"])) echo "<td class=\"dataHeadingList\" width=\"1%\"><img src=\"".$imageSrc."pencil.png\" border=\"0\" align=\"absmiddle\"></td>"; ?>
  <?php if (!checkmobile()) { ?><td class="dataHeadingList" width="1%">XML</td><?php } ?>
  <td class="dataHeadingList" width="25%"><?php echo $dbName; ?>&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <?php if ($page == "brewBlogList") { ?><td class="dataHeadingList" width="10%">Date&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td><?php } ?>
  
  <td class="dataHeadingList" width="25%">Style&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <td class="dataHeadingList" width="10%">Method&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <td class="dataHeadingList" width="10%"><?php if ($row_pref['measColor'] == "EBC") echo "EBC"; else echo "SRM"; ?>/<?php if ($row_pref['measColor'] == "EBC") echo "SRM"; else echo "EBC";?>&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <td class="dataHeadingList" width="5%">IBU&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <td class="dataHeadingList" width="5%">ABV&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?>
  <td class="dataHeadingList">Contributor&nbsp;<img src="<?php echo $imageSrc; ?>spacer.gif" border="0" width="16" height="5"></td>
  <?php } ?>
  <td class="dataHeadingList center" width="1%"><img src="<?php echo $imageSrc; ?>medal_gold_3.png" border="0" alt="Awards/Competition Entires" align="baseline"></td>
</tr>
<?php do { ?>
	<?php 
	// Get brew style information for all listed styles
	mysql_select_db($database_brewing, $brewing);
	$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_featured['brewStyle']);
	$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
	$row_styles = mysql_fetch_assoc($styles);
	$totalRows_styles = mysql_num_rows($styles); 
	
	// Get real user names
	mysql_select_db($database_brewing, $brewing);
	$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_featured['brewBrewerID']);
	$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
	$row_user2 = mysql_fetch_assoc($user2);
	$totalRows_user2 = mysql_num_rows($user2);
	
	// Awards
	$awardNewID = "b".$row_featured['id'];
	mysql_select_db($database_brewing, $brewing);
	$query_awards2 = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
	$awards2 = mysql_query($query_awards2, $brewing) or die(mysql_error());
	$row_awards2 = mysql_fetch_assoc($awards2);
	$totalRows_awards2 = mysql_num_rows($awards2);
	?>
<tr <?php echo "style=\"background-color:$color\""; ?>>
<?php if (isset($_SESSION["loginUsername"])) { if (($row_user['userLevel'] == "1") || ($row_featured['brewBrewerID'] == $loginUsername)) echo "<td class=\"dataList\"><a href=\"admin/index.php?action=edit&dbTable=".$dbTable."&id=".$row_featured['id']."\"><img src=\"".$imageSrc."pencil.png\" alt=\"Edit ".$row_featured['brewName']."\" title=\"Edit ".$row_featured['brewName']."\" border=\"0\" align=\"absmiddle\"></a></td>"; else echo "<td>&nbsp;</td>"; } ?>
  <?php if (!checkmobile()) { ?><td class="dataList"><a href="#" onClick="window.open('includes/output_beer_xml.inc.php?id=<?php echo $row_featured['id']; ?>&source=<?php echo $source; ?>&brewStyle=<?php echo $row_featured['brewStyle']; ?>','','height=1,width=1, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc; ?>page_white_code.png" title="Download BeerXML" align="absmiddle" border="0" /></a><?php } ?>
  <td class="dataList"><a href="index.php?page=<?php echo $destination; ?>&filter=<?php echo $row_featured['brewBrewerID']; ?>&id=<?php echo $row_featured['id']; ?>"><?php echo $row_featured['brewName']; ?></a></td>
  <?php if ($page == "brewBlogList") { ?><td class="dataList" nowrap="nowrap"><?php $date = $row_featured['brewDate']; $realdate = dateconvert2($date,3); echo $realdate; ?></td><?php } ?>
	  <td class="dataList">
	  <div id="moreInfo"><?php if (($totalRows_styles > 0) && (!checkmobile())) { ?><a href="#"><?php } echo $row_featured['brewStyle']; if (($totalRows_styles > 0) && (!checkmobile())) { ?>
	  <span>
	  <div id="wideWrapper">
	  <?php include ('reference/styles.inc.php'); ?>
	  </div>
	  </span>
	  </a>
  <?php } ?>
	  </div>
	</td>
  	<td class="dataList"><?php if ($row_featured['brewMethod'] != "") { echo $row_featured['brewMethod']; } else echo "&nbsp;" ?></td>
  	<?php if (!checkmobile()) { ?>
    <td class="dataList">
		<?php if ($row_featured['brewLovibond'] != "") { ?>
		<?php include (INCLUDES.'color.inc.php'); ?>
		<?php include (INCLUDES.'color_display_featured.inc.php'); ?>
		<?php } else echo "&nbsp;"; ?>
   	</td>
	<?php } ?>
  	<td class="dataList"><?php if ($row_featured['brewBitterness'] != "") { echo round ($row_featured['brewBitterness'], 1); } else echo "&nbsp;" ?></td>
  	<td class="dataList"><?php if (($row_featured['brewOG'] != "") && ($row_featured['brewFG'] != "")) { include (INCLUDES.'abv.inc.php'); echo round ($abv_featured, 1)."%"; } else echo "&nbsp;"; ?></td>
  	<?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td  class="dataList"><a href="?page=brewBlogList&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $row_user2['user_name']; ?>&view=limited"><?php echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></a></td><?php } ?>
  	<td class="dataList center"><?php if ($totalRows_awards2 > 0) echo $totalRows_awards2; else echo "&nbsp;"; ?></td>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_featured = mysql_fetch_assoc($featured)); ?>
</table>