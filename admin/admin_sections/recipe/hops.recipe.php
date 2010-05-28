<div id="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=hops&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>/information.png" border="0"></a></div>Hops</div>
<table class="dataTable">
<tr>
   <td>&nbsp;</td>
   <td class="dataLabel">Name</td>
   <td class="dataLabel">Wt</td>
   <td class="dataLabel">AAU</td>
   <td class="dataLabel">Time</td>
   <td class="dataLabel">Use</td>
   <td class="dataLabel">Type</td>
   <td class="dataLabel">Form</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 1:</td>
   <td class="data">
   <select name="brewHops1" >
    <?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops1'] != "")) { ?><option value="<?php echo $row_log['brewHops1']?>"><?php echo $row_log['brewHops1']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops1']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops1 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
     <td nowrap="nowrap" class="data"><input name="brewHops1Weight" type="text" id="brewHops1Weight" size="1" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops1Weight']; if ($action == "importCalc") echo $brewHops1Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td nowrap="nowrap" class="data"><input name="brewHops1IBU" type="text" id="brewHops1IBU" size="1" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops1IBU']; if ($action == "importCalc") echo $brewHops1IBU; ?>">&nbsp;%</td>
    <td nowrap="nowrap" class="data"><input type="text" name="brewHops1Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops1Time'];  if ($action == "importCalc") echo $brewHops1Time; ?>">&nbsp;min.</td>
<td class="data"><select name="brewHops1Use" id="brewHops1Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select></td>
     <td class="data"><select name="brewHops1Type" id="brewHops1Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                  </select></td>
     <td class="data"><select name="brewHops1Form" id="brewHops1Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops1Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops1Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops1Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops1Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
                    
                 </td>
                </tr>
                <tr>
      <td class="dataLabelLeft">Hop 2:</td>
    <td class="data">
   <select name="brewHops2" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops2'] != "")) { ?><option value="<?php echo $row_log['brewHops2']?>"><?php echo $row_log['brewHops2']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops2']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops2 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
   <td class="data"><input name="brewHops2Weight" type="text" id="brewHops2Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops2Weight']; if ($action == "importCalc") echo $brewHops2Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
   <td class="data"><input name="brewHops2IBU" type="text" id="brewHops2IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops2IBU']; if ($action == "importCalc") echo $brewHops2IBU; ?>">&nbsp;%</td>
   <td class="data"><input type="text" name="brewHops2Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops2Time']; if ($action == "importCalc") echo $brewHops2Time; ?>">&nbsp;min.</td>
   <td class="data"><select name="brewHops2Use" id="brewHops2Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select>
   </td>
   <td class="data"><select name="brewHops2Type" id="brewHops2Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                  </select></td>
     <td class="data"><select name="brewHops2Form" id="brewHops2Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops2Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops2Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops2Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops2Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 3:</td>
   <td class="data">
   <select name="brewHops3" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops3'] != "")) { ?><option value="<?php echo $row_log['brewHops3']?>"><?php echo $row_log['brewHops3']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops3']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops3 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
     <td class="data"><input name="brewHops3Weight" type="text" id="brewHops3Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops3Weight']; if ($action == "importCalc") echo $brewHops3Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
     <td class="data"><input name="brewHops3IBU" type="text" id="brewHops3IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops3IBU']; if ($action == "importCalc") echo $brewHops3IBU; ?>">&nbsp;%</td>
     <td class="data"><input type="text" name="brewHops3Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops3Time']; if ($action == "importCalc") echo $brewHops3Time; ?>">&nbsp;min.</td>
     <td class="data"><select name="brewHops3Use" id="brewHops3Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select>
   </td>
     <td class="data"><select name="brewHops3Type" id="brewHops3Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                  </select>
	 </td>
     <td class="data"><select name="brewHops3Form" id="brewHops3Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops3Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops3Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops3Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops3Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 4:</td>
   <td class="data">
   <select name="brewHops4" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops4'] != "")) { ?><option value="<?php echo $row_log['brewHops4']?>"><?php echo $row_log['brewHops4']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops4']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops4 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
   <td class="data"><input name="brewHops4Weight" type="text" id="brewHops4Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops4Weight']; if ($action == "importCalc") echo $brewHops4Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
   <td class="data"><input name="brewHops4IBU" type="text" id="brewHops4IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops4IBU']; if ($action == "importCalc") echo $brewHops4IBU; ?>">&nbsp;%</td>
   <td class="data"><input type="text" name="brewHops4Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops4Time']; if ($action == "importCalc") echo $brewHops4Time; ?>">&nbsp;min.</td>
   <td class="data"><select name="brewHops4Use" id="brewHops4Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select>
   </td>
   <td class="data"><select name="brewHops4Type" id="brewHops4Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                    </select>
	 </td>
     <td class="data"><select name="brewHops4Form" id="brewHops4Form">
                   <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops4Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops4Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops4Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops4Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 5:</td>
   <td class="data">
   <select name="brewHops5" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops5'] != "")) { ?><option value="<?php echo $row_log['brewHops5']?>"><?php echo $row_log['brewHops5']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops5']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops5 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
   <td class="data"><input name="brewHops5Weight" type="text" id="brewHops5Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops5Weight']; if ($action == "importCalc") echo $brewHops5Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
   <td class="data"><input name="brewHops5IBU" type="text" id="brewHops5IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops5IBU']; if ($action == "importCalc") echo $brewHops5IBU; ?>">&nbsp;%</td>
   <td class="data"><input type="text" name="brewHops5Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops5Time']; if ($action == "importCalc") echo $brewHops5Time; ?>">&nbsp;min.</td>
   <td class="data"><select name="brewHops5Use" id="brewHops5Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                     </select>
   </td>
   <td class="data"><select name="brewHops5Type" id="brewHops5Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                    </select>
	 </td>
     <td class="data"><select name="brewHops5Form" id="brewHops5Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops5Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops5Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops5Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops5Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 6:</td>
   <td class="data">
   <select name="brewHops6" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops6'] != "")) { ?><option value="<?php echo $row_log['brewHops6']?>"><?php echo $row_log['brewHops6']; ?></option><?php } ?>
	<option value="">
