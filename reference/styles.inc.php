<h2>BJCP Styles</h2>
<script>
$(document).ready( function () {
    $('#styles').DataTable({
		 "order": [[0,'asc'],[1,'asc']],
		 "paging": true,
		 "lengthChange": false,
		 "pageLength": 75,
		 "dom": 'fptp',
		 "columns": [
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null
		  ]
	});
} );
</script>
<table class="table table-striped table-bordered" id="styles">
	<thead>
    <tr>
    	<th>Set</th>
        <th>#</th>
    	<th class="min-15">Style</th>
        <th class="min-15 hidden-xs hidden-sm">Category</th>
        <th class="hidden-xs hidden-sm">ABV</th>
        <th class="hidden-xs hidden-sm">IBUs</th>
        <th class="hidden-xs hidden-sm">Color</th>
        <th class="hidden-xs hidden-sm">OG</th>
        <th class="hidden-xs hidden-sm">FG</th>
        <th class="max-30">Description</th>
    </tr>
    </thead>
    <tbody>
<?php do {

// Category Name
$categoryName = style_category($row_styles['brewStyleGroup'],$row_styles['brewStyleVersion']);

// Color
if ($row_styles['brewStyleSRM'] == "") $SRM = "Varies";
elseif ($row_styles['brewStyleSRM'] == "N/A") $SRM = "N/A";
elseif ($row_styles['brewStyleSRM'] != "") {
	$SRMmin = ltrim ($row_styles['brewStyleSRM'], "0");
	$SRMmax = ltrim ($row_styles['brewStyleSRMMax'], "0");
	if ($SRMmin >= "15") $color1 = "#ffffff"; else $color1 = "#000000";
	if ($SRMmax >= "15") $color2 = "#ffffff"; else $color2 = "#000000";
		$SRM = "";
		$SRM .= "<span class=\"badge\" style=\"background-color: ".srm_color($SRMmin,"srm")."; color: ".$color1."\">".$SRMmin."</span>";
		if (!empty($row_styles['brewStyleSRMMax'])) {
			$SRM .= " - ";
			$SRM .= "<span class=\"badge\" style=\"background-color: ".srm_color($SRMmax,"srm")."; color: ".$color2."\">".$SRMmax."</span>";
		}
}
else $SRM = "&nbsp;";

if ($row_styles['brewStyleABV'] == "") $ABV = "Varies";
elseif ($row_styles['brewStyleABV'] != "" ) $ABV = number_format((float)$row_styles['brewStyleABV'], 1, '.', '')."% - ".number_format((float)$row_styles['brewStyleABVMax'], 1, '.', '')."%";
else $ABV = "&nbsp;";

// IBUs
if ($row_styles['brewStyleIBU'] == "")  $IBU = "Varies";
elseif ($row_styles['brewStyleIBU'] == "N/A") $IBU = "N/A";
elseif ($row_styles['brewStyleIBU'] != "") $IBU = ltrim($row_styles['brewStyleIBU'], "0")." - ".ltrim($row_styles['brewStyleIBUMax'], "0")." IBU";
else $IBU = "&nbsp;";

// OG
if ($row_styles['brewStyleOG'] == "") $OG = "Varies";
elseif ($row_styles['brewStyleOG'] != "") $OG = number_format((float)$row_styles['brewStyleOG'], 3, '.', '')." - ".number_format((float)$row_styles['brewStyleOGMax'], 3, '.', '');
else $OG = "&nbsp;";

// FG
if ($row_styles['brewStyleFG'] == "") $FG = "Varies";
elseif ($row_styles['brewStyleFG'] != "") $FG = number_format((float)$row_styles['brewStyleFG'], 3, '.', '')." - ".number_format((float)$row_styles['brewStyleFGMax'], 3, '.', '');
else $FG = "&nbsp;";

// Info/Description
$replacement1 = array('must specify','may specify','MUST specify','MAY specify','must provide');
$replacement2 = array('<u>MUST</u> specify','<u>MAY</u> specify','<u>MUST</u> specify','<u>MAY</u> specify','<u>MUST</u> provide');

$info = $row_styles['brewStyleInfo'];
if (!empty($row_styles['brewStyleComEx'])) $comEx = "<strong class=\"text-info\">Commercial Examples:</strong> ".$row_styles['brewStyleComEx']; else $comEx = "";
if (!empty($row_styles['brewStyleEntry'])) $entryReq = "<strong class=\"text-danger\">Entry Instructions:</strong> ".str_replace($replacement1,$replacement2,$row_styles['brewStyleEntry']); else $entryReq = "";

?>
    <tr>
    	<td class="min-15"><?php echo str_replace("BJCP","BJCP ",$row_styles['brewStyleVersion']); ?></td>
    	<!-- Number -->
    	<td><?php echo $row_styles['brewStyleGroup'].$row_styles['brewStyleNum']; ?></td>
        <!-- Style Name -->
        <td class="min-15"><?php echo $row_styles['brewStyle']; ?></td>
        <!-- Overall Category Name -->
        <td class="hidden-xs hidden-sm"><?php echo $categoryName; ?></td>
        <!-- ABV -->
        <td class="hidden-xs hidden-sm" nowrap><?php echo $ABV; ?></td>
        <!--IBUs -->
        <td class="hidden-xs hidden-sm" nowrap><?php echo $IBU; 	?></td>
        <!-- Color -->
        <td class="hidden-xs hidden-sm" nowrap><?php echo $SRM; ?></td>
        <!-- OG -->
        <td class="hidden-xs hidden-sm" nowrap><?php echo $OG; ?></td>
        <!-- FG -->
        <td class="hidden-xs hidden-sm" nowrap><?php echo $FG; ?></td>
        <td>
		<?php
		echo "<p>";
		echo $info;
		if (!empty($comEx)) echo "<br>".$comEx;
		if (!empty($entryReq)) echo "<br>".$entryReq;
		echo "</p>";
		?>
		</td>
	</tr>
<?php } while ($row_styles = mysqli_fetch_assoc($styles)); ?>
	</tbody>
</table>