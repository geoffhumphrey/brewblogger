<?php
//-----------------------//
// Bitterness Calculator //
//-----------------------//

// Load the library of bitterness formula functions
// The file_exists.. statement helps determine what our CWD is since the getcwd()
// function isn't entirely portable or may be disabled.
if (file_exists("bitterness.php"))
  require "../lib/bitterness.lib.php";
else
  require "admin/lib/bitterness.lib.php";

// This is the maximum number of hop entries we can 
// process in this calculator.
$MAX_HOPS = 20;

// Initial number of hop entries to display.
$INIT_HOP_ENTRIES = 3;

// Default hop form ('whole' or 'pellet')
$DEFAULT_FORM = 'pellet';

// Default batch size
if ($row_user['defaultBatchSize'] > 0) {
  $DEFAULT_BATCH_SZ = $row_user['defaultBatchSize'];
 } else {
  if ($row_pref['measFluid2'] == "gallons")
    $DEFAULT_BATCH_SZ = 5;
  else
    $DEFAULT_BATCH_SZ = 19;
 }

if (($action == "calculate") || ($action == "entry")) {
// The $form variable and 'form' $_POST key are in reference to
// the format of the hops, i.e. whole/plug or pellet.
// It's easy to confuse this with fact that it's being 
// submitted via an HTML form.

  for ($i = 0; $i < $MAX_HOPS; $i++) {
    $hopWeight[$i]   = $_POST['hopWeight'][$i];
    $hopAA[$i]       = $_POST['hopAA'][$i];
    $utilization[$i] = $_POST['utilization'][$i];
    $form[$i]        = $_POST['form'][$i];
  }

  $preBoilVol  = $_POST['preBoilVol'];
  $finalVol    = $_POST['finalVol'];
  $gravity     = $_POST['gravity'];
  $desiredIBUs = $_POST['desiredIBUs'];
  $elevation   = $_POST['elevation'];
  $units       = $_POST['units'];

  // Tinseth method
  $ibuT = 0;
  for ($i = 0; $i < $MAX_HOPS; $i++) {
    $ibu_T[$i] = calc_bitter_tinseth($utilization[$i], $gravity, $hopAA[$i], $hopWeight[$i], $finalVol, $form[$i], $units);
    $ibuT     += $ibu_T[$i];
  }

  // Rager Method
  $ibuR = 0;
  for ($i = 0; $i < $MAX_HOPS; $i++) {
    $ibu_R[$i] = calc_bitter_rager($utilization[$i], $gravity, $hopAA[$i], $hopWeight[$i], $finalVol, $form[$i], $units);
    $ibuR     += $ibu_R[$i];
  }

  // Daniels Method
  $ibuD = 0;
  for ($i = 0; $i < $MAX_HOPS; $i++) {
    $ibu_D[$i] = calc_bitter_daniels($utilization[$i], $gravity, $hopAA[$i], $hopWeight[$i], $finalVol, $form[$i], $units);
    $ibuD     += $ibu_D[$i];
  }

  // Garetz Method
  $ibuG = 0;
  if (($preBoilVol > 0) && ($desiredIBUs > 0) && ($elevation >= 0)) {
    for ($i = 0; $i < $MAX_HOPS; $i++) {
      $ibu_G[$i] = calc_bitter_garetz($utilization[$i], $gravity, $hopAA[$i], $hopWeight[$i], $finalVol, $form[$i], $units,
				      $preBoilVol, $desiredIBUs, $elevation);
      $ibuG     += $ibu_G[$i];
    }
  }

 } // End if calculate

