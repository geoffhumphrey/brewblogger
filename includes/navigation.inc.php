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
$admin_dashboard_link = $base_url."index.php?page=admin";

if (($page == "admin") && ($section == "default")) $admin_dashboard_link = "#";

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

$nav_elements .= "<li><a href=\"".$nav_link_home."\">".$_SESSION['menuHome']."</a></li>";

if ($_SESSION['mode'] == "1") {
  if (($_SESSION['home'] != "brewblog-list") && ($page != "brewblog-list")) $nav_elements .= "<li><a href=\"".build_public_url("brewblog-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuBrewBlogs']."</a></li>"; elseif (($_SESSION['home'] != "brewblog-list") && ($page == "brewblog-list")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuBrewBlogs']."</a></li>";
}

if ($_SESSION['mode'] == "2") {

  if (($_SESSION['home'] != "members") && ($page != "members")) $nav_elements .= "<li><a href=\"".build_public_url("members", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuMembers']."</a></li>"; elseif (($_SESSION['home'] != "members") && ($page == "members")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuMembers']."</a></li>";
  else $nav_elements .= "";

  if (($_SESSION['home'] != "brewblog-list") && ($page != "brewblog-list")) $nav_elements .= "<li><a href=\"".build_public_url("brewblog-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuBrewBlogs']."</a></li>";
  elseif (($_SESSION['home'] != "brewblog-list") && ($page == "brewblog-list")) $nav_elements .= "<li class=\"active\">".$_SESSION['menuBrewBlogs']."</li>";

  if (($_SESSION['home'] != "recipe-list") && ($page != "recipe-list")) $nav_elements .= "<li><a href=\"".build_public_url("recipe-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuRecipes']."</a></li>";
  elseif (($_SESSION['home'] != "recipe-list") && ($page == "recipe-list")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuRecipes']."</a></li>";
}

if ($_SESSION['mode'] == "1") {
  if (($_SESSION['home'] != "recipe-list") && ($page != "recipe-list")) $nav_elements .= "<li><a href=\"".build_public_url("recipe-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuRecipes']."</a></li>";
  elseif (($_SESSION['home'] != "recipe-list") && ($page == "recipe-list")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuRecipes']."</a></li>";
}

if ($_SESSION['mode'] == "2") {
  if (($_SESSION['home'] != "awards-list") && ($page != "awards-list")) $nav_elements .= "<li><a href=\"".build_public_url("awards-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAwards']."</a></li>";
  elseif (($_SESSION['home'] != "awards-list") && ($page == "awards-list")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuAwards']."</a></li>";
}

if ($_SESSION['mode'] == "1") {
  if (($_SESSION['home'] != "awards-list") && ($page != "awards-list")) $nav_elements .= "<li><a href=\"".build_public_url("awards-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAwards']."</a></li>";
  elseif (($_SESSION['home'] != "awards-list") && ($page == "awards-list")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuAwards']."</a></li>";
}

if (($_SESSION['mode'] == "1") && ($_SESSION['home'] != "about") && ($page != "about")) $nav_elements .= "<li><a href=\"".build_public_url("about", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAbout']."</a></li>";
elseif (($_SESSION['mode'] == "1") && ($_SESSION['home'] != "about") && ($page == "about")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuAbout']."</a></li>";

if ($_SESSION['allowCalendar'] == "Y") {
  if (($_SESSION['home'] != "calendar") && ($page != "calendar")) $nav_elements .= "<li><a href=\"".build_public_url("calendar", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuCalendar']."</a></li>";
  elseif (($_SESSION['home'] != "calendar") && ($page == "calendar")) $nav_elements .= "<li class=\"active\"><a href=\"#\">".$_SESSION['menuCalendar']."</a></li>";
}

// Reference Links
$bjcp2008_link = build_public_url("reference", "styles", "view", "current", "bjcp2008", $id, $base_url);
$bjcp2015_link = build_public_url("reference", "styles", "view", "current", "bjcp2015", $id, $base_url);
$bjcp_all_link = build_public_url("reference", "styles", "view", "current", "all", $id, $base_url);
$carbonation_link = build_public_url("reference", "carbonation", "default", "default", "default", $id, $base_url);
$color_link = build_public_url("reference", "color", "default", "default", "default", $id, $base_url);
$hops_link = build_public_url("reference", "hops", "default", "default", "default", $id, $base_url);
$grains_link = build_public_url("reference", "grains", "default", "default", "default", $id, $base_url);
$yeast_link = build_public_url("reference", "yeast", "default", "default", "default", $id, $base_url);
?>
<!-- Fixed navbar -->
    <div class="navbar <?php echo $nav_container; ?> navbar-fixed-top">
      <div class="<?php echo $container_main; ?> hidden-xs hidden-sm">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo $nav_link_home; ?>"><strong><span class="fa fa-beer"></span> <?php echo $row_name['brewerLogName']; ?></strong> <small><?php echo $row_name['brewerTagline']; ?></small></a>
        </div>
      </div>
      <div class="<?php echo $container_main; ?>">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bcoem-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="bcoem-navbar-collapse">
              <ul class="nav navbar-nav">
                <?php echo $nav_elements; ?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">Reference <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $bjcp2008_link; ?>">BJCP 2008 Styles Only</a></li>
                            <li><a href="<?php echo $bjcp2015_link; ?>">BJCP 2015 Styles Only</a></li>
                            <li><a href="<?php echo $bjcp_all_link; ?>">BJCP 2008 and 2015 Styles</a></li>
                            <li><a href="<?php echo $carbonation_link; ?>">Carbonation Chart</a></li>
                            <li><a href="<?php echo $color_link; ?>">Color Chart</a></li>
                            <li><a href="<?php echo $hops_link; ?>">Hops</a></li>
                            <li><a href="<?php echo $grains_link; ?>">Malts and Grains</a></li>
                            <li><a href="<?php echo $yeast_link; ?>">Yeast</a></li>
                        </ul>
                    </li>
              </ul>
          <ul class="nav navbar-nav navbar-right">
          	<?php if ($help_icon) { ?>
            <li><a href="#" role="button" data-tooltip="true" data-toggle="modal" data-placement="bottom" title="Help" data-target="#helpModal"><span class="fa fa-question-circle"></span></a></li>
            <?php } ?>
          	<?php if ($print_icon) { ?>
          	<li><a href="javascript:window.print()" role="button" data-toggle="tooltip" data-placement="bottom" title="Print page"><span class="fa fa-print"></span></a></li>
            <?php } ?>
          	<?php if ($logged_in) { ?>
            <li class="dropdown">
                <a href="#" title="My account" class="my-dropdown" data-toggle="dropdown" data-placement="bottom"><span class="fa fa-user"></span> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                	<li class="dropdown-header">Logged in as:<br><strong><?php echo $_SESSION['loginUsername']; ?></strong></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $admin_dashboard_link; ?>">Admin Dashboard</a></li>
                    <li><a href="<?php echo $user_account_link; ?>" tabindex="-1">Edit Account</a></li>
                    <li><a href="<?php echo $edit_user_prefs_link; ?>" tabindex="-1">Edit Personal Preferences</a></li>
                    <!-- <li><a href="<?php echo $edit_user_email_link; ?>" tabindex="-1">Change Email</a></li> -->
                    <li><a href="<?php echo $edit_user_password_link; ?>" tabindex="-1">Change Password</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $base_url; ?>includes/logout.inc.php"><?php echo $_SESSION['menuLogout']; ?></a></li>
                </ul>
            </li>
            <?php } else { ?>
            <li<?php if ($section == "login") echo $active_class; ?>><a href="<?php echo $link_login; ?>" role="button"><?php echo $_SESSION['menuLogin']; ?></a></li>
            <?php } ?>
            </ul>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </div>