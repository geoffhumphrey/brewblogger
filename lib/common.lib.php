<?php

/**
 * Module:      common.lib.php
 * Description: This library includes functions necessary for performing
 *              calculations, etc.
 */


include (INCLUDES.'titles.inc.php');
//include (INCLUDES.'messages.inc.php');
include (INCLUDES.'scrubber.inc.php');

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

function check_setup($tablename, $database) {

	require(CONFIG.'config.php');
	mysqli_select_db($connection,$database);

	$query_log = sprintf("SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_schema = '%s' AND table_name = '%s'",$database, $tablename);
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);

	if ($row_log['count'] == 0) return FALSE;
	else return TRUE;

}

function check_update($column_name, $table_name) {

	require(CONFIG.'config.php');
	mysqli_select_db($connection,$database);

	$query_log = sprintf("SHOW COLUMNS FROM `%s` LIKE '%s'",$table_name,$column_name);
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log_exists = mysqli_num_rows($log);

    if ($row_log_exists) return TRUE;
	else return FALSE;

}


// ---------------------------- Check for mobile browsers ----------------------------------
// DEPRECATED
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

function calc_ppg($gravity,$wort,$grain,$units) {
	$ppg = (($gravity - 1) * 1000 * $wort) / $grain;
	switch ($units) {
 		case "gallons":
   		$ppg = $ppg;
   		break;
 		case "liters":
   		$ppg = ($ppg / 10);
   		break;
		}
	$ppg = round($ppg,0);
	return $ppg;
}

function calc_efficiency($gravity,$wort,$grain,$units,$log_id) {
	include(CONFIG.'config.php');
	include(ADMIN_INCLUDES.'constants.inc.php');

	$query_log = sprintf("SELECT * FROM brewing WHERE id='%s'",$log_id);
	$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
	$row_log = mysqli_fetch_assoc($log);

	$grainsPPG = array();

	$efficiency_sum = 0;
	switch ($units) {
 		case "gallons":
   		for ($i = 0; $i < MAX_GRAINS; $i++) {
  			$key              = "brewGrain" . ($i + 1);
  			$query            = 'SELECT maltPPG FROM malt WHERE maltName="' . $row_log[$key] . '"';
  			$grainsPPG[$i]    = mysqli_query($connection,$query) or die (mysqli_error($connection));
			$row_grainsPPG[$i]= mysqli_fetch_assoc($grainsPPG[$i]);
			$key              = "brewGrain" . ($i + 1) . "Weight";
			$grainsWeight[$i] = $row_log[$key];
			if ($grainsWeight[$i] > 0) {
				$ppg = array_sum($row_grainsPPG[$i]);
    			$efficiency_sum = ($ppg * $grainsWeight[$i]) / $wort;
				$efficiency[] = $efficiency_sum;
				}
   			}
   		break;
 		case "liters":
   		for ($i = 0; $i < MAX_GRAINS; $i++) {
			$key              = "brewGrain" . ($i + 1);
			$query            = 'SELECT maltPPG FROM malt WHERE maltName="' . $row_log[$key] . '"';
			$grainsPPG[$i]    = mysqli_query($connection,$query) or die (mysqli_error($connection));
			$row_grainsPPG[$i]= mysqli_fetch_assoc($grainsPPG[$i]);
			$key              = "brewGrain" . ($i + 1) . "Weight";
			$grainsWeight[$i] = $row_log[$key];
			if ($grainsWeight[$i] > 0) {
				$ppg = array_sum($row_grainsPPG[$i]);
				$efficiency_sum = ($ppg * ($grainsWeight[$i] * 2.202)) / ($wort * .264);
				$efficiency[] = $efficiency_sum;
				}
   		}
   	break;
	}

	$efficiency_sum = array_sum($efficiency);

	if (($efficiency_sum != 0) && ($gravity != ""))  {
  		$efficiency = round(((($gravity - 1) * 1000) / $efficiency_sum * 100),1)."%";
		}
	else $efficiency = '';

	return $efficiency;
}

