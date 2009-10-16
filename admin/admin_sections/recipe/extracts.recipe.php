<div id="headerContentAdmin">Malt Extracts</div>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft" width="5%">Extract 1:</td>
   <td class="data" width="10%">
   <select name="brewExtract1">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewExtract1'] != "")) { ?><option value="<?php echo $row_log['brewExtract1']; ?>"><?php echo $row_log['brewExtract1']; ?></option><?php } ?>
   <option value="">
</option><option value="">-- Items below are in the Extracts DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_extracts['extractName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_extracts['extractName'], $row_log['brewExtract1']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_extracts['extractName'], $brewExtract1))) {echo "SELECTED";} } ?>><?php echo $row_extracts['extractName']?></option>
   <?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
   </select>
   </td>
   <td class="dataLabel" width="5%">Weight:</td>
   <td class="data"><input name="brewExtract1Weight" type="text" id="brewExtract1Weight" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewExtract1Weight'];  if ($action == "importCalc") echo $brewExtract1Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Extract 2:</td>
   <td class="data">
   <select name="brewExtract2">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewExtract2'] != "")) { ?><option value="<?php echo $row_log['brewExtract2']; ?>"><?php echo $row_log['brewExtract2']; ?></option><?php } ?>
   <option value="">
</option><option value="">-- Items below are in the Extracts DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_extracts['extractName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_extracts['extractName'], $row_log['brewExtract2']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_extracts['extractName'], $brewExtract2))) {echo "SELECTED";} } ?>><?php echo $row_extracts['extractName']?></option>
   <?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewExtract2Weight" type="text" id="brewExtract2Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewExtract2Weight'];  if ($action == "importCalc") echo $brewExtract2Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Extract 3:</td>
  <td class="data">
   <select name="brewExtract3">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewExtract3'] != "")) { ?><option value="<?php echo $row_log['brewExtract3']; ?>"><?php echo $row_log['brewExtract3']; ?></option><?php } ?>
   <option value="">
</option><option value="">-- Items below are in the Extracts DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_extracts['extractName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_extracts['extractName'], $row_log['brewExtract3']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_extracts['extractName'], $brewExtract3))) {echo "SELECTED";} } ?>><?php echo $row_extracts['extractName']?></option>
   <?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewExtract3Weight" type="text" id="brewExtract3Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewExtract3Weight'];  if ($action == "importCalc") echo $brewExtract3Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Extract 4:</td>
   <td class="data">
   <select name="brewExtract4">
   <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewExtract4'] != "")) { ?><option value="<?php echo $row_log['brewExtract4']; ?>"><?php echo $row_log['brewExtract4']; ?></option><?php } ?>
   <option value="">
</option><option value="">-- Items below are in the Extracts DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_extracts['extractName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_extracts['extractName'], $row_log['brewExtract4']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_extracts['extractName'], $brewExtract4))) {echo "SELECTED";} } ?>><?php echo $row_extracts['extractName']?></option>
   <?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewExtract4Weight" type="text" id="brewExtract4Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewExtract4Weight'];  if ($action == "importCalc") echo $brewExtract4Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Extract 5:</td>
   <td class="data">
   <select name="brewExtract5">
      <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewExtract5'] != "")) { ?><option value="<?php echo $row_log['brewExtract5']; ?>"><?php echo $row_log['brewExtract5']; ?></option><?php } ?>
   <option value="">
</option><option value="">-- Items below are in the Extracts DB --</option>
   <?php do {  ?>
   <option value="<?php echo $row_extracts['extractName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_extracts['extractName'], $row_log['brewExtract5']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_extracts['extractName'], $brewExtract5))) {echo "SELECTED";} } ?>><?php echo $row_extracts['extractName']?></option>
   <?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
   </select>
   </td>
   <td class="dataLabel">Weight:</td>
   <td class="data"><input name="brewExtract5Weight" type="text" id="brewExtract5Weight" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewExtract5Weight'];  if ($action == "importCalc") echo $brewExtract5Weight; ?>" size="5">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
</table>