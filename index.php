<?php 
require ('paths.php');
require_once (CONFIG.'config.php'); 

//choose SQL table and set up functions to user authentication and
//navbar configuration for login/logout links
require (INCLUDES.'authentication_nav.inc.php'); session_start();

//override various default settings with GET parameters, if they exist
include (INCLUDES.'url_variables.inc.php');

//set up brewers, themes, etc.
include (INCLUDES.'db_connect_universal.inc.php');

//set up recipes, brewlogs, etc.
include (INCLUDES.'db_connect_log.inc.php');

//include various conversions functions, date functions and truncate functions
//plus additional libs for 
//    titles.inc.php - set up the navigation?
//    messages.inc.php - tooltips and a few messages
//    scrubber.inc.php - a few arrays for character replacement
include (INCLUDES.'functions.inc.php');

//figure out SRM and a hex value for displaying beer color
//include (INCLUDES.'color.inc.php');

// Load color library functions
require_once (ADMIN_LIBRARY.'color.lib.php');

//determine if club edition or personal edition is in use
include (INCLUDES.'version.inc.php'); 

// Load constants
require_once (ADMIN_INCLUDES.'constants.inc.php');

$imageSrc = "images/";

if ($section == "admin") {
	$container_main = "container-fluid";
	$nav_container = "navbar-inverse";
}
	
else { 
	$container_main = "container";
	$nav_container = "navbar-default";
}


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
else $header_output = $page_title;

