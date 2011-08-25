<?php
/**
 * Module: grains.add-edit.php
 * Description: Allow user to add or edit grains.
 */ ?>

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
    <td class="dataLabelLeft">Color (Low):</td>
    <td class="data"><input type="text" name="maltLovibondLow" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['maltLovibondLow']; ?>" size="5">&nbsp;&deg;L</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Color (High):</td>
    <td class="data"><input type="text" name="maltLovibondHigh" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['maltLovibondHigh']; ?>" size="5">&nbsp;&deg;L</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">PPG:</td>
    <td class="data"><input type="text" name="maltPPG" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['maltPPG']; ?>" size="5"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="maltInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['maltInfo']; ?></textarea></td>
  </tr>
</table>
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>