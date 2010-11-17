<?php

include ('titles.inc.php');
include ('messages.inc.php');
include ('scrubber.inc.php');

$agent = $_SERVER['HTTP_USER_AGENT']; 
if (strstr($agent, "MSIE")) $printBrowser = "IE"; else $printBrowser = "notIE";

//echo $agent."<br>";
//echo $printBrowser."<br>";

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
list($day, $month, $year) = explode("/", $date);
$date = "$year-$month-$day"; 
return $date;
}
if ($func == 2){ //output conversion
list($year, $month, $day) = explode("-", $date);
if ($month == "01" ) { $month = "January "; }
if ($month == "02" ) { $month = "February "; }
if ($month == "03" ) { $month = "March "; }
if ($month == "04" ) { $month = "April "; }
if ($month == "05" ) { $month = "May "; }
if ($month == "06" ) { $month = "June "; }
if ($month == "07" ) { $month = "July "; }
if ($month == "08" ) { $month = "August "; }
if ($month == "09" ) { $month = "September "; }
if ($month == "10" ) { $month = "October "; }
if ($month == "11" ) { $month = "November "; }
if ($month == "12" ) { $month = "December "; }
$day = ltrim($day, "0");
/* 
Future release: add logic to check if user preferences 
dictate "American" English date formats vs. "British" 
English date formats
*/
$date = "$month $day, $year";
return $date;
}

if ($func == 4){ //insert conversion
list($month, $day, $year) = explode("/", $date); 
$date = "$year-$month-$day"; 
return $date;
	}
}

