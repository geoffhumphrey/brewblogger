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

$brewName = $_POST['brewName'];
$efficiency = ($_POST['efficiency'] * .01);
$attenuation = ($_POST['attenuation'] * .01);
$brewYield = $_POST['brewYield'];
// $gravity = $_POST['gravity'];
$measureWeight1 = $row_pref['measWeight1']; 

// Style
$brewStyle = $_POST['brewStyle'];

$query_style1 = "SELECT * FROM styles WHERE brewStyle='$brewStyle'";
$style1 = mysql_query($query_style1, $brewing);
$row_style1 = mysql_fetch_assoc($style1);


// ------------------------------ Extracts -------------------------------
$brewExtract1 = $_POST['brewExtract1'];
$brewExtract2 = $_POST['brewExtract2'];
$brewExtract3 = $_POST['brewExtract3'];
$brewExtract4 = $_POST['brewExtract4'];
$brewExtract5 = $_POST['brewExtract5'];

$brewExtract1Weight = $_POST['brewExtract1Weight'];
$brewExtract2Weight = $_POST['brewExtract2Weight'];
$brewExtract3Weight = $_POST['brewExtract3Weight'];
$brewExtract4Weight = $_POST['brewExtract4Weight'];
$brewExtract5Weight = $_POST['brewExtract5Weight'];


for($i = 1; $i <= 15; ++$i) {
	
    $query_extract = 'query_extract'.$i;
    $extract = 'extract'.$i;
    $row_extract = 'row_extract'.$i;
    $totalRows_extract = 'totalRows_extract'.$i;
	
	mysql_select_db($database_brewing, $brewing);
    $$query_extract = sprintf("SELECT extractYield, extractLovibond FROM extract WHERE extractName='%s'", $_POST['brewExtract'.$i]);
    $$extract = mysql_query($$query_extract, $brewing);
    $$row_extract = mysql_fetch_assoc($$extract);
    $$totalRows_extract = mysql_num_rows($$extract);
}

mysql_select_db($database_brewing, $brewing);

$query_extractPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract1['extractYield']);
$extractPPG1 = mysql_query($query_extractPPG1, $brewing);
$row_extractPPG1 = mysql_fetch_assoc($extractPPG1);

$query_extractPPG2 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract2['extractYield']);
$extractPPG2 = mysql_query($query_extractPPG2, $brewing);
$row_extractPPG2 = mysql_fetch_assoc($extractPPG2);

$query_extractPPG3 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract3['extractYield']);
$extractPPG3 = mysql_query($query_extractPPG3, $brewing);
$row_extractPPG3 = mysql_fetch_assoc($extractPPG3);

$query_extractPPG4 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract4['extractYield']);
$extractPPG4 = mysql_query($query_extractPPG4, $brewing);
$row_extractPPG4 = mysql_fetch_assoc($extractPPG4);

$query_extractPPG5 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract5['extractYield']);
$extractPPG5 = mysql_query($query_extractPPG5, $brewing);
$row_extractPPG5 = mysql_fetch_assoc($extractPPG5);

// ------------------------------ Grains ---------------------------------
$brewGrain1 = $_POST['brewGrain1'];
$brewGrain2 = $_POST['brewGrain2'];
$brewGrain3 = $_POST['brewGrain3'];
$brewGrain4 = $_POST['brewGrain4'];
$brewGrain5 = $_POST['brewGrain5'];
$brewGrain6 = $_POST['brewGrain6'];
$brewGrain7 = $_POST['brewGrain7'];
$brewGrain8 = $_POST['brewGrain8'];
$brewGrain9 = $_POST['brewGrain9'];
$brewGrain10 = $_POST['brewGrain10'];
$brewGrain11 = $_POST['brewGrain11'];
$brewGrain12 = $_POST['brewGrain12'];
$brewGrain13 = $_POST['brewGrain13'];
$brewGrain14 = $_POST['brewGrain14'];
$brewGrain15 = $_POST['brewGrain15'];

