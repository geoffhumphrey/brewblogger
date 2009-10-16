<div id="breadcrumbAdmin">Administration</div>
<div id="subtitleAdmin">Administration</div>
<table>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>tick.png" align="absmiddle"></td>
    <td class="data"><?php  if ($row_pref['mode'] == "2") echo $row_user['realFirstName'].", y"; elseif (($row_pref['mode'] = "1") && ($row_name['brewerFirstName'] != "")) echo $row_name['brewerFirstName'].", y"; else echo "Y"; echo "ou can manage all of your BrewBlogger data, features, and functions here."; ?></td>
  </tr>
  <?php if (($row_pref['allowNews'] == "Y") && ($row_pref['mode'] == "2") && ($totalRows_newsGen > 0)) { ?>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>newspaper.png" align="absmiddle"></td>
    <td class="data">Read the <a href="index.php?action=view&dbTable=news"><?php echo $row_pref['menuMembers']; ?> News</a> items posted.</td>
  </tr>
  <?php } ?>
</table>
<div id="headerContentAdmin"><?php echo $row_pref['menuBrewBlogs']; ?></div>
<table>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>book.png" align="absmiddle"></td>
    <td class="data" width="33%"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=brewing&filter=all\">Manage ".$row_pref['menuBrewBlogs']."</a><br><a href=\"?action=list&dbTable=brewing&filter=".$loginUsername."\">Manage My ".$row_pref['menuBrewBlogs']."</a>"; else echo "<a href=\"?action=list&dbTable=brewing\">Manage ".$row_pref['menuBrewBlogs']."</a>"; ?></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>book_add.png"></td>
    <td class="data" width="33%"><a href="index.php?action=add&dbTable=brewing">Add <?php echo $row_pref['menuBrewBlogs']; ?></a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>picture_add.png" /></td>
    <td class="data"><a href="includes/upload_image.inc.php?KeepThis=true&TB_iframe=true&height=450&width=800" class="thickbox" title="Upload Label Images">Upload Label Images</a></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>hourglass.png" align="absmiddle"></td>
    <td class="data"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=upcoming\">Manage Upcoming ".$row_pref['menuBrewBlogs']."</a><br><a href=\"?action=list&dbTable=upcoming&filter=".$loginUsername."\">Manage My Upcoming ".$row_pref['menuBrewBlogs']."</a>"; else echo "<a href=\"?action=list&dbTable=upcoming\">Manage Upcoming ".$row_pref['menuBrewBlogs']."</a>"; ?></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>hourglass_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=upcoming">Add Upcoming <?php echo $row_pref['menuBrewBlogs']; ?></a></td>
    <td class="data_icon" width="1%"><?php if ($phpVersion >= "5") { ?><img src="<?php echo $imageSrc; ?>page_white_code.png" /><?php } else echo "&nbsp;"; ?></td>
    <td class="data"><?php if ($phpVersion >= "5") { ?><a href="index.php?action=importXML&dbTable=brewing">Import Beer XML to <?php echo $row_pref['menuBrewBlogs']; ?></a><?php } else echo "&nbsp;"; ?></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>medal_gold_1.png" align="absmiddle" /></td>
    <td class="data"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=awards&filter=all\">Manage ".$row_pref['menuAwards']."</a><br><a href=\"?action=list&dbTable=awards&filter=".$loginUsername."\">Manage My ".$row_pref['menuAwards']."</a>"; else echo "<a href=\"?action=list&dbTable=awards\">Manage ".$row_pref['menuAwards']."</a>"; ?></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>medal_gold_add.png" align="absmiddle" /></td>
    <td class="data"><a href="index.php?action=add&dbTable=awards&assoc=brewing">Add <?php echo $row_pref['menuAwards']; ?></a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>page_white_edit.png" align="absmiddle" /></td>
    <td class="data"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=reviews&filter=all\">Manage Reviews</a><br><a href=\"?action=list&dbTable=reviews&filter=".$loginUsername."\">Manage My Reviews</a>"; else echo "<a href=\"?action=list&dbTable=reviews\">Manage Reviews</a>"; ?></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>page_white_add.png" align="absmiddle" /></td>
    <td class="data"><a href="index.php?action=add&dbTable=reviews">Add Reviews</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
