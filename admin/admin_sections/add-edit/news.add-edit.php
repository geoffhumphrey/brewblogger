<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
<input type="hidden" name="newsPoster" id="newsPoster" value="<?php if ($action == "add") echo $loginUsername; if ($action == "edit") { if ($row_log['newsPoster'] != "") echo $row_log['newsPoster']; else echo $loginUsername; } ?>" />
<table>
<tr>
  <tr>
    <td class="dataLabelLeft">Date:</td>
    <td class="data"><input type="text" name="newsDate" id="newsDate" size="20" value="<?php if ($action == "edit") echo $row_log['newsDate']; else echo date('Y-m-d'); ?>"  onfocus="showCalendarControl(this);"></td>
  </tr>
    <td class="dataLabelLeft">Headline:</td>
    <td class="data"><input name="newsHeadline" type="text" id="newsHeadline" value="<?php if ($action == "edit") echo $row_log['newsHeadline']; ?>" size="50"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="newsText" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['newsText']; ?></textarea></td>
   </tr>
  <tr>
    <td class="dataLabelLeft">View:</td>
    <td class="data">
        <input name="newsPrivate" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['newsPrivate']))) {echo "CHECKED";} ?>>Public
        <input name="newsPrivate" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['newsPrivate']))) {echo "CHECKED";} if ($action == "add") echo "CHECKED"; ?>>Private (Members Only)
	</td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>
<?php } ?>
<?php 
if ($row_pref['allowNews'] == "N") echo "<span class=\"error\">This feature has been disabled by an Administrator.</span>"; 
elseif ($row_user['userLevel'] != "1") echo "<span class=\"error\">You do not have sufficient priviledges to access this area.</span>";
else echo ""; ?>
