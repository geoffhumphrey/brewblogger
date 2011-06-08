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
require_once 'bitterness.lib.php';

$brewName    = $_POST['brewName'];
$efficiency  = ($_POST['efficiency'] * .01);
$attenuation = ($_POST['attenuation'] * .01);
$brewYield   = $_POST['brewYield'];
// $gravity = $_POST['gravity'];
$measureWeight1 = $row_pref['measWeight1']; 

// Style
$brewStyle = $_POST['brewStyle'];

$query_style1 = "SELECT * FROM styles WHERE brewStyle='$brewStyle'";
$style1 = mysql_query($query_style1, $brewing);
$row_style1 = mysql_fetch_array($style1);


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
}

  /*
$brewExtract1 = $_POST['brewExtract1'];
$brewExtract1Weight = $_POST['brewExtract1Weight'];

for($i = 1; $i <= 15; ++$i) {
    $query_extract = 'query_extract'.$i;
    $extract = 'extract'.$i;
    $row_extract = 'row_extract'.$i;
    $totalRows_extract = 'totalRows_extract'.$i;
	
    mysql_select_db($database_brewing, $brewing);
    $$query_extract = sprintf("SELECT extractYield, extractLovibond FROM extract WHERE extractName='%s'", $_POST['brewExtract'.$i]);
    $$extract = mysql_query($$query_extract, $brewing);
    $$row_extract = mysql_fetch_array($$extract);
    $$totalRows_extract = mysql_num_rows($$extract);
}

mysql_select_db($database_brewing, $brewing);

$query_extractPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract1['extractYield']);
$extractPPG1 = mysql_query($query_extractPPG1, $brewing);
$row_extractPPG1 = mysql_fetch_array($extractPPG1);

// Extract Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$extract1GU = $brewExtract1Weight * $row_extractPPG1['sugarPPG'];
$extract5GU = $brewExtract5Weight * $row_extractPPG5['sugarPPG'];
}

if ($row_pref['measWeight2'] == "kilograms") { 
$extract1GU = ($brewExtract1Weight * 2.2046) * $row_extractPPG1['sugarPPG'];
$extract5GU = ($brewExtract5Weight * 2.2046) * $row_extractPPG5['sugarPPG'];
}
  */

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
}

/*
$brewGrain1 = $_POST['brewGrain1'];
$brewGrain15 = $_POST['brewGrain15'];

$brewGrain1Weight = $_POST['brewGrain1Weight'];
$brewGrain15Weight = $_POST['brewGrain15Weight'];

for($i = 1; $i <= 15; ++$i) {
	
    $query_grain = 'query_grain'.$i;
    $grain = 'grain'.$i;
    $row_grain = 'row_grain'.$i;
    $totalRows_grain = 'totalRows_grain'.$i;
	
    mysql_select_db($database_brewing, $brewing);
    $$query_grain = sprintf("SELECT maltYield, maltLovibond FROM malt WHERE maltName='%s'", $_POST['brewGrain'.$i]);
    $$grain = mysql_query($$query_grain, $brewing);
    $$row_grain = mysql_fetch_array($$grain);
    $$totalRows_grain = mysql_num_rows($$grain);
}

mysql_select_db($database_brewing, $brewing);
$query_grainPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain1['maltYield']);
$grainPPG1 = mysql_query($query_grainPPG1, $brewing);
$row_grainPPG1 = mysql_fetch_array($grainPPG1);

// Grain Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$grain1GU = $brewGrain1Weight * $row_grainPPG1['sugarPPG'];
$grain15GU = $brewGrain15Weight * $row_grainPPG15['sugarPPG']; 
}

if ($row_pref['measWeight2'] == "kilograms") { 
$grain1GU = ($brewGrain1Weight * 2.2046) * $row_grainPPG1['sugarPPG'];
$grain15GU = ($brewGrain15Weight * 2.2046) * $row_grainPPG15['sugarPPG'];
}
*/

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
}

/*
$brewAdjunct1 = $_POST['brewAdjunct1'];
$brewAdjunct9 = $_POST['brewAdjunct9'];

$brewAdjunct1Weight = $_POST['brewAdjunct1Weight'];
$brewAdjunct9Weight = $_POST['brewAdjunct9Weight'];


$query_adjunct1 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct1'";
$adjunct1 = mysql_query($query_adjunct1, $brewing) or die(mysql_error());
$row_adjunct1 = mysql_fetch_array($adjunct1);

$query_adjunct1PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct1['adjunctYield']);
$adjunct1PPG = mysql_query($query_adjunct1PPG, $brewing) or die(mysql_error());
$row_adjunct1PPG = mysql_fetch_array($adjunct1PPG);

// Adjunct Gravity Units
if ($row_pref['measWeight2'] == "pounds") {
$adjunct1GU = $brewAdjunct1Weight * $row_adjunct1PPG['sugarPPG'];
$adjunct9GU = $brewAdjunct9Weight * $row_adjunct9PPG['sugarPPG'];
}

if ($row_pref['measWeight2'] == "kilograms") {
$adjunct1GU = ($brewAdjunct1Weight * 2.2046) * $row_adjunct1PPG['sugarPPG'];
$adjunct9GU = ($brewAdjunct9Weight * 2.2046) * $row_adjunct9PPG['sugarPPG'];
}
*/

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