// ---------------------------- Date Conversion -----------------------------------------
// http://www.phpbuilder.com/annotate/message.php3?id=1031006
function dateconvert($date,$func) {
	if (empty($date)) {
		return '';
	}

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

// --------------------------- V3.0.0 ------------------------------

function addOrdinalNumberSuffix($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
  }

function display_place($place,$method) {

	require(CONFIG.'config.php');

	if ($method == "0") {
		$place = addOrdinalNumberSuffix($place);
	}

	if ($method == "1") {
		switch($place){
			case "1": $place = addOrdinalNumberSuffix($place);
			break;
			case "2": $place = addOrdinalNumberSuffix($place);
			break;
			case "3": $place = addOrdinalNumberSuffix($place);
			break;
			case "4": $place = addOrdinalNumberSuffix($place);
			break;
			case "honMen": $place = "HM";
			break;
			case "best": $place = "BOS";
			break;
		default: $place = "N/A";
		}
	}
	if ($method == "2") {
		switch($place){
			case "1": $place = "<span class=\"fa fa-lg fa-trophy text-gold\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "2": $place = "<span class=\"fa fa-lg fa-trophy text-silver\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "3": $place = "<span class=\"fa fa-lg fa-trophy text-bronze\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "4": $place = "<span class=\"fa fa-lg fa-trophy text-purple\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "honMen": $place = "<span class=\"fa fa-lg fa-trophy text-teal\"></span> HM";
			break;
			case "best": $place = "<span class=\"fa fa-lg fa-certificate text-gold\"></span> Best of Show";
			break;
			default: $place = "Entry Only";
			}
	}

	if ($method == "3") {
		switch($place){
			case "1": $place = "<span class=\"fa fa-lg fa-trophy text-gold\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "2": $place = "<span class=\"fa fa-lg fa-trophy text-silver\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "3": $place = "<span class=\"fa fa-lg fa-trophy text-bronze\"></span> ".addOrdinalNumberSuffix($place);
			break;
			case "honMen":  $place = "<span class=\"fa fa-lg fa-trophy text-teal\"></span> HM";
			break;
			case "best": $place = "<span class=\"fa fa-lg fa-certificate text-gold\"></span> BOS";
			break;
			default: $place = "<span class=\"fa fa-lg fa-trophy text-forest-green\"></span> EO";
			}
	}

	return $place;
}

function style_category($number,$prefsStyleSet) {

	if ($prefsStyleSet == "BJCP2008") {
		switch ($number) {
			case "01": $style_cat = "Light Lager"; break;
			case "02": $style_cat = "Pilsner"; break;
			case "03": $style_cat = "European Amber Lager"; break;
			case "04": $style_cat = "Dark Lager"; break;
			case "05": $style_cat = "Bock"; break;
			case "06": $style_cat = "Light Hybrid Beer"; break;
			case "07": $style_cat = "Amber Hybrid Beer"; break;
			case "08": $style_cat = "English Pale Ale"; break;
			case "09": $style_cat = "Scottish and Irish Ale"; break;
			case "10": $style_cat = "American Ale"; break;
			case "11": $style_cat = "English Brown Ale"; break;
			case "12": $style_cat = "Porter"; break;
			case "13": $style_cat = "Stout"; break;
			case "14": $style_cat = "India Pale Ale (IPA)"; break;
			case "15": $style_cat = "German Wheat and Rye Beer"; break;
			case "16": $style_cat = "Belgian and French Ale"; break;
			case "17": $style_cat = "Sour Ale"; break;
			case "18": $style_cat = "Belgian Strong Ale"; break;
			case "19": $style_cat = "Strong Ale"; break;
			case "20": $style_cat = "Fruit Beer"; break;
			case "21": $style_cat = "Spice/Herb/Vegetable Beer"; break;
			case "22": $style_cat = "Smoke-Flavored and Wood-Aged Beer"; break;
			case "23": $style_cat = "Specialty Beer"; break;
			case "24": $style_cat = "Traditional Mead"; break;
			case "25": $style_cat = "Melomel (Fruit Mead)"; break;
			case "26": $style_cat = "Other Mead"; break;
			case "27": $style_cat = "Standard Cider and Perry"; break;
			case "28": $style_cat = "Specialty Cider and Perry"; break;
			default: $style_cat = "Custom Style"; break;
			}
		}

		if ($prefsStyleSet == "BJCP2015") {
		switch ($number) {
			case "01": $style_cat = "Standard American Beer"; break;
			case "02": $style_cat = "International Lager"; break;
			case "03": $style_cat = "Czech Lager"; break;
			case "04": $style_cat = "Pale Malty European Lager"; break;
			case "05": $style_cat = "Pale Bitter European Beer"; break;
			case "06": $style_cat = "Amber Malty European Lager"; break;
			case "07": $style_cat = "Amber Bitter European Beer"; break;
			case "08": $style_cat = "Dark European Lager"; break;
			case "09": $style_cat = "Strong European Beer"; break;
			case "10": $style_cat = "German Wheat Beer"; break;
			case "11": $style_cat = "British Bitter"; break;
			case "12": $style_cat = "Pale Commonwealth Beer"; break;
			case "13": $style_cat = "Brown British Beer"; break;
			case "14": $style_cat = "Scottish Ale"; break;
			case "15": $style_cat = "Irish Beer"; break;
			case "16": $style_cat = "Dark British Beer"; break;
			case "17": $style_cat = "Strong British Ale"; break;
			case "18": $style_cat = "Pale American Ale"; break;
			case "19": $style_cat = "Amber and Brown American Beer"; break;
			case "20": $style_cat = "American Porter and Stout"; break;
			case "21": $style_cat = "IPA"; break;
			case "22": $style_cat = "Strong American Ale"; break;
			case "23": $style_cat = "European Sour Ale"; break;
			case "24": $style_cat = "Belgian Ale"; break;
			case "25": $style_cat = "Strong Belgian Ale"; break;
			case "26": $style_cat = "Trappist Ale"; break;
			case "27": $style_cat = "Historical Beer"; break;
			case "28": $style_cat = "American Wild Ale"; break;
			case "29": $style_cat = "Fruit Beer"; break;
			case "30": $style_cat = "Spiced Beer"; break;
			case "31": $style_cat = "Alternative Fermentables Beer"; break;
			case "32": $style_cat = "Smoked Beer"; break;
			case "33": $style_cat = "Wood Beer"; break;
			case "34": $style_cat = "Specialty Beer"; break;
			case "M1": $style_cat = "Traditional Mead"; break;
			case "M2": $style_cat = "Fruit Mead"; break;
			case "M3": $style_cat = "Spiced Mead"; break;
			case "M4": $style_cat = "Specialty Mead"; break;
			case "C1": $style_cat = "Standard Cider and Perry"; break;
			case "C2": $style_cat = "Specialty Cider and Perry"; break;
			default: $style_cat = "Custom Style"; break;
			}
		}
	return $style_cat;
}

function hop_more_info($name) {

	require(CONFIG.'config.php');

	$query_hops_profiles = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $name);
	$hops_profiles = mysqli_query($connection,$query_hops_profiles) or die (mysqli_error($connection));
	$row_hops_profiles = mysqli_fetch_assoc($hops_profiles);
	$totalRows_hops_profiles = mysqli_num_rows($hops_profiles);

	$return = "";

	if ($totalRows_hops_profiles > 0) $return = $row_hops_profiles['hopsGrown']."|".$row_hops_profiles['hopsInfo']."|".$row_hops_profiles['hopsUse']."|".$row_hops_profiles['hopsExample']."|".$row_hops_profiles['hopsAAULow']."|".$row_hops_profiles['hopsAAUHigh']."|".$row_hops_profiles['hopsSub'];

	return $return;

}

