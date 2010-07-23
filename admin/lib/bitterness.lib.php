<?php

//----------------------------------------------------------------//
// This library includes functions necessary for performing IBU
// calculations. Included formulas are: Tinseth, Garetz, Rager
// and Daniels.
//----------------------------------------------------------------//

// $pelletFactor represents the utilization difference between
// pellets and whole/plug hops. Depending on the 
// utilization formula used, this value is either
// multiplied or divided with the result. For example,
// the Tinseth formula is based on whole hops so we need
// to multiply the result of the formula with this factor
// to produce a result for pellet hops.
//
// Hop Union has published data suggesting a 5% - 7% difference 
// in utilization between whole and pellet (Type 90) hops. 
// Most modern data I've seen supports this range. The 15% 
// delta value is a left-over from the old days and appears to 
// have been based on speculation at that time.
// - Kevin
$pelletFactor = $row_pref['hopPelletFactor'];

// --------------------------- Tinseth Method --------------------------- //
// Reference: Tinseth, Glenn. www.realbeer.com/hops, 1995-1999.
// Default form: whole
// Tinseth based all of his data to produce this formula  on whole 
// hops; Therefore, we produce the IBU result for whole hops first
// and then apply the pelletFactor if needed for pellets.
// 
// IBUs = decimal alpha acid utilization * mg/l of added alpha acids
//
// metric
// mg/l of added alpha acids = decimal AA rating * grams hops * 1000
//                             -------------------------------------
//                                       liters of wort
//
// non-metric
// mg/l of added alpha acids = decimal AA rating * ozs hops * 7490
//                             -------------------------------------
//                                      gallons of wort
//
// Decimal Alpha Acid Utilization = Bigness Factor * Boil Time Factor
//
// $form  = ('pellet' || 'whole')
// $units = ('metric' || 'us')
function calc_bitter_tinseth($boilTime, $sg, $aa, $weight, $vol, $form, $units) {
  global $pelletFactor;

  $f = ($units == "us") ? 7489 : 1000;

  // Bigness Factor = 1.65 * 0.000125^(wort gravity - 1)
  $bignessFactor = 1.65 * (pow(0.000125, ($sg - 1)));
  
  // Boil Time Factor = 1 - e^(-0.04 * time in mins)
  //                    ----------------------------
  //                               4.15
  $eT = (-0.04 * $boilTime);
  $boilTimeFactor = (1 - (pow(2.71828, $eT))) / 4.15;

  $decimalAA = $bignessFactor * $boilTimeFactor;

  if ($form == "pellet") {
    $ibu = ($decimalAA * ((($aa / 100) * $weight * $f) / $vol)) * $pelletFactor;
  } else {
    $ibu = ($decimalAA * ((($aa / 100) * $weight * $f) / $vol));
  }

  return $ibu; 
}

// ---------------------------- Rager Method ----------------------------- //
// $form  = ('pellet' || 'whole')
// $units = ('metric' || 'us')
function calc_bitter_rager($boilTime, $sg, $aa, $weight, $vol, $form, $units) {
  global $pelletFactor;

  $f = ($units == "us") ? 7489 : 1000;

  if (($boilTime > 0) && ($boilTime <= 6))
    $u = "0.05";
  elseif (($boilTime > 6) && ($boilTime <= 10))
    $u = "0.06";
  elseif (($boilTime > 10) && ($boilTime <= 15))
    $u = "0.08";
  elseif (($boilTime > 15) && ($boilTime <= 20))
    $u = "0.101";
  elseif (($boilTime > 20) && ($boilTime <= 25))
    $u = ".121";
  elseif (($boilTime > 25) && ($boilTime <= 30))
    $u = ".153";
  elseif (($boilTime > 30) && ($boilTime <= 35))
    $u = ".188";
  elseif (($boilTime > 35) && ($boilTime <= 40))
    $u = ".228";
  elseif (($boilTime > 40) && ($boilTime <= 45))
    $u = ".269";
  elseif (($boilTime > 45) && ($boilTime <= 50))
    $u = ".281";
  elseif (($boilTime > 50) && ($boilTime <= 60))
    $u = ".291";
  elseif (($boilTime > 60) && ($boilTime <= 65))
    $u = ".30";
  elseif (($boilTime > 70) && ($boilTime <= 75))
    $u = ".31";
  elseif (($boilTime > 75) && ($boilTime <= 80))
    $u = ".32";
  elseif (($boilTime > 80) && ($boilTime <= 85))
    $u = ".33";
  elseif ($boilTime >= 90)
    $u = ".34";
  else
    $u = "0";
    
  if ($gravity > 1.050)
    $ga = (($gravity - 1.050) / .2);
  else
    $ga = 0;

  if ($form == "pellet")
    $ibu = ($weight * $u * ($aa / 100) * $f) / ($vol * (1 + $ga));
  else
    $ibu = ($weight * $u * ($aa / 100) * $f) / ($vol * (1 + $ga)) / $pelletFactor;
  
  return $ibu;
}

