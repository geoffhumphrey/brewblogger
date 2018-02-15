<?php
// -----------------------------------------------------------------------------------------------
// Generic Recipe Connection

$query_recipes = "SELECT * FROM recipes";
//if (($page == "admin") && ($_SESSION['mode'] == "2")) $query_recipes .= " WHERE brewBrewerID = '$loginUsername'";
$query_recipes .= " ORDER BY brewName ASC";
$recipes = mysqli_query($connection,$query_recipes) or die (mysqli_error($connection));
$row_recipes = mysqli_fetch_assoc($recipes);
$totalRows_recipes = mysqli_num_rows($recipes);

// -----------------------------------------------------------------------------------------------
// Generic BrewBlog Connection

$query_brewBlogs = "SELECT * FROM brewing";
if (($page == "admin") && ($_SESSION['mode'] == "2") && ($row_user['userLevel'] == "2")) $query_brewBlogs .= " WHERE brewBrewerID = '$loginUsername'";
$query_brewBlogs .= " ORDER BY brewName ASC";
$brewBlogs = mysqli_query($connection,$query_brewBlogs) or die (mysqli_error($connection));
$row_brewBlogs = mysqli_fetch_assoc($brewBlogs);
$totalRows_brewBlogs = mysqli_num_rows($brewBlogs);


// -----------------------------------------------------------------------------------------------
// News
$query_newsGen = "SELECT * FROM news";
if (($page == "news") || ($page == $_SESSION['home'])) $query_newsGen .= " WHERE newsPrivate='Y' ORDER BY newsDate DESC";
if ($page == "admin") $query_newsGen .= " WHERE newsPrivate='N' ORDER BY newsDate DESC";
$newsGen = mysqli_query($connection,$query_newsGen) or die (mysqli_error($connection));
$row_newsGen = mysqli_fetch_assoc($newsGen);
$totalRows_newsGen = mysqli_num_rows($newsGen);

/*
if (($page == "current") || ($page == "brewblog") || ($page == "recipe") || ($page == "recipe-list")) $sort = "brewName";
elseif ($page == "awards-list") $sort = "awardBrewName";
elseif ($page == "members") $sort = "realLastName";
elseif ($page == "brewblog-list") $sort = "brewDate";
else $sort = "default";
if (isset($_GET['sort'])) {
  $sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
}

if ($page == "brewblog-list") $dir = "DESC";
else $dir = "ASC";
if (isset($_GET['dir'])) {
  $dir = (get_magic_quotes_gpc()) ? $_GET['dir'] : addslashes($_GET['dir']);
}

// Scale Recipe Calculations //
if ($action == "scale") {
if ($page == "logPrint") { $amt = (get_magic_quotes_gpc()) ? $_GET['amt'] : addslashes($_GET['amt']); }
elseif ($page == "recipePrint") { $amt = (get_magic_quotes_gpc()) ? $_GET['amt'] : addslashes($_GET['amt']); }
else $amt =  $_POST['amt'];
}
*/

// -----------------------------------------------------------------------------------------------
// News (Club Edition only)

if ($_SESSION['mode'] == "2") {

	$query_news = "SELECT * FROM news";
	if ($page == $_SESSION['home']) $query_news .= " ORDER BY newsDate DESC LIMIT 2";
	if (($page == "news") && ($view != "all")) $query_news .= " WHERE newsPrivate='Y' ORDER BY $sort $dir LIMIT $view";
	if (($page == "news") && ($view == "all")) $query_news .= " WHERE newsPrivate='Y' ORDER BY $sort $dir";
	$news = mysqli_query($connection,$query_news) or die (mysqli_error($connection));
	$row_news = mysqli_fetch_assoc($news);
	$totalRows_news = mysqli_num_rows($news);

}

// -----------------------------------------------------------------------------------------------
// Current BrewBlog

if ($page == "current") {

	$query_log = "SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' OR brewArchive='No' ORDER BY brewDate DESC";
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);
	$totalRows_log = mysqli_num_rows($log);

}

if (($page == "brewblog-list") || (($page == "admin") && ($section == "brewblogs") && ($action == "manage"))) {

	if ((($_SESSION['mode'] == "2") && ($filter == "all")) || ($_SESSION['mode'] == "1")) {
		$query_log = "SELECT * FROM brewing";
		if ($style != "all") $view == "all";
	}

	if (($_SESSION['mode'] == "2") && ($filter != "all")) {
		$query_log = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s'", $filter);
	}

	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);
	$totalRows_log = mysqli_num_rows($log);

}

