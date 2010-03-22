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
        <?php } while ($row_members = mysql_fetch_assoc($members)); ?> 
      </select>
    <br />
    <br />
    </td>
</tr>
</table>
</form>
<?php } 

// http://phppod.com/Tutorials/PHP-Calendar-Tutorial.html

function GetTimeStamp($MySqlDate)
{   // http://www.weberdev.com/get_example-1385.html    
	$date_array = explode("-",$MySqlDate); // split the array
    $var_year = $date_array[0];
    $var_month = $date_array[1];
    $var_day = $date_array[2];
    $var_timestamp = mktime(0,0,0,$var_month,$var_day,$var_year);
    return($var_timestamp); // return it to the user
}

error_reporting('0');
ini_set('display_errors', '0');

// Gather variables
$todaysDate = mktime(0,0,0,date('m'), date('d'), date('Y'));

if(!isset($_REQUEST['date'])){

//If no date argument is passed, then we'll set one by using the mktime() function for the current month, date and year.

   $date = mktime(0,0,0,date('m'), date('d'), date('Y'));
} else {

   $date = $_REQUEST['date'];
}

$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

// Get the first day of the month
$month_start = mktime(0,0,0,$month, 1, $year);

// Get friendly month name
$month_name = date('F', $month_start);

// Figure out which day of the week the month starts on.
$month_start_day = date('D', $month_start);

switch($month_start_day){
    case "Sun": $offset = 0; break;
    case "Mon": $offset = 1; break;
    case "Tue": $offset = 2; break;
    case "Wed": $offset = 3; break;
    case "Thu": $offset = 4; break;
    case "Fri": $offset = 5; break;
    case "Sat": $offset = 6; break;
}

// determine how many days are in the last month.
if($month == 1){
   $num_days_last = cal_days_in_month(0, 12, ($year -1));
} else {
   $num_days_last = cal_days_in_month(0, ($month -1), $year);
}

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

if($offset > 0){

    $offset_correction = array_slice ($num_days_last_array, -$offset, $offset);
    $new_count = array_merge ($offset_correction, $num_days_array);
    $offset_count = count($offset_correction);
}

// The else statement is to prevent building the $offset array.
else {
$new_count = $num_days_array;
}

// count how many days we have with the two previous arrays merged together
$current_num = count($new_count);

// Since we will have 5 HTML table rows (TR) with 7 table data entries (TD) we need to fill in 35 TDs
// We will have to figure out how many days to appened to the end of the final array to make it 35 days.

if($current_num > 35){
   $num_weeks = 6;
   $outset = (42 - $current_num);
} 

elseif($current_num < 35){
   $num_weeks = 5;
   $outset = (35 - $current_num);
}

if($current_num == 35){
   $num_weeks = 5;
   $outset = 0;
}

// Outset Correction
for($i = 1; $i <= $outset; $i++){
   $new_count[] = $i;
}

// Now let's "chunk" the $new_count array into weeks. Each week has 7 days so we will array_chunk it into 7 days.
$weeks = array_chunk($new_count, 7);

// Build the next and previous month links
$previous_link = "<a href=\"index.php?page=calendar&filter=$filter&date=";
if($month == 1){
   $previous_link .= mktime(0,0,0,12,$day,($year -1));
} else {
   $previous_link .= mktime(0,0,0,($month -1),$day,$year);
}
$previous_link .= "\"><img src=\"images/arrow_left.png\" border=\"0\" title=\"Previous Month\"></a>";

$next_link = "<a href=\"index.php?page=calendar&filter=$filter&date=";
if($month == 12){
   $next_link .= mktime(0,0,0,1,$day,($year + 1));
} else {
   $next_link .= mktime(0,0,0,($month +1),
$day,$year);
}
$next_link .= "\"><img src=\"images/arrow_right.png\" border=\"0\" title=\"Next Month\"></a>";

 
// Build the heading portion of the calendar table
echo "<table class=\"calendar\">\n".
     "<tr>\n".
     "<td colspan=\"7\" class=\"header\">\n".
     "\n<table align=\"center\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" width=\"100%\">\n".
     "\n\n<tr>\n".
     "\n\n\n<td width=\"20%\" align=\"left\" class=\"none\">$previous_link</td>\n".
     "\n\n\n<td width=\"60%\" align=\"center\" class=\"text_16_bold\">$month_name $year</td>\n".
     "\n\n\n<td width=\"20%\" align=\"right\" class=\"none\">$next_link</td>\n".
     "\n\n</tr>\n".
     "\n</table>\n".
     "</td>\n".
     "<tr>\n".

