<div id="headerContentAdmin">Gravity</div>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft" width="5%">Original:</td>
   <td class="data" width="10%"><input name="brewOG" type="text" size="10" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if (($action == "importRecipe") || ($action == "edit") || (($action == "reuse") && ($dbTable == "recipes"))) echo $row_log['brewOG']; if (($action == "importCalc") && ($dbTable == "recipes")) echo round ($brewOG, 3);  ?>"></td>
   <td class="dataLabel" width="5%"><?php if ($dbTable == "brewing") echo "Target OG:"; else echo "&nbsp;"; ?></td>
   <td class="data"><?php if ($dbTable == "brewing") { ?><input name="brewTargetOG" type="text" size="10" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "import") echo $row_log['brewOG']; elseif (($action == "edit") || ($action == "reuse")) echo $row_log['brewTargetOG']; elseif ($action == "importCalc") echo round ($brewTargetOG, 3); ?>"><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php if ($dbTable == "brewing") { ?>
<tr>
   <td class="dataLabelLeft">Reading 1:</td>
   <td class="data"><input name="brewGravity1" type="text" id="brewGravity1" size="10" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "edit") echo $row_log['brewGravity1']; ?>"></td>
   <td class="dataLabel">Days:</td>
   <td class="data"><input name="brewGravity1Days" type="text" id="brewGravity1Days" size="10" value="<?php if ($action == "edit") echo $row_log['brewGravity1Days']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Reading 2:</td>
   <td class="data"><input name="brewGravity2" type="text" id="brewGravity2" tooltipText="<?php echo $toolTip_gravity; ?>" size="10" value="<?php if ($action == "edit") echo $row_log['brewGravity2']; ?>"></td>
   <td class="dataLabel">Days:</td>
   <td class="data"><input name="brewGravity2Days" type="text" id="brewGravity2Days" size="10" value="<?php if ($action == "edit") echo $row_log['brewGravity2Days']; ?>"></td>
</tr>
<?php } ?>
<tr>
   <td class="dataLabelLeft">Final:</td>
   <td class="data"><input name="brewFG" type="text" size="10" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if (($action == "importRecipe") || ($action == "edit") || (($action == "reuse") && ($dbTable == "recipes"))) echo $row_log['brewFG'];  if (($action == "importCalc") && ($dbTable == "recipes")) echo round ($brewFG, 3);  ?>"></td>
   <td class="dataLabel" width="5%"><?php if ($dbTable == "brewing") echo "Target FG:"; else echo "&nbsp;"; ?></td>
   <td class="data"><?php if ($dbTable == "brewing") { ?><input name="brewTargetFG" type="text" size="10" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "import") echo $row_log['brewFG']; elseif (($action == "edit") || ($action == "reuse")) echo $row_log['brewTargetFG']; elseif ($action == "importCalc") echo round ($brewTargetFG, 3); ?>"><?php } else echo "&nbsp;"; ?></td>
</tr>
</table>