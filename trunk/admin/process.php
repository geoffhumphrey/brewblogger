<?php
/**
 * Module: process.php
 * Description: This module does all the heavy lifting for any DB updates; new recipes,
 *              edited blogs, new users, etc.
 */

require ('../paths.php');
require_once (CONFIG.'config.php'); 
require (INCLUDES.'authentication.inc.php'); session_start(); sessionAuthenticate();
include (INCLUDES.'url_variables.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');
//include_once (INCLUDES.'constants.inc.php');

$fieldData = array();

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
  include '../includes/scrubber.inc.php';  
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break; 
    case "float":
      $theValue = ($theValue != "") ? floatval($theValue) : "NULL";
      break;
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
	case "scrubbed":
	  $theValue = ($theValue != "") ? "'" . strtr($theValue, $html_string) . "'" : "NULL";
  }
  return $theValue; 
}

// Return intention of hop use based on time.
function get_hop_type($time) { 
  $type = "";
  
  if ($time != "") {
    if ($time > 30) {
      $type = "Bittering";
    } elseif (($time <= 30) && ($time >= 15)) {
      $type = "Flavor";
    } else {
      $type = "Aroma";
    }
  }

  return $type;
}

// Return hop usage type based on when it's added versus boil time.
function get_hop_use($time, $boil_time) { 
  $use = "";
  
  if ($time != "") { 
    if ($boil_time == "") {
      $boil_time = 60;
    }
    
    if ($time > $boil_time) {
      $use = "First Wort";
    } elseif (($time <= $boil_time) && ($time > 15)) {
      $use = "Boil";
    } elseif (($time <= 15) && ($time > 0)) {
      $use = "Aroma";
    } else {
      $use = "Dry Hop";
    }
  }

  return $use;
}

// Load data common to 'recipes' and 'brewing' tables.
// $update == TRUE if we're updating from the recipe calculator.
function load_recipe_brewing_common_data($update) {
  global $fieldData;

  $fieldData["brewName"]     = GetSQLValueString($_POST['brewName'], "scrubbed");
  $fieldData["brewStyle"]    = GetSQLValueString($_POST['brewStyle'], "text");
  $fieldData["brewYield"]    = GetSQLValueString($_POST['brewYield'], "text");
  $fieldData["brewBrewerID"] = GetSQLValueString($_POST['brewBrewerID'], "text");

  for ($i = 0; $i < MAX_EXT; $i++) {
    $key = "brewExtract" . ($i + 1);
    $fieldData[$key] = GetSQLValueString($_POST['extName'][$i], "text");
    $key = "brewExtract" . ($i + 1) . "Weight";
    $fieldData[$key] = GetSQLValueString($_POST['extWeight'][$i], "text");
  }

  for ($i = 0; $i < MAX_GRAINS; $i++) {
    $key = "brewGrain" . ($i + 1);
    $fieldData[$key] = GetSQLValueString($_POST['grainName'][$i], "text");
    $key = "brewGrain" . ($i + 1) . "Weight";
    $fieldData[$key] = GetSQLValueString($_POST['grainWeight'][$i], "text");
  }

  for ($i = 0; $i < MAX_ADJ; $i++) {
    $key = "brewAddition" . ($i + 1);
    $fieldData[$key] = GetSQLValueString($_POST['adjName'][$i], "text");
    $key = "brewAddition" . ($i + 1) . "Amt";
    $fieldData[$key] = GetSQLValueString($_POST['adjWeight'][$i], "text");
  }

  for ($i = 0; $i < MAX_HOPS; $i++) {
    $key = "brewHops" . ($i + 1);
    $fieldData[$key] = GetSQLValueString($_POST['hopsName'][$i], "text");
    $key = "brewHops" . ($i + 1) . "Weight";
    $fieldData[$key] = GetSQLValueString($_POST['hopsWeight'][$i], "text");
    $key = "brewHops" . ($i + 1) . "IBU";
    $fieldData[$key] = GetSQLValueString($_POST['hopsAA'][$i], "text");
    $key = "brewHops" . ($i + 1) . "Time";
    $fieldData[$key] = GetSQLValueString($_POST['hopsTime'][$i], "text");
    $key = "brewHops" . ($i + 1) . "Form";
    $fieldData[$key] = GetSQLValueString($_POST['hopsForm'][$i], "text");

    if (!$update) {
      $key = "brewHops" . ($i + 1) . "Use";
      $fieldData[$key] = GetSQLValueString($_POST['hopsUse'][$i], "text");
      $key = "brewHops" . ($i + 1) . "Type";
      $fieldData[$key] = GetSQLValueString($_POST['hopsType'][$i], "text");
    }
  }

  if (!$update) {
    $fieldData["brewMethod"]       = GetSQLValueString($_POST['brewMethod'], "text");
    $fieldData["brewProcedure"]    = GetSQLValueString($_POST['brewProcedure'], "text");
    $fieldData["brewBitterness"]   = GetSQLValueString($_POST['brewBitterness'], "text");
    $fieldData["brewIBUFormula"]   = GetSQLValueString($_POST['brewIBUFormula'], "text");
    $fieldData["brewLovibond"]     = GetSQLValueString($_POST['brewLovibond'], "text");
    $fieldData["brewColorFormula"] = GetSQLValueString($_POST['brewColorFormula'], "text");

    $fieldData["brewFeatured"]   = GetSQLValueString($_POST['brewFeatured'], "text");
    $fieldData["brewArchive"]    = GetSQLValueString($_POST['brewArchive'], "text");
    $fieldData["brewBoilTime"]   = GetSQLValueString($_POST['brewBoilTime'], "text");
    $fieldData["brewOG"]         = GetSQLValueString($_POST['brewOG'], "text");
    $fieldData["brewFG"]         = GetSQLValueString($_POST['brewFG'], "text");

    $fieldData["brewPrimary"]       = GetSQLValueString($_POST['brewPrimary'], "text");
    $fieldData["brewPrimaryTemp"]   = GetSQLValueString($_POST['brewPrimaryTemp'], "text");
    $fieldData["brewSecondary"]     = GetSQLValueString($_POST['brewSecondary'], "text");
    $fieldData["brewSecondaryTemp"] = GetSQLValueString($_POST['brewSecondaryTemp'], "text");
    $fieldData["brewTertiary"]      = GetSQLValueString($_POST['brewTertiary'], "text");
    $fieldData["brewTertiaryTemp"]  = GetSQLValueString($_POST['brewTertiaryTemp'], "text");
    $fieldData["brewLager"]         = GetSQLValueString($_POST['brewLager'], "text");
    $fieldData["brewLagerTemp"]     = GetSQLValueString($_POST['brewLagerTemp'], "text");
    $fieldData["brewAge"]           = GetSQLValueString($_POST['brewAge'], "text");
    $fieldData["brewAgeTemp"]       = GetSQLValueString($_POST['brewAgeTemp'], "text");

    $fieldData["brewLink1"]     = GetSQLValueString($_POST['brewLink1'], "text");
    $fieldData["brewLink1Name"] = GetSQLValueString($_POST['brewLink1Name'], "scrubbed");
    $fieldData["brewLink2"]     = GetSQLValueString($_POST['brewLink2'], "text");
    $fieldData["brewLink2Name"] = GetSQLValueString($_POST['brewLink2Name'], "scrubbed");

    $fieldData["brewMisc1Name"]   = GetSQLValueString($_POST['brewMisc1Name'], "text");
    $fieldData["brewMisc1Type"]   = GetSQLValueString($_POST['brewMisc1Type'], "text");
    $fieldData["brewMisc1Use"]    = GetSQLValueString($_POST['brewMisc1Use'], "text");
    $fieldData["brewMisc1Time"]   = GetSQLValueString($_POST['brewMisc1Time'], "text");
    $fieldData["brewMisc1Amount"] = GetSQLValueString($_POST['brewMisc1Amount'], "text");
    $fieldData["brewMisc2Name"]   = GetSQLValueString($_POST['brewMisc2Name'], "text");
    $fieldData["brewMisc2Type"]   = GetSQLValueString($_POST['brewMisc2Type'], "text");
    $fieldData["brewMisc2Use"]    = GetSQLValueString($_POST['brewMisc2Use'], "text");
    $fieldData["brewMisc2Time"]   = GetSQLValueString($_POST['brewMisc2Time'], "text");
    $fieldData["brewMisc2Amount"] = GetSQLValueString($_POST['brewMisc2Amount'], "text");
    $fieldData["brewMisc3Name"]   = GetSQLValueString($_POST['brewMisc3Name'], "text");
    $fieldData["brewMisc3Type"]   = GetSQLValueString($_POST['brewMisc3Type'], "text");
    $fieldData["brewMisc3Use"]    = GetSQLValueString($_POST['brewMisc3Use'], "text");
    $fieldData["brewMisc3Time"]   = GetSQLValueString($_POST['brewMisc3Time'], "text");
    $fieldData["brewMisc3Amount"] = GetSQLValueString($_POST['brewMisc3Amount'], "text");
    $fieldData["brewMisc4Name"]   = GetSQLValueString($_POST['brewMisc4Name'], "text");
    $fieldData["brewMisc4Type"]   = GetSQLValueString($_POST['brewMisc4Type'], "text");
    $fieldData["brewMisc4Use"]    = GetSQLValueString($_POST['brewMisc4Use'], "text");
    $fieldData["brewMisc4Time"]   = GetSQLValueString($_POST['brewMisc4Time'], "text");
    $fieldData["brewMisc4Amount"] = GetSQLValueString($_POST['brewMisc4Amount'], "text");
  }
}

