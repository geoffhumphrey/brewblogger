<?php
//if ($row_pref['mode'] == "1") $page = "brewBlogCurrent";
//elseif ($row_pref['mode'] == "2") $page = "about";

if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "recipeList")) $sort = "brewName";
elseif ($page == "awardsList") $sort = "awardBrewName";
elseif ($page == "members") $sort = "realLastName";
elseif ($page == "brewBlogList") $sort = "brewDate";
else $sort = "default";
if (isset($_GET['sort'])) {
  $sort = (get_magic_quotes_gpc()) ? $_GET['sort'] : addslashes($_GET['sort']);
}

if ($page == "brewBlogList") $dir = "DESC";
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

// DB Connections
// -----------------------------------------------------------------------------------------------

// News (Club Edition only)
if ($row_pref['mode'] == "2") {
mysql_select_db($database_brewing, $brewing);
$query_news = "SELECT * FROM news";
if ($page == $row_pref['home']) $query_news .= " ORDER BY newsDate DESC LIMIT 2";
if (($page == "news") && ($view != "all")) $query_news .= " WHERE newsPrivate='Y' ORDER BY $sort $dir LIMIT $view";
if (($page == "news") && ($view == "all")) $query_news .= " WHERE newsPrivate='Y' ORDER BY $sort $dir";
$news = mysql_query($query_news, $brewing) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);
}

// Current BrewBlog */
if ($page == "brewBlogCurrent") {
mysql_select_db($database_brewing, $brewing);
$query_log = "SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' OR brewArchive='No' ORDER BY brewDate DESC";
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

if ($page == "brewBlogList") {
if ((($row_pref['mode'] == "2") && ($filter == "all")) || ($row_pref['mode'] == "1")) {
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM brewing ORDER BY %s %s", $sort, $dir);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
if ($style != "all") $view == "all";
}

if (($row_pref['mode'] == "2") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' ORDER BY %s %s", $filter, $sort, $dir);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}
}

if (($page == "brewBlogDetail") || ($page == "logPrint") || (($page == "recipePrint") && ($dbTable == "default"))) {

mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM brewing WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}


// BrewBlog List
if ($page == "brewBlogList") {

/* set pagination variables */
if ($view == "limited") $display = 25;
elseif ($view == "all") $display = 9999999;
$pg = (isset($_REQUEST['pg']) && ctype_digit($_REQUEST['pg'])) ?  $_REQUEST['pg'] : 1;
$start = $display * $pg - $display;

if (($row_pref['mode'] == "1") || (($row_pref['mode'] == "2") && ($filter == "all"))) {
mysql_select_db($database_brewing, $brewing);
$query_result = "SELECT count(*) FROM brewing";
if ($style != "all") $query_result .= " WHERE brewStyle='$style' AND"; else $query_result .= " WHERE";
$query_result .= " NOT brewArchive='Y'";
$result = mysql_query($query_result, $brewing) or die(mysql_error());
$total = mysql_result($result, 0);

$query_log = "SELECT * FROM brewing";
if ($style != "all") $query_log .= " WHERE brewStyle='$style' AND"; else $query_log .= " WHERE";
$query_log .= " NOT brewArchive='Y'";
$query_log .= " ORDER BY $sort $dir LIMIT $start, $display";
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
}

if (($row_pref['mode'] == "2") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$query_result = "SELECT count(*) FROM brewing WHERE brewBrewerID='$filter'";
if ($style != "all") $query_result .= " AND brewStyle='$style'";
$query_result .= " AND NOT brewArchive='Y'";
$result = mysql_query($query_result, $brewing) or die(mysql_error());
$total = mysql_result($result, 0);

$query_log = "SELECT * FROM brewing WHERE brewBrewerID='$filter'";
if ($style != "all") $query_log .= " AND brewStyle='$style'";
$query_log .= " AND NOT brewArchive='Y'";
$query_log .= " ORDER BY $sort $dir LIMIT $start, $display";
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
}


function paginate($display, $pg, $total) {
  /* make sure pagination doesn't interfere with other query string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($total <= $display) ? 1 : ceil($total / $display);
    
  /* create the links */
  $first = '<a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&lt;&lt;</a>';
  $prev = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">&lt;</a>';
  $next = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">&gt;</a>';
  $last = '<a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">&gt;&gt;</a>';
   
  /* display opening navigation */
  echo ($pg > 1) ? "$first&nbsp;$prev" : '&lt;&lt;&nbsp;&lt;';
  echo '&nbsp;&nbsp;More&nbsp;';
  
  // limit the number of page links displayed 
  $begin = $pg - 8;
  while($begin < 1)
    $begin++;
  $end = $pg + 8;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    echo ($i == $pg) ? ' ['.$i.'] ' : ' <a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a> ';
    
  /* display ending navigation */
  echo ($pg < $pages) ? "$next&nbsp;$last" : '&gt;&nbsp;&gt;&gt;';
}
}


// -----------------------------------------------------------------------------------------------
// Sidebar List

if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") /*|| ($page == "recipeDetail") */ || ($page == "about") || ($page == "profile")) {
/* set pagination variables */
$display = 8;
if ($page == "about") $display = 15;
$pg = (isset($_REQUEST['pg']) && ctype_digit($_REQUEST['pg'])) ?
  $_REQUEST['pg'] : 1;
$start = $display * $pg - $display;

if ($row_pref['mode'] == "1") {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM brewing");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' ORDER BY brewDate DESC LIMIT $start, $display");
$row_list = mysql_fetch_assoc($list);
}

if (($row_pref['mode'] == "2") && ($filter == "all")) {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM brewing");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' ORDER BY brewDate DESC LIMIT $start, $display");
$row_list = mysql_fetch_assoc($list);
}

