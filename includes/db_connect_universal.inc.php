<?php
// Get server's PHP version
$phpVersion = phpversion();
//echo $phpVersion;
if (!isset($_SESSION)) {
	session_start();
}

// if (DEBUG) $_SESSION['loginUsername'] = "geoff";

$currentPage = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
if (!empty($_SERVER["QUERY_STRING"])) $currentPage .= "?".$_SERVER['QUERY_STRING'];
$loginUsername = NULL;
if (isset($_SESSION['loginUsername']) && !empty($_SESSION["loginUsername"])) $loginUsername = $_SESSION["loginUsername"];

// Universal DB Connections

// -----------------------------------------------------------------------------------------------
// Name

$query_name = "SELECT * FROM brewer";
$name = mysqli_query($connection,$query_name) or die (mysqli_error($connection));
$row_name = mysqli_fetch_assoc($name);
$totalRows_name = mysqli_num_rows($name);

// -----------------------------------------------------------------------------------------------
// Preferences

$query_pref = "SELECT * FROM preferences";
$pref = mysqli_query($connection,$query_pref) or die (mysqli_error($connection));
$row_pref = mysqli_fetch_assoc($pref);
$totalRows_pref = mysqli_num_rows($pref);

// -----------------------------------------------------------------------------------------------
// Theme

$query_theme = "SELECT * FROM brewingcss";
$theme = mysqli_query($connection,$query_theme) or die (mysqli_error($connection));
$row_theme = mysqli_fetch_assoc($theme);
$totalRows_theme = mysqli_num_rows($theme);

// -----------------------------------------------------------------------------------------------
// Alternating Color Choice

$query_colorChoose = sprintf("SELECT * FROM brewingcss WHERE theme='%s'", $row_pref['theme']);
$colorChoose = mysqli_query($connection,$query_colorChoose) or die (mysqli_error($connection));
$row_colorChoose = mysqli_fetch_assoc($colorChoose);
$totalRows_colorChoose = mysqli_num_rows($colorChoose);

// -----------------------------------------------------------------------------------------------
// User Info
if (isset($_SESSION['loginUsername'])) {
	$query_user = sprintf("SELECT * FROM users WHERE user_name = '%s'", $_SESSION['loginUsername']);
	$user = mysqli_query($connection,$query_user) or die (mysqli_error($connection));
	$row_user = mysqli_fetch_assoc($user);
	$totalRows_user = mysqli_num_rows($user);
}

?>
