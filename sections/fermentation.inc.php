<?php if ($row_log['brewPrimary'] != "") { ?>
<div id="headerContent">Fermentation</div>
<div id="dataContainer">
<div class="dataTable">
<table>
 <tr>
  <td class="dataLabelLeft">Primary:</td>
  <td class="data"><?php echo $row_log['brewPrimary']." days @ ".$row_log['brewPrimaryTemp']."&deg ".$row_pref['measTemp']; ?></td>
 </td>
 <?php if ($row_log['brewSecondary'] != "" ) { ?>
 <tr>
  <td class="dataLabelLeft">Secondary:</td>
  <td class="data"><?php echo $row_log['brewSecondary']." days @ ".$row_log['brewSecondaryTemp']."&deg ".$row_pref['measTemp']; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewTertiary'] != "" ) { ?>
 <tr>
  <td class="dataLabelLeft">Tertiary:</td>
  <td class="data"><?php echo $row_log['brewTertiary']." days @ "; if ($page != "recipeDetail") echo $row_log['brewTertiaryTemp']; else echo $row_log['brewTertiaryTemp']; echo "&deg ".$row_pref['measTemp']; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewLager'] != "" ) { ?>
 <tr>
  <td class="dataLabelLeft">Lager:</td>
  <td class="data"><?php echo $row_log['brewLager']." days @ ".$row_log['brewLagerTemp']."&deg ".$row_pref['measTemp']; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewAge'] != "" ) { ?>
 <tr>
  <td class="dataLabelLeft">Age:</td>
  <td class="data"><?php echo $row_log['brewAge']." days @ ".$row_log['brewAgeTemp']."&deg ".$row_pref['measTemp']; ?></td>
 </tr>
 <?php } ?>
</table>
</div>
</div>
<?php } ?>
