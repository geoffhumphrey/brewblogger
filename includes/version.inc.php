<?php
$version = "3.0.0";
$version_extend = " (<a href=\"https://github.com/geoffhumphrey/brewblogger/commits/master\" target=\"_blank\">Pre-release Build 2</a>)";
if ($row_pref['mode'] == "1") $version_extend .= " Personal Edition";
if ($row_pref['mode'] == "2") $version_extend .= " Club Edition";
?>

