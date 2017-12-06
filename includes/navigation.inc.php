<?php
$help_icon = TRUE;
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

?>
<!-- Fixed navbar -->
    <div class="navbar <?php echo $nav_container; ?> navbar-fixed-top">
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
				<?php
				if ($page != $_SESSION['home']) echo "<li><a href=\"".$base_url."\">".$_SESSION['menuHome']."</a></li>";
				elseif ($page == $_SESSION['home']) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuHome']."</a></li>";

				if ($_SESSION['mode'] == "1") {
					if (($_SESSION['home'] != "brewblog-list") && ($page != "brewblog-list")) echo "<li><a href=\"".build_public_url("brewblog-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuBrewBlogs']."</a></li>"; elseif (($_SESSION['home'] != "brewblog-list") && ($page == "brewblog-list")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuBrewBlogs']."</a></li>";
				}

				if ($_SESSION['mode'] == "2") {

					if (($_SESSION['home'] != "members") && ($page != "members")) echo "<li><a href=\"".build_public_url("members", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuMembers']."</a></li>"; elseif (($_SESSION['home'] != "members") && ($page == "members")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuMembers']."</a></li>";
					else echo "";

					if (($_SESSION['home'] != "brewblog-list") && ($page != "brewblog-list")) echo "<li><a href=\"".build_public_url("brewblog-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuBrewBlogs']."</a></li>";
					elseif (($_SESSION['home'] != "brewblog-list") && ($page == "brewblog-list")) echo "<li class=\"active\">".$_SESSION['menuBrewBlogs']."</li>";

					if (($_SESSION['home'] != "recipe-list") && ($page != "recipe-list")) echo "<li><a href=\"".build_public_url("recipe-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuRecipes']."</a></li>";
					elseif (($_SESSION['home'] != "recipe-list") && ($page == "recipe-list")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuRecipes']."</a></li>";
				}

				if ($_SESSION['mode'] == "1") {
					if (($_SESSION['home'] != "recipe-list") && ($page != "recipe-list")) echo "<li><a href=\"".build_public_url("recipe-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuRecipes']."</a></li>";
					elseif (($_SESSION['home'] != "recipe-list") && ($page == "recipe-list")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuRecipes']."</a></li>";
				}

				if ($_SESSION['mode'] == "2") {
					if (($_SESSION['home'] != "awards-list") && ($page != "awards-list")) echo "<li><a href=\"".build_public_url("awards-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAwards']."</a></li>";
					elseif (($_SESSION['home'] != "awards-list") && ($page == "awards-list")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuAwards']."</a></li>";
				}

				if ($_SESSION['mode'] == "1") {
					if (($_SESSION['home'] != "awards-list") && ($page != "awards-list")) echo "<li><a href=\"".build_public_url("awards-list", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAwards']."</a></li>";
					elseif (($_SESSION['home'] != "awards-list") && ($page == "awards-list")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuAwards']."</a></li>";
				}

				if (($_SESSION['mode'] == "1") && ($_SESSION['home'] != "about") && ($page != "about")) echo "<li><a href=\"".build_public_url("about", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuAbout']."</a></li>";
				elseif (($_SESSION['mode'] == "1") && ($_SESSION['home'] != "about") && ($page == "about")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuAbout']."</a></li>";

				if ($_SESSION['allowCalendar'] == "Y") {
					if (($_SESSION['home'] != "calendar") && ($page != "calendar")) echo "<li><a href=\"".build_public_url("calendar", "default", "default", "default", "default", "default", $base_url)."\">".$_SESSION['menuCalendar']."</a></li>";
					elseif (($_SESSION['home'] != "calendar") && ($page == "calendar")) echo "<li class=\"active\"><a href=\"#\">".$_SESSION['menuCalendar']."</a></li>";
				}

        // Reference Links
        if (SEF) $bjcp2008_link = build_public_url("reference", "styles", "view", "current", "bjcp2008", $id, $base_url);
        else $bjcp2008_link = $base_url."index.php?page=reference&amp;section=styles&amp;action=view&amp;filter=bjcp2008";

        if (SEF) $bjcp2015_link = build_public_url("reference", "styles", "view", "current", "bjcp2015", $id, $base_url);
        else $bjcp2015_link = $base_url."index.php?page=reference&amp;section=styles&amp;action=view&amp;filter=bjcp2015";

        if (SEF) $bjcp_all_link = build_public_url("reference", "styles", "view", "current", "all", $id, $base_url);
        else $bjcp_all_link = $base_url."index.php?page=reference&amp;section=styles&amp;action=view&amp;filter=all";

        if (SEF) $carbonation_link = build_public_url("reference", "carbonation", "default", "default", "default", $id, $base_url);
        else $carbonation_link = $base_url."index.php?page=reference&section=carbonation";

        if (SEF) $color_link = build_public_url("reference", "color", "default", "default", "default", $id, $base_url);
        else $color_link = $base_url."index.php?page=reference&section=color";

        if (SEF) $hops_link = build_public_url("reference", "hops", "default", "default", "default", $id, $base_url);
        else $hops_link = $base_url."index.php?page=reference&section=hops";

        if (SEF) $grains_link = build_public_url("reference", "grains", "default", "default", "default", $id, $base_url);
        else $grains_link = $base_url."index.php?page=reference&section=grains";

        if (SEF) $yeast_link = build_public_url("reference", "yeast", "default", "default", "default", $id, $base_url);
        else $yeast_link = $base_url."index.php?page=reference&section=yeast";

				?>
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
            <li><a href="#" role="button" data-tooltip="true" data-toggle="modal" data-placement="left" title="Help" data-target="#helpModal"><span class="fa fa-question-circle"></span></a></li>
            <?php } ?>
          	<?php if ($print_icon) { ?>
          	<li><a href="javascript:window.print()" role="button" data-toggle="tooltip" data-placement="bottom" title="Print"><span class="fa fa-print"></span></a></li>
            <?php } ?>
          	<?php if ($logged_in) { ?>
            <li class="dropdown">
                <a href="#" title="Account" class="my-dropdown" data-toggle="dropdown" data-placement="right"><span class="fa fa-user"></span> <span class="caret"></span></a>
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
            <?php if ($admin_user) { ?>
            <!-- <li id="admin-arrow"><a href="<?php if ($go == "error_page") echo $base_url."index.php?section=admin"; else echo "#"; ?>" class="admin-offcanvas" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" title="<?php echo $admin_tooltip; ?>"><i class="fa fa-chevron-circle-left"></i> Admin</a></li> -->
            <?php } ?>
            <?php } else { ?>
            <li<?php if ($section == "login") echo $active_class; ?>><a href="<?php echo $link_login; ?>" role="button"><?php echo $_SESSION['menuLogin']; ?></a></li>
            <?php } ?>
            </ul>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </div>