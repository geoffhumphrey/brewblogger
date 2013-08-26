<?php 
if ($row_pref['measColor'] == "EBC") {
  $srm = ebc_to_srm($row_featured['brewLovibond']);
} else {
  $srm = ltrim($row_featured['brewLovibond'], "0");
}

$bkColor   = get_display_color($srm);
$fontColor = ($srm > "15") ? "#ffffff" : "#000000";

echo '<table class="colorTable"><tr><td style="background: ' . $bkColor . '; color: ' . $fontColor . '; padding: 0 3px 0 3px">';
echo round($row_featured['brewLovibond'], 1);
echo '</td></table>';

?>