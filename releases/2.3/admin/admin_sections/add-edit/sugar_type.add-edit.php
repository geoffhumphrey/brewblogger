<table>
<tr>
    <td class="dataLabelLeft">Sugar Name:</td>
    <td colspan="2" class="data"><input type="text" name="sugarName" id="sugarName" size="50" value="<?php if ($action == "edit") echo $row_log['sugarName']; ?>"></td>
  </tr>
    <td class="dataLabelLeft">PPG:</td>
    <td class="data"><input name="sugarPPG" type="text" id="sugarPPG" value="<?php if ($action == "edit") echo $row_log['sugarPPG']; ?>" size="10"></td>
    <td class="data">Also called "potential" - express here as a whole number (e.g., if potential is 1.046 the PPG is 46 - drop the 1.0)</td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>
