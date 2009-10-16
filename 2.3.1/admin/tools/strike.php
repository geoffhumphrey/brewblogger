<?php 
if (($action == "calculate") || ($action == "entry")) { 
$units = $_POST["units"];
$grainWeight = $_POST["grainWeight"];
$grainTemp = $_POST["grainTemp"];
$strikeWaterAmt = $_POST["strikeWaterAmt"];
$targetMashTemp = $_POST["targetMashTemp"];
$equipLoss = $_POST["equipLoss"];
}

if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.grainWeight.value))
	{ errormessage += "\nTotal amount of grain."; }
if(WithoutContent(document.form1.grainTemp.value))
	{ errormessage += "\nGrain temperature."; }
if(WithoutContent(document.form1.strikeWaterAmt.value))
	{ errormessage += "\nAmount of strike water."; }
if(WithoutContent(document.form1.targetMashTemp.value))
	{ errormessage += "\nThe target mash temperature."; }
if(WithoutContent(document.form1.equipLoss.value))
	{ errormessage += "\nDegrees adjusted for your equipment."; }
if(WithoutContent(document.form1.units.value))
	{ errormessage += "\nUnit of measure."; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To calculate properly, the following information is needed:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()


function WithoutContent(ss) {
if(ss.length > 0) { return false; }
return true;
}

function NoneWithContent(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].value.length > 0) { return false; }
	}
return true;
}

function NoneWithCheck(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].checked) { return false; }
	}
return true;
}

function WithoutCheck(ss) {
if(ss.checked) { return false; }
return true;
}

function WithoutSelectionValue(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].selected) {
		if(ss[i].value.length) { return false; }
		}
	}
return true;
}

