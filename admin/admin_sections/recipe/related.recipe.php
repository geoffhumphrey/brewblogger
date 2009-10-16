<div id="headerContentAdmin">Related Links</div>

<table class="dataTable">

<tr>

   <td class="dataLabelLeft">Link 1 Name:</td>

   <td class="data"><input name="brewLink1Name" type="text" id="brewLink1Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse") || ($action=="importRecipe") || ($action=="import")) echo $row_log['brewLink1Name']; ?>"></td>

   <td class="dataLabelLeft">Link 1 URL:</td>

   <td class="data"><input name="brewLink1" type="text" id="brewLink1" size="30" tooltipText="<?php echo $toolTip_URL; ?>" value="<?php if (($action == "edit") || ($action=="reuse") || ($action=="importRecipe") || ($action=="import")) echo $row_log['brewLink1']; ?>"></td>

</tr>

<tr>

   <td class="dataLabelLeft">Link 2 Name: </td>

   <td class="data"><input name="brewLink2Name" type="text" id="brewLink2Name" size="30" value="<?php if (($action == "edit") || ($action=="reuse") || ($action=="importRecipe") || ($action=="import")) echo $row_log['brewLink2Name']; ?>"></td>

   <td class="dataLabelLeft">Link 2 URL: </td>

   <td class="data"><input name="brewLink2" type="text" id="brewLink2" size="30" tooltipText="<?php echo $toolTip_URL; ?>" value="<?php if (($action == "edit") || ($action=="reuse") || ($action=="importRecipe") || ($action=="import")) echo $row_log['brewLink2']; ?>"></td>

</tr>

</table>