$brewGrain1Weight = $_POST['brewGrain1Weight'];
$brewGrain2Weight = $_POST['brewGrain2Weight'];
$brewGrain3Weight = $_POST['brewGrain3Weight'];
$brewGrain4Weight = $_POST['brewGrain4Weight'];
$brewGrain5Weight = $_POST['brewGrain5Weight'];
$brewGrain6Weight = $_POST['brewGrain6Weight'];
$brewGrain7Weight = $_POST['brewGrain7Weight'];
$brewGrain8Weight = $_POST['brewGrain8Weight'];
$brewGrain9Weight = $_POST['brewGrain9Weight'];
$brewGrain10Weight = $_POST['brewGrain10Weight'];
$brewGrain11Weight = $_POST['brewGrain11Weight'];
$brewGrain12Weight = $_POST['brewGrain12Weight'];
$brewGrain13Weight = $_POST['brewGrain13Weight'];
$brewGrain14Weight = $_POST['brewGrain14Weight'];
$brewGrain15Weight = $_POST['brewGrain15Weight'];

for($i = 1; $i <= 15; ++$i) {
	
    $query_grain = 'query_grain'.$i;
    $grain = 'grain'.$i;
    $row_grain = 'row_grain'.$i;
    $totalRows_grain = 'totalRows_grain'.$i;
	
	mysql_select_db($database_brewing, $brewing);
    $$query_grain = sprintf("SELECT maltYield, maltLovibond FROM malt WHERE maltName='%s'", $_POST['brewGrain'.$i]);
    $$grain = mysql_query($$query_grain, $brewing);
    $$row_grain = mysql_fetch_assoc($$grain);
    $$totalRows_grain = mysql_num_rows($$grain);
}

mysql_select_db($database_brewing, $brewing);
$query_grainPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain1['maltYield']);
$grainPPG1 = mysql_query($query_grainPPG1, $brewing);
$row_grainPPG1 = mysql_fetch_assoc($grainPPG1);

$query_grainPPG2 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain2['maltYield']);
$grainPPG2 = mysql_query($query_grainPPG2, $brewing);
$row_grainPPG2 = mysql_fetch_assoc($grainPPG2);

$query_grainPPG3 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain3['maltYield']);
$grainPPG3 = mysql_query($query_grainPPG3, $brewing);
$row_grainPPG3 = mysql_fetch_assoc($grainPPG3);

$query_grainPPG4 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain4['maltYield']);
$grainPPG4 = mysql_query($query_grainPPG4, $brewing);
$row_grainPPG4 = mysql_fetch_assoc($grainPPG4);

$query_grainPPG5 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain5['maltYield']);
$grainPPG5 = mysql_query($query_grainPPG5, $brewing);
$row_grainPPG5 = mysql_fetch_assoc($grainPPG5);

$query_grainPPG6 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain6['maltYield']);
$grainPPG6 = mysql_query($query_grainPPG6, $brewing);
$row_grainPPG6 = mysql_fetch_assoc($grainPPG6);

$query_grainPPG7 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain7['maltYield']);
$grainPPG7 = mysql_query($query_grainPPG7, $brewing);
$row_grainPPG7 = mysql_fetch_assoc($grainPPG7);

$query_grainPPG8 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain8['maltYield']);
$grainPPG8 = mysql_query($query_grainPPG8, $brewing);
$row_grainPPG8 = mysql_fetch_assoc($grainPPG8);

$query_grainPPG9 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain9['maltYield']);
$grainPPG9 = mysql_query($query_grainPPG9, $brewing);
$row_grainPPG9 = mysql_fetch_assoc($grainPPG9);

$query_grainPPG10 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain10['maltYield']);
$grainPPG10 = mysql_query($query_grainPPG10, $brewing);
$row_grainPPG10 = mysql_fetch_assoc($grainPPG10);

