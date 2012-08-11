<?php
// Get server's PHP version
$phpVersion = phpversion();
//echo $phpVersion;
if (!isset($_SESSION)) {
	session_start();
}

$currentPage = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
if (!empty($_SERVER["QUERY_STRING"])) $currentPage .= "?".$_SERVER['QUERY_STRING'];
$loginUsername = NULL;
if (isset($_SESSION['loginUsername']) && !empty($_SESSION["loginUsername"])) $loginUsername = $_SESSION["loginUsername"];

// Universal DB Connections
mysql_select_db($database_brewing, $brewing);


// -----------------------------------------------------------------------------------------------
// Name

$query_name = "SELECT * FROM brewer";
$name = mysql_query($query_name, $brewing) or die(mysql_error());
$row_name = mysql_fetch_assoc($name);
$totalRows_name = mysql_num_rows($name);

// -----------------------------------------------------------------------------------------------
// Preferences

$query_pref = "SELECT * FROM preferences";
$pref = mysql_query($query_pref, $brewing) or die(mysql_error());
$row_pref = mysql_fetch_assoc($pref);
$totalRows_pref = mysql_num_rows($pref);

if (!isset($page)) {
  $page = $row_pref['home'];
}
if (isset($_GET['page'])) {
  $page = (get_magic_quotes_gpc()) ? $_GET['page'] : addslashes($_GET['page']);
}
// -----------------------------------------------------------------------------------------------
// Theme

$query_theme = "SELECT * FROM brewingcss";
$theme = mysql_query($query_theme, $brewing) or die(mysql_error());
$row_theme = mysql_fetch_assoc($theme);
$totalRows_theme = mysql_num_rows($theme);

// -----------------------------------------------------------------------------------------------
// Alternating Color Choice

$query_colorChoose = sprintf("SELECT * FROM brewingcss WHERE theme='%s'", $row_pref['theme']);
$colorChoose = mysql_query($query_colorChoose, $brewing) or die(mysql_error());
$row_colorChoose = mysql_fetch_assoc($colorChoose);
$totalRows_colorChoose = mysql_num_rows($colorChoose);

// -----------------------------------------------------------------------------------------------
// User Info
if (isset($_SESSION["loginUsername"])) {
$query_user = sprintf("SELECT * FROM users WHERE user_name = '%s'", $_SESSION["loginUsername"]);
$user = mysql_query($query_user, $brewing) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
}

// -----------------------------------------------------------------------------------------------
// User Info

$query_user5 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
$user5 = mysql_query($query_user5, $brewing) or die(mysql_error());
$row_user5 = mysql_fetch_assoc($user5);
$totalRows_user5 = mysql_num_rows($user5);

// -----------------------------------------------------------------------------------------------
// Generic Recipe Connection

$query_recipes = "SELECT * FROM recipes";
//if (($page == "admin") && ($row_pref['mode'] == "2")) $query_recipes .= " WHERE brewBrewerID = '$loginUsername'";
$query_recipes .= " ORDER BY brewName ASC";
$recipes = mysql_query($query_recipes, $brewing) or die(mysql_error());
$row_recipes = mysql_fetch_assoc($recipes);
$totalRows_recipes = mysql_num_rows($recipes);

// -----------------------------------------------------------------------------------------------
// Generic BrewBlog Connection

$query_brewBlogs = "SELECT * FROM brewing";
if (($page == "admin") && ($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) $query_brewBlogs .= " WHERE brewBrewerID = '$loginUsername'";
$query_brewBlogs .= " ORDER BY brewName ASC";
$brewBlogs = mysql_query($query_brewBlogs, $brewing) or die(mysql_error());
$row_brewBlogs = mysql_fetch_assoc($brewBlogs);
$totalRows_brewBlogs = mysql_num_rows($brewBlogs);

// Generic Awards Connection

$query_awardGen = "SELECT * FROM awards";
if (($page == "admin") && ($row_pref['mode'] == "2")) $query_awardGen .= " WHERE brewBrewerID = '$loginUsername'";
$query_awardGen .= " ORDER BY awardBrewName ASC";
$awardGen = mysql_query($query_awardGen, $brewing) or die(mysql_error());
$row_awardGen = mysql_fetch_assoc($awardGen);
$totalRows_awardGen = mysql_num_rows($awardGen);

// -----------------------------------------------------------------------------------------------
// News

$query_newsGen = "SELECT * FROM news";
if (($page == "news") || ($page == $row_pref['home'])) $query_newsGen .= " WHERE newsPrivate='Y' ORDER BY newsDate DESC";
if ($page == "admin") $query_newsGen .= " WHERE newsPrivate='N' ORDER BY newsDate DESC";
$newsGen = mysql_query($query_newsGen, $brewing) or die(mysql_error());
$row_newsGen = mysql_fetch_assoc($newsGen);
$totalRows_newsGen = mysql_num_rows($newsGen);


?>
