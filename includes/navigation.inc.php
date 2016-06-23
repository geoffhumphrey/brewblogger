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
				 if (($row_pref['home'] != "members") && ($page != "members")) echo "<li><a href=\"index.php?page=members&sort=realLastName&dir=ASC\">".$row_pref['menuMembers']."</a></li>"; elseif (($row_pref['home'] != "members") && ($page == "members")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuMembers']."</a></li>"; else echo ""; 
				 if (($row_pref['home'] != "brewblog-list") && ($page != "brewblog-list")) echo "<li><a href=\"index.php?page=brewblog-list&sort=brewDate&dir=DESC\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewblog-list") && ($page == "brewblog-list")) echo "<li class=\"active\">".$row_pref['menuBrewBlogs']."</li>"; else echo "";
				 }
			if ($row_pref['mode'] == "2") { if (($row_pref['home'] != "recipe-list") && ($page != "recipe-list")) echo "<li><a href=\"index.php?page=recipe-list\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipe-list") && ($page == "recipe-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuRecipes']."</a></li>"; else echo ""; }
			if ($row_pref['mode'] == "1") { if (($row_pref['home'] != "recipe-list") && ($page != "recipe-list")) echo "<li><a href=\"index.php?page=recipe-list\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipe-list") && ($page == "recipe-list")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuRecipes']."</a></li>"; else echo ""; }
			if (($row_pref['mode'] == "2") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awardsList") && ($page != "awardsList")) echo "<li><a href=\"index.php?page=awardsList&sort=awardDate&dir=DESC\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awardsList") && ($page == "awardsList")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuAwards']."</a></li>"; else echo ""; }
			if (($row_pref['mode'] == "1") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awardsList") && ($page != "awardsList")) echo "<li><a href=\"index.php?page=awardsList&sort=awardDate&dir=DESC\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awardsList") && ($page == "awardsList")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuAwards']."</a></li>"; else echo ""; }
			if (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page != "about")) echo "<li><a href=\"index.php?page=about\">".$row_pref['menuAbout']."</a></li>"; elseif (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page == "about")) echo "<li class=\"active\"><a href=\"#\">".$row_pref['menuAbout']."</a></li>"; else echo "";
				
				
				
				
				?>
                
              </ul>
          <ul class="nav navbar-nav navbar-right">
          	<?php if ($help_icon) { ?>
            <li><a href="#" role="button" data-tooltip="true" data-toggle="modal" data-placement="bottom" title="Help" data-target="#helpModal"><span class="fa fa-question-circle"></span></a></li>
            <?php } ?>
          	<?php if ($print_icon) { ?>
          	<li><a href="javascript:window.print()" role="button" data-toggle="tooltip" data-placement="bottom" title="Print"><span class="fa fa-print"></span></a></li>
            <?php } ?>
          	<?php if ($logged_in) { ?>
            <li class="dropdown">
                <a href="#" title="My Account" class="my-dropdown" data-toggle="dropdown" data-placement="bottom"><span class="fa fa-user"></span> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                	<li class="dropdown-header">Logged in as:<br><strong><?php echo $_SESSION['loginUsername']; ?></strong></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $link_list; ?>" tabindex="-1">My Account</a></li>
                    <li><a href="<?php echo $edit_user_info_link; ?>" tabindex="-1">Edit Account</a></li>
                    <li><a href="<?php echo $edit_user_email_link; ?>" tabindex="-1">Change Email</a></li>
                    <li><a href="<?php echo $edit_user_password_link; ?>" tabindex="-1">Change Password</a></li> 
                    <li><a href="<?php echo $link_user_entries; ?>" tabindex="-1">Entries</a></li>
                    <?php if ($add_entry_link_show) { ?>
                    <li><a href="<?php echo $add_entry_link; ?>" tabindex="-1">Add an Entry</a></li>
                    <?php if ((!NHC) && ($_SESSION['prefsHideRecipe'] == "N")) { ?><li tabindex="-1"><a href="<?php echo $add_entry_beerxml_link; ?>">Import an Entry Using BeerXML</a><?php } ?>
                    <?php } ?> 
                    <?php if (!$disable_pay) { ?>
                    <li><a href="<?php echo $link_pay; ?>">Pay Entry Fees</a></li>
                    <?php } ?>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo $base_url; ?>includes/logout.inc.php">Log Out</a></li>
                </ul>
            </li>
            <?php if ($admin_user) { ?>
            <li id="admin-arrow"><a href="<?php if ($go == "error_page") echo $base_url."index.php?section=admin"; else echo "#"; ?>" class="admin-offcanvas" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body" title="<?php echo $admin_tooltip; ?>"><i class="fa fa-chevron-circle-left"></i> Admin</a></li>
            <?php } ?>
            <?php } else { ?>
            <li<?php if ($section == "login") echo $active_class; ?>><a href="<?php echo $link_login; ?>" role="button">Log In</a></li>
            <?php } ?>
            </ul>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </div>





































	