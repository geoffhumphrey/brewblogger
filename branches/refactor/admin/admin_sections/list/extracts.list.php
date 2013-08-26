<?PHP
/**
 * Module: extracts.list.php
 * Description: Display all extracts in the database. Provide the opportunity to add or edit extracts to
 * users with authority.
 */

echo '<div id="subtitleAdmin">' . $page_title . '</div>' . "\n";
include (ADMIN_INCLUDES.'list_add_link.inc.php');

if ($confirm == "true") {
  echo '<table class="dataTable">' . "\n";
  echo '<tr>' . "\n";
  echo '<td class="error">' . "\n";
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
    <td class="dataHeadingList">PPG</td>
    <td class="dataHeadingList">Form</td>
    <td class="dataHeadingList">Information</td>
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
    echo '<td class="dataList">' . $row_extracts['extractName'] . '</td>' . "\n";
    $lovHigh = $row_extracts['extractLovibondHigh'] > 0 ? $row_extracts['extractLovibondHigh'] : $row_extracts['extractLovibondLow'];
    echo '<td class="dataList">' . $row_extracts['extractLovibondLow'] . '&deg; - ' . $lovHigh . '&deg; L</td>' . "\n";
    echo '<td class="dataList">' . $row_extracts['extractPPG'] . '</td>' . "\n";
    $form = $row_extracts['extractLME'] ? "Liquid" : "Dry";
    echo '<td class="dataList">' . $form . '</td>' . "\n";
    echo '<td class="dataList">' . truncate_string($row_extracts['extractInfo'],50,'...') . '</td>' . "\n";
    echo '<td class="dataList">' . $row_extracts['extractSupplier'] . '</td>' . "\n";
    echo '<td class="dataList">' . $row_extracts['extractOrigin'] . '</td>' . "\n";
    echo '<td class="data-icon_list"><a href="index.php?action=edit&dbTable=extract&id=' . $row_extracts['id'] . '"><img src="' . $imageSrc . 'pencil.png" align="absmiddle" border="0" alt="Edit ' . $row_extracts['extractName'] . '" title="Edit ' . $row_extracts['extractName'] . '"></a></td>' . "\n";
    if  ($row_user['userLevel'] == "1") { ?>
      <td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=extract','id',<?php echo $row_extracts['id']; ?>,'Are you sure you want to delete this extract?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_grains['extractName']; ?>" title="Delete <?php echo $row_grains['extractName']; ?>"></a></td>
    <?php } ?>
    </tr>
    <?php 
    if ($color == $color1) {
      $color = $color2;
    } else {
      $color = $color1;
    }
  } while ($row_extracts = mysql_fetch_assoc($extracts)); ?>
</table>