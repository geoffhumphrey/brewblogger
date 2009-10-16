<?php 
$gravity = $row_log['brewMashGravity']; 
$wort = $row_log['brewPreBoilAmt']; 
$grain = $totalGrain;
$grain1 = $row_malt1['maltYield'];
$grain1amt = $row_log['brewGrain1Weight'];
$grain2 = $row_malt2['maltYield'];
$grain2amt = $row_log['brewGrain2Weight'];
$grain3 = $row_malt3['maltYield'];;
$grain3amt = $row_log['brewGrain3Weight'];
$grain4 = $row_malt4['maltYield'];
$grain4amt = $row_log['brewGrain4Weight'];
$grain5 = $row_malt5['maltYield'];
$grain5amt = $row_log['brewGrain5Weight'];
$grain6 = $row_malt6['maltYield'];
$grain6amt = $row_log['brewGrain6Weight'];
$grain7 = $row_malt7['maltYield'];
$grain7amt = $row_log['brewGrain7Weight'];
$grain8 = $row_malt8['maltYield'];
$grain8amt = $row_log['brewGrain8Weight'];
$grain9 = $row_malt9['maltYield'];
$grain9amt = $row_log['brewGrain9Weight'];
$units = $row_pref['measFluid2'];

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
$efficiency_sum = ($grain1calc + $grain2calc + $grain3calc + $grain4calc + $grain5calc + $grain6calc + $grain7calc + $grain8calc + $grain9calc);
	if (($efficiency_sum != 0) && ($gravity != ""))  {
	$efficiency = ($ogconvert / $efficiency_sum) * 100;
	} 

?>

