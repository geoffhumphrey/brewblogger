<?php

$brewColor = ($page == "recipe-list") ? $row_log['brewLovibond'] : $row_log['brewLovibond'];
$color        = $row_log['brewLovibond'];
$colorFormula = ($row_log['brewColorFormula'] != "") ? $row_log['brewColorFormula'] : "formula unknown";


if ($_SESSION['measColor'] == "EBC") {
  $srm = ebc_to_srm($color);
} else {
  $srm = ltrim($color, "0");
}

$bkColor   = get_display_color($srm);
$fontColor = ($srm > "15") ? "#ffffff" : "#000000";

echo '<table>' . "\n";
echo '<tr>' . "\n";
echo '<td class="colorTable" style="background: ' . $bkColor . '; color: ' . $fontColor . '; padding: 0 3px 0 3px">';
echo '&nbsp;&nbsp;' . round($color, 1) . '&nbsp;&nbsp;</td>' . "\n";
if ($page != "recipe-list" && $page != "brewblog-list")
  echo '<td>&nbsp;(' . $colorFormula . ')</td>' . "\n";
echo '</tr>' . "\n";
echo '</table>' . "\n";

?>