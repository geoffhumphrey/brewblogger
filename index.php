<?php

require ('paths.php');

if ((TESTING) || (DEBUG)) {
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $starttime = $mtime;
    $totaltime = "";
}

require (CONFIG.'config.php');
require (ADMIN_INCLUDES.'constants.inc.php');
require (INCLUDES.'authentication_nav.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');
include (INCLUDES.'url_variables.inc.php');
include (INCLUDES.'db_connect_log.inc.php');
include (LIB.'common.lib.php');
require_once (ADMIN_LIBRARY.'color.lib.php');
include (INCLUDES.'version.inc.php');

$imageSrc = "images/";

if ($section == "admin") {
	$container_main = "container-fluid";
	$nav_container = "navbar-inverse";
}

else {
	$container_main = "container";
	$nav_container = "navbar-default";
}

if (($page == "current") || ($page == "brewblog") || ($page == "recipe")) $title .= " [".$row_log['brewStyle']."]";

if (FORCE_UPDATE) include(UPDATE.'update_3.0.0.php');

// Pattern for links
// $page / $section / $action / $dbTable / $filter / $id

// -----------------------------------------------------------------------------------------------
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

	<!-- Load jQuery / http://jquery.com/ -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- Load Bootstrap / http://www.getbootsrap.com -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Load DataTables / https://www.datatables.net -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/1.10.10/integration/font-awesome/dataTables.fontAwesome.css" />
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/sorting/natural.js"></script>

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Load Custom Theme CSS - Contains Bootstrap overrides and custom classes -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/universal_elements.css" />

	<!-- Load Custom JS -->
    <script src="<?php echo $base_url; ?>js_includes/bb_custom.js"></script>