</option><option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops6']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops6 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
   <td class="data"><input name="brewHops6Weight" type="text" id="brewHops6Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops6Weight']; if ($action == "importCalc") echo $brewHops6Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
   <td class="data"><input name="brewHops6IBU" type="text" id="brewHops6IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops6IBU']; if ($action == "importCalc") echo $brewHops6IBU; ?>">&nbsp;%</td>
   <td class="data"><input type="text" name="brewHops6Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops6Time']; if ($action == "importCalc") echo $brewHops6Time; ?>">&nbsp;min.</td>
   <td class="data"><select name="brewHops6Use" id="brewHops6Use">
   					<option value=""></option>
                    <option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select>
   </td>
   <td class="data"><select name="brewHops6Type" id="brewHops6Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                    </select>
	 </td>
     <td class="data"><select name="brewHops6Form" id="brewHops6Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops6Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops6Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops6Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops6Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 7:</td>
   <td class="data">
   <select name="brewHops7" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops7'] != "")) { ?><option value="<?php echo $row_log['brewHops7']?>"><?php echo $row_log['brewHops7']; ?></option><?php } ?>
	<option value=""></option>
<option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops7']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops7 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
     <td class="data"><input name="brewHops7Weight" type="text" id="brewHops7Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops7Weight']; if ($action == "importCalc") echo $brewHops7Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
     <td class="data"><input name="brewHops7IBU" type="text" id="brewHops7IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops7IBU']; if ($action == "importCalc") echo $brewHops7IBU; ?>">&nbsp;%</td>
     <td class="data"><input type="text" name="brewHops7Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops7Time']; if ($action == "importCalc") echo $brewHops7Time; ?>">&nbsp;min.</td>
     <td class="data"><select name="brewHops7Use" id="brewHops7Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select>
   </td>
   <td class="data"><select name="brewHops7Type" id="brewHops7Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                    </select>
	 </td>
     <td class="data"><select name="brewHops7Form" id="brewHops7Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops7Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops7Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops7Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops7Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 8:</td>
   <td class="data">
   <select name="brewHops8" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops8'] != "")) { ?><option value="<?php echo $row_log['brewHops8']?>"><?php echo $row_log['brewHops8']; ?></option><?php } ?>
	<option value=""></option>
