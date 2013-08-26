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
	<td class="dataHeadingList">Name&nbsp;<a href="index.php?action=list&dbTable=hops&sort=hopsName&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=hops&sort=hopsName&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
	<td class="dataHeadingList">Country&nbsp;<a href="index.php?action=list&dbTable=hops&sort=hopsGrown&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=hops&sort=hopsGrown&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
	<td class="dataHeadingList">Example</td>
	<td class="dataHeadingList">AAU Range&nbsp;<a href="index.php?action=list&dbTable=hops&sort=hopsAAULow&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=hops&sort=hopsAAULow&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
	<td class="dataHeadingList">Substitute</td>
	<?php if  ($row_user['userLevel'] =="2") { ?>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } else { ?>
	<td class="dataHeadingList">&nbsp;</td>
	<?php } ?>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } ?>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList"><?php echo $row_hops['hopsName']; ?></td>
	<td class="dataList"><?php echo $row_hops['hopsGrown']; ?></td>
	<td class="dataList"><?php echo $row_hops['hopsExample']; ?></td>
	<td class="dataList" ><?php echo $row_hops['hopsAAULow']."-".$row_hops['hopsAAUHigh']."%"; ?></td>
    <td class="dataList"><?php echo $row_hops['hopsSub']; ?></td>
	<td class="data-icon_list"><a href="index.php?action=edit&dbTable=hops&id=<?php echo $row_hops['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_hops['hopsName']; ?>" title="Edit <?php echo $row_hops['hopsName']; ?>"></a></td>
  	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=hops','id',<?php echo $row_hops['id']; ?>,'Are you sure you want to delete this hop?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_hops['hopsName']; ?>" title="Delete <?php echo $row_hops['hopsName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_hops = mysql_fetch_assoc($hops)); ?>
</table>
