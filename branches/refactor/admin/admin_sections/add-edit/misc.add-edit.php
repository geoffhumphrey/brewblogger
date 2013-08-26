<table class="dataTable">
<tr>
	<td class="dataLabelLeft">Name:</td>
    <td class="data"><input type="text" name="miscName" value="<?php if ($action == "edit") echo $row_log['miscName']; ?>" size="60"></td>
</tr>
<tr>
	<td class="dataLabelLeft">Type:</td>
    <td class="data">
    <select name="miscType" id="miscType">
		<option value="Spice" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscType'], "Spice"))) {echo "SELECTED";} }?>>Spice</option>
    	<option value="Fining" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['MiscType'], "Fining"))) {echo "SELECTED";} }?>>Fining</option>
    	<option value="Water Agent" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscType'], "Water Agent"))) {echo "SELECTED";} }?>>Water Agent</option>
   	 	<option value="Herb" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscType'], "Herb"))) {echo "SELECTED";} }?>>Herb</option>
   	 	<option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscType'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
    	<option value="Other" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscType'], "Other"))) {echo "SELECTED";} }?>>Other</option>
	</select>
    </td>
</tr>
<tr>
	<td class="dataLabelLeft">Use:</td>
    <td class="data">
    <select name="miscUse" id="miscUse">
		<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscUse'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
    	<option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscUse'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
    	<option value="Primary" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscUse'], "Primary"))) {echo "SELECTED";} }?>>Primary</option>
    	<option value="Secondary" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscUse'], "Secondary"))) {echo "SELECTED";} }?>>Secondary</option>
    	<option value="Bottling" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['miscUse'], "Bottling"))) {echo "SELECTED";} }?>>Bottling</option>
	</select>
    </td>
</tr>
<tr>
	<td class="dataLabelLeft">Notes:</td>
    <td class="data"><textarea name="miscNotes" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['miscNotes']; ?></textarea></td>
</tr>
</table>
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>