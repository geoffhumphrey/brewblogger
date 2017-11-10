<?php
$grainWeight = $totalGrain;
if (isset($_SESSION["loginUsername"])) { 
	if (($row_user['defaultWaterRatio'] != "") && ($row_log['brewWaterRatio'] == "")) $thickness = $row_user['defaultWaterRatio'];
	elseif (isset($row_log['brewWaterRatio']) && $row_log['brewWaterRatio'] != "") $thickness = $row_log['brewWaterRatio'];
	else $thickness = "1.33";
	}
else $thickness = "1.33";

if     ((isset($row_log['brewEquipProfile']) && $row_log['brewEquipProfile'] != "") && ($row_pref['measFluid2'] == "gallons")) { $evapRate = round(($row_equip_profiles['equipBoilVolume'] / $row_equip_profiles['equipEvapRate']), 2) ; $equipLoss = $row_equip_profiles['equipLoss']; }
elseif ((isset($row_log['brewEquipProfile']) && $row_log['brewEquipProfile'] != "") && ($row_pref['measFluid2'] == "liters"))  { $evapRate = round((($row_equip_profiles['equipBoilVolume'] / $row_equip_profiles['equipEvapRate']) * 3.78), 2); $equipLoss = round($row_equip_profiles['equipLoss'] * 3.78, 2); }
elseif (($row_pref['measFluid2'] == "gallons") && (!isset($row_log['brewEquipProfile']) || $row_log['brewEquipProfile'] == "")) { $evapRate = 1.5; $equipLoss = 1; }
elseif (($row_pref['measFluid2'] == "liters")  && (!isset($row_log['brewEquipProfile']) || $row_log['brewEquipProfile'] == "")) { $evapRate = 5.6; $equipLoss = 3.8; }
else $evapRate = 1.5;

if ($row_log['brewBoilTime'] != "") $boilTime = $row_log['brewBoilTime'];
elseif ((isset($_SESSION["loginUsername"])) && ($row_log['brewBoilTime'] == "") && ($row_user['defaultBoilTime'] == "")) $boilTime = $row_user['defaultBoilTime'];
else $boilTime = 60;


if (($action == "default") || ($action == "reset")) $finalBoilVol = $row_log['brewYield']; if ($action == "scale") $finalBoilVol = $row_log['brewYield'] * $scale; 
if (($action == "default") || ($action == "reset")) $grainRetain = ($grainWeight * 0.213); if ($action == "scale") $grainRetain = (($totalGrain * $scale) * 0.213);
if (($action == "default") || ($action == "reset")) $grainRetainMet = ((($grainWeight * 2.204) * 0.213) * 3.78); if ($action == "scale") $grainRetainMet = (((($totalGrain * $scale) * 2.204) * 0.213) * 3.78);
//$shrinkage = ($finalBoilVol / 0.96);
//$evaporation = ($shrinkage / 0.95);
$evapVol = ($evapRate / 60 * $boilTime);
$runoffVol = ($finalBoilVol / 0.96 + $evapVol);
$totalWater = ($runoffVol + $grainRetain + $equipLoss);
$totalWaterMet = ($runoffVol + $grainRetainMet + $equipLoss);
$mashWater = (($grainWeight * $thickness) / 4);
$mashWaterMet = ($grainWeight * $thickness);
$spargeWater = ($totalWater - $mashWater);
$spargeWaterMet = ($totalWaterMet - $mashWaterMet);
//$runoffVol = $evaporation;
//$totalWater = ($runoffVol + $grainRetain);
//$totalWaterMet = ($runoffVol + $grainRetainMet);
if (($action == "default") || ($action == "reset")) $mashWater = (($totalGrain * $thickness) / 4); if ($action == "scale") $mashWater = ((($totalGrain * $scale) * $thickness) / 4);
if (($action == "default") || ($action == "reset")) $mashWaterMet = ($totalGrain * 2.5); if ($action == "scale") $mashWaterMet = (($totalGrain * $scale) * 2.5);
$spargeWater = ($totalWater - $mashWater);
$spargeWaterMet = ($totalWaterMet - $mashWaterMet);

?>

<div class="visible-print-inline-block">
<div style="page-break-before:always;"><h2><?php echo $row_log['brewName']; ?></h2></div>
<table>
	<tbody>
	<tr>
    	<td>Date Brewed: </td>
        <td>__________________________________</td>
    </tr>
    <tr>
    	<td>Brewer/Assistant: </td>
        <td>__________________________________</td>
    </tr>
    </tbody>
</table>
<br><br><br>
<h3>Brew Day Data</h3>
	<table class="table table-bordered">
    <tbody>
	<?php if ($row_log['brewMethod'] == "All Grain")  { ?>
    <tr>
	 <td>&nbsp;</td>
	 <td>Target</td>
     <td>Actual</td>
     <td>Notes</td>
	</tr>
    <tr>
	 <td>Str Water Amt:</td>
	 <td><?php if ($row_pref['measFluid2'] == "liters") echo round ($mashWaterMet, 1); else echo round ($mashWater, 1); ?></td>
     <td>&nbsp;</td>
     <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
	<tr>
	 <td>Str Water Temp:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Mash Temp:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Mash Time:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Sp Water Amt:</td>
	 <td><?php if ($row_pref['measFluid2'] == "liters") echo round ($spargeWaterMet, 1); else echo round ($spargeWater, 1); ?></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Sp Water Temp:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Pre-Boil Grav:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Pre-Boil Amt:</td>
	 <td><?php echo round ($runoffVol, 1); ?></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
    <tr>
	 <td>Post-Boil Amt:</td>
	 <td><?php echo $finalBoilVol; ?></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<?php } ?>
	<tr>
	 <td>Boil Time:</td>
	 <td><?php echo $boilTime; ?></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>O.G.:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Mash PH:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
	<tr>
	 <td>Boil PH:</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
    <tr>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
    <tr>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
	</tr>
    </tbody>
	</table>
</div>