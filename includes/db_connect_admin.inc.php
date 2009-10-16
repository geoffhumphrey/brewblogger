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

mysql_select_db($database_brewing, $brewing);
$query_brewing = "SELECT * FROM brewing"; 
if ($filter != "all") $query_brewing .= " WHERE brewBrewerID='$filter'";
$query_brewing .= " ORDER BY $sort $dir";
$brewing = mysql_query($query_brewing, $brewing) or die(mysql_error());
$row_brewing = mysql_fetch_assoc($brewing);
$totalRows_brewing = mysql_num_rows($brewing);

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

mysql_select_db($database_brewing, $brewing);

$query_log = "SELECT * FROM recipes";
if (($filter != "all") && ($view == "limited")) $query_log .= " WHERE brewBrewerID='$filter'";
$query_log .= " ORDER BY $sort $dir";
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);

$query_theme = "SELECT * FROM brewingcss";
$theme = mysql_query($query_theme) or die(mysql_error());
$row_theme = mysql_fetch_assoc($theme);
$totalRows_theme = mysql_num_rows($theme);

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
		($dbTable == "sugar_type")  ||
		($dbTable == "water_profiles")  ||
		($dbTable == "equip_profiles")  ||
		($dbTable == "yeast_profiles")  ||
		($dbTable == "mash_profiles")
		)
	)
) 

{
mysql_select_db($database_brewing, $brewing);
$query_log = "SELECT * FROM brewing";
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);

$query_styles = "SELECT * FROM styles ORDER BY brewStyleGroup,brewStyleNum ASC";
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);

$query_links = "SELECT * FROM brewerlinks ORDER BY brewerLinkName ASC";
$links = mysql_query($query_links, $brewing) or die(mysql_error());
$row_links = mysql_fetch_assoc($links);
$totalRows_links = mysql_num_rows($links);

$query_users = "SELECT * FROM users ORDER BY realLastName ASC";
$users = mysql_query($query_users, $brewing) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$totalRows_users = mysql_num_rows($users);

$query_extracts = "SELECT * FROM extract ORDER BY extractName ASC";
$extracts = mysql_query($query_extracts, $brewing) or die(mysql_error());
$row_extracts = mysql_fetch_assoc($extracts);
$totalRows_extracts = mysql_num_rows($extracts);

$query_misc = "SELECT * FROM misc ORDER BY miscName ASC";
$misc = mysql_query($query_misc, $brewing) or die(mysql_error());
$row_misc = mysql_fetch_assoc($misc);
$totalRows_misc = mysql_num_rows($misc);

$query_yeast_profiles = "SELECT * FROM yeast_profiles ORDER BY yeastLab,yeastName ASC";
$yeast_profiles = mysql_query($query_yeast_profiles, $brewing) or die(mysql_error());
$row_yeast_profiles = mysql_fetch_assoc($yeast_profiles);
$totalRows_yeast_profiles = mysql_num_rows($yeast_profiles);

$query_adjuncts = "SELECT * FROM adjuncts ORDER BY adjunctName ASC";
$adjuncts = mysql_query($query_adjuncts, $brewing) or die(mysql_error());
$row_adjuncts = mysql_fetch_assoc($adjuncts);
$totalRows_adjuncts = mysql_num_rows($adjuncts);

$query_news = "SELECT * FROM news ORDER BY newsDate DESC";
$news = mysql_query($query_news, $brewing) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);

$query_review = "SELECT * FROM reviews";
$review = mysql_query($query_review, $brewing) or die(mysql_error());
$row_review = mysql_fetch_assoc($review);
$totalRows_review = mysql_num_rows($review);

$query_hops = "SELECT * FROM hops ORDER BY hopsName ASC";
$hops = mysql_query($query_hops, $brewing) or die(mysql_error());
$row_hops = mysql_fetch_assoc($hops);
$totalRows_hops = mysql_num_rows($hops); 

$query_grains = "SELECT * FROM malt ORDER BY maltName ASC";
$grains = mysql_query($query_grains, $brewing) or die(mysql_error());
$row_grains = mysql_fetch_assoc($grains);
$totalRows_grains = mysql_num_rows($grains);

$query_mash_profiles = "SELECT * FROM mash_profiles ORDER BY mashProfileName ASC";
$mash_profiles = mysql_query($query_mash_profiles, $brewing) or die(mysql_error());
$row_mash_profiles = mysql_fetch_assoc($mash_profiles);
$totalRows_mash_profiles = mysql_num_rows($mash_profiles);

$query_water_profiles = "SELECT * FROM water_profiles ORDER BY waterName ASC";
$water_profiles = mysql_query($query_water_profiles, $brewing) or die(mysql_error());
$row_water_profiles = mysql_fetch_assoc($water_profiles);
$totalRows_water_profiles = mysql_num_rows($water_profiles);

$query_equip_profiles = "SELECT * FROM equip_profiles ORDER BY equipProfileName ASC";
$equip_profiles = mysql_query($query_equip_profiles, $brewing) or die(mysql_error());
$row_equip_profiles = mysql_fetch_assoc($equip_profiles);
$totalRows_equip_profiles = mysql_num_rows($equip_profiles);

