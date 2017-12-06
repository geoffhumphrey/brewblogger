<?php
$admin_enable = FALSE;
$show_archive = TRUE;
$thead = "";
$tbody = "";

if (($page == "recipe-list") && (((isset($_SESSION['loginUsername'])) && ($row_log['brewBrewerID'] == $loginUsername)) || ((isset($_SESSION['loginUsername'])) && ($_SESSION['userLevel'] == "1")))) $admin_enable = TRUE;

// Build the table head elements
$thead .= "<tr>";
$thead .= "<th width=\"20%\">Recipe</th>";
$thead .= "<th>Style</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\">Method</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\" nowrap>Batch Size</th>";
$thead .= "<th class=\"hidden-xs\">".$_SESSION['measColor']."</th>";
$thead .= "<th class=\"hidden-xs\">IBU</th>";
$thead .= "<th class=\"hidden-xs\">ABV</th>";
if ($page == "recipe-list") $thead .= "<th><span class=\"hidden-md hidden-lg fa fa-trophy\"></span><span class=\"hidden-xs hidden-sm\">Awards</span></th>";
else $thead .= "<th>Actions</th>";
$thead .= "</tr>";

do {

    if ($page == "recipe-list" && $row_log['brewArchive'] == "Y") $show_archive = FALSE;

    if ($show_archive) {

        // Get real user names
        if ($_SESSION['mode'] == "2") {
            /*
            // Get real user names
            $query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
            $user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
            $row_user2 = mysqli_fetch_assoc($user2);
            $totalRows_user2 = mysqli_num_rows($user2);

            // Awards
            $awardNewID = "r".$row_log['id'];
            $query_awards2 = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
            $awards2 = mysqli_query($connection,$query_awards2) or die (mysqli_error($connection));
            $row_awards2 = mysqli_fetch_assoc($awards2);
            $totalRows_awards2 = mysqli_num_rows($awards2);
            */
        }

        if (SEF) $recipe_link = build_public_url($destination, urlencode(strtolower(strtr($row_log['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_log['brewStyle'],$prettify_url))), "detail", strtolower($row_log['brewBrewerID']), $row_log['id'], $base_url);
        else $recipe_link = build_public_url($destination, "default", "default", "default", $row_log['brewBrewerID'], $row_log['id'], $base_url);

        $award_count = 0;
        $method = "&nbsp;";
        $actions_links = "";
        $admin_enable_link = "";
        if ($admin_enable) $admin_enable_link = "<a role=\"button\" data-toggle=\"collapse\" data-target=\"#collapseAdminMenu".$row_log['id']."\" aria-expanded=\"false\" aria-controls=\"collapseAdminMenu".$row_log['id']."\"><span class=\"fa fa-cog\"></span></a>";

        if ($row_log['brewMethod'] != "") $method = $row_log['brewMethod'];

        if ($page == "recipe-list") {
            // Awards
            $award_count = award_count($page,$row_log['id']);
            if ($admin_enable) $admin_enable_link = "<a role=\"button\" data-toggle=\"collapse\" data-target=\"#collapseAdminMenu".$row_log['id']."\" aria-expanded=\"false\" aria-controls=\"collapseAdminMenu".$row_log['id']."\"><span class=\"fa fa-cog\"></span></a>";
        }

        else {
            if ($row_log['brewArchive'] == "Y") $admin_enable_link = "<span class=\"fa fa-archive\"></span>";
        }

        $abv = "";
        if (($row_log['brewOG'] != "") && ($row_log['brewFG'] != "")) $abv = number_format(calc_abv($row_log['brewOG'], $row_log['brewFG']), 1)."%";

        $bitterness = "";
        if ($row_log['brewBitterness'] != "") $bitterness = number_format($row_log['brewBitterness'], 1);

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
        $tbody .= "<td width=\"30%\">";
        $tbody .= "<a href=\"".$recipe_link."\">".$row_log['brewName']."</a> ".$actions_links_export_beerXML.$admin_enable_link;
        if ($admin_enable) {
            $tbody .= "<div class=\"collapse\" id=\"collapseAdminMenu".$row_log['id']."\">";
            $tbody .= "Actions: ".$actions_links;
            $tbody .= "</div>";
        }
        $tbody .= "</td>";
        $tbody .= "<td>".$row_log['brewStyle']."</td>";
        $tbody .= "<td class=\"hidden-xs hidden-sm\">".$method."</td>";
        $tbody .= "<td class=\"hidden-xs hidden-sm\"><span class=\"hidden\">".sprintf("%06s",$row_log['brewYield'])."</span>".number_format($row_log['brewYield'],2)." ".$meas_fluid."</td>";
        $tbody .= "<td class=\"hidden-xs\">".$srm."</td>";
        $tbody .= "<td class=\"hidden-xs\">".$bitterness."</td>";
        $tbody .= "<td class=\"hidden-xs\">".$abv."</td>";
        if ($page == "recipe-list") {
            $tbody .= "<td>";
            if ($award_count > 0) $tbody .= $award_count;
            $tbody .= "</td>";
        }
        else $tbody .= "<td>".$actions_links."</td>";
        $tbody .= "</tr>";

    }

} while ($row_log = mysqli_fetch_assoc($log)); ?>











<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": 'rfptip',
        "columns": [
            null,
            null,
            null,
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            <?php if ($page == "admin") { ?>{ "orderable": false }<?php } else { ?>{ "type": "natural", targets: 0 }<?php } ?>
        ],
		"order": [[ 1, 'asc' ], [ 0, 'asc' ]],
		"pageLength": 50
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