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

mysql_select_db($database_brewing, $brewing);
$query_extract1 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract1'";
$extract1 = mysql_query($query_extract1, $brewing);
$row_extract1 = mysql_fetch_assoc($extract1);

$query_extractPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract1['extractYield']);
$extractPPG1 = mysql_query($query_extractPPG1, $brewing);
$row_extractPPG1 = mysql_fetch_assoc($extractPPG1);

$query_extract2 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract2'";
$extract2 = mysql_query($query_extract2, $brewing);
$row_extract2 = mysql_fetch_assoc($extract2);

$query_extractPPG2 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract2['extractYield']);
$extractPPG2 = mysql_query($query_extractPPG2, $brewing);
$row_extractPPG2 = mysql_fetch_assoc($extractPPG2);

$query_extract3 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract3'";
$extract3 = mysql_query($query_extract3, $brewing);
$row_extract3 = mysql_fetch_assoc($extract3);

$query_extractPPG3 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract3['extractYield']);
$extractPPG3 = mysql_query($query_extractPPG3, $brewing);
$row_extractPPG3 = mysql_fetch_assoc($extractPPG3);

$query_extract4 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract4'";
$extract4 = mysql_query($query_extract4, $brewing);
$row_extract4 = mysql_fetch_assoc($extract4);

$query_extractPPG4 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract4['extractYield']);
$extractPPG4 = mysql_query($query_extractPPG4, $brewing);
$row_extractPPG4 = mysql_fetch_assoc($extractPPG4);

$query_extract5 = "SELECT extractYield, extractLovibond FROM extract WHERE extractName='$brewExtract5'";
$extract5 = mysql_query($query_extract5, $brewing);
$row_extract5 = mysql_fetch_assoc($extract5);

$query_extractPPG5 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_extract5['extractYield']);
$extractPPG5 = mysql_query($query_extractPPG5, $brewing);
$row_extractPPG5 = mysql_fetch_assoc($extractPPG5);


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
$brewGrain10 = $_POST['brewGrain10'];
$brewGrain11 = $_POST['brewGrain12'];
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
    $$totalRows_malt = mysql_num_rows($$grain);
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

for($i = 1; $i <= 9; ++$i) {
	
    $query_adjunct = 'query_adjunct'.$i;
    $adjunct = 'adjunct'.$i;
    $row_adjunct = 'row_adjunct'.$i;
    $totalRows_adjunct = 'totalRows_adjunct'.$i;
	
	mysql_select_db($database_brewing, $brewing);
    $$query_adjunct = sprintf("SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='%s'", $_POST['brewadjunct'.$i]);
    $$adjunct = mysql_query($$query_adjunct, $brewing);
    $$row_adjunct = mysql_fetch_assoc($$adjunct);
    $$totalRows_malt = mysql_num_rows($$adjunct);
}


$query_adjunctPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct1['adjunctYield']);
$adjunctPPG1 = mysql_query($query_adjunctPPG1, $brewing);
$row_adjunctPPG1 = mysql_fetch_assoc($adjunctPPG1);

$query_adjunctPPG2 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct2['adjunctYield']);
$adjunctPPG2 = mysql_query($query_adjunctPPG2, $brewing);
$row_adjunctPPG2 = mysql_fetch_assoc($adjunctPPG2);

$query_adjunctPPG3 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct3['adjunctYield']);
$adjunctPPG3 = mysql_query($query_adjunctPPG3, $brewing);
$row_adjunctPPG3 = mysql_fetch_assoc($adjunctPPG3);

$query_adjunctPPG4 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct4['adjunctYield']);
$adjunctPPG4 = mysql_query($query_adjunctPPG4, $brewing);
$row_adjunctPPG4 = mysql_fetch_assoc($adjunctPPG4);

$query_adjunctPPG5 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct5['adjunctYield']);
$adjunctPPG5 = mysql_query($query_adjunctPPG5, $brewing);
$row_adjunctPPG5 = mysql_fetch_assoc($adjunctPPG5);

$query_adjunctPPG6 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct6['adjunctYield']);
$adjunctPPG6 = mysql_query($query_adjunctPPG6, $brewing);
$row_adjunctPPG6 = mysql_fetch_assoc($adjunctPPG6);

$query_adjunctPPG7 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct7['adjunctYield']);
$adjunctPPG7 = mysql_query($query_adjunctPPG7, $brewing);
$row_adjunctPPG7 = mysql_fetch_assoc($adjunctPPG7);

$query_adjunctPPG8 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct8['adjunctYield']);
$adjunctPPG8 = mysql_query($query_adjunctPPG8, $brewing);
$row_adjunctPPG8 = mysql_fetch_assoc($adjunctPPG8);

$query_adjunctPPG9 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_adjunct9['adjunctYield']);
$adjunctPPG9 = mysql_query($query_adjunctPPG9, $brewing);
$row_adjunctPPG9 = mysql_fetch_assoc($adjunctPPG9);

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
$adjunct1GU = $brewAdjunct1Weight * $row_adjunctPPG1['sugarPPG'];
$adjunct2GU = $brewAdjunct2Weight * $row_adjunctPPG2['sugarPPG'];
$adjunct3GU = $brewAdjunct3Weight * $row_adjunctPPG3['sugarPPG'];
$adjunct4GU = $brewAdjunct4Weight * $row_adjunctPPG4['sugarPPG'];
$adjunct5GU = $brewAdjunct5Weight * $row_adjunctPPG5['sugarPPG'];
$adjunct6GU = $brewAdjunct6Weight * $row_adjunctPPG6['sugarPPG'];
$adjunct7GU = $brewAdjunct7Weight * $row_adjunctPPG7['sugarPPG'];
$adjunct8GU = $brewAdjunct8Weight * $row_adjunctPPG8['sugarPPG'];
$adjunct9GU = $brewAdjunct9Weight * $row_adjunctPPG9['sugarPPG'];
}

