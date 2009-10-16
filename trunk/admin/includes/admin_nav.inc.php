<?php if (!checkmobile()) include ('includes/menu.inc.php'); ?>
<ul id="navlist">
<?php if ($row_user['userLevel'] == "2") { ?>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu8, '225px')" onMouseout="delayhidemenu()">Logs/Recipes</a><?php } else echo ""; ?></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu9, '165px')" onMouseout="delayhidemenu()">Lists<?php } else { ?><a href="index.php">Administration</a><?php } ?></li>
<li><?php if (!checkmobile()) { ?><a href="tools/calculate.php?KeepThis=true&TB_iframe=true&height=450&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox"><?php } else { ?><a href="../index.php?page=tools"><?php } echo $row_pref['menuCalculators']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onclick="return clickreturnvalue()" onmouseover="dropdownmenu(this, event, menu7, '120px')" onmouseout="delayhidemenu()">Help</a><?php } else echo ""; ?></li>
<?php } ?>

<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu2, '200px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="index.php?action=list&dbTable=brewing"><?php } echo $row_pref['menuBrewBlogs']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu3, '135px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="index.php?action=list&dbTable=recipes"><?php } echo $row_pref['menuRecipes']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu1, '160px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="../index.php?page=reference"><?php } echo $row_pref['menuReference']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu4, '130px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="index.php"><?php } ?>General</a></li>
<li><?php if (!checkmobile()) { ?><a href="tools/calculate.php?KeepThis=true&TB_iframe=true&height=450&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox"><?php } else { ?><a href="../index.php?page=tools"><?php } echo $row_pref['menuCalculators']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu7, '120px')" onMouseout="delayhidemenu()">Help</a><?php } else echo ""; ?></li>
<?php } ?>

<?php if (($row_pref['mode'] == "1") && ($row_user['userLevel'] == "1")) { ?>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu2, '200px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="index.php?action=list&dbTable=brewing"><?php } echo $row_pref['menuBrewBlogs']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu3, '135px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="index.php?action=list&dbTable=recipes"><?php } echo $row_pref['menuRecipes']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu1, '160px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="../index.php?page=reference"><?php } echo $row_pref['menuReference']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu4, '130px')" onMouseout="delayhidemenu()"><?php } else { ?><a href="index.php"><?php } ?>General</a></li>
<li><?php if (!checkmobile()) { ?><a href="tools/calculate.php?KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox"><?php } else { ?><a href="../index.php?page=tools"><?php } echo $row_pref['menuCalculators']; ?></a></li>
<li><?php if (!checkmobile()) { ?><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu7, '120px')" onMouseout="delayhidemenu()">Help</a><?php } else echo ""; ?></li>
<?php } ?>
<li><a href="../index.php" onMouseover="dropdownmenu(this, event, <?php if ($row_pref['mode'] == "1") echo "menu6"; if ($row_pref['mode'] == "2") echo "menu11"; ?>, '125px')" onMouseout="delayhidemenu()">&lt;&lt; Back to<?php if (!checkmobile()) echo "..."; else echo " Main"; ?></a></li>
<li><a href="../includes/logout.inc.php"><?php echo $row_pref['menuLogout']; ?></a></li>
</ul>
