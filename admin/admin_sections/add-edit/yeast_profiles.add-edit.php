<?php if (($action == "add") || ($action == "reuse") || (($action == "edit") && (($row_log['yeastBrewerID'] == $_SESSION['loginUsername']) || ($row_user['userLevel'] == "1")))) {  ?>
<?php // if (($action == "add") || ($action == "reuse") || (($row_log['yeastBrewerID'] != "brewblogger") && ($action == "edit"))) { ?>
<table class="dataTable">
<?php if (($row_pref['mode'] == "1") && ($row_user['userLevel'] == "1")) { ?>
<tr>
	<td class="dataLabelLeft">Brewer ID:</td>
    <td class="data">
    <select name="yeastBrewerID">
   		<?php do {  ?>
    	<option value="<?php echo $row_users['user_name']?>" <?php if (($action == "add") && ($row_users['user_name'] == $_SESSION["loginUsername"])) echo "SELECTED"; if (($action == "edit") || ($action == "reuse")) { if ($row_users['user_name'] == $row_log['yeastBrewerID']) echo "SELECTED"; } ?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
    	<?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
    </select>
    </td>
</tr>
<?php } ?>
<tr>
	<td class="dataLabelLeft">Manufacturer/Lab:</td>
    <td class="data"><input name="yeastLab" type="text" size="25" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastLab']; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Product ID/Number:</td>
    <td class="data"><input name="yeastProdID" type="text" size="25" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastProdID']; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Name:</td>
    <td class="data"><input name="yeastName" type="text" size="25" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastName']; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Form:</td>
    <td class="data">
	<select name="yeastForm" id="yeastForm">
	<option value="Liquid" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastForm'], "Liquid"))) {echo "SELECTED";} }?>>Liquid</option>
	<option value="Dry" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastForm'], "Dry"))) {echo "SELECTED";} }?>>Dry</option>
	<option value="Slant" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastForm'], "Slant"))) {echo "SELECTED";} }?>>Slant</option>
	<option value="Culture" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastForm'], "Culture"))) {echo "SELECTED";} }?>>Culture</option>
	</select>
    </td>
  </tr>
<tr>
	<td class="dataLabelLeft">Type:</td>
    <td class="data">
	<select name="yeastType" id="yeastType">
    <option value="Ale" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastType'], "Ale"))) {echo "SELECTED";} }?>>Ale</option>
    <option value="Lager" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastType'], "Lager"))) {echo "SELECTED";} }?>>Lager</option>
    <option value="Wheat" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastType'], "Wheat"))) {echo "SELECTED";} }?>>Wheat</option>
    <option value="Wine" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastType'], "Wine"))) {echo "SELECTED";} }?>>Wine</option>
    <option value="Champagne" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastType'], "Champagne"))) {echo "SELECTED";} }?>>Champagne</option>
	</select>    </td>
  </tr>
<tr>
	<td class="dataLabelLeft">Attenuation:</td>
    <td class="data"><input name="yeastAtten" type="text" size="5" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastAtten']; ?>" />
    % - provide a range</td>
  </tr>
<tr>
	<td class="dataLabelLeft">Floculation:</td>
    <td class="data">
    <select name="yeastFloc" id="yeastFloc">
    <option value="Low" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastFloc'], "Low"))) {echo "SELECTED";} }?>>Low</option>
    <option value="Medium" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastFloc'], "Medium"))) {echo "SELECTED";} }?>>Medium</option>
    <option value="High" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastFloc'], "High"))) {echo "SELECTED";} }?>>High</option>
    </select>    </td>
  </tr>
<tr>
	<td class="dataLabelLeft">Alcohol Tolerance:</td>
    <td class="data">
    <select name="yeastTolerance" id="yeastTolerance">
    <option value=""></option>
    <option value="Low" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastTolerance'], "Low"))) {echo "SELECTED";} }?>>Low</option>
    <option value="Medium" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastTolerance'], "Medium"))) {echo "SELECTED";} }?>>Medium</option>
    <option value="High" <?php if (($action == "edit") || ($action == "reuse")) { if (!(strcmp($row_log['yeastTolerance'], "High"))) {echo "SELECTED";} }?>>High</option>
    </select>    </td>
  </tr>
<tr>
	<td class="dataLabelLeft">Package Amount:</td>
    <td class="data"><input name="yeastAmount" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastAmount']; ?>" size="5" maxlength="3" /> milliliters for liquid, grams for dry</td>
  </tr>
<tr>
	<td class="dataLabelLeft">Minimum Temperature:</td>
    <td class="data"><input name="yeastMinTemp" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastMinTemp'];?>" size="5" maxlength="3" /> &deg;<?php echo $row_pref['measTemp']; ?></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Maximum Temperature:</td>
    <td class="data"><input name="yeastMaxTemp" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastMaxTemp']; ?>" size="5" maxlength="3" /> &deg;<?php echo $row_pref['measTemp']; ?></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Maximum Reuse:</td>
    <td class="data"><input name="yeastMaxReuse" type="text" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastMaxReuse']; ?>" size="5" maxlength="3" /></td>
</tr>
<tr>
	<td class="dataLabelLeft">Best For:</td>
    <td class="data"><input name="yeastBestFor" type="text" size="50" value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastBestFor']; ?>" /></td>
  </tr>
<tr>
	<td class="dataLabelLeft">Notes:</td>
    <td class="data"><textarea name="yeastNotes" cols="67" rows="10"><?php if (($action == "edit") || ($action == "reuse")) echo $row_log['yeastNotes']; ?>
    </textarea></td>
  </tr>
</table>
<?php //if ((($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) || ($row_pref['mode'] == "1")  || ($row_log['mashBrewerID'] == "brewblogger")) { ?>
<input name="yeastBrewerID" type="hidden" value="<?php if (($action == "edit") && ($row_log['yeastBrewerID'] != "brewblogger")) echo $_SESSION["loginUsername"]; else echo "brewblogger"; if ($action == "add") echo $_SESSION["loginUsername"] ?>" />
<?php //}
include ('includes/add_edit_buttons.inc.php'); ?>
<?php } // end if (brewBrewerID == "brewblogger")
// else include ('includes/error_core.inc.php'); 
//}  // end user priv check 
else include ('includes/error_privileges.inc.php'); 
?>
