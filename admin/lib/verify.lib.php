<?php 
/**
 * Module: verify.lib.php
 * Description: Part of the Recipe Calculator. The user has selected the calculated/recalculated
 *              values from the "predicted.lib.php" module for updating or importing. This
 *              module will present a page allowing the user to verify the new values compared
 *              to the old values.
 */

include_once 'lib/color.lib.php';

// Load form vars
$brewBrewerID = $_POST['loginUsername'];
$brewName     = $_POST['brewName'];
$brewYield    = $_POST['brewYield'];
$brewStyle    = $_POST['brewStyle'];
$srmMorey     = $_POST['srmMorey'];
$srmDaniels   = $_POST['srmDaniels'];
$srmMoser     = $_POST['srmMoser'];
$ibuR         = $_POST['ibuR'];
$ibuG         = $_POST['ibuG'];
$ibuT         = $_POST['ibuT'];
$ibuD         = $_POST['ibuD'];
$ibuAvg       = $_POST['ibuAvg'];
$brewOG       = $_POST['brewOG'];
$brewFG       = $_POST['brewFG'];

for ($i = 0; $i < MAX_EXT; $i++) {
  $extName[$i]   = $_POST['extName'][$i];
  $extWeight[$i] = $_POST['extWeight'][$i];
}

for ($i = 0; $i < MAX_GRAINS; $i++) {
  $grainName[$i]   = $_POST['grainName'][$i];
  $grainWeight[$i] = $_POST['grainWeight'][$i];
}

for ($i = 0; $i < MAX_ADJ; $i++) {
  $adjName[$i]   = $_POST['adjName'][$i];
  $adjWeight[$i] = $_POST['adjWeight'][$i];
}

for ($i = 0; $i < MAX_HOPS; $i++) {
  $hopsName[$i]   = $_POST['hopsName'][$i];
  $hopsWeight[$i] = $_POST['hopsWeight'][$i];
  $hopsAA[$i]     = $_POST['hopsAA'][$i];
  $hopsTime[$i]   = $_POST['hopsTime'][$i];
  $hopsForm[$i]   = $_POST['hopsForm'][$i];
}

// $assoc will either be "import" or "update"
if ($assoc == "import") $importDB = $_POST['importDB'];
?>

<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<table class="dataTable">
  <tr>
    <td><div id="subtitleAdmin"><?php echo $page_title; ?></div></td>
  </tr>
