<?php
if (($action == "calculate") || ($action == "entry")) { 
// calculation from http://brewery.org/library/CO2charts.html
$units = $_POST['units']; // U.S. or Metric
$tempF = $_POST['temp']; // temperature of beer
$tempC = (1.8 * $tempF) + 32; // convert C to F for formula to work
$tempFSquared = $tempF * $tempF; // square the F temperature reading
$tempCSquared = $tempC * $tempC; // square the C temperature reading
$desiredC02Volume = $_POST['desiredC02Volume'];
$volSquared = $desiredC02Volume * $desiredC02Volume;
$pressureF = (-16.6999) - (0.0101059 * $tempF) + (0.00116512 * $tempFSquared) + (0.173354 * $tempF * $desiredC02Volume) + (4.24267 * $desiredC02Volume) - (0.0684226 * $volSquared); 
$pressureC = (-16.6999) - (0.0101059 * $tempC) + (0.00116512 * $tempCSquared) + (0.173354 * $tempC * $desiredC02Volume) + (4.24267 * $desiredC02Volume) - (0.0684226 * $volSquared); 
}
if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.temp.value))
	{ errormessage += "\nTemperature of Liquid."; }
if(WithoutContent(document.form1.desiredC02Volume.value))
	{ errormessage += "\nDesired volume of CO2."; }
if(WithoutContent(document.form1.units.value))
	{ errormessage += "\nTemperature scale."; }
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
<?php if (($action == "default") || ($action == "entry")) { ?>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Force Carbonation Calculator</div>
<table>
  <tr>
   <td class="dataLabelLeft">Temperature of Liquid:</td>
   <td class="data">
	<input name="temp" type="text" id="temp" size="5" value="<?php if ($action == "entry") echo $tempF; ?>">&deg;&nbsp;
    <select name="units" id="units" class="text_area">
     <option value=""></option>
     <option value="F" <?php if (($action == "entry") && ($units == "F")) echo "SELECTED"; ?>>Fahrenheit</option>
     <option value="C" <?php if (($action == "entry") && ($units == "C")) echo "SELECTED"; ?>>Celsius</option>
    </select>
  </td>
  <tr>
    <td class="dataLabelLeft">Desired C0<sub>2</sub> Volume:</td>
    <td class="data"><input name="desiredC02Volume" type="text" id="desiredC02Volume" size="5" value="<?php if ($action == "entry") echo $desiredC02Volume; ?>"></td>
    </tr>
</table>
  	<div id="referenceHeader">Typical CO<sub>2</sub> Saturation by Style (in volumes)</div>
  		<table>
  		<tr>
   			<td class="dataLabelLeft" width="10%">English Ales</td>
   			<td class="data" width="10%">1.5 - 2.0</td>
   			<td class="dataLabel" width="10%">European Lagers</td>
   			<td class="data">2.2 - 2.7</td>
  		</tr>
  		<tr>
   			<td class="dataLabelLeft">Stout/Porter</td>
   			<td class="data">1.7 - 2.3</td>
   			<td class="dataLabel data">American Ales/Lagers</td>
   			<td class="data">2.2 - 2.7</td>
  		</tr>
  		<tr>
   			<td class="dataLabelLeft">Belgian Ales</td>
   			<td class="data">1.9 - 2.4</td>
   			<td class="dataLabel data">Lambic</td>
   			<td class="data">2.4 - 2.8</td>
  		</tr>
  		<tr>
   			<td class="dataLabelLeft">Wheat Beer</td>
   			<td class="data">3.3 - 4.5</td>
   			<td class="dataLabel data">Fruit Lambic</td>
   			<td class="data">3.0 - 4.5</td>
  		</tr>
  		</table>
</div>
<div class="calcButton">
<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
</div>
<?php } if ($action == "calculate") { ?>
<input type="hidden" name="temp" value="<?php echo $tempF; ?>">
<input type="hidden" name="units" value="<?php echo $units; ?>">
<input type="hidden" name="desiredC02Volume" value="<?php echo $desiredC02Volume; ?>">
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Force Carbonation Calculator</div>
<table>
  <tr>
    <td>
	<?php 
		switch ($units) {
			case "F":
				echo "For a CO<sub>2</sub> saturation volume of ".$desiredC02Volume." at ".$tempF."&deg; F, <strong>".round ($pressureF,1)." PSI</strong> will be needed.";
			break;
			case "C";
				echo "For a CO<sub>2</sub> saturation volume of ".$desiredC02Volume." at ".$tempF."&deg; C, <strong>".round ($pressureC,1)." PSI</strong> will be needed.";
			break;
			}
		?>
	</td>
  </tr>
</table>
</div>
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div><?php } ?>
</form>