<option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops8']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops8 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
   <td class="data"><input name="brewHops8Weight" type="text" id="brewHops8Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops8Weight']; if ($action == "importCalc") echo $brewHops8Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
   <td class="data"><input name="brewHops8IBU" type="text" id="brewHops8IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops8IBU']; if ($action == "importCalc") echo $brewHops8IBU; ?>">&nbsp;%</td>
   <td class="data"><input type="text" name="brewHops8Time" size="1"  value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops8Time']; if ($action == "importCalc") echo $brewHops8Time; ?>">&nbsp;min.</td>
   <td class="data"><select name="brewHops8Use" id="brewHops8Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                  </select>
   </td>
   <td class="data"><select name="brewHops8Type" id="brewHops8Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                    </select>
	 </td>
     <td class="data"><select name="brewHops8Form" id="brewHops8Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops8Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops8Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops8Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops8Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
<tr>
   <td class="dataLabelLeft">Hop 9:</td>
   <td class="data">
   <select name="brewHops9" >
	<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewHops9'] != "")) { ?><option value="<?php echo $row_log['brewHops9']?>"><?php echo $row_log['brewHops9']; ?></option><?php } ?>
	<option value=""></option>
<option value="">-- Items below are in the Hops DB --</option>
    <?php do {  ?><option value="<?php echo $row_hops['hopsName']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_hops['hopsName'], $row_log['brewHops9']))) {echo "SELECTED";} } if ($action == "importCalc") { if ($brewHops9 == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']?></option>
    <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
	<option value="Other">Other</option>
   </select>
   </td>
   <td class="data"><input name="brewHops9Weight" type="text" id="brewHops9Weight" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops9Weight']; if ($action == "importCalc") echo $brewHops9Weight; ?>">&nbsp;<?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
   <td class="data"><input name="brewHops9IBU" type="text" id="brewHops9IBU" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops9IBU']; if ($action == "importCalc") echo $brewHops9IBU; ?>">&nbsp;%</td>
   <td class="data"><input type="text" name="brewHops9Time" size="1" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewHops9Time']; if ($action == "importCalc") echo $brewHops9Time; ?>">&nbsp;min.</td>
   <td class="data"><select name="brewHops9Use" id="brewHops9Use">
                    <option value=""></option>
					<option value="Boil" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Use'], "Boil"))) {echo "SELECTED";} }?>>Boil</option>
                    <option value="Dry Hop" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Use'], "Dry Hop"))) {echo "SELECTED";} }?>>Dry Hop</option>
                    <option value="Mash" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Use'], "Mash"))) {echo "SELECTED";} }?>>Mash</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Use'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="First Wort" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Use'], "First Wort"))) {echo "SELECTED";} }?>>First Wort</option>
                    </select>
   </td>
   <td class="data"><select name="brewHops9Type" id="brewHops9Type">
                    <option value=""></option>
					<option value="Bittering" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Type'], "Bittering"))) {echo "SELECTED";} }?>>Bittering</option>
                    <option value="Flavor" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Type'], "Flavor"))) {echo "SELECTED";} }?>>Flavor</option>
                    <option value="Aroma" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Type'], "Aroma"))) {echo "SELECTED";} }?>>Aroma</option>
                    <option value="Both" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Type'], "Both"))) {echo "SELECTED";} }?>>Both</option>
                    </select>
	 </td>
     <td class="data"><select name="brewHops9Form" id="brewHops9Form">
                    <option value=""></option>
					<option value="Pellets" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Form'], "Pellets"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops9Form, "Pellets"))) {echo "SELECTED";} } ?>>Pellets</option>
                    <option value="Plug" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Form'], "Plug"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops9Form, "Plug"))) {echo "SELECTED";} } ?>>Plug</option>
                    <option value="Leaf" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if (!(strcmp($row_log['brewHops9Form'], "Leaf"))) {echo "SELECTED";} } if ($action=="importCalc") { if (!(strcmp($brewHops9Form, "Leaf"))) {echo "SELECTED";} } ?>>Leaf</option>
                    </select>
	</td>
</tr>
</table>