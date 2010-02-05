<?php if (!checkmobile()) include ('includes/menu.inc.php'); ?>
<ul id="navlist">
<?php if ($row_user['userLevel'] == "2") { ?>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu8');"><?php echo $row_pref['menuBrewBlogs']."/".$row_pref['menuRecipes']; ?></a><?php } else echo ""; ?></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu9');">Lists</a><?php } else echo "<a href=\"index.php\">Administration</a>"; ?></div></li>
<li><?php if (!checkmobile()) { ?><a href="tools/calculate.php?KeepThis=true&TB_iframe=true&height=450&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox"><?php } else { ?><a href="../index.php?page=tools"><?php } echo $row_pref['menuCalculators']; ?></a></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu10');">Help</a><?php } else echo ""; ?></div></li>
<?php } ?>

<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="index.php?action=list&dbTable=brewing" onclick="index.php?action=list&dbTable=brewing" onmouseover="buttonMouseover(event, 'adminMenu1');"><?php } else { ?><a href="index.php?action=list&dbTable=brewing"><?php } echo $row_pref['menuBrewBlogs']; ?></a></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="index.php?action=list&dbTable=recipes" onclick="index.php?action=list&dbTable=recipes" onmouseover="buttonMouseover(event, 'adminMenu2');"><?php } else { ?><a href="index.php?action=list&dbTable=recipes"><?php } echo $row_pref['menuRecipes']; ?></a></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu3');"><?php } else { ?><a href="../index.php?page=reference"><?php } echo $row_pref['menuReference']; ?></a></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu4');"><?php } else { ?><a href="index.php"><?php } ?>General</a></div></li>
<li><?php if (!checkmobile()) { ?><a href="tools/calculate.php?KeepThis=true&TB_iframe=true&height=450&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox"><?php } else { ?><a href="../index.php?page=tools"><?php } echo $row_pref['menuCalculators']; ?></a></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu10');">Help</a><?php } else echo ""; ?></div></li>
<?php } ?>

<?php if (($row_pref['mode'] == "1") && ($row_user['userLevel'] == "1")) { ?>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="index.php?action=list&dbTable=brewing" onclick="index.php?action=list&dbTable=brewing" onmouseover="buttonMouseover(event, 'adminMenu1');"><?php } else { ?><a href="index.php?action=list&dbTable=brewing"><?php } echo $row_pref['menuBrewBlogs']; ?></a></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="index.php?action=list&dbTable=recipes" onclick="index.php?action=list&dbTable=recipes" onmouseover="buttonMouseover(event, 'adminMenu2');"><?php } else { ?><a href="index.php?action=list&dbTable=recipes"><?php } echo $row_pref['menuRecipes']; ?></a></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu3');"><?php } else { ?><a href="../index.php?page=reference"><?php } echo $row_pref['menuReference']; ?></a></div></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu4');"><?php } else { ?><a href="index.php"><?php } ?>General</a></div></li>
<li><?php if (!checkmobile()) { ?><a href="tools/calculate.php?KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox"><?php } else { ?><a href="../index.php?page=tools"><?php } echo $row_pref['menuCalculators']; ?></a></li>
<li><div class="menuBar"><?php if (!checkmobile()) { ?><a class="menuButton" href="#" onclick="" onmouseover="buttonMouseover(event, 'adminMenu10');">Help</a><?php } else echo ""; ?></div></li>
<?php } ?>
<li><div class="menuBar"><a class="menuButton" href="../index.php" onclick="../index.php" onmouseover="buttonMouseover(event, 'admin<?php if ($row_pref['mode'] == "1") echo "Menu6"; if ($row_pref['mode'] == "2") echo "Menu7"; ?>')">&lt;&lt; Back to<?php if (!checkmobile()) echo "..."; else echo " Main"; ?></a></div></li>

