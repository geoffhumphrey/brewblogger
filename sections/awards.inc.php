<?php

$sidebar_panel_head = "";
$sidebar_panel_body = "";
$sidebar_panel_foot = "";

if  ($totalRows_awards > 0) {

    $sidebar_panel_head .= "<div class=\"panel panel-default hidden-print\">";
    $sidebar_panel_head .= "<div class=\"panel-heading\">";
    $sidebar_panel_head .= "<h4 class=\"panel-title\">Awards &amp; Competitions</h4>";
    $sidebar_panel_head .= "</div>";
    $sidebar_panel_head .= "<div class=\"panel-body\">";

    do {

        $sidebar_panel_body .= "<div class=\"small awards-wrapper\">";

        if (!empty($row_awards['awardBrewName'])) {
            $sidebar_panel_body .= "<div class=\"row\">";
            $sidebar_panel_body .= "<div class=\"col col-lg-3 col-md-4 col-sm-4 col-xs-4\">";
            $sidebar_panel_body .= "<strong class=\"text-info\">Name:</strong>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col col-lg-9 col-md-8 col-sm-8 col-xs-8\">";
            $sidebar_panel_body .= $row_awards['awardBrewName'];
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";
        }

        if (!empty($row_awards['awardContest'])) {
            $sidebar_panel_body .= "<div class=\"row\">";
            $sidebar_panel_body .= "<div class=\"col col-lg-3 col-md-4 col-sm-4 col-xs-4\">";
            $sidebar_panel_body .= "<strong class=\"text-info\">Comp<span class=\"hidden-lg hidden-md\">etition</span>:</strong>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col col-lg-9 col-md-8 col-sm-8 col-xs-8\">";
            if ($row_awards['awardContestURL'] != "") $sidebar_panel_body .= "<a href=\"".$row_awards['awardContestURL']."\" target=\"_blank\">".$row_awards['awardContest']."</a>";
            else $sidebar_panel_body .= $row_awards['awardContest'];
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";
        }

        if (!empty($row_awards['awardDate'])) {
            $sidebar_panel_body .= "<div class=\"row\">";
            $sidebar_panel_body .= "<div class=\"col col-lg-3 col-md-4 col-sm-4 col-xs-4\">";
            $sidebar_panel_body .= "<strong class=\"text-info\">Date:</strong>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col col-lg-9 col-md-8 col-sm-8 col-xs-8\">";
            $sidebar_panel_body .= dateconvert($row_awards['awardDate'],3);
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";
        }

        if (!empty($row_awards['awardStyle'])) {
            $sidebar_panel_body .= "<div class=\"row\">";
            $sidebar_panel_body .= "<div class=\"col col-lg-3 col-md-4 col-sm-4 col-xs-4\">";
            $sidebar_panel_body .= "<strong class=\"text-info\">Style:</strong>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col col-lg-9 col-md-8 col-sm-8 col-xs-8\">";
            $sidebar_panel_body .= $row_awards['awardStyle'];
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";
        }

        if (!empty($row_awards['awardPlace'])) {
            $sidebar_panel_body .= "<div class=\"row\">";
            $sidebar_panel_body .= "<div class=\"col col-lg-3 col-md-4 col-sm-4 col-xs-4\">";
            $sidebar_panel_body .= "<strong class=\"text-info\">Place:</strong>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col col-lg-9 col-md-8 col-sm-8 col-xs-8\">";
            $sidebar_panel_body .= display_place($row_awards['awardPlace'],2);
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";
        }

        $sidebar_panel_body .= "</div>";

    } while ($row_awards = mysqli_fetch_assoc($awards));

    $sidebar_panel_foot .= "</div>";
    $sidebar_panel_foot .= "</div>";

 }

 echo $sidebar_panel_head.$sidebar_panel_body.$sidebar_panel_foot;

 ?>
