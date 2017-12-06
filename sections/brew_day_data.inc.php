<?php
$grainWeight = $totalGrain;

if (isset($_SESSION["loginUsername"])) {
	if (($row_user['defaultWaterRatio'] != "") && ($row_log['brewWaterRatio'] == "")) $thickness = $row_user['defaultWaterRatio'];
	elseif (isset($row_log['brewWaterRatio']) && $row_log['brewWaterRatio'] != "") $thickness = $row_log['brewWaterRatio'];
	else $thickness = "1.33";
	}
else $thickness = "1.33";

if ((isset($row_log['brewEquipProfile']) && $row_log['brewEquipProfile'] != "") && ($_SESSION['measFluid2'] == "gallons")) { $evapRate = round(($row_equip_profiles['equipBoilVolume'] / $row_equip_profiles['equipEvapRate']), 2) ; $equipLoss = $row_equip_profiles['equipLoss']; }
elseif ((isset($row_log['brewEquipProfile']) && $row_log['brewEquipProfile'] != "") && ($_SESSION['measFluid2'] == "liters"))  { $evapRate = round((($row_equip_profiles['equipBoilVolume'] / $row_equip_profiles['equipEvapRate']) * 3.78), 2); $equipLoss = round($row_equip_profiles['equipLoss'] * 3.78, 2); }
elseif (($_SESSION['measFluid2'] == "gallons") && (!isset($row_log['brewEquipProfile']) || $row_log['brewEquipProfile'] == "")) { $evapRate = 1.5; $equipLoss = 1; }
elseif (($_SESSION['measFluid2'] == "liters")  && (!isset($row_log['brewEquipProfile']) || $row_log['brewEquipProfile'] == "")) { $evapRate = 5.6; $equipLoss = 3.8; }
else $evapRate = 1.5;

if ($row_log['brewBoilTime'] != "") $boilTime = $row_log['brewBoilTime'];
elseif ((isset($_SESSION["loginUsername"])) && ($row_log['brewBoilTime'] == "") && ($row_user['defaultBoilTime'] == "")) $boilTime = $row_user['defaultBoilTime'];
else $boilTime = 60;

$finalBoilVol = $row_log['brewYield']; if ($action == "scale") $finalBoilVol = $row_log['brewYield'] * $scale;
$grainRetain = ($grainWeight * 0.213); if ($action == "scale") $grainRetain = (($totalGrain * $scale) * 0.213);
$grainRetainMet = ((($grainWeight * 2.204) * 0.213) * 3.78); if ($action == "scale") $grainRetainMet = (((($totalGrain * $scale) * 2.204) * 0.213) * 3.78);
$shrinkage = ($finalBoilVol / 0.96);
$evaporation = ($shrinkage / 0.95);
$evapVol = ($evapRate / 60 * $boilTime);
$runoffVol = ($finalBoilVol / 0.96 + $evapVol);
$totalWater = ($runoffVol + $grainRetain + $equipLoss);
$totalWaterMet = ($runoffVol + $grainRetainMet + $equipLoss);
$mashWater = (($grainWeight * $thickness) / 4);
$mashWaterMet = ($grainWeight * $thickness);
$spargeWater = ($totalWater - $mashWater);
$spargeWaterMet = ($totalWaterMet - $mashWaterMet);
$runoffVol = $evaporation;
$totalWater = ($runoffVol + $grainRetain);
$totalWaterMet = ($runoffVol + $grainRetainMet);
if (($action == "default") || ($action == "reset")) $mashWater = (($totalGrain * $thickness) / 4); if ($action == "scale") $mashWater = ((($totalGrain * $scale) * $thickness) / 4);
if (($action == "default") || ($action == "reset")) $mashWaterMet = ($totalGrain * 2.5); if ($action == "scale") $mashWaterMet = (($totalGrain * $scale) * 2.5);
$spargeWater = ($totalWater - $mashWater);
$spargeWaterMet = ($totalWaterMet - $mashWaterMet);

if ($row_log['brewOG'] != "") $OG = $row_log['brewOG']." / ".round((-463.37) + (668.72 * $row_log['brewOG']) - (205.35 * (pow($row_log['brewOG'],2))), 1)."&deg; P";
elseif ($row_log['brewTargetOG'] != "") $OG = $row_log['brewTargetOG']." / ".round((-463.37) + (668.72 * $row_log['brewTargetOG']) - (205.35 * (pow($row_log['brewTargetOG'],2))), 1)."&deg; P";

?>
<div class="visible-print-inline-block">
<div style="page-break-before:always;"><h2><?php echo $row_log['brewName']; ?></h2></div>
<table class="table table-bordered">
	<tbody>
	<tr>
    	<th width="35%">Date Brewed:</th>
        <td width="65%">&nbsp;</td>
    </tr>
    <tr>
    	<th>Brewer/Assistant:</th>
        <td>&nbsp;</td>
    </tr>
    </tbody>
</table>
<br><br><br>
<h3>Brew Day Data</h3>
	<table class="table table-bordered">
    <thead>
        <tr>
            <th width="20%">&nbsp;</th>
            <th width="15%">Target</th>
            <th width="15%">Actual</th>
            <th width="50%">Notes</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($row_log['brewMethod'] == "All Grain")  { ?>
        <tr>
            <th>Strike Water Amount:</th>
            <td><?php if ($_SESSION['measFluid2'] == "liters") echo round ($mashWaterMet, 1); else echo round ($mashWater, 1); ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Strike Water Temperature:</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Mash Temperature(s):</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Mash Time:</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Sparge Water Amount:</th>
            <td><?php if ($_SESSION['measFluid2'] == "liters") echo round ($spargeWaterMet, 1); else echo round ($spargeWater, 1); ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Sparge Water Temperature:</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Pre-Boil Gravity:</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Pre-Boil Amount:</th>
            <td><?php echo round ($runoffVol, 1); ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Post-Boil Amount:</th>
            <td><?php echo $finalBoilVol; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <?php } ?>
        <tr>
            <th>Boil Time:</th>
            <td><?php echo $boilTime; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>OG:</th>
            <td><?php echo $OG; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Mash PH:</th>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th>Boil PH:</th>
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
    <p class="text-center">Printed using BrewBlogger <?php echo $version; ?>, brewing log software for PHP and MySQL, available at http://www.brewblogger.net.</p>
</div>
