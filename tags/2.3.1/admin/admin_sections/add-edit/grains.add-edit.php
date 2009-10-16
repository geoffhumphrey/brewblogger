<table class="dataTable">
<tr>
    <td class="dataLabelLeft">Name:</td>
    <td class="data"><input type="text" name="maltName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['maltName']; ?>" size="40"></td>
</tr>
<tr>
  <td class="dataLabelLeft">Supplier:</td>
  <td class="data"><input type="text" name="maltSupplier" tooltiptext="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['maltSupplier']; ?>" size="40" /></td>
</tr>
<tr>
  <td class="dataLabelLeft">Origin:</td>
  <td class="data"><input type="text" name="maltOrigin" tooltiptext="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['maltOrigin']; ?>" size="40" /></td>
</tr>
<tr>
    <td class="dataLabelLeft">Color:</td>
    <td class="data"><input type="text" name="maltLovibond" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['maltLovibond']; ?>" size="5">&nbsp;&deg;L</td>
</tr>
<tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="maltInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['maltInfo']; ?></textarea></td>
</tr>
<tr>
    <td class="dataLabelLeft">Type:</td>
	<td class="data">
	    <select class="text_area"  name="maltYield" id="maltYield">
        <?php do { ?>
          <option value="<?php echo $row_sugar_type['id']; ?>" <?php if ($action == "edit") { if (!(strcmp($row_log['maltYield'], $row_sugar_type['id']))) {echo "SELECTED";} }?>><?php echo $row_sugar_type['sugarName']." (".$row_sugar_type['sugarPPG']." PPG)"; ?></option>
        <?php } while ($row_sugar_type = mysql_fetch_assoc($sugar_type)); ?>
      </select>
	</td>
</table>
<input type="hidden" name="maltType" value="Grain" />
<?php include ('includes/add_edit_buttons.inc.php'); ?>