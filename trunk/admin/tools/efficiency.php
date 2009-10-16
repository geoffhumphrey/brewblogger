<?php 
if (($action == "calculate") || ($action == "entry")) { 
$gravity = $_POST["gravity"]; 
$wort = $_POST["wort"]; 
$grain = $_POST["grain"];
$grain1 = $_POST["grain1"];
$grain1amt = $_POST["grain1amt"];
$grain2 = $_POST["grain2"];
$grain2amt = $_POST["grain2amt"];
$grain3 = $_POST["grain3"];
$grain3amt = $_POST["grain3amt"];
$grain4 = $_POST["grain4"];
$grain4amt = $_POST["grain4amt"];
$grain5 = $_POST["grain5"];
$grain5amt = $_POST["grain5amt"];
$grain6 = $_POST["grain6"];
$grain6amt = $_POST["grain6amt"];
$grain7 = $_POST["grain7"];
$grain7amt = $_POST["grain7amt"];
$grain8 = $_POST["grain8"];
$grain8amt = $_POST["grain8amt"];
$grain9 = $_POST["grain9"];
$grain9amt = $_POST["grain9amt"];
$grain10 = $_POST["grain10"];
$grain10amt = $_POST["grain10amt"];
$units = $_POST["units"];
}

if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.gravity.value))
	{ errormessage += "\nPre-boil Gravity."; }
if(WithoutContent(document.form1.grain.value))
	{ errormessage += "\nTotal amount of grain."; }
if(WithoutContent(document.form1.wort.value))
	{ errormessage += "\nTotal amount of wort."; }
if(WithoutContent(document.form1.grain1.value))
	{ errormessage += "\nAt least one general grain category"; }
