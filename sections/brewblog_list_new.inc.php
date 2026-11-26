<?php
$admin_enable = FALSE;
if ((isset($_SESSION['loginUsername'])) && ($_SESSION['userLevel'] == "1")) $admin_enable = TRUE;

function calculateMean($arr) {
    if (empty($arr)) {
        throw new Exception("Empty array");
    }
    return array_sum($arr) / count($arr);
}

function calculateMedian($arr) {
    $count = count($arr); //total numbers in array
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
        $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
        $low = $arr[$middleval];
        $high = $arr[$middleval+1];
        $median = (($low+$high)/2);
    }
    return $median;
}

// unset($_SESSION['brewblog-list']);
$reset_brewblog_session = FALSE;

$query_brewlog_count = "SELECT COUNT(*) as 'count' FROM brewblogs";
$brewlog_count = mysqli_query($connection,$query_brewlog_count) or die (mysqli_error($connection));
$row_brewlog_count = mysqli_fetch_assoc($brewlog_count);

if ((!isset($_SESSION['brewblog-list'])) || (empty($_SESSION['brewblog-list']))) {

    $brewblog_count = 0;

    if ((($_SESSION['mode'] == "2") && ($filter == "all")) || ($_SESSION['mode'] == "1")) {
        $query_log = "SELECT * FROM brewblogs ORDER BY id ASC";
        if ($style != "all") $view == "all";
    }

    if (($_SESSION['mode'] == "2") && ($filter != "all")) {
        $query_log = sprintf("SELECT * FROM brewblogs WHERE brewBrewerID = '%s'", $filter);
    }

    $log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
    $row_log = mysqli_fetch_assoc($log);
    $totalRows_log = mysqli_num_rows($log);

    $brew_list = array();

    do {

        $brewblog_count++;
        
        $brew_list[] = array(
            "id" => $row_log['id'],
            "brewName" => $row_log['brewName'],
            "brewStyle" => $row_log['brewStyle'],
            "brewOG" => $row_log['brewOG'],
            "brewFG" => $row_log['brewFG'],
            "brewIBU" => $row_log['brewIBU'],
            "brewMethod" => $row_log['brewMethod'],
            "brewColor" => $row_log['brewColor'],
            "brewArchive" => $row_log['brewArchive'],
            "brewStatus" => $row_log['brewStatus'],
            "brewBatchNum" => $row_log['brewBatchNum'],
            "brewBrewerID" => $row_log['brewBrewerID'],
            "brewBatchSize" => $row_log['brewBatchSize'],
            "brewDate" => $row_log['brewDate'] 
        );

    } while ($row_log = mysqli_fetch_assoc($log));

    $_SESSION['brewblog-list'] = $brew_list;
    $_SESSION['brewblog-count'] = $brewblog_count;

}

if (!isset($_SESSION['brewblog-count'])) $brewblog_count_check = 0;
if (isset($_SESSION['brewblog-count'])) $brewblog_count_check = $_SESSION['brewblog-count'];

// echo $brewblog_count_check."<br>".$row_brewlog_count['count']; exit();

if ($row_brewlog_count['count'] > $brewblog_count_check) {
    unset($_SESSION['brewblog-list']);
    header(sprintf("Location: %s", $_SERVER['PHP_SELF']));
}

$batch_no_count = 0;
$gallon_count = 0;
$awards_count = 0;
$styles_brewed = array();
$brew_dates = array();
$award_dates = array();
$average_abv = array();
$average_ibu = array();

if ($_SESSION['measFluid2'] == "gallons") $meas_fluid = "Gal";
if ($_SESSION['measFluid2'] == "liters") $meas_fluid = "Li";

$thead = "";
$tbody = "";

