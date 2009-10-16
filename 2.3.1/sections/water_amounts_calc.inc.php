<?php
$grainWeight = $totalGrain;
if (isset($_SESSION["loginUsername"])) { 
	if (($row_user['defaultWaterRatio'] != "") && ($row_log['brewWaterRatio'] == "")) $thickness = $row_user['defaultWaterRatio'];
	elseif ($row_log['brewWaterRatio'] != "") $thickness = $row_log['brewWaterRatio'];
	else $thickness = "1.33";
	}
else $thickness = "1.33";

if     (($row_log['brewEquipProfile'] != "") && ($row_pref['measFluid2'] == "gallons")) { $evapRate = round(($row_equip_profiles['equipBoilVolume'] / $row_equip_profiles['equipEvapRate']), 2) ; $equipLoss = $row_equip_profiles['equipLoss']; }
elseif (($row_log['brewEquipProfile'] != "") && ($row_pref['measFluid2'] == "liters"))  { $evapRate = round((($row_equip_profiles['equipBoilVolume'] / $row_equip_profiles['equipEvapRate']) * 3.78), 2); $equipLoss = round($row_equip_profiles['equipLoss'] * 3.78, 2); }
elseif (($row_pref['measFluid2'] == "gallons") && ($row_log['brewEquipProfile'] == "")) { $evapRate = 1.5; $equipLoss = 1; }
elseif (($row_pref['measFluid2'] == "liters")  && ($row_log['brewEquipProfile'] == "")) { $evapRate = 5.6; $equipLoss = 3.8; }
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

if (($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "brewBlogCurrent"))  
{
echo "<div id=\"moreInfo\">Total Grain Weight (<a href=\"#\">Water Amounts";
echo "<span>
  <div id=\"wideWrapper\">
  <div id=\"referenceHeader\">Water Amounts</div>";
  	switch ($row_pref['measFluid2']) 
	{
	case "gallons": 
	echo "<table>";
	echo "<tr><td class=\"dataLabelLeft\" nowrap>Target Final Boil Volume:</td><td colspan=\"2\" class=\"data\">".$finalBoilVol." gallons</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Evaporation Rate:</td><td colspan=\"2\" class=\"data\">".$evapRate." gallons per hour</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Boil Time:</td><td colspan=\"2\" class=\"data\">".$boilTime." minutes</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Runoff Volume Needed:</td><td class=\"data\" width=\"20%\">".round ($runoffVol, 1)." gallons</td><td class=\"data\">".$finalBoilVol." gallons (final boil volume) &divide; 0.96 (cooling) + ".round($evapVol, 1)." gallons (boil evaporation)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Amount:</td><td colspan=\"2\" class=\"data\">".round($grainWeight, 1)." pounds</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Absorbtion:</td><td colspan=\"2\" class=\"data\">".number_format($grainRetain, 1)." gallons</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Total Water Needed:</td><td class=\"data\">".round ($totalWater, 1)." gallons</td><td class=\"data\">".round ($runoffVol, 1)." gallons (runoff) + ".round ($grainRetain, 1)." gallons (grain absorbtion) + ".$equipLoss." gallons (equip. loss)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Mash Water Needed:</td><td class=\"data\">".round ($mashWater, 1)." gallons</td><td class=\"data\">based on ".$thickness." quarts per pound of grain</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Sparge Water Needed:</td><td class=\"data\">".round ($spargeWater, 1)." gallons</td><td class=\"data\">".round ($totalWater, 1)." gallons (total water)  &ndash; ".round ($mashWater, 1)." gallons (mash water)</td></tr>";
	echo "</table>";
	break;
	
	case "liters":
	echo "<table>";
	echo "<tr><td class=\"dataLabelLeft\" nowrap>Target Final Boil Volume:</td><td colspan=\"2\" class=\"data\">".$finalBoilVol." litres</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Evaporation Rate:</td><td colspan=\"2\" class=\"data\">".$evapRate." litres per hour</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Boil Time:</td><td colspan=\"2\" class=\"data\">".$boilTime." minutes</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Runoff Volume Needed:</td><td class=\"data\">".round ($runoffVol, 1)." litres</td><td class=\"data\">".$finalBoilVol." litres (final boil volume) &divide; 0.96 (cooling) + ".round($evapVol, 1)." litres (boil evaporation)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Amount:</td><td colspan=\"2\" class=\"data\">".number_format($grainWeight, 1)." kilograms</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Grain Absorbtion:</td><td class=\"data\">".round ($grainRetainMet, 1)." litres</td class=\"data\">&nbsp;</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Total Water Needed:</td><td class=\"data\">".round ($totalWaterMet, 1)." litres</td><td class=\"data\">".round ($runoffVol, 1)." litres (runoff) + ".round ($grainRetainMet, 1)." litres (grain absorbtion) + ".$equipLoss." litres (equip. loss)</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Mash Water Needed:</td><td class=\"data\">".round ($mashWaterMet, 1)." litres</td></td><td class=\"data\">based on ".$thickness." litres per kilogram of grain</td></tr>";
	echo "<tr><td class=\"dataLabelLeft\">Sparge Water Needed:</td><td class=\"data\">".round ($spargeWaterMet, 1)." litres</td><td class=\"data\">".round ($totalWaterMet, 1)." litres (total water) &ndash; ".round ($mashWaterMet, 1)." litres (mash water)</td></tr>";
	echo "</table>";
	break;
	}
echo "</div></span></a>)</div>";
}
?>