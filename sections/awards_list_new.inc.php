<?php
$thead = "";
$tbody = "";
$show_awards = FALSE;
$award_count = 0;
$first_place = 0;
$second_place = 0;
$third_place = 0;
$fourth_place = 0;
$hm = 0;
$bos = 0;
$bos_second = 0;
$bos_third = 0;
$bos_hm = 0;
$pro_am = 0;
$scale_up = 0;
$non_bos = 0;

if ($totalRows_awardsList > 0) $show_awards = TRUE;
if (((isset($_SESSION['loginUsername'])) && ($row_log['brewBrewerID'] == $loginUsername)) || ((isset($_SESSION['loginUsername'])) && ($_SESSION['userLevel'] == "1"))) $admin_enable = TRUE;

if ($show_awards) {

    $thead .= "<tr>";
    $thead .= "<th><span class=\"hidden-xs hidden-sm\">Entered </span>Name</th>";
    $thead .= "<th class=\"hidden-xs hidden-sm\">Style</th>";
    $thead .= "<th>Competition</th>";
    $thead .= "<th>Date</th>";
    $thead .= "<th>Place</th>";
    if (($row_pref['mode'] == "2") && ($filter == "all")) $thead .= "<th>Brewer</th>";
    $thead .= "</tr>";

    do {

        $dbGo = rtrim($row_awardsList['awardBrewID'], "0123456789");
        if ($dbGo == "r") $destination = "recipe";
        else $destination = "brewblog";
        
        $brewID = ltrim ($row_awardsList['awardBrewID'], "rb");

        $query_brewblog = sprintf("SELECT id,brewName,brewDate FROM brewblogs WHERE id = '%s'", $brewID);
        $brewblog = mysqli_query($connection,$query_brewblog);
        $row_brewblog = mysqli_fetch_assoc($brewblog);
        $totalRows_brewblog = mysqli_num_rows($brewblog);

        $admin_enable_link = "";

        if ($admin_enable) $admin_enable_link = "<a href=\"\" role=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapseAdminMenu".$row_awardsList['id']."\" aria-expanded=\"false\" aria-controls=\"collapseAdminMenu".$row_awardsList['id']."\"><span class=\"fa fa-lg fa-fw fa-cog\"></span></a>&nbsp;";

        if ($totalRows_brewblog > 0) {

            if ($row_awardsList['awardPlace'] == 1) $first_place++;
            if ($row_awardsList['awardPlace'] == 2) $second_place++;
            if ($row_awardsList['awardPlace'] == 3) $third_place++;
            if ($row_awardsList['awardPlace'] == 4) $fourth_place++;
            if ($row_awardsList['awardPlace'] == "honMen") $hm++;
            if ($row_awardsList['awardPlace'] == "best") $bos++;
            if ($row_awardsList['awardPlace'] == "best1") $bos_second++;
            if ($row_awardsList['awardPlace'] == "best2") $bos_third++;
            if ($row_awardsList['awardPlace'] == "best3") $bos_hm++;
            if ($row_awardsList['awardPlace'] == "pro-am") $pro_am++;
            if ($row_awardsList['awardPlace'] == "scale-up") $scale_up++;

            $award_count++;

            // Move the following to a function
            if ($row_pref['mode'] == "2") {
                $query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_awardsList['brewBrewerID']);
                $user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
                $row_user2 = mysqli_fetch_assoc($user2);
                $totalRows_user2 = mysqli_num_rows($user2);
            }

            $real_brewblog_name = FALSE;

            if ($row_awardsList['awardBrewName'] != $row_brewblog['brewName']) $real_brewblog_name = TRUE;

            $link_log_name = pathauto_cleanstring($row_awardsList['awardBrewName']);
            $link_style_name = pathauto_cleanstring($row_awardsList['awardStyle']);

            if (SEF) $award_link = build_public_url($destination, urlencode(strtolower(strtr($link_log_name,$prettify_url))), urlencode(strtolower(strtr($link_style_name,$prettify_url))), "detail", strtolower($row_awardsList['brewBrewerID']), $row_brewblog['id'], $base_url);
            else $award_link = build_public_url($destination, "default", "default", "default", $row_awardsList['brewBrewerID'], $row_brewblog['id'], $base_url);

            $tbody .= "<tr>";
            $tbody .= "<td>";
            $tbody .= $admin_enable_link;
            $tbody .= "<a href=\"".$award_link."\">".h($row_awardsList['awardBrewName'])."</a>";

            if ($admin_enable) {
                $actions_links = "<a class=\"me-1\" href=\"".$base_url."index.php?page=admin&section=awards&action=edit&dbTable=awards&id=".$brewID."&sid=".$row_awardsList['id']."\"><i class=\"fa fa-pencil\"></i></a>";
                $actions_links .= "<a class=\"me-1\" href=\"".$base_url."includes/process_new.inc.php?action=delete&dbTable=awards&id=".$row_awardsList['id']."\" data-confirm=\"Are you sure you want to delete this award?\"><i class=\"fa fa-trash-o\"></i></a>";
                $tbody .= "<div class=\"collapse\" id=\"collapseAdminMenu".$row_awardsList['id']."\">";
                $tbody .= "Actions: ".$actions_links;
                $tbody .= "</div>";
            }

            // if ($real_brewblog_name) $tbody .= " <a href=\"".$award_link."\" role=\"button\" data-toggle=\"popover\" data-placement=\"auto right\" data-animation=\"true\" data-trigger=\"hover\" data-content=\"BrewBlog name is ".$row_brewblog['brewName']."\"><small><span class=\"fa fa-asterisk\"></span><small></a>";
            $tbody .= "</td>";
            $tbody .= "<td>".h($row_awardsList['awardStyle'])."</td>";
            $tbody .= "<td>";
            if (!empty($row_awardsList['awardContestURL'])) $tbody .= "<a href=\"".h($row_awardsList['awardContestURL'])."\" target=\"_blank\">".h($row_awardsList['awardContest'])."</a>";
            else $tbody .= $row_awardsList['awardContest'];
            $tbody .= "</td>";
            $tbody .= "<td nowrap><span class=\"visually-hidden\">".strtotime($row_awardsList['awardDate'])."</span>".dateconvert($row_awardsList['awardDate'],3)."</td>";
            $tbody .= "<td nowrap>".display_place($row_awardsList['awardPlace'],3)."</td>";
            if (($row_pref['mode'] == "2") && ($filter == "all")) $tbody .= "<td>".$row_user2['realLastName'].", ".$row_user2['realFirstName']."</td>";
            $tbody .= "</tr>";

        }

    } while ($row_awardsList = mysqli_fetch_assoc($awardsList));

    $place_breakdown = array();
    
    if ($bos > 0) $place_breakdown['BOS'] = $bos;
    if ($bos_second > 0) $place_breakdown['BOS 2nd'] = $bos_second;
    if ($bos_third > 0) $place_breakdown['BOS 3rd'] = $bos_third;
    if ($bos_hm > 0) $place_breakdown['BOS HM'] = $bos_hm;
    if ($pro_am > 0) $place_breakdown['Pro-Am'] = $pro_am;
    if ($scale_up > 0) $place_breakdown['Scale-Up'] = $scale_up;
    if ($first_place > 0) $place_breakdown['1st Place'] = $first_place;
    if ($second_place > 0) $place_breakdown['2nd Place'] = $second_place;
    if ($third_place > 0) $place_breakdown['3rd Place'] = $third_place;
    if ($fourth_place > 0) $place_breakdown['4th Place'] = $fourth_place;
    if ($hm > 0) $place_breakdown['HM'] = $hm;
    
    $non_bos = ($first_place + $second_place + $third_place + $fourth_place);

