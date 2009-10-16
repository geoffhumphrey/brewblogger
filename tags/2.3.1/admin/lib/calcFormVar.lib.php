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


$query_extract1 = "SELECT * FROM extract WHERE extractName='$brewExtract1'";
$extract1 = mysql_query($query_extract1, $brewing) or die(mysql_error());
$row_extract1 = mysql_fetch_assoc($extract1);


$query_extract2 = "SELECT * FROM extract WHERE extractName='$brewExtract2'";
$extract2 = mysql_query($query_extract2, $brewing) or die(mysql_error());
$row_extract2 = mysql_fetch_assoc($extract2);


$query_extract3 = "SELECT * FROM extract WHERE extractName='$brewExtract3'";
$extract3 = mysql_query($query_extract3, $brewing) or die(mysql_error());
$row_extract3 = mysql_fetch_assoc($extract3);


$query_extract4 = "SELECT * FROM extract WHERE extractName='$brewExtract4'";
$extract4 = mysql_query($query_extract4, $brewing) or die(mysql_error());
$row_extract4 = mysql_fetch_assoc($extract4);


$query_extract5 = "SELECT * FROM extract WHERE extractName='$brewExtract5'";
$extract5 = mysql_query($query_extract5, $brewing) or die(mysql_error());
$row_extract5 = mysql_fetch_assoc($extract5);

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


$query_grain1 = "SELECT * FROM malt WHERE maltName='$brewGrain1'";
$grain1 = mysql_query($query_grain1, $brewing) or die(mysql_error());
$row_grain1 = mysql_fetch_assoc($grain1);


$query_grain2 = "SELECT * FROM malt WHERE maltName='$brewGrain2'";
$grain2 = mysql_query($query_grain2, $brewing) or die(mysql_error());
$row_grain2 = mysql_fetch_assoc($grain2);


$query_grain3 = "SELECT * FROM malt WHERE maltName='$brewGrain3'";
$grain3 = mysql_query($query_grain3, $brewing) or die(mysql_error());
$row_grain3 = mysql_fetch_assoc($grain3);


$query_grain4 = "SELECT * FROM malt WHERE maltName='$brewGrain4'";
$grain4 = mysql_query($query_grain4, $brewing) or die(mysql_error());
$row_grain4 = mysql_fetch_assoc($grain4);


$query_grain5 = "SELECT * FROM malt WHERE maltName='$brewGrain5'";
$grain5 = mysql_query($query_grain5, $brewing) or die(mysql_error());
$row_grain5 = mysql_fetch_assoc($grain5);


$query_grain6 = "SELECT * FROM malt WHERE maltName='$brewGrain6'";
$grain6 = mysql_query($query_grain6, $brewing) or die(mysql_error());
$row_grain6 = mysql_fetch_assoc($grain6);


$query_grain7 = "SELECT * FROM malt WHERE maltName='$brewGrain7'";
$grain7 = mysql_query($query_grain7, $brewing) or die(mysql_error());
$row_grain7 = mysql_fetch_assoc($grain7);


$query_grain8 = "SELECT * FROM malt WHERE maltName='$brewGrain8'";
$grain8 = mysql_query($query_grain8, $brewing) or die(mysql_error());
$row_grain8 = mysql_fetch_assoc($grain8);


$query_grain9 = "SELECT * FROM malt WHERE maltName='$brewGrain9'";
$grain9 = mysql_query($query_grain9, $brewing) or die(mysql_error());
$row_grain9 = mysql_fetch_assoc($grain9);

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


$query_adjuncts1 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct1'";
$adjuncts1 = mysql_query($query_adjuncts1, $brewing) or die(mysql_error());
$row_adjuncts1 = mysql_fetch_assoc($adjuncts1);


$query_adjuncts2 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct2'";
$adjuncts2 = mysql_query($query_adjuncts2, $brewing) or die(mysql_error());
$row_adjuncts2 = mysql_fetch_assoc($adjuncts2);


$query_adjuncts3 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct3'";
$adjuncts3 = mysql_query($query_adjuncts3, $brewing) or die(mysql_error());
$row_adjuncts3 = mysql_fetch_assoc($adjuncts3);


$query_adjuncts4 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct4'";
$adjuncts4 = mysql_query($query_adjuncts4, $brewing) or die(mysql_error());
$row_adjuncts4 = mysql_fetch_assoc($adjuncts4);


$query_adjuncts5 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct5'";
$adjuncts5 = mysql_query($query_adjuncts5, $brewing) or die(mysql_error());
$row_adjuncts5 = mysql_fetch_assoc($adjuncts5);


$query_adjuncts6 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct6'";
$adjuncts6 = mysql_query($query_adjuncts6, $brewing) or die(mysql_error());
$row_adjuncts6 = mysql_fetch_assoc($adjuncts6);


$query_adjuncts7 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct7'";
$adjuncts7 = mysql_query($query_adjuncts7, $brewing) or die(mysql_error());
$row_adjuncts7 = mysql_fetch_assoc($adjuncts7);


$query_adjuncts8 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct8'";
$adjuncts8 = mysql_query($query_adjuncts8, $brewing) or die(mysql_error());
$row_adjuncts8 = mysql_fetch_assoc($adjuncts8);


$query_adjuncts9 = "SELECT * FROM adjuncts WHERE adjunctName='$brewAdjunct9'";
$adjuncts9 = mysql_query($query_adjuncts9, $brewing) or die(mysql_error());
$row_adjuncts9 = mysql_fetch_assoc($adjuncts9);

/*
$brewAdjunct1 = $row_adjuncts1['adjunctName'];
$brewAdjunct2 = $row_adjuncts2['adjunctName'];
$brewAdjunct3 = $row_adjuncts3['adjunctName'];
$brewAdjunct4 = $row_adjuncts4['adjunctName'];
$brewAdjunct5 = $row_adjuncts5['adjunctName'];
$brewAdjunct6 = $row_adjuncts6['adjunctName'];
$brewAdjunct7 = $row_adjuncts7['adjunctName'];
$brewAdjunct8 = $row_adjuncts8['adjunctName'];
$brewAdjunct9 = $row_adjuncts9['adjunctName'];
*/

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