if ($row_pref['measWeight2'] == "kilograms") {
$adjunct1GU = ($brewAdjunct1Weight * 2.2046) * $row_adjunctPPG1['sugarPPG'];
$adjunct2GU = ($brewAdjunct2Weight * 2.2046) * $row_adjunctPPG2['sugarPPG'];
$adjunct3GU = ($brewAdjunct3Weight * 2.2046) * $row_adjunctPPG3['sugarPPG'];
$adjunct4GU = ($brewAdjunct4Weight * 2.2046) * $row_adjunctPPG4['sugarPPG'];
$adjunct5GU = ($brewAdjunct5Weight * 2.2046) * $row_adjunctPPG5['sugarPPG'];
$adjunct6GU = ($brewAdjunct6Weight * 2.2046) * $row_adjunctPPG6['sugarPPG'];
$adjunct7GU = ($brewAdjunct7Weight * 2.2046) * $row_adjunctPPG7['sugarPPG'];
$adjunct8GU = ($brewAdjunct8Weight * 2.2046) * $row_adjunctPPG8['sugarPPG'];
$adjunct9GU = ($brewAdjunct9Weight * 2.2046) * $row_adjunctPPG9['sugarPPG'];
}

// Total Gravity Units (GU)
$totalGU = 
$extract1GU + $extract2GU + $extract3GU + $extract4GU + $extract5GU + 
$grain1GU + $grain2GU + $grain3GU + $grain4GU + $grain5GU + $grain6GU + $grain7GU + $grain8GU + $grain9GU + $grain10GU + $grain11GU + $grain12GU + $grain13GU + $grain14GU + $grain15GU +
$adjunct1GU + $adjunct2GU + $adjunct3GU + $adjunct4GU + $adjunct5GU + $adjunct6GU + $adjunct7GU + $adjunct8GU + $adjunct9GU;

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
$brewHops1 = $_POST['brewHops1'];
$brewHops2 = $_POST['brewHops2'];
$brewHops3 = $_POST['brewHops3'];
$brewHops4 = $_POST['brewHops4'];
$brewHops5 = $_POST['brewHops5'];
$brewHops6 = $_POST['brewHops6'];
$brewHops7 = $_POST['brewHops7'];
$brewHops8 = $_POST['brewHops8'];
$brewHops9 = $_POST['brewHops9'];
$brewHops10 = $_POST['brewHops10'];
$brewHops11 = $_POST['brewHops11'];
$brewHops12 = $_POST['brewHops12'];
$brewHops13 = $_POST['brewHops13'];
$brewHops14 = $_POST['brewHops14'];
$brewHops15 = $_POST['brewHops15'];

$brewHops1Weight = $_POST['brewHops1Weight'];
$brewHops2Weight = $_POST['brewHops2Weight'];
$brewHops3Weight = $_POST['brewHops3Weight'];
$brewHops4Weight = $_POST['brewHops4Weight'];
$brewHops5Weight = $_POST['brewHops5Weight'];
$brewHops6Weight = $_POST['brewHops6Weight'];
$brewHops7Weight = $_POST['brewHops7Weight'];
$brewHops8Weight = $_POST['brewHops8Weight'];
$brewHops9Weight = $_POST['brewHops9Weight'];
$brewHops10Weight = $_POST['brewHops10Weight'];
$brewHops11Weight = $_POST['brewHops11Weight'];
$brewHops12Weight = $_POST['brewHops12Weight'];
$brewHops13Weight = $_POST['brewHops13Weight'];
$brewHops14Weight = $_POST['brewHops14Weight'];
$brewHops15Weight = $_POST['brewHops15Weight'];

$brewHops1IBU = $_POST['brewHops1IBU'];
$brewHops2IBU = $_POST['brewHops2IBU'];
$brewHops3IBU = $_POST['brewHops3IBU'];
$brewHops4IBU = $_POST['brewHops4IBU'];
$brewHops5IBU = $_POST['brewHops5IBU'];
$brewHops6IBU = $_POST['brewHops6IBU'];
$brewHops7IBU = $_POST['brewHops7IBU'];
$brewHops8IBU = $_POST['brewHops8IBU'];
$brewHops9IBU = $_POST['brewHops9IBU'];
$brewHops10IBU = $_POST['brewHops10IBU'];
$brewHops11IBU = $_POST['brewHops11IBU'];
$brewHops12IBU = $_POST['brewHops12IBU'];
$brewHops13IBU = $_POST['brewHops13IBU'];
$brewHops14IBU = $_POST['brewHops14IBU'];
$brewHops15IBU = $_POST['brewHops15IBU'];

$brewHops1Time = $_POST['brewHops1Time'];
$brewHops2Time = $_POST['brewHops2Time'];
$brewHops3Time = $_POST['brewHops3Time'];
$brewHops4Time = $_POST['brewHops4Time'];
$brewHops5Time = $_POST['brewHops5Time'];
$brewHops6Time = $_POST['brewHops6Time'];
$brewHops7Time = $_POST['brewHops7Time'];
$brewHops8Time = $_POST['brewHops8Time'];
$brewHops9Time = $_POST['brewHops9Time'];
$brewHops10Time = $_POST['brewHops10Time'];
$brewHops11Time = $_POST['brewHops111Time'];
$brewHops12Time = $_POST['brewHops12Time'];
$brewHops13Time = $_POST['brewHops13Time'];
$brewHops14Time = $_POST['brewHops14Time'];
$brewHops15Time = $_POST['brewHops15Time'];

