<?php 
$query_sugarPPG1 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt1['maltYield']);
$sugarPPG1 = mysql_query($query_sugarPPG1, $brewing) or die(mysql_error());
$row_sugarPPG1 = mysql_fetch_assoc($sugarPPG1);

$query_sugarPPG2 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt2['maltYield']);
$sugarPPG2 = mysql_query($query_sugarPPG2, $brewing) or die(mysql_error());
$row_sugarPPG2 = mysql_fetch_assoc($sugarPPG2);

$query_sugarPPG3 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt3['maltYield']);
$sugarPPG3 = mysql_query($query_sugarPPG3, $brewing) or die(mysql_error());
$row_sugarPPG3 = mysql_fetch_assoc($sugarPPG1);

$query_sugarPPG4 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt4['maltYield']);
$sugarPPG4 = mysql_query($query_sugarPPG4, $brewing) or die(mysql_error());
$row_sugarPPG4 = mysql_fetch_assoc($sugarPPG4);

$query_sugarPPG5 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt5['maltYield']);
$sugarPPG5 = mysql_query($query_sugarPPG5, $brewing) or die(mysql_error());
$row_sugarPPG5 = mysql_fetch_assoc($sugarPPG5);

$query_sugarPPG6 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt6['maltYield']);
$sugarPPG6 = mysql_query($query_sugarPPG6, $brewing) or die(mysql_error());
$row_sugarPPG6 = mysql_fetch_assoc($sugarPPG6);

$query_sugarPPG7 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt7['maltYield']);
$sugarPPG7 = mysql_query($query_sugarPPG7, $brewing) or die(mysql_error());
$row_sugarPPG7 = mysql_fetch_assoc($sugarPPG7);

$query_sugarPPG8 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt8['maltYield']);
$sugarPPG8 = mysql_query($query_sugarPPG8, $brewing) or die(mysql_error());
$row_sugarPPG8 = mysql_fetch_assoc($sugarPPG8);

$query_sugarPPG9 = sprintf("SELECT sugarPPG FROM sugar_type WHERE id='%s'", $row_malt9['maltYield']);
$sugarPPG9 = mysql_query($query_sugarPPG9, $brewing) or die(mysql_error());
$row_sugarPPG9 = mysql_fetch_assoc($sugarPPG9);

$gravity = $row_log['brewMashGravity']; 
$wort = $row_log['brewPreBoilAmt']; 
$grain = $totalGrain;
$grain1 = $row_sugarPPG1['sugarPPG'];
$grain1amt = $row_log['brewGrain1Weight'];
$grain2 = $row_sugarPPG2['sugarPPG'];
$grain2amt = $row_log['brewGrain2Weight'];
$grain3 = $row_sugarPPG3['sugarPPG'];;
$grain3amt = $row_log['brewGrain3Weight'];
$grain4 = $row_sugarPPG4['sugarPPG'];
$grain4amt = $row_log['brewGrain4Weight'];
$grain5 = $row_sugarPPG5['sugarPPG'];
$grain5amt = $row_log['brewGrain5Weight'];
$grain6 = $row_sugarPPG6['sugarPPG'];
$grain6amt = $row_log['brewGrain6Weight'];
$grain7 = $row_sugarPPG7['sugarPPG'];
$grain7amt = $row_log['brewGrain7Weight'];
$grain8 = $row_sugarPPG8['sugarPPG'];
$grain8amt = $row_log['brewGrain8Weight'];
$grain9 = $row_sugarPPG9['sugarPPG'];
$grain9amt = $row_log['brewGrain9Weight'];
$units = $row_pref['measFluid2'];
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
$ppg = ($ogconvert * $wort) / $grain;
switch ($units) 
	{
	case "gallons": 
		$ppg_display = $ppg;
		break;
	case "liters":
		$ppg_display = ($ppg/10);
		break;
	}

// Calculate Efficiency
switch ($units) 
	{
	case "gallons": 
		$grain1calc = ($grain1 * $grain1amt)/$wort;
		$grain2calc = ($grain2 * $grain2amt)/$wort;
		$grain3calc = ($grain3 * $grain3amt)/$wort;
		$grain4calc = ($grain4 * $grain4amt)/$wort;
		$grain5calc = ($grain5 * $grain5amt)/$wort;
		$grain6calc = ($grain6 * $grain6amt)/$wort;
		$grain7calc = ($grain7 * $grain7amt)/$wort;
		$grain8calc = ($grain8 * $grain8amt)/$wort;
		$grain9calc = ($grain9 * $grain9amt)/$wort;
		break;
	case "liters":
		$grain1calc = ($grain1 * ($grain1amt * 2.202))/($wort * .264);
		$grain2calc = ($grain2 * ($grain2amt * 2.202))/($wort * .264);
		$grain3calc = ($grain3 * ($grain3amt * 2.202))/($wort * .264);
		$grain4calc = ($grain4 * ($grain4amt * 2.202))/($wort * .264);
		$grain5calc = ($grain5 * ($grain5amt * 2.202))/($wort * .264);
		$grain6calc = ($grain6 * ($grain6amt * 2.202))/($wort * .264);
		$grain7calc = ($grain7 * ($grain7amt * 2.202))/($wort * .264);
		$grain8calc = ($grain8 * ($grain8amt * 2.202))/($wort * .264);
		$grain9calc = ($grain9 * ($grain9amt * 2.202))/($wort * .264);
		break;
	}
$efficiency_sum = (
$grain1calc + 
$grain2calc + 
$grain3calc + 
$grain4calc + 
$grain5calc + 
$grain6calc + 
$grain7calc + 
$grain8calc + 
$grain9calc
);
	if (($efficiency_sum != 0) && ($gravity != ""))  {
	$efficiency = ($ogconvert / $efficiency_sum) * 100;
	} 
/*
echo $ogconvert."<br>";	
echo $efficiency_sum."<br>";
echo $grain1calc."<br>";
echo $grain2calc."<br>";
echo $grain3calc."<br>";
echo $grain4calc."<br>";
echo $grain5calc."<br>";
echo $grain6calc."<br>";
echo $grain7calc."<br>";
echo $grain8calc."<br>";
echo $grain9calc."<br>";
echo $efficiency;
*/
?>

