<?php
if ($page != "recipeList") { 
	if ($row_pref['measColor'] == "EBC") $SRM = colorconvert($row_log['brewLovibond'], "SRM"); else $SRM = ltrim($row_log['brewLovibond'], "0"); //echo $SRM;
	if ($SRM > "15") $fcolor = "#ffffff";
	if ($SRM < "15") $fcolor = "#000000";
	if ($row_pref['measColor'] == "SRM") { echo "<table class=\"colorTable\"><tr><td style=\"background: ".$beercolor."; color: ".$fcolor."; padding: 0 3px 0 3px\">"; echo round ($row_log['brewLovibond'], 1)."/"; echo colorconvert($row_log['brewLovibond'], "EBC"); echo "</td></table>"; }
	if ($row_pref['measColor'] == "EBC") { echo "<table class=\"colorTable\"><tr><td style=\"background: ".$beercolor."; color: ".$fcolor."; padding: 0 3px 0 3px\">"; echo round ($row_log['brewLovibond'], 1)."/"; echo colorconvert($row_log['brewLovibond'], "SRM"); echo "</td></table>"; }
}

if ($page == "recipeList") {
	if ($row_pref['measColor'] == "EBC") $SRM = colorconvert($row_recipeList['brewLovibond'], "SRM"); else $SRM = ltrim($row_recipeList['brewLovibond'], "0"); //echo $SRM;
	if ($SRM > "15") $fcolor = "#ffffff";
	if ($SRM < "15") $fcolor = "#000000";
	if ($row_pref['measColor'] == "SRM") { echo "<table class=\"colorTable\"><tr><td style=\"background: ".$beercolor."; color: ".$fcolor."; padding: 0 3px 0 3px\">"; echo round ($row_recipeList['brewLovibond'], 1)."/"; echo colorconvert($row_recipeList['brewLovibond'], "EBC"); echo "</td></table>"; }
	if ($row_pref['measColor'] == "EBC") { echo "<table class=\"colorTable\"><tr><td style=\"background: ".$beercolor."; color: ".$fcolor."; padding: 0 3px 0 3px\">"; echo round ($row_recipeList['brewLovibond'], 1)."/"; echo colorconvert($row_recipeList['brewLovibond'], "SRM"); echo "</td></table>"; }
}
?>