<?php if ($row_pref['mode'] == "2") { ?>
<form name="form" id="form">
<table class="dataTable">
<tr>
	<td class="dataLabelLeft">Filter By Member:</td>
    <td class="data">
      <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
        <option value="index.php?page=calendar" <?php if ($filter == "all") echo "SELECTED"; ?>>Club Brewing Calendar</option>
        <?php do { ?>
        <option value="index.php?page=calendar&filter=<?php echo $row_members['user_name']; ?>" <?php if ($row_members['user_name'] == $filter) echo "SELECTED"; ?>><?php echo $row_members['realFirstName']." ".$row_members['realLastName']; ?></option>
        <?php } while ($row_members = mysqli_fetch_assoc($members)); ?>
      </select>
    <br />
    <br />
    </td>
</tr>
</table>
</form>

<?php }

function get_timestamp($mysql_date){
	$date_array = explode("-",$mysql_date); // split the array
    $var_month = "";
    $var_day = "";
    $var_year = "";
    if (is_array($date_array)) {
        if (isset($date_array[0])) $var_year = $date_array[0];
        if (isset($date_array[1])) $var_month = $date_array[1];
        if (isset($date_array[2])) $var_day = $date_array[2];
        if ((is_numeric($var_month)) && (is_numeric($var_day)) && (is_numeric($var_year))) $var_timestamp = mktime(0,0,0,$var_month,$var_day,$var_year);
		else $var_timestamp = time();
        return($var_timestamp);
    }
}

// Gather variables
$todaysDate = mktime(0,0,0,date('m'),date('d'),date('Y'));
$offset = "";
$offset_count = "";
$previous_link = "";
$next_link = "";
$thead = "";
$tbody = "";

if (!is_numeric($section)) $date = mktime(0,0,0,date('m'), date('d'), date('Y'));
else $date = $section;

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

// Get the first day of the month
$month_start = mktime(0,0,0,$month,1,$year);

// Get friendly month name
$month_name = date('F',$month_start);

// Figure out which day of the week the month starts on.
$month_start_day = date('D',$month_start);

switch($month_start_day){
    case "Sun": $offset = 0; break;
    case "Mon": $offset = 1; break;
    case "Tue": $offset = 2; break;
    case "Wed": $offset = 3; break;
    case "Thu": $offset = 4; break;
    case "Fri": $offset = 5; break;
    case "Sat": $offset = 6; break;
}

// Determine how many days are in the last month.
if ($month == 1) $num_days_last = cal_days_in_month(0, 12, ($year -1));
else $num_days_last = cal_days_in_month(0, ($month -1), $year);

// Determine how many days are in the current month.
$num_days_current = cal_days_in_month(0, $month, $year);

// Build an array for the current days in the month
for($i = 1; $i <= $num_days_current; $i++){
    $num_days_array[] = $i;
}

// Build an array for the number of days in last month
for($i = 1; $i <= $num_days_last; $i++){
    $num_days_last_array[] = $i;
}

// If the $offset from the starting day of the week happens to be Sunday, $offset would be 0, so don't need an offset correction.
if ($offset > 0){
    $offset_correction = array_slice ($num_days_last_array, -$offset, $offset);
    $new_count = array_merge ($offset_correction, $num_days_array);
    $offset_count = count($offset_correction);
}

// The else statement is to prevent building the $offset array.
else $new_count = $num_days_array;

// count how many days we have with the two previous arrays merged together
$current_num = count($new_count);

// Since we will have 5 HTML table rows (TR) with 7 table data entries (TD) we need to fill in 35 TDs
// We will have to figure out how many days to appened to the end of the final array to make it 35 days.
if ($current_num > 35){
   $num_weeks = 6;
   $outset = (42 - $current_num);
}

elseif ($current_num < 35){
   $num_weeks = 5;
   $outset = (35 - $current_num);
}

if ($current_num == 35){
   $num_weeks = 5;
   $outset = 0;
}

