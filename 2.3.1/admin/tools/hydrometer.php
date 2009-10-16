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
$calTemp = $_POST["calTemp"];
$temp = $_POST["temp"];
$sg = $_POST["sg"];
$units = $_POST["units"];
?>

<form name="form1" method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=<?php if (($action == "default") || ($action == "entry")) echo "calculate"; if ($action == "calculate") echo "entry"; ?>">
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; else echo "Calc"; ?>">
<div id="referenceHeader">Hydrometer Correction Calculator</div>
<?php if (($action == "default") || ($action == "entry")) { ?>
<table>
<tr>
  <td class="dataLabelLeft">Specific Gravity:</td>
  <td colspan="2" class="data"><input name="sg" type="text" id="sg" size="5" value="<?php if ($action == "entry") echo $sg; ?>"></td>
  </tr>
<tr>
  <td class="dataLabelLeft">Temperature:</td>
  <td class="data" width="5%" nowrap="nowrap"><input name="temp" type="text" id="temp" size="5" value="<?php if ($action == "entry") echo $temp; ?>">&deg;</td>
  <td class="data"><select name="units2" id="units2">
    <option value="f" <?php if ($action == "default") echo "SELECTED"; if (($action == "entry") && ($units == "f")) echo "SELECTED"; ?>>Fahrenheit&nbsp;</option>
    <option value="c" <?php if (($action == "entry") && ($units == "c")) echo "SELECTED"; ?>>Celsius</option>
  </select></td>
</tr>
<tr>
  <td class="dataLabelLeft">Hydrometer Calibration Temperature:</td>
  <td colspan="2" class="data"><input name="calTemp" type="text" id="calTemp" size="5" value="<?php if ($action == "entry") echo $calTemp; ?>"></td>
</tr>
</table>
</div>
<?php if (($action == "default") || ($action == "entry")) { if (!checkmobile()) { ?><input class="calcButton" type="image" src="<?php echo $imageSrc."Brilliant" ?>/button_calculate_Brilliant.png" alt="Calculate" class="radiobutton" value="Calculate"><?php } else { ?><input type="submit" class="buttons" value="Calculate" /><?php } } ?>
		<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
		<?php if ($action == "calculate") { if (!checkmobile()) { ?><input class="calcButton" type="image" src="<?php echo $imageSrc."Brilliant" ?>/button_back_Brilliant.png" alt="Calculate" class="radiobutton" value="Re-enter Values"><?php } else { ?><input type="submit" class="radiobutton" value="Go Back"><?php } } ?>

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