$query_grainPPG11 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain11['maltYield']);
$grainPPG11 = mysql_query($query_grainPPG11, $brewing);
$row_grainPPG11 = mysql_fetch_assoc($grainPPG11);

$query_grainPPG12 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain12['maltYield']);
$grainPPG12 = mysql_query($query_grainPPG12, $brewing);
$row_grainPPG12 = mysql_fetch_assoc($grainPPG12);

$query_grainPPG13 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain13['maltYield']);
$grainPPG13 = mysql_query($query_grainPPG13, $brewing);
$row_grainPPG13 = mysql_fetch_assoc($grainPPG13);

$query_grainPPG14 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain14['maltYield']);
$grainPPG14 = mysql_query($query_grainPPG14, $brewing);
$row_grainPPG14 = mysql_fetch_assoc($grainPPG14);

$query_grainPPG15 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain15['maltYield']);
$grainPPG15 = mysql_query($query_grainPPG15, $brewing);
$row_grainPPG15 = mysql_fetch_assoc($grainPPG15);


// ------------------------------ Adjuncts -------------------------------
$brewAdjunct1 = $_POST['brewAdjunct1'];
$brewAdjunct2 = $_POST['brewAdjunct2'];
$brewAdjunct3 = $_POST['brewAdjunct3'];
$brewAdjunct4 = $_POST['brewAdjunct4'];
$brewAdjunct5 = $_POST['brewAdjunct5'];
$brewAdjunct6 = $_POST['brewAdjunct6'];
$brewAdjunct7 = $_POST['brewAdjunct7'];
$brewAdjunct8 = $_POST['brewAdjunct8'];
$brewAdjunct9 = $_POST['brewAdjunct9'];

$brewAdjunct1Weight = $_POST['brewAdjunct1Weight'];
$brewAdjunct2Weight = $_POST['brewAdjunct2Weight'];
$brewAdjunct3Weight = $_POST['brewAdjunct3Weight'];
$brewAdjunct4Weight = $_POST['brewAdjunct4Weight'];
$brewAdjunct5Weight = $_POST['brewAdjunct5Weight'];
$brewAdjunct6Weight = $_POST['brewAdjunct6Weight'];
$brewAdjunct7Weight = $_POST['brewAdjunct7Weight'];
$brewAdjunct8Weight = $_POST['brewAdjunct8Weight'];
$brewAdjunct9Weight = $_POST['brewAdjunct9Weight'];

$query_adjunct1 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct1'";
$adjunct1 = mysql_query($query_adjunct1, $brewing) or die(mysql_error());
$row_adjunct1 = mysql_fetch_assoc($adjunct1);

$query_adjunct1PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct1['adjunctYield']);
$adjunct1PPG = mysql_query($query_adjunct1PPG, $brewing) or die(mysql_error());
$row_adjunct1PPG = mysql_fetch_assoc($adjunct1PPG);

$query_adjunct2 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct2'";
$adjunct2 = mysql_query($query_adjunct2, $brewing) or die(mysql_error());
$row_adjunct2 = mysql_fetch_assoc($adjunct2);

$query_adjunct2PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct2['adjunctYield']);
$adjunct2PPG = mysql_query($query_adjunct2PPG, $brewing) or die(mysql_error());
$row_adjunct2PPG = mysql_fetch_assoc($adjunct2PPG);

$query_adjunct3 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct3'";
$adjunct3 = mysql_query($query_adjunct3, $brewing) or die(mysql_error());
$row_adjunct3 = mysql_fetch_assoc($adjunct3);

$query_adjunct3PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct3['adjunctYield']);
$adjunct3PPG = mysql_query($query_adjunct3PPG, $brewing) or die(mysql_error());
$row_adjunct3PPG = mysql_fetch_assoc($adjunct3PPG);

$query_adjunct4 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct4'";
$adjunct4 = mysql_query($query_adjunct4, $brewing) or die(mysql_error());
$row_adjunct4 = mysql_fetch_assoc($adjunct4);

