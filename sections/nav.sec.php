<?php
$help_icon = FALSE;
$print_icon = TRUE;
$logged_in = FALSE;
$admin_user = FALSE;
$link_login = $base_url."index.php?page=login";
$admin_tooltip = "";
$user_account_link = "#";
$edit_user_prefs_link = "#";
$edit_user_email_link = "#"; 
$edit_user_password_link = "#";

if (SEF) $admin_dashboard_link = build_public_url("admin", "default", "default", "default", "default", "default", $base_url);
else $admin_dashboard_link = $base_url."index.php?page=admin";
if (($page == "admin") && ($section == "default")) $admin_dashboard_link = "#";

if (SEF) $manage_brewblogs_link = build_public_url("admin", "brewblogs", "manage", "brewblogs", "all", "new", $base_url);
else $manage_brewblogs_link = $base_url."index.php?page=admin&amp;section=brewblogs&action=manage&amp;dbTable=brewblogs&amp;filter=all";

// REVISIT
if (isset($_SESSION['uid'])) {
  $edit_user_prefs_link = $base_url."admin/index.php?action=edit&dbTable=brewer&filter=".$loginUsername."&id=".$row_user['id'];
  $user_account_link = $base_url."admin/index.php?action=edit&dbTable=users&filter=".$loginUsername."&id=".$row_user['id'];
  $edit_user_password_link = $base_url."admin/index.php?action=edit&dbTable=users&section=password&filter=".$loginUsername."&id=".$row_user['id'];
}

if (isset($_SESSION['loginUsername'])) {
  $logged_in = TRUE;
  if ($_SESSION['userLevel'] <= 1) $admin_user = TRUE;
}

//build_public_url($page, $section, $action, $dbTable, $filter, $id, $base_url)

$nav_elements = "";

if ($page != $_SESSION['home']) $nav_link_home = $base_url;
elseif ($page == $_SESSION['home']) $nav_link_home = "#";

$nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".$nav_link_home."\">".$_SESSION['menuHome']."</a></li>";

