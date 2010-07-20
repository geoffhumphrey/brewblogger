<?php
mysql_select_db($database_brewing, $brewing);

if ($results == "true") {
/*
The first section here gathers the required information to 
perform calculations from the HTML form.
*/
// ----------------------------- General Information ---------------------
$brewName = strtr($_POST['brewName'], $string);
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

$brewLovibond = $_POST['brewLovibond'];
$brewOG = $_POST['brewOG'];
$brewFG = $_POST['brewFG'];

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
    $$totalRows_adjunct = mysql_num_rows($$adjunct);
}

// Extract Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$extract1GU = $brewExtract1Weight * $row_extract1['extractYield'];
$extract2GU = $brewExtract2Weight * $row_extract2['extractYield'];
$extract3GU = $brewExtract3Weight * $row_extract3['extractYield'];
$extract4GU = $brewExtract4Weight * $row_extract4['extractYield'];
$extract5GU = $brewExtract5Weight * $row_extract5['extractYield'];
}

if ($row_pref['measWeight2'] == "kilograms") { 
$extract1GU = ($brewExtract1Weight * 2.2046) * $row_extract1['extractYield'];
$extract2GU = ($brewExtract2Weight * 2.2046) * $row_extract2['extractYield'];
$extract3GU = ($brewExtract3Weight * 2.2046) * $row_extract3['extractYield'];
$extract4GU = ($brewExtract4Weight * 2.2046) * $row_extract4['extractYield'];
$extract5GU = ($brewExtract5Weight * 2.2046) * $row_extract5['extractYield'];
}

// Grain Gravity Units (GU)
if ($row_pref['measWeight2'] == "pounds") { 
$grain1GU = $brewGrain1Weight * $row_grain1['maltYield'];
$grain2GU = $brewGrain2Weight * $row_grain2['maltYield']; 
$grain3GU = $brewGrain3Weight * $row_grain3['maltYield']; 
$grain4GU = $brewGrain4Weight * $row_grain4['maltYield']; 
$grain5GU = $brewGrain5Weight * $row_grain5['maltYield']; 
$grain6GU = $brewGrain6Weight * $row_grain6['maltYield']; 
$grain7GU = $brewGrain7Weight * $row_grain7['maltYield']; 
$grain8GU = $brewGrain8Weight * $row_grain8['maltYield']; 
$grain9GU = $brewGrain9Weight * $row_grain9['maltYield']; 
}

if ($row_pref['measWeight2'] == "kilograms") { 
$grain1GU = ($brewGrain1Weight * 2.2046) * $row_grain1['maltYield'];
$grain2GU = ($brewGrain2Weight * 2.2046) * $row_grain2['maltYield']; 
$grain3GU = ($brewGrain3Weight * 2.2046) * $row_grain3['maltYield']; 
$grain4GU = ($brewGrain4Weight * 2.2046) * $row_grain4['maltYield']; 
$grain5GU = ($brewGrain5Weight * 2.2046) * $row_grain5['maltYield']; 
$grain6GU = ($brewGrain6Weight * 2.2046) * $row_grain6['maltYield']; 
$grain7GU = ($brewGrain7Weight * 2.2046) * $row_grain7['maltYield']; 
$grain8GU = ($brewGrain8Weight * 2.2046) * $row_grain8['maltYield']; 
$grain9GU = ($brewGrain9Weight * 2.2046) * $row_grain9['maltYield']; 
}

