<?php
$help_icon = TRUE;
$print_icon = TRUE;
$logged_in = FALSE;
$admin_user = FALSE;
$link_login = "";
$admin_tooltip = "";
$user_account_link = "#";
$edit_user_prefs_link = "#";
$edit_user_email_link = "#";
$edit_user_password_link = "#";
$admin_dashboard_link = $base_url."index.php?page=admin";

if (($page == "admin") && ($section == "default")) $admin_dashboard_link = "#";

// REVISIT
$edit_user_prefs_link = $base_url."admin/index.php?action=edit&dbTable=brewer&filter=".$loginUsername."&id=".$row_user['id'];
$user_account_link = $base_url."admin/index.php?action=edit&dbTable=users&filter=".$loginUsername."&id=".$row_user['id'];
$edit_user_password_link = $base_url."admin/index.php?action=edit&dbTable=users&section=password&filter=".$loginUsername."&id=".$row_user['id'];


if (isset($_SESSION['loginUsername'])) {
  $logged_in = TRUE;
  if ($_SESSION['userLevel'] <= 1) $admin_user = TRUE;
}
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
				if ($page != $row_pref['home']) echo "<li><a href=\"index.php\">".$row_pref['menuHome']."</a></li>"; elseif ($page == $row_pref['home']) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuHome']."</a></li>"; else echo "";
				if ($row_pref['mode'] == "1") {
				if (($row_pref['home'] != "brewblog-list") && ($page != "brewblog-list")) echo "<li><a href=\"index.php?page=brewblog-list\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewblog-list") && ($page == "brewblog-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuBrewBlogs']."</a></li>"; else echo "";
				}
			if ($row_pref['mode'] == "2") {
				 if (($row_pref['home'] != "members") && ($page != "members")) echo "<li><a href=\"index.php?page=members\">".$row_pref['menuMembers']."</a></li>"; elseif (($row_pref['home'] != "members") && ($page == "members")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuMembers']."</a></li>"; else echo "";
				 if (($row_pref['home'] != "brewblog-list") && ($page != "brewblog-list")) echo "<li><a href=\"index.php?page=brewblog-list\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewblog-list") && ($page == "brewblog-list")) echo "<li class=\"active\">".$row_pref['menuBrewBlogs']."</li>"; else echo "";
				 }
			if ($row_pref['mode'] == "2") { if (($row_pref['home'] != "recipe-list") && ($page != "recipe-list")) echo "<li><a href=\"index.php?page=recipe-list\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipe-list") && ($page == "recipe-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuRecipes']."</a></li>"; else echo ""; }
			if ($row_pref['mode'] == "1") { if (($row_pref['home'] != "recipe-list") && ($page != "recipe-list")) echo "<li><a href=\"index.php?page=recipe-list\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipe-list") && ($page == "recipe-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuRecipes']."</a></li>"; else echo ""; }
			if (($row_pref['mode'] == "2") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awards-list") && ($page != "awards-list")) echo "<li><a href=\"index.php?page=awards-list\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awards-list") && ($page == "awards-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuAwards']."</a></li>"; else echo ""; }
			if (($row_pref['mode'] == "1") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awards-list") && ($page != "awards-list")) echo "<li><a href=\"index.php?page=awards-list\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awards-list") && ($page == "awards-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuAwards']."</a></li>"; else echo ""; }
			if (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page != "about")) echo "<li><a href=\"index.php?page=about\">".$row_pref['menuAbout']."</a></li>"; elseif (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page == "about")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuAbout']."</a></li>"; else echo "";
				?>
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
                    <li><a href="<?php echo $base_url; ?>includes/logout.inc.php">Log Out</a></li>
                </ul>
            </li>
            <?php if ($admin_user) { ?>
            <!-- <li id="admin-arrow"><a href="<?php if ($go == "error_page") echo $base_url."index.php?section=admin"; else echo "#"; ?>" class="admin-offcanvas" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" title="<?php echo $admin_tooltip; ?>"><i class="fa fa-chevron-circle-left"></i> Admin</a></li> -->
            <?php } ?>
            <?php } else { ?>
            <li<?php if ($section == "login") echo $active_class; ?>><a href="<?php echo $link_login; ?>" role="button">Log In</a></li>
            <?php } ?>
            </ul>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </div>



































