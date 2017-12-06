<?php

$sidebar_panel_head = "";
$sidebar_panel_body = "";
$sidebar_panel_foot = "";

if ($page == "brewblog") {

    $sidebar_panel_head .= "<div class=\"panel panel-default hidden-print\">";
    $sidebar_panel_head .= "<div class=\"panel-heading\">";
    $sidebar_panel_head .= "<h4 class=\"panel-title\">More...</h4>";
    $sidebar_panel_head .= "</div>";
    $sidebar_panel_head .= "<div class=\"panel-body\">";

    do {

        if ($row_list['brewArchive'] != "Y") {

            $brew_name = "";
            $brew_link = "";
            $link_page = "";
            $brew_full_name = "";

            if ($row_list['id'] != $row_log['id']) {

                if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($row_list['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_list['brewStyle'],$prettify_url))), "detail", strtolower($row_list['brewBrewerID']), $row_list['id'], $base_url);
                else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_list['brewBrewerID'], $row_list['id'], $base_url);
                $brew_name .= "<a href=\"".$brewblog_link."\" data-toggle=\"tooltip\" data-placement=\"auto left\" title=\"".$row_list['brewStyle']."\">";
                $brew_full_name .= $brew_name;
                $brew_name .= truncate_string($row_list['brewName'], MAX_SIDEBAR_ALPHA, '...');
                $brew_full_name .= $row_list['brewName']."</a>";
                $brew_name .= "</a>";

            }

            else {

                $brew_full_name = $row_list['brewName'];
                $brew_name = truncate_string($row_list['brewName'], MAX_SIDEBAR_ALPHA, '...');

            }

            $sidebar_panel_body .= "<div class=\"row small\">";
            $sidebar_panel_body .= "<div class=\"col col-lg-7 col-md-12 col-sm-8 col-xs-8\">";
            $sidebar_panel_body .= "<span class=\"hidden-lg\">".$brew_full_name."</span><span class=\"hidden-xs hidden-sm hidden-md\">".$brew_name."</span>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col col-lg-5 col-md-12 col-sm-4 col-xs-4 text-right hidden-md\">";
            $sidebar_panel_body .= dateconvert($row_list['brewDate'],3);
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";

        }

    } while ($row_list = mysqli_fetch_assoc($list));

    $sidebar_panel_foot .= "</div>";
    $sidebar_panel_foot .= "</div>";

}

echo $sidebar_panel_head.$sidebar_panel_body.$sidebar_panel_foot;

?>