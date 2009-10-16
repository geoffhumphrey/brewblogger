<div id="referenceHeader"><?php if ($row_grains['maltName'] != "") echo $row_grains['maltName']; else echo "No Information Available" ?></div>
<table <?php if ($source =="reference") echo "style=\"margin-bottom: 10px;\"";?>>
<?php if ($row_grains['maltName'] != "") { ?>
<?php if ($row_grains['maltLovibond'] != "") { ?>
  <tr>
 	<td class="dataLabelLeft">Color (L):</td>
    <td class="data"><?php echo $row_grains['maltLovibond']; ?>&nbsp;&deg;L</td>
  </tr>
<?php } ?>
<?php if ($row_grains['maltLovibond'] == "") { ?>
  <tr>
    <td class="dataLabelLeft">Color (L):</td>
    <td class="data">Not provided.</td>
  </tr>
<?php } ?>
<?php if ($row_grains['maltInfo'] != "") { ?>
  <tr align="left" valign="top">
    <td class="dataLabelLeft">Info/Use:</td>
    <td class="data"><?php echo $row_grains['maltInfo']; ?></td>
  </tr>
<?php } ?>
<?php if ($row_grains['maltInfo'] == "") { ?>
  <tr>
    <td class="dataLabelLeft">Info/Use:</td>
    <td class="data">Not provided.</td>
  </tr>
<?php } ?>
<?php } else { ?>
  <tr>
    <td colspan="2">There is no data available for this grain.</td>
  </tr>
<?php } ?>
</table>