// Build the table head elements
$thead .= "<tr>";
//$thead .= "<th>XML</th>";
$thead .= "<th width=\"20%\">BrewBlog</th>";
$thead .= "<th>Date</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\" nowrap>Batch # (Overall)</th>";
$thead .= "<th>Style</th>";
// $thead .= "<th class=\"hidden-xs hidden-sm\">Status</th>";
$thead .= "<th class=\"hidden-xs hidden-sm\" nowrap>Batch Size (All) ".ucfirst($meas_fluid)."</th>";
$thead .= "<th class=\"hidden-xs\">".$_SESSION['measColor']."</th>";
$thead .= "<th class=\"hidden-xs\">IBU</th>";
$thead .= "<th class=\"hidden-xs\">ABV</th>";
if ($page == "brewblog-list") $thead .= "<th nowrap><span class=\"fa fa-trophy\"></span><span class=\"hidden-xs hidden-sm\"> (All)</span></th>";
else $thead .= "<th>Actions</th>";
$thead .= "</tr>";

// Build the table body elements by looping through data returned from DB
foreach ($_SESSION['brewblog-list'] as $key => $row_log) {

    $show_archive = TRUE; 

    if ($page == "brewblog-list" && $row_log['brewArchive'] == "Y") $show_archive = FALSE;

    if ($show_archive) {

        $brew_dates[] = $row_log['brewDate'];

        $batch_no_count++;

        $style = "No Style Selected";
        if (isset($row_log['brewStyle'])) {
            $style_json = json_decode($row_log['brewStyle'],true);
            if (isset($style_json['NAME'])) $style = $style_json['NAME'];
            $styles_brewed[] = $style;
        }

        $link_log_name = pathauto_cleanstring($row_log['brewName']);
        $link_style_name = pathauto_cleanstring($style);

        if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($link_log_name,$prettify_url))), urlencode(strtolower(strtr($link_style_name,$prettify_url))), "detail", strtolower($row_log['brewBrewerID']), $row_log['id'], $base_url);
        else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_log['brewBrewerID'], $row_log['id'], $base_url);

        $award_count = 0;
        $method_status = "&nbsp;";
        $admin_enable_link = "";

        if (($page == "brewblog-list") || ($page == "admin")) {
            // Awards
            $award_count = award_count($page,$row_log['id']);
            if ($award_count > 0) $award_dates[] = $row_log['brewDate'];
            if ($admin_enable) $admin_enable_link = "<a class=\"me-2\" href=\"\" role=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapseAdminMenu".$row_log['id']."\" aria-expanded=\"false\" aria-controls=\"collapseAdminMenu".$row_log['id']."\"><i class=\"fa fa-fw fa-cog\"></i></a>";
            if ($row_log['brewMethod'] != "") $method_status = $row_log['brewMethod'];
        }

        else {
            if ($row_log['brewArchive'] == "Y") $admin_enable_link = "<span class=\"fa fa-fw fa-archive\"></span>&nbsp;";
            if ($row_log['brewStatus'] != "") $method_status = $row_log['brewStatus'];
        }

        // Calculate ABV
        $abv = "";
        if (($row_log['brewOG'] != "") && ($row_log['brewFG'] != "")) {
            $abv = number_format(calc_abv($row_log['brewOG'], $row_log['brewFG']), 1);
            if ($abv > 0) $average_abv[] = $abv;
        }

        // Format bitterness
        $bitterness = "";
        if ($row_log['brewIBU'] != "") {
            $bitterness = number_format($row_log['brewIBU'], 1);
            if ($bitterness > 0) $average_ibu[] = $bitterness;
        }

        // Display color from SRM value
        $srm = "";
        if (!empty($row_log['brewColor'])) {
            if ($page == "logPrint" || $page == "recipePrint") $srm .= round($row_log['brewColor'], 1);
           
            else {
                
                $lovibond   = $row_log['brewColor'];
                if ($_SESSION['measColor'] == "EBC") $lovibond = ebc_to_srm($lovibond);
                
                $bk_color = get_display_color($lovibond);
                $srm_formatted = number_format($lovibond, 1);
                $srm .= "<span class=\"visually-hidden\">".sprintf("%06s",$srm_formatted)."</span>";
                $srm .= " <i class=\"fa fa-lg fa-glass-water\" style=\"color: ". $bk_color .";\"></i>";
                $srm .= "<span class=\"ms-2\">".$srm_formatted."</span>";

                // $font_color = ($lovibond >= 14) ? "#ffffff" : "#000000";
                // $srm .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bk_color ."; color: ".$font_color.";\">".$srm_formatted."</span>";
            
            }
        
        }

        if (($admin_enable) || ($page == "admin")) include (INCLUDES.'admin_actions_new.inc.php');

        //$gallon_count = $row_log['brewBatchSize'] + $gallon_count;
        //$awards_count = $award_count + $awards_count;

        $gallon_count += $row_log['brewBatchSize'];
        $awards_count += $award_count;

        $tbody .= "<tr class=\"border-bottom border-dark-subtle\">";
        //$tbody .= "<td>".$actions_links_export_beerXML."</td>";
        
        $tbody .= "<td>";
        $tbody .= "<span class=\"visually-hidden\">".h($row_log['brewName'])."</span> ";
        // $tbody .= "<i class=\"fa fa-lg fa-glass-water me-2\" style=\"color: ". $bk_color .";\"></i>";
        $tbody .= $admin_enable_link;
        $tbody .= "<a href=\"".$brewblog_link."\">".h($row_log['brewName'])."</a>";
        if ((!empty($row_log['brewStatus'] )) && ($row_log['brewStatus'] != "Gone")) $tbody .= "<em class=\"small text-muted text-lowercase ms-2\">".h($row_log['brewStatus'])."</em>";
        // if ((!empty($row_log['brewStatus'] )) && ($row_log['brewStatus'] != "Gone")) $tbody .= "<span class=\"small badge text-bg-secondary ms-2\">".strtolower($row_log['brewStatus'])."</span>";
        
        if ($admin_enable) {
            $tbody .= "<div style=\"margin-top: 10px;\" class=\"collapse\" id=\"collapseAdminMenu".$row_log['id']."\">";
            $tbody .= "<span class=\"text-secondary small me-2\">Actions:</span>".$actions_links;
            $tbody .= "</div>"; // end collapse
        }
        
        $tbody .= "</td>";
        $tbody .= "<td nowrap>";
        $tbody .= "<span class=\"visually-hidden\">".h($row_log['brewDate'])."</span> ".getTimeZoneDateTime($timezone, $row_log['brewDate'], "1", "1", "short", "date-no-gmt");
        $tbody .= "</td>";
        $tbody .= "<td nowrap class=\"hidden-xs hidden-sm\">".h($row_log['brewBatchNum'])." (".$batch_no_count.")</td>";
        $tbody .= "<td>".$style."</td>";
        // $tbody .= "<td class=\"hidden-xs hidden-sm\">".$method_status."</td>";
        $tbody .= "<td nowrap>".number_format($row_log['brewBatchSize'],2)." (".number_format($gallon_count,1).")</td>";
        $tbody .= "<td nowrap>".$srm."</td>";
        $tbody .= "<td>";
        $tbody .= "<span class=\"visually-hidden\">".sprintf("%06s",$bitterness)."</span>";
        if ((!empty($bitterness)) && ($bitterness > 0)) $tbody .= $bitterness;
        $tbody .= "</td>";
        $tbody .= "<td>";
        $tbody .= "<span class=\"visually-hidden\">".sprintf("%06s",$abv)."</span>";
        if ((!empty($abv)) && ($abv > 0)) $tbody .= $abv."%";
        $tbody .= "</td>";
        
        if ($page == "brewblog-list") {
            $tbody .= "<td nowrap>";
            if ($award_count > 0) $tbody .= $award_count." (".$awards_count.")";
            $tbody .= "</td>";
        }

        else $tbody .= "<td nowrap>".$actions_links."</td>";
        $tbody .= "</tr>";

    }

}

