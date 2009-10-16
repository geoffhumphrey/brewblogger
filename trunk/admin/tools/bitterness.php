<?php

if (($action == "calculate") || ($action == "entry")) {

// ------------------- Begin Globals ------------------- //

$hop1Weight = $_POST['hop1Weight'];
$hop2Weight = $_POST['hop2Weight'];
$hop3Weight = $_POST['hop3Weight'];
$hop4Weight = $_POST['hop4Weight'];
$hop5Weight = $_POST['hop5Weight'];
$hop6Weight = $_POST['hop6Weight'];
$hop7Weight = $_POST['hop7Weight'];
$hop8Weight = $_POST['hop8Weight'];
$hop9Weight = $_POST['hop9Weight'];
$hop10Weight = $_POST['hop10Weight'];
$hop1AA = $_POST['hop1AA'];
$hop2AA = $_POST['hop2AA'];
$hop3AA = $_POST['hop3AA'];
$hop4AA = $_POST['hop4AA'];
$hop5AA = $_POST['hop5AA'];
$hop6AA = $_POST['hop6AA'];
$hop7AA = $_POST['hop7AA'];
$hop8AA = $_POST['hop8AA'];
$hop9AA = $_POST['hop9AA'];
$hop10AA = $_POST['hop10AA'];
$utilization1 = $_POST['utilization1']; 
$utilization2 = $_POST['utilization2'];
$utilization3 = $_POST['utilization3'];
$utilization4 = $_POST['utilization4'];
$utilization5 = $_POST['utilization5'];
$utilization6 = $_POST['utilization6'];
$utilization7 = $_POST['utilization7'];
$utilization8 = $_POST['utilization8'];
$utilization9 = $_POST['utilization9'];
$utilization10 = $_POST['utilization10'];
$preBoilVol = $_POST['preBoilVol'];
$finalVol = $_POST['finalVol'];
$gravity = $_POST['gravity'];
$desiredIBUs = $_POST['desiredIBUs'];
$elevation = $_POST['elevation'];
$units = $_POST['units'];
$boilTime = $_POST['boilTime'];
$form1 = $_POST['form1'];
$form2 = $_POST['form2'];
$form3 = $_POST['form3'];
$form4 = $_POST['form4'];
$form5 = $_POST['form5'];
$form6 = $_POST['form6'];
$form7 = $_POST['form7'];
$form8 = $_POST['form8'];
$form9 = $_POST['form9'];
$form10 = $_POST['form10'];
switch ($units)
{
	case "u.s.":
	$f = 7489;
	$f2 = .7489;
	break;
	case "metric":
	$f = 1000;
	$f2 = .1;
}

// fraction utilization of pellet vs. whole hops
$wholeFraction = .85; 

// ------------------- End Globals ------------------- //

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

// Correct gravity
if ($gravity < 1.050) $cGravity = 1;
if ($gravity >= 1.050) { $cGravity = 1 + (($gravity - 1.050) / 0.2); }

// Calculate
if (($hop1Weight != "") && ($hop1AA !="")) 
	{
	if ($form1 == "pellet") { $numD = $utilization1; $u = convertUtilizationDPellet($numD); }
	if ($form1 == "whole")  { $numD = $utilization1; $u = convertUtilizationDWhole($numD); }
	$ibu1_D = ($hop1Weight * $u * ($hop1AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu1_D = "";

if (($hop2Weight != "") && ($hop2AA !="")) 
	{
	if ($form2 == "pellet") { $numD = $utilization2; $u = convertUtilizationDPellet($numD); }
	if ($form2 == "whole")  { $numD = $utilization2; $u = convertUtilizationDWhole($numD); }
	$ibu2_D = ($hop2Weight * $u * ($hop2AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu2_D = "";

if (($hop3Weight != "") && ($hop3AA !="")) 
	{
	if ($form3 == "pellet") { $numD = $utilization3; $u = convertUtilizationDPellet($numD); }
	if ($form3 == "whole")  { $numD = $utilization3; $u = convertUtilizationDWhole($numD); }
	$ibu3_D = ($hop3Weight * $u * ($hop3AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu3_D = "";
	
if (($hop4Weight != "") && ($hop4AA !="")) 
	{
	if ($form4 == "pellet") { $numD = $utilization4; $u = convertUtilizationDPellet($numD); }
	if ($form4 == "whole")  { $numD = $utilization4; $u = convertUtilizationDWhole($numD); }
	$ibu4_D = ($hop4Weight * $u * ($hop4AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu4_D = "";
	
if (($hop5Weight != "") && ($hop5AA !="")) 
	{
	if ($form5 == "pellet") { $numD = $utilization5; $u = convertUtilizationDPellet($numD); }
	if ($form5 == "whole")  { $numD = $utilization5; $u = convertUtilizationDWhole($numD); }
	$ibu5_D = ($hop5Weight * $u * ($hop5AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu5_D = "";
	
if (($hop6Weight != "") && ($hop6AA !="")) 
	{
	if ($form6 == "pellet") { $numD = $utilization6; $u = convertUtilizationDPellet($numD); }
	if ($form6 == "whole")  { $numD = $utilization6; $u = convertUtilizationDWhole($numD); };
	$ibu6_D = ($hop6Weight * $u * ($hop6AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu6_D = "";
	
if (($hop7Weight != "") && ($hop7AA !="")) 
	{
	if ($form7 == "pellet") { $numD = $utilization7; $u = convertUtilizationDPellet($numD); }
	if ($form7 == "whole")  { $numD = $utilization7; $u = convertUtilizationDWhole($numD); }
	$ibu7_D = ($hop7Weight * $u * ($hop7AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu7_D = "";
	
if (($hop8Weight != "") && ($hop8AA !="")) 
	{
	if ($form8 == "pellet") { $numD = $utilization8; $u = convertUtilizationDPellet($numD); }
	if ($form8 == "whole")  { $numD = $utilization8; $u = convertUtilizationDWhole($numD); }
	$ibu8_D = ($hop8Weight * $u * ($hop8AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu8_D = "";
	
if (($hop9Weight != "") && ($hop9AA !="")) 
	{
	if ($form9 == "pellet") { $numD = $utilization9; $u = convertUtilizationDPellet($numD); }
	if ($form9 == "whole")  { $numD = $utilization9; $u = convertUtilizationDWhole($numD); }
	$ibu9_D = ($hop9Weight * $u * ($hop9AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu9_D = "";
	
if (($hop10Weight != "") && ($hop10AA !="")) 
	{
	if ($form10 == "pellet") { $numD = $utilization10; $u = convertUtilizationDPellet($numD); }
	if ($form10 == "whole")  { $numD = $utilization10; $u = convertUtilizationDWhole($numD); }
	$ibu10_D = ($hop10Weight * $u * ($hop10AA * .01) * $f) / ($finalVol * $cGravity);
	}
	else $ibu10_D = "";

$ibuD = ($ibu1_D + $ibu2_D + $ibu3_D + $ibu4_D + $ibu5_D + $ibu6_D + $ibu7_D + $ibu8_D + $ibu9_D + $ibu10_D);

// End Daniels Method //

// ------------------- Garetz Method ------------------- //

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

// Calculate the Concentration Factor (CF)
$cf = $finalVol / $preBoilVol;

// Calculate Boil Gravity (BG)
$bg = ($cf * ($gravity - 1)) + 1;

// Calculate Gravity Factor (GF)
$gf = (($bg - 1.050) / .2) + 1;

// Calculate Hop Factor
$hf = (($cf * $desiredIBUs) / 260) + 1;

// Calculate Temperature Factor (TF)
$tf = (($elevation / 550 ) * 0.02) + 1;

// Calculate Combined Adjustments (CA)
$ca = $gf * $hf * $tf;

if (($hop1Weight != "") && ($hop1AA !="")) 
	{
	$numG = $utilization1; $u = convertUtilizationG($numG);
	if ($form1 == "pellet") { $ibu_1G = ($u * $hop1AA * $hop1Weight * $f2) / ($finalVol * $ca); }
	if ($form1 == "whole")  { $ibu_1G = ($u * $hop1AA * $hop1Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_1G = "";
	
if (($hop2Weight != "") && ($hop2AA !="")) 
	{
	$numG = $utilization2; $u = convertUtilizationG($numG);
	if ($form2 == "pellet") { $ibu_2G = ($u * $hop2AA * $hop2Weight * $f2) / ($finalVol * $ca); }
	if ($form2 == "whole")  { $ibu_2G = ($u * $hop2AA * $hop2Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_2G = "";
	
if (($hop3Weight != "") && ($hop3AA !="")) 
	{
	$numG = $utilization3; $u = convertUtilizationG($numG);
	if ($form3 == "pellet")  { $ibu_3G = ($u * $hop3AA * $hop3Weight * $f2) / ($finalVol * $ca); }
	if ($form3 == "whole")   { $ibu_3G = ($u * $hop3AA * $hop3Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_3G = "";
	
if (($hop4Weight != "") && ($hop4AA !="")) 
	{
	$numG = $utilization4; $u = convertUtilizationG($numG);
	if ($form4 == "pellet")  { $ibu_4G = ($u * $hop4AA * $hop4Weight * $f2) / ($finalVol * $ca); }
	if ($form4 == "whole")   { $ibu_4G = ($u * $hop4AA * $hop4Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_4G = "";
	
if (($hop5Weight != "") && ($hop5AA !="")) 
	{
	$numG = $utilization5; $u = convertUtilizationG($numG);
	if ($form5 == "pellet")  { $ibu_5G = ($u * $hop5AA * $hop5Weight * $f2) / ($finalVol * $ca); }
	if ($form5 == "whole")   { $ibu_5G = ($u * $hop5AA * $hop5Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_5G = "";
	
if (($hop6Weight != "") && ($hop6AA !="")) 
	{
	$numG = $utilization6; $u = convertUtilizationG($numG);
	if ($form6 == "pellet")  { $ibu_6G = ($u * $hop6AA * $hop6Weight * $f2) / ($finalVol * $ca); }
	if ($form6 == "whole")   { $ibu_6G = ($u * $hop6AA * $hop6Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_6G = "";
	
if (($hop7Weight != "") && ($hop7AA !="")) 
	{
	$numG = $utilization7; $u = convertUtilizationG($numG);
	if ($form7 == "pellet")  { $ibu_7G = ($u * $hop7AA * $hop7Weight * $f2) / ($finalVol * $ca); }
	if ($form7 == "whole")   { $ibu_7G = ($u * $hop7AA * $hop7Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_7G = "";
	
if (($hop8Weight != "") && ($hop8AA !="")) 
	{
	$numG = $utilization8; $u = convertUtilizationG($numG);
	if ($form8 == "pellet")  { $ibu_8G = ($u * $hop8AA * $hop8Weight * $f2) / ($finalVol * $ca); }
	if ($form8 == "whole")   { $ibu_8G = ($u * $hop8AA * $hop8Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_8G = "";
	
if (($hop9Weight != "") && ($hop9AA !="")) 
	{
	$numG = $utilization9; $u = convertUtilizationG($numG);
	if ($form9 == "pellet")  { $ibu_9G = ($u * $hop9AA * $hop9Weight * $f2) / ($finalVol * $ca); }
	if ($form9 == "whole")   { $ibu_9G = ($u * $hop9AA * $hop9Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_9G = "";
	
if (($hop10Weight != "") && ($hop10AA !="")) 
	{
	$numG = $utilization10; $u = convertUtilizationG($numG);
	if ($form10 == "pellet")  { $ibu_10G = ($u * $hop10AA * $hop10Weight * $f2) / ($finalVol * $ca); }
	if ($form10 == "whole")   { $ibu_10G = ($u * $hop10AA * $hop10Weight * $f2) / ($finalVol * $ca) * $wholeFraction; }
	} else 
	$ibu_10G = "";

$ibuG = $ibu_1G + $ibu_2G + $ibu_3G + $ibu_4G + $ibu_5G + $ibu_6G + $ibu_7G + $ibu_8G + $ibu_9G + $ibu_10G;

// End Garetz Method
  
// ------------------- Rager Method ------------------- //  

function convertUtilizationR ($numR) {
if ($numR == 0) $convertR = "0";
if (($numR > 0) && ($numR <= 6)) $convertR = "0.05";
if (($numR > 6) && ($numR <= 10)) $convertR = "0.06";
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

if ($gravity > 1.050) $ga = (($gravity - 1.050) / .2); else $ga = 0;


if (($hop1Weight != "") && ($hop1AA !="")) 
	{
	$numR = $utilization1; $u = convertUtilizationR($numR);
	if ($form1 == "pellet")  { $ibu_1R = ($hop1Weight * $u * ($hop1AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form1 == "whole")   { $ibu_1R = ($hop1Weight * $u * ($hop1AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_1R = "";
if (($hop2Weight != "") && ($hop2AA !="")) 
	{
	$numR = $utilization2; $u = convertUtilizationR($numR);
	if ($form2 == "pellet")  { $ibu_2R = ($hop2Weight * $u * ($hop2AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form2 == "whole")   { $ibu_2R = ($hop2Weight * $u * ($hop2AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_2R = "";
if (($hop3Weight != "") && ($hop3AA !="")) 
	{
	$numR = $utilization3; $u = convertUtilizationR($numR);
	if ($form3 == "pellet")  { $ibu_3R = ($hop3Weight * $u * ($hop3AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form3 == "whole")   { $ibu_3R = ($hop3Weight * $u * ($hop3AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_3R = "";
if (($hop4Weight != "") && ($hop4AA !="")) 
	{
	$numR = $utilization4; $u = convertUtilizationR($numR);
	if ($form4 == "pellet")  { $ibu_4R = ($hop4Weight * $u * ($hop4AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form4 == "whole")   { $ibu_4R = ($hop4Weight * $u * ($hop4AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_4R = "";
if (($hop5Weight != "") && ($hop5AA !="")) 
	{
	$numR = $utilization5; $u = convertUtilizationR($numR);
	if ($form5 == "pellet")  { $ibu_5R = ($hop5Weight * $u * ($hop5AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form5 == "whole")   { $ibu_5R = ($hop5Weight * $u * ($hop5AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_5R = "";
if (($hop6Weight != "") && ($hop6AA !="")) 
	{
	$numR = $utilization6; $u = convertUtilizationR($numR);
	if ($form6 == "pellet")  { $ibu_6R = ($hop6Weight * $u * ($hop6AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form6 == "whole")   { $ibu_6R = ($hop6Weight * $u * ($hop6AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_5R = "";
if (($hop7Weight != "") && ($hop7AA !="")) 
	{
	$numR = $utilization7; $u = convertUtilizationR($numR);
	if ($form7 == "pellet")  { $ibu_7R = ($hop7Weight * $u * ($hop7AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form7 == "whole")   { $ibu_7R = ($hop7Weight * $u * ($hop7AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_7R = "";
if (($hop8Weight != "") && ($hop8AA !="")) 
	{
	$numR = $utilization8; $u = convertUtilizationR($numR);
	if ($form8 == "pellet")  { $ibu_8R = ($hop8Weight * $u * ($hop8AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form8 == "whole")   { $ibu_8R = ($hop8Weight * $u * ($hop8AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_8R = "";
if (($hop9Weight != "") && ($hop9AA !="")) 
	{
	$numR = $utilization9; $u = convertUtilizationR($numR);
	if ($form9 == "pellet")  { $ibu_9R = ($hop9Weight * $u * ($hop9AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form9 == "whole")   { $ibu_9R = ($hop9Weight * $u * ($hop9AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_9R = "";
if (($hop10Weight != "") && ($hop10AA !="")) 
	{
	$numR = $utilization10; $u = convertUtilizationR($numR);
	if ($form10 == "pellet")  { $ibu_10R = ($hop10Weight * $u * ($hop10AA / 100) * $f) / ($finalVol * (1 + $ga)); }
	if ($form10 == "whole")   { $ibu_10R = ($hop10Weight * $u * ($hop10AA / 100) * $f) / ($finalVol * (1 + $ga)) * $wholeFraction; }
	} else 
	$ibu_10R = "";

$ibuR = ($ibu_1R + $ibu_2R + $ibu_3R + $ibu_4R + $ibu_5R + $ibu_6R + $ibu_7R + $ibu_8R + $ibu_9R + $ibu_10R);

// End Rager

// ------------------- Tinseth Method ------------------- //

// Bigness Factor = 1.65 * 0.000125^(wort gravity - 1)
$wg = $gravity - 1;
$bignessFactor = 1.65 * (pow(0.000125, $wg));

//Boil Time Factor = 1 - e^(-0.04 * time in mins)
//                   --------------------------
//                             4.15

function hopBTF($numT) { 
$eT = (-0.04 * $numT);
$boilTimeFactor = (1 - (pow(2.71828, $eT))) / 4.15;
return $boilTimeFactor;
}

if (($hop1Weight != "") && ($hop1AA !="")) 
	{
	$numT = $utilization1;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form1 == "pellet")  { $ibu_1T =  $decimalAA * ((($hop1AA/100) * $hop1Weight * $f) / $finalVol); }
	if ($form1 == "whole")   { $ibu_1T = ($decimalAA * ((($hop1AA/100) * $hop1Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_1T = "";
if (($hop2Weight != "") && ($hop2AA !="")) 
	{
	$numT = $utilization2;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form2 == "pellet")  { $ibu_2T =  $decimalAA * ((($hop2AA/100) * $hop2Weight * $f) / $finalVol); }
	if ($form2 == "whole")   { $ibu_2T = ($decimalAA * ((($hop2AA/100) * $hop2Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_2T = "";
if (($hop3Weight != "") && ($hop3AA !="")) 
	{
	$numT = $utilization3;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form3 == "pellet")  { $ibu_3T =  $decimalAA * ((($hop3AA/100) * $hop3Weight * $f) / $finalVol); }
	if ($form3 == "whole")   { $ibu_3T = ($decimalAA * ((($hop3AA/100) * $hop3Weight * $f) / $finalVol)) * $wholeFraction; } 
	} else 
	$ibu_3T = "";
if (($hop4Weight != "") && ($hop4AA !="")) 
	{
	$numT = $utilization4;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form4 == "pellet")  { $ibu_4T =  $decimalAA * ((($hop4AA/100) * $hop4Weight * $f) / $finalVol); }
	if ($form4 == "whole")   { $ibu_4T = ($decimalAA * ((($hop4AA/100) * $hop4Weight * $f) / $finalVol)) * $wholeFraction; } 
	} else 
	$ibu_4T = "";
if (($hop5Weight != "") && ($hop5AA !="")) 
	{
	$numT = $utilization5;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form5 == "pellet")  { $ibu_5T =  $decimalAA * ((($hop5AA/100) * $hop5Weight * $f) / $finalVol); }
	if ($form5 == "whole")   { $ibu_5T = ($decimalAA * ((($hop5AA/100) * $hop5Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_5T = "";
if (($hop6Weight != "") && ($hop6AA !="")) 
	{
	$numT = $utilization6;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form6 == "pellet")  { $ibu_6T =  $decimalAA * ((($hop6AA/100) * $hop6Weight * $f) / $finalVol); }
	if ($form6 == "whole")   { $ibu_6T = ($decimalAA * ((($hop6AA/100) * $hop6Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_6T = "";
if (($hop7Weight != "") && ($hop7AA !="")) 
	{
	$numT = $utilization7;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form7 == "pellet")  { $ibu_7T =  $decimalAA * ((($hop7AA/100) * $hop7Weight * $f) / $finalVol); }
	if ($form7 == "whole")   { $ibu_7T = ($decimalAA * ((($hop7AA/100) * $hop7Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_7T = "";
if (($hop8Weight != "") && ($hop8AA !="")) 
	{
	$numT = $utilization8;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form8 == "pellet")  { $ibu_8T =  $decimalAA * ((($hop8AA/100) * $hop8Weight * $f) / $finalVol); }
	if ($form8 == "whole")   { $ibu_8T = ($decimalAA * ((($hop8AA/100) * $hop8Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_8T = "";
if (($hop9Weight != "") && ($hop9AA !="")) 
	{
	$numT = $utilization9;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form9 == "pellet")  { $ibu_9T =  $decimalAA * ((($hop9AA/100) * $hop9Weight * $f) / $finalVol); }
	if ($form9 == "whole")   { $ibu_9T = ($decimalAA * ((($hop9AA/100) * $hop9Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_9T = "";
if (($hop10Weight != "") && ($hop10AA !="")) 
	{
	$numT = $utilization10;
	$decimalAA = $bignessFactor * hopBTF($numT);
	if ($form10 == "pellet")  { $ibu_10T =  $decimalAA * ((($hop10AA/100) * $hop10Weight * $f) / $finalVol); }
	if ($form10 == "whole")   { $ibu_10T = ($decimalAA * ((($hop10AA/100) * $hop10Weight * $f) / $finalVol)) * $wholeFraction; }
	} else 
	$ibu_10T = "";  

$ibuT = ($ibu_1T + $ibu_2T + $ibu_3T + $ibu_4T + $ibu_5T + $ibu_6T + $ibu_7T + $ibu_8T + $ibu_9T + $ibu_10);

} // End if calculate

// ------------------- End Calculations ------------------- //

if (($action == "default") || ($action == "entry")) { 
?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.hop1Weight.value))
	{ errormessage += "\nAt least one hop weight."; }
if(WithoutContent(document.form1.hop1AA.value))
	{ errormessage += "\nAt least one hop AAU."; }
if(WithoutContent(document.form1.utilization1.value))
	{ errormessage += "\nAt least one hop boil time."; }
if(WithoutContent(document.form1.gravity.value))
	{ errormessage += "\nGravity reading."; }
if(WithoutContent(document.form1.desiredIBUs.value))
	{ errormessage += "\nYour target IBUs."; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To calculate properly, the following information is needed:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()

function WithoutContent(ss) {
if(ss.length > 0) { return false; }
return true;
}

function NoneWithContent(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].value.length > 0) { return false; }
	}
return true;
}

function NoneWithCheck(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].checked) { return false; }
	}
return true;
}

function WithoutCheck(ss) {
if(ss.checked) { return false; }
return true;
}

function WithoutSelectionValue(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].selected) {
		if(ss[i].value.length) { return false; }
		}
	}
return true;
}

//-->
</script>
<?php } 
if (($action == "default") || ($action == "entry")) { ?>
<form action="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>&amp;action=calculate" method="post" name="form1" id="form1" <?php if (($action == "default") || ($action == "entry")) echo "onSubmit=\"return CheckRequiredFields()\""; ?>>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
  <div id="referenceHeader">International Bitterness Unit (IBU) Calculator</div>
	  <table>
       <tr>
        <td class="dataLabelLeft">Hop 1 Weight:*</td>
		<td  class="data"><input name="hop1Weight" type="text" id="hop1Weight" size="5" value="<?php if ($action == "entry") echo $hop1Weight; ?>" /></td>
		<td  class="dataLabel">Hop 1 AA%:*</td>
		<td  class="data"><input name="hop1AA" type="text" id="hop1AA" size="5" value="<?php if ($action == "entry") echo $hop1AA; ?>" /></td>
		<td  class="dataLabel">Hop 1 Time (min): *</td>
		<td  class="data"><input name="utilization1" type="text" id="utilization1" size="5" value="<?php if ($action == "entry") echo $utilization1; ?>" /></td>
        <td  class="dataLabel">Form:</td>
        <td nowrap="nowrap"  class="data">
      	  <input type="radio" name="form1" value="pellet" <?php if ((($action == "entry") && ($form1 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
          	<input type="radio" name="form1" value="whole" <?php if (($action == "entry") && ($form1 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
        </td>       
        </tr>
      <tr>
         <td class="dataLabelLeft">Hop 2 Weight: </td>
         <td  class="data"><input name="hop2Weight" type="text" id="hop2Weight" size="5" value="<?php if ($action == "entry") echo $hop2Weight; ?>" /></td>
         <td  class="dataLabel">Hop 2 AA%:</td>
         <td  class="data"><input name="hop2AA" type="text" id="hop2AA" size="5" value="<?php if ($action == "entry") echo $hop2AA; ?>" /></td>
         <td  class="dataLabel">Hop 2 Time (min): </td>          <td  class="data"><input name="utilization2" type="text" id="utilization2" size="5" value="<?php if ($action == "entry") echo $utilization2; ?>" /></td>
         <td  class="dataLabel">Form:</td>
         <td  class="data">
       	<input type="radio" name="form2" value="pellet" <?php if ((($action == "entry") && ($form2 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
          	<input type="radio" name="form2" value="whole" <?php if (($action == "entry") && ($form2 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
          </td>
        </tr>
        <tr>
         <td class="dataLabelLeft">Hop 3 Weight: </td>
         <td  class="data"><input name="hop3Weight" type="text" id="hop3Weight" size="5" value="<?php if ($action == "entry") echo $hop3Weight; ?>" /></td>
         <td  class="dataLabel">Hop 3 AA%:</td>
         <td  class="data"><input name="hop3AA" type="text" id="hop3AA" size="5" value="<?php if ($action == "entry") echo $hop3AA; ?>" /></td>
         <td  class="dataLabel">Hop 3 Time (min): </td>
         <td  class="data"><input name="utilization3" type="text" id="utilization3" size="5" value="<?php if ($action == "entry") echo $utilization3; ?>" /></td>
         <td  class="dataLabel">Form:</td>
         <td  class="data">
        	<input type="radio" name="form3" value="pellet" <?php if ((($action == "entry") && ($form3 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
          	<input type="radio" name="form3" value="whole" <?php if (($action == "entry") && ($form3 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
        </td>
        </tr>
        <tr>
         <td class="dataLabelLeft">Hop 4 Weight: </td>
         <td  class="data"><input name="hop4Weight" type="text" id="hop4Weight" size="5" value="<?php if ($action == "entry") echo $hop4Weight; ?>" /></td>
         <td  class="dataLabel">Hop 4 AA%:</td>
         <td  class="data"><input name="hop4AA" type="text" id="hop4AA" size="5" value="<?php if ($action == "entry") echo $hop4AA; ?>" /></td>
         <td  class="dataLabel">Hop 4 Time (min): </td>
         <td  class="data"><input name="utilization4" type="text" id="utilization4" size="5" value="<?php if ($action == "entry") echo $utilization4; ?>" /></td>
         <td  class="dataLabel">Form:</td>
         <td  class="data">
       	<input type="radio" name="form4" value="pellet" <?php if ((($action == "entry") && ($form4 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
         	<input type="radio" name="form4" value="whole" <?php if (($action == "entry") && ($form4 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
       </td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Hop 5 Weight: </td>
        <td  class="data"><input name="hop5Weight" type="text" id="hop5Weight" size="5" value="<?php if ($action == "entry") echo $hop5Weight; ?>" /></td>
        <td  class="dataLabel">Hop 5 AA%:</td>
        <td  class="data"><input name="hop5AA" type="text" id="hop5AA" size="5" value="<?php if ($action == "entry") echo $hop5AA; ?>" /></td>
        <td  class="dataLabel">Hop 5 Time (min): </td>
        <td  class="data"><input name="utilization5" type="text" id="utilization5" size="5" value="<?php if ($action == "entry") echo $utilization5; ?>" /></td>
        <td  class="dataLabel">Form:</td>
        <td  class="data">
      	<input type="radio" name="form5" value="pellet" <?php if ((($action == "entry") && ($form5 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
         	<input type="radio" name="form5" value="whole" <?php if (($action == "entry") && ($form5 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
       </td>
       </tr>
      <tr>
        <td class="dataLabelLeft">Hop 6 Weight: </td>
        <td  class="data"><input name="hop6Weight" type="text" id="hop6Weight" size="5" value="<?php if ($action == "entry") echo $hop6Weight; ?>" /></td>
        <td  class="dataLabel">Hop 6 AA%:</td>
        <td  class="data"><input name="hop6AA" type="text" id="hop6AA" size="5" value="<?php if ($action == "entry") echo $hop6AA; ?>" /></td>
        <td  class="dataLabel">Hop 6 Time (min): </td>
        <td  class="data"><input name="utilization6" type="text" id="utilization6" size="5" value="<?php if ($action == "entry") echo $utilization6; ?>" /></td>
        <td  class="dataLabel">Form:</td>
        <td  class="data">
      	<input type="radio" name="form6" value="pellet" <?php if ((($action == "entry") && ($form6 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
         	<input type="radio" name="form6" value="whole" <?php if (($action == "entry") && ($form6 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
       </td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Hop 7 Weight: </td>
        <td  class="data"><input name="hop7Weight" type="text" id="hop7Weight" size="5" value="<?php if ($action == "entry") echo $hop7Weight; ?>" /></td>
        <td  class="dataLabel">Hop 7 AA%:</td>
        <td  class="data"><input name="hop7AA" type="text" id="hop7AA" size="5" value="<?php if ($action == "entry") echo $hop7AA; ?>" /></td>
        <td  class="dataLabel">Hop 7 Time (min): </td>
        <td  class="data"><input name="utilization7" type="text" id="utilization7" size="5" value="<?php if ($action == "entry") echo $utilization7; ?>" /></td>
        <td  class="dataLabel">Form:</td>
        <td  class="data">
     	<input type="radio" name="form7" value="pellet" <?php if ((($action == "entry") && ($form7 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
         	<input type="radio" name="form7" value="whole" <?php if (($action == "entry") && ($form7 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
       </td>
       </tr>
      <tr>
        <td class="dataLabelLeft">Hop 8 Weight: </td>
        <td  class="data"><input name="hop8Weight" type="text" id="hop8Weight" size="5" value="<?php if ($action == "entry") echo $hop8Weight; ?>" /></td>
        <td  class="dataLabel">Hop 8 AA%:</td>
        <td  class="data"><input name="hop8AA" type="text" id="hop8AA" size="5" value="<?php if ($action == "entry") echo $hop8AA; ?>" /></td>
        <td  class="dataLabel">Hop 8 Time (min): </td>
        <td  class="data"><input name="utilization8" type="text" id="utilization8" size="5" value="<?php if ($action == "entry") echo $utilization8; ?>" /></td>
        <td  class="dataLabel">Form:</td>
        <td  class="data">
      	<input type="radio" name="form8" value="pellet" <?php if ((($action == "entry") && ($form8 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
         	<input type="radio" name="form8" value="whole" <?php if (($action == "entry") && ($form8 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
       </td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Hop 9 Weight: </td>
        <td  class="data"><input name="hop9Weight" type="text" id="hop9Weight" size="5" value="<?php if ($action == "entry") echo $hop9Weight; ?>" /></td>
        <td  class="dataLabel">Hop 9 AA%:</td>
        <td  class="data"><input name="hop9AA" type="text" id="hop9AA" size="5" value="<?php if ($action == "entry") echo $hop9AA; ?>" /></td>
        <td  class="dataLabel">Hop 9 Time (min): </td>
        <td  class="data"><input name="utilization9" type="text" id="utilization9" size="5" value="<?php if ($action == "entry") echo $utilization9; ?>" /></td>
        <td  class="dataLabel">Form:</td>
       <td  class="data">
      	<input type="radio" name="form9" value="pellet" <?php if ((($action == "entry") && ($form9 == "pellet")) || ($action == "default")) echo "CHECKED"; ?>  />Pellet
      	<input type="radio" name="form9" value="whole" <?php if (($action == "entry") && ($form9 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
         </td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Hop 10 Weight: </td>
        <td  class="data"><input name="hop10Weight" type="text" id="hop10Weight" size="5" value="<?php if ($action == "entry") echo $hop10Weight; ?>" /></td>
        <td  class="dataLabel">Hop 10 AA%:</td>
        <td  class="data"><input name="hop10AA" type="text" id="hop10AA" size="5" value="<?php if ($action == "entry") echo $hop10AA; ?>" /></td>
        <td  class="dataLabel">Hop 10 Time (min): </td>
        <td  class="data"><input name="utilization10" type="text" id="utilization10" size="5" value="<?php if ($action == "entry") echo $utilization10; ?>" /></td>
        <td  class="dataLabel">Form:</td>
        <td  class="data">
      	<input type="radio" name="form10" value="pellet" <?php if ((($action == "entry") && ($form10 == "pellet")) || ($action == "default")) echo "CHECKED"; ?> />Pellet
         	<input type="radio" name="form10" value="whole" <?php if (($action == "entry") && ($form10 == "whole")) echo "CHECKED"; ?> />Leaf or Plug
       </td>
       </tr>
       <tr>
       <td class="dataLabelLeft">Pre-Boil Volume:*</td>
        <td class="data" colspan="7"><input name="preBoilVol" type="text" id="preBoilVol" size="5" value="<?php if (($action == "default") && ($row_pref['measFluid2'] == "gallons")) echo "6"; if (($action == "default") && ($row_pref['measFluid2'] == "liters")) echo "23"; if ($action == "entry") echo $preBoilVol; ?>" /></td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Boil Time (Min):*</td>
        <td class="data" colspan="7"><input name="boilTime" type="text" id="boilTime" size="5" value="<?php if ($action == "entry") echo $boilTime; else echo "60" ?>" /></td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Final Volume:*</td>
        <td class="data" colspan="7"><input name="finalVol" type="text" id="finalVol" size="5" value="<?php if (($action == "default") && ($row_pref['measFluid2'] == "gallons")) echo "5"; if (($action == "default") && ($row_pref['measFluid2'] == "liters")) echo "19"; if ($action == "entry") echo $finalVol; ?>" /></td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Original Gravity:*</td>
        <td class="data"><input type="text" name="gravity" id="gravity" size="5" value="<?php if ($action == "entry") echo $gravity; ?>" /></td>
        <td colspan="6">e.g., 1.045</td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Target IBUs:*</td>
        <td class="data"><input type="text" name="desiredIBUs" id="desiredIBUs" size="5" value="<?php if ($action == "entry") echo $desiredIBUs; ?>" /></td>
        <td colspan="6">&nbsp;</td>
       </tr>
       <tr>
        <td class="dataLabelLeft">Units</td>
        <td class="data" colspan="3">
             <select class="text_area"  name="units">
               <option value="u.s." <?php if (($row_pref['measWeight1'] == "ounces") || ($row_pref['measWeight2'] == "pounds")) echo "SELECTED" ?>>U.S.</option>
               <option value="metric" <?php if (($row_pref['measWeight1'] == "grams") || ($row_pref['measWeight2'] == "kilograms")) echo "SELECTED" ?>>Metric</option>
             </select>		  </td>
      <td class ="dataLabelWide data" colspan="4">* indicates required field</td>
       </tr>
   </table>
   <input type="hidden" name="elevation" size="5" value="0" />
</div>

<?php if (!checkmobile ()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_calculate_Brilliant.png" alt="Calculate" class="calcButton" value="Calculate" /><?php } else { ?><input type="submit" class="calcButton" value="Calculate" /><?php } ?>
<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
</form>
<?php } if  ($action == "calculate") { ?>
<form name="form1" method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=entry">
<div id="hide">
<input name="hop1Weight" type="hidden" value="<?php echo $hop1Weight; ?>" />
<input name="hop1AA" type="hidden" value="<?php echo $hop1AA; ?>" />
<input name="utilization1" type="hidden" value="<?php echo $utilization1; ?>" />
<input name="hop2Weight" type="hidden" value="<?php echo $hop2Weight; ?>" />
<input name="hop2AA" type="hidden" value="<?php echo $hop2AA; ?>" />
<input name="utilization2" type="hidden" value="<?php echo $utilization2; ?>" />
<input name="hop3Weight" type="hidden" value="<?php echo $hop3Weight; ?>" />
<input name="hop3AA" type="hidden" value="<?php echo $hop3AA; ?>" />
<input name="utilization3" type="hidden" value="<?php echo $utilization3; ?>" />
<input name="hop4Weight" type="hidden" value="<?php echo $hop4Weight; ?>" />
<input name="hop4AA" type="hidden" value="<?php echo $hop4AA; ?>" />
<input name="utilization4" type="hidden" value="<?php echo $utilization4; ?>" />
<input name="hop5Weight" type="hidden" value="<?php echo $hop5Weight; ?>" />
<input name="hop5AA" type="hidden" value="<?php echo $hop5AA; ?>" />
<input name="utilization5" type="hidden" value="<?php echo $utilization5; ?>" />
<input name="hop6Weight" type="hidden" value="<?php echo $hop6Weight; ?>" />
<input name="hop6AA" type="hidden" value="<?php echo $hop6AA; ?>" />
<input name="utilization6" type="hidden" value="<?php echo $utilization6; ?>" />
<input name="hop7Weight" type="hidden" value="<?php echo $hop7Weight; ?>" />
<input name="hop7AA" type="hidden" value="<?php echo $hop7AA; ?>" />
<input name="utilization7" type="hidden" value="<?php echo $utilization7; ?>" />
<input name="hop8Weight" type="hidden" value="<?php echo $hop8Weight; ?>" />
<input name="hop8AA" type="hidden" value="<?php echo $hop8AA; ?>" />
<input name="utilization8" type="hidden" value="<?php echo $utilization8; ?>" />
<input name="hop9Weight" type="hidden" value="<?php echo $hop9Weight; ?>" />
<input name="hop9AA" type="hidden" value="<?php echo $hop9AA; ?>" />
<input name="utilization9" type="hidden" value="<?php echo $utilization9; ?>" />
<input name="hop10Weight" type="hidden" value="<?php echo $hop10Weight; ?>" />
<input name="hop10AA" type="hidden" value="<?php echo $hop10AA; ?>" />
<input name="utilization10" type="hidden" value="<?php echo $utilization10; ?>" />
<input name="preBoilVol" type="hidden" value="<?php echo $preBoilVol; ?>" />
<input name="boilTime" type="hidden" value="<?php echo $boilTime; ?>" />
<input name="finalVol" type="hidden" value="<?php echo $finalVol; ?>" />
<input type="hidden" name="gravity" value="<?php echo $gravity; ?>" />
<input type="hidden" name="desiredIBUs" value="<?php echo $desiredIBUs; ?>" />
<input type="hidden" name="units" value="<?php echo $units; ?>" />
<input type="hidden" name="form1" value="<?php echo $form1; ?>" />
<input type="hidden" name="form2" value="<?php echo $form2; ?>" />	
<input type="hidden" name="form3" value="<?php echo $form3; ?>" />	
<input type="hidden" name="form4" value="<?php echo $form4; ?>" />	
<input type="hidden" name="form5" value="<?php echo $form5; ?>" />	
<input type="hidden" name="form6" value="<?php echo $form6; ?>" />	
<input type="hidden" name="form7" value="<?php echo $form7; ?>" />	
<input type="hidden" name="form8" value="<?php echo $form8; ?>" />	
<input type="hidden" name="form9" value="<?php echo $form9; ?>" />	
<input type="hidden" name="form10" value="<?php echo $form10; ?>" />		  
<input type="hidden" name="elevation" value="0" />
</div>
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
  <div id="referenceHeader">International Bitterness Unit Calculator</div>
      	<table>

      	<tr>
          <td class="dataHeading">&nbsp;</td>
          <td class="data dataHeading" width="10%">Garetz</td>
          <td class="data dataHeading" width="10%">Rager</td>
          <td class="data dataHeading" width="10%">Tinseth</td>
	  	  <td class="data dataHeading">Daniels</td>
      	</tr>
        <?php if ($hop1Weight != "") { ?>
        <tr>
          <td class="dataLabelLeft">Hop 1 IBU: </td>
          <td class="data"><?php echo round ($ibu_1G, 1); ?></td>
          <td class="data"><?php echo round ($ibu_1R, 1); ?></td>
          <td class="data"><?php echo round ($ibu_1T, 1); ?></td>
          <td class="data"><?php echo round ($ibu1_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop2Weight != "") { ?>
       <tr>
          <td class="dataLabelLeft">Hop 2 IBU:</td>
          <td class="data"><?php echo round ($ibu_2G, 1); ?></td>
          <td class="data"><?php echo round ($ibu_2R, 1); ?></td>
          <td class="data"><?php echo round ($ibu_2T, 1); ?></td>
          <td class="data"><?php echo round ($ibu2_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop3Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 3 IBU:</td>
         <td class="data"><?php echo round ($ibu_3G, 1); ?></td>
        <td class="data"><?php echo round ($ibu_3R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_3T, 1); ?></td>
         <td class="data"><?php echo round ($ibu3_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop4Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 4 IBU: </td>
         <td class="data"><?php echo round ($ibu_4G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_4R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_4T, 1); ?></td>
         <td class="data"><?php echo round ($ibu4_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop5Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 5 IBU:</td>
         <td class="data"><?php echo round ($ibu_5G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_5R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_5T, 1); ?></td>
         <td class="data"><?php echo round ($ibu5_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop6Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 6 IBU:</td>
         <td class="data"><?php echo round ($ibu_6G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_6R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_6T, 1); ?></td>
         <td class="data"><?php echo round ($ibu6_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop7Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 7 IBU:</td>
         <td class="data"><?php echo round ($ibu_7G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_7R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_7T, 1); ?></td>
         <td class="data"><?php echo round ($ibu7_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop8Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 8 IBU:</td>
         <td class="data"><?php echo round ($ibu_8G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_8R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_8T, 1); ?></td>
         <td class="data"><?php echo round ($ibu8_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop9Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 9 IBU:</td>
         <td class="data"><?php echo round ($ibu_9G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_9R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_9T, 1); ?></td>
         <td class="data"><?php echo round ($ibu9_D, 1); ?></td>
        </tr>
        <?php } ?>
        <?php if ($hop10Weight != "") { ?>
        <tr>
         <td class="dataLabelLeft">Hop 10 IBU:</td>
         <td class="data"><?php echo round ($ibu_10G, 1); ?></td>
         <td class="data"><?php echo round ($ibu_10R, 1); ?></td>
         <td class="data"><?php echo round ($ibu_10T, 1); ?></td>
         <td class="data"><?php echo round ($ibu10_D, 1); ?></td>
        </tr>
        <?php } ?>
        <tr>
         <td class="dataLabelLeft bdr1T_dark">Total IBUs:</td>
         <td class="data bdr1T_dark"><?php echo round ($ibuG, 1); ?></td>
         <td class="data bdr1T_dark"><?php echo round ($ibuR, 1); ?></td>
         <td class="data bdr1T_dark"><?php echo round ($ibuT, 1); ?></td>
         <td class="data bdr1T_dark"><?php echo round ($ibuD, 1); ?></td>
        </tr>
        <tr>
		<td class="dataLabelLeft">Average IBUs:</td>
		<td class="data" colspan="4"><?php $ibuAverage = ($ibuG + $ibuR + $ibuT + $ibuD)/4; echo round ($ibuAverage, 1); ?></td>
		</tr>
        <tr>
		<td class="dataLabelLeft">Target IBUs:</td>
		<td class="data" colspan="4"><?php echo $desiredIBUs; ?></td>
		</tr>
        <tr>
        <td colspan="5"><p>If the total IBU number is higher or lower than your target IBU, go back and adjust your hop amounts.</p></td>
        </tr>
		</table>
</div>

<?php if (!checkmobile()) { ?><input type="image" src="<?php echo $imageSrc."Brilliant"; ?>/button_back_Brilliant.png" alt="Re-Enter Values" class="calcButton" value="Re-Enter Values" /><? } else { ?><input type="submit" class="calcButton" value="Go Back" /><?php } ?></div>
<?php } ?>