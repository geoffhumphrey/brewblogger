<?php
if (($action == "calculate") || ($action == "entry")) {
// Calculations based upon Mark Hibber's article at http://www.hbd.org/brewery/library/YPrimerMH.html

// Get variables from user
$units = $_POST['units']; // U.S. or Metric
$sugar = $_POST['sugar']; // what type of priming sugar to use
$beerAmount = $_POST['beerAmount'];  // total volume of beer
$initialC02Volume = $_POST['initialC02Volume']; // amount of C02 in green beer based upon temperature
$finalC02Volume = $_POST['finalC02Volume']; // desired volume for style

// Calculate Net Volume of Green Beer
$netC02Volume = ($finalC02Volume - $initialC02Volume);

// Calculate for Sucrose (Base Calculation)
$amountSucroseLiter = ($netC02Volume * 4) * $beerAmount;
$amountSucroseGallon = ($netC02Volume * .5) * $beerAmount;

// Calculate for Corn Sugar (Dextrose)
$amountDextroseLiter = ($amountSucroseLiter + ($amountSucroseLiter * .15));
$amountDextroseGallon = ($amountSucroseGallon + ($amountSucroseGallon * .15));

// Calculate for Honey
$amountHoneyLiter = $amountSucroseLiter + ($amountSucroseLiter * .40);
$amountHoneyGallon = $amountSucroseGallon + ($amountSucroseGallon * .40);

// Calculate for Maple Syrup
$amountMapleLiter = $amountSucroseLiter + ($amountSucroseLiter * .50);
$amountMapleGallon = $amountSucroseGallon + ($amountSucroseGallon * .50);

// Calculate for Molasses
$amountMolassesLiter = $amountSucroseLiter + ($amountSucroseLiter * .80);
$amountMolassesGallon = $amountSucroseGallon + ($amountSucroseGallon * .80);

// Calculate for Dry Malt Extract
$amountDMELiter = $amountSucroseLiter + ($amountSucroseLiter * .30);
$amountDMEGallon = $amountSucroseGallon + ($amountSucroseGallon * .30);

// Calculate for Liquid Malt Extract
$amountLMELiter = $amountSucroseLiter + ($amountSucroseLiter * .40);
$amountLMEGallon = $amountSucroseGallon + ($amountSucroseGallon * .40);

//
if ($sugar == "sucrose") 	{ $sugarOutput = "table sugar"; }
if ($sugar == "dextrose") 	{ $sugarOutput = "corn sugar"; }
if ($sugar == "honey") 		{ $sugarOutput = "honey"; }
if ($sugar == "maple") 		{ $sugarOutput = "maple syrup"; }
if ($sugar == "molasses")	{ $sugarOutput = "molasses"; }
if ($sugar == "dme") 		{ $sugarOutput = "dry malt extract"; }
if ($sugar == "lme") 		{ $sugarOutput = "liquid malt extract"; }
}
?>
<?php if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.beerAmount.value))
	{ errormessage += "\nAmount of Liquid."; }
