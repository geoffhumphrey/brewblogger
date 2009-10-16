<?php 
/* 
**********************************
Special thanks to Kevin Masaryk for 
tweaking the equations to allow for 
evaporation rate to be in volume 
instead of a percentage.
**********************************
*/
$units = $_POST["units"];
$grainWeight = $_POST["grainWeight"];
$grainRetainCoeff = $_POST["grainRetainCoeff"];
$finalBoilVol = $_POST["finalBoilVol"];
$equipLoss = $_POST["equipLoss"];
$evapRate = $_POST["evapRate"];
$boilTime = $_POST["boilTime"];
$thickness = $_POST["thickness"];
?> 
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.finalBoilVol.value))
	{ errormessage += "\nTarget final volume."; }
if(WithoutContent(document.form1.grainWeight.value))
	{ errormessage += "\nTotal amount of grain."; }
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
<form name="form1" <?php if (($action == "default") || ($action == "entry")) echo "onSubmit=\"return CheckRequiredFields()\""; ?> method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=<?php if (($action == "default") || ($action == "entry")) echo "calculate"; if ($action == "calculate") echo "entry"; ?>">
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; else echo "Calc"; ?>">
<div id="referenceHeader">Water Amounts Calculator</div>
<?php if (($action == "default") || ($action == "entry")) { ?>
<table>
<tr>
  <td class="dataLabelLeft">Target Final Volume:</td>
  <td class="data" width="1%"><input name="finalBoilVol" type="text" id="finalBoilVol" size="5" value="<?php if ($action == "entry") echo $finalBoilVol; if ((isset($_SESSION["loginUsername"])) && ($row_user['defaultBatchSize'] != "")) echo $row_user['defaultBatchSize']; ?>"></td>
  <td class="data">Gallons or Litres</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Amount of Grains:</td>
  <td class="data"><input name="grainWeight" type="text" id="grainWeight" size="5" value="<?php if ($action == "entry") echo $grainWeight; ?>"></td>
  <td class="data">Pounds or Kilograms</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Water Retention in Grain:</td>
  <td class="data"><input name="grainRetainCoeff" type="text" id="grainRetainCoeff" size="5" value="<?php if ($action == "entry") echo $grainRetainCoeff; else echo "0.8"; ?>"></td>
  <td class="data">Quarts per Pound or Litres per Kilogram (Daniels = .8 qt/lb, Palmer = .5 qt/lb)</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Mash Thickness:</td>
  <td class="data"><input name="thickness" type="text" id="thickness" size="5" value="<?php if ($action == "entry") echo $thickness; else echo "1.33"; ?>"></td>
  <td class="data">Quarts per Pound or Litres per Kilogram</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Equipment Loss:</td>
  <td class="data"><input name="equipLoss" type="text" id="equipLoss" size="5" value="<?php if ($action == "entry") echo $equipLoss; else echo "0"; ?>"></td>
  <td class="data">Gallons or Litres</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Evaporation Rate:</td>
  <td class="data"><input name="evapRate" type="text" id="evapRate" size="5" value="<?php if ($action == "entry") echo $evapRate; else echo "1.5"; ?>"></td>
  <td class="data">Gallons or Litres per Hour</td>
 </tr>
 <tr>
  <td class="dataLabelLeft">Boil Time:</td>
  <td class="data"><input name="boilTime" type="text" id="boilTime" size="5" value="<?php if ($action == "entry") echo $boilTime; elseif ((isset($_SESSION["loginUsername"])) && ($row_user['defaultBoilTime'] != "")) echo $row_user['defaultBoilTime']; else echo "60"; ?>"></td>
  <td class="data">Minutes</td>
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
<table class="dataTable">
	<tr>
    	<td width="5%" nowrap="nowrap"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_calculate_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Calculate" class="radiobutton" value="Calculate"></td>
		<?php if ($action == "entry") { ?>
        <td><a href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_clear_<?php echo $row_colorChoose['themeName']; ?>.png" border="0" title="Clear" alt="Clear"/></a></td>
		<?php } ?>
</tr>
</table>
<?php } 
if ($action == "calculate") {
$grainRetain = ($grainWeight * ($grainRetainCoeff / 4));
$grainRetainMet = ($grainWeight * $grainRetainCoeff);
$evapVol = ($evapRate / 60 * $boilTime);
$runoffVol = ($finalBoilVol / 0.96 + $evapVol);
$totalWater = ($runoffVol + $grainRetain + $equipLoss);
$totalWaterMet = ($runoffVol + $grainRetainMet + $equipLoss);
$mashWater = (($grainWeight * $thickness) / 4);
$mashWaterMet = ($grainWeight * $thickness);
$spargeWater = ($totalWater - $mashWater);
$spargeWaterMet = ($totalWaterMet - $mashWaterMet);
switch ($units) 
	{
	case "us": 
	echo "<table>";
	echo "<tr><td class=\"dataLabelLeft\" nowrap>Target Final Boil Volume:</td><td class=\"data\">".$finalBoilVol." gallons</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Evaporation Rate:</td><td class=\"data\">".$evapRate." gallons per hour</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Boil Time:</td><td class=\"data\">".$boilTime." minutes</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Runoff Volume Needed:</td><td class=\"data\">".round ($runoffVol, 2)." gallons</td><td class=\"data\">".$finalBoilVol." gallons (final boil volume) &divide; 0.96 (cooling) + ".round($evapVol, 2)." gallons (boil evaporation)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Amount:</td><td class=\"data\">".$grainWeight." pounds</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Absorbtion:</td><td class=\"data\">".round ($grainRetain, 2)." gallons</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Total Water Needed:</td><td class=\"data\">".round ($totalWater, 2)." gallons</td><td class=\"data\">".round ($runoffVol, 2)." gallons (runoff) + ".round ($grainRetain, 2)." gallons (grain absorbtion) + ".$equipLoss." gallons (equip. loss)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Mash Water Needed:</td><td class=\"data\">".round ($mashWater, 2)." gallons</td><td class=\"data\">based on ".$thickness." quarts per pound of grain</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Sparge Water Needed:</td><td class=\"data\">".round ($spargeWater, 2)." gallons</td><td class=\"data\">".round ($totalWater, 2)." gallons (total water)  &ndash; ".round ($mashWater, 2)." gallons (mash water)</td></tr>";
	echo "</table>";
	break;
	
	case "metric":
	echo "<table>";
	echo "<tr><td class=\"dataLabelLeft\" nowrap>Target Final Boil Volume:</td><td class=\"data\">".$finalBoilVol." litres</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Evaporation Rate:</td><td class=\"data\">".$evapRate." litres per hour</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Boil Time:</td><td class=\"data\">".$boilTime." minutes</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Runoff Volume Needed:</td><td class=\"data\">".round ($runoffVol, 2)." litres</td><td class=\"data\">".$finalBoilVol." litres (final boil volume) &divide; 0.96 (cooling) + ".round($evapVol, 2)." litres (boil evaporation)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Amount:</td><td class=\"data\">".$grainWeight." kilograms</td><td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Absorbtion:</td><td class=\"data\">".round ($grainRetainMet, 2)." litres</td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Total Water Needed:</td><td class=\"data\">".round ($totalWaterMet, 2)." litres</td><td class=\"data\">".round ($runoffVol, 2)." litres (runoff) + ".round ($grainRetainMet, 2)." litres (grain absorbtion) + ".$equipLoss." litres (equip. loss)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Mash Water Needed:</td><td class=\"data\">".round ($mashWaterMet, 2)." litres</td></td><td class=\"data\">based on ".$thickness." litres per kilogram of grain</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Sparge Water Needed:</td><td class=\"data\">".round ($spargeWaterMet, 2)." litres</td><td class=\"data\">".round ($totalWaterMet, 2)." litres (total water) &ndash; ".round ($mashWaterMet, 2)." litres (mash water)</td></tr>";
	echo "</table>";	
	break;
	
	}
echo "
<tr>
<td colspan=\"3\"><br><p>Calculations derived from Ray Daniels' book <em>Designing Great Beers</em>.</p></td>
</tr>
</table>";
?>
<input name="units" type="hidden" id="units" value="<?php echo $units; ?>">
<input name="finalBoilVol" type="hidden" id="finalBoilVol" value="<?php echo $finalBoilVol; ?>">
<input name="grainWeight" type="hidden" id="grainWeight" value="<?php echo $grainWeight; ?>">
<input name="grainRetainCoeff" type="hidden" id="grainRetainCoeff" value="<?php echo $grainRetainCoeff; ?>">
<input name="equipLoss" type="hidden" id="equipLoss" value="<?php echo $equipLoss; ?>">
<input name="evapRate" type="hidden" id="evapRate" value="<?php echo $evapRate; ?>">
<input name="boilTime" type="hidden" id="boilTime" value="<?php echo $boilTime; ?>">
<input name="thickness" type="hidden" id="thickness" value="<?php echo $thickness; ?>">
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div><?php } ?>
</form>
