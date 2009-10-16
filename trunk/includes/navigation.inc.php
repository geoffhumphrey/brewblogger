<?php include ('admin/includes/menu.inc.php'); ?>
	<ul id="navlist">
	<?php
	if ($page != $row_pref['home']) echo "<li><a href=\"index.php\">".$row_pref['menuHome']."</a></li>"; elseif ($page == $row_pref['home']) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuHome']."</strong></span></li>"; else echo "";
	if ($row_pref['mode'] == "1") {
		if (($row_pref['home'] != "brewBlogList") && ($page != "brewBlogList")) echo "<li><a href=\"index.php?page=brewBlogList\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewBlogList") && ($page == "brewBlogList")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuBrewBlogs']."</strong></span></li>"; else echo "";
		}
	if ($row_pref['mode'] == "2") {
	   	 if (($row_pref['home'] != "members") && ($page != "members")) echo "<li><a href=\"index.php?page=members&sort=realLastName&dir=ASC\">".$row_pref['menuMembers']."</a></li>"; elseif (($row_pref['home'] != "members") && ($page == "members")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuMembers']."</strong></span></li>"; else echo ""; 
		 if (($row_pref['home'] != "brewBlogList") && ($page != "brewBlogList")) echo "<li><a href=\"index.php?page=brewBlogList&sort=brewDate&dir=DESC\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewBlogList") && ($page == "brewBlogList")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuBrewBlogs']."</strong></span></li>"; else echo "";
		 }
	if ($row_pref['mode'] == "2") { if (($row_pref['home'] != "recipeList") && ($page != "recipeList")) echo "<li><a href=\"index.php?page=recipeList\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipeList") && ($page == "recipeList")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuRecipes']."</strong></span></li>"; else echo ""; }
	if ($row_pref['mode'] == "1") { if (($row_pref['home'] != "recipeList") && ($page != "recipeList")) echo "<li><a href=\"index.php?page=recipeList\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipeList") && ($page == "recipeList")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuRecipes']."</strong></span></li>"; else echo ""; }
	if (($row_pref['mode'] == "2") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awardsList") && ($page != "awardsList")) echo "<li><a href=\"index.php?page=awardsList&sort=awardDate&dir=DESC\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awardsList") && ($page == "awardsList")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuAwards']."</strong></span></li>"; else echo ""; }
	if (($row_pref['mode'] == "1") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awardsList") && ($page != "awardsList")) echo "<li><a href=\"index.php?page=awardsList&sort=awardDate&dir=DESC\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awardsList") && ($page == "awardsList")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuAwards']."</strong></span></li>"; else echo ""; }
	if (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page != "about")) echo "<li><a href=\"index.php?page=about\">".$row_pref['menuAbout']."</a></li>"; elseif (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page == "about")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuAbout']."</strong></span></li>"; else echo "";
	?>
	<?php if (($row_pref['home'] != "reference") && ($page != "reference")) { ?><li><a href="index.php?page=reference"  onMouseover="dropdownmenu(this, event, menu15, '150px')" onMouseout="delayhidemenu()"><?php echo $row_pref['menuReference']; ?></a></li><?php } ?>
	<?php if (($row_pref['home'] != "reference") && ($page == "reference")) echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuReference']."</strong></span></li>"; ?>
	<?php if (($row_pref['home'] != "tools") && ($page != "tools")) { ?><li><a href="index.php?page=tools"  onMouseover="dropdownmenu(this, event, menu16, '225px')" onMouseout="delayhidemenu()"><?php echo $row_pref['menuCalculators']; ?></a></li><?php } ?>
	<?php if (($row_pref['home'] != "tools") && ($page == "tools"))  echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuCalculators']."</strong></li></span>"; ?>
    <?php if ($row_pref['allowCalendar'] == "Y") { 
	if (($row_pref['home'] != "calendar") && ($page != "calendar")) { ?><li><a href="index.php?page=calendar"><?php echo $row_pref['menuCalendar']; ?></a></li><?php } ?>
    <?php if (($row_pref['home'] != "calendar") && ($page == "calendar"))  echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuCalendar']."</strong></span></li>"; 
	} 
	?>
    <?php if (($row_pref['home'] != "about") && ($row_pref['mode'] == "2")) { 
	if ($page != "about") { ?><li><a href="index.php?page=about"><?php echo $row_pref['menuAbout']; ?></a></li><?php } ?>
    <?php if ($page == "about")  echo "<li><span class=\"ultra_lt\"><strong>".$row_pref['menuAbout']."</strong></span></li>"; 
	} 
	?>
	<?php sessionAuthenticateNav(); ?>
    </ul>

