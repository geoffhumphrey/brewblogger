<?php
/**
 * Module: recipe_hops.inc.php
 * Description: This module populates the hop section of viewing a recipe.
 */


$total_hops = 0;
$hops_modals = "";
$hops_display = "";
$hops_display_table = "";

$meas_weight_hops = convert_to_abbrev($_SESSION['measWeight1']);

if ((is_array($hops)) && (!empty($hops))) {

	foreach ($hops as $key => $hop) {

		$hops_display .= "<div class=\"row mb-2\">";
		$hops_display .= "<div class=\"col-3 col-md-2 col-lg-1\">";
		if (isset($hop['AMOUNT'])) {
			//$hops_display .= "<span class=\"float-end\">";
			if ($action == "scale") $hops_display .= number_format(($hop['AMOUNT'] * $scale), 2)." ".$meas_weight_hops;
			else $hops_display .= number_format($hop['AMOUNT'],2)." ".$meas_weight_hops;
			//$hops_display .= "</span>";
		}
		$hops_display .= "</div>";
		$hops_display .= "<div class=\"col-6 col-md-4 col-lg-4\">";
		if (isset($hop['NAME'])) $hops_display .= "<strong>".h($hop['NAME'])."</strong> <span class=\"small text-body-secondary\">".number_format($hop['ALPHA'],1)."%</span>";
		$hops_display .= "</div>";
		$hops_display .= "<div class=\"col-3 col-md-6 col-lg-7\">";
		if (isset($hop['TIME'])) {
			if ($hop['USE'] == "Dry Hop") $hops_display .= (h($hop['TIME'])/1440)." days</td>";
			else {
				if (empty($hop['TIME'])) $hops_display .= "0 min";
				else $hops_display .= $hop['TIME']." min";
				if ((isset($hop['HOP_TEMP'])) && (h($hop['HOP_TEMP']) > 0)) $hops_display .= " <span class=\"small text-body-secondary\">hopstand @ ".h($hop['HOP_TEMP'])."&deg;".$_SESSION['measTemp']."</span>";
				elseif (isset($hop['USE'])) {
					if ($hop['USE'] == "Dry Hop") $hops_display .= " <span class=\"small text-body-secondary\">".(h($hop['TIME'])/1440)." days</span>";
					else $hops_display .= " <span class=\"small text-body-secondary\">".h($hop['USE'])."</span>";
				}	
			}
		}
		$hops_display .= "</div>";
		$hops_display .= "</div>";


		/*
		// Table Configuration

		$hops_display_table .= "<tr>" . "\n";
		
		if (isset($hop['AMOUNT'])) {
			if ($action == "scale") $hops_display_table .= "<td>".number_format(($hop['AMOUNT'] * $scale), 2)." ".$meas_weight_hops."</td>";
			else $hops_display_table .= "<td>".number_format($hop['AMOUNT'],2)." ".$meas_weight_hops."</td>";
		}
		
		else $hops_display_table .= "<td>&nbsp;</td>";
		
		if (isset($hop['NAME'])) $hops_display_table .= "<td>".$hop['NAME']."</td>";
		else $hops_display_table .= "<td>&nbsp;</td>";

		if (isset($hop['TIME'])) {
			if ($hop['USE'] == "Dry Hop") $hops_display_table .= "<td>".($hop['TIME']/1440)." days</td>";
			else $hops_display_table .= "<td>".$hop['TIME']." minutes</td>";
		}

		else $hops_display_table .= "<td>0 minutes</td>";
		
		if ((isset($hop['HOP_TEMP'])) && ($hop['HOP_TEMP'] > 0)) $hops_display_table .= "<td>Whirlpool <small>@ ".$hop['HOP_TEMP']."&deg;".$_SESSION['measTemp']."</small></td>";
		elseif (isset($hop['USE'])) $hops_display_table .= "<td>".$hop['USE']."</td>";
		else $hops_display_table .= "<td>&nbsp;</td>";
		
		if (isset($hop['FORM'])) $hops_display_table .= "<td>".$hop['FORM']."</td>";
		else $hops_display_table .= "<td>&nbsp;</td>";
		
		if (isset($hop['ALPHA'])) $hops_display_table .= "<td>".number_format($hop['ALPHA'],1)."%</td>";
		else $hops_display_table .= "<td>&nbsp;</td>";
		
		$hops_display_table .= "</tr>";
		if (is_numeric($hop['AMOUNT'])) $total_hops += $hop['AMOUNT'];

		*/

	}

	/*

	// hide entire set of hops rows if first is not present
	if (!empty($row_log['brewHops1'])) {

		for ($i = 0; $i < MAX_HOPS; $i++) {

			$hop_name   = 'brewHops' . ($i + 1);
			$hop_weight = 'brewHops' . ($i + 1) . 'Weight';
			$hop_alpha  = 'brewHops' . ($i + 1) . 'IBU';
			$hop_form = 'brewHops' . ($i + 1) . 'Form';
			$hop_time = 'brewHops' . ($i + 1) . 'Time';
			$hop_type = 'brewHops' . ($i + 1) . 'Type';
			$hop_use  = 'brewHops' . ($i + 1) . 'Use';

	    	if (!empty($row_log[$hop_name])) {

				// $hop_more_info = hop_more_info($row_log[$hop_name]);
				$hops_display_table = get_session_array_values($_SESSION['hops'],"hopsName",$row_log[$hop_name]);
				$hop_more_info_id = $i + 1;

				if (is_array($hops_display_table)) {

					// Build Modal
					$hops_modals .= "<div class=\"modal fade\" id=\"hopsModal".$hops_display_table[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"hopsModalLabel".$hops_display_table[0]['id']."\">";
					$hops_modals .= "<div class=\"modal-dialog\" role=\"document\">";
					$hops_modals .= "<div class=\"modal-content\">";
					$hops_modals .= "<div class=\"modal-header\">";
					$hops_modals .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
					$hops_modals .= "<h4 class=\"modal-title\" id=\"hopsModalLabel".$hops_display_table[0]['id']."\">".$row_log[$hop_name]."</h4>";
					$hops_modals .= "</div>";
					$hops_modals .= "<div class=\"modal-body\">";

					// $hops_modals .= $hop_more_info;

					// $hop_more_info = explode("|",$hop_more_info);

					if (!empty($hops_display_table[0]['hopsUse'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Use:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsUse']."</div>";
						$hops_modals .= "</div>";
					}

					if (!empty($hops_display_table[0]['hopsAAULow'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>AAU Range:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($hops_display_table[0]['hopsAAULow'],1)."%";
						if (!empty($hops_display_table[0]['hopsAAUHigh'])) $hops_modals .= " - ".number_format($hops_display_table[0]['hopsAAUHigh'],1)."%";
						$hops_modals .= "</div>";
						$hops_modals .= "</div>";
					}

					if (!empty($hops_display_table[0]['hopsGrown'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsGrown']."</div>";
						$hops_modals .= "</div>";
					}

					if (!empty($hops_display_table[0]['hopsInfo'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsInfo']."</div>";
						$hops_modals .= "</div>";
					}

					if (!empty($hops_display_table[0]['hopsExample'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Example(s):</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsExample']."</div>";
						$hops_modals .= "</div>";
					}

					if (!empty($hops_display_table[0]['hopsSub'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Substitution(s):</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsSub']."</div>";
						$hops_modals .= "</div>";
					}

					$hops_modals .= "</div>";
					$hops_modals .= "<div class=\"modal-footer\">";
					$hops_modals .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";

				}

				$hops .=  "<tr>" . "\n";

				// Amount
				$hops .= "<td>";
				if ($row_log[$hop_weight] != "" ) {
					if ($action == "scale")  $hops .= number_format(($row_log[$hop_weight] * $scale), 2);
					else $hops .= number_format($row_log[$hop_weight], 2);
				}
				$hops .= " " . $meas_weight_hops . "</td>" . "\n";

				// Name
				$hops .= "<td>" . "\n";
				if (is_array($hops_display_table)) $hops .= "<a href=\"#hopsModal".$hops_display_table[0]['id']."\" data-toggle=\"modal\">";
				$hops .= $row_log[$hop_name];
				if (is_array($hops_display_table)) $hops .= "</a>";
				$hops .= "</td>" . "\n";

				// Time
				$hops .= "<td>" . "\n";
				if ($row_log[$hop_time] != "") $hops .= $row_log[$hop_time] . " min";
				$hops .= "</td>" . "\n";

				// Type
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($row_log[$hop_type] == "Both") $hops .=  "Bittering and Aroma";
				  elseif ($row_log[$hop_type] != "") $hops .=  $row_log[$hop_type];
				  else	$hops .=  "";
				$hops .= "</td>" . "\n";
				// Use
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($row_log[$hop_use] != "") $hops .=  $row_log[$hop_use];
				$hops .= "</td>" . "\n";

				// Form
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($row_log[$hop_form] != "") $hops .= $row_log[$hop_form] . " ";
				$hops .= "</td>" . "\n";

				// Alpha Acid
				$hops .= "<td>" . "\n";
				if ($row_log[$hop_alpha] != "") $hops .= number_format($row_log[$hop_alpha],1) . "% ";
				$hops .= "</td>" . "\n";


			}

	 	}

		if ($totalHops > 0) {

			if ($action == "scale") $total_hops .= number_format(($totalHops * $scale), 2);
			else $total_hops .= number_format($totalHops, 2);
			$total_hops .=  "&nbsp;" . $meas_weight_hops;

		}

		else $total_hops .=  "&nbsp;";

	} // end hide Hops

	if (!empty($row_log['brewHops'])) {

		$hops_explode = explode("^", $row_log['brewHops']);

		foreach ($hops_explode as $hop) {

			$hop_explode = explode("|", $hop);
			$hops_display_table_info = array(0);

			if (!empty($hops_explode[0])) {

				$hops_display_table = get_session_array_values($_SESSION['hops'],"id",$hop_explode[0]);
				$hop_more_info_id = $i + 1;

				if (is_array($hops_display_table)) {

					// Build Modal
					$hops_modals .= "<div class=\"modal fade\" id=\"hopsModal".$hops_display_table[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"hopsModalLabel".$hops_display_table[0]['id']."\">";
					$hops_modals .= "<div class=\"modal-dialog\" role=\"document\">";
					$hops_modals .= "<div class=\"modal-content\">";
					$hops_modals .= "<div class=\"modal-header\">";
					$hops_modals .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
					$hops_modals .= "<h4 class=\"modal-title\" id=\"hopsModalLabel".$hops_display_table[0]['id']."\">".$hops_display_table[0]['hopsName']."</h4>";
					$hops_modals .= "</div>";
					$hops_modals .= "<div class=\"modal-body\">";

					if (!empty($hops_display_table[0]['hopsUse'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Use:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsUse']."</div>";
						$hops_modals .= "</div>";
						$hops_display_table_info[] = 1;
					}

					if (!empty($hops_display_table[0]['hopsAAULow'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>AAU Range:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($hops_display_table[0]['hopsAAULow'],1)."%";
						if (!empty($hops_display_table[0]['hopsAAUHigh'])) $hops_modals .= " - ".number_format($hops_display_table[0]['hopsAAUHigh'],1)."%";
						$hops_modals .= "</div>";
						$hops_modals .= "</div>";
						$hops_display_table_info[] = 1;

					}

					if (!empty($hops_display_table[0]['hopsGrown'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsGrown']."</div>";
						$hops_modals .= "</div>";
						$hops_display_table_info[] = 1;
					}

					if (!empty($hops_display_table[0]['hopsInfo'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsInfo']."</div>";
						$hops_modals .= "</div>";
						$hops_display_table_info[] = 1;
					}

					if (!empty($hops_display_table[0]['hopsExample'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Example(s):</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsExample']."</div>";
						$hops_modals .= "</div>";
						$hops_display_table_info[] = 1;
					}

					if (!empty($hops_display_table[0]['hopsSub'])) {
						$hops_modals .= "<div class=\"row bb-account-info\">";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Substitution(s):</strong></div>";
						$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hops_display_table[0]['hopsSub']."</div>";
						$hops_modals .= "</div>";
						$hops_display_table_info[] = 1;
					}

					$hops_modals .= "</div>";
					$hops_modals .= "<div class=\"modal-footer\">";
					$hops_modals .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";

				}

				$hops .=  "<tr>" . "\n";

				$hops_modal_display = array_sum($hops_display_table_info);

				// id, Weight, IBU, Time, Use, Type, Form
				// Weight
				$hops .= "<td>" . "\n";
				if ($hop_explode[1] != "0") {
					if ($action == "scale")  $hops .= number_format(($hop_explode[1] * $scale), 2);
					else $hops .= number_format($hop_explode[1], 2);
					$hops .= " " . $meas_weight_hops;
				}
				else $hops .= "&nbsp;";
				$hops .= "</td>" . "\n";

				// Name
				$hops .= "<td>" . "\n";
				if ((is_array($hops_display_table) && ($hops_modal_display > 0))) $hops .= "<a href=\"#hopsModal".$hops_display_table[0]['id']."\" data-toggle=\"modal\">";
				$hops .= $hops_display_table[0]['hopsName'];
				if ((is_array($hops_display_table) && ($hops_modal_display > 0))) $hops .= "</a>";
				$hops .= "</td>" . "\n";

				// Time
				$hops .= "<td>" . "\n";
				if (is_numeric($hop_explode[3])) $hops .= $hop_explode[3]. " min";
				else $hops .= "&nbsp;";
				$hops .= "</td>" . "\n";

				// Type
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($hop_explode[5] == "Both") $hops .=  "Bittering and Aroma";
				elseif ($hop_explode[5] != "*") $hops .=  $hop_explode[5];
				else $hops .= "&nbsp;";
				$hops .= "</td>" . "\n";

				// Use
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($hop_explode[4] != "*") $hops .=  $hop_explode[4];
				else $hops .= "&nbsp;";
				$hops .= "</td>" . "\n";

				// Form
				$hops .= "<td class=\"hidden-xs hidden-sm\">" . "\n";
				if ($hop_explode[6] != "*") $hops .= $hop_explode[6] . " ";
				else $hops .= "&nbsp;";
				$hops .= "</td>" . "\n";

				// Alpha Acid
				$hops .= "<td>" . "\n";
				if ($hop_explode[2] != "*") $hops .= number_format($hop_explode[2],1) . "% ";
				else $hops .= "&nbsp;";
				$hops .= "</td>" . "\n";

			}

	 	}

		if ($totalHops > 0) {

			if ($action == "scale") $total_hops .= number_format(($totalHops * $scale), 2);
			else $total_hops .= number_format($totalHops, 2);
			$total_hops .=  "&nbsp;" . $meas_weight_hops;

		}

		else $total_hops .=  "&nbsp;";

	} // end hide Hops

	*/

?>

<h3>Hops</h3>

<div class="mb-3">
<?php echo $hops_display; ?>
</div>

<!--
<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Hop</th>
            <th>Time</th>
            <th>Use</th>
            <th>Form</th>
            <th width="15%">AA</th>
        </tr>
    </thead>
    <tbody>
    	<?php echo $hops_display_table; ?>
    </tbody>
    <tfoot>
    	<tr>
        	<th><?php if ($action == "scale") echo number_format($total_hops*$scale,2); else echo number_format($total_hops,2); echo " ".$meas_weight_hops; ?></th>
            <th colspan="6">Total Hop Weight</th>
        </tr>
    </tfoot>
</table>

-->
<?php
	// if(!empty($hops_modals)) echo $hops_modals;
} // end if ((is_array($hops)) && (!empty($hops))) 
?>