</table>
<div class="headerContentAdmin"><?php if ($assoc != "import") echo "Recalculated"; else echo "Calculated"; if ($source == "brewing") echo "BrewBlog "; echo "Recipe"; if ($assoc == "import") echo "To Import"; ?></div>
<form id="form4" action="<?php if ($assoc == "update") echo "process"; else echo "index"; ?>.php?action=<?php if ($assoc == "update") echo "update"; else echo "importCalc"; ?>&dbTable=<?php if ($assoc == "update") echo $source; else echo $importDB; if ($assoc == "import") echo "&filter=".$loginUsername; else echo "&id=".$id; ?>" method="post" name="form4">
<table class="dataTable">
  <?php if ($row_recipeRecalc['id'] != "") { ?>
    <tr>
      <td width="10%">&nbsp;</td>
      <td width="40%" class="text_12_bold data"><?php if ($assoc == "import") echo "Original"; else echo "Present Recipe"; ?></td>
      <td width="40%" class="text_12_bold data"><?php if ($assoc == "import") echo "To Import"; else echo "Recalculated Recipe"; ?></td>
    </tr>
  <?php } ?>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Recipe Name:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo $row_recipeRecalc['brewName']; ?></td><?php } ?>
    <td class="data"><?php echo $brewName; ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Style:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo $row_recipeRecalc['brewStyle']; ?></td><?php } ?>
    <td class="data"><?php echo $brewStyle; ?></td>
  </tr>

  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Bitterness (IBU):</td>
    <?php if ($row_recipeRecalc['id'] != "") { ?>
      <td class="data">
      <table>
        <tr>
          <td><?php echo round($row_recipeRecalc['brewBitterness'], 1); ?></td>
          <td>&nbsp;<?php echo $row_recipeRecalc['brewIBUFormula']; ?></td>
        </tr>
      </table>
      </td>
    <?php } ?>
    <td class="data">
    <table>
      <tr>
        <td><input type="radio" name="brewBitterness" value="<?php echo round($ibuD, 1); echo "-Daniels"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Daniels") echo "checked"; ?> /></td>
   	<td>&nbsp;<?php echo round($ibuD, 1); ?></td>
    	<td>&nbsp;Daniels</td>
        <td><input type="radio" name="brewBitterness" value="<?php echo round($ibuG, 1); echo "-Garetz"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Garetz") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round($ibuG, 1); ?></td>
    	<td>&nbsp;Garetz&nbsp;</td>
      </tr>
      <tr>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round($ibuR, 1); echo "-Rager"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Rager") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round($ibuR, 1); ?></td>
    	<td>&nbsp;Rager</td>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round($ibuT, 1); echo "-Tinseth"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Tinseth") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round($ibuT, 1); ?></td>
    	<td>&nbsp;Tinseth&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>

  <tr>
    <td class="dataLabelLeft" nowrap>Color (<?php echo $row_pref['measColor']; ?>):</td>

    <td class="data">
    <?php
    if ($row_recipeRecalc['id'] != "") {    
      echo '<table>' . "\n";
      echo '<tr>' . "\n";
      $brewLov   = $row_recipeRecalc['brewLovibond'];
      if ($row_pref['measColor'] == "EBC")
	$brewLov = ebc_to_srm($brewLov);
      $fontColor = ($brewLov >= 15) ? "#ffffff" : "#000000";
      $bkColor   = get_display_color($brewLov);
      echo '<td class="colorTable" style="text-align: center; background: ' . $bkColor . '; color: ' . $fontColor . ';">&nbsp;&nbsp;';
      echo round($row_recipeRecalc['brewLovibond'], 1);
      echo '&nbsp;&nbsp;</td>' . "\n";
      echo '<td style="vertical-align: middle;">';
      if ($row_recipeRecalc['brewColorFormula'] == "") {
	echo "&nbsp;formula unknown";
      } else {
	echo '&nbsp;' . $row_recipeRecalc['brewColorFormula'];
      }
      echo '</td>' . "\n";
      echo '</tr>' . "\n";
      echo '</table>' . "\n";
    } ?>
    </td>

    <td class="data">
    <table>
      <tr>
        <?php
        echo '<td><input type="radio" name="brewLovibond" value="';
        if ($row_pref['measColor'] == "SRM") {
	  echo $srmMorey;
	} else {
	  echo srm_to_ebc($srmMorey);
	}
        echo '-Morey" ';
        if ($row_user['defaultColorFormula'] == "Morey")
	  echo "checked";
        echo '/>&nbsp;</td>' . "\n";
	$fontColor = ($srmMorey >= 15) ? "#ffffff" : "#000000";
        $bkColor   = get_display_color($srmMorey);
        echo '<td class="colorTable" style="text-align: center; background: ' . $bkColor . '; color: ' . $fontColor . ';">&nbsp;&nbsp;';
        if ($row_pref['measColor'] == "SRM") {
	  echo round($srmMorey, 1);
	} else {
	  echo round(srm_to_ebc($srmMorey), 1);
	}
        echo '&nbsp;&nbsp;</td>' . "\n";
        ?>
        <td style="vertical-align: middle;">&nbsp;Morey&nbsp;</td>
      </tr>
      <tr>
	<?php
        echo '<td><input type="radio" name="brewLovibond" value="';
        if ($row_pref['measColor'] == "SRM") {
	  echo $srmDaniels;
	} else {
	  echo srm_to_ebc($srmDaniels);
	}
        echo '-Daniels" ';
        if ($row_user['defaultColorFormula'] == "Daniels")
	  echo "checked";
        echo '/>&nbsp;</td>' . "\n";
	$fontColor = ($srmDaniels >= 15) ? "#ffffff" : "#000000";
        $bkColor   = get_display_color($srmDaniels);
        echo '<td class="colorTable" style="text-align: center; background: ' . $bkColor . '; color: ' . $fontColor . ';">&nbsp;&nbsp;';
        if ($row_pref['measColor'] == "SRM") {
	  echo round($srmDaniels, 1);
	} else {
	  echo round(srm_to_ebc($srmDaniels), 1);
	}
        echo '&nbsp;&nbsp;</td>' . "\n";
	?>
        <td style="vertical-align: middle;">&nbsp;Daniels&nbsp;</td>
      </tr>
      <tr>
	<?php
        echo '<td><input type="radio" name="brewLovibond" value="';
        if ($row_pref['measColor'] == "SRM") {
	  echo $srmMoser;
	} else {
	  echo srm_to_ebc($srmMoser);
	}
        echo '-Moser" ';
        if ($row_user['defaultColorFormula'] == "Moser")
	  echo "checked";
        echo '/>&nbsp;</td>' . "\n";
	$fontColor = ($srmMoser >= 15) ? "#ffffff" : "#000000";
        $bkColor   = get_display_color($srmMoser);
        echo '<td class="colorTable" style="text-align: center; background: ' . $bkColor . '; color: ' . $fontColor . ';">&nbsp;&nbsp;';
        if ($row_pref['measColor'] == "SRM") {
	  echo round($srmMoser, 1);
	} else {
	  echo round(srm_to_ebc($srmMoser), 1);
	}
        echo '&nbsp;&nbsp;</td>' . "\n";
	?>
        <td style="vertical-align: middle;">&nbsp;Moser&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>

  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Yield:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import") { ?><input type="radio" name="brewYield" value ="<?php echo $row_recipeRecalc['brewYield']; ?>">&nbsp;<?php } ?><?php echo $row_recipeRecalc['brewYield']; ?></td><?php } ?>
    <td class="data"><?php if ($assoc != "import") { ?><input type="radio" name="brewYield" value ="<?php echo $brewYield; ?>" checked="checked">&nbsp;<?php } ?><?php echo $brewYield; ?></td>
  </tr> 
  <tr>
    <td class="dataLabelLeft" nowrap>OG:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewOG" value ="<?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetOG'], 3); elseif ($row_recipeRecalc['brewOG'] > 0) echo number_format($row_recipeRecalc['brewOG'], 3); else echo ""; ?>" checked="checked">&nbsp;<?php } ?><?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetOG'], 3); elseif ($row_recipeRecalc['brewOG'] > 0) echo number_format($row_recipeRecalc['brewOG'], 3); else echo "None entered" ?></td><?php } ?>
    <td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewOG" value ="<?php if ($brewOG > 0) echo number_format ($brewOG, 3); ?>">&nbsp;<?php } ?><?php if ($brewOG > 0) echo number_format ($brewOG, 3); ?></td>
  </tr>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>FG:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewFG" value ="<?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetFG'], 3); elseif ($row_recipeRecalc['brewFG'] > 0) echo number_format($row_recipeRecalc['brewFG'], 3); else echo ""; ?>" checked="checked">&nbsp;<?php } ?><?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetFG'], 3); elseif ($row_recipeRecalc['brewFG'] > 0) echo number_format($row_recipeRecalc['brewFG'], 3); else echo "None entered" ?></td><?php } ?>
    <td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewFG" value ="<?php echo number_format ($brewFG, 3); ?>">&nbsp;<?php } ?><?php echo number_format ($brewFG, 3); ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Extracts:</td>
    <?php 
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      for ($i = 0; $i < MAX_EXT; $i++) {
	$keyName = "brewExtract" . ($i + 1);
	if ($row_recipeRecalc[$keyName] != "") { 
	  $keyWeight = "brewExtract" . ($i + 1) . "Weight";
	  echo $row_recipeRecalc[$keyWeight] . ' ' . $row_pref['measWeight2'] . ' ' . $row_recipeRecalc[$keyName] . '<br />';
	}
      }
      echo '</td>' . "\n";
    }
    echo '<td class="data">';
    for ($i = 0; $i < MAX_EXT; $i++) {
      if ($extName[$i] != "") {
	echo $extWeight[$i] . ' ' . $row_pref['measWeight2'] . ' ' . $extName[$i] . '<br />';
      } 
    }
    ?>
    </td>
  </tr>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Grains:</td>
    <?php
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      for ($i = 0; $i < MAX_GRAINS; $i++) {
	$keyName = "brewGrain" . ($i + 1);
	if ($row_recipeRecalc[$keyName] != "") {
	  $keyWeight = "brewGrain" . ($i + 1) . "Weight";
	  echo $row_recipeRecalc[$keyWeight] . ' ' . $row_pref['measWeight2'] . ' ' . $row_recipeRecalc[$keyName] . '<br />' . "\n";;
	}
      }
      echo '</td>' . "\n";
    }
    echo '<td class="data">' . "\n";
    for ($i = 0; $i < MAX_GRAINS; $i++) {
      if ($grainName[$i] != "") {
	echo $grainWeight[$i] . ' ' . $row_pref['measWeight2'] . ' ' . $grainName[$i] . '<br />' . "\n";
      }
    }
     ?>
    </td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Adjuncts:</td>
    <?php
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      for ($i = 0; $i < MAX_ADJ; $i++) {
	$keyName = "brewAddition" . ($i + 1);
	if ($row_recipeRecalc[$keyName] != "") {
	  $keyAmt = "brewAddition" . ($i + 1) . "Amt";
	  echo $row_recipeRecalc[$keyAmt] . ' ' . $row_pref['measWeight2'] . ' ' . $row_recipeRecalc[$keyName] . '<br />' . "\n";
	}
      }
      echo '</td>' . "\n";
    }
    echo '<td class="data">';
    for ($i = 0; $i < MAX_ADJ; $i++) {
      if ($adjName[$i] != "") {
	echo $adjWeight[$i] . ' ' . $row_pref['measWeight2'] . ' ' . $adjName[$i] . '<br />' . "\n";
      }
    }
    ?>
    </td>
  </tr>
  <tr class="bknd_ultra_lt">
    <?php
    echo '<td class="dataLabelLeft" nowrap>Hops:</td>' . "\n";
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      for ($i = 1; $i <= MAX_HOPS; $i++) {
	$keyName = "brewHops" . $i;
	if ($row_recipeRecalc[$keyName]) {
	  $key = "brewHops" . $i . "Weight";
	  echo $row_recipeRecalc[$key] . " " . $row_pref['measWeight1'] . " " . $row_recipeRecalc[$keyName] . " ";
	  $key = "brewHops" . $i . "IBU";
	  echo $row_recipeRecalc[$key] . "% @ ";
	  $key = "brewHops" . $i . "Time";
	  echo $row_recipeRecalc[$key] . " min.<br />";
	}
      }
      echo '</td>' . "\n";
    }

    echo '<td class="data">';
    echo '<table>';
    for ($i = 0; $i < MAX_HOPS; $i++) {
      if ($hopsName[$i]) {
	echo $hopsWeight[$i] . " " . $row_pref['measWeight1'] . " ";
	echo $hopsName[$i] . " ";
	echo $hopsAA[$i] . "% ";
	echo $hopsForm[$i] . " @ ";
	echo $hopsTime[$i] . " min.<br />";
      }
    }
    echo '</table>' . "\n";
    echo '</td>' . "\n";
    ?>
  </tr>
