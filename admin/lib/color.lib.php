<?php
/**
 * Module: color.lib.php
 * Description: This library provides all the functions needed to calculate SRM
 *              values and convert between SRM and EBC.
 */

/**
 * The Daniels, Moser and Morey methods are all well documented in numerous
 * brewing texts. Moser came first and then Daniels modified that formula
 * in Brewing Techniques - Vol. 3 Nos. 4-6, "Beer Color Demystified - Part
 * I-III." Morey came last in a response to the BT article by Daneils:
 * http://www.brewingtechniques.com/brewingtechniques/beerslaw/morey.html
 * The Morey formula is considered to be the most accurate since it's
 * exponential instead of linear and, therefore, follows the data
 * more accurately. Wikipedia's "Standard Reference Method" page is also
 * a good source as is Palmer's "How to Brew" book.
 *
 * The SRM/EBC conversions are based on the definition of SRM from the
 * ASBC.
 */

// Convert SRM to EBC
function srm_to_ebc($srm) {
  return round((1.97 * $srm), 1);
}

// Convert EBC to SRM
function ebc_to_srm($ebc) {
  return round(($ebc / 1.97), 1);
}

// Calculate SRM using the Daniels method.
function calc_srm_daniels($mcu) {
  return ($mcu * 0.2) + 8.4;
}

// Calculate SRM using the Moser method.
function calc_srm_moser($mcu) {
  return ($mcu * 0.3) + 4.7;
}

// Calculate the SRM using the Morey method.

function calc_srm_morey($mcu) {
  return 1.4922 * pow($mcu, 0.6859);
}

function srm_color($srm,$method) {
	if ($method == "ebc") $srm = (1.97 * $srm); else $srm = $srm;
	
    if ($srm >= 1 && $srm < 2) $return = "#f3f993";
	elseif ($srm >= 2 && $srm < 3) $return = "#f5f75c";
	elseif ($srm >= 3 && $srm < 4) $return = "#f6f513";
	elseif ($srm >= 4 && $srm < 5) $return = "#eae615";
	elseif ($srm >= 5 && $srm < 6) $return = "#e0d01b";
	elseif ($srm >= 6 && $srm < 7) $return = "#d5bc26";
	elseif ($srm >= 7 && $srm < 8) $return = "#cdaa37";
	elseif ($srm >= 8 && $srm < 9) $return = "#c1963c";
	elseif ($srm >= 9 && $srm < 10) $return = "#be8c3a";
	elseif ($srm >= 10 && $srm < 11) $return = "#be823a";
	elseif ($srm >= 11 && $srm < 12) $return = "#c17a37";
	elseif ($srm >= 12 && $srm < 13) $return = "#bf7138";
	elseif ($srm >= 13 && $srm < 14) $return = "#bc6733";
	elseif ($srm >= 14 && $srm < 15) $return = "#b26033";
	elseif ($srm >= 15 && $srm < 16) $return = "#a85839";
	elseif ($srm >= 16 && $srm < 17) $return = "#985336";
	elseif ($srm >= 17 && $srm < 18) $return = "#8d4c32";
	elseif ($srm >= 18 && $srm < 19) $return = "#7c452d";
	elseif ($srm >= 19 && $srm < 20) $return = "#6b3a1e";
	elseif ($srm >= 20 && $srm < 21) $return = "#5d341a";
	elseif ($srm >= 21 && $srm < 22) $return = "#4e2a0c";
	elseif ($srm >= 22 && $srm < 23) $return = "#4a2727";
	elseif ($srm >= 23 && $srm < 24) $return = "#361f1b";
	elseif ($srm >= 24 && $srm < 25) $return = "#261716";
	elseif ($srm >= 25 && $srm < 26) $return = "#231716";
	elseif ($srm >= 26 && $srm < 27) $return = "#19100f";
	elseif ($srm >= 27 && $srm < 28) $return = "#16100f";
	elseif ($srm >= 28 && $srm < 29) $return = "#120d0c";
	elseif ($srm >= 29 && $srm < 30) $return = "#100b0a";
	elseif ($srm >= 30 && $srm < 31) $return = "#050b0a";
	elseif ($srm > 31) $return = "#000000";
  	else $return = "#ffffff";
return $return;
}

// Convert SRM value to hex color code for web display.
function get_display_color($srm) {
  $srm = round($srm);

  if ($srm >= 01 && $srm < 02) { $displayColor ="#f3f993"; }
  elseif ($srm >= 02 && $srm < 03) { $displayColor = "#f5f75c"; }
  elseif ($srm >= 03 && $srm < 04) { $displayColor = "#f6f513"; }
  elseif ($srm >= 04 && $srm < 05) { $displayColor = "#eae615"; }
  elseif ($srm >= 05 && $srm < 06) { $displayColor = "#e0d01b"; }
  elseif ($srm >= 06 && $srm < 07) { $displayColor = "#d5bc26"; }
  elseif ($srm >= 07 && $srm < 08) { $displayColor = "#cdaa37"; }
  elseif ($srm >= 08 && $srm < 09) { $displayColor = "#c1963c"; }
  elseif ($srm >= 09 && $srm < 10) { $displayColor = "#be8c3a"; }
  elseif ($srm >= 10 && $srm < 11) { $displayColor = "#be823a"; }
  elseif ($srm >= 11 && $srm < 12) { $displayColor = "#c17a37"; }
  elseif ($srm >= 12 && $srm < 13) { $displayColor = "#bf7138"; }
  elseif ($srm >= 13 && $srm < 14) { $displayColor = "#bc6733"; }
  elseif ($srm >= 14 && $srm < 15) { $displayColor = "#b26033"; }
  elseif ($srm >= 15 && $srm < 16) { $displayColor = "#a85839"; }
  elseif ($srm >= 16 && $srm < 17) { $displayColor = "#985336"; }
  elseif ($srm >= 17 && $srm < 18) { $displayColor = "#8d4c32"; }
  elseif ($srm >= 18 && $srm < 19) { $displayColor = "#7c452d"; }
  elseif ($srm >= 19 && $srm < 20) { $displayColor = "#6b3a1e"; }
  elseif ($srm >= 20 && $srm < 21) { $displayColor = "#5d341a"; }
  elseif ($srm >= 21 && $srm < 22) { $displayColor = "#4e2a0c"; }
  elseif ($srm >= 22 && $srm < 23) { $displayColor = "#4a2727"; }
  elseif ($srm >= 23 && $srm < 24) { $displayColor = "#361f1b"; }
  elseif ($srm >= 24 && $srm < 25) { $displayColor = "#261716"; }
  elseif ($srm >= 25 && $srm < 26) { $displayColor = "#231716"; }
  elseif ($srm >= 26 && $srm < 27) { $displayColor = "#19100f"; }
  elseif ($srm >= 27 && $srm < 28) { $displayColor = "#16100f"; }
  elseif ($srm >= 28 && $srm < 29) { $displayColor = "#120d0c"; }
  elseif ($srm >= 29 && $srm < 30) { $displayColor = "#100b0a"; }
  elseif ($srm >= 30 && $srm < 31) { $displayColor = "#050b0a"; }
  elseif ($srm > 31) { $displayColor = "#000000"; }
  else { $displayColor = "#ffffff"; }

  return $displayColor;
}