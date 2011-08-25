<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php include (ADMIN_INCLUDES.'list_add_link.inc.php'); ?>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">Name</td>
	<td class="dataHeadingList">Type</td>
	<td class="dataHeadingList">Use</td>
	<td class="dataHeadingList">Notes</td>
	<td class="dataHeadingList">&nbsp;</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList" width="16" nowrap><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div></td>
	<?php } ?>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList" nowrap><?php echo $row_misc['miscName']; ?></td>
	<td class="dataList" nowrap><?php echo $row_misc['miscType']; ?></td>
    <td class="dataList"><?php echo $row_misc['miscUse']; ?></td>
	<td class="dataList"><?php echo $row_misc['miscNotes']; ?></td>
	<td class="data_icon_list"><a href="index.php?action=edit&dbTable=misc&id=<?php echo $row_misc['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_misc['miscName']; ?>" title="Edit <?php echo $row_misc['miscName']; ?>"></a></td>
  	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=misc','id',<?php echo $row_misc['id']; ?>,'Are you sure you want to delete this grain?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_misc['miscName']; ?>" title="Delete <?php echo $row_misc['miscName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_misc = mysql_fetch_assoc($misc)); ?>
</table>