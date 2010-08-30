<div class="headerContentAdmin">Adjuncts</div>
<table>     
<tr>
   <td class="dataLabelLeft" width="5%">Adjunct 1:</td>
   <td class="data" width="10%">
   <select name="brewAddition1">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition1'] != "")) { ?><option value="<?php echo $row_log['brewAddition1']; ?>"><?php echo $row_log['brewAddition1']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition1']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition1))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel" width="5%">Weight:</td>
   <td class="data"><input name="brewAddition1Amt" type="text" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition1Amt']; if ($action == "importCalc") echo $brewAddition1Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 2:</td>
   <td class="data">
   <select name="brewAddition2">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition2'] != "")) { ?><option value="<?php echo $row_log['brewAddition2']; ?>"><?php echo $row_log['brewAddition2']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition2']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition2))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition2Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition2Amt']; if ($action == "importCalc") echo $brewAddition2Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 3:</td>
   <td class="data">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition3'] != "")) { ?><option value="<?php echo $row_log['brewAddition3']; ?>"><?php echo $row_log['brewAddition3']; ?></option><?php } ?>
   <select name="brewAddition3">
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition3']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition3))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition3Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition3Amt']; if ($action == "importCalc") echo $brewAddition3Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 4:</td>
   <td class="data">
   <select name="brewAddition4">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition4'] != "")) { ?><option value="<?php echo $row_log['brewAddition4']; ?>"><?php echo $row_log['brewAddition4']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition4']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition4))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition4Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition4Amt']; if ($action == "importCalc") echo $brewAddition4Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 5:</td>
   <td class="data">
   <select name="brewAddition5">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition5'] != "")) { ?><option value="<?php echo $row_log['brewAddition5']; ?>"><?php echo $row_log['brewAddition5']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition5']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition5))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition5Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition5Amt']; if ($action == "importCalc") echo $brewAddition5Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 6:</td>
   <td class="data">
   <select name="brewAddition6">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition6'] != "")) { ?><option value="<?php echo $row_log['brewAddition6']; ?>"><?php echo $row_log['brewAddition6']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition6']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition6))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition6Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition6Amt']; if ($action == "importCalc") echo $brewAddition6Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Adjunct 7:</td>
   <td class="data">
   <select name="brewAddition7">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition7'] != "")) { ?><option value="<?php echo $row_log['brewAddition7']; ?>"><?php echo $row_log['brewAddition7']; ?></option><?php } ?>
   <option value=""></option>
   <option value="">-- Items below are in the Adjunct DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition7']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition7))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition7Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition7Amt']; if ($action == "importCalc") echo $brewAddition7Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
<td class="dataLabelLeft">Adjunct 8:</td>
   	<td class="data">
   <select name="brewAddition8">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition8'] != "")) { ?><option value="<?php echo $row_log['brewAddition8']; ?>"><?php echo $row_log['brewAddition8']; ?></option><?php } ?>
   <option value=""></option>
	<option value="">-- Items below are in the Adjunct DB --</option> 
	<?php do {  ?>
   <option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition8']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition8))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   <?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input type="text" name="brewAddition8Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition8Amt']; if ($action == "importCalc") echo $brewAddition8Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft">Adjunct 9:</td>
   	<td class="data">
   	<select name="brewAddition9">
   	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewAddition9'] != "")) { ?><option value="<?php echo $row_log['brewAddition9']; ?>"><?php echo $row_log['brewAddition9']; ?></option><?php } ?>
   	<option value=""></option>
    <option value="">-- Items below are in the Adjunct DB --</option>
   	<?php do {  ?>
   	<option value="<?php echo $row_adjuncts['adjunctName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_adjuncts['adjunctName'], $row_log['brewAddition9']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_adjuncts['adjunctName'], $brewAddition9))) {echo "SELECTED";} } ?>><?php echo $row_adjuncts['adjunctName']?></option>
   	<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   	</select>
   	</td>
   	<td class="dataLabel">Weight:</td>
   	<td class="data"><input type="text" name="brewAddition9Amt" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewAddition9Amt']; if ($action == "importCalc") echo $brewAddition9Amt; ?>" size="10" maxlength="20">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
</table>