<div class="headerContentAdmin">Mash</div>
<?php if ($row_pref['mashDisplayMethod'] == "1") { ?>
<table>
<tr>
	<td class="dataLabelLeft">Mash Profile:</td>
    <td class="data">
    <select name="brewMashProfile" id="brewMashProfile">
    <option value=""></option>
	<?php do {  ?>
    <option value="<?php echo $row_mash_profiles['id']?>" <?php if ((($action == "add") || ($action == "importCalc")) && ($row_user['defaultMashProfile'] == $row_mash_profiles['id'])) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_mash_profiles['id'], $row_log['brewMashProfile']))) {echo "SELECTED";} } ?>><?php echo $row_mash_profiles['mashProfileName']?></option>
    <?php } while ($row_mash_profiles = mysql_fetch_assoc($mash_profiles)); $rows = mysql_num_rows($mash_profiles);	if($rows > 0) {	mysql_data_seek($mash_profiles, 0); $row_mash_profiles = mysql_fetch_assoc($mash_profiles); } ?>
   </select>
   </td>
</tr>
<tr> 
   <td class="dataLabelLeft">Mash Thickness:</td>
   <td class="data"><input name="brewWaterRatio" type="text" id="brewWaterRatio" size="5" value="<?php if ($action == "add") { if ($row_user['defaultWaterRatio'] != "") echo $row_user['defaultWaterRatio']; else echo "1.33"; } if (($action == "edit") || ($action=="reuse")) echo $row_log['brewWaterRatio']; ?>"> <?php echo $row_pref['measWaterGrainRatio']; ?></td>
</tr>

<tr>
   <td class="dataLabelLeft">Pre-boil Wort Amount:</td>
   <td class="data"><input name="brewPreBoilAmt" type="text" id="brewPreBoilAmt" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewPreBoilAmt']; ?>">&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
</tr>
<tr> 
   <td class="dataLabelLeft">Pre-boil Gravity:</td>
   <td class="data"><input name="brewMashGravity" type="text" id="brewMashGravity" size="5" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashGravity']; ?>"></td>
