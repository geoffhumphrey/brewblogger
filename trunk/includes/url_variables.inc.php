<?php 
$dbTable = "default";
if (isset($_GET['dbTable'])) {
  	$dbTable = (get_magic_quotes_gpc()) ? $_GET['dbTable'] : addslashes($_GET['dbTable']);
}

$action = "default";
if (isset($_GET['action'])) {
  	$action = (get_magic_quotes_gpc()) ? $_GET['action'] : addslashes($_GET['action']);
}

$id = "default";
if (isset($_GET['id'])) {
  	$id = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}

$filter = "all";
if (isset($_GET['filter'])) {
  	$filter = (get_magic_quotes_gpc()) ? $_GET['filter'] : addslashes($_GET['filter']);
}

$style = "all";
if (isset($_GET['style'])) {
  	$style = (get_magic_quotes_gpc()) ? $_GET['style'] : addslashes($_GET['style']);
}

$section = "default";
if (isset($_GET['section'])) {
  	$section = (get_magic_quotes_gpc()) ? $_GET['section'] : addslashes($_GET['section']);
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
if (is_numeric($_GET['id'])) {
	$colname_log = (get_magic_quotes_gpc()) ? $_GET['id'] : addslashes($_GET['id']);
}

?>