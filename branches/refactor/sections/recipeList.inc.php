<?php
$pageVars = array(
    'total'          => $total,
    'filter'         => $filter,
    'pref'           => $row_pref,
    'db_name'        => $dbName,
    'style'          => $style,
    'login_username' => $_SESSION['loginUsername'],
    'checkmobile'    => checkmobile(),
    'sort'           => $sort,
    'view'           => $view,
    'pg'             => $pg,
    'user'           => $row_user,
    'login_username' => $_SESSION["loginUsername"],
    'includes'       => INCLUDES,
    'dir'            => $dir,
    'destination'    => $destination,
    'image_src'      => $imageSrc,
    'color1'         => $color1,
    'color2'         => $color2,
    'display'        => $display,
    'page'           => $page,
    'source'         => $source,
);
if ($totalRows_featured > 0) {
    if (($row_pref['mode'] == "1") || (($row_pref['mode'] == "2") && ($filter == "all"))) {
        ob_start();
        include('featured.inc.php');
        $pageVars['featured'] = ob_get_clean();
    }
}

if ($total > $display) {
    ob_start();
    paginate($display, $pg, $total);
    $pageVars['pagination'] = ob_get_clean();
}

$pageVars['recipes'] = array();
do {
    $recipe = $row_recipeList;
    if ($row_recipeList['brewArchive'] != "Y") {

        if ($row_recipeList['brewLovibond'] != "") {
            ob_start();
            include(INCLUDES . 'color_display.inc.php');
            $recipe['color_display'] = ob_get_clean();
        }

        $recipe['calcABV'] = '&nbsp;';
        if (($row_recipeList['brewOG'] != "") && ($row_recipeList['brewFG'] != "")) {
            $recipe['calcABV'] = round(calc_abv($row_recipeList['brewOG'], $row_recipeList['brewFG']), 1) . "%";
        };

        /**
         * @todo Why yes, these should be done with a JOIN
         */

        // Get brew style information for all listed styles
        mysql_select_db($database_brewing, $brewing);
        $query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_recipeList['brewStyle']);
        $styles = mysql_query($query_styles, $brewing) or die(mysql_error());
        $row_styles       = mysql_fetch_assoc($styles);
        $totalRows_styles = mysql_num_rows($styles);

        $recipe['style'] = $row_styles;
        if ($totalRows_styles > 0) {
            ob_start();
            include('reference/styles.inc.php');
            $recipe['style_include'] = ob_get_clean();
        }

        // Get real user names
        mysql_select_db($database_brewing, $brewing);
        $query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_recipeList['brewBrewerID']);
        $user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
        $row_user2       = mysql_fetch_assoc($user2);
        $totalRows_user2 = mysql_num_rows($user2);
        $recipe['user']  = $row_user2;

        // Awards
        $awardNewID = "r" . $row_recipeList['id'];
        mysql_select_db($database_brewing, $brewing);
        $query_awards2 = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
        $awards2 = mysql_query($query_awards2, $brewing) or die(mysql_error());
        $row_awards2           = mysql_fetch_assoc($awards2);
        $totalRows_awards2     = mysql_num_rows($awards2);
        $recipe['award_count'] = $totalRows_awards2;

        $pageVars['recipes'][] = $recipe;
    } // end if ($row_recipeList['brewArchive'] != "Y")
} while ($row_recipeList = mysql_fetch_assoc($recipeList));

return $twig->render('recipeList.html.twig', $pageVars);