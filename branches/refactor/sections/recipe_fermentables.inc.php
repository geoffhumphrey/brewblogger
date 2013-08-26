<?php 
/**
 * Module: recipe_fermentables.inc.php
 * Description: This module populates the extract, grain and adjunct sections of recipe viewing page.
 */

if ($row_log['brewYield'] != "" && $page != "logPrint" && $page != "recipePrint" && 
    (($row_log['brewExtract1'] != "" || $row_log['brewGrain1'] != "") && $row_log['brewHops1'] != ""))  { ?>
  <div class="headerContent"><a name="recipe" id="recipe"></a>Scale Recipe</div>
  <div class="data-container">
  <table>
  <tr>
    <td class="dataLeft" width="5%" nowrap>Enter desired final yield (volume): </td>
    <form action="<?php echo "index.php?page=".$page."&filter=".$row_log['brewBrewerID']."&action=scale"; if ($action == "scale") echo "&amt=".$_POST['amt']; echo "&id=".$row_log['id']."#recipe"; ?>" method="post" name="form1" id="form1">
    <td class="data" width="5%" nowrap><input class="quickEdit" name="amt" type="text" size="5" value="<?php if ($action == "scale") echo $amt; if ($action == "reset") echo $row_log['brewYield']; ?>" /></td>
    <td class="data" width="5%" nowrap><?php echo "&nbsp;".$row_pref['measFluid2']; ?></td>
    <td class="data">&nbsp;<input class="quickEdit" name="submit" type="submit" value="Scale"/>
    <input class="quickEdit" name="reset" type="button" value="Reset" onClick="window.location='<?php echo "index.php?page=".$page."&filter=".$filter."&id=".$id."&action=reset"; ?>'">
    </td></form>
  </tr>
  </table>
  </div>
<?php } ?>

<?php // ------------------------ EXTRACT SECTION ------------------------ 
if ($row_log['brewExtract1'] != "" ) { // hide entire set of extract rows if first not present (1)  ?>
  <div class="headerContent"><a name="recipe" id="recipe"></a>Extract</div>
  <div class="data-container">
  <table class="dataTable">

  <?php
  for ($i = 0; $i < MAX_EXT; $i++) {
    $keyName   = 'brewExtract' . ($i + 1);
    $keyWeight = 'brewExtract' . ($i + 1) . 'Weight';
    if ($row_log[$keyName] != "") {
      echo '<tr>' . "\n";
      echo '<td class="dataLeft">';
      if ($action == "default" || $action == "reset" || $action == "print") {
	echo number_format($row_log[$keyWeight], 2);
      }
      if ($action == "scale") {
	echo number_format(($row_log[$keyWeight] * $scale), 2);
      }
      echo "&nbsp;" . $row_pref['measWeight2'] . '</td>' . "\n";
      echo '<td class="data">' . $row_log[$keyName] . '</td>' . "\n";
      echo '<td class="data">';
      if ($row_log[$keyWeight] != "") {
	echo round ($extractPer[$i], 1) . "% of grist";
      } else {
	echo "&nbsp;";
      }
      echo '</td>' . "\n";
      echo '</tr>' . "\n";
    }
  }
  ?>
  <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
    <td class="dataLeft bdr1T_light_dashed"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalExtract, 2); if ($action == "scale") echo number_format (($totalExtract * $scale), 2); echo"&nbsp;".$row_pref['measWeight2']; ?></td>
    <td class="data bdr1T_light_dashed">Total Extract Weight</td>
    <td class="data bdr1T_light_dashed"><?php echo round ($totalExtractPer, 1); ?>% of grist</td>
  </tr>
  </table>
  </div>
<?php } // end hide extracts (1) ?>

