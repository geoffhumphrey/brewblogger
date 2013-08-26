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
	<td class="dataHeadingList">PPG (Potential)</td>
	<td class="dataHeadingList">&nbsp;</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList" width="16" nowrap><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div></td>
	<?php } ?>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList" nowrap width="5%"><?php echo $row_sugar_type['sugarName']; ?></td>
	<td class="dataList" nowrap><?php echo $row_sugar_type['sugarPPG']; ?></td>
	<td class="data-icon_list"><a href="index.php?action=edit&dbTable=sugar_type&id=<?php echo $row_sugar_type['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_sugar_type['sugarName']; ?>" title="Edit <?php echo $row_sugar_type['sugarName']; ?>"></a></td>
  	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=sugar_type','id',<?php echo $row_sugar_type['id']; ?>,'Are you sure you want to delete this sugar type?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_sugar_type['sugarName']; ?>" title="Delete <?php echo $row_sugar_type['sugarName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_sugar_type = mysql_fetch_assoc($sugar_type)); ?>
</table>