</table>

<div id="hide">
<input type="hidden" name="brewBoilTime" value="<?php echo $row_recipeRecalc['brewBoilTime']; ?>"  />

<?php
if ($assoc == "import") { 
  if ($importDB == "brewing") {
    echo '<input type="hidden" name="brewTargetOG" value="' . round($brewOG, 3) . '">' . "\n";
    echo '<input type="hidden" name="brewTargetFG" value="' . round($brewFG, 3) . '">' . "\n";
  } else {
    // $importDB must be "recipes"
    echo '<input type="hidden" name="brewOG" value="' . round($brewOG, 3) . '">' . "\n";
    echo '<input type="hidden" name="brewFG" value="' . round($brewFG, 3) . '">' . "\n";
  }
}
include ('importFormVar.lib.php');
?>

<input type="hidden" name="brewBrewerID" value="<?php if ($assoc == "import") echo $filter; elseif ($row_recipeRecalc['brewBrewerID'] != "") echo $row_recipeRecalc['brewBrewerID']; else echo $_SESSION['loginUsername']; ?>">
</div>
<br /><br />

<div class="right"><a href="#" onClick="history.go(-1)"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_back_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Back to Calculator" class="radiobutton" /></a>&nbsp;<input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_<?php if ($assoc == "import") echo "import"; else echo "update"; ?>_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update with New Calculations" class="radiobutton" value="Edit"></div>

</form>
