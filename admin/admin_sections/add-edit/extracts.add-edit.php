<?php
/**
 * Module: extracts.add-edit.php
 * Description: Allow user to add or edit extracts.
 */ ?>

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
    <td class="dataLabelLeft">Color (Low):</td>
    <td class="data"><input type="text" name="extractLovibondLow" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['extractLovibondLow']; ?>" size="5">&nbsp;&deg;L</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Color (High):</td>
    <td class="data"><input type="text" name="extractLovibondHigh" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['extractLovibondHigh']; ?>" size="5">&nbsp;&deg;L</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">PPG:</td>
    <td class="data"><input type="text" name="extractPPG" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['extractPPG'] ?>" size="5"></td>
  <tr>
    <td class="dataLabelLeft">Extract Form:</td>
    <td class="data">
      <select class="text_area" name="extractLME">
        <option value="1" <?php if ($action == "edit") { if ($row_log['extractLME'] == "1") echo "SELECTED"; } ?>>Liquid</option>
        <option value="0" <?php if ($action == "edit") { if ($row_log['extractLME'] == "0") echo "SELECTED"; } ?>>Dry</option>
      </select></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="extractInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['extractInfo']; ?></textarea></td>
  </tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>