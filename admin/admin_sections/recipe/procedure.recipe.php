<div id="headerContentAdmin">Procedure</div>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft">Enter Step By Step Instructions:<br><br><textarea name="brewProcedure" cols="67" rows="15"><?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewProcedure']; ?></textarea></td>
</tr>
<?php if ($dbTable != "recipes") { ?>
<tr>
   <td class="dataLabelLeft"><br>Enter Special Procedures:<br><br><textarea name="brewSpecialProcedure" cols="67" rows="15" id="brewSpecialProcedure"><?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewSpecialProcedure']; ?></textarea></td>
</tr>
<?php } ?>
</table>