// ---- Color needs to be reworked ------
// Color (SRM)
/*
if ($row_pref['measWeight2'] == "pounds") { 
$SRM1 = ($row_extract1['extractLovibond'] * $brewExtract1Weight) / $brewYield; 
$SRM2 = ($row_extract2['extractLovibond'] * $brewExtract2Weight) / $brewYield; 
$SRM3 = ($row_extract3['extractLovibond'] * $brewExtract3Weight) / $brewYield; 
$SRM4 = ($row_extract4['extractLovibond'] * $brewExtract4Weight) / $brewYield;
$SRM5 = ($row_extract5['extractLovibond'] * $brewExtract5Weight) / $brewYield; 
$SRM6 = ($row_grain1['maltLovibond'] * $brewGrain1Weight) / $brewYield; 
$SRM7 = ($row_grain2['maltLovibond'] * $brewGrain2Weight) / $brewYield; 
$SRM8 = ($row_grain3['maltLovibond'] * $brewGrain3Weight) / $brewYield; 
$SRM9 = ($row_grain4['maltLovibond'] * $brewGrain4Weight) / $brewYield; 
$SRM10 = ($row_grain5['maltLovibond'] * $brewGrain5Weight) / $brewYield; 
$SRM11 = ($row_grain6['maltLovibond'] * $brewGrain6Weight) / $brewYield; 
$SRM12 = ($row_grain7['maltLovibond'] * $brewGrain7Weight) / $brewYield; 
$SRM13 = ($row_grain8['maltLovibond'] * $brewGrain8Weight) / $brewYield; 
$SRM14 = ($row_grain9['maltLovibond'] * $brewGrain9Weight) / $brewYield;
$SRM24 = ($row_grain10['maltLovibond'] * $brewGrain10Weight) / $brewYield; 
$SRM25 = ($row_grain11['maltLovibond'] * $brewGrain11Weight) / $brewYield; 
$SRM26 = ($row_grain12['maltLovibond'] * $brewGrain12Weight) / $brewYield; 
$SRM27 = ($row_grain13['maltLovibond'] * $brewGrain13Weight) / $brewYield; 
$SRM28 = ($row_grain14['maltLovibond'] * $brewGrain14Weight) / $brewYield; 
$SRM29 = ($row_grain15['maltLovibond'] * $brewGrain15Weight) / $brewYield;
$SRM15 = ($row_adjunct1['adjunctLovibond'] * $brewAdjunct1Weight) / $brewYield;
$SRM16 = ($row_adjunct2['adjunctLovibond'] * $brewAdjunct2Weight) / $brewYield;
$SRM17 = ($row_adjunct3['adjunctLovibond'] * $brewAdjunct3Weight) / $brewYield;
$SRM18 = ($row_adjunct4['adjunctLovibond'] * $brewAdjunct4Weight) / $brewYield;
$SRM19 = ($row_adjunct5['adjunctLovibond'] * $brewAdjunct5Weight) / $brewYield;
$SRM20 = ($row_adjunct6['adjunctLovibond'] * $brewAdjunct6Weight) / $brewYield;
$SRM21 = ($row_adjunct7['adjunctLovibond'] * $brewAdjunct7Weight) / $brewYield;
$SRM22 = ($row_adjunct8['adjunctLovibond'] * $brewAdjunct8Weight) / $brewYield;
$SRM23 = ($row_adjunct9['adjunctLovibond'] * $brewAdjunct9Weight) / $brewYield;
}

if ($row_pref['measWeight2'] == "kilograms") { 
$SRM1 = ($row_srm_extract1['extractLovibond'] * ($brewExtract1Weight * 2.2046)) / ($brewYield * .2642); 
$SRM2 = ($row_srm_extract2['extractLovibond'] * ($brewExtract2Weight * 2.2046)) / ($brewYield * .2642); 
$SRM3 = ($row_srm_extract3['extractLovibond'] * ($brewExtract3Weight * 2.2046)) / ($brewYield * .2642); 
$SRM4 = ($row_srm_extract4['extractLovibond'] * ($brewExtract4Weight * 2.2046)) / ($brewYield * .2642);
$SRM5 = ($row_srm_extract5['extractLovibond'] * ($brewExtract5Weight * 2.2046)) / ($brewYield * .2642); 
$SRM6 = ($row_grain1['maltLovibond'] * ($brewGrain1Weight * 2.2046)) / ($brewYield * .2642); 
$SRM7 = ($row_grain2['maltLovibond'] * ($brewGrain2Weight * 2.2046)) / ($brewYield * .2642); 
$SRM8 = ($row_grain3['maltLovibond'] * ($brewGrain3Weight * 2.2046)) / ($brewYield * .2642); 
$SRM9 = ($row_grain4['maltLovibond'] * ($brewGrain4Weight * 2.2046)) / ($brewYield * .2642); 
$SRM10 = ($row_grain5['maltLovibond'] * ($brewGrain5Weight * 2.2046)) / ($brewYield * .2642); 
$SRM11 = ($row_grain6['maltLovibond'] * ($brewGrain6Weight * 2.2046)) / ($brewYield * .2642); 
$SRM12 = ($row_grain7['maltLovibond'] * ($brewGrain7Weight * 2.2046)) / ($brewYield * .2642); 
$SRM13 = ($row_grain8['maltLovibond'] * ($brewGrain8Weight * 2.2046)) / ($brewYield * .2642); 
$SRM14 = ($row_grain9['maltLovibond'] * ($brewGrain9Weight * 2.2046)) / ($brewYield * .2642);
$SRM24 = ($row_grain10['maltLovibond'] * ($brewGrain10Weight * 2.2046)) / ($brewYield * .2642); 
$SRM25 = ($row_grain11['maltLovibond'] * ($brewGrain11Weight * 2.2046)) / ($brewYield * .2642);
$SRM26 = ($row_grain12['maltLovibond'] * ($brewGrain12Weight * 2.2046)) / ($brewYield * .2642); 
$SRM27 = ($row_grain13['maltLovibond'] * ($brewGrain13Weight * 2.2046)) / ($brewYield * .2642); 
$SRM28 = ($row_grain14['maltLovibond'] * ($brewGrain14Weight * 2.2046)) / ($brewYield * .2642); 
$SRM29 = ($row_grain15['maltLovibond'] * ($brewGrain15Weight * 2.2046)) / ($brewYield * .2642);
$SRM15 = ($row_adjunct1['adjunctLovibond'] * ($brewAdjunct1Weight * 2.2046)) / ($brewYield * .2642);
$SRM16 = ($row_adjunct2['adjunctLovibond'] * ($brewAdjunct2Weight * 2.2046)) / ($brewYield * .2642);
$SRM17 = ($row_adjunct3['adjunctLovibond'] * ($brewAdjunct3Weight * 2.2046)) / ($brewYield * .2642);
$SRM18 = ($row_adjunct4['adjunctLovibond'] * ($brewAdjunct4Weight * 2.2046)) / ($brewYield * .2642);
$SRM19 = ($row_adjunct5['adjunctLovibond'] * ($brewAdjunct5Weight * 2.2046)) / ($brewYield * .2642);
$SRM20 = ($row_adjunct6['adjunctLovibond'] * ($brewAdjunct6Weight * 2.2046)) / ($brewYield * .2642);
$SRM21 = ($row_adjunct7['adjunctLovibond'] * ($brewAdjunct7Weight * 2.2046)) / ($brewYield * .2642);
$SRM22 = ($row_adjunct8['adjunctLovibond'] * ($brewAdjunct8Weight * 2.2046)) / ($brewYield * .2642);
$SRM23 = ($row_adjunct9['adjunctLovibond'] * ($brewAdjunct9Weight * 2.2046)) / ($brewYield * .2642);
}

$SRMTotal = 
$SRM1 + 
$SRM2 + 
$SRM3 + 
$SRM4 + 
$SRM5 + 
$SRM6 + 
$SRM7 + 
$SRM8 + 
$SRM9 + 
$SRM10 + 
$SRM11 + 
$SRM12 + 
$SRM13 + 
$SRM14 + 
$SRM15 + 
$SRM16 + 
$SRM17 + 
$SRM18 + 
$SRM19 + 
$SRM20 + 
$SRM21 + 
$SRM22 + 
$SRM23 +
$SRM24 + 
$SRM25 + 
$SRM26 + 
$SRM27 + 
$SRM28 + 
$SRM29;
*/

// TMP amount until fix
$SRMTotal = 1;

if (($SRMTotal >= 1) && ($SRMTotal <= 11)) $SRM = $SRMTotal;
if (($SRMTotal >= 11) && ($SRMTotal < 21)) $SRM = $SRMTotal * .66;
if (($SRMTotal >= 21) && ($SRMTotal < 31)) $SRM = $SRMTotal * .51;
if (($SRMTotal >= 31) && ($SRMTotal < 41)) $SRM = $SRMTotal * .44;
if (($SRMTotal >= 41) && ($SRMTotal < 51)) $SRM = $SRMTotal * .41;
if (($SRMTotal >= 51) && ($SRMTotal < 85)) $SRM = $SRMTotal * .375;
if ($SRMTotal >= 85) $SRM = $SRMTotal * .35;

if ($row_pref['measColor'] == "EBC") { 
$EBC = (2.65 * $SRM) - 1.2;
}

// $SRM = $SRMTotal * $efficiency * .49 * 1.25;
// formula from http://www.picobrewery.com/askarchive/color.html - best one I could find.

?>