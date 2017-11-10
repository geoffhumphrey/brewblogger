<?php 
/**
 * Module: recipe_fermentables.inc.php
 * Description: This module populates the extract, grain and adjunct sections of recipe viewing page.
 */

function more_info_modal($name,$db) {
	
	require (CONFIG.'config.php'); 
	$output = "";
	
	$query  = sprintf("SELECT * FROM %s WHERE maltName='%s'",$db,$name);
	$query_result = mysqli_query($connection,$query) or die (mysqli_error($connection));
	$row_result = mysqli_fetch_array($query_result);
	$totalRows_result = mysqli_num_rows($query_result);
	
	if ($totalRows_result > 0) {
		
		if ($db == "malt") {
			
			$output .= "";
			$output .= "";
			$output .= "";
			$output .= "";
			$output .= "";
			
		}
		
		if ($db == "hops") {
			
			$output .= "";
			$output .= "";
			$output .= "";
			$output .= "";
			$output .= "";
		
		}
		
		if ($db == "styles") {
		
			$output .= "";
			$output .= "";
			$output .= "";
			$output .= "";
			$output .= "";
		
		}
		
		
	}
	
	return $output;
	
	
		//echo '<div id="moreInfo">';
		//echo '<a href="#">';
		//echo $row_log[$keyName];
		/*
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
		  echo "<tr>" . "\n";
		  echo '<td class="dataLabelLeft">Color (L):</td>' . "\n";
		  echo "<td>";
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
		  echo "</td>" . "\n";
		  echo "</tr>" . "\n";
		  echo '<tr align="left" valign="top">' . "\n";
		  echo '<td class="dataLabelLeft">Info/Use:</td>' . "\n";
		  echo "<td>";
		  if ($row_malt['maltInfo'] != "") {
			echo $row_malt['maltInfo'];
		  } 
		  else {
			echo 'Not provided';
		  }
		  
		  echo "</td>" . "\n";
		  echo "</tr>" . "\n";
		  echo '</table>' . "\n";
		}
		echo '</div></span></a></div>' . "\n";
		  }
		  */
}

// Setup vars
$fermentables_extract = "";
$fermentables_extract_modals = "";
$total_fermentables_extract = "";
$fermentables_grain = "";
$fermentables_grain_modals = "";
$total_fermentables_grain = "";
$fermentables_adjunct = "";
$fermentables_adjunct_modals = "";
$total_fermentables_adjunct = "";

// Malt Extracts
if (!empty($row_log['brewExtract1'])) {
	for ($i = 0; $i < MAX_EXT; $i++) {
		$keyName   = 'brewExtract' . ($i + 1);
		$keyWeight = 'brewExtract' . ($i + 1) . 'Weight';
		if ($row_log[$keyName] != "") {
		  $fermentables_extract .= "<tr>" . "\n";
		  $fermentables_extract .= "<td>";
		  if ($action == "default" || $action == "reset" || $action == "print") $fermentables_extract .= number_format($row_log[$keyWeight], 2);
		  if ($action == "scale") $fermentables_extract .= number_format(($row_log[$keyWeight] * $scale), 2);
		  $fermentables_extract .= "&nbsp;" . $row_pref['measWeight2'] . "</td>" . "\n";
		  $fermentables_extract .= "<td>" . $row_log[$keyName] . "</td>" . "\n";
		  $fermentables_extract .= "<td>";
		  if ($row_log[$keyWeight] != "") {
			$fermentables_extract .= round ($extractPer[$i], 1) . "%";
		  } else {
			$fermentables_extract .= "&nbsp;";
		  }
		  $fermentables_extract .= "</td>" . "\n";
		  $fermentables_extract .= "</tr>" . "\n";
		}
	}
	
	if (($action == "default") || ($action == "reset") || ($action == "print")) $total_fermentables_extract .= number_format ($totalExtract, 2)."&nbsp;".$row_pref['measWeight2']; 
	if ($action == "scale") $total_fermentables_extract .= number_format (($totalExtract * $scale), 2)."&nbsp;".$row_pref['measWeight2'];
	
} //if (!empty($row_log['brewExtract1']))

