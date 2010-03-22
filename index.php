<?php 

//image dir / SQL information and connect to MySQL server
require_once ('Connections/config.php'); 

//choose SQL table and set up functions to user authentication and
//navbar configuration for login/logout links
require ('includes/authentication_nav.inc.php'); session_start();

//override various default settings with GET parameters, if they exist
include ('includes/url_variables.inc.php');

//set up brewers, themes, etc.
include ('includes/db_connect_universal.inc.php');

//set up recipes, brewlogs, etc.
include ('includes/db_connect_log.inc.php');

//include function to check for mobile browsers
include ('includes/check_mobile.inc.php');

//do various abv calculations related to the currently viewed recipe (if any)
include ('includes/abv.inc.php');

//include various conversions functions, date functions and truncate functions
//plus additional libs for 
//    titles.inc.php - set up the navigation?
//    messages.inc.php - tooltips and a few messages
//    scrubber.inc.php - a few arrays for character replacement
include ('includes/plug-ins.inc.php');

//figure out SRM and a hex value for displaying beer color
include ('includes/color.inc.php');

//determine if club edition or personal edition is in use
include ('includes/version.inc.php'); 

$imageSrc = "images/";

// -----------------------------------------------------------------------------------------------
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content="<?php echo $row_name['brewerLogName']; ?> is the homebrewing log and recipe collection of <?php if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName']; if ($row_name['brewerLastName'] != "") echo "&nbsp;".$row_name['brewerLastName']; ?>. Powered by BrewBlogger <?php echo $version; ?>.">
<meta name="robots" content="index,follow,noarchive"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
<title><?php if ($row_pref['mode'] == "1") { if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName']."&nbsp;"; if ($row_name['brewerLastName'] != "") echo $row_name['brewerLastName']."'s "; echo "BrewBlog &gt; ".$page_title.$page_title_extension; } if ($row_pref['mode'] == "2") echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLogName']." &gt; ".$page_title.$page_title_extension; if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail")) echo " [".$row_log['brewStyle']."]"; ?></title>
<link rel="stylesheet" href="css/html_elements.css" type="text/css">
<link rel="stylesheet" href="css/universal_elements.css" type="text/css">
<?php 
if (checkmobile()) {
echo "<link rel=\"stylesheet\" href=\"css/mobile.css\" type=\"text/css\" >";
} else {
echo "
<script type=\"text/javascript\" src=\"js_includes/menu.js\"></script>
<script type=\"text/javascript\" src=\"js_includes/jquery.js\"></script>
<script type=\"text/javascript\" src=\"js_includes/thickbox.js\"></script>
<script type=\"text/javascript\" src=\"js_includes/jump_menu.js\"></script>
<link rel=\"stylesheet\" href=\"css/thickbox.css\" type=\"text/css\" media=\"screen\">
<link rel=\"stylesheet\" href=\"css/".$row_pref['theme']."\" type=\"text/css\">";
} 
?>
<?php if (checkmobile()) echo ""; else { if (($page == "reference") && ($section == "carbonation")) { 
	if ($printBrowser == "IE") { ?>
<script language="JavaScript" type="text/JavaScript">
<!-- 
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
}
// -->
</script>
<?php } else { ?>
<script>
$(document).ready(function(){
tb_show('Carbonation Chart','reference/carbonation.php?KeepThis=true&TB_iframe=true&height=550&width=900', 'loadingAnimation.gif');
});
</script>
<?php } } } ?>
</head>
<body <?php if (($printBrowser == "IE") && ($page == "reference") && ($section == "carbonation")) echo "onLoad=\"javascript:popUp('reference/carbonation.php')\""; ?>>

<div id="maincontainer">
<!-- Begin Header -->
	<div id="header">
		<div class="titleText"><?php if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName'];  if (($row_pref['mode'] == "1") && ($row_name['brewerFirstName'] != ""))  echo "'s"; echo "&nbsp;".$row_name['brewerLogName']; ?></div><div class="quoteText"><?php echo $row_name['brewerTagline']; ?></div>
	</div>
	<div id="nav"><?php include ('includes/navigation.inc.php'); ?></div>