if (($row_pref['mode'] == "2") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM brewing WHERE brewBrewerID = '$filter'");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM brewing WHERE brewArchive='' OR brewArchive='N' AND brewBrewerID = '$filter'ORDER BY brewDate DESC LIMIT $start, $display") or die(mysql_error());
$row_list = mysql_fetch_assoc($list);
}

if ($page == "about") {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM brewerlinks");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM brewerlinks ORDER BY brewerLinkName ASC LIMIT $start, $display");
$row_list = mysql_fetch_assoc($list);
}

function paginate($display, $pg, $total) {
  /* make sure pagination doesn't interfere with other query string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($total <= $display) ? 1 : ceil($total / $display);
    
  /* create the links */
  $first = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&lt;&lt;</a>';
  $prev = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">&lt;</a>';
  $next = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">&gt;</a>';
  $last = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">&gt;&gt;</a>';
   
  /* display opening navigation */
  echo '<div class="center"><span class="text_9">';
  echo ($pg > 1) ? "$first&nbsp;$prev" : '&lt;&lt;&nbsp;&lt;';
  echo '&nbsp;&nbsp;More&nbsp;';
  /* limit the number of page links displayed */
  $begin = $pg - 4;
  while($begin < 1)
    $begin++;
  $end = $pg + 4;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    echo ($i == $pg) ? ' ['.$i.'] ' : ' <a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a> ';
    
  /* display ending navigation */
  echo ($pg < $pages) ? "$next&nbsp;$last" : '&gt;&nbsp;&gt;&gt;';
  echo '</span></div>';
}
}

// -----------------------------------------------------------------------------------------------
// REVIEWS
if (($page =="brewBlogCurrent") || ($page =="brewBlogDetail")) {
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
mysql_select_db($database_brewing, $brewing);
$query_review = sprintf("SELECT * FROM reviews WHERE brewID ='".$row_log['id']."' ORDER BY id DESC");
if ($view == "limited") {
$query_limit_review = sprintf("%s LIMIT %d, %d", $query_review, $startRow_review, $maxRows_review);
$review = mysql_query($query_limit_review, $brewing) or die(mysql_error());
} else
$review = mysql_query($query_review, $brewing) or die(mysql_error());
$row_review = mysql_fetch_assoc($review);

if (isset($_GET['totalRows_review'])) {
  $totalRows_review = $_GET['totalRows_review'];
} else {
  $all_review = mysql_query($query_review);
  $totalRows_review = mysql_num_rows($all_review);
}
$totalPages_review = ceil($totalRows_review/$maxRows_review)-1;
}
// -----------------------------------------------------------------------------------------------

