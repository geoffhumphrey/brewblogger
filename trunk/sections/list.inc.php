<?php if ($page != "about") { ?>
<?php
// Single User BrewBlog or Recipe List (defaults to all)
if ($row_pref['mode'] == "1") 
{ ?>
<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>book.png" align="absmiddle"></span><span class="data"><?php echo "More"; if ($page != "recipeDetail") echo " ".$row_pref['menuBrewBlogs']; else echo " ".$row_pref['menuRecipes']; ?></span></div>
  	<div id="sidebarInnerWrapper" >
      <table width="100%">
	    <?php do { 
			if ($row_list['brewArchive'] != "Y") { 
		?>
		  <tr>
    	     <td class="listLeftAlign"><?php if ($row_list['id'] != $row_log['id']) { ?><a href="<?php if ($page != "recipeDetail") echo "index.php?page=brewBlogDetail&"; else echo "index.php?page=recipeDetail&"; ?>&filter=<?php echo $row_list['brewBrewerID']; ?>&id=<?php echo $row_list['id']; if ($pg != "") echo "&pg=".$pg ?>"><?php } $str = $row_list['brewName']; if ($page != "recipeDetail") echo Truncate2($str);  else echo $str; if ($row_list['brewName'] != $row_log['brewName']) { ?></a><?php } ?></td>
		     <?php if ($page != "recipeDetail") { ?><td class="listRightAlign"><?php $date = $row_list['brewDate']; $realdate = dateconvert2($date,3); echo $realdate; ?></td><?php }  ?>
		 </tr> 
	    <?php
			}
		} while ($row_list = mysql_fetch_assoc($list)); ?>
		<tr>
			<td colspan="2"><div align="center"><?php if (($page == "recipeDetail") && ($total > $display)) { paginate($display, $pg, $total); } elseif ((($page == "brewBlogDetail") || ($page == "brewBlogCurrent")) && ($total > $display)) { paginate($display, $pg, $total); } ?></div></td>
		</tr>
	  </table>
     </div>
</div>
<?php } ?>
<?php 
// Multiple User BrewBlog or Recipe List (defaults to user's other BrewBlogs)
if ($row_pref['mode'] == "2") {
?>
<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>book.png" align="absmiddle"></span><span class="data"><?php if ($row_log['brewBrewerID'] != "") echo $row_user2['realFirstName']."'s"; else echo "Other";  if ($page != "recipeDetail") echo " ".$row_pref['menuBrewBlogs']; else echo " ".$row_pref['menuRecipes']; ?></span></div>
    <div id="sidebarInnerWrapper" >
      <table width="100%">
	    <tr>
		   <td class="listLeftAlign" <?php if ($page == "brewBlogDetail") echo "colspan=\"2\""; ?>><?php if ($page != "recipeDetail") echo " <a href=\"?page=brewBlogList&sort=brewDate&dir=DESC\">All Club ".$row_pref['menuBrewBlogs']."</a>"; else echo " <a href=\"?page=recipeList\">All Club ".$row_pref['menuRecipes']."</a>"; ?></td>
		</td>
	    <?php if ($row_log['brewBrewerID'] != "") do { 
			if ($row_list['brewArchive'] != "Y") { 
		?>
		  <tr>
    	     <td class="listLeftAlign"><?php if ($row_list['id'] != $row_log['id']) { ?><a href="<?php if ($page != "recipeDetail") echo "index.php?page=brewBlogDetail&"; else echo "index.php?page=recipeDetail&"; ?>&filter=<?php echo $row_log['brewBrewerID']; ?>&id=<?php echo $row_list['id']; if ($pg != "") echo "&pg=".$pg ?>"><?php }  $str = $row_list['brewName']; if ($page != "recipeDetail") echo Truncate2($str);  else echo $str; if ($row_list['brewName'] != $row_log['brewName']) { ?></a><?php } ?></td>
		     <?php if ($page != "recipeDetail") { ?><td class="listRightAlign"><?php $date = $row_list['brewDate']; $realdate = dateconvert2($date,3); echo $realdate; ?></td><?php }  ?>
		 </tr> 
	    <?php 
			}
		} while ($row_list = mysql_fetch_assoc($list)); ?>
		<tr>
			<td colspan="2"><div align="center"><?php if (($page == "recipeDetail") && ($total > $display)) { paginate($display, $pg, $total); } elseif ((($page == "brewBlogDetail") || ($page == "brewBlogCurrent")) && ($total > $display)) { paginate($display, $pg, $total); } ?></div></td>
		</tr>
	  </table>
     </div>
</div>
<?php } ?>
<?php } ?>


<?php if ($page == "about") {
if ((isset($_SESSION["loginUsername"])) && ($row_user['userLevel'] == "1")) { echo "<span class=\"data_icon\"><img src=\"".$imageSrc."/pencil.png\" alt=\"Edit\" border=\"0\" align=\"absmiddle\"></span><span class=\"data\"><a href=\"admin/index.php?action=edit&dbTable=brewer&id=1\"><span class=\"text_10\">Edit ".$row_name['brewerFirstName']."'s Profile</span></span></a>"; 
} ?>
<?php if ($row_name['brewerImage'] != "") { 
function getFileSizeW($file) 
	{
		$size = getimagesize($file);
		$type = $size['mime'];
		$width = $size[0];
		return $width; 
	}
$file = "label_images/".$row_name['brewerImage']; $imgW = getFileSizeW($file);
function getFileSizeH($fileH) 
	{
		$size = getimagesize($fileH);
		$type = $size['mime'];
		$height = $size[1];
		return $height; 
	}
$file = "label_images/".$row_name['brewerImage']; $imgH = getFileSizeH($file);
if (($imgH < 150) && ($imgW < 200)) $imgSize = "width=\"".$imgW."\"";

?>
<div id="sidebarWrapper">
<div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>picture.png" align="absmiddle"></span><span class="data"><?php if ($row_pref['mode'] == "1") echo $row_name['brewerFirstName']."'s Photo"; if ($row_pref['mode'] == "2") echo "Club Logo";?></span></div>
    <div id="sidebarInnerWrapper" >
    <div align="center">
	<img class="labelImage" src="label_images/<?php echo $row_name['brewerImage'];?>" <?php echo $imgSize; ?> />
	<?php if (($imgH >= 150) && ($imgW >= 200)) { ?><div id="labelImageEnlarge"><a href="label_images/<?php echo $row_name['brewerImage']; ?>" title="" class="thickbox">View Full Size</a></div><?php } ?>
    </div>
	</div>
</div>
<?php } 
if  ($row_list['brewerLinkName'] !="") {
?>
<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>link.png" align="absmiddle"></span><span class="data"><?php if (($row_pref['mode'] == "1") && ($row_name['brewerFirstName'] != "")) echo $row_name['brewerFirstName']."'s "; if ($row_pref['mode'] == "2") echo "Club "; ?>Links</span></div>
    <div id="sidebarInnerWrapper" >
      <table>
	    <?php do { ?>
		  <tr>
    	     <td class="listLeftAlign"><a href="<?php echo $row_list['brewerLinkURL']; ?>" target="blank"><?php $str3 = $row_list['brewerLinkName']; echo Truncate4($str3); ?></a></td>
		  </tr>
	    <?php } while ($row_list = mysql_fetch_assoc($list)); ?>
	  </table>
	  <tr>
			<td colspan="2"><div align="center"><?php if  ($total > $display) { paginate($display, $pg, $total); } ?></div></td>
		</tr>
     </div>
</div>
<?php } 
} ?>
