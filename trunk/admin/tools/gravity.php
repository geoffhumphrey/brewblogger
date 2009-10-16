<?php 
if (($action == "calculate") || ($action == "entry")) {
// All calculations derived from http://hbd.org/ensmingr/
// Get OG and FG from form
$og = $_POST['og']; 
$fg = $_POST['fg']; 

// Square OG and FG
$og2 = $og * $og;
$fg2 = $fg * $fg;

// Degrees Plato Calculation
$plato_i = (-463.37) + (668.72 * $og) - (205.35 * $og2);
$plato_f = (-463.37) + (668.72 * $fg) - (205.35 * $fg2);

// Calculate Real Extract
$real_extract = (0.1808 * $plato_i) + (0.8192 * $plato_f);

// Apparent Attenuation
$aa = (1 - ($plato_f / $plato_i)) * 100;

// Real Attenuation
$ra = (1 - ($real_extract / $plato_i)) * 100;

// Alcohol by Volume (returns percentage such as 5.2%)
$abv_calc = ($og - $fg ) / .75;
$abv = $abv_calc * 100;

// Alcohol by Weight
$abw_calc = (0.79 * $abv_calc) / $fg;
$abw = $abw_calc * 100;

// Calories (12 ounces)
$calories = ((6.9 * $abw) + 4.0 * ($real_extract - 0.1)) * $fg * 3.55;
} 
?>
<?php if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.og.value))
	{ errormessage += "\nOriginal Gravity."; }
if(WithoutContent(document.form1.fg.value))
	{ errormessage += "\nFinal Gravity."; }
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
<div id="referenceHeader">Calories, Alcohol, and Plato Calculator</div>
<table>
    <tr>
      <td class="dataLabelLeft">Original Gravity:</strong></td>
      <td class="data"><input name="og" type="text" id="og" size="10" value="<?php if ($action == "entry") echo $og; ?>">&nbsp;e.g., 1.052</td>
    </tr>
    <tr>
      <td class="dataLabelLeft"><strong>Final Gravity:</strong></td>
      <td class="data"><input name="fg" type="text" id="fg" size="10" value="<?php if ($action == "entry") echo $fg; ?>">&nbsp;e.g., 1.010</td>
    </tr>
  </table>
</div>
<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
<?php } if ($action == "calculate") { ?>
<input name="og" type="hidden" id="og" size="10" value="<?php echo $og; ?>">
<input name="fg" type="hidden" id="fg" size="10" value="<?php echo $fg; ?>">
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Calories, Alcohol, and Plato Calculator</div>
<table>
  <tr>
    <td class="dataLabelLeft">Original Gravity:</td>
    <td class="data"><?php echo $og; ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Final Gravity:</td>
    <td class="data"><?php echo $fg; ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Initial Gravity (Plato):</td>
    <td class="data"><?php echo round ($plato_i, 2); ?>&deg; P</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Final Gravity (Plato):</td>
    <td class="data"><?php echo round ($plato_f, 2); ?>&deg; P</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Real Extract: </td>
    <td class="data"><?php echo round ($real_extract, 2); ?>&deg; P</td>
 </tr>
  <tr>
    <td class="dataLabelLeft">Apparent Attenuation:</td>
    <td class="data"><?php echo round ($aa, 1); ?>%</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Real Attenuation:</td>
    <td class="data"><?php echo round ($ra, 1); ?>%</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Alcohol By Volume (ABV):</td>
    <td class="data"><?php echo round ($abv, 1); ?>%</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Alcohol By Weight (ABW):</td>
    <td class="data"><?php echo round ($abw, 1); ?>%</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Calories (12 ounces):</td>
    <td class="data"><?php echo round ($calories, 0); ?></td>
  </tr>
  <tr>
    <td colspan="2"><p>Calculations derived from Peter Ensminger's article <em>Beer Data: Alcohol, Calorie, and Attenuation Levels of Beer</em>, <a href="http://hbd.org/ensmingr/" target="_blank">here</a>.</p></td>
  </tr>
</table>
</div>
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div><?php } ?>
</form>