if ($_SESSION['mode'] == "1") {
  if (($_SESSION['home'] != "brewblog-list") && ($page != "brewblog-list")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("brewblog-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuBrewBlogs']."</a></li>"; elseif (($_SESSION['home'] != "brewblog-list") && ($page == "brewblog-list")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuBrewBlogs']."</a></li>";
}

if ($_SESSION['mode'] == "2") {
  if (($_SESSION['home'] != "members") && ($page != "members")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("members", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuMembers']."</a></li>"; elseif (($_SESSION['home'] != "members") && ($page == "members")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuMembers']."</a></li>";
  else $nav_elements .= "";

  if (($_SESSION['home'] != "brewblog-list") && ($page != "brewblog-list")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("brewblog-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuBrewBlogs']."</a></li>";
  elseif (($_SESSION['home'] != "brewblog-list") && ($page == "brewblog-list")) $nav_elements .= "<li class=\"nav-item active\">".$_SESSION['menuBrewBlogs']."</li>";

  if (($_SESSION['home'] != "recipe-list") && ($page != "recipe-list")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("recipe-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuRecipes']."</a></li>";
  elseif (($_SESSION['home'] != "recipe-list") && ($page == "recipe-list")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuRecipes']."</a></li>";
}

/*
if ($_SESSION['mode'] == "1") {
  if (($_SESSION['home'] != "recipe-list") && ($page != "recipe-list")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("recipe-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuRecipes']."</a></li>";
  elseif (($_SESSION['home'] != "recipe-list") && ($page == "recipe-list")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuRecipes']."</a></li>";
}
*/


if ($_SESSION['mode'] == "2") {
  if (($_SESSION['home'] != "awards-list") && ($page != "awards-list")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("awards-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAwards']."</a></li>";
  elseif (($_SESSION['home'] != "awards-list") && ($page == "awards-list")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuAwards']."</a></li>";
}

if ($_SESSION['mode'] == "1") {
  if (($_SESSION['home'] != "awards-list") && ($page != "awards-list")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("awards-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAwards']."</a></li>";
  elseif (($_SESSION['home'] != "awards-list") && ($page == "awards-list")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuAwards']."</a></li>";
}


/*
if (($_SESSION['mode'] == "1") && ($_SESSION['home'] != "about") && ($page != "about")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("about", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAbout']."</a></li>";
elseif (($_SESSION['mode'] == "1") && ($_SESSION['home'] != "about") && ($page == "about")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuAbout']."</a></li>";

if ($_SESSION['allowCalendar'] == "Y") {
  if (($_SESSION['home'] != "calendar") && ($page != "calendar")) $nav_elements .= "<li class=\"nav-item\"><a class=\"nav-link\" href=\"".build_public_url("calendar", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuCalendar']."</a></li>";
  elseif (($_SESSION['home'] != "calendar") && ($page == "calendar")) $nav_elements .= "<li class=\"nav-item active\"><a class=\"nav-link active\" href=\"#\">".$_SESSION['menuCalendar']."</a></li>";
}
*/

// Reference Links
// $bjcp2008_link = build_public_url("reference", "styles", "view", "current", "bjcp2008", $id, $base_url);
// $bjcp2015_link = build_public_url("reference", "styles", "view", "current", "bjcp2015", $id, $base_url);
// $bjcp_all_link = build_public_url("reference", "styles", "view", "current", "all", $id, $base_url);
$carbonation_link = build_public_url("reference", "carbonation", "default", "default", "default", $id, $base_url);
$color_link = build_public_url("reference", "color", "default", "default", "default", $id, $base_url);
$hops_link = build_public_url("reference", "hops", "default", "default", "default", $id, $base_url);
$grains_link = build_public_url("reference", "grains", "default", "default", "default", $id, $base_url);
$yeast_link = build_public_url("reference", "yeast", "default", "default", "default", $id, $base_url);
?>



<nav class="navbar bg-dark border-bottom border-body fixed-top navbar-expand-md mb-5 d-print-none" data-bs-theme="dark">

    <div class="container-xxl">
        <a class="navbar-brand" href="#"><i class="fas fa-beer"></i></a>
        <button type="button" class="navbar-toggler" aria-controls="#nav-toggler" aria-label="Toggle Navigation" data-bs-toggle="collapse" data-bs-target="#nav-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav-toggler">         
            <ul class="navbar-nav">
                <?php echo $nav_elements; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Reference</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo $carbonation_link; ?>">Carbonation Chart</a></li>
                        <li><a class="dropdown-item" href="<?php echo $color_link; ?>">Color Chart</a></li>
                        <!--
                        <li><a class="dropdown-item" href="<?php echo $hops_link; ?>">Hops</a></li>
                        <li><a class="dropdown-item" href="<?php echo $grains_link; ?>">Malts and Grains</a></li>
                        <li><a class="dropdown-item" href="<?php echo $yeast_link; ?>">Yeast</a></li>
                        -->
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">

                <?php if ($print_icon) { ?>
                <li class="nav-item"><a class="nav-link" href="javascript:window.print()" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print page"><i class="fa fa-print"></i></a></li>
                <?php } ?>

                <?php if ($logged_in) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="fa fa-user"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Logged in as:<br><strong><?php echo $_SESSION['loginUsername']; ?></strong></li>
                        <li role="separator" class="divider"></li>
                        <li><a class="dropdown-item" href="<?php echo $admin_dashboard_link; ?>">Admin Dashboard</a></li>
                        <li><a class="dropdown-item" href="<?php echo $manage_brewblogs_link; ?>" tabindex="-1">Manage BrewBlogs</a></li>
                        <!--
                        <li><a class="dropdown-item" href="<?php echo $user_account_link; ?>" tabindex="-1">Edit Account</a></li>
                        <li><a class="dropdown-item" href="<?php echo $edit_user_prefs_link; ?>" tabindex="-1">Edit Personal Preferences</a></li>
                        <li><a class="dropdown-item" href="<?php echo $edit_user_email_link; ?>" tabindex="-1">Change Email</a></li>
                        <li><a class="dropdown-item" href="<?php echo $edit_user_password_link; ?>" tabindex="-1">Change Password</a></li>
                        -->
                        <li role="separator" class="divider"></li>
                        <li><a class="dropdown-item" href="<?php echo $base_url; ?>includes/logout.inc.php"><?php echo $_SESSION['menuLogout']; ?></a></li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo $link_login; ?>"><?php echo $_SESSION['menuLogin']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

    

</nav>
        
    
<?php if (($page == "current") || ($page == "brewblog")) { ?>
<div style="right: 15px; top: 80px; position: fixed; z-index: 1000;" class="d-none d-md-block">
    <a data-bs-toggle="offcanvas" href="#more-brewblogs" role="button" aria-controls="more-brewblogs" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="View the Latest BrewBlogs List">
        <span class="fa-stack fa-2x ms-1">
            <i class="fa-solid fa-circle fa-stack-2x text-primary"></i>
            <i class="fa-solid fa-list fa-stack-1x text-white"></i>
        </span>
    </a>
</div>
<div style="right: 0; top: 62px; position: fixed; z-index: 1000;" class="d-xs-block d-md-none">
    <a data-bs-toggle="offcanvas" href="#more-brewblogs" role="button" aria-controls="more-brewblogs" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="View the Latest BrewBlogs List">
        <span class="fa-stack">
            <i class="fa-solid fa-circle fa-stack-2x text-primary"></i>
            <i class="fa-solid fa-list fa-stack-1x text-white"></i>
        </span>
    </a>
</div>
<?php } ?>