<?php
/**
 * Module: adjuncts.add-edit.php
 * Description: Allow user to add or edit adjuncts.
 */ ?>

<table class="dataTable">
  <tr>
    <td class="dataLabelLeft">Name:</td>
    <td class="data"><input type="text" name="adjunctName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctName']; ?>" size="40"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Supplier:</td>
    <td class="data"><input type="text" name="adjunctSupplier" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctSupplier']; ?>" size="40"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Origin:</td>
    <td class="data"><input type="text" name="adjunctOrigin" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctOrigin']; ?>" size="40"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Color (Low):</td>
    <td class="data"><input type="text" name="adjunctLovibondLow" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctLovibondLow']; ?>" size="5">&nbsp;&deg;L</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Color (High):</td>
    <td class="data"><input type="text" name="adjunctLovibondHigh" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctLovibondHigh']; ?>" size="5">&nbsp;&deg;L</td>
  </tr>
  <tr>
    <td class="dataLabelLeft">PPG:</td>
    <td class="data"><input type="text" name="adjunctPPG" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['adjunctPPG'] ?>" size="5"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="adjunctInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['adjunctInfo']; ?></textarea></td>
  </tr>
</table>
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>