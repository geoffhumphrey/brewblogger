<?php if (($action == "add") || ($action == "reuse") || (($action == "edit") && (($row_log['waterBrewerID'] == $_SESSION['loginUsername']) || ($row_user['userLevel'] == "1")))) {  ?>
<?php if (($action == "add") || ($action == "reuse") || (($row_log['waterBrewerID'] != "brewblogger") && ($action == "edit"))) { ?>
<table class="dataTable">
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<tr>
	<td class="dataLabelLeft">Brewer ID:</td>
    <td class="data">
    <select name="waterBrewerID">
   		<?php do {  ?>
    	<option value="<?php echo $row_users['user_name']?>" <?php if (($action == "add") && ($row_users['user_name'] == $_SESSION["loginUsername"])) echo "SELECTED"; if (($action == "edit") || ($action == "reuse")) { if ($row_users['user_name'] == $row_log['waterBrewerID']) echo "SELECTED"; } ?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
    	<?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
    </select>
    </td>
</tr>
<?php } ?>
<tr>
	<td class="dataLabelLeft">Profile Name:</td>
    <td class="data"><input name="waterName" type="text" size="50" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterName']; if ($action == "reuse") echo " [".$_SESSION['loginUsername']."]"; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Calcium:</td>
    <td class="data"><input name="waterCalcium" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterCalcium']; ?>" size="5" maxlength="8" />&nbsp;ppm</td>
</tr>
<tr>
	<td class="dataLabelLeft">Magnesium:</td>
    <td class="data"><input name="waterMagnesium" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterMagnesium']; ?>" size="5" maxlength="8" />&nbsp;ppm</td>
</tr>
<tr>
	<td class="dataLabelLeft">Sodium:</td>
    <td class="data"><input name="waterSodium" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterSodium']; ?>" size="5" maxlength="8" />&nbsp;ppm</td>
</tr>
<tr>
	<td class="dataLabelLeft">Sulfate:</td>
    <td class="data"><input name="waterSulfate" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterSulfate']; ?>" size="5" maxlength="8" />&nbsp;ppm</td>
  </tr>
<tr>
	<td class="dataLabelLeft">Chloride:</td>
    <td class="data"><input name="waterChloride" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterChloride']; ?>" size="5" maxlength="8" />&nbsp;ppm</td>
</tr>
<tr>
	<td class="dataLabelLeft">Bicarbonate:</td>
    <td class="data"><input name="waterBicarbonate" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterBicarbonate']; ?>" size="5" maxlength="8" />&nbsp;ppm</td>
  </tr>
<tr>
	<td class="dataLabelLeft">PH:</td>
    <td class="data"><input name="waterPH" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterPH']; ?>" size="5" maxlength="8" /></td>
</tr>
<tr>
	<td class="dataLabelLeft">Notes:</td>
    <td class="data"><textarea name="waterNotes" cols="67" rows="10"><?php if (($action == "edit") || ($action == "reuse")) echo $row_log['waterNotes']; ?>
    </textarea></td>
  </tr>
</table>
<?php if ((($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) || ($row_pref['mode'] == "1")  || ($row_log['mashBrewerID'] == "brewblogger")) { ?>
<input name="waterBrewerID" type="hidden" value="<?php if (($action == "edit") && ($row_log != "brewblogger")) echo $_SESSION["loginUsername"]; if ($action == "add") echo $_SESSION["loginUsername"] ?>" />
<?php }
include ('includes/add_edit_buttons.inc.php'); ?>
<?php } // end if (brewBrewerID == "brewblogger")
else include ('includes/error_core.inc.php'); 
}  // end user priv check
else include ('includes/error_privileges.inc.php'); 
?>