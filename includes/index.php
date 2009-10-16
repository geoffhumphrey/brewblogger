<?php 
require_once ('Connections/config.php'); 
require ('includes/authentication_nav.inc.php');  session_start();
include ('includes/db_connect_universal.inc.php');
include ('includes/db_connect_log.inc.php');
include ('includes/check_mobile.inc.php');
include ('includes/abv.inc.php');
include ('includes/color.inc.php');
include ('includes/plug-ins.inc.php');
include ('includes/version.inc.php'); 
$imageSrc = "images/";

// -----------------------------------------------------------------------------------------------
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content="<?php echo $row_name['brewerLogName']; ?> is the homebrewing log and recipe collection of <?php if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName']; if ($row_name['brewerLastName'] != "") echo "&nbsp;".$row_name['brewerLastName']; ?>. Powered by BrewBlogger <?php echo $version; ?>.">
<meta name="robots" content="index,follow,noarchive" /> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
<title><?php if ($row_pref['mode'] == "1") { if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName']."&nbsp;"; if ($row_name['brewerLastName'] != "") echo $row_name['brewerLastName']."'s "; echo "BrewBlog &gt; ".$page_title.$page_title_extension; } if ($row_pref['mode'] == "2") echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLogName']." &gt; ".$page_title.$page_title_extension; if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail")) echo " [".$row_log['brewStyle']."]"; ?></title>
<?php 
if (checkmobile()) {
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/mobile.css\">";
} else {
echo "
<script type=\"text/javascript\" src=\"js_includes/jquery.js\"></script>
<script type=\"text/javascript\" src=\"js_includes/thickbox.js\"></script>
<script type=\"text/javascript\" src=\"js_includes/jump_menu.js\"></script>
<link rel=\"stylesheet\" href=\"css/thickbox.css\" type=\"text/css\" media=\"screen\" />
";
//echo "<link rel=\"stylesheet\" href=\"css/".$row_pref['theme']."\" type=\"text/css\">";
echo "<link rel=\"stylesheet\" href=\"css/mobile.css\" type=\"text/css\">";
} 
?>
<link rel=\"stylesheet\" href=\"css/".$row_pref['theme']."\" type=\"text/css\">
<?php if (checkmobile()) echo ""; else { if
(($page == "reference") && ($section == "carbonation")) { ?>
<script language="JavaScript" type="text/JavaScript">
<!-- 
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
}
// -->
</script>
<?php } } ?>
</head>
<body <?php if ($page == "login") echo "onLoad=\"self.focus();document.form1.loginUsername.focus()\""; if (($page == "reference") && ($section == "carbonation")) echo "onLoad=\"javascript:popUp('reference/carbonation.php')\""; ?>>
<!-- Begin Main Wrapper -->
<div id="maincontainer">
<!-- Begin Header -->
	<div id="header">
		<div class="titleText"><?php if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName'];  if (($row_pref['mode'] == "1") && ($row_name['brewerFirstName'] != ""))  echo "'s"; echo "&nbsp;".$row_name['brewerLogName']; ?></div><div class="quoteText"><?php echo $row_name['brewerTagline']; ?></div>
	</div>
	<div id="nav"><?php include ('includes/navigation.inc.php'); ?></div>
<!-- End Header -->
	