// Recipe List
if ($page == "recipeList") {

/* set pagination variables */
if ($view == "limited") $display = 25; 
if ($view == "all") $display = 999999;
$pg = (isset($_REQUEST['pg']) && ctype_digit($_REQUEST['pg'])) ?  $_REQUEST['pg'] : 1;
$start = $display * $pg - $display;

if ($row_pref['mode'] == "1") {

mysql_select_db($database_brewing, $brewing);
$query_result = "SELECT count(*) FROM recipes";
if ($style != "all") $query_result .= " WHERE brewStyle='$style' AND"; else $query_result .= " WHERE";
$query_result .= " NOT brewArchive='Y'";
$result = mysql_query($query_result, $brewing) or die(mysql_error());
$total = mysql_result($result, 0);
//$recipeList = mysql_query("SELECT * FROM recipes ORDER BY $sort $dir LIMIT $start, $display") or die(mysql_error());
$query_recipeList = "SELECT * FROM recipes";
if ($style != "all") $query_recipeList.= " WHERE brewStyle='$style' AND"; else $query_recipeList .= " WHERE";
$query_recipeList .= " NOT brewArchive='Y'";
$query_recipeList .= " ORDER BY $sort $dir LIMIT $start, $display";
$recipeList = mysql_query($query_recipeList, $brewing) or die(mysql_error());
$row_recipeList = mysql_fetch_assoc($recipeList);
}


if (($row_pref['mode'] == "2") && ($filter == "all")) {
mysql_select_db($database_brewing, $brewing);
$query_result = "SELECT count(*) FROM recipes";
if ($style != "all") $query_result .= " WHERE brewStyle='$style' AND"; else $query_result .= " WHERE";
$query_result .= " NOT brewArchive='Y'";
$result = mysql_query($query_result, $brewing) or die(mysql_error());
$total = mysql_result($result, 0);
$query_recipeList = "SELECT * FROM recipes";
if ($style != "all") $query_recipeList.= " WHERE brewStyle='$style' AND"; else $query_recipeList.= " WHERE";
$query_recipeList .= " NOT brewArchive='Y'";
$query_recipeList .= " ORDER BY $sort $dir LIMIT $start, $display";
$recipeList = mysql_query($query_recipeList, $brewing) or die(mysql_error());
$row_recipeList = mysql_fetch_assoc($recipeList);
}

if (($row_pref['mode'] == "2") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$query_result = "SELECT count(*) FROM recipes WHERE brewBrewerID='$filter'";
if ($style != "all") $query_result .= " AND brewStyle='$style'";
$query_result .= " AND NOT brewArchive='Y'";
$result = mysql_query($query_result, $brewing) or die(mysql_error());
$total = mysql_result($result, 0);

$query_recipeList = "SELECT * FROM recipes WHERE brewBrewerID='$filter'";
if ($style != "all") $query_recipeList.= " AND brewStyle='$style'";
$query_recipeList .= " AND NOT brewArchive='Y'";
$query_recipeList .= " ORDER BY $sort $dir LIMIT $start, $display";
$recipeList = mysql_query($query_recipeList, $brewing) or die(mysql_error());
$row_recipeList = mysql_fetch_assoc($recipeList);
}



function paginate($display, $pg, $total) {
  /* make sure pagination doesn't interfere with other query string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($total <= $display) ? 1 : ceil($total / $display);
    
  /* create the links */
  $first = '<a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&lt;&lt;</a>';
  $prev = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">&lt;</a>';
  $next = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">&gt;</a>';
  $last = '<a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">&gt;&gt;</a>';
   
  /* display opening navigation */
  
  echo ($pg > 1) ? "$first&nbsp;$prev" : '&lt;&lt;&nbsp;&lt;';
  echo '&nbsp;&nbsp;More&nbsp;';
  
  // limit the number of page links displayed 
  $begin = $pg - 8;
  while($begin < 1)
    $begin++;
  $end = $pg + 8;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    echo ($i == $pg) ? ' ['.$i.'] ' : ' <a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a> ';
    
  /* display ending navigation */
  echo ($pg < $pages) ? "$next&nbsp;$last" : '&gt;&nbsp;&gt;&gt;';
}
}

// Recipe Detail pages

if (($page == "recipeDetail") || (($page == "recipePrint") && ($dbTable == "recipes"))) {

mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM recipes WHERE id = '%s'", $colname_log);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);

/* set pagination variables */
$display = 25;
$pg = (isset($_REQUEST['pg']) && ctype_digit($_REQUEST['pg'])) ?
  $_REQUEST['pg'] : 1;
$start = $display * $pg - $display;

if ($row_pref['mode'] == "1") {
/* paginating from a database */
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM recipes");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM recipes ORDER BY brewName ASC LIMIT $start, $display");
$row_list = mysql_fetch_assoc($list);
}

