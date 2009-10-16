<table class="dataTable">
<tr>
      <td class="dataLabelLeft">BrewBlog Name:</td>
      <td class="data"><input name="brewerLogName" type="text" id="brewerLogName" value="<?php if ($action == "edit") echo $row_log['brewerLogName']; ?>" size="32" maxlength="18">&nbsp;will appear in the header - 18 characters maximum </td>
</tr>
<tr>
      <td class="dataLabelLeft">Tagline:</td>
      <td class="data"><input name="brewerTagline" type="text" value="<?php if ($action == "edit") echo $row_log['brewerTagline']; ?>" size="32" maxlength="80">&nbsp;will appear in the header - 80 characters maximum </td>
</tr>
<tr>
      <td class="dataLabelLeft"><?php if ($row_pref['mode'] == "1") echo "First Name:"; else echo "Club Name:" ?></td>
      <td class="data"><input name="brewerFirstName" type="text" value="<?php if ($action == "edit") echo $row_log['brewerFirstName']; ?>" size="32" maxlength="20">&nbsp;will appear in the header - 20 characters maximum </td>
</tr>
<?php if ($row_pref['mode'] == "1") { ?>
<tr>
      <td class="dataLabelLeft">Middle Name:</td>
      <td class="data"><input type="text" name="brewerMiddleName" value="<?php if ($action == "edit") echo $row_log['brewerMiddleName']; ?>" size="32">&nbsp;middle initial OK </td>
</tr>
<tr>
      <td class="dataLabelLeft">Last Name:</td>
      <td class="data"><input type="text" name="brewerLastName" value="<?php if ($action == "edit") echo $row_log['brewerLastName']; ?>" size="32"></td>
</tr>
<tr>
      <td class="dataLabelLeft">Prefix:</td>
      <td class="data"><input type="text" name="brewerPrefix" value="<?php if ($action == "edit") echo $row_log['brewerPrefix']; ?>" size="32">&nbsp;e.g., Mr., Mrs., Dr., etc. </td>
</tr>
<tr>
      <td class="dataLabelLeft">Suffix:</td>
      <td class="data"><input type="text" name="brewerSuffix" value="<?php if ($action == "edit") echo $row_log['brewerSuffix']; ?>" size="32">&nbsp;e.g., Jr., Sr., II, Esquire, etc. </td>
</tr>
<tr>
      <td class="dataLabelLeft">Age:</td>
      <td class="data"><input type="text" name="brewerAge" value="<?php if ($action == "edit") echo $row_log['brewerAge']; ?>" size="32"></td>
</tr>
<?php } ?>
<tr>
      <td class="dataLabelLeft">City:</td>
      <td class="data"><input type="text" name="brewerCity" value="<?php if ($action == "edit") echo $row_log['brewerCity']; ?>" size="32"></td>
</tr>
<tr>
      <td class="dataLabelLeft">State:</td>
      <td class="data"><input type="text" name="brewerState" value="<?php if ($action == "edit") echo $row_log['brewerState']; ?>" size="32"></td>
</tr>
<tr>
      <td class="dataLabelLeft">Country:</td>
      <td class="data"><input type="text" name="brewerCountry" value="<?php if ($action == "edit") echo $row_log['brewerCountry']; ?>" size="32"></td>
</tr>
<tr>
      <td class="dataLabelLeft"><?php if ($row_pref['mode'] == "1") echo "Thoughts:"; else echo "Club Info:"; ?></td>
      <td class="data"><textarea name="brewerAbout" cols="67" rows="20"><?php if ($action == "edit") echo $row_log['brewerAbout']; ?></textarea></td>
</tr>
<?php if ($row_pref['mode'] == "1") { ?>
<tr>
      <td class="dataLabelLeft">Favorite Styles:</td>
      <td class="data"><input name="brewerFavStyles" type="text" value="<?php if ($action == "edit") echo $row_log['brewerFavStyles']; ?>" size="60" maxlength="200"></td>
</tr>
<tr>
      <td class="dataLabelLeft">Method:</td>
      <td class="data">
	  <select name="brewerPrefMethod" class="text_area" id="brewerPrefMethod">
       <option value="Extract" <?php if ($action == "edit") { if (!(strcmp($row_log['brewerPrefMethod'], "Extract"))) {echo "SELECTED";} } ?>>Extract</option>
       <option value="Partial Mash" <?php if ($action == "edit") { if (!(strcmp($row_log['brewerPrefMethod'], "Partial Mash"))) {echo "SELECTED";} } ?>>Partial Mash</option>
       <option value="All Grain" <?php if ($action == "edit") { if (!(strcmp($row_log['brewerPrefMethod'], "All Grain"))) {echo "SELECTED";} } ?>>All Grain</option>
      </select>&nbsp;indicate your preference and/or current skill level
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Brew Clubs:</td>
      <td class="data"><input name="brewerClubs" type="text" value="<?php if ($action == "edit") echo $row_log['brewerClubs']; ?>" size="60" maxlength="200"></td>
</tr>
<?php } ?>
<tr>
      <td class="dataLabelLeft"><?php if ($row_pref['mode'] == "1") echo "Image Name:"; else echo "Logo Image Name:"; ?></td>
      <td class="data"><input name="brewerImage" type="text" value="<?php if ($action == "edit") echo $row_log['brewerImage']; ?>" size="60"> 
      &nbsp;<span class="data_icon"><img src="<?php echo $imageSrc; ?>picture_add.png" align="absmiddle"/></span><span class="data"><a href="includes/upload_image.inc.php?KeepThis=true&TB_iframe=true&height=450&width=800" class="thickbox" title="Upload">Upload</a></span></td>
</tr>
<tr>
      <td class="dataLabelLeft">Misc. Info:</td>
      <td class="data"><textarea name="brewerOther" cols="67" rows="20"><?php if ($action == "edit") echo $row_log['brewerOther']; ?></textarea></td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>