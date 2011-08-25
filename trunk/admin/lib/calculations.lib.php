<?php 
/**
 * Module: calculations.lib.php
 * Description: This module coordinates all the calculations for the Recipe Calculator.
 *              Libs are called as needed to perform the actual calculations for
 *              IBUs, gravity, SRM, etc.
 */


// The first section here gathers the required information to 
// perform calculations from the HTML form.

// ----------------------------- General Information ---------------------
require_once (ADMIN_LIBRARY.'bitterness.lib.php');
require_once (ADMIN_LIBRARY.'color.lib.php');

$brewName       = $_POST['brewName'];
$efficiency     = ($_POST['efficiency'] * .01);
$attenuation    = ($_POST['attenuation'] * .01);
$brewYield      = $_POST['brewYield'];
$measureWeight1 = $row_pref['measWeight1'];
$mcu            = 0;
// $gravity = $_POST['gravity'];

// Style
$brewStyle    = $_POST['brewStyle'];
$query_style1 = "SELECT * FROM styles WHERE brewStyle='$brewStyle'";
$style1       = mysql_query($query_style1, $brewing);
$row_style1   = mysql_fetch_array($style1);


// ------------------------------ Extracts -------------------------------
for ($i = 0; $i < MAX_EXT; $i++) {
  $extName[$i]    = $_POST['extName'][$i];
  $extWeight[$i]  = $_POST['extWeight'][$i];

  $query          = "SELECT extractPPG, extractLovibondLow, extractLovibondHigh FROM extract where extractName='$extName[$i]'";
  $result         = mysql_query($query, $brewing) or die(mysql_error());
  $row            = mysql_fetch_array($result);
  $extPPG[$i]     = $row['extractPPG'];
  $extLovLow[$i]  = $row['extractLovibondLow'];
  $extLovHigh[$i] = $row['extractLovibondHigh'];

  $extGU[$i]      = $extWeight[$i] * $extPPG[$i];
  if ($row_pref['measWeight2'] == "kilograms") {
    $extGU[$i] *= 2.2046;
  }

  $lov = ($extLovLow[$i] + $extLovHigh[$i]) / 2;
  if ($row_pref['measWeight2'] == "pounds") {
    $mcu += $lov * $extWeight[$i] / $brewYield;
  } else {
    $mcu += $lov * $extWeight[$i] * 2.2046 / ($brewYield * .2642);
  }
}

// ------------------------------ Grains ---------------------------------
for ($i = 0; $i < MAX_GRAINS; $i++) {
  $grainName[$i]    = $_POST['grainName'][$i];
  $grainWeight[$i]  = $_POST['grainWeight'][$i];

  $query            = "SELECT maltPPG, maltLovibondLow, maltLovibondHigh FROM malt WHERE maltName='$grainName[$i]'";
  $result           = mysql_query($query, $brewing) or die(mysql_error());
  $row              = mysql_fetch_array($result);
  $grainPPG[$i]     = $row['maltPPG'];
  $grainLovLow[$i]  = $row['maltLovibondLow'];
  $grainLovHigh[$i] = $row['maltLovibondHigh'];
  
  $grainGU[$i]      = $grainWeight[$i] * $grainPPG[$i];
  if ($row_pref['measWeight2'] == "kilograms") {
    $grainGU[$i] *= 2.2046;
  }

  $lov = ($grainLovLow[$i] + $grainLovHigh[$i]) / 2;
  if ($row_pref['measWeight2'] == "pounds") {
    $mcu += $lov * $grainWeight[$i] / $brewYield;
  } else {
    $mcu += $lov * $grainWeight[$i] * 2.2046 / ($brewYield * .2642);
  }
}

// ------------------------------ Adjuncts -------------------------------
for ($i = 0; $i < MAX_ADJ; $i++) {
  $adjName[$i]    = $_POST['adjName'][$i];
  $adjWeight[$i]  = $_POST['adjWeight'][$i];

  $query          = "SELECT adjunctPPG, adjunctLovibondLow, adjunctLovibondHigh FROM adjuncts WHERE adjunctName='$adjName[$i]'";
  $result         = mysql_query($query, $brewing) or die(mysql_error());
  $row            = mysql_fetch_array($result);
  $adjPPG[$i]     = $row['adjunctPPG'];
  $adjLovLow[$i]  = $row['adjunctLovibondLow'];
  $adjLovHigh[$i] = $row['adjunctLovibondHigh'];
  
  $adjGU[$i]      = $adjWeight[$i] * $adjPPG[$i];
  if ($row_pref['measWeight2'] == "kilograms") {
    $adjGU[$i] *= 2.2046;
  }

  $lov = ($adjLovLow[$i] + $adjLovHigh[$i]) / 2;
  if ($row_pref['measWeight2'] == "pounds") {
    $mcu += $lov * $adjWeight[$i] / $brewYield;
  } else {
    $mcu += $lov * $adjWeight[$i] * 2.2046 / ($brewYield * .2642);
  }
}

