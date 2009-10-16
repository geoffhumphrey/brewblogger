<?php
mysql_select_db($database_brewing, $brewing);
$query_theme = "SELECT * FROM brewingcss ORDER BY id ASC";
$theme = mysql_query($query_theme, $brewing) or die(mysql_error());
$row_theme = mysql_fetch_assoc($theme);
$totalRows_theme = mysql_num_rows($theme);
?>
