<?php
$dbName = "";
$page_title = "";
$page_title_extension = "";
$sqlSelect = "";
$msgName = "";
$sourceName = "";
$icon = "";
$dbTable = "";
$source = "";
$destination = "";
$action_name = "";
$title = "";

// ---------------------------- Friendly Names------------------------------------------
if (($dbTable == "recipes") || ($source == "recipes") || ($page == "recipe-list") || ($page == "recipe")) 		{
	$dbName = $row_pref['menuRecipes'];
	$sqlSelect = "brewName";
	$msgName = "recipe";
	$sourceName = $row_pref['menuRecipes'];
	$icon = "script";
	$dbTable = "recipes";
	if ($page != "admin") $source = "recipe";
	$destination = "recipe";
}

if (($dbTable == "brewing") || ($source == "brewing") || ($page == "brewblog-list") || ($page == "brewblog") || ($page == "current")) {
	$dbName = $row_pref['menuBrewBlogs'];
	$sqlSelect = "brewDate";
	$msgName = "log";
	$sourceName = $row_pref['menuBrewBlogs'];
	$icon = "book";
	$dbTable = "brewing";
	if ($page != "admin") $source = "brewLog";
	$destination = "brewblog";
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

if ($dbTable == "yeast_profiles") {
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

if (($dbTable == "brewer") && ($row_pref['mode'] == "1")) {
	$dbName = "Brewer";
	$icon = "user";
}

if (($dbTable == "brewer") && ($row_pref['mode'] == "2")) {
	$dbName = "Club Profile";
	$icon = "group";
}

if ($dbTable == "preferences") {
	$dbName = "Preferences";
	$icon = "cog";
}

// ---------------------------- Titles --------------------------------------------------

if 	($page == "current") 	{
	if ($row_pref['mode'] == "1") $page_title = "Current ";
	if ($row_pref['mode'] == "2") $page_title = $row_pref['menuBrewBlogs'];
	$page_title_extension = " &gt; ".$row_log['brewName']; $icon = "book";
}

if 	($page == "members") {
	$page_title = $row_pref['menuMembers'];
	$icon = "group";
}

if 	($page == "news") {
	$page_title = "News/Announcements";
	$icon = "newspaper";
}

if 	(($page == "brewblog-list") && ($filter == "all")) {
	$page_title = $row_pref['menuBrewBlogs'];
	$page_title_extension = ""; $icon = "book";
}

if 	(($page == "brewblog-list") && ($filter != "all")) {
	$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
	$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
	$row_user2 = mysqli_fetch_assoc($user2);
	$totalRows_user2 = mysqli_num_rows($user2);
	$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuBrewBlogs'];
	$page_title_extension = "";
	$icon = "book";
}

if 	($page == "brewblog") {
	$page_title = $row_pref['menuBrewBlogs']; $page_title_extension = " &gt; ".$row_log['brewName'];
	$icon = "book";
}

if 	(($page == "recipe-list") && ($filter == "all")) {
	$page_title = $row_pref['menuRecipes'];
	$page_title_extension = "";
	$icon = "script";
}

if 	(($page == "recipe-list") && ($filter != "all"))
		{
		if ($row_pref['mode'] == "2") {
			$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
			$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
			$row_user2 = mysqli_fetch_assoc($user2);
			$totalRows_user2 = mysqli_num_rows($user2);
			$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuRecipes'];
			$page_title_extension = "";
			$icon = "script";
		}
		else $page_title = $row_pref['menuRecipes']; $page_title_extension = ""; $icon = "script";
		}

if 	($page == "recipe") {
	$page_title = $row_pref['menuRecipes'];
	$page_title_extension = " &gt; ".$row_log['brewName'];
	$icon = "script";
}

if 	($page == "about") {
	if ($row_pref['mode'] == "1") $page_title = $row_pref['menuAbout']; $page_title_extension = " "; $icon = "user";
	if ($row_pref['mode'] == "2") $page_title = $row_pref['menuAbout'];   $page_title_extension = ""; $icon = "group";
}

if 	($page == "login") {
	$page_title = $row_pref['menuLogin'];
	$icon = "user";
}

if 	($page == "tools") {
	$page_title = $row_pref['menuCalculators'];
	$icon = "calculator";
}

if 	($page == "reference") {
	$page_title = $row_pref['menuReference'];
	$icon = "book_open";
}

if 	(($page == "reviews")  || ($page == "reviewsView")) {
	$page_title = "Tastings and Reviews";
	 $icon = "page_edit";
}

if 	(($page == "awards-list") && ($filter == "all")) {
	$page_title = $row_pref['menuAwards'];
	$icon = "medal_gold_3";
}

if 	(($page == "awards-list") && ($filter != "all")) {
	$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
	$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
	$row_user2 = mysqli_fetch_assoc($user2);
	$totalRows_user2 = mysqli_num_rows($user2);
	$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuAwards'];
	$icon = "medal_gold_3";
}

if 	(($page == "calendar") && ($filter == "all")) {
	$page_title = $row_pref['menuCalendar'];
	$icon = "calendar_view_month";
}

if 	(($page == "calendar") && ($filter != "all")) {
	$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
	$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
	$row_user2 = mysqli_fetch_assoc($user2);
	$totalRows_user2 = mysqli_num_rows($user2);
	$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s ".$row_pref['menuCalendar'];
	$icon = "calendar_view_month";
}

if 	($page == "profile") {
	$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
	$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
	$row_user2 = mysqli_fetch_assoc($user2);
	$totalRows_user2 = mysqli_num_rows($user2);
	$page_title = $row_user2['realFirstName']."&nbsp;". $row_user2['realLastName']."'s Profile";
	$icon = "user";
}

// Add or Edit actions
if ($page == "admin") {
	if ($action == "add") 				$action_name = "Add";
	if ($action == "edit") 				$action_name = "Edit";
	if ($action == "list")				$action_name = "Manage";
	if ($dbTable == "default")   		$page_title = "Administration";
	else $page_title = $action_name." ".$dbName;

// Special actions
	if 	(($action == "import") && ($dbTable == "brewing")) $page_title = "Import ".$row_pref['menuRecipes']." to ".$row_pref['menuBrewBlogs'];
	if 	(($action == "importRecipe") && ($dbTable == "recipes")) $page_title = "Import ".$row_pref['menuBrewBlogs']." to ".$row_pref['menuRecipes'];
	if 	(($action == "importCalc") && ($dbTable == "recipes")) $page_title = "Add ".$row_pref['menuRecipes'];
	if 	(($action == "importCalc") && ($dbTable == "brewing")) $page_title = "Add ".$row_pref['menuBrewBlogs'];
	if 	(($action == "reuse")  && ($dbTable == "brewing")) $page_title = "Reuse ".$row_pref['menuBrewBlogs'];
	if (($action == "reuse")  && ($dbTable == "recipes")) $page_title = "Copy ".$row_pref['menuRecipes'];
	if (($action == "reuse")  && ($dbTable != "recipes")) $page_title = "Copy ".$dbName;
	if 	(($action == "edit")   && ($dbTable == "users") && ($row_user['userLevel'] == "1") && (($row_pref['mode'] == "2") || ($row_pref['mode'] == "1"))) $page_title = "Edit Users";

	if 	($action == "exportSQL") {
		$page_title = "Export SQL: <em>".$dbName."</em> Database";
		$icon = "page_lightning";
	}

	if 	(($page != "tools") && ($action == "calculate")) {
		$page_title = "Recipe Calculator";
		$icon = "calculator";
	}

	if 	($action == "chooseRecalc") {
		$page_title = "Recalculate ".$row_pref['menuBrewBlogs']." or ".$row_pref['menuRecipes'];
		$icon = "calculator";
	}

	if 	($action == "chooseAward") {
		$page_title = "Add ".$row_pref['menuAwards'];
		$icon = "medal_gold_3";
	}

}

// ----------------------------- Breadcrumbs -------------------------
if ($page != "admin") {
	$bDefault = "<li>".$row_pref['menuHome']."</li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
	if (($page == "login") || ($page == "logout") || ($page == "reference") || ($page == "tools") || ($page == "members")) $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";

	if ($row_pref['mode'] == "1") {
		if ($page == "brewblog-list") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == "recipe-list") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == "awards-list") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", str_replace(" &gt; ", "</li><li>", $page_title_extension))."</li>";
		if ($page == "brewblog") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=brewblog-list\">".$page_title."</a>".str_replace(" &gt; ", "</li><li>", str_replace(" &gt; ", "</li><li>", $page_title_extension))."</li>";
		if ($page == "recipe") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=recipe-list\">".$page_title."</a> ".str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == "about") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == "current") $breadcrumb = $row_pref['menuHome']."</li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == "calendar") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == $row_pref['home']) $breadcrumb = $bDefault;
	}

	if ($row_pref['mode'] == "2") {
		if ($page == $row_pref['home']) $breadcrumb = $bDefault;
		if ($page == "news") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		if ($page == "profile") {
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=members\">".$row_pref['menuMembers']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "brewblog-list") && ($row_pref['home'] == "brewblog-list")) {
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$row_pref['menuBrewBlogs']."</li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "brewblog-list") && ($row_pref['home'] != "brewblog-list")) {
			if ($filter == "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
			if ($filter != "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=brewblog-list\">".$row_pref['menuBrewBlogs']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "recipe-list") && ($row_pref['home'] == "recipe-list")) {
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$row_pref['menuRecipes']."</li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "recipe-list") && ($row_pref['home'] != "recipe-list")) {
			if ($filter == "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
			if ($filter != "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=recipe-list\">".$row_pref['menuRecipes']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "awards-list") && ($row_pref['home'] == "awards-list")) {
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$row_pref['menuAwards']."</li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}
		if (($page == "awards-list") && ($row_pref['home'] != "awards-list")) {
			if ($filter == "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
			if ($filter != "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=awards-list\">".$row_pref['menuAwards']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "calendar") && ($row_pref['home'] == "calendar")) {
			if ($filter == "all") $breadcrumb = $bDefault;
			if ($filter != "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>Calendar</li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "calendar") && ($row_pref['home'] != "calendar")) {
			if ($filter == "all") $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
			if ($filter != "all") $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=calendar\">Calendar</a></li><li>".$page_title.str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
		}

		if (($page == "recipe") && ($row_log['brewBrewerID'] != "")) $breadcrumb = "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=recipe-list\">".$row_pref['menuRecipes']."</a></li><li><a href=\"".$base_url."index.php?page=recipe-list&filter=".$row_log['brewBrewerID']."\">".$row_user3['realFirstName']."&nbsp;".$row_user3['realLastName']."'s ".$row_pref['menuRecipes']."</a>".str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";

		if (($page == "recipe") && ($row_log['brewBrewerID'] == "")) $breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=recipe-list\">".$page_title."</a>".str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";

		if (($page == "brewblog") && ($row_log['brewBrewerID'] != "")) $breadcrumb =  "<li><li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=brewblog-list\">".$row_pref['menuBrewBlogs']."</a></li><li><a href=\"".$base_url."index.php?page=brewblog-list&filter=".$row_log['brewBrewerID']."\">".$row_user3['realFirstName']."&nbsp;".$row_user3['realLastName']."'s ".$row_pref['menuBrewBlogs']."</a>".str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";

		if (($page == "brewblog") && ($row_log['brewBrewerID'] == "")) 	$breadcrumb =  "<li><a href=\"".$base_url."index.php\">".$row_pref['menuHome']."</a></li><li><a href=\"".$base_url."index.php?page=brewblog-list\">".$page_title."</a>".str_replace(" &gt; ", "</li><li>", $page_title_extension)."</li>";
	}
}


//----------------------------- Admin Breadcrumbs -------------------------
if ($page == "admin") {

	if (isset($_SESSION['loginUsername'])) {

	$prefix = "Manage ";

		if ($row_user['userLevel'] == "1") {
			if ($filter == "all") $breadcrumb = $prefix.$dbName;
			if ($filter != "all") $breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix.$dbName."</a></li><li>".$filter."'s ".$dbName;
			if (($dbTable == "brewing") && ($action == "import")) $breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix.$dbName."</a>";
			if (($dbTable == "recipes") && ($action == "importRecipes")) $breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix.$dbName."</a>";
			if ($action == "importCalc") $breadcrumb = "<a href=\"javascript:history.back()\">Recipe Calculator</a>";
		}

		if (($dbTable == "preferences") || ($dbTable == "brewer")) $breadcrumb = "Edit ".$dbName;
		elseif (($dbTable == "awards") && ($action == "edit")) $breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix." ".$dbName."</a></li><li>Edit ".$dbName;
		elseif (($dbTable == "awards") && ($action == "add") && ($assoc == "default")) $breadcrumb = "<a href=\"?action=list&dbTable=".$assoc."\">".$prefix." ".$sourceName."</a></li><li>Add ".$dbName;
		elseif (($dbTable == "awards") && ($action == "add") && ($assoc != "default")) $breadcrumb = "<a href=\"?action=list&dbTable=".$dbTable."\">".$prefix." ".$dbName."</a></li><li>Add ".$dbName;
		elseif ($dbTable == "mash_steps") $breadcrumb = "<a href=\"?action=list&dbTable=mash_profiles\">".$prefix." ".$dbName."</a> ";
		else $breadcrumb = $prefix.$dbName;

		if ($row_user['userLevel'] != "1") {
			if (($dbTable == "users") && ($action == "edit")) $breadcrumb = "<a href=\"?action=list&dbTable=users\">".$dbName."</a></li><li>Change Password";
		}

	}

} // end if ($page == "admin")

// ---------------------------- Heading Elements ---------------------------------------
if ($page == "current") $header_output = $row_log['brewName'];
elseif ($page == "brewblog") {
   	if ($row_pref['mode'] == "1")	$header_output = $row_log['brewName'];
   	else $header_output = "BrewBlog: " . $row_log['brewName'];
}
elseif ($page == "recipe") {
	if ($row_pref['mode'] == "1") $header_output = $row_log['brewName'];
    else $header_output =  "Recipe: " . $row_log['brewName'];
}

elseif ($page == "about") $header_output = $page_title.$page_title_extension;

elseif ($page == "login") $header_output = $page_title.$page_title_extension;

elseif ($page == "admin") {
	$header_output = "Administration";

	if ($section = "default") $page_title = " Dashboard";

	$header_output .= $page_title.$page_title_extension;
}

else $header_output = $page_title;

if ($row_pref['mode'] == "1") {
    if ($row_name['brewerFirstName'] != "") $title .= $row_name['brewerFirstName']."&nbsp;";
    if ($row_name['brewerLastName'] != "") $title .= $row_name['brewerLastName']."'s ";
    $title .= "BrewBlog &gt; ".$page_title.$page_title_extension;
}

if ($row_pref['mode'] == "2") {
    $title .= $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLogName']." &gt; ".$page_title.$page_title_extension;
}

?>