<?php if ($printBrowser == "IE") { ?>
<a href="#" onClick="window.open(SECTIONS.'print.inc.php?page=logPrint&source=log&dbTable=brewing&brewStyle=<?php echo $row_log['brewStyle'];  if ($action == "scale") echo "&action=scale&amt=".$amt; ?>&id=<?php echo $row_log['id']; ?>','','height=600,width=800,toolbar=no,resizable=yes,scrollbars=yes'); return false;" title="Print <?php echo $row_log['brewName']; ?>"><img src="<?php echo $imageSrc. $row_colorChoose['themeName']; ?>/button_print_log_<?php echo $row_colorChoose['themeName']; ?>.png"  border="0" alt="Print Log"></a>
<?php } else { ?>
<a href="print.php?page=logPrint&source=log&dbTable=brewing&brewStyle=<?php echo $row_log['brewStyle'];  if ($action == "scale") echo "&action=scale&amt=".$amt; ?>&id=<?php echo $row_log['id']; ?>&KeepThis=true&TB_iframe=true&height=450&width=700" title="Print <?php echo $row_log['brewName']; ?>" class="thickbox"><img src="<?php echo $imageSrc. $row_colorChoose['themeName']; ?>/button_print_log_<?php echo $row_colorChoose['themeName']; ?>.png"  border="0" alt="Print Log"></a>
<?php } ?>