// --------------------------- Garetz Method --------------------------- //
// Default form: whole.
// $form  = ('pellet' || 'whole')
// $units = ('metric' || 'us')
function calc_bitter_garetz($boilTime, $sg, $aa, $weight, $postBoilVol, $form, $units,
			    $preBoilVol, $desiredIBU, $elevation) {
  global $pelletFactor;

  if ($units == "us") {
    $f = .7489;
  } else {
    $f = .1;
    $elevation = $elevation / .3048;
  }

  if (($boilTime > 10) && ($boilTime <= 15))
    $u = "1";
  elseif (($boilTime > 15) && ($boilTime <= 20))
    $u = "4";
  elseif (($boilTime > 20) && ($boilTime <= 25))
    $u = "6";
  elseif (($boilTime > 25) && ($boilTime <= 30))
    $u = "11";
  elseif (($boilTime > 30) && ($boilTime <= 35))
    $u = "13";
  elseif (($boilTime > 35) && ($boilTime <= 40))
    $u = "19";
  elseif (($boilTime > 40) && ($boilTime <= 45))
    $u = "23";
  elseif (($boilTime > 45) && ($boilTime <= 50))
    $u = "24";
  elseif (($boilTime > 50) && ($boilTime <= 60))
    $u = "25";
  elseif (($boilTime > 60) && ($boilTime <= 65))
    $u = "26";
  elseif (($boilTime > 70) && ($boilTime <= 75))
    $u = "27";
  elseif (($boilTime > 75) && ($boilTime <= 80))
    $u = "28";
  elseif (($boilTime > 80) && ($boilTime <= 85))
    $u = "29";
  elseif ($boilTime >= 90)
    $u = "30";
  else
    $u = "0";

  // Calculate the Concentration Factor (CF)
  $cf = $postBoilVol / $preBoilVol;
  
  // Calculate Boil Gravity (BG)
  $bg = ($cf * ($sg - 1)) + 1;

  // Calculate Gravity Factor (GF)
  $gf = (($bg - 1.050) / .2) + 1;
  
  // Calculate Hop Factor
  $hf = (($cf * $desiredIBU) / 260) + 1;
  
  // Calculate Temperature Factor (TF)
  $tf = (($elevation / 550 ) * 0.02) + 1;

  // Calculate Combined Adjustments (CA)
  $ca = $gf * $hf * $tf;
 
  if ($form == "pellet")
    $ibu = ($u * $aa * $weight * $f) / ($postBoilVol * $ca);
  else
    $ibu = ($u * $aa * $weight * $f) / ($postBoilVol * $ca) / $pelletFactor;

  return $ibu;
}

// ----------------------------- Daniels Method ----------------------------- //
// Reference: Daniels, Ray. Designing Great Beers, Brewers
//            Publications, 2000.
//
// Equation - U.S.:
//  IBU = Weight * Utilization % * Alpha % * 7,489
//   -------------------------------------------
// (Final Volume * (1 +[(Boil Time - 1.050) / 0.2)])
//
// Equation - Metric:
//  IBU = Weight * Utilization % * Alpha % * 1,000
//   -------------------------------------------
// (Final Volume * (1 +[(Boil Time - 1.050) / 0.2)])
//
// $form  = ('pellet' || 'whole')
// $units = ('metric' || 'us')
function calc_bitter_daniels($boilTime, $sg, $aa, $weight, $vol, $form, $units) {

  $f = ($units == "us") ? 7489 : 1000;

  if ($form == "pellet") {
    if (($boilTime > 0) && ($boilTime <= 10))
      $u = ".06";
    elseif (($boilTime > 10) && ($boilTime <= 19))
      $u = ".15";
    elseif (($boilTime > 19) && ($boilTime <= 30))
      $u = ".19";
    elseif (($boilTime > 29) && ($boilTime <= 44))
      $u = ".24";
    elseif (($boilTime > 44) && ($boilTime <= 59))
      $u = ".27";
    elseif (($boilTime > 59) && ($boilTime <= 74))
      $u = ".30";
    elseif ($boilTime >= 74)
      $u = ".34";
    else
      $u = "0";
  } else {
    if (($boilTime > 0) && ($boilTime <= 10))
      $u = ".05";
    elseif (($boilTime > 10) && ($boilTime <= 19))
      $u = ".12";
    elseif (($boilTime > 19) && ($boilTime <= 30))
      $u = ".15";
    elseif (($boilTime > 29) && ($boilTime <= 44))
      $u = ".19";
    elseif (($boilTime > 44) && ($boilTime <= 59))
      $u = ".22";
    elseif (($boilTime > 59) && ($boilTime <= 74))
      $u = ".24";
    elseif ($boilTime >= 74)
      $u = ".27";
    else
      $u = "0";
  }

  // Correct gravity
  if ($gravity < 1.050)
    $cGravity = 1;
  else
    $cGravity = 1 + (($gravity - 1.050) / 0.2);

  // Calculate
  $ibu = ($weight * $u * ($aa * .01) * $f) / ($vol * $cGravity);

  return $ibu;
}

?>