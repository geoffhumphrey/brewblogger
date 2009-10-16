<?php 
/*
The first section here gathers the required information to 
perform calculations from the HTML form.
*/
// ----------------------------- General Information ---------------------

$brewName = $_POST['brewName'];
$efficiency = ($_POST['efficiency'] * .01);
$attenuation = ($_POST['attenuation'] * .01);
$brewYield = $_POST['brewYield'];
// $gravity = $_POST['gravity'];
$measureWeight1 = $row_pref['measWeight1']; 

// Style
$brewStyle = $_POST['brewStyle'];

$query_style1 = "SELECT * FROM styles WHERE brewStyle='$brewStyle'";
$style1 = mysql_query($query_style1, $brewing) or die(mysql_error());
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

mysql_select_db($database_brewing, $brewing);
$query_extract1 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract1'";
$extract1 = mysql_query($query_extract1, $brewing) or die(mysql_error());
$row_extract1 = mysql_fetch_assoc($extract1);

$query_extract1PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract1['extractYield']);
$extract1PPG = mysql_query($query_extract1PPG, $brewing) or die(mysql_error());
$row_extract1PPG = mysql_fetch_assoc($extract1PPG);

$query_extract2 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract2'";
$extract2 = mysql_query($query_extract2, $brewing) or die(mysql_error());
$row_extract2 = mysql_fetch_assoc($extract2);

$query_extract2PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract2['extractYield']);
$extract2PPG = mysql_query($query_extract2PPG, $brewing) or die(mysql_error());
$row_extract2PPG = mysql_fetch_assoc($extract2PPG);

$query_extract3 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract3'";
$extract3 = mysql_query($query_extract3, $brewing) or die(mysql_error());
$row_extract3 = mysql_fetch_assoc($extract3);

$query_extract3PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract3['extractYield']);
$extract3PPG = mysql_query($query_extract3PPG, $brewing) or die(mysql_error());
$row_extract3PPG = mysql_fetch_assoc($extract3PPG);

$query_extract4 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract4'";
$extract4 = mysql_query($query_extract4, $brewing) or die(mysql_error());
$row_extract4 = mysql_fetch_assoc($extract4);

$query_extract4PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract4['extractYield']);
$extract4PPG = mysql_query($query_extract4PPG, $brewing) or die(mysql_error());
$row_extract4PPG = mysql_fetch_assoc($extract4PPG);

$query_extract5 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract5'";
$extract5 = mysql_query($query_extract5, $brewing) or die(mysql_error());
$row_extract5 = mysql_fetch_assoc($extract5);

$query_extract5PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract5['extractYield']);
$extract5PPG = mysql_query($query_extract5PPG, $brewing) or die(mysql_error());
$row_extract5PPG = mysql_fetch_assoc($extract5PPG);


/*
$brewExtract1 = $row_extract1['extractName'];
$brewExtract2 = $row_extract2['extractName'];
$brewExtract3 = $row_extract3['extractName'];
$brewExtract4 = $row_extract4['extractName'];
$brewExtract5 = $row_extract5['extractName'];
*/

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

$brewGrain1Weight = $_POST['brewGrain1Weight'];
$brewGrain2Weight = $_POST['brewGrain2Weight'];
$brewGrain3Weight = $_POST['brewGrain3Weight'];
$brewGrain4Weight = $_POST['brewGrain4Weight'];
$brewGrain5Weight = $_POST['brewGrain5Weight'];
$brewGrain6Weight = $_POST['brewGrain6Weight'];
$brewGrain7Weight = $_POST['brewGrain7Weight'];
$brewGrain8Weight = $_POST['brewGrain8Weight'];
$brewGrain9Weight = $_POST['brewGrain9Weight'];


$query_grain1 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain1'";
$grain1 = mysql_query($query_grain1, $brewing) or die(mysql_error());
$row_grain1 = mysql_fetch_assoc($grain1);

$query_grain1PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain1['maltYield']);
$grain1PPG = mysql_query($query_grain1PPG, $brewing) or die(mysql_error());
$row_grain1PPG = mysql_fetch_assoc($grain1PPG);

$query_grain2 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain2'";
$grain2 = mysql_query($query_grain2, $brewing) or die(mysql_error());
$row_grain2 = mysql_fetch_assoc($grain2);

$query_grain2PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain2['maltYield']);
$grain2PPG = mysql_query($query_grain2PPG, $brewing) or die(mysql_error());
$row_grain2PPG = mysql_fetch_assoc($grain2PPG);

$query_grain3 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain3'";
$grain3 = mysql_query($query_grain3, $brewing) or die(mysql_error());
$row_grain3 = mysql_fetch_assoc($grain3);

$query_grain3PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain3['maltYield']);
$grain3PPG = mysql_query($query_grain3PPG, $brewing) or die(mysql_error());
$row_grain3PPG = mysql_fetch_assoc($grain3PPG);

$query_grain4 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain4'";
$grain4 = mysql_query($query_grain4, $brewing) or die(mysql_error());
$row_grain4 = mysql_fetch_assoc($grain4);

$query_grain4PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain4['maltYield']);
$grain4PPG = mysql_query($query_grain4PPG, $brewing) or die(mysql_error());
$row_grain4PPG = mysql_fetch_assoc($grain4PPG);

