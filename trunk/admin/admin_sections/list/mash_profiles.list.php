<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php include (ADMIN_INCLUDES.'list_add_link.inc.php'); ?>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } // echo $_SESSION['loginUsername']."<br>"; ?>
<table class="dataTable">
<tr>
   <td class="dataHeadingList">Name</td>
   <td class="dataHeadingList">Grain Temp.</td>
   <td class="dataHeadingList">Tun Temp.</td>
   <td class="dataHeadingList">Sparge Temp.</td>
   <td class="dataHeadingList">Mash PH</td>
   <td class="dataHeadingList">Steps</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList">&nbsp;</td>
   <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php do {  
mysql_select_db($database_brewing, $brewing);
$query_mash_steps = sprintf("SELECT * FROM mash_steps WHERE stepMashProfileID = '%s'", $row_mash_profiles['id']);
$mash_steps = mysql_query($query_mash_steps, $brewing) or die(mysql_error());
$totalRows_mash_steps = mysql_num_rows($mash_steps);
?>
<tr <?php echo " style=\"background-color:$color\"";?>>
   <td class="dataList"><?php echo $row_mash_profiles['mashProfileName']; ?></td>
   <td class="dataList"><?php if ($row_mash_profiles['mashGrainTemp'] != "") { if (($row_pref['measTemp'] == "C") && ($row_mash_profiles['mashBrewerID'] == "brewblogger")) echo tempconvert($row_mash_profiles['mashGrainTemp'], "C"); else echo $row_mash_profiles['mashGrainTemp']; } ?>&deg; <?php echo $row_pref['measTemp']; ?></td>
   <td class="dataList"><?php if ($row_mash_profiles['mashTunTemp'] != "") { if (($row_pref['measTemp'] == "C") && ($row_mash_profiles['mashBrewerID'] == "brewblogger")) echo tempconvert($row_mash_profiles['mashTunTemp'], "C"); else echo $row_mash_profiles['mashTunTemp']; } ?>&deg; <?php echo $row_pref['measTemp'];  ?></td>
   <td class="dataList"><?php if ($row_mash_profiles['mashSpargeTemp'] != "") { if (($row_pref['measTemp'] == "C") && ($row_mash_profiles['mashBrewerID'] == "brewblogger")) echo tempconvert($row_mash_profiles['mashSpargeTemp'], "C"); else echo $row_mash_profiles['mashSpargeTemp']; }  ?>&deg; <?php echo $row_pref['measTemp']; ?></td>
   <td class="dataList"><?php echo $row_mash_profiles['mashPH']; ?>%</td>
   <td class="dataList"><?php if ($totalRows_mash_steps > 0) echo $totalRows_mash_steps; if ($totalRows_mash_steps == 0) echo "0"; ?></td>
   <td class="data_icon_list"><a href="index.php?action=view&dbTable=mash_steps&id=<?php echo $row_mash_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View <?php echo $row_mash_profiles['mashProfileName']; ?>" title="View <?php echo $row_mash_profiles['mashProfileName']; ?>"></a></td>
   <td class="data_icon_list"><a href="index.php?action=reuse&dbTable=mash_profiles&id=<?php echo $row_mash_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Copy the <?php echo $row_mash_profiles['mashProfileName']; ?> Mash Profile" title="Copy the <?php echo $row_mash_profiles['mashProfileName']; ?> Mash Profile"></a></td>
   <?php  if (($row_mash_profiles['mashBrewerID'] != "brewblogger") && (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername']))) { ?>
   <td class="data_icon_list"><a href="index.php?action=add&dbTable=mash_steps&id=<?php echo $row_mash_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add a Step to the <?php echo $row_mash_profiles['mashProfileName']; ?> Mash Profile" title="Add a Step to the <?php echo $row_mash_profiles['mashProfileName']; ?> Mash Profile"></a></td>
   <?php } 
   else { ?>
   <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>add_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <?php } ?>
   <?php if (($row_mash_profiles['mashBrewerID'] != "brewblogger") &&  (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername']))) { ?>
   <td class="data_icon_list"><?php if (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername'])) { ?><a href="index.php?action=edit&dbTable=mash_profiles&id=<?php echo $row_mash_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_mash_profiles['mashProfileName']; ?>" title="Edit <?php echo $row_mash_profiles['mashProfileName']; ?>"></a><?php } else echo "&nbsp;"; ?></td>
   <td class="data_icon_list"><?php if (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername'])) { ?><a href="javascript:DelWithCon('index.php?action=delete&dbTable=mash_profiles','id',<?php echo $row_mash_profiles['id']; ?>,'Are you sure you want to delete this mash profile? This cannot be undone.');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_mash_profiles['waterName']; ?>" title="Delete <?php echo $row_styles['mashProfileName']; ?>"></a><?php } else echo "&nbsp;"; ?></td>
   <?php } 
   else { ?>
   <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>pencil_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>bin_closed_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_mash_profiles = mysql_fetch_assoc($mash_profiles)); ?>
</table>