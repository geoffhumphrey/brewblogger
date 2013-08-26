<?php 
/**
 * Module: hops.recipe.php
 * Description: Build hop section on recipe/blog form.
 */

// $action = ['add' | 'edit' | 'import' | 'reuse' | 'importRecipe' | 'importCalc'] 

// If we're importing from the calc, we have to make some guesses
// about hop type and use.
if ($action == "importCalc") { 
  function get_hop_type($time, $field) { 
    $rv = 0;

    if ($time) {
      switch ($field) { 
      case "Bittering":
	if ($time > 30) $rv = 1;
	break;
      case "Flavor":
	if (($time <= 30) && ($time >= 15)) $rv = 1;
	break;
      case "Aroma":
	if (($time < 15) && ($time >= 0)) $rv = 1;
	break;
      }
    }

    return $rv;
  }

  function get_hop_use($time, $boil_time, $field) { 
    $rv = 0;
    if ($boil_time == "") $boil_time = 60;

    if ($time) {
      switch ($field) { 
      case "First Wort":
	if ($time > $boil_time) $rv = 1;
	break;
      case "Boil":
	if  (($time <= $boil_time) && ($time > 15)) $rv = 1;
	break;
      case "Aroma":
	if  (($time <= 15) && ($time > 0)) $rv = 1;
	break;
      case "Dry Hop":
	if  ($time <= 0) $rv = 1;
	break;
      }
    }

    return $rv;
  }
 }
?>

<div class="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=hops&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>/information.png" border="0"></a></div>Hops</div>
<table class="dataTable">
<tr>
   <td>&nbsp;</td>
   <td class="dataLabel">Name</td>
   <td class="dataLabel">Wt</td>
   <td class="dataLabel">AAU</td>
   <td class="dataLabel">Time</td>
   <td class="dataLabel">Use</td>
   <td class="dataLabel">Type</td>
   <td class="dataLabel">Form</td>
</tr>

<?php