if (($row_pref['mode'] == "2") && ($filter == "all")) {
/* paginating from a database */
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM recipes");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM recipes ORDER BY brewName ASC LIMIT $start, $display");
$row_list = mysql_fetch_assoc($list);
}

if (($row_pref['mode'] == "2") && ($filter != "all")) {
/* paginating from a database */
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM recipes WHERE brewBrewerID = '".$filter."'");
$total = mysql_result($result, 0);
$list = mysql_query("SELECT * FROM recipes WHERE brewBrewerID = '".$filter."' ORDER BY brewName ASC LIMIT $start, $display");
$row_list = mysql_fetch_assoc($list);
}

function paginate($display, $pg, $total) {
  /* make sure pagination doesn't interfere with other query string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($total <= $display) ? 1 : ceil($total / $display);
    
  /* create the links */
  $first = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&lt;&lt;</a>';
  $prev = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">&lt;</a>';
  $next = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">&gt;</a>';
  $last = 	'<a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">&gt;&gt;</a>';
   
  /* display opening navigation */
  echo '<div class="center"><span class="text_9">';
  echo ($pg > 1) ? "$first&nbsp;$prev" : '&lt;&lt;&nbsp;&lt;';
  echo '&nbsp;&nbsp;More&nbsp;';
  /* limit the number of page links displayed */
  $begin = $pg - 4;
  while($begin < 1)
    $begin++;
  $end = $pg + 4;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    echo ($i == $pg) ? ' ['.$i.'] ' : ' <a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a> ';
    
  /* display ending navigation */
  echo ($pg < $pages) ? "$next&nbsp;$last" : '&gt;&nbsp;&gt;&gt;';
  echo '</span></div>';
}

}

// -----------------------------------------------------------------------------------------------

// Awards List

// Recipe List
if ($page == "awardsList") {

/* set pagination variables */
if ($view == "limited") $display = 25; 
if ($view == "all") $display = 999999;
$pg = (isset($_REQUEST['pg']) && ctype_digit($_REQUEST['pg'])) ?  $_REQUEST['pg'] : 1;
$start = $display * $pg - $display;

if ($row_pref['mode'] == "1") {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM awards");
$total = mysql_result($result, 0);
$awardsList = mysql_query("SELECT * FROM awards ORDER BY $sort $dir LIMIT $start, $display") or die(mysql_error());
$row_awardsList = mysql_fetch_assoc($awardsList);
//echo $awardsList;
}


if (($row_pref['mode'] == "2") && ($filter == "all")) {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM awards");
$total = mysql_result($result, 0);
$awardsList = mysql_query("SELECT * FROM awards ORDER BY $sort $dir LIMIT $start, $display") or die(mysql_error());
$row_awardsList = mysql_fetch_assoc($awardsList);
}

if (($row_pref['mode'] == "2") && ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$result = mysql_query("SELECT count(*) FROM awards WHERE brewBrewerID = '".$filter."'");
$total = mysql_result($result, 0);
$awardsList = mysql_query("SELECT * FROM awards WHERE brewBrewerID = '".$filter."' ORDER BY $sort $dir LIMIT $start, $display") or die(mysql_error());
$row_awardsList = mysql_fetch_assoc($awardsList);
}



function paginate($display, $pg, $total) {
  /* make sure pagination doesn't interfere with other query string variables */
  if(isset($_SERVER['QUERY_STRING']) && trim(
    $_SERVER['QUERY_STRING']) != '') {
    if(stristr($_SERVER['QUERY_STRING'], 'pg='))
      $query_str = '?'.preg_replace('/pg=\d+/', 'pg=', 
        $_SERVER['QUERY_STRING']);
    else
      $query_str = '?'.$_SERVER['QUERY_STRING'].'&pg=';
  } else
    $query_str = '?pg=';
    
  /* find out how many pages we have */
  $pages = ($total <= $display) ? 1 : ceil($total / $display);
    
  /* create the links */
  $first = '<a href="'.$_SERVER['PHP_SELF'].$query_str.'1">&lt;&lt;</a>';
  $prev = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg - 1).'">&lt;</a>';
  $next = '<a href="'.$_SERVER['PHP_SELF'].$query_str.($pg + 1).'">&gt;</a>';
  $last = '<a href="'.$_SERVER['PHP_SELF'].$query_str.$pages.'">&gt;&gt;</a>';
   
  /* display opening navigation */
  
  echo ($pg > 1) ? "$first&nbsp;$prev" : '&lt;&lt;&nbsp;&lt;';
  echo '&nbsp;&nbsp;More&nbsp;';
  
  // limit the number of page links displayed 
  $begin = $pg - 8;
  while($begin < 1)
    $begin++;
  $end = $pg + 8;
  while($end > $pages)
    $end--;
  for($i=$begin; $i<=$end; $i++)
    echo ($i == $pg) ? ' ['.$i.'] ' : ' <a href="'.
      $_SERVER['PHP_SELF'].$query_str.$i.'">'.$i.'</a> ';
    
  /* display ending navigation */
  echo ($pg < $pages) ? "$next&nbsp;$last" : '&gt;&nbsp;&gt;&gt;';
}
}