</head>
<body>
    <!-- MAIN NAV -->
	<div class="<?php echo $container_main; ?> hidden-print">
		<?php include (INCLUDES.'navigation.inc.php'); ?>
	</div><!-- container -->
    <!-- ./MAIN NAV -->
    <!-- ALERTS -->
    <div class="<?php echo $container_main; ?>">
    	<?php include (INCLUDES.'alerts.inc.php'); ?>
    </div><!-- ./container -->
    <!-- ./ALERTS -->
    <?php
    if ((isset($_SESSION['loginUsername'])) && (DEBUG_SESSION_VARS)) include (DEBUG_SCRIPTS.'debug_session_vars.inc.php')
    ?>
    <?php if ($page == "admin") { ?>
    <!-- Admin -->
    <div class="container">
        <div class="page-header">
            <h1><?php echo $header_output; ?></h1>
        </div>
    	<?php
            if (isset($_SESSION['loginUsername'])) {

                if (($section == "default") || ($section == "dashboard")) include(ADMIN.'dashboard.admin.php');
                if ($section == "brewblogs") include(ADMIN.'brewblogs.admin.php');
                if ($section == "recipes") include(ADMIN.'recipes.admin.php');
                /*
                // Have not been built yet

                if ($section == "settings") include(ADMIN.'settings.admin.php');
                if ($section == "profiles") include(ADMIN.'profiles.admin.php');
                if ($section == "ingredients") include(ADMIN.'ingredients.admin.php');
                if ($section == "calculators") include(ADMIN.'calculators.admin.php');
                */
            }

            else echo "<p>Please log in to access admin functions.</p>";

		?>
    </div><!-- ./container -->
    <!-- ./Admin -->
    <?php } else { ?>
    <!-- Fixed Layout with Sidebar -->
    <div class="container">
    	<div class="row">
    		<?php if (($page == "current") || ($page == "brewblog") || ($page == "recipe")) { ?>
            <div class="col col-lg-9 col-md-8 col-sm-12 col-xs-12">
            <?php } else { ?>
            <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php } ?>
           	<small>
                <ol class="breadcrumb hidden-print">
                    <?php echo $breadcrumb; ?>
                </ol>
            </small>
            <div class="page-header">
        		<h1><?php echo $header_output; ?></h1>
        	</div>
        	<?php
                if (isset($_POST['amt'])) $amt = $_POST['amt'];
                else $amt = $amt;
				if (($page == "current") || ($page == "brewblog")) {
					if ($_SESSION['allowSpecifics'] == "Y") 		include (SECTIONS.'recipe_specifics.inc.php');
					if ($_SESSION['allowGeneral'] == "Y")			include (SECTIONS.'recipe_general.inc.php');
					if ($_SESSION['allowComments'] == "Y")			include (SECTIONS.'recipe_comments.inc.php');
					if ($_SESSION['allowRecipe'] == "Y")			include (SECTIONS.'recipe.inc.php');
					include (SECTIONS.'recipe_equipment.inc.php');
					if ($_SESSION['allowMash'] == "Y")				include (SECTIONS.'recipe_mash.inc.php');
					if ($_SESSION['allowWater'] == "Y")				include (SECTIONS.'recipe_water.inc.php');
					if ($_SESSION['allowProcedure'] == "Y")			include (SECTIONS.'recipe_procedure.inc.php');
					if ($_SESSION['allowSpecialProcedure'] == "Y")	include (SECTIONS.'recipe_special_procedure.inc.php');
					if ($_SESSION['allowFermentation'] == "Y")		include (SECTIONS.'recipe_fermentation.inc.php');
				  	if ($_SESSION['allowReviews'] == "Y")		  	include (SECTIONS.'recipe_reviews.inc.php');
					include (SECTIONS.'brew_day_data.inc.php');
				}

				elseif ($page == "recipe") {
					if ($_SESSION['allowSpecifics'] == "Y") 		include (SECTIONS.'recipe_specifics.inc.php');
					if ($_SESSION['allowGeneral'] == "Y") 			include (SECTIONS.'recipe_general.inc.php');
					if ($_SESSION['allowRecipe'] == "Y") 			include (SECTIONS.'recipe.inc.php');
					if ($_SESSION['allowProcedure'] == "Y") 		include (SECTIONS.'recipe_procedure.inc.php');
					if ($_SESSION['allowFermentation'] == "Y") 		include (SECTIONS.'recipe_fermentation.inc.php');
					if ($_SESSION['allowComments'] == "Y") 			include (SECTIONS.'recipe_notes.inc.php');
				}

				elseif ($page == "brewblog-list") 					include (SECTIONS.'brewblog_list.inc.php');
				elseif ($page == "recipe-list") 					include (SECTIONS.'recipe_list.inc.php');
				elseif ($page == "awards-list") 					include (SECTIONS.'awards_list.inc.php');
				elseif ($page == "login") 							include (SECTIONS.'login.inc.php');
				// elseif ($page == "tools") 							include (SECTIONS.'tools.inc.php');
				elseif ($page == "about") 							include (SECTIONS.'about.inc.php');
				elseif ($page == "reference") 						include (SECTIONS.'reference.inc.php');
				elseif (($_SESSION['allowCalendar'] == "Y") && ($page == "calendar")) 	include (SECTIONS.'calendar.inc.php');
				elseif (($_SESSION['allowCalendar'] == "N") && ($page == "calendar")) 	echo "<p class=\"error\">This feature has been disabled by the site administrator.</p>";
				elseif (($_SESSION['mode'] == "2") && ($page == "members")) 				include(SECTIONS.'memberList.inc.php');
				elseif (($_SESSION['mode'] == "2") && ($page == "profile")) 				include (SECTIONS.'profile.inc.php');
				elseif (($_SESSION['mode'] == "2") && ($page == "news"))  				include (SECTIONS.'news.inc.php');


			?>
            </div><!-- ./left column -->

            <?php if (($page == "current") || ($page == "brewblog") || ($page == "recipe")) { ?>
           	<!-- Sidebar for BrewBlogs and Recipes -->
            <div class="sidebar col col-lg-3 col-md-4 col-sm-12 col-xs-12">
            <?php
				// include (SECTIONS.'sidebar.sec.php');
				include (SECTIONS.'label.inc.php');
				include (SECTIONS.'scale_recipe.inc.php');
				include (SECTIONS.'awards.inc.php');
				include (SECTIONS.'list.inc.php');
			?>
            </div><!-- ./sidebar -->
            <?php } ?>

        </div><!-- ./row -->

    </div><!-- ./container -->
    <!-- ./Public Pages -->
    <?php } ?>

    <!-- Footer -->
    <footer class="footer hidden-xs hidden-sm hidden-md">
    	<div class="navbar <?php echo $nav_container; ?> navbar-fixed-bottom bb-footer">
            <div class="<?php echo $container_main; ?> text-center">
                <p class="navbar-text col-md-12 col-sm-12 col-xs-12 text-muted small"><?php include (INCLUDES.'footer.inc.php'); ?></p>
            </div>
    	</div>
    </footer>
	<!-- ./ Footer -->

</body>
</html>