if (($page == "brewblog") || ($page == "logPrint") || (($page == "recipePrint") && ($dbTable == "default"))) {

	$query_log = sprintf("SELECT * FROM brewing WHERE id = '%s'", $id);
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);
	$totalRows_log = mysqli_num_rows($log);

	if (!empty($row_log['brewYeastProfile'])) {

		$query_yeast_profiles = sprintf("SELECT * FROM yeast_profiles WHERE id='%s'", $row_log['brewYeastProfile']);
		$yeast_profiles = mysqli_query($connection,$query_yeast_profiles) or die (mysqli_error($connection));
		$row_yeast_profiles = mysqli_fetch_assoc($yeast_profiles);

	}

}

if (($page == "admin") && ($section == "brewblogs") && ($action == "edit")) {

	$query_log = sprintf("SELECT * FROM brewing WHERE id = '%s'", $id);
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);
	$totalRows_log = mysqli_num_rows($log);

}

// -----------------------------------------------------------------------------------------------
// BrewBlog List

if ($page == "brewblog-list") {

	if (($_SESSION['mode'] == "1") || (($_SESSION['mode'] == "2") && ($filter == "all"))) {

		$query_log = "SELECT * FROM brewing";
		if ($style != "all") $query_log .= " WHERE brewStyle='$style' AND"; else $query_log .= " WHERE";
		$query_log .= " NOT brewArchive='Y'";

	}

	if (($_SESSION['mode'] == "2") && ($filter != "all")) {

		$query_log = "SELECT * FROM brewing WHERE brewBrewerID='$filter'";
		if ($style != "all") $query_log .= " AND brewStyle='$style'";
		$query_log .= " AND NOT brewArchive='Y'";

	}

	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);
	$totalRows_log = mysqli_num_rows($log);

}


// -----------------------------------------------------------------------------------------------
// Sidebar List
if (($page == "current") || ($page == "brewblog") || ($page == "profile")) {

	if ($_SESSION['mode'] == "1") {
		$query_list = sprintf("SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' AND brewDate <= '%s' ORDER BY brewDate DESC LIMIT %s",$row_log['brewDate'],MAX_SIDEBAR_BLOGS);
	}

	if (($_SESSION['mode'] == "2") && ($filter == "all")) {
		$query_list = sprintf("SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' AND brewDate <= '%s' ORDER BY brewDate LIMIT %s",$row_log['brewDate'],MAX_SIDEBAR_BLOGS);
	}

	if (($_SESSION['mode'] == "2") && ($filter != "all")) {
		$query_list = sprintf("SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' AND brewBrewerID = '%s' AND brewDate <= '%s' ORDER BY brewDate DESC LIMIT %s",$filter, $row_log['brewDate'],MAX_SIDEBAR_BLOGS);
	}

	if ($page == "about") {
		$query_list = "SELECT * FROM brewerlinks ORDER BY brewerLinkName ASC";
	}

	$list = mysqli_query($connection,$query_list);
	$row_list = mysqli_fetch_assoc($list);
	$totalRows_list = mysqli_num_rows($list);

}


/*
// -----------------------------------------------------------------------------------------------
// REVIEWS
if (($page =="current") || ($page =="brewblog")) {
	if ($view == "limited") {
	$maxRows_review = 5;
	$pageNum_review = 0;
	if (isset($_GET['pageNum_review'])) {
	  $pageNum_review = $_GET['pageNum_review'];
	}
	$startRow_review = $pageNum_review * $maxRows_review;
	}
	$colname_review = "1";
	if (isset($_GET['brewID'])) {
	  $colname_review = (get_magic_quotes_gpc()) ? $_GET['brewID'] : addslashes($_GET['brewID']);
	}

	$query_review = sprintf("SELECT * FROM reviews WHERE brewID ='".$row_log['id']."' ORDER BY id DESC");
	if ($view == "limited") {
	$query_limit_review = sprintf("%s LIMIT %d, %d", $query_review, $startRow_review, $maxRows_review);
	$review = mysqli_query($connection,$query_limit_review) or die (mysqli_error($connection));
	} else
	$review = mysqli_query($connection,$query_review) or die (mysqli_error($connection));
	$row_review = mysqli_fetch_assoc($review);

	if (isset($_GET['totalRows_review'])) {
	  $totalRows_review = $_GET['totalRows_review'];
	} else {
	  $all_review = mysqli_query($connection,$query_review);
	  $totalRows_review = mysqli_num_rows($all_review);
	}
	$totalPages_review = ceil($totalRows_review/$maxRows_review)-1;
}
// -----------------------------------------------------------------------------------------------
*/