$brewHops1Form = $_POST['brewHops1Form'];
$brewHops2Form = $_POST['brewHops2Form'];
$brewHops3Form = $_POST['brewHops3Form'];
$brewHops4Form = $_POST['brewHops4Form'];
$brewHops5Form = $_POST['brewHops5Form'];
$brewHops6Form = $_POST['brewHops6Form'];
$brewHops7Form = $_POST['brewHops7Form'];
$brewHops8Form = $_POST['brewHops8Form'];
$brewHops9Form = $_POST['brewHops9Form'];
$brewHops10Form = $_POST['brewHops10Form'];
$brewHops11Form = $_POST['brewHops11Form'];
$brewHops12Form = $_POST['brewHops12Form'];
$brewHops13Form = $_POST['brewHops13Form'];
$brewHops14Form = $_POST['brewHops14Form'];
$brewHops15Form = $_POST['brewHops15Form'];

$wholeFraction = ".85";

// Hop Union has published data suggesting a 5% - 7% difference in utilization
// between whole and pellet (Type 90) hops. Most modern data I've seen supports this range.
// The 15% delta value is a left-over from the old days and appears to have
// been based on speculation at that time.
// Anyways, this really should be a user var they can set in their prefs.
// - Kevin
$wholeFraction = ".94";

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

if (($brewHops1Form == "Plug") || ($brewHops1Form == "Leaf")) $uD1 = convertUtilizationDWhole($brewHops1Time); else $uD1 = convertUtilizationDPellet($brewHops1Time);
if (($brewHops2Form == "Plug") || ($brewHops2Form == "Leaf")) $uD2 = convertUtilizationDWhole($brewHops2Time); else $uD2 = convertUtilizationDPellet($brewHops2Time);
if (($brewHops3Form == "Plug") || ($brewHops3Form == "Leaf")) $uD3 = convertUtilizationDWhole($brewHops3Time); else $uD3 = convertUtilizationDPellet($brewHops3Time);
if (($brewHops4Form == "Plug") || ($brewHops4Form == "Leaf")) $uD4 = convertUtilizationDWhole($brewHops4Time); else $uD4 = convertUtilizationDPellet($brewHops4Time);
if (($brewHops5Form == "Plug") || ($brewHops5Form == "Leaf")) $uD5 = convertUtilizationDWhole($brewHops5Time); else $uD5 = convertUtilizationDPellet($brewHops5Time);
if (($brewHops6Form == "Plug") || ($brewHops6Form == "Leaf")) $uD6 = convertUtilizationDWhole($brewHops6Time); else $uD6 = convertUtilizationDPellet($brewHops6Time);
if (($brewHops7Form == "Plug") || ($brewHops7Form == "Leaf")) $uD7 = convertUtilizationDWhole($brewHops7Time); else $uD7 = convertUtilizationDPellet($brewHops7Time);
if (($brewHops8Form == "Plug") || ($brewHops8Form == "Leaf")) $uD8 = convertUtilizationDWhole($brewHops8Time); else $uD8 = convertUtilizationDPellet($brewHops8Time);
if (($brewHops9Form == "Plug") || ($brewHops9Form == "Leaf")) $uD9 = convertUtilizationDWhole($brewHops9Time); else $uD9 = convertUtilizationDPellet($brewHops9Time);
if (($brewHops10Form == "Plug") || ($brewHops10Form == "Leaf")) $uD10 = convertUtilizationDWhole($brewHops10Time); else $uD10 = convertUtilizationDPellet($brewHops10Time);
if (($brewHops11Form == "Plug") || ($brewHops11Form == "Leaf")) $uD11 = convertUtilizationDWhole($brewHops11Time); else $uD11 = convertUtilizationDPellet($brewHops11Time);
if (($brewHops12Form == "Plug") || ($brewHops12Form == "Leaf")) $uD12 = convertUtilizationDWhole($brewHops12Time); else $uD12 = convertUtilizationDPellet($brewHops12Time);
if (($brewHops13Form == "Plug") || ($brewHops13Form == "Leaf")) $uD13 = convertUtilizationDWhole($brewHops13Time); else $uD13 = convertUtilizationDPellet($brewHops13Time);
if (($brewHops14Form == "Plug") || ($brewHops14Form == "Leaf")) $uD14 = convertUtilizationDWhole($brewHops14Time); else $uD14 = convertUtilizationDPellet($brewHops14Time);
if (($brewHops15Form == "Plug") || ($brewHops15Form == "Leaf")) $uD15 = convertUtilizationDWhole($brewHops15Time); else $uD15 = convertUtilizationDPellet($brewHops15Time);

// Correct gravity
if ($og < 1.050) $cGravity = 1;
if ($og >= 1.050) { $cGravity = 1 + (($og - 1.050) / 0.2); }


// ------------------ Garetz Method ------------------- //
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
$uR1 = convertUtilizationG($brewHops1Time);
$uG2 = convertUtilizationG($brewHops2Time);
$uG3 = convertUtilizationG($brewHops3Time);
$uG4 = convertUtilizationG($brewHops4Time);
$uG5 = convertUtilizationG($brewHops5Time);
$uG6 = convertUtilizationG($brewHops6Time);
$uG7 = convertUtilizationG($brewHops7Time);
$uG8 = convertUtilizationG($brewHops8Time);
$uG9 = convertUtilizationG($brewHops9Time);
$uG10 = convertUtilizationG($brewHops10Time);
$uG11 = convertUtilizationG($brewHops11Time);
$uG12 = convertUtilizationG($brewHops12Time);
$uG13 = convertUtilizationG($brewHops13Time);
$uG14 = convertUtilizationG($brewHops14Time);
$uG15 = convertUtilizationG($brewHops15Time);

