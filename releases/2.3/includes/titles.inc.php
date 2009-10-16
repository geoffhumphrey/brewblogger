<?php
// ---------------------------- Friendly Names------------------------------------------
if (($dbTable == "recipes") || ($source == "recipes") || ($page == "recipeList") || ($page == "recipeDetail")) 		{ 
$dbName = $row_pref['menuRecipes'];
$sqlSelect = "brewName"; 
$msgName = "recipe"; 		
$sourceName = $row_pref['menuRecipes'];
$icon = "script";
$dbTable = "recipes";
if ($page != "admin") $source = "recipe";
$destination = "recipeDetail";
}

if (($dbTable == "brewing") || ($source == "brewing") || ($page == "brewBlogList") || ($page == "brewBlogDetail") || ($page == "brewBlogCurrent")) { 
$dbName = $row_pref['menuBrewBlogs']; 	
$sqlSelect = "brewDate"; 			
$msgName = "log"; 						
$sourceName = $row_pref['menuBrewBlogs']; 		
$icon = "book"; 
$dbTable = "brewing";
if ($page != "admin") $source = "brewLog";
$destination = "brewBlogDetail";
}

if (($page == "reference") || ($page == "admin")) {
	if ($dbTable == "hops") { 
	$dbName = "Hops"; 
	$sqlSelect = "hopsName"; 
	$msgName = "hop"; 
	$icon = "plugin"; 
	}

	if ($dbTable == "malt") { 
	$dbName = "Grains"; 
	$sqlSelect = "maltName"; 
	$msgName = "grain"; 
	$icon = "world"; 
	}

	if ($dbTable == "adjuncts") { 
	$dbName = "Adjuncts";	 		
	$sqlSelect = "adjunctName"; 					
	$msgName = "adjunct";
	$icon = "user"; 
	}

	if ($dbTable == "styles") { 
	$dbName = "Styles";	 		
	$sqlSelect = "brewName"; 						
	$msgName = "style"; 	
	$icon = "note"; 
	}
} // end if (($page == "reference") || ($page == "admin"))

if ($dbTable == "users") { 
$dbName = "Users";
$sqlSelect = "realFirstName"; 
$msgName = "user"; 
$icon = "user"; 
}

if ($dbTable == "brewerlinks") { 
$dbName = "Links";
$sqlSelect = "linkName";
$msgName = "link"; 	
$icon = "link"; 
}

if ($dbTable == "brewingcss") { 
$dbName = "Themes";	   		
$sqlSelect = "themeName"; 						
$msgName = "theme"; 																	
$icon = "application"; 
}



if ($dbTable == "upcoming") { 
$dbName = "Upcoming ".$row_pref['menuBrewBlogs'];  	
$sqlSelect = "upcoming"; 						
$msgName = "upcoming brew"; 															
$icon = "script"; 
}

if ($dbTable == "reviews")  { 
$dbName = "Reviews";
$sqlSelect = "awardBrewID";	
$msgName = "review"; 	
$icon = "medal_gold_3"; 
}

if ($dbTable == "awards") { 
$dbName = $row_pref['menuAwards']; 	   		
$sqlSelect = "brewID"; 							
$msgName = "award/competition entry"; 													
$icon = "script"; 
if ($assoc == "recipes") $sourceName = $row_pref['menuRecipes'];
if ($assoc == "brewing") $sourceName = $row_pref['menuBrewBlogs'];
}

if ($dbTable == "extract") { 
$dbName = "Extracts";	   		
$sqlSelect = "extractName"; 					
$msgName = "extract"; 																	
$icon = "database"; 
}

if ($dbTable == "sugar_type") { 
$dbName = "Sugar Types";	   		
$sqlSelect = "sugarName"; 					
$msgName = "sugar type"; 																	
$icon = "database"; 
}

if ($dbTable == "yeast_profiles") 	{ 
$dbName = "Yeast Profiles";	
$sqlSelect = "yeastName"; 						
$msgName = "yeast profile"; 															
$icon = "zoom"; 
}

if ($dbTable == "mash_profiles") { 
$dbName = "Mash Profiles";	
$sqlSelect = "mashProfileName"; 
$msgName = "mash profile"; 
$icon = "chart_curve"; 
}

if ($dbTable == "mash_steps") { 
$dbName = "Mash Steps";	
$sqlSelect = "mashStepName"; 
$msgName = "mash step"; 
$icon = "chart_curve"; 
}

if ($dbTable == "water_profiles") { 
$dbName = "Water Profiles";
$sqlSelect = "waterProfileName";
$msgName = "water profile"; 
$icon = "shape_square"; 
}

