<div id="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>/information.png" border="0"></a></div>Grains</div>
<table>
<tr>
   <td class="dataLabelLeft" width="5%">Grain 1:</td>
   <td class="data" width="10%">
   <select name="brewGrain1" id="brewGrain1">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain1'] != "")) { ?><option value="<?php echo $row_log['brewGrain1']; ?>"><?php echo $row_log['brewGrain1']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	<?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain1']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain1 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains);	if($rows > 0) {	mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); } ?>
   </select>
   </td>
   <td class="dataLabel" width="5%">Weight:</td>
   <td class="data"><input name="brewGrain1Weight" type="text" id="brewGrain1Weight" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain1Weight']; if ($action == "importCalc") echo $brewGrain1Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 2:</td>
   <td class="data">
   <select name="brewGrain2" id="brewGrain2">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain2'] != "")) { ?><option value="<?php echo $row_log['brewGrain2']; ?>"><?php echo $row_log['brewGrain2']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	<?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain2']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain2 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain2Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain2Weight']; if ($action == "importCalc") echo $brewGrain2Weight;?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 3:</td>
   <td class="data">
   <select name="brewGrain3" id="brewGrain3">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain3'] != "")) { ?><option value="<?php echo $row_log['brewGrain3']; ?>"><?php echo $row_log['brewGrain3']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	<?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain3']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain3 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain3Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain3Weight']; if ($action == "importCalc") echo $brewGrain3Weight;?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 4:</td>
   <td class="data">
   <select name="brewGrain4" id="brewGrain4">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain4'] != "")) { ?><option value="<?php echo $row_log['brewGrain4']; ?>"><?php echo $row_log['brewGrain4']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	<?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>"<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain4']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain4 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain4Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain4Weight']; if ($action == "importCalc") echo $brewGrain4Weight;?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 5:</td>
   <td class="data">
	<select name="brewGrain5" id="brewGrain5">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain5'] != "")) { ?><option value="<?php echo $row_log['brewGrain5']; ?>"><?php echo $row_log['brewGrain5']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	<?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain5']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain5 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain5Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain5Weight']; if ($action == "importCalc") echo $brewGrain5Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 6:</td>
   <td class="data">
	<select name="brewGrain6" id="brewGrain6">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain6'] != "")) { ?><option value="<?php echo $row_log['brewGrain6']; ?>"><?php echo $row_log['brewGrain6']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	<?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain6']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain6 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain6Weight" type="text" id="brewGrain6Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain6Weight']; if ($action == "importCalc") echo $brewGrain6Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 7:</td>
   <td class="data">
   <select name="brewGrain7" id="brewGrain7">
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain7'] != "")) { ?><option value="<?php echo $row_log['brewGrain7']; ?>"><?php echo $row_log['brewGrain7']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
	 <?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain7']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain7 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain7Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain7Weight']; if ($action == "importCalc") echo $brewGrain8Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 8:</td>
   <td class="data">
   <select name="brewGrain8" id="brewGrain8">
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain8'] != "")) { ?><option value="<?php echo $row_log['brewGrain8']; ?>"><?php echo $row_log['brewGrain8']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
    <?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>"<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain8']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain8 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain8Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain8Weight']; if ($action == "importCalc") echo $brewGrain8Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Grain 9:</td>
   <td class="data">
   <select name="brewGrain9" id="brewGrain9">
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewGrain9'] != "")) { ?><option value="<?php echo $row_log['brewGrain9']; ?>"><?php echo $row_log['brewGrain9']; ?></option><?php } ?>
    <option value="">
</option><option value="">-- Items below are in the Grain DB --</option>
     <?php do {  ?>
    <option value="<?php echo $row_grains['maltName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_grains['maltName'], $row_log['brewGrain9']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewGrain9 == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']?></option>
    <?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   </select>
</td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewGrain9Weight" type="text" id="brewGrain1Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewGrain9Weight']; if ($action == "importCalc") echo $brewGrain9Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
</table>