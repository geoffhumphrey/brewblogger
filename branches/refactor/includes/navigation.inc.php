	<ul id="navlist">
	<?php
	if ($page != $row_pref['home']) echo "<li><a href=\"index.php\">".$row_pref['menuHome']."</a></li>"; elseif ($page == $row_pref['home']) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuHome']."</span></strong></li>"; else echo "";
	if ($row_pref['mode'] == "1") {
		if (($row_pref['home'] != "brewBlogList") && ($page != "brewBlogList")) echo "<li><a href=\"index.php?page=brewBlogList\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewBlogList") && ($page == "brewBlogList")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuBrewBlogs']."</span></strong></li>"; else echo "";
		}
	if ($row_pref['mode'] == "2") {
	   	 if (($row_pref['home'] != "members") && ($page != "members")) echo "<li><a href=\"index.php?page=members&sort=realLastName&dir=ASC\">".$row_pref['menuMembers']."</a></li>"; elseif (($row_pref['home'] != "members") && ($page == "members")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuMembers']."</span></strong></li>"; else echo ""; 
		 if (($row_pref['home'] != "brewBlogList") && ($page != "brewBlogList")) echo "<li><a href=\"index.php?page=brewBlogList&sort=brewDate&dir=DESC\">".$row_pref['menuBrewBlogs']."</a></li>"; elseif (($row_pref['home'] != "brewBlogList") && ($page == "brewBlogList")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuBrewBlogs']."</span></strong></li>"; else echo "";
		 }
	if ($row_pref['mode'] == "2") { if (($row_pref['home'] != "recipeList") && ($page != "recipeList")) echo "<li><a href=\"index.php?page=recipeList\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipeList") && ($page == "recipeList")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuRecipes']."</span></strong></li>"; else echo ""; }
	if ($row_pref['mode'] == "1") { if (($row_pref['home'] != "recipeList") && ($page != "recipeList")) echo "<li><a href=\"index.php?page=recipeList\">".$row_pref['menuRecipes']."</a></li>"; elseif (($row_pref['home'] != "recipeList") && ($page == "recipeList")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuRecipes']."</span></strong></li>"; else echo ""; }
	if (($row_pref['mode'] == "2") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awardsList") && ($page != "awardsList")) echo "<li><a href=\"index.php?page=awardsList&sort=awardDate&dir=DESC\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awardsList") && ($page == "awardsList")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuAwards']."</span></strong></li>"; else echo ""; }
	if (($row_pref['mode'] == "1") && ($totalRows_awardGen > 0)) { if (($row_pref['home'] != "awardsList") && ($page != "awardsList")) echo "<li><a href=\"index.php?page=awardsList&sort=awardDate&dir=DESC\">".$row_pref['menuAwards']."</a></li>"; elseif (($row_pref['home'] != "awardsList") && ($page == "awardsList")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuAwards']."</span></strong></li>"; else echo ""; }
	if (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page != "about")) echo "<li><a href=\"index.php?page=about\">".$row_pref['menuAbout']."</a></li>"; elseif (($row_pref['mode'] == "1") && ($row_pref['home'] != "about") && ($page == "about")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuAbout']."</span></strong></li>"; else echo "";
	?>
	<?php if (($row_pref['home'] != "reference") && ($page != "reference")) { ?><li><div class="menuBar"><a class="menuButton" href="index.php?page=reference" onclick="index.php?page=reference" onmouseover="buttonMouseover(event, 'publicMenu0');"><?php echo $row_pref['menuReference']; ?></a></div></li><?php } ?>
	<?php if (($row_pref['home'] != "reference") && ($page == "reference")) echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuReference']."</span></strong></li>"; ?>
	<?php if (($row_pref['home'] != "tools") && ($page != "tools")) { ?><li><div class="menuBar"><a class="menuButton" href="index.php?page=tools" onclick="index.php?page=tools" onmouseover="buttonMouseover(event, 'publicMenu1');"><?php echo $row_pref['menuCalculators']; ?></a></div></li><?php } ?>
	<?php if (($row_pref['home'] != "tools") && ($page == "tools"))  echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuCalculators']."</li></span></strong>"; ?>
    <?php if ($row_pref['allowCalendar'] == "Y") { 
	if (($row_pref['home'] != "calendar") && ($page != "calendar")) { ?><li><a href="index.php?page=calendar"><?php echo $row_pref['menuCalendar']; ?></a></li><?php } ?>
    <?php if (($row_pref['home'] != "calendar") && ($page == "calendar"))  echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuCalendar']."</span></strong></li>"; 
	} 
	?>
    <?php if (($row_pref['home'] != "about") && ($row_pref['mode'] == "2")) { 
	if ($page != "about") { ?><li><a href="index.php?page=about"><?php echo $row_pref['menuAbout']; ?></a></li><?php } ?>
    <?php if ($page == "about")  echo "<li><strong><span class=\"ultra_lt\">".$row_pref['menuAbout']."</span></strong></li>"; 
	} 
	?>
	<?php sessionAuthenticateNav(); ?>
    </ul>

<div id="publicMenu0" class="menu">
	<a class="menuItem" href="index.php?page=reference&section=styles">BJCP Style Information</a>
	<a class="menuItem" href="index.php?page=reference&section=carbonation">Carbonation Chart</a>
	<a class="menuItem" href="index.php?page=reference&section=color">Color Chart</a>
	<a class="menuItem" href="index.php?page=reference&section=hops">Hops</a>
	<a class="menuItem" href="index.php?page=reference&section=grains">Malts and Grains</a>
	<a class="menuItem" href="index.php?page=reference&section=yeast">Yeast</a>
</div>
<div id="publicMenu1" class="menu">
	<a class="menuItem" href="index.php?page=tools&section=bitterness">Bitterness Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=efficiency">Efficiency Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=calories">Calories, Alcohol, and Plato Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=force_carb">Force Carbonation Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=hyd">Hydrometer Correction Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=plato">Plato/Brix/SG Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=sugar">Priming Sugar Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=strike">Strike Water Calculator</a>
	<a class="menuItem" href="index.php?page=tools&section=water">Water Amounts Calculator</a>
</div>
<?php if (isset($_SESSION["loginUsername"])) { 
if ($row_user['userLevel'] == "1") { ?>
<div id="publicMenu2" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.1');"><span class="menuItemText">Manage</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2');"><span class="menuItemText">Add</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.3');"><span class="menuItemText">Edit</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.4');"><span class="menuItemText">Import BeerXML</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.5');"><span class="menuItemText">Tools</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="publicMenu2.1" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=brewing"><?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=recipes"><?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=awards"><?php echo $row_pref['menuAwards']; ?></a>
	<?php if ($row_pref['mode'] == "2") echo "<a class=\"menuItem\" href=\"admin/index.php?action=list&dbTable=upcoming\">All Upcoming ".$row_pref['menuBrewBlogs']."</a>"; else echo "<a class=\"menuItem\" href=\"admin/index.php?action=list&dbTable=upcoming\">Upcoming ".$row_pref['menuBrewBlogs']."</a>"; ?>
	<?php if ($row_pref['mode'] == "2") echo "<a class=\"menuItem\" href=\"admin/index.php?action=list&dbTable=upcoming&filter=".$loginUsername."\">My Upcoming ".$row_pref['menuBrewBlogs']."</a>"; ?>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.1.1');"><span class="menuItemText">Reference</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.1.2');"><span class="menuItemText">Profiles</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.1.3');"><span class="menuItemText">General</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="publicMenu2.1.1" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=adjuncts">Adjuncts</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=extracts">Extracts</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=grains">Grains</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=hops">Hops</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=misc">Misc Ingredients</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=styles">Styles</a>
</div>
<div id="publicMenu2.1.2" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=equip_profiles">Equipment Profiles</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=mash_profiles">Mash Profiles</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=water_profiles">Water Profiles</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=yeast_profiles">Yeast Profiles</a>
</div>
<div id="publicMenu2.1.3" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=brewerlinks">Links</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=brewingcss">Themes</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=users">Users</a>
</div>
<div id="publicMenu2.2" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=brewing"><?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=recipes"><?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=awards&assoc=brewing"><?php echo $row_pref['menuAwards']; ?>: <?php echo $row_pref['menuBrewBlogs']; ?></a>
    <a class="menuItem" href="admin/index.php?action=add&dbTable=awards&assoc=recipes"><?php echo $row_pref['menuAwards']; ?>: <?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=upcoming">Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2.1');"><span class="menuItemText">Reference</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2.2');"><span class="menuItemText">Profiles</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2.3');"><span class="menuItemText">General</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="publicMenu2.2.1" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=adjuncts">Adjuncts</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=extracts">Extracts</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=grains">Grains</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=hops">Hops</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=misc">Misc Ingredients</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=styles">Styles</a>
</div>
<div id="publicMenu2.2.2" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=equip_profiles">Equipment Profiles</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=mash_profiles">Mash Profiles</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=water_profiles">Water Profiles</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=yeast_profiles">Yeast Profiles</a>
</div>
<div id="publicMenu2.2.3" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=brewerlinks">Links</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=brewingcss">Themes</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=users">Users</a>
</div>
<div id="publicMenu2.3" class="menu">
	<?php echo "<a class=\"menuItem\" href=\"admin/index.php?action=edit&dbTable=users&filter=".$loginUsername."&id=".$row_user['id']."\">"; ?><?php if ($row_pref['mode'] == "2") echo "My"; ?> Personal Defaults and Info</a>
	<a class="menuItem" href="admin/index.php?action=edit&dbTable=preferences&id=1">Preferences</a>
	<a class="menuItem" href="admin/index.php?action=edit&dbTable=brewer&id=1">Profile</a>
</div>
<div id="publicMenu2.4" class="menu">
	<a class="menuItem" href="admin/index.php?action=importXML&dbTable=brewing">Brewlogs</a>
	<a class="menuItem" href="admin/index.php?action=importXML&dbTable=recipes">Recipes</a>
</div>
<div id="publicMenu2.5" class="menu">
	<a class="menuItem" href="admin/index.php?action=calculate">Recipe Calculator</a>
	<a class="menuItem" href="admin/index.php?action=chooseRecalc">Recalculate a Recipe or Log</a>
</div>
<?php } ?>
<?php if ($row_user['userLevel'] == "2") { ?>
<div id="publicMenu2" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.1');"><span class="menuItemText">Manage</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.6');"><span class="menuItemText">List</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2');"><span class="menuItemText">Add</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.3');"><span class="menuItemText">Edit</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.4');"><span class="menuItemText">Import BeerXML</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.5');"><span class="menuItemText">Tools</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="publicMenu2.1" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=brewing"><?php echo $row_pref['menuBrewBlogs']; ?></a>
    <a class="menuItem" href="admin/index.php?action=list&dbTable=recipes"><?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=awards"><?php echo $row_pref['menuAwards']; ?></a>
	<?php if ($row_pref['mode'] == "2") echo "<a class=\"menuItem\" href=\"admin/index.php?action=list&dbTable=upcoming&filter=".$loginUsername."\">My Upcoming ".$row_pref['menuBrewBlogs']."</a>"; ?>
</div>
<div id="publicMenu2.6" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.6.1');"><span class="menuItemText">Reference</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.6.2');"><span class="menuItemText">Profiles</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.6.3');"><span class="menuItemText">General</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="publicMenu2.6.1" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=adjuncts">Adjuncts</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=extracts">Extracts</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=grains">Grains</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=hops">Hops</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=misc">Misc Ingredients</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=styles">Styles</a>
</div>
<div id="publicMenu2.6.2" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=equip_profiles">Equipment Profiles</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=mash_profiles">Mash Profiles</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=water_profiles">Water Profiles</a>
	<a class="menuItem" href="admin/index.php?action=list&dbTable=yeast_profiles">Yeast Profiles</a>
</div>
<div id="publicMenu2.6.3" class="menu">
	<a class="menuItem" href="admin/index.php?action=list&dbTable=users">Users</a>
</div>
<div id="publicMenu2.2" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=brewing"><?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=recipes"><?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=awards&assoc=brewing"><?php echo $row_pref['menuAwards']; ?>: <?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=awards&assoc=recipes"><?php echo $row_pref['menuAwards']; ?>: <?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=upcoming">Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2.1');"><span class="menuItemText">Reference</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2.2');"><span class="menuItemText">Profiles</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'publicMenu2.2.3');"><span class="menuItemText">General</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="publicMenu2.2.1" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=adjuncts">Adjuncts</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=extracts">Extracts</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=grains">Grains</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=hops">Hops</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=misc">Misc Ingredients</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=styles">Styles</a>
</div>
<div id="publicMenu2.2.2" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=equip_profiles">Equipment Profiles</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=mash_profiles">Mash Profiles</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=water_profiles">Water Profiles</a>
	<a class="menuItem" href="admin/index.php?action=add&dbTable=yeast_profiles">Yeast Profiles</a>
</div>
<div id="publicMenu2.2.3" class="menu">
	<a class="menuItem" href="admin/index.php?action=add&dbTable=users">Users</a>
</div>
<div id="publicMenu2.3" class="menu">
	<a class="menuItem" href="admin/index.php?action=edit&dbTable=users&filter=<?php echo $row_user['user_name']; ?>&section=password&id=<?php echo $row_user['id']; ?>">Change My Password</a>
	<?php echo "<a class=\"menuItem\" href=\"admin/index.php?action=edit&dbTable=users&filter=".$loginUsername."&id=".$row_user['id']."\">"; ?><?php if ($row_pref['mode'] == "2") echo "My"; ?> Personal Defaults and Info</a>
	<a class="menuItem" href="admin/index.php?action=edit&dbTable=users&filter=<?php echo $row_user['user_name']; ?>&id=<?php echo $row_user['id']; ?>">My Profile</a>
</div>
<div id="publicMenu2.4" class="menu">
	<a class="menuItem" href="admin/index.php?action=importXML&dbTable=brewing">Brewlogs</a>
	<a class="menuItem" href="admin/index.php?action=importXML&dbTable=recipes">Recipes</a>
</div>
<div id="publicMenu2.5" class="menu">
	<a class="menuItem" href="admin/index.php?action=calculate">Recipe Calculator</a>
	<a class="menuItem" href="admin/index.php?action=chooseRecalc">Recalculate a Recipe or Log</a>
</div>
<?php } 
}
?>