if (($action == "default") || ($action == "entry")) { 
  ?>
  <script type="text/javascript" language="JavaScript" src="<?php if (file_exists("bitterness.js")) echo "bitterness.js"; else echo "admin/tools/bitterness.js"; ?>"></script>
  <form name="form1" method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=calculate" onSubmit="return CheckRequiredFields()">
  <div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
  <div id="referenceHeader">International Bitterness Unit (IBU) Calculator</div>
  <table id="hop_entries">
	
  <?php
  function create_hop_entries($start, $end) {
    global $action, $hopWeight, $hopAA, $utilization, $form, $DEFAULT_FORM;
    for ($i = $start; $i <= $end; $i++) {
      echo '<tr>';
      echo '<td class="dataLabelLeft">Hop ' . ($i + 1) . ' Weight:';
      if ($i == 0) echo '*';
      echo '</td>'."\n";
      echo '<td class="data"><input name="hopWeight['.$i.']" type="text" size="5" value="';
      if ($action == "entry") echo $hopWeight[$i];
      echo '" /></td>'."\n";
      echo '<td class="dataLabel">Hop ' . ($i + 1) . ' AA%:';
      if ($i == 0) echo '*';
      echo '</td>'."\n";
      echo '<td class="data"><input name="hopAA['.$i.']" type="text" size="5" value="';
      if ($action == "entry") echo $hopAA[$i];
      echo '" /></td>'."\n";
      echo '<td class="dataLabel">Hop ' . ($i + 1) . ' Time (min):';
      if ($i == 0) echo '*';
      echo '</td>'."\n";
      echo '<td class="data"><input name="utilization['.$i.']" type="text" size="5" value="';
      if ($action == "entry") echo $utilization[$i];
      echo '" /></td>'."\n";
      echo '<td class="dataLabel">Form:</td>'."\n";
      echo '<td class="data" nowrap="nowrap">';
      echo '<input type="radio" name="form['.$i.']" value="pellet"';
      if ((($action == "entry") && ($form[$i] == "pellet")) || ($DEFAULT_FORM == "pellet")) echo ' CHECKED';
      echo ' />Pellet&nbsp;';
      echo '<input type="radio" name="form['.$i.']" value="whole"';
      if ((($action == "entry") && ($form[$i] == "whole")) || ($DEFAULT_FORM == "whole")) echo ' CHECKED';
      echo ' />Whole/Plug</td>'."\n";
      echo '</tr>'."\n";
    }
  }
    
  create_hop_entries(0, $INIT_HOP_ENTRIES - 1);

  // Add any extra hop entries if the user previously gave values for them.
  if ($action == "entry") {
    $endHopEntries = 0;
    for ($i = $INIT_HOP_ENTRIES; $i < $MAX_HOPS; $i++) {
      if ($hopWeight[$i] > 0) $endHopEntries = $i;
    }
    if ($endHopEntries > 0) create_hop_entries($INIT_HOP_ENTRIES, $endHopEntries);
  }
  ?>
  
  <tr id="addHopButtonRow">
  <td><input id="addHopButton" type="button" value="Add Hop Entry" onClick="addHop('hop_entries', <?php echo $MAX_HOPS . ', \'' . $DEFAULT_FORM . '\', '; if (($action == "entry") && ($endHopEntries > 0)) echo $endHopEntries + 1; else echo $INIT_HOP_ENTRIES; ?>);" class="add_button"></td>
  </tr>
  <tr>
     <td class="dataLabelLeft">Final Volume:*</td>
     <td class="data"><input name="finalVol" type="text" id="finalVol" size="5" value="<?php if ($action == "default") echo $DEFAULT_BATCH_SZ; else echo $finalVol; ?>" /></td>
  </tr>
  <tr>
     <td class="dataLabelLeft">Original Gravity:*</td>
     <td class="data"><input type="text" name="gravity" id="gravity" size="5" value="<?php if ($action == "entry") echo $gravity; ?>" /></td>
     <td colspan="6">e.g., 1.045</td>
  </tr>
  <tr>
     <td class="dataLabelLeft">Target IBUs:</td>
     <td class="data"><input type="text" name="desiredIBUs" id="desiredIBUs" size="5" value="<?php if ($action == "entry") echo $desiredIBUs; ?>" /></td>
     <td colspan="6">(Only required for Garetz)</td>
  </tr>
  <tr>
     <td class="dataLabelLeft">Elevation:</td>
     <td class="data"><input type="text" name="elevation" id="elevation" size="5" value="<?php if ($action == "entry") echo $elevation; ?>" /></td>
     <td colspan="6">feet or meters (Only required for Garetz)</td>
  <tr>
     <td class="dataLabelLeft">Pre-Boil Volume:</td>
     <td class="data"><input name="preBoilVol" type="text" id="preBoilVol" size="5" value="<?php if ($action == "entry") echo $preBoilVol; ?>" /></td>
     <td colspan="6">(Only required for Garetz)</td>
  </tr>
  <tr>
     <td class="dataLabelLeft">Units</td>
     <td class="data" colspan="3">
     <select class="text_area"  name="units">
     <?php
     if (($action == "default") && (($row_pref['measWeight1'] == "grams") || ($row_pref['measWeight2'] == "ounces")))
       $units = "metric";
     elseif ($action == "default")
       $units = "us";
     ?>
     <option value="us" <?php if ($units == "us") echo "SELECTED" ?>>U.S.</option>
     <option value="metric" <?php if ($units == "metric") echo "SELECTED" ?>>Metric&nbsp;</option>
     </select></td>
     <td class ="dataLabelWide data" colspan="4">* indicates required field</td>
  </tr>
</table>
</div>

<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
</form>
    <?php } // end if "default" || "entry"