// Total Gravity Units (GU) and grist weight.
$totalGU    = 0;
$totalGrist = 0;

for ($i = 0; $i < MAX_GRAINS; $i++) {
  $totalGU    += $grainGU[$i];
  $totalGrist += $grainWeight[$i];
 }

for ($i = 0; $i < MAX_EXT; $i++) {
  $totalGU    += $extGU[$i];
  $totalGrist += $extWeight[$i];
}

for ($i = 0; $i < MAX_ADJ; $i++) {
  $totalGU += $adjGU[$i];
}

// Original Gravity
if ($row_pref['measFluid2'] == "gallons") { 
$og = ((($efficiency * $totalGU) / $brewYield) / 1000) + 1;
}

if ($row_pref['measFluid2'] == "liters") { 
$og = ((($efficiency * $totalGU) / ($brewYield * .2642)) / 1000) + 1;
}

// Final Gravity
$fg1 = ((($og - 1) * 1000) * $attenuation);
$fg = ((($og - 1) * 1000) - $fg1) * .001 + 1;

// Degrees Plato Calculation
$plato_i = (-463.37) + (668.72 * $og) - (205.35 * ($og * $og));
$plato_f = (-463.37) + (668.72 * $fg) - (205.35 * ($fg * $fg));

// Calculate Real Extract
$real_extract = (0.1808 * $plato_i) + (0.8192 * $plato_f);

// Apparent Attenuation
$aa = (1 - ($plato_f / $plato_i)) * 100;

// Real Attenuation
$ra = (1 - ($real_extract / $plato_i)) * 100;

// Alcohol by Volume (returns percentage such as 5.2%)
$abv = (($og - $fg ) / .75) * 100;

// Alcohol by Weight
$abw = ((0.79 * $abv) / $fg);

// Calories (12 ounces)
$calories = (((6.9 * $abw) + 4.0 * ($real_extract - 0.1)) * $fg * 3.55);


// ------------------------------ Hops -----------------------------------
for ($i = 0; $i < MAX_HOPS; $i++) {
  $hopsName[$i]   = $_POST['hopsName'][$i];
  $hopsWeight[$i] = $_POST['hopsWeight'][$i];
  $hopsAA[$i]     = $_POST['hopsAA'][$i];
  $hopsTime[$i]   = $_POST['hopsTime'][$i];
  $hopsForm[$i]   = $_POST['hopsForm'][$i];
}

// ------------------------------ Calculations ----------------------------------- //

$units    = ($measureWeight1 == "grams") ? "metric" : "us";
$ibuT     = 0;
$ibuD     = 0;
$ibuG     = 0;
$ibuR     = 0;
$ibuAvg   = 0;

if ($og > 1.000 && $brewYield > 0) {
  for ($i = 0; $i < MAX_HOPS; $i++) {
    if ($hopsWeight[$i] && $hopsAA[$i]) {
      $hopsAAU[$i] = $hopsWeight[$i] * $hopsAA[$i];

      if ($hopsTime[$i] && $hopsForm[$i]) {
	$format = ($hopsForm[$i] == "Pellet")  ? "pellet" : "whole";

	$ibuT += calc_bitter_tinseth($hopsTime[$i], $og, $hopsAA[$i], $hopsWeight[$i], $brewYield, $format, $units);
	$ibuR += calc_bitter_rager($hopsTime[$i], $og, $hopsAA[$i], $hopsWeight[$i], $brewYield, $format, $units);
	$ibuD += calc_bitter_daniels($hopsTime[$i], $og, $hopsAA[$i], $hopsWeight[$i], $brewYield, $format, $units);
	$ibuG += 0; // Not enough data to do calc properly
      }
    }
  }
}

$ibuAvg = $ibuT + $ibuR + $ibuD;
if ($ibuAvg > 0) {
  if ($ibuG > 0) {
    $ibuAvg += $ibuG;
    $ibuAvg /= 4;
  } else {
    $ibuAvg /= 3;
  }

  if ($results != "verify") {
    $bugu = $ibuAvg / (($og - 1) * 1000);
  }
}

// --------------------------- Color ------------------------------------

$srmMorey   = calc_srm_morey($mcu);
$ebcMorey   = srm_to_ebc($srmMorey);
$srmDaniels = calc_srm_daniels($mcu);
$ebcDaniels = srm_to_ebc($srmDaniels);
$srmMoser   = calc_srm_moser($mcu);
$ebcMoser   = srm_to_ebc($srmMoser);

?>