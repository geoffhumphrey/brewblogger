<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<table class="dataTable">
	<tr>
	<?php if ($row_pref['mode'] == "1") { ?>
		<td><?php if ($totalRows_upcoming > 0) { echo $row_user['realFirstName'].", there "; if ($totalRows_upcoming > 1 )  echo "are "; else echo "is ";  echo $totalRows_upcoming; if ($totalRows_upcoming > 1 ) echo " upcoming brews "; else echo " upcoming brew "; if ($filter == "all") echo "in the database.<br><br>"; else echo "under ".$row_log['brewBrewerID']."'s User ID.<br><br>"; } else echo "There are no upcoming brews found in the database.";?></tr>
	<?php } ?>
	<?php if ($row_pref['mode'] == "2") { ?>
		<td><?php if (($row_user['userLevel'] == "1") && ($totalRows_upcoming > 0))  { echo "There "; if ($totalRows_upcoming > 1 )  echo "are "; else echo "is ";  echo $totalRows_upcoming; if ($totalRows_upcoming > 1 ) echo " upcoming brews "; else echo " upcoming brew ";  echo "in the database.<br><br>"; } elseif (($row_user['userLevel'] == "2") && ($totalRows_upcoming > 0)) { echo $row_user['realFirstName'].", there "; if ($totalRows_upcoming > 1 ) echo "are "; else echo "is ";  echo $totalRows_upcoming; if ($totalRows_upcoming > 1 ) echo " upcoming brews "; else echo " upcoming brew "; echo  "in your personal database.<br><br>"; } else echo "There are no upcoming brews found in the database.<br><br>"; ?></td>
	<?php } ?>
		<td><?php include (ADMIN_INCLUDES.'list_add_link.inc.php'); ?></td>
	</tr>
</table>
<?php if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<?php if ($totalRows_upcoming != 0) { ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">Brew Name</td>
	<td class="dataHeadingList">Date</td>
	<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="1")) { ?>
	<td class="dataHeadingList">Brewer ID</td>
	<?php } 
	if ($row_upcoming['upcomingRecipeID'] != "") { ?>
    <td class="dataHeadingList">&nbsp;</td>
    <?php } ?>
    <td class="dataHeadingList">&nbsp;</td>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList" ><?php echo $row_upcoming['upcoming']; ?></td>
	<td class="dataList" ><?php if ($row_upcoming['upcomingDate'] != "")  { $date2 = $row_upcoming['upcomingDate']; $realdate = dateconvert($date2,2); echo $realdate;  } else echo "&nbsp;"; ?></a></td>
	<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="1")) { ?>
	<td class="dataList"><a href="index.php?action=list&dbTable=<?php echo $dbTable; ?>&filter=<?php echo $row_upcoming['brewBrewerID']; ?>"><?php echo $row_upcoming['brewBrewerID']; ?></a></td>
	<?php } ?>
	<?php if ($row_upcoming['upcomingRecipeID'] != "") { ?>
    <td class="data-icon_list"><a href="../index.php?page=recipeDetail&id=<?php echo $row_upcoming['upcomingRecipeID']; if ($row_pref['mode'] == "2") echo "&filter=".$row_upcoming['brewBrewerID'];  ?>"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View <?php echo $row_upcoming['upcoming']; ?>" title="View <?php echo $row_upcoming['upcoming']; ?>"></a></td>
    <?php } else { ?><td class="dataLabel">&nbsp;</td><?php } ?>
    <td class="data-icon_list"><a href="index.php?action=edit&dbTable=upcoming&id=<?php echo $row_upcoming['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_upcoming['upcoming']; ?>" title="Edit <?php echo $row_upcoming['upcoming']; ?>"></a></td>
  	<td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=upcoming','id',<?php echo $row_upcoming['id']; ?>,'Are you sure you want to delete this upcoming brew?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_upcoming['upcoming']; ?>" title="Delete <?php echo $row_upcoming['upcoming']; ?>"></a></td>
	
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_upcoming = mysql_fetch_assoc($upcoming)); ?>
</table>
<?php } ?>