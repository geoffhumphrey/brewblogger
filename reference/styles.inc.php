<?php
$thead = "";
$tbody = "";

$thead .= "<tr>";
$thead .= "<th>Set</th>";
$thead .= "<th>#</th>";
$thead .= "<th class=\"min-15\">Style</th>";
$thead .= "<th class=\"min-15 hidden-xs hidden-sm\">Category</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\">ABV</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\">IBUs</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\">Color</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\">OG</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\">FG</th>";
$thead .= "<th class=\"max-30\">Description</th>";
$thead .= "</tr>";

if ($filter == "bjcp2008") $style_set = $_SESSION['styles2008'];
if ($filter == "bjcp2015") $style_set = $_SESSION['styles2015'];
if ($filter == "all") $style_set = array_merge($_SESSION['styles2008'],$_SESSION['styles2015']);

foreach ($style_set as $row_styles) {

    // Category Name
    $categoryName = style_category($row_styles['brewStyleGroup'],$row_styles['brewStyleVersion']);

    // Color
    if (empty($row_styles['brewStyleSRM'])) $SRM = "Varies";
    elseif ($row_styles['brewStyleSRM'] == "N/A") $SRM = "N/A";
    elseif (!empty($row_styles['brewStyleSRM'])) {
        $SRMmin = ltrim ($row_styles['brewStyleSRM'], "0");
        $SRMmax = ltrim ($row_styles['brewStyleSRMMax'], "0");
        if ($SRMmin >= "15") $color1 = "#ffffff"; else $color1 = "#000000";
        if ($SRMmax >= "15") $color2 = "#ffffff"; else $color2 = "#000000";
            $SRM = "";
            $SRM .= "<span class=\"badge\" style=\"background-color: ".srm_color($SRMmin,"srm")."; color: ".$color1."\">".number_format($SRMmin,1)."</span>";
            if (!empty($row_styles['brewStyleSRMMax'])) {
                $SRM .= " - ";
                $SRM .= "<span class=\"badge\" style=\"background-color: ".srm_color($SRMmax,"srm")."; color: ".$color2."\">".number_format($SRMmax,1)."</span>";
            }
    }
    else $SRM = "&nbsp;";

    if (empty($row_styles['brewStyleABV'])) $ABV = "Varies";
    else $ABV = number_format((float)$row_styles['brewStyleABV'], 1, '.', '')."% - ".number_format((float)$row_styles['brewStyleABVMax'], 1, '.', '')."%";

    // IBUs
    if (empty($row_styles['brewStyleIBU']))  $IBU = "Varies";
    elseif ($row_styles['brewStyleIBU'] == "N/A") $IBU = "N/A";
    else $IBU = ltrim($row_styles['brewStyleIBU'], "0")." - ".ltrim($row_styles['brewStyleIBUMax'], "0")." IBU";

    // OG
    if (empty($row_styles['brewStyleOG'])) $OG = "Varies";
    else $OG = number_format((float)$row_styles['brewStyleOG'], 3, '.', '')." - ".number_format((float)$row_styles['brewStyleOGMax'], 3, '.', '');

    // FG
    if (empty($row_styles['brewStyleFG'])) $FG = "Varies";
    else $FG = number_format((float)$row_styles['brewStyleFG'], 3, '.', '')." - ".number_format((float)$row_styles['brewStyleFGMax'], 3, '.', '');

    // Info/Description
    $replacement1 = array('must specify','may specify','MUST specify','MAY specify','must provide');
    $replacement2 = array('<u>MUST</u> specify','<u>MAY</u> specify','<u>MUST</u> specify','<u>MAY</u> specify','<u>MUST</u> provide');

    $info = $row_styles['brewStyleInfo'];
    if (!empty($row_styles['brewStyleComEx'])) $comEx = "<strong class=\"text-info\">Commercial Examples:</strong> ".$row_styles['brewStyleComEx']; else $comEx = "";
    if (!empty($row_styles['brewStyleEntry'])) $entryReq = "<strong class=\"text-danger\">Entry Instructions:</strong> ".str_replace($replacement1,$replacement2,$row_styles['brewStyleEntry']); else $entryReq = "";

    $tbody .= "<tr>";
    $tbody .= "<td class=\"min-15\">".str_replace("BJCP","BJCP ",$row_styles['brewStyleVersion'])."</td>";
    $tbody .= "<td>".$row_styles['brewStyleGroup'].$row_styles['brewStyleNum']."</td>";
    $tbody .= "<td class=\"min-15\">".$row_styles['brewStyle']."</td>";
    $tbody .= "<td class=\"min-15\">".$categoryName."</td>";
    $tbody .= "<td class=\"hidden-xs hidden-sm\" nowrap>".$ABV."</td>";
    $tbody .= "<td class=\"hidden-xs hidden-sm\" nowrap>".$IBU."</td>";
    $tbody .= "<td class=\"hidden-xs hidden-sm\" nowrap>".$SRM."</td>";
    $tbody .= "<td class=\"hidden-xs hidden-sm\" nowrap>".$OG."</td>";
    $tbody .= "<td class=\"hidden-xs hidden-sm\" nowrap>".$FG."</td>";
    $tbody .= "<td>";
    $tbody .= $info;
    if (!empty($comEx)) $tbody .= "<br>".$comEx;
    if (!empty($entryReq)) $tbody .= "<br>".$entryReq;
    $tbody .= "</td>";
    $tbody .= "</tr>";
}

?>
<h2>BJCP Styles</h2>
<script>
$(document).ready( function () {
    $('#styles').DataTable({
		 "order": [[0,'asc'],[1,'asc']],
		 "paging": true,
		 "lengthChange": false,
		 "pageLength": 50,
		 "dom": 'fptp',
		 "columns": [
			null,
            null,
            null,
			{ "type": "natural", targets: 0 },
			{ "type": "natural", targets: 0 },
			{ "type": "natural", targets: 0 },
			{ "type": "natural", targets: 0 },
			{ "type": "natural", targets: 0 },
			null,
			null
		  ]
	});
} );
</script>
<table class="table table-striped table-bordered" id="styles">
	<thead>
    <?php echo $thead; ?>
    </thead>
    <tbody>
    <?php echo $tbody; ?>
	</tbody>
</table>