<div class="headerContentAdmin">Boil</div>
<table class="dataTable">
<tr>   
   <td class="dataLabelLeft">Total Boil Time:</td>
   <td class="data"><input type="text" name="brewBoilTime" size="5" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action == "reuse")) echo $row_log['brewBoilTime']; else echo $row_user['defaultBoilTime']; ?>">&nbsp;min.</td>
</tr>
</table>