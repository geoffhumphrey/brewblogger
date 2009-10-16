<?php 
if ($row_pref['measColor'] == "EBC") $SRM = colorconvert($row_featured['brewLovibond'], "SRM"); else $SRM = ltrim($row_featured['brewLovibond'], "0"); //echo $SRM;
if ($SRM > "15") $fcolor = "#ffffff";
if ($SRM < "15") $fcolor = "#000000";
if ($row_pref['measColor'] == "SRM") { echo "<table class=\"colorTable\"><tr><td style=\"background: ".$beercolor_featured."; color: ".$fcolor."; padding: 0 3px 0 3px\">"; echo round ($row_featured['brewLovibond'], 1)."/"; echo colorconvert($row_featured['brewLovibond'], "EBC"); echo "</td></table>"; }
if ($row_pref['measColor'] == "EBC") { echo "<table class=\"colorTable\"><tr><td style=\"background: ".$beercolor_featured."; color: ".$fcolor."; padding: 0 3px 0 3px\">"; echo round ($row_featured['brewLovibond'], 1)."/"; echo colorconvert($row_featured['brewLovibond'], "SRM"); echo "</td></table>"; }
?>