<table class="dataTable">
<?php if (($row_log['user_name'] != $loginUsername) && ($row_user['userLevel'] == "2")) {  ?>
<tr>
<td colspan="3" class="error">Sorry, you do not have sufficient privileges to access this area.</td>
</tr>
<?php } 
if (($row_log['user_name'] == $loginUsername) || ($row_user['userLevel'] == "1")) 
{ ?>
	<?php if ($confirm == "false") { ?>
	<tr>
      <?php if ($msg == "1") { ?><td colspan="3" class="error">Sorry, that user name has been taken. Please choose another.<br><br></td><?php } ?>
	  <?php if ($msg == "2") { ?><td colspan="3" class="error">Sorry, the old password did not match the password in the database. Please try again.<br><br></td><?php } ?>
	</tr>
	<?php } ?>
<input type="hidden" name="user_name" value="<?php echo $filter; ?>" />
<input type="hidden" name="userLevel" value="<?php echo $row_log['userLevel']; ?>">
<tr>
      <td class="dataLabelLeft">First Name:</td>
      <td class="data" width="10%"><input type="text" name="realFirstName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") { if (($row_pref['mode'] == "1") && ($row_name['user_name'] == $loginUsername)) echo $row_name['brewerFirstName']; else echo $row_log['realFirstName']; } ?>" size="20"></td>
  	  <td class="data">&nbsp;</td></tr>
<tr>
      <td class="dataLabelLeft">Last Name:</td>
      <td class="data"><input type="text" name="realLastName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") { if (($row_pref['mode'] == "1") && ($row_name['user_name'] == $loginUsername)) echo $row_name['brewerLastName']; else echo $row_log['realLastName']; } ?>" size="20"></td>
  	  <td class="data">&nbsp;</td></tr>
<tr>
	  <td class="dataLabelLeft">Brewing Since (Year):</td>
      <td class="data"><input type="text" name="userBrewingSince" value="<?php if (($action == "edit") && ($row_log['userBrewingSince'] != "0000")) echo $row_log['userBrewingSince']; else print date ( 'Y' ); ?>" size="10" maxlength="4"></td>
  	  <td class="data">&nbsp;</td></tr>
<?php if ($row_user['userLevel'] == "1") { ?>
<tr>
      <td class="dataLabelLeft">User Level:</td>
      <td class="data">
	  <select name="userLevel" class="text_area" id="userLevel">
       <option value="2" <?php if ($action == "edit") { if (!(strcmp($row_log['userLevel'], "2"))) {echo "SELECTED";} } ?>>User</option>
       <option value="1" <?php if ($action == "edit") { if (!(strcmp($row_log['userLevel'], "1"))) {echo "SELECTED";} } ?>>Admin</option>
       </select>	  
       </td>
  <td class="data">User = ability to add/edit/delete only THEIR OWN data.<br>Admin = ability to add/edit/delete access ALL user's data.</td
></tr>
<tr>
     <td class="dataLabelLeft">User Name:</td>
     <td class="data"><input type="text" name="user_name" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['user_name']; ?>" size="20"></td>
  	  <td class="data">&nbsp;</td>
</tr>
	<?php if ($action == "add") { ?>
<tr>
      <td class="dataLabelLeft">Password:</td>
      <td class="data"><input type="password" name="password" value="" size="20"></td>
  	  <td class="data">&nbsp;</td>
</tr>

<?php } } ?>
</table>
<div class="headerContentAdmin">User Defaults</div>
<table  class="dataTable">
<tr>
      <td class="dataLabelLeft">Usual Method:</td>
      <td class="data">
	  <select name="defaultMethod" class="text_area" id="defaultMethod">
       <option value="Extract" <?php if ($action == "edit") { if (!(strcmp($row_log['defaultMethod'], "Extract"))) {echo "SELECTED";} } ?>>Extract</option>
       <option value="Partial Mash" <?php if ($action == "edit") { if (!(strcmp($row_log['defaultMethod'], "Partial Mash"))) {echo "SELECTED";} } ?>>Partial Mash</option>
       <option value="All Grain" <?php if ($action == "edit") { if (!(strcmp($row_log['defaultMethod'], "All Grain"))) {echo "SELECTED";} } ?>>All Grain</option>
      </select>&nbsp;indicate your preference and/or current skill level	  </td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
  	<td class="dataLabelLeft">Usual Batch Size:</td>
  	<td class="data"><input name="defaultBatchSize" type="text" value="<?php echo $row_log['defaultBatchSize']; ?>" size="5" /> <?php echo $row_pref['measFluid2']; ?></td>
 	<td class="data"></td>