</table>
<div id="headerContentAdmin"><?php echo $row_pref['menuRecipes']; ?></div>
<table>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>script.png"></td>
    <td class="data" width="33%"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=recipes&filter=all\">Manage ".$row_pref['menuRecipes']."</a><br><a href=\"?action=list&dbTable=recipes&filter=".$loginUsername."\">Manage My ".$row_pref['menuRecipes']."</a>"; else echo "<a href=\"?action=list&dbTable=recipes\">Manage ".$row_pref['menuRecipes']."</a>"; ?></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>script_add.png"></td>
    <td class="data" width="33%"><a href="index.php?action=add&dbTable=recipes">Add <?php echo $row_pref['menuRecipes']; ?></a></td>
    <?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) { ?>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>page_refresh.png" /></td>
    <td class="data"><a href="?action=list&dbTable=recipes&view=copy">Copy/Import Other User <?php echo $row_pref['menuRecipes']; ?></a></td>
  	<?php } else { ?>
    <td class="data_icon" width="1%"><?php if ($phpVersion >= "5") { ?><img src="<?php echo $imageSrc; ?>page_white_code.png" /><?php } else echo "&nbsp;"; ?></td>
    <td class="data"><?php if ($phpVersion >= "5") { ?><a href="index.php?action=importXML&dbTable=recipes">Import Beer XML to <?php echo $row_pref['menuRecipes']; ?></a><?php } else echo "&nbsp;"; ?></td>
	<?php } ?>
  </tr>
  <tr>
  	<td class="data_icon"><img src="<?php echo $imageSrc; ?>medal_gold_1.png" align="absmiddle" /></td>
    <td class="data"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=awards&assoc=recipes&filter=all\">Manage ".$row_pref['menuAwards']."</a><br><a href=\"?action=list&dbTable=awards&assoc=recipes&filter=".$loginUsername."\">Manage My ".$row_pref['menuAwards']."</a>"; else echo "<a href=\"?action=list&dbTable=awards&assoc=recipes\">Manage ".$row_pref['menuAwards']."</a>"; ?></td>
  	<td class="data_icon"><img src="<?php echo $imageSrc; ?>medal_gold_add.png" align="absmiddle" /></td>
    <td class="data"><a href="index.php?action=add&dbTable=awards&assoc=recipes">Add <?php echo $row_pref['menuAwards']; ?></a></td>
    <?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) { ?>
    <td class="data_icon" width="1%"><?php if ($phpVersion >= "5") { ?><img src="<?php echo $imageSrc; ?>page_white_code.png" /><?php } else echo "&nbsp;"; ?></td>
    <td class="data"><?php if ($phpVersion >= "5") { ?><a href="index.php?action=importXML&dbTable=recipes">Import Beer XML to <?php echo $row_pref['menuRecipes']; ?></a><?php } else echo "&nbsp;"; ?></td>
    <?php } else { ?>
    <td class="data_icon" width="1%">&nbsp;</td>
    <td class="data">&nbsp;</td>
	<?php } ?>
  </tr>
