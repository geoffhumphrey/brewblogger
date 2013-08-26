<div class="headerContentAdmin">Fermenting, Lagering, and Aging</div>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft">Primary:</td>
   <td class="data"><input type="text" name="brewPrimary" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewPrimary']; ?>">&nbsp;days @&nbsp;<input name="brewPrimaryTemp" type="text" id="brewPrimaryTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewPrimaryTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Secondary:</td>
   	<td class="data"><input type="text" name="brewSecondary" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewSecondary']; ?>">&nbsp;days @&nbsp;<input name="brewSecondaryTemp" type="text" id="brewSecondaryTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewSecondaryTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Tertiary:</td>
    <td class="data">
 		<input type="text" name="brewTertiary" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewTertiary']; ?>">&nbsp;days @&nbsp;<?php if (($dbTable == "brewing") && ($action == "import")) { ?><input  name="brewTertiaryTemp" type="text" id="brewTertiaryTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php echo $row_log['brewTertiaryTemp'];  ?>"><?php } ?>
<?php if (($dbTable == "recipes") && ($action == "importRecipe")) { ?><input  name="brewTertiaryTemp" type="text" id="brewTertiaryTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php echo $row_log['brewTertiaryTemp'];  ?>"><?php } ?>
<?php if (($dbTable == "recipes") && ($action != "importRecipe")) { ?><input  name="brewTertiaryTemp" type="text" id="brewTertiaryTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action=="edit") || ($action == "reuse")) echo $row_log['brewTertiaryTemp'];  ?>"><?php } ?>
<?php if (($dbTable == "brewing") && ($action != "import")) { ?><input  name="brewTertiaryTemp" type="text" id="brewTertiaryTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action=="edit") || ($action == "reuse")) echo $row_log['brewTertiaryTemp'];  ?>"><?php } ?>&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
 	<td class="dataLabelLeft">Lager:</td>
   	<td class="data"><input type="text" name="brewLager" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewLager']; ?>">&nbsp;days @&nbsp;<input name="brewLagerTemp" type="text" id="brewLagerTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewLagerTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   	<td class="dataLabelLeft">Age:</td>
   	<td class="data"><input type="text" name="brewAge" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAge']; ?>">&nbsp;days @&nbsp;<input name="brewAgeTemp" type="text" id="brewAgeTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAgeTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
</table>