for ($i = 0; $i < MAX_HOPS; $i++) {
  echo '<tr>' . "\n";
  echo '<td class="dataLabelLeft">Hop ' . ($i + 1) . ':</td>' . "\n";

  echo '<td class="data"><select name="hopsName['.$i.']">' . "\n";
  $key = "brewHops" . ($i + 1);
  if ((($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) && ($row_log[$key] != "")) {
    echo '<option value="' . $row_log[$key] . '">' . $row_log[$key] . '</option>' . "\n";
  }
  echo '<option value=""></option>' . "\n";
  echo '<option value="">-- Items below are in the Hops DB --</option>' . "\n";
  do {
    echo '<option value="' . $row_hops['hopsName'] . '" ';
    if (($action != "add") && ((($action != "importCalc") && ($row_hops['hopsName'] == $row_log[$key])) ||
			       (($action == "importCalc") && ($row_hops['hopsName'] == $hopsName[$i])))) {
      echo "SELECTED";
    }
    echo '>' . $row_hops['hopsName'] . '</option>' . "\n";
  } while ($row_hops = mysql_fetch_array($hops));

  // Reset $row_hops to first row
  $rows = mysql_num_rows($hops);
  if ($rows > 0) {
    mysql_data_seek($hops, 0);
    $row_hops = mysql_fetch_array($hops);
  }
  echo '<option value="Other">Other</option>' . "\n";
  echo '</select>' . "\n";
  echo '</td>' . "\n";

  echo '<td nowrap="nowrap" class="data"><input name="hopsWeight['.$i.']" type="text" size="1" tooltipText="' . $toolTip_decimal . '" value="';
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    $key = "brewHops" . ($i + 1) . "Weight";
    echo $row_log[$key];
  } elseif ($action == "importCalc") {
    echo $hopsWeight[$i];
  }
  echo '">&nbsp;';
  if ($row_pref['measWeight1'] == "ounces") {
    echo "oz.";
  } else {
    echo "g.";
  }
  echo '</td>' . "\n";

  echo '<td nowrap="nowrap" class="data"><input name="hopsAA['.$i.']" type="text" size="1" tooltipText="' . $toolTip_decimal . '" value="';
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    $key = "brewHops" . ($i + 1) . "IBU";
    echo $row_log[$key];
  } elseif ($action == "importCalc") {
    echo $hopsAA[$i];
  }
  echo '">&nbsp;%</td>' . "\n";

  echo '<td nowrap="nowrap" class="data"><input type="text" name="hopsTime['.$i.']" size="1" value="';
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    $key = "brewHops" . ($i + 1) . "Time";
    echo $row_log[$key];
  } elseif ($action == "importCalc") {
    echo $hopsTime[$i];
  }
  echo '">&nbsp;min.' . "\n";
  echo '</td>' . "\n";

  echo '<td class="data"><select name="hopsUse['.$i.']">' . "\n";
  echo '<option value=""></option>' . "\n";
  echo '<option value="Boil" ';
  $key = "brewHops" . ($i + 1) . "Use";
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Boil")) ||
			     (($action == "importCalc") && (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Boil"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Boil") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Boil")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Boil</option>' . "\n";

  echo '<option value="Dry Hop" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Dry Hop")) ||
			     (($action == "importCalc") && (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Dry Hop"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Dry Hop") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Dry Hop")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Dry Hop</option>' . "\n";

  echo '<option value="Mash" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Mash")) ||
			     (($action == "importCalc") && (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Mash"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Mash") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Mash")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Mash</option>' . "\n";

  echo '<option value="Aroma" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Aroma")) ||
			     (($action == "importCalc") && (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Aroma"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Aroma") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "Aroma")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Aroma</option>' . "\n";

  echo '<option value="First Wort" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "First Wort")) ||
			     (($action == "importCalc") && (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "First Wort"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "First Wort") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_use($hopsTime[$i], $row_log['brewBoilTime'], "First Wort")) {
      echo "SELECTED";
    }
  }
  */
  echo '>First Wort</option>' . "\n";
  echo '</select>' . "\n";
  echo '</td>' . "\n";

  echo '<td class="data"><select name="hopsType['.$i.']">' . "\n";
  echo '<option value=""></option>' . "\n";
  echo '<option value="Bittering" ';
  $key = "brewHops" . ($i + 1) . "Type";
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Bittering")) ||
			     (($action == "importCalc") && (get_hop_type($hopsTime[$i], "Bittering"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Bittering") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_type($hopsTime[$i], "Bittering")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Bittering</option>' . "\n";

  echo '<option value="Flavor" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Flavor")) ||
			     (($action == "importCalc") && (get_hop_type($hopsTime[$i], "Flavor"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Flavor") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_type($hopsTime[$i], "Flavor")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Flavor</option>' . "\n";

  echo '<option value="Aroma" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Aroma")) ||
			     (($action == "importCalc") && (get_hop_type($hopsTime[$i], "Aroma"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Aroma") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_type($hopsTime[$i], "Aroma")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Aroma</option>' . "\n";

  echo '<option value="Both" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Both")) ||
			     (($action == "importCalc") && (get_hop_type($hopsTime[$i], "Both"))))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Both") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if (get_hop_type($hopsTime[$i], "Both")) {
      echo "SELECTED";
    }
  }
  */
  echo '>Both</option>' . "\n";
  echo '</select>' . "\n";
  echo '</td>' . "\n";
  
  echo '<td class="data"><select name="hopsForm['.$i.']">' . "\n";
  echo '<option value=""></option>' . "\n";
  echo '<option value="Pellets" ';
  $key = "brewHops" . ($i + 1) . "Form";
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Pellets")) ||
			     (($action == "importCalc") && ($hopsForm[$i] == "Pellets")))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Pellets") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if ($hopsForm[$i] == "Pellets") {
      echo "SELECTED";
    }
  }
  */
  echo '>Pellets</option>' . "\n";

  echo '<option value="Plug" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Plug")) ||
			     (($action == "importCalc") && ($hopsForm[$i] == "Plug")))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Plug") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if ($hopsForm[$i] == "Plug") {
      echo "SELECTED";
    }
  }
  */
  echo '>Plug</option>' . "\n";

  echo '<option value="Leaf" ';
  if (($action != "add") && ((($action != "importCalc") && ($row_log[$key] == "Leaf")) ||
			     (($action == "importCalc") && ($hopsForm[$i] == "Leaf")))) {
    echo "SELECTED";
  }
  /*
  if (($action == "edit") || ($action == "import") || ($action == "importRecipe") || ($action == "reuse")) {
    if ($row_log[$key] == "Leaf") {
      echo "SELECTED";
    }
  } elseif ($action == "importCalc") {
    if ($hopsForm[$i] == "Leaf") {
      echo "SELECTED";
    }
  }
  */
  echo '>Leaf</option>';
  echo '</select>' . "\n";
  echo '</td>' . "\n";
  echo '</tr>' . "\n";
}

?>
</table>