// Recipe List
if (($page == "recipe-list") || (($page == "admin") && ($section == "recipes") && ($action == "manage"))) {

	if ($_SESSION['mode'] == "1") {

		$query_recipes = "SELECT count(*) FROM recipes";
		if ($style != "all") $query_recipes .= " WHERE brewStyle='$style' AND"; else $query_recipes .= " WHERE";
		$query_recipes .= " brewArchive!='Y'";
		$recipes = mysqli_query($connection,$query_recipes) or die (mysqli_error($connection));
		$row_recipes = mysqli_fetch_assoc($recipes);

		$query_log = "SELECT * FROM recipes";
		if ($style != "all") $query_log.= " WHERE brewStyle='$style' AND"; else $query_log .= " WHERE";
		$query_log .= " brewArchive!='Y'";

	}


	if (($_SESSION['mode'] == "2") && ($filter == "all")) {

		$query_log = "SELECT * FROM recipes";
		if ($style != "all") $query_log.= " WHERE brewStyle='$style' AND"; else $query_log.= " WHERE";
		$query_log .= " NOT brewArchive='Y'";

	}

	if (($_SESSION['mode'] == "2") && ($filter != "all")) {

		$query_log = sprintf("SELECT * FROM %s WHERE brewBrewerID='%s'","recipes",$filter);
		$query_log .= " AND NOT brewArchive='Y'";

	}

	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);

}

// Recipe Detail pages

if (($page == "recipe") || (($page == "recipePrint") && ($dbTable == "recipes"))) {

	$query_log = sprintf("SELECT * FROM recipes WHERE id = '%s'", $colname_log);
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);
	$totalRows_log = mysqli_num_rows($log);

}

// -----------------------------------------------------------------------------------------------
// Awards List

if ($page == "awards-list") {

	if ($_SESSION['mode'] == "1") {
		$query_awardsList = sprintf("SELECT * FROM %s", "awards");
	}

	if (($_SESSION['mode'] == "2") && ($filter == "all")) {
		$query_awardsList = sprintf("SELECT * FROM %s", "awards");
	}

	if (($_SESSION['mode'] == "2") && ($filter != "all")) {
		$query_awardsList = sprintf("SELECT * FROM %s WHERE brewBrewerID='%s'", "awards",$filter);
	}

	$awardsList = mysqli_query($connection,$query_awardsList) or die(mysql_error());
	$row_awardsList = mysqli_fetch_assoc($awardsList);
	$totalRows_awardsList = mysqli_num_rows($awardsList);

}

// -----------------------------------------------------------------------------------------------
//Awards

if (($page == "current") || ($page == "brewblog")) {

	$awardNewID = "b".$row_log['id'];
	$query_awards = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
	$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
	$row_awards = mysqli_fetch_assoc($awards);
	$totalRows_awards = mysqli_num_rows($awards);

}

if ($page == "recipe") {

	$awardNewID = "r".$row_log['id'];
	$query_awards = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
	$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
	$row_awards = mysqli_fetch_assoc($awards);
	$totalRows_awards = mysqli_num_rows($awards);

}

if ($page == "profile") {

	$query_awards = sprintf("SELECT * FROM awards WHERE brewBrewerID='%s'", $filter);
	$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
	$row_awards = mysqli_fetch_assoc($awards);
	$totalRows_awards = mysqli_num_rows($awards);

}

