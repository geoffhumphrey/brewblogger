<?php if (($row_pref['mode'] == "1") || (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="2"))) { ?>
<input type="hidden" name="brewBrewerID" value="<?php echo $loginUsername; ?>">
<?php } ?>
<table class="dataTable">
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="1")) { ?>
<tr>
	 <td class="dataLabelLeft">Brewer:</td>
	 <td class="data">
	 <select name="brewBrewerID">
	 <option value=""></option>
     <?php do {  ?>
     <option value="<?php echo $row_users['user_name']; ?>" <?php if ($row_users['user_name'] == $loginUsername) echo "SELECTED"; if (($action == "edit") && (($row_users['user_name'] == $row_log['brewBrewerID']))) { echo "SELECTED"; }?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
     <?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
     </select>
     </td>
</td>
<?php } ?>
<tr>
     <td class="dataLabelLeft">Brew Name:</td>
     <td class="data"><input type="text" name="upcoming" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['upcoming']; ?>" size="32"></td>
</tr>
<tr>
      <td class="dataLabelLeft">Date:</td>
      <td class="data"><input type="text" name="upcomingDate" value="<?php if ($action == "edit") echo $row_log['upcomingDate']; else print date ( 'Y-m-d' ); ?>" size="32" onfocus="showCalendarControl(this);">&nbsp;&nbsp;Date Format: YYYY-MM-DD</td>
</tr>
<tr>
	  <td class="dataLabelLeft">Base Recipe:</td>
	  <td class="data">
	  <select name="upcomingRecipeID">
	  <option value=""></option>
    <?php do {  ?>
     <option value="<?php echo $row_recipes['id']?>" <?php if ($action == "edit") {  if (($row_log['upcomingRecipeID']) == ($row_recipes['id'])) {echo "SELECTED";} }?>><?php echo $row_recipes['brewName']?></option>
      <?php } while ($row_recipes = mysql_fetch_assoc($recipes)); $rows = mysql_num_rows($recipes); if($rows > 0) { mysql_data_seek($recipes, 0); $row_styles = mysql_fetch_assoc($recipes); } ?>
   </select>&nbsp;&nbsp;<a href="./?action=add&dbTable=recipes">Add?</a>
	  </td>
</tr>
</table>
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>