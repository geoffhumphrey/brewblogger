<table class="dataTable">
<tr>
    <td class="dataLabelLeft">Link Name:</td>
    <td class="data"><input type="text" name="brewerLinkName" value="<?php if ($action == "edit") echo $row_log['brewerLinkName']; ?>" size="60">&nbsp;e.g., BrewBlogger</td>
</tr>
<tr>
    <td class="dataLabelLeft">Address:</td>
    <td class="data"><input type="text" name="brewerLinkURL" tooltipText="<?php echo $toolTip_URL; ?>" value="<?php if ($action == "edit") echo $row_log['brewerLinkURL']; ?>" size="60">&nbsp;e.g., http://www.brewblogger.net</td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>