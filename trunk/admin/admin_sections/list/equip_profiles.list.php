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
	<td colspan="8">&nbsp;</td>
	<td class="dataHeadingList" width="1%">&nbsp;</td>
    <td class="dataHeadingList" width="1%">&nbsp;</td>
   	<td class="dataHeadingList" width="1%"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php do {  ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
   	<td class="data" colspan="8"><h3><?php echo $row_equip_profiles['equipProfileName']; ?></h3></td>
    <td class="data-icon_list"><a href="index.php?action=reuse&dbTable=equip_profiles&id=<?php echo $row_equip_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Copy the <?php echo $row_equip_profiles['equipProfileName']; ?> Equipment Profile" title="Copy the <?php echo $row_equip_profiles['equipProfileName']; ?> Equipment Profile"></a></td>
    <?php if (($row_equip_profiles['equipBrewerID'] != "brewblogger") &&  (($row_user['userLevel'] == "1") || ($row_equip_profiles['equipBrewerID'] == $_SESSION['loginUsername']))) { ?>
    <td class="data-icon_list"><a href="index.php?action=edit&dbTable=equip_profiles&id=<?php echo $row_equip_profiles['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_equip_profiles['equipProfileName']; ?>" title="Edit <?php echo $row_equip_profiles['equipProfileName']; ?>"></a></td>
   	<td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=equip_profiles','id',<?php echo $row_equip_profiles['id']; ?>,'Are you sure you want to delete this equipment profile? This cannot be undone.');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_equip_profiles['equipProfileName']; ?>" title="Delete <?php echo $row_equip_profiles['equipProfileName']; ?>"></a></td>
   	<?php } else { ?>
   	<td class="data-icon_list"><img src="<?php echo $imageSrc; ?>pencil_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
    <td class="data-icon_list"><img src="<?php echo $imageSrc; ?>bin_closed_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   	<?php } ?>
</tr>
<tr <?php echo " style=\"background-color:$color\"";?>>
  	<td class="dataLabel">Batch Size:</td>
   	<td class="data" width="15%" nowrap="nowrap"><?php if (($row_equip_profiles['equipBatchSize'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipBatchSize'], "liters"); else echo $row_equip_profiles['equipBatchSize']; echo " ".$row_pref['measFluid2']; ?></td>
   	<td class="dataLabel">Boil Vol.:</td>
    <td class="data" width="10%" nowrap="nowrap"><?php if (($row_equip_profiles['equipBoilVolume'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipBoilVolume'], "liters"); else echo $row_equip_profiles['equipBoilVolume']; echo " ".$row_pref['measFluid2']; ?></td>
   	<td class="dataLabel">Evap. Rate:</td>
    <td class="data" width="15%" nowrap="nowrap"><?php if ($row_equip_profiles['equipEvapRate'] != "") echo $row_equip_profiles['equipEvapRate']."% per hour"; ?></td>
   	<td class="dataLabel">Loss:</td>
    <td class="data" colspan="4"><?php if (($row_equip_profiles['equipLoss'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipLoss'], "liters"); else echo $row_equip_profiles['equipLoss']; echo " ".$row_pref['measFluid2']; ?></td>
</tr>
<tr <?php echo " style=\"background-color:$color\"";?>>
   	<td class="dataLabel">Efficiency:</td>
    <td class="data"><?php if ($row_equip_profiles['equipTypicalEfficiency'] != "") echo $row_equip_profiles['equipTypicalEfficiency']."%"; ?></td>
   	<td class="dataLabel">H<sub>2</sub>O/Grain:</td>
   	<td class="data"><?php if ($row_equip_profiles['equipTypicalWaterRatio'] != "") { echo $row_equip_profiles['equipTypicalWaterRatio']; if ($row_pref['measWeight2'] == "pounds") echo " qt/lb"; else echo " li/kg"; } ?></td>
    <td class="dataLabel">Hop Util:</td>
   	<td class="data" colspan="6"><?php if ($row_equip_profiles['equipHopUtil'] != "") echo $row_equip_profiles['equipHopUtil']."%"; ?></td>  
    </tr>
<tr <?php echo " style=\"background-color:$color\"";?>>
   	<td class="dataLabel">Tun Vol.:</td>
   	<td class="data" width="15%"><?php if (($row_equip_profiles['equipMashTunVolume'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipMashTunVolume'], "liters"); else echo $row_equip_profiles['equipMashTunVolume']; echo " ".$row_pref['measFluid2']; ?></td>
   	<td class="dataLabel">Tun Dead Sp:</td>
   	<td class="data"><?php if (($row_equip_profiles['equipMashTunDeadspace'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipMashTunDeadspace'], "liters"); else echo $row_equip_profiles['equipMashTunDeadspace']; echo " ".$row_pref['measFluid2']; ?></td>
    <td class="dataLabel">Tun Sp. Heat:</td>
   	<td class="data" width="15%"><?php if ($row_equip_profiles['equipMashTunSpecificHeat'] != "") echo $row_equip_profiles['equipMashTunSpecificHeat']."  Cal/gram per &deg;C"; ?></td>
   	<td class="dataLabel">Tun Wt.:</td>
   	<td class="data" colspan="4"><?php if (($row_equip_profiles['equipMashTunWeight'] != "") && ($row_pref['measWeight2'] == "kilograms") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo weightconvert($row_equip_profiles['equipMashTunWeight'], "kilograms"); else echo $row_equip_profiles['equipMashTunWeight']; echo " ".$row_pref['measWeight2'];  ?></td>
</tr>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataLabel">Notes:</td>
    <td class="data" colspan="10"><?php if ($row_equip_profiles['equipNotes'] != "") echo $row_equip_profiles['equipNotes']; ?></td>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_equip_profiles = mysql_fetch_assoc($equip_profiles)); ?>
</table>
