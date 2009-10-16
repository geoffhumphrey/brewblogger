<table class="dataTable">
<tr>
    <td class="dataLabelLeft">Name:</td>
    <td class="data"><input type="text" name="adjunctName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctName']; ?>" size="40"></td>
</tr>
<tr>
    <td class="dataLabelLeft">Supplier:</td>
    <td class="data"><input type="text" name="adjunctSupplier" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctSupplier']; ?>" size="40"></td>
</td>
<tr>
    <td class="dataLabelLeft">Origin:</td>
    <td class="data"><input type="text" name="adjunctOrigin" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctOrigin']; ?>" size="40"></td>
</td>
</tr>
<tr>
    <td class="dataLabelLeft">Color:</td>
    <td class="data"><input type="text" name="adjunctLovibond" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctLovibond']; ?>" size="5">&nbsp;&deg;L</td>
</tr>
<tr>
    <td class="dataLabelLeft">Fermentable Type:</td>
	<td class="data">
	    <select class="text_area" name="adjunctType">
          <option value="Adjunct" <?php if ($action == "edit") { if (!(strcmp($row_log['adjunctType'], "Adjunct"))) echo "SELECTED"; } ?>>Adjunct</option>
       	  <option value="Grain" <?php if ($action == "edit") { if (!(strcmp($row_log['adjunctType'], "Grain"))) echo "SELECTED"; } ?>>Grain</option>
          <option value="Sugar" <?php if ($action == "edit") { if (!(strcmp($row_log['adjunctType'], "Sugar"))) echo "SELECTED"; } ?>>Sugar</option>
        </select>
	</td>
</tr>
<tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="adjunctInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['adjunctInfo']; ?></textarea></td>
</tr>
<tr>
    <td class="dataLabelLeft">Type:</td>
	<td class="data">
	    <select class="text_area" name="adjunctYield">
          <?php do { ?>
          <option value="<?php echo $row_sugar_type['id']; ?>" <?php if ($action == "edit") { if (!(strcmp($row_log['adjunctYield'], $row_sugar_type['id']))) {echo "SELECTED";} }?>><?php echo $row_sugar_type['sugarName']." (".$row_sugar_type['sugarPPG']." PPG)"; ?></option>
        <?php } while ($row_sugar_type = mysql_fetch_assoc($sugar_type)); ?>
        </select>
	</td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>