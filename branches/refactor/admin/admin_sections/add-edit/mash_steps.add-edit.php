<?php
mysql_select_db($database_brewing, $brewing);
if ($action == "view") $query_mash_steps = sprintf("SELECT * FROM mash_steps WHERE stepMashProfileID = '%s'", $id);
else $query_mash_steps = sprintf("SELECT * FROM mash_steps WHERE stepMashProfileID = '%s'", $row_log['stepMashProfileID']);
$mash_steps = mysql_query($query_mash_steps, $brewing) or die(mysql_error());
$row_mash_steps = mysql_fetch_assoc($mash_steps);
$totalRows_mash_steps = mysql_num_rows($mash_steps);

if ($action == "edit") $query_mash_profiles = sprintf("SELECT * FROM mash_profiles WHERE id = '%s'", $row_log['stepMashProfileID']);

else $query_mash_profiles = sprintf("SELECT * FROM mash_profiles WHERE id = '%s'", $id);
$mash_profiles = mysql_query($query_mash_profiles, $brewing) or die(mysql_error());
$row_mash_profiles = mysql_fetch_assoc($mash_profiles); ?>
<?php if (($action == "add") || ($action == "edit")) { ?>
<h3>Mash Profile: <em><?php echo $row_mash_profiles['mashProfileName']; ?></em></h3>
<?php  if (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername'])) { ?>
<table class="dataTable">
<tr>
	<td class="dataLabelLeft">Step Name:</td>
    <td class="data"><input name="stepName" type="text" size="25" value="<?php if ($action == "edit") echo $row_log['stepName']; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Step Number:</td>
    <td class="data"><input name="stepNumber" type="text" size="5" value="<?php if ($action == "edit") echo $row_log['stepNumber']; ?>" /></td>
</tr>
<tr>
	<td class="dataLabelLeft">Step Type:</td>
    <td class="data">
    <select name="stepType">
      <option value="Infusion" <?php if (($action == "edit") && ($row_log['stepType'] == "Infusion")) echo "SELECTED"; ?>>Infusion</option>
      <option value="Decoction" <?php if (($action == "edit") && ($row_log['stepType'] == "Decoction")) echo "SELECTED"; ?>>Decoction</option>
      <option value="Temperature" <?php if (($action == "edit") && ($row_log['stepType'] == "Temperature")) echo "SELECTED"; ?>>Temperature</option>
    </select>
    </td>
</tr>
<tr>
	<td class="dataLabelLeft">Step Temperature:</td>
    <td class="data"><input name="stepTemp" type="text" value="<?php if ($action == "edit") { if (($row_log['stepTemp'] != "") && ($row_pref['measTemp'] == "C")) echo tempconvert($row_log['stepTemp'], "C"); else echo $row_log['stepTemp']; } ?>" size="5" maxlength="8" />&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Step Time:</td>
    <td class="data"><input name="stepTime" type="text" value="<?php if ($action == "edit") echo $row_log['stepTime']; ?>" size="5" maxlength="8" />&nbsp;min.</td>
</tr>
<tr>
	<td class="dataLabelLeft">Step Ramp Up Time:</td>
    <td class="data"><input name="stepRampTime" type="text" value="<?php if ($action == "edit") echo $row_log['stepRampTime']; ?>" size="5" maxlength="8" />&nbsp;min.</td>
</tr>
<tr>
	<td class="dataLabelLeft">Step Ramp End Temp:</td>
    <td class="data"><input name="stepEndTemp" type="text" value="<?php if ($action == "edit") { if (($row_log['stepTemp'] != "") && ($row_pref['measTemp'] == "C")) echo tempconvert($row_log['stepEndTemp'], "C"); else echo $row_log['stepEndTemp'];  }  ?>" size="5" maxlength="8" />&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<!-- 
<tr>
	<td class="dataLabelLeft">Step Infusion Amount:</td>
    <td class="data"><input name="stepInfuseAmt" type="text" value="<?php // if ($action == "edit") echo $row_log['stepInfuseAmt']; ?>" size="5" maxlength="8" />&nbsp;(if infusion type)</td>
</tr>
-->
<tr>
	<td class="dataLabelLeft">Step Decoction Amount:</td>
    <td class="data"><input name="stepDecoctionAmt" type="text" value="<?php if ($action == "edit") echo $row_log['stepDecoctionAmt']; ?>" size="5" maxlength="8" /> (if decoction type)</td>
</tr>
<tr>
	<td class="dataLabelLeft">Step Description:</td>
    <td class="data"><textarea name="stepDescription" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['stepDescription']; ?>
    </textarea></td>
</tr>
</table>
<input name="stepMashProfileID" type="hidden" value="<?php if ($action == "add") echo $id; if ($action == "edit") echo $row_log['stepMashProfileID']; ?>" />
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>
<?php } else { ?>
<?php include (ADMIN_INCLUDES.'error_privileges.inc.php'); ?>
<?php } 
} 
if ($action == "view") { ?>
<?php if ($totalRows_mash_steps > 0) { ?>
<p>The steps below are part of the <em><?php echo $row_mash_profiles['mashProfileName']; ?></em> mash profile. <?php if ($row_mash_profiles['mashBrewerID'] != "brewblogger") { if (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername'])) { ?>You can edit them below or <a href="index.php?action=add&dbTable=mash_steps&id=<?php echo$row_log['stepMashProfileID']; ?>">add another step</a> to the mash profile.<?php } else echo "This mash profile belongs to another user; therefore, you cannot add or edit any of its associated steps."; } else echo " This mash profile is part of the BrewBlogger core; therefore, the profile and its associated steps cannot be edited or deleted."; ?></p>
<a name="list" id="list"></a>
<table class="dataTable">
<tr>
	<td class="dataHeadingList" width="5%">No.</td>
	<td class="dataHeadingList" width="15%">Name</td>
    <td class="dataHeadingList" width="10%">Type</td>
    <td class="dataHeadingList" width="10%">Time</td>
    <td class="dataHeadingList" width="10%">Temp.</td>
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
    <td class="dataList"><?php echo $row_mash_steps['stepDescription']; ?></td>
    <?php  if (($row_mash_profiles['mashBrewerID'] != "brewblogger") && (($row_user['userLevel'] == "1") || ($row_mash_profiles['mashBrewerID'] == $_SESSION['loginUsername']))) { ?>
    <td class="data-icon_list"><a href="index.php?action=edit&dbTable=mash_steps&id=<?php echo $row_mash_steps['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_mash_steps['stepName']; ?>" title="Edit <?php echo $row_mash_steps['stepName']; ?>"></a></td>
    <td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=mash_steps','id',<?php echo $row_mash_steps['id']; ?>,'Are you sure you want to delete this mash step? This cannot be undone.');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_mash_steps['stepName']; ?>" title="Delete <?php echo $row_mash_steps['stepName']; ?>"></a></td>
    <?php } 
	else { ?>
   <td class="data-icon_list"><img src="<?php echo $imageSrc; ?>pencil_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <td class="data-icon_list"><img src="<?php echo $imageSrc; ?>bin_closed_fade.png" align="absmiddle" border="0" alt="No Privileges" title="No Privileges"></td>
   <?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_mash_steps = mysql_fetch_assoc($mash_steps)); ?>
<?php } else { ?>
<p>The mash profile <em><?php echo $row_log['mashProfileName']; ?></em> does not contain any steps. <a href="index.php?action=add&dbTable=mash_steps&id=<?php echo $row_log['id']; ?>">Add a step now?</a>
<?php } ?>
</table>
<?php } ?>