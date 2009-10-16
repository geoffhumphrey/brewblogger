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
	<td class="dataHeadingList">Name</td>
	<td class="dataHeadingList">Color</td>
    <td class="dataHeadingList">Fermentable Type</td>
    <td class="dataHeadingList">Information</td>
	<td class="dataHeadingList">PPG</td>
    <td class="dataHeadingList">Supplier</td>
    <td class="dataHeadingList">Origin</td>
	<td class="dataHeadingList">&nbsp;</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } ?>
</tr>
<?php do { 
$query_sugar_type = sprintf("SELECT sugarPPG FROM sugar_type WHERE id=%s", $row_extracts['extractYield']);
$sugar_type = mysql_query($query_sugar_type, $brewing) or die(mysql_error());
$row_sugar_type = mysql_fetch_assoc($sugar_type);
?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList"><?php echo $row_extracts['extractName']; ?></td>
	<td class="dataList"><?php echo $row_extracts['extractLovibond']; ?>&deg; L</td>
    <td class="dataList"><?php echo $row_extracts['extractType']; ?></td>
    <td class="dataList"><?php echo Truncate3($row_extracts['extractInfo']); ?></td>
	<td class="dataList"><?php echo $row_sugar_type['sugarPPG']; ?></td>
    <td class="dataList"><?php echo $row_extracts['extractSupplier']; ?></td>
    <td class="dataList"><?php echo $row_extracts['extractOrigin']; ?></td>
	<td class="data_icon_list"><a href="index.php?action=edit&dbTable=extract&id=<?php echo $row_extracts['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_extracts['extractName']; ?>" title="Edit <?php echo $row_extracts['extractName']; ?>"></a></td>
  	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=extract','id',<?php echo $row_extracts['id']; ?>,'Are you sure you want to delete this extract?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_grains['extractName']; ?>" title="Delete <?php echo $row_grains['extractName']; ?>"></a></td>
	<?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_extracts = mysql_fetch_assoc($extracts)); ?>
</table>