//Awards
if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) {
$awardNewID = "b".$row_log['id'];
mysql_select_db($database_brewing, $brewing);
$query_awards = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}

if ($page == "recipeDetail") {
$awardNewID = "r".$row_log['id'];
mysql_select_db($database_brewing, $brewing);
$query_awards = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}

if ($page == "profile") {
mysql_select_db($database_brewing, $brewing);
$query_awards = sprintf("SELECT * FROM awards WHERE brewBrewerID='%s'", $filter);
$awards = mysql_query($query_awards, $brewing) or die(mysql_error());
$row_awards = mysql_fetch_assoc($awards);
$totalRows_awards = mysql_num_rows($awards);
}


// -----------------------------------------------------------------------------------------------
// User Breadcrumb
if (($page == "recipeDetail") && ($row_log['brewBrewerID'] != "")) {
mysql_select_db($database_brewing, $brewing);
$query_user3 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
$user3 = mysql_query($query_user3, $brewing) or die(mysql_error());
$row_user3 = mysql_fetch_assoc($user3);
$totalRows_user3 = mysql_num_rows($user3);
}

// Members
if (($page == "members") || ($page == "calendar") || ($page == "profile")) { 
mysql_select_db($database_brewing, $brewing);
$query_members = "SELECT * FROM users";
if ($page == "members") $query_members .= " ORDER BY $sort $dir";
if ($page == "profile") $query_members .= " WHERE user_name='$filter'";
if ($page == "calendar") $query_members .= " ORDER BY realLastName";
$members = mysql_query($query_members, $brewing) or die(mysql_error());
$row_members = mysql_fetch_assoc($members);
$totalRows_members = mysql_num_rows($members);
}

// -----------------------------------------------------------------------------------------------
// Status - single user
if ($row_pref['mode'] == "1") { 
mysql_select_db($database_brewing, $brewing);
$countStatus = "SELECT * FROM brewing WHERE brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName ASC";
$query_count = mysql_query($countStatus, $brewing) or die(mysql_error());
$total_status = mysql_num_rows($query_count);

mysql_select_db($database_brewing, $brewing);
$query_status = "SELECT * FROM brewing WHERE brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName ASC";
if ($total_status > 25) $query_status .= " LIMIT 25";
$status = mysql_query($query_status, $brewing) or die(mysql_error());
$row_status = mysql_fetch_assoc($status);
$totalRows_status = mysql_num_rows($status);
}


// Status - multi-user
if ($row_pref['mode'] == "2") { 
mysql_select_db($database_brewing, $brewing);
$countStatus = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' AND brewStatus NOT LIKE '' AND brewArchive NOT LIKE '%s' ORDER BY brewStatus,brewName ASC", $filter, "Y");
$query_count = mysql_query($countStatus, $brewing) or die(mysql_error());
$total_status = mysql_num_rows($query_count);

mysql_select_db($database_brewing, $brewing);
if ($page == "profile") $query_status = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' AND brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName ASC", $filter);
else $query_status = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s' AND brewStatus NOT LIKE '' AND brewArchive NOT LIKE 'Y' ORDER BY brewStatus,brewName,brewDate DESC", $row_log['brewBrewerID']);
if ($total_status > 25) $query_status .= " LIMIT 25";
$status = mysql_query($query_status, $brewing) or die(mysql_error());
$row_status = mysql_fetch_assoc($status);
$totalRows_status = mysql_num_rows($status);
}

// -----------------------------------------------------------------------------------------------

