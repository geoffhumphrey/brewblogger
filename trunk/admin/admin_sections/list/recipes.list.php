<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if ((($row_user['userLevel'] == "2") && ($filter == $_SESSION['loginUsername'])) || ($row_user['userLevel'] == "1")) { ?>
<form name="form1" method="post" action="process.php?action=massUpdate&dbTable=<?php echo $dbTable; ?>&filter=<?php echo $filter; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>">
<table class="dataTable">
	<tr>
	<?php if ($row_pref['mode'] == "1") { ?>
		<td><?php if ($totalRows_log > 0) { if ($row_name['brewerFirstName'] != "") echo $row_user['realFirstName'].", there "; if ($row_name['brewerFirstName'] == "") echo "There "; if ($totalRows_log > 1 )  echo "are "; else echo "is ";  echo $totalRows_log; if ($totalRows_log > 1 ) echo " recipes "; else echo " recipe "; if ($filter == "all") echo "in the database.<br><br>"; else echo "under ".$row_log['brewBrewerID']."'s User ID.<br><br>"; } else echo "There are no recipes found in the database.<br><br>"; ?></td>
	<?php } ?>
	<?php if ($row_pref['mode'] == "2") { ?>
		<td><?php if (($row_user['userLevel'] == "1") && ($totalRows_log > 0))  { echo "There "; if ($totalRows_log > 1 )  echo "are "; else echo "is ";  echo $totalRows_log; if ($totalRows_log > 1 ) echo " recipes "; else echo " recipe ";  echo "in the database.<br><br>"; } elseif (($row_user['userLevel'] == "2") && ($totalRows_log > 0)) { echo $row_user['realFirstName'].", there "; if ($totalRows_log > 1 ) echo "are "; else echo "is ";  echo $totalRows_log; if ($totalRows_log > 1 ) echo " recipes "; else echo " recipe "; echo  "in the database.<br><br>"; } else echo "There are no recipes found in the database.<br><br>"; ?></td>
	<?php } ?>
		<td width="10%" nowrap><?php include ('includes/list_add_link.inc.php'); ?></td>
	</tr>
</table>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; if ($msg == "9") echo $msg9; ?></td>
	</tr>
</table>
<?php } ?>
<?php if (($totalRows_log != 0) == ($view == "limited")) { ?>
<table class="dataTable">
 <tr>
 		<td colspan="16" align="right" class="dataHeadingList"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_update_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update" class="radiobutton" value="Update"></td>
   	</tr>
 <tr>
  <td class="dataHeadingList">Name&nbsp;<a href="index.php?action=list&dbTable=recipes&sort=brewName&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewName&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <td class="dataHeadingList">Style&nbsp;<a href="index.php?action=list&dbTable=recipes&sort=brewStyle&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewStyle&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <td class="dataHeadingList">Method&nbsp;<a href="index.php?action=list&dbTable=recipes&sort=brewMethod&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewMethod&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
  <td class="dataHeadingList">Brewer ID<a href="index.php?action=list&dbTable=recipes&sort=brewBrewerID&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewBrewerID&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <?php } if ($row_user['userLevel'] == "1") { ?>
  <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>star.png" align="absmiddle" border="0" alt="<?php echo $row_pref['menuRecipes']; ?> Featured?" title="<?php echo $row_pref['menuRecipes']; ?> Featured?"></td>
  <?php } ?>
  <td class="data_icon_list"><img src="<?php echo $imageSrc; ?>lock.png" align="absmiddle" border="0" alt="<?php echo $row_pref['menuRecipes']; ?> Archived?" title="<?php echo $row_pref['menuRecipes']; ?> Archived?"></td>
  <td colspan="<?php if (!checkmobile()) echo "8"; else echo "6" ?>" class="dataHeadingList">Actions</td>
  <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
 </tr>
 <?php do { ?>
 <input type="hidden" name="id[]" value="<?php echo $row_log['id']; ?>" />
 <tr <?php echo " style=\"background-color:$color\"";?>>
  <td class="dataList"><?php echo $row_log['brewName']; ?></td>
  <td class="dataList"><?php echo $row_log['brewStyle']; ?></td>
  <td class="dataList"><?php echo $row_log['brewMethod']; ?></td>
  <?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
  <td class="dataList"><a href="index.php?action=list&dbTable=recipes&filter=<?php echo $row_log['brewBrewerID']; ?>"><?php echo $row_log['brewBrewerID']; ?></a></td>
  <?php } if ($row_user['userLevel'] == "1") { ?>
  <td class="data_icon_list"><input id="brewFeatured" name="brewFeatured<?php echo $row_log['id']; ?>" type="checkbox" value="Y" <?php if ($row_log['brewFeatured'] == "Y") echo "checked"; else ""; ?> /></td>
  <?php } ?>
  <td class="data_icon_list"><input id="brewArchive" name="brewArchive<?php echo $row_log['id']; ?>" type="checkbox" value="Y" <?php if ($row_log['brewArchive'] == "Y") echo "checked"; else ""; ?> /></td>
  <td class="data_icon_list"><a href="../index.php?page=recipeDetail&id=<?php echo $row_log['id']; if ($row_pref['mode'] == "2") echo "&filter=".$row_log['brewBrewerID'];  ?>"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View <?php echo $row_log['brewName']; ?>" title="View <?php echo $row_log['brewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="index.php?action=reuse&dbTable=recipes&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Copy <?php echo $row_log['brewName']; ?>" title="Copy <?php echo $row_log['brewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="index.php?action=import&dbTable=brewing&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>page_lightning.png" align="absmiddle" border="0" alt="Import <?php echo $row_log['brewName']; ?> to BrewBlog" title="Import <?php echo $row_log['brewName']; ?> to BrewBlog"></a></td>
  <td class="data_icon_list"><a href="index.php?action=edit&dbTable=recipes&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_log['brewName']; ?>" title="Edit <?php echo $row_log['brewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=recipes','id',<?php echo $row_log['id']; ?>,'Are you sure you want to delete this recipe?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_log['brewName']; ?>" title="Delete <?php echo $row_log['brewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="index.php?action=calculate&source=recipes&results=false<?php if ($row_user['userLevel'] == "1") echo "&filter=".$row_log['brewBrewerID']; elseif (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) echo "&filter=".$loginUsername; else echo ""; ?>&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>calculator.png" align="absmiddle" border="0" alt="Recalculate <?php echo $row_log['brewName']; ?>" title="Recalculate <?php echo $row_log['brewName']; ?>"></a></td>		 
  <td class="data_icon_list"><a href="index.php?action=add&dbTable=awards&assoc=recipes<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) echo "&filter=".$row_log['brewBrewerID']; elseif (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) echo "&filter=".$loginUsername; else echo ""; ?>&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>medal_gold_3.png" align="absmiddle" border="0" alt="Add an award/contest entry for <?php echo $row_log['brewName']; ?>" title="Add an award/contest entry for <?php echo $row_log['brewName']; ?>"></a></td>		 
  <?php if (!checkmobile()) { ?>
  <td class="data_icon_list"><a href="#" onclick="window.open('../includes/output_beer_xml.inc.php?id=<?php echo $row_log['id']; ?>&source=recipe&brewStyle=<?php echo $row_log['brewStyle']; ?>','','height=1,width=1, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc; ?>page_white_code.png" title="Download BeerXML" align="absmiddle" border="0" /></a>    
  <td class="data_icon_list"><?php if ($printBrowser == "IE") { ?><a href="#" onClick="window.open('../sections/print.inc.php?source=recipe&dbTable=recipes&page=recipePrint&brewStyle=<?php echo $row_log['brewStyle']; ?>&id=<?php echo $row_log['id']; ?>','','height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes'); return false;"  title="Print <?php echo $row_log['brewName']; ?>"><?php } else { ?><a href="../sections/print.inc.php?source=recipe&dbTable=recipes&page=recipePrint&brewStyle=<?php echo $row_log['brewStyle']; ?>&id=<?php echo $row_log['id']; ?>&KeepThis=true&TB_iframe=true&height=450&width=700" class="thickbox"  title="Print <?php echo $row_log['brewName']; ?>"><?php } ?><img src="<?php echo $imageSrc; ?>printer.png" align="absmiddle" border="0" alt="Print the <?php echo $row_log['brewName']; ?> Recipe" title="Print the <?php echo $row_log['brewName']; ?> Recipe"></a></td>
  <?php } ?>
 </tr>
  <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_log = mysql_fetch_assoc($log)); ?>
  <tr>
   <td colspan="16" align="right" class="dataHeadingList"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_update_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update" class="radiobutton" value="Update"></td>
  </tr>
