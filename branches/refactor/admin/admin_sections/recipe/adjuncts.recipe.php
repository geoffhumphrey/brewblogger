<?php
/**
 * Module: adjuncts.recipe.php
 * Description: Setup adjuncts part of the page to add/edit blog or recipe.
 */

// $action = ['add' | 'edit' | 'import' | 'reuse' | 'importRecipe' | 'importCalc'] 

echo '<div class="headerContentAdmin">Adjuncts</div>' . "\n";
echo '<table class="dataTable">' . "\n";

for ($i = 0; $i < MAX_ADJ; $i++) {
  echo '<tr>' . "\n";
  echo '<td class="dataLabelLeft" width="5%">Adjunct ' . ($i + 1) . ': </td>' . "\n";
  echo '<td class="data" width="10%"><select name="adjName['.$i.']">' . "\n";
  $key = "brewAddition" . ($i + 1);
  if ((($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) && ($row_log[$key] != "")) {
    echo '<option value="' . $row_log[$key] . '">' . $row_log[$key] . '</option>' . "\n";
  }
  echo '<option value=""></option>' . "\n";
  echo '<option value="">-- Items below are in the Adjunct DB --</option>' . "\n";
  do {
    echo '<option value="' . $row_adjuncts['adjunctName'] . '" ';
    if (($action != "add") && ((($action != "importCalc") && ($row_adjuncts['adjunctName'] == $row_log[$key])) ||
			       (($action == "importCalc") && ($row_adjuncts['adjunctName'] == $adjName[$i])))) {
      echo "SELECTED";
    }
    echo '>' . $row_adjuncts['adjunctName'] . '</option>' . "\n";
  } while ($row_adjuncts = mysql_fetch_array($adjuncts));
  echo '</select></td>' . "\n";
  
  // Reset $row_adjuncts to first row
  $rows = mysql_num_rows($adjuncts);
  if ($rows > 0) {
    mysql_data_seek($adjuncts, 0);
    $row_adjuncts = mysql_fetch_array($adjuncts);
  }

  echo '<td class="dataLabel" width="5%">Weight:</td>' . "\n";
  $key = "brewAddition" . ($i +1) . "Amt";
  echo '<td class="data"><input name="adjWeight['.$i.']" type="text" tooltipText="' . $toolTip_decimal . '" value="';
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    echo $row_log[$key];
  }
  if ($action == "importCalc") {
    echo $adjWeight[$i];
  }
  echo '" size="10" maxlength="20">&nbsp;' . $row_pref['measWeight2'] . '</td>' . "\n";
  echo '</tr>' . "\n";
}

/*
<tr>
   <td class="dataLabelLeft" width="5%">Adjunct 1: </td>
   <td class="data" width="10%">
   <select name="brewAdjunct1">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition1'] != "")) { ?><option value="<?php echo $row_log['brewAddition1']; ?>"><?php echo $row_log['brewAddition1']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action=="reuse")) {  if ($row_adjuncts['adjunctName'] == $row_log['brewAddition1']) echo "SELECTED"; } if ($action == "importCalc") { if ($row_adjuncts['adjunctName'] == $brewAdjunct1) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel" width="5%">Weight:</td>
   <td class="data"><input name="brewAdjunct1Weight" type="text" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition1Amt']; if ($action == "importCalc") echo $brewAdjunct1Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 2:</td>
   <td class="data">
   <select name="brewAdjunct2">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition2'] != "")) { ?><option value="<?php echo $row_log['brewAddition2']; ?>"><?php echo $row_log['brewAddition2']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition2']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct2))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct2Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition2Amt']; if ($action == "importCalc") echo $brewAdjunct2Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 3:</td>
   <td class="data">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition3'] != "")) { ?><option value="<?php echo $row_log['brewAddition3']; ?>"><?php echo $row_log['brewAddition3']; ?></option><?php } ?>
   <select name="brewAdjunct3">
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition3']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct3))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct3Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition3Amt']; if ($action == "importCalc") echo $brewAdjunct3Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 4:</td>
   <td class="data">
   <select name="brewAdjunct4">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition4'] != "")) { ?><option value="<?php echo $row_log['brewAddition4']; ?>"><?php echo $row_log['brewAddition4']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition4']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct4))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct4Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition4Amt']; if ($action == "importCalc") echo $brewAdjunct4Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 5:</td>
   <td class="data">
   <select name="brewAdjunct5">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition5'] != "")) { ?><option value="<?php echo $row_log['brewAddition5']; ?>"><?php echo $row_log['brewAddition5']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition5']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct5))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct5Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition5Amt']; if ($action == "importCalc") echo $brewAdjunct5Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 6:</td>
   <td class="data">
   <select name="brewAdjunct6">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition6'] != "")) { ?><option value="<?php echo $row_log['brewAddition6']; ?>"><?php echo $row_log['brewAddition6']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition6']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct6))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct6Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition6Amt']; if ($action == "importCalc") echo $brewAdjunct6Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 7:</td>
   <td class="data">
   <select name="brewAdjunct7">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition7'] != "")) { ?><option value="<?php echo $row_log['brewAddition7']; ?>"><?php echo $row_log['brewAddition7']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition7']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct7))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct7Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition7Amt']; if ($action == "importCalc") echo $brewAdjunct7Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
<td class="dataLabelLeft">Adjunct 8:</td>
   	<td class="data">
   <select name="brewAdjunct8">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition8'] != "")) { ?><option value="<?php echo $row_log['brewAddition8']; ?>"><?php echo $row_log['brewAddition8']; ?></option><?php } ?>
   <option value=""></option>
	<option value="">-- Items below are in the Adjunct DB --</option> 
	<?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition8']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct8))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAdjunct8Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition8Amt']; if ($action == "importCalc") echo $brewAdjunct8Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Adjunct 9:</td>
   	<td class="data">
   	<select name="brewAdjunct9">
   	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition9'] != "")) { ?><option value="<?php echo $row_log['brewAddition9']; ?>"><?php echo $row_log['brewAddition9']; ?></option><?php } ?>
   	<option value=""></option>
    <option value="">-- Items below are in the Adjunct DB --</option>
   	<?php do {  ?>
   	<option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition9']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAdjunct9))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   	<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   	</select>
   	</td>
   	<td class="dataLabel">Weight:</td>
   	<td class="data"><input type="text" name="brewAdjunct9Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition9Amt']; if ($action == "importCalc") echo $brewAdjunct9Weight; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
*/

?>
</table>