if ($dbTable == "equip_profiles") { 
$dbName = "Equipment Profiles";	
$sqlSelect = "equipProfileName"; 
$msgName = "equipment profile"; 
$icon = "database"; 
}

if ($dbTable == "misc") { 
$dbName = "Misc. Ingredients"; 
$sqlSelect = "miscName";
$msgName = "misc. ingredient"; 
$icon = "block"; 
}
																																		
if ($dbTable == "news")  { 
$dbName = "News";
$sqlSelect = "news"; 
$msgName = "news";
$icon = "newspaper"; 
}

if ($dbTable == "users")  { 
$dbName = "Users";
$sqlSelect = "userName"; 
$msgName = "user";
$icon = "user"; 
}

if (($dbTable == "brewer") && ($row_pref['mode'] == "1"))	{ $dbName = "Brewer"; $icon = "user"; }
if (($dbTable == "brewer") && ($row_pref['mode'] == "2"))	{ $dbName = "Club Profile"; $icon = "group"; }
if ($dbTable == "preferences") { $dbName = "Preferences"; $icon = "cog"; } 




// ---------------------------- Titles --------------------------------------------------
if 	($page == "brewBlogCurrent") 	{ if ($row_pref['mode'] == "1") $page_title = "Current "; if ($row_pref['mode'] == "2")  $page_title = $row_pref['menuBrewBlogs']; $page_title_extension = " &gt; ".$row_log['brewName']; $icon = "book"; }
if 	($page == "members") 			{ $page_title = $row_pref['menuMembers']; $icon = "group"; }
if 	($page == "news") 				{ $page_title = "News/Announcements"; $icon = "newspaper";}
if 	(($page == "brewBlogList") && ($filter == "all"))		{ $page_title = $row_pref['menuBrewBlogs']; $page_title_extension = ""; $icon = "book"; }
if 	(($page == "brewBlogList") && ($filter != "all"))		
		{ 
		mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuBrewBlogs'];  $page_title_extension = ""; $icon = "book"; 
		}
if 	($page == "brewBlogDetail") 							{ $page_title = $row_pref['menuBrewBlogs']; $page_title_extension = " &gt; ".$row_log['brewName'];  $icon = "book"; }
if 	(($page == "recipeList") && ($filter == "all"))			{ $page_title = $row_pref['menuRecipes']; $page_title_extension = "";  $icon = "script";}
if 	(($page == "recipeList") && ($filter != "all"))			
		{ 
		if ($row_pref['mode'] == "2") {
		mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuRecipes'];   $page_title_extension = ""; $icon = "script";
		}
		else 
		$page_title = $row_pref['menuRecipes']; $page_title_extension = ""; $icon = "script";
		}
if 	($page == "recipeDetail") 		{ $page_title = $row_pref['menuRecipes']; $page_title_extension = " &gt; ".$row_log['brewName']; $icon = "script"; }
if 	($page == "about")				{ if ($row_pref['mode'] == "1") { $page_title = $row_pref['menuAbout']; $page_title_extension = " "; $icon = "user"; } if ($row_pref['mode'] == "2") { $page_title = $row_pref['menuAbout'];   $page_title_extension = ""; $icon = "group";  } }
if 	($page == "login") 				{ $page_title = $row_pref['menuLogin']; $page_title_extension = ""; $icon = "user"; }
if 	($page == "tools") 				{ $page_title = $row_pref['menuCalculators']; $page_title_extension = ""; $icon = "calculator";  }
if 	($page == "reference") 			{ $page_title = $row_pref['menuReference']; $page_title_extension = ""; $icon = "book_open"; }
if 	(($page == "reviews")  || ($page == "reviewsView"))     { $page_title = "Tastings and Reviews"; $page_title_extension = ""; $icon = "page_edit";}
if 	(($page == "awardsList") && ($filter == "all"))			{ $page_title = $row_pref['menuAwards']; $page_title_extension = ""; $icon = "medal_gold_3"; }
if 	(($page == "awardsList") && ($filter != "all"))			
		{ 
		mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuAwards'];  $page_title_extension = ""; $icon = "medal_gold_3";
		}

if 	(($page == "calendar") && ($filter == "all"))			{ $page_title = $row_pref['menuCalendar']; $page_title_extension = ""; $icon = "calendar_view_month"; }
if 	(($page == "calendar") && ($filter != "all"))			
		{ 
		mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuCalendar'];  $page_title_extension = ""; $icon = "calendar_view_month";
		}

if 	($page == "profile") 
		{ 
		mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s Profile";  $page_title_extension = ""; $icon = "user";
		}