</table>
<?php } ?> 
</form>
<?php } // end if ((($row_user['userLevel'] == "2") && ($filter == $_SESSION['loginUsername'])) || ($row_user['userLevel'] == "1")) 
else include('includes/error_privileges.inc.php');
?>

<?php if (($totalRows_log != 0) && (($row_pref['mode'] == "2") && ($view == "copy"))) { ?>
<table class="dataTable">
 <tr>
  <td class="dataHeadingList">Name&nbsp;<a href="index.php?action=list&dbTable=recipes&sort=brewName&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewName&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <td class="dataHeadingList">Style&nbsp;<a href="index.php?action=list&dbTable=recipes&sort=brewStyle&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewStyle&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <td class="dataHeadingList">Method&nbsp;<a href="index.php?action=list&dbTable=recipes&sort=brewMethod&dir=ASC"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" title="Sort Ascending"></a><a href="index.php?action=list&dbTable=recipes&sort=brewMethod&dir=DESC"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" title="Sort Descending"></a></td>
  <td colspan="<?php if (!checkmobile()) echo "4"; else echo "3" ?>" class="dataHeadingList">Actions</td>
 </tr>
 <?php do { ?>
 <tr <?php echo " style=\"background-color:$color\"";?>>
  <td class="dataList"><?php echo $row_log['brewName']; ?></td>
  <td class="dataList"><?php echo $row_log['brewStyle']; ?></td>
  <td class="dataList"><?php echo $row_log['brewMethod']; ?></td>
  <td class="data_icon_list"><a href="../index.php?page=recipeDetail&id=<?php echo $row_log['id']; if ($row_pref['mode'] == "2") echo "&filter=".$row_log['brewBrewerID'];  ?>"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View <?php echo $row_log['brewName']; ?>" title="View <?php echo $row_log['brewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="index.php?action=import&dbTable=recipes&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Copy <?php echo $row_log['brewName']; ?>" title="Copy <?php echo $row_log['brewName']; ?>"></a></td>
  <td class="data_icon_list"><a href="index.php?action=import&dbTable=brewing&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>page_lightning.png" align="absmiddle" border="0" alt="Import <?php echo $row_log['brewName']; ?> to BrewBlog" title="Import <?php echo $row_log['brewName']; ?> to BrewBlog"></a></td>
  <?php if (!checkmobile()) { ?>
  <td class="data_icon_list"><a href="#" onclick="window.open('../includes/output_beer_xml.inc.php?id=<?php echo $row_log['id']; ?>&source=recipe&brewStyle=<?php echo $row_log['brewStyle']; ?>','','height=1,width=1, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc; ?>page_white_code.png" title="Download BeerXML" align="absmiddle" border="0" /></a>    
  <?php } ?>
 </tr>
  <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_log = mysql_fetch_assoc($log)); ?>
</table>
<?php } ?>