// The next row indicates which day of the week each column is for.

"<td width=\"15%\" class=\"weekdays\">Sunday</td>
<td width=\"14%\" class=\"weekdays\">Monday</td>
<td width=\"14%\" class=\"weekdays\">Tuesday</td>
<td width=\"14%\" class=\"weekdays\">Wednesday</td>
<td width=\"14%\" class=\"weekdays\">Thursday</td>
<td width=\"14%\" class=\"weekdays\">Friday</td>
<td width=\"15%\" class=\"weekdays\">Saturday</td>
\n".
"</tr>\n";

// Now we break each key of the array into a week and create a new table row for each week with the days of that week in the table data
$i = 0;

foreach($weeks AS $week){

// We now know that we are inside of a week, so we'll draw the table row (<tr>) for this week and begin draw.
       echo "<tr>\n";

       foreach($week as $d) {

         if($i < $offset_count){
		     	
				mysql_select_db($database_brewing, $brewing);
				$query_calDays = "SELECT * FROM brewing";
				if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
				$calDays = mysql_query($query_calDays, $brewing) or die(mysql_error());
				$row_calDays = mysql_fetch_assoc($calDays);
				$totalRows_calDays = mysql_num_rows($calDays);
		 	 
			 $today0 = mktime(0,0,0,$month -1,$d,$year);
             $day_link = "<a href=\"index.php?page=calendar&filter=$filter&date=".$today0."\">$d</a>";
             echo "<td class=\"nonmonthdays day\">$day_link<br>";
			 echo "<table class=\"none\">";
			   do { 
			   if ($row_calDays['brewArchive'] != "Y") {
			   $str0 = $row_calDays['brewName']; $brewName0 = Truncate6($str0);
			   $MySqlDate0 = $row_calDays['brewDate']; 
			   $planned0 = GetTimeStamp($MySqlDate0);
			   $brewday0 = GetTimeStamp($MySqlDate0);
			   if ($row_calDays['brewPrimary'] > 0) $secondary0 = $brewday0 + ($row_calDays['brewPrimary'] * 86400); else $secondary0 = "0";
			   if ($secondary0 > 0) $tertiary0 = $secondary0 + ($row_calDays['brewSecondary'] * 86400); else $tertiary0 = "0";
			   if ($tertiary0 > 0) $lager0 = $tertiary0 + ($row_calDays['brewTertiary'] * 86400); else $lager0 = "0";
			   if ($lager0 > 0) $age0 = $lager0 + ($row_calDays['brewLager'] * 86400); else $age0 = "0";
			   if ($row_calDays['brewTapDate'] != "") $tap0 = GetTimeStamp($row_calDays['brewTapDate']); else { if ($age0 > 0) $tap0 = $age0 + ($row_calDays['brewAge'] * 86400); else $tap0 = "0"; }
			   if (($row_calDays['brewStatus'] == "Planned") && (($planned0 == $today0))) echo "<tr><td valign=\"top\" class=\"calInfo\">Plan: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
			   if (($row_calDays['brewStatus'] != "Planned") && (($brewday0 == $today0))) echo "<tr><td valign=\"top\" class=\"calInfo\">Brew: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
			   if (($secondary0 == $today0) && ($row_calDays['brewSecondary'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Sec: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
			   if (($tertiary0 == $today0)  && ($row_calDays['brewTertiary'] > 0))  echo "<tr><td valign=\"top\" class=\"calInfo\">Ter: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
			   if (($lager0 == $today0)  && ($row_calDays['brewLager'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Lag: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
			   if (($age0 == $today0) && ($row_calDays['brewAge'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Age: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
			   if ($tap0 == $today0) echo "<tr><td valign=\"top\" class=\"calInfo\">Tap: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName0."</a></td></tr>";
					}
				} 
			   while ($row_calDays = mysql_fetch_assoc($calDays));
			   
			   mysql_select_db($database_brewing, $brewing);
				$query_upDays = "SELECT * FROM upcoming";
				if ($filter !="all") $query_upDays .= " WHERE brewBrewerID = '$filter'";
				$upDays = mysql_query($query_upDays, $brewing) or die(mysql_error());
				$row_upDays = mysql_fetch_assoc($upDays);
				$totalRows_upDays = mysql_num_rows($upDays);
				
			   
			   do {
			   	mysql_select_db($database_brewing, $brewing);
				$query_upRecipe = sprintf("SELECT brewBrewerID FROM recipes WHERE id = '%s'", $row_upDays['upcomingRecipeID']);
				$upRecipe  = mysql_query($query_upRecipe, $brewing) or die(mysql_error());
				$row_upRecipe  = mysql_fetch_assoc($upRecipe);
				$totalRows_upRecipe  = mysql_num_rows($upRecipe);
				
			   	$MySqlDate_0 = $row_upDays['upcomingDate'];
			   	$upcoming0 = GetTimeStamp($MySqlDate_0);
				if ($todaysDate < $upcoming0) {
			   	  $str_0 = $row_upDays['upcoming']; 
			   	  $upBrewName0 = Truncate6($str_0);
			      if ($upcoming0 == $today0) { echo "<tr><td valign=\"top\" class=\"none\">Up: </td><td valign=\"top\" class=\"calInfo\">"; if ($row_upDays['upcomingRecipeID'] != "") echo "<a href=\"index.php?page=recipeDetail&filter=".$row_upRecipe['brewBrewerID']."&id=".$row_upDays['upcomingRecipeID']."\">".$upBrewName0."</a>"; else echo $upBrewName0; echo "</td></tr>"; }
			   	}
			   }
			   while ($row_upDays = mysql_fetch_assoc($upDays));
			   
			   echo "</table></td>\n";
         }

//------------------
// If the previous IF statement was not TRUE on the result, then nothing would have been drawn yet, so we are going to check and determine if the current day being looped belongs to the month being displayed. At the same time, we need to ensure that it 1.) does not belong to the previous month and 2.) does not belong to the next month. If both of these rules are passed, then the current day must fall into the current month being displayed.
//------------------

         if(($i >= $offset_count) && ($i < ($num_weeks * 7) - $outset)){

//------------------
// Alright, here's a catchy part. We will determine if the current day of the $date value (argument passed to the script, or set if no date argument is passed) is the same as the current day being looped for this cycle, if it is, we will not display a hyperlink and we will shade the day with the appropriate CSS style.
//------------------

           if($date == mktime(0,0,0,$month,$d,$year)){
		   		
				// Make a connection to DB, get necessary data
				
				mysql_select_db($database_brewing, $brewing);
				$query_calDays = "SELECT * FROM brewing";
				if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
				$calDays = mysql_query($query_calDays, $brewing) or die(mysql_error());
				$row_calDays = mysql_fetch_assoc($calDays);
				$totalRows_calDays = mysql_num_rows($calDays);
			   	

               echo "<td class=\"today day\">$d<br>";
			   $today1 = mktime(0,0,0,$month,$d,$year);
			   echo "<table class=\"none\">";
			   do { 
			   if ($row_calDays['brewArchive'] != "Y") {
			   $str1 = $row_calDays['brewName']; $brewName1 = Truncate6($str1);
			   $MySqlDate1 = $row_calDays['brewDate']; 
			   $planned1 = GetTimeStamp($MySqlDate1);
			   $brewday1 = GetTimeStamp($MySqlDate1);
			   if ($row_calDays['brewPrimary'] > 0) $secondary1 = $brewday1 + ($row_calDays['brewPrimary'] * 86400); else $secondary1 = "0";
			   if ($secondary1 > 0) $tertiary1 = $secondary1 + ($row_calDays['brewSecondary'] * 86400); else $tertiary1 = "0";
			   if ($tertiary1 > 0) $lager1 = $tertiary1 + ($row_calDays['brewTertiary'] * 86400); else $lager1 = "0";
			   if ($lager1 > 0) $age1 = $lager1 + ($row_calDays['brewLager'] * 86400); else $age1 = "0";
			   if ($row_calDays['brewTapDate'] != "") $tap1 = GetTimeStamp($row_calDays['brewTapDate']); else { if ($age1 > 0) $tap1 = $age1 + ($row_calDays['brewAge'] * 86400); else $tap1 = "0"; }
			   if (($row_calDays['brewStatus'] == "Planned") && (($planned1 == $today1))) echo "<tr><td valign=\"top\" class=\"calInfo\">Plan: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
			   if (($row_calDays['brewStatus'] != "Planned") && (($brewday1 == $today1))) echo "<tr><td valign=\"top\" class=\"calInfo\">Brew: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
			   if (($secondary1 == $today1) && ($row_calDays['brewSecondary'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Sec: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
			   if (($tertiary1 == $today1)  && ($row_calDays['brewTertiary'] > 0))  echo "<tr><td valign=\"top\" class=\"calInfo\">Ter: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
			   if (($lager1 == $today1)  && ($row_calDays['brewLager'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Lag: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
			   if (($age1 == $today1) && ($row_calDays['brewAge'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Age: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
			   if ($tap1 == $today1) echo "<tr><td valign=\"top\" class=\"calInfo\">Tap: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName1."</a></td></tr>";
					}
				} 
			   while ($row_calDays = mysql_fetch_assoc($calDays));
			   
			   mysql_select_db($database_brewing, $brewing);
				$query_upDays = "SELECT * FROM upcoming";
				if ($filter !="all") $query_upDays .= " WHERE brewBrewerID = '$filter'";
				$upDays = mysql_query($query_upDays, $brewing) or die(mysql_error());
				$row_upDays = mysql_fetch_assoc($upDays);
				$totalRows_upDays = mysql_num_rows($upDays);
				
							   
			   do {
			   	mysql_select_db($database_brewing, $brewing);
				$query_upRecipe = sprintf("SELECT brewBrewerID FROM recipes WHERE id = '%s'", $row_upDays['upcomingRecipeID']);
				$upRecipe  = mysql_query($query_upRecipe, $brewing) or die(mysql_error());
				$row_upRecipe  = mysql_fetch_assoc($upRecipe);
				$totalRows_upRecipe  = mysql_num_rows($upRecipe);
			    
			   	$MySqlDate_1 = $row_upDays['upcomingDate'];
			   	$upcoming1 = GetTimeStamp($MySqlDate_1);
				if ($todaysDate < $upcoming1) { 
			   	 $str_1 = $row_upDays['upcoming']; 
			   	 $upBrewName1 = Truncate6($str_1);
			     if ($upcoming1 == $today1) { echo "<tr><td valign=\"top\" class=\"calInfo\">Up: </td><td valign=\"top\" class=\"calInfo\">"; if ($row_upDays['upcomingRecipeID'] != "") echo "<a href=\"index.php?page=recipeDetail&filter=".$row_upRecipe['brewBrewerID']."&id=".$row_upDays['upcomingRecipeID']."\">".$upBrewName1."</a>"; else echo $upBrewName1; echo "</td></tr>"; }
			     }
			   }
			   while ($row_upDays = mysql_fetch_assoc($upDays));
			   
			   
			   
			   echo "</table></td>\n";
           } else {


				mysql_select_db($database_brewing, $brewing);
				$query_calDays = "SELECT * FROM brewing";
				if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
				$calDays = mysql_query($query_calDays, $brewing) or die(mysql_error());
				$row_calDays = mysql_fetch_assoc($calDays);
				$totalRows_calDays = mysql_num_rows($calDays);
				
			   $today2 = mktime(0,0,0,$month,$d,$year);
               echo "<td class=\"monthdays\" valign=\"top\">"."<a href=\"index.php?page=calendar&filter=$filter&date=".$today2."\">".$d."</a>";
			   echo "<table class=\"none\">";
			   do { 
			   if ($row_calDays['brewArchive'] != "Y") {
			   $str2 = $row_calDays['brewName']; $brewName2 = Truncate6($str2);
			   $MySqlDate2 = $row_calDays['brewDate']; 
			   $planned2 = GetTimeStamp($MySqlDate2);
			   $brewday2 = GetTimeStamp($MySqlDate2);
			   if ($row_calDays['brewPrimary'] > 0) $secondary2 = $brewday2 + ($row_calDays['brewPrimary'] * 86400); else $secondary2 = "0";
			   if ($secondary2 > 0) $tertiary2 = $secondary2 + ($row_calDays['brewSecondary'] * 86400); else $tertiary2 = "0";
			   if ($tertiary2 > 0) $lager2 = $tertiary2 + ($row_calDays['brewTertiary'] * 86400); else $lager2 = "0";
			   if ($lager2 > 0) $age2 = $lager2 + ($row_calDays['brewLager'] * 86400); else $age2 = "0";
			   if ($row_calDays['brewTapDate'] != "") $tap2 = GetTimeStamp($row_calDays['brewTapDate']); else { if ($age2 > 0) $tap2 = $age2 + ($row_calDays['brewAge'] * 86400); else $tap2 = "0"; }
			   if (($row_calDays['brewStatus'] == "Planned") && (($planned2 == $today2))) echo "<tr><td valign=\"top\" class=\"calInfo\">Plan: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   if (($row_calDays['brewStatus'] != "Planned") && (($brewday2 == $today2))) echo "<tr><td valign=\"top\" class=\"calInfo\">Brew: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   if (($secondary2 == $today2) && ($row_calDays['brewSecondary'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Sec: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   if (($tertiary2 == $today2)  && ($row_calDays['brewTertiary'] > 0))  echo "<tr><td valign=\"top\" class=\"calInfo\">Ter: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   if (($lager2 == $today2)  && ($row_calDays['brewLager'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Lag: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   if (($age2 == $today2) && ($row_calDays['brewAge'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Age: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   if ($tap2 == $today2) echo "<tr><td valign=\"top\" class=\"calInfo\">Tap: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName2."</a></td></tr>";
			   	}
			   } 
			   while ($row_calDays = mysql_fetch_assoc($calDays));
			   
			  	mysql_select_db($database_brewing, $brewing);
				$query_upDays = "SELECT * FROM upcoming";
				if ($filter !="all") $query_upDays .= " WHERE brewBrewerID = '$filter'";
				$upDays = mysql_query($query_upDays, $brewing) or die(mysql_error());
				$row_upDays = mysql_fetch_assoc($upDays);
				$totalRows_upDays = mysql_num_rows($upDays);
				$recipeID2 = $row_upDays['upcomingRecipeID'];
				
			   do {
			  	mysql_select_db($database_brewing, $brewing);
				$query_upRecipe = sprintf("SELECT brewBrewerID FROM recipes WHERE id = '%s'", $row_upDays['upcomingRecipeID']);
				$upRecipe  = mysql_query($query_upRecipe, $brewing) or die(mysql_error());
				$row_upRecipe  = mysql_fetch_assoc($upRecipe);
				$totalRows_upRecipe  = mysql_num_rows($upRecipe);
			  
			   	$MySqlDate_2 = $row_upDays['upcomingDate'];
			   	$upcoming2 = GetTimeStamp($MySqlDate_2);
				
				if ($todaysDate < $upcoming2) {
			   	 $str_2 = $row_upDays['upcoming']; 
			   	 $upBrewName2 = Truncate6($str_2);
			     if ($upcoming2 == $today2) { echo "<tr><td valign=\"top\" class=\"calInfo\">Up: </td><td valign=\"top\" class=\"calInfo\">"; if ($row_upDays['upcomingRecipeID'] != "") echo "<a href=\"index.php?page=recipeDetail&filter=".$row_upRecipe['brewBrewerID']."&id=".$row_upDays['upcomingRecipeID']."\">".$upBrewName2."</a>"; else echo $upBrewName2; echo "</td></tr>"; }
			     }
			   }
			   while ($row_upDays = mysql_fetch_assoc($upDays));
			   
			   echo "</table></td>\n";
           }


        } elseif ($i >= ($num_weeks * 7) - $outset) {

				mysql_select_db($database_brewing, $brewing);
				$query_calDays = "SELECT * FROM brewing";
				if ($filter !="all") $query_calDays .= " WHERE brewBrewerID = '$filter'";
				$calDays = mysql_query($query_calDays, $brewing) or die(mysql_error());
				$row_calDays = mysql_fetch_assoc($calDays);
				$totalRows_calDays = mysql_num_rows($calDays);
				
			
			$today3 = mktime(0,0,0,$month +1,$d,$year);
            $day_link = "<a href=\"index.php?page=calendar&filter=$filter&date=".$today3."\">$d</a>";
            echo "<td class=\"nonmonthdays day\">$day_link<br>";
			echo "<table class=\"none\">";
			   do { 
			   		if ($row_calDays['brewArchive'] != "Y") {
			   $str3 = $row_calDays['brewName']; $brewName3 = Truncate6($str3);
			   $MySqlDate3 = $row_calDays['brewDate']; 
			   $planned3 = GetTimeStamp($MySqlDate3);
			   $brewday3 = GetTimeStamp($MySqlDate3);
			   if ($row_calDays['brewPrimary'] > 0) $secondary3 = $brewday3 + ($row_calDays['brewPrimary'] * 86400); else $secondary3 = "0";
			   if ($secondary3 > 0) $tertiary3 = $secondary3 + ($row_calDays['brewSecondary'] * 86400); else $tertiary3 = "0";
			   if ($tertiary3 > 0) $lager3 = $tertiary3 + ($row_calDays['brewTertiary'] * 86400); else $lager3 = "0";
			   if ($lager3 > 0) $age3 = $lager3 + ($row_calDays['brewLager'] * 86400); else $age3 = "0";
			   if ($row_calDays['brewTapDate'] != "") $tap3 = GetTimeStamp($row_calDays['brewTapDate']); else { if ($age3 > 0) $tap3 = $age3 + ($row_calDays['brewAge'] * 86400); else $tap3 = "0"; }
			   if (($row_calDays['brewStatus'] == "Planned") && (($planned3 == $today3))) echo "<tr><td valign=\"top\" class=\"calInfo\">Plan: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
			   if (($row_calDays['brewStatus'] != "Planned") && (($brewday3 == $today3))) echo "<tr><td valign=\"top\" class=\"calInfo\">Brew: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
			   if (($secondary3 == $today3) && ($row_calDays['brewSecondary'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Sec: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
			   if (($tertiary3 == $today3)  && ($row_calDays['brewTertiary'] > 0))  echo "<tr><td valign=\"top\" class=\"calInfo\">Ter: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
			   if (($lager3 == $today3)  && ($row_calDays['brewLager'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Lag: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
			   if (($age3 == $today3) && ($row_calDays['brewAge'] > 0)) echo "<tr><td valign=\"top\" class=\"calInfo\">Age: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
			   if ($tap3 == $today3) echo "<tr><td valign=\"top\" class=\"calInfo\">Tap: </td><td valign=\"top\" class=\"calInfo\"><a href=\"index.php?page=brewBlogDetail&filter=".$row_calDays['brewBrewerID']."&id=".$row_calDays['id']."\">".$brewName3."</a></td></tr>";
					}
				} 
			   while ($row_calDays = mysql_fetch_assoc($calDays));
			   
			   mysql_select_db($database_brewing, $brewing);
				$query_upDays = "SELECT * FROM upcoming";
				if ($filter !="all") $query_upDays .= " WHERE brewBrewerID = '$filter'";
				$upDays = mysql_query($query_upDays, $brewing) or die(mysql_error());
				$row_upDays = mysql_fetch_assoc($upDays);
				$totalRows_upDays = mysql_num_rows($upDays);
				
				
			   
			   do {
			   	mysql_select_db($database_brewing, $brewing);
				$query_upRecipe = sprintf("SELECT brewBrewerID FROM recipes WHERE id = '%s'", $row_upDays['upcomingRecipeID']);
				$upRecipe  = mysql_query($query_upRecipe, $brewing) or die(mysql_error());
				$row_upRecipe  = mysql_fetch_assoc($upRecipe);
				$totalRows_upRecipe  = mysql_num_rows($upRecipe);
			   
			   	$MySqlDate_3 = $row_upDays['upcomingDate'];
			   	$upcoming3 = GetTimeStamp($MySqlDate_3);
			   	if ($todaysDate < $upcoming3) {
				 $str_3 = $row_upDays['upcoming']; 
			   	 $upBrewName3 = Truncate6($str_3);
			     if ($upcoming3 == $today3) { echo "<tr><td valign=\"top\" class=\"calInfo\">Up: </td><td valign=\"top\" class=\"calInfo\">"; if ($row_upDays['upcomingRecipeID'] != "") echo "<a href=\"index.php?page=recipeDetail&filter=".$row_upRecipe['brewBrewerID']."&id=".$row_upDays['upcomingRecipeID']."\">".$upBrewName3."</a>"; else echo $upBrewName3; echo "</td></tr>"; }
			     }
			   }
			   while ($row_upDays = mysql_fetch_assoc($upDays));
			   
			   echo "</table></td>\n";
        }

//Remember that good ol' $i value? Well, it's time to increment it by 1 for the next day in our loop so that the all of the IF statements we coded will work properly.
  $i++;

//Close out the for loop for $week AS $d.

      }

//Close out the table row for this current week.

      echo "</tr>\n";   
}

// Now close out your calendar table, PHP and your HTML tags and you're all done!

// Close out your table and that's it!
echo "<tr><td colspan=\"7\" class=\"header\" align=\"center\">"; 
if (isset($_REQUEST['date'])) echo "<a href=\"index.php?page=calendar\">Reset to Today</a>"; else echo "&nbsp;"; 
echo "</td></tr>";
?>

</table>