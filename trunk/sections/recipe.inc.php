<?php 
if ($amt != 0) $scale = $amt/$row_log['brewYield'];
mysql_select_db($database_brewing, $brewing);

for($i = 1; $i <= 15; ++$i) {
    $query_hops = 'query_hops'.$i;
    $hops = 'hops'.$i;
    $row_hops = 'row_hops'.$i;
    $totalRows_hops = 'totalRows_hops'.$i;
    $$query_hops = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops'.$i]);
    $$hops = mysql_query($$query_hops, $brewing) or die(mysql_error());
    $$row_hops = mysql_fetch_assoc($$hops);
    $$totalRows_hops = mysql_num_rows($$hops);
}

for($i = 1; $i <= 15; ++$i) {
    $query_malt = 'query_malt'.$i;
    $malt = 'malt'.$i;
    $row_malt = 'row_malt'.$i;
    $totalRows_malt = 'totalRows_malt'.$i;
    $$query_malt = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain'.$i]);
    $$malt = mysql_query($$query_malt, $brewing) or die(mysql_error());
    $$row_malt = mysql_fetch_assoc($$malt);
    $$totalRows_malt = mysql_num_rows($$malt);
	
}


//Grist percentage calculations
$totalExtract = (
    $row_log['brewExtract1Weight'] + 
    $row_log['brewExtract2Weight'] + 
    $row_log['brewExtract3Weight'] + 
    $row_log['brewExtract4Weight'] + 
    $row_log['brewExtract5Weight']
);

$totalGrain = (
    $row_log['brewGrain1Weight'] + 
    $row_log['brewGrain2Weight'] + 
    $row_log['brewGrain3Weight'] + 
    $row_log['brewGrain4Weight'] + 
    $row_log['brewGrain5Weight'] + 
    $row_log['brewGrain6Weight'] + 
    $row_log['brewGrain7Weight'] + 
    $row_log['brewGrain8Weight'] + 
    $row_log['brewGrain9Weight'] +
	$row_log['brewGrain10Weight'] +
	$row_log['brewGrain11Weight'] +
	$row_log['brewGrain12Weight'] +
	$row_log['brewGrain13Weight'] +
	$row_log['brewGrain14Weight'] +
	$row_log['brewGrain15Weight']
);

$totalGrist = ($totalExtract + $totalGrain);

for($i = 1; $i <= 5; ++$i) {
    $extractPer = 'extract'.$i.'Per';
    if (($row_log['brewExtract'.$i.'Weight'] != "0") && ($row_log['brewExtract'.$i.'Weight'] != "")) { 
        $$extractPer = (($row_log['brewExtract'.$i.'Weight']/$totalGrist) * 100); 
    }
}

for($i = 1; $i <= 15; ++$i) {
    $grainPer = 'grain'.$i.'Per';
    if (($row_log['brewGrain'.$i.'Weight'] != "0") && ($row_log['brewGrain'.$i.'Weight'] != "")) { 
        $$grainPer = (($row_log['brewGrain'.$i.'Weight']/$totalGrist) * 100); 
    }
}

if (($totalExtract !=0) && ($totalGrist !=0)) { $totalExtractPer = (($totalExtract/$totalGrist) * 100); }

if (($totalGrain !=0) && ($totalGrist !=0)) { $totalGrainPer = (($totalGrain/$totalGrist) * 100); }

//Hop percentage calculations
$totalHops = (
    $row_log['brewHops1Weight'] + 
    $row_log['brewHops2Weight'] + 
    $row_log['brewHops3Weight'] + 
    $row_log['brewHops4Weight'] + 
    $row_log['brewHops5Weight'] + 
    $row_log['brewHops6Weight'] + 
    $row_log['brewHops7Weight'] + 
    $row_log['brewHops8Weight'] + 
    $row_log['brewHops9Weight'] +
	$row_log['brewHops10Weight'] +
	$row_log['brewHops11Weight'] +
	$row_log['brewHops12Weight'] +
	$row_log['brewHops13Weight'] +
	$row_log['brewHops14Weight'] +
	$row_log['brewHops15Weight']
);

$weightMultiplier = 1;
if ($row_pref['measWeight1'] == "grams") {
    $weightMultipler = 0.035;
};

for($i = 1; $i <= 15; ++$i) {
    $hopPer = 'hop'.$i.'Per';
    $$hopPer = (($row_log['brewHops'.$i.'Weight'] * $weightMultiplier) * $row_log['brewHops'.$i.'IBU']);
}

$totalAAU = array_sum(array($hop1Per,$hop2Per,$hop3Per,$hop4Per,$hop5Per,$hop6Per,$hop7Per,$hop8Per,$hop9Per,$hop10Per,$hop11Per,$hop12Per,$hop13Per,$hop14Per,$hop15Per));

include (SECTIONS.'recipe_fermentables.inc.php');
include (SECTIONS.'recipe_non-fermentables.inc.php');
include (SECTIONS.'recipe_hops.inc.php');
include (SECTIONS.'recipe_yeast.inc.php');
?>
