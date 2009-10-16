<table class="dataTable">
<tr>
    <td class="dataLabelLeft">Name:</td>
    <td class="data"><input type="text" name="extractName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['extractName']; ?>" size="40"></td>
</tr>
<tr>
  <td class="dataLabelLeft">Supplier:</td>
  <td class="data"><input type="text" name="extractSupplier" tooltiptext="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['extractSupplier']; ?>" size="40" /></td>
</tr>
<tr>
  <td class="dataLabelLeft">Origin:</td>
  <td class="data"><input type="text" name="extractOrigin" tooltiptext="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['extractOrigin']; ?>" size="40" /></td>
</tr>
<tr>
    <td class="dataLabelLeft">Color:</td>
    <td class="data"><input type="text" name="extractLovibond" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['extractLovibond']; ?>" size="5">&nbsp;&deg;L</td>
</tr>
<tr>
    <td class="dataLabelLeft">Fermentable Type:</td>
	<td class="data">
	    <select class="text_area" name="extractType">
          <option value="Extract" <?php if ($action == "edit") { if (!(strcmp($row_log['extractType'], "Extract"))) echo "SELECTED"; } ?>>Liquid Extract</option>
       	  <option value="Dry Extract" <?php if ($action == "edit") { if (!(strcmp($row_log['extractType'], "Dry Extract"))) echo "SELECTED"; } ?>>Dry Extract</option>
        </select>	</td>
</tr>

<tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="extractInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['extractInfo']; ?></textarea></td>
</tr>
<tr>
    <td class="dataLabelLeft">Type:</td>
	<td class="data">
	    <select class="text_area" name="extractYield">
          <?php do { ?>
          <option value="<?php echo $row_sugar_type['id']; ?>" <?php if ($action == "edit") { if (!(strcmp($row_log['extractYield'], $row_sugar_type['id']))) {echo "SELECTED";} }?>><?php echo $row_sugar_type['sugarName']." (".$row_sugar_type['sugarPPG']." PPG)"; ?></option>
          <?php } while ($row_sugar_type = mysql_fetch_assoc($sugar_type)); ?>
      </select>	</td>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>