// ------------------ Rager Method ------------------- //
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
$uR1 = convertUtilizationR($brewHops1Time);
$uR2 = convertUtilizationR($brewHops2Time);
$uR3 = convertUtilizationR($brewHops3Time);
$uR4 = convertUtilizationR($brewHops4Time);
$uR5 = convertUtilizationR($brewHops5Time);
$uR6 = convertUtilizationR($brewHops6Time);
$uR7 = convertUtilizationR($brewHops7Time);
$uR8 = convertUtilizationR($brewHops8Time);
$uR9 = convertUtilizationR($brewHops9Time);
$uR10 = convertUtilizationR($brewHops10Time);
$uR11 = convertUtilizationR($brewHops11Time);
$uR12 = convertUtilizationR($brewHops12Time);
$uR13 = convertUtilizationR($brewHops13Time);
$uR14 = convertUtilizationR($brewHops14Time);
$uR15 = convertUtilizationR($brewHops15Time);

if ($og > 1.050) $ga = (($og - 1.050) / .2); else $ga = 0;

// ------------------ Tinseth Method --------------- //
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

$decimalAA1 = $bignessFactor * hopBTF($brewHops1Time);
$decimalAA2 = $bignessFactor * hopBTF($brewHops2Time);
$decimalAA3 = $bignessFactor * hopBTF($brewHops3Time);
$decimalAA4 = $bignessFactor * hopBTF($brewHops4Time);
$decimalAA5 = $bignessFactor * hopBTF($brewHops5Time);
$decimalAA6 = $bignessFactor * hopBTF($brewHops6Time);
$decimalAA7 = $bignessFactor * hopBTF($brewHops7Time);
$decimalAA8 = $bignessFactor * hopBTF($brewHops8Time);
$decimalAA9 = $bignessFactor * hopBTF($brewHops9Time);
$decimalAA10 = $bignessFactor * hopBTF($brewHops10Time);
$decimalAA11 = $bignessFactor * hopBTF($brewHops11Time);
$decimalAA12 = $bignessFactor * hopBTF($brewHops12Time);
$decimalAA13 = $bignessFactor * hopBTF($brewHops13Time);
$decimalAA14 = $bignessFactor * hopBTF($brewHops14Time);
$decimalAA15 = $bignessFactor * hopBTF($brewHops15Time);


// Are all the queries below needed? Looks like they can be deleted?
for($i = 1; $i <= 9; ++$i) {
	
    $query_hops = 'query_hops'.$i;
    $hops = 'hops'.$i;
    $row_hops = 'row_hops'.$i;
    $totalRows_hops = 'totalRows_hops'.$i;
	
	mysql_select_db($database_brewing, $brewing);
    $$query_hops = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $_POST['brewHops'.$i]);
    $$hops = mysql_query($$query_hops, $brewing);
    $$row_hops = mysql_fetch_assoc($$hops);
    $$totalRows_hops = mysql_num_rows($$hops);
}



