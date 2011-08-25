<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if ($row_user['userLevel'] == "1") include (ADMIN_INCLUDES.'list_add_link.inc.php'); ?>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">Display Name</td>
	<td class="dataHeadingList">URL (Web Address)</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList">&nbsp;</td>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } ?>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList" ><?php echo $row_links['brewerLinkName']; ?></td>
	<td class="dataList"><a href="<?php echo $row_links['brewerLinkURL']; ?>" target="_blank"><?php $str = $row_links['brewerLinkURL']; echo Truncate3($str); ?></a></td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data_icon_list"><a href="index.php?action=edit&dbTable=brewerlinks&id=<?php echo $row_links['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_links['brewerLinkName']; ?>" title="Edit <?php echo $row_links['brewerLinkName']; ?>"></a></td>
  	<td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=brewerlinks','id',<?php echo $row_links['id']; ?>,'Are you sure you want to delete this link?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_links['brewerLinkName']; ?>" title="Delete <?php echo $row_links['brewerLinkName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_links = mysql_fetch_assoc($links)); ?>
</table>