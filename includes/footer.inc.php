<?php

$footer = "Content &copy; ".date ('Y')." ".$row_name['brewerFirstName']." ".$row_name['brewerLastName']." &mdash; BrewBlogger ".$version.$version_extend;

if (((TESTING) || (DEBUG)) && (isset($starttime))) {
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
    $endtime = $mtime;
    $totaltime = ($endtime - $starttime);
    $footer .= " &mdash; Page Created: ".number_format($totaltime, 3)."s";
}

echo $footer;
?>
