<?php 
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

include ('url_variables.inc.php');

$filter = "default";
if ($row_user['userLevel'] == "1") $filter = "all";
if ($row_user['userLevel'] == "2") $filter = $loginUsername;
if (isset($_GET['filter'])) {
  $filter = (get_magic_quotes_gpc()) ? $_GET['filter'] : addslashes($_GET['filter']);
}


// --------------------------- END Globals ------------------------------------------- //

// --------------------------- If Default (BrewBlog List) ---------------------------- //

if (($action == "list") && ($dbTable == "brewing")) { 

$sort = "brewDate";
if (isset($_GET['sort'])) {
  $sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
}

$dir = "DESC";
if (isset($_GET['dir'])) {
  $dir = (get_magic_quotes_gpc()) ? $_GET['dir'] : addslashes($_GET['dir']);
}


$query_brewing = "SELECT * FROM brewing"; 
if ($filter != "all") $query_brewing .= " WHERE brewBrewerID='$filter'";
$query_brewing .= " ORDER BY $sort $dir";
$brewing = mysqli_query($connection,$query_brewing) or die (mysqli_error($connection));
$row_brewing = mysqli_fetch_assoc($brewing);
$totalRows_brewing = mysqli_num_rows($brewing);

}

// --------------------------- END Default ------------------------------------------- //

// --------------------------- If Recipe List -------------------------------------- //

if (($action == "list") && ($dbTable == "recipes")) {

$sort = "brewName";
if (isset($_GET['sort'])) {
  $sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
}

$dir = "ASC";
if (isset($_GET['dir'])) {
  $dir = (get_magic_quotes_gpc()) ? $_GET['dir'] : addslashes($_GET['dir']);
}



$query_log = "SELECT * FROM recipes";
if (($filter != "all") && ($view == "limited")) $query_log .= " WHERE brewBrewerID='$filter'";
$query_log .= " ORDER BY $sort $dir";
$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
$row_log = mysqli_fetch_assoc($log);
$totalRows_log = mysqli_num_rows($log);

$query_theme = "SELECT * FROM brewingcss";
$theme = mysqli_query($connection,$query_theme) or die(mysql_error());
$row_theme = mysqli_fetch_assoc($theme);
$totalRows_theme = mysqli_num_rows($theme);

}





if (
($action == "add") || 
($action == "edit")  || 
($action == "import")  || 
($action == "importRecipe") || 
($action == "importCalc") || 
($action == "reuse") || 
($action == "calculate") || 
	(
	($action == "list") && 
		(
		($dbTable == "brewerlinks") || 
		($dbTable == "users") || 
		($dbTable == "extract") || 
		($dbTable == "adjuncts") || 
		($dbTable == "news") || 
		($dbTable == "misc") || 
		($dbTable == "reviews")  || 
		($dbTable == "water_profiles")  ||
		($dbTable == "equip_profiles")  ||
		($dbTable == "yeast_profiles")  ||
		($dbTable == "mash_profiles")
		)
	)
) 