<li><a href="../includes/logout.inc.php"><?php echo $row_pref['menuLogout']; ?></a></li>
</ul>
<div id="adminMenu1" class="menu">
	<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
    <a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu1.4');"><span class="menuItemText">Manage</span><span class="menuItemArrow">&#9654;</span></a>
    <?php } else { ?>
	<a class="menuItem" href="index.php?action=list&dbTable=brewing">Manage</a>
    <?php } ?>
	<a class="menuItem" href="index.php?action=add&dbTable=brewing">Add</a>
	<a class="menuItem" href="index.php?action=importXML&dbTable=brewing">Import BeerXML</a>
    <a class="menuItem" href="index.php?action=calculate">Recipe Calculator</a>
    <a class="menuItem" href="index.php?action=chooseRecalc">Recalculate <?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu1.1');"><span class="menuItemText">Upcoming</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu1.3');"><span class="menuItemText"><?php echo $row_pref['menuAwards']; ?></span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu1.2');"><span class="menuItemText">Reviews</span><span class="menuItemArrow">&#9654;</span></a>
	</div>
<div id="adminMenu1.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=upcoming">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=upcoming">Add</a>
</div>
<div id="adminMenu1.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=reviews">Manage</a>
    <a class="menuItem" href="index.php?action=add&dbTable=reviews">Add</a>
</div>
<div id="adminMenu1.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=awards&filter=<?php echo $filter; ?>">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=awards&assoc=brewing">Add</a>
</div>
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<div id="adminMenu1.4" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=brewing">All <?php echo $row_pref['menuBrewBlogs']; ?></a>
	<a class="menuItem" href="index.php?action=list&dbTable=brewing&filter=<?php echo $loginUsername; ?>">My <?php echo $row_pref['menuBrewBlogs']; ?></a>
</div>
<?php } ?>

<div id="adminMenu2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=recipes">Manage</a>
    <a class="menuItem" href="index.php?action=add&dbTable=recipes">Add</a>
	<a class="menuItem" href="index.php?action=importXML&dbTable=recipes">Import BeerXML</a>
    <a class="menuItem" href="index.php?action=calculate">Recipe Calculator</a>
    <a class="menuItem" href="index.php?action=chooseRecalc">Recalculate <?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu2.1');"><span class="menuItemText"><?php echo $row_pref['menuAwards']; ?></span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu2.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=awards&assoc=recipes&filter=<?php echo $filter; ?>">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=awards&assoc=recipes">Add</a>
</div>
<div id="adminMenu3" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.1');"><span class="menuItemText">Adjuncts</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.2');"><span class="menuItemText">Extracts</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.3');"><span class="menuItemText">Grains</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.4');"><span class="menuItemText">Hops</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.5');"><span class="menuItemText">Misc. Ingredients</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.6');"><span class="menuItemText">Styles</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.7');"><span class="menuItemText">Profiles</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu3.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=adjuncts">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=adjuncts">Add</a>
</div>
<div id="adminMenu3.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=extract">Manage</a>
    <a class="menuItem" href="index.php?action=add&dbTable=extract">Add</a>
</div>
<div id="adminMenu3.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=malt">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=malt">Add</a>
</div>
<div id="adminMenu3.4" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=hops">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=hops">Add</a>
</div>
<div id="adminMenu3.5" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=misc">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=misc">Add</a>
</div>
<div id="adminMenu3.6" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=styles">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=styles">Add</a>
</div>
<div id="adminMenu3.7" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.7.1');"><span class="menuItemText">Equipment</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.7.2');"><span class="menuItemText">Mash</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.7.3');"><span class="menuItemText">Water</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu3.7.4');"><span class="menuItemText">Yeast</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu3.7.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=equip_profiles">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=equip_profiles">Add</a>
</div>
<div id="adminMenu3.7.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=mash_profiles">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=mash_profiles">Add</a>
</div>
<div id="adminMenu3.7.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=water_profiles">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=water_profiles">Add</a>
</div>
<div id="adminMenu3.7.4" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=yeast_profiles">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=yeast_profiles">Add</a>
</div>
<div id="adminMenu4" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu4.4');"><span class="menuItemText">Edit</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu4.1');"><span class="menuItemText">Links</span><span class="menuItemArrow">&#9654;</span></a>
	<?php if ($row_pref['mode'] == "2") { ?>
    <a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu4.5');"><span class="menuItemText">News</span><span class="menuItemArrow">&#9654;</span></a>
	<?php } ?>
    <a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu4.2');"><span class="menuItemText">Themes</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu4.3');"><span class="menuItemText">Users</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu4.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=brewerlinks">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=brewerlinks">Add</a>
</div>
<div id="adminMenu4.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=brewingcss">Manage Themes</a>
	<a class="menuItem" href="index.php?action=add&dbTable=brewingcss">Add</a>