if(WithoutContent(document.form1.finalC02Volume.value))
	{ errormessage += "\nDesired CO2 Volume."; }
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
<form name="form1" id="form1" <?php if (($action == "default") || ($action == "entry")) echo "onSubmit=\"return CheckRequiredFields()\""; ?> method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=<?php if (($action == "default") || ($action == "entry")) echo "calculate"; if ($action == "calculate") echo "entry"; ?>">
<?php if (($action == "default") || ($action == "entry")) { ?>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Calculate Priming Sugar Amount</div>
<table class="dataTable">
  <tr>
    <td class="dataLabelLeft">Amount of Liquid:</td>
	<td class="data"><input name="beerAmount" id="beerAmount" type="text" size="10" maxlength="4" value="<?php if ($action == "entry") echo $beerAmount; ?>"> (gallons or liters)</td>
	<td class="dataLabelLeft">&nbsp;</td>
	<td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Fermentation Temperature:</td>
	<td class="data">
		<select name="initialC02Volume" id="initialC02Volume">
	    <option value="1.7" <?php if (($action == "entry") && ($initialC02Volume == "1.7")) echo "SELECTED"; ?>>32&deg; F / 0&deg; C</option>
		<option value="1.5" <?php if (($action == "entry") && ($initialC02Volume == "1.5")) echo "SELECTED"; ?>>35&deg; F / 2&deg; C</option>
		<option value="1.45" <?php if (($action == "entry") && ($initialC02Volume == "1.45")) echo "SELECTED"; ?>>40&deg; F / 4.5&deg; C</option>
		<option value="1.3" <?php if (($action == "entry") && ($initialC02Volume == "1.3")) echo "SELECTED"; ?>>45&deg; F / 7&deg; C</option>
		<option value="1.2" <?php if (($action == "entry") && ($initialC02Volume == "1.2")) echo "SELECTED"; ?>>50&deg; F / 10&deg; C</option>
		<option value="1.1" <?php if (($action == "entry") && ($initialC02Volume == "1.1")) echo "SELECTED"; ?>>55&deg; F / 13&deg; C</option>
		<option value="1.0" <?php if (($action == "entry") && ($initialC02Volume == "1.0")) echo "SELECTED"; ?>>60&deg; F / 15.5&deg; C</option>
		<option value="0.9" <?php if (($action == "entry") && ($initialC02Volume == "0.9")) echo "SELECTED"; ?>>65&deg; F / 18&deg; C</option>
		<option value="0.85" <?php if (($action == "entry") && ($initialC02Volume == "0.85")) echo "SELECTED"; ?>>70&deg; F / 21&deg; C</option>
		<option value="0.78" <?php if (($action == "entry") && ($initialC02Volume == "0.78")) echo "SELECTED"; ?>>75&deg; F / 24&deg; C</option>
	  </select>
	</td>
	<td class="dataLabelLeft">&nbsp;</td>
	<td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Desired C0<sub>2</sub> Saturation:</td>
	<td class="data"><input name="finalC02Volume" type="text" id="finalC02Volume" size="10"  value="<?php if ($action == "entry") echo $finalC02Volume; ?>">&nbsp;volumes</td>
	<td class="dataLabelLeft">&nbsp;</td>
	<td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Type of Priming Sugar:</td>
	<td class="data">
	    <select name="sugar" id="sugar">
        <option value="sucrose" <?php if (($action == "entry") && ($sugar == "sucrose")) echo "SELECTED"; ?>>Table Sugar (Sucrose)</option>
        <option value="dextrose" <?php if (($action == "entry") && ($sugar == "dextrose")) echo "SELECTED"; ?>>Corn Sugar (Dextrose)</option>
        <option value="dme" <?php if (($action == "entry") && ($sugar == "dme")) echo "SELECTED"; ?>>Dry Malt Extract</option>
        <option value="lme" <?php if (($action == "entry") && ($sugar == "lme")) echo "SELECTED"; ?>>Liquid Malt Extract</option>
        <option value="maple" <?php if (($action == "entry") && ($sugar == "maple")) echo "SELECTED"; ?>>Maple Syrup</option>
        <option value="honey" <?php if (($action == "entry") && ($sugar == "honey")) echo "SELECTED"; ?>>Honey</option>
        <option value="molasses" <?php if (($action == "entry") && ($sugar == "molasses")) echo "SELECTED"; ?>>Molasses</option>
        </select>
	</td>
	<td class="dataLabelLeft">&nbsp;</td>
	<td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Units:</td>
	<td class="data">
	    <select name="units" id="units">
        <option value="us" <?php if ($action == "default") echo "SELECTED"; if (($action == "entry") && ($units == "us")) echo "SELECTED"; ?>>U.S.</option>
        <option value="metric" <?php if (($action == "entry") && ($units == "metric")) echo "SELECTED"; ?>>Metric</option>
        </select>
	</td>
	<td class="dataLabelLeft">&nbsp;</td>
	<td class="data">&nbsp;</td>
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
<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>

<?php } if ($action == "calculate") { ?>
<input type="hidden" name="units" value="<?php echo $units; ?>" />
<input type="hidden" name="sugar" value="<?php echo $sugar; ?>" />
<input type="hidden" name="beerAmount" value="<?php echo $beerAmount; ?>" />
<input type="hidden" name="initialC02Volume" value="<?php echo $initialC02Volume; ?>" />
<input type="hidden" name="finalC02Volume" value="<?php echo $finalC02Volume; ?>" />
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Calculate Priming Sugar</div>
<table>
<?php 
switch ($units) 
	{
	case "us": 
		switch ($sugar)
			{
			case "sucrose":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".round ($amountSucroseGallon, 2)." ounces of ".$sugarOutput." (sucrose)</td></tr>";
			break;
			case "dextrose":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountDextroseGallon, 2)." ounces of ".$sugarOutput." (dextrose)</td></tr>";
			break;
			case "honey":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountHoneyGallon, 2)." ounces of ".$sugarOutput."</td></tr>";
			break;
			case "maple":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountMapleGallon, 2)." ounces of ".$sugarOutput."</td></tr>";
			break;
			case "molasses":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountMolassesGallon, 2)." ounces of ".$sugarOutput."</td></tr>";
			break;
			case "dme":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountDMEGallon, 2)." ounces of ".$sugarOutput."</td></tr>";
			break;
			case "lme":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." gallons
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountLMEGallon, 2)." ounces of ".$sugarOutput."</td></tr>";
			break;
			}
		break;
	case "metric":
			switch ($sugar)
			{
			case "sucrose":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".round ($amountSucroseLiter, 2)." grams of ".$sugarOutput." (sucrose)</td></tr>";
			break;
			case "dextrose":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountDextroseLiter, 2)." grams of ".$sugarOutput." (dextrose)</td></tr>";
			break;
			case "honey":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountHoneyLiter, 2)." grams of ".$sugarOutput."</td></tr>";
			break;
			case "maple":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountMapleLiter, 2)." grams of ".$sugarOutput."</td></tr>";
			break;
			case "molasses":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountMolassesLiter, 2)." grams of ".$sugarOutput."</td></tr>";
			break;
			case "dme":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountDMELiter, 2)." grams of ".$sugarOutput."</td></tr>";
			break;
			case "lme":
			echo "
			<tr><td class=\"dataLabelLeft\">Desired C0<sub class=\"text_9\">2</sub> Saturation:</td><td class=\"data\">".$finalC02Volume." volumes
			<tr><td class=\"dataLabelLeft\">Amount of Liquid:&nbsp;&nbsp;&nbsp;</td><td class=\"data\">".$beerAmount." liters
			<tr><td class=\"dataLabelLeft\">Amount of Priming Sugar:</td><td class=\"data\">".round ($amountLMELiter, 2)." grams of ".$sugarOutput."</td></tr>";
			break;
			}
	}
?>
<tr>
	<td colspan="3"><p>Calculations derived from Mark Hibber's article <a href="http://www.hbd.org/brewery/library/YPrimerMH.html" target="_blank">from hbd.org</a>.</p></td>
</tr>
</table>
</div>

<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div>
<?php } ?>

</form>