// function to convert MySQL dates to only month/year.
function dateconvert2($date,$func) {
if ($func == 1){ //insert conversion
list($day, $month, $year) = explode("-", $date);
$date = "$year-$month-$day"; 
return $date;
}
if ($func == 2){ //output conversion
list($year, $month, $day) = explode("-", $date);
$date = "$year";
if ($month == "01" ) { $month = "Jan"; }
if ($month == "02" ) { $month = "Feb"; }
if ($month == "03" ) { $month = "Mar"; }
if ($month == "04" ) { $month = "Apr"; }
if ($month == "05" ) { $month = "May"; }
if ($month == "06" ) { $month = "Jun"; }
if ($month == "07" ) { $month = "Jul"; }
if ($month == "08" ) { $month = "Aug"; }
if ($month == "09" ) { $month = "Sep"; }
if ($month == "10" ) { $month = "Oct"; }
if ($month == "11" ) { $month = "Nov"; }
if ($month == "12" ) { $month = "Dec"; }
$day = ltrim($day, "0");
/* 
Future release: add logic to check if user preferences 
dictate "American" English date formats vs. "British" 
English date formats
*/
return $date;
}

if ($func == 3){ //output conversion
list($year, $month, $day) = explode("-", $date);
if ($month == "01" ) { $month = "Jan"; }
if ($month == "02" ) { $month = "Feb"; }
if ($month == "03" ) { $month = "Mar"; }
if ($month == "04" ) { $month = "Apr"; }
if ($month == "05" ) { $month = "May"; }
if ($month == "06" ) { $month = "Jun"; }
if ($month == "07" ) { $month = "Jul"; }
if ($month == "08" ) { $month = "Aug"; }
if ($month == "09" ) { $month = "Sep"; }
if ($month == "10" ) { $month = "Oct"; }
if ($month == "11" ) { $month = "Nov"; }
if ($month == "12" ) { $month = "Dec"; }
$day = ltrim($day, "0");
/* 
Future release: add logic to check if user preferences 
dictate "American" English date formats vs. "British" 
English date formats
*/
$date = "$month $day, $year";
return $date;
}

if ($func == 4){ //output conversion
list($year, $month, $day) = explode("-", $date); 
if ($month == "01" ) { $month = "Jan"; }
if ($month == "02" ) { $month = "Feb"; }
if ($month == "03" ) { $month = "Mar"; }
if ($month == "04" ) { $month = "Apr"; }
if ($month == "05" ) { $month = "May"; }
if ($month == "06" ) { $month = "Jun"; }
if ($month == "07" ) { $month = "Jul"; }
if ($month == "08" ) { $month = "Aug"; }
if ($month == "09" ) { $month = "Sep"; }
if ($month == "10" ) { $month = "Oct"; }
if ($month == "11" ) { $month = "Nov"; }
if ($month == "12" ) { $month = "Dec"; }
$day = ltrim($day, "0");
/* 
Future release: add logic to check if user preferences 
dictate "American" English date formats vs. "British" 
English date formats
*/
$date = "$day $month $year";
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

function output_beer_xml($id, $source, $style, $imageSrc, $theme) { 

$agent = $_SERVER['HTTP_USER_AGENT']; 
if (strstr($agent, "MSIE")) $printBrowser = "IE"; else $printBrowser = "notIE";

	if ($printBrowser == "IE") $output = '<a href="includes/output_beer_xml.inc.php?id='.$id.'&source='.$source.'&brewStyle='.$style.'">'; 
	else $output = '<a href="#" onclick="window.open(\'includes/output_beer_xml.inc.php?id='.$id.'&source='.$source.'&brewStyle='.$style.'\',\'\',\'height=5,width=5, scrollbars=no, toolbar=no, resizable==no, menubar=no\'); return false;">';
	$output .= '<img src="'.$imageSrc.$theme.'/button_beer_xml_'.$theme.'.png"  border="0" alt="Output to Beer XML"></a>';
	return $output;

}

function output_print_recipe($id, $source, $dbTable, $page, $style, $scale, $amt, $name, $imageSrc, $theme) { 

$agent = $_SERVER['HTTP_USER_AGENT']; 
if (strstr($agent, "MSIE")) $printBrowser = "IE"; else $printBrowser = "notIE";

	if ($printBrowser == "IE") {  
	$output = '<a href="#" onClick="window.open(\'print.php?page='.$page.'&source='.$source.'&dbTable='.$dbTable.'&brewStyle='.$style;  
	if ($scale == "Y") $output .= '&amp;action=scale&amp;amt='.$amt;
 	$output .= '&id='.$id.'&view=print\',\'\',\'height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;" title="Print '.$name.'">';  }
	
	else { $output = '<a href="print.php?page='.$page.'&source='.$source.'&dbTable='.$dbTable.'&brewStyle='.$style;  
	if ($scale == "Y") $output .= '&amp;action=scale&amp;amt='.$amt; 
	$output .= '&id='.$id.'&KeepThis=true&TB_iframe=true&height=450&width=700" title="Print '.$name.'" class="thickbox">';
	}
	$output .= '<img src="'.$imageSrc.$theme.'/button_print_recipe_'.$theme.'.png"  border="0" alt="print '.$source.'"></a>';
	return $output;
}

function output_print_log($id, $source, $dbTable, $page, $style, $scale, $amt, $name, $imageSrc, $theme) { 

$agent = $_SERVER['HTTP_USER_AGENT']; 
if (strstr($agent, "MSIE")) $printBrowser = "IE"; else $printBrowser = "notIE";

	if ($printBrowser == "IE") {  
	$output = '<a href="#" onClick="window.open(\'print.php?page='.$page.'&source='.$source.'&dbTable='.$dbTable.'&brewStyle='.$style;  
	if ($scale == "Y") $output .= '&amp;action=scale&amp;amt='.$amt;
 	$output .= '&id='.$id.'&view=print\',\'\',\'height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;" title="Print '.$name.'">';  }
	
	else { $output = '<a href="print.php?page='.$page.'&source='.$source.'&dbTable='.$dbTable.'&brewStyle='.$style;  
	if ($scale == "Y") $output .= '&amp;action=scale&amp;amt='.$amt; 
	$output .= '&id='.$id.'&KeepThis=true&TB_iframe=true&height=450&width=700" title="Print '.$name.'" class="thickbox">'; }
	$output .= '<img src="'.$imageSrc.$theme.'/button_print_log_'.$theme.'.png"  border="0" alt="print '.$source.'"></a>';
	return $output;
}


?>