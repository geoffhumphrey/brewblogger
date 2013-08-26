<?php
if ($dbTable == "brewing") { $sql_output = "BrewBlog_DB_Export"; $title = "BrewBlog SQL Export"; }
if ($dbTable == "recipes") { $sql_output = "Recipe_DB_Export"; $title = "Recipe SQL Export"; }

if (($row_pref['mode'] == "1") || (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")))  {
mysql_select_db($database_brewing, $brewing);
$query_log = "SELECT * FROM $dbTable ORDER BY id";
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

if ((($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) || ($filter != "all")) {
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM %s WHERE brewBrewerID = '%s'", $dbTable, $filter);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);
}

?>
<div id="breadcrumbAdmin"><?php echo "<a href=\"index.php\">Administration</a> &gt; <a href = \"index.php?action=list&dbTable=".$dbTable."&filter=".$filter."\">".$breadcrumb."</a> &gt; ".$page_title; ?></div>
<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr>
<td>Copy and paste the following MySQL queries into your new BrewBlogger <em><?php echo $dbTable; ?></em> database.</td>
</tr>
<tr>
<td>
<form>
<textarea cols="100" rows="25" wrap="OFF"><?php do { 
echo "INSERT INTO `".$dbTable."` VALUES (".$row_log['id'].", '";
$row_log['brewName'] = strtr($row_log['brewName'], $html_string);
echo $row_log['brewName']."', '"
.$row_log['brewStyle']."', '";
if ($dbTable == "brewing") 
{
echo $row_log['brewBatchNum']."', '"
.$row_log['brewCondition']."', '"
.$row_log['brewDate']."', '"; 
}
if ($dbTable == "recipes") {
echo $row_log['brewSource']."', '";
}
echo $row_log['brewYield']."', '"
.$row_log['brewMethod']."', '";
if ($dbTable == "brewing") 
{
echo $row_log['brewCost']."', '";
}
echo $row_log['brewLink1']."', '";
				$row_log['brewLink1Name'] = strtr($row_log['brewLink1Name'], $html_string);
echo $row_log['brewLink1Name']."', '"
.$row_log['brewLink2']."', '";
				$row_log['brewLink2Name'] = strtr($row_log['brewLink2Name'], $html_string);
echo $row_log['brewLink2Name']."', '";
if ($dbTable == "brewing") 
{
				$row_log['brewInfo'] = strtr($row_log['brewInfo'], $html_string);
echo $row_log['brewInfo']."', '";
} 
if ($dbTable == "recipes") 
{
				$row_log['brewNotes'] = strtr($row_log['brewNotes'], $html_string);
echo $row_log['brewNotes']."', '";
}
echo $row_log['brewExtract1']."', '"
.$row_log['brewExtract1Weight']."', '"
.$row_log['brewExtract2']."', '"
.$row_log['brewExtract2Weight']."', '"
.$row_log['brewExtract3']."', '"
.$row_log['brewExtract3Weight']."', '"
.$row_log['brewExtract4']."', '"
.$row_log['brewExtract4Weight']."', '"
.$row_log['brewExtract5']."', '"
.$row_log['brewExtract5Weight']."', '"
.$row_log['brewGrain1']."', '"
.$row_log['brewGrain1Weight']."', '"
.$row_log['brewGrain2']."', '"
.$row_log['brewGrain2Weight']."', '"
.$row_log['brewGrain3']."', '"
.$row_log['brewGrain3Weight']."', '"
.$row_log['brewGrain4']."', '"
.$row_log['brewGrain4Weight']."', '"
.$row_log['brewGrain5']."', '"
.$row_log['brewGrain5Weight']."', '"
.$row_log['brewGrain6']."', '"
.$row_log['brewGrain6Weight']."', '"
.$row_log['brewGrain7']."', '"
.$row_log['brewGrain7Weight']."', '"
.$row_log['brewGrain8']."', '"
.$row_log['brewGrain8Weight']."', '"
.$row_log['brewGrain9']."', '"
.$row_log['brewGrain9Weight']."', '";
				$row_log['brewAddition1'] = strtr($row_log['brewAddition1'], $html_string);
echo $row_log['brewAddition1']."', '"
.$row_log['brewAddition1Amt']."', '";
				$row_log['brewAddition2'] = strtr($row_log['brewAddition2'], $html_string);
echo $row_log['brewAddition2']."', '"
.$row_log['brewAddition2Amt']."', '";
				$row_log['brewAddition3'] = strtr($row_log['brewAddition3'], $html_string);
echo $row_log['brewAddition3']."', '"
.$row_log['brewAddition3Amt']."', '";
				$row_log['brewAddition4'] = strtr($row_log['brewAddition4'], $html_string);
echo $row_log['brewAddition4']."', '"
.$row_log['brewAddition4Amt']."', '";
				$row_log['brewAddition5'] = strtr($row_log['brewAddition5'], $html_string);
echo $row_log['brewAddition5']."', '"
.$row_log['brewAddition5Amt']."', '";
				$row_log['brewAddition6'] = strtr($row_log['brewAddition6'], $html_string);
echo $row_log['brewAddition6']."', '"
.$row_log['brewAddition6Amt']."', '";
				$row_log['brewAddition7'] = strtr($row_log['brewAddition7'], $html_string);
echo $row_log['brewAddition7']."', '"
.$row_log['brewAddition7Amt']."', '";
				$row_log['brewAddition8'] = strtr($row_log['brewAddition8'], $html_string);
echo $row_log['brewAddition8']."', '"
.$row_log['brewAddition8Amt']."', '";
				$row_log['brewAddition9'] = strtr($row_log['brewAddition9'], $html_string);
echo $row_log['brewAddition9']."', '"
.$row_log['brewAddition9Amt']."', '";
				$row_log['brewMisc1Name'] = strtr($row_log['brewMisc1Name'], $html_string);
echo $row_log['brewMisc1Name']."', '";
				$row_log['brewMisc2Name'] = strtr($row_log['brewMisc2Name'], $html_string);
echo $row_log['brewMisc2Name']."', '";
				$row_log['brewMisc3Name'] = strtr($row_log['brewMisc3Name'], $html_string);
echo $row_log['brewMisc3Name']."', '";
				$row_log['brewMisc4Name'] = strtr($row_log['brewMisc4Name'], $html_string);
echo $row_log['brewMisc4Name']."', '"
.$row_log['brewMisc1Type']."', '"
.$row_log['brewMisc2Type']."', '"
.$row_log['brewMisc3Type']."', '"
.$row_log['brewMisc4Type']."', '"
.$row_log['brewMisc1Use']."', '"
.$row_log['brewMisc2Use']."', '"
.$row_log['brewMisc3Use']."', '"
.$row_log['brewMisc4Use']."', '"
.$row_log['brewMisc1Time']."', '"
.$row_log['brewMisc2Time']."', '"
.$row_log['brewMisc3Time']."', '"
.$row_log['brewMisc4Time']."', '"
.$row_log['brewMisc1Amount']."', '"
.$row_log['brewMisc2Amount']."', '"
.$row_log['brewMisc3Amount']."', '"
.$row_log['brewMisc4Amount']."', '"
.$row_log['brewHops1']."', '"
.$row_log['brewHops1Weight']."', '"
.$row_log['brewHops1IBU']."', '"
.$row_log['brewHops1Time']."', '"
.$row_log['brewHops2']."', '"
.$row_log['brewHops2Weight']."', '"
.$row_log['brewHops2IBU']."', '"
.$row_log['brewHops2Time']."', '"
.$row_log['brewHops3']."', '"
.$row_log['brewHops3Weight']."', '"
.$row_log['brewHops3IBU']."', '"
.$row_log['brewHops3Time']."', '"
.$row_log['brewHops4']."', '"
.$row_log['brewHops4Weight']."', '"
.$row_log['brewHops4IBU']."', '"
.$row_log['brewHops4Time']."', '"
.$row_log['brewHops5']."', '"
.$row_log['brewHops5Weight']."', '"
.$row_log['brewHops5IBU']."', '"
.$row_log['brewHops5Time']."', '"
.$row_log['brewHops6']."', '"
.$row_log['brewHops6Weight']."', '"
.$row_log['brewHops6IBU']."', '"
.$row_log['brewHops6Time']."', '"
.$row_log['brewHops7']."', '"
.$row_log['brewHops7Weight']."', '"
.$row_log['brewHops7IBU']."', '"
.$row_log['brewHops7Time']."', '"
.$row_log['brewHops8']."', '"
.$row_log['brewHops8Weight']."', '"
.$row_log['brewHops8IBU']."', '"
.$row_log['brewHops8Time']."', '"
.$row_log['brewHops9']."', '"
.$row_log['brewHops9Weight']."', '"
.$row_log['brewHops9IBU']."', '"
.$row_log['brewHops9Time']."', '"
.$row_log['brewHops1Use']."', '"
.$row_log['brewHops2Use']."', '"
.$row_log['brewHops3Use']."', '"
.$row_log['brewHops4Use']."', '"
.$row_log['brewHops5Use']."', '"
.$row_log['brewHops6Use']."', '"
.$row_log['brewHops7Use']."', '"
.$row_log['brewHops8Use']."', '"
.$row_log['brewHops9Use']."', '"
.$row_log['brewHops1Type']."', '"
.$row_log['brewHops2Type']."', '"
.$row_log['brewHops3Type']."', '"
.$row_log['brewHops4Type']."', '"
.$row_log['brewHops5Type']."', '"
.$row_log['brewHops6Type']."', '"
.$row_log['brewHops7Type']."', '"
.$row_log['brewHops8Type']."', '"
.$row_log['brewHops9Type']."', '"
.$row_log['brewHops1Form']."', '"
.$row_log['brewHops2Form']."', '"
.$row_log['brewHops3Form']."', '"
.$row_log['brewHops4Form']."', '"
.$row_log['brewHops5Form']."', '"
.$row_log['brewHops6Form']."', '"
.$row_log['brewHops7Form']."', '"
.$row_log['brewHops8Form']."', '"
.$row_log['brewHops9Form']."', '";
		$row_log['brewYeast'] = strtr($row_log['brewYeast'], $html_string);
echo $row_log['brewYeast']."', '";
		$row_log['brewYeastMan'] = strtr($row_log['brewYeastMan'], $html_string);
echo $row_log['brewYeastMan']."', '"
.$row_log['brewYeastForm']."', '"
.$row_log['brewYeastType']."', '"
.$row_log['brewYeastAmount']."', '";
		$row_log['brewLabelImage'] = strtr($row_log['brewLabelImage'], $html_string);
echo $row_log['brewLabelImage']."', '"
.$row_log['brewOG']."', '"
.$row_log['brewFG']."', '";
if ($dbTable == "brewing") 
{
echo $row_log['brewGravity1']."', '"
.$row_log['brewGravity1Days']."', '"
.$row_log['brewGravity2']."', '"
.$row_log['brewGravity2Days']."', '";
}
		$row_log['brewProcedure'] = strtr($row_log['brewProcedure'], $html_string);
		//$row_log['brewProcedure'] = str_replace("&#39;", "''", $row_log['brewProcedure'], $html_string);
echo $row_log['brewProcedure']."', '";
if ($dbTable == "brewing") 
{
		$row_log['brewSpecialProcedure'] = strtr($row_log['brewSpecialProcedure'], $html_string);
echo $row_log['brewSpecialProcedure']."', '";
}
echo $row_log['brewPrimary']."', '"
.$row_log['brewPrimaryTemp']."', '"
.$row_log['brewSecondary']."', '"
.$row_log['brewSecondaryTemp']."', '"
.$row_log['brewTertiary']."', '"
.$row_log['brewTertiaryTemp']."', '"
.$row_log['brewLager']."', '"
.$row_log['brewLagerTemp']."', '"
.$row_log['brewAge']."', '"
.$row_log['brewAgeTemp']."', '"
.$row_log['brewBitterness']."', '"
.$row_log['brewIBUFormula']."', '"
.$row_log['brewLovibond']."', '";
if ($dbTable == "brewing") 
{
		$row_log['brewComments'] = strtr($row_log['brewComments'], $html_string);
echo $row_log['brewComments']."', '";
}
if ($dbTable == "brewing") 
{
echo $row_log['brewMashType']."', '"
.$row_log['brewMashGrainWeight']."', '"
.$row_log['brewMashGrainTemp']."', '"
.$row_log['brewMashTunTemp']."', '"
.$row_log['brewMashSpargAmt']."', '"
.$row_log['brewMashSpargeTemp']."', '"
.$row_log['brewMashEquipAdjust']."', '"
.$row_log['brewMashPH']."', '"
.$row_log['brewMashStep1Name']."', '";
		$row_log['brewMashStep1Desc'] = strtr($row_log['brewMashStep1Desc'], $html_string);
echo $row_log['brewMashStep1Desc']."', '"
.$row_log['brewMashStep1Temp']."', '"
.$row_log['brewMashStep1Time']."', '"
.$row_log['brewMashStep2Name']."', '";
		$row_log['brewMashStep2Desc'] = strtr($row_log['brewMashStep2Desc'], $html_string);
echo $row_log['brewMashStep2Desc']."', '"
.$row_log['brewMashStep2Temp']."', '"
.$row_log['brewMashStep2Time']."', '"
.$row_log['brewMashStep3Name']."', '";
		$row_log['brewMashStep3Desc'] = strtr($row_log['brewMashStep3Desc'], $html_string);
echo $row_log['brewMashStep3Desc']."', '"
.$row_log['brewMashStep3Temp']."', '"
.$row_log['brewMashStep3Time']."', '"
.$row_log['brewMashStep4Name']."', '";
		$row_log['brewMashStep4Desc'] = strtr($row_log['brewMashStep4Desc'], $html_string);
echo $row_log['brewMashStep4Desc']."', '"
.$row_log['brewMashStep4Temp']."', '"
.$row_log['brewMashStep4Time']."', '"
.$row_log['brewMashStep5Name']."', '";
		$row_log['brewMashStep5Desc'] = strtr($row_log['brewMashStep5Desc'], $html_string);
echo $row_log['brewMashStep5Desc']."', '"
.$row_log['brewMashStep5Temp']."', '"
.$row_log['brewMashStep5Time']."', '";
		$row_log['brewWaterName'] = strtr($row_log['brewWaterName'], $html_string);
echo $row_log['brewWaterName']."', '"
.$row_log['brewWaterAmount']."', '"
.$row_log['brewWaterCalcium']."', '"
.$row_log['brewWaterBicarb']."', '"
.$row_log['brewWaterSulfate']."', '"
.$row_log['brewWaterChloride']."', '"
.$row_log['brewWaterMagnesium']."', '"
.$row_log['brewWaterPH']."', '";
		$row_log['brewWaterNotes'] = strtr($row_log['brewWaterNotes'], $html_string);
echo $row_log['brewWaterNotes']."', '"
.$row_log['brewWaterSodium']."', '"
.$row_log['brewEfficiency']."', '"
.$row_log['brewPPG']."', '"
.$row_log['brewStatus']."', '";
if ($row_log['brewTapDate'] != "") echo $row_log['brewTapDate']."', '"; else echo date('Y\-m\-d')."', '";
echo $row_log['brewMashGravity']."', '"
.$row_log['brewPreBoilAmt']."', '";
}
if ($row_log['brewBrewerID'] != "") echo $row_log['brewBrewerID']; else echo $loginUsername;
if ($dbTable == "brewing") { 
echo $row_log['brewTargetOG']."', '"
.$row_log['brewTargetFG']."', '"
.$row_log['brewMashProfile']."', '"
.$row_log['brewWaterProfile']."', '"
.$row_log['brewYeastProfile']."', '"
.$row_log['brewBoilTime']."', '"
.$row_log['brewEquipProfile']."', '"
.$row_log['brewFeatured']."', '"
.$row_log['brewWaterRatio']."', '";
}
if ($dbTable == "recipes") { 
echo $row_log['brewBoilTime']."', '"
.$row_log['brewFeatured']."', '";
}
echo $row_log['brewArchive']."', '";
echo "');";
echo "\n";
} while ($row_log = mysql_fetch_assoc($log)); ?> 
</textarea>
</form>
</td>
</tr>
</table>



