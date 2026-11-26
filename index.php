<?php

/**
 * Update: April 18, 2026.
 * 
 * ********* NOT PRODUCTION READY *********
 * 
 * Data from the obsolete brewing DB table is converted into the brewblogs
 * table automatically on the first page load after upgrading, and legacy
 * HTML entities in stored text are decoded - see
 * update/update_3.0.0_data_checks.php.
 *
 * BeerXML import is currently the ONLY way to add new brewblogs into the DB.
 * 
 * Once imported, only "essential info" can be updated - conversion to 
 * Boostrap 5.3 styles is pending for all admin functions including 
 * brewblog import/delete and award add/edit/delete.
 * 
 * Support for manual entry and full edit of any brewblog is 
 * forthcoming. 
 * 
 */

// Pattern for links
// $page / $section / $action / $dbTable / $filter / $id

require ('paths.php');

if ((TESTING) || (DEBUG)) {
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $starttime = $mtime;
    $totaltime = "";
}

require (ADMIN_INCLUDES.'constants.inc.php');
require (INCLUDES.'authentication_nav.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');
include (INCLUDES.'url_variables.inc.php');
include (UPDATE.'update_3.0.0_data_checks.php');
if ($confirm == "new") include (INCLUDES.'db_connect_log_new.inc.php');
else include (INCLUDES.'db_connect_log.inc.php');
include (LIB.'common.lib.php');
include (ADMIN_LIBRARY.'color.lib.php');
include (INCLUDES.'version.inc.php');
if (FORCE_UPDATE) include(UPDATE.'update_3.0.0.php');

$scale = "";
$referrer = "";

if (isset($_SERVER['HTTP_REFERER'])) $referrer = urldecode($_SERVER['HTTP_REFERER']);

if (isset($_POST['amt'])) $amt = $_POST['amt'];
else $amt = $amt;

if (is_numeric($amt)) $scale = $amt / $row_log['brewBatchSize'];

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <!-- Load jQuery / http://jquery.com/ -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Load Fancybox / http://www.fancyapps.com -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

        <!-- Load Ninja Bootstrap (REPLACES and EXTENDS Bootstrap's CSS) / https://bootstrap.ninja/ninjabootstrap/ -->
        <link href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Load Tom Select / https://github.com/orchidjs/tom-select / https://tom-select.js.org/ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

        <!-- Load DataTables / https://www.datatables.net -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.7/css/dataTables.bootstrap5.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/2.3.7/js/dataTables.bootstrap5.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.12/integration/font-awesome/dataTables.fontAwesome.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<?php if ($page == "admin") { ?>

        <!-- Load Bootstrap DateTime Picker / http://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.1/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

        <!-- Load TinyMCE / https://www.tinymce.com/ -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>
        <script src="<?php echo $base_url;?>js_includes/tinymce-init.js"></script>
        <!-- Load Bootstrap Form Validator / http://1000hz.github.io/bootstrap-validator -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.9.0/validator.min.js"></script>

        <!-- Load Bootstrap-Select / http://silviomoreto.github.io/bootstrap-select -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>

<?php } ?>

        <!-- Load Font Awesome / https://fortawesome.github.io/Font-Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
        <script type="text/javascript">
            window.FontAwesomeConfig = { autoReplaceSvg: false }
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v4-shims.min.css" />

        <!-- Load Custom Theme CSS - Contains Bootstrap overrides and custom classes -->
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/bruxellensis.css" /> -->
        <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/universal_elements.css" />

        <!-- Load Custom JS -->
        <script src="<?php echo $base_url; ?>js_includes/bb_custom.js"></script>

        <script>
            // Invoke TomSelect for some select form elements
            document.querySelectorAll('.bootstrap-select-new').forEach((el) => {
                let settings = {
                    maxOptions: 100,
                    allowEmptyOption: false
                };
                new TomSelect(el, settings);
            });

            new TomSelect('.bootstrap-select',{
                plugins: ['dropdown_input'],
            });
        </script>

        <style>
            body {
                /* padding-bottom: 80px; */
            }

            a,
            a:hover,
            a:focus,
            a:active,
            a:visited {
              text-decoration: none;
            }

            h1 {
                font-weight: 800;
            }

            h2 {
                font-weight: 700;
            }

            h3 {
                padding: .8em 0 .8em 0;
                font-weight: 600;
            }

            h4 {
                padding: .8em 0 .8em 0;
                font-weight: 400;
            }
        </style>

    </head>

