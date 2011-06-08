<?php 
/**
 * Module: recipe_calculator.php
 * Description: Sets up the main Recipe Calculator page for calculating or recalculating a new or existing
 *              recipe or blog. Also processes the form until the user is satisfied with results and moves
 *              to next step in calculation/recalculation process.
 */

$imageSrc = "../images/";

// If recalculating an existing recipe or blog, get info from db.
if ($id != "default") {
  mysql_select_db($database_brewing, $brewing);
  $query_recipeRecalc = "SELECT * FROM ";

  if ($source == "brewing") {
    $query_recipeRecalc .= "brewing ";
  } else {
    // $source must be 'recipes'
    $query_recipeRecalc .= "recipes ";
  }

  $query_recipeRecalc .= " WHERE id='$id'";
  $recipeRecalc        = mysql_query($query_recipeRecalc, $brewing) or die(mysql_error());
  $row_recipeRecalc    = mysql_fetch_array($recipeRecalc);
}

if ($action == "calculate") {
  if (($results == "true") || ($results == "verify")) {
    // If we're verifying then all the calcs have already been done and there shouldn't be
    // any reason to include the following two libs. So, if $results == "verify" can't we 
    // skip this section?
    include 'lib/calculations.lib.php';
    include 'lib/calcFormVar.lib.php'; 

    mysql_select_db($database_brewing, $brewing);
    $query_hops = "SELECT * FROM hops";
    $hops = mysql_query($query_hops, $brewing);
    $row_hops = mysql_fetch_array($hops);
  }

  if ($results != "verify") { ?>
    <div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
    <div id="subtitleAdmin"><?php echo $page_title; ?></div>

    <?php if ($results == "true") include 'lib/predicted.lib.php'; ?>
						      
    <form id="form3" action="index.php?action=calculate&results=true&filter=<?php echo $filter; if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>" method="post" name="form3" onSubmit="return CheckRequiredFields()">
    <input type="hidden" name="brewBrewerID" value="<?php echo $filter; ?>">
    <div class="headerContentAdmin">General Information</div>

    <table>
      <tr>
        <td class="dataLabelLeft">Name:</td>
        <td class="data"><input type="text" name="brewName" value="<?php if ($results == "true") echo $brewName; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewName']; ?>" size="30"></td>
      </tr>
      <tr>
        <td class="dataLabelLeft"><div id="help"><a href="../sections/reference.inc.php?section=styles&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Styles Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Style:</td>
        <td class="data">
        <select name="brewStyle">
        <?php 
        do {  ?>
	   <option value="<?php echo $row_styles['brewStyle']?>" <?php if ($results == "true") { if ($brewStyle == $row_styles['brewStyle']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewStyle'] == $row_styles['brewStyle']) echo "SELECTED" ; } ?>><?php echo $row_styles['brewStyle'];?></option>
        <?php } while ($row_styles = mysql_fetch_array($styles)); $rows = mysql_num_rows($styles); if($rows > 0) { mysql_data_seek($styles, 0); $row_styles = mysql_fetch_array($styles); } ?>
        </select></td>
      </tr>
    </table>
	    	    
    <table>
      <tr>
        <td class="dataLabelLeft">Finished Vol. (Batch Size):</td>
        <td class="data" width="5%"><input id="brewYield" name="brewYield" type="text" size="10" value="<?php if ($results == "true") echo $brewYield; elseif ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewYield']; else echo "5"; ?>"></td>
        <td class="data"><?php echo $row_pref['measFluid2']; ?></td>
      </tr>
      <tr>
        <td class="dataLabelLeft">System Efficiency %:</td>
        <td class="data"><input name="efficiency" type="text" size="10" value="<?php if ($results == "true") echo ($efficiency * 100); else echo "72"; ?>"></td>
        <td class="data">%</td>
      </tr>
      <tr>
        <td class="dataLabelLeft">Attenuation %:</td>
        <td class="data"><input name="attenuation" type="text" size="10" value="<?php if ($results == "true") echo ($attenuation * 100); else echo "75"; ?>"></td>
        <td class="data">%</td>
      </tr>
    </table>
								   
<!-- Extracts -->
<div class="headerContentAdmin">Malt Extracts</div>
<table>
  <tr>
    <td colspan="5" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Extracts?" title="Add Extracts?"></span>&nbsp;<a href="index.php?action=add&dbTable=extract">Add Extracts?</a></td>
  </tr>

** START LOOP **
  <?php
  function create_extract_entries($start, $end) {
    global $extName, $extWeight, $row_extracts, $row_pref, $row_recipeRecalc, 
    $extracts, $id, $totalGrist, $results;
    
    for ($i = 0; $i < $end; $i++) {
      echo '<tr>' . "\n";
      echo '<td class="dataLabelLeft">Extract ' . ($i + 1) . ':</td>' . "\n";
      echo '<td class="data" width="5%"><select name="extName['.$i.']">' . "\n";
      echo '<option value=""></option>' . "\n";
      do {
	echo '<option value="' . $row_extracts['extractName'] . '" ';
	$key = "brewExtract" . ($i + 1);
	if ((($results == "true") && ($extName[$i] == $row_extracts['extractName'])) ||
	    (($id != "default") && ($results == "false") && ($row_recipeRecalc[$key] == $row_extracts['extractName']))) {
	    echo "SELECTED";
	}
	echo '>' . $row_extracts['extractName'] . '</option>' . "\n";
      } while ($row_extracts = mysql_fetch_array($extracts));
      echo '</select></td>' . "\n";

      # Reset $row_extracts to first row
      $rows = mysql_num_rows($extracts);
      if ($rows > 0) {
	mysql_data_seek($extracts, 0);
	$row_extracts = mysql_fetch_array($extracts);
      }

      echo '<td class="dataLabel">Weight:</td>' . "\n";
      echo '<td class="data" width="5%"><input name="extWeight['.$i.']" type="text" size="5" value="';
      if ($results == "true") {
	echo $extWeight[$i];
      }
      if (($id != "default") && ($results == "false")) {
	$key = "brewExtract" . ($i + 1) . "Weight";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";
      echo '<td class="data" ';
      if ($results == "true") {
	echo 'width="5%"';
      }
      echo '>' . $row_pref['measWeight2'] . '</td>' . "\n";
      if ($results == "true") {
	if ($extWeight[$i] != "") {
	  $pctGrist = $extWeight[$i] / $totalGrist * 100;
	  echo '<td class="data">' . round($pctGrist, 1) . '%</td>';
	} else {
	  echo '<td>&nbsp;</td>';
	}
      }
      echo '</tr>' . "\n";
    }
  }
    create_extract_entries(0, MAX_EXT);
/*
    <tr>
   	<td class="dataLabelLeft">Extract 1:</td>
	<td class="data" width="5%">
	    <select name="brewExtract1" id="brewExtract1">
	        <option value=""></option>
    	        <?php do {  ?>
    	        <option value="<?php echo $row_extracts['extractName']; ?>" <?php if ($results == "true") { if ($brewExtract1 == $row_extracts['extractName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewExtract1'] == $row_extracts['extractName']) echo "SELECTED"; } ?>><?php echo $row_extracts['extractName']; ?></option>
    		<?php } while ($row_extracts = mysql_fetch_array($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_array($extracts); } ?>
   	    </select>
	</td>
	<td class="dataLabel">Weight:</td>
   	<td class="data" width="5%"><input name="brewExtract1Weight" type="text" id="brewExtract1Weight" size="5" value="<?php if ($results == "true") echo $brewExtract1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewExtract1Weight']; ?>">
	<td class="data" <?php if ($results == "true") echo "width=\"5%\""; ?>><?php echo $row_pref['measWeight2']; ?></td>
	     <?php if (($results == "true") && ($brewExtract1Weight != "")) { $e1Grist = $brewExtract1Weight/$totalGrist * 100;echo "<td class=\"data\">".round ($e1Grist, 1)."%</td>"; } if (($results == "true") && ($brewExtract1Weight == "")) echo "<td>&nbsp;</td>"; ?>
    </tr>
*/ ?>
</table>
	
<!-- Grains -->
<?php if (($id != "default") && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original extract is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=extract">add another to the database</a>.</em></div>
<?php } ?>
<div class="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Grains</div>
<table>
  <tr>
    <td colspan="5" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Grains?" title="Add Grains?"></span>&nbsp;<a href="index.php?action=add&dbTable=malt">Add Grains?</a></td>
  </tr>

** START LOOP **
  <?php
  function create_grain_entries($start, $end) {
    global $grainName, $grainWeight, $row_grains, $row_recipeRecalc,
    $grains, $id, $totalGrist, $results, $row_pref;

    for ($i = $start; $i < $end; $i++) {
      echo '<tr>' . "\n";
      echo '<td class="dataLabelLeft">Grain ' . ($i + 1) . ':</td>' . "\n";
      echo '<td class="data" width="5%"><select name="grainName['.$i.']">' . "\n";
      echo '<option value=""></option>' . "\n";
      do {
	echo '<option value="' .  $row_grains['maltName'] . '" ';
	$key = "brewGrain" . ($i + 1);
	if ((($results == "true") && ($grainName[$i] == $row_grains['maltName'])) ||
	    (($results == "false") && ($id != "default") && ($row_recipeRecalc[$key] == $row_grains['maltName']))) {
	  echo "SELECTED";
	}
	echo '>' . $row_grains['maltName'] . '</option>' . "\n";
      } while ($row_grains = mysql_fetch_array($grains));
      echo '</select></td>' . "\n";

      # Reset $row_grains to first row
      $rows = mysql_num_rows($grains);
      if ($rows > 0) {
	mysql_data_seek($grains, 0);
	$row_grains = mysql_fetch_array($grains);
      }

      echo '<td class="dataLabel">Weight:</td>' . "\n";
      echo '<td class="data" width="5%"><input name="grainWeight['.$i.']" type="text" size="5" value="';
      if ($results == "true") {
	echo $grainWeight[$i];
      } elseif ($id != "default") {
	$key = "brewGrain" . ($i + 1) . "Weight";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";
      echo '<td class="data" ';
      if ($results == "true") {
	echo 'width="5%"';
      }
      echo '>' . $row_pref['measWeight2'] . '</td>' . "\n";
      if ($results == "true") {
	if ($grainWeight[$i] != "") {
	  $pctGrist = $grainWeight[$i] / $totalGrist * 100;
	  echo '<td class="data">' . round($pctGrist, 1) . '%</td>' . "\n";
	} else {
	  echo '<td>&nbsp;</td>';
	}
      }
      echo '</tr>' . "\n";
    }
  }
  create_grain_entries(0, MAX_GRAINS);
/*
	<tr>
   		<td class="dataLabelLeft">Grain 1:</td>
   		<td class="data" width="5%">
   			<select name="brewGrain1" id="brewGrain1">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain1 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain1'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    			<?php } while ($row_grains = mysql_fetch_array($grains)); $rows = mysql_num_rows($grains);	if($rows > 0) {	mysql_data_seek($grains, 0); $row_grains = mysql_fetch_array($grains); } ?>
   			</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data" width="5%"><input name="brewGrain1Weight" type="text" id="brewGrain1Weight" size="5" value="<?php if ($results == "true") echo $brewGrain1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain1Weight']; ?>">
		<td class="data" <?php if ($results == "true") echo "width=\"5%\""; ?>><?php echo $row_pref['measWeight2']; ?></td>
		</td>
		<?php if (($results == "true") && ($brewGrain1Weight != "")) { $g1Grist = $brewGrain1Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g1Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain1Weight == "")) echo "<td>&nbsp;</td>"; ?>
  	</tr>
*/ ?>
</table>
	    
<!-- Adjuncts -->
<?php if (($id != "default") && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original grain is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=malt">add another to the database</a>.</em></div>
<?php } ?>
<div class="headerContentAdmin">Adjuncts</div>
<table>
  <tr>
    <td colspan="5" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Adjuncts?" title="Add Adjuncts?"></span>&nbsp;<a href="index.php?action=add&dbTable=adjuncts">Add Adjuncts?</a></td>
  </tr>

** START LOOP **
  <?php
  function create_adj_entries($start, $end) {
    global $adjName, $adjWeight, $row_adjuncts, $row_pref, $row_recipeRecalc,
    $adjuncts, $id, $results;

    for ($i = $start; $i < $end; $i++) {
      echo '<tr>' . "\n";
      echo '<td class="dataLabelLeft">Adjunct ' . ($i + 1) . ':</td>' . "\n";
      echo '<td class="data" width="5%"><select name="adjName['.$i.']">' . "\n";
      echo '<option value=""></option>' . "\n";
      do {
	echo '<option value="' . $row_adjuncts['adjunctName'] . '" ';
	$key = "brewAddition" . ($i + 1);
	if ((($results == "true") && ($adjName[$i] == $row_adjuncts['adjunctName'])) ||
	    (($results == "false") && ($id != "default") && ($row_recipeRecalc[$key] == $row_adjuncts['adjunctName']))) {
	    echo "SELECTED";
	}
	echo '>' . $row_adjuncts['adjunctName'] . '</option>' . "\n";
      } while ($row_adjuncts = mysql_fetch_array($adjuncts));
      echo '</select></td>' . "\n";

      # Reset $row_adjuncts to first row
      $rows = mysql_num_rows($adjuncts);
      if ($rows > 0) {
	mysql_data_seek($adjuncts, 0);
	$row_adjuncts = mysql_fetch_array($adjuncts);
      }

      echo '<td class="dataLabel">Weight:</td>' . "\n";
      $key = "brewAddition" . ($i + 1) . "Amt";
      echo '<td class="data" width="5%"><input name="adjWeight['.$i.']" type="text" size="5" value="';
      if ($results == "true") {
	echo $adjWeight[$i];
      } elseif ($id != "default") {
	echo $row_recipeRecalc[$key];
      }
      echo '">' . "\n";
      echo '<td class="data">' . $row_pref['measWeight2'] . '</td>' . "\n";
    }
  }

  create_adj_entries(0, MAX_ADJ);

  /*
  <tr>
   		<td class="dataLabelLeft">Adjunct 1:</td>
		<td class="data" width="5%">
   			<select name="brewAdjunct1" id="brewAdjunct1">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct1 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition1'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_array($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_array($adjuncts); } ?>
   			</select>
            </td>
		<td class="dataLabel">Weight:</td>
   		<td class="data" width="5%"><input name="brewAdjunct1Weight" type="text" id="brewAdjunct1Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition1Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
   	</tr>

      */ ?>
</table>

<?php if (($id != "default") && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original adjunct is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=adjuncts">add another to the database</a>.</em></div>
<?php } ?>

<!-- Hops Section -->
<div class="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=hops&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Hops</div>
<table>
    <tr>
        <td colspan="11" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Hops?" title="Add Hops?"></span>&nbsp;<a href="index.php?action=add&dbTable=hops">Add Hops?</a></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" class="dataLabelWide data">Weight</td>
        <td colspan="2" class="dataLabelWide data">AA%</td>
        <td colspan="2" class="dataLabelWide data">Time</td>
        <td colspan="3" class="dataLabelWide data">Form</td>
	<?php if ($results == "true") { ?><td class="dataLabelWide data">AAUs</td><?php } ?>
    </tr>

   <?php
   // Functions should be moved to the top of the file.
   function create_hop_entries($start, $end) {
    global $hopsName, $hopsWeight, $hopsAA, $hopsTime, $hopsForm, $hopsAAU, $hops, $row_hops,
      $row_recipeRecalc, $id, $results, $row_pref;

    for ($i = $start; $i < $end; $i++) {
      echo '<tr>' . "\n";
      echo '<td nowrap class="dataLabelLeft">Hop ' . ($i + 1) . ':</td>' . "\n";

      echo '<td class="data" width="5%"><select name="hopsName['.$i.']">' . "\n";
      echo '<option value=""></option>' . "\n";
      do {
        echo '<option value="' . $row_hops['hopsName'] . '" ';
	$key = "brewHops" . ($i + 1);
	if ((($results == "true") && ($hopsName[$i] == $row_hops['hopsName'])) || 
	    (($results == "false") && ($id != "default") && ($row_recipeRecalc[$key] == $row_hops['hopsName']))) {
	  echo 'SELECTED';
	}
	echo '>' . $row_hops['hopsName'] . '</option>' . "\n";
      } while ($row_hops = mysql_fetch_array($hops));
      echo '</select></td>' . "\n";

      // Reset $row_hops to first row
      $rows = mysql_num_rows($hops);
      if ($rows > 0) { 
	mysql_data_seek($hops, 0);
	$row_hops = mysql_fetch_array($hops);
      }

      echo '<td class="data" width="5%"><input name="hopsWeight['.$i.']" type="text" size="3" value="';
      if ($results == "true") {
	echo $hopsWeight[$i];
      } elseif ($id != "default") {
	$key = "brewHops" . ($i + 1) . "Weight";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";

      echo '<td class="data" width="5%" nowrap>';
      if ($row_pref['measWeight1'] == "ounces") {
	echo 'oz.';
      } else {
	echo 'g.';
      }
      echo '</td>' . "\n";

      echo '<td class="data" width="5%"><input name="hopsAA['.$i.']" type="text" size="3" value="';
      if ($results == "true") {
	echo $hopsAA[$i];
      } elseif ($id != "default") {
	$key = "brewHops" . ($i + 1) . "IBU";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";

      echo '<td class="data" width="5%">%</td>' . "\n";

      echo '<td class="data" width="5%"><input name="hopsTime['.$i.']" type="text" size="3" value="';
      if ($results == "true") {
	echo $hopsTime[$i];
      } elseif ($id != "default") {
	$key = "brewHops" . ($i + 1) . "Time";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";

      echo '<td class="data" width="5%">min.</td>' . "\n";

      echo '<td class="data" width="5%"><input type="radio" name="hopsForm['.$i.']" value="Pellets" ';
      if ($results == "true") {
	if (($hopsName[$i] != "") && ($hopsForm[$i] == "Pellets")) {
	  echo 'CHECKED';
	}
      } else {
	$key = "brewHops" . ($i + 1) . "Form";
	if ((($id != "default") && ($row_recipeRecalc[$key] == "Pellets")) ||
	    ($source == "calculator")) {
	  echo 'CHECKED';
	}
      }
      echo '/><span class="data">Pellets</span></td>' . "\n";

      echo '<td class="data" width="5%"><input type="radio" name="hopsForm['.$i.']" value="Leaf" ';
      if ($results == "true") {
	if (($hopsName[$i] != "") && ($hopsForm[$i] == "Leaf")) {
	  echo 'CHECKED';
	}
      } else {
	$key = "brewHops" . ($i + 1) . "Form";
	if (($id != "default") && ($row_recipeRecalc[$key] == "Leaf")) {
	  echo 'CHECKED';
	}
      }
      echo '/><span class="data">Leaf</span></td>' . "\n";

      echo '<td class="data"';
      if ($results == "true") {
	echo ' width="5%"';
      }
      echo '><input type="radio" name="hopsForm['.$i.']" value="Plug" ';
      if ($results == "true") {
	if (($hopsName[$i] != "") && ($hopsForm[$i] == "Plug")) {
	  echo 'CHECKED';
	}
      } else {
	$key = "brewHops" . ($i + 1) . "Form";
	if (($id != "default") && ($row_recipeRecalc[$key] == "Plug")) {
	  echo "CHECKED";
	}
      }
      echo '/><span class="data">Plug</span></td>' . "\n";

      if (($results == "true") && ($hopsAAU[$i] != 0)) {
	echo '<td class="data">' . round($hopsAAU[$i], 1) . '</td>' . "\n";
      }

      echo '</tr>' . "\n";
    }
  }

  create_hop_entries(0, MAX_HOPS);
  ?>
</table>

<?php if (($id != "default") && ($results == "false")) { ?>
  <div class="red"><em>**If any dropdown menu is blank, the recipe\'s original hop is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=hops">add another to the database</a>.</em></div>
<?php } ?>

<table class="dataTable">
  <tr>
    <td><div class="right"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_calculate_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Calculate" class="radiobutton" value="Calculate"></div></td>
  </tr>
</table>

</form>
<?php 
  } //end if ($results != "verify")
  else {
    include ('lib/verify.lib.php');
  }
} // ends if ($action == "calculate")
else { ?>
  // Doesn't $action always == "calculate" in this file? Is this block ever executed?
  <div id="breadcrumbWide"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
  <div id="subtitleWide"><?php echo $page_title; ?></div>
  <div class="headerContentAdmin">Recalculated <php if ($source == "brewing") echo "BrewBlog "; ?>Recipe</div>
  <table class="dataTable">
  <tr>
      <td class="error">Sorry, you do not have sufficient privileges to perform this action.<br><br><br></td>
  </tr>
  </table>
<?php } ?>