{

$query_log = "SELECT * FROM brewing";
$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
$row_log = mysqli_fetch_assoc($log);
$totalRows_log = mysqli_num_rows($log);

$query_styles = "SELECT * FROM styles ORDER BY brewStyleGroup,brewStyleNum ASC";
$styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
$row_styles = mysqli_fetch_assoc($styles);
$totalRows_styles = mysqli_num_rows($styles);

$query_links = "SELECT * FROM brewerlinks ORDER BY brewerLinkName ASC";
$links = mysqli_query($connection,$query_links) or die (mysqli_error($connection));
$row_links = mysqli_fetch_assoc($links);
$totalRows_links = mysqli_num_rows($links);

$query_users = "SELECT * FROM users ORDER BY realLastName ASC";
$users = mysqli_query($connection,$query_users) or die (mysqli_error($connection));
$row_users = mysqli_fetch_assoc($users);
$totalRows_users = mysqli_num_rows($users);

$query_extracts = "SELECT * FROM extract ORDER BY extractName ASC";
$extracts = mysqli_query($connection,$query_extracts) or die (mysqli_error($connection));
$row_extracts = mysqli_fetch_assoc($extracts);
$totalRows_extracts = mysqli_num_rows($extracts);

$query_misc = "SELECT * FROM misc ORDER BY miscName ASC";
$misc = mysqli_query($connection,$query_misc) or die (mysqli_error($connection));
$row_misc = mysqli_fetch_assoc($misc);
$totalRows_misc = mysqli_num_rows($misc);

$query_yeast_profiles = "SELECT * FROM yeast_profiles ORDER BY yeastLab,yeastName ASC";
$yeast_profiles = mysqli_query($connection,$query_yeast_profiles) or die (mysqli_error($connection));
$row_yeast_profiles = mysqli_fetch_assoc($yeast_profiles);
$totalRows_yeast_profiles = mysqli_num_rows($yeast_profiles);

$query_adjuncts = "SELECT * FROM adjuncts ORDER BY adjunctName ASC";
$adjuncts = mysqli_query($connection,$query_adjuncts) or die (mysqli_error($connection));
$row_adjuncts = mysqli_fetch_assoc($adjuncts);
$totalRows_adjuncts = mysqli_num_rows($adjuncts);

// echo $query_adjuncts."<br>".$totalRows_adjuncts;

$query_news = "SELECT * FROM news ORDER BY newsDate DESC";
$news = mysqli_query($connection,$query_news) or die (mysqli_error($connection));
$row_news = mysqli_fetch_assoc($news);
$totalRows_news = mysqli_num_rows($news);

$query_review = "SELECT * FROM reviews";
$review = mysqli_query($connection,$query_review) or die (mysqli_error($connection));
$row_review = mysqli_fetch_assoc($review);
$totalRows_review = mysqli_num_rows($review);

$query_hops = "SELECT * FROM hops ORDER BY hopsName ASC";
$hops = mysqli_query($connection,$query_hops) or die (mysqli_error($connection));
$row_hops = mysqli_fetch_assoc($hops);
$totalRows_hops = mysqli_num_rows($hops); 

$query_grains = "SELECT * FROM malt ORDER BY maltName ASC";
$grains = mysqli_query($connection,$query_grains) or die (mysqli_error($connection));
$row_grains = mysqli_fetch_assoc($grains);
$totalRows_grains = mysqli_num_rows($grains);

$query_mash_profiles = "SELECT * FROM mash_profiles ORDER BY mashProfileName ASC";
$mash_profiles = mysqli_query($connection,$query_mash_profiles) or die (mysqli_error($connection));
$row_mash_profiles = mysqli_fetch_assoc($mash_profiles);
$totalRows_mash_profiles = mysqli_num_rows($mash_profiles);

$query_water_profiles = "SELECT * FROM water_profiles ORDER BY waterName ASC";
$water_profiles = mysqli_query($connection,$query_water_profiles) or die (mysqli_error($connection));
$row_water_profiles = mysqli_fetch_assoc($water_profiles);
$totalRows_water_profiles = mysqli_num_rows($water_profiles);

$query_equip_profiles = "SELECT * FROM equip_profiles ORDER BY equipProfileName ASC";
$equip_profiles = mysqli_query($connection,$query_equip_profiles) or die (mysqli_error($connection));
$row_equip_profiles = mysqli_fetch_assoc($equip_profiles);
$totalRows_equip_profiles = mysqli_num_rows($equip_profiles);

}

/* -- Styles list -- */

if (($action == "list") && (($dbTable == "styles") || ($dbTable == "hops") || ($dbTable == "malt"))) { 
$dir = "ASC";
if (isset($_GET['dir'])) {
  $dir = (get_magic_quotes_gpc()) ? $_GET['dir'] : addslashes($_GET['dir']);
}

if ($dbTable == "styles") {
	$sort = "brewStyleGroup,brewStyleNum";
	if (isset($_GET['sort'])) {
  		$sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
		}


$query_styles = "SELECT * FROM styles ORDER BY $sort $dir";
$styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
$row_styles = mysqli_fetch_assoc($styles);
$totalRows_styles = mysqli_num_rows($styles);
}

if ($dbTable == "hops") {
	$sort = "hopsName";
	if (isset($_GET['sort'])) {
  		$sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
		}


$query_hops = "SELECT * FROM hops ORDER BY $sort $dir";
$hops = mysqli_query($connection,$query_hops) or die (mysqli_error($connection));
$row_hops = mysqli_fetch_assoc($hops);
$totalRows_hops = mysqli_num_rows($hops);
}

if ($dbTable == "malt") {
	$sort = "maltName";
	if (isset($_GET['sort'])) {
  		$sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
		}



$query_grains = "SELECT * FROM malt ORDER BY $sort $dir";
$grains = mysqli_query($connection,$query_grains) or die (mysqli_error($connection));
$row_grains = mysqli_fetch_assoc($grains);
$totalRows_grains = mysqli_num_rows($grains);
}

}