if(WithoutContent(document.form1.grain1amt.value))
	{ errormessage += " and its corresponding amount."; }
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
<?php if (($action == "default") || ($action == "entry")) { ?>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Brewhouse Efficiency Calculator</div>
<table>
<tr>
      <td class="dataLabelLeft">Pre-Boil Gravity:*</td>
      <td class="data" colspan="3"><input name="gravity" type="text" id="gravity" size="15" value="<?php if ($action == "entry") echo $gravity; ?>">
     &nbsp;e.g., 1.048</td>
      </tr>
    <tr>
      <td class="dataLabelLeft">Total Fermentable Amt:*</td>
      <td class="data" colspan="3"><input name="grain" type="text" id="grain" size="15" value="<?php if ($action == "entry") echo $grain; ?>">&nbsp;pounds (U.S) or kilograms </td>
      </tr>
    <tr>
      <td class="dataLabelLeft">Pre-Boil Wort Amt:*</td>
      <td class="data" colspan="3"><input name="wort" type="text" id="wort" size="15" value="<?php if ($action == "entry") echo $wort; ?>">&nbsp;gallons (U.S.) or liters</td>
      </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 1:*</td>
      <td class="data">
	    <select class="text_area" name="grain1" id="grain1">
	  	  <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain1 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain1 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain1 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain1 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain1 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain1 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain1 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain1 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="35.04" <?php if (($action == "entry") && ($grain1 == "34.03")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain1 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain1 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain1 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain1 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain1 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain1 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain1 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain1 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain1 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain1 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain1 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain1 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain1 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain1 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain1 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain1 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
      </select></td>
      <td class="dataLabel data">Amt:*</td>
      <td nowrap="nowrap" class="data"><input name="grain1amt" type="text" id="grain1amt" size="15" value="<?php if ($action == "entry") echo $grain1amt; ?>">&nbsp;pounds (U.S) or kilograms</td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 2:</td>
      <td class="data"><select class="text_area"  name="grain2" id="grain2">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain2 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain2 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain2 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain2 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain2 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain2 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain2 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain2 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain2 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain2 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain2 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain2 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain2 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain2 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain2 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain2 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain2 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain2 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain2 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain2 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain2 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain2 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain2 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain2 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain2 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
      </select></td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain2amt" type="text" id="grain2amt" size="15" value="<?php if ($action == "entry") echo $grain2amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 3:</td>
      <td class="data"><select class="text_area"  name="grain3" id="grain3">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain3 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain3 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain3 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain3 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain3 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain3 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain3 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain3 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain3 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain3 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain3 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain3 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain3 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain3 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain3 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain3 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain3 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain3 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain3 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain3 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain3 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain3 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain3 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain3 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain3 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
      </select></td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain3amt" type="text" id="grain3amt" size="15" value="<?php if ($action == "entry") echo $grain3amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 4:</td>
      <td class="data">
	      <select class="text_area"  name="grain4" id="grain4">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain4 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain4 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain4 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain4 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain4 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain4 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain4 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain4 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain4 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain4 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain4 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain4 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain4 == "31.00")) echo "SELECTED"?>>Special B</option>
         <option value="28.00" <?php if (($action == "entry") && ($grain4 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain4 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain4 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain4 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain4 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain4 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain4 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain4 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain4 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain4 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain4 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain4 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
      </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain4amt" type="text" id="grain4amt" size="15" value="<?php if ($action == "entry") echo $grain4amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 5:</td>
      <td class="data">
	      <select class="text_area"  name="grain5" id="grain5">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain5 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain5 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain5 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain5 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain5 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain5 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain5 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain5 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain5 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain5 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain5 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain5 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain5 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain5 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain5 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain5 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain5 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain5 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain5 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain5 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain5 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain5 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain5 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain5 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain5 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
      </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain5amt" type="text" id="grain5amt" size="15" value="<?php if ($action == "entry") echo $grain5amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 6:</td>
      <td class="data">
	      <select class="text_area"  name="grain6" id="grain6">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain6 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain6 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain6 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain6 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain6 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain6 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain6 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain6 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain6 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain6 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain6 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain6 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain6 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain6 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain6 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain6 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain6 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain6 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain6 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain6 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain6 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain6 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain6 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain6 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain6 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
          </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain6amt" type="text" id="grain6amt" size="15" value="<?php if ($action == "entry") echo $grain6amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 7:</td>
      <td class="data">
	      <select class="text_area"  name="grain7" id="grain7">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain7 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain7 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain7 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain7 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain7 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain7 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain7 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain7 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain7 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain7 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain7 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain7 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain7 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain7 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain7 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain7 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain7 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain7 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain7 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain7 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain7 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain7 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain7 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain7 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain7 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
          </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain7amt" type="text" id="grain7amt" size="15" value="<?php if ($action == "entry") echo $grain7amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 8:</td>
      <td class="data">
	      <select class="text_area"  name="grain8" id="grain8">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain8 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain8 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain8 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain8 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain8 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain8 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain8 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain8 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain7 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain8 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain8 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain8 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain8 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain8 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain8 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain8 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain8 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain8 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain8 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain8 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain8 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain8 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain8 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain8 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain8 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
          </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain8amt" type="text" id="grain8amt" size="15" value="<?php if ($action == "entry") echo $grain8amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 9:</td>
      <td class="data">
	      <select class="text_area"  name="grain9" id="grain9">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain9 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain9 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain9 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain9 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain9 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain9 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain9 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain9 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain9 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain9 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain9 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain9 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain9 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain9 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain9 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain9 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain9 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain9 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain9 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain9 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain9 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain9 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain9 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain9 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain9 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
          </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain9amt" type="text" id="grain9amt" size="15" value="<?php if ($action == "entry") echo $grain9amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Fermentable 10:</td>
      <td class="data">
	      <select class="text_area"  name="grain10" id="grain10">
          <option value=""></option>
          <option value="37.00" <?php if (($action == "entry") && ($grain10 == "37.00")) echo "SELECTED"?>>2 Row Lager/Pils Malt</option>
          <option value="35.00" <?php if (($action == "entry") && ($grain10 == "35.00")) echo "SELECTED"?>>6 Row Malt</option>
          <option value="38.00" <?php if (($action == "entry") && ($grain10 == "38.00")) echo "SELECTED"?>>2 Row Pale Malt</option>
          <option value="35.01" <?php if (($action == "entry") && ($grain10 == "35.01")) echo "SELECTED"?>>Biscuit or Victory Malt</option>
          <option value="35.02" <?php if (($action == "entry") && ($grain10 == "35.02")) echo "SELECTED"?>>Vienna Malt</option>
          <option value="35.03" <?php if (($action == "entry") && ($grain10 == "35.03")) echo "SELECTED"?>>Munich Malt</option>
          <option value="32.00" <?php if (($action == "entry") && ($grain10 == "32.00")) echo "SELECTED"?>>Brown Malt</option>
          <option value="32.01" <?php if (($action == "entry") && ($grain10 == "32.01")) echo "SELECTED"?>>Dextrin Malt</option>
          <option value="34.01" <?php if (($action == "entry") && ($grain10 == "34.01")) echo "SELECTED"?>>Light Crystal Malt (10 - 15L)</option>
          <option value="34.00" <?php if (($action == "entry") && ($grain10 == "34.00")) echo "SELECTED"?>>Pale Crystal (25 - 40L)</option>
          <option value="34.02" <?php if (($action == "entry") && ($grain10 == "34.02")) echo "SELECTED"?>>Medium Crystal (40 - 75L)</option>
          <option value="33.00" <?php if (($action == "entry") && ($grain10 == "33.00")) echo "SELECTED"?>>Dark Crystal (75 - 120L)</option>
          <option value="31.00" <?php if (($action == "entry") && ($grain10 == "31.00")) echo "SELECTED"?>>Special B</option>
          <option value="28.00" <?php if (($action == "entry") && ($grain10 == "28.00")) echo "SELECTED"?>>Chocolate Malt</option>
          <option value="25.00" <?php if (($action == "entry") && ($grain10 == "25.00")) echo "SELECTED"?>>Roast Barley</option>
          <option value="25.01" <?php if (($action == "entry") && ($grain10 == "25.01")) echo "SELECTED"?>>Black Patent Malt</option>
          <option value="37.01" <?php if (($action == "entry") && ($grain10 == "37.01")) echo "SELECTED"?>>Wheat Malt</option>
          <option value="29.00" <?php if (($action == "entry") && ($grain10 == "29.00")) echo "SELECTED"?>>Rye Malt</option>
          <option value="32.02" <?php if (($action == "entry") && ($grain10 == "32.02")) echo "SELECTED"?>>Oatmeal (Flaked)</option>
          <option value="39.00" <?php if (($action == "entry") && ($grain10 == "39.00")) echo "SELECTED"?>>Corn (Flaked)</option>
          <option value="32.03" <?php if (($action == "entry") && ($grain10 == "32.03")) echo "SELECTED"?>>Barley (Flaked)</option>
          <option value="36.00" <?php if (($action == "entry") && ($grain10 == "36.01")) echo "SELECTED"?>>Wheat (Flaked)</option>
          <option value="38.01" <?php if (($action == "entry") && ($grain10 == "38.01")) echo "SELECTED"?>>Rice (Flaked)</option>
          <option value="40.00" <?php if (($action == "entry") && ($grain10 == "40.00")) echo "SELECTED"?>>Malto-Dextrin Powder</option>
          <option value="46.00" <?php if (($action == "entry") && ($grain10 == "46.00")) echo "SELECTED"?>>Sugar (Corn, Cane)</option>
      </select>	  </td>
      <td class="dataLabel data">Amt:</td>
      <td class="data"><input name="grain10amt" type="text" id="grain10amt" size="15" value="<?php if ($action == "entry") echo $grain10amt; ?>"></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Units:</td>
      <td colspan="2" class="data">
	      <select class="text_area" name="units">
          <option value="u.s." <?php if (($action == "entry") && ($units == "u.s.")) echo "SELECTED" ?>>U.S.</option>
          <option value="metric" <?php if (($action == "entry") && ($units == "metric")) echo "SELECTED" ?>>Metric</option>
          </select>	  </td>
      <td class="data">*indicates required field</td>
    </tr>
  </table>
</div>
<div class="calcButton">
<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
</div>
<?php } 

if ($action == "calculate") { 
?>
<div id="hide">
<input type="hidden" name="gravity" value="<?php echo $gravity; ?>">
<input type="hidden" name="wort" value="<?php echo $wort; ?>">
<input type="hidden" name="units" value="<?php echo $units; ?>">
<input type="hidden" name="grain" value="<?php echo $grain; ?>">
<input type="hidden" name="grain1" value="<?php echo $grain1; ?>">
<input type="hidden" name="grain2" value="<?php echo $grain2; ?>">
<input type="hidden" name="grain3" value="<?php echo $grain3; ?>">
<input type="hidden" name="grain4" value="<?php echo $grain4; ?>">
<input type="hidden" name="grain5" value="<?php echo $grain5; ?>">
<input type="hidden" name="grain6" value="<?php echo $grain6; ?>">
<input type="hidden" name="grain7" value="<?php echo $grain7; ?>">
<input type="hidden" name="grain8" value="<?php echo $grain8; ?>">
<input type="hidden" name="grain9" value="<?php echo $grain9; ?>">
<input type="hidden" name="grain10" value="<?php echo $grain10; ?>">
<input type="hidden" name="grain1amt" value="<?php echo $grain1amt; ?>">
<input type="hidden" name="grain2amt" value="<?php echo $grain2amt; ?>">
<input type="hidden" name="grain3amt" value="<?php echo $grain3amt; ?>">
<input type="hidden" name="grain4amt" value="<?php echo $grain4amt; ?>">
<input type="hidden" name="grain5amt" value="<?php echo $grain5amt; ?>">
<input type="hidden" name="grain6amt" value="<?php echo $grain6amt; ?>">
<input type="hidden" name="grain7amt" value="<?php echo $grain7amt; ?>">
<input type="hidden" name="grain8amt" value="<?php echo $grain8amt; ?>">
<input type="hidden" name="grain9amt" value="<?php echo $grain9amt; ?>">
<input type="hidden" name="grain10amt" value="<?php echo $grain10amt; ?>">
</div>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Brewhouse Efficiency Calculator</div>
<table>
<?php 
$ogconvert = ($gravity - 1) * 1000;
$ppg = ($ogconvert * $wort) / $grain;
switch ($units) 
	{
	case "u.s.": 
		echo "<tr><td class=\"dataLabelLeft\">Points/Pound/Gallon (PPG):</td><td class=\"data\">".round ($ppg, 2)."</td></tr>";
		break;
	case "metric":
		echo "<tr><td class=\"dataLabelLeft\">Points/Kilo/Liter (PKL):</td><td class=\"data\">".round (($ppg/10), 2)."</td></tr>";
		break;
	}
// Calculate Efficiency
switch ($units) 
	{
	case "u.s.": 
		$grain1calc = ($grain1 * $grain1amt)/$wort;
		$grain2calc = ($grain2 * $grain2amt)/$wort;
		$grain3calc = ($grain3 * $grain3amt)/$wort;
		$grain4calc = ($grain4 * $grain4amt)/$wort;
		$grain5calc = ($grain5 * $grain5amt)/$wort;
		$grain6calc = ($grain6 * $grain6amt)/$wort;
		$grain7calc = ($grain7 * $grain7amt)/$wort;
		$grain8calc = ($grain8 * $grain8amt)/$wort;
		$grain9calc = ($grain9 * $grain9amt)/$wort;
		$grain10calc = ($grain10 * $grain10amt)/$wort;
		break;
	case "metric":
		$grain1calc = ($grain1 * ($grain1amt * 2.202))/($wort * .264);
		$grain2calc = ($grain2 * ($grain2amt * 2.202))/($wort * .264);
		$grain3calc = ($grain3 * ($grain3amt * 2.202))/($wort * .264);
		$grain4calc = ($grain4 * ($grain4amt * 2.202))/($wort * .264);
		$grain5calc = ($grain5 * ($grain5amt * 2.202))/($wort * .264);
		$grain6calc = ($grain6 * ($grain6amt * 2.202))/($wort * .264);
		$grain7calc = ($grain7 * ($grain7amt * 2.202))/($wort * .264);
		$grain8calc = ($grain8 * ($grain8amt * 2.202))/($wort * .264);
		$grain9calc = ($grain9 * ($grain9amt * 2.202))/($wort * .264);
		$grain10calc = ($grain10 * ($grain10amt * 2.202))/($wort * .264);
		break;
	}
$efficiency_sum = ($grain1calc + $grain2calc + $grain3calc + $grain4calc + $grain5calc + $grain6calc + $grain7calc + $grain8calc + $grain9calc + $grain10calc);
	if (($efficiency_sum != 0) && ($gravity != ""))  {
	$efficiency = ($ogconvert / $efficiency_sum) * 100;
	echo "<tr><td class=\"dataLabelLeft\">Efficiency:</td><td class=\"data\">".round ($efficiency, 2)."%</td></tr>";
	}
?>
</table>
</div>
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div></form>
<?php } ?>