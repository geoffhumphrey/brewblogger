<?php

$pageVars = array(
    'filter'         => $filter,
    'view'           => $view,
    'display'        => $display,
    'image_src'      => $imageSrc,
    'sort'           => $sort,
    'dir'            => $dir,
    'pg'             => $pg,
    'pref'           => $row_pref,
    'user'           => $user,
    'user2'          => isset($user2) ? : null,
    'login_username' => isset($_SESSION["loginUsername"]) ? : null,
    'color1'         => $color1,
    'color2'         => $color2,
);

ob_start();
paginate($display, $pg, $total);
$pageVars['paginate'] = ob_get_clean();

$pageVars['awards'] = array();
do {
    if (empty($row_awardsList)) {
        continue;
    }
    $award = $row_awardsList;

    // Get brew style information for all listed styles
    mysql_select_db($database_brewing, $brewing);
    $query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_awardsList['awardStyle']);
    $styles = mysql_query($query_styles, $brewing) or die(mysql_error());
    $row_styles       = mysql_fetch_assoc($styles);
    $totalRows_styles = mysql_num_rows($styles);
    ob_start();
    include('reference/styles.inc.php');
    $award['style_include'] = ob_get_clean();

    // Get real user names
    mysql_select_db($database_brewing, $brewing);
    $query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_awardsList['brewBrewerID']);
    $user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
    $row_user2       = mysql_fetch_assoc($user2);
    $totalRows_user2 = mysql_num_rows($user2);
    $award['user']   = $row_user2;

    $pageVars['awards'][] = $award;
} while ($row_awardsList = mysql_fetch_assoc($awardsList));

return $twig->render('awardsList.html.twig', $pageVars);