// Adjunct Gravity Units
if ($row_pref['measWeight2'] == "pounds") {
$adjunct1GU = $brewAdjunct1Weight * $row_adjuncts1['adjunctYield'];
$adjunct2GU = $brewAdjunct2Weight * $row_adjuncts2['adjunctYield'];
$adjunct3GU = $brewAdjunct3Weight * $row_adjuncts3['adjunctYield'];
$adjunct4GU = $brewAdjunct4Weight * $row_adjuncts4['adjunctYield'];
$adjunct5GU = $brewAdjunct5Weight * $row_adjuncts5['adjunctYield'];
$adjunct6GU = $brewAdjunct6Weight * $row_adjuncts6['adjunctYield'];
$adjunct7GU = $brewAdjunct7Weight * $row_adjuncts7['adjunctYield'];
$adjunct8GU = $brewAdjunct8Weight * $row_adjuncts8['adjunctYield'];
$adjunct9GU = $brewAdjunct9Weight * $row_adjuncts9['adjunctYield'];
}

if ($row_pref['measWeight2'] == "kilograms") {
$adjunct1GU = ($brewAdjunct1Weight * 2.2046) * $row_adjuncts1['adjunctYield'];
$adjunct2GU = ($brewAdjunct2Weight * 2.2046) * $row_adjuncts2['adjunctYield'];
$adjunct3GU = ($brewAdjunct3Weight * 2.2046) * $row_adjuncts3['adjunctYield'];
$adjunct4GU = ($brewAdjunct4Weight * 2.2046) * $row_adjuncts4['adjunctYield'];
$adjunct5GU = ($brewAdjunct5Weight * 2.2046) * $row_adjuncts5['adjunctYield'];
$adjunct6GU = ($brewAdjunct6Weight * 2.2046) * $row_adjuncts6['adjunctYield'];
$adjunct7GU = ($brewAdjunct7Weight * 2.2046) * $row_adjuncts7['adjunctYield'];
$adjunct8GU = ($brewAdjunct8Weight * 2.2046) * $row_adjuncts8['adjunctYield'];
$adjunct9GU = ($brewAdjunct9Weight * 2.2046) * $row_adjuncts9['adjunctYield'];
}

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
$brewHops11Time = $_POST['brewHops11Time'];
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
}
if ($results == "verify") { 
$brewBrewerID = $_POST['loginUsername'];
$brewName = $_POST['brewName'];
$brewYield = $_POST['brewYield'];
$brewStyle = $_POST['brewStyle'];
$brewLovibond = $_POST['brewLovibond'];
$bitternessR = $_POST['bitternessR'];
$bitternessG = $_POST['bitternessG'];
$bitternessT = $_POST['bitternessT'];
$bitternessD = $_POST['bitternessD'];
$bitternessAvg = $_POST['bitternessAvg'];
$brewOG = $_POST['brewOG'];
$brewFG = $_POST['brewFG'];
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
$brewAdjunct1 = $_POST['brewAdjunct1'];
$brewAdjunct2 = $_POST['brewAdjunct2'];
$brewAdjunct3 = $_POST['brewAdjunct3'];
$brewAdjunct4 = $_POST['brewAdjunct4'];
$brewAdjunct5 = $_POST['brewAdjunct6'];
$brewAdjunct6 = $_POST['brewAdjunct7'];
$brewAdjunct7 = $_POST['brewAdjunct8'];
$brewAdjunct8 = $_POST['brewAdjunct9'];
$brewAdjunct9 = $_POST['brewAdjunct5'];
$brewAdjunct1Weight = $_POST['brewAdjunct1Weight'];
$brewAdjunct2Weight = $_POST['brewAdjunct2Weight'];
$brewAdjunct3Weight = $_POST['brewAdjunct3Weight'];
$brewAdjunct4Weight = $_POST['brewAdjunct4Weight'];
$brewAdjunct5Weight = $_POST['brewAdjunct5Weight'];
$brewAdjunct6Weight = $_POST['brewAdjunct6Weight'];
$brewAdjunct7Weight = $_POST['brewAdjunct7Weight'];
$brewAdjunct8Weight = $_POST['brewAdjunct8Weight'];
$brewAdjunct9Weight = $_POST['brewAdjunct9Weight'];
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
$brewHops6IBU= $_POST['brewHops6IBU'];
$brewHops7IBU= $_POST['brewHops7IBU'];
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

}
?>