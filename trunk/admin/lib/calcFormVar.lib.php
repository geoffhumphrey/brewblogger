<?php
/**
 * Module: calcFormVar.lib.php
 * Description: Load form variables for processing...may be mostly unneccessary?
 */

// This file needs review for it's relevancy. It looks like there might be
// a lot of redundancy going on b/t this file and calculate.lib.php

  // this shouldn't be needed
  //mysql_select_db($database_brewing, $brewing);

  // $results == ["true" | "verify"]
if ($results == "true") {
  /*
   The first section here gathers the required information from the
   HTML form to perform calculations.
  */
  // ----------------------------- General Information ---------------------
  /*
  $brewName       = strtr($_POST['brewName'], $string);
  $efficiency     = ($_POST['efficiency'] * .01);
  $attenuation    = ($_POST['attenuation'] * .01);
  $brewYield      = $_POST['brewYield'];
  // $gravity = $_POST['gravity'];
  $measureWeight1 = $row_pref['measWeight1']; 

  // Style
  $brewStyle = $_POST['brewStyle'];

  $query_style1 = "SELECT * FROM styles WHERE brewStyle='$brewStyle'";
  $style1 = mysql_query($query_style1, $brewing) or die(mysql_error());
  $row_style1 = mysql_fetch_assoc($style1);
  */
  //  $brewLovibond = $_POST['brewLovibond'];

  //only used in "verify"
  //  $brewOG = $_POST['brewOG'];
  //  $brewFG = $_POST['brewFG'];

  // ------------------------------ Extracts -------------------------------
  /*
  for ($i = 0; $i < MAX_EXT; $i++) {
    $extName[$i]   = $_POST['extName'][$i];
    $extWeight[$i] = $_POST['extWeight'][$i];
    
    $query          = "SELECT extractPPG, extractLovibondLow, extractLovibondHigh FROM extract where extractName='$extName[$i]'";
    $result         = mysql_query($query, $brewing) or die(mysql_error());
    $row            = mysql_fetch_array($result);
    $extPPG[$i]     = $row['extractPPG'];
    $extLovLow[$i]  = $row['extractLovibondLow'];
    $extLovHigh[$i] = $row['extractLovibondHigh'];
  }

  /*
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

  for ($i = 1; $i <= 15; ++$i) {
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
  */

  // ------------------------------ Grains ---------------------------------
  /*
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
  
  for ($i = 1; $i <= 15; ++$i) {
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
  */
  // ------------------------------ Adjuncts -------------------------------
  /*
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
 
  for ($i = 1; $i <= 9; ++$i) {
    $query_adjunct = 'query_adjunct'.$i;
    $adjunct = 'adjunct'.$i;
    $row_adjunct = 'row_adjunct'.$i;
    $totalRows_adjunct = 'totalRows_adjunct'.$i;
	
    mysql_select_db($database_brewing, $brewing);
    $$query_adjunct = sprintf("SELECT adjunctYield, adjunctLovibond FROM adjuncts WHERE adjunctName='%s'", $_POST['brewAdjunct'.$i]);
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
  */
  // ------------------------------ Hops -----------------------------------
  /*
  for ($i = 0; $i < MAX_HOPS; $i++) {
    $brewHopsName[$i]   = $_POST['brewHopsName'][$i];
    $brewHopsWeight[$i] = $_POST['brewHopsWeight'][$i];
    $brewHopsAA[$i]     = $_POST['brewHopsAA'][$i];
    $brewHopsTime[$i]   = $_POST['brewHopsTime'][$i];
    $brewHopsForm[$i]   = $_POST['brewHopsForm'][$i];
  }

  /* can this block be deleted? */
  /*  for ($i = 1; $i <= 15; ++$i) {
    $query_hops = 'query_hops'.$i;
    $hops = 'hops'.$i;
    $row_hops = 'row_hops'.$i;
    $totalRows_hops = 'totalRows_hops'.$i;
   
    mysql_select_db($database_brewing, $brewing);
    //$$query_hops = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $_POST['brewHops'.$i]);
    $$query_hops = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $brewHopsName[$i-1]);
    $$hops = mysql_query($$query_hops, $brewing);
    $$row_hops = mysql_fetch_assoc($$hops);
    $$totalRows_hops = mysql_num_rows($$hops);
  }
  */
} else {
  // $results == "verify"

  $brewBrewerID = $_POST['loginUsername'];
  $brewName     = $_POST['brewName'];
  $brewYield    = $_POST['brewYield'];
  $brewStyle    = $_POST['brewStyle'];
  $brewLovibond = $_POST['brewLovibond'];
  $ibuR         = $_POST['ibuR'];
  $ibuG         = $_POST['ibuG'];
  $ibuT         = $_POST['ibuT'];
  $ibuD         = $_POST['ibuD'];
  $ibuAvg       = $_POST['ibuAvg'];
  $brewOG       = $_POST['brewOG'];
  $brewFG       = $_POST['brewFG'];

  for ($i = 0; $i < MAX_EXT; $i++) {
    $extName[$i]   = $_POST['extName'][$i];
    $extWeight[$i] = $_POST['extWeight'][$i];
  }

  for ($i = 0; $i < MAX_GRAINS; $i++) {
    $grainName[$i]   = $_POST['grainName'][$i];
    $grainWeight[$i] = $_POST['grainWeight'][$i];
  }

  for ($i = 0; $i < MAX_ADJ; $i++) {
    $adjName[$i]   = $_POST['adjName'][$i];
    $adjWeight[$i] = $_POST['adjWeight'][$i];
  }

  for ($i = 0; $i < MAX_HOPS; $i++) {
    $brewHopsName[$i]   = $_POST['brewHopsName'][$i];
    $brewHopsWeight[$i] = $_POST['brewHopsWeight'][$i];
    $brewHopsAA[$i]     = $_POST['brewHopsAA'][$i];
    $brewHopsTime[$i]   = $_POST['brewHopsTime'][$i];
    $brewHopsForm[$i]   = $_POST['brewHopsForm'][$i];
  }
}
?>