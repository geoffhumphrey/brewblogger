<?php 
if (($row_log['brewPreBoilAmt'] != "") && ($row_log['brewMashGravity'] !="") && (($page == "brewBlogCurrent") || ($page == "brewBlogDetail"))) { include (INCLUDES.'efficiency.inc.php'); }
if (($row_log['brewPreBoilAmt'] != "") && ($row_log['brewMashGravity'] !="") && ($page == "logPrint")) { include (INCLUDES.'efficiency.inc.php'); } ?>

<?php if (($row_pref['mashDisplayMethod'] == "1") && ($row_log['brewMashProfile'] != "")) { // Use mash profiles DB ?>
<div class="headerContent">Mash Profile</div>
<div class="data-container">
<h3><em><?php echo $row_mash_profiles['mashProfileName']; ?></em></h3>
<table class="dataTable">
	<tr>
    	<td class="dataLabelLeft">Grain Temperature:</td>
        <td class="data" width="15%"><?php echo $row_mash_profiles['mashGrainTemp']."&deg;".$row_pref['measTemp']; ; ?></td>
        <td class="dataLabel data" width="10%">Tun Temperature:</td>
        <td class="data"><?php echo $row_mash_profiles['mashTunTemp']."&deg;".$row_pref['measTemp']; ; ?></td>
    </tr>
    <tr>
    	<td class="dataLabelLeft">Sparge Temperature:</td>
        <td class="data"><?php echo $row_mash_profiles['mashSpargeTemp']."&deg;".$row_pref['measTemp']; ?></td>
        <td class="dataLabel data">PH:</td>
        <td class="data"><?php echo $row_mash_profiles['mashPH']; ?></td>
    </tr>
    <tr>
  		<td class="dataLabelLeft"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) { if ($row_pref['measFluid2'] == "liters") echo "PPK:"; else echo "PPG:"; } elseif ($row_log['brewPPG'] != "") { if ($row_pref['measFluid2'] == "liters") echo "PPK:"; else echo "PPG:"; } else echo ""; ?></td>
  		<td class="data"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo round ($ppg_display, 1); ?></td>
  		<td class="dataLabel data"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo "Efficiency:"; elseif ($row_log['brewEfficiency'] != "") echo "Efficiency:"; else echo ""; ?></td>
  		<td class="data"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo round ($efficiency, 1)."%"; ?></td>
 	</tr>
    <tr>
    	<td class="dataLabelLeft">Notes:</td>
        <td class="data" colspan="3"><?php echo $row_mash_profiles['mashNotes']; ?></td>
    </tr>
