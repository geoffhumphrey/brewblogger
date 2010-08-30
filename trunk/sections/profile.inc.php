<?php 
mysql_select_db($database_brewing, $brewing);
$query_count1 = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s'", $row_members['user_name']);
$count1 = mysql_query($query_count1, $brewing) or die(mysql_error());
$row_count1 = mysql_fetch_assoc($count1);
$totalRows_count1 = mysql_num_rows($count1);

mysql_select_db($database_brewing, $brewing);
$query_count2 = sprintf("SELECT * FROM recipes WHERE brewBrewerID = '%s'", $row_members['user_name']);
$count2 = mysql_query($query_count2, $brewing) or die(mysql_error());
$row_count2 = mysql_fetch_assoc($count2);
$totalRows_count2 = mysql_num_rows($count2);

?>

<div class="dataContainer">
<table>
<?php if ($totalRows_count1 > 0) { ?>
<tr>
	<td class="data_icon"><img src="<?php echo $imageSrc; ?>book.png"></td>
	<td class="data"><a href="index.php?page=brewBlogList&filter=<?php echo $filter; ?>&sort=brewDate&dir=DESC">View <?php echo $row_members['realFirstName']; ?>'s <?php echo $row_pref['menuBrewBlogs']; ?></a></td>
</tr>
<?php } ?>
<?php if ($totalRows_count2 > 0) { ?>
<tr>
	<td class="data_icon"><img src="<?php echo $imageSrc; ?>script.png"></td>
	<td class="data"><a href="index.php?page=recipeList&filter=<?php echo $filter; ?>">View <?php echo $row_members['realFirstName']; ?>'s <?php echo $row_pref['menuRecipes']; ?></a></td>
</tr>
<?php } ?>
</table>
<table class="dataTable">
<?php if ($row_members['userInfoPrivate'] == "Y") { ?>
 <?php if ($row_members['userBrewingSince'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Brewing Since:</td>
	<td valign="top" class="data"><?php echo $row_members['userBrewingSince']; ?></td>
 </tr>
  <?php } 
  if ($row_members['userPosition'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Current Club Position:</td>
	<td valign="top" class="data"><?php echo $row_members['userPosition']; ?></td>
 </tr>
 
  <?php }
  if ($row_members['userPastPosition'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Past Club Positions:</td>
	<td valign="top" class="data"><?php echo $row_members['userPastPosition']; ?></td>
 </tr>
  <?php }
  if ($row_members['userOccupation'] != "") { ?>
   <tr>
	<td valign="top" class="dataLabelLeft">Occupation:</td>
	<td valign="top" class="data"><?php echo $row_members['userOccupation']; ?></td>
    </tr>
  <?php } 
  if ($row_members['userHometown'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Hometown:</td>
	<td valign="top" class="data"><?php echo $row_members['userHometown']; ?></td>
    </tr>
 <?php }
  if ($row_members['userFavQuote'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Favorite Quote:</td>
	<td valign="top" class="data"><?php echo $row_members['userFavQuote']; ?></td>
    </tr>
  <?php } 
  if ($row_members['userFavStyles'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Favorite Styles:</td>
	<td valign="top" class="data"><?php echo $row_members['userFavStyles']; ?></td>
    </tr>
  <?php } 
  if ($row_members['userFavCommercial'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Favorite Commercial Brew:</td>
	<td valign="top" class="data"><?php echo $row_members['userFavCommercial']; ?></td>
    </tr>
  <?php } 
  if (($row_members['userWebsiteName'] != "") && ($row_members['userWebsiteURL'] != "")) { ?>
  <tr>
	<td valign="top" class="dataLabelLeft">Personal Website:</td>
	<td valign="top" class="data"><?php echo "<a href=\"".$row_members['userWebsiteURL']."\" target=\"_blank\">".$row_members['userWebsiteName']."</a>"; ?></td>
    </tr>
  <?php } 
  if ($row_members['userProfile'] != "") { ?>
  <tr>
	<td valign="top" class="dataLabelLeft">Profile:</td>
	<td valign="top" class="data"><?php echo $row_members['userProfile']; ?></td>
    </tr>
   <?php } ?>

<?php } else { ?>
  <tr>
	<td valign="top" class="error"><?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>'s profile is not available.</td>
 </tr>
<?php } ?>
</table>
<br><br><br><br>
</div>