</tr>
<tr>
      <td class="dataLabelLeft">Bitterness Formula:</td>
      <td class="data" width="5%">
      <select name="defaultBitternessFormula" id="defaultBitternessFormula">
		<option value="Daniels" <?php if (!(strcmp($row_log['defaultBitternessFormula'], "Daniels"))) 	echo "SELECTED"; ?>>Daniels</option>
    	<option value="Garetz" 	<?php if (!(strcmp($row_log['defaultBitternessFormula'], "Garetz"))) 	echo "SELECTED"; ?>>Garetz</option>
    	<option value="Rager" 	<?php if (!(strcmp($row_log['defaultBitternessFormula'], "Rager"))) 	echo "SELECTED"; ?>>Rager</option>
    	<option value="Tinseth" <?php if (!(strcmp($row_log['defaultBitternessFormula'], "Tinseth"))) 	echo "SELECTED"; ?>>Tinseth</option>
  	  </select>      </td>
      <td class="data"></td>
</tr>
<tr>
      <td class="dataLabelLeft">Equipment Profile:</td>
      <td class="data">
      <select name="defaultEquipProfile" id="defaultEquipProfile">
      <option value=""></option>
      <?php do { ?>
		<option value="<?php echo $row_equip_profiles['id']; ?>" <?php if (!(strcmp($row_log['defaultEquipProfile'], $row_equip_profiles['id']))) echo "SELECTED"; ?>><?php echo $row_equip_profiles['equipProfileName']; ?></option>
  	  <?php } while ($row_equip_profiles = mysql_fetch_assoc($equip_profiles))?>
      </select>      </td>
      <td class="data"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" border="0" align="absbottom" alt="Add Equipment Profile?" title="Add Equipment Profile?"></span><span class="data"><a href="index.php?action=add&dbTable=equip_profiles">Add Equipment Profiles?</a></span></td>
</tr>
<tr>
      <td class="dataLabelLeft">Mash Profile:</td>
      <td class="data">
      <option value=""></option>
      <select name="defaultMashProfile" id="defaultMashProfile">
      <?php do { ?>
		<option value="<?php echo $row_mash_profiles['id']; ?>" <?php if (!(strcmp($row_log['defaultMashProfile'], $row_mash_profiles['id']))) echo "SELECTED"; ?>><?php echo $row_mash_profiles['mashProfileName']; ?></option>
  	  <?php } while ($row_mash_profiles = mysql_fetch_assoc($mash_profiles))?>
      </select>      </td>
      <td class="data"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" border="0" align="absbottom" alt="Add Mash Profile?" title="Add Mash Profile?"></span><span class="data"><a href="index.php?action=add&dbTable=mash_profiles">Add Mash Profiles?</a></span></td>
</tr>
<tr>
      <td class="dataLabelLeft">Mash Thickness:</td>
      <td class="data"><input name="defaultWaterRatio" type="text" value="<?php echo $row_log['defaultWaterRatio']; if ($row_log['defaultWaterRatio'] == "") echo "1.33"; ?>" size="5" /> <?php echo $row_pref['measWaterGrainRatio']; ?></td>
	  <td class="data">&nbsp;</td>
</tr>
<tr>
      <td class="dataLabelLeft">Water Profile:</td>
      <td class="data">
      <select name="defaultWaterProfile" id="defaultWaterProfile">
      <option value=""></option>
      <?php do { ?>
		<option value="<?php echo $row_water_profiles['id']; ?>" <?php if (!(strcmp($row_log['defaultWaterProfile'], $row_water_profiles['id']))) echo "SELECTED"; ?>><?php echo $row_water_profiles['waterName']; ?></option>
  	  <?php } while ($row_water_profiles = mysql_fetch_assoc($water_profiles))?>
      </select>      </td>
      <td class="data"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" border="0" align="absbottom" alt="Add Water Profile?" title="Add Water Profile?"></span><span class="data"><a href="index.php?action=add&dbTable=water_profiles">Add Water Profiles?</a></span></td>
</tr>
<tr>
      <td class="dataLabelLeft">Boil Time:</td>
      <td class="data"><input name="defaultBoilTime" type="text" value="<?php echo $row_log['defaultBoilTime']; ?>" size="5" /> min.</td>
	  <td class="data">&nbsp;</td>
</tr>
</table>
<table class="dataTable">
<div class="headerContentAdmin">Personal Information</div>
<tr>
  <td colspan="3" class="error">(*) Indicates the item is only used for printing competition recipes and labels. It's not displayed on the site.</td>