<!-- End Header -->
<!-- Begin Main Content -->
<div id="contentwrapper">
    <div id="<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "about") || ($page == "recipeDetail") || ($page == "profile")) echo "contentcolumn"; else echo "contentWide"; ?>">
    <div id="<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "about") || ($page == "profile")) echo "breadcrumb"; else echo "breadcrumbWide"; ?>"><?php echo $breadcrumb; ?></div>
	<?php if (($row_pref['mode'] == "2") && ($row_pref['home'] == $page) && ($row_pref['allowNews'] == "Y") && ($totalRows_newsGen > 0)) include ('sections/news.inc.php'); ?>
    <div id="<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "about") || ($page == "profile")) echo "subtitle"; else echo "subtitleWide"; ?>">
	   <div id="icon"><img src="<?php echo $imageSrc.$icon.".png"; ?>" align="bottom"></div>
	   <?php 
			if ($page == "brewBlogCurrent") echo $row_log['brewName']; 
			elseif ($page == "brewBlogDetail") { if ($row_pref['mode'] == "1") echo $row_log['brewName']; else echo "BrewBlog: ".$row_log['brewName']; }
			elseif ($page == "recipeDetail") { if ($row_pref['mode'] == "1") echo $row_log['brewName']; else echo "Recipe: ".$row_log['brewName']; }
			elseif ($page == "about") echo $page_title.$page_title_extension;
			elseif ($page == "login") echo $page_title.$page_title_extension;
			else echo $page_title; 
		?>
      </div> <!-- end subtitle or subtitleWide -->
		<?php 
		if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { 
					if ($row_pref['allowSpecifics'] == "Y") 		include ('sections/specifics.inc.php');
					if ($row_pref['allowGeneral'] == "Y") 			include ('sections/general.inc.php');
					if ($row_pref['allowComments'] == "Y") 			include ('sections/comments.inc.php');
					if ($row_pref['allowRecipe'] == "Y") 			include ('sections/recipe.inc.php');
					include ('sections/equipment.inc.php'); 
					if ($row_pref['allowMash'] == "Y") 				include ('sections/mash.inc.php');
					if ($row_pref['allowWater'] == "Y") 			include ('sections/water.inc.php');
					if ($row_pref['allowProcedure'] == "Y") 		include ('sections/procedure.inc.php');
					if ($row_pref['allowSpecialProcedure'] == "Y") 	include ('sections/special_procedure.inc.php');
					if ($row_pref['allowFermentation'] == "Y") 		include ('sections/fermentation.inc.php');
					if (checkmobile()) echo ""; else { if ($row_pref['allowReviews'] == "Y") include ('sections/reviews.inc.php'); } 		    
		} 
		if ($page == "brewBlogList") 	include('sections/brewblogList.inc.php'); 
		if ($page == "recipeList") 		include('sections/recipeList.inc.php'); 
        if ($page == "awardsList") 		include('sections/awardsList.inc.php'); 
		if ($page == "login")  			include ('sections/login.inc.php');   
		if ($page == "tools") 			include ('sections/tools.inc.php'); 
		if ($page == "about")  			include ('sections/about.inc.php'); 
		if ($page == "reference")  		include ('sections/reference.inc.php'); 
		if (($row_pref['allowCalendar'] == "Y") && ($page == "calendar")) include ('sections/calendar.inc.php'); 
		if (($row_pref['allowCalendar'] == "N") && ($page == "calendar")) echo "<p class=\"error\">This feature has been disabled by the site administrator.</p>"; 
		if (($row_pref['mode'] == "2") && ($page == "members"))  	include('sections/memberList.inc.php'); 
		if (($row_pref['mode'] == "2") && ($page == "profile"))		include ('sections/profile.inc.php');
		if (($row_pref['mode'] == "2") && ($page == "news")) 		include ('sections/news.inc.php');
		if ($page == "recipeDetail") { 
		// Include sections according to set preferences
			if ($row_pref['allowSpecifics'] == "Y") 	{ include ('sections/specifics.inc.php'); }
			if ($row_pref['allowGeneral'] == "Y") 		{ include ('sections/general.inc.php'); }
			if ($row_pref['allowRecipe'] == "Y") 		{ include ('sections/recipe.inc.php'); }
			if ($row_pref['allowProcedure'] == "Y") 	{ include ('sections/procedure.inc.php'); } 
			if ($row_pref['allowFermentation'] == "Y") 	{ include ('sections/fermentation.inc.php'); } 
			if ($row_pref['allowComments'] == "Y") 		{ include ('sections/notes.inc.php'); }
		   }
		?>  
    <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis pharetra elit non porta. Nullam vel ipsum turpis, quis volutpat odio. Nullam posuere fringilla lacus eget vulputate. Nullam at eros sit amet est iaculis egestas sit amet quis nunc. Sed pretium laoreet neque sed fringilla. Mauris rutrum vulputate velit, eu tincidunt orci rhoncus nec. Suspendisse adipiscing massa vitae purus egestas fermentum. Cras pulvinar, velit ac commodo posuere, dui felis aliquet tellus, quis pulvinar quam urna pellentesque justo. Aenean mattis tellus ipsum, venenatis vehicula diam. Curabitur quis ipsum ante, ullamcorper commodo nulla. Curabitur ultrices egestas libero a sagittis.</p>-->
    </div><!-- End contentcolumn -->
	<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "about") || ($page == "recipeDetail") || ($page == "profile")) { ?>
	<div id="rightcolumn">
	<?php 
		 if ($page == "about") { include ('sections/list.inc.php'); }
		 if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { 
		 				if (checkmobile()) echo ""; else {
						// Include printing, BeerXML buttons according to preferences
						if ($row_pref['allowPrintLog'] == "Y") 		{ include ('sections/printLog.inc.php'); }
						if ($row_pref['allowPrintRecipe'] == "Y") 	{ include ('sections/printRecipe.inc.php');  echo "&nbsp;"; }
						if ($row_pref['allowPrintXML'] == "Y") 		{ include ('sections/printXML.inc.php'); }
						}
						if (($row_pref['mode'] == "2") && ($filter != "all")) echo "<div id=\"sidebarWrapper\"><span class=\"text_9\"><span class=\"data_icon\"><img src = \"".$imageSrc."calendar_view_month.png\" alt=\"Calendar\" border=\"0\" align=\"absmiddle\"></span><span class=\"data\"><a href=\"index.php?page=calendar&filter=".$filter."\">View ".$row_user2['realFirstName']."'s Brewing Calendar</a></span></span></div>";
																	{ include ('sections/quick_edit.inc.php'); }
						if (checkmobile()) echo ""; else {
						// Include sidebar sections according to preferences
						if ($row_pref['allowLabel'] == "Y") 		{ include ('sections/label.inc.php'); }
						}
						if ($row_pref['allowAwards'] == "Y") 		{ include ('sections/awards.inc.php'); }
						if ($row_pref['allowRelated'] == "Y") 		{ include ('sections/related.inc.php'); } 
						include ('sections/list.inc.php');  
						if ($row_pref['allowStatus'] == "Y") 		{ include ('sections/status.inc.php'); } 
						if ($row_pref['allowUpcoming'] == "Y") 		{ include ('sections/upcoming.inc.php'); }		
		} 
		if ($page == "recipeDetail") { 
		// Include sidebar sections according to preferences
		    if ($row_pref['allowPrintRecipe'] == "Y") 	{ include ('sections/printRecipe.inc.php'); echo "&nbsp;"; }
			if ($row_pref['allowPrintXML'] == "Y") 		{ include ('sections/printXML.inc.php'); }
														{ include ('sections/quick_edit.inc.php'); }
			if ($row_pref['allowAwards'] == "Y") 		{ include ('sections/awards.inc.php'); }
			if ($row_pref['allowRelated'] == "Y") 		{ include ('sections/related.inc.php'); } 
			if ($row_pref['allowList'] == "Y") 			{ include ('sections/list.inc.php'); } 
			
	    } 
        
        if ($page == "profile") include ('sections/userPic.inc.php'); 
	?>
	</div><!-- End rightcolumn -->
    <?php } ?>
</div><!-- End contentWrapper -->
<!-- End Main Content -->

<!-- Begin Footer -->
<div id="footer"><?php include ('includes/footer.inc.php'); ?></div>
<!-- End Footer -->

</div><!-- End Main Container -->
</body>
</html>
