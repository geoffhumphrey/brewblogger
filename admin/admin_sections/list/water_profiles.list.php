<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php include (ADMIN_INCLUDES.'list_add_link.inc.php'); 
if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
   <td class="dataHeadingList" width="30%">Name</td>
   <td class="dataHeadingList" width="10%">Calicum</td>
   <td class="dataHeadingList" width="10%">Bicarbonate</td>
   <td class="dataHeadingList" width="10%">Sulfate</td>
   <td class="dataHeadingList" width="10%">Chloride</td>
   <td class="dataHeadingList" width="10%">Sodium</td>
   <td class="dataHeadingList" width="10%">Magnesium</td>
   <td class="dataHeadingList">PH</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php do {  ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
   <td class="dataList"><?php echo $row_water_profiles['waterName']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterCalcium']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterBicarbonate']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterSulfate']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterChloride']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterSodium']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterMagnesium']; ?></td>
   <td class="dataList"><?php echo $row_water_profiles['waterPH']; ?></td>
   <td class="data_icon_list"><a href="index.php?action=reuse&dbTable=water_profiles&id=<?php echo $row_water_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Copy the <?php echo $row_water_profiles['waterName']; ?> Water Profile" title="Copy the <?php echo $row_water_profiles['waterName']; ?> Water Profile"></a></td>
   <?php if (($row_water_profiles['waterBrewerID'] != "brewblogger") &&  (($row_user['userLevel'] == "1") || ($row_water_profiles['waterBrewerID'] == $_SESSION['loginUsername']))) { ?>
   <td class="data_icon_list"><a href="index.php?action=edit&dbTable=water_profiles&id=<?php echo $row_water_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_water_profiles['waterName']; ?>" title="Edit <?php echo $row_water_profiles['waterName']; ?>"></a></td>
   <td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=water_profiles','id',<?php echo $row_water_profiles['id']; ?>,'Are you sure you want to delete this water profile? This cannot be undone.');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_water_profiles['waterName']; ?>" title="Delete <?php echo $row_water_profiles['waterName']; ?>"></a></td>
   <?php } else { ?>
   <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>pencil_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>bin_closed_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_water_profiles = mysql_fetch_assoc($water_profiles)); ?>
</table>