<?php 
/**
 * Module: recipe_hops.inc.php
 * Description: This module populates the hop section of viewing a recipe.
 */
 
$hops = "";
$hops_modals = "";
$total_hops = "";

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
			
			$hop_more_info = hop_more_info($row_log[$hop_name]);
			$hop_more_info_id = $i + 1;
			
			if (!empty($hop_more_info)) {
			
				// Build Modal
				$hops_modals .= "<div class=\"modal fade\" id=\"hopsModal".$hop_more_info_id."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"hopsModalLabel".$hop_more_info_id."\">";
				$hops_modals .= "<div class=\"modal-dialog\" role=\"document\">";
				$hops_modals .= "<div class=\"modal-content\">";
				$hops_modals .= "<div class=\"modal-header\">";
				$hops_modals .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
				$hops_modals .= "<h4 class=\"modal-title\" id=\"hopsModalLabel".$hop_more_info_id."\">".$row_log[$hop_name]."</h4>";
				$hops_modals .= "</div>";
				$hops_modals .= "<div class=\"modal-body\">";

				//$hops_modals .= $hop_more_info;

				$hop_more_info = explode("|",$hop_more_info);

				if (!empty($hop_more_info[2])) {
					$hops_modals .= "<div class=\"row bcoem-account-info\">";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Use:</strong></div>";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$hop_more_info[2]."</div>";
					$hops_modals .= "</div>";
				}

				if (!empty($hop_more_info[4])) {
					$hops_modals .= "<div class=\"row bcoem-account-info\">";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>AAU Range:</strong></div>";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hop_more_info[4];
					if (!empty($hop_more_info[5])) $hops_modals .= " - ".$hop_more_info[5];
					$hops_modals .= "</div>";
					$hops_modals .= "</div>";
				}

				if (!empty($hop_more_info[0])) {
					$hops_modals .= "<div class=\"row bcoem-account-info\">";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hop_more_info[0]."</div>";
					$hops_modals .= "</div>";
				}

				if (!empty($hop_more_info[1])) {
					$hops_modals .= "<div class=\"row bcoem-account-info\">";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hop_more_info[1]."</div>";
					$hops_modals .= "</div>";
				}

				if (!empty($hop_more_info[3])) {
					$hops_modals .= "<div class=\"row bcoem-account-info\">";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Example(s):</strong></div>";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hop_more_info[3]."</div>";
					$hops_modals .= "</div>";
				}

				if (!empty($hop_more_info[6])) {
					$hops_modals .= "<div class=\"row bcoem-account-info\">";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Substitution(s):</strong></div>";
					$hops_modals .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$hop_more_info[6]."</div>";
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
				if ($action == "default" || $action == "reset" || $action == "print")	$hops .= number_format($row_log[$hop_weight], 2);
				if ($action == "scale")  $hops .= number_format(($row_log[$hop_weight] * $scale), 2);
			}
			$hops .= " " . $row_pref['measWeight1'] . "</td>" . "\n";

			// Name
			$hops .= "<td>" . "\n";
			if (!empty($hop_more_info)) $hops .= "<a href=\"#hopsModal".$hop_more_info_id."\" data-toggle=\"modal\">";
			$hops .= $row_log[$hop_name];
			if (!empty($hop_more_info)) $hops .= "</a>";
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

		if ($action == "default" || $action == "reset" || $action == "print") $total_hops .= number_format($totalHops, 2);
		if ($action == "scale") $total_hops .= number_format(($totalHops * $scale), 2);
		$total_hops .=  "&nbsp;" . $row_pref['measWeight1'];

	} 
	
	else $total_hops .=  "&nbsp;";
    
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
<?php if(!empty($hops_modals)) echo $hops_modals;
} ?>