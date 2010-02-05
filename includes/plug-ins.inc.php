<?php

include ('titles.inc.php');
include ('messages.inc.php');
include ('scrubber.inc.php');

$agent = $_SERVER['HTTP_USER_AGENT']; 
if (eregi ("msie", $agent)) $printBrowser = "IE"; else $printBrowser = "notIE";

//echo $agent;
//echo $browser;

// ---------------------------- Color Conversion ------------------------------------------------------------
// Calculations based upon Daniels, R. (2000, pg. 44). Designing great beers. Boulder, CO: Brewer's Publications.
function colorconvert($color, $c) {
if ($c == "SRM") { // EBC to SRM
	$ccon = $color / 1.97; 
	return round ($ccon, 1);
	}

if ($c == "EBC") { // SRM to EBC
	$ccon = $color * 1.97;
	return round ($ccon, 1);
	}
}

// ---------------------------- Temperature, Weight, and Volume Conversion ----------------------------------

function tempconvert($temp,$t) { // $t = desired output, defined at function call
if ($t == "F") { // Celsius to F if source is C
	$tcon = (($temp - 32) / 1.8); 
    return round ($tcon, 0);
	}
	
if ($t == "C") { // F to Celsius
	$tcon = (($temp - 32) * (5/9)); 
    return round ($tcon, 0);
	}
}

function weightconvert($weight,$w) { // $w = desired output, defined at function call
if ($w == "pounds") { // kilograms to pounds
	$wcon = ($weight * 2.2046);
	return round ($wcon, 2);
	}
	
if ($w == "ounces") { // grams to ounces
	$wcon = ($weight * 0.03527);
	return round ($wcon, 2);
	}	
	
if ($w == "grams") { // ounces to grams
	$wcon = ($weight * 28.3495);
	return round ($wcon, 2);
	}
	
if ($w == "kilograms") { // pounds to kilograms
	$wcon = ($weight * 0.4535);
	return round ($wcon, 2);
	}
}

function volumeconvert($volume,$v) {  // $v = desired output, defined at function call
if ($v == "gallons") { // liters to gallons
	$vcon = ($volume * 0.2641);
	return round ($vcon, 2);
	}
	
if ($v == "ounces") { // milliliters to ounces
	$vcon = ($volume * 29.573);
	return round ($vcon, 2);
	}	

if ($v == "liters") { // gallons to liters
	$vcon = ($volume * 3.7854);
	return round ($vcon, 2);
	}
	
if ($v == "milliliters") { // fluid ounces to milliliters
	$vcon = ($volume * 29.5735) ;
	return round ($vcon, 2);
	}	
	
}

// ---------------------------- Date Conversion -----------------------------------------
// http://www.phpbuilder.com/annotate/message.php3?id=1031006
function dateconvert($date,$func) {
if ($func == 1){ //insert conversion
list($day, $month, $year) = split('[/.-]', $date); 
$date = "$year-$month-$day"; 
return $date;
}
if ($func == 2){ //output conversion
list($year, $month, $day) = split('[-.]', $date); 
$date = "$day, $year"; 
if ($month == "01" ) { echo "January "; }
if ($month == "02" ) { echo "February "; }
if ($month == "03" ) { echo "March "; }
if ($month == "04" ) { echo "April "; }
if ($month == "05" ) { echo "May "; }
if ($month == "06" ) { echo "June "; }
if ($month == "07" ) { echo "July "; }
if ($month == "08" ) { echo "August "; }
if ($month == "09" ) { echo "September "; }
if ($month == "10" ) { echo "October "; }
if ($month == "11" ) { echo "November "; }
if ($month == "12" ) { echo "December "; }
return $date;
}

if ($func == 4){ //insert conversion
list($month, $day, $year) = split('[/.-]', $date); 
$date = "$year-$month-$day"; 
return $date;
	}
}

