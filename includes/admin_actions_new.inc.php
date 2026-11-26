<?php
$actions_links = "";
$export_destination = "";
$export_destination_url = "";

if (($page == "recipe-list") || ($page == "recipe") || (($page == "admin") && ($section == "recipes") && ($action == "manage"))) {
    $dbTable = "recipes";
    $section = "recipes";
    $export_destination = "BrewBlog";
    $export_destination_url = "importBrewBlog";
}

if (($page == "brewblog-list") || ($page == "brewblog") || (($page == "admin") && ($section == "brewblogs") && ($action == "manage"))) {
    $dbTable = "brewblogs";
    $section = "brewblogs";
    $export_destination = "Recipe";
    $export_destination_url = "importRecipe";
}

// build_public_url($page, $section, $action, $dbTable, $filter, $id, $base_url)

// Edit
if (SEF) $edit_href = build_public_url("admin", "brewblogs", "edit", $dbTable, $filter, $row_log['id'], $base_url);
else $edit_href = $base_url."index.php?page=admin&amp;section=brewblogs&action=edit&amp;dbTable=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_edit = "<a class=\"me-1\" href=\"".$edit_href."\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Edit ".h($row_log['brewName'])."\"><span class=\"fa fa-pencil\"></span></a>";

// Edit Essentials
if (SEF) $edit_essentials_href = build_public_url("admin", "brewblogs", "edit", $dbTable, "essentials", $row_log['id'], $base_url);
else $edit_essentials_href = $base_url."index.php?page=admin&amp;section=brewblogs&action=edit&amp;dbTable=".$dbTable."&amp;filter=essentials&amp;id=".$row_log['id'];
// if ($confirm == "new") $edit_essentials_href .= "&amp;confirm=new";
$actions_links_edit_essentials = "<a class=\"me-1\" href=\"".$edit_essentials_href."\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Edit ".h($row_log['brewName'])." - Essential Info Only\"><span class=\"fa fa-edit\"></span></a>";

// Export to BeerXML
if ($source == "recipe") $export_beerXML = $base_url."includes/output_beer_xml.inc.php?id=".$row_log['id']."&source=".$source."&brewStyle=".urlencode($style);
else $export_beerXML = $base_url."includes/output_beer_xml_new.inc.php?id=".$row_log['id'];
$actions_links_export_beerXML = "<a class=\"me-1\" href=\"".$export_beerXML."\" role=\"button\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Download ".h($row_log['brewName'])." in BeerXML format\"><span class=\"fa fa-file-code-o\"></span></a>";

// Add awards
if (SEF) $awards_href = build_public_url("admin", "awards", "add", "awards", $filter, $row_log['id'], $base_url);
else $awards_href = $base_url."index.php?page=admin&amp;section=awards&amp;action=add&amp;dbTable=awards&amp;id=".$row_log['id'];
$actions_links_awards = "<a class=\"me-1\" href=\"".$awards_href."\" role=\"button\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Add awards for ".h($row_log['brewName'])."\"><span class=\"fa fa-trophy\"></span></a>";

// Delete
$actions_links_delete = "<a class=\"me-1\" href=\"".$base_url."includes/process_new.inc.php?action=delete&dbTable=brewblogs&id=".$row_log['id']."\" role=\"button\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Delete ".h($row_log['brewName'])."\" data-confirm=\"Are you sure you want to delete ".h($row_log['brewName'])."?\"><span class=\"fa fa-trash-o\"></span></a>";

/*
// Duplicate
// if (SEF) $duplicate_href = build_public_url("admin", $section, "reuse", $dbTable, $filter, $row_log['id'], $base_url);
// else
$duplicate_href = $base_url."admin/index.php?action=reuse&amp;dbTable=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_duplicate = "<a href=\"".$duplicate_href."\" role=\"button\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Duplicate ".$row_log['brewName']."\"><span class=\"fa fa-clone\" title=\"Duplicate ".$row_log['brewName']."\"></span></a>";

// Recalculate
// if (SEF) $recalculate_href = build_public_url("admin", $section, "recalculate", $dbTable, $filter, $row_log['id'], $base_url);
// else
$recalculate_href = $base_url."admin/index.php?action=recalculate&amp;source=".$dbTable."&amp;results=false&amp;id=".$row_log['id'];
$actions_links_recalculate = "<a href=\"".$recalculate_href."\" role=\"button\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Recalculate ".$row_log['brewName']."\"><span class=\"fa fa-calculator\"></span></a>";

// Export
// if (SEF) $export_href = build_public_url("admin", $section, $export_destination_url, $dbTable, $filter, $row_log['id'], $base_url);
// else
$export_href = $base_url."admin/index.php?action=".$export_destination_url."&amp;dbTable=".$dbTable."&amp;id=".$row_log['id'];
$actions_links_export_recipes = "<a href=\"".$export_href."\" role=\"button\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Export ".$row_log['brewName']." as a ".$export_destination."\"><span class=\"fa fa-exchange\" ></span></a>";

*/

// Print
$actions_links_print = "<a class=\"me-1\" href=\"javascript:window.print()\" role=\"button\"><span class=\"fa fa-print\"></span></a>";
$actions_links .= $actions_links_edit;
$actions_links .= $actions_links_edit_essentials;
$actions_links .= $actions_links_awards;
$actions_links .= $actions_links_delete;

/*
$actions_links .= $actions_links_duplicate;
$actions_links .= $actions_links_print;
$actions_links .= $actions_links_recalculate;
$actions_links .= $actions_links_export_recipes;
*/
?>