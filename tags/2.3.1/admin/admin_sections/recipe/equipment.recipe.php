<div id="headerContentAdmin">Equipment</div>
<table class="dataTable">
<tr>
	<td class="dataLabelLeft">Equipment Profile:</td>
    <td class="data">
    <select name="brewEquipProfile" id="brewEquipProfile">
    <option value=""></option>
	<?php do {  ?>
    <option value="<?php echo $row_equip_profiles['id']?>" <?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultEquipProfile'] == $row_equip_profiles['id'])) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_equip_profiles['id'], $row_log['brewEquipProfile']))) {echo "SELECTED";} } ?>><?php echo $row_equip_profiles['equipProfileName']?></option>
    <?php } while ($row_equip_profiles = mysql_fetch_assoc($equip_profiles));  ?>
    </select>
   </td>
</tr>
</table> 