</div>
<div id="adminMenu4.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=users">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=users">Add</a>
</div>
<div id="adminMenu4.4" class="menu">
<?php echo "<a class=\"menuItem\" href=\"index.php?action=edit&dbTable=users&filter=".$loginUsername."&id=".$row_user['id']."\">"; ?><?php if ($row_pref['mode'] == "2") echo "My"; ?> Personal Defaults and Info</a>
	<a class="menuItem" href="index.php?action=edit&dbTable=preferences&id=1">Preferences</a>
	<a class="menuItem" href="index.php?action=edit&dbTable=brewer&id=1">Profile</a>
</div>
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<div id="adminMenu4.5" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=news">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=news">Add</a>
</div>
<?php } ?>

<div id="adminMenu6" class="menu">
<a class="menuItem" href="../index.php?page=awardsList&sort=awardBrewName&dir=ASC"><?php echo $row_pref['menuAwards']; ?></a>
<a class="menuItem" href="../index.php?page=about">Profile</a>
<a class="menuItem" href="../index.php?page=brewBlogList"><?php echo $row_pref['menuBrewBlogs']; ?></a>
<a class="menuItem" href="../index.php?page=tools"><?php echo $row_pref['menuCalculators']; ?></a>
<a class="menuItem" href="../index.php?page=calendar"><?php echo $row_pref['menuCalendar']; ?></a>
<a class="menuItem" href="../index.php?page=brewBlogCurrent">Current</a>
<a class="menuItem" href="../index.php?page=recipeList"><?php echo $row_pref['menuRecipes']; ?></a>
<a class="menuItem" href="../index.php?page=reference"><?php echo $row_pref['menuReference']; ?></a>
</div>
<div id="adminMenu7" class="menu">
<a class="menuItem" href="../index.php?page=awardsList&sort=awardBrewName&dir=ASC"><?php echo $row_pref['menuAwards']; ?></a>
<a class="menuItem" href="../index.php?page=brewBlogList&sort=brewDate&dir=DESC"><?php echo $row_pref['menuBrewBlogs']; ?></a>
<a class="menuItem" href="../index.php?page=members&sort=realLastName&dir=ASC"><?php echo $row_pref['menuMembers']; ?></a>
<a class="menuItem" href="../index.php?page=about">Profile</a>
<a class="menuItem" href="../index.php?page=recipeList"><?php echo $row_pref['menuRecipes']; ?></a>
<a class="menuItem" href="../index.php?page=tools"><?php echo $row_pref['menuCalculators']; ?></a>
<a class="menuItem" href="../index.php?page=reference"><?php echo $row_pref['menuReference']; ?></a>
<a class="menuItem" href="../index.php?page=calendar"><?php echo $row_pref['menuCalendar']; ?></a>
</div>
<?php if ($row_user['userLevel'] == "2") { ?>
<div id="adminMenu8" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu8.1');"><span class="menuItemText"><?php echo $row_pref['menuBrewBlogs']; ?></span><span class="menuItemArrow">&#9654;</span></a>
    <a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu8.2');"><span class="menuItemText"><?php echo $row_pref['menuRecipes']; ?></span><span class="menuItemArrow">&#9654;</span></a>

</div>
<div id="adminMenu8.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=brewing">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=brewing">Add</a>
	<a class="menuItem" href="index.php?action=importXML&dbTable=brewing">Import BeerXML</a>
    <a class="menuItem" href="index.php?action=calculate">Recipe Calculator</a>
    <a class="menuItem" href="index.php?action=chooseRecalc">Recalculate  <?php echo $row_pref['menuBrewBlogs']; ?></a>
    <a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu8.1.2');"><span class="menuItemText"><?php echo $row_pref['menuAwards']; ?></span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu8.1.3');"><span class="menuItemText">Reviews</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu8.1.1');"><span class="menuItemText">Upcoming</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu8.1.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=upcoming">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=upcoming">Add</a>
</div>
<div id="adminMenu8.1.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=awards">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=awards&assoc=brewing">Add</a>
</div>
<div id="adminMenu8.1.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=reviews">Manage</a>
    <a class="menuItem" href="index.php?action=add&dbTable=reviews">Add</a>
