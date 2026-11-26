<?php
$hops = "";
$fermentables = "";
$yeasts = "";
$non_fermentables = "";
$water = "";
$equipment = "";
$mash = "";
$style = "";
$primary = "";
$secondary = "";
$tertiary = "";
$age = "";
$tap_locations = "";

$fermentation_aging = FALSE;

if ((isset($row_log['brewHops'])) && (!empty($row_log['brewHops']))) $hops = json_decode($row_log['brewHops'],true);
if ((isset($row_log['brewFermentables'])) && (!empty($row_log['brewFermentables']))) $fermentables = json_decode($row_log['brewFermentables'],true);
if ((isset($row_log['brewYeasts'])) && (!empty($row_log['brewYeasts']))) $yeasts = json_decode($row_log['brewYeasts'],true);
if ((isset($row_log['brewMiscs'])) && (!empty($row_log['brewMiscs']))) $non_fermentables = json_decode($row_log['brewMiscs'],true);
if ((isset($row_log['brewWater'])) && (!empty($row_log['brewWater']))) $water = json_decode($row_log['brewWater'],true);
if ((isset($row_log['brewEquipment'])) && (!empty($row_log['brewEquipment']))) $equipment = json_decode($row_log['brewEquipment'],true);
if ((isset($row_log['brewMash'])) && (!empty($row_log['brewMash']))) $mash = json_decode($row_log['brewMash'],true);
if ((isset($row_log['brewStyle'])) && (!empty($row_log['brewStyle']))) $style = json_decode($row_log['brewStyle'],true);
if ((isset($row_log['brewTapLocation'])) && (!empty($row_log['brewTapLocation']))) $tap_locations = json_decode($row_log['brewTapLocation'],true);

if ((isset($row_log['brewPrimary'])) && (!empty($row_log['brewPrimary']))) {
	$primary = json_decode($row_log['brewPrimary'],true);
	$fermentation_aging = TRUE;
}

if ((isset($row_log['brewSecondary'])) && (!empty($row_log['brewSecondary']))) {
	$secondary = json_decode($row_log['brewSecondary'],true);
	$fermentation_aging = TRUE;
}

if ((isset($row_log['brewTertiary'])) && (!empty($row_log['brewTertiary']))) {
	$tertiary = json_decode($row_log['brewTertiary'],true);
	$fermentation_aging = TRUE;
}

if ((isset($row_log['brewAge'])) && (!empty($row_log['brewAge']))) {
	$age = json_decode($row_log['brewAge'],true);
	$fermentation_aging = TRUE;
}
?>