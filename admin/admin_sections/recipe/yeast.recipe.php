<div id="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=yeast&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Yeast Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div>Yeast</div>
<table>
<?php if ((($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) && ($row_log['brewYeastProfile'] == "")) { ?>
<?php if ($row_log['brewYeast'] != "") { ?>
<tr>
	<td width="5%" class="dataLabelLeft">Keep Current?</td>
    <td class="data">
    <?php 
  	if ($row_log['brewYeastMan'] != "" ) echo $row_log['brewYeastMan']."&nbsp;"; 
  	if ($row_log['brewYeast'] != "" ) echo $row_log['brewYeast']; 
  	if ($row_log['brewYeastForm'] != "" ) echo "&nbsp;&mdash;&nbsp;".$row_log['brewYeastForm']; 
  	if ($row_log['brewYeastAmount'] != "" ) echo "&nbsp;&mdash;&nbsp;".$row_log['brewYeastAmount']; 
  	?>
    <input name="yeastKeep" type="radio" value="Yes" />Yes&nbsp;<input name="yeastKeep" type="radio" value="No" checked="checked"/>No
    </td>
</tr>
<input type="hidden" name="brewYeast" value="<?php echo $row_log['brewYeast']; ?>" />
<input type="hidden" name="brewYeastMan" value="<?php echo $row_log['brewYeastMan']; ?>" />
<input type="hidden" name="brewYeastForm" value="<?php echo $row_log['brewYeastForm']; ?>" />
<input type="hidden" name="brewYeastAmount" value="<?php echo $row_log['brewYeastAmount']; ?>" />
<?php } ?>
<?php } ?>
<tr>
   <td class="dataLabelLeft">Name:</td>
   <td class="data">
   <select name="brewYeastProfile">
   	<option value=""></option>
   	<?php do {  ?>
   	<option value="<?php echo $row_yeast_profiles['id']?>" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if (!(strcmp($row_yeast_profiles['id'], $row_log['brewYeastProfile']))) {echo "SELECTED";} } if ($action == "importCalc") {  if (!(strcmp($row_yeast_profiles['yeastName'], $brewYeast))) {echo "SELECTED";} } ?>><?php echo $row_yeast_profiles['yeastLab']." ".$row_yeast_profiles['yeastName']; if ($row_yeast_profiles['yeastProdID'] != "") echo " (".$row_yeast_profiles['yeastProdID'].")"; ?></option>
   	<?php } while ($row_yeast_profiles = mysql_fetch_assoc($yeast_profiles)); $rows = mysql_num_rows($yeast_profiles); if($rows > 0) { mysql_data_seek($yeast_profiles, 0); $row_yeast_profiles = mysql_fetch_assoc($yeast_profiles); } ?>
   	</select>
   </td>