// ------------------------------ Calculations ----------------------------------- //

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
$hopsAAU10 = $brewHops10Weight * $brewHops10IBU;
$hopsAAU11 = $brewHops11Weight * $brewHops11IBU;
$hopsAAU12 = $brewHops12Weight * $brewHops12IBU;
$hopsAAU13 = $brewHops13Weight * $brewHops13IBU;
$hopsAAU14 = $brewHops14Weight * $brewHops14IBU;
$hopsAAU15 = $brewHops15Weight * $brewHops15IBU;

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
$hopsIBUCalc10D = ($brewHops10Weight * $uD10 * ($brewHops10IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc11D = ($brewHops11Weight * $uD11 * ($brewHops11IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc12D = ($brewHops12Weight * $uD12 * ($brewHops12IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc13D = ($brewHops13Weight * $uD13 * ($brewHops13IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc14D = ($brewHops14Weight * $uD14 * ($brewHops14IBU * .01) * 7489) / ($brewYield * $cGravity);
$hopsIBUCalc15D = ($brewHops15Weight * $uD15 * ($brewHops15IBU * .01) * 7489) / ($brewYield * $cGravity);

// Garetz
$hopsIBUCalc1G = ($hopsAAU1 * $uG1) / $brewYield / 1.34; if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1G *= $wholeFraction; 
$hopsIBUCalc2G = ($hopsAAU2 * $uG2) / $brewYield / 1.34; if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug"))  $hopsIBUCalc2G *= $wholeFraction;
$hopsIBUCalc3G = ($hopsAAU3 * $uG3) / $brewYield / 1.34; if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug"))  $hopsIBUCalc3G *= $wholeFraction;
$hopsIBUCalc4G = ($hopsAAU4 * $uG4) / $brewYield / 1.34; if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug"))  $hopsIBUCalc4G *= $wholeFraction;
$hopsIBUCalc5G = ($hopsAAU5 * $uG5) / $brewYield / 1.34; if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug"))  $hopsIBUCalc5G *= $wholeFraction;
$hopsIBUCalc6G = ($hopsAAU6 * $uG6) / $brewYield / 1.34; if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug"))  $hopsIBUCalc6G *= $wholeFraction;
$hopsIBUCalc7G = ($hopsAAU7 * $uG7) / $brewYield / 1.34; if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug"))  $hopsIBUCalc7G *= $wholeFraction;
$hopsIBUCalc8G = ($hopsAAU8 * $uG8) / $brewYield / 1.34; if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug"))  $hopsIBUCalc8G *= $wholeFraction;
$hopsIBUCalc9G = ($hopsAAU9 * $uG9) / $brewYield / 1.34; if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug"))  $hopsIBUCalc9G *= $wholeFraction;
$hopsIBUCalc10G = ($hopsAAU10 * $uG10) / $brewYield / 1.34; if (($brewHops10Form == "Leaf") || ($brewHops10Form == "Plug")) $hopsIBUCalc10G .= "*".$wholeFraction; 
$hopsIBUCalc11G = ($hopsAAU11 * $uG11) / $brewYield / 1.34; if (($brewHops11Form == "Leaf") || ($brewHops11Form == "Plug")) $hopsIBUCalc11G .= "*".$wholeFraction; 
$hopsIBUCalc12G = ($hopsAAU12 * $uG12) / $brewYield / 1.34; if (($brewHops12Form == "Leaf") || ($brewHops12Form == "Plug")) $hopsIBUCalc12G .= "*".$wholeFraction; 
$hopsIBUCalc13G = ($hopsAAU13 * $uG13) / $brewYield / 1.34; if (($brewHops13Form == "Leaf") || ($brewHops13Form == "Plug")) $hopsIBUCalc13G .= "*".$wholeFraction; 
$hopsIBUCalc14G = ($hopsAAU14 * $uG14) / $brewYield / 1.34; if (($brewHops14Form == "Leaf") || ($brewHops14Form == "Plug")) $hopsIBUCalc14G .= "*".$wholeFraction; 
$hopsIBUCalc15G = ($hopsAAU15 * $uG15) / $brewYield / 1.34; if (($brewHops15Form == "Leaf") || ($brewHops15Form == "Plug")) $hopsIBUCalc15G .= "*".$wholeFraction; 

// Rager
$hopsIBUCalc1R = ($brewHops1Weight * $uR1 * ($brewHops1IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1R *= $wholeFraction; 
$hopsIBUCalc2R = ($brewHops2Weight * $uR2 * ($brewHops2IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug"))$hopsIBUCalc2R *= $wholeFraction; 
$hopsIBUCalc3R = ($brewHops3Weight * $uR3 * ($brewHops3IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3R *= $wholeFraction; 
$hopsIBUCalc4R = ($brewHops4Weight * $uR4 * ($brewHops4IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4R *= $wholeFraction; 
$hopsIBUCalc5R = ($brewHops5Weight * $uR5 * ($brewHops5IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5R *= $wholeFraction; 
$hopsIBUCalc6R = ($brewHops6Weight * $uR6 * ($brewHops6IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6R *= $wholeFraction; 
$hopsIBUCalc7R = ($brewHops7Weight * $uR7 * ($brewHops7IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7R *= $wholeFraction; 
$hopsIBUCalc8R = ($brewHops8Weight * $uR8 * ($brewHops8IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8R *= $wholeFraction; 
$hopsIBUCalc9R = ($brewHops9Weight * $uR9 * ($brewHops9IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9R *= $wholeFraction; 
$hopsIBUCalc10R = ($brewHops10Weight * $uR10 * ($brewHops10IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops10Form == "Leaf") || ($brewHops10Form == "Plug")) $hopsIBUCalc10R .= "*".$wholeFraction; 
$hopsIBUCalc11R = ($brewHops11Weight * $uR11 * ($brewHops11IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops11Form == "Leaf") || ($brewHops11Form == "Plug")) $hopsIBUCalc11R .= "*".$wholeFraction; 
$hopsIBUCalc12R = ($brewHops12Weight * $uR12 * ($brewHops12IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops12Form == "Leaf") || ($brewHops12Form == "Plug")) $hopsIBUCalc12R .= "*".$wholeFraction; 
$hopsIBUCalc13R = ($brewHops13Weight * $uR13 * ($brewHops13IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops13Form == "Leaf") || ($brewHops13Form == "Plug")) $hopsIBUCalc13R .= "*".$wholeFraction; 
$hopsIBUCalc14R = ($brewHops14Weight * $uR14 * ($brewHops14IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops14Form == "Leaf") || ($brewHops14Form == "Plug")) $hopsIBUCalc14R .= "*".$wholeFraction; 
$hopsIBUCalc15tR = ($brewHops15Weight * $uR15 * ($brewHops15IBU / 100) * 7489) / ($brewYield * (1 + $ga)); if (($brewHops15Form == "Leaf") || ($brewHops15Form == "Plug")) $hopsIBUCalc15R .= "*".$wholeFraction; 

// Tinseth
// The Tinseth formula is based on whole hops so, do the calc for that and then
// convert to pellet if necessary.
$hopsIBUCalc1T = $decimalAA1 * ((($brewHops1IBU / 100) * $brewHops1Weight * 7489) / $brewYield); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1T *= $wholeFraction; 
$hopsIBUCalc2T = $decimalAA2 * ((($brewHops2IBU / 100) * $brewHops2Weight * 7489) / $brewYield); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2T *= $wholeFraction; 
$hopsIBUCalc3T = $decimalAA3 * ((($brewHops3IBU / 100) * $brewHops3Weight * 7489) / $brewYield); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3T *= $wholeFraction; 
$hopsIBUCalc4T = $decimalAA4 * ((($brewHops4IBU / 100) * $brewHops4Weight * 7489) / $brewYield); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4T *= $wholeFraction; 
$hopsIBUCalc5T = $decimalAA5 * ((($brewHops5IBU / 100) * $brewHops5Weight * 7489) / $brewYield); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5T *= $wholeFraction; 
$hopsIBUCalc6T = $decimalAA6 * ((($brewHops6IBU / 100) * $brewHops6Weight * 7489) / $brewYield); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6T *= $wholeFraction; 
$hopsIBUCalc7T = $decimalAA7 * ((($brewHops7IBU / 100) * $brewHops7Weight * 7489) / $brewYield); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7T *= $wholeFraction; 
$hopsIBUCalc8T = $decimalAA8 * ((($brewHops8IBU / 100) * $brewHops8Weight * 7489) / $brewYield); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8T *= $wholeFraction; 
$hopsIBUCalc9T = $decimalAA9 * ((($brewHops9IBU / 100) * $brewHops9Weight * 7489) / $brewYield); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9T *= $wholeFraction; 
$hopsIBUCalc10T = $decimalAA10 * ((($brewHops10IBU / 100) * $brewHops10Weight * 7489) / $brewYield); if (($brewHops10Form == "Leaf") || ($brewHops10Form == "Plug")) $hopsIBUCalc10T .= "*".$wholeFraction; 
$hopsIBUCalc11T = $decimalAA11 * ((($brewHops11IBU / 100) * $brewHops11Weight * 7489) / $brewYield); if (($brewHops11Form == "Leaf") || ($brewHops11Form == "Plug")) $hopsIBUCalc11T .= "*".$wholeFraction; 
$hopsIBUCalc12T = $decimalAA12 * ((($brewHops12IBU / 100) * $brewHops12Weight * 7489) / $brewYield); if (($brewHops12Form == "Leaf") || ($brewHops12Form == "Plug")) $hopsIBUCalc12T .= "*".$wholeFraction; 
$hopsIBUCalc13T = $decimalAA13 * ((($brewHops13IBU / 100) * $brewHops13Weight * 7489) / $brewYield); if (($brewHops13Form == "Leaf") || ($brewHops13Form == "Plug")) $hopsIBUCalc13T .= "*".$wholeFraction; 
$hopsIBUCalc14T = $decimalAA14 * ((($brewHops14IBU / 100) * $brewHops14Weight * 7489) / $brewYield); if (($brewHops14Form == "Leaf") || ($brewHops14Form == "Plug")) $hopsIBUCalc14T .= "*".$wholeFraction; 
$hopsIBUCalc15T = $decimalAA15 * ((($brewHops15IBU / 100) * $brewHops15Weight * 7489) / $brewYield); if (($brewHops15Form == "Leaf") || ($brewHops15Form == "Plug")) $hopsIBUCalc15T .= "*".$wholeFraction; 
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
$hopsAAU10 = ($brewHops10Weight * .0353) * $brewHops10IBU;
$hopsAAU11 = ($brewHops11Weight * .0353) * $brewHops11IBU;
$hopsAAU12 = ($brewHops12Weight * .0353) * $brewHops12IBU;
$hopsAAU13 = ($brewHops13Weight * .0353) * $brewHops13IBU;
$hopsAAU14 = ($brewHops14Weight * .0353) * $brewHops14IBU;
$hopsAAU15 = ($brewHops15Weight * .0353) * $brewHops15IBU;

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
$hopsIBUCalc10D = ($brewHops10Weight * $uD10 * ($brewHops10IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc11D = ($brewHops11Weight * $uD11 * ($brewHops11IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc12D = ($brewHops12Weight * $uD12 * ($brewHops12IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc13D = ($brewHops13Weight * $uD13 * ($brewHops13IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc14D = ($brewHops14Weight * $uD14 * ($brewHops14IBU * .01) * 1000) / ($brewYield * $cGravity);
$hopsIBUCalc15D = ($brewHops15Weight * $uD15 * ($brewHops15IBU * .01) * 1000) / ($brewYield * $cGravity);

// Garetz
$hopsIBUCalc1G = ($hopsAAU1 * $uG1) / ($brewYield * .2642) / 1.34;  if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1G *= $wholeFraction;
$hopsIBUCalc2G = ($hopsAAU2 * $uG2) / ($brewYield * .2642) / 1.34;  if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2G *= $wholeFraction;
$hopsIBUCalc3G = ($hopsAAU3 * $uG3) / ($brewYield * .2642) / 1.34;  if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3G *= $wholeFraction;
$hopsIBUCalc4G = ($hopsAAU4 * $uG4) / ($brewYield * .2642) / 1.34;  if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4G *= $wholeFraction;
$hopsIBUCalc5G = ($hopsAAU5 * $uG5) / ($brewYield * .2642) / 1.34;  if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5G *= $wholeFraction;
$hopsIBUCalc6G = ($hopsAAU6 * $uG6) / ($brewYield * .2642) / 1.34;  if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6G *= $wholeFraction;
$hopsIBUCalc7G = ($hopsAAU7 * $uG7) / ($brewYield * .2642) / 1.34;  if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7G *= $wholeFraction;
$hopsIBUCalc8G = ($hopsAAU8 * $uG8) / ($brewYield * .2642) / 1.34;  if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8G *= $wholeFraction;
$hopsIBUCalc9G = ($hopsAAU9 * $uG9) / ($brewYield * .2642) / 1.34;  if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9G *= $wholeFraction;
$hopsIBUCalc10G = ($hopsAAU10 * $uG10) / ($brewYield * .2642) / 1.34;  if (($brewHops10Form == "Leaf") || ($brewHops10Form == "Plug")) $hopsIBUCalc10G .= "*".$wholeFraction;
$hopsIBUCalc11G = ($hopsAAU11 * $uG11) / ($brewYield * .2642) / 1.34;  if (($brewHops11Form == "Leaf") || ($brewHops11Form == "Plug")) $hopsIBUCalc11G .= "*".$wholeFraction;
$hopsIBUCalc12G = ($hopsAAU12 * $uG12) / ($brewYield * .2642) / 1.34;  if (($brewHops12Form == "Leaf") || ($brewHops12Form == "Plug")) $hopsIBUCalc12G .= "*".$wholeFraction;
$hopsIBUCalc13G = ($hopsAAU13 * $uG13) / ($brewYield * .2642) / 1.34;  if (($brewHops13Form == "Leaf") || ($brewHops13Form == "Plug")) $hopsIBUCalc13G .= "*".$wholeFraction;
$hopsIBUCalc14G = ($hopsAAU14 * $uG14) / ($brewYield * .2642) / 1.34;  if (($brewHops14Form == "Leaf") || ($brewHops14Form == "Plug")) $hopsIBUCalc14G .= "*".$wholeFraction;
$hopsIBUCalc15G = ($hopsAAU15 * $uG15) / ($brewYield * .2642) / 1.34;  if (($brewHops15Form == "Leaf") || ($brewHops15Form == "Plug")) $hopsIBUCalc15G .= "*".$wholeFraction;

// Rager
$hopsIBUCalc1R = (($brewHops1Weight * .0353) * $uR1 * ($brewHops1IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1R *= $wholeFraction;
$hopsIBUCalc2R = (($brewHops2Weight * .0353) * $uR2 * ($brewHops2IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2R *= $wholeFraction;
$hopsIBUCalc3R = (($brewHops3Weight * .0353) * $uR3 * ($brewHops3IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3R *= $wholeFraction;
$hopsIBUCalc4R = (($brewHops4Weight * .0353) * $uR4 * ($brewHops4IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4R *= $wholeFraction;
$hopsIBUCalc5R = (($brewHops5Weight * .0353) * $uR5 * ($brewHops5IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5R *= $wholeFraction;
$hopsIBUCalc6R = (($brewHops6Weight * .0353) * $uR6 * ($brewHops6IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6R *= $wholeFraction;
$hopsIBUCalc7R = (($brewHops7Weight * .0353) * $uR7 * ($brewHops7IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7R *= $wholeFraction;
$hopsIBUCalc8R = (($brewHops8Weight * .0353) * $uR8 * ($brewHops8IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8R *= $wholeFraction;
$hopsIBUCalc9R = (($brewHops9Weight * .0353) * $uR9 * ($brewHops9IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9R *= $wholeFraction;
$hopsIBUCalc10R = (($brewHops10Weight * .0353) * $uR10 * ($brewHops10IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops10Form == "Leaf") || ($brewHops10Form == "Plug")) $hopsIBUCalc10R .= "*".$wholeFraction;
$hopsIBUCalc11R = (($brewHops11Weight * .0353) * $uR11 * ($brewHops11IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops11Form == "Leaf") || ($brewHops11Form == "Plug")) $hopsIBUCalc11R .= "*".$wholeFraction;
$hopsIBUCalc12R = (($brewHops12Weight * .0353) * $uR12 * ($brewHops12IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops12Form == "Leaf") || ($brewHops12Form == "Plug")) $hopsIBUCalc12R .= "*".$wholeFraction;
$hopsIBUCalc13R = (($brewHops13Weight * .0353) * $uR13 * ($brewHops13IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops13Form == "Leaf") || ($brewHops13Form == "Plug")) $hopsIBUCalc13R .= "*".$wholeFraction;
$hopsIBUCalc14R = (($brewHops14Weight * .0353) * $uR14 * ($brewHops14IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops14Form == "Leaf") || ($brewHops14Form == "Plug")) $hopsIBUCalc14R .= "*".$wholeFraction;
$hopsIBUCalc15R = (($brewHops15Weight * .0353) * $uR15 * ($brewHops15IBU / 100) * 1000) / (($brewYield * .2642) * (1 + $ga)); if (($brewHops15Form == "Leaf") || ($brewHops15Form == "Plug")) $hopsIBUCalc15R .= "*".$wholeFraction;

// Tinseth
$hopsIBUCalc1T = $decimalAA1 * ((($brewHops1IBU / 100) * ($brewHops1Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops1Form == "Leaf") || ($brewHops1Form == "Plug")) $hopsIBUCalc1T *= $wholeFraction; 
$hopsIBUCalc2T = $decimalAA2 * ((($brewHops2IBU / 100) * ($brewHops2Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops2Form == "Leaf") || ($brewHops2Form == "Plug")) $hopsIBUCalc2T *= $wholeFraction; 
$hopsIBUCalc3T = $decimalAA3 * ((($brewHops3IBU / 100) * ($brewHops3Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops3Form == "Leaf") || ($brewHops3Form == "Plug")) $hopsIBUCalc3T *= $wholeFraction; 
$hopsIBUCalc4T = $decimalAA4 * ((($brewHops4IBU / 100) * ($brewHops4Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops4Form == "Leaf") || ($brewHops4Form == "Plug")) $hopsIBUCalc4T *= $wholeFraction; 
$hopsIBUCalc5T = $decimalAA5 * ((($brewHops5IBU / 100) * ($brewHops5Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops5Form == "Leaf") || ($brewHops5Form == "Plug")) $hopsIBUCalc5T *= $wholeFraction; 
$hopsIBUCalc6T = $decimalAA6 * ((($brewHops6IBU / 100) * ($brewHops6Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops6Form == "Leaf") || ($brewHops6Form == "Plug")) $hopsIBUCalc6T *= $wholeFraction; 
$hopsIBUCalc7T = $decimalAA7 * ((($brewHops7IBU / 100) * ($brewHops7Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops7Form == "Leaf") || ($brewHops7Form == "Plug")) $hopsIBUCalc7T *= $wholeFraction; 
$hopsIBUCalc8T = $decimalAA8 * ((($brewHops8IBU / 100) * ($brewHops8Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops8Form == "Leaf") || ($brewHops8Form == "Plug")) $hopsIBUCalc8T *= $wholeFraction; 
$hopsIBUCalc9T = $decimalAA9 * ((($brewHops9IBU / 100) * ($brewHops9Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops9Form == "Leaf") || ($brewHops9Form == "Plug")) $hopsIBUCalc9T *= $wholeFraction; 
$hopsIBUCalc10T = $decimalAA10 * ((($brewHops10IBU / 100) * ($brewHops10Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops10Form == "Leaf") || ($brewHops10Form == "Plug")) $hopsIBUCalc10T .= "*".$wholeFraction; 
$hopsIBUCalc11T = $decimalAA11 * ((($brewHops11IBU / 100) * ($brewHops11Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops11Form == "Leaf") || ($brewHops11Form == "Plug")) $hopsIBUCalc11T .= "*".$wholeFraction; 
$hopsIBUCalc12T = $decimalAA12 * ((($brewHops12IBU / 100) * ($brewHops12Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops12Form == "Leaf") || ($brewHops12Form == "Plug")) $hopsIBUCalc12T .= "*".$wholeFraction; 
$hopsIBUCalc13T = $decimalAA13 * ((($brewHops13IBU / 100) * ($brewHops13Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops13Form == "Leaf") || ($brewHops13Form == "Plug")) $hopsIBUCalc13T .= "*".$wholeFraction; 
$hopsIBUCalc14T = $decimalAA14 * ((($brewHops14IBU / 100) * ($brewHops14Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops14Form == "Leaf") || ($brewHops14Form == "Plug")) $hopsIBUCalc14T .= "*".$wholeFraction; 
$hopsIBUCalc15T = $decimalAA15 * ((($brewHops15IBU / 100) * ($brewHops15Weight * .0353) * 1000) / ($brewYield * .2642)); if (($brewHops15Form == "Leaf") || ($brewHops15Form == "Plug")) $hopsIBUCalc15T .= "*".$wholeFraction; 
}

// Bitterness Calculations
// Daniels
$bitternessD = $hopsIBUCalc1D + $hopsIBUCalc2D + $hopsIBUCalc3D + $hopsIBUCalc4D + $hopsIBUCalc5D + $hopsIBUCalc6D + $hopsIBUCalc7D + $hopsIBUCalc8D + $hopsIBUCalc9D + $hopsIBUCalc10D + $hopsIBUCalc11D + $hopsIBUCalc12D + $hopsIBUCalc13D + $hopsIBUCalc14D + $hopsIBUCalc15D ;

// Garetz
$bitternessG = $hopsIBUCalc1G + $hopsIBUCalc2G + $hopsIBUCalc3G + $hopsIBUCalc4G + $hopsIBUCalc5G + $hopsIBUCalc6G + $hopsIBUCalc7G + $hopsIBUCalc8G + $hopsIBUCalc9G + $hopsIBUCalc10G + $hopsIBUCalc11G + $hopsIBUCalc12G + $hopsIBUCalc13G + $hopsIBUCalc14G + $hopsIBUCalc15G;

// Rager
$bitternessR = $hopsIBUCalc1R + $hopsIBUCalc2R + $hopsIBUCalc3R + $hopsIBUCalc4R + $hopsIBUCalc5R + $hopsIBUCalc6R + $hopsIBUCalc7R + $hopsIBUCalc8R + $hopsIBUCalc9R + $hopsIBUCalc10R + $hopsIBUCalc11R + $hopsIBUCalc12R + $hopsIBUCalc13R + $hopsIBUCalc14R + $hopsIBUCalc15R;

// Tinseth
$bitternessT = $hopsIBUCalc1T + $hopsIBUCalc2T + $hopsIBUCalc3T + $hopsIBUCalc4T + $hopsIBUCalc5T + $hopsIBUCalc6T + $hopsIBUCalc7T + $hopsIBUCalc8T + $hopsIBUCalc9T + $hopsIBUCalc10T + $hopsIBUCalc11T + $hopsIBUCalc12T + $hopsIBUCalc13T + $hopsIBUCalc14T + $hopsIBUCalc15T;


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


$SRMTotal = $SRM1 + $SRM2 + $SRM3 + $SRM4 + $SRM5 + $SRM6 + $SRM7 + $SRM8 + $SRM9 + $SRM10 + $SRM11 + $SRM12 + $SRM13 + $SRM14 + $SRM15 + $SRM16 + $SRM17 + $SRM18 + $SRM19 + $SRM20 + $SRM21 + $SRM22 + $SRM23 + $SRM24 + $SRM25 + $SRM26 + $SRM27 + $SRM28 + $SRM29; 
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

// GU:BU Ratio

if ((($bitternessG != 0) || ($bitternessR != 0) || ($bitternessT != 0) || ($bitternessD != 0)) && ($totalGU != 0)) {
$bitternessAvg = ($bitternessG + $bitternessR + $bitternessT + $bitternessD) / 4;
if ($results != "verify") {
$bugu = $bitternessAvg /(($og - 1) * 1000); 
}
}
?>