$query_adjunct4PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct4['adjunctYield']);
$adjunct4PPG = mysql_query($query_adjunct4PPG, $brewing) or die(mysql_error());
$row_adjunct4PPG = mysql_fetch_assoc($adjunct4PPG);

$query_adjunct5 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE id='$brewAdjunct5'";
$adjunct5 = mysql_query($query_adjunct5, $brewing) or die(mysql_error());
$row_adjunct5 = mysql_fetch_assoc($adjunct5);

$query_adjunct5PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct5['adjunctYield']);
$adjunct5PPG = mysql_query($query_adjunct5PPG, $brewing) or die(mysql_error());
$row_adjunct5PPG = mysql_fetch_assoc($adjunct5PPG);

$query_adjunct6 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct6'";
$adjunct6 = mysql_query($query_adjunct6, $brewing) or die(mysql_error());
$row_adjunct6 = mysql_fetch_assoc($adjunct6);

$query_adjunct6PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct6['adjunctYield']);
$adjunct6PPG = mysql_query($query_adjunct6PPG, $brewing) or die(mysql_error());
$row_adjunct6PPG = mysql_fetch_assoc($adjunct6PPG);

$query_adjunct7 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct7'";
$adjunct7 = mysql_query($query_adjunct7, $brewing) or die(mysql_error());
$row_adjunct7 = mysql_fetch_assoc($adjunct7);

$query_adjunct7PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct7['adjunctYield']);
$adjunct7PPG = mysql_query($query_adjunct7PPG, $brewing) or die(mysql_error());
$row_adjunct7PPG = mysql_fetch_assoc($adjunct7PPG);

$query_adjunct8 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct8'";
$adjunct8 = mysql_query($query_adjunct8, $brewing) or die(mysql_error());
$row_adjunct8 = mysql_fetch_assoc($adjunct8);

$query_adjunct8PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct8['adjunctYield']);
$adjunct8PPG = mysql_query($query_adjunct8PPG, $brewing) or die(mysql_error());
$row_adjunct8PPG = mysql_fetch_assoc($adjunct8PPG);

$query_adjunct9 = "SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='$brewAdjunct9'";
$adjunct9 = mysql_query($query_adjunct9, $brewing) or die(mysql_error());
$row_adjunct9 = mysql_fetch_assoc($adjunct9);

$query_adjunct9PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct9['adjunctYield']);
$adjunct9PPG = mysql_query($query_adjunct9PPG, $brewing) or die(mysql_error());
$row_adjunct9PPG = mysql_fetch_assoc($adjunct9PPG);

// Extract Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$extract1GU = $brewExtract1Weight * $row_extractPPG1['sugarPPG'];
$extract2GU = $brewExtract2Weight * $row_extractPPG2['sugarPPG'];
$extract3GU = $brewExtract3Weight * $row_extractPPG3['sugarPPG'];
$extract4GU = $brewExtract4Weight * $row_extractPPG4['sugarPPG'];
$extract5GU = $brewExtract5Weight * $row_extractPPG5['sugarPPG'];
}

if ($row_pref['measWeight2'] == "kilograms") { 
$extract1GU = ($brewExtract1Weight * 2.2046) * $row_extractPPG1['sugarPPG'];
$extract2GU = ($brewExtract2Weight * 2.2046) * $row_extractPPG2['sugarPPG'];
$extract3GU = ($brewExtract3Weight * 2.2046) * $row_extractPPG3['sugarPPG'];
$extract4GU = ($brewExtract4Weight * 2.2046) * $row_extractPPG4['sugarPPG'];
$extract5GU = ($brewExtract5Weight * 2.2046) * $row_extractPPG5['sugarPPG'];
}

