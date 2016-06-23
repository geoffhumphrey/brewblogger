<?php 
/**
 * Module: recipe_hops.inc.php
 * Description: This module populates the hop section of viewing a recipe.
 */
 

 /* } else {
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
	    echo "<tr>" . "\n";
	    echo '<td class="dataLabelLeft">Region:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsGrown'] . "</td>" . "\n";
	    echo "</tr>" . "\n";
	  }
	  if ($row_hops['hopsAAULow'] != "") {
	    echo "<tr>" . "\n";
	    echo '<td class="dataLabelLeft">AA Range:</td>' . "\n";
	    echo '<td class="data">';
	    $AAUmin = ltrim($row_hops['hopsAAULow'], "0");
	    $AAUmax = ltrim($row_hops['hopsAAUHigh'], "0");
	    echo $AAUmin." - ".$AAUmax."%";
	    echo "</td>" . "\n";
	    echo "</tr>" . "\n";
	  }
	  if ($row_hops['hopsInfo'] != "" ) {
	    echo "<tr>" . "\n";
	    echo '<td class="dataLabelLeft">Notes:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsInfo'] . "</td>" . "\n";
	    echo "</tr>" . "\n";
	  }
	  if ($row_hops['hopsUse'] != "" ) {
	    echo "<tr>" . "\n";
	    echo '<td class="dataLabelLeft">Typical Use:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsUse'] . "</td>" . "\n";
	    echo "</tr>" . "\n";
	  }
	  if ($row_hops['hopsSub'] != "" ) {
	    echo "<tr>" . "\n";
	    echo '<td class="dataLabelLeft">Substitution:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsSub'] . "</td>" . "\n";
	    echo "</tr>" . "\n";
	  }
	  if ($row_hops['hopsExample'] != "" ) {
	    echo "<tr>" . "\n";
	    echo '<td class="dataLabelLeft">Example:</td>' . "\n";
	    echo '<td class="data">' . $row_hops['hopsExample'] . "</td>" . "\n";
	    echo "</tr>" . "\n";
	  }
	  echo '</table></div></span>' . "\n";
	  echo '</a>' . "\n";
	  echo '</div>' . "\n";
	  
	}
	
      }
*/
 
$hops = "";
$hops_modals = "";
$total_hops = "";

if ($row_log['brewHops1'] != "" ) { // hide entire set of hops rows if first is not present 
	for ($i = 0; $i < MAX_HOPS; $i++) {
		$keyName   = 'brewHops' . ($i + 1);
		$keyWeight = 'brewHops' . ($i + 1) . 'Weight';
		$keyAA   = 'brewHops' . ($i + 1) . 'IBU';
		$keyForm = 'brewHops' . ($i + 1) . 'Form';
		$keyTime = 'brewHops' . ($i + 1) . 'Time';
		$keyType = 'brewHops' . ($i + 1) . 'Type';
		$keyUse  = 'brewHops' . ($i + 1) . 'Use';
		
    		if ($row_log[$keyName] != "") {
      			$hops .=  "<tr>" . "\n";
				
				// Amount
     			$hops .= "<td>";
      			if ($row_log[$keyWeight] != "" ) {
					if ($action == "default" || $action == "reset" || $action == "print")	$hops .= number_format($row_log[$keyWeight], 2);
					if ($action == "scale")  $hops .= number_format(($row_log[$keyWeight] * $scale), 2);
      			}
				$hops .= " " . $row_pref['measWeight1'] . "</td>" . "\n";
				
				// Name
				$hops .= "<td>" . "\n";
				$hops .= $row_log[$keyName];
				$hops .= "</td>" . "\n";
				
				// Time
				$hops .= "<td>" . "\n";
				if ($row_log[$keyTime] != "") $hops .= $row_log[$keyTime] . " min"; 
				$hops .= "</td>" . "\n";
				
				// Type
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($row_log[$keyType] == "Both") $hops .=  "Bittering and Aroma";
				  elseif ($row_log[$keyType] != "") $hops .=  $row_log[$keyType];
				  else	$hops .=  "";
				$hops .= "</td>" . "\n";
				// Use
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($row_log[$keyUse] != "") $hops .=  $row_log[$keyUse]; 
				$hops .= "</td>" . "\n";
				
				// Form 
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($row_log[$keyForm] != "") $hops .= $row_log[$keyForm] . " "; 
				$hops .= "</td>" . "\n";
				
				// Alpha Acid
				$hops .= "<td>" . "\n";
				if ($row_log[$keyAA] != "") $hops .= number_format($row_log[$keyAA],1) . "% ";
				$hops .= "</td>" . "\n";
      
   			}
 	}

  if ($totalHops > 0) {
    if ($action == "default" || $action == "reset" || $action == "print") $total_hops .= number_format($totalHops, 2);
    if ($action == "scale") $total_hops .= number_format(($totalHops * $scale), 2);
    $total_hops .=  "&nbsp;" . $row_pref['measWeight1'];
  } else    $total_hops .=  "&nbsp;";
    
} // end hide Hops 

if (!empty($hops)) { ?>
<h3>Hops</h3>
<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Hop</th>
            <th>Time</th>
            <th class="hidden-xs hidden-sm">Type</th>
            <th class="hidden-xs hidden-sm">Use</th>
            <th class="hidden-xs hidden-sm">Form</th>
            <th width="15%">AA</th>
        </tr>
    </thead>
    <tbody>
    	<?php echo $hops; ?>
    </tbody>
    <tfoot>
    	<tr>
        	<th><?php echo $total_hops; ?></th>
            <th colspan="6">Total Hop Weight</th>
        </tr>
    </tfoot>
</table>
<?php } ?>