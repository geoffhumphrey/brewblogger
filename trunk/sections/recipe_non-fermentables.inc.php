<?php if (($row_log['brewMisc1Name'] != "") && ($row_log['brewMisc1Amount'] != "")) { // hide entire set of misc rows if first is not present (4) ?>
<div class="headerContent"><a name="recipe" id="recipe"></a>Non-Fermentables</div>
<div class="dataContainer">
<table>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc1Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc1Name']; if ($row_log['brewMisc1Time'] !="") echo " @ ".$row_log['brewMisc1Time']." minutes"; else echo ""; if ($row_log['brewMisc1Use'] !="") echo " (".$row_log['brewMisc1Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php if ($row_log['brewMisc2Name'] != "") { ?>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc2Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc2Name']; if ($row_log['brewMisc2Time'] !="") echo " @ ".$row_log['brewMisc2Time']." minutes"; else echo ""; if ($row_log['brewMisc2Use'] !="") echo " (".$row_log['brewMisc2Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewMisc3Name'] != "") { ?>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc3Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc3Name']; if ($row_log['brewMisc3Time'] !="") echo " @ ".$row_log['brewMisc3Time']." minutes"; else echo ""; if ($row_log['brewMisc3Use'] !="") echo " (".$row_log['brewMisc3Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewMisc4Name'] != "") { ?>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc4Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc4Name']; if ($row_log['brewMisc4Time'] !="") echo " @ ".$row_log['brewMisc4Time']." minutes"; else echo ""; if ($row_log['brewMisc4Use'] !="") echo " (".$row_log['brewMisc4Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php } ?>
 <?php if ($action == "scale") { ?>
 <tr>
   <td colspan="3" class="text_9 red">* Amounts are NOT scaled in this section. Original yield is <?php echo $row_log['brewYield']."&nbsp;".$row_pref['measFluid2']; ?>. Adjust accordingly.</td>
 </tr>
 <?php } ?>
</table>
</div>
<?php } // end hide Misc  ?>


