<?php if (($page ==  "recipePrint") || ($page == "logPrint")) echo ""; else { if ((($row_log['brewYeast'] != "") && ($row_log['brewYeastProfile'] == "")) || (($row_log['brewYeast'] == "") && ($row_log['brewYeastProfile'] != ""))) { ?>
<div id="help"><a href="sections/reference.inc.php?section=yeast&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Yeast Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div><?php } } 
if ((($row_log['brewYeast'] != "") && ($row_log['brewYeastProfile'] == "")) || (($row_log['brewYeast'] == "") && ($row_log['brewYeastProfile'] != ""))) { ?>
<div class="headerContent">Yeast</div>
<?php if ($row_log['brewYeast'] != "") { // hide Yeast section if none listed (6) ?>
<div class="dataContainer">
<table class="dataTable">
  <td class="dataLeft">
  <?php 
  if ($row_log['brewYeastMan'] != "" ) echo $row_log['brewYeastMan']."&nbsp;"; 
  if ($row_log['brewYeast'] != "" ) echo $row_log['brewYeast']; 
  if ($row_log['brewYeastForm'] != "" ) echo "&nbsp;&mdash;&nbsp;".$row_log['brewYeastForm']; 
  if ($row_log['brewYeastAmount'] != "" ) echo "&nbsp;&mdash;&nbsp;".$row_log['brewYeastAmount']; 
  ?>
  </td>
 </tr>
</table>
</div>
<?php } // end hide Yeast (6) ?>
<?php if ($row_log['brewYeastProfile'] != "") { // show yeast profile if present 
mysql_select_db($database_brewing, $brewing);
$query_yeast_profiles = sprintf("SELECT * FROM yeast_profiles WHERE id='%s'", $row_log['brewYeastProfile']);
$yeast_profiles = mysql_query($query_yeast_profiles, $brewing) or die(mysql_error());
$row_yeast_profiles = mysql_fetch_assoc($yeast_profiles);
?>
<div class="dataContainer">
<table class="dataTable">
<?php if ($row_yeast_profiles['yeastName'] != "") { ?>
<tr>
   <td class="dataLabelLeft">Name:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastName']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastLab'] != "") { ?>
<tr>
   <td class="dataLabelLeft">Manufacturer:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastLab']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastProdID'] != "") { ?>
<tr> 
   <td class="dataLabelLeft">Product ID:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastProdID']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastType'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Type:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastType']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastFloc'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Flocculation:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastFloc']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastAtten'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Attenuation:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastAtten']; ?>%</td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastTolerance'] != "") { ?>
<tr>  
   <td class="dataLabelLeft">Alcohol Tolerance:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastTolerance']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastMinTemp'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Temperature Range:</td>
   <td class="data"><?php if ($row_pref['measTemp'] == "C") { echo round(((($row_yeast_profiles['yeastMinTemp'] - 32) / 9) * 5), 0)."&ndash;"; echo round(((($row_yeast_profiles['yeastMaxTemp'] - 32) / 9) * 5), 0); } else { echo $row_yeast_profiles['yeastMinTemp']."&ndash;".$row_yeast_profiles['yeastMaxTemp']; } ?>&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<?php } 
if ($row_log['brewYeastAmount'] != "" ) { ?>
<tr>  
   <td class="dataLabelLeft">Amount:</td>
   <td class="data"><?php echo $row_log['brewYeastAmount']; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } } ?>
