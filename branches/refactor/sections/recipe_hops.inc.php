<?php 
/**
 * Module: recipe_hops.inc.php
 * Description: This module populates the hop section of viewing a recipe.
 */

if ($row_log['brewHops1'] != "" ) { // hide entire set of hops rows if first is not present
  if ($page == "recipePrint" || $page == "logPrint") {
    echo "";
  } else { ?>
    <div id="help"><a href="sections/reference.inc.php?section=hops&amp;source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div>
  <?php } ?>
  <div class="headerContent"><a name="recipe" id="recipe"></a>Hops</div>
  <div class="data-container">
  <table class="dataTable">

  <?php
  for ($i = 0; $i < MAX_HOPS; $i++) {
    $keyName   = 'brewHops' . ($i + 1);
    $keyWeight = 'brewHops' . ($i + 1) . 'Weight';
    if ($row_log[$keyName] != "") {
      echo '<tr>' . "\n";
      echo '<td class="dataLeft">';
      if ($row_log[$keyWeight] != "" ) {
	if ($action == "default" || $action == "reset" || $action == "print") {
	  echo number_format($row_log[$keyWeight], 2);
	}
	if ($action == "scale") {
	  echo number_format(($row_log[$keyWeight] * $scale), 2);
	}
      }
      echo " " . $row_pref['measWeight1'] . '</td>' . "\n";
      
      echo '<td class="data">' . "\n";
      if ($page == "recipePrint" || $page == "logPrint" || checkmobile()) {
	echo $row_log[$keyName];
      } else {
	$query        = "SELECT * FROM hops WHERE hopsName='" . $row_log[$keyName] . "'";
	$query_result = mysql_query($query, $brewing) or die (mysql_error());
	$row_hops     = mysql_fetch_array($query_result);
	
	echo '<div id="moreInfo">';
	echo '<a href="#">';
	echo $row_log[$keyName] . "<br>";
	echo '<span>' . "\n";
	echo '<div id="moreInfoWrapper">' . "\n";
	echo '<div id="referenceHeader">';
	if ($row_hops['hopsName'] != "") {
	  echo $row_hops['hopsName'];
	} else {
	  echo "No Information Available";
	}
	echo '</div>' . "\n";
	if ($row_hops['hopsName'] != "") {
	  echo '<table class="dataTable">' . "\n";
	  if ($row_hops['hopsGrown'] != "" ) {
	    echo '<tr>' . "\n";
	    echo '<td class="dataLabelLeft">Region:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsGrown'] . '</td>' . "\n";
	    echo '</tr>' . "\n";
	  }
	  if ($row_hops['hopsAAULow'] != "") {
	    echo '<tr>' . "\n";
	    echo '<td class="dataLabelLeft">AAU Range:</td>' . "\n";
	    echo '<td class="data">';
	    $AAUmin = ltrim($row_hops['hopsAAULow'], "0");
	    $AAUmax = ltrim($row_hops['hopsAAUHigh'], "0");
	    echo $AAUmin." - ".$AAUmax."%";
	    echo '</td>' . "\n";
	    echo '</tr>' . "\n";
	  }
	  if ($row_hops['hopsInfo'] != "" ) {
	    echo '<tr>' . "\n";
	    echo '<td class="dataLabelLeft">Notes:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsInfo'] . '</td>' . "\n";
	    echo '</tr>' . "\n";
	  }
	  if ($row_hops['hopsUse'] != "" ) {
	    echo '<tr>' . "\n";
	    echo '<td class="dataLabelLeft">Typical Use:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsUse'] . '</td>' . "\n";
	    echo '</tr>' . "\n";
	  }
	  if ($row_hops['hopsSub'] != "" ) {
	    echo '<tr>' . "\n";
	    echo '<td class="dataLabelLeft">Substitution:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsSub'] . '</td>' . "\n";
	    echo '</tr>' . "\n";
	  }
	  if ($row_hops['hopsExample'] != "" ) {
	    echo '<tr>' . "\n";
	    echo '<td class="dataLabelLeft">Example:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsExample'] . '</td>' . "\n";
	    echo '</tr>' . "\n";
	  }
	  echo '</table></div></span>' . "\n";
	  echo '</a>' . "\n";
	  echo '</div>' . "\n";
	}
      }

      $keyAA   = 'brewHops' . ($i + 1) . 'IBU';
      $keyForm = 'brewHops' . ($i + 1) . 'Form';
      $keyTime = 'brewHops' . ($i + 1) . 'Time';
      $keyType = 'brewHops' . ($i + 1) . 'Type';
      $keyUse  = 'brewHops' . ($i + 1) . 'Use';
      if ($row_log[$keyAA] != "")
	echo $row_log[$keyAA] . "% ";
      if ($row_log[$keyForm] != "")
	echo $row_log[$keyForm] . " "; 
      if ($row_log[$keyTime] != "")
	echo "@ " . $row_log[$keyTime] . " minutes "; 
      if ($row_log[$keyType] != "" && $row_log[$keyType] == "Both")
	echo "<br>Type: Bittering and Aroma";
      elseif ($row_log[$keyType] != "")
	echo "<br>Type: " . $row_log[$keyType];
      else
	echo "";
      if ($row_log[$keyUse] != "")
	echo "<br>Use: " . $row_log[$keyUse] . " ";  
      echo '</td>' . "\n";
      echo '<td class="data">';
      if ($row_log[$keyAA] != "") {
	if ($action == "default" || $action == "reset" || $action == "print") 
	  echo round ($hop1Per, 1);
	if ($action == "scale")
	  echo round (($hop1Per * $scale), 1);
	echo "&nbsp;AAUs";
      } else {
	echo "&nbsp;";
      }
      echo '</td>' . "\n";
      echo '</tr>' . "\n";
    }
  }

  echo '<tr bgcolor="';
  if ($page == "recipePrint" || $page == "logPrint")
    echo "#dddddd";
  elseif (checkmobile())
    echo "#dddddd";
  else
    echo $color1;
  echo '">' . "\n";
  echo '<td class="dataLeft bdr1T_light_dashed">';
  if ($totalHops > 0) {
    if ($action == "default" || $action == "reset" || $action == "print")
      echo number_format($totalHops, 2);
    if ($action == "scale")
      echo number_format(($totalHops * $scale), 2);
    echo "&nbsp;" . $row_pref['measWeight1'];
  } else {
    echo "&nbsp;"; 
  }
  echo '</td>' . "\n";
  echo '<td class="data bdr1T_light_dashed">';
  if ($totalHops > 0)
    echo "Total Hop Weight";
  else
    echo "&nbsp;";
  echo '</td>' . "\n";
  echo '<td class="data bdr1T_light_dashed">';
  if ($totalAAU > 0) {
    if ($action == "default" || $action == "reset" || $action == "print")
      echo round($totalAAU, 1);
    if ($action == "scale")
      echo round(($totalAAU * $scale), 1);
    echo "&nbsp;AAUs";
  } else {
    echo "&nbsp;";
  }
  echo '</td></tr></table></div>' . "\n";
} // end hide Hops

if ($row_log['brewBoilTime'] != "") { ?>
  <div class="headerContent">Boil</div>
  <div class="data-container">
  <table class="dataTable">
  <tr>
    <td class="dataLabelLeft">Total Boil Time:</td>
    <td class="data"><?php echo $row_log['brewBoilTime']; ?> minutes</td>
  </tr>
  </table>
  </div>
<?php } ?>