<?php

$sidebar_panel_head = ""; 
$awards_list_brewblog = "";
$sidebar_panel_foot = "";

if  ($totalRows_awards > 0) {

    do {

        $awards_list_brewblog .= "<div class=\"small mb-2\">";

        if (!empty($row_awards['awardBrewName'])) {
            $awards_list_brewblog .= "<div class=\"row\">";
            $awards_list_brewblog .= "<div class=\"col-4\">";
            $awards_list_brewblog .= "<strong class=\"text-silver\">Name</strong>";
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "<div class=\"col-8\">";
            $awards_list_brewblog .= $row_awards['awardBrewName'];
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "</div>";
        }

        if (!empty($row_awards['awardContest'])) {
            $awards_list_brewblog .= "<div class=\"row\">";
            $awards_list_brewblog .= "<div class=\"col-4\">";
            $awards_list_brewblog .= "<strong class=\"text-silver\">Competition</strong>";
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "<div class=\"col-8\">";
            if ($row_awards['awardContestURL'] != "") $awards_list_brewblog .= "<a href=\"".h($row_awards['awardContestURL'])."\" target=\"_blank\">".h($row_awards['awardContest'])."</a>";
            else $awards_list_brewblog .= $row_awards['awardContest'];
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "</div>";
        }

        if (!empty($row_awards['awardDate'])) {
            $awards_list_brewblog .= "<div class=\"row\">";
            $awards_list_brewblog .= "<div class=\"col-4\">";
            $awards_list_brewblog .= "<strong class=\"text-silver\">Date</strong>";
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "<div class=\"col-8\">";
            $awards_list_brewblog .= getTimeZoneDateTime($timezone, strtotime($row_awards['awardDate']), "1", "1", "short", "date-no-gmt");
            //$awards_list_brewblog .= dateconvert($row_awards['awardDate'],3);
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "</div>";
        }

        if (!empty($row_awards['awardStyle'])) {
            $awards_list_brewblog .= "<div class=\"row\">";
            $awards_list_brewblog .= "<div class=\"col-4\">";
            $awards_list_brewblog .= "<strong class=\"text-silver\">Style</strong>";
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "<div class=\"col-8\">";
            $awards_list_brewblog .= $row_awards['awardStyle'];
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "</div>";
        }

        if (!empty($row_awards['awardPlace'])) {
            $awards_list_brewblog .= "<div class=\"row\">";
            $awards_list_brewblog .= "<div class=\"col-4\">";
            $awards_list_brewblog .= "<strong class=\"text-silver\">Place</strong>";
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "<div class=\"col-8\">";
            $awards_list_brewblog .= display_place($row_awards['awardPlace'],2);
            $awards_list_brewblog .= "</div>";
            $awards_list_brewblog .= "</div>";

            if (($row_awards['awardPlace'] == "pro-am") || ($row_awards['awardPlace'] == "scale-up")) {
                $awards_list_brewblog .= "<div class=\"row\">";
                $awards_list_brewblog .= "<div class=\"col-4\">";
                $awards_list_brewblog .= "<strong class=\"text-silver\">Organization</strong>";
                $awards_list_brewblog .= "</div>";
                $awards_list_brewblog .= "<div class=\"col-8\">";
                if (!empty($row_awards['awardProamURL'])) $awards_list_brewblog .= "<a href=\"".h($row_awards['awardProamURL'])."\" target=\"_blank\">".h($row_awards['awardProamName'])."</a>";
                else $awards_list_brewblog .= $row_awards['awardProamName'];
                $awards_list_brewblog .= "</div>";
                $awards_list_brewblog .= "</div>";
            }
            
        }

        $awards_list_brewblog .= "</div>";

        $awards_list_brewblog .= "<div class=\"text-secondary\"><hr class=\"border border-secondary opacity-50\"></div>";

    } while ($row_awards = mysqli_fetch_assoc($awards));

 }

 ?>


<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="awards-brewblogs" aria-labelledby="awards-brewblogs-label" data-bs-theme="dark">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="awards-brewblogs-label"><?php echo h($row_log['brewName']); ?> &ndash; <?php echo $totalRows_awards; ?> Awards</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php echo $awards_list_brewblog; ?>
    </div>
</div>