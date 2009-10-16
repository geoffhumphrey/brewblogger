<table class="dataTable">
<tr>
<td width="90%">
<div id="breadcrumbAdmin">
<?php if ($action != "default") 
echo "<a href=\"index.php\">Administration</a>"; else echo "Administration"; ?> &gt; 
<?php if (
($dbTable == "recipes")    				|| 
($dbTable == "hops")      				||
($dbTable == "malt")      				|| 
($dbTable == "users")      				|| 
($dbTable == "styles")     				|| 
($dbTable == "brewerlinks")				||
($dbTable == "brewingcss")				|| 
($dbTable == "upcoming")   				|| 
($dbTable == "reviews")   				||
($dbTable == "extract")   				|| 
($dbTable == "adjuncts")   				||  
($dbTable == "awards")   				||  
($dbTable == "mash_profiles")   		||
($dbTable == "misc")   					||
($dbTable == "mash_steps")   		    ||
($dbTable == "yeast_profiles")   		||
($dbTable == "water_profiles")   		||
($dbTable == "equip_profiles")   		||
($dbTable == "news")   					||
($dbTable == "sugar_type")				||
($dbTable == "brewing")
) echo $breadcrumb; else echo " "; ?>
</div>
</td>
<?php if (!checkmobile()) { 
if (($row_user['userLevel'] == "1") && (($action == "list") && (($dbTable == "brewing") || ($dbTable == "recipes")))) { ?>
<td nowrap><div class="right"><a href="includes/excel_download.inc.php?dbTable=<?php echo $dbTable; ?>&filter=<?php echo $filter; ?>"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_export_excel_<?php echo $row_colorChoose['themeName']; ?>.png" border="0"></a>&nbsp;<?php if ($filter == "all")  echo "<a href=\"?action=exportSQL&dbTable=brewing\">"; if (($filter == $loginUsername) || ($row_user['userLevel'] == "1")) { ?><a href="index.php?action=exportSQL&dbTable=<?php echo $dbTable; ?>&filter=<?php echo $filter; ?>"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_export_sql_<?php echo $row_colorChoose['themeName']; ?>.png" border="0"></a><?php } ?></div></td>
<?php } 
} ?>
</tr>
</table>
<?php 
if (($action == "list") && ($dbTable == "brewing")) 		include ('list/brewblogs.list.php'); 
if (($action == "list") && ($dbTable == "recipes")) 		include ('list/recipes.list.php'); 
if (($action == "list") && ($dbTable == "styles"))  		include ('list/styles.list.php'); 
if (($action == "list") && ($dbTable == "hops"))  			include ('list/hops.list.php');
if (($action == "list") && ($dbTable == "extract")) 		include ('list/extracts.list.php'); 
if (($action == "list") && ($dbTable == "malt")) 			include ('list/grains.list.php'); 
if (($action == "list") && ($dbTable == "adjuncts")) 		include ('list/adjuncts.list.php'); 
if (($action == "list") && ($dbTable == "brewerlinks"))		include ('list/brewerlinks.list.php');
if (($action == "list") && ($dbTable == "users")) 			include ('list/users.list.php');
if (($action == "list") && ($dbTable == "awards")) 			include ('list/awards.list.php');
if (($action == "list") && ($dbTable == "reviews"))			include ('list/reviews.list.php');
if (($action == "list") && ($dbTable == "water_profiles"))	include ('list/water_profiles.list.php');
if (($action == "list") && ($dbTable == "yeast_profiles"))	include ('list/yeast_profiles.list.php');
if (($action == "list") && ($dbTable == "mash_profiles"))	include ('list/mash_profiles.list.php');
if (($action == "list") && ($dbTable == "equip_profiles"))	include ('list/equip_profiles.list.php');
if (($action == "list") && ($dbTable == "mash_steps"))		include ('add-edit/mash_steps.add-edit.php');
if (($action == "list") && ($dbTable == "upcoming")	)		include ('list/upcoming.list.php');
if (($action == "list") && ($dbTable == "misc")	)			include ('list/misc.list.php');
if (($action == "list") && ($dbTable == "sugar_type"))		include ('list/sugar_type.list.php');

if ($row_pref['mode'] == "2") {
 	if (($action == "list") && ($dbTable == "news")) 	include ('list/news.list.php'); 
    } 

if  ($row_user['userLevel'] =="1") { 
	if (($action == "list") && ($dbTable == "brewingcss"))  include ('list/brewingcss.list.php'); 
 	}
	
?>