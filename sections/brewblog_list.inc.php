<?php
$show_archive = TRUE;
$thead = "";
$tbody = "";

if (($page == "brewblog-list") && (((isset($_SESSION['loginUsername'])) && ($row_log['brewBrewerID'] == $loginUsername)) || ((isset($_SESSION['loginUsername'])) && ($_SESSION['userLevel'] == "1")))) $admin_enable = TRUE;

// Build the table head elements
$thead .= "<tr>";
$thead .= "<th width=\"20%\">BrewBlog</th>";
$thead .= "<th>Date</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\" nowrap>Batch #</th>";
$thead .= "<th>Style</th>";
if ($page == "brewblog-list") $thead .= "<th class=\"hidden-xs hidden-sm\">Method</th>";
else $thead .= "<th class=\"hidden-xs hidden-sm\">Status</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\" nowrap>Batch Size</th>";
$thead .= "<th class=\"hidden-xs\">".$_SESSION['measColor']."</th>";
$thead .= "<th class=\"hidden-xs\">IBU</th>";
$thead .= "<th class=\"hidden-xs\">ABV</th>";
if ($page == "brewblog-list") $thead .= "<th><span class=\"hidden-md hidden-lg fa fa-trophy\"></span><span class=\"hidden-xs hidden-sm\">Awards</span></th>";
else $thead .= "<th>Actions</th>";
$thead .= "</tr>";

// Build the table body elements by looping through data returned from DB
do {

    if ($page == "brewblog-list" && $row_log['brewArchive'] == "Y") $show_archive = FALSE;

    if ($show_archive) {

        if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($row_log['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_log['brewStyle'],$prettify_url))), "detail", strtolower($row_log['brewBrewerID']), $row_log['id'], $base_url);
        else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_log['brewBrewerID'], $row_log['id'], $base_url);

        $award_count = 0;
        $method_status = "&nbsp;";
        $admin_enable_link = "";

        if ($page == "brewblog-list") {
            // Awards
            $award_count = award_count($page,$row_log['id']);
            if ($admin_enable) $admin_enable_link = "<a role=\"button\" data-toggle=\"collapse\" data-target=\"#collapseAdminMenu".$row_log['id']."\" aria-expanded=\"false\" aria-controls=\"collapseAdminMenu".$row_log['id']."\"><span class=\"fa fa-cog\"></span></a>";
            if ($row_log['brewMethod'] != "") $method_status = $row_log['brewMethod'];
        }

        else {
            if ($row_log['brewArchive'] == "Y") $admin_enable_link = "<span class=\"fa fa-archive\"></span>";
            if ($row_log['brewStatus'] != "") $method_status = $row_log['brewStatus'];
        }

        // Calculate ABV
        $abv = "";
        if (($row_log['brewOG'] != "") && ($row_log['brewFG'] != "")) $abv = number_format(calc_abv($row_log['brewOG'], $row_log['brewFG']), 1)."%";

        // Format bitterness
        $bitterness = "";
        if ($row_log['brewBitterness'] != "") $bitterness = number_format($row_log['brewBitterness'], 1);

        // Display color from SRM value
        $srm = "";
        if (!empty($row_log['brewLovibond'])) {
            if ($page == "logPrint" || $page == "recipePrint") $srm .= round($row_log['brewLovibond'], 1);
            else {
                $lovibond   = $row_log['brewLovibond'];
                if ($_SESSION['measColor'] == "EBC") $lovibond = ebc_to_srm($lovibond);
                $font_color = ($lovibond >= 14) ? "#ffffff" : "#000000";
                $bk_color   = get_display_color($lovibond);
                $srm_formatted = number_format($lovibond, 1);
                $srm .= "<span class=\"hidden\">".sprintf("%06s",$srm_formatted)."</span>";
                $srm .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bk_color ."; color: ".$font_color.";\">".$srm_formatted."</span>";
            }
        }

        if ($_SESSION['measFluid2'] == "gallons") $meas_fluid = "gal";
        if ($_SESSION['measFluid2'] == "liters") $meas_fluid = "li";

        include(INCLUDES.'admin_actions.inc.php');

        $tbody .= "<tr>";
        $tbody .= "<td>";
        $tbody .= "<a href=\"".$brewblog_link."\">".$row_log['brewName']."</a> ".$actions_links_export_beerXML.$admin_enable_link;
        if ($admin_enable) {
            $tbody .= "<div class=\"collapse\" id=\"collapseAdminMenu".$row_log['id']."\">";
            $tbody .= "Actions: ".$actions_links;
            $tbody .= "</div>";
        }
        $tbody .= "</td>";
        $tbody .= "<td nowrap>".dateconvert($row_log['brewDate'],3)."</td>";
        $tbody .= "<td class=\"hidden-xs hidden-sm\">".$row_log['brewBatchNum']."</td>";
        $tbody .= "<td>".$row_log['brewStyle']."</td>";
        $tbody .= "<td class=\"hidden-xs hidden-sm\">".$method_status."</td>";
        $tbody .= "<td class=\"hidden-xs hidden-sm\">".number_format($row_log['brewYield'],2)." ".$meas_fluid."</td>";
        $tbody .= "<td class=\"hidden-xs\">".$srm."</td>";
        $tbody .= "<td class=\"hidden-xs\">".$bitterness."</td>";
        $tbody .= "<td class=\"hidden-xs\">".$abv."</td>";
        if ($page == "brewblog-list") {
            $tbody .= "<td>";
            if ($award_count > 0) $tbody .= $award_count;
            $tbody .= "</td>";
        }
        else $tbody .= "<td>".$actions_links."</td>";
        $tbody .= "</tr>";

    }

} while ($row_log = mysqli_fetch_assoc($log));

?>
<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": "rfptip",
        "columns": [
            null,
            null,
            { "type": "natural", targets: 0 },
            null,
            null,
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            <?php if ($page == "admin") { ?>{ "orderable": false }<?php } else { ?>{ "type": "natural", targets: 0 }<?php } ?>
        ],
		"order": [[ 1, 'desc' ], [ 0, 'asc' ]],
		"pageLength": 50,
    } );
});
</script>
<table class="table table-striped" id="sortable">
<thead>
    <?php echo $thead; ?>
</thead>
<tbody>
	<?php echo $tbody; ?>
</tbody>
</table>