<?php // ------------------------ GRAINS SECTION ------------------------ 
if ($row_log['brewGrain1'] != "" ) { // hide entire set of grain rows if first not present
  if (($page == "recipePrint") || ($page == "logPrint")) {
    echo "";
  } else { ?>
    <div id="help"><a href="sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div>
  <?php } ?>
  <div class="headerContent"><a name="recipe" id="recipe"></a>Malts and Grains</div>
  <div class="data-container">
  <table class="dataTable">

  <?php
  for ($i = 0; $i < MAX_GRAINS; $i++) {
    $keyName   = 'brewGrain' . ($i + 1);
    $keyWeight = 'brewGrain' . ($i + 1) . 'Weight';
    if ($row_log[$keyName] != "") {
      echo '<tr>' . "\n";
      echo '<td class="dataLeft">';
      if (($action == "default") || ($action == "reset") || ($action == "print")) {
	echo number_format($row_log[$keyWeight], 2);
      }
      if ($action == "scale") {
	echo number_format(($row_log[$keyWeight] * $scale), 2);
      }
      echo "&nbsp;".$row_pref['measWeight2']; 
      echo '</td>' . "\n";
      echo '<td class="data">';
      if ($page ==  "recipePrint" || $page == "logPrint" || checkmobile()) {
	echo $row_log[$keyName];
      } else {
	$query        = "SELECT * FROM malt WHERE maltName='" . $row_log[$keyName] . "'";
	$query_result = mysql_query($query, $brewing) or die(mysql_error());
	$row_malt     = mysql_fetch_array($query_result);
	echo '<div id="moreInfo">';
	echo '<a href="#">';
	echo $row_log[$keyName];
	echo '<span>';
	echo '<div id="moreInfoWrapper">';
	echo '<div id="referenceHeader">';
	if ($row_malt['maltName'] != "") {
	  echo $row_malt['maltName'];
	} else {
	  echo "No Information Available";
	}
	echo '</div>' . "\n";
	if ($row_malt['maltName'] != "") {
	  echo '<table class="dataTable">' . "\n";
	  echo '<tr>' . "\n";
	  echo '<td class="dataLabelLeft">Color (L):</td>' . "\n";
	  echo '<td class="data">';
	  if ($row_malt['maltLovibondLow'] != "") {
	    echo $row_malt['maltLovibondLow'] . '&deg; - ';
	    if ($row_malt['maltLovibondHigh'] > 0) {
	      echo $row_malt['maltLovibondHigh'];
	      echo '&deg;L (avg = ' . (($row_malt['maltLovibondLow'] + $row_malt['maltLovibondHigh']) / 2) . ')';
	    } else {
	      echo $row_malt['maltLovibondLow'] . '&deg;L';
	    }
	  } else {
	    echo 'Not provided';
	  }
	  echo '</td>' . "\n";
	  echo '</tr>' . "\n";
	  echo '<tr align="left" valign="top">' . "\n";
	  echo '<td class="dataLabelLeft">Info/Use:</td>' . "\n";
	  echo '<td class="data">';
	  if ($row_malt['maltInfo'] != "") {
	    echo $row_malt['maltInfo'];
	  } else {
	    echo 'Not provided';
	  }
	  echo '</td>' . "\n";
	  echo '</tr>' . "\n";
	  echo '</table>' . "\n";
	}
	echo '</div></span></a></div>' . "\n";
      }
      echo '</td>' . "\n";
      echo '<td class="data">';
      if ($row_log[$keyWeight] != "") {
	echo round($grainPer[$i], 1) . '% of grist';
      } else {
	echo '&nbsp;';
      }
      echo '</td>' . "\n";
      echo '</tr>' . "\n";
    }
  }
  ?>
  <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
    <td class="dataLeft bdr1T_light_dashed"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalGrain, 2); if ($action == "scale") echo number_format (($totalGrain * $scale), 2);  echo "&nbsp;".$row_pref['measWeight2']; ?></td>
    <td class="data bdr1T_light_dashed"><?php if  ((($page ==  "recipePrint") || ($page == "logPrint")) || ($row_log['brewMethod'] != "All Grain") || (checkmobile())) echo "Total Grain Weight"; else include (SECTIONS.'water_amounts_calc.inc.php'); ?></td>
    <td class="data bdr1T_light_dashed"><?php echo round ($totalGrainPer, 1); ?>% of grist</td>
  </tr>
  </table>
  </div>
<?php } ?>


<?php // ------------------------ ADJUNCT SECTION ------------------------ 
if ($row_log['brewAddition1'] != "") { // hide entire set of Adjunct table rows (3) ?>
  <div class="headerContent"><a name="recipe" id="recipe"></a><?php if ($row_styles['brewStyleGroup'] > 23) echo "Ingredients"; else echo "Adjuncts"; ?></div>
  <div class="data-container">
  <table>

  <?php
  for ($i = 0; $i < MAX_ADJ; $i++) {
    $keyName   = 'brewAddition' . ($i + 1);
    $keyWeight = 'brewAddition' . ($i + 1) . 'Amt';
    if ($row_log[$keyName] != "") {
      echo '<tr>' . "\n";
      echo '<td class="dataLeft">';
      if ($action == "default" || $action == "reset" || $action == "print") {
	echo number_format($row_log[$keyWeight], 2);
      }
      if ($action == "scale") {
	echo number_format(($row_log[$keyWeight] * $scale), 2);
      }
      echo "&nbsp;" . $row_pref['measWeight2'] . '</td>' . "\n";
      echo '<td class="data">' . $row_log[$keyName] . '</td>' . "\n";
      echo '<td>&nbsp;</td>' . "\n";
      echo '</tr>' . "\n";
    }
  }
  echo '</table></div>' . "\n";
} // end hide Adjuncts (3) ?>