</div>
<div id="adminMenu8.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=recipes">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=recipes">Add</a>
	<a class="menuItem" href="index.php?action=importXML&dbTable=recipes">Import BeerXML</a>
	<a class="menuItem" href="index.php?action=list&dbTable=recipes&view=copy">Copy/Import Other User <?php echo $row_pref['menuRecipes']; ?></a>
	<a class="menuItem" href="index.php?action=calculate">Recipe Calculator</a>
    <a class="menuItem" href="index.php?action=chooseRecalc">Recalculate  <?php echo $row_pref['menuRecipes']; ?></a>
    <a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu8.2.1');"><span class="menuItemText"><?php echo $row_pref['menuAwards']; ?></span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu8.2.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=awards">Manage</a>
	<a class="menuItem" href="index.php?action=add&dbTable=awards&assoc=recipes">Add</a>
</div>
<div id="adminMenu9" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.1');"><span class="menuItemText">Adjuncts</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.2');"><span class="menuItemText">Extracts</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.3');"><span class="menuItemText">Grains</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.4');"><span class="menuItemText">Hops</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.5');"><span class="menuItemText">Misc. Ingredients</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.6');"><span class="menuItemText">Styles</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.7');"><span class="menuItemText">Profiles</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu9.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=adjuncts">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=adjuncts">Add</a>
</div>
<div id="adminMenu9.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=extract">List</a>
    <a class="menuItem" href="index.php?action=add&dbTable=extract">Add</a>
</div>
<div id="adminMenu9.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=malt">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=malt">Add</a>
</div>
<div id="adminMenu9.4" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=hops">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=hops">Add</a>
</div>
<div id="adminMenu9.5" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=misc">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=misc">Add</a>
</div>
<div id="adminMenu9.6" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=styles">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=styles">Add</a>
</div>
<div id="adminMenu9.7" class="menu">
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.7.1');"><span class="menuItemText">Equipment</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.7.2');"><span class="menuItemText">Mash</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.7.3');"><span class="menuItemText">Water</span><span class="menuItemArrow">&#9654;</span></a>
	<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu9.7.4');"><span class="menuItemText">Yeast</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu9.7.1" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=equip_profiles">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=equip_profiles">Add</a>
</div>
<div id="adminMenu9.7.2" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=mash_profiles">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=mash_profiles">Add</a>
</div>
<div id="adminMenu9.7.3" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=water_profiles">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=water_profiles">Add</a>
</div>
<div id="adminMenu9.7.4" class="menu">
	<a class="menuItem" href="index.php?action=list&dbTable=yeast_profiles">List</a>
	<a class="menuItem" href="index.php?action=add&dbTable=yeast_profiles">Add</a>
</div>
<?php } ?>
<div id="adminMenu10" class="menu">
<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu10.1');"><span class="menuItemText">Google</span><span class="menuItemArrow">&#9654;</span></a>
<a class="menuItem" href="" onclick="return false;" onmouseover="menuItemMouseover(event, 'adminMenu10.2');"><span class="menuItemText">SourceForge</span><span class="menuItemArrow">&#9654;</span></a>
</div>
<div id="adminMenu10.1" class="menu">
<a class="menuItem" href="http://code.google.com/p/brewblogger/" target="_blank">Project Home</a>
<a class="menuItem" href="http://code.google.com/p/brewblogger/issues/list?can=1&q=&colspec=ID+Type+Status+Priority+Milestone+Owner+Summary&cells=tiles" target="_blank">Issues</a>
<a class="menuItem" href="http://code.google.com/p/brewblogger/source/browse/trunk" target="_blank">Source</a>
<a class="menuItem" href="http://code.google.com/p/brewblogger/updates/list" target="_blank">Updates</a>
</div>

<div id="adminMenu10.2" class="menu">
<a class="menuItem" href="http://sourceforge.net/projects/brewblogger/" target="_blank">Project Home</a>
<a class="menuItem" href="http://sourceforge.net/projects/brewblogger/forums/forum/564469" target="_blank">Help Forum</a>
<a class="menuItem" href="http://sourceforge.net/tracker/?group_id=165855&atid=837037" target="_blank">Report a Bug</a>
<a class="menuItem" href="http://sourceforge.net/tracker/?group_id=165855&atid=837040" target="_blank">Request a Feature</a>
<a class="menuItem" href="http://sourceforge.net/tracker/?group_id=165855&atid=837038" target="_blank">Request Support</a>
</div>