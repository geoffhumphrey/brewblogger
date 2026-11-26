<?php
/**
 * Module: process_new.php
 * Description: This module does all the heavy lifting for any DB updates; new recipes,
 *              edited blogs, new users, etc.
 */

require ('../paths.php');
require_once (CONFIG.'config.php');
require (INCLUDES.'authentication.inc.php'); 
include (INCLUDES.'url_variables.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');
include (ADMIN_INCLUDES.'constants.inc.php');
include (LIB.'common.lib.php');
require (CLASSES.'htmlpurifier/HTMLPurifier.standalone.php');
$config_html_purifier = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config_html_purifier);

$fieldData = array();

function check_http($input) {

  if (!empty($input)) {

    // Only allow http(s) URLs at the start, so e.g. "javascript:...//http://" can't slip through
    if (preg_match('~^https?://~i', $input)) return $input;
    return "http://".preg_replace('~^[a-z][a-z0-9+.-]*:/*~i', '', $input);

  }

}

// Ingredient arrays are rebuilt from the edit form, which doesn't show every stored field
// (e.g., yeast BEST_FOR/NOTES, mash step NOTES, extra fields from imported BeerXML). Start each
// existing item from its stored data so those survive a save; posted fields still overwrite,
// and defaults only fill fields the item never had. New items (no stored match) are unchanged.
function merge_stored_items($items, $stored) {

  if (!is_array($stored)) return $items;

  foreach ($items as $identifier => $item) {
    if ((!isset($stored[$identifier])) || (!is_array($stored[$identifier]))) continue;
    $merged = $stored[$identifier];
    foreach ($item as $field => $value) {
      if ((isset($_POST[$identifier."-".$field])) || (!array_key_exists($field, $merged))) $merged[$field] = $value;
    }
    $items[$identifier] = $merged;
  }

  return $items;

}


$process_allowed = FALSE;
if (isset($_SERVER['HTTP_REFERER'])) {
  $referrer = parse_url($_SERVER['HTTP_REFERER']);
  if ($referrer['host'] == $_SERVER['SERVER_NAME']) $process_allowed = TRUE;
}