$query_grain5 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain5'";
$grain5 = mysql_query($query_grain5, $brewing) or die(mysql_error());
$row_grain5 = mysql_fetch_assoc($grain5);

$query_grain5PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain5['maltYield']);
$grain5PPG = mysql_query($query_grain5PPG, $brewing) or die(mysql_error());
$row_grain5PPG = mysql_fetch_assoc($grain5PPG);

$query_grain6 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain6'";
$grain6 = mysql_query($query_grain6, $brewing) or die(mysql_error());
$row_grain6 = mysql_fetch_assoc($grain6);

$query_grain6PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain6['maltYield']);
$grain6PPG = mysql_query($query_grain6PPG, $brewing) or die(mysql_error());
$row_grain6PPG = mysql_fetch_assoc($grain6PPG);

$query_grain7 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain7'";
$grain7 = mysql_query($query_grain7, $brewing) or die(mysql_error());
$row_grain7 = mysql_fetch_assoc($grain7);

$query_grain7PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain7['maltYield']);
$grain7PPG = mysql_query($query_grain7PPG, $brewing) or die(mysql_error());
$row_grain7PPG = mysql_fetch_assoc($grain7PPG);

$query_grain8 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain8'";
$grain8 = mysql_query($query_grain8, $brewing) or die(mysql_error());
$row_grain8 = mysql_fetch_assoc($grain8);

$query_grain8PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain8['maltYield']);
$grain8PPG = mysql_query($query_grain8PPG, $brewing) or die(mysql_error());
$row_grain8PPG = mysql_fetch_assoc($grain8PPG);

$query_grain9 = "SELECT maltYield, maltLovibond FROM malt WHERE maltName='$brewGrain9'";
$grain9 = mysql_query($query_grain9, $brewing) or die(mysql_error());
$row_grain9 = mysql_fetch_assoc($grain9);

$query_grain9PPG = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_grain9['maltYield']);
$grain9PPG = mysql_query($query_grain9PPG, $brewing) or die(mysql_error());
$row_grain9PPG = mysql_fetch_assoc($grain9PPG);

/*
$brewGrain1 = $row_grain1['maltName'];
$brewGrain2 = $row_grain2['maltName'];
$brewGrain3 = $row_grain3['maltName'];
$brewGrain4 = $row_grain4['maltName'];
$brewGrain5 = $row_grain5['maltName'];
$brewGrain6 = $row_grain6['maltName'];
$brewGrain7 = $row_grain7['maltName'];
$brewGrain8 = $row_grain8['maltName'];
$brewGrain9 = $row_grain9['maltName'];
*/

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

/*
$brewAdjunct1 = $row_adjunct1['adjunctName'];
$brewAdjunct2 = $row_adjunct2['adjunctName'];
$brewAdjunct3 = $row_adjunct3['adjunctName'];
$brewAdjunct4 = $row_adjunct4['adjunctName'];
$brewAdjunct5 = $row_adjunct5['adjunctName'];
$brewAdjunct6 = $row_adjunct6['adjunctName'];
$brewAdjunct7 = $row_adjunct7['adjunctName'];
$brewAdjunct8 = $row_adjunct8['adjunctName'];
$brewAdjunct9 = $row_adjunct9['adjunctName'];
*/

// Extract Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$extract1GU = $brewExtract1Weight * $row_extract1PPG['sugarPPG'];
$extract2GU = $brewExtract2Weight * $row_extract2PPG['sugarPPG'];
$extract3GU = $brewExtract3Weight * $row_extract3PPG['sugarPPG'];
$extract4GU = $brewExtract4Weight * $row_extract4PPG['sugarPPG'];
$extract5GU = $brewExtract5Weight * $row_extract5PPG['sugarPPG'];
}

if ($row_pref['measWeight2'] == "kilograms") { 
$extract1GU = ($brewExtract1Weight * 2.2046) * $row_extract1PPG['sugarPPG'];
$extract2GU = ($brewExtract2Weight * 2.2046) * $row_extract2PPG['sugarPPG'];
$extract3GU = ($brewExtract3Weight * 2.2046) * $row_extract3PPG['sugarPPG'];
$extract4GU = ($brewExtract4Weight * 2.2046) * $row_extract4PPG['sugarPPG'];
$extract5GU = ($brewExtract5Weight * 2.2046) * $row_extract5PPG['sugarPPG'];
}

// Grain Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$grain1GU = $brewGrain1Weight * $row_grain1PPG['sugarPPG'];
$grain2GU = $brewGrain2Weight * $row_grain2PPG['sugarPPG']; 
$grain3GU = $brewGrain3Weight * $row_grain3PPG['sugarPPG']; 
$grain4GU = $brewGrain4Weight * $row_grain4PPG['sugarPPG']; 
$grain5GU = $brewGrain5Weight * $row_grain5PPG['sugarPPG']; 
$grain6GU = $brewGrain6Weight * $row_grain6PPG['sugarPPG']; 
$grain7GU = $brewGrain7Weight * $row_grain7PPG['sugarPPG']; 
$grain8GU = $brewGrain8Weight * $row_grain8PPG['sugarPPG']; 
$grain9GU = $brewGrain9Weight * $row_grain9PPG['sugarPPG']; 
}

