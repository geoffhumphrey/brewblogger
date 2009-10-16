<div id="headerContentAdmin">Bitterness</div>
<table class="dataTable">
<tr>   
   <td class="dataLabelLeft" width="5%">Bitterness:</td>
   <td class="data" width="15%"><input type="text" name="brewBitterness" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action == "reuse")) echo $row_log['brewBitterness']; if ($action == "importCalc") echo round ($brewBitterness[0], 1); ?>">&nbsp;<?php echo $row_pref['measBitter']; ?></td>
   <td class="dataLabel" width="5%">Formula:</td>
   <td class="data">
   <select name="brewIBUFormula" id="brewIBUFormula">
	<option value="Daniels" <?php if ($action == "add") { if (!(strcmp($row_user['defaultBitternessFormula'], "Daniels"))) echo "SELECTED"; } if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action == "reuse")) { if (!(strcmp($row_log['brewIBUFormula'], "Daniels"))) 	{ echo "SELECTED"; } if (!(strcmp($brewIBUFormula, "Daniels"))) 	{ echo "SELECTED"; } } if ($action == "importCalc") { if (!(strcmp($brewBitterness[1], "Daniels"))) 	{ echo "SELECTED"; } }?>>Daniels</option>
    <option value="Garetz" 	<?php if ($action == "add") { if (!(strcmp($row_user['defaultBitternessFormula'], "Garetz"))) echo "SELECTED"; } if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action == "reuse")) { if (!(strcmp($row_log['brewIBUFormula'], "Garetz"))) 		{ echo "SELECTED"; } if (!(strcmp($brewIBUFormula, "Garetz"))) 		{ echo "SELECTED"; } } if ($action == "importCalc") { if (!(strcmp($brewBitterness[1], "Garetz"))) 		{ echo "SELECTED"; } }?>>Garetz</option>
    <option value="Rager" 	<?php if ($action == "add") { if (!(strcmp($row_user['defaultBitternessFormula'], "Rager"))) echo "SELECTED"; } if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action == "reuse")) { if (!(strcmp($row_log['brewIBUFormula'], "Rager"))) 		{ echo "SELECTED"; } if (!(strcmp($brewIBUFormula, "Rager"))) 		{ echo "SELECTED"; } } if ($action == "importCalc") { if (!(strcmp($brewBitterness[1], "Rager"))) 		{ echo "SELECTED"; } }?>>Rager</option>
    <option value="Tinseth" <?php if ($action == "add") { if (!(strcmp($row_user['defaultBitternessFormula'], "Tinseth"))) echo "SELECTED"; } if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action == "reuse")) { if (!(strcmp($row_log['brewIBUFormula'], "Tinseth"))) 	{ echo "SELECTED"; } if (!(strcmp($brewIBUFormula, "Tinseth")))		{ echo "SELECTED"; } } if ($action == "importCalc") { if (!(strcmp($brewBitterness[1], "Tinseth"))) 	{ echo "SELECTED"; } }?>>Tinseth</option>
  </select>
   </td>
</tr>
</table>