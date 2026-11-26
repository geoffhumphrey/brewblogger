<?php

/*
// ------------------------------- Styles -------------------------------
if ($section == "styles") {
    $query_styles = "SELECT * FROM styles";
    if ($filter == "bjcp2015") $query_styles .= " WHERE brewStyleVersion='BJCP2015'";
    if ($filter == "bjcp2008") $query_styles .= " WHERE brewStyleVersion='BJCP2008'";
    $styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
    $row_styles = mysqli_fetch_assoc($styles);
    $totalRows_styles = mysqli_num_rows($styles);
}

// ------------------------------- Hops -------------------------------
if ($section == "hops") {
    $query_styles = "SELECT * FROM hops";
    $styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
    $row_styles = mysqli_fetch_assoc($styles);
    $totalRows_styles = mysqli_num_rows($styles);
}

// ------------------------------- Grains -------------------------------
if ($section == "grains") {
    $query_grains = "SELECT * FROM malt";
    $grains = mysqli_query($connection,$query_grains) or die (mysqli_error($connection));
    $row_grains = mysqli_fetch_assoc($grains);
    $totalRows_grains = mysqli_num_rows($grains);
}

// ------------------------------- Yeast -------------------------------
if ($section == "yeast") {
    $query_yeast = "SELECT * FROM yeast_profiles";
    $yeast = mysqli_query($connection,$query_yeast) or die (mysqli_error($connection));
    $row_yeast = mysqli_fetch_assoc($yeast);
    $totalRows_yeast = mysqli_num_rows($yeast);
}
*/

?>
<?php
if ($section == "carbonation") include (REFERENCE.'carbonation.inc.php');
if ($section == "color") include (REFERENCE.'color.inc.php');
/*
if (($section == "styles") || ($section == "default")) include (REFERENCE.'styles.inc.php');
if ($section == "hops") include (REFERENCE.'hops.inc.php');
if ($section == "grains") include (REFERENCE.'grains.inc.php');
if ($section == "yeast") include (REFERENCE.'yeast.inc.php');
*/
?>
