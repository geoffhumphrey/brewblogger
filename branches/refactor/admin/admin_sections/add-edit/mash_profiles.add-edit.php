<?php if (($action == "add") || ($action == "reuse") || (($action == "edit") && (($row_log['mashBrewerID'] == $_SESSION['loginUsername']) || ($row_user['userLevel'] == "1")))) {  ?>
<?php if (($action == "add") || ($action == "reuse") || (($row_log['mashBrewerID'] != "brewblogger") && ($action == "edit"))) { ?>
<table class="dataTable">
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<tr>
	<td class="dataLabelLeft">Brewer ID:</td>
    <td class="data">
    <select name="equipBrewerID">
   		<?php do {  ?>
    	<option value="<?php echo $row_users['user_name']?>" <?php if (($action == "add") && ($row_users['user_name'] == $_SESSION["loginUsername"])) echo "SELECTED"; if (($action == "edit") || ($action == "reuse")) { if ($row_users['user_name'] == $row_log['mashBrewerID']) echo "SELECTED"; } ?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
    	<?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
    </select>
    </td>
</tr>
<?php } ?>
<tr>
	<td class="dataLabelLeft">Profile Name:</td>
    <td class="data"><input name="mashProfileName" type="text" size="25" value="<?php if ($action == "edit") echo $row_log['mashProfileName']; if ($action == "reuse") echo $row_log['mashProfileName']." [".$_SESSION['loginUsername']."]"; else echo "My Mash Profile"; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Grain Temp:</td>
    <td class="data"><input name="mashGrainTemp" type="text" value="<?php if (($action == "edit") || ($action == "reuse"))  { if (($row_log['mashBrewerID'] == "brewblogger") && ($row_pref['measTemp'] == "C")) echo tempconvert($row_log['mashGrainTemp'], "C"); else echo $row_log['mashGrainTemp']; } ?>" size="5" maxlength="8" />&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Mash Tun Temp:</td>
    <td class="data"><input name="mashTunTemp" type="text" value="<?php if (($action == "edit") || ($action == "reuse"))  { if (($row_log['mashBrewerID'] == "brewblogger") && ($row_pref['measTemp'] == "C")) echo tempconvert($row_log['mashTunTemp'], "C"); else echo $row_log['mashTunTemp']; } ?>" size="5" maxlength="8" />&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Sparge Temp:</td>
    <td class="data"><input name="mashSpargeTemp" type="text" value="<?php if (($action == "edit") || ($action == "reuse"))  { if (($row_log['mashBrewerID'] == "brewblogger") && ($row_pref['measTemp'] == "C")) echo tempconvert($row_log['mashSpargeTemp'], "C"); else echo $row_log['mashSpargeTemp']; } ?>" size="5" maxlength="8" />&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Mash PH:</td>
    <td class="data"><input name="mashPH" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['mashPH']; ?>" size="5" maxlength="8" /> %</td>
  </tr>
<tr>
	<td class="dataLabelLeft">Notes:</td>
    <td class="data"><textarea name="mashNotes" cols="67" rows="10"><?php if (($action == "edit") || ($action == "reuse")) echo $row_log['mashNotes']; ?>
    </textarea></td>
  </tr>
</table>
<?php if ((($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) || ($row_pref['mode'] == "1")  || ($row_log['mashBrewerID'] == "brewblogger")) { ?>
<input name="mashBrewerID" type="hidden" value="<?php if (($action == "edit") && ($row_log['mashBrewerID'] != "brewblogger")) echo $_SESSION["loginUsername"]; elseif (($action == "reuse") || ($action == "add")) echo $_SESSION["loginUsername"]; else echo $row_log['mashBrewerID']; ?>" />
<?php } 
include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>
<?php  
if ($action == "edit") { 
mysql_select_db($database_brewing, $brewing);
$query_mash_steps = "SELECT * FROM mash_steps WHERE stepMashProfileID = '$id'";
$mash_steps = mysql_query($query_mash_steps, $brewing) or die(mysql_error());
$row_mash_steps = mysql_fetch_assoc($mash_steps);
$totalRows_mash_steps = mysql_num_rows($mash_steps);
?>
<br />
<?php if ($totalRows_mash_steps > 0) { ?>
<p>The mash profile <em><?php echo $row_log['mashProfileName']; ?></em> has <?php echo $totalRows_mash_steps; ?> steps. You can edit them below or <a href="index.php?action=add&dbTable=mash_steps&id=<?php echo $row_log['id']; ?>">add another step</a> to the mash profile.</p>
<table class="dataTable">
<tr>
	<td class="dataHeadingList" width="5%">No.</td>
	<td class="dataHeadingList" width="15%">Name</td>
    <td class="dataHeadingList" width="10%">Type</td>
    <td class="dataHeadingList" width="10%">Time</td>
    <td class="dataHeadingList" width="10%">Temp.</td>
    <td class="dataHeadingList" width="5%">H<sub>2</sub>O/Grain Ratio</td>
    <td class="dataHeadingList">Description</td>
    <td class="dataHeadingList">&nbsp;</td>
    <td class="dataHeadingList">&nbsp;</td>
</tr>
<?php do {  ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList"><?php echo $row_mash_steps['stepNumber']; ?></td>
    <td class="dataList"><?php echo $row_mash_steps['stepName']; ?></td>
    <td class="dataList"><?php echo $row_mash_steps['stepType']; ?></td>
    <td class="dataList"><?php echo $row_mash_steps['stepTime']; ?> min.</td>
    <td class="dataList"><?php if ($row_mash_steps['stepTemp'] != "") echo $row_mash_steps['stepTemp']."&deg; ".$row_pref['measTemp']; ?></td>
    <td class="dataList"><?php echo $row_mash_steps['stepWaterGrainRatio']; if ($row_mash_steps['stepWaterGrainRatio'] != "") { if ($row_pref['measFluid2'] == "liters") echo " lt/kg"; else echo " qt/lb"; } ?></td>
    <td class="dataList"><?php echo $row_mash_steps['stepDescription']; ?></td>
    <td class="data-icon_list"><a href="index.php?action=edit&dbTable=mash_steps&id=<?php echo $row_mash_steps['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_mash_steps['stepName']; ?>" title="Edit <?php echo $row_mash_steps['stepName']; ?>"></a></td>
    <td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=mash_steps','id',<?php echo $row_mash_steps['id']; ?>,'Are you sure you want to delete this mash step? This cannot be undone.');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_mash_steps['stepName']; ?>" title="Delete <?php echo $row_mash_steps['stepName']; ?>"></a></td>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_mash_steps = mysql_fetch_assoc($mash_steps)); ?>
</table>
<?php }
  }
} // end if (brewBrewerID == "brewblogger")
else include (ADMIN_INCLUDES.'error_core.inc.php'); 
}  // end user priv check
else include (ADMIN_INCLUDES.'error_privileges.inc.php'); 
?>
