<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
	<tr>
		<td><?php if (($row_user['userLevel'] == "1") && ($totalRows_news > 0))  { echo "There "; if ($totalRows_news > 1 )  echo "are "; else echo "is ";  echo $totalRows_news; if ($totalRows_news > 1 ) echo " news items "; else echo " news item ";  echo "in the database.<br><br>"; }  else echo "There are no news entries found in the database."; ?></td>
		<td width="10%" nowrap><?php include ('includes/list_add_link.inc.php'); ?></td>
	</tr>
</table>
<?php if ($totalRows_news != 0) { ?>
<table>
 <tr>
  <td class="dataHeadingList">Date</td>
  <td class="dataHeadingList">Headline</td>
  <td class="dataHeadingList">Text</td>
  <td class="dataHeadingList">Posted By</td>
  <?php if  ($row_user['userLevel'] == "1") { ?>
  <td class="dataHeadingList">&nbsp;</td>
  <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
  <?php } ?>
 </tr>
 <?php do { ?>
 <tr <?php echo " style=\"background-color:$color\"";?>>
  <td class="dataList"><?php  $date = $row_news['newsDate']; $realdate = dateconvert2($date,3); echo $realdate; ?></td>
  <td class="dataList"><?php  echo $row_news['newsHeadline']; ?></td>
  <td class="dataList" ><?php $str = $row_news['newsText']; $truncate = Truncate2($str); echo $truncate; ?></td>
  <td class="dataList"><?php echo $row_news['newsPoster']; ?></td>
  <?php if  ($row_user['userLevel'] == "1") { ?>
  <td class="data_icon_list"><a href="index.php?action=edit&dbTable=news&id=<?php echo $row_news['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_news['newsHeadline']; ?>" title="Edit <?php echo $row_news['newsHeadline']; ?>"></a></td>
  <td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=news','id',<?php echo $row_news['id']; ?>,'Are you sure you want to delete this news item?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_news['newsHeadline']; ?>" title="Delete <?php echo $row_news['newsHeadline']; ?>"></a></td>
  <?php } ?>
  </tr>
  <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_news = mysql_fetch_assoc($news)); ?>
</table>
<?php } else { echo "There are no news items currently in the database."; if ($row_user['userLevel'] == "1") echo " <a href=\"index.php?action=add&dbTable=news\">Add a News Item?</a>"; } ?>