</tr>
<?php if ($row_pref['mode'] == "2") { ?>
<tr>
	  <td class="dataLabelLeft">Profile:</td>
      <td colspan="2" class="data"><textarea name="userProfile" cols="50" rows="10"><?php if ($action == "edit") echo $row_log['userProfile']; ?></textarea></td>
  </tr>
<tr>
  <td class="dataLabelLeft">Birthdate:</td>
  <td class="data"><input type="text" name="userBirthdate" value="<?php if ($action == "edit") echo $row_log['userBirthdate']; ?>"  onfocus="showCalendarControl(this);" size="20"></td>
  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Occupation:</td>
      <td class="data"><input type="text" name="userOccupation" value="<?php if ($action == "edit") echo $row_log['userOccupation']; ?>" size="20"></td>
	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Hometown:</td>
      <td class="data"><input type="text" name="userHometown" value="<?php if ($action == "edit") echo $row_log['userHometown']; ?>" size="20"></td>
	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Other Hobbies:</td>
      <td class="data"><input type="text" name="userHobbies" value="<?php if ($action == "edit") echo $row_log['userHobbies']; ?>" size="20"></td>
	  <td class="data">&nbsp;</td>
</tr>
<?php } ?>
<tr>
  <td class="dataLabelLeft">Street Address:</td>
  <td class="data" width="10%"><input type="text" name="userAddress" value="<?php if ($action == "edit") echo $row_log['userAddress']; ?>" size="20"></td>
  <td class="data red"> (*)</td>
</tr>
<tr>
  <td class="dataLabelLeft">City:</td>
  <td class="data"><input type="text" name="userCity" value="<?php if ($action == "edit") echo $row_log['userCity']; ?>" size="20"></td>
  <td class="data red"> (*)</td>
</tr>
<tr>
  <td class="dataLabelLeft">State:</td>
  <td class="data"><input type="text" name="userState" value="<?php if ($action == "edit") echo $row_log['userState']; ?>" size="20"></td>
  <td class="data red"> (*)</td>
</tr>
<tr>
  <td class="dataLabelLeft">Zip:</td>
  <td class="data"><input type="text" name="userZip" value="<?php if ($action == "edit") echo $row_log['userZip']; ?>" size="20"></td>
  <td class="data red"> (*)</td>
</tr>
<tr>
  <td class="dataLabelLeft">Home Phone:</td>
  <td class="data"><input type="text" name="userPhoneH" value="<?php if ($action == "edit") echo $row_log['userPhoneH']; ?>" size="20"></td> 
  <td class="data red"> (*)</td>
</tr>
<tr>
  <td class="dataLabelLeft">Work Phone:</td>
  <td class="data"><input type="text" name="userPhoneW" value="<?php if ($action == "edit") echo $row_log['userPhoneW']; ?>" size="20"></td> 
  <td class="data red"> (*)</td>
</tr>
<tr>
  <td class="dataLabelLeft">Email Address:</td>
  <td class="data"><input type="text" name="userEmail" value="<?php if ($action == "edit") echo $row_log['userEmail']; ?>" size="20"> </td>
  <td class="data red"> (*)</td>
</tr>
<?php if ($row_pref['mode'] == "2") { ?>
<tr>
	  <td class="dataLabelLeft">Personal Website Name:</td>
      <td class="data"><input type="text" name="userWebsiteName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['userWebsiteName']; ?>" size="20"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Personal Website URL:</td>
      <td class="data"><input type="text" name="userWebsiteURL" tooltipText="<?php echo $toolTip_URL; ?>" value="<?php if ($action == "edit") echo $row_log['userWebsiteURL']; ?>"  size="20"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Favorite Style(s):</td>
      <td class="data"><input type="text" name="userFavStyles" value="<?php if ($action == "edit") echo $row_log['userFavStyles']; ?>" size="30"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Favorite Quote:</td>
      <td class="data"><input type="text" name="userFavQuote" value="<?php if ($action == "edit") echo $row_log['userFavQuote']; ?>" size="30"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Favorite Commercial Brews:</td>
      <td class="data"><input type="text" name="userFavCommercial" value="<?php if ($action == "edit") echo $row_log['userFavCommercial']; ?>" size="30"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Club Position:</td>
      <td class="data"><input type="text" name="userPosition" value="<?php if ($action == "edit") echo $row_log['userPosition']; ?>" size="30"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Past Positions:</td>
      <td class="data"><input type="text" name="userPastPosition" value="<?php if ($action == "edit") echo $row_log['userPastPosition']; ?>" size="30"></td>
  	  <td class="data">&nbsp;</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Your Photo's Name:</td>
      <td class="data"><input type="text" name="userPicURL" tooltipText="<?php echo $toolTip_images; ?>" value="<?php if ($action == "edit") echo $row_log['userPicURL']; ?>" size="30"></td>
  	  <td class="data"><a href="includes/upload_image.inc.php?KeepThis=true&TB_iframe=true&height=450&width=800" class="thickbox" title="Upload Profile Image">Upload Your Photo</a> (new window)</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Display Your Profile?</td>
      <td class="data">
        <input name="userInfoPrivate" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['userInfoPrivate']))) {echo "CHECKED";} else echo "CHECKED"; ?>>Yes
        <input name="userInfoPrivate" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['userInfoPrivate']))) {echo "CHECKED";} ?>>No	  </td>
  	  <td class="data">&nbsp;</td>
</tr>	
<?php }  }	?>
</table> 
<?php include ('includes/add_edit_buttons.inc.php'); ?>