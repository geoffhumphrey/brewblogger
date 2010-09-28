<div class="headerContentAdmin">General Information</div>
<table>
<tr>
   <td class="dataLabelLeft" width="5%">Name:</td>
   <td class="data" width="10%"><input type="text"  name="brewName" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewName']; if ($action == "importCalc") echo $brewName; ?>" size="30"></td>
   <?php if ($dbTable == "brewing") { ?>
   <td class="dataLabel" width="5%">Batch No:</td>
   <td class="data"><input name="brewBatchNum" type="text"  value="<?php if ($action == "edit") echo $row_log['brewBatchNum']; ?>" size="20"></td>
   <?php } ?>
   <?php if ($dbTable == "recipes") { ?>
   <td class="dataLabel" width="5%">Source:</td>
   <td class="data"><input name="brewSource" type="text"  value="<?php if (($action == "edit") || ($action == "reuse")) echo $row_log['brewSource']; ?>" size="20"></td>
   <?php } ?>
</tr>
<?php if ($row_user['userLevel'] == "1") { ?>
<tr>
	<td class="dataLabelLeft">Featured?</td>
    <td class="data" colspan="3">
        <input type="radio" name="brewFeatured" value="Y" id="brewFeatured_0" <?php if (($action == "edit") && ($row_log['brewFeatured'] == "Y")) echo "checked"; ?> />Yes&nbsp;<input type="radio" name="brewFeatured" value="N" id="brewFeatured_1"  <?php if (($action == "add") || ($action == "importCalc") || ($action == "reuse") || ($action == "importRecipe") || ($action == "import") || (($action == "edit") && (($row_log['brewFeatured'] == "N") || ($row_log['brewFeatured'] == "")))) echo "checked"; ?> />No<br />
        <em>Selecting "Yes" will place this <?php echo $msgName; ?> into the "Featured" list at the top of the <?php echo $dbName; ?> list display. </em>    </td>
</tr>
<?php } else { ?><input type="hidden" name="brewFeatured" value="<?php echo $row_log['brewFeatured']; ?>" /><?php } ?>
<tr>
	<td class="dataLabelLeft">Archive?</td>
    <td class="data" colspan="3">
        <input type="radio" name="brewArchive" value="Y" id="brewArchive_0" <?php if (($action == "edit") && ($row_log['brewArchive'] == "Y")) echo "checked"; ?> />Yes&nbsp;<input type="radio" name="brewArchive" value="N" id="brewArchive_1"  <?php if (($action == "add") || ($action == "importCalc") || ($action == "reuse") || ($action == "importRecipe") || ($action == "import") || (($action == "edit") && (($row_log['brewArchive'] == "N") || ($row_log['brewArchive'] == "")))) echo "checked"; ?> />No
    	&nbsp;<br />
    	<em>Selecting "Yes" will place this <?php echo $msgName; ?> into your archive list. It will not be displayed on the "public" areas of the site.</em>
    </td>
</tr>
<tr>
   <td class="dataLabelLeft"><div id="help"><a href="../sections/reference.inc.php?section=styles&source=admin&KeepThis=true&TB_iframe=true&height=450&width=800" title="Style Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>/information.png" border="0"></a></div>Style:</td>
   <td class="data">
   <select name="brewStyle">
    <?php do {  ?>
     <option value="<?php echo $row_styles['brewStyle']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_styles['brewStyle'], $row_log['brewStyle']))) {echo "SELECTED";} } if ($action == "importCalc") {  if ($row_styles['brewStyle'] == $brewStyle ) echo "SELECTED"; } ?>><?php echo $row_styles['brewStyle']?></option>
      <?php } while ($row_styles = mysql_fetch_assoc($styles)); $rows = mysql_num_rows($styles); if($rows > 0) { mysql_data_seek($styles, 0); $row_styles = mysql_fetch_assoc($styles); } ?>
   </select>
   </td>
   <td class="dataLabel">Yield:</td>
   <td class="data"><input name="brewYield" type="text" size="10" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "add") echo $row_user['defaultBatchSize']; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewYield']; if ($action == "importCalc") echo $brewYield; ?>">&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr>
    <td class="dataLabelLeft">Method:</td>
   <td class="data">
   <select name="brewMethod" id="brewMethod">
   <option value="Extract"<?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultMethod'] == "Extract")) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_log['brewMethod'], "Extract"))) {echo "SELECTED";} } if (($action == "add") && ($row_pref['brewerPrefMethod'] == "Extract")) echo "SELECTED"; ?>>Extract</option>
   <option value="Partial Mash"<?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultMethod'] == "Partial Mash")) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_log['brewMethod'], "Partial Mash"))) {echo "SELECTED";} } if (($action == "add") && ($row_pref['brewerPrefMethod'] == "Partial Mash")) echo "SELECTED";?>>Partial Mash</option>
   <option value="All Grain"<?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultMethod'] == "All Grain")) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_log['brewMethod'], "All Grain"))) {echo "SELECTED";} } if (($action == "add") && ($row_pref['brewerPrefMethod'] == "All Grain")) echo "SELECTED"; ?>>All Grain</option>
   <option value="Other"<?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultMethod'] == "Other")) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_log['brewMethod'], "Other"))) {echo "SELECTED";} } if (($action == "add") && ($row_pref['brewerPrefMethod'] == "Other")) echo "SELECTED"; ?>>Other</option>
   </select>
   </td>
   <td class="dataLabel"><?php if ($dbTable != "recipes") echo "Conditioning:"; else echo "&nbsp;"; ?></td>
   <td class="data"><?php if ($dbTable != "recipes") { ?>
   <select name="brewCondition" id="brewCondition">
	<option value=""<?php if ($action == "edit") { if (!(strcmp($row_log['brewCondition'], ""))) { echo "SELECTED"; } } ?>></option>
    <option value="Bottles"<?php if ($action == "edit") { if (!(strcmp($row_log['brewCondition'], "Bottles"))) {echo "SELECTED";} }?>>Bottles</option>
    <option value="Keg"<?php if ($action == "edit") {  if (!(strcmp($row_log['brewCondition'], "Keg"))) {echo "SELECTED";} }?>>Keg</option>
    <option value="Cask"<?php if ($action == "edit") {  if (!(strcmp($row_log['brewCondition'], "Cask"))) {echo "SELECTED";} }?>>Cask</option>
    <option value="Bottles and Keg"<?php if ($action == "edit") {  if (!(strcmp($row_log['brewCondition'], "Cask"))) {echo "SELECTED";} }?>>Bottles and Keg</option>
	<option value="Bottles and Cask"<?php if ($action == "edit") {  if (!(strcmp($row_log['brewCondition'], "Bottles and Keg"))) {echo "SELECTED";} }?>>Bottles and Cask</option>
	<option value="Keg and Cask"<?php if ($action == "edit") {  if (!(strcmp($row_log['brewCondition'], "Keg and Cask"))) {echo "SELECTED";} }?>>Keg and Cask</option>
	<option value="Bottles, Keg and Cask"<?php if ($action == "edit") {  if (!(strcmp($row_log['brewCondition'], "Bottles, Keg and Cask"))) {echo "SELECTED";} }?>>Bottles, Keg and Cask</option>
   </select>
   <?php } else echo "&nbsp;"; ?>
	</td>