?>

<script type="text/javascript">
$(document).ready(function(){
    
    $('#sortable').DataTable( {

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
            null,
            null,
            null
        ],

        order: [[ 3, 'desc' ], [ 2, 'asc' ], [ 1, 'asc' ]],
        
        pageLength: 100,

    } );

});
</script>

<div class="container-fluid bg-black mb-4">

    <div class="container-xxl">

        <div class="row row-cols-2 g-2 justify-content-center pt-5 pb-2">

            <div class="col">
                <div class="card h-100 text-bg-dark shadow-sm">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-medal fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-1"><strong class="fs-4"><?php echo number_format($award_count,0); ?> Awards</strong></div><div class="text-center text-secondary small lh-1">total won to date</div>
                    </div>
                </div>
            </div>

            <?php if ($non_bos > 0) { ?>
            <div class="col">
                <div class="card h-100 text-bg-dark shadow-sm">
                    <div class="card-body">
                        <div class="mb-1 text-center"><span class="position-absolute top-0 start-50 translate-middle badge text-primary-emphasis bg-primary-subtle border border-primary-subtle ps-3 pe-3"><i class="fa fa-fw fa-trophy fa-2x"></i></span></div>
                        <div class="text-center mt-3 mb-2"><strong class="fs-4"><?php echo number_format($non_bos,0); ?> Awards</strong></div><div class="text-center text-secondary small lh-1 pb-3">excluding BOS, Pro-Am, Scale-Up, or HM Awards</div>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>

    <?php if (!empty($place_breakdown)) { ?>

        <div class="row row-cols-11 g-2 justify-content-center pb-5">

            <?php foreach ($place_breakdown as $key => $value) { 

                if ($key == "BOS") { $icon_style = "text-light"; $icon_bg = "text-teal"; }
                elseif ($key == "BOS 2nd") { $icon_style = "text-dark"; $icon_bg = "text-amber"; }
                elseif ($key == "BOS 3rd") { $icon_style = "text-light"; $icon_bg = "text-indigo"; }
                elseif ($key == "BOS HM") { $icon_style = "text-light"; $icon_bg = "text-forest-green"; }
                elseif ($key == "Pro-Am") { $icon_style = "text-dark"; $icon_bg = "text-yellow"; }
                elseif ($key == "Scale-Up") { $icon_style = "text-light"; $icon_bg = "text-orange"; }
                elseif ($key == "1st Place") { $icon_style = "text-dark"; $icon_bg = "text-gold"; }
                elseif ($key == "2nd Place") { $icon_style = "text-dark"; $icon_bg = "text-silver"; }
                elseif ($key == "3rd Place") { $icon_style = "text-light"; $icon_bg = "text-bronze"; }
                elseif ($key == "4th Place") { $icon_style = "text-light"; $icon_bg = "text-forest-green"; }
                elseif ($key == "HM") { $icon_style = "text-light"; $icon_bg = "text-purple"; }

            ?>

            <div class="col">
                <div class="card h-100 text-bg-dark bg-gradient">
                    <div class="card-body">
                        <div class="mb-1 text-center">
                            <span class="position-absolute top-0 start-50 translate-middle">
                                <span class="fa-stack">
                                  <i class="fa-solid fa-circle fa-stack-2x <?php echo $icon_bg; ?>"></i>
                                  <i class="fa-solid fa-award fa-stack-1x <?php echo $icon_style; ?>"></i>
                                </span>
                            </span>
                        </div>
                        <div class="text-center"><strong class="fs-5"><?php echo $value; ?></strong></div><div class="text-center text-secondary small lh-1"><?php echo $key; ?></div>
                    </div>
                </div>
            </div>

            <?php } ?>

        </div>

<?php } ?>

    </div>

</div>

<div class="container-xxl mb-5">
    <div class="table-responsive-lg">
        <table class="table table-striped table-hover table-rounded mt-2 mb-2" id="sortable">
            <thead class="table-dark">
                <?php echo $thead; ?>
            </thead>
            <tbody class="table-group-divider">
                <?php echo $tbody; ?>
            </tbody>
        </table>
    </div>
</div>
<?php } else echo "<div class=\"container-xxl mb-5\"><p>No awards have been entered.</p></div>"; ?>