<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php 
include (ADMIN_INCLUDES.'list_add_link.inc.php'); 
if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
   <td class="dataHeadingList">Lab</td>
   <td class="dataHeadingList">Name</td>
   <td class="dataHeadingList">ID</td>
   <td class="dataHeadingList">Type</td>
   <td class="dataHeadingList">Floc.</td>
   <td class="dataHeadingList">Atten.</td>
   <td class="dataHeadingList">Alc. Tol.</td>
   <td class="dataHeadingList">Temp. Range</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php do {  ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastLab']; ?></td>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastName']; ?></td>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastProdID']; ?></td>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastType']; ?></td>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastFloc']; ?></td>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastAtten']; ?>%</td>
   <td class="dataList"><?php echo $row_yeast_profiles['yeastTolerance']; ?></td>
   <td class="dataList"><?php if (($row_pref['measTemp'] == "C") && ($row_yeast_profiles['yeastBrewerID'] == "brewblogger")) { echo tempconvert($row_yeast_profiles['yeastMinTemp'], "C")."-"; echo tempconvert($row_yeast_profiles['yeastMaxTemp'], "C"); } else { echo $row_yeast_profiles['yeastMinTemp']."-".$row_yeast_profiles['yeastMaxTemp']; } ?>&deg; <?php echo $row_pref['measTemp']; ?></td>
   <td class="data-icon_list"><a href="index.php?action=reuse&dbTable=yeast_profiles&id=<?php echo $row_yeast_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Copy the <?php echo $row_yeast_profiles['yeastName']; ?> Yeast Profile" title="Copy the <?php echo $row_yeast_profiles['yeastName']; ?> Yeast Profile"></a></td>
   <?php if (($row_yeast_profiles['yeastBrewerID'] != "brewblogger") &&  (($row_user['userLevel'] == "1") || ($row_yeast_profiles['yeastBrewerID'] == $_SESSION['loginUsername']))) { ?>
   <td class="data-icon_list"><a href="index.php?action=edit&dbTable=yeast_profiles&id=<?php echo $row_yeast_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_yeast_profiles['yeastName']; ?>" title="Edit <?php echo $row_yeast_profiles['yeastName']; ?>"></a></td>
   <td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=yeast_profiles','id',<?php echo $row_yeast_profiles['id']; ?>,'Are you sure you want to delete this yeast profile? This cannot be undone.');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_yeast_profiles['yeastName']; ?>" title="Delete <?php echo $row_yeast_profiles['yeastName']; ?>"></a></td>
   <?php  
   } else { ?>
   <td class="data-icon_list"><img src="<?php echo $imageSrc; ?>pencil_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <td class="data-icon_list"><img src="<?php echo $imageSrc; ?>bin_closed_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <?php } ?> 
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_yeast_profiles = mysql_fetch_assoc($yeast_profiles)); ?>
</table>