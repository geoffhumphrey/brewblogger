<?php if (($row_pref['waterDisplayMethod'] == "1") && ($row_log['brewWaterProfile'] != "")) { // Use water profiles tables ?>
<div class="headerContent">Water Profile</div>
<div class="data-container">
<h3><em><?php echo $row_water_profiles['waterName']; ?></em></h3>
<table class="dataTable">
<?php if ($row_water_profiles['waterCalcium'] != "") { ?>
<tr> 
   <td class="dataLabelLeft" width="10%">Calicum:</td>
   <td class="data"><?php echo $row_water_profiles['waterCalcium']; ?> ppm</td>
</tr>
<?php } 
if ($row_water_profiles['waterBicarbonate'] != "") {
?>
<tr> 
   <td class="dataLabelLeft" width="10%">Bicarbonate:</td>
   <td class="data"><?php echo $row_water_profiles['waterBicarbonate']; ?> ppm</td>
</tr>
<?php } 
if ($row_water_profiles['waterSulfate'] != "") {
?>
<tr> 
   <td class="dataLabelLeft" width="10%">Sulfate:</td>
   <td class="data"><?php echo $row_water_profiles['waterSulfate']; ?> ppm</td>
</tr>
<?php } 
if ($row_water_profiles['waterChloride'] != "") {
?>
<tr> 
   <td class="dataLabelLeft" width="10%">Chloride:</td>
   <td class="data"><?php echo $row_water_profiles['waterChloride']; ?> ppm</td>
</tr>
<?php } 
if ($row_water_profiles['waterSodium'] != "") {
?>
<tr>  
   <td class="dataLabelLeft" width="10%">Sodium:</td>
   <td class="data"><?php echo $row_water_profiles['waterSodium']; ?> ppm</td>
</tr>
<?php } 
if ($row_water_profiles['waterMagnesium'] != "") {
?>
<tr>   
   <td class="dataLabelLeft" width="10%">Magnesium:</td>
   <td class="data"><?php echo $row_water_profiles['waterMagnesium']; ?> ppm</td>
</tr>
<?php } 
if ($row_water_profiles['waterPH'] != "") {
?>
<tr> 
   <td class="dataLabelLeft">PH:</td>
   <td class="data"><?php echo $row_water_profiles['waterPH']; ?>%</td>
</tr>
<?php } 
if ($row_water_profiles['waterNotes'] != "") {
?>
<tr> 
   <td class="dataLabelLeft">Notes:</td>
   <td class="data"><?php echo $row_water_profiles['waterNotes']; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<?php if ($row_pref['waterDisplayMethod'] == "2") { ?>
<?php if ($row_log['brewWaterName'] != "" ) { // (1) hide entire water rows if name not present ?>
<div class="headerContent">Water Profile</div>
<div class="data-container">
<table class="dataTable">
<tr>
<td width="50%">
 <table>
 <?php if ($row_log['brewWaterName'] != "")  { ?>
 <tr>
  <td class="dataLabelLeft">Source:</td>
  <td class="dataLeft"><?php echo $row_log['brewWaterName'];  ?></td>
 </tr>
 <?php } ?>
  <?php if ($row_log['brewWaterSulfate'] != "") { ?>
 <tr>
  <td class="dataLabelLeft">Sulfate:</td>
  <td class="data"><?php echo $row_log['brewWaterSulfate']; ?>&nbsp;ppm</td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewWaterPH'] != "") {  ?>
 <tr>
  <td class="dataLabelLeft">PH:</td>
  <td class="data"><?php echo $row_log['brewWaterPH']; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewWaterCalcium'] != "") { ?>
 <tr>
  <td class="dataLabelLeft">Calcium:</td>
  <td class="data"><?php echo $row_log['brewWaterCalcium']; ?>&nbsp;ppm</td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewWaterMagnesium'] != "") {  ?>
 <tr>
  <td class="dataLabelLeft">Magnesium:</td>
  <td class="data"><?php echo $row_log['brewWaterMagnesium']; ?>&nbsp;ppm</td>
 </tr>
 <?php } ?>
 </table>
</td>

<td width="50%"> 
 <table>
 <?php if ($row_log['brewWaterAmount'] != "")  { ?>
 <tr>
  <td class="dataLabelLeft">Amount:</td>
  <td class="data"><?php echo $row_log['brewWaterAmount']; ?>&nbsp;<?php echo $row_pref['measFluid2']; ?></td>
 </tr>
 <?php } ?>

  <?php if ($row_log['brewWaterChloride'] != "") { ?>
  <tr>
  <td class="dataLabelLeft">Chloride:</td>
  <td class="data"><?php echo $row_log['brewWaterChloride']; ?>&nbsp;ppm</td>
  </tr>
  <?php }  ?>
  <?php if ($row_log['brewWaterSodium'] != "") {  ?>
  <tr>
  <td class="dataLabelLeft">Sodium:</td>
  <td class="data"><?php echo $row_log['brewWaterSodium']; ?>&nbsp;ppm</td>
  </tr>
  <?php }  ?>
  </table>
</td>
</tr>
<tr>
<td colspan="2">
 <table> 
 <?php if ($row_log['brewWaterNotes'] != "") { ?>
 <tr>
  <td class="dataLabelLeft">Notes:</td>
  <td class="data" colspan="3"><?php echo $row_log['brewWaterNotes']; ?></td>
 </tr>
 <?php } ?>
 </table>
</td>
</tr>
</table>
</div>
<?php } } ?>