$query_sugar_type = "SELECT * FROM sugar_type";
if (($action == "edit") && ($dbTable == "sugar_type")) $query_sugar_type .= " WHERE id=$id"; else $query_sugar_type .= " ORDER BY sugarName ASC"; 
$sugar_type = mysql_query($query_sugar_type, $brewing) or die(mysql_error());
$row_sugar_type = mysql_fetch_assoc($sugar_type);
$totalRows_sugar_type = mysql_num_rows($sugar_type);
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

mysql_select_db($database_brewing, $brewing);
$query_styles = "SELECT * FROM styles ORDER BY $sort $dir";
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
}

if ($dbTable == "hops") {
	$sort = "hopsName";
	if (isset($_GET['sort'])) {
  		$sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
		}

mysql_select_db($database_brewing, $brewing);
$query_hops = "SELECT * FROM hops ORDER BY $sort $dir";
$hops = mysql_query($query_hops, $brewing) or die(mysql_error());
$row_hops = mysql_fetch_assoc($hops);
$totalRows_hops = mysql_num_rows($hops);
}

if ($dbTable == "malt") {
	$sort = "maltName";
	if (isset($_GET['sort'])) {
  		$sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
		}


mysql_select_db($database_brewing, $brewing);
$query_grains = "SELECT * FROM malt ORDER BY $sort $dir";
$grains = mysql_query($query_grains, $brewing) or die(mysql_error());
$row_grains = mysql_fetch_assoc($grains);
$totalRows_grains = mysql_num_rows($grains);
}

}





/* if (($action == "list") && ($dbTable == "awards")) {
mysql_select_db($database_brewing, $brewing);
$query_awards = "SELECT * FROM awards";
if ($filter != "all") $query_awards .= " WHERE awardBrewerID='$filter'";
$query_awards .= " ORDER BY $sort $dir";
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}
*/

if ($action == "delete") {
if ((isset($_GET['id'])) && ($_GET['id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM $dbTable WHERE id='%s'", GetSQLValueString($_GET['id'], "int"));
  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($deleteSQL, $brewing) or die(mysql_error());
  }
  $insertGoTo = "index.php?page=delWithCon&action=list&dbTable=".$dbTable."&confirm=true&msg=3";
  header(sprintf("Location: %s", $insertGoTo));
}

// ---------------------- If upcoming List ----------------------------------------
if (($action == "list") && ($dbTable == "upcoming")) {
// Upcoming if User Mode 1
if (($row_user['userLevel'] == "1") && ($filter == "all")) {
mysql_select_db($database_brewing, $brewing);
$query_upcoming = "SELECT * FROM upcoming ORDER BY upcomingDate,upcoming ASC";
$upcoming = mysql_query($query_upcoming, $brewing) or die(mysql_error());
$row_upcoming = mysql_fetch_assoc($upcoming);
$totalRows_upcoming = mysql_num_rows($upcoming);
}
if (($row_user['userLevel'] == "1") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming ASC", $filter);
$upcoming = mysql_query($query_upcoming, $brewing) or die(mysql_error());
$row_upcoming = mysql_fetch_assoc($upcoming);
$totalRows_upcoming = mysql_num_rows($upcoming);
}

// Upcoming if User Mode 2
if ($row_user['userLevel'] == "2") {
mysql_select_db($database_brewing, $brewing);
$query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming ASC", $loginUsername);
$upcoming = mysql_query($query_upcoming, $brewing) or die(mysql_error());
$row_upcoming = mysql_fetch_assoc($upcoming);
$totalRows_upcoming = mysql_num_rows($upcoming);
}
}

// ---------------------- If Awards List ----------------------------------------
if (($action == "list") && ($dbTable == "awards")) {
// Awards if User Mode 1
if (($row_user['userLevel'] == "1") && ($filter == "all")) {
mysql_select_db($database_brewing, $brewing);
$query_awards = "SELECT * FROM awards ORDER BY awardDate DESC";
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}

if (($row_user['userLevel'] == "1") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$query_awards = sprintf("SELECT * FROM awards WHERE brewBrewerID='%s' ORDER BY  awardDate DESC", $filter);
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}

// Awards if User Mode 2
if ($row_user['userLevel'] == "2") {
mysql_select_db($database_brewing, $brewing);
$query_awards = sprintf("SELECT * FROM awards WHERE brewBrewerID='%s' ORDER BY  awardDate DESC", $filter);
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}
}

// ---------------------- If Reviews List ----------------------------------------

if ($dbTable == "reviews") {

mysql_select_db($database_brewing, $brewing);
$query_review = "SELECT * FROM reviews";
if ((($row_user['userLevel'] == "1") && ($filter != "all")) || ($row_user['userLevel'] == "2")) $query_review .= " WHERE brewBrewerID='$filter'";
$review = mysql_query($query_review, $brewing) or die(mysql_error());
$row_review = mysql_fetch_assoc($review);
$totalRows_review = mysql_num_rows($review);

$query_log2 = "SELECT * FROM brewing";
if ($row_user['userLevel'] == "2") $query_log2 .= " WHERE brewBrewerID='$loginUsername'";
$query_log2 .= " ORDER by brewName ASC";
$log2 = mysql_query($query_log2, $brewing) or die(mysql_error());
$row_log2 = mysql_fetch_assoc($log2);
$totalRows_log2 = mysql_num_rows($log2);
}

?>