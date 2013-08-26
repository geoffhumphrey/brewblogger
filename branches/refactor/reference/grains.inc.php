<?php
/**
 * Module: grains.inc.php
 * Description: This module displays info about grains in the db when the user has selected
 *              "Malt and Grains" in the Reference menu.
 */
?>

<div id="referenceHeader"><?php if ($row_grains['maltName'] != "") echo $row_grains['maltName']; else echo "No Information Available" ?></div>

<table <?php if ($source =="reference") echo "style=\"margin-bottom: 10px;\"";?>>
<?php
if ($row_grains['maltName'] != "") {
  echo '<tr>' . "\n";
  echo '<td class="dataLabelLeft">Color:</td>' . "\n";
  echo '<td class="data">' . $row_grains['maltLovibondLow'] . '&deg; - ';
  if ($row_grains['maltLovibondHigh'] > 0) {
    echo $row_grains['maltLovibondHigh'] . '&deg;';
  } else {
    echo $row_grains['maltLovibondLow'] . '&deg;';
  }
  echo ' L</td>' . "\n";
  echo '</tr>' . "\n";

  echo '<tr align="left" valign="top">' . "\n";
  echo '<td class="dataLabelLeft">Info/Use:</td>' . "\n";
  if ($row_grains['maltInfo'] != "") {
    echo '<td class="data">' . $row_grains['maltInfo'] . '</td>' . "\n";
  } else {
    echo '<td class="data">Not provided.</td>' . "\n";
  }
  echo '</tr>' . "\n";

} else {
  echo '<tr>' . "\n";
  echo '<td colspan="2">There is no data available for this grain.</td>' . "\n";
  echo '</tr>' . "\n";
}
?>
</table>