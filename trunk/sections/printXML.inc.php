<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { 
if ($printBrowser == "IE") { 
?>
<a href="includes/output_beer_xml.inc.php?id=<?php echo $row_log['id']; ?>&source=brewLog&brewStyle=<?php echo $row_log['brewStyle']; ?>"><img src="<?php echo $imageSrc. $row_colorChoose['themeName']; ?>/button_beer_xml_<?php echo $row_colorChoose['themeName']; ?>.png"  border="0" alt="Output to Beer XML"></a>
<?php } else { ?>
<a href="#" onclick="window.open('includes/output_beer_xml.inc.php?id=<?php echo $row_log['id']; ?>&source=brewLog&brewStyle=<?php echo $row_log['brewStyle']; ?>','','height=5,width=5, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc. $row_colorChoose['themeName']; ?>/button_beer_xml_<?php echo $row_colorChoose['themeName']; ?>.png"  border="0" alt="Output to Beer XML"></a>
<?php } 
} ?>
<?php if ($page == "recipeDetail") { 
if ($printBrowser == "IE") { ?>
<a href="includes/output_beer_xml.inc.php?id=<?php echo $row_log['id']; ?>&source=recipe&brewStyle=<?php echo $row_log['brewStyle']; ?>"><img src="<?php echo $imageSrc. $row_colorChoose['themeName']; ?>/button_beer_xml_<?php echo $row_colorChoose['themeName']; ?>.png"  border="0" alt="Output to Beer XML"></a>
<?php } else { ?>
<a href="#" onclick="window.open('includes/output_beer_xml.inc.php?id=<?php echo $row_log['id']; ?>&source=recipe&brewStyle=<?php echo $row_log['brewStyle']; ?>','','height=5,width=5, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc. $row_colorChoose['themeName']; ?>/button_beer_xml_<?php echo $row_colorChoose['themeName']; ?>.png"  border="0" alt="Output to Beer XML"></a>
<?php } 
} ?>

