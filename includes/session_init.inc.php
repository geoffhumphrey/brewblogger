<?php
session_start();

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

$installation_id = "";

if (empty($installation_id)) $prefix_session = md5(__FILE__);
else $prefix_session = md5($installation_id);

function is_session_started() {
    if (php_sapi_name() !== 'cli' ) {
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}

if (is_session_started() === FALSE) {
    session_name($prefix_session);
    session_start();
}

if (isset($_SESSION['last_action'])) {
    $seconds_inactive = time() - $_SESSION['last_action'];
    $session_expire_after_seconds = $session_expire_after * 60;
    if ($seconds_inactive >= $session_expire_after_seconds) {
        session_unset();
        session_destroy();
    }
}

// Define global session vars
$_SESSION['last_action'] = time();
if (!isset($_SESSION['session_set_'.$prefix_session])) $_SESSION['session_set_'.$prefix_session] = $prefix_session;
if (!isset($_SESSION['prefs_'.$prefix_session])) $_SESSION['prefs_'.$prefix_session] = "";
if (!isset($_SESSION['user_info_'.$prefix_session])) $_SESSION['user_info_'.$prefix_session] = "";

// Check to see if the session_set variable is corrupted or hijacked. If so, destroy the session and reset
if (((!empty($_SESSION['session_set_'.$prefix_session])) && ($_SESSION['session_set_'.$prefix_session] != $prefix_session)) || (empty($_SESSION['session_set_'.$prefix_session]))) {

    session_unset();
    session_destroy();
    session_write_close();
    session_regenerate_id(true);
    session_name($prefix_session);
    session_start();
    $_SESSION['session_set_'.$prefix_session] = $prefix_session;

}

// Generate preferences session vars
if ((empty($_SESSION['prefs_'.$prefix_session])) || ($_SESSION['prefs_'.$prefix_session] != $prefix_session)) {

    $query_pref = "SELECT * FROM preferences WHERE id='1'";
    $pref = mysqli_query($connection,$query_pref) or die (mysqli_error($connection));
    $row_pref = mysqli_fetch_assoc($pref);
    $totalRows_pref = mysqli_num_rows($pref);

    $prefs_columns = array_keys($row_pref);

    foreach ($prefs_columns as $prefs_column_name) {
        if ($prefs_column_name != "id") {
            if (isset($row_pref[$prefs_column_name])) $_SESSION[$prefs_column_name] = $row_pref[$prefs_column_name];
            else $_SESSION[$prefs_column_name] = "";
        }
    }

    $_SESSION['prefs_'.$prefix_session] = $prefix_session;

}

// Generate user-specific session vars
if (isset($_SESSION['loginUsername'])) {

    if ((empty($_SESSION['user_info_'.$prefix_session])) || ($_SESSION['user_info_'.$prefix_session] != $prefix_session))  {

        $query_user = sprintf("SELECT * FROM users WHERE user_name = '%s'", $_SESSION['loginUsername']);
        $user = mysqli_query($connection,$query_user) or die (mysqli_error($connection));
        $row_user = mysqli_fetch_assoc($user);
        $totalRows_user = mysqli_num_rows($user);

        $user_columns = array_keys($row_user);

        foreach ($user_columns as $user_column_name) {
            if (($user_column_name != "password") && ($user_column_name != "id")) {
                if (isset($row_user[$user_column_name])) $_SESSION[$user_column_name] = $row_user[$user_column_name];
                else $_SESSION[$user_column_name] = "";
            }
        }

        $_SESSION['uid'] = $row_user['id'];
        $_SESSION['user_info_'.$prefix_session] = $prefix_session;

    }

}

// Get vars from DB reference tables
// Adjuncts
if ((empty($_SESSION['adjuncts_'.$prefix_session])) || ($_SESSION['adjuncts_'.$prefix_session] != $prefix_session)) {

    $query_adjuncts = "SELECT * FROM adjuncts ORDER BY id ASC";
    $adjuncts = mysqli_query($connection,$query_adjuncts) or die (mysqli_error($connection));
    $adjuncts_array = array();
    while ($row_adjuncts = mysqli_fetch_array($adjuncts, MYSQL_ASSOC)) {
        $adjuncts_array[] = $row_adjuncts;
    }

    $_SESSION['adjuncts'] = $adjuncts_array;
    $_SESSION['adjuncts_'.$prefix_session] = $prefix_session;
}

// Extracts
if ((empty($_SESSION['extracts_'.$prefix_session])) || ($_SESSION['extracts_'.$prefix_session] != $prefix_session)) {

    $query_extracts = "SELECT * FROM extract ORDER BY id ASC";
    $extracts = mysqli_query($connection,$query_extracts) or die (mysqli_error($connection));
    $extracts_array = array();
    while ($row_extracts = mysqli_fetch_array($extracts, MYSQL_ASSOC)) {
        $extracts_array[] = $row_extracts;
    }

    $_SESSION['extracts'] = $extracts_array;
    $_SESSION['extracts_'.$prefix_session] = $prefix_session;
}

// Misc ingredients
if ((empty($_SESSION['misc_'.$prefix_session])) || ($_SESSION['misc_'.$prefix_session] != $prefix_session)) {

    $query_misc = "SELECT * FROM misc ORDER BY id ASC";
    $misc = mysqli_query($connection,$query_misc) or die (mysqli_error($connection));
    $misc_array = array();
    while ($row_misc = mysqli_fetch_array($misc, MYSQL_ASSOC)) {
        $misc_array[] = $row_misc;
    }

    $_SESSION['misc'] = $misc_array;
    $_SESSION['misc_'.$prefix_session] = $prefix_session;
}

/*
// Yeast profiles
if ((empty($_SESSION['yeast_'.$prefix_session])) || ($_SESSION['yeast_'.$prefix_session] != $prefix_session)) {

    $query_yeast = "SELECT * FROM yeast_profiles ORDER BY id ASC";
    $yeast = mysqli_query($connection,$query_yeast) or die (mysqli_error($connection));
    $yeast_array = array();
    while ($row_yeast = mysqli_fetch_array($yeast, MYSQL_ASSOC)) {
        $yeast_array[] = $row_yeast;
    }

    $_SESSION['yeast'] = $yeast_array;
    $_SESSION['yeast_'.$prefix_session] = $prefix_session;
}
*/

// Hops
if ((empty($_SESSION['hops_'.$prefix_session])) || ($_SESSION['hops_'.$prefix_session] != $prefix_session)) {

    $query_hops = "SELECT * FROM hops ORDER BY id ASC";
    $hops = mysqli_query($connection,$query_hops) or die (mysqli_error($connection));
    $hops_array = array();
    while ($row_hops = mysqli_fetch_array($hops, MYSQL_ASSOC)) {
        $hops_array[] = $row_hops;
    }

    $_SESSION['hops'] = $hops_array;
    $_SESSION['hops_'.$prefix_session] = $prefix_session;
}

// Grains and malts
if ((empty($_SESSION['grains_'.$prefix_session])) || ($_SESSION['grains_'.$prefix_session] != $prefix_session)) {

    $query_grains = "SELECT * FROM malt ORDER BY id ASC";
    $grains = mysqli_query($connection,$query_grains) or die (mysqli_error($connection));
    $grains_array = array();
    while ($row_grains = mysqli_fetch_array($grains, MYSQL_ASSOC)) {
        $grains_array[] = $row_grains;
    }

    $_SESSION['grains'] = $grains_array;
    $_SESSION['grains_'.$prefix_session] = $prefix_session;
}

// BJCP 2008 styles
if ((empty($_SESSION['styles2008_'.$prefix_session])) || ($_SESSION['styles2008_'.$prefix_session] != $prefix_session)) {

    $query_styles = "SELECT * FROM styles WHERE brewStyleVersion='BJCP2008' ORDER BY brewStyleGroup,brewStyleNum ASC";
    $styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
    $styles_array = array();
    while ($row_styles = mysqli_fetch_array($styles, MYSQL_ASSOC)) {
        $styles_array[] = $row_styles;
    }

    $_SESSION['styles2008'] = $styles_array;
    $_SESSION['styles2008_'.$prefix_session] = $prefix_session;
}

// BJCP 2015 styles
if ((empty($_SESSION['styles2015_'.$prefix_session])) || ($_SESSION['styles2015_'.$prefix_session] != $prefix_session)) {

    $query_styles = "SELECT * FROM styles WHERE brewStyleVersion='BJCP2015' ORDER BY brewStyleGroup,brewStyleNum ASC";
    $styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
    $styles_array = array();
    while ($row_styles = mysqli_fetch_array($styles, MYSQL_ASSOC)) {
        $styles_array[] = $row_styles;
    }

    $_SESSION['styles2015'] = $styles_array;
    $_SESSION['styles2015_'.$prefix_session] = $prefix_session;
}

// Close session writing.
session_write_close();

?>