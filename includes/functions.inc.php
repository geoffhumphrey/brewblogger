<?php

/**
 * Module:      functions.inc.php
 * Description: This library includes functions necessary for performing
 *              calculations, etc. 
 */
 

include ('titles.inc.php');
include ('messages.inc.php');
include ('scrubber.inc.php');

$agent = $_SERVER['HTTP_USER_AGENT']; 
if (strstr($agent, "MSIE")) $printBrowser = "IE"; else $printBrowser = "notIE";

// ---------------------------- Alternating Table Row Colors ----------------------------
// May be deprecated with inclusion of DataTables functionality.
if (checkmobile()) { 
	$color1 = "#dddddd"; 
	$color2 = "#cecece"; 
	$color = $color1;
} 

else {
	$color1 = $row_colorChoose['themeColor1'];
	$color2 = $row_colorChoose['themeColor2'];
	$color = $color1;
}

// ---------------------------- Check for mobile browsers ----------------------------------

// Thanks to http://www.brainhandles.com/techno-thoughts/detecting-mobile-browsers for the script to detect mobile browsers.
function checkmobile(){
	if(isset($_SERVER["HTTP_X_WAP_PROFILE"])) return true;
	
	if(preg_match("/wap\.|\.wap/i",$_SERVER["HTTP_ACCEPT"])) return true;
	
	// Quick Array to kill out matches in the user agent that might cause false positives
	if(isset($_SERVER["HTTP_USER_AGENT"])) {
		$badmatches = array("Creative\ AutoUpdate","OfficeLiveConnector","MSIE\ 8\.0");
		foreach($badmatches as $badstring) {
			if(preg_match("/".$badstring."/i",$_SERVER["HTTP_USER_AGENT"])) return false;
			}
	
	// Positive matches
		if(preg_match("/Creative\ AutoUpdate/i",$_SERVER["HTTP_USER_AGENT"])) return false;
		$uamatches = array("midp", "j2me", "avantg", "docomo", "novarra", "palmos", "palmsource", "240x320", "opwv", "chtml", "pda", "windows\ ce", "mmp\/", "blackberry", "mib\/", "symbian", "wireless", "nokia", "hand", "mobi", "phone", "cdm", "up\.b", "audio", "SIE\-", "SEC\-", "samsung", "HTC", "mot\-", "mitsu", "sagem", "sony", "alcatel", "lg", "erics", "vx", "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch", "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi", "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo", "sgh", "gradi", "jb", "\d\d\di", "moto");
		foreach($uamatches as $uastring) {
			if(preg_match("/".$uastring."/i",$_SERVER["HTTP_USER_AGENT"])) return true;
			}
	}
	return false;
} 

// ---------------------------- Calculations used in the "Specifics" section of a log or recipe ----------------------------------
function calc_plato($value) {
	$calc = round((-463.37) + (668.72 * $value) - (205.35 * pow($value,2)),1);
	return $calc;
}

function calc_abv($og,$fg) {
	$calc = round((($og - $fg) / .75) * 100, 1);
	return $calc;
}

function calc_abw($og,$fg) {
	$calc = round((((($og - $fg) / .75) * 100) * .78), 1);
	return $calc;
}

function calc_extract($og,$fg) {
	$calc = round((0.1808 * calc_plato($og)) + (0.8192 * calc_plato($fg)),1);
	return $calc;
}

function calc_app_atten($og,$fg) {
	$calc = round((1 - (calc_plato($fg) / calc_plato($og))) * 100, 1);
	return $calc;
}

function calc_real_atten($og,$fg) {
	$calc = round((1 - (calc_extract($og,$fg) / calc_plato($og))) * 100,1);	
	return $calc;
}

function calc_calories($og,$fg) {
	$calc = round(((6.9 * calc_abw($og,$fg)) + 4.0 * (calc_extract($og,$fg) - 0.1)) * $fg * 3.55,0);
	return $calc;
}

function calc_bugu($bitterness,$og) {
	$calc = round($bitterness/(($og - 1) * 1000), 2);
	return $calc;
}

// ---------------------------- Date Conversion -----------------------------------------
// http://www.phpbuilder.com/annotate/message.php3?id=1031006
function dateconvert($date,$func) {
	
	if ($func == 1){ //insert conversion
		list($day, $month, $year) = explode("/", $date);
		$date = "$year-$month-$day"; 
		return $date;
	}
	
	if ($func == 2) { //output conversion
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

	if ($func == 4) { //insert conversion
		list($month, $day, $year) = explode("/", $date); 
		$date = "$year-$month-$day"; 
		return $date;
	}
}

function datecharcheck($date) {
	$d1 = strpos($date, "/");
	if ($d1 !== false) return "true";
	
	$d2 = strpos($date, "-");
	if ($d2 !== false) return $d2."-";
	
	$d3 = strpos($date, " ");
	if ($d3 !== false) return "true";

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

function truncate_string ($str, $length, $trailing) { 
      // take off chars for the trailing 
      $length-=strlen($trailing);
	  // string exceeded length, truncate and add trailing characters
      if (strlen($str) > $length) return substr($str,0,$length).$trailing; 
      // string was already short enough, return the string 
      else  $res = $str; 
      return $res; 
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
 		$output .= '&id='.$id.'&view=print\',\'\',\'height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;" title="Print '.$name.'">';  
	}
	
	else { 
		$output = '<a href="print.php?page='.$page.'&source='.$source.'&dbTable='.$dbTable.'&brewStyle='.$style;  
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
 		$output .= '&id='.$id.'&view=print\',\'\',\'height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes\'); return false;" title="Print '.$name.'">';  
	}
	
	else { 
		$output = '<a href="print.php?page='.$page.'&source='.$source.'&dbTable='.$dbTable.'&brewStyle='.$style;  
		if ($scale == "Y") $output .= '&amp;action=scale&amp;amt='.$amt; 
		$output .= '&id='.$id.'&KeepThis=true&TB_iframe=true&height=450&width=700" title="Print '.$name.'" class="thickbox">';
	}
	
	$output .= '<img src="'.$imageSrc.$theme.'/button_print_log_'.$theme.'.png"  border="0" alt="print '.$source.'"></a>';
	
	return $output;
}

?>