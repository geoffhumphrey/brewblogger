<?php 
/**
 * Module: efficiency.inc.php
 * Description: This module provides the "PPG" number in the "Mash Profile" section of a blog.
 *              The efficincy of the recipe is calculated here but should probably be
 *              centralaized in a library.
 */


/*
$query_sugarPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt1['maltYield']);
$sugarPPG1 = mysql_query($query_sugarPPG1, $brewing) or die(mysql_error());
$row_sugarPPG1 = mysql_fetch_assoc($sugarPPG1);

$query_sugarPPG15 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt15['maltYield']);
$sugarPPG15 = mysql_query($query_sugarPPG15, $brewing) or die(mysql_error());
$row_sugarPPG15 = mysql_fetch_assoc($sugarPPG15);
*/

$gravity = $row_log['brewMashGravity']; 
$wort    = $row_log['brewPreBoilAmt']; 
$grain   = $totalGrain;
/*
$grain1 = $row_sugarPPG1['sugarPPG'];
$grain1amt = $row_log['brewGrain1Weight'];
$grain15 = $row_sugarPPG15['sugarPPG'];
$grain15amt = $row_log['brewGrain15Weight'];
*/
$units = $row_pref['measFluid2'];

$grainsPPG = array();
for ($i = 0; $i < MAX_GRAINS; $i++) {
  $key              = "brewGrain" . ($i + 1);
  $query            = "SELECT maltPPG FROM malt WHERE maltName=" . $row_log[$key];
  $grainsPPG[$i]    = mysql_query($query, $brewing) or die(mysql_error());
  $key              = "brewGrain" . ($i + 1) . "Weight";
  $grainsWeight[$i] = $row_log[$key];
}

/*
echo $gravity."<br>";
echo $wort."<br>";
echo $grain1." ".$grain1amt."<br>";
echo $grain2." ".$grain2amt."<br>";
echo $grain3." ".$grain3amt."<br>";
echo $grain4." ".$grain4amt."<br>";
echo $grain5." ".$grain5amt."<br>";
echo $grain6." ".$grain6amt."<br>";
echo $grain7." ".$grain7amt."<br>";
echo $grain8." ".$grain8amt."<br>";
echo $grain9." ".$grain9amt."<br>";;
*/

$ogconvert = ($gravity - 1) * 1000;
$ppg       = ($ogconvert * $wort) / $grain;
switch ($units) {
 case "gallons": 
   $ppg_display = $ppg;
   break;
 case "liters":
   $ppg_display = ($ppg / 10);
   break;
}

// Calculate Efficiency
$efficiency_sum = 0;
switch ($units) {
 case "gallons": 
   for ($i = 0; $i < MAX_GRAINS; $i++) {
     $efficiency_sum += ($grainsPPG[$i] * $grainsWeight[$i]) / $wort;
   }
   /*
   $grain1calc = ($grain1 * $grain1amt)/$wort;
   $grain15calc = ($grain15 * $grain15amt)/$wort;
   */
   break;
 case "liters":
   for ($i = 0; $i < MAX_GRAINS; $i++) {
     $efficiency_sum += ($grainsPPG[$i] * ($grainsWeight[$i] * 2.202)) / ($wort * .264);
   }
   /*
   $grain1calc = ($grain1 * ($grain1amt * 2.202))/($wort * .264);
   $grain15calc = ($grain15 * ($grain15amt * 2.202))/($wort * .264);
   */
   break;
}

/*
$efficiency_sum = (
$grain1calc + 
$grain2calc + 
$grain3calc + 
$grain4calc + 
$grain5calc + 
$grain6calc + 
$grain7calc + 
$grain8calc + 
$grain9calc +
$grain10calc +
$grain11calc +
$grain12calc +
$grain13calc +
$grain14calc +
$grain15calc
);
*/

if (($efficiency_sum != 0) && ($gravity != ""))  {
  $efficiency = ($ogconvert / $efficiency_sum) * 100;
} 

/*
echo $ogconvert."<br>";	
echo $efficiency_sum."<br>";
echo $efficiency;
*/
?>

