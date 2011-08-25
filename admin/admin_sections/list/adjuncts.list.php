<?php 
/**
 * Module: adjuncts.list.php
 * Description: Display a list of all adjuncts in the database. Provide the opportunity to add or edit
 * adjuncts to users with authority.
 */

echo '<div id="subtitleAdmin">' . $page_title . '</div>' . "\n";
include (ADMIN_INCLUDES.'list_add_link.inc.php');

if ($confirm == "true") {
  echo '<table class="dataTable">' . "\n";
  echo '<tr>' . "\n";
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
    <td class="dataHeadingList">Name</td>
    <td class="dataHeadingList">Color (Low - High)</td>
    <td class="dataHeadingList">Information</td>
    <td class="dataHeadingList">PPG</td>
    <td class="dataHeadingList">Supplier</td>
    <td class="dataHeadingList">Origin</td>
    <td class="dataHeadingList">&nbsp;</td>
    <?php if  ($row_user['userLevel'] == "1") { ?>
      <td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
    <?php } ?>
  </tr>
  <?php 
  do { 
    echo '<tr style="background-color:' . $color . '">' . "\n";
    echo '<td class="dataList">' . $row_adjuncts['adjunctName'] . '</td>' . "\n";
    $lovHigh = $row_adjuncts['adjunctLovibondHigh'] > 0 ? $row_adjuncts['adjunctLovibondHigh'] : $row_adjuncts['adjunctLovibondLow'];
    echo '<td class="dataList">' . $row_adjuncts['adjunctLovibondLow'] . '&deg; - ' . $lovHigh. '&deg; L</td>' . "\n";
    echo '<td class="dataList">' . Truncate3($row_adjuncts['adjunctInfo']) . '</td>' . "\n";
    echo '<td class="dataList">' . $row_adjuncts['adjunctPPG'] . '</td>' . "\n";
    echo '<td class="dataList">' . $row_adjuncts['adjunctSupplier'] . '</td>' . "\n";
    echo '<td class="dataList">' . $row_adjuncts['adjunctOrigin'] . '</td>' . "\n";
    echo '<td class="data_icon_list"><a href="index.php?action=edit&dbTable=adjuncts&id=' . $row_adjuncts['id'] . '"><img src="' . $imageSrc . 'pencil.png" align="absmiddle" border="0" alt="Edit ' . $row_adjuncts['adjunctName'] . '" title="Edit ' . $row_adjuncts['adjunctName'] . '"></a></td>' . "\n";
    if ($row_user['userLevel'] == "1") { ?>
      <td class="data_icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=adjuncts','id',<?php echo $row_adjuncts['id']; ?>,'Are you sure you want to delete this adjunct?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_grains['extractName']; ?>" title="Delete <?php echo $row_grains['extractName']; ?>"></a></td>
    <?php }
    echo '</tr>' . "\n";
    if ($color == $color1) {
      $color = $color2;
    } else { 
      $color = $color1;
    }
  } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); ?>
</table>