// Malts and Grains
if (!empty($row_log['brewGrain1'])) {
	for ($i = 0; $i < MAX_GRAINS; $i++) {
		$keyName   = 'brewGrain' . ($i + 1);
		$keyWeight = 'brewGrain' . ($i + 1) . 'Weight';
		if ($row_log[$keyName] != "") {
		  $fermentables_grain .= "<tr>" . "\n";
		  $fermentables_grain .= '<td class="dataLeft">';
		  if (($action == "default") || ($action == "reset") || ($action == "print")) $fermentables_grain .= number_format($row_log[$keyWeight], 2);
		  if ($action == "scale")  $fermentables_grain .= number_format(($row_log[$keyWeight] * $scale), 2);
		  $fermentables_grain .= "&nbsp;".$row_pref['measWeight2']; 
		  $fermentables_grain .= "</td>" . "\n";
		  $fermentables_grain .= "<td>";
		  $fermentables_grain .= $row_log[$keyName];
		  $fermentables_grain .= "</td>" . "\n";
		  $fermentables_grain .= "<td>";
		  if ($row_log[$keyWeight] != "") $fermentables_grain .= round($grainPer[$i], 1)."%";
		  else  $fermentables_grain .= '&nbsp;';
		  $fermentables_grain .= "</td>" . "\n";
		  $fermentables_grain .= "</tr>" . "\n";
		  
		  $modal_body = more_info_modal($row_log[$keyName],"malt");
		  if(!empty($modal_body)) $fermentables_grain_modals .= $modal_body;
		  
		}
	  }
} // end if (!empty($row_log['brewGrain1']))

// Adjuncts
if (!empty($row_log['brewAddition1'])) {
	for ($i = 0; $i < MAX_ADJ; $i++) {
		$keyName   = 'brewAddition' . ($i + 1);
		$keyWeight = 'brewAddition' . ($i + 1) . 'Amt';
		if ($row_log[$keyName] != "") {
			$fermentables_adjunct .= "<tr>" . "\n";
			$fermentables_adjunct .= "<td>";
			if ($action == "default" || $action == "reset" || $action == "print") $fermentables_adjunct .= number_format($row_log[$keyWeight], 2);
			if ($action == "scale") $fermentables_adjunct .= number_format(($row_log[$keyWeight] * $scale), 2);
			$fermentables_adjunct .= "&nbsp;" . $row_pref['measWeight2'] . "</td>" . "\n";
			$fermentables_adjunct .= "<td>" . $row_log[$keyName] . "</td>" . "\n";
			$fermentables_adjunct .= "</tr>" . "\n";
		}
	}
}
?>
<?php if (!empty($fermentables_extract)) {  ?>
<!-- Malt Extracts -->
<h3>Extract</h3>
<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Extract</th>
            <th width="15%">% of Grist</th>
        </tr>
    </thead>
	<tbody>
	<?php echo $fermentables_extract; ?>
	</tbody>
	<tfoot>
        <tr>
            <th width="15%"><?php echo $total_fermentables_extract; ?></td>
            <th>Total Extract Weight</td>
            <th width="15%"><?php echo round ($totalExtractPer, 1); ?>% of grist</td>
        </tr>
	</tfoot>
</table>
<?php } // end hide extracts (1) ?>

<?php if (!empty($fermentables_grain)) { ?>
<h3><a name="recipe" id="recipe"></a>Malts and Grains</h3>
<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Malt/Grain</th>
            <th width="15%">%<span  class="hidden-xs hidden-sm"> of Grist</span></th>
        </tr>
    </thead>
    <tbody>
    <?php echo $fermentables_grain; ?>
    </tbody>
    <tfoot>
    	<tr>
    		<th width="15%"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalGrain, 2); if ($action == "scale") echo number_format (($totalGrain * $scale), 2);  echo "&nbsp;".$row_pref['measWeight2']; ?></td>
    		<th>Total Grain Weight</td>
    		<th width="15%"><?php echo round ($totalGrainPer, 1); ?>%</td>
    	</tr>
    </tfoot>
</table>
<?php } ?>


<?php // ------------------------ ADJUNCT SECTION ------------------------ 
if (!empty($fermentables_adjunct)) { // hide entire set of Adjunct table rows (3) ?>
 <h3>Adjuncts</h3>
  <table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Adjunct</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $fermentables_adjunct; ?>
    </tbody>
</table>

  <?php } // end hide Adjuncts (3) ?>
