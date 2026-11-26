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

if (isset($row_pref['home'])) $page = $row_pref['home'];
else $page = "default";
if (isset($_GET['page'])) $page = sterilize($_GET['page']);

$section = "default";
if (isset($_GET['section'])) $section = sterilize($_GET['section']);

$action = "default";
if (isset($_GET['action'])) $action = sterilize($_GET['action']);

$filter = "all";
if (isset($_GET['filter'])) $filter = sterilize($_GET['filter']);

$id = "default";
if (isset($_GET['id'])) $id = sterilize($_GET['id']);

$sid = "default";
if (isset($_GET['sid'])) $sid = sterilize($_GET['sid']);

$dbTable = "default";
if (isset($_GET['dbTable'])) $dbTable = sterilize($_GET['dbTable']);

$style = "all";
if (isset($_GET['style'])) $style = sterilize($_GET['style']);

$view = "limited";
if (isset($_GET['view'])) $view = sterilize($_GET['view']);

$source = "default";
if (isset($_GET['source'])) $source = sterilize($_GET['source']);

$assoc = "default";
if (isset($_GET['assoc'])) $assoc = sterilize($_GET['assoc']);

$confirm = "new";
if (isset($_GET['confirm'])) $confirm = sterilize($_GET['confirm']);

$msg = "default";
if (isset($_GET['msg'])) $msg = sterilize($_GET['msg']);

$amt = "default";
if (isset($_GET['amt'])) $msg = sterilize($_GET['amt']);

$theme = "dark";
if (isset($_GET['theme'])) $theme = sterilize($_GET['theme']);

$autorefresh = "true";
if (isset($_GET['autorefresh'])) $autorefresh = sterilize($_GET['autorefresh']);

?>