if  ($action == "calculate") { ?>
<form name="form1" method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=entry">
<div id="hide">

<?php
for ($i = 0; $i < $MAX_HOPS; $i++) {
  echo '<input name="hopWeight['.$i.']" type="hidden" value="'.$hopWeight[$i].'" />';
  echo '<input name="hopAA['.$i.']" type="hidden" value="'.$hopAA[$i].'" />';
  echo '<input name="utilization['.$i.']" type="hidden" value="'.$utilization[$i].'" />';
  echo '<input name="form['.$i.']" type="hidden" value="'.$form[$i].'" />';
}
?>
<input name="finalVol" type="hidden" value="<?php echo $finalVol; ?>" />
<input name="gravity" type="hidden" value="<?php echo $gravity; ?>" />
<input name="desiredIBUs" type="hidden" value="<?php echo $desiredIBUs; ?>" />
<input name="elevation" type="hidden" value="<?php echo $elevation; ?>" />
<input name="preBoilVol" type="hidden" value="<?php echo $preBoilVol; ?>" />
<input name="units" type="hidden" value="<?php echo $units; ?>" />
</div>

<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">International Bitterness Unit Calculator</div>
<table>
   <tr>
     <td class="dataHeading">&nbsp;</td>
     <td class="data dataHeading" width="10%">Daniels</td>
     <td class="data dataHeading" width="10%">Garetz</td>
     <td class="data dataHeading" width="10%">Rager</td>
     <td class="data dataHeading">Tinseth</td>
   </tr>

<?php
  $endHopEntries = 0;
  for ($i = 0; $i < $MAX_HOPS; $i++) {
    if ($ibu_T[$i] > 0) $endHopEntries = $i;
  }

  for ($i = 0; $i <= $endHopEntries; $i++) {
    echo '<tr>';
    echo '<td class="dataLabelLeft">Hop ' . ($i + 1) . ' IBU: </td>';
    echo '<td class="data">' . round($ibu_D[$i], 1) . '</td>';
    echo '<td class="data">' . round($ibu_G[$i], 1) . '</td>';
    echo '<td class="data">' . round($ibu_R[$i], 1) . '</td>';
    echo '<td class="data">' . round($ibu_T[$i], 1) . '</td>';
    echo '</tr>';
  }
?>

   <tr>
     <td class="dataLabelLeft bdr1T_dark">Total IBUs:</td>
     <td class="data bdr1T_dark"><?php echo round ($ibuD, 1); ?></td>
     <td class="data bdr1T_dark"><?php echo round ($ibuG, 1); ?></td>
     <td class="data bdr1T_dark"><?php echo round ($ibuR, 1); ?></td>
     <td class="data bdr1T_dark"><?php echo round ($ibuT, 1); ?></td>
   </tr>
   <tr>
     <td class="dataLabelLeft">Average IBUs:</td>
     <?php
       if ($ibuG > 0) { 
	 echo '<td class="data" colspan="4">'; 
	 $ibuAverage = ($ibuG + $ibuR + $ibuT + $ibuD) / 4;
	 echo round ($ibuAverage, 1) . '</td>';
       } else { 
	 echo '<td class="data">'; 
	 $ibuAverage = ($ibuR + $ibuT + $ibuD) / 3; 
	 echo round ($ibuAverage, 1);
	 echo '<td class="data" colspan="3">(Garetz formula excluded from avg.)</td>';
       }
     ?>
   </tr>
      <?php
       if ($desiredIBUs > 0) {
	 echo '<tr>';
	 echo '<td class="dataLabelLeft">Target IBUs:</td>';
	 echo '<td class="data" colspan="4">' . $desiredIBUs . '</td>';
	 echo '</tr>';
       }
      ?>
   </table>
   </div>
										       
<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div>
<?php } ?>