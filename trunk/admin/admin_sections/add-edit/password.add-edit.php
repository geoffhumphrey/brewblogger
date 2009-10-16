<?php if (($row_log['user_name'] != $loginUsername) && ($row_user['userLevel'] == "2")) {  ?>
<table class="dataTable">
	<tr>
		<td class="error">Sorry, you do not have sufficient privileges to access this area.</td>
	</tr>
</table>
<?php } 
if ((($row_log['user_name'] == $loginUsername) && ($row_user['userLevel'] == "2"))  || ($row_user['userLevel'] == "1"))
{ ?>
<table class="dataTable">
	<?php if ($confirm == "false") { ?>
	<tr>
      <?php if ($msg == "1") { ?><td class="error">Sorry, that user name has been taken. Please choose another.<br><br></td><?php } ?>
	  <?php if ($msg == "2") { ?><td class="error">Sorry, the old password did not match the password in the database. Please try again.<br><br></td><?php } ?>
	</tr>
	<?php } ?>
</table>
<table class="dataTable">
<?php if ($row_user['userLevel'] == "2")  { ?>
<tr>
      <td class="dataLabelLeft" >Current Password:</td>
      <td class="data"><input type="password" name="passwordOld" size="32" value=""></td>
</tr>
<?php } ?>
<tr>
      <td class="dataLabelLeft" >New Password:</td>
      <td class="data"><input type="password" name="password" size="32" value=""></td>
</tr>
</table>
<?php if (($action == "edit") && ($filter == $loginUsername)) { ?>
<input type="hidden" name="user_name" value="<?php echo $filter; ?>">
<input type="hidden" name="userLevel" value="<?php echo $row_log['userLevel']; ?>">
<?php } ?>
<input type="hidden" name="admin" value="<?php if ($row_user['userLevel'] == "1") echo "admin"; else echo "nonpriv"; ?>">
<?php include ('includes/add_edit_buttons.inc.php'); ?>
<?php } ?>