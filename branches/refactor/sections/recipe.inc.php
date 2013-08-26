<?php 
/**
 * Module: recipe.inc.php
 * Description: This module loads up vars which will be used to display all the ingredients 
 *              when viewing a recipe or blog.
 */

if ($amt != 0) {
  $scale = $amt / $row_log['brewYield'];
}

mysql_select_db($database_brewing, $brewing);

//
// Grist percentage calculations
//

$totalExtract = 0;
for ($i = 1; $i <= MAX_EXT; $i++) {
  $key           = 'brewExtract' . $i . 'Weight';
  $totalExtract += $row_log[$key];
}

$totalGrain = 0;
for ($i = 1; $i <= MAX_GRAINS; $i++) {
  $key         = 'brewGrain' . $i . 'Weight';
  $totalGrain += $row_log[$key];
}

$totalGrist = ($totalExtract + $totalGrain);

for ($i = 0; $i <= MAX_EXT; $i++) {
  $key = 'brewExtract' . ($i + 1) . 'Weight';
  if (isset($row_log[$key]) && $row_log[$key] != "" && $row_log[$key] > 0) { 
    $extractPer[$i] = (($row_log[$key] / $totalGrist) * 100); 
  }
}

for ($i = 0; $i <= MAX_GRAINS; $i++) {
  $key = 'brewGrain' . ($i + 1) . 'Weight';
  if (isset($row_log[$key]) && $row_log[$key] != "" && $row_log[$key] > 0) { 
    $grainPer[$i] = (($row_log[$key] / $totalGrist) * 100); 
  }
}

if ($totalExtract > 0 && $totalGrist > 0) {
  $totalExtractPer = (($totalExtract / $totalGrist) * 100);
}

if ($totalGrain > 0 && $totalGrist > 0) {
  $totalGrainPer = (($totalGrain / $totalGrist) * 100);
}

//Hop percentage calculations
$totalHops = 0;
for ($i = 1; $i <= MAX_HOPS; $i++) {
  $key        = 'brewHops' . $i . 'Weight';
  $totalHops += $row_log[$key];
}

$weightMultiplier = ($row_pref['measWeight1'] == "grams") ? 0.035 : 1;

for ($i = 1; $i <= MAX_HOPS; $i++) {
  $hopPer  = 'hop' . $i . 'Per';
  $$hopPer = (($row_log['brewHops' . $i . 'Weight'] * $weightMultiplier) * $row_log['brewHops' . $i . 'IBU']);
}

$totalAAU = array_sum(array($hop1Per,$hop2Per,$hop3Per,$hop4Per,$hop5Per,$hop6Per,$hop7Per,$hop8Per,$hop9Per,$hop10Per,$hop11Per,$hop12Per,$hop13Per,$hop14Per,$hop15Per));

include (SECTIONS.'recipe_fermentables.inc.php');
include (SECTIONS.'recipe_non-fermentables.inc.php');
include (SECTIONS.'recipe_hops.inc.php');
include (SECTIONS.'recipe_yeast.inc.php');
?>
