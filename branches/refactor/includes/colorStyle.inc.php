<?php
if ($action == "calculate") {
  $colorSRMmin = $row_style1['brewStyleSRM'];
  $colorSRMmax = $row_style1['brewStyleSRMMax'];
} else {
  $colorSRMmin = $row_styles['brewStyleSRM'];
  $colorSRMmax = $row_styles['brewStyleSRMMax'];
}

$beercolorMin = get_display_color($colorSRMmin);
$beercolorMax = get_display_color($colorSRMmax);

?>