/*
// -----------------------------------------------------------------------------------------------
// Status - single user
// DEPRECATE
if ($_SESSION['mode'] == "1") {

	$countStatus = "SELECT id FROM brewing WHERE brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName ASC";
	$query_count = mysqli_query($connection,$countStatus) or die (mysqli_error($connection));
	$total_status = mysqli_num_rows($query_count);

	$query_status = "SELECT * FROM brewing WHERE brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName ASC";
	if ($total_status > 25) $query_status .= " LIMIT 25";
	$status = mysqli_query($connection,$query_status) or die (mysqli_error($connection));
	$row_status = mysqli_fetch_assoc($status);
	$totalRows_status = mysqli_num_rows($status);

}


// Status - multi-user
// DEPRECATE
if ($_SESSION['mode'] == "2") {

$countStatus = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' AND brewStatus NOT LIKE '' AND brewArchive NOT LIKE '%s' ORDER BY brewStatus,brewName ASC", $filter, "Y");
$query_count = mysqli_query($connection,$countStatus) or die (mysqli_error($connection));
$total_status = mysqli_num_rows($query_count);


if ($page == "profile") $query_status = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' AND brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName ASC", $filter);
else $query_status = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' AND brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName,brewDate DESC", $row_log['brewBrewerID']);
if ($total_status > 25) $query_status .= " LIMIT 25";
$status = mysqli_query($connection,$query_status) or die (mysqli_error($connection));
$row_status = mysqli_fetch_assoc($status);
$totalRows_status = mysqli_num_rows($status);
}


// -----------------------------------------------------------------------------------------------
// DEPRECATE
// Upcoming if User Mode 1
if ($_SESSION['mode'] == "1") {


$countUp = "SELECT * FROM upcoming";
$query_countUp = mysqli_query($connection,$countUp) or die (mysqli_error($connection));
$total_upcoming = mysqli_num_rows($query_countUp);



$query_upcoming = "SELECT * FROM upcoming ORDER BY upcomingDate,upcoming DESC";
if ($total_upcoming > 10) $query_upcoming .= " LIMIT 10";
$upcoming = mysqli_query($connection,$query_upcoming) or die (mysqli_error($connection));
$row_upcoming = mysqli_fetch_assoc($upcoming);
$totalRows_upcoming = mysqli_num_rows($upcoming);
}

//Upcoming if User Mode 2
if ($_SESSION['mode'] == "2") {
if ($filter != "all") {

$countUp = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s'", $filter);
$query_countUp = mysqli_query($connection,$countUp) or die (mysqli_error($connection));
$total_upcoming = mysqli_num_rows($query_countUp);


if ($page == "profile") $query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming DESC", $filter);
else $query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming DESC", $row_log['brewBrewerID']);
if ($total_upcoming > 10) $query_upcoming .= " LIMIT 10";
$upcoming = mysqli_query($connection,$query_upcoming) or die (mysqli_error($connection));
$row_upcoming = mysqli_fetch_assoc($upcoming);
$totalRows_upcoming = mysqli_num_rows($upcoming);
}

if ($filter == "all") {
$query_upcoming = "SELECT * FROM upcoming ORDER BY upcomingDate,upcoming ASC";
$upcoming = mysqli_query($connection,$query_upcoming) or die (mysqli_error($connection));
$row_upcoming = mysqli_fetch_assoc($upcoming);
$totalRows_upcoming = mysqli_num_rows($upcoming);
}
}
// -----------------------------------------------------------------------------------------------

*/

if (($page == "current") || ($page == "brewblog") || ($page == "logPrint") || ($page == "recipePrint")) {

	if (!empty($row_log['brewMashProfile'])) {

		$query_mash_profiles = sprintf("SELECT * FROM mash_profiles WHERE id='%s'", $row_log['brewMashProfile']);
		$mash_profiles = mysqli_query($connection,$query_mash_profiles) or die (mysqli_error($connection));
		$row_mash_profiles = mysqli_fetch_assoc($mash_profiles);
		$totalRows_mash_profiles = mysqli_num_rows($mash_profiles);

		$query_mash_steps = sprintf("SELECT * FROM mash_steps WHERE stepMashProfileID = '%s'", $row_mash_profiles['id']);
		$mash_steps = mysqli_query($connection,$query_mash_steps) or die (mysqli_error($connection));
		$row_mash_steps = mysqli_fetch_assoc($mash_steps);
		$totalRows_mash_steps = mysqli_num_rows($mash_steps);

	}

	if (!empty($row_log['brewWaterProfile'])) {
		$query_water_profiles = sprintf("SELECT * FROM water_profiles WHERE id='%s'", $row_log['brewWaterProfile']);
		$water_profiles = mysqli_query($connection,$query_water_profiles) or die (mysqli_error($connection));
		$row_water_profiles = mysqli_fetch_assoc($water_profiles);
		$totalRows_water_profiles = mysqli_num_rows($water_profiles);
	}

	if (!empty($row_log['brewEquipProfile'])) {
		$query_equip_profiles = sprintf("SELECT * FROM equip_profiles WHERE id='%s'", $row_log['brewEquipProfile']);
		$equip_profiles = mysqli_query($connection,$query_equip_profiles) or die (mysqli_error($connection));
		$row_equip_profiles = mysqli_fetch_assoc($equip_profiles);
		$totalRows_equip_profiles = mysqli_num_rows($equip_profiles);
	}

}

/*
// Featured. DEPRECATE??

if (($page == "brewblog-list") || ($page == "recipe-list")) {

	if ($page == "brewblog-list") $table = "brewing";
	if ($page == "recipe-list") $table = "recipes";

	$query_featured = "SELECT * FROM $table WHERE brewFeatured='Y' ";
	if ($page == "brewblog-list") $query_featured .= "ORDER BY brewDate DESC";
	if ($page == "recipe-list") $query_featured .= "ORDER BY brewName ASC";
	$featured = mysqli_query($connection,$query_featured) or die (mysqli_error($connection));
	$row_featured = mysqli_fetch_assoc($featured);
	$totalRows_featured = mysqli_num_rows($featured);

}
*/
?>

