<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if  ($row_user['userLevel'] == "1")  include ('includes/list_add_link.inc.php'); 
if ($confirm == "true") { ?>
<table>
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">Theme Name</td>
	<td class="dataHeadingList">File Name</td>
	<td class="dataHeadingList">&nbsp;</td>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList" ><?php echo $row_theme['themeName']; ?></td>
	<td class="dataList" ><?php echo $row_theme['theme'];  ?></a></td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data_icon_list"><a href="index.php?action=edit&dbTable=brewingcss&id=<?php echo $row_theme['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_theme['themeName']; ?>" title="Edit <?php echo $row_theme['themeName']; ?>"></a></td>
  	<td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=brewingcss','id',<?php echo $row_theme['id']; ?>,'Are you sure you want to delete this theme?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_theme['themeName']; ?>" title="Delete <?php echo $row_theme['themeName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_theme = mysql_fetch_assoc($theme)); ?>
</table>