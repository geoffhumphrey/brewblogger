<?php
/**
 * Module: grains.list.php
 * Description: Display all grains in the database. Provide the opportunity to add or edit grains to
 * users with authority.
 */

echo '<div id="subtitleAdmin">' . $page_title . '</div>' . "\n";
include ('includes/list_add_link.inc.php');
if ($confirm == "true") {
  echo '<table class="dataTable">' . "\n";
  echo '<tr>'. "\n";
  echo '<td class="error">';
  if ($msg == "1") {
    echo $msg1;
  } elseif ($msg == "2") {
    echo $msg2;
  } elseif ($msg == "3") {
    echo $msg3;
  }
  echo '</td>' . "\n";
  echo '</tr>' . "\n";
  echo '</table>' . "\n";
 } ?>

<table class="dataTable">
<tr>
  <td class="dataHeadingList">Name&nbsp;<a href="index.php?action=list&dbTable=malt&sort=maltName&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=malt&sort=maltName&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
  <td class="dataHeadingList">Color (Low - High)&nbsp;<a href="index.php?action=list&dbTable=malt&sort=maltLovibondLow&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=malt&sort=maltLovibondLow&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a>&nbsp;</td>
  <td class="dataHeadingList">Information</td>
  <td class="dataHeadingList">PPG</td>
  <td class="dataHeadingList">Supplier</td>
  <td class="dataHeadingList">Origin</td>
  <td class="dataHeadingList">&nbsp;</td>
  <?php if  ($row_user['userLevel'] == "1") { ?>
  <td class="dataHeadingList" width="16" nowrap><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div></td>
  <?php } ?>
</tr>

<?php
do { 
  echo '<tr style="background-color:' . $color . '">' . "\n";
  echo '<td class="dataList" nowrap>' . $row_grains['maltName'] . '</td>' . "\n";
  $lovHigh = $row_grains['maltLovibondHigh'] > 0 ? $row_grains['maltLovibondHigh'] : $row_grains['maltLovibondLow'];
  echo '<td class="dataList" nowrap>' . $row_grains['maltLovibondLow'] . '&deg; - ' . $lovHigh . '&deg; L</td>' . "\n";
  echo '<td class="dataList">' . Truncate3($row_grains['maltInfo']) . '</td>' . "\n";
  echo '<td class="dataList">' . $row_grains['maltPPG'] . '</td>' . "\n";
  echo '<td class="dataList">' . $row_grains['maltSupplier'] . '</td>' . "\n";
  echo '<td class="dataList">' . $row_grains['maltOrigin'] . '</td>' . "\n";
  echo '<td class="data_icon_list"><a href="index.php?action=edit&dbTable=malt&id=' . $row_grains['id'] . '"><img src="' . $imageSrc . 'pencil.png" align="absmiddle" border="0" alt="Edit ' . $row_grains['maltName'] . '" title="Edit ' . $row_grains['maltName'] . '"></a></td>' . "\n";
  if ($row_user['userLevel'] == "1") { ?>
    <td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=malt','id',<?php echo $row_grains['id']; ?>,'Are you sure you want to delete this grain?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_grains['maltName']; ?>" title="Delete <?php echo $row_grains['maltName']; ?>"></a></td>
  <?php }
  echo '</tr>' . "\n";
  if ($color == $color1) {
    $color = $color2;
  } else {
    $color = $color1;
  }
} while ($row_grains = mysql_fetch_assoc($grains)); ?>
</table>