</table>
<?php if ($row_user['userLevel'] == "1") { ?>
<div id="headerContentAdmin"><?php echo $row_pref['menuReference']; ?></div>
<table>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>cup.png"></td>
    <td class="data" width="33%"><a href="index.php?action=list&dbTable=adjuncts">Manage Adjuncts</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>cup_add.png"></td>
    <td class="data" width="33%"><a href="index.php?action=add&dbTable=adjuncts">Add Adjuncts</a></td>
    <td class="data_icon" width="1%">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>pill.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=extract">Manage Extracts</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>pill_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=extract">Add Extracts</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>world.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=malt">Manage Grains</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>world_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=malt">Add Grains</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>plugin.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=hops">Manage Hops</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>plugin_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=hops">Add Hops</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>brick.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=misc">Manage Misc Ingredients</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>brick_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=misc">Add Misc Ingredients</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>note.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=styles">Manage Styles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>note_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=styles">Add Styles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>ruby.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=sugar_type">Manage Sugar Types</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>ruby_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=sugar_type">Add Sugar Types</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>database.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=equip_profiles">Manage Equipment Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>database_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=equip_profiles">Add Equipment Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>chart_curve.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=mash_profiles">Manage Mash Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>chart_curve_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=mash_profiles">Add Mash Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>shape_square.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=water_profiles">Manage Water Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>shape_square_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=water_profiles">Add Water Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>zoom.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=yeast_profiles">Manage Yeast Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>zoom_in.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=yeast_profiles">Add Yeast Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  
</table>
<div id="headerContentAdmin">General</div>
<table>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>user.png" /></td>
    <td class="data"><?php echo "<a href=\"?action=edit&dbTable=users&filter=".$loginUsername."&id=".$row_user['id']."\">"; ?>Edit <?php if ($row_pref['mode'] == "2") echo "My"; ?> Personal Defaults and Info</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?><?php if ($row_pref['mode'] == "1") echo "user_edit"; else echo "group_edit"; ?>.png" /></td>
    <td class="data"><a href="index.php?action=edit&dbTable=brewer&id=1">Edit Profile</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>picture_add.png" /></td>
    <td class="data"><a href="includes/upload_image.inc.php?KeepThis=true&TB_iframe=true&height=450&width=800" class="thickbox" title="Upload Profile Image">Upload Profile Image</a></td>
  </tr>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>link.png"></td>
    <td class="data" width="33%"><a href="index.php?action=list&dbTable=brewerlinks">Manage Links</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>link_add.png"></td>
    <td class="data" width="33%"><a href="index.php?action=add&dbTable=brewerlinks">Add Links</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>cog.png" /></td>
    <td class="data"><a href="index.php?action=edit&dbTable=preferences&id=1">Edit Preferences</a></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>user.png" /></td>
    <td class="data"><?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "<a href=\"index.php?action=list&dbTable=users\">Manage Users</a>"; else echo "<a href=\"?action=list&dbTable=users\">Manage Users</a>"; ?></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>user_add.png" /></td>
    <td class="data"><a href="index.php?action=add&dbTable=users">Add Users</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>application.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=brewingcss">Manage Themes</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>application_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=brewingcss">Add Themes</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <?php if ($row_pref['mode'] == "2") { ?>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>newspaper.png" /></td>
    <td class="data"><a href="index.php?action=list&dbTable=news">Manage News</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>newspaper_add.png" /></td>
    <td class="data"><a href="index.php?action=add&dbTable=news">Add News</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <?php } ?>
</table>
<?php } ?>
<?php if ($row_user['userLevel'] == "2") { ?>
<div id="headerContentAdmin">My Profile</div>
<table>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>user.png"></td>
    <td class="data" width="33%"><a href="index.php?action=edit&dbTable=users&filter=<?php echo $row_user['user_name']; ?>&id=<?php echo $row_user['id']; ?>">Edit My Profile</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>key.png"></td>
    <td class="data" width="33%"><a href="index.php?action=edit&dbTable=users&filter=<?php echo $row_user['user_name']; ?>&section=password&id=<?php echo $row_user['id']; ?>">Change My Password</a></td>
    <td class="data_icon" width="1%">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
</table>
<div id="headerContentAdmin">Lists</div>
<table>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>cup.png"></td>
    <td class="data" width="33%"><a href="index.php?action=list&dbTable=adjuncts">List Adjuncts</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>cup_add.png"></td>
    <td class="data" width="33%"><a href="index.php?action=add&dbTable=adjuncts">Add Ajuncts</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>note.png" /></td>
    <td class="data"><a href="index.php?action=list&dbTable=styles">List Styles</a></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>database.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=extract">List Extracts</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>database_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=extract">Add Extracts</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>group.png" /></td>
    <td class="data"><a href="index.php?action=list&dbTable=users">List Users</a></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>world.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=malt">List Grains</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>world_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=malt">Add Grains</a></td>
    <?php if (($row_prefs['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>

    <td class="data_icon"><img src="<?php echo $imageSrc; ?>newspaper.png" /></td>
    <td class="data"><a href="index.php?action=list&dbTable=news">List News</a></td>
    <?php } else { ?>

    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
    <?php } ?>

 </tr>
 <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>plugin.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=hops">List Hops</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>plugin_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=hops">Add Hops</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
 <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>database.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=equip_profiles">List Equipment Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>database_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=equip_profiles">Add Equipment Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>chart_curve.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=mash_profiles">List Mash Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>chart_curve_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=mash_profiles">Add Mash Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>shape_square.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=water_profiles">List Water Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>shape_square_add.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=water_profiles">Add Water Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
  </tr>
    <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>zoom.png"></td>
    <td class="data"><a href="index.php?action=list&dbTable=yeast_profiles">List Yeast Profiles</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>zoom_in.png"></td>
    <td class="data"><a href="index.php?action=add&dbTable=yeast_profiles">Add Yeast Profiles</a></td>
    <td class="data_icon">&nbsp;</td>
    <td class="data">&nbsp;</td>
  </tr>
</table>

<?php } ?>

<div id="headerContentAdmin"><?php echo $row_pref['menuCalculators']; ?></div>
<table>
  <tr>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>calculator.png"></td>
    <td class="data" width="33%"><a href="tools/calculate.php?section=bitterness&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">Bitterness Calculator</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>calculator.png"></td>
    <td class="data" width="33%"><a href="tools/calculate.php?section=calories&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">Calories, Alcohol, and Plato Calculator</a></td>
    <td class="data_icon" width="1%"><img src="<?php echo $imageSrc; ?>calculator.png" /></td>
    <td class="data"><a href="tools/calculate.php?section=force_carb&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">Force Carbonation Calculator</a></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>calculator.png" /></td>
    <td class="data"><a href="tools/calculate.php?section=plato&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">Plato to Specific Gravity Calculator</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>calculator.png" /></td>
    <td class="data"><a href="tools/calculate.php?section=efficiency&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">PPG and Efficiency Calculator</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>calculator.png" /></td>
    <td class="data"><a href="tools/calculate.php?section=sugar&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">Priming Sugar Calculator</a></td>
  </tr>
  <tr>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>calculator.png"></td>
    <td class="data"><a href="index.php?action=chooseRecalc">Recalculate a Recipe or Log</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>calculator.png"></td>
    <td class="data"><a href="index.php?action=calculate">Recipe Calculator</a></td>
    <td class="data_icon"><img src="<?php echo $imageSrc; ?>calculator.png" /></td>
    <td class="data"><a href="tools/calculate.php?section=water&KeepThis=true&TB_iframe=true&height=475&width=800" title="<?php echo $row_pref['menuCalculators']; ?>" class="thickbox">Water Amounts Calculator</a> </td>
  </tr>
</table>