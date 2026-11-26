<?php
/**
 * Module: recipe_fermentables.inc.php
 * Description: This module populates the extract, grain and adjunct sections of recipe viewing page.
 */

// Setup vars
$fermentables_modals = "";
$fermentables_display_table = "";
$fermentables_display = "";
$total_grist = 0;
$fermentable_count = 0;

$meas_weight_fermentables = convert_to_abbrev($_SESSION['measWeight2']);

$visual_backgrounds = array(
    "1" => "",
    "2" => "bg-secondary",
    "3" => "bg-primary",
    "4" => "bg-primary",
    "5" => "bg-primary",
    "6" => "bg-primary",
    "7" => "bg-primary",
    "8" => "bg-primary",
    "9" => "bg-primary",
    "10" => "bg-primary",
    "11" => "bg-primary",
    "12" => "bg-primary",
    "13" => "bg-primary",
    "14" => "bg-primary",
    "15" => "bg-primary",
    "16" => "bg-primary",
    "17" => "bg-primary",
    "18" => "bg-primary",
    "19" => "bg-primary",
    "20" => "bg-primary"
);

foreach ($fermentables as $key => $fermentable_amount) {
    if (is_numeric($fermentable_amount['AMOUNT'])) $total_grist += $fermentable_amount['AMOUNT'];
}