// $page / $section / $action / $dbTable / $filter / $id
function build_public_url($page, $section, $action, $dbTable, $filter, $id, $base_url) {
	if (SEF) {
		$url = $base_url;
		if ($page != "default") {
			$url .= $page."/";
			if ($section != "default") $url .= $section."/";
			if ($action != "default") $url .= $action."/";
			if ($dbTable != "default") $url .= $dbTable."/";
			if ($filter != "default") $url .= $filter."/";
			if ($id != "default") $url .= $id."/";
		}
		return rtrim($url,"/");
	}
	else {
		$url = $base_url;
		if ($page != "default") {
			$url .= "index.php?page=".$page;
			if ($section != "default") $url .= "&amp;section=".$section;
			if ($action != "default") $url .= "&amp;action=".$action;
			if ($dbTable != "default") $url .= "&amp;dbTable=".$dbTable;
			if ($filter != "default") $url .= "&amp;filter=".$filter;
			if ($id != "default") $url .= "&amp;id=".$id;
		}
		return $url;
	}
}

function award_count($source,$id) {

	require(CONFIG.'config.php');
	mysqli_select_db($connection,$database);

	if ($source == "brewblog-list") $awardBrewID = "b".$id;
	if ($source == "recipe-list") $awardBrewID = "r".$id;
	$query_awards = sprintf("SELECT COUNT(*) as 'count' FROM awards WHERE awardBrewID='%s'", $awardBrewID);
	$awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
	$row_awards = mysqli_fetch_assoc($awards);

	return $row_awards['count'];

	//return $query_awards;

}

function get_session_array_values($haystack,$needle,$needle_value) {
    $arrIt = new RecursiveIteratorIterator(new RecursiveArrayIterator($haystack));
    $return = "";
    foreach ($arrIt as $sub) {
        $subArray = $arrIt->getSubIterator();
        if ($subArray[$needle] === $needle_value) {
            $return[] = iterator_to_array($subArray);
        }
    }
    return $return;
}

// print_r($_SESSION['adjuncts']);
// $outputArray = get_session_array_values($_SESSION['adjuncts'],"adjunctName","Grits");
// $outputArray = get_session_array_values($_SESSION['adjuncts'],"id","4");
// if (isset($outputArray)) print_r($outputArray);
// if (is_array($outputArray)) echo $outputArray[0]['id'];
?>