// Upcoming if User Mode 1
if ($row_pref['mode'] == "1") {

mysql_select_db($database_brewing, $brewing);
$countUp = "SELECT * FROM upcoming";
$query_countUp = mysql_query($countUp, $brewing) or die(mysql_error());
$total_upcoming = mysql_num_rows($query_countUp);


mysql_select_db($database_brewing, $brewing);
$query_upcoming = "SELECT * FROM upcoming ORDER BY upcomingDate,upcoming DESC";
if ($total_upcoming > 10) $query_upcoming .= " LIMIT 10";
$upcoming = mysql_query($query_upcoming, $brewing) or die(mysql_error());
$row_upcoming = mysql_fetch_assoc($upcoming);
$totalRows_upcoming = mysql_num_rows($upcoming);
}

//Upcoming if User Mode 2
if ($row_pref['mode'] == "2") {
if ($filter != "all") {
mysql_select_db($database_brewing, $brewing);
$countUp = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s'", $filter);
$query_countUp = mysql_query($countUp, $brewing) or die(mysql_error());
$total_upcoming = mysql_num_rows($query_countUp);

mysql_select_db($database_brewing, $brewing);
if ($page == "profile") $query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming DESC", $filter);
else $query_upcoming = sprintf("SELECT * FROM upcoming WHERE brewBrewerID='%s' ORDER BY upcomingDate,upcoming DESC", $row_log['brewBrewerID']);
if ($total_upcoming > 10) $query_upcoming .= " LIMIT 10";
$upcoming = mysql_query($query_upcoming, $brewing) or die(mysql_error());
$row_upcoming = mysql_fetch_assoc($upcoming);
$totalRows_upcoming = mysql_num_rows($upcoming);
} 

if ($filter == "all") {
$query_upcoming = "SELECT * FROM upcoming ORDER BY upcomingDate,upcoming ASC";
$upcoming = mysql_query($query_upcoming, $brewing) or die(mysql_error());
$row_upcoming = mysql_fetch_assoc($upcoming);
$totalRows_upcoming = mysql_num_rows($upcoming);
}
}
// -----------------------------------------------------------------------------------------------

if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "logPrint") || ($page == "recipePrint")) {
mysql_select_db($database_brewing, $brewing);
$query_mash_profiles = sprintf("SELECT * FROM mash_profiles WHERE id='%s'", $row_log['brewMashProfile']);
$mash_profiles = mysql_query($query_mash_profiles, $brewing) or die(mysql_error());
$row_mash_profiles = mysql_fetch_assoc($mash_profiles);
$totalRows_mash_profiles = mysql_num_rows($mash_profiles);

$query_mash_steps = sprintf("SELECT * FROM mash_steps WHERE stepMashProfileID = '%s'", $row_mash_profiles['id']);
$mash_steps = mysql_query($query_mash_steps, $brewing) or die(mysql_error());
$row_mash_steps = mysql_fetch_assoc($mash_steps);
$totalRows_mash_steps = mysql_num_rows($mash_steps);

$query_water_profiles = sprintf("SELECT * FROM water_profiles WHERE id='%s'", $row_log['brewWaterProfile']);
$water_profiles = mysql_query($query_water_profiles, $brewing) or die(mysql_error());
$row_water_profiles = mysql_fetch_assoc($water_profiles);
$totalRows_water_profiles = mysql_num_rows($water_profiles);

$query_equip_profiles = sprintf("SELECT * FROM equip_profiles WHERE id='%s'", $row_log['brewEquipProfile']);
$equip_profiles = mysql_query($query_equip_profiles, $brewing) or die(mysql_error());
$row_equip_profiles = mysql_fetch_assoc($equip_profiles);
$totalRows_equip_profiles = mysql_num_rows($equip_profiles);

}

if (($page == "brewBlogList") || ($page == "recipeList")) {
if ($page == "brewBlogList") $table = "brewing";
if ($page == "recipeList") $table = "recipes";
$query_featured = "SELECT * FROM $table WHERE brewFeatured='Y' ";
if ($page == "brewBlogList") $query_featured .= "ORDER BY brewDate DESC";
if ($page == "recipeList") $query_featured .= "ORDER BY brewName ASC";
// echo $query_featured;
$featured = mysql_query($query_featured, $brewing) or die(mysql_error());
$row_featured = mysql_fetch_assoc($featured);
$totalRows_featured = mysql_num_rows($featured);

}

?>

