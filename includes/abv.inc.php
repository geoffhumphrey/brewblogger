<?php

// Get OG and FG from Database
if ($page == "recipeList") {
$og = $row_recipeList['brewOG']; 
$fg = $row_recipeList['brewFG'];
$og_featured = $row_featured['brewOG']; 
$fg_featured = $row_featured['brewFG'];
} 

if (($page == "brewBlogCurrent") || ($page == "brewBlogList") || ($page == "brewBlogDetail") || ($page == "logPrint") || ($page == "recipePrint") || ($page == "recipeDetail")) {
$og = $row_log['brewOG']; 
$fg = $row_log['brewFG'];
$og_featured = $row_featured['brewOG']; 
$fg_featured = $row_featured['brewFG'];
}

if (($page == "brewBlogCurrent") || ($page == "brewBlogList") || ($page == "brewBlogDetail") || ($page == "logPrint") || ($page == "recipePrint") || ($page == "recipeList") || ($page == "recipeDetail")) {
// Square OG and FG
$og2 = $og * $og;
$fg2 = $fg * $fg;

// Degrees Plato Calculation
$plato_i = (-463.37) + (668.72 * $og) - (205.35 * $og2);
$plato_f = (-463.37) + (668.72 * $fg) - (205.35 * $fg2);

// Calculate Real Extract
$real_extract = (0.1808 * $plato_i) + (0.8192 * $plato_f);

// Apparent Attenuation
$aa = (1 - ($plato_f / $plato_i)) * 100;

// Real Attenuation
$ra = (1 - ($real_extract / $plato_i)) * 100;

// Alcohol by Volume (returns percentage such as 5.2%)
$abv_calc = ($og - $fg ) / .75;
$abv_calc_featured =($og_featured - $fg_featured ) / .75;
$abv = $abv_calc * 100;
$abv_featured = $abv_calc_featured * 100;
$adj_abv = $abv +.5;

// Alcohol by Weight
$abw_calc = $abv_calc * .78;
$abw = $abw_calc * 100;

// Calories (12 ounces)
$calories = ((6.9 * $abw) + 4.0 * ($real_extract - 0.1)) * $fg * 3.55;
}
?>
