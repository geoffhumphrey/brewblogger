<?php
require ('../Connections/config.php'); 
require ('../includes/authentication.inc.php'); session_start(); sessionAuthenticate();
include ('../includes/url_variables.inc.php');
include ('../includes/db_connect_universal.inc.php'); 


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
  include ('../includes/scrubber.inc.php');  
  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
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


// --------------------------- If Adding a new	brewBlog ------------------------------ //

if ((($action == "add") || ($action == "importCalc") || ($action == "reuse") || ($action == "import")) && ($dbTable == "brewing")) { 
  $insertSQL = sprintf("INSERT INTO	brewing 
  (
	brewName,
	brewStyle,
	brewBatchNum,
	brewCondition,
	brewDate,
	brewYield,
	brewMethod,
	brewCost,
	brewLink1,
	brewLink1Name,
	brewLink2,
	brewLink2Name,
	brewInfo,
	brewExtract1,
	brewExtract1Weight,
	brewExtract2,
	brewExtract2Weight,
	brewExtract3,
	brewExtract3Weight,
	brewExtract4,
	brewExtract4Weight,
	brewExtract5,
	brewExtract5Weight,
	brewGrain1,
	brewGrain1Weight,
	brewGrain2,
	brewGrain2Weight,
	brewGrain3,
	brewGrain3Weight,
	brewGrain4,
	brewGrain4Weight,
	brewGrain5,
	brewGrain5Weight,
	brewGrain6,
	brewGrain6Weight,
	brewGrain7,
	brewGrain7Weight,
	brewGrain8,
	brewGrain8Weight,
	brewGrain9,
	brewGrain9Weight,
	brewAddition1,
	brewAddition1Amt,
	brewAddition2,
	brewAddition2Amt,
	brewAddition3,
	brewAddition3Amt,
	brewAddition4,
	brewAddition4Amt,
	brewAddition5,
	brewAddition5Amt,
	brewAddition6,
	brewAddition6Amt,
	brewAddition7,
	brewAddition7Amt,
	brewAddition8,
	brewAddition8Amt,
	brewAddition9,
	brewAddition9Amt,
	brewMisc1Name,
	brewMisc2Name,
	brewMisc3Name,
	brewMisc4Name,
	brewMisc1Type,
	brewMisc2Type,
	brewMisc3Type,
	brewMisc4Type,
	brewMisc1Use,
	brewMisc2Use,
	brewMisc3Use,
	brewMisc4Use,
	brewMisc1Time,
	brewMisc2Time,
	brewMisc3Time,
	brewMisc4Time,
	brewMisc1Amount,
	brewMisc2Amount,
	brewMisc3Amount,
	brewMisc4Amount,
	brewHops1,
	brewHops1Weight,
	brewHops1IBU,
	brewHops1Time,
	brewHops2,
	brewHops2Weight,
	brewHops2IBU,
	brewHops2Time,
	brewHops3,
	brewHops3Weight,
	brewHops3IBU,
	brewHops3Time,
	brewHops4,
	brewHops4Weight,
	brewHops4IBU,
	brewHops4Time,
	brewHops5,
	brewHops5Weight,
	brewHops5IBU,
	brewHops5Time,
	brewHops6,
	brewHops6Weight,
	brewHops6IBU,
	brewHops6Time,
	brewHops7,
	brewHops7Weight,
	brewHops7IBU,
	brewHops7Time,
	brewHops8,
	brewHops8Weight,
	brewHops8IBU,
	brewHops8Time,
	brewHops9,
	brewHops9Weight,
	brewHops9IBU,
	brewHops9Time,
	brewHops1Use,
	brewHops2Use,
	brewHops3Use,
	brewHops4Use,
	brewHops5Use,
	brewHops6Use,
	brewHops7Use,
	brewHops8Use,
	brewHops9Use,
	brewHops1Type,
	brewHops2Type,
	brewHops3Type,
	brewHops4Type,
	brewHops5Type,
	brewHops6Type,
	brewHops7Type,
	brewHops8Type,
	brewHops9Type,
	brewHops1Form,
	brewHops2Form,
	brewHops3Form,
	brewHops4Form,
	brewHops5Form,
	brewHops6Form,
	brewHops7Form,
	brewHops8Form,
	brewHops9Form,
	brewYeast,
	brewYeastMan,
	brewYeastForm,
	brewYeastType,
	brewYeastAmount,
	brewLabelImage,
	brewOG,
	brewFG,
	brewGravity1,
	brewGravity1Days,
	brewGravity2,
	brewGravity2Days,
	brewProcedure,
	brewSpecialProcedure,
	brewPrimary,
	brewPrimaryTemp,
	brewSecondary,
	brewSecondaryTemp,
	brewTertiary,
	brewTertiaryTemp,
	brewLager,
	brewLagerTemp,
	brewAge,
	brewAgeTemp,
	brewBitterness,
	brewLovibond,
	brewComments,
	brewMashType,
	brewMashGrainWeight,
	brewMashGrainTemp,
	brewMashTunTemp,
	brewMashSpargAmt,
	brewMashSpargeTemp,
	brewMashEquipAdjust,
	brewMashPH,
	brewMashStep1Name,
	brewMashStep1Desc,
	brewMashStep1Temp,
	brewMashStep1Time,
	brewMashStep2Name,
	brewMashStep2Desc,
	brewMashStep2Temp,
	brewMashStep2Time,
	brewMashStep3Name,
	brewMashStep3Desc,
	brewMashStep3Temp,
	brewMashStep3Time,
	brewMashStep4Name,
	brewMashStep4Desc,
	brewMashStep4Temp,
	brewMashStep4Time,
	brewMashStep5Name,
	brewMashStep5Desc,
	brewMashStep5Temp,
	brewMashStep5Time,
	brewWaterName,
	brewWaterAmount,
	brewWaterCalcium,
	brewWaterBicarb,
	brewWaterSulfate,
	brewWaterChloride,
	brewWaterMagnesium,
	brewWaterPH,
	brewWaterNotes,
	brewWaterSodium,
	brewEfficiency,
	brewPPG,
	brewTapDate,
	brewStatus,
	brewMashGravity,
	brewPreBoilAmt,
	brewBrewerID,
	brewTargetOG,
	brewTargetFG,
	brewMashProfile,
	brewWaterProfile,
	brewIBUFormula,
	brewYeastProfile,
	brewEquipProfile,
	brewBoilTime,
	brewFeatured,
	brewWaterRatio,
	brewArchive, 
	brewGrain10,
	brewGrain10Weight,
	brewGrain11,
	brewGrain11Weight, 
	brewGrain12,
	brewGrain12Weight, 
	brewGrain13,
	brewGrain13Weight, 
	brewGrain14,
	brewGrain14Weight, 
	brewGrain15,
	brewGrain15Weight, 
	brewHops10,
	brewHops10Weight,
	brewHops10IBU,
	brewHops10Time,
	brewHops10Use,
	brewHops10Type,
	brewHops10Form,
	brewHops11,
	brewHops11Weight,
	brewHops11IBU,
	brewHops11Time,
	brewHops11Use,
	brewHops11Type,
	brewHops11Form,
	brewHops12,
	brewHops12Weight,
	brewHops12IBU,
	brewHops12Time,
	brewHops12Use,
	brewHops12Type,
	brewHops12Form,
	brewHops13,
	brewHops13Weight,
	brewHops13IBU,
	brewHops13Time,
	brewHops13Use,
	brewHops13Type,
	brewHops13Form,
	brewHops14,
	brewHops14Weight,
	brewHops14IBU,
	brewHops14Time,
	brewHops14Use,
	brewHops14Type,
	brewHops14Form,
	brewHops15,
	brewHops15Weight,
	brewHops15IBU,
	brewHops15Time,
	brewHops15Use,
	brewHops15Type,
	brewHops15Form
) 
VALUES 
  (
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
  %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
  %s, %s, %s, %s, %s, %s, %s, %s, %s,
  )",
                       GetSQLValueString($_POST['brewName'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyle'], "text"),
                       GetSQLValueString($_POST['brewBatchNum'], "text"),
                       GetSQLValueString($_POST['brewCondition'], "text"),
                       GetSQLValueString($_POST['brewDate'], "date"),
                       GetSQLValueString($_POST['brewYield'], "text"),
                       GetSQLValueString($_POST['brewMethod'], "text"),
                       GetSQLValueString($_POST['brewCost'], "text"),
                       GetSQLValueString($_POST['brewLink1'], "text"),
                       GetSQLValueString($_POST['brewLink1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewLink2'], "text"),
                       GetSQLValueString($_POST['brewLink2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewInfo'], "text"),
                       GetSQLValueString($_POST['brewExtract1'], "text"),
                       GetSQLValueString($_POST['brewExtract1Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract2'], "text"),
                       GetSQLValueString($_POST['brewExtract2Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract3'], "text"),
                       GetSQLValueString($_POST['brewExtract3Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract4'], "text"),
                       GetSQLValueString($_POST['brewExtract4Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract5'], "text"),
                       GetSQLValueString($_POST['brewExtract5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain1'], "text"),
                       GetSQLValueString($_POST['brewGrain1Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain2'], "text"),
                       GetSQLValueString($_POST['brewGrain2Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain3'], "text"),
                       GetSQLValueString($_POST['brewGrain3Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain4'], "text"),
                       GetSQLValueString($_POST['brewGrain4Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain5'], "text"),
                       GetSQLValueString($_POST['brewGrain5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain6'], "text"),
                       GetSQLValueString($_POST['brewGrain6Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain7'], "text"),
                       GetSQLValueString($_POST['brewGrain7Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain8'], "text"),
                       GetSQLValueString($_POST['brewGrain8Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain9'], "text"),
                       GetSQLValueString($_POST['brewGrain9Weight'], "text"),
                       GetSQLValueString($_POST['brewAddition1'], "text"),
                       GetSQLValueString($_POST['brewAddition1Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition2'], "text"),
                       GetSQLValueString($_POST['brewAddition2Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition3'], "text"),
                       GetSQLValueString($_POST['brewAddition3Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition4'], "text"),
                       GetSQLValueString($_POST['brewAddition4Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition5'], "text"),
                       GetSQLValueString($_POST['brewAddition5Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition6'], "text"),
                       GetSQLValueString($_POST['brewAddition6Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition7'], "text"),
                       GetSQLValueString($_POST['brewAddition7Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition8'], "text"),
                       GetSQLValueString($_POST['brewAddition8Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition9'], "text"),
                       GetSQLValueString($_POST['brewAddition9Amt'], "text"),
                       GetSQLValueString($_POST['brewMisc1Name'], "text"),
                       GetSQLValueString($_POST['brewMisc2Name'], "text"),
                       GetSQLValueString($_POST['brewMisc3Name'], "text"),
                       GetSQLValueString($_POST['brewMisc4Name'], "text"),
                       GetSQLValueString($_POST['brewMisc1Type'], "text"),
                       GetSQLValueString($_POST['brewMisc2Type'], "text"),
                       GetSQLValueString($_POST['brewMisc3Type'], "text"),
                       GetSQLValueString($_POST['brewMisc4Type'], "text"),
                       GetSQLValueString($_POST['brewMisc1Use'], "text"),
                       GetSQLValueString($_POST['brewMisc2Use'], "text"),
                       GetSQLValueString($_POST['brewMisc3Use'], "text"),
                       GetSQLValueString($_POST['brewMisc4Use'], "text"),
                       GetSQLValueString($_POST['brewMisc1Time'], "text"),
                       GetSQLValueString($_POST['brewMisc2Time'], "text"),
                       GetSQLValueString($_POST['brewMisc3Time'], "text"),
                       GetSQLValueString($_POST['brewMisc4Time'], "text"),
                       GetSQLValueString($_POST['brewMisc1Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc2Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc3Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc4Amount'], "text"),
                       GetSQLValueString($_POST['brewHops1'], "text"),
                       GetSQLValueString($_POST['brewHops1Weight'], "text"),
                       GetSQLValueString($_POST['brewHops1IBU'], "text"),
                       GetSQLValueString($_POST['brewHops1Time'], "text"),
                       GetSQLValueString($_POST['brewHops2'], "text"),
                       GetSQLValueString($_POST['brewHops2Weight'], "text"),
                       GetSQLValueString($_POST['brewHops2IBU'], "text"),
                       GetSQLValueString($_POST['brewHops2Time'], "text"),
                       GetSQLValueString($_POST['brewHops3'], "text"),
                       GetSQLValueString($_POST['brewHops3Weight'], "text"),
                       GetSQLValueString($_POST['brewHops3IBU'], "text"),
                       GetSQLValueString($_POST['brewHops3Time'], "text"),
                       GetSQLValueString($_POST['brewHops4'], "text"),
                       GetSQLValueString($_POST['brewHops4Weight'], "text"),
                       GetSQLValueString($_POST['brewHops4IBU'], "text"),
                       GetSQLValueString($_POST['brewHops4Time'], "text"),
                       GetSQLValueString($_POST['brewHops5'], "text"),
                       GetSQLValueString($_POST['brewHops5Weight'], "text"),
                       GetSQLValueString($_POST['brewHops5IBU'], "text"),
                       GetSQLValueString($_POST['brewHops5Time'], "text"),
                       GetSQLValueString($_POST['brewHops6'], "text"),
                       GetSQLValueString($_POST['brewHops6Weight'], "text"),
                       GetSQLValueString($_POST['brewHops6IBU'], "text"),
                       GetSQLValueString($_POST['brewHops6Time'], "text"),
                       GetSQLValueString($_POST['brewHops7'], "text"),
                       GetSQLValueString($_POST['brewHops7Weight'], "text"),
                       GetSQLValueString($_POST['brewHops7IBU'], "text"),
                       GetSQLValueString($_POST['brewHops7Time'], "text"),
                       GetSQLValueString($_POST['brewHops8'], "text"),
                       GetSQLValueString($_POST['brewHops8Weight'], "text"),
                       GetSQLValueString($_POST['brewHops8IBU'], "text"),
                       GetSQLValueString($_POST['brewHops8Time'], "text"),
                       GetSQLValueString($_POST['brewHops9'], "text"),
                       GetSQLValueString($_POST['brewHops9Weight'], "text"),
                       GetSQLValueString($_POST['brewHops9IBU'], "text"),
                       GetSQLValueString($_POST['brewHops9Time'], "text"),
                       GetSQLValueString($_POST['brewHops1Use'], "text"),
                       GetSQLValueString($_POST['brewHops2Use'], "text"),
                       GetSQLValueString($_POST['brewHops3Use'], "text"),
                       GetSQLValueString($_POST['brewHops4Use'], "text"),
                       GetSQLValueString($_POST['brewHops5Use'], "text"),
                       GetSQLValueString($_POST['brewHops6Use'], "text"),
                       GetSQLValueString($_POST['brewHops7Use'], "text"),
                       GetSQLValueString($_POST['brewHops8Use'], "text"),
                       GetSQLValueString($_POST['brewHops9Use'], "text"),
                       GetSQLValueString($_POST['brewHops1Type'], "text"),
                       GetSQLValueString($_POST['brewHops2Type'], "text"),
                       GetSQLValueString($_POST['brewHops3Type'], "text"),
                       GetSQLValueString($_POST['brewHops4Type'], "text"),
                       GetSQLValueString($_POST['brewHops5Type'], "text"),
                       GetSQLValueString($_POST['brewHops6Type'], "text"),
                       GetSQLValueString($_POST['brewHops7Type'], "text"),
                       GetSQLValueString($_POST['brewHops8Type'], "text"),
                       GetSQLValueString($_POST['brewHops9Type'], "text"),
                       GetSQLValueString($_POST['brewHops1Form'], "text"),
                       GetSQLValueString($_POST['brewHops2Form'], "text"),
                       GetSQLValueString($_POST['brewHops3Form'], "text"),
                       GetSQLValueString($_POST['brewHops4Form'], "text"),
                       GetSQLValueString($_POST['brewHops5Form'], "text"),
                       GetSQLValueString($_POST['brewHops6Form'], "text"),
                       GetSQLValueString($_POST['brewHops7Form'], "text"),
                       GetSQLValueString($_POST['brewHops8Form'], "text"),
                       GetSQLValueString($_POST['brewHops9Form'], "text"),
                       GetSQLValueString($_POST['brewYeast'], "text"),
                       GetSQLValueString($_POST['brewYeastMan'], "text"),
                       GetSQLValueString($_POST['brewYeastForm'], "text"),
                       GetSQLValueString($_POST['brewYeastType'], "text"),
                       GetSQLValueString($_POST['brewYeastAmount'], "text"),
                       GetSQLValueString($_POST['brewLabelImage'], "text"),
                       GetSQLValueString($_POST['brewOG'], "text"),
                       GetSQLValueString($_POST['brewFG'], "text"),
                       GetSQLValueString($_POST['brewGravity1'], "text"),
                       GetSQLValueString($_POST['brewGravity1Days'], "text"),
                       GetSQLValueString($_POST['brewGravity2'], "text"),
                       GetSQLValueString($_POST['brewGravity2Days'], "text"),
                       GetSQLValueString($_POST['brewProcedure'], "text"),
                       GetSQLValueString($_POST['brewSpecialProcedure'], "text"),
                       GetSQLValueString($_POST['brewPrimary'], "text"),
                       GetSQLValueString($_POST['brewPrimaryTemp'], "text"),
                       GetSQLValueString($_POST['brewSecondary'], "text"),
                       GetSQLValueString($_POST['brewSecondaryTemp'], "text"),
                       GetSQLValueString($_POST['brewTertiary'], "text"),
                       GetSQLValueString($_POST['brewTertiaryTemp'], "text"),
                       GetSQLValueString($_POST['brewLager'], "text"),
                       GetSQLValueString($_POST['brewLagerTemp'], "text"),
                       GetSQLValueString($_POST['brewAge'], "text"),
                       GetSQLValueString($_POST['brewAgeTemp'], "text"),
                       GetSQLValueString($_POST['brewBitterness'], "text"),
                       GetSQLValueString($_POST['brewLovibond'], "text"),
                       GetSQLValueString($_POST['brewComments'], "text"),
                       GetSQLValueString($_POST['brewMashType'], "text"),
                       GetSQLValueString($_POST['brewMashGrainWeight'], "text"),
                       GetSQLValueString($_POST['brewMashGrainTemp'], "text"),
                       GetSQLValueString($_POST['brewMashTunTemp'], "text"),
                       GetSQLValueString($_POST['brewMashSpargAmt'], "text"),
                       GetSQLValueString($_POST['brewMashSpargeTemp'], "text"),
                       GetSQLValueString($_POST['brewMashEquipAdjust'], "text"),
                       GetSQLValueString($_POST['brewMashPH'], "text"),
                       GetSQLValueString($_POST['brewMashStep1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep1Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep1Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep1Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep2Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep2Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep2Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep3Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep3Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep3Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep3Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep4Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep4Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep4Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep4Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep5Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep5Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep5Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep5Time'], "text"),
                       GetSQLValueString($_POST['brewWaterName'], "scrubbed"),
                       GetSQLValueString($_POST['brewWaterAmount'], "text"),
                       GetSQLValueString($_POST['brewWaterCalcium'], "text"),
                       GetSQLValueString($_POST['brewWaterBicarb'], "text"),
                       GetSQLValueString($_POST['brewWaterSulfate'], "text"),
                       GetSQLValueString($_POST['brewWaterChloride'], "text"),
                       GetSQLValueString($_POST['brewWaterMagnesium'], "text"),
                       GetSQLValueString($_POST['brewWaterPH'], "text"),
                       GetSQLValueString($_POST['brewWaterNotes'], "text"),
                       GetSQLValueString($_POST['brewWaterSodium'], "text"),
                       GetSQLValueString($_POST['brewEfficiency'], "text"),
                       GetSQLValueString($_POST['brewPPG'], "text"),
					   GetSQLValueString($_POST['brewTapDate'], "text"),
					   GetSQLValueString($_POST['brewStatus'], "text"),
					   GetSQLValueString($_POST['brewMashGravity'], "text"),
                       GetSQLValueString($_POST['brewPreBoilAmt'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($_POST['brewTargetOG'], "text"),
					   GetSQLValueString($_POST['brewTargetFG'], "text"),
					   GetSQLValueString($_POST['brewMashProfile'], "text"),
					   GetSQLValueString($_POST['brewWaterProfile'], "text"),
					   GetSQLValueString($_POST['brewIBUFormula'], "text"),
					   GetSQLValueString($_POST['brewYeastProfile'], "text"),
					   GetSQLValueString($_POST['brewEquipProfile'], "text"),
					   GetSQLValueString($_POST['brewBoilTime'], "text"),
					   GetSQLValueString($_POST['brewFeatured'], "text"),
					   GetSQLValueString($_POST['brewWaterRatio'], "text"),
					   GetSQLValueString($_POST['brewArchive'], "text"),
					   GetSQLValueString($_POST['brewGrain10'], "text"),
					   GetSQLValueString($_POST['brewGrain10Weight'], "text"),
					   GetSQLValueString($_POST['brewGrain11'], "text"),
					   GetSQLValueString($_POST['brewGrain11Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain12'], "text"),
					   GetSQLValueString($_POST['brewGrain12Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain13'], "text"),
					   GetSQLValueString($_POST['brewGrain13Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain14'], "text"),
					   GetSQLValueString($_POST['brewGrain14Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain15'], "text"),
					   GetSQLValueString($_POST['brewGrain15Weight'], "text"), 
					   GetSQLValueString($_POST['brewHops10'], "text"),
					   GetSQLValueString($_POST['brewHops10Weight'], "text"),
					   GetSQLValueString($_POST['brewHops10IBU'], "text"),
					   GetSQLValueString($_POST['brewHops10Time'], "text"),
					   GetSQLValueString($_POST['brewHops10Use'], "text"),
					   GetSQLValueString($_POST['brewHops10Type'], "text"),
					   GetSQLValueString($_POST['brewHops10Form'], "text"),
					   GetSQLValueString($_POST['brewHops11'], "text"),
					   GetSQLValueString($_POST['brewHops11Weight'], "text"),
					   GetSQLValueString($_POST['brewHops11IBU'], "text"),
					   GetSQLValueString($_POST['brewHops11Time'], "text"),
					   GetSQLValueString($_POST['brewHops11Use'], "text"),
					   GetSQLValueString($_POST['brewHops11Type'], "text"),
					   GetSQLValueString($_POST['brewHops11Form'], "text"),
					   GetSQLValueString($_POST['brewHops12'], "text"),
					   GetSQLValueString($_POST['brewHops12Weight'], "text"),
					   GetSQLValueString($_POST['brewHops12IBU'], "text"),
					   GetSQLValueString($_POST['brewHops12Time'], "text"),
					   GetSQLValueString($_POST['brewHops12Use'], "text"),
					   GetSQLValueString($_POST['brewHops12Type'], "text"),
					   GetSQLValueString($_POST['brewHops12Form'], "text"),
					   GetSQLValueString($_POST['brewHops13'], "text"),
					   GetSQLValueString($_POST['brewHops13Weight'], "text"),
					   GetSQLValueString($_POST['brewHops13IBU'], "text"),
					   GetSQLValueString($_POST['brewHops13Time'], "text"),
					   GetSQLValueString($_POST['brewHops13Use'], "text"),
					   GetSQLValueString($_POST['brewHops13Type'], "text"),
					   GetSQLValueString($_POST['brewHops13Form'], "text"),
					   GetSQLValueString($_POST['brewHops14'], "text"),
					   GetSQLValueString($_POST['brewHops14Weight'], "text"),
					   GetSQLValueString($_POST['brewHops14IBU'], "text"),
					   GetSQLValueString($_POST['brewHops14Time'], "text"),
					   GetSQLValueString($_POST['brewHops14Use'], "text"),
					   GetSQLValueString($_POST['brewHops14Type'], "text"),
					   GetSQLValueString($_POST['brewHops14Form'], "text"),
					   GetSQLValueString($_POST['brewHops15'], "text"),
					   GetSQLValueString($_POST['brewHops15Weight'], "text"),
					   GetSQLValueString($_POST['brewHops15IBU'], "text"),
					   GetSQLValueString($_POST['brewHops15Time'], "text"),
					   GetSQLValueString($_POST['brewHops15Use'], "text"),
					   GetSQLValueString($_POST['brewHops15Type'], "text"),
					   GetSQLValueString($_POST['brewHops15Form'], "text")
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=brewing&id=".$id."&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}


// --------------------------- If Editing a	brewBlog ------------------------------- //

if (($action == "edit") && ($dbTable == "brewing")) {
	if ($_POST['yeastKeep'] == "Yes") { $brewYeast = $_POST['brewYeast']; $brewYeastMan = $_POST['brewYeastMan']; $brewYeastType = $_POST['brewYeastType']; $brewYeastForm = $_POST['brewYeastForm']; $brewYeastProfile = ""; $brewYeastAmount = $_POST['brewYeastAmount']; }
	if ($_POST['yeastKeep'] == "No")  { $brewYeast = ""; $brewYeastMan = ""; $brewYeastType = ""; $brewYeastForm = ""; $brewYeastProfile = $_POST['brewYeastProfile']; $brewYeastAmount = $_POST['brewYeastAmount']; }
  $updateSQL = sprintf("
	UPDATE	brewing SET 
	brewName=%s, 
	brewStyle=%s, 
	brewBatchNum=%s, 
	brewCondition=%s, 
	brewDate=%s, 
	brewYield=%s, 
	brewMethod=%s,
	brewCost=%s,
	brewLink1=%s,
	brewLink1Name=%s,
	brewLink2=%s,
	brewLink2Name=%s,
	brewInfo=%s,
	brewExtract1=%s,
	brewExtract1Weight=%s,
	brewExtract2=%s,
	brewExtract2Weight=%s,
	brewExtract3=%s,
	brewExtract3Weight=%s,
	brewExtract4=%s,
	brewExtract4Weight=%s,
	brewExtract5=%s,
	brewExtract5Weight=%s,
	brewGrain1=%s,
	brewGrain1Weight=%s,
	brewGrain2=%s,
	brewGrain2Weight=%s,
	brewGrain3=%s,
	brewGrain3Weight=%s,
	brewGrain4=%s,
	brewGrain4Weight=%s,
	brewGrain5=%s,
	brewGrain5Weight=%s,
	brewGrain6=%s,
	brewGrain6Weight=%s,
	brewGrain7=%s,
	brewGrain7Weight=%s,
	brewGrain8=%s,
	brewGrain8Weight=%s,
	brewGrain9=%s,
	brewGrain9Weight=%s,
	brewAddition1=%s,
	brewAddition1Amt=%s,
	brewAddition2=%s,
	brewAddition2Amt=%s,
	brewAddition3=%s,
	brewAddition3Amt=%s,
	brewAddition4=%s,
	brewAddition4Amt=%s,
	brewAddition5=%s,
	brewAddition5Amt=%s,
	brewAddition6=%s,
	brewAddition6Amt=%s,
	brewAddition7=%s,
	brewAddition7Amt=%s,
	brewAddition8=%s,
	brewAddition8Amt=%s,
	brewAddition9=%s,
	brewAddition9Amt=%s,
	brewMisc1Name=%s,
	brewMisc2Name=%s,
	brewMisc3Name=%s,
	brewMisc4Name=%s,
	brewMisc1Type=%s,
	brewMisc2Type=%s,
	brewMisc3Type=%s,
	brewMisc4Type=%s,
	brewMisc1Use=%s,
	brewMisc2Use=%s,
	brewMisc3Use=%s,
	brewMisc4Use=%s,
	brewMisc1Time=%s,
	brewMisc2Time=%s,
	brewMisc3Time=%s,
	brewMisc4Time=%s,
	brewMisc1Amount=%s,
	brewMisc2Amount=%s,
	brewMisc3Amount=%s,
	brewMisc4Amount=%s,
	brewHops1=%s,
	brewHops1Weight=%s,
	brewHops1IBU=%s,
	brewHops1Time=%s,
	brewHops2=%s,
	brewHops2Weight=%s,
	brewHops2IBU=%s,
	brewHops2Time=%s,
	brewHops3=%s,
	brewHops3Weight=%s,
	brewHops3IBU=%s,
	brewHops3Time=%s,
	brewHops4=%s,
	brewHops4Weight=%s,
	brewHops4IBU=%s,
	brewHops4Time=%s,
	brewHops5=%s,
	brewHops5Weight=%s,
	brewHops5IBU=%s,
	brewHops5Time=%s,
	brewHops6=%s,
	brewHops6Weight=%s,
	brewHops6IBU=%s,
	brewHops6Time=%s,
	brewHops7=%s,
	brewHops7Weight=%s,
	brewHops7IBU=%s,
	brewHops7Time=%s,
	brewHops8=%s,
	brewHops8Weight=%s,
	brewHops8IBU=%s,
	brewHops8Time=%s,
	brewHops9=%s,
	brewHops9Weight=%s,
	brewHops9IBU=%s,
	brewHops9Time=%s,
	brewHops1Use=%s,
	brewHops2Use=%s,
	brewHops3Use=%s,
	brewHops4Use=%s,
	brewHops5Use=%s,
	brewHops6Use=%s,
	brewHops7Use=%s,
	brewHops8Use=%s,
	brewHops9Use=%s,
	brewHops1Type=%s,
	brewHops2Type=%s,
	brewHops3Type=%s,
	brewHops4Type=%s,
	brewHops5Type=%s,
	brewHops6Type=%s,
	brewHops7Type=%s,
	brewHops8Type=%s,
	brewHops9Type=%s,
	brewHops1Form=%s,
	brewHops2Form=%s,
	brewHops3Form=%s,
	brewHops4Form=%s,
	brewHops5Form=%s,
	brewHops6Form=%s,
	brewHops7Form=%s,
	brewHops8Form=%s,
	brewHops9Form=%s,
	brewYeast=%s,
	brewYeastMan=%s,
	brewYeastForm=%s,
	brewYeastType=%s,
	brewYeastAmount=%s,
	brewLabelImage=%s,
	brewOG=%s,
	brewFG=%s,
	brewGravity1=%s,
	brewGravity1Days=%s,
	brewGravity2=%s,
	brewGravity2Days=%s,
	brewProcedure=%s,
	brewSpecialProcedure=%s,
	brewPrimary=%s,
	brewPrimaryTemp=%s,
	brewSecondary=%s,
	brewSecondaryTemp=%s,
	brewTertiary=%s,
	brewTertiaryTemp=%s,
	brewLager=%s,
	brewLagerTemp=%s,
	brewAge=%s,
	brewAgeTemp=%s,
	brewBitterness=%s,
	brewLovibond=%s,
	brewComments=%s,
	brewMashType=%s,
	brewMashGrainWeight=%s,
	brewMashGrainTemp=%s,
	brewMashTunTemp=%s,
	brewMashSpargAmt=%s,
	brewMashSpargeTemp=%s,
	brewMashEquipAdjust=%s,
	brewMashPH=%s,
	brewMashStep1Name=%s,
	brewMashStep1Desc=%s,
	brewMashStep1Temp=%s,
	brewMashStep1Time=%s,
	brewMashStep2Name=%s,
	brewMashStep2Desc=%s,
	brewMashStep2Temp=%s,
	brewMashStep2Time=%s,
	brewMashStep3Name=%s,
	brewMashStep3Desc=%s,
	brewMashStep3Temp=%s,
	brewMashStep3Time=%s,
	brewMashStep4Name=%s,
	brewMashStep4Desc=%s,
	brewMashStep4Temp=%s,
	brewMashStep4Time=%s,
	brewMashStep5Name=%s,
	brewMashStep5Desc=%s,
	brewMashStep5Temp=%s,
	brewMashStep5Time=%s,
	brewWaterName=%s,
	brewWaterAmount=%s,
	brewWaterCalcium=%s,
	brewWaterBicarb=%s,
	brewWaterSulfate=%s,
	brewWaterChloride=%s,
	brewWaterMagnesium=%s,
	brewWaterPH=%s,
	brewWaterNotes=%s,
	brewWaterSodium=%s,
	brewEfficiency=%s,
	brewPPG=%s,
	brewTapDate=%s,
	brewStatus=%s,
	brewMashGravity=%s,
	brewPreBoilAmt=%s,
	brewBrewerID=%s,
	brewTargetOG=%s,
	brewTargetFG=%s,
	brewMashProfile=%s,
	brewWaterProfile=%s,
	brewIBUFormula=%s,
	brewYeastProfile=%s,
	brewEquipProfile=%s,
	brewBoilTime=%s,
	brewFeatured=%s,
	brewWaterRatio=%s,
	brewArchive=%s,
 	brewGrain10=%s,
	brewGrain10Weight=%s,
	brewGrain11=%s,
	brewGrain11Weight=%s, 
	brewGrain12=%s,
	brewGrain12Weight=%s, 
	brewGrain13=%s,
	brewGrain13Weight=%s, 
	brewGrain14=%s,
	brewGrain14Weight=%s, 
	brewGrain15=%s,
	brewGrain15Weight=%s, 
	brewHops10=%s,
	brewHops10Weight=%s,
	brewHops10IBU=%s,
	brewHops10Time=%s,
	brewHops10Use=%s,
	brewHops10Type=%s,
	brewHops10Form=%s,
	brewHops11=%s,
	brewHops11Weight=%s,
	brewHops11IBU=%s,
	brewHops11Time=%s,
	brewHops11Use=%s,
	brewHops11Type=%s,
	brewHops11Form=%s,
	brewHops12=%s,
	brewHops12Weight=%s,
	brewHops12IBU=%s,
	brewHops12Time=%s,
	brewHops12Use=%s,
	brewHops12Type=%s,
	brewHops12Form=%s,
	brewHops13=%s,
	brewHops13Weight=%s,
	brewHops13IBU=%s,
	brewHops13Time=%s,
	brewHops13Use=%s,
	brewHops13Type=%s,
	brewHops13Form=%s,
	brewHops14=%s,
	brewHops14Weight=%s,
	brewHops14IBU=%s,
	brewHops14Time=%s,
	brewHops14Use=%s,
	brewHops14Type=%s,
	brewHops14Form=%s,
	brewHops15=%s,
	brewHops15Weight=%s,
	brewHops15IBU=%s,
	brewHops15Time=%s,
	brewHops15Use=%s,
	brewHops15Type=%s,
	brewHops15Form=%s
	WHERE id='%s'",
                       GetSQLValueString($_POST['brewName'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyle'], "text"),
                       GetSQLValueString($_POST['brewBatchNum'], "text"),
                       GetSQLValueString($_POST['brewCondition'], "text"),
                       GetSQLValueString($_POST['brewDate'], "date"),
                       GetSQLValueString($_POST['brewYield'], "text"),
                       GetSQLValueString($_POST['brewMethod'], "text"),
                       GetSQLValueString($_POST['brewCost'], "text"),
                       GetSQLValueString($_POST['brewLink1'], "text"),
                       GetSQLValueString($_POST['brewLink1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewLink2'], "text"),
                       GetSQLValueString($_POST['brewLink2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewInfo'], "text"),
                       GetSQLValueString($_POST['brewExtract1'], "text"),
                       GetSQLValueString($_POST['brewExtract1Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract2'], "text"),
                       GetSQLValueString($_POST['brewExtract2Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract3'], "text"),
                       GetSQLValueString($_POST['brewExtract3Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract4'], "text"),
                       GetSQLValueString($_POST['brewExtract4Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract5'], "text"),
                       GetSQLValueString($_POST['brewExtract5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain1'], "text"),
                       GetSQLValueString($_POST['brewGrain1Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain2'], "text"),
                       GetSQLValueString($_POST['brewGrain2Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain3'], "text"),
                       GetSQLValueString($_POST['brewGrain3Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain4'], "text"),
                       GetSQLValueString($_POST['brewGrain4Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain5'], "text"),
                       GetSQLValueString($_POST['brewGrain5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain6'], "text"),
                       GetSQLValueString($_POST['brewGrain6Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain7'], "text"),
                       GetSQLValueString($_POST['brewGrain7Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain8'], "text"),
                       GetSQLValueString($_POST['brewGrain8Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain9'], "text"),
                       GetSQLValueString($_POST['brewGrain9Weight'], "text"),
                       GetSQLValueString($_POST['brewAddition1'], "text"),
                       GetSQLValueString($_POST['brewAddition1Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition2'], "text"),
                       GetSQLValueString($_POST['brewAddition2Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition3'], "text"),
                       GetSQLValueString($_POST['brewAddition3Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition4'], "text"),
                       GetSQLValueString($_POST['brewAddition4Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition5'], "text"),
                       GetSQLValueString($_POST['brewAddition5Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition6'], "text"),
                       GetSQLValueString($_POST['brewAddition6Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition7'], "text"),
                       GetSQLValueString($_POST['brewAddition7Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition8'], "text"),
                       GetSQLValueString($_POST['brewAddition8Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition9'], "text"),
                       GetSQLValueString($_POST['brewAddition9Amt'], "text"),
                       GetSQLValueString($_POST['brewMisc1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc3Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc4Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc1Type'], "text"),
                       GetSQLValueString($_POST['brewMisc2Type'], "text"),
                       GetSQLValueString($_POST['brewMisc3Type'], "text"),
                       GetSQLValueString($_POST['brewMisc4Type'], "text"),
                       GetSQLValueString($_POST['brewMisc1Use'], "text"),
                       GetSQLValueString($_POST['brewMisc2Use'], "text"),
                       GetSQLValueString($_POST['brewMisc3Use'], "text"),
                       GetSQLValueString($_POST['brewMisc4Use'], "text"),
                       GetSQLValueString($_POST['brewMisc1Time'], "text"),
                       GetSQLValueString($_POST['brewMisc2Time'], "text"),
                       GetSQLValueString($_POST['brewMisc3Time'], "text"),
                       GetSQLValueString($_POST['brewMisc4Time'], "text"),
                       GetSQLValueString($_POST['brewMisc1Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc2Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc3Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc4Amount'], "text"),
                       GetSQLValueString($_POST['brewHops1'], "text"),
                       GetSQLValueString($_POST['brewHops1Weight'], "text"),
                       GetSQLValueString($_POST['brewHops1IBU'], "text"),
                       GetSQLValueString($_POST['brewHops1Time'], "text"),
                       GetSQLValueString($_POST['brewHops2'], "text"),
                       GetSQLValueString($_POST['brewHops2Weight'], "text"),
                       GetSQLValueString($_POST['brewHops2IBU'], "text"),
                       GetSQLValueString($_POST['brewHops2Time'], "text"),
                       GetSQLValueString($_POST['brewHops3'], "text"),
                       GetSQLValueString($_POST['brewHops3Weight'], "text"),
                       GetSQLValueString($_POST['brewHops3IBU'], "text"),
                       GetSQLValueString($_POST['brewHops3Time'], "text"),
                       GetSQLValueString($_POST['brewHops4'], "text"),
                       GetSQLValueString($_POST['brewHops4Weight'], "text"),
                       GetSQLValueString($_POST['brewHops4IBU'], "text"),
                       GetSQLValueString($_POST['brewHops4Time'], "text"),
                       GetSQLValueString($_POST['brewHops5'], "text"),
                       GetSQLValueString($_POST['brewHops5Weight'], "text"),
                       GetSQLValueString($_POST['brewHops5IBU'], "text"),
                       GetSQLValueString($_POST['brewHops5Time'], "text"),
                       GetSQLValueString($_POST['brewHops6'], "text"),
                       GetSQLValueString($_POST['brewHops6Weight'], "text"),
                       GetSQLValueString($_POST['brewHops6IBU'], "text"),
                       GetSQLValueString($_POST['brewHops6Time'], "text"),
                       GetSQLValueString($_POST['brewHops7'], "text"),
                       GetSQLValueString($_POST['brewHops7Weight'], "text"),
                       GetSQLValueString($_POST['brewHops7IBU'], "text"),
                       GetSQLValueString($_POST['brewHops7Time'], "text"),
                       GetSQLValueString($_POST['brewHops8'], "text"),
                       GetSQLValueString($_POST['brewHops8Weight'], "text"),
                       GetSQLValueString($_POST['brewHops8IBU'], "text"),
                       GetSQLValueString($_POST['brewHops8Time'], "text"),
                       GetSQLValueString($_POST['brewHops9'], "text"),
                       GetSQLValueString($_POST['brewHops9Weight'], "text"),
                       GetSQLValueString($_POST['brewHops9IBU'], "text"),
                       GetSQLValueString($_POST['brewHops9Time'], "text"),
                       GetSQLValueString($_POST['brewHops1Use'], "text"),
                       GetSQLValueString($_POST['brewHops2Use'], "text"),
                       GetSQLValueString($_POST['brewHops3Use'], "text"),
                       GetSQLValueString($_POST['brewHops4Use'], "text"),
                       GetSQLValueString($_POST['brewHops5Use'], "text"),
                       GetSQLValueString($_POST['brewHops6Use'], "text"),
                       GetSQLValueString($_POST['brewHops7Use'], "text"),
                       GetSQLValueString($_POST['brewHops8Use'], "text"),
                       GetSQLValueString($_POST['brewHops9Use'], "text"),
                       GetSQLValueString($_POST['brewHops1Type'], "text"),
                       GetSQLValueString($_POST['brewHops2Type'], "text"),
                       GetSQLValueString($_POST['brewHops3Type'], "text"),
                       GetSQLValueString($_POST['brewHops4Type'], "text"),
                       GetSQLValueString($_POST['brewHops5Type'], "text"),
                       GetSQLValueString($_POST['brewHops6Type'], "text"),
                       GetSQLValueString($_POST['brewHops7Type'], "text"),
                       GetSQLValueString($_POST['brewHops8Type'], "text"),
                       GetSQLValueString($_POST['brewHops9Type'], "text"),
                       GetSQLValueString($_POST['brewHops1Form'], "text"),
                       GetSQLValueString($_POST['brewHops2Form'], "text"),
                       GetSQLValueString($_POST['brewHops3Form'], "text"),
                       GetSQLValueString($_POST['brewHops4Form'], "text"),
                       GetSQLValueString($_POST['brewHops5Form'], "text"),
                       GetSQLValueString($_POST['brewHops6Form'], "text"),
                       GetSQLValueString($_POST['brewHops7Form'], "text"),
                       GetSQLValueString($_POST['brewHops8Form'], "text"),
                       GetSQLValueString($_POST['brewHops9Form'], "text"),
                       GetSQLValueString($brewYeast, "text"),
                       GetSQLValueString($brewYeastMan, "text"),
                       GetSQLValueString($brewYeastForm, "text"),
                       GetSQLValueString($brewYeastType, "text"),
                       GetSQLValueString($brewYeastAmount, "text"),
                       GetSQLValueString($_POST['brewLabelImage'], "text"),
                       GetSQLValueString($_POST['brewOG'], "text"),
                       GetSQLValueString($_POST['brewFG'], "text"),
                       GetSQLValueString($_POST['brewGravity1'], "text"),
                       GetSQLValueString($_POST['brewGravity1Days'], "text"),
                       GetSQLValueString($_POST['brewGravity2'], "text"),
                       GetSQLValueString($_POST['brewGravity2Days'], "text"),
                       GetSQLValueString($_POST['brewProcedure'], "text"),
                       GetSQLValueString($_POST['brewSpecialProcedure'], "text"),
                       GetSQLValueString($_POST['brewPrimary'], "text"),
                       GetSQLValueString($_POST['brewPrimaryTemp'], "text"),
                       GetSQLValueString($_POST['brewSecondary'], "text"),
                       GetSQLValueString($_POST['brewSecondaryTemp'], "text"),
                       GetSQLValueString($_POST['brewTertiary'], "text"),
                       GetSQLValueString($_POST['brewTertiaryTemp'], "text"),
                       GetSQLValueString($_POST['brewLager'], "text"),
                       GetSQLValueString($_POST['brewLagerTemp'], "text"),
                       GetSQLValueString($_POST['brewAge'], "text"),
                       GetSQLValueString($_POST['brewAgeTemp'], "text"),
                       GetSQLValueString($_POST['brewBitterness'], "text"),
                       GetSQLValueString($_POST['brewLovibond'], "text"),
                       GetSQLValueString($_POST['brewComments'], "text"),
                       GetSQLValueString($_POST['brewMashType'], "text"),
                       GetSQLValueString($_POST['brewMashGrainWeight'], "text"),
                       GetSQLValueString($_POST['brewMashGrainTemp'], "text"),
                       GetSQLValueString($_POST['brewMashTunTemp'], "text"),
                       GetSQLValueString($_POST['brewMashSpargAmt'], "text"),
                       GetSQLValueString($_POST['brewMashSpargeTemp'], "text"),
                       GetSQLValueString($_POST['brewMashEquipAdjust'], "text"),
                       GetSQLValueString($_POST['brewMashPH'], "text"),
                       GetSQLValueString($_POST['brewMashStep1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep1Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep1Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep1Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep2Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep2Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep2Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep3Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep3Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep3Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep3Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep4Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep4Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep4Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep4Time'], "text"),
                       GetSQLValueString($_POST['brewMashStep5Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep5Desc'], "scrubbed"),
                       GetSQLValueString($_POST['brewMashStep5Temp'], "text"),
                       GetSQLValueString($_POST['brewMashStep5Time'], "text"),
                       GetSQLValueString($_POST['brewWaterName'], "scrubbed"),
                       GetSQLValueString($_POST['brewWaterAmount'], "text"),
                       GetSQLValueString($_POST['brewWaterCalcium'], "text"),
                       GetSQLValueString($_POST['brewWaterBicarb'], "text"),
                       GetSQLValueString($_POST['brewWaterSulfate'], "text"),
                       GetSQLValueString($_POST['brewWaterChloride'], "text"),
                       GetSQLValueString($_POST['brewWaterMagnesium'], "text"),
                       GetSQLValueString($_POST['brewWaterPH'], "text"),
                       GetSQLValueString($_POST['brewWaterNotes'], "text"),
                       GetSQLValueString($_POST['brewWaterSodium'], "text"),
                       GetSQLValueString($_POST['brewEfficiency'], "text"),
                       GetSQLValueString($_POST['brewPPG'], "text"),
					   GetSQLValueString($_POST['brewTapDate'], "text"),
					   GetSQLValueString($_POST['brewStatus'], "text"),
					   GetSQLValueString($_POST['brewMashGravity'], "text"),
                       GetSQLValueString($_POST['brewPreBoilAmt'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($_POST['brewTargetOG'], "text"),
					   GetSQLValueString($_POST['brewTargetFG'], "text"),
					   GetSQLValueString($_POST['brewMashProfile'], "text"),
					   GetSQLValueString($_POST['brewWaterProfile'], "text"),
					   GetSQLValueString($_POST['brewIBUFormula'], "text"),
					   GetSQLValueString($brewYeastProfile, "text"),
					   GetSQLValueString($_POST['brewEquipProfile'], "text"),
					   GetSQLValueString($_POST['brewBoilTime'], "text"),
					   GetSQLValueString($_POST['brewFeatured'], "text"),
					   GetSQLValueString($_POST['brewWaterRatio'], "text"),
					   GetSQLValueString($_POST['brewArchive'], "text"),
					   GetSQLValueString($_POST['brewGrain10'], "text"),
					   GetSQLValueString($_POST['brewGrain10Weight'], "text"),
					   GetSQLValueString($_POST['brewGrain11'], "text"),
					   GetSQLValueString($_POST['brewGrain11Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain12'], "text"),
					   GetSQLValueString($_POST['brewGrain12Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain13'], "text"),
					   GetSQLValueString($_POST['brewGrain13Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain14'], "text"),
					   GetSQLValueString($_POST['brewGrain14Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain15'], "text"),
					   GetSQLValueString($_POST['brewGrain15Weight'], "text"), 
					   GetSQLValueString($_POST['brewHops10'], "text"),
					   GetSQLValueString($_POST['brewHops10Weight'], "text"),
					   GetSQLValueString($_POST['brewHops10IBU'], "text"),
					   GetSQLValueString($_POST['brewHops10Time'], "text"),
					   GetSQLValueString($_POST['brewHops10Use'], "text"),
					   GetSQLValueString($_POST['brewHops10Type'], "text"),
					   GetSQLValueString($_POST['brewHops10Form'], "text"),
					   GetSQLValueString($_POST['brewHops11'], "text"),
					   GetSQLValueString($_POST['brewHops11Weight'], "text"),
					   GetSQLValueString($_POST['brewHops11IBU'], "text"),
					   GetSQLValueString($_POST['brewHops11Time'], "text"),
					   GetSQLValueString($_POST['brewHops11Use'], "text"),
					   GetSQLValueString($_POST['brewHops11Type'], "text"),
					   GetSQLValueString($_POST['brewHops11Form'], "text"),
					   GetSQLValueString($_POST['brewHops12'], "text"),
					   GetSQLValueString($_POST['brewHops12Weight'], "text"),
					   GetSQLValueString($_POST['brewHops12IBU'], "text"),
					   GetSQLValueString($_POST['brewHops12Time'], "text"),
					   GetSQLValueString($_POST['brewHops12Use'], "text"),
					   GetSQLValueString($_POST['brewHops12Type'], "text"),
					   GetSQLValueString($_POST['brewHops12Form'], "text"),
					   GetSQLValueString($_POST['brewHops13'], "text"),
					   GetSQLValueString($_POST['brewHops13Weight'], "text"),
					   GetSQLValueString($_POST['brewHops13IBU'], "text"),
					   GetSQLValueString($_POST['brewHops13Time'], "text"),
					   GetSQLValueString($_POST['brewHops13Use'], "text"),
					   GetSQLValueString($_POST['brewHops13Type'], "text"),
					   GetSQLValueString($_POST['brewHops13Form'], "text"),
					   GetSQLValueString($_POST['brewHops14'], "text"),
					   GetSQLValueString($_POST['brewHops14Weight'], "text"),
					   GetSQLValueString($_POST['brewHops14IBU'], "text"),
					   GetSQLValueString($_POST['brewHops14Time'], "text"),
					   GetSQLValueString($_POST['brewHops14Use'], "text"),
					   GetSQLValueString($_POST['brewHops14Type'], "text"),
					   GetSQLValueString($_POST['brewHops14Form'], "text"),
					   GetSQLValueString($_POST['brewHops15'], "text"),
					   GetSQLValueString($_POST['brewHops15Weight'], "text"),
					   GetSQLValueString($_POST['brewHops15IBU'], "text"),
					   GetSQLValueString($_POST['brewHops15Time'], "text"),
					   GetSQLValueString($_POST['brewHops15Use'], "text"),
					   GetSQLValueString($_POST['brewHops15Type'], "text"),
					   GetSQLValueString($_POST['brewHops15Form'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=brewing&id=".$id."&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Updating Calculations ------------------------------- //

if (($action == "update") && (($dbTable == "brewing") || ($dbTable == "recipes"))) {
$brewBitterness = explode("-", $_POST['brewBitterness']);
$updateSQL = sprintf("UPDATE $dbTable SET 
	brewName=%s,	
	brewStyle=%s,	
	brewYield=%s, 
	brewExtract1=%s,
	brewExtract1Weight=%s, 
	brewExtract2=%s,
	brewExtract2Weight=%s, 
	brewExtract3=%s,
	brewExtract3Weight=%s, 
	brewExtract4=%s,
	brewExtract4Weight=%s, 
	brewExtract5=%s,
	brewExtract5Weight=%s, 
	brewGrain1=%s,
	brewGrain1Weight=%s, 
	brewGrain2=%s,
	brewGrain2Weight=%s, 
	brewGrain3=%s,
	brewGrain3Weight=%s, 
	brewGrain4=%s,
	brewGrain4Weight=%s, 
	brewGrain5=%s,
	brewGrain5Weight=%s, 
	brewGrain6=%s,
	brewGrain6Weight=%s, 
	brewGrain7=%s,
	brewGrain7Weight=%s, 
	brewGrain8=%s,
	brewGrain8Weight=%s, 
	brewGrain9=%s,
	brewGrain9Weight=%s, 
	brewAddition1=%s,
	brewAddition1Amt=%s, 
	brewAddition2=%s,
	brewAddition2Amt=%s, 
	brewAddition3=%s,
	brewAddition3Amt=%s, 
	brewAddition4=%s,
	brewAddition4Amt=%s, 
	brewAddition5=%s,
	brewAddition5Amt=%s, 
	brewAddition6=%s,
	brewAddition6Amt=%s, 
	brewAddition7=%s,
	brewAddition7Amt=%s, 
	brewAddition8=%s,
	brewAddition8Amt=%s, 
	brewAddition9=%s,
	brewAddition9Amt=%s,
	brewHops1=%s,
	brewHops1Weight=%s,
	brewHops1IBU=%s,	
	brewHops1Time=%s, 
	brewHops2=%s,
	brewHops2Weight=%s,
	brewHops2IBU=%s,
	brewHops2Time=%s, 
	brewHops3=%s,
	brewHops3Weight=%s,
	brewHops3IBU=%s,
	brewHops3Time=%s, 
	brewHops4=%s,
	brewHops4Weight=%s,
	brewHops4IBU=%s,
	brewHops4Time=%s, 
	brewHops5=%s,
	brewHops5Weight=%s,
	brewHops5IBU=%s,
	brewHops5Time=%s, 
	brewHops6=%s,
	brewHops6Weight=%s,
	brewHops6IBU=%s,
	brewHops6Time=%s, 
	brewHops7=%s,
	brewHops7Weight=%s,
	brewHops7IBU=%s,
	brewHops7Time=%s, 
	brewHops8=%s,
	brewHops8Weight=%s,
	brewHops8IBU=%s,
	brewHops8Time=%s, 
	brewHops9=%s,
	brewHops9Weight=%s,
	brewHops9IBU=%s,
	brewHops9Time=%s,  
	brewHops1Form=%s,
	brewHops2Form=%s,
	brewHops3Form=%s,
	brewHops4Form=%s,
	brewHops5Form=%s, 
	brewHops6Form=%s,
	brewHops7Form=%s,
	brewHops8Form=%s,
	brewHops9Form=%s, 
	brewOG=%s, 
	brewFG=%s, 
	brewBitterness=%s, 
	brewLovibond=%s, 
	brewBrewerID=%s,
	brewIBUFormula=%s,
 	brewGrain10=%s,
	brewGrain10Weight=%s,
	brewGrain11=%s,
	brewGrain11Weight=%s, 
	brewGrain12=%s,
	brewGrain12Weight=%s, 
	brewGrain13=%s,
	brewGrain13Weight=%s, 
	brewGrain14=%s,
	brewGrain14Weight=%s, 
	brewGrain15=%s,
	brewGrain15Weight=%s, 
	brewHops10=%s,
	brewHops10Weight=%s,
	brewHops10IBU=%s,
	brewHops10Time=%s,
	brewHops10Use=%s,
	brewHops10Type=%s,
	brewHops10Form=%s,
	brewHops11=%s,
	brewHops11Weight=%s,
	brewHops11IBU=%s,
	brewHops11Time=%s,
	brewHops11Use=%s,
	brewHops11Type=%s,
	brewHops11Form=%s,
	brewHops12=%s,
	brewHops12Weight=%s,
	brewHops12IBU=%s,
	brewHops12Time=%s,
	brewHops12Use=%s,
	brewHops12Type=%s,
	brewHops12Form=%s,
	brewHops13=%s,
	brewHops13Weight=%s,
	brewHops13IBU=%s,
	brewHops13Time=%s,
	brewHops13Use=%s,
	brewHops13Type=%s,
	brewHops13Form=%s,
	brewHops14=%s,
	brewHops14Weight=%s,
	brewHops14IBU=%s,
	brewHops14Time=%s,
	brewHops14Use=%s,
	brewHops14Type=%s,
	brewHops14Form=%s,
	brewHops15=%s,
	brewHops15Weight=%s,
	brewHops15IBU=%s,
	brewHops15Time=%s,
	brewHops15Use=%s,
	brewHops15Type=%s,
	brewHops15Form=%s
	WHERE id='%s'",
                       GetSQLValueString($_POST['brewName'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyle'], "text"),
                       GetSQLValueString($_POST['brewYield'], "text"),
                       GetSQLValueString($_POST['brewExtract1'], "text"),
                       GetSQLValueString($_POST['brewExtract1Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract2'], "text"),
                       GetSQLValueString($_POST['brewExtract2Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract3'], "text"),
                       GetSQLValueString($_POST['brewExtract3Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract4'], "text"),
                       GetSQLValueString($_POST['brewExtract4Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract5'], "text"),
                       GetSQLValueString($_POST['brewExtract5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain1'], "text"),
                       GetSQLValueString($_POST['brewGrain1Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain2'], "text"),
                       GetSQLValueString($_POST['brewGrain2Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain3'], "text"),
                       GetSQLValueString($_POST['brewGrain3Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain4'], "text"),
                       GetSQLValueString($_POST['brewGrain4Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain5'], "text"),
                       GetSQLValueString($_POST['brewGrain5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain6'], "text"),
                       GetSQLValueString($_POST['brewGrain6Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain7'], "text"),
                       GetSQLValueString($_POST['brewGrain7Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain8'], "text"),
                       GetSQLValueString($_POST['brewGrain8Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain9'], "text"),
                       GetSQLValueString($_POST['brewGrain9Weight'], "text"),
                       GetSQLValueString($_POST['brewAddition1'], "text"),
                       GetSQLValueString($_POST['brewAddition1Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition2'], "text"),
                       GetSQLValueString($_POST['brewAddition2Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition3'], "text"),
                       GetSQLValueString($_POST['brewAddition3Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition4'], "text"),
                       GetSQLValueString($_POST['brewAddition4Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition5'], "text"),
                       GetSQLValueString($_POST['brewAddition5Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition6'], "text"),
                       GetSQLValueString($_POST['brewAddition6Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition7'], "text"),
                       GetSQLValueString($_POST['brewAddition7Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition8'], "text"),
                       GetSQLValueString($_POST['brewAddition8Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition9'], "text"),
                       GetSQLValueString($_POST['brewAddition9Amt'], "text"),
                       GetSQLValueString($_POST['brewHops1'], "text"),
                       GetSQLValueString($_POST['brewHops1Weight'], "text"),
                       GetSQLValueString($_POST['brewHops1IBU'], "text"),
                       GetSQLValueString($_POST['brewHops1Time'], "text"),
                       GetSQLValueString($_POST['brewHops2'], "text"),
                       GetSQLValueString($_POST['brewHops2Weight'], "text"),
                       GetSQLValueString($_POST['brewHops2IBU'], "text"),
                       GetSQLValueString($_POST['brewHops2Time'], "text"),
                       GetSQLValueString($_POST['brewHops3'], "text"),
                       GetSQLValueString($_POST['brewHops3Weight'], "text"),
                       GetSQLValueString($_POST['brewHops3IBU'], "text"),
                       GetSQLValueString($_POST['brewHops3Time'], "text"),
                       GetSQLValueString($_POST['brewHops4'], "text"),
                       GetSQLValueString($_POST['brewHops4Weight'], "text"),
                       GetSQLValueString($_POST['brewHops4IBU'], "text"),
                       GetSQLValueString($_POST['brewHops4Time'], "text"),
                       GetSQLValueString($_POST['brewHops5'], "text"),
                       GetSQLValueString($_POST['brewHops5Weight'], "text"),
                       GetSQLValueString($_POST['brewHops5IBU'], "text"),
                       GetSQLValueString($_POST['brewHops5Time'], "text"),
                       GetSQLValueString($_POST['brewHops6'], "text"),
                       GetSQLValueString($_POST['brewHops6Weight'], "text"),
                       GetSQLValueString($_POST['brewHops6IBU'], "text"),
                       GetSQLValueString($_POST['brewHops6Time'], "text"),
                       GetSQLValueString($_POST['brewHops7'], "text"),
                       GetSQLValueString($_POST['brewHops7Weight'], "text"),
                       GetSQLValueString($_POST['brewHops7IBU'], "text"),
                       GetSQLValueString($_POST['brewHops7Time'], "text"),
                       GetSQLValueString($_POST['brewHops8'], "text"),
                       GetSQLValueString($_POST['brewHops8Weight'], "text"),
                       GetSQLValueString($_POST['brewHops8IBU'], "text"),
                       GetSQLValueString($_POST['brewHops8Time'], "text"),
                       GetSQLValueString($_POST['brewHops9'], "text"),
                       GetSQLValueString($_POST['brewHops9Weight'], "text"),
                       GetSQLValueString($_POST['brewHops9IBU'], "text"),
                       GetSQLValueString($_POST['brewHops9Time'], "text"),
                       GetSQLValueString($_POST['brewHops1Form'], "text"),
                       GetSQLValueString($_POST['brewHops2Form'], "text"),
                       GetSQLValueString($_POST['brewHops3Form'], "text"),
                       GetSQLValueString($_POST['brewHops4Form'], "text"),
                       GetSQLValueString($_POST['brewHops5Form'], "text"),
                       GetSQLValueString($_POST['brewHops6Form'], "text"),
                       GetSQLValueString($_POST['brewHops7Form'], "text"),
                       GetSQLValueString($_POST['brewHops8Form'], "text"),
                       GetSQLValueString($_POST['brewHops9Form'], "text"),
                       GetSQLValueString($_POST['brewOG'], "text"),
                       GetSQLValueString($_POST['brewFG'], "text"),
                       GetSQLValueString($brewBitterness[0], "text"),
                       GetSQLValueString($_POST['brewLovibond'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($brewBitterness[1], "text"),
					   GetSQLValueString($_POST['brewGrain10'], "text"),
					   GetSQLValueString($_POST['brewGrain10Weight'], "text"),
					   GetSQLValueString($_POST['brewGrain11'], "text"),
					   GetSQLValueString($_POST['brewGrain11Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain12'], "text"),
					   GetSQLValueString($_POST['brewGrain12Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain13'], "text"),
					   GetSQLValueString($_POST['brewGrain13Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain14'], "text"),
					   GetSQLValueString($_POST['brewGrain14Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain15'], "text"),
					   GetSQLValueString($_POST['brewGrain15Weight'], "text"), 
					   GetSQLValueString($_POST['brewHops10'], "text"),
					   GetSQLValueString($_POST['brewHops10Weight'], "text"),
					   GetSQLValueString($_POST['brewHops10IBU'], "text"),
					   GetSQLValueString($_POST['brewHops10Time'], "text"),
					   GetSQLValueString($_POST['brewHops10Use'], "text"),
					   GetSQLValueString($_POST['brewHops10Type'], "text"),
					   GetSQLValueString($_POST['brewHops10Form'], "text"),
					   GetSQLValueString($_POST['brewHops11'], "text"),
					   GetSQLValueString($_POST['brewHops11Weight'], "text"),
					   GetSQLValueString($_POST['brewHops11IBU'], "text"),
					   GetSQLValueString($_POST['brewHops11Time'], "text"),
					   GetSQLValueString($_POST['brewHops11Use'], "text"),
					   GetSQLValueString($_POST['brewHops11Type'], "text"),
					   GetSQLValueString($_POST['brewHops11Form'], "text"),
					   GetSQLValueString($_POST['brewHops12'], "text"),
					   GetSQLValueString($_POST['brewHops12Weight'], "text"),
					   GetSQLValueString($_POST['brewHops12IBU'], "text"),
					   GetSQLValueString($_POST['brewHops12Time'], "text"),
					   GetSQLValueString($_POST['brewHops12Use'], "text"),
					   GetSQLValueString($_POST['brewHops12Type'], "text"),
					   GetSQLValueString($_POST['brewHops12Form'], "text"),
					   GetSQLValueString($_POST['brewHops13'], "text"),
					   GetSQLValueString($_POST['brewHops13Weight'], "text"),
					   GetSQLValueString($_POST['brewHops13IBU'], "text"),
					   GetSQLValueString($_POST['brewHops13Time'], "text"),
					   GetSQLValueString($_POST['brewHops13Use'], "text"),
					   GetSQLValueString($_POST['brewHops13Type'], "text"),
					   GetSQLValueString($_POST['brewHops13Form'], "text"),
					   GetSQLValueString($_POST['brewHops14'], "text"),
					   GetSQLValueString($_POST['brewHops14Weight'], "text"),
					   GetSQLValueString($_POST['brewHops14IBU'], "text"),
					   GetSQLValueString($_POST['brewHops14Time'], "text"),
					   GetSQLValueString($_POST['brewHops14Use'], "text"),
					   GetSQLValueString($_POST['brewHops14Type'], "text"),
					   GetSQLValueString($_POST['brewHops14Form'], "text"),
					   GetSQLValueString($_POST['brewHops15'], "text"),
					   GetSQLValueString($_POST['brewHops15Weight'], "text"),
					   GetSQLValueString($_POST['brewHops15IBU'], "text"),
					   GetSQLValueString($_POST['brewHops15Time'], "text"),
					   GetSQLValueString($_POST['brewHops15Use'], "text"),
					   GetSQLValueString($_POST['brewHops15Type'], "text"),
					   GetSQLValueString($_POST['brewHops15Form'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=".$dbTable."&id=".$id."&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding or Copying a Recipe ------------------------------ //

if ((($action == "add") || ($action == "importRecipe") || ($action == "importCalc")  || ($action == "reuse") || ($action == "import")) && ($dbTable=="recipes")) {
  $insertSQL = sprintf("
INSERT INTO recipes 
(
	brewName, 
	brewStyle, 
	brewSource, 
	brewYield, 
	brewMethod, 
	brewLink1, 
	brewLink1Name, 
	brewLink2, 
	brewLink2Name, 
	brewNotes, 

	brewExtract1, 
	brewExtract1Weight, 
	brewExtract2, 
	brewExtract2Weight, 
	brewExtract3, 
	brewExtract3Weight, 
	brewExtract4, 
	brewExtract4Weight, 
	brewExtract5, 
	brewExtract5Weight, 

	brewGrain1, 
	brewGrain1Weight, 
	brewGrain2, 
	brewGrain2Weight, 
	brewGrain3, 
	brewGrain3Weight, 
	brewGrain4, 
	brewGrain4Weight, 
	brewGrain5, 
	brewGrain5Weight, 

	brewGrain6, 
	brewGrain6Weight, 
	brewGrain7, 
	brewGrain7Weight, 
	brewGrain8, 
	brewGrain8Weight, 
	brewGrain9, 
	brewGrain9Weight, 
	brewAddition1, 
	brewAddition1Amt,
 
	brewAddition2, 
	brewAddition2Amt, 
	brewAddition3, 
	brewAddition3Amt, 
	brewAddition4, 
	brewAddition4Amt, 
	brewAddition5, 
	brewAddition5Amt, 
	brewAddition6, 
	brewAddition6Amt,
 
	brewAddition7, 
	brewAddition7Amt, 
	brewAddition8, 
	brewAddition8Amt, 
	brewAddition9, 
	brewAddition9Amt, 
	brewMisc1Name, 
	brewMisc2Name, 
	brewMisc3Name, 
	brewMisc4Name, 

	brewMisc1Type, 

	brewMisc2Type, 
	brewMisc3Type, 
	brewMisc4Type, 
	brewMisc1Use, 
	brewMisc2Use, 
	brewMisc3Use, 
	brewMisc4Use, 
	brewMisc1Time, 
	brewMisc2Time, 
	brewMisc3Time, 

	brewMisc4Time, 
	brewMisc1Amount, 
	brewMisc2Amount, 
	brewMisc3Amount, 
	brewMisc4Amount, 
	brewHops1, 
	brewHops1Weight, 
	brewHops1IBU,
	brewHops1Time, 
	brewHops2, 

	brewHops2Weight, 
	brewHops2IBU,
	brewHops2Time,
	brewHops3, 
	brewHops3Weight, 
	brewHops3IBU, 
	brewHops3Time, 
	brewHops4, 
	brewHops4Weight, 
	brewHops4IBU, 

	brewHops4Time, 
	brewHops5, 
	brewHops5Weight, 
	brewHops5IBU, 
	brewHops5Time, 
	brewHops6, 
	brewHops6Weight, 
	brewHops6IBU, 
	brewHops6Time, 
	brewHops7, 

	brewHops7Weight, 
	brewHops7IBU, 
	brewHops7Time, 
	brewHops8, 
	brewHops8Weight, 
	brewHops8IBU, 
	brewHops8Time, 
	brewHops9, 
	brewHops9Weight, 
	brewHops9IBU, 

	brewHops9Time, 
	brewHops1Use, 
	brewHops2Use, 
	brewHops3Use, 
	brewHops4Use, 
	brewHops5Use, 
	brewHops6Use, 
	brewHops7Use, 
	brewHops8Use, 
	brewHops9Use, 

	brewHops1Type, 
	brewHops2Type, 
	brewHops3Type, 
	brewHops4Type, 
	brewHops5Type, 
	brewHops6Type, 
	brewHops7Type, 
	brewHops8Type, 
	brewHops9Type, 
	brewHops1Form,

	brewHops2Form, 
	brewHops3Form, 
	brewHops4Form, 
	brewHops5Form, 
	brewHops6Form, 
	brewHops7Form, 
	brewHops8Form, 
	brewHops9Form, 
	brewYeast, 
	brewYeastMan, 
 
	brewYeastForm, 
	brewYeastType, 
	brewYeastAmount, 
	brewOG, 
	brewFG, 
	brewProcedure, 
	brewPrimary, 
	brewPrimaryTemp, 
	brewSecondary, 
	brewSecondaryTemp, 
 
	brewTertiary, 
	brewTertiaryTemp, 
	brewLager, 
	brewLagerTemp,
	brewAge, 
	brewAgeTemp, 
	brewBitterness, 
	brewLovibond, 
	brewIBUFormula, 
	brewYeastProfile, 
 
	brewFeatured, 
	brewbrewerID, 
	brewArchive,
	brewBoilTime,
	brewGrain10,
	brewGrain10Weight,
	brewGrain11,
	brewGrain11Weight, 
	brewGrain12,
	brewGrain12Weight, 
	brewGrain13,
	brewGrain13Weight, 
	brewGrain14,
	brewGrain14Weight, 
	brewGrain15,
	brewGrain15Weight, 
	brewHops10,
	brewHops10Weight,
	brewHops10IBU,
	brewHops10Time,
	brewHops10Use,
	brewHops10Type,
	brewHops10Form,
	brewHops11,
	brewHops11Weight,
	brewHops11IBU,
	brewHops11Time,
	brewHops11Use,
	brewHops11Type,
	brewHops11Form,
	brewHops12,
	brewHops12Weight,
	brewHops12IBU,
	brewHops12Time,
	brewHops12Use,
	brewHops12Type,
	brewHops12Form,
	brewHops13,
	brewHops13Weight,
	brewHops13IBU,
	brewHops13Time,
	brewHops13Use,
	brewHops13Type,
	brewHops13Form,
	brewHops14,
	brewHops14Weight,
	brewHops14IBU,
	brewHops14Time,
	brewHops14Use,
	brewHops14Type,
	brewHops14Form,
	brewHops15,
	brewHops15Weight,
	brewHops15IBU,
	brewHops15Time,
	brewHops15Use,
	brewHops15Type,
	brewHops15Form
)


VALUES (
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
%s, %s, %s, %s, %s, %s, %s, %s, %s
)",

//164 rows
                       GetSQLValueString($_POST['brewName'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyle'], "text"),
                       GetSQLValueString($_POST['brewSource'], "scrubbed"),
                       GetSQLValueString($_POST['brewYield'], "text"),
                       GetSQLValueString($_POST['brewMethod'], "text"),
                       GetSQLValueString($_POST['brewLink1'], "text"),
                       GetSQLValueString($_POST['brewLink1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewLink2'], "text"),
                       GetSQLValueString($_POST['brewLink2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewNotes'], "text"),
                       GetSQLValueString($_POST['brewExtract1'], "text"),
                       GetSQLValueString($_POST['brewExtract1Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract2'], "text"),
                       GetSQLValueString($_POST['brewExtract2Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract3'], "text"),
                       GetSQLValueString($_POST['brewExtract3Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract4'], "text"),
                       GetSQLValueString($_POST['brewExtract4Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract5'], "text"),
                       GetSQLValueString($_POST['brewExtract5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain1'], "text"),
                       GetSQLValueString($_POST['brewGrain1Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain2'], "text"),
                       GetSQLValueString($_POST['brewGrain2Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain3'], "text"),
                       GetSQLValueString($_POST['brewGrain3Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain4'], "text"),
                       GetSQLValueString($_POST['brewGrain4Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain5'], "text"),
                       GetSQLValueString($_POST['brewGrain5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain6'], "text"),
                       GetSQLValueString($_POST['brewGrain6Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain7'], "text"),
                       GetSQLValueString($_POST['brewGrain7Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain8'], "text"),
                       GetSQLValueString($_POST['brewGrain8Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain9'], "text"),
                       GetSQLValueString($_POST['brewGrain9Weight'], "text"),
                       GetSQLValueString($_POST['brewAddition1'], "text"),
                       GetSQLValueString($_POST['brewAddition1Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition2'], "text"),
                       GetSQLValueString($_POST['brewAddition2Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition3'], "text"),
                       GetSQLValueString($_POST['brewAddition3Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition4'], "text"),
                       GetSQLValueString($_POST['brewAddition4Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition5'], "text"),
                       GetSQLValueString($_POST['brewAddition5Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition6'], "text"),
                       GetSQLValueString($_POST['brewAddition6Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition7'], "text"),
                       GetSQLValueString($_POST['brewAddition7Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition8'], "text"),
                       GetSQLValueString($_POST['brewAddition8Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition9'], "text"),
                       GetSQLValueString($_POST['brewAddition9Amt'], "text"),
                       GetSQLValueString($_POST['brewMisc1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc3Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc4Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc1Type'], "text"),
                       GetSQLValueString($_POST['brewMisc2Type'], "text"),
                       GetSQLValueString($_POST['brewMisc3Type'], "text"),
                       GetSQLValueString($_POST['brewMisc4Type'], "text"),
                       GetSQLValueString($_POST['brewMisc1Use'], "text"),
                       GetSQLValueString($_POST['brewMisc2Use'], "text"),
                       GetSQLValueString($_POST['brewMisc3Use'], "text"),
                       GetSQLValueString($_POST['brewMisc4Use'], "text"),
                       GetSQLValueString($_POST['brewMisc1Time'], "text"),
                       GetSQLValueString($_POST['brewMisc2Time'], "text"),
                       GetSQLValueString($_POST['brewMisc3Time'], "text"),
                       GetSQLValueString($_POST['brewMisc4Time'], "text"),
                       GetSQLValueString($_POST['brewMisc1Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc2Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc3Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc4Amount'], "text"),
                       GetSQLValueString($_POST['brewHops1'], "text"),
                       GetSQLValueString($_POST['brewHops1Weight'], "text"),
                       GetSQLValueString($_POST['brewHops1IBU'], "text"),
                       GetSQLValueString($_POST['brewHops1Time'], "text"),
                       GetSQLValueString($_POST['brewHops2'], "text"),
                       GetSQLValueString($_POST['brewHops2Weight'], "text"),
                       GetSQLValueString($_POST['brewHops2IBU'], "text"),
                       GetSQLValueString($_POST['brewHops2Time'], "text"),
                       GetSQLValueString($_POST['brewHops3'], "text"),
                       GetSQLValueString($_POST['brewHops3Weight'], "text"),
                       GetSQLValueString($_POST['brewHops3IBU'], "text"),
                       GetSQLValueString($_POST['brewHops3Time'], "text"),
                       GetSQLValueString($_POST['brewHops4'], "text"),
                       GetSQLValueString($_POST['brewHops4Weight'], "text"),
                       GetSQLValueString($_POST['brewHops4IBU'], "text"),
                       GetSQLValueString($_POST['brewHops4Time'], "text"),
                       GetSQLValueString($_POST['brewHops5'], "text"),
                       GetSQLValueString($_POST['brewHops5Weight'], "text"),
                       GetSQLValueString($_POST['brewHops5IBU'], "text"),
                       GetSQLValueString($_POST['brewHops5Time'], "text"),
                       GetSQLValueString($_POST['brewHops6'], "text"),
                       GetSQLValueString($_POST['brewHops6Weight'], "text"),
                       GetSQLValueString($_POST['brewHops6IBU'], "text"),
                       GetSQLValueString($_POST['brewHops6Time'], "text"),
                       GetSQLValueString($_POST['brewHops7'], "text"),
                       GetSQLValueString($_POST['brewHops7Weight'], "text"),
                       GetSQLValueString($_POST['brewHops7IBU'], "text"),
                       GetSQLValueString($_POST['brewHops7Time'], "text"),
                       GetSQLValueString($_POST['brewHops8'], "text"),
                       GetSQLValueString($_POST['brewHops8Weight'], "text"),
                       GetSQLValueString($_POST['brewHops8IBU'], "text"),
                       GetSQLValueString($_POST['brewHops8Time'], "text"),
                       GetSQLValueString($_POST['brewHops9'], "text"),
                       GetSQLValueString($_POST['brewHops9Weight'], "text"),
                       GetSQLValueString($_POST['brewHops9IBU'], "text"),
                       GetSQLValueString($_POST['brewHops9Time'], "text"),
                       GetSQLValueString($_POST['brewHops1Use'], "text"),
                       GetSQLValueString($_POST['brewHops2Use'], "text"),
                       GetSQLValueString($_POST['brewHops3Use'], "text"),
                       GetSQLValueString($_POST['brewHops4Use'], "text"),
                       GetSQLValueString($_POST['brewHops5Use'], "text"),
                       GetSQLValueString($_POST['brewHops6Use'], "text"),
                       GetSQLValueString($_POST['brewHops7Use'], "text"),
                       GetSQLValueString($_POST['brewHops8Use'], "text"),
                       GetSQLValueString($_POST['brewHops9Use'], "text"),
                       GetSQLValueString($_POST['brewHops1Type'], "text"),
                       GetSQLValueString($_POST['brewHops2Type'], "text"),
                       GetSQLValueString($_POST['brewHops3Type'], "text"),
                       GetSQLValueString($_POST['brewHops4Type'], "text"),
                       GetSQLValueString($_POST['brewHops5Type'], "text"),
                       GetSQLValueString($_POST['brewHops6Type'], "text"),
                       GetSQLValueString($_POST['brewHops7Type'], "text"),
                       GetSQLValueString($_POST['brewHops8Type'], "text"),
                       GetSQLValueString($_POST['brewHops9Type'], "text"),
                       GetSQLValueString($_POST['brewHops1Form'], "text"),
                       GetSQLValueString($_POST['brewHops2Form'], "text"),
                       GetSQLValueString($_POST['brewHops3Form'], "text"),
                       GetSQLValueString($_POST['brewHops4Form'], "text"),
                       GetSQLValueString($_POST['brewHops5Form'], "text"),
                       GetSQLValueString($_POST['brewHops6Form'], "text"),
                       GetSQLValueString($_POST['brewHops7Form'], "text"),
                       GetSQLValueString($_POST['brewHops8Form'], "text"),
                       GetSQLValueString($_POST['brewHops9Form'], "text"),
                       GetSQLValueString($_POST['brewYeast'], "scrubbed"),
                       GetSQLValueString($_POST['brewYeastMan'], "scrubbed"),
                       GetSQLValueString($_POST['brewYeastForm'], "text"),
                       GetSQLValueString($_POST['brewYeastType'], "text"),
                       GetSQLValueString($_POST['brewYeastAmount'], "scrubbed"),
                       GetSQLValueString($_POST['brewOG'], "text"),
                       GetSQLValueString($_POST['brewFG'], "text"),
                       GetSQLValueString($_POST['brewProcedure'], "text"),
                       GetSQLValueString($_POST['brewPrimary'], "text"),
                       GetSQLValueString($_POST['brewPrimaryTemp'], "text"),
                       GetSQLValueString($_POST['brewSecondary'], "text"),
                       GetSQLValueString($_POST['brewSecondaryTemp'], "text"),
                       GetSQLValueString($_POST['brewTertiary'], "text"),
                       GetSQLValueString($_POST['brewTertiaryTemp'], "text"),
                       GetSQLValueString($_POST['brewLager'], "text"),
                       GetSQLValueString($_POST['brewLagerTemp'], "text"),
                       GetSQLValueString($_POST['brewAge'], "text"),
                       GetSQLValueString($_POST['brewAgeTemp'], "text"),
                       GetSQLValueString($_POST['brewBitterness'], "text"),
                       GetSQLValueString($_POST['brewLovibond'], "text"),
					   GetSQLValueString($_POST['brewIBUFormula'], "text"),
					   GetSQLValueString($_POST['brewYeastProfile'], "text"),
					   GetSQLValueString($_POST['brewFeatured'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($_POST['brewArchive'], "text"),
					   GetSQLValueString($_POST['brewBoilTime'], "text"),
					   GetSQLValueString($_POST['brewGrain10'], "text"),
					   GetSQLValueString($_POST['brewGrain10Weight'], "text"),
					   GetSQLValueString($_POST['brewGrain11'], "text"),
					   GetSQLValueString($_POST['brewGrain11Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain12'], "text"),
					   GetSQLValueString($_POST['brewGrain12Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain13'], "text"),
					   GetSQLValueString($_POST['brewGrain13Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain14'], "text"),
					   GetSQLValueString($_POST['brewGrain14Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain15'], "text"),
					   GetSQLValueString($_POST['brewGrain15Weight'], "text"), 
					   GetSQLValueString($_POST['brewHops10'], "text"),
					   GetSQLValueString($_POST['brewHops10Weight'], "text"),
					   GetSQLValueString($_POST['brewHops10IBU'], "text"),
					   GetSQLValueString($_POST['brewHops10Time'], "text"),
					   GetSQLValueString($_POST['brewHops10Use'], "text"),
					   GetSQLValueString($_POST['brewHops10Type'], "text"),
					   GetSQLValueString($_POST['brewHops10Form'], "text"),
					   GetSQLValueString($_POST['brewHops11'], "text"),
					   GetSQLValueString($_POST['brewHops11Weight'], "text"),
					   GetSQLValueString($_POST['brewHops11IBU'], "text"),
					   GetSQLValueString($_POST['brewHops11Time'], "text"),
					   GetSQLValueString($_POST['brewHops11Use'], "text"),
					   GetSQLValueString($_POST['brewHops11Type'], "text"),
					   GetSQLValueString($_POST['brewHops11Form'], "text"),
					   GetSQLValueString($_POST['brewHops12'], "text"),
					   GetSQLValueString($_POST['brewHops12Weight'], "text"),
					   GetSQLValueString($_POST['brewHops12IBU'], "text"),
					   GetSQLValueString($_POST['brewHops12Time'], "text"),
					   GetSQLValueString($_POST['brewHops12Use'], "text"),
					   GetSQLValueString($_POST['brewHops12Type'], "text"),
					   GetSQLValueString($_POST['brewHops12Form'], "text"),
					   GetSQLValueString($_POST['brewHops13'], "text"),
					   GetSQLValueString($_POST['brewHops13Weight'], "text"),
					   GetSQLValueString($_POST['brewHops13IBU'], "text"),
					   GetSQLValueString($_POST['brewHops13Time'], "text"),
					   GetSQLValueString($_POST['brewHops13Use'], "text"),
					   GetSQLValueString($_POST['brewHops13Type'], "text"),
					   GetSQLValueString($_POST['brewHops13Form'], "text"),
					   GetSQLValueString($_POST['brewHops14'], "text"),
					   GetSQLValueString($_POST['brewHops14Weight'], "text"),
					   GetSQLValueString($_POST['brewHops14IBU'], "text"),
					   GetSQLValueString($_POST['brewHops14Time'], "text"),
					   GetSQLValueString($_POST['brewHops14Use'], "text"),
					   GetSQLValueString($_POST['brewHops14Type'], "text"),
					   GetSQLValueString($_POST['brewHops14Form'], "text"),
					   GetSQLValueString($_POST['brewHops15'], "text"),
					   GetSQLValueString($_POST['brewHops15Weight'], "text"),
					   GetSQLValueString($_POST['brewHops15IBU'], "text"),
					   GetSQLValueString($_POST['brewHops15Time'], "text"),
					   GetSQLValueString($_POST['brewHops15Use'], "text"),
					   GetSQLValueString($_POST['brewHops15Type'], "text"),
					   GetSQLValueString($_POST['brewHops15Form'], "text")
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=recipes&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Recipe -------------------------------------- //

if (($action == "edit") && ($dbTable == "recipes")) { 
  $updateSQL = sprintf(
"UPDATE recipes SET 

brewName=%s, 
brewStyle=%s, 
brewSource=%s, 
brewYield=%s, 
brewMethod=%s, 
brewLink1=%s, 
brewLink1Name=%s, 
brewLink2=%s, 
brewLink2Name=%s, 
brewNotes=%s, 

brewExtract1=%s, 
brewExtract1Weight=%s, 
brewExtract2=%s, 
brewExtract2Weight=%s, 
brewExtract3=%s, 
brewExtract3Weight=%s, 
brewExtract4=%s, 
brewExtract4Weight=%s, 
brewExtract5=%s, 
brewExtract5Weight=%s, 

brewGrain1=%s, 
brewGrain1Weight=%s, 
brewGrain2=%s, 
brewGrain2Weight=%s, 
brewGrain3=%s, 
brewGrain3Weight=%s, 
brewGrain4=%s, 
brewGrain4Weight=%s, 
brewGrain5=%s, 
brewGrain5Weight=%s, 

brewGrain6=%s, 
brewGrain6Weight=%s, 
brewGrain7=%s, 
brewGrain7Weight=%s, 
brewGrain8=%s, 
brewGrain8Weight=%s, 
brewGrain9=%s, 
brewGrain9Weight=%s, 
brewAddition1=%s, 
brewAddition1Amt=%s,
 
brewAddition2=%s, 
brewAddition2Amt=%s, 
brewAddition3=%s, 
brewAddition3Amt=%s, 
brewAddition4=%s, 
brewAddition4Amt=%s, 
brewAddition5=%s, 
brewAddition5Amt=%s, 
brewAddition6=%s, 
brewAddition6Amt=%s,
 
brewAddition7=%s, 
brewAddition7Amt=%s, 
brewAddition8=%s, 
brewAddition8Amt=%s, 
brewAddition9=%s, 
brewAddition9Amt=%s, 
brewMisc1Name=%s, 
brewMisc2Name=%s, 
brewMisc3Name=%s, 
brewMisc4Name=%s, 

brewMisc1Type=%s, 

brewMisc2Type=%s, 
brewMisc3Type=%s, 
brewMisc4Type=%s, 
brewMisc1Use=%s, 
brewMisc2Use=%s, 
brewMisc3Use=%s, 
brewMisc4Use=%s, 
brewMisc1Time=%s, 
brewMisc2Time=%s, 
brewMisc3Time=%s, 

brewMisc4Time=%s, 
brewMisc1Amount=%s, 
brewMisc2Amount=%s, 
brewMisc3Amount=%s, 
brewMisc4Amount=%s, 
brewHops1=%s, 
brewHops1Weight=%s, 
brewHops1IBU=%s,
brewHops1Time=%s, 
brewHops2=%s, 

brewHops2Weight=%s, 
brewHops2IBU=%s,
brewHops2Time=%s,
brewHops3=%s, 
brewHops3Weight=%s, 
brewHops3IBU=%s, 
brewHops3Time=%s, 
brewHops4=%s, 
brewHops4Weight=%s, 
brewHops4IBU=%s, 

brewHops4Time=%s, 
brewHops5=%s, 
brewHops5Weight=%s, 
brewHops5IBU=%s, 
brewHops5Time=%s, 
brewHops6=%s, 
brewHops6Weight=%s, 
brewHops6IBU=%s, 
brewHops6Time=%s, 
brewHops7=%s, 

brewHops7Weight=%s, 
brewHops7IBU=%s, 
brewHops7Time=%s, 
brewHops8=%s, 
brewHops8Weight=%s, 
brewHops8IBU=%s, 
brewHops8Time=%s, 
brewHops9=%s, 
brewHops9Weight=%s, 
brewHops9IBU=%s, 

brewHops9Time=%s, 
brewHops1Use=%s, 
brewHops2Use=%s, 
brewHops3Use=%s, 
brewHops4Use=%s, 
brewHops5Use=%s, 
brewHops6Use=%s, 
brewHops7Use=%s, 
brewHops8Use=%s, 
brewHops9Use=%s, 

brewHops1Type=%s, 
brewHops2Type=%s, 
brewHops3Type=%s, 
brewHops4Type=%s, 
brewHops5Type=%s, 
brewHops6Type=%s, 
brewHops7Type=%s, 
brewHops8Type=%s, 
brewHops9Type=%s, 
brewHops1Form=%s,

brewHops2Form=%s, 
brewHops3Form=%s, 
brewHops4Form=%s, 
brewHops5Form=%s, 
brewHops6Form=%s, 
brewHops7Form=%s, 
brewHops8Form=%s, 
brewHops9Form=%s, 
brewYeast=%s, 
brewYeastMan=%s, 
 
brewYeastForm=%s, 
brewYeastType=%s, 
brewYeastAmount=%s, 
brewOG=%s, 
brewFG=%s, 
brewProcedure=%s, 
brewPrimary=%s, 
brewPrimaryTemp=%s, 
brewSecondary=%s, 
brewSecondaryTemp=%s, 
 
brewTertiary=%s, 
brewTertiaryTemp=%s, 
brewLager=%s, 
brewLagerTemp=%s,
brewAge=%s, 
brewAgeTemp=%s, 
brewBitterness=%s, 
brewLovibond=%s, 
brewIBUFormula=%s, 
brewYeastProfile=%s, 
 
brewFeatured=%s, 
brewBrewerID=%s, 
brewArchive=%s,
brewBoilTime=%s,

 	brewGrain10=%s,
	brewGrain10Weight=%s,
	brewGrain11=%s,
	brewGrain11Weight=%s, 
	brewGrain12=%s,
	brewGrain12Weight=%s, 
	brewGrain13=%s,
	brewGrain13Weight=%s, 
	brewGrain14=%s,
	brewGrain14Weight=%s, 
	brewGrain15=%s,
	brewGrain15Weight=%s, 
	brewHops10=%s,
	brewHops10Weight=%s,
	brewHops10IBU=%s,
	brewHops10Time=%s,
	brewHops10Use=%s,
	brewHops10Type=%s,
	brewHops10Form=%s,
	brewHops11=%s,
	brewHops11Weight=%s,
	brewHops11IBU=%s,
	brewHops11Time=%s,
	brewHops11Use=%s,
	brewHops11Type=%s,
	brewHops11Form=%s,
	brewHops12=%s,
	brewHops12Weight=%s,
	brewHops12IBU=%s,
	brewHops12Time=%s,
	brewHops12Use=%s,
	brewHops12Type=%s,
	brewHops12Form=%s,
	brewHops13=%s,
	brewHops13Weight=%s,
	brewHops13IBU=%s,
	brewHops13Time=%s,
	brewHops13Use=%s,
	brewHops13Type=%s,
	brewHops13Form=%s,
	brewHops14=%s,
	brewHops14Weight=%s,
	brewHops14IBU=%s,
	brewHops14Time=%s,
	brewHops14Use=%s,
	brewHops14Type=%s,
	brewHops14Form=%s,
	brewHops15=%s,
	brewHops15Weight=%s,
	brewHops15IBU=%s,
	brewHops15Time=%s,
	brewHops15Use=%s,
	brewHops15Type=%s,
	brewHops15Form=%s


WHERE id='%s'",

//164
                       GetSQLValueString($_POST['brewName'], "scrubbed"),
                       GetSQLValueString($_POST['brewStyle'], "text"),
                       GetSQLValueString($_POST['brewSource'], "scrubbed"),
                       GetSQLValueString($_POST['brewYield'], "text"),
                       GetSQLValueString($_POST['brewMethod'], "text"),
                       GetSQLValueString($_POST['brewLink1'], "text"),
                       GetSQLValueString($_POST['brewLink1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewLink2'], "text"),
                       GetSQLValueString($_POST['brewLink2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewNotes'], "text"),
                       GetSQLValueString($_POST['brewExtract1'], "text"),
                       GetSQLValueString($_POST['brewExtract1Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract2'], "text"),
                       GetSQLValueString($_POST['brewExtract2Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract3'], "text"),
                       GetSQLValueString($_POST['brewExtract3Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract4'], "text"),
                       GetSQLValueString($_POST['brewExtract4Weight'], "text"),
                       GetSQLValueString($_POST['brewExtract5'], "text"),
                       GetSQLValueString($_POST['brewExtract5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain1'], "text"),
                       GetSQLValueString($_POST['brewGrain1Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain2'], "text"),
                       GetSQLValueString($_POST['brewGrain2Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain3'], "text"),
                       GetSQLValueString($_POST['brewGrain3Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain4'], "text"),
                       GetSQLValueString($_POST['brewGrain4Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain5'], "text"),
                       GetSQLValueString($_POST['brewGrain5Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain6'], "text"),
                       GetSQLValueString($_POST['brewGrain6Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain7'], "text"),
                       GetSQLValueString($_POST['brewGrain7Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain8'], "text"),
                       GetSQLValueString($_POST['brewGrain8Weight'], "text"),
                       GetSQLValueString($_POST['brewGrain9'], "text"),
                       GetSQLValueString($_POST['brewGrain9Weight'], "text"),
                       GetSQLValueString($_POST['brewAddition1'], "text"),
                       GetSQLValueString($_POST['brewAddition1Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition2'], "text"),
                       GetSQLValueString($_POST['brewAddition2Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition3'], "text"),
                       GetSQLValueString($_POST['brewAddition3Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition4'], "text"),
                       GetSQLValueString($_POST['brewAddition4Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition5'], "text"),
                       GetSQLValueString($_POST['brewAddition5Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition6'], "text"),
                       GetSQLValueString($_POST['brewAddition6Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition7'], "text"),
                       GetSQLValueString($_POST['brewAddition7Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition8'], "text"),
                       GetSQLValueString($_POST['brewAddition8Amt'], "text"),
                       GetSQLValueString($_POST['brewAddition9'], "text"),
                       GetSQLValueString($_POST['brewAddition9Amt'], "text"),
                       GetSQLValueString($_POST['brewMisc1Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc2Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc3Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc4Name'], "scrubbed"),
                       GetSQLValueString($_POST['brewMisc1Type'], "text"),
                       GetSQLValueString($_POST['brewMisc2Type'], "text"),
                       GetSQLValueString($_POST['brewMisc3Type'], "text"),
                       GetSQLValueString($_POST['brewMisc4Type'], "text"),
                       GetSQLValueString($_POST['brewMisc1Use'], "text"),
                       GetSQLValueString($_POST['brewMisc2Use'], "text"),
                       GetSQLValueString($_POST['brewMisc3Use'], "text"),
                       GetSQLValueString($_POST['brewMisc4Use'], "text"),
                       GetSQLValueString($_POST['brewMisc1Time'], "text"),
                       GetSQLValueString($_POST['brewMisc2Time'], "text"),
                       GetSQLValueString($_POST['brewMisc3Time'], "text"),
                       GetSQLValueString($_POST['brewMisc4Time'], "text"),
                       GetSQLValueString($_POST['brewMisc1Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc2Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc3Amount'], "text"),
                       GetSQLValueString($_POST['brewMisc4Amount'], "text"),
                       GetSQLValueString($_POST['brewHops1'], "text"),
                       GetSQLValueString($_POST['brewHops1Weight'], "text"),
                       GetSQLValueString($_POST['brewHops1IBU'], "text"),
                       GetSQLValueString($_POST['brewHops1Time'], "text"),
                       GetSQLValueString($_POST['brewHops2'], "text"),
                       GetSQLValueString($_POST['brewHops2Weight'], "text"),
                       GetSQLValueString($_POST['brewHops2IBU'], "text"),
                       GetSQLValueString($_POST['brewHops2Time'], "text"),
                       GetSQLValueString($_POST['brewHops3'], "text"),
                       GetSQLValueString($_POST['brewHops3Weight'], "text"),
                       GetSQLValueString($_POST['brewHops3IBU'], "text"),
                       GetSQLValueString($_POST['brewHops3Time'], "text"),
                       GetSQLValueString($_POST['brewHops4'], "text"),
                       GetSQLValueString($_POST['brewHops4Weight'], "text"),
                       GetSQLValueString($_POST['brewHops4IBU'], "text"),
                       GetSQLValueString($_POST['brewHops4Time'], "text"),
                       GetSQLValueString($_POST['brewHops5'], "text"),
                       GetSQLValueString($_POST['brewHops5Weight'], "text"),
                       GetSQLValueString($_POST['brewHops5IBU'], "text"),
                       GetSQLValueString($_POST['brewHops5Time'], "text"),
                       GetSQLValueString($_POST['brewHops6'], "text"),
                       GetSQLValueString($_POST['brewHops6Weight'], "text"),
                       GetSQLValueString($_POST['brewHops6IBU'], "text"),
                       GetSQLValueString($_POST['brewHops6Time'], "text"),
                       GetSQLValueString($_POST['brewHops7'], "text"),
                       GetSQLValueString($_POST['brewHops7Weight'], "text"),
                       GetSQLValueString($_POST['brewHops7IBU'], "text"),
                       GetSQLValueString($_POST['brewHops7Time'], "text"),
                       GetSQLValueString($_POST['brewHops8'], "text"),
                       GetSQLValueString($_POST['brewHops8Weight'], "text"),
                       GetSQLValueString($_POST['brewHops8IBU'], "text"),
                       GetSQLValueString($_POST['brewHops8Time'], "text"),
                       GetSQLValueString($_POST['brewHops9'], "text"),
                       GetSQLValueString($_POST['brewHops9Weight'], "text"),
                       GetSQLValueString($_POST['brewHops9IBU'], "text"),
                       GetSQLValueString($_POST['brewHops9Time'], "text"),
                       GetSQLValueString($_POST['brewHops1Use'], "text"),
                       GetSQLValueString($_POST['brewHops2Use'], "text"),
                       GetSQLValueString($_POST['brewHops3Use'], "text"),
                       GetSQLValueString($_POST['brewHops4Use'], "text"),
                       GetSQLValueString($_POST['brewHops5Use'], "text"),
                       GetSQLValueString($_POST['brewHops6Use'], "text"),
                       GetSQLValueString($_POST['brewHops7Use'], "text"),
                       GetSQLValueString($_POST['brewHops8Use'], "text"),
                       GetSQLValueString($_POST['brewHops9Use'], "text"),
                       GetSQLValueString($_POST['brewHops1Type'], "text"),
                       GetSQLValueString($_POST['brewHops2Type'], "text"),
                       GetSQLValueString($_POST['brewHops3Type'], "text"),
                       GetSQLValueString($_POST['brewHops4Type'], "text"),
                       GetSQLValueString($_POST['brewHops5Type'], "text"),
                       GetSQLValueString($_POST['brewHops6Type'], "text"),
                       GetSQLValueString($_POST['brewHops7Type'], "text"),
                       GetSQLValueString($_POST['brewHops8Type'], "text"),
                       GetSQLValueString($_POST['brewHops9Type'], "text"),
                       GetSQLValueString($_POST['brewHops1Form'], "text"),
                       GetSQLValueString($_POST['brewHops2Form'], "text"),
                       GetSQLValueString($_POST['brewHops3Form'], "text"),
                       GetSQLValueString($_POST['brewHops4Form'], "text"),
                       GetSQLValueString($_POST['brewHops5Form'], "text"),
                       GetSQLValueString($_POST['brewHops6Form'], "text"),
                       GetSQLValueString($_POST['brewHops7Form'], "text"),
                       GetSQLValueString($_POST['brewHops8Form'], "text"),
                       GetSQLValueString($_POST['brewHops9Form'], "text"),
                       GetSQLValueString($_POST['brewYeast'], "scrubbed"),
                       GetSQLValueString($_POST['brewYeastMan'], "scrubbed"),
                       GetSQLValueString($_POST['brewYeastForm'], "text"),
                       GetSQLValueString($_POST['brewYeastType'], "text"),
                       GetSQLValueString($_POST['brewYeastAmount'], "scrubbed"),
                       GetSQLValueString($_POST['brewOG'], "text"),
                       GetSQLValueString($_POST['brewFG'], "text"),
                       GetSQLValueString($_POST['brewProcedure'], "text"),
                       GetSQLValueString($_POST['brewPrimary'], "text"),
                       GetSQLValueString($_POST['brewPrimaryTemp'], "text"),
                       GetSQLValueString($_POST['brewSecondary'], "text"),
                       GetSQLValueString($_POST['brewSecondaryTemp'], "text"),
                       GetSQLValueString($_POST['brewTertiary'], "text"),
                       GetSQLValueString($_POST['brewTertiaryTemp'], "text"),
                       GetSQLValueString($_POST['brewLager'], "text"),
                       GetSQLValueString($_POST['brewLagerTemp'], "text"),
                       GetSQLValueString($_POST['brewAge'], "text"),
                       GetSQLValueString($_POST['brewAgeTemp'], "text"),
                       GetSQLValueString($_POST['brewBitterness'], "text"),
                       GetSQLValueString($_POST['brewLovibond'], "text"),
					   GetSQLValueString($_POST['brewIBUFormula'], "text"),
					   GetSQLValueString($_POST['brewYeastProfile'], "text"),
					   GetSQLValueString($_POST['brewFeatured'], "text"),
					   GetSQLValueString($_POST['brewBrewerID'], "text"),
					   GetSQLValueString($_POST['brewArchive'], "text"),
					   GetSQLValueString($_POST['brewBoilTime'], "text"),
					   GetSQLValueString($_POST['brewGrain10'], "text"),
					   GetSQLValueString($_POST['brewGrain10Weight'], "text"),
					   GetSQLValueString($_POST['brewGrain11'], "text"),
					   GetSQLValueString($_POST['brewGrain11Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain12'], "text"),
					   GetSQLValueString($_POST['brewGrain12Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain13'], "text"),
					   GetSQLValueString($_POST['brewGrain13Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain14'], "text"),
					   GetSQLValueString($_POST['brewGrain14Weight'], "text"), 
					   GetSQLValueString($_POST['brewGrain15'], "text"),
					   GetSQLValueString($_POST['brewGrain15Weight'], "text"), 
					   GetSQLValueString($_POST['brewHops10'], "text"),
					   GetSQLValueString($_POST['brewHops10Weight'], "text"),
					   GetSQLValueString($_POST['brewHops10IBU'], "text"),
					   GetSQLValueString($_POST['brewHops10Time'], "text"),
					   GetSQLValueString($_POST['brewHops10Use'], "text"),
					   GetSQLValueString($_POST['brewHops10Type'], "text"),
					   GetSQLValueString($_POST['brewHops10Form'], "text"),
					   GetSQLValueString($_POST['brewHops11'], "text"),
					   GetSQLValueString($_POST['brewHops11Weight'], "text"),
					   GetSQLValueString($_POST['brewHops11IBU'], "text"),
					   GetSQLValueString($_POST['brewHops11Time'], "text"),
					   GetSQLValueString($_POST['brewHops11Use'], "text"),
					   GetSQLValueString($_POST['brewHops11Type'], "text"),
					   GetSQLValueString($_POST['brewHops11Form'], "text"),
					   GetSQLValueString($_POST['brewHops12'], "text"),
					   GetSQLValueString($_POST['brewHops12Weight'], "text"),
					   GetSQLValueString($_POST['brewHops12IBU'], "text"),
					   GetSQLValueString($_POST['brewHops12Time'], "text"),
					   GetSQLValueString($_POST['brewHops12Use'], "text"),
					   GetSQLValueString($_POST['brewHops12Type'], "text"),
					   GetSQLValueString($_POST['brewHops12Form'], "text"),
					   GetSQLValueString($_POST['brewHops13'], "text"),
					   GetSQLValueString($_POST['brewHops13Weight'], "text"),
					   GetSQLValueString($_POST['brewHops13IBU'], "text"),
					   GetSQLValueString($_POST['brewHops13Time'], "text"),
					   GetSQLValueString($_POST['brewHops13Use'], "text"),
					   GetSQLValueString($_POST['brewHops13Type'], "text"),
					   GetSQLValueString($_POST['brewHops13Form'], "text"),
					   GetSQLValueString($_POST['brewHops14'], "text"),
					   GetSQLValueString($_POST['brewHops14Weight'], "text"),
					   GetSQLValueString($_POST['brewHops14IBU'], "text"),
					   GetSQLValueString($_POST['brewHops14Time'], "text"),
					   GetSQLValueString($_POST['brewHops14Use'], "text"),
					   GetSQLValueString($_POST['brewHops14Type'], "text"),
					   GetSQLValueString($_POST['brewHops14Form'], "text"),
					   GetSQLValueString($_POST['brewHops15'], "text"),
					   GetSQLValueString($_POST['brewHops15Weight'], "text"),
					   GetSQLValueString($_POST['brewHops15IBU'], "text"),
					   GetSQLValueString($_POST['brewHops15Time'], "text"),
					   GetSQLValueString($_POST['brewHops15Use'], "text"),
					   GetSQLValueString($_POST['brewHops15Type'], "text"),
					   GetSQLValueString($_POST['brewHops15Form'], "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=recipes&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Editing	brewer Profile -------------------------------------- //

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
  waterDisplayMethod=%s
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
   $password = md5($_POST['password']);
   $insertSQL = sprintf("INSERT INTO users (
   user_name, 
   password, 
   realFirstName, 
   realLastName, 
   userLevel,
    
   userProfile, 
   userPicURL, 
   userFavStyles, 
   userFavCommercial, 
   userFavQuote,
    
   userDesignations, 
   userOccupation,
   userHobbies, 
   userBirthdate, 
   userHometown,
    
   userBrewingSince, 
   userWebsiteName, 
   userWebsiteURL, 
   userPosition, 
   userPastPosition,
    
   userInfoPrivate,
   userAddress, 
   userCity, 
   userState, 
   userZip, 
   
   userPhoneH, 
   userPhoneW, 
   userEmail,
   defaultBoilTime,
   defaultEquipProfile, 
   
   defaultMashProfile,
   defaultWaterProfile,
   defaultBitternessFormula,
   defaultMethod,
   defaultBatchSize,
   defaultWaterRatio
   ) 
   VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", 
                       GetSQLValueString($_POST['user_name'], "text"),
                       GetSQLValueString($password, "text"),
					   GetSQLValueString($_POST['realFirstName'], "scrubbed"),
					   GetSQLValueString($_POST['realLastName'], "scrubbed"),
					   GetSQLValueString($_POST['userLevel'], "text"),
					   
					   GetSQLValueString($_POST['userProfile'], "text"),
					   GetSQLValueString($_POST['userPicURL'], "text"),
					   GetSQLValueString($_POST['userFavStyles'], "scrubbed"),
					   GetSQLValueString($_POST['userFavCommercial'], "scrubbed"),
					   GetSQLValueString($_POST['userFavQuote'], "scrubbed"),
					   
					   GetSQLValueString($_POST['userDesignations'], "scrubbed"),
					   GetSQLValueString($_POST['userOccupation'], "scrubbed"),
					   GetSQLValueString($_POST['userHobbies'], "scrubbed"),
					   GetSQLValueString($_POST['userBirthdate'], "text"),
					   GetSQLValueString($_POST['userHometown'], "scrubbed"),
					   
					   GetSQLValueString($_POST['userBrewingSince'], "text"),
					   GetSQLValueString($_POST['userWebsiteName'], "scrubbed"),
					   GetSQLValueString($_POST['userWebsiteURL'], "text"),
					   GetSQLValueString($_POST['userPosition'], "scrubbed"),
					   GetSQLValueString($_POST['userPastPosition'], "scrubbed"),
					   
					   GetSQLValueString($_POST['userInfoPrivate'], "text"),
					   GetSQLValueString($_POST['userAddress'], "scrubbed"),
					   GetSQLValueString($_POST['userCity'], "scrubbed"),
					   GetSQLValueString($_POST['userState'], "scrubbed"),
					   GetSQLValueString($_POST['userZip'], "text"),
					   
					   GetSQLValueString($_POST['userPhoneH'], "text"),
					   GetSQLValueString($_POST['userPhoneW'], "text"),
					   GetSQLValueString($_POST['userEmail'], "text"),
					   GetSQLValueString($_POST['defaultBoilTime'], "text"),
					   GetSQLValueString($_POST['defaultEquipProfile'], "text"), 
					   
					   GetSQLValueString($_POST['defaultMashProfile'], "text"),
					   GetSQLValueString($_POST['defaultWaterProfile'], "text"),
					   GetSQLValueString($_POST['defaultBitternessFormula'], "text"),
					   GetSQLValueString($_POST['defaultMethod'], "text"),
					   GetSQLValueString($_POST['defaultBatchSize'], "text"),
					   GetSQLValueString($_POST['defaultWaterRatio'], "text")
					   ); 

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=users&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a User ----------------------------- //

if (($action == "edit") && ($dbTable == "users") && ($section == "password")) 
{
$admin = $_POST['admin'];
mysql_select_db($database_brewing, $brewing);
$query_user5 = sprintf("SELECT user_name,password FROM users WHERE id = '%s'", $id);
$user5 = mysql_query($query_user5, $brewing) or die(mysql_error());
$row_user5 = mysql_fetch_assoc($user5);
$totalRows_user5 = mysql_num_rows($user5);

  $password =   md5($_POST['password']);
  if (($reset == "default") && ($admin == "nonpriv")){ 
  $passwordOld = md5($_POST['passwordOld']); $confirmPass = $row_user5['password']; 
  if ($confirmPass != $passwordOld) 
  header ("Location: index.php?action=edit&dbTable=users&id=".$id."&confirm=false&section=password&msg=2"); 
  } 
  if (($confirmPass == $passwordOld) || ($reset == "true") || ($admin == "admin"))
	   {
  $updateSQL = sprintf("UPDATE users SET password=%s WHERE id=%s",
                       GetSQLValueString($password, "text"),
                       GetSQLValueString($id, "int")); 
					   
  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=users&confirm=true&section=password&msg=2";
  if ($admin == "admin") $updateGoTo .= "&filter=".$row_user5['user_name']."&assoc=".$_POST['password'];
  header(sprintf("Location: %s", $updateGoTo));
   }
}
if (($action == "edit") && ($dbTable == "users") && ($section == "default")) 
{
$updateSQL = sprintf("UPDATE users SET user_name=%s, realFirstName=%s, realLastName=%s, 
  userLevel=%s, userProfile=%s, userPicURL=%s, userFavStyles=%s, userFavCommercial=%s, userFavQuote=%s, 
  userDesignations=%s, userOccupation=%s, userHobbies=%s, userBirthdate=%s, userHometown=%s, 
  userBrewingSince=%s, userWebsiteName=%s, userWebsiteURL=%s, userPosition=%s, userPastPosition=%s, userInfoPrivate=%s,
  userAddress=%s, userCity=%s, userState=%s, userZip=%s, userPhoneH=%s, userPhoneW=%s, userEmail=%s,
  defaultBoilTime=%s,
  defaultEquipProfile=%s, 
  defaultMashProfile=%s,
  defaultWaterProfile=%s,
  defaultBitternessFormula=%s,
  defaultMethod=%s,
  defaultBatchSize=%s,
  defaultWaterRatio=%s
  WHERE id=%s",
                       GetSQLValueString($_POST['user_name'], "text"),
					   GetSQLValueString($_POST['realFirstName'], "scrubbed"),
					   GetSQLValueString($_POST['realLastName'], "scrubbed"),
					   GetSQLValueString($_POST['userLevel'], "text"),
					   GetSQLValueString($_POST['userProfile'], "text"),
					   GetSQLValueString($_POST['userPicURL'], "text"),
					   GetSQLValueString($_POST['userFavStyles'], "scrubbed"),
					   GetSQLValueString($_POST['userFavCommercial'], "scrubbed"),
					   GetSQLValueString($_POST['userFavQuote'], "scrubbed"),
					   GetSQLValueString($_POST['userDesignations'], "scrubbed"),
					   GetSQLValueString($_POST['userOccupation'], "scrubbed"),
					   GetSQLValueString($_POST['userHobbies'], "scrubbed"),
					   GetSQLValueString($_POST['userBirthdate'], "text"),
					   GetSQLValueString($_POST['userHometown'], "scrubbed"),
					   GetSQLValueString($_POST['userBrewingSince'], "scrubbed"),
					   GetSQLValueString($_POST['userWebsiteName'], "scrubbed"),
					   GetSQLValueString($_POST['userWebsiteURL'], "text"),
					   GetSQLValueString($_POST['userPosition'], "scrubbed"),
					   GetSQLValueString($_POST['userPastPosition'], "scrubbed"),
					   GetSQLValueString($_POST['userInfoPrivate'], "text"),
					   GetSQLValueString($_POST['userAddress'], "scrubbed"),
					   GetSQLValueString($_POST['userCity'], "scrubbed"),
					   GetSQLValueString($_POST['userState'], "scrubbed"),
					   GetSQLValueString($_POST['userZip'], "text"),
					   GetSQLValueString($_POST['userPhoneH'], "text"),
					   GetSQLValueString($_POST['userPhoneW'], "text"),
					   GetSQLValueString($_POST['userEmail'], "text"),
					   GetSQLValueString($_POST['defaultBoilTime'], "text"),
					   GetSQLValueString($_POST['defaultEquipProfile'], "text"), 
					   GetSQLValueString($_POST['defaultMashProfile'], "text"),
					   GetSQLValueString($_POST['defaultWaterProfile'], "text"),
					   GetSQLValueString($_POST['defaultBitternessFormula'], "text"),
					   GetSQLValueString($_POST['defaultMethod'], "text"),
					   GetSQLValueString($_POST['defaultBatchSize'], "text"),
					   GetSQLValueString($_POST['defaultWaterRatio'], "text"),
                       GetSQLValueString($id, "int")); 
					   
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
  $insertSQL = sprintf("INSERT INTO malt (maltName, maltLovibond, maltInfo, maltYield, maltOrigin, maltSupplier) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['maltName'], "scrubbed"),
                       GetSQLValueString($_POST['maltLovibond'], "text"),
                       GetSQLValueString($_POST['maltInfo'], "text"),
					   GetSQLValueString($_POST['maltYield'], "text"),
					   GetSQLValueString($_POST['maltOrigin'], "scrubbed"),
					   GetSQLValueString($_POST['maltSupplier'], "scrubbed")
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=malt&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Grain --------------------------- //

if (($action == "edit") && ($dbTable == "malt")) {
  $updateSQL = sprintf("UPDATE malt SET maltName=%s, maltLovibond=%s, maltInfo=%s, maltYield=%s, maltOrigin=%s, maltSupplier=%s WHERE id=%s",
                       GetSQLValueString($_POST['maltName'], "scrubbed"),
                       GetSQLValueString($_POST['maltLovibond'], "text"),
                       GetSQLValueString($_POST['maltInfo'], "text"),
					   GetSQLValueString($_POST['maltYield'], "text"),
					   GetSQLValueString($_POST['maltOrigin'], "scrubbed"),
					   GetSQLValueString($_POST['maltSupplier'], "scrubbed"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=malt&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding an Adjunct --------------------------- //

if (($action == "add") && ($dbTable == "adjuncts")) {
  $insertSQL = sprintf("INSERT INTO adjuncts (adjunctName, adjunctLovibond, adjunctInfo, adjunctYield, adjunctType, adjunctOrigin, adjunctSupplier) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['adjunctName'], "scrubbed"),
                       GetSQLValueString($_POST['adjunctLovibond'], "text"),
                       GetSQLValueString($_POST['adjunctInfo'], "text"),
					   GetSQLValueString($_POST['adjunctYield'], "text"),
					   GetSQLValueString($_POST['adjunctType'], "scrubbed"),
					   GetSQLValueString($_POST['adjunctOrigin'], "scrubbed"),
					   GetSQLValueString($_POST['adjunctSupplier'], "scrubbed")
					   );

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=adjuncts&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing an Adjunct --------------------------- //

if (($action == "edit") && ($dbTable == "adjuncts")) {
  $updateSQL = sprintf("UPDATE adjuncts SET adjunctName=%s, adjunctLovibond=%s, adjunctInfo=%s, adjunctYield=%s, adjunctType=%s, adjunctOrigin=%s, adjunctSupplier=%s WHERE id=%s",
                       GetSQLValueString($_POST['adjunctName'], "scrubbed"),
                       GetSQLValueString($_POST['adjunctLovibond'], "text"),
                       GetSQLValueString($_POST['adjunctInfo'], "text"),
					   GetSQLValueString($_POST['adjunctYield'], "text"),
					   GetSQLValueString($_POST['adjunctType'], "scrubbed"),
					   GetSQLValueString($_POST['adjunctOrigin'], "scrubbed"),
					   GetSQLValueString($_POST['adjunctSupplier'], "scrubbed"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=adjuncts&confirm=true&msg=2";
  header(sprintf("Location: %s", $updateGoTo));
}

// --------------------------- If Adding an Extract --------------------------- //

if (($action == "add") && ($dbTable == "extract")) {
  $insertSQL = sprintf("INSERT INTO extract (extractName, extractLovibond, extractInfo, extractYield, extractOrigin, extractSupplier, extractType) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['extractName'], "scrubbed"),
                       GetSQLValueString($_POST['extractLovibond'], "text"),
                       GetSQLValueString($_POST['extractInfo'], "text"),
					   GetSQLValueString($_POST['extractYield'], "text"),
					   GetSQLValueString($_POST['extractOrigin'], "scrubbed"),
					   GetSQLValueString($_POST['extractSupplier'], "scrubbed"),
					   GetSQLValueString($_POST['extractType'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=extract&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing an Extract --------------------------- //

if (($action == "edit") && ($dbTable == "extract")) {
  $updateSQL = sprintf("UPDATE extract SET extractName=%s, extractLovibond=%s, extractInfo=%s, extractYield=%s, extractOrigin=%s, extractSupplier=%s, extractType=%s WHERE id=%s",
                       GetSQLValueString($_POST['extractName'], "scrubbed"),
                       GetSQLValueString($_POST['extractLovibond'], "text"),
                       GetSQLValueString($_POST['extractInfo'], "text"),
					   GetSQLValueString($_POST['extractYield'], "text"),
					   GetSQLValueString($_POST['extractOrigin'], "scrubbed"),
					   GetSQLValueString($_POST['extractSupplier'], "scrubbed"),
					   GetSQLValueString($_POST['extractType'], "text"),
                       GetSQLValueString($id, "int"));

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

// --------------------------- If Adding a Sugar Type ------------------- //

if (($action == "add") && ($dbTable == "sugar_type")) {
  $insertSQL = sprintf("INSERT INTO sugar_type (sugarName, sugarPPG) VALUES (%s, %s)",
                       GetSQLValueString($_POST['sugarName'], "scrubbed"),
                       GetSQLValueString($_POST['sugarPPG'], "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "index.php?action=list&dbTable=sugar_type&confirm=true&msg=1";
  header(sprintf("Location: %s", $insertGoTo));
}

// --------------------------- If Editing a Sugar Type ------------------- //

if (($action == "edit") && ($dbTable == "sugar_type")) {
  $updateSQL = sprintf("UPDATE sugar_type SET sugarName=%s, sugarPPG=%s WHERE id=%s",
                       GetSQLValueString($_POST['sugarName'], "scrubbed"),
                       GetSQLValueString($_POST['sugarPPG'], "int"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());

  $updateGoTo = "index.php?action=list&dbTable=sugar_type&confirm=true&msg=2";
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