<!-- Begin Content Wrapper -->

	<div id="contentwrapper">
		<!-- Begin Left Section -->
	   <div id="<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "about") || ($page == "profile")) echo "breadcrumb"; else echo "breadcrumbWide"; ?>"><?php echo $breadcrumb; ?></div>
       <?php if (($row_pref['mode'] == "2") && ($row_pref['home'] == $page) && ($row_pref['allowNews'] == "Y") && ($totalRows_newsGen > 0)) include ('sections/news.inc.php'); ?>
       <div id="<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "about") || ($page == "profile")) echo "subtitle"; else echo "subtitleWide"; ?>">
	   		<div id="icon"><img src="<?php echo $imageSrc.$icon.".png"; ?>" align="baseline"></div>
	   <?php 
			if ($page == "brewBlogCurrent") echo $row_log['brewName']; 
			elseif ($page == "brewBlogDetail") { if ($row_pref['mode'] == "1") echo $row_log['brewName']; else echo "BrewBlog: ".$row_log['brewName']; }
			elseif ($page == "recipeDetail") { if ($row_pref['mode'] == "1") echo $row_log['brewName']; else echo "Recipe: ".$row_log['brewName']; }
			elseif ($page == "about") echo $page_title.$page_title_extension;
			elseif ($page == "login") echo $page_title.$page_title_extension;
			else echo $page_title; 
		?>
        </div>
	    <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { ?>
		<div id="contentcolumn">
			 		<?php
					if ($row_pref['allowSpecifics'] == "Y") { include ('sections/specifics.inc.php'); }
					if ($row_pref['allowGeneral'] == "Y") { include ('sections/general.inc.php'); }
					if ($row_pref['allowComments'] == "Y") { include ('sections/comments.inc.php'); }
					if ($row_pref['allowRecipe'] == "Y") { include ('sections/recipe.inc.php'); }
					if ($row_pref['allowMash'] == "Y") { include ('sections/mash.inc.php'); } 
					if ($row_pref['allowWater'] == "Y") { include ('sections/water.inc.php'); } 
					if ($row_pref['allowProcedure'] == "Y") { include ('sections/procedure.inc.php'); } 
					if ($row_pref['allowSpecialProcedure'] == "Y") { include ('sections/special_procedure.inc.php'); } 
					if ($row_pref['allowFermentation'] == "Y") { include ('sections/fermentation.inc.php'); }
					if (checkmobile()) echo ""; else {  
					if ($row_pref['allowReviews'] == "Y") { include ('sections/reviews.inc.php'); } 
					}
				    ?>
		</div>
		<?php } 
		if ($page == "brewBlogList") include('sections/brewblogList.inc.php'); 
		if ($page == "recipeList") include('sections/recipeList.inc.php'); 
        if ($page == "awardsList") include('sections/awardsList.inc.php'); 
		if ($page == "recipeDetail") { ?>
		  <div id="contentcolumn">
		  <?php // Include sections according to set preferences
			if ($row_pref['allowSpecifics'] == "Y") 	{ include ('sections/specifics.inc.php'); }
			if ($row_pref['allowGeneral'] == "Y") 		{ include ('sections/general.inc.php'); }
			if ($row_pref['allowRecipe'] == "Y") 		{ include ('sections/recipe.inc.php'); }
			if ($row_pref['allowProcedure'] == "Y") 	{ include ('sections/procedure.inc.php'); } 
			if ($row_pref['allowFermentation'] == "Y") 	{ include ('sections/fermentation.inc.php'); } 
			if ($row_pref['allowComments'] == "Y") 		{ include ('sections/notes.inc.php'); }
		  ?>
		</div><!-- End ContentColumn Div for Recipe Detail Page-->
		<?php } 
		if ($page == "login") { ?>
		<div id="contentWide">
        <?php include ('sections/login.inc.php'); ?>
		</div>
		<?php }  
		if ($page == "tools") { ?>
		<div id="contentWide">
        <?php include ('sections/tools.inc.php'); ?>
		</div>
		<?php } 
		if ($page == "about") { ?>
       <div id="contentcolumn">
		<?php include ('sections/about.inc.php'); ?>
		</div>
		<?php } 
		if ($page == "reference") { ?>
		<div id="contentWide">
        <?php include ('sections/reference.inc.php'); ?>
		</div>
		<?php } 
		if (($row_pref['allowCalendar'] == "Y") && ($page == "calendar")) { ?>
		<div id="contentWide">
        <?php include ('sections/calendar.inc.php'); ?>
		</div>
		<?php } 
		if (($row_pref['allowCalendar'] == "N") && ($page == "calendar")) { ?>
        <div id="contentWide">
        <p class="error">This feature has been disabled by the site administrator.</p>
        </div> 
        <?php } 
		if (($row_pref['mode'] == "2") && ($page == "members")) { ?>
        <div id="contentWide">
        <?php include('sections/memberList.inc.php'); ?>
        </div>
        <?php } 
		if (($row_pref['mode'] == "2") && ($page == "profile")) { ?>
        <div id="contentcolumn">
        <?php include ('sections/profile.inc.php'); ?>
        </div>
        <?php } 
		if (($row_pref['mode'] == "2") && ($page == "news")) { ?>
        <div id="contentWide">
        <?php include ('sections/news.inc.php'); ?>
        </div>
        <?php } ?>
        
		
	</div> <!-- End ContentWrapper Div -->
	<!-- End Left Section -->

	<!-- Begin Right Section -->
	<div id="rightcolumn">
		<?php 
		 if ($page == "about") { include ('sections/list.inc.php'); }
		 if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { 
		 				if (checkmobile()) echo ""; else {
						if ($row_pref['allowPrintLog'] == "Y") 		{ include ('sections/printLog.inc.php'); }
						if ($row_pref['allowPrintRecipe'] == "Y") 	{ include ('sections/printRecipe.inc.php');  echo "&nbsp;"; }
						if ($row_pref['allowPrintXML'] == "Y") 		{ include ('sections/printXML.inc.php'); }
						}
						if (($row_pref['mode'] == "2") && ($filter != "all")) echo "<br><span class=\"text_9\">&nbsp;<img src = \"".$imageSrc."calendar_view_month.png\" alt=\"Calendar\" border=\"0\" align=\"absmiddle\"><a href=\"index.php?page=calendar&filter=".$filter."\">&nbsp;View ".$row_user2['realFirstName']."'s Brewing Calendar</a></span>";
																	{ include ('sections/quick_edit.inc.php'); }
						if (checkmobile()) echo ""; else {
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
	</div>
	
	<!-- End Right Section -->
		
	<!-- End Content Wrapper -->
	
	<div id="footer"><?php include ('includes/footer.inc.php'); ?></div>
	<!-- End Footer -->

<!-- End Overall Wrapper -->
    </div>
</div>	 
</body>
</html>