foreach ($fermentables as $key => $fermentable) {

    $fermentable_count++;

    $modal_body = "";
    $modal_data = "";
    $grains_data = "";
    $extract_data = "";
    $adjunct_data = "";
    $modal_display = 0;
    $grain_percentage = "";

    if (isset($fermentable['AMOUNT']) && ($fermentable['AMOUNT'] > 0)) {
        $grain_percentage = (($fermentable['AMOUNT'] / $total_grist) * 100);
        $grain_percentage = round($grain_percentage, 1);
    }

    /*
    // Fermentable Weight
    $fermentables_display_table .= "<tr>" . "\n";
    
    $fermentables_display_table .= '<td>';
    if (isset($fermentable['AMOUNT'])) {
        if ($action == "scale")  $fermentables_display_table .= number_format(($fermentable['AMOUNT'] * $scale), 2);
        else $fermentables_display_table .= number_format($fermentable['AMOUNT'], 2);
        $fermentables_display_table .= "&nbsp;".$_SESSION['measWeight2'];
    }
    else $fermentables_display_table .= "&nbsp;";
    $fermentables_display_table .= "</td>" . "\n";
    
    // Fermentable Name
    $fermentables_display_table .= "<td>";
    */


    if (isset($fermentable['NAME'])) {

        if ($fermentable['TYPE'] == "Grain") $grains_data = get_session_array_values($_SESSION['grains'],"maltName",$fermentable['NAME']);
        elseif (($fermentable['TYPE'] == "Extract") || ($fermentable['TYPE'] == "Dry Extract")) $extract_data = get_session_array_values($_SESSION['extracts'],"extractName",$fermentable['NAME']);
        else $adjunct_data = get_session_array_values($_SESSION['adjuncts'],"adjunctName",$fermentable['NAME']);

        if (!empty($grains_data)) {
            $modal_data = array(
                'id' => $grains_data[0]['id'],
                'name' => $grains_data[0]['maltName'],
                'color' => $grains_data[0]['maltLovibond'],
                'yield' => $grains_data[0]['maltYield'],
                'origin' => $grains_data[0]['maltOrigin'],
                'supplier' => $grains_data[0]['maltSupplier'],
                'type' => $grains_data[0]['maltType'],
                'info' => $grains_data[0]['maltInfo']
            );
        }

        elseif (!empty($extract_data)) {
            $modal_data = array(
                'id' => $extract_data[0]['id'],
                'name' => $extract_data[0]['extractName'],
                'color' => $extract_data[0]['extractLovibond'],
                'yield' => $extract_data[0]['extractYield'],
                'origin' => $extract_data[0]['extractOrigin'],
                'supplier' => $extract_data[0]['extractSupplier'],
                'type' => $extract_data[0]['extractType'],
                'info' => $extract_data[0]['extractInfo']
            );
        }

        elseif (!empty($adjunct_data)) {
            $modal_data = array(
                'id' => $adjunct_data[0]['id'],
                'name' => $adjunct_data[0]['adjunctName'],
                'color' => $adjunct_data[0]['adjunctLovibond'],
                'yield' => $adjunct_data[0]['adjunctYield'],
                'origin' => $adjunct_data[0]['adjunctOrigin'],
                'supplier' => $adjunct_data[0]['adjunctSupplier'],
                'type' => $adjunct_data[0]['adjunctType'],
                'info' => $adjunct_data[0]['adjunctInfo']
            );
        }

        else {
            $modal_data = array();
            $modal_data['id'] = mt_rand(100000,999999);
            $modal_data['name'] = $fermentable['NAME'];
            if ((isset($fermentable['COLOR'])) && (!empty($fermentable['COLOR']))) $modal_data['color'] = $fermentable['COLOR'];
            if ((isset($fermentable['YIELD'])) && (!empty($fermentable['YIELD']))) $modal_data['yield'] = $fermentable['YIELD'];
            if ((isset($fermentable['ORIGIN'])) && (!empty($fermentable['ORIGIN']))) $modal_data['origin'] = $fermentable['ORIGIN'];
            if ((isset($fermentable['SUPPLIER'])) && (!empty($fermentable['SUPPLIER']))) $modal_data['supplier'] = $fermentable['SUPPLIER'];
            if ((isset($fermentable['TYPE'])) && (!empty($fermentable['TYPE']))) $modal_data['type'] = $fermentable['TYPE'];
            if ((isset($fermentable['INFO'])) && (!empty($fermentable['INFO']))) $modal_data['info'] = $fermentable['INFO'];
        }

        if (is_array($modal_data)) {

            $collapse_body = "";

            // Build show/hide
            $collapse_body .= "<section class=\"collapse mt-2 small text-primary-emphasis bg-primary-subtle border border-primary-subtle rounded-1 p-3\" id=\"grains-collapse-".h($modal_data['id'])."\">";
            $collapse_body .= "<div class=\"row row-cols-10 g-1\">";

            if (!empty($modal_data['type'])) {
                $collapse_body .= "<div class=\"col\">";
                $collapse_body .= "<div class=\"row\">";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-4 col-xl-3\"><strong>Type</strong></div>";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-8 col-xl-9\">".h($modal_data['type'])."</div>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['origin'])) {
                $collapse_body .= "<div class=\"col\">";
                $collapse_body .= "<div class=\"row\">";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-4 col-xl-3\"><strong>Origin</strong></div>";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-8 col-xl-9\">".h($modal_data['origin'])."</div>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['color'])) {

                $collapse_body .= "<div class=\"col\">";
                $collapse_body .= "<div class=\"row\">";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-4 col-xl-3\"><strong>Color</strong></div>";
                
                // Color may be a single value or a range (e.g., "5.0-6.0"); BeerXML stores it in Lovibond/SRM
                $lov_parts = array_map('floatval', explode("-", $modal_data['color']));
                $lov_value = array_sum($lov_parts) / count($lov_parts); // Midpoint of a range drives the swatch color
                if ($_SESSION['measColor'] == "EBC") $lov_parts = array_map('srm_to_ebc', $lov_parts);
                $lovibond = implode("-", array_map(function($lov) { return number_format($lov,1); }, $lov_parts));

                $fontColor = ($lov_value >= 15) ? "#ffffff" : "#000000";
                $bkColor = get_display_color($lov_value);
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-8 col-xl-9\">";
                $collapse_body .= $lovibond." ".$_SESSION['measColor'];
                $collapse_body .= "<span class=\"d-none d-lg-inline\"><span class=\"fa-stack ms-1\">";
                $collapse_body .= "<i class=\"fa-solid fa-circle fa-stack-2x\" style=\"color: ".$bkColor."\"></i>";
                $collapse_body .= "<i class=\"fa-solid fa-wheat-awn fa-stack-1x\" style=\"color: ".$fontColor."\"></i>";
                $collapse_body .= "</span></span>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $modal_display++;
                              
                              
                            
            }

            if (!empty($modal_data['yield'])) {
                $collapse_body .= "<div class=\"col\">";
                $collapse_body .= "<div class=\"row\">";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-4 col-xl-3\"><strong>PPG</strong></div>";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-8 col-xl-9\">".number_format($modal_data['yield'],1)."</div>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['info'])) {
                $collapse_body .= "<div class=\"col\">";
                $collapse_body .= "<div class=\"row\">";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-4 col-xl-3\"><strong>Info</strong></div>";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-8 col-xl-9\">".h($modal_data['info'])."</div>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $modal_display++;
            }

            /*
            if (!empty($modal_data['supplier'])) {
                $collapse_body .= "<div class=\"col\">";
                $collapse_body .= "<div class=\"row\">";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-4 col-xl-3\"><strong>Supplier</strong></div>";
                $collapse_body .= "<div class=\"col-12 col-md-6 col-lg-8 col-xl-9\">".$modal_data['supplier']."</div>";
                $collapse_body .= "</div>";
                $collapse_body .= "</div>";
                $modal_display++;
            }
            */

            $collapse_body .= "</div>";
            $collapse_body .= "</section>";

            /*
            // Build Modal
            $modal_body .= "<div class=\"modal fade\" id=\"grainsModal".$modal_data['id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"grainsModalLabel".$modal_data['id']."\">";
            $modal_body .= "<div class=\"modal-dialog\" role=\"document\">";
            $modal_body .= "<div class=\"modal-content\">";
            $modal_body .= "<div class=\"modal-header\">";
            $modal_body .= "<h5 class=\"modal-title\" id=\"grainsModalLabel".$modal_data['id']."\">".$modal_data['name']."</h5>";
            $modal_body .= "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>";
            $modal_body .= "</div>";
            $modal_body .= "<div class=\"modal-body\">";
        
            if (!empty($modal_data['color'])) {
                $modal_body .= "<div class=\"row\">";
                $modal_body .= "<div class=\"col-3\"><strong>Color</strong></div>";
                if (strpos($modal_data['color'], "-") !== false) {
                    $lov_explodies = explode("-", $modal_data['color']);
                    $lovibond = number_format($lov_explodies[0],1)."-".number_format($lov_explodies[1],1);
                }
                else $lovibond = number_format($modal_data['color'],1);
                $modal_body .= "<div class=\"col-9\">".$lovibond." ".$_SESSION['measColor']."</div>";
                $modal_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['yield'])) {
                $modal_body .= "<div class=\"row\">";
                $modal_body .= "<div class=\"col-3\"><strong>PPG</strong></div>";
                $modal_body .= "<div class=\"col-9\">".number_format($modal_data['yield'],1)."</div>";
                $modal_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['origin'])) {
                $modal_body .= "<div class=\"row\">";
                $modal_body .= "<div class=\"col-3\"><strong>Origin</strong></div>";
                $modal_body .= "<div class=\"col-9\">".$modal_data['origin']."</div>";
                $modal_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['supplier'])) {
                $modal_body .= "<div class=\"row\">";
                $modal_body .= "<div class=\"col-3\"><strong>Supplier</strong></div>";
                $modal_body .= "<div class=\"col-9\">".$modal_data['supplier']."</div>";
                $modal_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['type'])) {
                $modal_body .= "<div class=\"row\">";
                $modal_body .= "<div class=\"col-3\"><strong>Type</strong></div>";
                $modal_body .= "<div class=\"col-9\">".$modal_data['type']."</div>";
                $modal_body .= "</div>";
                $modal_display++;
            }

            if (!empty($modal_data['info'])) {
                $modal_body .= "<div class=\"row\">";
                $modal_body .= "<div class=\"col-3\"><strong>Info</strong></div>";
                $modal_body .= "<div class=\"col-9\">".$modal_data['info']."</div>";
                $modal_body .= "</div>";
                $modal_display++;
            }

            $modal_body .= "</div>";
            $modal_body .= "<div class=\"modal-footer\">";
            $modal_body .= "<button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Close</button>";
            $modal_body .= "</div>";
            $modal_body .= "</div>";
            $modal_body .= "</div>";
            $modal_body .= "</div>";
            */

        }

        $fermentables_display .= "<div class=\"row\">";
        $fermentables_display .= "<div class=\"col-xs-12 col-sm-9 col-md-9\">";

        $grain_percentage_label = "";
        if ($grain_percentage >= 3.5) $grain_percentage_label = $grain_percentage."%";

        if ((!empty($collapse_body)) && ($modal_display > 0)) {

            /*
            $fermentables_display_table .= "<strong><a href=\"#grainsModal".$modal_data['id']."\" data-bs-toggle=\"modal\">";
            $fermentables_display_table .= $fermentable['NAME'];
            $fermentables_display_table .= "</a></strong>";
            if ((isset($fermentable['SUPPLIER'])) && (!empty($fermentable['SUPPLIER']))) $fermentables_display_table .= " <small>".$fermentable['SUPPLIER']."</small>";
            */

            $fermentables_display .= "<a data-bs-toggle=\"collapse\" href=\"#grains-collapse-".h($modal_data['id'])."\" role=\"button\" aria-expanded=\"false\" aria-controls=\"collapseExample\"><i class=\"me-1 fa fa-info-circle fa-fw\"></i><strong></a>".h($fermentable['NAME'])."</strong>";
            // $fermentables_display .= "<strong><a href=\"#grainsModal".$modal_data['id']."\" data-bs-toggle=\"modal\">".$fermentable['NAME']."</a></strong>";
            
        }

        else {

            $fermentables_display .= "<strong>".h($fermentable['NAME'])."</strong>";
            /*
            $fermentables_display_table .= "<strong>".$fermentable['NAME']."</strong>";
            if ((isset($fermentable['SUPPLIER'])) && (!empty($fermentable['SUPPLIER']))) $fermentables_display_table .= " <small>".$fermentable['SUPPLIER']."</small>";
            */
        
        }

        if (isset($fermentable['SUPPLIER'])) $fermentables_display .= "<small class=\"ms-2 text-body-secondary\">".h($fermentable['SUPPLIER'])."</small>"; // if (isset($fermentable['SUPPLIER']))
        $fermentables_display .= "</div>"; 
        
        $fermentables_display .= "<div class=\"col-xs-12 col-sm-3 col-md-3\">";
        if (isset($fermentable['AMOUNT'])) {
            $fermentables_display .= "<span class=\"float-lg-end\">";
            
            if (is_numeric($fermentable['AMOUNT'])) {
                if ($action == "scale")  $fermentables_display .= number_format(($fermentable['AMOUNT'] * $scale), 2);
                else $fermentables_display .= number_format($fermentable['AMOUNT'], 2);
                $fermentables_display .= "&nbsp;<span class=\"small text-body-secondary\">".$meas_weight_fermentables."</span>";
                $fermentables_display .= "<span class=\"ms-1 me-1 small text-body-secondary\">|</span>".$grain_percentage."%";
                $fermentables_display .= "</span>";
            }

            else {
                $fermentables_display .= $fermentable['AMOUNT'];
            }
            
        }
        $fermentables_display .= "</div>";
        $fermentables_display .= "</div>";

        $fermentables_display .= $collapse_body;

        $fermentables_display .= "<div class=\"progress mt-2 mb-3\" role=\"progressbar\" aria-label=\"\" aria-valuenow=\"".$grain_percentage."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"height: 25px\">";
        $fermentables_display .= "<div class=\"progress-bar bg-secondary\" style=\"width: ".$grain_percentage."%\"><span class=\"d-none d-md-block\">".$grain_percentage_label."</span></div>";
        $fermentables_display .= "</div>";

    }

    else $fermentables_display_table .= "&nbsp;";
    $fermentables_display_table .= "</td>" . "\n";
    
    // Grist Percentage
    $fermentables_display_table .= "<td>";    
    if (isset($fermentable['AMOUNT']) && ($fermentable['AMOUNT'] > 0)) {
        $fermentables_display_table .= round ($grain_percentage, 1) . "%";
    }
    else  $fermentables_display_table .= "&nbsp;";
    $fermentables_display_table .= "</td>" . "\n";
    
    $fermentables_display_table .= "</tr>" . "\n";

    if(!empty($modal_body)) $fermentables_modals .= $modal_body;

}

if (!empty($fermentables_modals)) echo $fermentables_modals;
?>

<h3><a name="recipe" id="recipe"></a>Fermentables</h3>

<div class="mb-3">
<?php echo $fermentables_display; ?>
</div>

<!--
<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Fermentable</th>
            <th width="15%">%<span  class="hidden-xs hidden-sm"> of Grist</span></th>
        </tr>
    </thead>
    <tbody>
    <?php // echo $fermentables_display; ?>
    </tbody>
    <tfoot>
    	<tr>
    		<th width="15%"><?php if ($action == "scale") echo number_format($total_grist*$scale,2); else echo number_format($total_grist,2); echo " ".$_SESSION['measWeight2']; ?></td>
    		<th>Total Fermentable Weight</td>
    		<th width="15%">100%</td>
    	</tr>
    </tfoot>
</table>
-->