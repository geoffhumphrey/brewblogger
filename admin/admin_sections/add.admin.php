<?php
if (($action == "edit") || ($action == "reuse")) {
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM $dbTable WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

if (($action == "add") && ($dbTable == "awards") && ($id != "default")) { 
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM $assoc WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

if ($action == "import") {
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM recipes WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

if ($action == "importRecipe") {
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM brewing WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

if ($action == "importCalc") include ('lib/importFormVar.lib.php'); 

?>
<script type="text/javascript" src="js_includes/rounded-corners.js"></script>
<script type="text/javascript" src="js_includes/form-field-tooltip.js"></script>
<script type="text/javascript" src="js_includes/calendar_control.js"></script>

<link rel="stylesheet" href="css/tooltip.css" media="screen" type="text/css">
<link rel="stylesheet" href="css/calendar_control.css" media="screen" type="text/css">

<div id="breadcrumbAdmin">
<?php if ($action != "default") echo "<a href=\"index.php\">Administration</a>"; else echo "Administration"; ?> &gt; 
<?php if (
(($dbTable == "recipes") && ($action != "importRecipe"))   || 
($dbTable == "hops")      	||
($dbTable == "malt")      	||  
($dbTable == "styles")     	|| 
($dbTable == "brewerlinks")	||
($dbTable == "brewingcss")	|| 
($dbTable == "upcoming")   	|| 
($dbTable == "reviews")   	|| 
($dbTable == "extract")   	||
($dbTable == "adjuncts")   	||
($dbTable == "news")   		||
($dbTable == "misc")   		||
($dbTable == "yeast_profiles")   	||
($dbTable == "equip_profiles")   	||
($dbTable == "mash_profiles")   	||
($dbTable == "mash_steps")   		||
($dbTable == "water_profiles")   	||
($dbTable == "sugar_type")          ||
(($dbTable == "brewing") && ($action != "import"))	||
(($dbTable == "users") && ($row_user['userLevel'] == "1"))
) echo "<a href = \"index.php?action=list&dbTable=".$dbTable."\">".$breadcrumb."</a> &gt; ".$page_title; 
elseif (($dbTable == "users") && ($row_user['userLevel'] != "1")) echo "<a href = \"index.php?action=list&dbTable=".$dbTable."\">User List</a> &gt; ".$page_title; 
elseif (($dbTable == "brewing") && ($action == "import")) echo "<a href=\"?action=list&dbTable=recipes\">".$prefix."Recipes</a> &gt; ".$page_title;
elseif (($dbTable == "recipes") && ($action == "importRecipe")) echo "<a href=\"?action=list&dbTable=brewing\">".$prefix."BrewBlogs</a> &gt; ".$page_title;
else echo $breadcrumb; 
?>
</div>
<form action="process.php?<?php echo "action=".$action."&dbTable=".$dbTable; if ($action == "edit") echo "&id=".$id; if (($dbTable == "users") && ($action == "edit")) echo "&filter=".$row_log['user_name']."&section=".$section; if (($dbTable == "awards") && ($action == "add")) echo "&assoc=".$assoc; ?>" method="POST" name="form1" onSubmit="return CheckRequiredFields()">
<table class="dataTable">
<tr>
<td>
<div id="subtitleAdmin"><?php echo $page_title; ?></div>
</td>
<td>

<?php 
if (($action == "edit") && (($dbTable == "recipes") || ($dbTable == "brewing") || ($dbTable == "upcoming") || ($dbTable == "awards")) && ($row_user['userLevel'] == "2") && ($row_log['brewBrewerID'] != $loginUsername)) { echo "</tr><tr><td class=\"error\">Sorry, you do not have sufficient privileges to edit this "; if ($dbTable == "brewing") echo "BrewBlog."; if ($dbTable == "recipes") echo "Recipe."; if ($dbTable == "upcoming") echo "Upcoming Brew."; if ($dbTable == "awards") echo "Award/Competition Entry."; echo "<br><br><br></td></tr></table>"; } 
elseif ((($dbTable == "preferences") || ($dbTable == "brewingcss") || ($dbTable == "brewerlinks") || ($dbTable == "brewer")) && ($row_user['userLevel'] == "2")) { echo "</tr><tr><td class=\"error\">Sorry, you do not have sufficient privileges to access this area.<br><br><br></td></tr></table>"; } 
elseif ((($action == "add") || ($action == "edit")) && (($dbTable == "styles") || ($dbTable == "brewerlinks") || ($dbTable == "brewerlinks") || ($dbTable == "brewingcss")) && ($row_user['userLevel'] == "2")) { echo "</tr><tr><td class=\"error\">Sorry, you do not have sufficient privileges to access this area.<br><br><br></td></tr></table>"; } 
elseif (($action == "add") && ($row_user['userLevel'] == "2") && ($dbTable == "users"))  { echo "</tr><tr><td class=\"error\">Sorry, you do not have sufficient privileges to access this area.<br><br><br></td></tr></table>"; }
elseif (($action == "edit") && ($row_user['userLevel'] == "2") && ($filter != $loginUsername)) { echo "</tr><tr><td class=\"error\">Sorry, you do not have sufficient privileges to access this area.<br><br><br></td></tr></table>"; }
else echo ""; ?>

</td>
</tr>
<?php if ($confirm == "true") { ?>
<tr>
<td class="error">The <?php echo $dbName; ?> information has been updated!<br><br></td>
</tr>
<?php } ?>
</table>

<?php 
if ($dbTable == "awards") 			include ('add-edit/awards.add-edit.php'); 
if (($dbTable == "brewing") || ($dbTable == "recipes")) include ('bb_recipe.admin.php'); 
if ($dbTable == "upcoming")			include ('add-edit/upcoming.add-edit.php'); 
if ($dbTable == "extract") 			include ('add-edit/extracts.add-edit.php'); 
if ($dbTable == "adjuncts") 		include ('add-edit/adjuncts.add-edit.php');
if ($dbTable == "hops") 			include ('add-edit/hops.add-edit.php'); 
if ($dbTable == "styles") 			include ('add-edit/styles.add-edit.php'); 
if ($dbTable == "brewerlinks") 		include ('add-edit/brewerlinks.add-edit.php');
if ($dbTable == "sugar_type") 		include ('add-edit/sugar_type.add-edit.php');
if ($dbTable == "news") 			include ('add-edit/news.add-edit.php'); 
if ($dbTable == "malt") 			include ('add-edit/grains.add-edit.php'); 
if (($dbTable == "yeast_profiles") && (($action == "add") || ($action == "edit") || ($action == "reuse"))) 	include ('add-edit/yeast_profiles.add-edit.php'); 
if (($dbTable == "mash_profiles")  && (($action == "add") || ($action == "edit") || ($action == "reuse")))	include ('add-edit/mash_profiles.add-edit.php');
if ($dbTable == "mash_steps") 		include ('add-edit/mash_steps.add-edit.php');  
if (($dbTable == "equip_profiles") && (($action == "add") || ($action == "edit") || ($action == "reuse")))	include ('add-edit/equip_profiles.add-edit.php'); 
if ($dbTable == "water_profiles") 	include ('add-edit/water_profiles.add-edit.php'); 
if ($dbTable == "misc") 			include ('add-edit/misc.add-edit.php'); 
if (($dbTable == "users") && ($section == "default")) 							include ('add-edit/users.add-edit.php'); 
if (($dbTable == "users") && ($action == "edit") && ($section == "password")) 	include ('add-edit/password.add-edit.php'); 
if (($dbTable == "brewingcss") && ($row_user['userLevel'] == "1")) 				include ('add-edit/brewingcss.add-edit.php'); 
if (($dbTable == "brewer") && ($row_user['userLevel'] == "1")) 					include ('add-edit/brewer.add-edit.php'); 
if (($dbTable == "preferences") && ($row_user['userLevel'] == "1")) 			include ('add-edit/preferences.add-edit.php');
if (($action == "edit") && ($dbTable == "reviews")) 							include ('add-edit/reviews.add-edit.php');
if (($action == "add") && ($dbTable == "reviews")) 								include ('add-edit/reviews.add-edit.php');

?>
<?php // } ?>
</form>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('below');
tooltipObj.setPageBgColor('#ffffff');
tooltipObj.setTooltipCornerSize(3);
tooltipObj.initFormFieldTooltip();
</script>
