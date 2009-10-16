<?php if ($action == "edit") { ?>
<input type="hidden" name="awardBrewID" value="<?php echo $row_log['awardBrewID']; ?>">
<?php } ?>
<?php if (($action == "add") && ($id != "default")) { ?>
<input type="hidden" name="awardBrewID" value="<?php echo $id; ?>">
<?php } ?>
<?php if (($row_pref['mode'] == "1") || (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="2"))) { ?>
<input type="hidden" name="brewBrewerID" value="<?php echo $loginUsername; ?>">
<?php } ?>
<table>
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="1")) { ?>
  <tr>
    <td class="dataLabelLeft">Brewer ID:</td>
    <td class="data">
    <select name="brewBrewerID">
	<option value=""></option>
    <?php do {  ?>
    <option value="<?php echo $row_users['user_name']?>" <?php if (!(strcmp($row_users['user_name'], $row_log['brewBrewerID']))) echo "SELECTED"; ?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
    <?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
   </select>
   </td>
  </tr>
<?php } ?>
  <tr>
    <td class="dataLabelLeft">Competition Name:</td>
    <td class="data"><input name="awardContest" type="text" id="awardContest" value="<?php if ($action == "edit") echo $row_log['awardContest']; ?>" size="50">
    </td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Competition Website URL:</td>
    <td class="data"><input type="text" name="awardContestURL" id="awardContestURL" size="50" tooltipText="<?php echo $toolTip_URL; ?>" value="<?php if ($action == "edit") echo $row_log['awardContestURL']; ?>"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Competition Date:</td>
    <td class="data"><input type="text" name="awardDate" id="awardDate" size="20" value="<?php if ($action == "edit") echo $row_log['awardDate']; else echo date('Y-m-d'); ?>" onfocus="showCalendarControl(this);"></td>
  </tr>
  <?php if (($id != "default") || ($assoc != "default")) { ?>
  <tr>
    <td class="dataLabelLeft">Name of Entry:</td>
    <td class="data"><input type="text" name="awardBrewName" id="awardBrewName" size="50" value="<?php if ($action == "edit") echo $row_log['awardBrewName']; if (($action == "add") && ($id != "default")) echo $row_log['brewName']; ?>"></td>
  </tr>
  <?php } 
  if (($id == "default") && ($assoc == "brewing")) { ?>
  <tr>
    <td class="dataLabelLeft">Brew:</td>
    <td class="data">
  <select name="awardBrewID">
    <?php do {  ?>
     <option value="<?php echo $row_brewBlogs['id']; ?>"><?php echo $row_brewBlogs['brewName']." ["; echo dateconvert($row_brewBlogs['brewDate'], 2)."] "; ?></option>
      <?php } while ($row_brewBlogs = mysql_fetch_assoc($brewBlogs)); ?>
   	</select>
  	</td>
  </tr>
  <?php } 
   if (($id == "default") && ($assoc == "recipes")) { ?>
  <tr>
    <td class="dataLabelLeft">Brew:</td>
    <td class="data">
  <select name="awardBrewID">
    <?php do {  ?>
     <option value="<?php echo $row_recipes['id']; ?>"><?php echo $row_recipes['brewName']?></option>
      <?php } while ($row_recipes = mysql_fetch_assoc($recipes)); ?>
   	</select>
  	</td>
  </tr>
  <?php } ?>
  <tr>
    <td class="dataLabelLeft">Style:</td>
    <td class="data">
    <select name="awardStyle">
    <?php do {  ?>
     <option value="<?php echo $row_styles['brewStyle']; ?>" <?php if ($action == "edit") {  if (!(strcmp($row_styles['brewStyle'], $row_log['awardStyle']))) {echo "SELECTED";} } if (($action == "add") && ($id != "default")) {  if (!(strcmp($row_styles['brewStyle'], $row_log['brewStyle']))) {echo "SELECTED";} } ?>><?php echo $row_styles['brewStyle']?></option>
      <?php } while ($row_styles = mysql_fetch_assoc($styles)); $rows = mysql_num_rows($styles); if($rows > 0) { mysql_data_seek($styles, 0); $row_styles = mysql_fetch_assoc($styles); } ?>
   </select>
    </td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Place:</td>
    <td class="data">
      <select name="awardPlace" id="awardPlace">
        <option value="entry" <?php if ($action == "edit") { if ($row_log['awardPlace'] == "entry") echo "SELECTED"; } ?>>Entry Only</option>
        <option value="best" <?php if ($action == "edit") { if ($row_log['awardPlace'] == "best") echo "SELECTED"; } ?>>Best In Show</option>
	  <option value="honMen" <?php if ($action == "edit") { if ($row_log['awardPlace'] == "honMen") echo "SELECTED"; } ?>>Honorable Mention</option>
        <option value="1" <?php if ($action == "edit") { if ($row_log['awardPlace'] == "1") echo "SELECTED"; } ?>>1st</option>
        <option value="2" <?php if ($action == "edit") { if ($row_log['awardPlace'] == "2") echo "SELECTED"; } ?>>2nd</option>
        <option value="3" <?php if ($action == "edit") { if ($row_log['awardPlace'] == "3") echo "SELECTED"; } ?>>3rd</option>
      </select>
    </td>
  </tr>
  <?php 
  $source1 = rtrim($row_log['awardBrewID'], "1234567890"); 
  //echo $source1;
  if (($action == "edit") && ($source1 == "b")) { 
  ?>
  <tr>
    <td class="dataLabelLeft">&nbsp;</td>
    <td class="data"><a href="../sections/add_review.inc.php?id=<?php echo ltrim($row_log['awardBrewID'], "rb"); ?>&KeepThis=true&TB_iframe=true&height=450&width=700" class="thickbox" title="Submit a Review for <?php if ($action == "edit") echo $row_log['awardBrewName']; if ($action == "add") echo $row_log['brewName']; ?>">Add Judge's Comments</a></td>
  </tr>
  <?php } ?>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>