//-->
</script>
<?php } ?>
<form name="form1" <?php if (($action == "default") || ($action == "entry")) echo "onSubmit=\"return CheckRequiredFields()\""; ?> method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=<?php if (($action == "default") || ($action == "entry")) echo "calculate"; if ($action == "calculate") echo "entry"; ?>">
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Strike Water Temperature Calculator</div>
<?php if (($action == "default") || ($action == "entry")) { ?>
<table>
 <tr>
  <td class="dataLabelLeft">Amount of Grains:</td>
  <td class="data" width="5%"><input name="grainWeight" type="text" id="grainWeight" size="5" value="<?php if ($action == "entry") echo $grainWeight; ?>"></td>
  <td class="data">pounds or kilograms</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Grain Temperature:</td>
  <td class="data"><input name="grainTemp" type="text" id="grainTemp" size="5" value="<?php if ($action == "entry") echo $grainTemp; ?>"></td>
  <td class="data">&deg; F or &deg; C</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Strike Water Amount:</td>
  <td class="data"><input name="strikeWaterAmt" type="text" id="strikeWaterAmt" size="5" value="<?php if ($action == "entry") echo $strikeWaterAmt; ?>"></td>
  <td class="data">gallons or liters</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Target Mash Temperature:</td>
  <td class="data"><input name="targetMashTemp" type="text" id="argetMashTemp" size="5" value="<?php if ($action == "entry") echo $targetMashTemp; ?>"></td>
  <td class="data">&deg; F or &deg; C</td>
 </tr>
  <tr>
  <td class="dataLabelLeft">Equipment Loss:</td>
  <td class="data"><input name="equipLoss" type="text" id="equipLoss" size="5" value="<?php if ($action == "entry") echo $equipLoss; else echo "0"; ?>"></td>
  <td class="data">&deg; F or &deg; C</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Units:</td>
  <td class="data">
	    <select name="units" id="units">
        <option value="us" <?php if ($action == "default") echo "SELECTED"; if (($action == "entry") && ($units == "us")) echo "SELECTED"; ?>>U.S.</option>
        <option value="metric" <?php if (($action == "entry") && ($units == "metric")) echo "SELECTED"; ?>>Metric</option>
        </select>
  </td>
  <td>&nbsp;</td>
 </tr>
</table>
</div>

<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>


<?php } 
if ($action == "calculate") { ?>
<table>
<?php 
/* debug:
echo $Aa."<br>";
echo $Cc."<br>";
*/
switch ($units) 
	{
	case "us": 
	// Calculation
	$Aa = ($grainWeight * 0.05) * $grainTemp;
	$Cc = (($grainWeight * 0.05) + $strikeWaterAmt) * $targetMashTemp;
	$strikeWaterTemp = ($Cc - $Aa) / $strikeWaterAmt;
	$strikeWaterTempAdj =  $strikeWaterTemp + $equipLoss;
	echo "<table>";
	echo "<tr><td class=\"dataLabelLeft\" nowrap>Grain Weight:</td><td class=\"data\">".$grainWeight." pounds</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Temperature:</td><td class=\"data\">".$grainTemp."&deg; F</td><td class=\"data\"></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Strike Water Amount:</td><td class=\"data\">".$strikeWaterAmt." gallons</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Target Mash Temperature:</td><td class=\"data\">".$targetMashTemp."&deg; F</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Equipment Loss:</td><td class=\"data\">".$equipLoss."&deg; F</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Strike Water Temperature:</td><td class=\"data\">".round ($strikeWaterTempAdj, 1)."&deg; F";
	if ($equipLoss > 0) echo " (".round ($strikeWaterTemp, 1)."&deg; F less ".$equipLoss."&deg; F equipment loss adjustment)";
	echo "</td></tr>";
	echo "</table>";
	break;
	
	case "metric":
	// convert from metric to imperial
	$grainTempC = (($grainTemp * 9) / 5) + 32; // C to F
	$targetMashTempC = (($targetMashTemp * 9) / 5) + 32; // C to F
	$grainWeightC = ($grainWeight * 2.204) * .05; // kg to lbs
	$strikeWaterAmtC = $strikeWaterAmt * .2641; // liters to gallons
	$Aa = $grainWeightC * $grainTempC;
	$Cc = ($grainWeightC + $strikeWaterAmtC) * $targetMashTempC;
	$strikeWaterTempF = ($Cc - $Aa) / $strikeWaterAmtC;
	$strikeWaterTemp = (($strikeWaterTempF - 32) / 9) * 5;
	$strikeWaterTempAdj = $strikeWaterTemp + $equipLoss;
	/* debug
	echo $grainTempC." F<br>";
	echo $targetMashTempC." F<br>";
	echo $grainWeightC." pounds<br>";
	echo $strikeWaterAmtC." gallons <br>";
	*/
	echo "<tr><td class=\"dataLabelLeft\" nowrap>Grain Weight:</td><td class=\"data\">".$grainWeight." kilograms</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Temperature:</td><td class=\"data\">".$grainTemp."&deg; C</td><td class=\"data\"></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Strike Water Amount:</td><td class=\"data\">".$strikeWaterAmt." liters</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Target Mash Temperature:</td><td class=\"data\">".$targetMashTemp."&deg; C</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Equipment Loss:</td><td class=\"data\">".$equipLoss."&deg; C</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Strike Water Temperature:</td><td class=\"data\">".round ($strikeWaterTempAdj, 1)."&deg; C";
	if ($equipLoss > 0) echo " (".round ($strikeWaterTemp, 1)."&deg; C less ".$equipLoss."&deg; C equipment loss adjustment)";
	echo "</td></tr>";	
	break;
	
	}
?>
<tr>
	<td colspan="5"><p>Calculations derived from the <em>Brewing Techniques Troubleshooter, Vol. 4, No. 4</em> available <a href="http://brewingtechniques.com/library/backissues/issue4.5/miller.html" target="_blank">here</a>.</p></td>
</table>

<input name="units" type="hidden" id="units" value="<?php echo $units; ?>">
<input name="grainTemp" type="hidden" id="grainTemp" value="<?php echo $grainTemp; ?>">
<input name="grainWeight" type="hidden" id="grainWeight" value="<?php echo $grainWeight; ?>">
<input name="strikeWaterAmt" type="hidden" id="strikeWaterAmt" value="<?php echo $strikeWaterAmt; ?>">
<input name="targetMashTemp" type="hidden" id="targetMashTemp" value="<?php echo $targetMashTemp; ?>">
<input name="equipLoss" type="hidden" id="equipLoss" value="<?php echo $equipLoss; ?>">
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div><?php } ?>
</form>