// Grain Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$grain1GU = $brewGrain1Weight * $row_grainPPG1['sugarPPG'];
$grain2GU = $brewGrain2Weight * $row_grainPPG2['sugarPPG']; 
$grain3GU = $brewGrain3Weight * $row_grainPPG3['sugarPPG']; 
$grain4GU = $brewGrain4Weight * $row_grainPPG4['sugarPPG']; 
$grain5GU = $brewGrain5Weight * $row_grainPPG5['sugarPPG']; 
$grain6GU = $brewGrain6Weight * $row_grainPPG6['sugarPPG']; 
$grain7GU = $brewGrain7Weight * $row_grainPPG7['sugarPPG']; 
$grain8GU = $brewGrain8Weight * $row_grainPPG8['sugarPPG']; 
$grain9GU = $brewGrain9Weight * $row_grainPPG9['sugarPPG']; 
$grain10GU = $brewGrain10Weight * $row_grainPPG10['sugarPPG']; 
$grain11GU = $brewGrain11Weight * $row_grainPPG11['sugarPPG']; 
$grain12GU = $brewGrain12Weight * $row_grainPPG12['sugarPPG']; 
$grain13GU = $brewGrain13Weight * $row_grainPPG13['sugarPPG']; 
$grain14GU = $brewGrain14Weight * $row_grainPPG14['sugarPPG']; 
$grain15GU = $brewGrain15Weight * $row_grainPPG15['sugarPPG']; 
}

if ($row_pref['measWeight2'] == "kilograms") { 
$grain1GU = ($brewGrain1Weight * 2.2046) * $row_grainPPG1['sugarPPG'];
$grain2GU = ($brewGrain2Weight * 2.2046) * $row_grainPPG2['sugarPPG']; 
$grain3GU = ($brewGrain3Weight * 2.2046) * $row_grainPPG3['sugarPPG']; 
$grain4GU = ($brewGrain4Weight * 2.2046) * $row_grainPPG4['sugarPPG']; 
$grain5GU = ($brewGrain5Weight * 2.2046) * $row_grainPPG5['sugarPPG']; 
$grain6GU = ($brewGrain6Weight * 2.2046) * $row_grainPPG6['sugarPPG']; 
$grain7GU = ($brewGrain7Weight * 2.2046) * $row_grainPPG7['sugarPPG']; 
$grain8GU = ($brewGrain8Weight * 2.2046) * $row_grainPPG8['sugarPPG']; 
$grain9GU = ($brewGrain9Weight * 2.2046) * $row_grainPPG9['sugarPPG']; 
$grain10GU = ($brewGrain10Weight * 2.2046) * $row_grainPPG10['sugarPPG'];
$grain11GU = ($brewGrain11Weight * 2.2046) * $row_grainPPG11['sugarPPG'];
$grain12GU = ($brewGrain12Weight * 2.2046) * $row_grainPPG12['sugarPPG'];
$grain13GU = ($brewGrain13Weight * 2.2046) * $row_grainPPG13['sugarPPG'];
$grain14GU = ($brewGrain14Weight * 2.2046) * $row_grainPPG14['sugarPPG'];
$grain15GU = ($brewGrain15Weight * 2.2046) * $row_grainPPG15['sugarPPG'];
}

// Adjunct Gravity Units
if ($row_pref['measWeight2'] == "pounds") {
$adjunct1GU = $brewAdjunct1Weight * $row_adjunct1PPG['sugarPPG'];
$adjunct2GU = $brewAdjunct2Weight * $row_adjunct2PPG['sugarPPG'];
$adjunct3GU = $brewAdjunct3Weight * $row_adjunct3PPG['sugarPPG'];
$adjunct4GU = $brewAdjunct4Weight * $row_adjunct4PPG['sugarPPG'];
$adjunct5GU = $brewAdjunct5Weight * $row_adjunct5PPG['sugarPPG'];
$adjunct6GU = $brewAdjunct6Weight * $row_adjunct6PPG['sugarPPG'];
$adjunct7GU = $brewAdjunct7Weight * $row_adjunct7PPG['sugarPPG'];
$adjunct8GU = $brewAdjunct8Weight * $row_adjunct8PPG['sugarPPG'];
$adjunct9GU = $brewAdjunct9Weight * $row_adjunct9PPG['sugarPPG'];
}