</tr>
<tr>
   <td width="5%" class="dataLabelLeft">Amount:</td>
   <td class="data">
   <select name="brewYeastAmount">
   <option value=""></option>
   	<option value="35 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "35 ml") echo "SELECTED"; } ?>>35 ml (1 White Labs Vial)</option>
   	<option value="70 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "70 ml") echo "SELECTED"; } ?>>70 ml (2 White Labs Vials)</option>
   	<option value="105 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "105 ml") echo "SELECTED"; } ?>>105 ml (3 White Labs Vials)</option>
   	<option value="140 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "140 ml") echo "SELECTED"; } ?>>140 ml (4 White Labs Vials)</option>
   	<option value="175 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "175 ml") echo "SELECTED"; } ?>>175 ml (5 White Labs Vials)</option>
   	<option value="50 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "50 ml") echo "SELECTED"; } ?>>50 ml (1 Wyeast Propagator Package)</option>
   	<option value="100 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "100 ml") echo "SELECTED"; } ?>>100 ml (2 Wyeast Propagator Packages)</option>
   	<option value="150 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "150 ml") echo "SELECTED"; } ?>>150 ml (3 Wyeast Propagator Packages)</option>
   	<option value="200 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "200 ml") echo "SELECTED"; } ?>>200 ml (4 Wyeast Propagator Packages)</option>
   	<option value="250 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "250 ml") echo "SELECTED"; } ?>>250 ml (5 Wyeast Propagator Packages)</option>
   	<option value="125 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "125 ml") echo "SELECTED"; } ?>>125 ml (1 Wyeast Activator Package)</option>
   	<option value="250 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "250 ml") echo "SELECTED"; } ?>>250 ml (2 Wyeast Activator Packages)</option>
   	<option value="375 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "375 ml") echo "SELECTED"; } ?>>375 ml (3 Wyeast Activator Packages)</option>
   	<option value="500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "500 ml") echo "SELECTED"; } ?>>500 ml Starter</option>
   	<option value="1000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "1000 ml") echo "SELECTED"; } ?>>1000 ml Starter</option>
   	<option value="1500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "1500 ml") echo "SELECTED"; } ?>>1500 ml Starter</option>
   	<option value="2000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "2000 ml") echo "SELECTED"; } ?>>2000 ml Starter</option>
   	<option value="2500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "2500 ml") echo "SELECTED"; } ?>>2500 ml Starter</option>
   	<option value="3000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "3000 ml") echo "SELECTED"; } ?>>3000 ml Starter</option>
   	<option value="3500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "3500 ml") echo "SELECTED"; } ?>>4500 ml Starter</option>
   	<option value="4000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "4000 ml") echo "SELECTED"; } ?>>5000 ml Starter</option>
   	<option value="4500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "4500 ml") echo "SELECTED"; } ?>>4500 ml Starter</option>
   	<option value="5000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "5000 ml") echo "SELECTED"; } ?>>5000 ml Starter</option>
   	<option value="5500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "5500 ml") echo "SELECTED"; } ?>>5500 ml Starter</option>
   	<option value="6000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "6000 ml") echo "SELECTED"; } ?>>6000 ml Starter</option>
   	<option value="6500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "6500 ml") echo "SELECTED"; } ?>>6500 ml Starter</option>
   	<option value="7000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "7000 ml") echo "SELECTED"; } ?>>7000 ml Starter</option>
   	<option value="7500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "7500 ml") echo "SELECTED"; } ?>>7500 ml Starter</option>
   	<option value="8000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "8000 ml") echo "SELECTED"; } ?>>8000 ml Starter</option>
   	<option value="8500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "8500 ml") echo "SELECTED"; } ?>>8500 ml Starter</option>
   	<option value="9000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "9000 ml") echo "SELECTED"; } ?>>9000 ml Starter</option>
   	<option value="9500 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "9500 ml") echo "SELECTED"; } ?>>9500 ml Starter</option>
   	<option value="10000 ml" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "10000 ml") echo "SELECTED"; } ?>>10000 ml Starter</option>
    <option value="12 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "12 gr") echo "SELECTED"; } ?>>11-12 gr Dry Yeast</option>
	<option value="24 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "24 gr") echo "SELECTED"; } ?>>22-24 gr Dry Yeast</option>
	<option value="35 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "36 gr") echo "SELECTED"; } ?>>33-36 gr Dry Yeast</option>
	<option value="48 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "48 gr") echo "SELECTED"; } ?>>44-48 gr Dry Yeast</option>
	<option value="60 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "60 gr") echo "SELECTED"; } ?>>55-60 Dry Yeast</option>
	<option value="5 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "5 gr") echo "SELECTED"; } ?>>5 gr Dry Yeast</option>
	<option value="10 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "10 gr") echo "SELECTED"; } ?>>10 gr Dry Yeast</option>
	<option value="15 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "15 gr") echo "SELECTED"; } ?>>15 gr Dry Yeast</option>
	<option value="20 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "20 gr") echo "SELECTED"; } ?>>20 gr Dry Yeast</option>
	<option value="25 gr" <?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) { if ($row_log['brewYeastAmount'] == "25 gr") echo "SELECTED"; } ?>>25 gr Dry Yeast</option>
   </select>
  </tr>
</table>
<?php if ($row_log['brewYeast'] == "") { ?>
<input type="hidden" name="yeastKeep" value="No" />
<?php } ?>