if ($process_allowed && (isset($_SESSION['loginUsername']))) {

  /*
  $insertGoTo = "index.php?action=list&dbTable=brewing&id=".$id."&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
  */

  $error_output = array(); // compiled into session var at the end of the script

  // --------------------------- Deleting Anything ------------------------------------ //
  if ($action == "delete") {

    // Only these two tables are ever deletable from the live UI - $dbTable is user-controlled
    // and can't be parameterized the way a value can, so it must be whitelisted before use.
    $allowed_delete_tables = array("brewblogs", "awards");

    if (in_array($dbTable, $allowed_delete_tables, true)) {

      $db_conn->where ('id', $id);
      $result = $db_conn->delete($dbTable);
      if ($result) {
          if ($dbTable == "brewblogs") $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&msg=3";
          if ($dbTable == "awards") $updateGoTo = $base_url."index.php?page=admin&msg=3";
      }

      else {
        $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=4";
        $error_output[] = $db_conn->getLastError();
        $errors = TRUE;
      }

    } else {
      $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=4";
      $error_output[] = "Invalid table for delete.";
      $errors = TRUE;
    }

  }

  // --------------------------- If Adding/Editing an Award --------------------------- //

  if ((($action == "add") || ($action == "edit")) && ($dbTable == "awards")) {

    // Two new columns added 07/09/2024
    // ALTER TABLE `awards` ADD `awardProamName` VARCHAR(255) NULL AFTER `awardBrewName`, ADD `awardProamURL` VARCHAR(255) NULL AFTER `awardProamName`;
    
    $db_conn->where('id', $id);
    $row_log = $db_conn->getOne('brewblogs', 'brewName');

    if (!empty($_POST)) {

      if ($filter == "recipes") $append = "r"; 
      else $append = "b";

      $data = array(
        'awardBrewID' => $append.sterilize($id),
        'awardContest' => clean_text($_POST['awardContest']),
        'awardDate' => sterilize($_POST['awardDate']),
        'awardStyle' => clean_text($_POST['awardStyle']),
        'awardPlace' => sterilize($_POST['awardPlace']),
        'awardDate' => sterilize($_POST['awardDate']),
        'brewBrewerID' => sterilize($_SESSION['loginUsername']),
        'awardBrewName' => clean_text($_POST['awardBrewName']),
      );

      if (!empty($_POST['awardContestURL'])) $data['awardContestURL'] = check_http(clean_text($_POST['awardContestURL']));
      if (!empty($_POST['awardProAmName'])) $data['awardProAmName'] =  clean_text($_POST['awardProAmName']);
      if (!empty($_POST['awardProAmURL'])) $data['awardProAmURL'] = check_http(clean_text($_POST['awardProAmURL']));

      $update_table = $dbTable;
      
      if ($action == "add") $result = $db_conn->insert($update_table, $data);
      
      if ($action == "edit") {
        $db_conn->where ('id', $sid);
        $result = $db_conn->update ($update_table, $data);
      }

      if (isset($_POST['save-comp-info'])) {

        setcookie("awardContest", $data['awardContest'], 0, "/");
        setcookie("awardDate", $data['awardDate'], 0, "/");
        setcookie("awardContestURL", $data['awardContestURL'], 0, "/");

      }

      if ($result) {
          
          if (isset($_POST['add-another-award-'.$id])) {
              $updateGoTo = $base_url."page=admin&section=awards&action=add&dbTable=awards&id=".$id."&msg=1";
          }
          
          else {
              if ($_POST['relocate'] == "brewblog-list") $updateGoTo = $base_url."index.php?page=brewblog-list&msg=1";
              elseif ($_POST['relocate'] == "brewblog") $updateGoTo = $base_url."index.php?page=brewblog&filter=".$_SESSION['loginUsername']."&id=".$id."&msg=1";
              elseif ($_POST['relocate'] == "awards-list") $updateGoTo = $base_url."index.php?page=awards-list&msg=2";
              else $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&msg=1";
          }

      }

      else {
          $error_output[] = $db_conn->getLastError();
          $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=4";
      }

    }

    else {
      $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=4";
      $error_output[] = "No data in the form submission.";
    }

  }

  // --------------------------- If Editing a brewBlog ------------------------------- //

  if ((($action == "add") || ($action == "edit")) && ($dbTable == "brewblogs")) {

    if (!empty($_POST)) {

      $data = array(

        'brewName' => clean_text($_POST['brewName']),
        'brewBatchSize' => sterilize($_POST['brewYield']),
        'brewMethod' => sterilize($_POST['brewMethod']),
        'brewDate' => sterilize(strtotime($_POST['brewDate'])),
        'brewTapDate' => sterilize(strtotime($_POST['brewTapDate'])),
        'brewBatchNum' => clean_text($_POST['brewBatchNum']),
        'brewCost' => sterilize($_POST['brewCost']),
        'brewStatus' => clean_text($_POST['brewStatus']),
        'brewCondition' => clean_text($_POST['brewCondition']),
        'brewOG' => sterilize($_POST['brewOG']),
        'brewFG' => sterilize($_POST['brewFG']),
        'brewColor' => sterilize($_POST['brewColor']),
        'brewIBU' => sterilize($_POST['brewIBU']),
        'brewCarbonation' => sterilize($_POST['brewCarbonation']),
        'brewEfficiency' => sterilize($_POST['brewEfficiency']),
        'brewBoilSize' => sterilize($_POST['brewBoilSize']),
        'brewBoilTime' => sterilize($_POST['brewBoilTime']),
        'brewLabelImage' => clean_text($_POST['brewLabelImage']),
        'brewInfo' => $purifier->purify($_POST['brewNotes']),
        'brewComments' => $purifier->purify($_POST['brewComments']),
        'brewProcedure' => $purifier->purify($_POST['brewProcedure']),
        'brewSpecialProcedure' => $purifier->purify($_POST['brewSpecialProcedure']),

      );

      $original_style_id = sterilize($_POST['brewStyleID']);
      $new_style_id = sterilize($_POST['brewStyle']);
      
      if ($original_style_id != $new_style_id) {

        $vf = array();

        $db_conn->where('id', $new_style_id);
        $row_style = $db_conn->getOne('reference_styles');

        if (!empty($row_style)) {

          $vf['NAME'] = clean_text($row_style['brewStyle']);
          $vf['CATEGORY'] = clean_text($row_style['brewStyleCategory']);
          $vf['VERSION'] = "1";
          $vf['CATEGORY_NUMBER'] = sterilize($row_style['brewStyleGroup']);
          $vf['STYLE_LETTER'] = sterilize($row_style['brewStyleNum']);
          $vf['STYLE_GUIDE'] = clean_text(str_replace("BJCP","BJCP ",$row_style['brewStyleVersion']));
          $vf['TYPE'] = sterilize($row_style['brewStyleType']);
          $vf['OG_MIN'] = number_format(sterilize($row_style['brewStyleOG']), 3);
          $vf['OG_MAX'] = number_format(sterilize($row_style['brewStyleOGMax']), 3);
          $vf['FG_MIN'] = number_format(sterilize($row_style['brewStyleFG']), 3);
          $vf['FG_MAX'] = number_format(sterilize($row_style['brewStyleFGMax']), 3);
          $vf['IBU_MIN'] = sterilize($row_style['brewStyleIBU']);
          $vf['IBU_MAX'] = sterilize($row_style['brewStyleIBUMax']);
          $vf['COLOR_MIN'] = sterilize($row_style['brewStyleSRM']);
          $vf['COLOR_MAX'] = sterilize($row_style['brewStyleSRMMax']);

        }

          $data['brewStyle'] = json_encode($vf);

      }

      // Tap Locations - processed unconditionally (not gated behind $filter == "all")
      // because the Tap Location fields render whenever brewStatus is editable, which
      // includes the "essentials" screen, not just the full "all" edit screen. Keyed by
      // the user-entered location name (not the synthetic "taplocation0" identifier,
      // which is only used for the HTML field-group prefix).
      $brewTapLocation = array();
      $taplocation_numbers = array();

      foreach ($_POST as $key => $value) {
        if (substr($key, 0, strlen("taplocation")) === "taplocation") {
          if (strpos($key, "-") === false) $taplocation_numbers[] = $value;
        }
      }

      foreach ($taplocation_numbers as $v) {
        $identifier = "taplocation".$v;
        if (isset($_POST[$identifier."-LOCATION"]) && (trim($_POST[$identifier."-LOCATION"]) !== "")) {
          $location_key = clean_text($_POST[$identifier."-LOCATION"]);
          $brewTapLocation[$location_key]['TAP_NUMBER'] = isset($_POST[$identifier."-TAP_NUMBER"]) ? sterilize($_POST[$identifier."-TAP_NUMBER"]) : "";
          $brewTapLocation[$location_key]['TAP_DATE'] = !empty($_POST[$identifier."-TAP_DATE"]) ? sterilize(strtotime($_POST[$identifier."-TAP_DATE"])) : "";
          $brewTapLocation[$location_key]['AMOUNT'] = isset($_POST[$identifier."-AMOUNT"]) ? sterilize($_POST[$identifier."-AMOUNT"]) : "";
          $brewTapLocation[$location_key]['VARIATION'] = isset($_POST[$identifier."-VARIATION"]) ? clean_text($_POST[$identifier."-VARIATION"]) : "";
          $brewTapLocation[$location_key]['FLAG'] = isset($_POST[$identifier."-FLAG"]) ? sterilize($_POST[$identifier."-FLAG"]) : "";
        }
      }

      // Always set brewTapLocation (not just when non-empty) so a submission with no
      // tap-location data - e.g. the user discarded it via the Status-change modal -
      // actually clears the column instead of leaving a stale value untouched.
      $data['brewTapLocation'] = !empty($brewTapLocation) ? json_encode($brewTapLocation) : NULL;

      if ($filter == "all") {

        // Define arrays for JSON encoding
        $brewFermentables = array();
        $brewHops = array();
        $brewMiscs = array();
        $brewYeasts = array();
        $brewMash = array();
        // $brewEquipment = array();
        // $brewWater = array();
        $brewPrimary = array();
        $brewSecondary = array();
        $brewTertiary = array();
        $brewAge = array();

        $fermentable_numbers = array();
        $hop_numbers = array();
        $yeast_numbers = array();
        $misc_numbers = array();
        $mash_step_numbers = array();

        // Each ingredient section posts a bare hidden field named after its stored key (e.g.,
        // "fermentable2"); its fields are posted as "fermentable2-NAME", etc. Take the number
        // from the field NAME, not its value: server-rendered sections post a running counter as
        // the value, which stops matching the key once an ingredient has been deleted.
        foreach($_POST as $key => $value) {

          if (strpos($key, "-") !== false) continue;

          if (preg_match('/^fermentable([0-9]+)$/', $key, $matches)) $fermentable_numbers[] = $matches[1];
          if (preg_match('/^hop([0-9]+)$/', $key, $matches)) $hop_numbers[] = $matches[1];
          if (preg_match('/^yeast([0-9]+)$/', $key, $matches)) $yeast_numbers[] = $matches[1];
          if (preg_match('/^misc([0-9]+)$/', $key, $matches)) $misc_numbers[] = $matches[1];
          if (preg_match('/^mash_step([0-9]+)$/', $key, $matches)) $mash_step_numbers[] = $matches[1];

        }

        // Loop through POST again, build arrays.

        $posted_data = array_map('strval', $_POST);

        foreach($posted_data  as $key => $value) {

          // Fermentables
          foreach ($fermentable_numbers as $v) {

            $identifier = "fermentable".$v;
            if (isset($_POST[$identifier."-NAME"])) {
              $brewFermentables[$identifier]['NAME'] = clean_text($_POST[$identifier."-NAME"]);
              $brewFermentables[$identifier]['VERSION'] = 1;
              if (isset($_POST[$identifier."-TYPE"])) $brewFermentables[$identifier]['TYPE'] = sterilize($_POST[$identifier."-TYPE"]);
              else $brewFermentables[$identifier]['TYPE'] = "";
              if (isset($_POST[$identifier."-AMOUNT"])) $brewFermentables[$identifier]['AMOUNT'] = sterilize($_POST[$identifier."-AMOUNT"]);
              else $brewFermentables[$identifier]['AMOUNT'] = "0";
              if (isset($_POST[$identifier."-YIELD"])) $brewFermentables[$identifier]['YIELD'] = sterilize($_POST[$identifier."-YIELD"]);
              else $brewFermentables[$identifier]['YIELD'] = "";
              if (isset($_POST[$identifier."-COLOR"])) $brewFermentables[$identifier]['COLOR'] = sterilize($_POST[$identifier."-COLOR"]);
              else $brewFermentables[$identifier]['COLOR'] = "0";
              if (isset($_POST[$identifier."-ORIGIN"])) $brewFermentables[$identifier]['ORIGIN'] = clean_text($_POST[$identifier."-ORIGIN"]);
              else $brewFermentables[$identifier]['ORIGIN'] = "";
              if (isset($_POST[$identifier."-SUPPLIER"])) $brewFermentables[$identifier]['SUPPLIER'] = clean_text($_POST[$identifier."-SUPPLIER"]);
              else $brewFermentables[$identifier]['SUPPLIER'] = "";
              if (isset($_POST[$identifier."-NOTES"])) $brewFermentables[$identifier]['NOTES'] = clean_text($_POST[$identifier."-NOTES"]);
              else $brewFermentables[$identifier]['NOTES'] = "";
              if (isset($_POST[$identifier."-IBU_GAL_PER_LB"])) $brewFermentables[$identifier]['IBU_GAL_PER_LB'] = sterilize($_POST[$identifier."-IBU_GAL_PER_LB"]);
              else $brewFermentables[$identifier]['IBU_GAL_PER_LB'] = "";
              if (isset($_POST[$identifier."-NOT_FERMENTABLE"])) $brewFermentables[$identifier]['NOT_FERMENTABLE'] = sterilize($_POST[$identifier."-NOT_FERMENTABLE"]);
              else $brewFermentables[$identifier]['NOT_FERMENTABLE'] = "FALSE";
              if (isset($_POST[$identifier."-ADD_AFTER_BOIL"])) $brewFermentables[$identifier]['ADD_AFTER_BOIL'] = sterilize($_POST[$identifier."-ADD_AFTER_BOIL"]);
              else $brewFermentables[$identifier]['ADD_AFTER_BOIL'] = "FALSE";
            }
          
          }

          // Hops

          foreach ($hop_numbers as $v) {

            $identifier = "hop".$v;

            if (isset($_POST[$identifier."-NAME"])) {
              $brewHops[$identifier]['NAME'] = clean_text($_POST[$identifier."-NAME"]);
              $brewHops[$identifier]['VERSION'] = 1;
              if (isset($_POST[$identifier."-TYPE"])) $brewHops[$identifier]['TYPE'] = sterilize($_POST[$identifier."-TYPE"]);
              else $brewHops[$identifier]['TYPE'] = "";
              if (isset($_POST[$identifier."-ALPHA"])) $brewHops[$identifier]['ALPHA'] = sterilize($_POST[$identifier."-ALPHA"]);
              else $brewHops[$identifier]['ALPHA'] = "0";
              if (isset($_POST[$identifier."-AMOUNT"])) $brewHops[$identifier]['AMOUNT'] = sterilize($_POST[$identifier."-AMOUNT"]);
              else $brewHops[$identifier]['AMOUNT'] = "0";
              if (isset($_POST[$identifier."-USE"])) $brewHops[$identifier]['USE'] = sterilize($_POST[$identifier."-USE"]);
              else $brewHops[$identifier]['USE'] = "";
              if (isset($_POST[$identifier."-TIME"])) $brewHops[$identifier]['TIME'] = sterilize($_POST[$identifier."-TIME"]);
              else $brewHops[$identifier]['TIME'] = "";
              if (isset($_POST[$identifier."-NOTES"])) $brewHops[$identifier]['NOTES'] = clean_text($_POST[$identifier."-NOTES"]);
              else $brewHops[$identifier]['NOTES'] = "";
              //if (isset($_POST[$identifier."-TYPE"])) $brewHops[$identifier]['TYPE'] = clean_text($_POST[$identifier."-TYPE"]);
              //else $brewHops[$identifier]['TYPE'] = "";
              if (isset($_POST[$identifier."-FORM"])) $brewHops[$identifier]['FORM'] = sterilize($_POST[$identifier."-FORM"]);
              else $brewHops[$identifier]['FORM'] = "Pellet";
              if (isset($_POST[$identifier."-ORIGIN"])) $brewHops[$identifier]['ORIGIN'] = clean_text($_POST[$identifier."-ORIGIN"]);
              else $brewHops[$identifier]['ORIGIN'] = "";
              if (isset($_POST[$identifier."-SUBSTITUTES"])) $brewHops[$identifier]['SUBSTITUTES'] = clean_text($_POST[$identifier."-SUBSTITUTES"]);
              else $brewHops[$identifier]['SUBSTITUTES'] = "";
              //if (isset($_POST[$identifier."-HOP_TEMP"])) $brewHops[$identifier]['HOP_TEMP'] = sterilize($_POST[$identifier."-HOP_TEMP"]);
              //else $brewHops[$identifier]['HOP_TEMP'] = "";
              if (isset($_POST[$identifier."-TEMPERATURE"])) $brewHops[$identifier]['TEMPERATURE'] = sterilize($_POST[$identifier."-TEMPERATURE"]);
              else $brewHops[$identifier]['TEMPERATURE'] = "";
            }
          
          }

          // Yeast

          foreach ($yeast_numbers as $v) {

            $identifier = "yeast".$v;

            if (isset($_POST[$identifier."-NAME"])) {

              $brewYeasts[$identifier]['NAME'] = clean_text($_POST[$identifier."-NAME"]);
              $brewYeasts[$identifier]['VERSION'] = 1;
              if (isset($_POST[$identifier."-TYPE"])) $brewYeasts[$identifier]['TYPE'] = sterilize($_POST[$identifier."-TYPE"]);
              else $brewYeasts[$identifier]['TYPE'] = "";
              if (isset($_POST[$identifier."-FORM"])) $brewYeasts[$identifier]['FORM'] = sterilize($_POST[$identifier."-FORM"]);
              else $brewYeasts[$identifier]['FORM'] = "";
              if (isset($_POST[$identifier."-AMOUNT"])) $brewYeasts[$identifier]['AMOUNT'] = sterilize($_POST[$identifier."-AMOUNT"]);
              else $brewYeasts[$identifier]['AMOUNT'] = "";
              if (isset($_POST[$identifier."-LABORATORY"])) $brewYeasts[$identifier]['LABORATORY'] = clean_text($_POST[$identifier."-LABORATORY"]);
              else $brewYeasts[$identifier]['LABORATORY'] = "";
              if (isset($_POST[$identifier."-PRODUCT_ID"])) $brewYeasts[$identifier]['PRODUCT_ID'] = clean_text($_POST[$identifier."-PRODUCT_ID"]);
              else $brewYeasts[$identifier]['PRODUCT_ID'] = "";
              if (isset($_POST[$identifier."-MIN_TEMPERATURE"])) $brewYeasts[$identifier]['MIN_TEMPERATURE'] = sterilize($_POST[$identifier."-MIN_TEMPERATURE"]);
              else $brewYeasts[$identifier]['MIN_TEMPERATURE'] = "";
              if (isset($_POST[$identifier."-MAX_TEMPERATURE"])) $brewYeasts[$identifier]['MAX_TEMPERATURE'] = sterilize($_POST[$identifier."-MAX_TEMPERATURE"]);
              else $brewYeasts[$identifier]['MAX_TEMPERATURE'] = "";
              if (isset($_POST[$identifier."-FLOCCULATION"])) $brewYeasts[$identifier]['FLOCCULATION'] = sterilize($_POST[$identifier."-FLOCCULATION"]);
              else $brewYeasts[$identifier]['FLOCCULATION'] = "";
              if (isset($_POST[$identifier."-ATTENUATION"])) $brewYeasts[$identifier]['ATTENUATION'] = sterilize($_POST[$identifier."-ATTENUATION"]);
              else $brewYeasts[$identifier]['ATTENUATION'] = "";
              
              //if (isset($_POST[$identifier."-NOTES"])) $brewYeasts[$identifier]['NOTES'] = clean_text($_POST[$identifier."-NOTES"]);
              //else $brewYeasts[$identifier]['NOTES'] = "";
            
            }

          }

          // Misc

          foreach ($misc_numbers as $v) {

            /*
            {"misc0":{"NAME":"Calcium Chloride (CaCl2)","VERSION":"1","AMOUNT":"0.003307","TYPE":"Water Agent","USE":"Mash","TIME":"0","AMOUNT_IS_WEIGHT":"TRUE","DISPLAY_AMOUNT":"1.5 g"}
            */

            $identifier = "misc".$v;
            
            if (isset($_POST[$identifier."-NAME"])) {
              $brewMiscs[$identifier]['NAME'] = clean_text($_POST[$identifier."-NAME"]);
              $brewMiscs[$identifier]['VERSION'] = 1;
              if (isset($_POST[$identifier."-TYPE"])) $brewMiscs[$identifier]['TYPE'] = sterilize($_POST[$identifier."-TYPE"]);
              else $brewMiscs[$identifier]['TYPE'] = "";
              if (isset($_POST[$identifier."-USE"])) $brewMiscs[$identifier]['USE'] = sterilize($_POST[$identifier."-USE"]);
              else $brewMiscs[$identifier]['USE'] = "";
              if (isset($_POST[$identifier."-TIME"])) $brewMiscs[$identifier]['TIME'] = sterilize($_POST[$identifier."-TIME"]);
              else $brewMiscs[$identifier]['TIME'] = "";
              if (isset($_POST[$identifier."-AMOUNT"])) $brewMiscs[$identifier]['AMOUNT'] = sterilize($_POST[$identifier."-AMOUNT"]);
              else $brewMiscs[$identifier]['AMOUNT'] = "";
              if (isset($_POST[$identifier."-AMOUNT_IS_WEIGHT"])) $brewMiscs[$identifier]['AMOUNT_IS_WEIGHT'] = sterilize($_POST[$identifier."-AMOUNT_IS_WEIGHT"]);
              else $brewMiscs[$identifier]['AMOUNT_IS_WEIGHT'] = "FALSE";
              if (isset($_POST[$identifier."-DISPLAY_AMOUNT"])) $brewMiscs[$identifier]['DISPLAY_AMOUNT'] = clean_text($_POST[$identifier."-DISPLAY_AMOUNT"]);
              else $brewMiscs[$identifier]['DISPLAY_AMOUNT'] = "";
            }

          }

          // Mash

          if (isset($_POST['mash-NAME'])) {

            $brewMash['NAME'] = clean_text($_POST["mash-NAME"]);
            $brewMash['VERSION'] = 1;
            if (isset($_POST["mash-GRAIN_TEMP"])) $brewMash['GRAIN_TEMP'] = sterilize($_POST["mash-GRAIN_TEMP"]);
            else $brewMash['GRAIN_TEMP'] = "";
            if (isset($_POST["mash-TUN_TEMP"])) $brewMash['TUN_TEMP'] = sterilize($_POST["mash-TUN_TEMP"]);
            else $brewMash['TUN_TEMP'] = "";
            if (isset($_POST["mash-SPARGE_TEMP"])) $brewMash['SPARGE_TEMP'] = sterilize($_POST["mash-SPARGE_TEMP"]);
            else $brewMash['SPARGE_TEMP'] = "";
            if (isset($_POST["mash-PH"])) $brewMash['PH'] = sterilize($_POST["mash-PH"]);
            else $brewMash['PH'] = "";
            if (isset($_POST["mash-NOTES"])) $brewMash['NOTES'] = clean_text($_POST["mash-NOTES"]);
            else $brewMash['NOTES'] = "";

            $brewMash['MASH_STEPS'] = array();

            foreach ($mash_step_numbers as $v) {

              $identifier = "mash_step".$v;
              
              if (isset($_POST[$identifier."-NAME"])) {
                $brewMash['MASH_STEPS'][$identifier]['NAME'] = clean_text($_POST[$identifier."-NAME"]);
                $brewMash['MASH_STEPS'][$identifier]['VERSION'] = "1";
                if (isset($_POST[$identifier."-TYPE"])) $brewMash['MASH_STEPS'][$identifier]['TYPE'] = clean_text($_POST[$identifier."-TYPE"]);
                else $brewMash['MASH_STEPS'][$identifier]['TYPE'] = "";
                if (isset($_POST[$identifier."-STEP_TEMP"])) $brewMash['MASH_STEPS'][$identifier]['STEP_TEMP'] = sterilize($_POST[$identifier."-STEP_TEMP"]);
                else $brewMash['MASH_STEPS'][$identifier]['STEP_TEMP'] = "";
                if (isset($_POST[$identifier."-STEP_TIME"])) $brewMash['MASH_STEPS'][$identifier]['STEP_TIME'] = sterilize($_POST[$identifier."-STEP_TIME"]);
                else $brewMash['MASH_STEPS'][$identifier]['STEP_TIME'] = "";
              }

            }

          }

          if ((isset($_POST['PRIMARY_AGE'])) && (!empty($_POST['PRIMARY_AGE']))) $brewPrimary['PRIMARY_AGE'] = sterilize($_POST['PRIMARY_AGE']);
          if ((isset($_POST['PRIMARY_TEMP'])) && (!empty($_POST['PRIMARY_TEMP'])))  $brewPrimary['PRIMARY_TEMP'] = sterilize($_POST['PRIMARY_TEMP']);
          if ((isset($_POST['SECONDARY_AGE'])) && (!empty($_POST['SECONDARY_AGE'])))  $brewSecondary['SECONDARY_AGE'] = sterilize($_POST['SECONDARY_AGE']);
          if ((isset($_POST['SECONDARY_TEMP'])) && (!empty($_POST['SECONDARY_TEMP'])))  $brewSecondary['SECONDARY_TEMP'] = sterilize($_POST['SECONDARY_TEMP']);
          if ((isset($_POST['TERTIARY_AGE'])) && (!empty($_POST['TERTIARY_AGE'])))  $brewTertiary['TERTIARY_AGE'] = sterilize($_POST['TERTIARY_AGE']);
          if ((isset($_POST['TERTIARY_TEMP'])) && (!empty($_POST['TERTIARY_TEMP'])))  $brewTertiary['TERTIARY_TEMP'] = sterilize($_POST['TERTIARY_TEMP']);
          if ((isset($_POST['AGE'])) && (!empty($_POST['AGE'])))  $brewAge['AGE'] = sterilize($_POST['AGE']);
          if ((isset($_POST['AGE_TEMP'])) && (!empty($_POST['AGE_TEMP'])))  $brewAge['AGE_TEMP'] = sterilize($_POST['AGE_TEMP']);

        }

      $db_conn->where('id', $id);
      $row_stored = $db_conn->getOne('brewblogs', 'brewFermentables, brewHops, brewYeasts, brewMiscs, brewMash');

      if (!empty($row_stored)) {
        $brewFermentables = merge_stored_items($brewFermentables, json_decode((string) $row_stored['brewFermentables'], true));
        $brewHops = merge_stored_items($brewHops, json_decode((string) $row_stored['brewHops'], true));
        $brewYeasts = merge_stored_items($brewYeasts, json_decode((string) $row_stored['brewYeasts'], true));
        $brewMiscs = merge_stored_items($brewMiscs, json_decode((string) $row_stored['brewMiscs'], true));
        $stored_mash = json_decode((string) $row_stored['brewMash'], true);
        if ((!empty($brewMash)) && (is_array($stored_mash))) {
          $mash_steps = $brewMash['MASH_STEPS'];
          $stored_mash_steps = (isset($stored_mash['MASH_STEPS'])) ? $stored_mash['MASH_STEPS'] : array();
          unset($brewMash['MASH_STEPS'], $stored_mash['MASH_STEPS']);
          // Mash-level fields are posted as "mash-NAME", etc.
          $brewMash = merge_stored_items(array("mash" => $brewMash), array("mash" => $stored_mash))["mash"];
          $brewMash['MASH_STEPS'] = merge_stored_items($mash_steps, $stored_mash_steps);
        }
      }

      if (!empty($brewFermentables)) $data['brewFermentables'] = json_encode($brewFermentables);
      if (!empty($brewHops)) $data['brewHops'] = json_encode($brewHops);
      if (!empty($brewYeasts)) $data['brewYeasts'] = json_encode($brewYeasts);
      if (!empty($brewMiscs)) $data['brewMiscs'] = json_encode($brewMiscs);
      if (!empty($brewMash)) $data['brewMash'] = json_encode($brewMash);
      if (!empty($brewPrimary)) $data['brewPrimary'] = json_encode($brewPrimary);
      if (!empty($brewSecondary)) $data['brewSecondary'] = json_encode($brewSecondary);
      if (!empty($brewTertiary)) $data['brewTertiary'] = json_encode($brewTertiary);
      if (!empty($brewAge)) $data['brewAge'] = json_encode($brewAge);

      } // end if ($filter == "all")

      /*
      echo json_encode($brewFermentables);
      
      echo "<br><br>";
      echo json_encode($brewHops);

      echo "<br><br>";
      echo json_encode($brewYeasts);

      echo "<br><br>";
      echo json_encode($brewMiscs);

      echo "<br><br>";
      echo json_encode($brewMash);

      echo "<br><br>";
      echo json_encode($brewPrimary);

      echo "<br><br>";
      echo json_encode($brewSecondary);

      echo "<br><br>";
      echo json_encode($brewTertiary);

      echo "<br><br>";
      echo json_encode($brewAge);

      exit();

      */

      $update_table = $dbTable;
      $db_conn->where ('id', $id);
      $result = $db_conn->update($update_table, $data);

      if ($result) {
        //if (SEF) $updateGoTo = build_public_url("admin", "brewblogs", "manage", "brewblogs", "all", "default", $base_url, "2");
        //else 
        $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=2";
      }

      else {
        $error_output[] = $db_conn->getLastError();
        //if (SEF) $updateGoTo = build_public_url("admin", "brewblogs", "manage", "brewblogs", "all", "default", $base_url, "4");
        //else
        $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=4";
      }

    } // end if (!empty($_POST))

    else {
      //if (SEF) $updateGoTo = build_public_url("admin", "brewblogs", "manage", "brewblogs", "all", "default", $base_url, "4");
      //else 
      $updateGoTo = $base_url."index.php?page=admin&section=brewblogs&action=manage&dbTable=brewblogs&filter=all&confirm=new&msg=4";
      $error_output[] = "No data in the form submission.";
    }

  } // end if (($action == "edit") && ($dbTable == "brewblogs"))

  // Legacy dead code (recipes/brewer/preferences/users/mash_steps/etc. handlers, ~1,400 lines)
  // archived to unused/includes/process_new.legacy.inc.php on 2026-08-02 - see that file for
  // details. It was already inert (sat inside a /* ... */ comment block) before this move.

  $_SESSION['error_output'] = $error_output;
  header(sprintf("Location: %s", $updateGoTo));
  exit();

} // end security check

?>