// Outset Correction
for($i = 1; $i <= $outset; $i++){
   $new_count[] = $i;
}

// Now let's "chunk" the $new_count array into weeks. Each week has 7 days so we will array_chunk it into 7 days.
$weeks = array_chunk($new_count, 7);

if ($month == 1) $previous_date = mktime(0,0,0,12,$day,($year -1));
else $previous_date = mktime(0,0,0,($month -1),$day,$year);
$previous_link_url = build_public_url("calendar", $previous_date, "view", "default", $filter, $id, $base_url);
$previous_link .= "<a href=\"".$previous_link_url."\" title=\"Next Month\"><span class=\"fa fa-3x fa-arrow-circle-left \"></span></a>";

if ($month == 12) $next_date = mktime(0,0,0,1,$day,($year + 1));
else $next_date = mktime(0,0,0,($month +1),$day,$year);
$next_link_url = build_public_url("calendar", $next_date, "view", "default", $filter, $id, $base_url);
$next_link .= "<a href=\"".$next_link_url."\" title=\"Next Month\"><span class=\"fa fa-3x fa-arrow-circle-right \"></span></a>";

// Build the month navigation
$thead .= "<div class=\"row\">";
$thead .= "<div class=\"col col-xs-2 col-sm-3 col-md-3 col-lg-2 text-center\">".$previous_link."</div>";
$thead .= "<div class=\"col col-xs-8 col-sm-6 col-md-6 col-lg-8 text-center\"><h3>".$month_name." ".$year."</h3></div>";
$thead .= "<div class=\"col col-xs-2 col-sm-3 col-md-3 col-lg-2 text-center\">".$next_link."</div>";
$thead .= "</div>";

if (is_numeric($section)) {
    $reset_link_url = build_public_url("calendar", "today", "view", "all", $filter, $id, $base_url);
    $thead .= "<div class=\"row\">";
    $thead .= "<div class=\"col col-xs-12 text-center\">";
    $thead .= "<p><a href=\"".$reset_link_url."\" title=\"Reset to Today\"><span class=\"fa fa-rotate-left\"></span> Reset to Today</a></p>";
    $thead .= "</div>";
    $thead .= "</div>";
}

// Build the heading portion of the calendar table
$thead .="<table class=\"table table-bordered table-striped\">\n";
$thead .= "<tr>\n";
$thead .= "<th class=\"weekdays\">Sun<span class=\"hidden-xs hidden-sm\">day</span></th>";
$thead .= "<th class=\"weekdays\">Mon<span class=\"hidden-xs hidden-sm\">day</span></th>";
$thead .= "<th class=\"weekdays\">Tues<span class=\"hidden-xs hidden-sm\">day</span></th>";
$thead .= "<th class=\"weekdays\">Wed<span class=\"hidden-xs hidden-sm\">nesday</span></th>";
$thead .= "<th class=\"weekdays\">Thu<span class=\"hidden-xs hidden-sm\">rsday</span></th>";
$thead .= "<th class=\"weekdays\">Fri<span class=\"hidden-xs hidden-sm\">day</span></th>";
$thead .= "<th class=\"weekdays\">Sat<span class=\"hidden-xs hidden-sm\">urday</span></th>";
$thead .= "\n";
$thead .= "</tr>\n";

// Now we break each key of the array into a week and create a new table row for each week with the days of that week in the table data
$i = 0;

