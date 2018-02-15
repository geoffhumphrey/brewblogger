<?php
/**
 * Module: recipe_fermentables.inc.php
 * Description: This module populates the extract, grain and adjunct sections of recipe viewing page.
 */

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
$total_extract = 0;
$total_grain = 0;
$total_adjunct = 0;
$total_grist = 0;
$total_extract_percentage = 0;
$total_grain_percentage = 0;
$total_adjunct_percentage = 0;

if (!empty($row_log['brewFermentables'])) {

    $fermentables_explode = explode("^", $row_log['brewFermentables']);

    // Get total grist calculation
    foreach ($fermentables_explode as $fermentable_grist) {

        $fermentable_grist_explode = explode("|",$fermentable_grist);

        if ($fermentable_grist_explode[0] == "e") {
            $total_extract += $fermentable_grist_explode[2];
        }

        if ($fermentable_grist_explode[0] == "g") {
            $total_grain += $fermentable_grist_explode[2];
        }

        if ($fermentable_grist_explode[0] == "a") {
            $total_adjunct += $fermentable_grist_explode[2];
        }

    }

    $total_grist = ($total_extract + $total_grain + $total_adjunct);

    if ($total_extract > 0 && $total_grist > 0) {
        $total_extract_percentage = (($total_extract / $total_grist) * 100);
    }

    if ($total_grain > 0 && $total_grist > 0) {
        $total_grain_percentage = (($total_grain / $total_grist) * 100);
    }

    if ($total_adjunct > 0 && $total_grist > 0) {
        $total_adjunct_percentage = (($total_adjunct / $total_grist) * 100);
    }

    if ($action == "scale") {
        $total_fermentables_extract .= number_format (($total_extract * $scale), 2)."&nbsp;".$_SESSION['measWeight2'];
        $total_fermentables_grain .= number_format (($total_grain * $scale), 2)."&nbsp;".$_SESSION['measWeight2'];
        $total_fermentables_adjunct .= number_format (($total_adjunct * $scale), 2)."&nbsp;".$_SESSION['measWeight2'];
    }

    else {
        $total_fermentables_extract .= number_format ($total_extract, 2)."&nbsp;".$_SESSION['measWeight2'];
        $total_fermentables_grain .= number_format ($total_grain, 2)."&nbsp;".$_SESSION['measWeight2'];
        $total_fermentables_adjunct .= number_format ($total_adjunct, 2)."&nbsp;".$_SESSION['measWeight2'];
    }

    foreach ($fermentables_explode as $fermentable) {

        $fermentable_explode = explode("|",$fermentable);

        // Extract
        if ($fermentable_explode[0] == "e") {

            $fermentables_extract_display = array(0);

            $fermentables_extract .= "<tr>" . "\n";
            $fermentables_extract .= "<td>";
            if ($action == "scale") $fermentables_extract .= number_format(($fermentable_explode[2] * $scale), 2);
            else $fermentables_extract .= number_format($fermentable_explode[2], 2);
            $fermentables_extract .= "&nbsp;" . $_SESSION['measWeight2'] . "</td>" . "\n";
            $fermentables_extract .= "<td>";

            $total_extract += $fermentable_explode[2];

            $extract_display = get_session_array_values($_SESSION['extracts'],"id",$fermentable_explode[1]);

            if (is_array($extract_display)) {

                $modal_body = "";

                // Build Modal
                $modal_body .= "<div class=\"modal fade\" id=\"extractModal".$extract_display[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"extractModalLabel".$extract_display[0]['id']."\">";
                $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
                $modal_body .= "<div class=\"modal-content\">";
                $modal_body .= "<div class=\"modal-header\">";
                $modal_body .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                $modal_body .= "<h4 class=\"modal-title\" id=\"grainsModalLabel".$extract_display[0]['id']."\">".$extract_display[0]['extractName']."</h4>";
                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-body\">";

                if (!empty($extract_display[0]['extractLovibond'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Color:</strong></div>";
                    if (strpos($extract_display[0]['extractLovibond'], "-") !== false) {
                        $extract_lov_explodies = explode("-", $extract_display[0]['extractLovibond']);
                        $extract_lovibond = number_format($extract_lov_explodies[0],1)."-".number_format($extract_lov_explodies[1],1);
                    }
                    else $extract_lovibond = number_format($extract_display[0]['extractLovibond'],1);
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$extract_lovibond." ".$_SESSION['measColor']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                if (!empty($extract_display[0]['extractYield'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>PPG:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($extract_display[0]['extractYield'],1)."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                if (!empty($extract_display[0]['extractOrigin'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$extract_display[0]['extractOrigin']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                if (!empty($extract_display[0]['extractSupplier'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Supplier:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$extract_display[0]['extractSupplier']."</div>";
                    $modal_body .= "</div>";
                }

                if (!empty($extract_display[0]['extractInfo'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$extract_display[0]['extractInfo']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-footer\">";
                $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";

            }

            if (array_sum($fermentables_extract_display) > 0) $fermentables_extract .= "<a href=\"#extractModal".$extract_display[0]['id']."\" data-toggle=\"modal\">".$extract_display[0]['extractName']."</a>";
            else $fermentables_extract .= $extract_display[0]['extractName'];
            $fermentables_extract .= "</td>" . "\n";
            $fermentables_extract .= "<td>";
            if (isset($fermentable_explode[2]) && ($fermentable_explode[2] > 0)) {
                $extract_percentage = (($fermentable_explode[2] / $total_grist) * 100);
                $fermentables_extract .= round ($extract_percentage, 1) . "%";
            }
            else  $fermentables_extract .= "&nbsp;";
            $fermentables_extract .= "</td>" . "\n";
            $fermentables_extract .= "</tr>" . "\n";
            if(!empty($modal_body)) $fermentables_extract_modals .= $modal_body;

        } // end if ($fermentable_explode[0] == "e")

        // Grain
        if ($fermentable_explode[0] == "g") {

            $fermentables_grain_display = array(0);
            $fermentables_grain .= "<tr>" . "\n";
            $fermentables_grain .= '<td>';
            if ($action == "scale")  $fermentables_grain .= number_format(($fermentable_explode[2] * $scale), 2);
            else $fermentables_grain .= number_format($fermentable_explode[2], 2);
            $fermentables_grain .= "&nbsp;".$_SESSION['measWeight2'];
            $fermentables_grain .= "</td>" . "\n";
            $fermentables_grain .= "<td>";

            $grains_display = get_session_array_values($_SESSION['grains'],"id",$fermentable_explode[1]);

            if (is_array($grains_display)) {

                $modal_body = "";

                // Build Modal
                $modal_body .= "<div class=\"modal fade\" id=\"grainsModal".$grains_display[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"grainsModalLabel".$grains_display[0]['id']."\">";
                $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
                $modal_body .= "<div class=\"modal-content\">";
                $modal_body .= "<div class=\"modal-header\">";
                $modal_body .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                $modal_body .= "<h4 class=\"modal-title\" id=\"grainsModalLabel".$grains_display[0]['id']."\">".$grains_display[0]['maltName']."</h4>";
                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-body\">";

                if (!empty($grains_display[0]['maltLovibond'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Color:</strong></div>";
                    if (strpos($grains_display[0]['maltLovibond'], "-") !== false) {
                        $malt_lov_explodies = explode("-", $grains_display[0]['maltLovibond']);
                        $malt_lovibond = number_format($malt_lov_explodies[0],1)."-".number_format($malt_lov_explodies[1],1);
                    }
                    else $malt_lovibond = number_format($grains_display[0]['maltLovibond'],1);
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$malt_lovibond." ".$_SESSION['measColor']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltYield'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>PPG:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($grains_display[0]['maltYield'],1)."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltOrigin'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$grains_display[0]['maltOrigin']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltSupplier'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Supplier:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$grains_display[0]['maltSupplier']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltInfo'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$grains_display[0]['maltInfo']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-footer\">";
                $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";

            }

            if (array_sum($fermentables_grain_display) > 0) $fermentables_grain .= "<a href=\"#grainsModal".$grains_display[0]['id']."\" data-toggle=\"modal\">".$grains_display[0]['maltName']."</a>";
            else $fermentables_grain .= $grains_display[0]['maltName'];
            $fermentables_grain .= "</td>" . "\n";
            $fermentables_grain .= "<td>";
            if (isset($fermentable_explode[2]) && ($fermentable_explode[2] > 0)) {
                $grain_percentage = (($fermentable_explode[2] / $total_grist) * 100);
                $fermentables_grain .= round ($grain_percentage, 1) . "%";
            }
            else  $fermentables_grain .= "&nbsp;";
            $fermentables_grain .= "</td>" . "\n";
            $fermentables_grain .= "</tr>" . "\n";

            if(!empty($modal_body)) $fermentables_grain_modals .= $modal_body;

        }

        // Adjunct
        if ($fermentable_explode[0] == "a") {

            $fermentables_adjunct_display = array(0);
            $fermentables_adjunct .= "<tr>" . "\n";
            $fermentables_adjunct .= "<td>";
            if ($action == "scale") $fermentables_adjunct .= number_format(($fermentable_explode[2] * $scale), 2);
            else $fermentables_adjunct .= number_format($fermentable_explode[2], 2);
            $fermentables_adjunct .= "&nbsp;" . $_SESSION['measWeight2'] . "</td>" . "\n";

            $fermentables_adjunct .= "<td>";

            $adjunct_display = get_session_array_values($_SESSION['adjuncts'],"id",$fermentable_explode[1]);

            if (is_array($adjunct_display)) {

                $modal_body = "";

                // Build Modal
                $modal_body .= "<div class=\"modal fade\" id=\"adjunctModal".$adjunct_display[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"adjunctModalLabel".$adjunct_display[0]['id']."\">";
                $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
                $modal_body .= "<div class=\"modal-content\">";
                $modal_body .= "<div class=\"modal-header\">";
                $modal_body .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                $modal_body .= "<h4 class=\"modal-title\" id=\"grainsModalLabel".$adjunct_display[0]['id']."\">".$adjunct_display[0]['adjunctName']."</h4>";
                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-body\">";

                if (!empty($adjunct_display[0]['adjunctLovibond'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Color:</strong></div>";
                    if (strpos($adjunct_display[0]['adjunctLovibond'], "-") !== false) {
                        $adjunct_lov_explodies = explode("-", $adjunct_display[0]['adjunctLovibond']);
                        $adjunct_lovibond = number_format($adjunct_lov_explodies[0],1)."-".number_format($adjunct_lov_explodies[1],1);
                    }
                    else $adjunct_lovibond = number_format($adjunct_display[0]['adjunctLovibond'],1);
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$adjunct_lovibond." ".$_SESSION['measColor']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctYield'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>PPG:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($adjunct_display[0]['adjunctYield'],1)."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctOrigin'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$adjunct_display[0]['adjunctOrigin']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctSupplier'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Supplier:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$adjunct_display[0]['adjunctSupplier']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctInfo'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$adjunct_display[0]['adjunctInfo']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-footer\">";
                $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";

            }

            if (array_sum($fermentables_adjunct_display) > 0)  $fermentables_adjunct .= "<a href=\"#adjunctModal".$adjunct_display[0]['id']."\" data-toggle=\"modal\">".$adjunct_display[0]['adjunctName']."</a>";
            else $fermentables_adjunct .= $adjunct_display[0]['adjunctName'];
            $fermentables_adjunct .= "</td>" . "\n";
            $fermentables_adjunct .= "<td>";
            if (isset($fermentable_explode[2]) && ($fermentable_explode[2] > 0)) {
                $adjunct_percentage = (($fermentable_explode[2] / $total_grist) * 100);
                $fermentables_adjunct .= round ($adjunct_percentage, 1) . "%";
            }
            else  $fermentables_adjunct .= "&nbsp;";
            $fermentables_adjunct .= "</td>" . "\n";
            $fermentables_adjunct .= "</tr>" . "\n";
            if(!empty($modal_body)) $fermentables_grain_modals .= $modal_body;
        }

    }

} // end if (!empty($row_log['brewFermentables']))

if (!empty($fermentables_extract_modals)) echo $fermentables_extract_modals;
if (!empty($fermentables_grain_modals)) echo $fermentables_grain_modals;
if (!empty($fermentables_adjunct_modals)) echo $fermentables_adjunct_modals;
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
            <th width="15%"><?php echo round ($total_extract_percentage, 1); ?>%</td>
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
    		<th width="15%"><?php echo $total_fermentables_grain; ?></td>
    		<th>Total Grain Weight</td>
    		<th width="15%"><?php echo round ($total_grain_percentage, 1); ?>%</td>
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
            <th width="15%">%<span  class="hidden-xs hidden-sm"> of Grist</span></th>
        </tr>
    </thead>
    <tbody>
    <?php echo $fermentables_adjunct; ?>
    </tbody>
    <tfoot>
        <tr>
            <th width="15%"><?php echo $total_fermentables_adjunct; ?></td>
            <th>Total Adjunct Weight</td>
            <th width="15%"><?php echo round ($total_adjunct_percentage, 1); ?>%</td>
        </tr>
    </tfoot>
</table>
<?php } // end hide Adjuncts (3)

/*
// Malt Extracts
if (!empty($row_log['brewExtract1'])) {
    for ($i = 0; $i < MAX_EXT; $i++) {
            $fermentables_extract_display = array(0);
            $keyName   = 'brewExtract' . ($i + 1);
            $keyWeight = 'brewExtract' . ($i + 1) . 'Weight';
            if ($row_log[$keyName] != "") {
            $fermentables_extract .= "<tr>" . "\n";
            $fermentables_extract .= "<td>";
            if ($action == "scale") $fermentables_extract .= number_format(($row_log[$keyWeight] * $scale), 2);
            else $fermentables_extract .= number_format($row_log[$keyWeight], 2);
            $fermentables_extract .= "&nbsp;" . $_SESSION['measWeight2'] . "</td>" . "\n";
            $fermentables_extract .= "<td>";

            $extract_display = get_session_array_values($_SESSION['extracts'],"extractName",$row_log[$keyName]);

            if (is_array($extract_display)) {

                $modal_body = "";

                // Build Modal
                $modal_body .= "<div class=\"modal fade\" id=\"extractModal".$extract_display[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"extractModalLabel".$extract_display[0]['id']."\">";
                $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
                $modal_body .= "<div class=\"modal-content\">";
                $modal_body .= "<div class=\"modal-header\">";
                $modal_body .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                $modal_body .= "<h4 class=\"modal-title\" id=\"grainsModalLabel".$extract_display[0]['id']."\">".$row_log[$keyName]."</h4>";
                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-body\">";

                if (!empty($extract_display[0]['extractLovibond'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Color:</strong></div>";
                    if (strpos($extract_display[0]['extractLovibond'], "-") !== false) {
                        $extract_lov_explodies = explode("-", $extract_display[0]['extractLovibond']);
                        $extract_lovibond = number_format($extract_lov_explodies[0],1)."-".number_format($extract_lov_explodies[1],1);
                    }
                    else $extract_lovibond = number_format($extract_display[0]['extractLovibond'],1);
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$extract_lovibond." ".$_SESSION['measColor']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                if (!empty($extract_display[0]['extractYield'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>PPG:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($extract_display[0]['extractYield'],1)."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                if (!empty($extract_display[0]['extractOrigin'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$extract_display[0]['extractOrigin']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                if (!empty($extract_display[0]['extractSupplier'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Supplier:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$extract_display[0]['extractSupplier']."</div>";
                    $modal_body .= "</div>";
                }

                if (!empty($extract_display[0]['extractInfo'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$extract_display[0]['extractInfo']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_extract_display[] = 1;
                }

                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-footer\">";
                $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";

            }

            if (array_sum($fermentables_extract_display) > 0) $fermentables_extract .= "<a href=\"#extractModal".$extract_display[0]['id']."\" data-toggle=\"modal\">".$row_log[$keyName]."</a>";
            else $fermentables_extract .= $row_log[$keyName];
            $fermentables_extract .= "</td>" . "\n";
            $fermentables_extract .= "<td>";
            if ($row_log[$keyWeight] != "") $fermentables_extract .= round ($extractPer[$i], 1) . "%";
            else  $fermentables_extract .= "&nbsp;";
            $fermentables_extract .= "</td>" . "\n";
            $fermentables_extract .= "</tr>" . "\n";
            if(!empty($modal_body)) $fermentables_extract_modals .= $modal_body;
        }
    }

    if ($action == "scale") $total_fermentables_extract .= number_format (($total_extract * $scale), 2)."&nbsp;".$_SESSION['measWeight2'];
    else $total_fermentables_extract .= number_format ($total_extract, 2)."&nbsp;".$_SESSION['measWeight2'];

} //if (!empty($row_log['brewExtract1']))

// Malts and Grains
if (!empty($row_log['brewGrain1'])) {

    for ($i = 0; $i < MAX_GRAINS; $i++) {
        $keyName   = 'brewGrain' . ($i + 1);
        $keyWeight = 'brewGrain' . ($i + 1) . 'Weight';
        if ($row_log[$keyName] != "") {
            $fermentables_grain_display = array(0);
            $fermentables_grain .= "<tr>" . "\n";
            $fermentables_grain .= '<td class="dataLeft">';
            if ($action == "scale")  $fermentables_grain .= number_format(($row_log[$keyWeight] * $scale), 2);
            else $fermentables_grain .= number_format($row_log[$keyWeight], 2);
            $fermentables_grain .= "&nbsp;".$_SESSION['measWeight2'];
            $fermentables_grain .= "</td>" . "\n";
            $fermentables_grain .= "<td>";

            $grains_display = get_session_array_values($_SESSION['grains'],"maltName",$row_log[$keyName]);

            if (is_array($grains_display)) {

                $modal_body = "";

                // Build Modal
                $modal_body .= "<div class=\"modal fade\" id=\"grainsModal".$grains_display[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"grainsModalLabel".$grains_display[0]['id']."\">";
                $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
                $modal_body .= "<div class=\"modal-content\">";
                $modal_body .= "<div class=\"modal-header\">";
                $modal_body .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                $modal_body .= "<h4 class=\"modal-title\" id=\"grainsModalLabel".$grains_display[0]['id']."\">".$row_log[$keyName]."</h4>";
                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-body\">";

                if (!empty($grains_display[0]['maltLovibond'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Color:</strong></div>";
                    if (strpos($grains_display[0]['maltLovibond'], "-") !== false) {
                        $malt_lov_explodies = explode("-", $grains_display[0]['maltLovibond']);
                        $malt_lovibond = number_format($malt_lov_explodies[0],1)."-".number_format($malt_lov_explodies[1],1);
                    }
                    else $malt_lovibond = number_format($grains_display[0]['maltLovibond'],1);
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$malt_lovibond." ".$_SESSION['measColor']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltYield'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>PPG:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($grains_display[0]['maltYield'],1)."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltOrigin'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$grains_display[0]['maltOrigin']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltSupplier'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Supplier:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$grains_display[0]['maltSupplier']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                if (!empty($grains_display[0]['maltInfo'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$grains_display[0]['maltInfo']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_grain_display[] = 1;
                }

                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-footer\">";
                $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";

            }
            if (array_sum($fermentables_grain_display) > 0) $fermentables_grain .= "<a href=\"#grainsModal".$grains_display[0]['id']."\" data-toggle=\"modal\">".$row_log[$keyName]."</a>";
            else $fermentables_grain .= $row_log[$keyName];
            $fermentables_grain .= "</td>" . "\n";
            $fermentables_grain .= "<td>";
            if ($row_log[$keyWeight] != "") $fermentables_grain .= round($grainPer[$i], 1)."%";
            else  $fermentables_grain .= '&nbsp;';
            $fermentables_grain .= "</td>" . "\n";
            $fermentables_grain .= "</tr>" . "\n";

            if(!empty($modal_body)) $fermentables_grain_modals .= $modal_body;
        }
    }
} // end if (!empty($row_log['brewGrain1']))

// Adjuncts
if (!empty($row_log['brewAddition1'])) {
    for ($i = 0; $i < MAX_ADJ; $i++) {
        $fermentables_adjunct_display = array(0);
        $keyName   = 'brewAddition' . ($i + 1);
        $keyWeight = 'brewAddition' . ($i + 1) . 'Amt';
        if ($row_log[$keyName] != "") {

            $fermentables_adjunct .= "<tr>" . "\n";
            $fermentables_adjunct .= "<td>";
            if ($action == "scale") $fermentables_adjunct .= number_format(($row_log[$keyWeight] * $scale), 2);
            else $fermentables_adjunct .= number_format($row_log[$keyWeight], 2);
            $fermentables_adjunct .= "&nbsp;" . $_SESSION['measWeight2'] . "</td>" . "\n";

            $fermentables_adjunct .= "<td>";

            $adjunct_display = get_session_array_values($_SESSION['adjuncts'],"adjunctName",$row_log[$keyName]);

            if (is_array($adjunct_display)) {

                $modal_body = "";

                // Build Modal
                $modal_body .= "<div class=\"modal fade\" id=\"adjunctModal".$adjunct_display[0]['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"adjunctModalLabel".$adjunct_display[0]['id']."\">";
                $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
                $modal_body .= "<div class=\"modal-content\">";
                $modal_body .= "<div class=\"modal-header\">";
                $modal_body .= "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
                $modal_body .= "<h4 class=\"modal-title\" id=\"grainsModalLabel".$adjunct_display[0]['id']."\">".$row_log[$keyName]."</h4>";
                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-body\">";

                if (!empty($adjunct_display[0]['adjunctLovibond'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-xs-12 col-sm-3 col-md-3\"><strong>Color:</strong></div>";
                    if (strpos($adjunct_display[0]['adjunctLovibond'], "-") !== false) {
                        $adjunct_lov_explodies = explode("-", $adjunct_display[0]['adjunctLovibond']);
                        $adjunct_lovibond = number_format($adjunct_lov_explodies[0],1)."-".number_format($adjunct_lov_explodies[1],1);
                    }
                    else $adjunct_lovibond = number_format($adjunct_display[0]['adjunctLovibond'],1);
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-xs-12 col-sm-9 col-md-9\">".$adjunct_lovibond." ".$_SESSION['measColor']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctYield'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>PPG:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".number_format($adjunct_display[0]['adjunctYield'],1)."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctOrigin'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Origin:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$adjunct_display[0]['adjunctOrigin']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctSupplier'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Supplier:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$adjunct_display[0]['adjunctSupplier']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                if (!empty($adjunct_display[0]['adjunctInfo'])) {
                    $modal_body .= "<div class=\"row bb-account-info\">";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-3 col-md-3\"><strong>Info:</strong></div>";
                    $modal_body .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">".$adjunct_display[0]['adjunctInfo']."</div>";
                    $modal_body .= "</div>";
                    $fermentables_adjunct_display[] = 1;
                }

                $modal_body .= "</div>";
                $modal_body .= "<div class=\"modal-footer\">";
                $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">Close</button>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";
                $modal_body .= "</div>";

            }

            if (array_sum($fermentables_adjunct_display) > 0)  $fermentables_adjunct .= "<a href=\"#adjunctModal".$adjunct_display[0]['id']."\" data-toggle=\"modal\">".$row_log[$keyName]."</a>";
            else $fermentables_adjunct .= $row_log[$keyName];
            $fermentables_adjunct .= "</td>" . "\n";
            $fermentables_adjunct .= "</tr>" . "\n";
            if(!empty($modal_body)) $fermentables_grain_modals .= $modal_body;
        }
    }
}
*/



?>