/* if (($action == "list") && ($dbTable == "awards")) {

$query_awards = "SELECT * FROM awards";
if ($filter != "all") $query_awards .= " WHERE awardBrewerID='$filter'";
$query_awards .= " ORDER BY $sort $dir";
$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
$row_awards = mysqli_fetch_assoc($awards);
$totalRows_awards = mysqli_num_rows($awards);
}
*/

if ($action == "delete") {
if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM $dbTable WHERE id='%s'", GetSQLValueString($_GET['id'], "int"));
  
  $Result1 = mysqli_query($connection,$deleteSQL) or die (mysqli_error($connection));
  }
  $insertGoTo = "index.php?page=delWithCon&action=list&dbTable=".$dbTable."&confirm=true&msg=3";
  header(sprintf("Location: %s", $insertGoTo));
}

// ---------------------- If upcoming List ----------------------------------------
if (($action == "list") && ($dbTable == "upcoming")) {
// Upcoming if User Mode 1
if (($row_user['userLevel'] == "1") && ($filter == "all")) {

$query_upcoming = "SELECT * FROM upcoming ORDER BY upcomingDate,upcoming ASC";
$upcoming = mysqli_query($connection,$query_upcoming) or die (mysqli_error($connection));
$row_upcoming = mysqli_fetch_assoc($upcoming);
$totalRows_upcoming = mysqli_num_rows($upcoming);
}
if (($row_user['userLevel'] == "1") && ($filter != "all")) {

$query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming ASC", $filter);
$upcoming = mysqli_query($connection,$query_upcoming) or die (mysqli_error($connection));
$row_upcoming = mysqli_fetch_assoc($upcoming);
$totalRows_upcoming = mysqli_num_rows($upcoming);
}

// Upcoming if User Mode 2
if ($row_user['userLevel'] == "2") {

$query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming ASC", $loginUsername);
$upcoming = mysqli_query($connection,$query_upcoming) or die (mysqli_error($connection));
$row_upcoming = mysqli_fetch_assoc($upcoming);
$totalRows_upcoming = mysqli_num_rows($upcoming);
}
}

// ---------------------- If Awards List ----------------------------------------
if (($action == "list") && ($dbTable == "awards")) {
// Awards if User Mode 1
if (($row_user['userLevel'] == "1") && ($filter == "all")) {

$query_awards = "SELECT * FROM awards ORDER BY awardDate DESC";
$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
$row_awards = mysqli_fetch_assoc($awards);
$totalRows_awards = mysqli_num_rows($awards);
}

if (($row_user['userLevel'] == "1") && ($filter != "all")) {

$query_awards = sprintf("SELECT * FROM awards WHERE brewBrewerID='%s' ORDER BY  awardDate DESC", $filter);
$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
$row_awards = mysqli_fetch_assoc($awards);
$totalRows_awards = mysqli_num_rows($awards);
}

// Awards if User Mode 2
if ($row_user['userLevel'] == "2") {

$query_awards = sprintf("SELECT * FROM awards WHERE brewBrewerID='%s' ORDER BY  awardDate DESC", $filter);
$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
$row_awards = mysqli_fetch_assoc($awards);
$totalRows_awards = mysqli_num_rows($awards);
}
}

// ---------------------- If Reviews List ----------------------------------------

if ($dbTable == "reviews") {


$query_review = "SELECT * FROM reviews";
if ((($row_user['userLevel'] == "1") && ($filter != "all")) || ($row_user['userLevel'] == "2")) $query_review .= " WHERE brewBrewerID='$filter'";
$review = mysqli_query($connection,$query_review) or die (mysqli_error($connection));
$row_review = mysqli_fetch_assoc($review);
$totalRows_review = mysqli_num_rows($review);

$query_log2 = "SELECT * FROM brewing";
if ($row_user['userLevel'] == "2") $query_log2 .= " WHERE brewBrewerID='$loginUsername'";
$query_log2 .= " ORDER by brewName ASC";
$log2 = mysqli_query($connection,$query_log2) or die (mysqli_error($connection));
$row_log2 = mysqli_fetch_assoc($log2);
$totalRows_log2 = mysqli_num_rows($log2);
}

?>