if ($row_pref['measWeight2'] == "kilograms") { 
$grain1GU = ($brewGrain1Weight * 2.2046) * $row_grain1PPG['sugarPPG'];
$grain2GU = ($brewGrain2Weight * 2.2046) * $row_grain2PPG['sugarPPG']; 
$grain3GU = ($brewGrain3Weight * 2.2046) * $row_grain3PPG['sugarPPG']; 
$grain4GU = ($brewGrain4Weight * 2.2046) * $row_grain4PPG['sugarPPG']; 
$grain5GU = ($brewGrain5Weight * 2.2046) * $row_grain5PPG['sugarPPG']; 
$grain6GU = ($brewGrain6Weight * 2.2046) * $row_grain6PPG['sugarPPG']; 
$grain7GU = ($brewGrain7Weight * 2.2046) * $row_grain7PPG['sugarPPG']; 
$grain8GU = ($brewGrain8Weight * 2.2046) * $row_grain8PPG['sugarPPG']; 
$grain9GU = ($brewGrain9Weight * 2.2046) * $row_grain9PPG['sugarPPG']; 
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
$grain1GU + $grain2GU + $grain3GU + $grain4GU + $grain5GU + $grain6GU + $grain7GU + $grain8GU + $grain9GU + 
$adjunct1GU + $adjunct2GU + $adjunct3GU + $adjunct4GU + $adjunct5GU + $adjunct6GU + $adjunct7GU + $adjunct8GU + $adjunct9GU;

// Total Grist Weight
$totalGrist = $brewExtract1Weight + $brewExtract2Weight + $brewExtract3Weight + $brewExtract4Weight + $brewExtract5Weight + 
$brewGrain1Weight + $brewGrain2Weight + $brewGrain3Weight + $brewGrain4Weight + $brewGrain5Weight + $brewGrain6Weight + $brewGrain7Weight + $brewGrain8Weight + $brewGrain9Weight;

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
$brewHops1 = $_POST['brewHops1'];
$brewHops2 = $_POST['brewHops2'];
$brewHops3 = $_POST['brewHops3'];
$brewHops4 = $_POST['brewHops4'];
$brewHops5 = $_POST['brewHops5'];
$brewHops6 = $_POST['brewHops6'];
$brewHops7 = $_POST['brewHops7'];
$brewHops8 = $_POST['brewHops8'];
$brewHops9 = $_POST['brewHops9'];
$brewHops1Weight = $_POST['brewHops1Weight'];
$brewHops2Weight = $_POST['brewHops2Weight'];
$brewHops3Weight = $_POST['brewHops3Weight'];
$brewHops4Weight = $_POST['brewHops4Weight'];
$brewHops5Weight = $_POST['brewHops5Weight'];
$brewHops6Weight = $_POST['brewHops6Weight'];
$brewHops7Weight = $_POST['brewHops7Weight'];
$brewHops8Weight = $_POST['brewHops8Weight'];
$brewHops9Weight = $_POST['brewHops9Weight'];
$brewHops1IBU = $_POST['brewHops1IBU'];
$brewHops2IBU = $_POST['brewHops2IBU'];
$brewHops3IBU = $_POST['brewHops3IBU'];
$brewHops4IBU = $_POST['brewHops4IBU'];
$brewHops5IBU = $_POST['brewHops5IBU'];
$brewHops6IBU = $_POST['brewHops6IBU'];
$brewHops7IBU = $_POST['brewHops7IBU'];
$brewHops8IBU = $_POST['brewHops8IBU'];
$brewHops9IBU = $_POST['brewHops9IBU'];
$brewHops1Time = $_POST['brewHops1Time'];
$brewHops2Time = $_POST['brewHops2Time'];
$brewHops3Time = $_POST['brewHops3Time'];
$brewHops4Time = $_POST['brewHops4Time'];
$brewHops5Time = $_POST['brewHops5Time'];
$brewHops6Time = $_POST['brewHops6Time'];
$brewHops7Time = $_POST['brewHops7Time'];
$brewHops8Time = $_POST['brewHops8Time'];
$brewHops9Time = $_POST['brewHops9Time'];
$brewHops1Form = $_POST['brewHops1Form'];
$brewHops2Form = $_POST['brewHops2Form'];
$brewHops3Form = $_POST['brewHops3Form'];
$brewHops4Form = $_POST['brewHops4Form'];
$brewHops5Form = $_POST['brewHops5Form'];
$brewHops6Form = $_POST['brewHops6Form'];
$brewHops7Form = $_POST['brewHops7Form'];
$brewHops8Form = $_POST['brewHops8Form'];
$brewHops9Form = $_POST['brewHops9Form'];
$wholeFraction = ".85";

// Convert to Utilization Percentage...

// ------------------- Daniels Method ------------------- //
/*
Equation - U.S.:
IBU = Weight * Utilization % * Alpha % * 7,489
      -------------------------------------------
	  (Final Volume * (1 +[(Boil Time - 1.050) / 0.2)])

Equation - Metric:
IBU = Weight * Utilization % * Alpha % * 1,000
      -------------------------------------------
	  (Final Volume * (1 +[(Boil Time - 1.050) / 0.2)])
*/

function convertUtilizationDPellet($numD) {
if ($numD == 0) $convertD = "0";
if (($numD > 0) && ($numD <= 10))  { $convertD = ".06"; }
if (($numD > 10) && ($numD <= 19)) { $convertD = ".15"; }
if (($numD > 19) && ($numD <= 30)) { $convertD = ".19"; }
if (($numD > 29) && ($numD <= 44)) { $convertD = ".24"; }
if (($numD > 44) && ($numD <= 59)) { $convertD = ".27"; }
if (($numD > 59) && ($numD <= 74)) { $convertD = ".30"; }
if ($numD >= 74) $convertD = ".34";
return $convertD;
}

function convertUtilizationDWhole($numD) {
if ($numD == 0) $convertD = "0";
if (($numD > 0) && ($numD <= 10))  { $convertD = ".05"; }
if (($numD > 10) && ($numD <= 19)) { $convertD = ".12"; }
if (($numD > 19) && ($numD <= 30)) { $convertD = ".15"; }
if (($numD > 29) && ($numD <= 44)) { $convertD = ".19"; }
if (($numD > 44) && ($numD <= 59)) { $convertD = ".22"; }
if (($numD > 59) && ($numD <= 74)) { $convertD = ".24"; }
if ($numD >= 74) $convertD = ".27";
return $convertD;
}

$numD = $brewHops1Time; if (($brewHops1Form == "Plug") || ($brewHops1Form == "Leaf")) $uD1 = convertUtilizationDWhole($numD); if ($brewHops1Form == "Pellets")  $uD1 = convertUtilizationDPellet($numD);
$numD = $brewHops2Time; if (($brewHops2Form == "Plug") || ($brewHops2Form == "Leaf")) $uD2 = convertUtilizationDWhole($numD); if ($brewHops2Form == "Pellets")  $uD2 = convertUtilizationDPellet($numD);
$numD = $brewHops3Time; if (($brewHops3Form == "Plug") || ($brewHops3Form == "Leaf")) $uD3 = convertUtilizationDWhole($numD); else $uD3 = convertUtilizationDPellet($numD);
$numD = $brewHops4Time; if (($brewHops4Form == "Plug") || ($brewHops4Form == "Leaf")) $uD4 = convertUtilizationDWhole($numD); else $uD4 = convertUtilizationDPellet($numD);
$numD = $brewHops5Time; if (($brewHops5Form == "Plug") || ($brewHops5Form == "Leaf")) $uD5 = convertUtilizationDWhole($numD); else $uD5 = convertUtilizationDPellet($numD);
$numD = $brewHops6Time; if (($brewHops6Form == "Plug") || ($brewHops6Form == "Leaf")) $uD6 = convertUtilizationDWhole($numD); else $uD6 = convertUtilizationDPellet($numD);
$numD = $brewHops7Time; if (($brewHops7Form == "Plug") || ($brewHops7Form == "Leaf")) $uD7 = convertUtilizationDWhole($numD); else $uD7 = convertUtilizationDPellet($numD);
$numD = $brewHops8Time; if (($brewHops8Form == "Plug") || ($brewHops8Form == "Leaf")) $uD8 = convertUtilizationDWhole($numD); else $uD8 = convertUtilizationDPellet($numD);
$numD = $brewHops9Time; if (($brewHops9Form == "Plug") || ($brewHops9Form == "Leaf")) $uD9 = convertUtilizationDWhole($numD); else $uD9 = convertUtilizationDPellet($numD);

// Correct gravity
if ($og < 1.050) $cGravity = 1;
if ($og >= 1.050) { $cGravity = 1 + (($og - 1.050) / 0.2); }


// Garetz
function convertUtilizationG($numG) {
if ($numG <= 10) { $convertG = "0"; }
if (($numG > 10) && ($numG <= 15)) { $convertG = "1"; }
if (($numG > 15) && ($numG <= 20)) { $convertG = "4"; }
if (($numG > 20) && ($numG <= 25)) { $convertG = "6"; }
if (($numG > 25) && ($numG <= 30)) { $convertG = "11"; }
if (($numG > 30) && ($numG <= 35)) { $convertG = "13"; }
if (($numG > 35) && ($numG <= 40)) { $convertG = "19"; }
if (($numG > 40) && ($numG <= 45)) { $convertG = "23"; }
if (($numG > 45) && ($numG <= 50)) { $convertG = "24"; }
if (($numG > 50) && ($numG <= 60)) { $convertG = "25"; }
if (($numG > 60) && ($numG <= 65)) { $convertG = "26"; }
if (($numG > 70) && ($numG <= 75)) { $convertG = "27"; }
if (($numG > 75) && ($numG <= 80)) { $convertG = "28"; }
if (($numG > 80) && ($numG <= 85)) { $convertG = "29"; }
if ($numG >= 90) $convertG = "30";
return $convertG;
}
$numG = $brewHops1Time; $uG1 = convertUtilizationG($numG);
$numG = $brewHops2Time; $uG2 = convertUtilizationG($numG);
$numG = $brewHops3Time; $uG3 = convertUtilizationG($numG);
$numG = $brewHops4Time; $uG4 = convertUtilizationG($numG);
$numG = $brewHops5Time; $uG5 = convertUtilizationG($numG);
$numG = $brewHops6Time; $uG6 = convertUtilizationG($numG);
$numG = $brewHops7Time; $uG7 = convertUtilizationG($numG);
$numG = $brewHops8Time; $uG8 = convertUtilizationG($numG);
$numG = $brewHops9Time; $uG9 = convertUtilizationG($numG);

// Rager
function convertUtilizationR ($numR) {
if ($numR == 0) $convertR = "0";
if (($numR > 0) && ($numR <= 6))   $convertR = "0.05";
if (($numR > 6) && ($numR <= 10))  $convertR = "0.06";
if (($numR > 10) && ($numR <= 15)) $convertR = "0.08";
if (($numR > 15) && ($numR <= 20)) $convertR = "0.101";
if (($numR > 20) && ($numR <= 25)) $convertR = ".121";
if (($numR > 25) && ($numR <= 30)) $convertR = ".153";
if (($numR > 30) && ($numR <= 35)) $convertR = ".188";
if (($numR > 35) && ($numR <= 40)) $convertR = ".228";
if (($numR > 40) && ($numR <= 45)) $convertR = ".269";
if (($numR > 45) && ($numR <= 50)) $convertR = ".281";
if (($numR > 50) && ($numR <= 60)) $convertR = ".291";
if (($numR > 60) && ($numR <= 65)) $convertR = ".30";
if (($numR > 70) && ($numR <= 75)) $convertR = ".31";
if (($numR > 75) && ($numR <= 80)) $convertR = ".32";
if (($numR > 80) && ($numR <= 85)) $convertR = ".33";
if ($numR >= 90) $convertR = ".34";
return $convertR;
}
$numR = $brewHops1Time; $uR1 = convertUtilizationR($numR);
$numR = $brewHops2Time; $uR2 = convertUtilizationR($numR);
$numR = $brewHops3Time; $uR3 = convertUtilizationR($numR);
$numR = $brewHops4Time; $uR4 = convertUtilizationR($numR);
$numR = $brewHops5Time; $uR5 = convertUtilizationR($numR);
$numR = $brewHops6Time; $uR6 = convertUtilizationR($numR);
$numR = $brewHops7Time; $uR7 = convertUtilizationR($numR);
$numR = $brewHops8Time; $uR8 = convertUtilizationR($numR);
$numR = $brewHops9Time; $uR9 = convertUtilizationR($numR);
if ($og > 1.050) $ga = (($og - 1.050) / .2); else $ga = 0;

// Tinseth
// Bigness Factor = 1.65 * 0.000125^(wort gravity - 1)
$wg = $og - 1;
$bignessFactor = 1.65 * (pow(0.000125, $wg));

//Boil Time Factor = 1 - e^(-0.04 * time in mins)
//                   --------------------------
//                             4.15
function hopBTF($numT) { 
$eT = (-0.04 * $numT);
$boilTimeFactor = (1 - (pow(2.71828, $eT))) / 4.15;
return $boilTimeFactor;
}

$numT = $brewHops1Time;	$decimalAA1 = $bignessFactor * hopBTF($numT);
$numT = $brewHops2Time;	$decimalAA2 = $bignessFactor * hopBTF($numT);
$numT = $brewHops3Time;	$decimalAA3 = $bignessFactor * hopBTF($numT);
$numT = $brewHops4Time;	$decimalAA4 = $bignessFactor * hopBTF($numT);
$numT = $brewHops5Time;	$decimalAA5 = $bignessFactor * hopBTF($numT);
$numT = $brewHops6Time;	$decimalAA6 = $bignessFactor * hopBTF($numT);
$numT = $brewHops7Time;	$decimalAA7 = $bignessFactor * hopBTF($numT);
$numT = $brewHops8Time;	$decimalAA8 = $bignessFactor * hopBTF($numT);
$numT = $brewHops9Time;	$decimalAA9 = $bignessFactor * hopBTF($numT);



$query_hops1 = "SELECT * FROM hops WHERE hopsName='$brewHops1'";
$hops1 = mysql_query($query_hops1, $brewing) or die(mysql_error());
$row_hops1 = mysql_fetch_assoc($hops1);


$query_hops2 = "SELECT * FROM hops WHERE hopsName='$brewHops2'";
$hops2 = mysql_query($query_hops2, $brewing) or die(mysql_error());
$row_hops2 = mysql_fetch_assoc($hops2);


$query_hops3 = "SELECT * FROM hops WHERE hopsName='$brewHops3'";
$hops3 = mysql_query($query_hops3, $brewing) or die(mysql_error());
$row_hops3 = mysql_fetch_assoc($hops3);


$query_hops4 = "SELECT * FROM hops WHERE hopsName='$brewHops4'";
$hops4 = mysql_query($query_hops4, $brewing) or die(mysql_error());
$row_hops4 = mysql_fetch_assoc($hops4);


$query_hops5 = "SELECT * FROM hops WHERE hopsName='$brewHops5'";
$hops5 = mysql_query($query_hops5, $brewing) or die(mysql_error());
$row_hops5 = mysql_fetch_assoc($hops5);


$query_hops6 = "SELECT * FROM hops WHERE hopsName='$brewHops6'";
$hops6 = mysql_query($query_hops6, $brewing) or die(mysql_error());
$row_hops6 = mysql_fetch_assoc($hops6);


$query_hops7 = "SELECT * FROM hops WHERE hopsName='$brewHops7'";
$hops7 = mysql_query($query_hops7, $brewing) or die(mysql_error());
$row_hops7 = mysql_fetch_assoc($hops7);


$query_hops8 = "SELECT * FROM hops WHERE hopsName='$brewHops8'";
$hops8 = mysql_query($query_hops8, $brewing) or die(mysql_error());
$row_hops8 = mysql_fetch_assoc($hops8);


$query_hops9 = "SELECT * FROM hops WHERE hopsName='$brewHops9'";
$hops9 = mysql_query($query_hops9, $brewing) or die(mysql_error());
$row_hops9 = mysql_fetch_assoc($hops9);

/*
$brewHops1 = $row_hops1['hopsName'];
$brewHops2 = $row_hops2['hopsName'];
$brewHops3 = $row_hops3['hopsName'];
$brewHops4 = $row_hops4['hopsName'];
$brewHops5 = $row_hops5['hopsName'];
$brewHops6 = $row_hops6['hopsName'];
$brewHops7 = $row_hops7['hopsName'];
$brewHops8 = $row_hops8['hopsName'];
$brewHops9 = $row_hops9['hopsName'];
*/

// ------------------------------ Calculations -----------------------------------
// Hops
if ($row_pref['measWeight1'] == "ounces") { 

$hopsAAU1 = $brewHops1Weight * $brewHops1IBU;
$hopsAAU2 = $brewHops2Weight * $brewHops2IBU;
$hopsAAU3 = $brewHops3Weight * $brewHops3IBU;
$hopsAAU4 = $brewHops4Weight * $brewHops4IBU;
$hopsAAU5 = $brewHops5Weight * $brewHops5IBU;
$hopsAAU6 = $brewHops6Weight * $brewHops6IBU;
$hopsAAU7 = $brewHops7Weight * $brewHops7IBU;
$hopsAAU8 = $brewHops8Weight * $brewHops8IBU;
$hopsAAU9 = $brewHops9Weight * $brewHops9IBU;

// Daniels
$hopsIBUCalc1D = ($brewHops1Weight * $uD1 * ($brewHops1IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc2D = ($brewHops2Weight * $uD2 * ($brewHops2IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc3D = ($brewHops3Weight * $uD3 * ($brewHops3IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc4D = ($brewHops4Weight * $uD4 * ($brewHops4IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc5D = ($brewHops5Weight * $uD5 * ($brewHops5IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc6D = ($brewHops6Weight * $uD6 * ($brewHops6IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc7D = ($brewHops7Weight * $uD7 * ($brewHops7IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc8D = ($brewHops8Weight * $uD8 * ($brewHops8IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc9D = ($brewHops9Weight * $uD9 * ($brewHops9IBU * .01) * 7489) / ($brewYield * $cGravity);

// Garetz
$hopsIBUCalc1G = ($hopsAAU1 * $uG1) / $brewYield / 1.34; if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1G .= "*".$wholeFraction; 
$hopsIBUCalc2G = ($hopsAAU2 * $uG2) / $brewYield / 1.34; if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug"))  $hopsIBUCalc2G .= "*".$wholeFraction;
$hopsIBUCalc3G = ($hopsAAU3 * $uG3) / $brewYield / 1.34; if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug"))  $hopsIBUCalc3G .= "*".$wholeFraction;
$hopsIBUCalc4G = ($hopsAAU4 * $uG4) / $brewYield / 1.34; if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug"))  $hopsIBUCalc4G .= "*".$wholeFraction;
$hopsIBUCalc5G = ($hopsAAU5 * $uG5) / $brewYield / 1.34; if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug"))  $hopsIBUCalc5G .= "*".$wholeFraction;
$hopsIBUCalc6G = ($hopsAAU6 * $uG6) / $brewYield / 1.34; if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug"))  $hopsIBUCalc6G .= "*".$wholeFraction;
$hopsIBUCalc7G = ($hopsAAU7 * $uG7) / $brewYield / 1.34; if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug"))  $hopsIBUCalc7G .= "*".$wholeFraction;
$hopsIBUCalc8G = ($hopsAAU8 * $uG8) / $brewYield / 1.34; if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug"))  $hopsIBUCalc8G .= "*".$wholeFraction;
$hopsIBUCalc9G = ($hopsAAU9 * $uG9) / $brewYield / 1.34; if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug"))  $hopsIBUCalc9G .= "*".$wholeFraction;

// Rager
$hopsIBUCalc1R = ($brewHops1Weight * $uR1 * ($brewHops1IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1R .= "*".$wholeFraction; 
$hopsIBUCalc2R = ($brewHops2Weight * $uR2 * ($brewHops2IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug"))$hopsIBUCalc2R .= "*".$wholeFraction; 
$hopsIBUCalc3R = ($brewHops3Weight * $uR3 * ($brewHops3IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3R .= "*".$wholeFraction; 
$hopsIBUCalc4R = ($brewHops4Weight * $uR4 * ($brewHops4IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4R .= "*".$wholeFraction; 
$hopsIBUCalc5R = ($brewHops5Weight * $uR5 * ($brewHops5IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5R .= "*".$wholeFraction; 
$hopsIBUCalc6R = ($brewHops6Weight * $uR6 * ($brewHops6IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6R .= "*".$wholeFraction; 
$hopsIBUCalc7R = ($brewHops7Weight * $uR7 * ($brewHops7IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7R .= "*".$wholeFraction; 
$hopsIBUCalc8R = ($brewHops8Weight * $uR8 * ($brewHops8IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8R .= "*".$wholeFraction; 
$hopsIBUCalc9R = ($brewHops9Weight * $uR9 * ($brewHops9IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9R .= "*".$wholeFraction; 

//Tinseth
$hopsIBUCalc1T = $decimalAA1 * ((($brewHops1IBU / 100) * $brewHops1Weight * 7489) / $brewYield); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1T .= "*".$wholeFraction; 
$hopsIBUCalc2T = $decimalAA2 * ((($brewHops2IBU / 100) * $brewHops2Weight * 7489) / $brewYield); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2T .= "*".$wholeFraction; 
$hopsIBUCalc3T = $decimalAA3 * ((($brewHops3IBU / 100) * $brewHops3Weight * 7489) / $brewYield); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3T .= "*".$wholeFraction; 
$hopsIBUCalc4T = $decimalAA4 * ((($brewHops4IBU / 100) * $brewHops4Weight * 7489) / $brewYield); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4T .= "*".$wholeFraction; 
$hopsIBUCalc5T = $decimalAA5 * ((($brewHops5IBU / 100) * $brewHops5Weight * 7489) / $brewYield); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5T .= "*".$wholeFraction; 
$hopsIBUCalc6T = $decimalAA6 * ((($brewHops6IBU / 100) * $brewHops6Weight * 7489) / $brewYield); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6T .= "*".$wholeFraction; 
$hopsIBUCalc7T = $decimalAA7 * ((($brewHops7IBU / 100) * $brewHops7Weight * 7489) / $brewYield); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7T .= "*".$wholeFraction; 
$hopsIBUCalc8T = $decimalAA8 * ((($brewHops8IBU / 100) * $brewHops8Weight * 7489) / $brewYield); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8T .= "*".$wholeFraction; 
$hopsIBUCalc9T = $decimalAA9 * ((($brewHops9IBU / 100) * $brewHops9Weight * 7489) / $brewYield); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9T .= "*".$wholeFraction; 
}

if ($row_pref['measWeight1'] == "grams") { 
// Garetz
$hopsAAU1 = ($brewHops1Weight * .0353) * $brewHops1IBU;
$hopsAAU2 = ($brewHops2Weight * .0353) * $brewHops2IBU;
$hopsAAU3 = ($brewHops3Weight * .0353) * $brewHops3IBU;
$hopsAAU4 = ($brewHops4Weight * .0353) * $brewHops4IBU;
$hopsAAU5 = ($brewHops5Weight * .0353) * $brewHops5IBU;
$hopsAAU6 = ($brewHops6Weight * .0353) * $brewHops6IBU;
$hopsAAU7 = ($brewHops7Weight * .0353) * $brewHops7IBU;
$hopsAAU8 = ($brewHops8Weight * .0353) * $brewHops8IBU;
$hopsAAU9 = ($brewHops9Weight * .0353) * $brewHops9IBU;

// Daniels
$hopsIBUCalc1D = ($brewHops1Weight * $uD1 * ($brewHops1IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc2D = ($brewHops2Weight * $uD2 * ($brewHops2IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc3D = ($brewHops3Weight * $uD3 * ($brewHops3IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc4D = ($brewHops4Weight * $uD4 * ($brewHops4IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc5D = ($brewHops5Weight * $uD5 * ($brewHops5IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc6D = ($brewHops6Weight * $uD6 * ($brewHops6IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc7D = ($brewHops7Weight * $uD7 * ($brewHops7IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc8D = ($brewHops8Weight * $uD8 * ($brewHops8IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc9D = ($brewHops9Weight * $uD9 * ($brewHops9IBU * .01) * 1000) / ($brewYield * $cGravity);

//Garetz
$hopsIBUCalc1G = ($hopsAAU1 * $uG1) / ($brewYield * .2642) / 1.34;  if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1G .= "*".$wholeFraction;
$hopsIBUCalc2G = ($hopsAAU2 * $uG2) / ($brewYield * .2642) / 1.34;  if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2G .= "*".$wholeFraction;
$hopsIBUCalc3G = ($hopsAAU3 * $uG3) / ($brewYield * .2642) / 1.34;  if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3G .= "*".$wholeFraction;
$hopsIBUCalc4G = ($hopsAAU4 * $uG4) / ($brewYield * .2642) / 1.34;  if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4G .= "*".$wholeFraction;
$hopsIBUCalc5G = ($hopsAAU5 * $uG5) / ($brewYield * .2642) / 1.34;  if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5G .= "*".$wholeFraction;
$hopsIBUCalc6G = ($hopsAAU6 * $uG6) / ($brewYield * .2642) / 1.34;  if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6G .= "*".$wholeFraction;
$hopsIBUCalc7G = ($hopsAAU7 * $uG7) / ($brewYield * .2642) / 1.34;  if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7G .= "*".$wholeFraction;
$hopsIBUCalc8G = ($hopsAAU8 * $uG8) / ($brewYield * .2642) / 1.34;  if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8G .= "*".$wholeFraction;
$hopsIBUCalc9G = ($hopsAAU9 * $uG9) / ($brewYield * .2642) / 1.34;  if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9G .= "*".$wholeFraction;

// Rager
$hopsIBUCalc1R = (($brewHops1Weight * .0353) * $uR1 * ($brewHops1IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1R .= "*".$wholeFraction;
$hopsIBUCalc2R = (($brewHops2Weight * .0353) * $uR2 * ($brewHops2IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2R .= "*".$wholeFraction;
$hopsIBUCalc3R = (($brewHops3Weight * .0353) * $uR3 * ($brewHops3IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3R .= "*".$wholeFraction;
$hopsIBUCalc4R = (($brewHops4Weight * .0353) * $uR4 * ($brewHops4IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4R .= "*".$wholeFraction;
$hopsIBUCalc5R = (($brewHops5Weight * .0353) * $uR5 * ($brewHops5IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5R .= "*".$wholeFraction;
$hopsIBUCalc6R = (($brewHops6Weight * .0353) * $uR6 * ($brewHops6IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6R .= "*".$wholeFraction;
$hopsIBUCalc7R = (($brewHops7Weight * .0353) * $uR7 * ($brewHops7IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7R .= "*".$wholeFraction;
$hopsIBUCalc8R = (($brewHops8Weight * .0353) * $uR8 * ($brewHops8IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8R .= "*".$wholeFraction;
$hopsIBUCalc9R = (($brewHops9Weight * .0353) * $uR9 * ($brewHops9IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9R .= "*".$wholeFraction;

//Tinseth
$hopsIBUCalc1T = $decimalAA1 * ((($brewHops1IBU / 100) * ($brewHops1Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1T .= "*".$wholeFraction; 
$hopsIBUCalc2T = $decimalAA2 * ((($brewHops2IBU / 100) * ($brewHops2Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2T .= "*".$wholeFraction; 
$hopsIBUCalc3T = $decimalAA3 * ((($brewHops3IBU / 100) * ($brewHops3Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3T .= "*".$wholeFraction; 
$hopsIBUCalc4T = $decimalAA4 * ((($brewHops4IBU / 100) * ($brewHops4Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4T .= "*".$wholeFraction; 
$hopsIBUCalc5T = $decimalAA5 * ((($brewHops5IBU / 100) * ($brewHops5Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5T .= "*".$wholeFraction; 
$hopsIBUCalc6T = $decimalAA6 * ((($brewHops6IBU / 100) * ($brewHops6Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6T .= "*".$wholeFraction; 
$hopsIBUCalc7T = $decimalAA7 * ((($brewHops7IBU / 100) * ($brewHops7Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7T .= "*".$wholeFraction; 
$hopsIBUCalc8T = $decimalAA8 * ((($brewHops8IBU / 100) * ($brewHops8Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8T .= "*".$wholeFraction; 
$hopsIBUCalc9T = $decimalAA9 * ((($brewHops9IBU / 100) * ($brewHops9Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9T .= "*".$wholeFraction; 
}

// Bitterness Calculations
// Daniels
$bitternessD = $hopsIBUCalc1D + $hopsIBUCalc2D + $hopsIBUCalc3D + $hopsIBUCalc4D + $hopsIBUCalc5D + $hopsIBUCalc6D + $hopsIBUCalc7D + $hopsIBUCalc8D + $hopsIBUCalc9D;

// Garetz
$bitternessG = $hopsIBUCalc1G + $hopsIBUCalc2G + $hopsIBUCalc3G + $hopsIBUCalc4G + $hopsIBUCalc5G + $hopsIBUCalc6G + $hopsIBUCalc7G + $hopsIBUCalc8G + $hopsIBUCalc9G;

// Rager
$bitternessR = $hopsIBUCalc1R + $hopsIBUCalc2R + $hopsIBUCalc3R + $hopsIBUCalc4R + $hopsIBUCalc5R + $hopsIBUCalc6R + $hopsIBUCalc7R + $hopsIBUCalc8R + $hopsIBUCalc9R;

// Tinseth
$bitternessT = $hopsIBUCalc1T + $hopsIBUCalc2T + $hopsIBUCalc3T + $hopsIBUCalc4T + $hopsIBUCalc5T + $hopsIBUCalc6T + $hopsIBUCalc7T + $hopsIBUCalc8T + $hopsIBUCalc9T;


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


$SRMTotal = $SRM1 + $SRM2 + $SRM3 + $SRM4 + $SRM5 + $SRM6 + $SRM7 + $SRM8 + $SRM9 + $SRM10 + $SRM11 + $SRM12 + $SRM13 + $SRM14 + $SRM15 + $SRM16 + $SRM17 + $SRM18 + $SRM19 + $SRM20 + $SRM21 + $SRM22 + $SRM23; 
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

//$SRM = $SRMTotal * $efficiency * .49 * 1.25;
// formula from http://www.picobrewery.com/askarchive/color.html - best one I could find.

// GU:BU Ratio

if ((($bitternessG != 0) || ($bitternessR != 0) || ($bitternessT != 0) || ($bitternessD != 0)) && ($totalGU != 0)) {
$bitternessAvg = ($bitternessG + $bitternessR + $bitternessT + $bitternessD) / 4;
if ($results != "verify") {
$bugu = $bitternessAvg /(($og - 1) * 1000); 
}
}
?>