<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php include ('includes/list_add_link.inc.php'); ?>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">Name&nbsp;<a href="index.php?action=list&dbTable=malt&sort=maltName&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=malt&sort=maltName&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
	<td class="dataHeadingList">Color&nbsp;<a href="index.php?action=list&dbTable=malt&sort=maltLovibond&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=malt&sort=maltLovibond&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
	<td class="dataHeadingList">Information</td>
	<td class="dataHeadingList">PPG</td>
    <td class="dataHeadingList">Supplier</td>
    <td class="dataHeadingList">Origin</td>
	<td class="dataHeadingList">&nbsp;</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList" width="16" nowrap><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div></td>
	<?php } ?>
</tr>
<?php do { 
$query_sugar_type = sprintf("SELECT sugarPPG FROM sugar_type WHERE id=%s", $row_grains['maltYield']);
$sugar_type = mysql_query($query_sugar_type, $brewing) or die(mysql_error());
$row_sugar_type = mysql_fetch_assoc($sugar_type);
?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList" nowrap><?php echo $row_grains['maltName']; ?></td>
	<td class="dataList" nowrap><?php echo $row_grains['maltLovibond']; ?>&deg; L</td>
	<td class="dataList"><?php $str = $row_grains['maltInfo']; echo Truncate3($str); ?></td>
	<td class="dataList"><?php echo $row_sugar_type['sugarPPG']; ?></td>
    <td class="dataList"><?php echo $row_grains['maltSupplier']; ?></td>
    <td class="dataList"><?php echo $row_grains['maltOrigin']; ?></td>
	<td class="data_icon_list"><a href="index.php?action=edit&dbTable=malt&id=<?php echo $row_grains['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_grains['maltName']; ?>" title="Edit <?php echo $row_grains['maltName']; ?>"></a></td>
  	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=malt','id',<?php echo $row_grains['id']; ?>,'Are you sure you want to delete this grain?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_grains['maltName']; ?>" title="Delete <?php echo $row_grains['maltName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_grains = mysql_fetch_assoc($grains)); ?>
</table>