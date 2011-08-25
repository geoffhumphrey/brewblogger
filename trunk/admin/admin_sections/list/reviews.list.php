<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php include (ADMIN_INCLUDES.'list_add_link.inc.php'); ?>
<table class="dataTable">
	<?php if ($row_pref['mode'] == "1") { ?>
	<tr>
		<td colspan="2"><?php if ($totalRows_review > 0) { echo $row_user['realFirstName'].", there "; if ($totalRows_review > 1 )  echo "are "; else echo "is ";  echo $totalRows_review; if ($totalRows_review > 1 ) echo " reviews "; else echo " review "; if ($filter == "all") echo "in the database.<br><br>"; else echo "under ".$row_log['brewBrewerID']."'s User ID.<br><br>"; } else echo "There are no reviews found in the database.<br><br>";?></tr>
	<?php } ?>
	<?php if ($row_pref['mode'] == "2") { ?>
	<tr>
		<td colspan="2"><?php if (($row_user['userLevel'] == "1") && ($totalRows_review > 0))  { echo "There "; if ($totalRows_review > 1 )  echo "are "; else echo "is ";  echo $totalRows_review; if ($totalRows_review > 1 ) echo " reviews "; else echo " review ";  echo "in the database.<br><br>"; } elseif (($row_user['userLevel'] == "2") && ($totalRows_review > 0)) { echo $row_user['realFirstName'].", there "; if ($totalRows_review > 1 ) echo "are "; else echo "is ";  echo $totalRows_review; if ($totalRows_review > 1 ) echo " reviews "; else echo " reviews "; echo  "in your personal database.<br><br>"; } else echo "There are no reviews found in the database.<br><br>"; ?></td>
	</tr>
	<?php } ?>
</table>
<?php if ($confirm == "true") { ?>
<table>
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<?php if ($totalRows_review != "0") { ?>
<table>
<tr>
	<td class="dataHeadingList">Review For</td>
	<td class="dataHeadingList">Scored By</td>
    <td class="dataHeadingList">Date Added</td>
	<td class="dataHeadingList">Reviewer Role</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList">&nbsp;</td>
    <td class="dataHeadingList">&nbsp;</td>
    <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } ?>
</tr>
<?php do { 
mysql_select_db($database_brewing, $brewing);
$query_log_review = sprintf("SELECT * FROM brewing WHERE id = '%s'", $row_review['brewID']);
$log_review = mysql_query($query_log_review, $brewing) or die(mysql_error());
$row_log_review = mysql_fetch_assoc($log_review);
$totalRows_log_review = mysql_num_rows($log_review);
?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList"><?php if ($row_log_review ['brewName'] != "") echo $row_log_review['brewName']; else echo "<span class=\"red\"><em>BrewBlog has been Deleted</em></span>"; ?></td>
	<td class="dataList"><?php echo $row_review['brewScoredBy']; ?></td>
    <td class="dataList"><?php $date = $row_review['brewScoreDate']; $realdate = dateconvert($date,3); echo $realdate; ?></td>
	<td class="dataList"><?php echo $row_review['brewScorerLevel']; ?></td>
    <td class="data_icon_list"><a href="../index.php?page=brewBlogDetail&id=<?php echo $row_review['brewID'] ?>#tasting"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View the reviews for <?php echo $row_log_review['brewName'] ?>" title="View the reviews <?php echo $row_log_review['brewName'] ?>"></a></td>
	<td class="data_icon_list"><a href="index.php?action=edit&dbTable=reviews&id=<?php echo $row_review['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit This Review" title="Edit This Review"></a></td>
  	<td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=reviews','id',<?php echo $row_review['id']; ?>,'Are you sure you want to delete this review?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete this Review" title="Delete this Review"></a></td>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_review = mysql_fetch_assoc($review)); ?>
</table>
<?php } ?>