$first_brew_date = min($brew_dates);
$first_brew_date = getTimeZoneDateTime($timezone, $first_brew_date, "1", "1", "short", "date-no-gmt");

$first_award_date = min($award_dates);
$first_award_date = getTimeZoneDateTime($timezone, $first_award_date, "1", "1", "short", "date-no-gmt");

$styles_brewed = array_unique($styles_brewed);
$styles_brewed_count = count($styles_brewed);


//$average_abv = sort($average_abv);
// print_r($average_abv);
$median_abv_display = calculateMedian($average_abv);
$average_abv_display = calculateMean($average_abv);
$median_ibu_display = calculateMedian($average_ibu);
$average_ibu_display = calculateMean($average_ibu);

?>
<script type="text/javascript">
$(document).ready(function(){
    
    $('#brewblog-dt-sort').DataTable( {

        layout: {
            topEnd: 'paging',
            topStart: 'pageLength',
            top2Start: 'info',
            top2End: 'search',
            bottomStart: 'info',
            bottomEnd: 'paging'
        },

        columns: [
            null,
            null,
            { "type": "natural", "targets": 0 },
            null,
            { "type": "natural", "targets": 0 },
            { "type": "natural", "targets": 0 },
            { "type": "natural", "targets": 0 },
            { "type": "natural", "targets": 0 },
            <?php if ($page == "admin") { ?>
            { "orderable": false }
            <?php } else { ?>
            { "type": "natural", "targets": 0 },
            <?php } ?>
        ],

		order: [[ 2, 'desc' ], [ 1, 'asc' ]],
		
        pageLength: 100,

    } );

});
</script>  