// function to convert MySQL dates to only month/year.
function dateconvert2($date,$func) {
if ($func == 1){ //insert conversion
list($day, $month, $year) = split('[/.-]', $date); 
$date = "$year-$month-$day"; 
return $date;
}
if ($func == 2){ //output conversion
list($year, $month, $day) = split('[-.]', $date); 
$date = "$year";
if ($month == "01") { echo "Jan "; }
if ($month == "02") { echo "Feb "; }
if ($month == "03") { echo "Mar "; }
if ($month == "04") { echo "Apr "; }
if ($month == "05") { echo "May "; }
if ($month == "06") { echo "Jun "; }
if ($month == "07") { echo "Jul "; }
if ($month == "08") { echo "Aug "; }
if ($month == "09") { echo "Sep "; }
if ($month == "10") { echo "Oct "; }
if ($month == "11") { echo "Nov "; }
if ($month == "12") { echo "Dec "; }
return $date;
}

if ($func == 3){ //output conversion
list($year, $month, $day) = split('[-.]', $date); 
$date = "$day, $year";
if ($month == "01") { echo "Jan "; }
if ($month == "02") { echo "Feb "; }
if ($month == "03") { echo "Mar "; }
if ($month == "04") { echo "Apr "; }
if ($month == "05") { echo "May "; }
if ($month == "06") { echo "Jun "; }
if ($month == "07") { echo "Jul "; }
if ($month == "08") { echo "Aug "; }
if ($month == "09") { echo "Sep "; }
if ($month == "10") { echo "Oct "; }
if ($month == "11") { echo "Nov "; }
if ($month == "12") { echo "Dec "; }
return $date;
}

if ($func == 4){ //output conversion
list($year, $month, $day) = split('[-.]', $date); 
$date = "$day $month $year";
if ($month == "01") { echo "Jan "; }
if ($month == "02") { echo "Feb "; }
if ($month == "03") { echo "Mar "; }
if ($month == "04") { echo "Apr "; }
if ($month == "05") { echo "May "; }
if ($month == "06") { echo "Jun "; }
if ($month == "07") { echo "Jul "; }
if ($month == "08") { echo "Aug "; }
if ($month == "09") { echo "Sep "; }
if ($month == "10") { echo "Oct "; }
if ($month == "11") { echo "Nov "; }
if ($month == "12") { echo "Dec "; }
return $date;
}
}




function datecharcheck ($date) {
	$d1 = strpos($date, "/");
	if ($d1 !== false) return "true";
	
	$d2 = strpos($date, "-");
	if ($d2 !== false) return $d2."-";
	
	$d3 = strpos($date, " ");
	if ($d3 !== false) return "true";

}

// ---------------------------- Truncate Functions --------------------------------------

function Truncate ($str, $length=100, $trailing='...')  
{ 
      // take off chars for the trailing 
      $length-=strlen($trailing); 
      if (strlen($str) > $length)  
      { 
         // string exceeded length, truncate and add trailing dots 
         return substr($str,0,$length).$trailing; 
      }  
      else  
      {  
         // string was already short enough, return the string 
         $res = $str;  
      } 
      return $res; 
}
function Truncate2 ($str, $length=24, $trailing='...')  
{ 
      // take off chars for the trailing 
      $length-=strlen($trailing); 
      if (strlen($str) > $length)  
      { 
         // string exceeded length, truncate and add trailing dots 
         return substr($str,0,$length).$trailing; 
      }  
      else  
      {  
         // string was already short enough, return the string 
         $res = $str;  
      } 
      return $res; 
}
function Truncate3 ($str, $length=50, $trailing='...')  
{ 
      // take off chars for the trailing 
      $length-=strlen($trailing); 
      if (strlen($str) > $length)  
      { 
         // string exceeded length, truncate and add trailing dots 
         return substr($str,0,$length).$trailing; 
      }  
      else  
      {  
         // string was already short enough, return the string 
         $res = $str;  
      } 
      return $res; 
}
function Truncate4 ($str, $length=39, $trailing='...')  
{ 
      // take off chars for the trailing 
      $length-=strlen($trailing); 
      if (strlen($str) > $length)  
      { 
         // string exceeded length, truncate and add trailing dots 
         return substr($str,0,$length).$trailing; 
      }  
      else  
      {  
         // string was already short enough, return the string 
         $res = $str;  
      } 
      return $res; 
}

function Truncate5 ($str, $length=500, $trailing='...')  
{ 
      // take off chars for the trailing 
      $length-=strlen($trailing); 
      if (strlen($str) > $length)  
      { 
         // string exceeded length, truncate and add trailing dots 
         return substr($str,0,$length).$trailing; 
      }  
      else  
      {  
         // string was already short enough, return the string 
         $res = $str;  
      } 
      return $res; 
}
function Truncate6 ($str, $length=12, $trailing='...')  
{ 
      // take off chars for the trailing 
      $length-=strlen($trailing); 
      if (strlen($str) > $length)  
      { 
         // string exceeded length, truncate and add trailing dots 
         return substr($str,0,$length).$trailing; 
      }  
      else  
      {  
         // string was already short enough, return the string 
         $res = $str;  
      } 
      return $res; 
}

// ---------------------------- Alternating Table Row Colors ----------------------------
if (checkmobile()) { $color1 = "#dddddd"; $color2 = "#cecece"; $color = $color1; } 
else 
{
$color1 = $row_colorChoose['themeColor1'];
$color2 = $row_colorChoose['themeColor2'];
$color = $color1;
}


?>