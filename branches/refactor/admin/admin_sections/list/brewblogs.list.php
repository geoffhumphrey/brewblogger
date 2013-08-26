<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if ((($row_user['userLevel'] == "2") && ($filter == $_SESSION['loginUsername'])) || ($row_user['userLevel'] == "1")) { ?>
<form name="form1" method="post" action="process.php?action=massUpdate&dbTable=<?php echo $dbTable; ?>&filter=<?php echo $filter; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>">
<table class="dataTable">
	<tr>
	<?php if ($row_pref['mode'] == "1") { ?>
		<td><?php if ($totalRows_brewing > 0) { if ($row_name['brewerFirstName'] != "") echo $row_user['realFirstName'].", there "; if ($row_name['brewerFirstName'] == "") echo "There "; if ($totalRows_brewing > 1 )  echo "are "; else echo "is ";  echo $totalRows_brewing; if ($totalRows_brewing > 1 ) echo " logs "; else echo " log "; echo "in the database.<br><br>";  } else echo "There are no logs found in the database.<br><br>"; ?></td>
	<?php } ?>
	<?php if ($row_pref['mode'] == "2") { ?>
		<td><?php if (($row_user['userLevel'] == "1") && ($totalRows_brewing > 0))  { echo "There "; if ($totalRows_brewing > 1 )  echo "are "; else echo "is ";  echo $totalRows_brewing; if ($totalRows_brewing > 1 ) echo " BrewBlogs "; else echo " BrewBlog ";  echo "in the database.<br><br>"; } elseif (($row_user['userLevel'] == "2") && ($totalRows_brewing > 0 )) { echo $row_user['realFirstName'].", there "; if ($totalRows_brewing > 1 ) echo "are "; else echo "is ";  echo $totalRows_brewing; if ($totalRows_brewing > 1 ) echo " logs "; else echo " log "; echo  "in your personal database.<br><br>"; } else echo "There are no logs found in the database.<br><br>"; ?></td>
	<?php } ?>
		<td width="10%" nowrap><?php include (ADMIN_INCLUDES.'list_add_link.inc.php'); ?></td>
	</tr>
</table>
<table class="dataTable">
	<tr>
    	<td>&nbsp;</td>
    	<td width="10%" nowrap><div class="right"><span class="data-icon_list"><img src="<?php echo $imageSrc; ?>calculator.png" align="absmiddle"/></span><a href="index.php?action=calculate">Recipe Calculator</a></div></td>
    </tr>
</table>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; if ($msg == "9") echo $msg9; ?></td>
	</tr>
</table>
<?php } ?>
<?php if ($totalRows_brewing != 0) { ?>
<table class="dataTable">
    <tr>
 		<td colspan="18" align="right" class="dataHeadingList"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_update_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update" class="radiobutton" value="Update"></td>
 	</tr>
	<tr>
		<td class="dataHeadingList">Brew Name<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=brewing&sort=brewName&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=brewing&sort=brewName&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a><?php } ?></td>
        <td class="dataHeadingList">Style<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=brewing&sort=brewStyle&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=brewing&sort=brewStyle&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a><?php } ?></td>
        <td class="dataHeadingList">Date<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=brewing&sort=brewDate&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=brewing&sort=brewDate&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a><?php } ?></td>
        <td class="dataHeadingList">Batch #<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=brewing&sort=brewBatchNum&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=brewing&sort=brewBatchNum&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a><?php } ?></td>
        <td class="dataHeadingList">Amount</td>
		<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
		<td class="dataHeadingList">Brewer ID<a href="index.php?action=list&dbTable=brewing&sort=brewBrewerID&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=brewing&sort=brewBrewerID&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
		<?php } if ($row_user['userLevel'] == "1") { ?>
        <td class="data-icon_list"><img src="<?php echo $imageSrc; ?>star.png" align="absmiddle" border="0" alt="<?php echo $row_pref['menuRecipes']; ?> Featured?" title="<?php echo $row_pref['menuRecipes']; ?> Featured?"></td>
  		<?php } ?>
  		<td class="data-icon_list"><img src="<?php echo $imageSrc; ?>lock.png" align="absmiddle" border="0" alt="<?php echo $row_pref['menuRecipes']; ?> Archived?" title="<?php echo $row_pref['menuRecipes']; ?> Archived?"></td>
		<td colspan="<?php if (!checkmobile()) echo "9"; else echo "6"; ?>" class="dataHeadingList">Actions</td>
		<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
    </tr>
    <?php do { ?>
    <input type="hidden" name="id[]" value="<?php echo $row_brewing['id']; ?>" />
    <tr <?php echo " style=\"background-color:$color\"";?>>
        <td class="dataList"><?php echo $row_brewing['brewName']; ?></td>
        <td class="dataList"><?php echo $row_brewing['brewStyle']; ?></td>
        <td class="dataList" nowrap="nowrap"><?php $date = $row_brewing['brewDate']; $realdate = dateconvert($date,3); echo $realdate; ?></td>
        <td class="dataList"><?php echo $row_brewing['brewBatchNum']; ?>&nbsp;</td>
        <td class="dataList" nowrap="nowrap"><?php echo $row_brewing['brewYield']." ".$row_pref['measFluid2']; ?></td>
		<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
		<td class="dataList"><?php if ($filter == "all") { ?><a href="index.php?action=list&dbTable=brewing&filter=<?php echo $row_brewing['brewBrewerID']; ?>"><?php echo $row_brewing['brewBrewerID']; ?></a><?php } else echo $row_brewing['brewBrewerID']; ?></td>
		<?php } if ($row_user['userLevel'] == "1") { ?>
        <td class="data-icon_list"><input id="brewFeatured" name="brewFeatured<?php echo $row_brewing['id']; ?>" type="checkbox" value="Y" <?php if ($row_brewing['brewFeatured'] == "Y") echo "checked"; else ""; ?> /></td>
  		<?php } ?>
        <td class="data-icon_list"><input id="brewArchive" name="brewArchive<?php echo $row_brewing['id']; ?>" type="checkbox" value="Y" <?php if ($row_brewing['brewArchive'] == "Y") echo "checked"; else ""; ?> /></td>
        <td class="data-icon_list"><a href="../index.php?page=brewBlogDetail&id=<?php echo $row_brewing['id']; if ($row_pref['mode'] == "2") echo "&filter=".$row_brewing['brewBrewerID'];  ?>"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View <?php echo $row_brewing['brewName']; ?>" title="View <?php echo $row_brewing['brewName']; ?>"></a></td>
        <td class="data-icon_list"><a href="index.php?action=reuse&dbTable=brewing&id=<?php echo $row_brewing['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Reuse <?php echo $row_brewing['brewName']; ?>" title="Reuse <?php echo $row_brewing['brewName']; ?>"></a></td>
     	<td class="data-icon_list"><a href="index.php?action=importRecipe&dbTable=recipes&id=<?php echo $row_brewing['id']; ?>"><img src="<?php echo $imageSrc; ?>page_lightning.png" align="absmiddle" border="0" alt="Import <?php echo $row_brewing['brewName']; ?> to the Recipe Database" title="Import <?php echo $row_brewing['brewName']; ?> to the Recipe Database"></a></td>
		<td class="data-icon_list"><a href="index.php?action=edit&dbTable=brewing&id=<?php echo $row_brewing['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_brewing['brewName']; ?>" title="Edit <?php echo $row_brewing['brewName']; ?>"></a></td>
        <td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=brewing','id',<?php echo $row_brewing['id']; ?>,'Are you sure you want to delete this BrewBlog?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_brewing['brewName']; ?>" title="Delete <?php echo $row_brewing['brewName']; ?>"></a></td>
        <td class="data-icon_list"><a href="index.php?action=calculate&source=brewing&results=false<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "&filter=".$row_brewing['brewBrewerID']; elseif (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) echo "&filter=".$loginUsername; else echo ""; ?>&id=<?php echo $row_brewing['id']; ?>"><img src="<?php echo $imageSrc; ?>calculator.png" align="absmiddle" border="0" alt="Recalculate <?php echo $row_brewing['brewName']; ?>" title="Recalculate <?php echo $row_brewing['brewName']; ?>"></a></td>		 
		<td class="data-icon_list"><a href="index.php?action=add&dbTable=awards&assoc=brewing<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "&filter=".$row_brewing['brewBrewerID']; elseif (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) echo "&filter=".$loginUsername; else echo ""; ?>&id=<?php echo $row_brewing['id']; ?>"><img src="<?php echo $imageSrc; ?>medal_gold_3.png" align="absmiddle" border="0" alt="Add an award/contest entry for <?php echo $row_brewing['brewName']; ?>" title="Add an award/contest entry for <?php echo $row_brewing['brewName']; ?>"></a></td>		 
		<?php if (!checkmobile()) { ?>
        <td class="data-icon_list"><a href="#" onclick="window.open('../includes/output_beer_xml.inc.php?id=<?php echo $row_brewing['id']; ?>&source=brewLog&brewStyle=<?php echo $row_brewing['brewStyle']; ?>','','height=1,width=1, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc; ?>page_white_code.png" title="Download BeerXML" align="absmiddle" border="0" /></a>    
        <td class="data-icon_list"><?php if ($printBrowser == "IE") { ?><a href="#" onClick="window.open('../print.php?source=log&dbTable=brewing&page=logPrint&brewStyle=<?php echo $row_brewing['brewStyle']; ?>&id=<?php echo $row_brewing['id']; ?>','','height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes'); return false;" title="Print <?php echo $row_brewing['brewName']; ?>"><?php } else { ?><a href="../print.php?source=log&dbTable=brewing&page=logPrint&brewStyle=<?php echo $row_brewing['brewStyle']; ?>&id=<?php echo $row_brewing['id']; ?>&KeepThis=true&TB_iframe=true&height=450&width=700" title="Print <?php echo $row_brewing['brewName']; ?>" class="thickbox"><?php } ?><img src="<?php echo $imageSrc; ?>printer.png" align="absmiddle" border="0" alt="Print the <?php echo $row_brewing['brewName']; ?> BrewBlog"  title="Print the <?php echo $row_brewing['brewName']; ?> BrewBlog"></a></td>
	 	<td class="data-icon_list"><a href="../entry.php?style=<?php echo $row_brewing['brewStyle']; ?>&filter=<?php if ($row_pref['mode'] == "2") echo $row_brewing['brewBrewerID']; else echo $loginUsername; ?>&id=<?php echo $row_brewing['id']; ?>&KeepThis=true&TB_iframe=true&height=450&width=700" class="thickbox"><img src="<?php echo $imageSrc; ?>award_star_add.png" alt="Add Awards for <?php echo $row_brewing['brewName']; ?>" title="Print a contest entry sheet for <?php echo $row_brewing['brewName']; ?>" border="0" align="absmiddle"></a></td>
     	<?php } ?>
     </tr>
     <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
     <?php } while ($row_brewing = mysql_fetch_assoc($brewing)); ?>
     <tr>
 		<td colspan="18" align="right" class="dataHeadingList"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_update_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update" class="radiobutton" value="Update"></td>
 	</tr>
</table>
</form>
<?php } ?>
<?php } // end if ((($row_user['userLevel'] == "2") && ($filter == $_SESSION['loginUsername'])) || ($row_user['userLevel'] == "1")) 
else include(ADMIN_INCLUDES.'error_privileges.inc.php');
?>