<div class="container-fluid bg-black mb-4">

    <div class="container-xxl">

        <div class="row row-cols-2 row-cols-sm-4 row-cols-lg-6 g-2 justify-content-center pt-5 pb-5">

            <div class="col">
                <div class="card h-100 text-bg-dark shadow-sm">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-beer fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($batch_no_count,0); ?> Brews</strong></div><div class="text-center text-secondary small lh-1">logged since <?php echo $first_brew_date; ?></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-droplet fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($gallon_count,0)." ".ucfirst($_SESSION['measFluid2']); ?></strong></div><div class="text-center text-secondary small lh-1">brewed since <?php echo $first_brew_date; ?></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-file-circle-check fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($styles_brewed_count,0); ?> Styles</strong></div><div class="text-center text-secondary small lh-1">brewed since <?php echo $first_brew_date; ?></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-medal fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo $awards_count; ?> Awards</strong></div><div class="text-center text-secondary small lh-1">won since <?php echo $first_award_date; ?></div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-bottle-droplet fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($average_abv_display,1); ?>% ABV</strong></div><div class="text-center text-secondary small lh-1">overall average</div>
                    </div>
                </div>
            </div>

            <!--
            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-bottle-droplet fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($median_abv_display,1); ?>% ABV</strong></div><div class="text-center text-secondary small lh-1">median of all logged brews</div>
                    </div>
                </div>
            </div>
            -->

            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-calculator fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($average_ibu_display,1); ?> IBU</strong></div><div class="text-center text-secondary small lh-1">overall average</div>
                    </div>
                </div>
            </div>

            <!--
            <div class="col">
                <div class="card h-100 text-bg-dark">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-calculator fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($median_ibu_display,1); ?> IBU</strong></div><div class="text-center text-secondary small lh-1">median of all logged brews</div>
                    </div>
                </div>
            </div>
            -->

        </div>

    </div>

</div>

<div class="container-xxl mb-5">

    <div class="table-responsive-lg">
        <table class="table table-striped table-hover table-rounded mt-2 mb-2" id="brewblog-dt-sort">
            <thead class="table-dark">
                <?php echo $thead; ?>
            </thead>
            <tbody class="table-group-divider">
            	<?php echo $tbody; ?>
            </tbody>
        </table>
    </div>

</div>