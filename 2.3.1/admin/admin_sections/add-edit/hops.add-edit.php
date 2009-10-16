<table class="dataTable">
<tr>
    <td class="dataLabelLeft">Name:</td>
    <td class="data"><input type="text" name="hopsName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['hopsName']; ?>" size="50"></td>
</tr>
<tr>
    <td class="dataLabelLeft">Country:</td>
    <td class="data"><input type="text" name="hopsGrown" value="<?php if ($action == "edit") echo $row_log['hopsGrown']; ?>" size="50"></td>
</tr>
<tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="hopsInfo" cols="67" rows="12"><?php if ($action == "edit") echo $row_log['hopsInfo']; ?></textarea></td>
</tr>
<tr>
    <td class="dataLabelLeft">Use:</td>
    <td class="data"><input type="text" name="hopsUse" value="<?php if ($action == "edit") echo $row_log['hopsUse']; ?>" size="50"></td>
</tr>
<tr>
    <td class="dataLabelLeft">Example(s):</td>
    <td class="data"><input type="text" name="hopsExample" value="<?php if ($action == "edit") echo $row_log['hopsExample']; ?>" size="50"></td>
</tr>
<tr>
    <td class="dataLabelLeft">AAU Low:</td>
    <td class="data"><input type="text" name="hopsAAULow" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['hopsAAULow']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft">AAU High:</td>
    <td class="data"><input type="text" name="hopsAAUHigh" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['hopsAAUHigh']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft">Subtitutions:</td>
    <td class="data"><input type="text" name="hopsSub" value="<?php if ($action == "edit") echo $row_log['hopsSub']; ?>" size="50"></td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>