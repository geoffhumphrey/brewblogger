<div id="headerContentAdmin">Water</div>
<?php  if ($row_pref['waterDisplayMethod'] == "1") { ?>
<table>
<td class="dataLabelLeft" width="5%">Water Profile:</td>
   <td class="data">
   <select name="brewWaterProfile">
   <option value=""></option>
   <?php do {  ?>
   <option value="<?php echo $row_water_profiles['id']; ?>"  <?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultWaterProfile'] == $row_water_profiles['id'])) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_water_profiles['id'], $row_log['brewWaterProfile']))) {echo "SELECTED";} } ?>/><?php echo $row_water_profiles['waterName']; ?></option>
   <?php } while ($row_water_profiles = mysql_fetch_assoc($water_profiles)); ?>
   </select>
   </td>
</tr>
</table>
<?php } else { ?>
<table>
<tr>
   <td class="dataLabelLeft">Source:</td>
   <td class="data"><input name="brewWaterName" type="text" id="brewWaterName" size="50" maxlength="250" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterName']; ?>"></td>
</tr>
</table>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft">Calcium:</td>
   <td class="data"><input name="brewWaterCalcium" type="text" id="brewWaterCalcium" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterCalcium']; ?>"></td>
   <td class="dataLabelLeft">Amount:</td>
   <td class="data"><input name="brewWaterAmount" type="text" id="brewWaterAmount" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterAmount']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Chloride:</td>
   <td class="data"><input name="brewWaterChloride" type="text" id="brewWaterChloride" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterChloride']; ?>"></td>
   <td class="dataLabelLeft">Bicarbonate:</td>
   <td class="data"><input name="brewWaterBicarb" type="text" id="brewWaterBicarb" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterBicarb']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Magnesium:</td>
   <td class="data"><input name="brewWaterMagnesium" type="text" id="brewWaterMagnesium" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterMagnesium']; ?>"></td>
   <td class="dataLabelLeft">Sulfate:</td>
   <td class="data"><input name="brewWaterSulfate" type="text" id="brewWaterSulfate" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterSulfate']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">PH:</td>
   <td class="data"><input name="brewWaterPH" type="text" id="brewWaterPH" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterPH']; ?>"></td>
   <td class="dataLabelLeft">Sodium:</td>
   <td class="data"><input name="brewWaterSodium" type="text" id="brewWaterSodium" size="10" maxlength="25" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit")|| ($action=="reuse")) echo $row_log['brewWaterSodium']; ?>"></td>
</tr>
</table>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft">Notes:</td>
   <td class="data"><input name="brewWaterNotes" type="text" id="brewWaterNotes" size="80" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterNotes']; ?>"></td>
</tr>
<tr>
</table>
<?php } ?>