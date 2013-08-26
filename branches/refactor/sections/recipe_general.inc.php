<?php if ($row_log['brewMethod'] != "" ) {  ?>
<div class="headerContent">General Information</div>
<div class="data-container">
    <table class="dataTable">
     <tr>
      <td class="dataLabelLeft">Method:</td>
      <td class="data"><?php echo $row_log['brewMethod'];?></td>
     </tr>
 <?php if (($page =="recipeDetail") || ($page =="recipePrint")) { ?>
   <?php if ($row_log['brewSource'] != "" ) { ?>
      <tr>
       <td class="dataLabelLeft">Source:</td>
       <td class="data"><?php echo $row_log['brewSource']; ?></td>
      </tr>
   <?php } ?>
 <?php } ?>
<?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>
   <?php if ($row_log['brewCost'] != "" ) { ?>
      <tr>
       <td class="dataLabelLeft">Cost:</td>
       <td class="data"><?php echo $row_log['brewCost']; ?></td>
      </tr>
   <?php }?>
     </table>
     <table>
   <?php if ($row_log['brewInfo'] != "" ) {  ?>
      <tr>
       <td><?php echo $row_log['brewInfo']; ?></td>
      </tr>
   <?php } ?>
<?php } ?>
</table>
</div>
<?php }  ?>
