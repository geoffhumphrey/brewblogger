<?php if (($action == "add") || ($action == "reuse") || (($action == "edit") && (($row_log['equipBrewerID'] == $_SESSION['loginUsername']) || ($row_user['userLevel'] == "1")))) {  ?>
<?php if (($action == "add") || ($action == "reuse") || (($row_log['equipBrewerID'] != "brewblogger") && ($action == "edit"))) { ?>
<table class="dataTable">
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<tr>
	<td class="dataLabelLeft">Brewer ID:</td>
    <td class="data">
    <select name="equipBrewerID">
   		<?php do {  ?>
    	<option value="<?php echo $row_users['user_name']?>" <?php if (($action == "add") && ($row_users['user_name'] == $_SESSION["loginUsername"])) echo "SELECTED"; if (($action == "edit") || ($action == "reuse")) { if ($row_users['user_name'] == $row_log['equipBrewerID']) echo "SELECTED"; } ?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
    	<?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
    </select>
    </td>
</tr>
<?php } ?>
<tr>
	<td class="dataLabelLeft">Profile Name:</td>
    <td class="data"><input name="equipProfileName" type="text" size="40" value="<?php if ($action == "edit") echo $row_log['equipProfileName']; else echo "My Equipment [".$_SESSION['loginUsername']."]"; ?>" /></td>
</tr>
<tr>
	<td class="dataLabelLeft">Batch Size:</td>
    <td class="data"><input name="equipBatchSize" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipBatchSize'],"liters"); else echo $row_log['equipBatchSize']; } if ($action == "add") echo $row_user['defaultBatchSize']; ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Boil Volume:</td>
    <td class="data"><input name="equipBoilVolume" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipBoilVolume'],"liters"); else echo $row_log['equipBoilVolume']; } if (($action == "add") && ($row_user['defaultBatchSize'] != "")) echo $row_user['defaultBatchSize'] * 1.2;  ?>" size="5" maxlength="8"  />&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Evaporation Rate:</td>
    <td class="data"><input name="equipEvapRate" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['equipEvapRate']; else echo "9" ?>" size="5" maxlength="8" />&nbsp;% per hour</td>
</tr>
<tr>
	<td class="dataLabelLeft">Hop Utilization:</td>
    <td class="data"><input name="equipHopUtil" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['equipHopUtil']; else echo "100"; ?>" size="5" maxlength="8" />&nbsp;%</td>
</tr>
<tr>
	<td class="dataLabelLeft">Typical/Average Efficiency:</td>
    <td class="data"><input name="equipTypicalEfficiency" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['equipTypicalEfficiency']; else echo "75" ?>" size="5" maxlength="8" />&nbsp;%</td>
</tr>
<tr>
	<td class="dataLabelLeft">Typical Water to Grain Ratio:</td>
    <td class="data"><input name="equipTypicalWaterRatio" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['equipTypicalWaterRatio']; if ($action == "add") { if ($row_pref['measWeight2'] == "kilograms") echo ""; else echo "1.2"; }  ?>" size="5" maxlength="8" />&nbsp;<?php if ($row_pref['measWeight2'] == "kilograms") echo "lt/kg"; else echo "qt/lb"; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Top Up Water (Kettle):</td>
    <td class="data"><input name="equipTopUpKettle" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipTopUpKettle'],"liters"); else echo $row_log['equipTopUpKettle']; } ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Top Up Water (Fermenter):</td>
    <td class="data"><input name="equipTopUp" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipTopUp'],"liters"); else echo $row_log['equipTopUp']; } ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measFluid2']; ?> (if not boiling the full volume)</td>
</tr>
<tr>
	<td class="dataLabelLeft">Loss:</td>
    <td class="data"><input name="equipLoss" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipLoss'],"liters"); else echo $row_log['equipLoss']; } ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Mash Tun Volume:</td>
    <td class="data"><input name="equipMashTunVolume" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipMashTunVolume'],"liters"); else echo $row_log['equipMashTunVolume']; } ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Mash Tun Weight:</td>
    <td class="data"><input name="equipMashTunWeight" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipMashTunWeight'],"liters"); else echo $row_log['equipMashTunWeight']; } ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Mash Tun Specific Heat:</td>
    <td class="data"><input name="equipMashTunSpecificHeat" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['equipMashTunSpecificHeat']; ?>" size="5" maxlength="8" /> Cal/gram per &deg;C</td>
</tr>
<tr>
	<td class="dataLabelLeft">Mash Tun Dead Space:</td>
    <td class="data"><input name="equipMashTunDeadspace" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) { if (($row_log['equipBrewerID'] == "brewblogger") && ($row_pref['measFluid2'] == "liters")) echo volumeconvert($row_log['equipMashTunDeadspace'],"liters"); else echo $row_log['equipMashTunDeadspace']; } ?>" size="5" maxlength="8" />&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Notes:</td>
    <td class="data"><textarea name="equipNotes" cols="67" rows="10"><?php if (($action == "edit") || ($action == "reuse")) echo $row_log['equipNotes']; ?>
    </textarea></td>
</tr>
</table>
<?php if ((($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) || ($row_pref['mode'] == "1")  || ($row_log['mashBrewerID'] == "brewblogger")) { ?>
<input name="equipBrewerID" type="hidden" value="<?php if (($action == "edit") && ($row_log['equipBrewerID'] != "brewblogger")) echo $_SESSION["loginUsername"]; elseif (($action == "reuse") || ($action == "add")) echo $_SESSION["loginUsername"]; else echo $row_log['equipBrewerID']; ?>" />
<?php } 
include ('includes/add_edit_buttons.inc.php'); ?>
<?php } // end if (brewBrewerID == "brewblogger")
else include ('includes/error_core.inc.php'); 
}  // end user priv check
else include ('includes/error_privileges.inc.php'); 
?>
