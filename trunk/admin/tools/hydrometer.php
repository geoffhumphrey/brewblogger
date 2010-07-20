<?php
  /*
   ***********************************************
   * Hydrometer Correction Calculator
   *
   * Adjust a SG hydrometer reading correcting for
   * variance from calibration temperature.
   * Calculation derived from Christopher Lyons 
   * hydrometer correction equation in Home Brew 
   * Digest 963.
   ***********************************************
   */

// Default hydrometer calibration temperature in Fahrenheit.
// This needs to be a user profile variable.
$CAL_TEMP_DEFAULT = 60;

$calTemp = $_POST["calTemp"];
$temp    = $_POST["temp"];
$sg      = $_POST["sg"];
$units   = $_POST["units"];

if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
    <!-- Copyright 2003 Bontrager Connection, LLC
    // Code obtained from http://WillMaster.com/
    function CheckRequiredFields() {
      var errormessage = new String();
      // Put field checks below this point.
      if(WithoutContent(document.form1.calTemp.value))
	{ errormessage += "\nHydrometer calibration temperature."; }
      if(WithoutContent(document.form1.temp.value))
	{ errormessage += "\nTemperature of the wort sample."; }
      if(WithoutContent(document.form1.sg.value))
	{ errormessage += "\nSpecific Gravity of the wort sample."; }
      // Put field checks above this point.
      if(errormessage.length > 2) {
        alert('To calculate properly, the following information is needed:\n' + errormessage);
        return false;
      }
      return true;
    }

    function WithoutContent(ss) {
      if(ss.length > 0) { return false; }
      return true;
    }
  //-->
  </script>
  <?php } ?>

<form name="form1" method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=<?php if (($action == "default") || ($action == "entry")) echo 'calculate" onSubmit="return CheckRequiredFields()"'; if ($action == "calculate") echo 'entry"'; ?>>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; else echo "Calc"; ?>">
<div id="referenceHeader">Hydrometer Correction Calculator</div>

<?php if (($action == "default") || ($action == "entry")) { ?>
<table>
<tr>
  <td class="dataLabelLeft">Specific Gravity:</td>
  <td class="data"><input name="sg" type="text" id="sg" size="5" value="<?php if ($action == "entry") echo $sg; ?>"></td>
</tr>
<tr>
  <td class="dataLabelLeft">Temperature:</td>
  <td class="data"><input name="temp" type="text" id="temp" size="5" value="<?php if ($action == "entry") echo $temp; ?>">&deg;&nbsp;</td>
</tr>
<tr>
  <td class="dataLabelLeft">Hydrometer Calibration Temperature:</td>
  <td class="data"><input name="calTemp" type="text" id="calTemp" size="5" value="<?php if ($action == "default") echo $CAL_TEMP_DEFAULT; if ($action == "entry") echo $calTemp; ?>">&deg;&nbsp</td>
</tr>
<tr>
  <td class="dataLabelLeft">Units:</td>
  <td class="data">
    <select name="units" id="units">
      <option value="f" <?php if (($action == "default") || (($action == "entry") && ($units == "f"))) echo "SELECTED"; ?>>Fahrenheit&nbsp;</option>
      <option value="c" <?php if (($action == "entry") && ($units == "c")) echo "SELECTED"; ?>>Celsius</option>
    </select>
  </td>
</tr>
</table>
</div>
<table class="dataTable">
<tr>
  <td><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_calculate_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Calculate" class="radiobutton" value="Calculate"></td>
  <?php if ($action == "entry") { ?>
  <td align="right"><a href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_clear_<?php echo $row_colorChoose['themeName']; ?>.png" border="0" title="Clear" alt="Clear"/></a></td>
  <?php } ?>
</tr>
</table>
<?php }

if ($action == "calculate") {
  if ($units == "c") {
    // Retain original celsius values for temps to avoid converting back and forth which introduces rounding issues.
    $temp_o    = $temp;
    $calTemp_o = $calTemp;
    $temp      = $temp * 1.8 + 32;
    $calTemp   = $calTemp * 1.8 + 32;
  }
  // Temps must be in F for these formulas.
  $tAdj   = (1.313454 - 0.132674 * $temp + 2.057793e-3 * ($temp * $temp) - 2.627634e-6 * ($temp * $temp * $temp)) * 10e-4;
  $calAdj = (1.313454 - 0.132674 * $calTemp + 2.057793e-3 * ($calTemp * $calTemp) - 2.627634e-6 * ($calTemp * $calTemp * $calTemp)) * 10e-4;
  $correctedSG = $sg + ($tAdj - $calAdj);
  if ($units == "c") {
    $temp    = $temp_o;
    $calTemp = $calTemp_o;
  }
  echo "<table>";
  echo "<tr><td class=\"dataLabelLeft\">Adjusted Specific Gravity:</td><td class=\"data\">".round($correctedSG, 3)."</td><td class=\"data\">&nbsp;</td></tr>";
  echo "</table>";
  echo "<tr>";
  echo "<td colspan=\"3\"><br><p>Calculation derived from Christopher Lyons' hydrometer correction equation in Home Brew Digest #963.</p></td>";
  echo "<tr>";
  echo "</table>";
?>
<input name="calTemp" type="hidden" id="calTemp" value="<?php echo $calTemp; ?>">
<input name="temp" type="hidden" id="temp" value="<?php echo $temp; ?>">
<input name="sg" type="hidden" id="sg" value="<?php echo $sg; ?>">
<input name="units" type="hidden" id="units" value="<?php echo $units; ?>">
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><?php } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div><?php } ?>
</form>