</table>
<?php if ($totalRows_mash_steps > 0) { ?>
<h3>Steps</h3>
<table class="dataTable">
<tr>
	<td class="dataHeadingLeft" width="5%" nowrap="nowrap">#</td>
	<td class="dataHeading" width="25%">Name</td>
    <td class="dataHeading" width="5%" nowrap="nowrap">Type</td>
    <td class="dataHeading" width="5%" nowrap="nowrap">Time</td>
    <td class="dataHeading" width="5%" nowrap="nowrap">Temp.</td>
    <td class="dataHeading" width="50%">Description</td>
</tr>
<?php do {  ?>
<tr>
	<td class="dataLeft"><?php echo $row_mash_steps['stepNumber']; ?></td>
    <td class="data"><?php echo $row_mash_steps['stepName']; ?></td>
    <td class="data"><?php echo $row_mash_steps['stepType']; ?></td>
    <td class="data" nowrap><?php echo $row_mash_steps['stepTime']; ?> min.</td>
    <td class="data" nowrap><?php if ($row_pref['measTemp'] == "C") { echo round(((($row_mash_steps['stepTemp'] - 32) / 9) * 5), 1); } else { echo round($row_mash_steps['stepTemp'], 1); } echo "&deg;".$row_pref['measTemp']; ?></td>
    <td class="data"><?php echo $row_mash_steps['stepDescription']; ?></td>
</tr>
<?php } while ($row_mash_steps = mysql_fetch_assoc($mash_steps)); ?>
</table>
<?php } ?>
</div>
<?php } 
if (($row_pref['mashDisplayMethod'] == "2") || (($row_pref['mashDisplayMethod'] == "1")  && ($row_log['brewMashProfile'] == ""))) { // unique mash profiles for every log
if ($row_log['brewMashType'] != "" ) { // hide entire set of mash rows if first is not present ?>
<div class="headerContent">Mash</div>
<div class="data-container">
<table class="dataTable">
	<tr>
	<td width="50%">
 		<table>
 			<tr>
  				<td class="dataLabelLeft">Mash Type:</td>
  				<td class="data"><?php echo $row_log['brewMashType']; ?></td>
 			</tr>
 			<?php if ($row_log['brewMashPH'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Mash PH:</td>
  				<td class="data"><?php echo $row_log['brewMashPH']; ?></td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashGrainWeight'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Grain Amt.</td>
  				<td class="data"><?php if ($action == "default") echo $row_log['brewMashGrainWeight']; if ($action == "scale") echo number_format(($row_log['brewMashGrainWeight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
 			</tr>
 			<?php } ?>
 			<tr>
  				<td class="dataLabelLeft"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) { if ($row_pref['measFluid2'] == "liters") echo "PPK:"; else echo "PPG:"; } elseif ($row_log['brewPPG'] != "") { if ($row_pref['measFluid2'] == "liters") echo "PPK:"; else echo "PPG:"; } else echo ""; ?></td>
  				<td class="data"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo round ($ppg_display, 2); else echo $row_log['brewPPG']; if ($row_log['brewEfficiency'] == "") echo ""; ?></td>
 			</tr>
 			<tr>
  				<td class="dataLabelLeft"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo "Efficiency:"; elseif ($row_log['brewEfficiency'] != "") echo "Efficiency:"; else echo ""; ?></td>
  				<td class="data"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo round ($efficiency, 2)."%"; else echo $row_log['brewEfficiency']; if ($row_log['brewEfficiency'] != "") echo "%"; else echo "";?></td>
 			</tr>
 		</table> 
	</td>
	<td width="50%">
 		<table>
 			<?php if ($row_log['brewMashGrainTemp'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Grain Temp.</td>
  				<td class="data"><?php echo $row_log['brewMashGrainTemp']."&deg; ".$row_pref['measTemp']; ?></td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashTunTemp'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Tun Temp.</td>
  				<td class="data"><?php echo $row_log['brewMashTunTemp']."&deg; ".$row_pref['measTemp']; ?></td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashSpargAmt'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Sparge Amt.</td>
  				<td class="data"><?php if ($action == "default") echo $row_log['brewMashSpargAmt']; if ($action == "scale") echo number_format(($row_log['brewMashSpargAmt'] * $scale), 2); echo "&nbsp;".$row_pref['measFluid2']; ?></td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashSpargeTemp'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Sparge Temp.</td>
  				<td class="data"><?php echo $row_log['brewMashSpargeTemp']."&deg; ".$row_pref['measTemp']; ?></td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashEquipAdjust'] != "" ) { ?>
 			<tr>
  				<td class="dataLabelLeft">Equip. Adj.?</td>
  				<td class="data"><?php echo $row_log['brewMashEquipAdjust']; ?></td>
 			</tr>
 			<?php } ?>
 		</table>
	</td>
	</tr>
	<?php if ($row_log['brewMashStep1Name'] != "" ) { ?>
	<tr>
	<td colspan="2">
 		<table width="100%">
 			<tr>
  				<td class="dataLabelLeft">Step</td>
  				<td class="dataLabel data">Description</td>
  				<td class="dataLabel data">Temp.</td>
  				<td class="dataLabel data">Time</td>
 			</tr>
 			<tr>
  				<td class="dataLeft"><?php echo $row_log['brewMashStep1Name']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep1Desc']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep1Temp']."&deg; ".$row_pref['measTemp']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep1Time']; ?>&nbsp;min.</td>
 			</tr>
 			<?php if ($row_log['brewMashStep2Name'] != "" ) { ?>
 			<tr>
  				<td class="dataLeft"><?php echo $row_log['brewMashStep2Name']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep2Desc']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep2Temp']."&deg; ".$row_pref['measTemp']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep2Time']; ?>&nbsp;min.</td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashStep3Name'] != "" ) { ?>
 			<tr>
              	<td class="dataLeft"><?php echo $row_log['brewMashStep3Name']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep3Desc']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep3Temp']."&deg; ".$row_pref['measTemp']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep3Time']; ?>&nbsp;min.</td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashStep4Name'] != "" ) { ?>
 			<tr>
  				<td class="dataLeft"><?php echo $row_log['brewMashStep4Name']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep4Desc']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep4Temp']."&deg; ".$row_pref['measTemp']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep4Time']; ?>&nbsp;min.</td>
 			</tr>
 			<?php } ?>
 			<?php if ($row_log['brewMashStep5Name'] != "" ) { ?>
 			<tr>
  				<td class="dataLeft"><?php echo $row_log['brewMashStep5Name']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep5Desc']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep5Temp']."&deg; ".$row_pref['measTemp']; ?></td>
  				<td class="data"><?php echo $row_log['brewMashStep5Time']; ?>&nbsp;min.</td>
 			</tr>
 			<?php } ?>
 		</table>
	<?php } ?>
	</td>
	</tr>
</table>
</div>
<?php }
} ?>
