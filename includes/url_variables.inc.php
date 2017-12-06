<?php
/*
---------------------------------------------
Post-UI Conversion Pattern for public pages

$page
$section
$action (default to view)
$filter
$id

---------------------------------------------
Post-UI Conversion Pattern for admin pages
Match to public pages

$page
$section
$action (add, edit)
$filter (in place of $dbTable)
$id (for editing)

*/

// Begin Public

$page = $row_pref['home'];
if (isset($_GET['page'])) {
  $page = (get_magic_quotes_gpc()) ? $_GET['page'] : addslashes($_GET['page']);
}

$section = "default";
if (isset($_GET['section'])) {
  $section = (get_magic_quotes_gpc()) ? $_GET['section'] : addslashes($_GET['section']);
}

$filter = "all";
if (isset($_GET['filter'])) {
  	$filter = (get_magic_quotes_gpc()) ? $_GET['filter'] : addslashes($_GET['filter']);
}

$id = "default";
if (isset($_GET['id'])) {
  	$id = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}

$dbTable = "default";
if (isset($_GET['dbTable'])) {
  	$dbTable = (get_magic_quotes_gpc()) ? $_GET['dbTable'] : addslashes($_GET['dbTable']);
}

$action = "default";
if (isset($_GET['action'])) {
  	$action = (get_magic_quotes_gpc()) ? $_GET['action'] : addslashes($_GET['action']);
}

$style = "all";
if (isset($_GET['style'])) {
  	$style = (get_magic_quotes_gpc()) ? $_GET['style'] : addslashes($_GET['style']);
}

$view = "limited";
if (isset($_GET['view'])) {
  	$view = (get_magic_quotes_gpc()) ? $_GET['view'] : addslashes($_GET['view']);
}

$source = "default";
if (isset($_GET['source'])) {
  	$source = (get_magic_quotes_gpc()) ? $_GET['source'] : addslashes($_GET['source']);
}

$assoc = "default";
if (isset($_GET['assoc'])) {
  	$assoc = (get_magic_quotes_gpc()) ? $_GET['assoc'] : addslashes($_GET['assoc']);
}

$confirm = "default";
if (isset($_GET['confirm'])) {
  	$confirm = (get_magic_quotes_gpc()) ? $_GET['confirm'] : addslashes($_GET['confirm']);
}

$msg = "default";
if (isset($_GET['msg'])) {
  	$msg = (get_magic_quotes_gpc()) ? $_GET['msg'] : addslashes($_GET['msg']);
}

$calculate = "default";
if (isset($_GET['calculate'])) {
  	$calculate = (get_magic_quotes_gpc()) ? $_GET['calculate'] : addslashes($_GET['calculate']);
}

$results = "false";
if (isset($_GET['results'])) {
  	$results = (get_magic_quotes_gpc()) ? $_GET['results'] : addslashes($_GET['results']);
}

$reset = "default";
if (isset($_GET['reset'])) {
  	$reset = (get_magic_quotes_gpc()) ? $_GET['reset'] : addslashes($_GET['reset']);
}

$amt = "default";
if (isset($_GET['amt'])) {
  	$amt = (get_magic_quotes_gpc()) ? $_GET['amt'] : addslashes($_GET['amt']);
}

$colname_log = "-1";
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$colname_log = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}

$sort = "brewDate";
if (isset($_GET['sort'])) {
  $sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
}

$dir = "DESC";
if (isset($_GET['dir'])) {
  $dir = (get_magic_quotes_gpc()) ? $_GET['dir'] : addslashes($_GET['dir']);
}

$source = "reference";
if (isset($_GET['source'])) {
  $source = (get_magic_quotes_gpc()) ? $_GET['source'] : addslashes($_GET['source']);
}

?>