// Load data unique to the 'brewing' table (blogs)
function load_brewing_data() {
  global $fieldData;
  
  $fieldData["brewBatchNum"]         = GetSQLValueString($_POST['brewBatchNum'], "text");
  $fieldData["brewCondition"]        = GetSQLValueString($_POST['brewCondition'], "text");
  $fieldData["brewDate"]             = GetSQLValueString($_POST['brewDate'], "date");
  $fieldData["brewCost"]             = GetSQLValueString($_POST['brewCost'], "text");
  $fieldData["brewInfo"]             = GetSQLValueString($_POST['brewInfo'], "text");
  $fieldData["brewLabelImage"]       = GetSQLValueString($_POST['brewLabelImage'], "text");
  $fieldData["brewSpecialProcedure"] = GetSQLValueString($_POST['brewSpecialProcedure'], "text");
  $fieldData["brewComments"]         = GetSQLValueString($_POST['brewComments'], "text");
  $fieldData["brewEfficiency"]       = GetSQLValueString($_POST['brewEfficiency'], "text");
  $fieldData["brewPPG"]              = GetSQLValueString($_POST['brewPPG'], "text");
  $fieldData["brewTapDate"]          = GetSQLValueString($_POST['brewTapDate'], "text");
  $fieldData["brewStatus"]           = GetSQLValueString($_POST['brewStatus'], "text");
  $fieldData["brewPreBoilAmt"]       = GetSQLValueString($_POST['brewPreBoilAmt'], "text");
  $fieldData["brewTargetOG"]         = GetSQLValueString($_POST['brewTargetOG'], "text");
  $fieldData["brewTargetFG"]         = GetSQLValueString($_POST['brewTargetFG'], "text");
  $fieldData["brewMashProfile"]      = GetSQLValueString($_POST['brewMashProfile'], "text");
  $fieldData["brewWaterProfile"]     = GetSQLValueString($_POST['brewWaterProfile'], "text");
  $fieldData["brewEquipProfile"]     = GetSQLValueString($_POST['brewEquipProfile'], "text");
  $fieldData["brewWaterRatio"]       = GetSQLValueString($_POST['brewWaterRatio'], "text");

  $fieldData["brewGravity1"]     = GetSQLValueString($_POST['brewGravity1'], "text");
  $fieldData["brewGravity1Days"] = GetSQLValueString($_POST['brewGravity1Days'], "text");
  $fieldData["brewGravity2"]     = GetSQLValueString($_POST['brewGravity2'], "text");
  $fieldData["brewGravity2Days"] = GetSQLValueString($_POST['brewGravity2Days'], "text");

  $fieldData["brewMashGravity"]     = GetSQLValueString($_POST['brewMashGravity'], "text");
  $fieldData["brewMashType"]        = GetSQLValueString($_POST['brewMashType'], "text");
  $fieldData["brewMashGrainWeight"] = GetSQLValueString($_POST['brewMashGrainWeight'], "text");
  $fieldData["brewMashGrainTemp"]   = GetSQLValueString($_POST['brewMashGrainTemp'], "text");
  $fieldData["brewMashTunTemp"]     = GetSQLValueString($_POST['brewMashTunTemp'], "text");
  $fieldData["brewMashSpargAmt"]    = GetSQLValueString($_POST['brewMashSpargAmt'], "text");
  $fieldData["brewMashSpargeTemp"]  = GetSQLValueString($_POST['brewMashSpargeTemp'], "text");
  $fieldData["brewMashEquipAdjust"] = GetSQLValueString($_POST['brewMashEquipAdjust'], "text");
  $fieldData["brewMashPH"]          = GetSQLValueString($_POST['brewMashPH'], "text");
  $fieldData["brewMashStep1Name"]   = GetSQLValueString($_POST['brewMashStep1Name'], "scrubbed");
  $fieldData["brewMashStep1Desc"]   = GetSQLValueString($_POST['brewMashStep1Desc'], "scrubbed");
  $fieldData["brewMashStep1Temp"]   = GetSQLValueString($_POST['brewMashStep1Temp'], "text");
  $fieldData["brewMashStep1Time"]   = GetSQLValueString($_POST['brewMashStep1Time'], "text");
  $fieldData["brewMashStep2Name"]   = GetSQLValueString($_POST['brewMashStep2Name'], "scrubbed");
  $fieldData["brewMashStep2Desc"]   = GetSQLValueString($_POST['brewMashStep2Desc'], "scrubbed");
  $fieldData["brewMashStep2Temp"]   = GetSQLValueString($_POST['brewMashStep2Temp'], "text");
  $fieldData["brewMashStep2Time"]   = GetSQLValueString($_POST['brewMashStep2Time'], "text");
  $fieldData["brewMashStep3Name"]   = GetSQLValueString($_POST['brewMashStep3Name'], "scrubbed");
  $fieldData["brewMashStep3Desc"]   = GetSQLValueString($_POST['brewMashStep3Desc'], "scrubbed");
  $fieldData["brewMashStep3Temp"]   = GetSQLValueString($_POST['brewMashStep3Temp'], "text");
  $fieldData["brewMashStep3Time"]   = GetSQLValueString($_POST['brewMashStep3Time'], "text");
  $fieldData["brewMashStep4Name"]   = GetSQLValueString($_POST['brewMashStep4Name'], "scrubbed");
  $fieldData["brewMashStep4Desc"]   = GetSQLValueString($_POST['brewMashStep4Desc'], "scrubbed");
  $fieldData["brewMashStep4Temp"]   = GetSQLValueString($_POST['brewMashStep4Temp'], "text");
  $fieldData["brewMashStep4Time"]   = GetSQLValueString($_POST['brewMashStep4Time'], "text");
  $fieldData["brewMashStep5Name"]   = GetSQLValueString($_POST['brewMashStep5Name'], "scrubbed");
  $fieldData["brewMashStep5Desc"]   = GetSQLValueString($_POST['brewMashStep5Desc'], "scrubbed");
  $fieldData["brewMashStep5Temp"]   = GetSQLValueString($_POST['brewMashStep5Temp'], "text");
  $fieldData["brewMashStep5Time"]   = GetSQLValueString($_POST['brewMashStep5Time'], "text");

  $fieldData["brewWaterName"]      = GetSQLValueString($_POST['brewWaterName'], "scrubbed");
  $fieldData["brewWaterAmount"]    = GetSQLValueString($_POST['brewWaterAmount'], "text");
  $fieldData["brewWaterCalcium"]   = GetSQLValueString($_POST['brewWaterCalcium'], "text");
  $fieldData["brewWaterBicarb"]    = GetSQLValueString($_POST['brewWaterBicarb'], "text");
  $fieldData["brewWaterSulfate"]   = GetSQLValueString($_POST['brewWaterSulfate'], "text");
  $fieldData["brewWaterChloride"]  = GetSQLValueString($_POST['brewWaterChloride'], "text");
  $fieldData["brewWaterMagnesium"] = GetSQLValueString($_POST['brewWaterMagnesium'], "text");
  $fieldData["brewWaterPH"]        = GetSQLValueString($_POST['brewWaterPH'], "text");
  $fieldData["brewWaterNotes"]     = GetSQLValueString($_POST['brewWaterNotes'], "text");
  $fieldData["brewWaterSodium"]    = GetSQLValueString($_POST['brewWaterSodium'], "text");
}

// Load data specific to the 'recipe' table.
function load_recipe_data() {
  global $fieldData;
  
  $fieldData["brewSource"] = GetSQLValueString($_POST['brewSource'], "scrubbed");
  $fieldData["brewNotes"]  = GetSQLValueString($_POST['brewNotes'], "text");
}

// Load data specific to an update of a recipe or blog from running the 
// Recipe Calculator.
// $table == ['brewing' || 'recipes']
function load_recipe_brewing_update_data($table) {
  global $fieldData;

  $brewBitterness              = explode("-", $_POST['brewBitterness']);
  $fieldData["brewBitterness"] = GetSQLValueString($brewBitterness[0], "text");
  $fieldData["brewIBUFormula"] = GetSQLValueString($brewBitterness[1], "text");

  $brewLovibond                  = explode("-", $_POST['brewLovibond']);
  $fieldData["brewLovibond"]     = GetSQLValueString($brewLovibond[0], "text");
  $fieldData["brewColorFormula"] = GetSQLValueString($brewLovibond[1], "text");

  // Hop Use and Type aren't considered in the calculator so we have to make some assumptions here.
  $boilTime = $_POST['brewBoilTime'];
  for ($i = 0; $i < MAX_HOPS; $i++) {
    $key = "brewHops" . ($i + 1) . "Use";
    $fieldData[$key] = GetSQLValueString(get_hop_use($_POST['hopsTime'][$i], $boilTime), "text");
    $key = "brewHops" . ($i + 1) . "Type";
    $fieldData[$key] = GetSQLValueString(get_hop_type($_POST['hopsTime'][$i]), "text");
  }

  // If this is a blog, we want to update the target/predicted OG and FG; Otherwise, it's a
  // recipe so we just update the 'brewOG' and 'brewFG'.
  if ($table == "brewing") {
    $fieldData["brewTargetOG"] = GetSQLValueString($_POST['brewOG'], "text");
    $fieldData["brewTargetFG"] = GetSQLValueString($_POST['brewFG'], "text");
  } else {
    $fieldData["brewOG"] = GetSQLValueString($_POST['brewOG'], "text");
    $fieldData["brewFG"] = GetSQLValueString($_POST['brewFG'], "text");
  }
}

// --------------------------- If Adding a new brewBlog ------------------------------ //