foreach($weeks AS $week){

       $tbody .= "<tr>\n";

       foreach($week as $d) {

         if($i < $offset_count){

			$query_calDays = "SELECT id,brewName,brewPrimary,brewSecondary,brewTertiary,brewLager,brewAge,brewBrewerID,brewStatus,brewDate,brewArchive,brewTapDate,brewStyle FROM brewing";
			if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
			$calDays = mysqli_query($connection,$query_calDays) or die (mysqli_error($connection));
			$row_calDays = mysqli_fetch_assoc($calDays);
			$totalRows_calDays = mysqli_num_rows($calDays);

			$today0 = mktime(0,0,0,$month -1,$d,$year);
            $day_link = "<a href=\"index.php?page=calendar&filter=$filter&date=".$today0."\">$d</a>";
            $tbody .= "<td class=\"warning day\">$day_link<br>";
            $tbody .= "<ul class=\"list-unstyled\">";

			do {

                if ($row_calDays['brewArchive'] != "Y") {
                    $brewName0 = truncate_string($row_calDays['brewName'],20,'...');
                    $mysql_date0 = $row_calDays['brewDate'];
                    $planned0 = get_timestamp($mysql_date0);
                    $brewday0 = $planned0;

                    if ($row_calDays['brewPrimary'] > 0) $secondary0 = $brewday0 + ($row_calDays['brewPrimary'] * 86400);
                    else $secondary0 = "0";

                    if ($secondary0 > 0) $tertiary0 = $secondary0 + ($row_calDays['brewSecondary'] * 86400);
                    else $tertiary0 = "0";

                    if ($tertiary0 > 0) $lager0 = $tertiary0 + ($row_calDays['brewTertiary'] * 86400);
                    else $lager0 = "0";

                    if ($lager0 > 0) $age0 = $lager0 + ($row_calDays['brewLager'] * 86400);
                    else $age0 = "0";

                    if (isset($row_calDays['brewTapDate'])) $tap0 = get_timestamp($row_calDays['brewTapDate']);
                    else {
                        if ($age0 > 0) $tap0 = $age0 + ($row_calDays['brewAge'] * 86400);
                        else $tap0 = "0";
                    }

                    if (SEF) $brewblog_link = build_public_url("brewblog", urlencode(strtolower(strtr($row_calDays['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_calDays['brewStyle'],$prettify_url))), "detail", strtolower($row_calDays['brewBrewerID']), $row_calDays['id'], $base_url);
                    else $brewblog_link = build_public_url("brewblog", "default", "default", "default", $row_calDays['brewBrewerID'], $row_calDays['id'], $base_url);

                    $blog_link = "<a href=\"".$brewblog_link."\">".$brewName0."</a>";

					if (($row_calDays['brewStatus'] == "Planned") && (($planned0 == $today0))) $tbody .= "<li>Plan: ".$blog_link."</li>";
					if (($row_calDays['brewStatus'] != "Planned") && (($brewday0 == $today0))) $tbody .= "<li>Brew: ".$blog_link."</li>";
					if (($secondary0 == $today0) && ($row_calDays['brewSecondary'] > 0)) $tbody .= "<li>Sec: ".$blog_link."</li>";
					if (($tertiary0 == $today0)  && ($row_calDays['brewTertiary'] > 0))  $tbody .= "<li>Ter: ".$blog_link."</li>";
					if (($lager0 == $today0)  && ($row_calDays['brewLager'] > 0)) $tbody .= "<li>Lag: ".$blog_link."</li>";
					if (($age0 == $today0) && ($row_calDays['brewAge'] > 0)) $tbody .= "<li>Age: ".$blog_link."</li>";
					if ($tap0 == $today0) $tbody .= "Tap: ".$blog_link."</li>";

        		}

			}

			   while ($row_calDays = mysqli_fetch_assoc($calDays));

               $tbody .= "</ul>";
               $tbody .= "</td>\n";

         }

/*
 * If the previous IF statement was not TRUE on the result, then nothing
 * would have been drawn yet, so we are going to check and determine if
 * the current day being looped belongs to the month being displayed. At
 * the same time, we need to ensure that it 1.) does not belong to the
 * previous month and 2.) does not belong to the next month. If both of
 * these rules are passed, then the current day must fall into the current
 * month being displayed.
 */

    if(($i >= $offset_count) && ($i < ($num_weeks * 7) - $outset)) {

/*
 * Alright, here's a catchy part. We will determine if the current day
 * of the $date value (argument passed to the script, or set if no date
 * argument is passed) is the same as the current day being looped for
 * this cycle, if it is, we will not display a hyperlink and we will shade
 * the day with the appropriate CSS style.
 */

           if ($date === mktime(0,0,0,$month,$d,$year)) {

                $query_calDays = "SELECT id,brewName,brewPrimary,brewSecondary,brewTertiary,brewLager,brewAge,brewBrewerID,brewStatus,brewDate,brewArchive,brewTapDate,brewStyle FROM brewing";
                if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
                $calDays = mysqli_query($connection,$query_calDays) or die (mysqli_error($connection));
                $row_calDays = mysqli_fetch_assoc($calDays);
                $totalRows_calDays = mysqli_num_rows($calDays);

                $tbody .= "<td class=\"info\">$d<br>";
                $today1 = mktime(0,0,0,$month,$d,$year);
                $tbody .= "<ul class=\"list-unstyled\">";

                do {

                    if ($row_calDays['brewArchive'] != "Y") {

                        $brewName1 = truncate_string($row_calDays['brewName'],20,'...');

                        $mysql_date1 = $row_calDays['brewDate'];
                        $planned1 = get_timestamp($mysql_date1);
                        $brewday1 = $planned1;

                        if ($row_calDays['brewPrimary'] > 0) $secondary1 = $brewday1 + ($row_calDays['brewPrimary'] * 86400);
                        else $secondary1 = "0";

                        if ($secondary1 > 0) $tertiary1 = $secondary1 + ($row_calDays['brewSecondary'] * 86400);
                        else $tertiary1 = "0";

                        if ($tertiary1 > 0) $lager1 = $tertiary1 + ($row_calDays['brewTertiary'] * 86400);
                        else $lager1 = "0";

                        if ($lager1 > 0) $age1 = $lager1 + ($row_calDays['brewLager'] * 86400);
                        else $age1 = "0";

                        if ($row_calDays['brewTapDate'] != "") $tap1 = get_timestamp($row_calDays['brewTapDate']);
                        else {
                            if ($age1 > 0) $tap1 = $age1 + ($row_calDays['brewAge'] * 86400);
                            else $tap1 = "0";
                        }

                        if (SEF) $brewblog_link = build_public_url("brewblog", urlencode(strtolower(strtr($row_calDays['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_calDays['brewStyle'],$prettify_url))), "detail", strtolower($row_calDays['brewBrewerID']), $row_calDays['id'], $base_url);
                        else $brewblog_link = build_public_url("brewblog", "default", "default", "default", $row_calDays['brewBrewerID'], $row_calDays['id'], $base_url);
						$blog_link = "<a href=\"".$brewblog_link."\">".$brewName1."</a>";

                        if (($row_calDays['brewStatus'] == "Planned") && (($planned1 == $today1))) $tbody .= "<li>Plan: ".$blog_link."</li>";
                        if (($row_calDays['brewStatus'] != "Planned") && (($brewday1 == $today1))) $tbody .= "<li>Brew: ".$blog_link."</li>";
                        if (($secondary1 == $today1) && ($row_calDays['brewSecondary'] > 0)) $tbody .= "<li>Sec: ".$blog_link."</li>";
                        if (($tertiary1 == $today1)  && ($row_calDays['brewTertiary'] > 0))  $tbody .= "<li>Ter: ".$blog_link."</li>";
                        if (($lager1 == $today1)  && ($row_calDays['brewLager'] > 0)) $tbody .= "<li>Lag: ".$blog_link."</li>";
                        if (($age1 == $today1) && ($row_calDays['brewAge'] > 0)) $tbody .= "<li>Age: ".$blog_link."</li>";
                        if ($tap1 == $today1) $tbody .= "Tap: ".$blog_link."</li>";

                    }

                } while ($row_calDays = mysqli_fetch_assoc($calDays));

			   $tbody .= "</ul>";
               $tbody .= "</td>\n";

		   } else {

			$query_calDays = "SELECT id,brewName,brewPrimary,brewSecondary,brewTertiary,brewLager,brewAge,brewBrewerID,brewStatus,brewDate,brewArchive,brewTapDate,brewStyle FROM brewing";
			if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
			$calDays = mysqli_query($connection,$query_calDays) or die (mysqli_error($connection));
			$row_calDays = mysqli_fetch_assoc($calDays);
			$totalRows_calDays = mysqli_num_rows($calDays);

			$today2 = mktime(0,0,0,$month,$d,$year);
			$highlight = "";
			if ($date == $today2) $highlight = "info";
			$tbody .= "<td class=\"monthdays $highlight\" valign=\"top\">"."<a href=\"index.php?page=calendar&filter=$filter&date=".$today2."\">".$d."</a>";
			$tbody .= "<ul class=\"list-unstyled\">";

			do {

				if ($row_calDays['brewArchive'] != "Y") {

					$brewName2 = truncate_string($row_calDays['brewName'],20,'...');
					$mysql_date2 = $row_calDays['brewDate'];
					$planned2 = get_timestamp($mysql_date2);
					$brewday2 = $planned2;

					if ($row_calDays['brewPrimary'] > 0) $secondary2 = $brewday2 + ($row_calDays['brewPrimary'] * 86400);
					else $secondary2 = "0";
					if ($secondary2 > 0) $tertiary2 = $secondary2 + ($row_calDays['brewSecondary'] * 86400);
					else $tertiary2 = "0";
					if ($tertiary2 > 0) $lager2 = $tertiary2 + ($row_calDays['brewTertiary'] * 86400);
					else $lager2 = "0";
					if ($lager2 > 0) $age2 = $lager2 + ($row_calDays['brewLager'] * 86400);
					else $age2 = "0";

					if ($row_calDays['brewTapDate'] != "") $tap2 = get_timestamp($row_calDays['brewTapDate']);
					else {
						if ($age2 > 0) $tap2 = $age2 + ($row_calDays['brewAge'] * 86400);
						else $tap2 = "0";
					}

					if (SEF) $brewblog_link = build_public_url("brewblog", urlencode(strtolower(strtr($row_calDays['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_calDays['brewStyle'],$prettify_url))), "detail", strtolower($row_calDays['brewBrewerID']), $row_calDays['id'], $base_url);
                    else $brewblog_link = build_public_url("brewblog", "default", "default", "default", $row_calDays['brewBrewerID'], $row_calDays['id'], $base_url);
                    $blog_link = "<a href=\"".$brewblog_link."\">".$brewName2."</a>";

					if (($row_calDays['brewStatus'] == "Planned") && (($planned2 == $today2))) $tbody .= "<li>Plan: ".$blog_link."</li>";
					if (($row_calDays['brewStatus'] != "Planned") && (($brewday2 == $today2))) $tbody .= "<li>Brew: ".$blog_link."</li>";
					if (($secondary2 == $today2) && ($row_calDays['brewSecondary'] > 0)) $tbody .= "<li>Sec: ".$blog_link."</li>";
					if (($tertiary2 == $today2)  && ($row_calDays['brewTertiary'] > 0))  $tbody .= "<li>Ter: ".$blog_link."</li>";
					if (($lager2 == $today2)  && ($row_calDays['brewLager'] > 0)) $tbody .= "<li>Lag: ".$blog_link."</li>";
					if (($age2 == $today2) && ($row_calDays['brewAge'] > 0)) $tbody .= "<li>Age: ".$blog_link."</li>";
					if ($tap2 == $today2) $tbody .= "<li>Tap: ".$blog_link."</li>";

				}

			} while ($row_calDays = mysqli_fetch_assoc($calDays));


			$tbody .= "</ul>";
			$tbody .= "</td>\n";

           }

        } elseif ($i >= ($num_weeks * 7) - $outset) {

			$query_calDays = "SELECT id,brewName,brewPrimary,brewSecondary,brewTertiary,brewLager,brewAge,brewBrewerID,brewStatus,brewDate,brewArchive,brewTapDate,brewStyle FROM brewing";
			if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
			$calDays = mysqli_query($connection,$query_calDays) or die (mysqli_error($connection));
			$row_calDays = mysqli_fetch_assoc($calDays);
			$totalRows_calDays = mysqli_num_rows($calDays);

			$today3 = mktime(0,0,0,$month +1,$d,$year);
            $day_link = "<a href=\"index.php?page=calendar&filter=$filter&date=".$today3."\">$d</a>";
            $tbody .= "<td class=\"warning day\">$day_link<br>";
			$tbody .= "<ul class=\"list-unstyled\">";

			do {
				if ($row_calDays['brewArchive'] != "Y") {
					$brewName3 = truncate_string($row_calDays['brewName'],20,'...');

					$mysql_date3 = $row_calDays['brewDate'];
					$planned3 = get_timestamp($mysql_date3);
					$brewday3 = get_timestamp($mysql_date3);

					if ($row_calDays['brewPrimary'] > 0) $secondary3 = $brewday3 + ($row_calDays['brewPrimary'] * 86400);
					else $secondary3 = "0";

					if ($secondary3 > 0) $tertiary3 = $secondary3 + ($row_calDays['brewSecondary'] * 86400);
					else $tertiary3 = "0";

					if ($tertiary3 > 0) $lager3 = $tertiary3 + ($row_calDays['brewTertiary'] * 86400);
					else $lager3 = "0";

					if ($lager3 > 0) $age3 = $lager3 + ($row_calDays['brewLager'] * 86400);
					else $age3 = "0";

					if ($row_calDays['brewTapDate'] != "") $tap3 = get_timestamp($row_calDays['brewTapDate']);
					else {
						if ($age3 > 0) $tap3 = $age3 + ($row_calDays['brewAge'] * 86400);
						else $tap3 = "0";
					}

					if (SEF) $brewblog_link = build_public_url("brewblog", urlencode(strtolower(strtr($row_calDays['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_calDays['brewStyle'],$prettify_url))), "detail", strtolower($row_calDays['brewBrewerID']), $row_calDays['id'], $base_url);
                    else $brewblog_link = build_public_url("brewblog", "default", "default", "default", $row_calDays['brewBrewerID'], $row_calDays['id'], $base_url);
                    $blog_link = "<a href=\"".$brewblog_link."\">".$brewName3."</a>";

					if (($row_calDays['brewStatus'] == "Planned") && (($planned3 == $today3))) $tbody .= "<li>Plan: ".$blog_link."</li>";
					if (($row_calDays['brewStatus'] != "Planned") && (($brewday3 == $today3))) $tbody .= "<li>Brew: ".$blog_link."</li>";
					if (($secondary3 == $today3) && ($row_calDays['brewSecondary'] > 3)) $tbody .= "<li>Sec: ".$blog_link."</li>";
					if (($tertiary3 == $today3)  && ($row_calDays['brewTertiary'] > 3))  $tbody .= "<li>Ter: ".$blog_link."</li>";
					if (($lager3 == $today3)  && ($row_calDays['brewLager'] > 3)) $tbody .= "<li>Lag: ".$blog_link."</li>";
					if (($age3 == $today3) && ($row_calDays['brewAge'] > 3)) $tbody .= "<li>Age: ".$blog_link."</li>";
					if ($tap3 == $today3) $tbody .= "Tap: ".$blog_link."</li>";

				}
			}
			while ($row_calDays = mysqli_fetch_assoc($calDays));

			$tbody .= "</ul>\n";
			$tbody .= "</td>\n";
        }

  	$i++;

	//Close out the for loop for $week AS $d.
	}

	//Close out the table row for the current week.
	$tbody .= "</tr>\n";

}

$tbody .= "</table>";

echo $thead;
echo $tbody;
?>

