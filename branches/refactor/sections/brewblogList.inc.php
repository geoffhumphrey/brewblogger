<?php
$pageVars = array(
    'log_rows' => $totalRows_log,
    'filter'   => $filter,
);

if ($totalRows_log > 0) {
    $pageVars += array(
        'checkmobile'   => checkmobile(),
        'pref'          => $row_pref,
        'featured_rows' => $totalRows_featured,
        'db_name'       => $dbName,
        'includes'      => INCLUDES,
        'user_level'    => $row_user['userLevel'],
        'destination'   => $destination,
        'source'        => $source,
    );

    ob_start();
    paginate($display, $pg, $total);
    $pageVars['paginate'] = ob_get_clean();

    // Needs to be in the middle because I don't know what side-effects that include has
    if ($totalRows_featured > 0) {
        ob_start();
        include('featured.inc.php');
        $pageVars['featured'] = ob_get_clean();
    }

    $pageVars += array(
        'style'          => $style,
        'log'            => $row_log,
        'page'           => $page,
        'sort'           => $sort,
        'dir'            => $dir,
        'view'           => $view,
        'pg'             => $pg,
        'user2'          => $user2,
        'total'          => $total,
        'display'        => $display,
        'login_username' => isset($_SESSION['loginUsername']) ? $_SESSION['loginUsername'] : null,
        'img_src'        => $imageSrc,
        'color1'         => $color1,
        'color2'         => $color2,
    );

    $pageVars['logs'] = array();
    do {
        $brew = array(
            'brewBrewerID'   => $row_log['brewBrewerID'],
            'brewArchive'    => $row_log['brewArchive'],
            'brewBitterness' => $row_log['brewBitterness'],
            'brewDate'       => $row_log['brewDate'],
            'brewLovibond'   => $row_log['brewLovibond'],
            'brewMethod'     => $row_log['brewMethod'],
            'brewName'       => $row_log['brewName'],
            'brewStyle'      => $row_log['brewStyle'],
            'id'             => $row_log['id'],
        );

        if ($row_log['brewArchive'] != "Y") {
            // @todo sure why not just do 3 queries in a loop? It's not like they could be turned into 1 query or better yet JOINed!

            // Get brew style information for all listed styles
            mysql_select_db($database_brewing, $brewing);
            $query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_log['brewStyle']);
            $styles = mysql_query($query_styles, $brewing) or die(mysql_error());
            $row_styles       = mysql_fetch_assoc($styles);
            $totalRows_styles = mysql_num_rows($styles);


            // Get real user names
            mysql_select_db($database_brewing, $brewing);
            $query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
            $user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
            $row_user2       = mysql_fetch_assoc($user2);
            $totalRows_user2 = mysql_num_rows($user2);

            // Awards
            $awardNewID = "b" . $row_log['id'];
            mysql_select_db($database_brewing, $brewing);
            $query_awards2 = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
            $awards2 = mysql_query($query_awards2, $brewing) or die(mysql_error());
            $row_awards2       = mysql_fetch_assoc($awards2);
            $totalRows_awards2 = mysql_num_rows($awards2);

            $brew['style_count']  = $totalRows_styles;
            $brew['awards_count'] = $totalRows_awards2;
            $brew['user']         = array(
                'realFirstName' => $user2['realFirstName'],
                'realLastName'  => $user2['realLastName'],
                'user_name'     => $user2['user_name'],
            );

            ob_start();
            include('reference/styles.inc.php');
            $brew['styles_inc'] = ob_get_clean();

            $brew['color_display_inc'] = '&nbsp;';
            if ($row_log['brewLovibond'] != "") {
                ob_start();
                include(INCLUDES . 'color_display.inc.php');
                $brew['color_display_inc'] = ob_get_clean();
            }

            $brew['calcABV'] = '&nbsp;';
            if (($row_log['brewOG'] != "") && ($row_log['brewFG'] != "")) {
                $brew['calcABV'] = round(calc_abv($row_log['brewOG'], $row_log['brewFG']), 1) . "%";
            }

        }

        $pageVars['logs'][] = $brew;

    } while ($row_log = mysql_fetch_assoc($log));
}

return $twig->render('brewblogList.html.twig', $pageVars);