if ((($action == "add") || ($action == "importCalc") ||
     ($action == "reuse") || ($action == "import")) && ($dbTable == "brewing")) { 

  load_recipe_brewing_common_data(FALSE);
  load_brewing_data();

  $fieldData["brewYeast"]        = GetSQLValueString($_POST['brewYeast'], "scrubbed");
  $fieldData["brewYeastMan"]     = GetSQLValueString($_POST['brewYeastMan'], "scrubbed");
  $fieldData["brewYeastForm"]    = GetSQLValueString($_POST['brewYeastForm'], "text");
  $fieldData["brewYeastType"]    = GetSQLValueString($_POST['brewYeastType'], "text");
  $fieldData["brewYeastAmount"]  = GetSQLValueString($_POST['brewYeastAmount'], "scrubbed");
  $fieldData["brewYeastProfile"] = GetSQLValueString($_POST['brewYeastProfile'], "text");
  
  $columns = array();
  $data    = array();

  foreach ($fieldData as $k => $v) {
    $columns[] = $k;
    if ($v != "") {
      $data[] = $v;
    } else {
      $data[] = "NULL";
    }
  }
  $cols = implode(",", $columns);
  $vals = implode(",", $data);

  $insertSQL = "INSERT INTO brewing ($cols) VALUES ($vals)";

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=brewing&id=".$id."&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a brewBlog ------------------------------- //

if (($action == "edit") && ($dbTable == "brewing")) {

  load_recipe_brewing_common_data(FALSE);
  load_brewing_data();

  if ($_POST['yeastKeep'] == "Yes") {
    $brewYeast        = $_POST['brewYeast'];
    $brewYeastMan     = $_POST['brewYeastMan'];
    $brewYeastType    = $_POST['brewYeastType'];
    $brewYeastForm    = $_POST['brewYeastForm'];
    $brewYeastProfile = "";
    $brewYeastAmount  = $_POST['brewYeastAmount'];
  } else  {
    $brewYeast        = "";
    $brewYeastMan     = "";
    $brewYeastType    = "";
    $brewYeastForm    = "";
    $brewYeastProfile = $_POST['brewYeastProfile'];
    $brewYeastAmount  = $_POST['brewYeastAmount'];
  }

  $fieldData["brewYeast"]        = GetSQLValueString($brewYeast, "text");
  $fieldData["brewYeastMan"]     = GetSQLValueString($brewYeastMan, "text");
  $fieldData["brewYeastType"]    = GetSQLValueString($brewYeastType, "text");
  $fieldData["brewYeastForm"]    = GetSQLValueString($brewYeastForm, "text");
  $fieldData["brewYeastProfile"] = GetSQLValueString($brewYeastProfile, "text");
  $fieldData["brewYeastAmount"]  = GetSQLValueString($brewYeastAmount, "text");

  $data = "";
  $count  = count($fieldData);
  $i      = 1;

  foreach ($fieldData as $k => $v) {
    $data .= "$k = $v";
    if ($i < $count) {
      $data .= ", ";
    }

    $i++;
  }

  $updateSQL = "UPDATE brewing SET $data WHERE id=" . GetSQLValueString($id, "int");

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=brewing&id=".$id."&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Updating Calculations ------------------------------- //

if (($action == "update") && (($dbTable == "brewing") || ($dbTable == "recipes"))) {

  load_recipe_brewing_common_data(TRUE);
  load_recipe_brewing_update_data($dbTable);

  $data = "";
  $count  = count($fieldData);
  $i      = 1;

  foreach ($fieldData as $k => $v) {
    $data .= "$k = $v";
    if ($i < $count) {
      $data .= ", ";
    }

    $i++;
  }

  $updateSQL = "UPDATE $dbTable SET $data WHERE id=" . GetSQLValueString($id, "int");

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=".$dbTable."&id=".$id."&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a new Recipe --------------------------------------- //

if ((($action == "add") || ($action == "importRecipe") || ($action == "importCalc")  ||
     ($action == "reuse") || ($action == "import")) && ($dbTable=="recipes")) {

  load_recipe_brewing_common_data(FALSE);
  load_recipe_data();

  $fieldData["brewYeast"]        = GetSQLValueString($_POST['brewYeast'], "scrubbed");
  $fieldData["brewYeastMan"]     = GetSQLValueString($_POST['brewYeastMan'], "scrubbed");
  $fieldData["brewYeastForm"]    = GetSQLValueString($_POST['brewYeastForm'], "text");
  $fieldData["brewYeastType"]    = GetSQLValueString($_POST['brewYeastType'], "text");
  $fieldData["brewYeastAmount"]  = GetSQLValueString($_POST['brewYeastAmount'], "scrubbed");
  $fieldData["brewYeastProfile"] = GetSQLValueString($_POST['brewYeastProfile'], "text");

  $columns = array();
  $data    = array();

  foreach ($fieldData as $k => $v) {
    $columns[] = $k;
    if ($v != "") {
      $data[] = $v;
    } else {
      $data[] = "NULL";
    }
  }
  $cols = implode(",", $columns);
  $vals = implode(",", $data);

  $insertSQL = "INSERT INTO recipes ($cols) VALUES ($vals)";

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=recipes&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Recipe -------------------------------------- //

if (($action == "edit") && ($dbTable == "recipes")) { 

  load_recipe_brewing_common_data(FALSE);
  load_recipe_data();

  $fieldData["brewYeast"]        = GetSQLValueString($_POST['brewYeast'], "scrubbed");
  $fieldData["brewYeastMan"]     = GetSQLValueString($_POST['brewYeastMan'], "scrubbed");
  $fieldData["brewYeastForm"]    = GetSQLValueString($_POST['brewYeastForm'], "text");
  $fieldData["brewYeastType"]    = GetSQLValueString($_POST['brewYeastType'], "text");
  $fieldData["brewYeastAmount"]  = GetSQLValueString($_POST['brewYeastAmount'], "scrubbed");
  $fieldData["brewYeastProfile"] = GetSQLValueString($_POST['brewYeastProfile'], "text");

  $data  = "";
  $count = count($fieldData);
  $i     = 1;

  foreach ($fieldData as $k => $v) {
    $data .= "$k = $v";
    if ($i < $count) {
      $data .= ", ";
    }

    $i++;
  }

  $updateSQL = "UPDATE recipes SET $data WHERE id=" . GetSQLValueString($id, "int");

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=recipes&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Editing brewer Profile -------------------------------------- //

if (($action == "edit") && ($dbTable == "brewer")) {
  $updateSQL = sprintf("UPDATE	brewer SET	brewerFirstName=%s,	brewerLastName=%s,	brewerMiddleName=%s,	brewerPrefix=%s,	brewerSuffix=%s,	brewerAge=%s,	brewerCity=%s,	brewerState=%s,	brewerCountry=%s,	brewerAbout=%s,	brewerLogName=%s,	brewerTagline=%s,	brewerFavStyles=%s,	brewerPrefMethod=%s,	brewerClubs=%s,	brewerOther=%s,	brewerImage=%s WHERE id=1",
                       GetSQLValueString($_POST['brewerFirstName'], "scrubbed"),
                       GetSQLValueString($_POST['brewerLastName'], "scrubbed"),
                       GetSQLValueString($_POST['brewerMiddleName'], "scrubbed"),
                       GetSQLValueString($_POST['brewerPrefix'], "scrubbed"),
                       GetSQLValueString($_POST['brewerSuffix'], "scrubbed"),
                       GetSQLValueString($_POST['brewerAge'], "scrubbed"),
                       GetSQLValueString($_POST['brewerCity'], "scrubbed"),
                       GetSQLValueString($_POST['brewerState'], "scrubbed"),
                       GetSQLValueString($_POST['brewerCountry'], "scrubbed"),
                       GetSQLValueString($_POST['brewerAbout'], "text"),
                       GetSQLValueString($_POST['brewerLogName'], "text"),
                       GetSQLValueString($_POST['brewerTagline'], "scrubbed"),
                       GetSQLValueString($_POST['brewerFavStyles'], "scrubbed"),
                       GetSQLValueString($_POST['brewerPrefMethod'], "text"),
                       GetSQLValueString($_POST['brewerClubs'], "scrubbed"),
                       GetSQLValueString($_POST['brewerOther'], "text"),
					   GetSQLValueString($_POST['brewerImage'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=edit&dbTable=brewer&id=1&confirm=true";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Editing Preferences -------------------------------------- //

if (($action == "edit") && ($dbTable == "preferences")) {
  $updateSQL = sprintf("UPDATE preferences SET 
  measFluid1=%s, 
  measFluid2=%s, 
  measWeight1=%s, 
  measWeight2=%s,
  measWaterGrainRatio=%s, 
  measTemp=%s, 
  measColor=%s, 
  measBitter=%s, 
  measAbbrev=%s, 
  allowReviews=%s, 
  allowPrintLog=%s, 
  allowPrintRecipe=%s, 
  allowPrintXML=%s, 
  allowSpecifics=%s, 
  allowGeneral=%s, 
  allowComments=%s, 
  allowRecipe=%s, 
  allowMash=%s, 
  allowWater=%s, 
  allowProcedure=%s, 
  allowSpecialProcedure=%s, 
  allowFermentation=%s, 
  allowLabel=%s, 
  allowRelated=%s, 
  allowStatus=%s, 
  allowUpcoming=%s, 
  allowAwards=%s, 
  allowCalendar=%s, 
  allowNews=%s, 
  allowProfile=%s, 
  theme=%s, 
  mode=%s, 
  home=%s, 
  menuHome=%s,
  menuBrewBlogs=%s,
  menuRecipes=%s,
  menuAwards=%s,
  menuAbout=%s,
  menuReference=%s,
  menuCalculators=%s,
  menuCalendar=%s,
  menuLogin=%s,
  menuLogout=%s,
  menuMembers=%s,
  mashDisplayMethod=%s,
  waterDisplayMethod=%s,
  hopPelletFactor=%f
  WHERE $dbTable.id='%s'",
                       GetSQLValueString($_POST['measFluid1'], "text"),
                       GetSQLValueString($_POST['measFluid2'], "text"),
                       GetSQLValueString($_POST['measWeight1'], "text"),
                       GetSQLValueString($_POST['measWeight2'], "text"),
		       GetSQLValueString($_POST['measWaterGrainRatio'], "text"),
                       GetSQLValueString($_POST['measTemp'], "text"),
                       GetSQLValueString($_POST['measColor'], "text"),
                       GetSQLValueString($_POST['measBitter'], "text"),
                       GetSQLValueString($_POST['measFluid1'], "text"),
                       GetSQLValueString($_POST['allowReviews'], "text"),
                       GetSQLValueString($_POST['allowPrintLog'], "text"),
                       GetSQLValueString($_POST['allowPrintRecipe'], "text"),
                       GetSQLValueString($_POST['allowPrintXML'], "text"),
                       GetSQLValueString($_POST['allowSpecifics'], "text"),
                       GetSQLValueString($_POST['allowGeneral'], "text"),
                       GetSQLValueString($_POST['allowComments'], "text"),
                       GetSQLValueString($_POST['allowRecipe'], "text"),
                       GetSQLValueString($_POST['allowMash'], "text"),
                       GetSQLValueString($_POST['allowWater'], "text"),
                       GetSQLValueString($_POST['allowProcedure'], "text"),
                       GetSQLValueString($_POST['allowSpecialProcedure'], "text"),
                       GetSQLValueString($_POST['allowFermentation'], "text"),
                       GetSQLValueString($_POST['allowLabel'], "text"),
                       GetSQLValueString($_POST['allowRelated'], "text"),
		       GetSQLValueString($_POST['allowStatus'], "text"),
		       GetSQLValueString($_POST['allowUpcoming'], "text"),
		       GetSQLValueString($_POST['allowAwards'], "text"),
		       GetSQLValueString($_POST['allowCalendar'], "text"),
		       GetSQLValueString($_POST['allowNews'], "text"),
		       GetSQLValueString($_POST['allowProfile'], "text"),
		       GetSQLValueString($_POST['theme'], "text"),
		       GetSQLValueString($_POST['mode'], "text"),
		       GetSQLValueString($_POST['home'], "text"),
		       GetSQLValueString($_POST['menuHome'], "scrubbed"),
		       GetSQLValueString($_POST['menuBrewBlogs'], "scrubbed"),
		       GetSQLValueString($_POST['menuRecipes'], "scrubbed"),
		       GetSQLValueString($_POST['menuAwards'], "scrubbed"),
		       GetSQLValueString($_POST['menuAbout'], "scrubbed"),
		       GetSQLValueString($_POST['menuReference'], "scrubbed"),
		       GetSQLValueString($_POST['menuCalculators'], "scrubbed"),
		       GetSQLValueString($_POST['menuCalendar'], "scrubbed"),
		       GetSQLValueString($_POST['menuLogin'], "scrubbed"),
		       GetSQLValueString($_POST['menuLogout'], "scrubbed"),
		       GetSQLValueString($_POST['menuMembers'], "scrubbed"),
		       GetSQLValueString($_POST['mashDisplayMethod'], "text"),
		       GetSQLValueString($_POST['waterDisplayMethod'], "text"),
		       GetSQLValueString($_POST['pelletFactor'], "float"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());
  //echo $updateSQL;

  $updateGoTo = "index.php?action=edit&dbTable=preferences&id=".$id."&confirm=true";
  header(sprintf("Location: %s", $updateGoTo));

}

// --------------------------- If Adding a Theme ------------------------------ //

if (($action == "add") && ($dbTable == "brewingcss")) {
  $insertSQL = sprintf("INSERT INTO	brewingcss (theme, themeName, themeColor1, themeColor2) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['theme'], "text"),
					   GetSQLValueString($_POST['themeName'], "scrubbed"),
					   GetSQLValueString($_POST['themeColor1'], "text"),
					   GetSQLValueString($_POST['themeColor2'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=brewingcss&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing Theme ------------------------------ //

if (($action == "edit") && ($dbTable == "brewingcss")) {
  $updateSQL = sprintf("UPDATE	brewingcss SET theme=%s, themeName=%s, themeColor1=%s, themeColor2=%s WHERE id=%s",
                       GetSQLValueString($_POST['theme'], "text"),
					   GetSQLValueString($_POST['themeName'], "scrubbed"),
					   GetSQLValueString($_POST['themeColor1'], "text"),
					   GetSQLValueString($_POST['themeColor2'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=brewingcss&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a Link ------------------------------ //

if (($action == "add") && ($dbTable == "brewerlinks")) {
  $insertSQL = sprintf("INSERT INTO	brewerlinks (brewerLinkName,	brewerLinkURL) VALUES (%s, %s)",
                       GetSQLValueString($_POST['brewerLinkName'], "scrubbed"),
                       GetSQLValueString($_POST['brewerLinkURL'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=brewerlinks&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Link ----------------------------- //

if (($action == "edit") && ($dbTable == "brewerlinks")) {
  $updateSQL = sprintf("UPDATE	brewerlinks SET	brewerLinkName=%s,	brewerLinkURL=%s WHERE id=%s",
                       GetSQLValueString($_POST['brewerLinkName'], "scrubbed"),
                       GetSQLValueString($_POST['brewerLinkURL'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=brewerlinks&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a User ------------------------------ //

if (($action == "add") && ($dbTable == "users")) {
   $password                              = md5($_POST['password']);

   $fieldData["user_name"]                = GetSQLValueString($_POST['user_name'], "text");
   $fieldData["password"]                 = GetSQLValueString($password, "text");
   $fieldData["realFirstName"]            = GetSQLValueString($_POST['realFirstName'], "scrubbed");
   $fieldData["realLastName"]             = GetSQLValueString($_POST['realLastName'], "scrubbed");
   $fieldData["userLevel"]                = GetSQLValueString($_POST['userLevel'], "text");
   $fieldData["userProfile"]              = GetSQLValueString($_POST['userProfile'], "text");
   $fieldData["userPicURL"]               = GetSQLValueString($_POST['userPicURL'], "text");
   $fieldData["userFavStyles"]            = GetSQLValueString($_POST['userFavStyles'], "scrubbed");
   $fieldData["userFavCommercial"]        = GetSQLValueString($_POST['userFavCommercial'], "scrubbed");
   $fieldData["userFavQuote"]             = GetSQLValueString($_POST['userFavQuote'], "scrubbed");
   $fieldData["userDesignations"]         = GetSQLValueString($_POST['userDesignations'], "scrubbed");
   $fieldData["userOccupation"]           = GetSQLValueString($_POST['userOccupation'], "scrubbed");
   $fieldData["userHobbies"]              = GetSQLValueString($_POST['userHobbies'], "scrubbed");
   $fieldData["userBirthdate"]            = GetSQLValueString($_POST['userBirthdate'], "text");
   $fieldData["userHometown"]             = GetSQLValueString($_POST['userHometown'], "scrubbed");
   $fieldData["userBrewingSince"]         = GetSQLValueString($_POST['userBrewingSince'], "scrubbed");
   $fieldData["userWebsiteName"]          = GetSQLValueString($_POST['userWebsiteName'], "scrubbed");
   $fieldData["userWebsiteURL"]           = GetSQLValueString($_POST['userWebsiteURL'], "text");
   $fieldData["userPosition"]             = GetSQLValueString($_POST['userPosition'], "scrubbed");
   $fieldData["userPastPosition"]         = GetSQLValueString($_POST['userPastPosition'], "scrubbed");
   $fieldData["userInfoPrivate"]          = GetSQLValueString($_POST['userInfoPrivate'], "text");
   $fieldData["userAddress"]              = GetSQLValueString($_POST['userAddress'], "scrubbed");
   $fieldData["userCity"]                 = GetSQLValueString($_POST['userCity'], "scrubbed");
   $fieldData["userState"]                = GetSQLValueString($_POST['userState'], "scrubbed");
   $fieldData["userZip"]                  = GetSQLValueString($_POST['userZip'], "text");
   $fieldData["userPhoneH"]               = GetSQLValueString($_POST['userPhoneH'], "text");
   $fieldData["userPhoneW"]               = GetSQLValueString($_POST['userPhoneW'], "text");
   $fieldData["userEmail"]                = GetSQLValueString($_POST['userEmail'], "text");
   $fieldData["defaultBoilTime"]          = GetSQLValueString($_POST['defaultBoilTime'], "text");
   $fieldData["defaultEquipProfile"]      = GetSQLValueString($_POST['defaultEquipProfile'], "text");
   $fieldData["defaultMashProfile"]       = GetSQLValueString($_POST['defaultMashProfile'], "text");
   $fieldData["defaultWaterProfile"]      = GetSQLValueString($_POST['defaultWaterProfile'], "text");
   $fieldData["defaultBitternessFormula"] = GetSQLValueString($_POST['defaultBitternessFormula'], "text");
   $fieldData["defaultMethod"]            = GetSQLValueString($_POST['defaultMethod'], "text");
   $fieldData["defaultBatchSize"]         = GetSQLValueString($_POST['defaultBatchSize'], "text");
   $fieldData["defaultWaterRatio"]        = GetSQLValueString($_POST['defaultWaterRatio'], "text");
   $fieldData["defaultColorFormula"]      = GetSQLValueString($_POST['defaultColorFormula'], "text");

   $columns = array();
   $data    = array();

   foreach ($fieldData as $k => $v) {
     $columns[] = $k;
     if ($v != "") {
       $data[] = $v;
     } else {
       $data[] = "NULL";
     }
   }
   $cols = implode(",", $columns);
   $vals = implode(",", $data);

   $insertSQL = "INSERT INTO users ($cols) VALUES ($vals)";

   mysql_select_db($database_brewing, $brewing);
   $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

   $insertGoTo = "index.php?action=list&dbTable=users&confirm=true&msg=1";
   header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a User ----------------------------- //

if (($action == "edit") && ($dbTable == "users") && ($section == "password")) {
  $admin = $_POST['admin'];
  mysql_select_db($database_brewing, $brewing);
  $query_user5 = sprintf("SELECT user_name,password FROM users WHERE id = '%s'", $id);
  $user5 = mysql_query($query_user5, $brewing) or die(mysql_error());
  $row_user5 = mysql_fetch_assoc($user5);
  $totalRows_user5 = mysql_num_rows($user5);

  $password = md5($_POST['password']);
  if (($reset == "default") && ($admin == "nonpriv")) { 
    $passwordOld = md5($_POST['passwordOld']); $confirmPass = $row_user5['password']; 
    if ($confirmPass != $passwordOld) {
      header ("Location: index.php?action=edit&dbTable=users&id=".$id."&confirm=false&section=password&msg=2");
    }
  }
  if (($confirmPass == $passwordOld) || ($reset == "true") || ($admin == "admin")) {
    $updateSQL = sprintf("UPDATE users SET password=%s WHERE id=%s",
			 GetSQLValueString($password, "text"),
			 GetSQLValueString($id, "int")); 
					   
    mysql_select_db($database_brewing, $brewing);
    $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

    $updateGoTo = "index.php?action=list&dbTable=users&confirm=true&section=password&msg=2";
    if ($admin == "admin") $updateGoTo .= "&filter=".$row_user5['user_name']."&assoc=".$_POST['password']; {
      header(sprintf("Location: %s", $updateGoTo));
    }
  }
}

if (($action == "edit") && ($dbTable == "users") && ($section == "default")) {

  $fieldData["user_name"]                = GetSQLValueString($_POST['user_name'], "text");
  $fieldData["realFirstName"]            = GetSQLValueString($_POST['realFirstName'], "scrubbed");
  $fieldData["realLastName"]             = GetSQLValueString($_POST['realLastName'], "scrubbed");
  $fieldData["userLevel"]                = GetSQLValueString($_POST['userLevel'], "text");
  $fieldData["userProfile"]              = GetSQLValueString($_POST['userProfile'], "text");
  $filedData["userPicURL"]               = GetSQLValueString($_POST['userPicURL'], "text");
  $fieldData["userFavStyles"]            = GetSQLValueString($_POST['userFavStyles'], "scrubbed");
  $fieldData["userFavCommercial"]        = GetSQLValueString($_POST['userFavCommercial'], "scrubbed");
  $fieldData["userFavQuote"]             = GetSQLValueString($_POST['userFavQuote'], "scrubbed");
  $fieldData["userDesignations"]         = GetSQLValueString($_POST['userDesignations'], "scrubbed");
  $fieldData["userOccupation"]           = GetSQLValueString($_POST['userOccupation'], "scrubbed");
  $fieldData["userHobbies"]              = GetSQLValueString($_POST['userHobbies'], "scrubbed");
  $fieldData["userBirthdate"]            = GetSQLValueString($_POST['userBirthdate'], "text");
  $fieldData["userHometown"]             = GetSQLValueString($_POST['userHometown'], "scrubbed");
  $fieldData["userBrewingSince"]         = GetSQLValueString($_POST['userBrewingSince'], "scrubbed");
  $fieldData["userWebsiteName"]          = GetSQLValueString($_POST['userWebsiteName'], "scrubbed");
  $fieldData["userWebsiteURL"]           = GetSQLValueString($_POST['userWebsiteURL'], "text");
  $fieldData["userPosition"]             = GetSQLValueString($_POST['userPosition'], "scrubbed");
  $fieldData["userPastPosition"]         = GetSQLValueString($_POST['userPastPosition'], "scrubbed");
  $fieldData["userInfoPrivate"]          = GetSQLValueString($_POST['userInfoPrivate'], "text");
  $fieldData["userAddress"]              = GetSQLValueString($_POST['userAddress'], "scrubbed");
  $fieldData["userCity"]                 = GetSQLValueString($_POST['userCity'], "scrubbed");
  $fieldData["userState"]                = GetSQLValueString($_POST['userState'], "scrubbed");
  $fieldData["userZip"]                  = GetSQLValueString($_POST['userZip'], "text");
  $fieldData["userPhoneH"]               = GetSQLValueString($_POST['userPhoneH'], "text");
  $fieldData["userPhoneW"]               = GetSQLValueString($_POST['userPhoneW'], "text");
  $fieldData["userEmail"]                = GetSQLValueString($_POST['userEmail'], "text");
  $fieldData["defaultBoilTime"]          = GetSQLValueString($_POST['defaultBoilTime'], "text");
  $fieldData["defaultEquipProfile"]      = GetSQLValueString($_POST['defaultEquipProfile'], "text");
  $fieldData["defaultMashProfile"]       = GetSQLValueString($_POST['defaultMashProfile'], "text");
  $fieldData["defaultWaterProfile"]      = GetSQLValueString($_POST['defaultWaterProfile'], "text");
  $fieldData["defaultBitternessFormula"] = GetSQLValueString($_POST['defaultBitternessFormula'], "text");
  $fieldData["defaultMethod"]            = GetSQLValueString($_POST['defaultMethod'], "text");
  $fieldData["defaultBatchSize"]         = GetSQLValueString($_POST['defaultBatchSize'], "text");
  $fieldData["defaultWaterRatio"]        = GetSQLValueString($_POST['defaultWaterRatio'], "text");
  $fieldData["defaultColorFormula"]      = GetSQLValueString($_POST['defaultColorFormula'], "text");

  $data  = "";
  $count = count($fieldData);
  $i     = 1;

  foreach ($fieldData as $k => $v) {
    $data .= "$k = $v";
    if ($i < $count) {
      $data .= ", ";
    }

    $i++;
  }

  $updateSQL = "UPDATE users SET $data WHERE id=" . GetSQLValueString($id, "int");
  
  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=users&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

 //--------------------------- If Adding an Upcoming	brew -------------------- //

if (($action == "add") && ($dbTable == "upcoming")) {
  $insertSQL = sprintf("INSERT INTO upcoming (upcoming, upcomingDate, upcomingRecipeID,	brewBrewerID) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['upcoming'], "scrubbed"),
                       GetSQLValueString($_POST['upcomingDate'], "text"),
					   GetSQLValueString($_POST['upcomingRecipeID'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=upcoming&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing an Upcoming	brew ------------------- //

if (($action == "edit") && ($dbTable == "upcoming")) {
  $updateSQL = sprintf("UPDATE upcoming SET upcoming=%s, upcomingDate=%s, upcomingRecipeID=%s,	brewBrewerID=%s WHERE id=%s",
                       GetSQLValueString($_POST['upcoming'], "scrubbed"),
                       GetSQLValueString($_POST['upcomingDate'], "text"),
					   GetSQLValueString($_POST['upcomingRecipeID'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=upcoming&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a Review --------------------------- //

if (($action == "add") && ($dbTable == "reviews")) {
$insertSQL = sprintf("INSERT INTO reviews (brewID,	brewScoreDate,	brewAromaScore,	brewAromaInfo,	brewAppearanceScore,	brewAppearanceInfo,	brewFlavorScore,	brewFlavorInfo,	brewMouthfeelScore,	brewMouthfeelInfo,	brewOverallScore,	brewOverallInfo,	brewScorerLevel,	brewScoredBy) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['brewID'], "int"),
                       GetSQLValueString($_POST['brewScoreDate'], "date"),
                       GetSQLValueString($_POST['brewAromaScore'], "int"),
                       GetSQLValueString($_POST['brewAromaInfo'], "scrubbed"),
                       GetSQLValueString($_POST['brewAppearanceScore'], "int"),
                       GetSQLValueString($_POST['brewAppearanceInfo'], "scrubbed"),
                       GetSQLValueString($_POST['brewFlavorScore'], "int"),
                       GetSQLValueString($_POST['brewFlavorInfo'], "scrubbed"),
                       GetSQLValueString($_POST['brewMouthfeelScore'], "int"),
                       GetSQLValueString($_POST['brewMouthfeelInfo'], "scrubbed"),
                       GetSQLValueString($_POST['brewOverallScore'], "int"),
                       GetSQLValueString($_POST['brewOverallInfo'], "scrubbed"),
					   GetSQLValueString($_POST['brewScorerLevel'], "text"),
                       GetSQLValueString($_POST['brewScoredBy'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=reviews&confirm=true&msg=1".$URL_append;
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Review --------------------------- //

if (($action == "edit") && ($dbTable == "reviews")) {
  $updateSQL = sprintf("UPDATE reviews SET	brewID=%s,	brewScoreDate=%s,	brewAromaScore=%s,	brewAromaInfo=%s,	brewAppearanceScore=%s,	brewAppearanceInfo=%s,	brewFlavorScore=%s,	brewFlavorInfo=%s,
 	brewMouthfeelScore=%s,	brewMouthfeelInfo=%s,	brewOverallScore=%s,	brewOverallInfo=%s,	brewScoredBy=%s,	brewScorerLevel=%s WHERE id=%s",
                       GetSQLValueString($_POST['brewID'], "int"),
                       GetSQLValueString($_POST['brewScoreDate'], "date"),
                       GetSQLValueString($_POST['brewAromaScore'], "int"),
                       GetSQLValueString($_POST['brewAromaInfo'], "text"),
                       GetSQLValueString($_POST['brewAppearanceScore'], "int"),
                       GetSQLValueString($_POST['brewAppearanceInfo'], "text"),
                       GetSQLValueString($_POST['brewFlavorScore'], "int"),
                       GetSQLValueString($_POST['brewFlavorInfo'], "text"),
                       GetSQLValueString($_POST['brewMouthfeelScore'], "int"),
                       GetSQLValueString($_POST['brewMouthfeelInfo'], "text"),
                       GetSQLValueString($_POST['brewOverallScore'], "int"),
                       GetSQLValueString($_POST['brewOverallInfo'], "text"),
                       GetSQLValueString($_POST['brewScoredBy'], "text"),
					   GetSQLValueString($_POST['brewScorerLevel'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=reviews&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a Style --------------------------- //

if (($action == "add") && ($dbTable == "styles")) {
  $insertSQL = sprintf("INSERT INTO styles (brewStyleNum,	brewStyle,	brewStyleOG,	brewStyleOGMax,	brewStyleFG,	brewStyleFGMax,	brewStyleABV,	brewStyleABVMax,	brewStyleIBU,	brewStyleIBUMax,	brewStyleSRM,	brewStyleSRMMax,	brewStyleType,	brewStyleInfo,	brewStyleLink,	brewStyleGroup) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['brewStyleNum'], "text"),
                       GetSQLValueString($_POST['brewStyle'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyleOG'], "text"),
                       GetSQLValueString($_POST['brewStyleOGMax'], "text"),
                       GetSQLValueString($_POST['brewStyleFG'], "text"),
                       GetSQLValueString($_POST['brewStyleFGMax'], "text"),
                       GetSQLValueString($_POST['brewStyleABV'], "text"),
                       GetSQLValueString($_POST['brewStyleABVMax'], "text"),
                       GetSQLValueString($_POST['brewStyleIBU'], "text"),
                       GetSQLValueString($_POST['brewStyleIBUMax'], "text"),
                       GetSQLValueString($_POST['brewStyleSRM'], "text"),
                       GetSQLValueString($_POST['brewStyleSRMMax'], "text"),
                       GetSQLValueString($_POST['brewStyleType'], "text"),
                       GetSQLValueString($_POST['brewStyleInfo'], "text"),
                       GetSQLValueString($_POST['brewStyleLink'], "text"),
                       GetSQLValueString($_POST['brewStyleGroup'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=styles&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));

}


// --------------------------- If Editing a Style --------------------------- //

if (($action == "edit") && ($dbTable == "styles")) {
  $updateSQL = sprintf("UPDATE styles SET	brewStyleNum=%s,	brewStyle=%s,	brewStyleOG=%s,	brewStyleOGMax=%s,	brewStyleFG=%s,	brewStyleFGMax=%s,	brewStyleABV=%s,	brewStyleABVMax=%s,	brewStyleIBU=%s,	brewStyleIBUMax=%s,	brewStyleSRM=%s,	brewStyleSRMMax=%s,	brewStyleType=%s,	brewStyleInfo=%s,	brewStyleLink=%s,	brewStyleGroup=%s WHERE id=%s",
                       GetSQLValueString($_POST['brewStyleNum'], "text"),
                       GetSQLValueString($_POST['brewStyle'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyleOG'], "text"),
                       GetSQLValueString($_POST['brewStyleOGMax'], "text"),
                       GetSQLValueString($_POST['brewStyleFG'], "text"),
                       GetSQLValueString($_POST['brewStyleFGMax'], "text"),
                       GetSQLValueString($_POST['brewStyleABV'], "text"),
                       GetSQLValueString($_POST['brewStyleABVMax'], "text"),
                       GetSQLValueString($_POST['brewStyleIBU'], "text"),
                       GetSQLValueString($_POST['brewStyleIBUMax'], "text"),
                       GetSQLValueString($_POST['brewStyleSRM'], "text"),
                       GetSQLValueString($_POST['brewStyleSRMMax'], "text"),
                       GetSQLValueString($_POST['brewStyleType'], "text"),
                       GetSQLValueString($_POST['brewStyleInfo'], "text"),
                       GetSQLValueString($_POST['brewStyleLink'], "text"),
                       GetSQLValueString($_POST['brewStyleGroup'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=styles&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}


// --------------------------- If Adding a Hop --------------------------- //

if (($action == "add") && ($dbTable == "hops")) {
  $insertSQL = sprintf("INSERT INTO hops (hopsName, hopsGrown, hopsInfo, hopsUse, hopsExample, hopsAAULow, hopsAAUHigh, hopsSub) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hopsName'], "scrubbed"),
                       GetSQLValueString($_POST['hopsGrown'], "scrubbed"),
                       GetSQLValueString($_POST['hopsInfo'], "text"),
                       GetSQLValueString($_POST['hopsUse'], "scrubbed"),
                       GetSQLValueString($_POST['hopsExample'], "scrubbed"),
                       GetSQLValueString($_POST['hopsAAULow'], "int"),
                       GetSQLValueString($_POST['hopsAAUHigh'], "int"),
                       GetSQLValueString($_POST['hopsSub'], "scrubbed"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=hops";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Hop --------------------------- //

if (($action == "edit") && ($dbTable == "hops")) {
  $updateSQL = sprintf("UPDATE hops SET hopsName=%s, hopsGrown=%s, hopsInfo=%s, hopsUse=%s, hopsExample=%s, hopsAAULow=%s, hopsAAUHigh=%s, hopsSub=%s WHERE id=%s",
                       GetSQLValueString($_POST['hopsName'], "scrubbed"),
                       GetSQLValueString($_POST['hopsGrown'], "scrubbed"),
                       GetSQLValueString($_POST['hopsInfo'], "text"),
                       GetSQLValueString($_POST['hopsUse'], "text"),
                       GetSQLValueString($_POST['hopsExample'], "scrubbed"),
                       GetSQLValueString($_POST['hopsAAULow'], "int"),
                       GetSQLValueString($_POST['hopsAAUHigh'], "int"),
                       GetSQLValueString($_POST['hopsSub'], "scrubbed"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=hops";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a Grain --------------------------- //

if (($action == "add") && ($dbTable == "malt")) {
  //$insertSQL = sprintf("INSERT INTO malt (maltName, maltLovibond, maltInfo, maltYield, maltOrigin, maltSupplier) VALUES (%s, %s, %s, %s, %s, %s)",
  $fieldData['maltName']         = GetSQLValueString($_POST['maltName'], "scrubbed");
  $fieldData['maltLovibondLow']  = GetSQLValueString($_POST['maltLovibondLow'], "text");
  $fieldData['maltLovibondHigh'] = GetSQLValueString($_POST['maltLovibondHigh'], "text");
  $fieldData['maltInfo']         = GetSQLValueString($_POST['maltInfo'], "text");
  $fieldData['maltPPG']          = GetSQLValueString($_POST['maltPPG'], "text");
  $fieldData['maltOrigin']       = GetSQLValueString($_POST['maltOrigin'], "scrubbed");
  $fieldData['maltSupplier']     = GetSQLValueString($_POST['maltSupplier'], "scrubbed");

  $columns = array();
  $data    = array();

  foreach ($fieldData as $k => $v) {
    $columns[] = $k;
    if ($v != "") {
      $data[] = $v;
    } else {
      $data[] = "NULL";
    }
  }
  $cols = implode(",", $columns);
  $vals = implode(",", $data);

  $insertSQL = "INSERT INTO malt ($cols) VALUES ($vals)";

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=malt&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Grain --------------------------- //

if (($action == "edit") && ($dbTable == "malt")) {
  $update  = "maltName = " . GetSQLValueString($_POST['maltName'], "scrubbed") . ", ";
  $update .= "maltLovibondLow = " . GetSQLValueString($_POST['maltLovibondLow'], "text") . ", ";
  $update .= "maltLovibondHigh = " . GetSQLValueString($_POST['maltLovibondHigh'], "text") . ", ";
  $update .= "maltInfo = " . GetSQLValueString($_POST['maltInfo'], "text") . ", ";
  $update .= "maltPPG = " . GetSQLValueString($_POST['maltPPG'], "text") . ", ";
  $update .= "maltOrigin = " . GetSQLValueString($_POST['maltOrigin'], "scrubbed") . ", ";
  $update .= "maltSupplier = " . GetSQLValueString($_POST['maltSupplier'], "scrubbed");

  $updateSQL = "UPDATE malt SET $update WHERE id = " . GetSQLValueString($id, "int");

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=malt&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding an Adjunct --------------------------- //

if (($action == "add") && ($dbTable == "adjuncts")) {
  //$insertSQL = sprintf("INSERT INTO adjuncts (adjunctName, adjunctLovibond, adjunctInfo, adjunctYield, adjunctType, adjunctOrigin, adjunctSupplier) VALUES (%s, %s, %s, %s, %s, %s, %s)",

  $fieldData['adjunctName']         = GetSQLValueString($_POST['adjunctName'], "scrubbed");
  $fieldData['adjunctLovibondLow']  = GetSQLValueString($_POST['adjunctLovibondLow'], "text");
  $fieldData['adjunctLovibondHigh'] = GetSQLValueString($_POST['adjunctLovibondHigh'], "text");
  $fieldData['adjunctInfo']         = GetSQLValueString($_POST['adjunctInfo'], "text");
  $fieldData['adjunctPPG']          = GetSQLValueString($_POST['adjunctPPG'], "text");
  $fieldData['adjunctOrigin']       = GetSQLValueString($_POST['adjunctOrigin'], "scrubbed");
  $fieldData['adjunctSupplier']     = GetSQLValueString($_POST['adjunctSupplier'], "scrubbed");

  $columns = array();
  $data    = array();

  foreach ($fieldData as $k => $v) {
    $columns[] = $k;
    if ($v != "") {
      $data[] = $v;
    } else {
      $data[] = "NULL";
    }
  }
  $cols = implode(",", $columns);
  $vals = implode(",", $data);

  $insertSQL = "INSERT INTO adjuncts ($cols) VALUES ($vals)";

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=adjuncts&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing an Adjunct --------------------------- //

if (($action == "edit") && ($dbTable == "adjuncts")) {
  $update  = "adjunctName = " . GetSQLValueString($_POST['adjunctName'], "scrubbed") . ", ";
  $update .= "adjunctLovibondLow = " . GetSQLValueString($_POST['adjunctLovibondLow'], "text") . ", ";
  $update .= "adjunctLovibondHigh = " . GetSQLValueString($_POST['adjunctLovibondHigh'], "text") . ", ";
  $update .= "adjunctInfo = " . GetSQLValueString($_POST['adjunctInfo'], "text") . ", ";
  $update .= "adjunctPPG = " . GetSQLValueString($_POST['adjunctPPG'], "text") . ", ";
  $update .= "adjunctOrigin = " . GetSQLValueString($_POST['adjunctOrigin'], "scrubbed") . ", ";
  $update .= "adjunctSupplier = " . GetSQLValueString($_POST['adjunctSupplier'], "scrubbed");

  $updateSQL = "UPDATE adjuncts SET $update WHERE id = " . GetSQLValueString($id, "int");

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=adjuncts&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding an Extract --------------------------- //

if (($action == "add") && ($dbTable == "extract")) {
  $fieldData['extractName']         = GetSQLValueString($_POST['extractName'], "scrubbed");
  $fieldData['extractLovibondLow']  = GetSQLValueString($_POST['extractLovibondLow'], "text");
  $fieldData['extractLovibondHigh'] = GetSQLValueString($_POST['extractLovibondHigh'], "text");
  $fieldData['extractInfo']         = GetSQLValueString($_POST['extractInfo'], "text");
  $fieldData['extractPPG']          = GetSQLValueString($_POST['extractPPG'], "text");
  $fieldData['extractOrigin']       = GetSQLValueString($_POST['extractOrigin'], "scrubbed");
  $fieldData['extractSupplier']     = GetSQLValueString($_POST['extractSupplier'], "scrubbed");
  $fieldData['extractLME']          = GetSQLValueString($_POST['extractLME'], "text");

  $columns = array();
  $data    = array();

  foreach ($fieldData as $k => $v) {
    $columns[] = $k;
    if ($v != "") {
      $data[] = $v;
    } else {
      $data[] = "NULL";
    }
  }
  $cols = implode(",", $columns);
  $vals = implode(",", $data);

  $insertSQL = "INSERT INTO extract ($cols) VALUES ($vals)";

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=extract&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing an Extract --------------------------- //

if (($action == "edit") && ($dbTable == "extract")) {
  $update = "extractName = " . GetSQLValueString($_POST['extractName'], "scrubbed") . ", ";
  $update .= "extractLovibondLow = " . GetSQLValueString($_POST['extractLovibondLow'], "text") . ", ";
  $update .= "extractLovibondHigh = " . GetSQLValueString($_POST['extractLovibondHigh'], "text") . ", ";
  $update .= "extractInfo = " . GetSQLValueString($_POST['extractInfo'], "text") . ", ";
  $update .= "extractPPG = " . GetSQLValueString($_POST['extractPPG'], "text") . ", ";
  $update .= "extractOrigin = " . GetSQLValueString($_POST['extractOrigin'], "scrubbed") . ", ";
  $update .= "extractSupplier = " . GetSQLValueString($_POST['extractSupplier'], "scrubbed") . ", ";
  $update .= "extractLME = ". GetSQLValueString($_POST['extractLME'], "text");

  $updateSQL = "UPDATE extract SET $update WHERE id = " . GetSQLValueString($id, "int");

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=extract&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding an Award --------------------------- //

if (($action == "add") && ($dbTable == "awards")) {
  	$query_log = sprintf("SELECT id,brewName FROM %s WHERE id = '%s'", $assoc, $_POST['awardBrewID']);
	$log = mysql_query($query_log, $brewing) or die(mysql_error());
	$row_log = mysql_fetch_assoc($log);
	//echo $query_log."<br>";
	if ($assoc == "brewing") $append = "b"; else $append = "r";
  $insertSQL = sprintf("INSERT INTO awards (awardBrewID, awardContest, awardContestURL, awardDate, awardStyle, awardPlace,	brewBrewerID, awardBrewName) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($append.$_POST['awardBrewID'], "text"),
                       GetSQLValueString($_POST['awardContest'], "scrubbed"),
                       GetSQLValueString($_POST['awardContestURL'], "text"),
					   GetSQLValueString($_POST['awardDate'], "text"),
					   GetSQLValueString($_POST['awardStyle'], "text"),
					   GetSQLValueString($_POST['awardPlace'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($_POST['awardBrewName'], "scrubbed"));

  //echo $insertSQL;
  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());
  $insertGoTo = "index.php?action=list&dbTable=awards&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing an Award --------------------------- //

if (($action == "edit") && ($dbTable == "awards")) {
  $updateSQL = sprintf("UPDATE awards SET awardBrewID=%s, awardContest=%s, awardContestURL=%s, awardDate=%s, awardStyle=%s, awardPlace=%s,	brewBrewerID=%s, awardBrewName=%s WHERE id=%s",
                       GetSQLValueString($_POST['awardBrewID'], "text"),
                       GetSQLValueString($_POST['awardContest'], "scrubbed"),
                       GetSQLValueString($_POST['awardContestURL'], "text"),
					   GetSQLValueString($_POST['awardDate'], "text"),
					   GetSQLValueString($_POST['awardStyle'], "text"),
					   GetSQLValueString($_POST['awardPlace'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($_POST['awardBrewName'], "scrubbed"),
					   GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=awards&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding News --------------------------- //

if (($action == "add") && ($dbTable == "news")) {
  $insertSQL = sprintf("INSERT INTO news (newsHeadline, newsText, newsDate, newsPrivate, newsPoster) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['newsHeadline'], "scrubbed"),
                       GetSQLValueString($_POST['newsText'], "text"),
                       GetSQLValueString($_POST['newsDate'], "text"),
					   GetSQLValueString($_POST['newsPrivate'], "text"),
					   GetSQLValueString($_POST['newsPoster'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=news&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing news --------------------------- //

if (($action == "edit") && ($dbTable == "news")) {
  $updateSQL = sprintf("UPDATE news 
  SET 
  newsHeadline=%s, 
  newsText=%s, 
  newsDate=%s, 
  newsPrivate=%s, 
  newsPoster=%s 
  WHERE id=%s",
                       GetSQLValueString($_POST['newsHeadline'], "scrubbed"),
                       GetSQLValueString($_POST['newsText'], "text"),
                       GetSQLValueString($_POST['newsDate'], "text"),
					   GetSQLValueString($_POST['newsPrivate'], "text"),
					   GetSQLValueString($_POST['newsPoster'], "text"),
					   GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=news&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Editing From Public --------------------------- //

if (($action == "editPub") && ($dbTable == "brewing") && ($section == "public")) {
$updateSQL = sprintf("UPDATE	brewing 
SET 
brewName=%s, 
brewStatus=%s, 
brewBatchNum=%s, 
brewDate=%s,
brewTapDate=%s, 
brewOG=%s, 
brewGravity1=%s, 
brewGravity1Days=%s, 
brewGravity2=%s, 
brewGravity2Days=%s, 
brewFG=%s,
brewTargetOG=%s,
brewTargetFG=%s,
brewFeatured=%s
WHERE id=%s",
						GetSQLValueString($_POST['brewName'], "scrubbed"), 
						GetSQLValueString($_POST['brewStatus'], "text"),
						GetSQLValueString($_POST['brewBatchNum'], "text"),
						GetSQLValueString($_POST['brewDate'], "text"),
						GetSQLValueString($_POST['brewTapDate'], "text"),
						GetSQLValueString($_POST['brewOG'], "text"),
						GetSQLValueString($_POST['brewGravity1'], "text"),
						GetSQLValueString($_POST['brewGravity1Days'], "text"),
						GetSQLValueString($_POST['brewGravity2'], "text"),
						GetSQLValueString($_POST['brewGravity2Days'], "text"),
                       	GetSQLValueString($_POST['brewFG'], "text"),
						GetSQLValueString($_POST['brewTargetOG'], "text"),
						GetSQLValueString($_POST['brewTargetFG'], "text"),
						GetSQLValueString($_POST['brewFeatured'], "text"),
					   	GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "../index.php?page=brewBlogDetail&filter=".$filter."&id=".$id;
  header(sprintf("Location: %s", $updateGoTo));
}

if (($action == "editPub") && ($dbTable == "recipes") && ($section == "public")) {
$updateSQL = sprintf("UPDATE recipes SET	brewName=%s,	brewOG=%s,	brewFG=%s,	brewFeatured=%s WHERE id=%s",
						GetSQLValueString($_POST['brewName'], "scrubbed"), 
						GetSQLValueString($_POST['brewOG'], "text"),
                       	GetSQLValueString($_POST['brewFG'], "text"),
						GetSQLValueString($_POST['brewFeatured'], "text"),
					   	GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "../index.php?page=recipeDetail&filter=".$filter."&id=".$id;
  header(sprintf("Location: %s", $updateGoTo));
}


// --------------------------- If Adding a Yeast Profile --------------------------- //
if ($dbTable == "yeast_profiles") {

if (($row_pref['measTemp'] == "C") && ($_POST['yeastMinTemp'] != "")) $yeastMinTemp = round((($_POST['yeastMinTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard) 
else $yeastMinTemp  = $_POST['yeastMinTemp'];
if (($row_pref['measTemp'] == "C") && ($_POST['yeastMaxTemp'] != "")) $yeastMaxTemp = round((($_POST['yeastMaxTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard)
else $yeastMaxTemp  = $_POST['yeastMaxTemp'];


if ((($action == "add")|($action == "reuse")) && ($dbTable == "yeast_profiles")) {

  $insertSQL = sprintf("INSERT INTO yeast_profiles (
  yeastName,
  yeastFloc,
  yeastAtten,
  yeastTolerance,
  yeastType,
  yeastForm,
  yeastAmount,
  yeastLab,
  yeastProdID,
  yeastMinTemp,
  yeastMaxTemp,
  yeastNotes,
  yeastBestFor,
  yeastMaxReuse,
  yeastBrewerID
  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['yeastName'], "scrubbed"),
                       GetSQLValueString($_POST['yeastFloc'], "text"),
                       GetSQLValueString($_POST['yeastAtten'], "text"),
                       GetSQLValueString($_POST['yeastTolerance'], "text"),
                       GetSQLValueString($_POST['yeastType'], "text"),
                       GetSQLValueString($_POST['yeastForm'], "text"),
                       GetSQLValueString($_POST['yeastAmount'], "text"),
                       GetSQLValueString($_POST['yeastLab'], "scrubbed"),
                       GetSQLValueString($_POST['yeastProdID'], "scrubbed"),
                       GetSQLValueString($yeastMinTemp, "text"),
                       GetSQLValueString($yeastMaxTemp, "text"),                      
					   GetSQLValueString($_POST['yeastNotes'], "text"),
                       GetSQLValueString($_POST['yeastBestFor'], "scrubbed"),
                       GetSQLValueString($_POST['yeastMaxReuse'], "scrubbed"),	
					   GetSQLValueString($_POST['yeastBrewerID'], "text")			   
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Yeast Profile --------------------------- //

if (($action == "edit") && ($dbTable == "yeast_profiles")) {
  $updateSQL = sprintf("UPDATE yeast_profiles 
  SET
  yeastName=%s,
  yeastFloc=%s,
  yeastAtten=%s,
  yeastTolerance=%s,
  yeastType=%s,
  yeastForm=%s,
  yeastAmount=%s,
  yeastLab=%s,
  yeastProdID=%s,
  yeastMinTemp=%s,
  yeastMaxTemp=%s,
  yeastNotes=%s,
  yeastBestFor=%s,
  yeastMaxReuse=%s,
  yeastBrewerID=%s
  WHERE id='%s'",
                       GetSQLValueString($_POST['yeastName'], "scrubbed"),
                       GetSQLValueString($_POST['yeastFloc'], "text"),
                       GetSQLValueString($_POST['yeastAtten'], "text"),
                       GetSQLValueString($_POST['yeastTolerance'], "text"),
                       GetSQLValueString($_POST['yeastType'], "text"),
                       GetSQLValueString($_POST['yeastForm'], "text"),
                       GetSQLValueString($_POST['yeastAmount'], "text"),
                       GetSQLValueString($_POST['yeastLab'], "scrubbed"),
                       GetSQLValueString($_POST['yeastProdID'], "scrubbed"),
                       GetSQLValueString($yeastMinTemp, "text"),
                       GetSQLValueString($yeastMaxTemp, "text"),                      
					   GetSQLValueString($_POST['yeastNotes'], "text"),
                       GetSQLValueString($_POST['yeastBestFor'], "scrubbed"),
                       GetSQLValueString($_POST['yeastMaxReuse'], "scrubbed"),
					   GetSQLValueString($_POST['yeastBrewerID'], "text"),	
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

} // end if ($dbTable == "yeast_profiles")

// --------------------------- If Adding a Mash Profile --------------------------- //
if ($dbTable == "mash_profiles") {
if (($row_pref['measTemp'] == "C") && ($_POST['mashGrainTemp'] != "")) $mashGrainTemp = round((($_POST['mashGrainTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard) 
else $mashGrainTemp = $_POST['mashGrainTemp'];
if (($row_pref['measTemp'] == "C") && ($_POST['mashTunTemp'] != "")) $mashTunTemp = round((($_POST['mashTunTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard) 
else $mashTunTemp = $_POST['mashTunTemp'];
if (($row_pref['measTemp'] == "C") && ($_POST['mashSpargeTemp'] != "")) $mashSpargeTemp = round((($_POST['mashSpargeTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard)
else $mashSpargeTemp = $_POST['mashSpargeTemp'];

if ((($action == "add") || ($action == "reuse")) && ($dbTable == "mash_profiles")) {

  $insertSQL = sprintf("INSERT INTO mash_profiles (
  mashProfileName,
  mashGrainTemp,
  mashTunTemp,
  mashSpargeTemp,
  mashPH,
  mashEquipAdj,
  mashNotes,
  mashBrewerID
  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['mashProfileName'], "scrubbed"),
                       GetSQLValueString($mashGrainTemp, "text"),
                       GetSQLValueString($mashTunTemp, "text"),
                       GetSQLValueString($mashSpargeTemp, "text"),
                       GetSQLValueString($_POST['mashPH'], "text"),
                       GetSQLValueString($_POST['mashEquipAdj'], "text"),
                       GetSQLValueString($_POST['mashNotes'], "text"),
					   GetSQLValueString($_POST['mashBrewerID'], "text")				   
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Mash Profile --------------------------- //

if (($action == "edit") && ($dbTable == "mash_profiles")) {
  $updateSQL = sprintf("UPDATE mash_profiles 
  SET
  mashProfileName=%s,
  mashGrainTemp=%s,
  mashTunTemp=%s,
  mashSpargeTemp=%s,
  mashPH=%s,
  mashEquipAdj=%s,
  mashNotes=%s,
  mashBrewerID=%s
  WHERE id='%s'",
                       GetSQLValueString($_POST['mashProfileName'], "scrubbed"),
                       GetSQLValueString($mashGrainTemp, "text"),
                       GetSQLValueString($mashTunTemp, "text"),
                       GetSQLValueString($mashSpargeTemp, "text"),
                       GetSQLValueString($_POST['mashPH'], "text"),
                       GetSQLValueString($_POST['mashEquipAdj'], "text"),
                       GetSQLValueString($_POST['mashNotes'], "text"),
					   GetSQLValueString($_POST['mashBrewerID'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

} // end if ($dbTable == "mash_profiles")

// --------------------------- If Adding a Mash Step --------------------------- //
if ($dbTable == "mash_steps") {
if (($row_pref['measTemp'] == "C") && ($_POST['stepTemp'] != "")) $stepTemp = round((($_POST['stepTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard) 
else $stepTemp = $_POST['stepTemp'];
if (($row_pref['measTemp'] == "C") && ($_POST['stepInfusionTemp'] != "")) $stepInfusionTemp = round((($_POST['stepInfusionTemp'] * 1.8) + 32), 0); // convert to F. (BrewBlogger DB standard)
else $stepInfusionTemp = $_POST['stepInfusionTemp'];

if (($action == "add") && ($dbTable == "mash_steps")) {

  $insertSQL = sprintf("INSERT INTO mash_steps (
  stepMashProfileID,
  stepName,
  stepNumber,
  stepType,
  stepTime,
  stepTemp,
  stepRampTime,
  stepEndTemp,
  stepDescription,
  stepDecoctionAmt,
  stepInfuseAmt,
  stepInfusionTemp
  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                         GetSQLValueString($_POST['stepMashProfileID'], "text"),	
                         GetSQLValueString($_POST['stepName'], "scrubbed"),	
                         GetSQLValueString($_POST['stepNumber'], "text"),
                         GetSQLValueString($_POST['stepType'], "text"),
                         GetSQLValueString($_POST['stepTime'], "text"),
                         GetSQLValueString($stepTemp, "text"),
                         GetSQLValueString($_POST['stepRampTime'], "text"),
                         GetSQLValueString($_POST['stepEndTemp'], "text"),
                         GetSQLValueString($_POST['stepDescription'], "text"),
                         GetSQLValueString($_POST['stepDecoctionAmt'], "text"),
						 GetSQLValueString($_POST['stepInfuseAmt'], "text"),
                         GetSQLValueString($stepInfusionTemp, "text")			   
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=view&dbTable=mash_steps&id=".$_POST['stepMashProfileID']."&confirm=true&msg=2";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Mash Step --------------------------- //

if (($action == "edit") && ($dbTable == "mash_steps")) {
  $updateSQL = sprintf("UPDATE mash_steps 
  SET
  stepMashProfileID=%s,
  stepName=%s,
  stepNumber=%s,
  stepType=%s,
  stepTime=%s,
  stepTemp=%s,
  stepRampTime=%s,
  stepEndTemp=%s,
  stepDescription=%s,
  stepDecoctionAmt=%s,
  stepInfuseAmt=%s,
  stepInfusionTemp=%s
  WHERE id='%s'",
                       GetSQLValueString($_POST['stepMashProfileID'], "text"),	
                       GetSQLValueString($_POST['stepName'], "scrubbed"),	
                       GetSQLValueString($_POST['stepNumber'], "text"),
                       GetSQLValueString($_POST['stepType'], "text"),
                       GetSQLValueString($_POST['stepTime'], "text"),
                       GetSQLValueString($_POST['stepTemp'], "text"),
                       GetSQLValueString($_POST['stepRampTime'], "text"),
                       GetSQLValueString($stepEndTemp, "text"),
                       GetSQLValueString($_POST['stepDescription'], "text"),
                       GetSQLValueString($_POST['stepDecoctionAmt'], "text"),
					   GetSQLValueString($_POST['stepInfuseAmt'], "text"),
                       GetSQLValueString($stepInfusionTemp, "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=view&dbTable=mash_steps&id=".$_POST['stepMashProfileID']."&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

} // end if ($dbTable == "mash_steps")

// --------------------------- If Adding a Water Profile --------------------------- //

if ((($action == "add") || ($action == "reuse")) && ($dbTable == "water_profiles")) {

  $insertSQL = sprintf("INSERT INTO water_profiles (
  waterName,
  waterAmount,
  waterCalcium,
  waterBicarbonate,
  waterSulfate,
  waterChloride,
  waterSodium,
  waterMagnesium,
  waterPH,
  waterNotes,
  waterBrewerID
  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                         GetSQLValueString($_POST['waterName'], "scrubbed"),
                         GetSQLValueString($_POST['waterAmount'], "text"),
                         GetSQLValueString($_POST['waterCalcium'], "text"),
                         GetSQLValueString($_POST['waterBicarbonate'], "text"),
                         GetSQLValueString($_POST['waterSulfate'], "text"),
                         GetSQLValueString($_POST['waterChloride'], "text"),
                         GetSQLValueString($_POST['waterSodium'], "text"),
                         GetSQLValueString($_POST['waterMagnesium'], "text"),
                         GetSQLValueString($_POST['waterPH'], "text"),
                         GetSQLValueString($_POST['waterNotes'], "text"),
						 GetSQLValueString($_POST['waterBrewerID'], "text")		   
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Water Profile --------------------------- //

if (($action == "edit") && ($dbTable == "water_profiles")) {
  $updateSQL = sprintf("UPDATE water_profiles 
  SET
  waterName=%s,
  waterAmount=%s,
  waterCalcium=%s,
  waterBicarbonate=%s,
  waterSulfate=%s,
  waterChloride=%s,
  waterSodium=%s,
  waterMagnesium=%s,
  waterPH=%s,
  waterNotes=%s,
  waterBrewerID=%s
  WHERE id='%s'",
                       GetSQLValueString($_POST['waterName'], "scrubbed"),
                       GetSQLValueString($_POST['waterAmount'], "text"),
                       GetSQLValueString($_POST['waterCalcium'], "text"),
                       GetSQLValueString($_POST['waterBicarbonate'], "text"),
                       GetSQLValueString($_POST['waterSulfate'], "text"),
                       GetSQLValueString($_POST['waterChloride'], "text"),
                       GetSQLValueString($_POST['waterSodium'], "text"),
                       GetSQLValueString($_POST['waterMagnesium'], "text"),
                       GetSQLValueString($_POST['waterPH'], "text"),
                       GetSQLValueString($_POST['waterNotes'], "text"),
					   GetSQLValueString($_POST['waterBrewerID'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding a Water Profile --------------------------- //

if ((($action == "add") || ($action == "reuse")) && ($dbTable == "equip_profiles")) {

  $insertSQL = sprintf("INSERT INTO equip_profiles (
  equipProfileName,
  equipBatchSize,
  equipBoilVolume,
  equipEvapRate,
  equipLoss,
  equipNotes,
  equipMashTunVolume,
  equipMashTunWeight,
  equipMashTunMaterial,
  equipMashTunSpecificHeat,
  equipMashTunDeadspace,
  equipHopUtil,
  equipTypicalEfficiency,
  equipTypicalWaterRatio,
  equipTopUp,
  equipTopUpKettle,
  equipBrewerID
  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
  						GetSQLValueString($_POST['equipProfileName'], "scrubbed"),
  						GetSQLValueString($_POST['equipBatchSize'], "text"),
  						GetSQLValueString($_POST['equipBoilVolume'], "text"),
  						GetSQLValueString($_POST['equipEvapRate'], "text"),
 						GetSQLValueString($_POST['equipLoss'], "text"),
  						GetSQLValueString($_POST['equipNotes'], "text"),
  						GetSQLValueString($_POST['equipMashTunVolume'], "text"),
  						GetSQLValueString($_POST['equipMashTunWeight'], "text"),
  						GetSQLValueString($_POST['equipMashTunMaterial'], "text"),
  						GetSQLValueString($_POST['equipMashTunSpecificHeat'], "text"),
  						GetSQLValueString($_POST['equipMashTunDeadspace'], "text"),
  						GetSQLValueString($_POST['equipHopUtil'], "text"),
  						GetSQLValueString($_POST['equipTypicalEfficiency'], "text"),
						GetSQLValueString($_POST['equipTypicalWaterRatio'], "text"),
  						GetSQLValueString($_POST['equipTopUp'], "text"),
  						GetSQLValueString($_POST['equipTopUpKettle'], "text"),
  						GetSQLValueString($_POST['equipBrewerID'], "text")                   	   
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Equipment Profile --------------------------- //

if (($action == "edit") && ($dbTable == "equip_profiles")) {
  $updateSQL = sprintf("UPDATE equip_profiles 
  SET
  equipProfileName=%s,
  equipBatchSize=%s,
  equipBoilVolume=%s,
  equipEvapRate=%s,
  equipLoss=%s,
  equipNotes=%s,
  equipMashTunVolume=%s,
  equipMashTunWeight=%s,
  equipMashTunMaterial=%s,
  equipMashTunSpecificHeat=%s,
  equipMashTunDeadspace=%s,
  equipHopUtil=%s,
  equipTypicalEfficiency=%s,
  equipTypicalWaterRatio=%s,
  equipTopUp=%s,
  equipTopUpKettle=%s,
  equipBrewerID=%s
  WHERE id='%s'",
                       	GetSQLValueString($_POST['equipProfileName'], "scrubbed"),
  						GetSQLValueString($_POST['equipBatchSize'], "text"),
  						GetSQLValueString($_POST['equipBoilVolume'], "text"),
  						GetSQLValueString($_POST['equipEvapRate'], "text"),
 						GetSQLValueString($_POST['equipLoss'], "text"),
  						GetSQLValueString($_POST['equipNotes'], "text"),
  						GetSQLValueString($_POST['equipMashTunVolume'], "text"),
  						GetSQLValueString($_POST['equipMashTunWeight'], "text"),
  						GetSQLValueString($_POST['equipMashTunMaterial'], "text"),
  						GetSQLValueString($_POST['equipMashTunSpecificHeat'], "text"),
  						GetSQLValueString($_POST['equipMashTunDeadspace'], "text"),
  						GetSQLValueString($_POST['equipHopUtil'], "text"),
  						GetSQLValueString($_POST['equipTypicalEfficiency'], "text"),
						GetSQLValueString($_POST['equipTypicalWaterRatio'], "text"),
  						GetSQLValueString($_POST['equipTopUp'], "text"),
  						GetSQLValueString($_POST['equipTopUpKettle'], "text"),
  						GetSQLValueString($_POST['equipBrewerID'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding Misc Ingredients --------------------------- //

if (($action == "add") && ($dbTable == "misc")) {

  $insertSQL = sprintf("INSERT INTO misc (
  miscName,
  miscType,
  miscUse,
  miscNotes
  ) VALUES (%s, %s, %s, %s)",
                         GetSQLValueString($_POST['miscName'], "scrubbed"),
                         GetSQLValueString($_POST['miscType'], "text"),
						 GetSQLValueString($_POST['miscUse'], "text"),
                         GetSQLValueString($_POST['miscNotes'], "text")		   
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing Misc Ingredients --------------------------- //

if (($action == "edit") && ($dbTable == "misc")) {
  $updateSQL = sprintf("UPDATE misc 
  SET
  miscName=%s,
  miscType=%s,
  miscUse=%s,
  miscNotes=%s
  WHERE id='%s'",
                         GetSQLValueString($_POST['miscName'], "scrubbed"),
                         GetSQLValueString($_POST['miscType'], "text"),
						 GetSQLValueString($_POST['miscUse'], "text"),
                         GetSQLValueString($_POST['miscNotes'], "text"),
                         GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=$dbTable&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If updating records en masse ------------------------------- //

if ($action == "massUpdate") {


foreach($_POST['id'] as $id)

	{ 
	if ($_POST['brewArchive'.$id] == "Y") $brewArchive = "Y"; else $brewArchive = "N";
	if ($_POST['brewFeatured'.$id] == "Y") $brewFeatured = "Y"; else $brewFeatured = "N";
	$updateSQL = "UPDATE $dbTable SET	brewArchive='".$brewArchive."',	brewFeatured='".$brewFeatured."' WHERE id='".$id."';"; 
	mysql_select_db($database_brewing, $brewing);
	$result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());	
	//echo $updateSQL;
	}  

if($result1){ 
	header("location: index.php?action=list&dbTable=".$dbTable."&filter=".$filter."&sort=".$sort."&dir=".$dir."&confirm=true&msg=9");  
	}

}

?>
