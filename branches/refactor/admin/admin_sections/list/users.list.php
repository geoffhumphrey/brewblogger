<?php if ($row_user['userLevel'] == "2") { ?><div id="RightAlign"><a href="index.php?action=edit&dbTable=users&section=password&filter=<?php echo $row_user['user_name']; ?>&id=<?php echo $row_user['id']; ?>">Change My Password</a></div><?php } ?>
<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if  ($row_user['userLevel'] == "1") include (ADMIN_INCLUDES.'list_add_link.inc.php');  
if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
    <?php if ($assoc != "default") { ?>
    <tr>
		<td class="error">The password for <?php echo $filter; ?> is now <em><?php echo $assoc; ?></em>.</td>
	</tr>
    <?php } ?>
</table>
<?php } ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">First Name</td>
	<td class="dataHeadingList">Last Name</td>
	<td class="dataHeadingList">User Name</td>
    <td class="dataHeadingList">&nbsp;</td>
	<td class="dataHeadingList">&nbsp;</td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
    <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } else echo "<td class=\"dataHeadingList\" width=\"16\">&nbsp;</td>"; ?>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList"><?php echo $row_users['realFirstName']; ?></td>
	<td class="dataList"><?php echo $row_users['realLastName']; ?></td>
	<td class="dataList" ><?php echo $row_users['user_name']; if ((($row_users['user_name'] == "nonpriv") || ($row_users['user_name'] == "admin")) && ($row_user['userLevel'] == "1")) echo "<br><span class=\"red text_9\">This is a default user name - for security reasons, you should change or delete it now!</span>" ?></td>
	<?php if (($row_user['user_name'] == $row_users['user_name']) || ($row_user['userLevel'] == "1")) { ?>
    <td class="data-icon_list"><?php if (($row_user['user_name'] == $row_users['user_name']) && ($row_user['userLevel'] == "2")) echo "Change your password: "; ?><a href="index.php?action=edit&dbTable=users&section=password&filter=<?php echo $row_users['user_name']; ?>&id=<?php echo $row_users['id']; ?>"><img src="<?php echo $imageSrc; ?>key.png" align="absmiddle" border="0" alt="Edit <?php echo $row_users['user_name']; ?>'s Password"  title="Edit <?php echo $row_users['user_name']; ?>'s Password"></a></td>
	<td class="data-icon_list"><a href="index.php?action=edit&dbTable=users&filter=<?php echo $row_users['user_name']; ?>&id=<?php echo $row_users['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_users['user_name']; ?>" title="Edit <?php echo $row_users['user_name']; ?>"></a></td>
  	<?php } else echo "<td class=\"dataList\" width=\"16\">&nbsp;</td><td class=\"dataList\" width=\"16\">&nbsp;</td>"; 
	if  (($row_user['userLevel'] == "1") && (($row_user['user_name'] != $row_users['user_name'])))  { ?>
	<td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=users','id',<?php echo $row_users['id']; ?>,'Are you sure you want to delete this user?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_users['user_name']; ?>" title="Delete <?php echo $row_users['user_name']; ?>"></a></td>
	<?php } else echo "<td class=\"dataList\" width=\"16\">&nbsp;</td>"; ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_users = mysql_fetch_assoc($users)); ?>
</table>