</tr>
</table> 
<?php } else { ?>
<table>
<tr>
   <td class="dataLabelLeft">Mash Type:</td>
   <td class="data"><select name="brewMashType" id="brewMashType">
   					  <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewMashType'] != "")) { ?><option value="<?php echo $row_log['brewMashType']?>"><?php echo $row_log['brewMashType']; ?></option><?php } ?>
                      <option value=""></option>
                      <option value="Infusion" <?php if (($action == "edit") || ($action=="reuse")) { if (!(strcmp($row_log['brewMashType'], "Infusion"))) {echo "SELECTED";} }?>>Infusion</option>
                      <option value="Step"<?php if (($action == "edit") || ($action=="reuse")) { if (!(strcmp($row_log['brewMashType'], "Step"))) {echo "SELECTED";} }?>>Step</option>
                      <option value="Decoction"<?php if (($action == "edit") || ($action=="reuse")) { if (!(strcmp($row_log['brewMashType'], "Decoction"))) {echo "SELECTED";} }?>>Decoction</option>
                    </select>
   </td>
   <td class="dataLabelLeft">Tot. Grain Wt:</td>
   <td class="data"><input name="brewMashGrainWeight" type="text" id="brewMashGrainWeight" tooltipText="<?php echo $toolTip_decimal; ?>" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashGrainWeight']; ?>">&nbsp;<?php echo $row_pref['measWeight2']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Tun Temp:</td>
   <td class="data"><input name="brewMashTunTemp" type="text" id="brewMashTunTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashTunTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
   <td class="dataLabelLeft">Grain Temp:</td>
   <td class="data"><input name="brewMashGrainTemp" type="text" id="brewMashGrainTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashGrainTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Sparge Amt:</td>
   <td class="data"><input name="brewMashSpargAmt" type="text" id="brewMashSpargAmt" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashSpargAmt']; ?>">&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
   <td class="dataLabelLeft">Sparge Temp: </td>
   <td class="data"><input name="brewMashSpargeTemp" type="text" id="brewMashSpargeTemp" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashSpargeTemp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">PH:</td>
   <td class="data"><input name="brewMashPH" type="text" id="brewMashPH" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashPH']; ?>"></td>
   <td class="dataLabelLeft">Temp Adjust?</td>
   <td class="data"><select name="brewMashEquipAdjust" id="brewMashEquipAdjust">
                      <option value=""></option>
			          <option value="True" <?php if (($action == "edit") || ($action=="reuse")) { if (!(strcmp($row_log['brewMashEquipAdjust'], "True"))) {echo "SELECTED";} }?>>True</option>
                      <option value="False" <?php if (($action == "edit") || ($action=="reuse")) { if (!(strcmp($row_log['brewMashEquipAdjust'], "False"))) {echo "SELECTED";} }?>>False</option>
                    </select>
   </td>
</tr>
<tr>
   <td class="dataLabelLeft">Pre-boil Wort Amt:</td>
   <td class="data"><input name="brewPreBoilAmt" type="text" id="brewPreBoilAmt" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewPreBoilAmt']; ?>">&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
   <td class="dataLabelLeft">Pre-boil Gravity:</td>
   <td class="data"><input name="brewMashGravity" type="text" id="brewMashGravity" size="5" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashGravity']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Step 1 Name:</td>
   <td class="data"><input name="brewMashStep1Name" type="text" id="brewMashStep1Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep1Name']; ?>"></td>
   <td class="dataLabelLeft">Time:</td>
   <td class="data"><input name="brewMashStep1Time" type="text" id="brewMashStep1Time" tooltipText="<?php echo $toolTip_decimal; ?>" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep1Time']; ?>">&nbsp;min.</td>
   <td class="dataLabelLeft">Temp:</td>
   <td class="data"><input name="brewMashStep1Temp" type="text" id="brewMashStep1Temp" tooltipText="<?php echo $toolTip_decimal; ?>" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep1Temp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Description:</td>
   <td class="data" colspan="4"><input name="brewMashStep1Desc" type="text" id="brewMashStep1Desc" size="75" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep1Desc']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Step 2 Name:</td>
   <td class="data"><input name="brewMashStep2Name" type="text" id="brewMashStep2Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep2Name']; ?>"></td>
   <td class="dataLabelLeft">Time:</td>
   <td class="data"><input name="brewMashStep2Time" type="text" id="brewMashStep2Time" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep2Time']; ?>">&nbsp;min.</td>
   <td class="dataLabelLeft">Temp:</td>
   <td class="data"><input name="brewMashStep2Temp" type="text" id="brewMashStep2Temp" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep2Temp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Description:</td>
   <td class="data" colspan="4"><input name="brewMashStep2Desc" type="text" id="brewMashStep2Desc" size="75" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep2Desc']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Step 3 Name:</td>
   <td class="data"><input name="brewMashStep3Name" type="text" id="brewMashStep3Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep3Name']; ?>"></td>
   <td class="dataLabelLeft">Time:</td>
   <td class="data"><input name="brewMashStep3Time" type="text" id="brewMashStep3Time" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep3Time']; ?>">&nbsp;min.</td>
   <td class="dataLabelLeft">Temp:</td>
   <td class="data"><input name="brewMashStep3Temp" type="text" id="brewMashStep3Temp" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep3Temp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Description:</td>
   <td class="data" colspan="4"><input name="brewMashStep3Desc" type="text" id="brewMashStep3Desc" size="75" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep3Desc']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Step 4 Name:</td>
   <td class="data"><input name="brewMashStep4Name" type="text" id="brewMashStep4Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep4Name']; ?>"></td>
   <td class="dataLabelLeft">Time:</td>
   <td class="data"><input name="brewMashStep4Time" type="text" id="brewMashStep4Time" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep4Time']; ?>">&nbsp;min.</td>
   <td class="dataLabelLeft">Temp:</td>
   <td class="data"><input name="brewMashStep4Temp" type="text" id="brewMashStep4Temp" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep4Temp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Description:</td>
   <td class="data" colspan="4"><input name="brewMashStep4Desc" type="text" id="brewMashStep4Desc" size="75" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep4Desc']; ?>"></td>
</tr>
<tr>
   <td class="dataLabelLeft">Step 5 Name:</td>
   <td class="data"><input name="brewMashStep5Name" type="text" id="brewMashStep5Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep5Name']; ?>"></td>
   <td class="dataLabelLeft">Time:</td>
   <td class="data"><input name="brewMashStep5Time" type="text" id="brewMashStep5Time" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep5Time']; ?>">&nbsp;min.</td>
   <td class="dataLabelLeft">Temp:</td>
   <td class="data"><input name="brewMashStep5Temp" type="text" id="brewMashStep5Temp" size="5" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep5Temp']; ?>">&nbsp;&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<tr>
   <td class="dataLabelLeft">Description:</td>
   <td class="data" colspan="4"><input name="brewMashStep5Desc" type="text" id="brewMashStep5Desc" size="75" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewMashStep5Desc']; ?>"></td>
</tr>
</table>
<?php } ?>