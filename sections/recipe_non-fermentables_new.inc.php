<?php 

$non_fermentables_display = "";
$non_fermentables_display_table = "";

if (!empty($row_log['brewMiscs'])) {

    foreach ($non_fermentables as $key => $misc) {
        
        $non_fermentables_display .= "<div class=\"row mb-2\">";
        
        // Amount
        $non_fermentables_display .= "<div class=\"col-3 col-md-2 col-lg-1\">";
        
        if (isset($misc['AMOUNT'])) {
            
            if (isset($misc['DISPLAY_AMOUNT'])) {
                $non_explodies = explode(" ",$misc['DISPLAY_AMOUNT']);
                if ($action == "scale") $non_fermentables_display .= number_format(($non_explodies[0] * $scale),2)." ".$non_explodies[1];
                else $non_fermentables_display .= number_format($non_explodies[0],2)." ".$non_explodies[1];
            }
            
            elseif (is_numeric($misc['AMOUNT'])) $non_fermentables_display .= number_format($misc['AMOUNT'],2);
            
            else $non_fermentables_display .= $misc['AMOUNT'];

        }
        
        else {
            
            if (isset($misc['DISPLAY_AMOUNT'])) {
               $non_explodies = explode(" ",$misc['DISPLAY_AMOUNT']);
               if ($action == "scale") $non_fermentables_display .= number_format(($non_explodies[0] * $scale),2)." ".$non_explodies[1];
               else $non_fermentables_display .= number_format($non_explodies[0],2)." ".$non_explodies[1]; 
            }
            
            else $non_fermentables_display .= "--";
        }
        
        $non_fermentables_display .= "</div>";
        
        // Name and Type
        $non_fermentables_display .= "<div class=\"col-6 col-md-4 col-lg-4\">";
        
        if (isset($misc['NAME'])) {
            $non_fermentables_display .= "<strong>".h($misc['NAME'])."</strong>";
            if (isset($misc['TYPE'])) $non_fermentables_display .= " <span class=\"small text-body-secondary\">".h($misc['TYPE'])."</span>";
        }

        $non_fermentables_display .= "</div>";


        // Use
        $non_fermentables_display .= "<div class=\"col-3 col-md-6 col-lg-7\">";
        if (isset($misc['USE'])) $non_fermentables_display .= "<span class=\"me-1\">".h($misc['USE'])."</span>";
        if ((isset($misc['TIME'])) && (($misc['USE']) == "Boil")) $non_fermentables_display .= $misc['TIME']." min";
        $non_fermentables_display .= "</div>";
        
        $non_fermentables_display .= "</div>"; // end row

        /*
        // Table Display 
        $non_fermentables_display_table .= "<tr>";
        
        if (isset($misc['AMOUNT'])) {
            if (isset($misc['DISPLAY_AMOUNT'])) {
                $non_explodies = explode(" ",$misc['DISPLAY_AMOUNT']);
                if ($action == "scale") $non_fermentables_display_table .= "<td>".number_format(($non_explodies[0] * $scale),2)." ".$non_explodies[1]."</td>";
                else $non_fermentables_display_table .= "<td>".number_format($non_explodies[0],2)." ".$non_explodies[1]."</td>";
            }
            elseif (is_numeric($misc['AMOUNT'])) $non_fermentables_display_table .= "<td>".number_format($misc['AMOUNT'],2)."</td>";
            else $non_fermentables_display_table .= "<td>".$misc['AMOUNT']."</td>";
        }
        else $non_fermentables_display_table .= "<td>&nbsp;</td>";
        
        if (isset($misc['NAME'])) $non_fermentables_display_table .= "<td>".$misc['NAME']."</td>";
        else $non_fermentables_display_table .= "<td>&nbsp;</td>";

        if (isset($misc['TYPE'])) $non_fermentables_display_table .= "<td>".$misc['TYPE']."</td>";
        else $non_fermentables_display_table .= "<td>&nbsp;</td>";

        if (isset($misc['USE'])) $non_fermentables_display_table .= "<td>".$misc['USE']."</td>";
        else $non_fermentables_display_table .= "<td>&nbsp;</td>";

        if (isset($misc['TIME'])) $non_fermentables_display_table .= "<td>".$misc['TIME']." minutes</td>";
        else $non_fermentables_display_table .= "<td>&nbsp;</td>";

        $non_fermentables_display_table .= "</tr>";
        */
    
    }

?>

<h3>Non-Fermentables</h3>
<div class="mb-3">
<?php echo $non_fermentables_display; ?>
</div>

<!--
<table class="table table-striped">
	<thead>
    	<tr>
        	<th width="15%">Amount</th>
            <th>Non-Fermentable</th>
            <th>Type</th>
            <th>Use</th>
            <th width="15%">Time</th>
        </tr>
    </thead>
    <tbody>
        <?php //echo $non_fermentables_display_table; ?>
    </tbody>
</table>
-->
<?php } // end hide Misc  ?>