if ($row_pref['measWeight2'] == "kilograms") {
$adjunct1GU = ($brewAdjunct1Weight * 2.2046) * $row_adjunct1PPG['sugarPPG'];
$adjunct2GU = ($brewAdjunct2Weight * 2.2046) * $row_adjunct2PPG['sugarPPG'];
$adjunct3GU = ($brewAdjunct3Weight * 2.2046) * $row_adjunct3PPG['sugarPPG'];
$adjunct4GU = ($brewAdjunct4Weight * 2.2046) * $row_adjunct4PPG['sugarPPG'];
$adjunct5GU = ($brewAdjunct5Weight * 2.2046) * $row_adjunct5PPG['sugarPPG'];
$adjunct6GU = ($brewAdjunct6Weight * 2.2046) * $row_adjunct6PPG['sugarPPG'];
$adjunct7GU = ($brewAdjunct7Weight * 2.2046) * $row_adjunct7PPG['sugarPPG'];
$adjunct8GU = ($brewAdjunct8Weight * 2.2046) * $row_adjunct8PPG['sugarPPG'];
$adjunct9GU = ($brewAdjunct9Weight * 2.2046) * $row_adjunct9PPG['sugarPPG'];
}

// Total Gravity Units (GU)
$totalGU = $extract1GU + $extract2GU + $extract3GU + $extract4GU + $extract5GU + 
  $grain1GU + $grain2GU + $grain3GU + $grain4GU + $grain5GU + 
  $grain6GU + $grain7GU + $grain8GU + $grain9GU + $grain10GU + 
  $grain11GU + $grain12GU + $grain13GU + $grain14GU + $grain15GU + 
  $adjunct1GU + $adjunct2GU + $adjunct3GU + $adjunct4GU + $adjunct5GU + 
  $adjunct6GU + $adjunct7GU + $adjunct8GU + $adjunct9GU;

// Total Grist Weight
$totalGrist = 
$brewExtract1Weight + 
$brewExtract2Weight + 
$brewExtract3Weight + 
$brewExtract4Weight + 
$brewExtract5Weight + 
$brewGrain1Weight + 
$brewGrain2Weight + 
$brewGrain3Weight + 
$brewGrain4Weight + 
$brewGrain5Weight + 
$brewGrain6Weight + 
$brewGrain7Weight + 
$brewGrain8Weight + 
$brewGrain9Weight +
$brewGrain10Weight +
$brewGrain11Weight + 
$brewGrain12Weight + 
$brewGrain13Weight + 
$brewGrain14Weight + 
$brewGrain15Weight
;

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
  $brewHopsName[$i]   = $_POST['brewHopsName'][$i];
  $brewHopsWeight[$i] = $_POST['brewHopsWeight'][$i];
  $brewHopsAA[$i]     = $_POST['brewHopsAA'][$i];
  $brewHopsTime[$i]   = $_POST['brewHopsTime'][$i];
  $brewHopsForm[$i]   = $_POST['brewHopsForm'][$i];
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
    if ($brewHopsWeight[$i] && $brewHopsAA[$i]) {
      $hopsAAU[$i] = $brewHopsWeight[$i] * $brewHopsAA[$i];

      if ($brewHopsTime[$i] && $brewHopsForm[$i]) {
	$format = ($brewHopsForm[$i] == "Pellet")  ? "pellet" : "whole";

	$ibuT += calc_bitter_tinseth($brewHopsTime[$i], $og, $brewHopsAA[$i], $brewHopsWeight[$i], $brewYield, $format, $units);
	$ibuR += calc_bitter_rager($brewHopsTime[$i], $og, $brewHopsAA[$i], $brewHopsWeight[$i], $brewYield, $format, $units);
	$ibuD += calc_bitter_daniels($brewHopsTime[$i], $og, $brewHopsAA[$i], $brewHopsWeight[$i], $brewYield, $format, $units);
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


// Color (SRM)
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