</tr>
<tr>
   <td class="dataLabelLeft"><?php if ($dbTable != "recipes") echo "Date:"; else echo "&nbsp;" ?></td>
   <td class="data"><?php if ($dbTable != "recipes") { ?><input type="text" name="brewDate" value="<?php if ($action == "edit") echo $row_log['brewDate'];  else print date ( 'Y-m-d' ); ?>" size="20" onfocus="showCalendarControl(this);"><?php } else echo "&nbsp;"; ?></td>
   <td class="dataLabel"><?php if ($dbTable != "recipes") echo "Cost:"; else echo "&nbsp;"; ?></td>
   <td class="data"><?php if ($dbTable != "recipes") { ?><input name="brewCost" type="text" id="brewCost" size="20" tooltipText="<?php echo $toolTip_money; ?>" value="<?php if ($action == "edit") echo $row_log['brewCost']; ?>"><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php if ($dbTable != "recipes") { ?>
<tr>
<td class="dataLabelLeft">Status:</td>
	<td class="data">
	 <select name="brewStatus" id="brewStatus">
     <option value="Primary" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Primary"))) {echo "SELECTED";} } ?>>Primary</option>
     <option value="Secondary" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Secondary"))) {echo "SELECTED";} } ?>>Secondary</option>
     <option value="Tertiary" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Tertiary"))) {echo "SELECTED";} } ?>>Tertiary</option>
     <option value="Lagering" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Lagering"))) {echo "SELECTED";} } ?>>Lagering</option>
	 <option value="Conditioning" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Conditioning"))) {echo "SELECTED";} } ?>>Conditioning</option>
     <option value="On Tap" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "On Tap"))) {echo "SELECTED";} } ?>>On Tap</option>
     <option value="Bottled" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Bottled"))) {echo "SELECTED";} } ?>>Bottled</option>
     <option value="Planned" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], "Planned"))) {echo "SELECTED";} } ?>>Planned</option>
     <option value="" <?php if ($action == "edit") {  if (!(strcmp($row_log['brewStatus'], ""))) {echo "SELECTED";} } ?>>Gone</option>
     </select>
	</td>
	<td class="dataLabel">Tap Date:</td>
	<td class="data"><input name="brewTapDate" type="text" id="brewTapDate" size="20" value="<?php if ($action == "edit") echo $row_log['brewTapDate']; ?>" onfocus="showCalendarControl(this);"></td>
</tr>
<?php } ?>
<tr>
   <td class="dataLabelLeft" colspan="4"><br><?php if ($dbTable != "recipes") echo "General Info About The Brew:"; else echo "Notes:"; ?><br><br><textarea <?php if ($dbTable != "recipes") echo "name=\"brewInfo\""; else echo "name=\"brewNotes\"" ?> cols="67" rows="15"><?php if (($action == "edit") && ($dbTable == "brewing")) echo $row_log['brewInfo']; if ((($action == "edit") && ($dbTable == "recipes")) || (($action == "import") && ($dbTable == "brewing"))) echo $row_log['brewNotes']; ?></textarea></td>
</tr>
<?php if ($dbTable != "recipes") { ?>
<tr>
   <td class="dataLabelLeft" colspan="4"><br>Your Comments About The Brew:<br><br><textarea name="brewComments" cols="67" rows="15"><?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewComments']; ?></textarea></td>
</tr>
<?php } ?>
</table>