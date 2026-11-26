<?php
$sidebar_panel_body = "";

if ($page == "brewblog") {

    do {

        if ($row_list['brewArchive'] != "Y") {

            $style_sidebar = json_decode($row_list['brewStyle'],true);

            $brew_name = "";
            $brew_link = "";
            $link_page = "";
            $brew_full_name = "";

            if ($row_list['id'] != $row_log['id']) {

                // $link_log_name = $transliterator->transliterate($row_list['brewName']);
                // $link_style_name = $transliterator->transliterate($row_list['brewStyle']);

                $link_log_name = pathauto_cleanstring($row_list['brewName']);
                $link_style_name = "";
                if (isset($style_sidebar['NAME'])) $link_style_name = pathauto_cleanstring($style_sidebar['NAME']);

                if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($link_log_name,$prettify_url))), urlencode(strtolower(strtr($link_style_name,$prettify_url))), "detail", strtolower($row_list['brewBrewerID']), $row_list['id'], $base_url);
                else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_list['brewBrewerID'], $row_list['id'], $base_url);
                // if ($confirm == "new") $brewblog_link .= "&amp;confirm=new";
                if (isset($style_sidebar['NAME'])) $brew_name .= "<a href=\"".$brewblog_link."\" data-toggle=\"tooltip\" data-placement=\"auto left\" title=\"".h($style_sidebar['NAME'])."\">";
                $brew_full_name .= $brew_name;
                $brew_name .= truncate_string($row_list['brewName'], 16, '...');
                $brew_full_name .= h($row_list['brewName'])."</a>";
                $brew_name .= "</a>";

            }

            else {

                $brew_full_name = $row_list['brewName'];
                $brew_name = truncate_string($row_list['brewName'], 16, '...');

            }

            $sidebar_panel_body .= "<div class=\"row small\">";
            $sidebar_panel_body .= "<div class=\"col-8\">";
            //$sidebar_panel_body .= "<span class=\"d-none d-xl-inline\">".$brew_full_name."</span><span class=\"d-xl-none d-lg-inline\">".$brew_name."</span>";
            $sidebar_panel_body .= $brew_full_name;
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "<div class=\"col-4\">";
            $sidebar_panel_body .= "<span class=\"text-end\">".getTimeZoneDateTime($timezone, $row_list['brewDate'], "1", "1", "short", "date-no-gmt")."</span>";
            $sidebar_panel_body .= "</div>";
            $sidebar_panel_body .= "</div>";

        }

    } while ($row_list = mysqli_fetch_assoc($list));


}

echo $sidebar_panel_body;

?>