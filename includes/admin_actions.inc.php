<?php
$actions_links = "";

if (($page == "recipe-list") || ($page == "recipe") || (($page == "admin") && ($section == "recipes") && ($action == "manage"))) {
    $dbTable = "recipes";
    $section = "recipes";
    $export_destination = "BrewBlog";
    $export_destination_url = "importBrewBlog";
}

if (($page == "brewblog-list") || ($page == "brewblog") || (($page == "admin") && ($section == "brewblogs") && ($action == "manage"))) {
    $dbTable = "brewing";
    $section = "brewblogs";
    $export_destination = "Recipe";
    $export_destination_url = "importRecipe";
}

// build_public_url($page, $section, $action, $dbTable, $filter, $id, $base_url)

// Edit
// if (SEF) $edit_href = build_public_url("admin", $section, "edit", $dbTable, $filter, $row_log['id'], $base_url);
// else
$edit_href = $base_url."admin/index.php?action=edit&amp;dbTable=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_edit = "<a href=\"".$edit_href."\" title=\"Edit ".$row_log['brewName']."\"><span class=\"fa fa-pencil\"></span></a> ";

// Duplicate
// if (SEF) $duplicate_href = build_public_url("admin", $section, "reuse", $dbTable, $filter, $row_log['id'], $base_url);
// else
$duplicate_href = $base_url."admin/index.php?action=reuse&amp;dbTable=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_duplicate = "<a href=\"".$duplicate_href."\"><span class=\"fa fa-clone\" title=\"Duplicate ".$row_log['brewName']."\"></span></a> ";

// Recalculate
// if (SEF) $recalculate_href = build_public_url("admin", $section, "recalculate", $dbTable, $filter, $row_log['id'], $base_url);
// else
$recalculate_href = $base_url."admin/index.php?action=recalculate&amp;source=".$dbTable."&amp;results=false&amp;id=".$row_log['id'];
$actions_links_recalculate = "<a href=\"".$recalculate_href."\"><span class=\"fa fa-calculator\" title=\"Recalculate ".$row_log['brewName']."\"></span></a> ";

// Export
// if (SEF) $export_href = build_public_url("admin", $section, $export_destination_url, $dbTable, $filter, $row_log['id'], $base_url);
// else
$export_href = $base_url."admin/index.php?action=".$export_destination_url."&amp;dbTable=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_export_recipes = "<a href=\"".$export_href."\"><span class=\"fa fa-exchange\" title=\"Export ".$row_log['brewName']." as a ".$export_destination."\"></span></a> ";

// Export to BeerXML
$export_beerXML = $base_url."includes/output_beer_xml.inc.php?id=".$id."&source=".$source."&brewStyle=".$row_log['brewStyle'];
$actions_links_export_beerXML = "<a href=\"".$export_beerXML."\" title=\"Download ".$row_log['brewName']." in BeerXML format\"><span class=\"fa fa-file-code-o\"></span></a> ";

// Add awards
// if (SEF) $awards_href = build_public_url("admin", $section, "add", "awards", $dbTable, $row_log['id'], $base_url);
// else
$awards_href = $base_url."admin/index.php?action=add&amp;dbTable=awards&amp;assoc=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_awards = "<a href=\"".$awards_href."\"><span class=\"fa fa-trophy\" title=\"Add awards for ".$row_log['brewName']."\"></span></a> ";

// Delete
$actions_links_delete = "<a href=\"#\"><span class=\"fa fa-trash-o\" title=\"Delete ".$row_log['brewName']."\"></span></a> ";

// Print
// http://test.brewblogger.net/print.php?source=log&dbTable=brewing&page=logPrint&brewStyle=German%20Pils&id=353&KeepThis=true&TB_iframe=true&height=450&width=700
$actions_links_print = "<a href=\"#\"><span class=\"fa fa-print\" title=\"Print ".$row_log['brewName']."\"></span></a> ";

$actions_links = $actions_links_edit.$actions_links_duplicate.$actions_links_print.$actions_links_recalculate.$actions_links_awards.$actions_links_export_recipes.$actions_links_delete;
?>