<div id="headerContentAdmin">Miscellaneous (<em>NON-Fermentable</em> Ingredients)</div>
<table>
<tr>
  <td width="5%" class="dataLabelLeft">Miscellaneous 1:</td>
  <td width="10%" class="data">
   <select name="brewMisc1Name">
   	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewMisc1Name'] != "")) { ?><option value="<?php echo $row_log['brewMisc1Name']; ?>"><?php echo $row_log['brewMisc1Name']; ?></option><?php } ?>
   	<option value=""></option>
    <option value="">-- Items below are in the Misc DB --</option>
   	<?php do {  ?>
   	<option value="<?php echo $row_misc['miscName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_misc['miscName'], $row_log['brewMisc1Name']))) {echo "SELECTED";} } ?>><?php echo $row_misc['miscName']?></option>
   	<?php } while ($row_misc = mysql_fetch_assoc($misc)); $rows = mysql_num_rows($misc); if($rows > 0) { mysql_data_seek($misc, 0); $row_misc = mysql_fetch_assoc($misc); } ?>
   	</select>   </td>
   <td width="5%" class="dataLabel">Time:</td>
   <td width="10%" nowrap="nowrap" class="data"><input name="brewMisc1Time" type="text" id="brewMisc1Time" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc1Time']; ?>"> 
   min.</td>
   <td width="5%" class="dataLabel">Amount:</td>
   <td class="data"><input name="brewMisc1Amount" type="text" id="brewMisc1Amount" size="10" maxlength="250"value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc1Amount']; ?>"></td>
</tr>
<tr>
   <td width="5%" class="dataLabelLeft">Miscellaneous 2:</td>
   <td width="10%" class="data">
   <select name="brewMisc2Name">
   	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewMisc2Name'] != "")) { ?><option value="<?php echo $row_log['brewMisc2Name']; ?>"><?php echo $row_log['brewMisc2Name']; ?></option><?php } ?>
   	<option value=""></option>
    <option value="">-- Items below are in the Misc DB --</option>
   	<?php do {  ?>
   	<option value="<?php echo $row_misc['miscName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_misc['miscName'], $row_log['brewMisc2Name']))) {echo "SELECTED";} } ?>><?php echo $row_misc['miscName']?></option>
   	<?php } while ($row_misc = mysql_fetch_assoc($misc)); $rows = mysql_num_rows($misc); if($rows > 0) { mysql_data_seek($misc, 0); $row_misc = mysql_fetch_assoc($misc); } ?>
   	</select>   </td>
   <td width="5%" class="dataLabel">Time:</td>
   <td width="10%" class="data"><input name="brewMisc2Time" type="text" id="brewMisc2Time" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc2Time']; ?>"> 
   min.</td>
   <td width="5%" class="dataLabel">Amount:</td>
   <td class="data"><input name="brewMisc2Amount" type="text" id="brewMisc2Amount" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc2Amount']; ?>"></td>
</tr>
<tr>
   <td width="5%" class="dataLabelLeft">Miscellaneous 3:</td>
   <td width="10%" class="data">
   <select name="brewMisc3Name">
   	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewMisc3Name'] != "")) { ?><option value="<?php echo $row_log['brewMisc3Name']; ?>"><?php echo $row_log['brewMisc3Name']; ?></option><?php } ?>
   	<option value=""></option>
    <option value="">-- Items below are in the Misc DB --</option>
   	<?php do {  ?>
   	<option value="<?php echo $row_misc['miscName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_misc['miscName'], $row_log['brewMisc3Name']))) {echo "SELECTED";} } ?>><?php echo $row_misc['miscName']?></option>
   	<?php } while ($row_misc = mysql_fetch_assoc($misc)); $rows = mysql_num_rows($misc); if($rows > 0) { mysql_data_seek($misc, 0); $row_misc = mysql_fetch_assoc($misc); } ?>
   	</select>   </td>
   <td width="5%" class="dataLabel">Time:</td>
   <td width="10%" class="data"><input name="brewMisc3Time" type="text" id="brewMisc3Time" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc3Time']; ?>"> 
   min.</td>
   <td width="5%" class="dataLabel">Amount:</td>
   <td class="data"><input name="brewMisc3Amount" type="text" id="brewMisc3Amount" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc3Amount']; ?>"></td>
</tr>
<tr>
   <td width="5%" class="dataLabelLeft">Miscellaneous 4:</td>
   <td width="10%" class="data">
   <select name="brewMisc4Name">
   	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewMisc4Name'] != "")) { ?><option value="<?php echo $row_log['brewMisc4Name']; ?>"><?php echo $row_log['brewMisc4Name']; ?></option><?php } ?>
   	<option value=""></option>
    <option value="">-- Items below are in the Misc DB --</option>
   	<?php do {  ?>
   	<option value="<?php echo $row_misc['miscName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_misc['miscName'], $row_log['brewMisc4Name']))) {echo "SELECTED";} } ?>><?php echo $row_misc['miscName']?></option>
   	<?php } while ($row_misc = mysql_fetch_assoc($misc)); $rows = mysql_num_rows($misc); if($rows > 0) { mysql_data_seek($misc, 0); $row_misc = mysql_fetch_assoc($misc); } ?>
   	</select>   </td>
   <td width="5%" class="dataLabel">Time:</td>
   <td width="10%" class="data"><input name="brewMisc4Time" type="text" id="brewMisc4Time" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc4Time']; ?>"> 
   min.</td>
   <td width="5%" class="dataLabel">Amount:</td>
   <td class="data"><input name="brewMisc4Amount" type="text" id="brewMisc4Amount" size="10" maxlength="250" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewMisc4Amount']; ?>"></td>
</tr>
</table>