// Add or Edit actions
if ($page == "admin") {
	if ($action == "add") 				$action_name = "Add";
	if ($action == "edit") 				$action_name = "Edit";
	if ($action == "list")				$action_name = "Manage";

	if ($dbTable == "default")   		$page_title = "Administration";
	else 								$page_title = $action_name." ".$dbName;


// Special actions
	if 	(($action == "import") && ($dbTable == "brewing")) 	 	{ $page_title = "Import ".$row_pref['menuRecipes']." to ".$row_pref['menuBrewBlogs']; }
	if 	(($action == "importRecipe") && ($dbTable == "recipes")){ $page_title = "Import ".$row_pref['menuBrewBlogs']." to ".$row_pref['menuRecipes']; }
	if 	(($action == "importCalc") && ($dbTable == "recipes")) 	{ $page_title = "Add ".$row_pref['menuRecipes']; }
	if 	(($action == "importCalc") && ($dbTable == "brewing")) 	{ $page_title = "Add ".$row_pref['menuBrewBlogs']; }
	if 	(($action == "reuse")  && ($dbTable == "brewing")) 		{ $page_title = "Reuse ".$row_pref['menuBrewBlogs']; }
	if (($action == "reuse")  && ($dbTable == "recipes")) 		{ $page_title = "Copy ".$row_pref['menuRecipes']; }
	if (($action == "reuse")  && ($dbTable != "recipes"))   	{ $page_title = "Copy ".$dbName; }
	if 	(($action == "edit")   && ($dbTable == "users") && ($row_user['userLevel'] == "1") && (($row_pref['mode'] == "2") || ($row_pref['mode'] == "1")))		{ $page_title = "Edit Users"; }
	if 	($action == "exportSQL") 			   					{ $page_title = "Export SQL: <em>".$dbName."</em> Database"; 	$icon = "page_lightning"; }
	if 	(($page != "tools") && ($action == "calculate"))		{ $page_title = "Recipe Calculator"; 							$icon = "calculator"; }
	if 	($action == "chooseRecalc")								{ $page_title = "Recalculate ".$row_pref['menuBrewBlogs']." or ".$row_pref['menuRecipes']; 			$icon = "calculator"; }
	if 	($action == "chooseAward")								{ $page_title = "Add ".$row_pref['menuAwards']; 			$icon = "medal_gold_3"; }

}
// ----------------------------- Breadcrumbs -------------------------
if ($page != "admin") {
	$bDefault = $row_pref['menuHome']." &gt; ".$page_title.$page_title_extension;
	if (($page == "login") || ($page == "logout") || ($page == "reference") || ($page == "tools") || ($page == "members")) { $breadcrumb = "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; }

	if ($row_pref['mode'] == "1") {
		if ($page == "brewBlogList")   	$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
		if ($page == "recipeList")  	$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
		if ($page == "awardsList")  	$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
		if ($page == "brewBlogDetail")  $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=brewBlogList&sort=brewDate&dir=DESC\">".$page_title."</a>".$page_title_extension;  
		if ($page == "recipeDetail")  	$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=recipeList\">".$page_title."</a> ".$page_title_extension; 
		if ($page == "about")  			$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
		if ($page == "brewBlogCurrent") $breadcrumb =  $row_pref['menuHome']." &gt; ".$page_title.$page_title_extension; 
		if ($page == "calendar") 		$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
		if ($page == $row_pref['home']) $breadcrumb = $bDefault;
	}

	if ($row_pref['mode'] == "2") {
		if ($page == $row_pref['home']) $breadcrumb = $bDefault;
		if ($page == "news")  			$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
		if ($page == "profile") { 
			if ($filter == "all") $breadcrumb = $bDefault; 
			if ($filter != "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=members&sort=realLastName&dir=ASC\">".$row_pref['menuMembers']."</a> &gt; ".$page_title.$page_title_extension;
		}

		if (($page == "brewBlogList") && ($row_pref['home'] == "brewBlogList")) { 
			if ($filter == "all") $breadcrumb = $bDefault; 
			if ($filter != "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$row_pref['menuBrewBlogs']." &gt; ".$page_title.$page_title_extension;
		}
		
		if (($page == "brewBlogList") && ($row_pref['home'] != "brewBlogList")) { 
			if ($filter == "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension;
			if ($filter != "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=brewBlogList&sort=brewDate&dir=DESC\">".$row_pref['menuBrewBlogs']."</a> &gt; ".$page_title.$page_title_extension; 
		}

		if (($page == "recipeList") && ($row_pref['home'] == "recipeList")) {
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$row_pref['menuRecipes']." &gt; ".$page_title.$page_title_extension;
		}
		
		if (($page == "recipeList") && ($row_pref['home'] != "recipeList")) {
			if ($filter == "all") $breadcrumb = "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension;
			if ($filter != "all") $breadcrumb = "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=recipeList\">".$row_pref['menuRecipes']."</a> &gt; ".$page_title.$page_title_extension;
		}

		if (($page == "awardsList") && ($row_pref['home'] == "awardsList")) { 
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb = "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$row_pref['menuAwards']." &gt; ".$page_title.$page_title_extension;
		}
		if (($page == "awardsList") && ($row_pref['home'] != "awardsList")) {
			if ($filter == "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension;
			if ($filter != "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=awardsList\">".$row_pref['menuAwards']."</a> &gt; ".$page_title.$page_title_extension;
		}

		if (($page == "calendar") && ($row_pref['home'] == "calendar")) { 
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb = "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; Calendar &gt; ".$page_title.$page_title_extension;
		}
		if (($page == "calendar") && ($row_pref['home'] != "calendar")) {
			if ($filter == "all") $breadcrumb = "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; ".$page_title.$page_title_extension; 
			if ($filter != "all") $breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=calendar\">Calendar</a> &gt; ".$page_title.$page_title_extension;
		}
		if (($page == "recipeDetail") && ($row_log['brewBrewerID'] != "")) 		$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=recipeList\">".$row_pref['menuRecipes']."</a> &gt; <a href=\"index.php?page=recipeList&filter=".$row_log['brewBrewerID']."\">".$row_user3['realFirstName']."&nbsp;".$row_user3['realLastName']."'s ".$row_pref['menuRecipes']."</a>".$page_title_extension;
		if (($page == "recipeDetail") && ($row_log['brewBrewerID'] == "")) 		$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=recipeList\">".$page_title."</a>".$page_title_extension;
		if (($page == "brewBlogDetail") && ($row_log['brewBrewerID'] != "")) 	$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=brewBlogList&sort=brewDate&dir=DESC\">".$row_pref['menuBrewBlogs']."</a> &gt; <a href=\"index.php?page=brewBlogList&filter=".$row_log['brewBrewerID']."&sort=brewDate&dir=DESC\">".$row_user3['realFirstName']."&nbsp;".$row_user3['realLastName']."'s ".$row_pref['menuBrewBlogs']."</a>".$page_title_extension;
		if (($page == "brewBlogDetail") && ($row_log['brewBrewerID'] == "")) 	$breadcrumb =  "<a href = \"index.php\">".$row_pref['menuHome']."</a> &gt; <a href=\"index.php?page=brewBlogList&sort=brewDate&dir=DESC\">".$page_title."</a>".$page_title_extension; 
	}
}


//----------------------------- Admin Breadcrumbs -------------------------
if ($page == "admin") {

$prefix = "Manage ";

if ($row_user['userLevel'] == "1") {
if ($filter == "all") 											$breadcrumb = $prefix.$dbName;
if ($filter != "all")											$breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix.$dbName."</a> &gt; ".$filter."'s ".$dbName;
if (($dbTable == "brewing") && ($action == "import")) 			$breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix.$dbName."</a>";
if (($dbTable == "recipes") && ($action == "importRecipes")) 	$breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix.$dbName."</a>";
if ($action == "importCalc") 									$breadcrumb = "<a href=\"javascript:history.back()\">Recipe Calculator</a>";
}


if 	   (($dbTable == "preferences") || ($dbTable == "brewer"))	$breadcrumb = "Edit ".$dbName;
elseif (($dbTable == "awards") && ($action == "edit"))  		$breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix." ".$dbName."</a> &gt; Edit ".$dbName;
elseif (($dbTable == "awards") && ($action == "add") && ($assoc == "default"))  			$breadcrumb = "<a href=\"?action=list&dbTable=".$assoc."\">".$prefix." ".$sourceName."</a> &gt; Add ".$dbName;
elseif (($dbTable == "awards") && ($action == "add") && ($assoc != "default"))  			$breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix." ".$dbName."</a> &gt; Add ".$dbName;
elseif ($dbTable == "mash_steps")  								$breadcrumb = "<a href=\"?action=list&dbTable=mash_profiles\">".$prefix." ".$dbName."</a> ";
else 															$breadcrumb = $prefix.$dbName;

if ($row_user['userLevel'] != "1") { 
if (($dbTable == "users") && ($action == "edit"))  		$breadcrumb = "<a href=\"?action=list&dbTable=users\">".$dbName."</a> &gt; Change Password";
}
}


?>