// -----------------------------------------------------------------------------------------------
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if ($row_pref['mode'] == "1") { if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName']."&nbsp;"; if ($row_name['brewerLastName'] != "") echo $row_name['brewerLastName']."'s "; echo "BrewBlog &gt; ".$page_title.$page_title_extension; } if ($row_pref['mode'] == "2") echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLogName']." &gt; ".$page_title.$page_title_extension; if (($page == "current") || ($page == "brewblog") || ($page == "recipe")) echo " [".$row_log['brewStyle']."]"; ?></title>
    
	<!-- Load jQuery / http://jquery.com/ -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	
    <!-- Load Bootstrap / http://www.getbootsrap.com -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    <!-- Load DataTables / https://www.datatables.net -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.10/integration/font-awesome/dataTables.fontAwesome.css" />
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    
    <!-- Load Fancybox / http://www.fancyapps.com -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    
    <!-- Load Bootstrap DateTime Picker / http://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    
	<!-- Load TinyMCE / https://www.tinymce.com/ -->
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	
    <!-- Load Jasny Off-Canvas Menu for Admin / http://www.jasny.net/bootstrap -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
		
    <!-- Load DropZone / http://www.dropzonejs.com -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script src="<?php echo $base_url;?>js_includes/dz.min.js"></script>
	
	<!-- Load Bootstrap Form Validator / http://1000hz.github.io/bootstrap-validator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.9.0/validator.min.js"></script>
   
    <!-- Load Bootstrap-Select / http://silviomoreto.github.io/bootstrap-select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>
    
    <!-- Load Font Awesome / https://fortawesome.github.io/Font-Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <!-- Load Custom Theme CSS - Contains Bootstrap overrides and custom classes -->
    <link rel="stylesheet" type="text/css" href="css/default.css" />
	<link rel="stylesheet" type="text/css" href="css/universal_elements.css" />
	<!-- Load Custom JS -->
    <script src="js_includes/bb_custom.min.js"></script>
  
</head>
<body>
    <!-- MAIN NAV -->
	<div class="<?php echo $container_main; ?> hidden-print">
		<?php include (INCLUDES.'navigation.inc.php'); ?>
	</div><!-- container -->   
    <!-- ./MAIN NAV -->
    
    <!-- ALERTS -->
    <div class="<?php echo $container_main; ?>">
    	<?php // include (SECTIONS.'alerts.sec.php'); ?>
    </div><!-- ./container --> 
    <!-- ./ALERTS -->
    
    
    
    
    
    <!-- Fixed Layout with Sidebar -->
    <div class="container"> 
    	<div class="row">
    		<?php if (($page == "current") || ($page == "brewblog") || ($page == "recipe")) { ?>
            <div class="col col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <?php } else { ?>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php } ?>
            <div class="page-header">
        		<h1><?php echo $header_output; ?></h1>
        	</div>             
        	<?php 
				if (($page == "current") || ($page == "brewblog")) { 
					if ($row_pref['allowSpecifics'] == "Y") 			include (SECTIONS.'recipe_specifics.inc.php');
					if ($row_pref['allowGeneral'] == "Y")			include (SECTIONS.'recipe_general.inc.php');
					if ($row_pref['allowComments'] == "Y")			include (SECTIONS.'recipe_comments.inc.php');
					if ($row_pref['allowRecipe'] == "Y")				include (SECTIONS.'recipe.inc.php');
					include (SECTIONS.'recipe_equipment.inc.php'); 
					if ($row_pref['allowMash'] == "Y")				include (SECTIONS.'recipe_mash.inc.php');
					if ($row_pref['allowWater'] == "Y")				include (SECTIONS.'recipe_water.inc.php');
					if ($row_pref['allowProcedure'] == "Y")			include (SECTIONS.'recipe_procedure.inc.php');
					if ($row_pref['allowSpecialProcedure'] == "Y")	include (SECTIONS.'recipe_special_procedure.inc.php');
					if ($row_pref['allowFermentation'] == "Y")		include (SECTIONS.'recipe_fermentation.inc.php');
				  	if ($row_pref['allowReviews'] == "Y")		  	include (SECTIONS.'recipe_reviews.inc.php');
				  	    
				}
				
				elseif ($page == "recipe") { 
					if ($row_pref['allowSpecifics'] == "Y") 			include (SECTIONS.'recipe_specifics.inc.php');
					if ($row_pref['allowGeneral'] == "Y") 			include (SECTIONS.'recipe_general.inc.php');
					if ($row_pref['allowRecipe'] == "Y") 			include (SECTIONS.'recipe.inc.php');
					if ($row_pref['allowProcedure'] == "Y") 			include (SECTIONS.'recipe_procedure.inc.php');
					if ($row_pref['allowFermentation'] == "Y") 		include (SECTIONS.'recipe_fermentation.inc.php');
					if ($row_pref['allowComments'] == "Y") 			include (SECTIONS.'recipe_notes.inc.php');
				}
				
				elseif ($page == "brewblog-list") 					include (SECTIONS.'brewblogList.inc.php');
				elseif ($page == "recipe-list") 						include (SECTIONS.'recipeList.inc.php');
				elseif ($page == "awardsList") 						include (SECTIONS.'awardsList.inc.php');
				elseif ($page == "login") 							include (SECTIONS.'login.inc.php');
				elseif ($page == "tools") 							include (SECTIONS.'tools.inc.php');
				elseif ($page == "about") 							include (SECTIONS.'about.inc.php');
				elseif ($page == "reference") 						include (SECTIONS.'reference.inc.php');
				elseif (($row_pref['allowCalendar'] == "Y") && ($page == "calendar")) 	include (SECTIONS.'calendar.inc.php');
				elseif (($row_pref['allowCalendar'] == "N") && ($page == "calendar")) 	echo "<p class=\"error\">This feature has been disabled by the site administrator.</p>";
				elseif (($row_pref['mode'] == "2") && ($page == "members")) 				include(SECTIONS.'memberList.inc.php');
				elseif (($row_pref['mode'] == "2") && ($page == "profile")) 				include (SECTIONS.'profile.inc.php');
				elseif (($row_pref['mode'] == "2") && ($page == "news"))  				include (SECTIONS.'news.inc.php');
				
				
			?> 
            </div><!-- ./left column -->
            
            <?php if (($page == "current") || ($page == "brewblog") || ($page == "recipe")) { ?>
           	<!-- Sidebar for BrewBlogs and Recipes -->
            <div class="sidebar col col-lg-3 col-md-4 col-sm-12 col-xs-12">
            	<?php // include (SECTIONS.'sidebar.sec.php'); ?>
                <?php include (SECTIONS.'label.inc.php'); ?>
                <?php include (SECTIONS.'scale_recipe.inc.php'); ?>
            </div><!-- ./sidebar -->
            <?php } ?>
            
        </div><!-- ./row -->
    	<!-- ./Public Pages -->
    </div><!-- ./container -->
    
    
    
    <!-- ./Public Pages -->
    <!-- Footer -->
    <footer class="footer hidden-xs hidden-sm hidden-md">
    	<div class="navbar <?php echo $nav_container; ?> navbar-fixed-bottom bcoem-footer">
            <div class="<?php echo $container_main; ?> text-center">
                <p class="navbar-text col-md-12 col-sm-12 col-xs-12 text-muted small"><?php include (INCLUDES.'footer.inc.php'); ?></p>
            </div>
    	</div>
    </footer><!-- ./footer --> 
	<!-- ./ Footer -->
    
</body>
</html>
