<body>

    <!-- MAIN NAV -->
    <div class="container-xxl d-print-none m-0 bg-black">
        <?php include (SECTIONS.'nav.sec.php'); ?>
    </div>

    <!-- ALERTS -->
    <div class="container-xxl d-print-none" style="margin-top: 50px;">
        <?php include (SECTIONS.'alerts_new.inc.php'); ?>
    </div>

    <?php // if ((isset($_SESSION['loginUsername'])) && (DEBUG_SESSION_VARS)) include (DEBUG_SCRIPTS.'debug_session_vars.inc.php'); ?>

    <!-- PAGE TITLE -->
    <div class="container-fluid bg-black m-0 pt-3">
        <div class="container-xxl pt-3 pb-3">
            <h1 class="text-light"><?php echo $header_output; ?></h1>
        </div>
    </div>
 
    <?php

    // Each needs their own container class

    if (($page == "current") || ($page == "brewblog")) include (SECTIONS.'brewblog.inc.php');  
    elseif ($page == "brewblog-list") include (SECTIONS.'brewblog_list_new.inc.php'); 
    elseif ($page == "awards-list") include (SECTIONS.'awards_list_new.inc.php');
    elseif ($page == "login") include (SECTIONS.'login_new.inc.php');
    elseif ($page == "reference") include (SECTIONS.'reference.inc.php');
    elseif ($page == "admin") {

        if (isset($_SESSION['loginUsername'])) {
            if (($section == "default") || ($section == "dashboard")) include (ADMIN.'dashboard.admin.php');
            if ($section == "brewblogs") include (ADMIN.'brewblogs_new.admin.php');
            if ($section == "awards") include (ADMIN.'awards_new.admin.php');
        }

        else echo "<p>Please log in to access admin functions.</p>";

    }

    /*

    elseif ($page == "recipe") {
        if ($_SESSION['allowSpecifics'] == "Y")         include (SECTIONS.'recipe_specifics.inc.php');
        if ($_SESSION['allowGeneral'] == "Y")           include (SECTIONS.'recipe_general.inc.php');
        if ($_SESSION['allowRecipe'] == "Y")            include (SECTIONS.'recipe.inc.php');
        if ($_SESSION['allowProcedure'] == "Y")         include (SECTIONS.'recipe_procedure.inc.php');
        if ($_SESSION['allowFermentation'] == "Y")      include (SECTIONS.'recipe_fermentation.inc.php');
        if ($_SESSION['allowComments'] == "Y")          include (SECTIONS.'recipe_notes.inc.php');
    }

    elseif ($page == "about")                           include (SECTIONS.'about.inc.php');
    elseif ($page == "recipe-list")                     include (SECTIONS.'recipe_list.inc.php');
    elseif ($page == "tools")                           include (SECTIONS.'tools.inc.php');
    
    elseif (($_SESSION['allowCalendar'] == "Y") && ($page == "calendar"))   include (SECTIONS.'calendar.inc.php');
    elseif (($_SESSION['allowCalendar'] == "N") && ($page == "calendar"))   echo "<p class=\"error\">This feature has been disabled by the site administrator.</p>";
    elseif (($_SESSION['mode'] == "2") && ($page == "members"))             include(SECTIONS.'memberList.inc.php');
    elseif (($_SESSION['mode'] == "2") && ($page == "profile"))             include (SECTIONS.'profile.inc.php');
    elseif (($_SESSION['mode'] == "2") && ($page == "news"))                include (SECTIONS.'news.inc.php');
    
    */

    ?>

    <!-- Footer -->
    <footer class="site-footer bg-dark text-light justify-content-center sticky-bottom container-fluid pt-3 pb-1 d-print-none">
         <p class="text-center" style="font-size: .8em;"><?php include (INCLUDES.'footer.inc.php'); ?></p>
    </footer>
    <!-- ./ Footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

</body>
</html>