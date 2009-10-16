<?php 
$imageSrc = "../images/";
// If recalculating, get info from db
if ($id != "default") {
mysql_select_db($database_brewing, $brewing);
$query_recipeRecalc = "SELECT * FROM ";
if ($source == "brewing") { $query_recipeRecalc .= "brewing "; }
if ($source == "recipes") { $query_recipeRecalc .= "recipes "; }
$query_recipeRecalc .= " WHERE id='$id'";
//echo $source;
//echo $query_recipeRecalc;
$recipeRecalc = mysql_query($query_recipeRecalc, $brewing) or die(mysql_error());
$row_recipeRecalc = mysql_fetch_assoc($recipeRecalc);
}

if ($action == "calculate") {
if (($results == "true") || ($results == "verify")) {
include ('lib/calculations.lib.php');
include ('lib/calcFormVar.lib.php'); 
}

if ($results != "verify") { 
?>
<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if ($results == "true") include ('lib/predicted.lib.php'); ?>
<form id="form3" action="index.php?action=calculate&results=true&filter=<?php echo $filter; if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>" method="post" name="form3" onSubmit="return CheckRequiredFields()">
<input type="hidden" name="brewBrewerID" value="<?php echo $filter; ?>">
<div id="headerContentAdmin">General Information</div>
<table>
	<tr>
		<td class="dataLabelLeft">Name:</td>
		<td class="data"><input type="text" name="brewName" value="<?php if ($results == "true") echo $brewName; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewName']; ?>" size="30"></td>
	</tr>
	<tr>

  		<td class="dataLabelLeft"><div id="help"><a href="../sections/reference.inc.php?section=styles&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Styles Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Style:</td>
   		<td class="data">
   			<select name="brewStyle">
    			<?php do {  ?>
     			<option value="<?php echo $row_styles['brewStyle']?>" <?php if ($results == "true") { if ($brewStyle == $row_styles['brewStyle']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewStyle'] == $row_styles['brewStyle']) echo "SELECTED" ; } ?>><?php echo $row_styles['brewStyle'];?></option>
      			<?php } while ($row_styles = mysql_fetch_assoc($styles)); $rows = mysql_num_rows($styles); if($rows > 0) { mysql_data_seek($styles, 0); $row_styles = mysql_fetch_assoc($styles); } ?>
   			</select>
   		</td>
   	</tr>
</table>
<table>
   	<tr>
   		<td class="dataLabelLeft">Finished Vol. (Batch Size):</td>
   		<td class="data" width="5%"><input id="brewYield" name="brewYield" type="text" size="10" value="<?php if ($results == "true") echo $brewYield; elseif ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewYield']; else echo "5"; ?>"></td>
		<td class="data"><?php echo $row_pref['measFluid2']; ?></td>
   	</tr>
   	<tr>
   		<td class="dataLabelLeft">System Efficiency %:</td>
   		<td class="data"><input name="efficiency" type="text" size="10" value="<?php if ($results == "true") echo ($efficiency * 100); else echo "72"; ?>"></td>
		<td class="data">%</td>
   	</tr>
   	<tr>
   		<td class="dataLabelLeft">Attenuation %:</td>
   		<td class="data"><input name="attenuation" type="text" size="10" value="<?php if ($results == "true") echo ($attenuation * 100); else echo "75"; ?>"></td>
		<td class="data">%</td>
   	</tr>
</table>
<div id="headerContentAdmin">Malt Extracts</div>
<table>
	<tr>
    	<td colspan="5" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Extracts?" title="Add Extracts?"></span>&nbsp;<a href="index.php?action=add&dbTable=extract">Add Extracts?</a></td>
    </tr>
	<tr>
   		<td class="dataLabelLeft">Extract 1:</td>
		<td class="data" width="5%">
   			<select name="brewExtract1" id="brewExtract1">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_extracts['extractName']; ?>" <?php if ($results == "true") { if ($brewExtract1 == $row_extracts['extractName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewExtract1'] == $row_extracts['extractName']) echo "SELECTED"; } ?>><?php echo $row_extracts['extractName']; ?></option>
    			<?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts); if($rows > 0) { mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
   			</select>
		</td>
		<td class="dataLabel">Weight:</td>
   		<td class="data" width="5%"><input name="brewExtract1Weight" type="text" id="brewExtract1Weight" size="5" value="<?php if ($results == "true") echo $brewExtract1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewExtract1Weight']; ?>">
		<td class="data" <?php if ($results == "true") echo "width=\"5%\""; ?>><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewExtract1Weight != "")) { $e1Grist = $brewExtract1Weight/$totalGrist * 100;echo "<td class=\"data\">".round ($e1Grist, 1)."%</td>"; } if (($results == "true") && ($brewExtract1Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Extract 2:</td>
		<td class="data">
   		<select name="brewExtract2" id="brewExtract2">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_extracts['extractName']; ?>" <?php if ($results == "true") { if ($brewExtract2 == $row_extracts['extractName']) echo "SELECTED"; }  if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewExtract2'] == $row_extracts['extractName']) echo "SELECTED"; } ?>><?php echo $row_extracts['extractName']; ?></option>
    			<?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts);	if($rows > 0) {	mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
	  	</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewExtract2Weight" type="text" id="brewExtract2Weight" size="5" value="<?php if ($results == "true") echo $brewExtract2Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewExtract2Weight']; ?>">
<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
</td>
		<?php if (($results == "true") && ($brewExtract2Weight != "")) { $e2Grist = $brewExtract2Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($e2Grist, 1)."%</td>"; } if (($results == "true") && ($brewExtract2Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Extract 3:</td>
		<td class="data">
   		<select name="brewExtract3" id="brewExtract3">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_extracts['extractName']; ?>" <?php if ($results == "true") { if ($brewExtract3 == $row_extracts['extractName']) echo "SELECTED"; }  if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewExtract3'] == $row_extracts['extractName']) echo "SELECTED"; } ?>><?php echo $row_extracts['extractName']; ?></option>
    			<?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts);	if($rows > 0) {	mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
	  	</select>
		</td>
   		<td class="dataLabel">Weight: </td>
   		<td class="data"><input name="brewExtract3Weight" type="text" id="brewExtract3Weight" size="5" value="<?php if ($results == "true") echo $brewExtract3Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewExtract3Weight']; ?>">
<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
</td>
		<?php if (($results == "true") && ($brewExtract3Weight != "")) { $e3Grist = $brewExtract3Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($e3Grist, 1)."%</td>"; } if (($results == "true") && ($brewExtract3Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Extract 4:</td>
		<td class="data">
   		<select name="brewExtract4" id="brewExtract4">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_extracts['extractName']; ?>" <?php if ($results == "true") { if ($brewExtract4 == $row_extracts['extractName']) echo "SELECTED"; }  if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewExtract4'] == $row_extracts['extractName']) echo "SELECTED"; } ?>><?php echo $row_extracts['extractName']; ?></option>
    			<?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts);	if($rows > 0) {	mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
	  	</select>
		</td>
   		<td class="dataLabel">Weight: </td>
   		<td class="data"><input name="brewExtract4Weight" type="text" id="brewExtract4Weight" size="5" value="<?php if ($results == "true") echo $brewExtract4Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewExtract4Weight']; ?>">
<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
</td>
		<?php if (($results == "true") && ($brewExtract4Weight != "")) { $e4Grist = $brewExtract4Weight/$totalGrist * 100;  echo "<td class=\"data\">".round ($e4Grist, 1)."%</td>"; } if (($results == "true") && ($brewExtract4Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Extract 5:</td>
		<td class="data">
   		<select name="brewExtract5" id="brewExtract5">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_extracts['extractName']; ?>" <?php if ($results == "true") { if ($brewExtract5 == $row_extracts['extractName']) echo "SELECTED"; }  if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewExtract5'] == $row_extracts['extractName']) echo "SELECTED"; } ?>><?php echo $row_extracts['extractName']; ?></option>
    			<?php } while ($row_extracts = mysql_fetch_assoc($extracts)); $rows = mysql_num_rows($extracts);	if($rows > 0) {	mysql_data_seek($extracts, 0); $row_extracts = mysql_fetch_assoc($extracts); } ?>
	  	</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewExtract5Weight" type="text" id="brewExtract5Weight" size="5" value="<?php if ($results == "true") echo $brewExtract5Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewExtract5Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewExtract5Weight != "")) { $e5Grist = $brewExtract5Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($e5Grist, 1)."%</td>"; } if (($results == "true") && ($brewExtract5Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
</table>
<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe's original extract is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=extract">add another to the database</a>.</em></div>
<?php } ?>
<div id="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Grains</div>
<table>
	<tr>
    	<td colspan="5" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Grains?" title="Add Grains?"></span>&nbsp;<a href="index.php?action=add&dbTable=malt">Add Grains?</a></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 1:</td>
   		<td class="data" width="5%">
   			<select name="brewGrain1" id="brewGrain1">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain1 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain1'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    			<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains);	if($rows > 0) {	mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); } ?>
   			</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data" width="5%"><input name="brewGrain1Weight" type="text" id="brewGrain1Weight" size="5" value="<?php if ($results == "true") echo $brewGrain1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain1Weight']; ?>">
		<td class="data" <?php if ($results == "true") echo "width=\"5%\""; ?>><?php echo $row_pref['measWeight2']; ?></td>
		</td>
		<?php if (($results == "true") && ($brewGrain1Weight != "")) { $g1Grist = $brewGrain1Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g1Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain1Weight == "")) echo "<td>&nbsp;</td>"; ?>
  	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 2:</td>
   		<td class="data">
   			<select name="brewGrain2" id="brewGrain2">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain2 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain2'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
   			<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   			</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain2Weight" type="text" id="brewGrain2Weight" size="5" value="<?php if ($results == "true") echo $brewGrain2Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain2Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain2Weight != "")) { $g2Grist = $brewGrain2Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g2Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain2Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 3:</td>
   		<td class="data">
   				<select name="brewGrain3" id="brewGrain3">
					<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain3 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain3'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain3Weight" type="text" id="brewGrain3Weight" size="5" value="<?php if ($results == "true") echo $brewGrain3Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain3Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain3Weight != "")) { $g3Grist = $brewGrain3Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g3Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain3Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 4:</td>
   		<td class="data">
  	 			<select name="brewGrain4" id="brewGrain4">
					<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain4 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain4'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain4Weight" type="text" id="brewGrain4Weight" size="5" value="<?php if ($results == "true") echo $brewGrain4Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain4Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain4Weight != "")) { $g4Grist = $brewGrain4Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g4Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain4Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 5:</td>
   		<td class="data">
				<select name="brewGrain5" id="brewGrain5">
					<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain5 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain5'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
  				</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain5Weight" type="text" id="brewGrain5Weight" size="5" value="<?php if ($results == "true") echo $brewGrain5Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain5Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain5Weight != "")) { $g5Grist = $brewGrain5Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g5Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain5Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 6:</td>
   		<td class="data">
				<select name="brewGrain6" id="brewGrain6">
					<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain6 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain6'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain6Weight" type="text" id="brewGrain6Weight" size="5" value="<?php if ($results == "true") echo $brewGrain6Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain6Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain6Weight != "")) { $g6Grist = $brewGrain6Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g6Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain6Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 7:</td>
   		<td class="data">
   				<select name="brewGrain7" id="brewGrain7">
					<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain7 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain7'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain7Weight" type="text" id="brewGrain7Weight" size="5" value="<?php if ($results == "true") echo $brewGrain7Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain7Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain7Weight != "")) { $g7Grist = $brewGrain7Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g7Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain7Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 8:</td>
   		<td class="data">
				<select name="brewGrain8" id="brewGrain8">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain8 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain8'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
   		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain8Weight" type="text" id="brewGrain8Weight" size="5" value="<?php if ($results == "true") echo $brewGrain8Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain8Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain8Weight != "")) { $g8Grist = $brewGrain8Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g8Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain8Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Grain 9:</td>
   		<td class="data">
				<select name="brewGrain9" id="brewGrain9">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain9 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain9'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain9Weight" type="text" id="brewGrain9Weight" size="5" value="<?php if ($results == "true") echo $brewGrain9Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain9Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain9Weight != "")) { $g9Grist = $brewGrain9Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g9Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain9Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
</table>
<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe's original grain is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=malt">add another to the database</a>.</em></div>
<?php } ?>
<div id="headerContentAdmin">Adjuncts</div>
<table>
	<tr>
    	<td colspan="5" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Adjuncts?" title="Add Adjuncts?"></span>&nbsp;<a href="index.php?action=add&dbTable=adjuncts">Add Adjuncts?</a></td>
    </tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 1:</td>
		<td class="data" width="5%">
   			<select name="brewAdjunct1" id="brewAdjunct1">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct1 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition1'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   			</select>		</td>
		<td class="dataLabel">Weight:</td>
   		<td class="data" width="5%"><input name="brewAdjunct1Weight" type="text" id="brewAdjunct1Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition1Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
   	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 2:</td>
		<td class="data">
   		<select name="brewAdjunct2" id="brewAdjunct2">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct2 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if (($source == "recipes") || ($source == "brewing")) { if ($row_recipeRecalc['brewAddition2'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	  	</select>		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewAdjunct2Weight" type="text" id="brewAdjunct2Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct2Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition2Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 3:</td>
		<td class="data">
   		<select name="brewAdjunct3" id="brewAdjunct3">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct3 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition3'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	 	</select>		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewAdjunct3Weight" type="text" id="brewAdjunct3Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct3Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition3Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 4:</td>
		<td class="data">
   		<select name="brewAdjunct4" id="brewAdjunct4">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct4 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition4'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts);	if($rows > 0) {	mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	  	</select>		</td>
   		<td class="dataLabel" nowrap>Weight:</td>
   		<td class="data"><input name="brewAdjunct4Weight" type="text" id="brewAdjunct4Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct4Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition4Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 5:</td>
		<td class="data">
   		<select name="brewAdjunct5" id="brewAdjunct5">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct5 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition5'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts);	if($rows > 0) {	mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	  	</select>		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewAdjunct5Weight" type="text" id="brewAdjunct5Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct5Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition5Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 6:</td>
		<td class="data">
   			<select name="brewAdjunct6" id="brewAdjunct6">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct6 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition6'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   			</select>		</td>
		<td class="data dataLabelWide" nowrap>Weight:</td>
   		<td class="data"><input name="brewAdjunct6Weight" type="text" id="brewAdjunct6Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct6Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition6Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 7:</td>
		<td class="data">
   		<select name="brewAdjunct7" id="brewAdjunct7">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct7 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition7'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	  	</select>		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewAdjunct7Weight" type="text" id="brewAdjunct7Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct7Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition7Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 8:</td>
		<td class="data">
   		<select name="brewAdjunct8" id="brewAdjunct8">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct8 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition8'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	 	</select>		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewAdjunct8Weight" type="text" id="brewAdjunct8Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct8Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition8Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Adjunct 9:</td>
		<td class="data">
   		<select name="brewAdjunct9" id="brewAdjunct9">
				<option value=""></option>
    			<?php do {  ?>
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct9 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition9'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts);	if($rows > 0) {	mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
	  	</select>		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewAdjunct9Weight" type="text" id="brewAdjunct9Weight" size="5" value="<?php if ($results == "true") echo $brewAdjunct9Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewAddition9Amt']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
	</tr>
</table>
<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe's original adjunct is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=adjuncts">add another to the database</a>.</em></div>
<?php } ?>
<div id="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=hops&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Hops</div>
<table>
	<tr>
    	<td colspan="11" class="dataListLeft"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add Hops?" title="Add Hops?"></span>&nbsp;<a href="index.php?action=add&dbTable=hops">Add Hops?</a></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" class="dataLabelWide data">Weight</td>
    <td colspan="2" class="dataLabelWide data">AA%</td>
    <td colspan="2" class="dataLabelWide data">Time</td>
    <td colspan="3" class="dataLabelWide data">Form</td>
	<?php if ($results == "true") { ?><td class="dataLabelWide data">AAUs</td><?php } ?>
    </tr>
  <tr>
    <td nowrap class="dataLabelLeft">Hop 1:</td>
    <td class="data" width="5%"><select name="brewHops1">
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops1 == $row_hops['hopsName']) echo "SELECTED"; }  if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops1'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>    </td>
    <td class="data" width="5%"><input name="brewHops1Weight" type="text" id="brewHops1Weight" size="3" value="<?php if ($results == "true") echo $brewHops1Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops1Weight']; ?>"></td>
    <td class="data" width="5%" nowrap><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data" width="5%"><input name="brewHops1IBU" type="text" id="brewHops1IBU" size="3" value="<?php if ($results == "true") echo $brewHops1IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops1IBU']; ?>"></td>
    <td class="data" width="5%">%</td>
    <td class="data" width="5%"><input name="brewHops1Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops1Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops1Time']; ?>"></td>
    <td class="data" width="5%">min.</td>
	<td class="data" width="5%"><input type="radio" name="brewHops1Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops1 != ""))  { if ($brewHops1Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops1Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED";  ?>  /><span class="data">Pellets</span></td>
    <td class="data" width="5%"><input type="radio" name="brewHops1Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops1 != ""))  { if ($brewHops1Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops1Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" <?php if ($results == "true") echo "width=\"5%\""; ?>><input type="radio" name="brewHops1Form" value="Plug" 		<?php if (($results == "true") && ($brewHops1 != ""))  { if ($brewHops1Form == "Plug")  		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops1Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU1 != 0) echo "<td class=\"data\">".round ($hopsAAU1, 1)."</td>"; } ?>
  </tr>
  <tr>
  	  <td nowrap class="dataLabelWide">Hop 2:</td>
      <td class="data"><select name="brewHops2">
          <option value=""></option>
          <?php do {  ?>
          <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops2 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops2'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
          <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
        </select>      </td>
      <td class="data"><input name="brewHops2Weight" type="text" id="brewHops2Weight" size="3" value="<?php if ($results == "true") echo $brewHops2Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops2Weight']; ?>"></td>
      <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
      <td class="data"><input name="brewHops2IBU" type="text" id="brewHops2IBU" size="3" value="<?php if ($results == "true") echo $brewHops2IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops2IBU']; ?>"></td>
      <td class="data">%</td>
      <td class="data"><input name="brewHops2Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops2Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops2Time']; ?>"></td>
      <td class="data">min.</td>
	  <td class="data" nowrap><input type="radio" name="brewHops2Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops2 != ""))  { if ($brewHops2Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops2Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED"; ?>  /><span class="data">Pellets</span></td>
      <td class="data" nowrap><input type="radio" name="brewHops2Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops2 != ""))  { if ($brewHops2Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops2Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	  <td class="data" nowrap><input type="radio" name="brewHops2Form" value="Plug" 		<?php if (($results == "true") && ($brewHops2 != ""))  { if ($brewHops2Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops2Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU2 != 0) echo "<td class=\"data\">".round ($hopsAAU2, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 3:</td>
    <td class="data"><select name="brewHops3">
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops3 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops3'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>    </td>
    <td class="data"><input name="brewHops3Weight" type="text" id="brewHops3Weight" size="3" value="<?php if ($results == "true") echo $brewHops3Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops3Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops3IBU" type="text" id="brewHops3IBU" size="3" value="<?php if ($results == "true") echo $brewHops3IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops3IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops3Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops3Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops3Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops3Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops3 != ""))  { if ($brewHops3Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops3Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED"; ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops3Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops3 != ""))  { if ($brewHops3Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops3Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops3Form" value="Plug" 		<?php if (($results == "true") && ($brewHops3 != ""))  { if ($brewHops3Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops3Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU3 != 0) echo "<td class=\"data\">".round ($hopsAAU3, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 4:</td>
    <td class="data"><select name="brewHops4">
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops4 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops4'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>    </td>
    <td class="data"><input name="brewHops4Weight" type="text" id="brewHops4Weight" size="3" value="<?php if ($results == "true") echo $brewHops4Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops4Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops4IBU" type="text" id="brewHops4IBU" size="3" value="<?php if ($results == "true") echo $brewHops4IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops4IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops4Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops4Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops4Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops4Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops4 != ""))  { if ($brewHops4Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops4Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED";   ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops4Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops4 != ""))  { if ($brewHops4Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops4Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops4Form" value="Plug" 		<?php if (($results == "true") && ($brewHops4 != ""))  { if ($brewHops4Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops4Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU4 != 0) echo "<td class=\"data\">".round ($hopsAAU4, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 5:</td>
    <td class="data"><select name="brewHops5">
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops5 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops5'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>    </td>
    <td class="data"><input name="brewHops5Weight" type="text" id="brewHops5Weight" size="3" value="<?php if ($results == "true") echo $brewHops5Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops5Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops5IBU" type="text" id="brewHops5IBU" size="3" value="<?php if ($results == "true") echo $brewHops5IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops5IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops5Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops5Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops5Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops5Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops5 != ""))  { if ($brewHops5Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops5Form'] == "Pellets") echo "CHECKED"; }  if (($source == "calculator") && ($results == "false")) echo "CHECKED"; ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops5Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops5 != ""))  { if ($brewHops5Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops5Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops5Form" value="Plug" 		<?php if (($results == "true") && ($brewHops5 != ""))  { if ($brewHops5Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops5Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU5 != 0) echo "<td class=\"data\">".round ($hopsAAU5, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 6:</td>
    <td class="data"><select name="brewHops6" >
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops6 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops6'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>    </td>
    <td class="data"><input name="brewHops6Weight" type="text" id="brewHops6Weight" size="3" value="<?php if ($results == "true") echo $brewHops6Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops6Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops6IBU" type="text" id="brewHops6IBU" size="3" value="<?php if ($results == "true") echo $brewHops6IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops6IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops6Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops6Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops6Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops6Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops6 != ""))  { if ($brewHops6Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops6Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED"; ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops6Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops6 != ""))  { if ($brewHops6Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops6Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops6Form" value="Plug" 		<?php if (($results == "true") && ($brewHops6 != ""))  { if ($brewHops6Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops6Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU6 != 0) echo "<td class=\"data\">".round ($hopsAAU6, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 7:</td>
    <td class="data"><select name="brewHops7" >
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops7 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops7'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>    </td>
    <td class="data"><input name="brewHops7Weight" type="text" id="brewHops7Weight" size="3" value="<?php if ($results == "true") echo $brewHops7Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops7Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops7IBU" type="text" id="brewHops7IBU" size="3" value="<?php if ($results == "true") echo $brewHops7IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops7IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops7Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops7Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops7Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops7Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops7 != ""))  { if ($brewHops7Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops7Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED";  ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops7Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops7 != ""))  { if ($brewHops7Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops7Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops7Form" value="Plug" 		<?php if (($results == "true") && ($brewHops7 != ""))  { if ($brewHops7Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops7Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU7 != 0) echo "<td class=\"data\">".round ($hopsAAU7, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 8:</td>
    <td class="data"><select name="brewHops8" >
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops8 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops8'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
       <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select> 
    </td>
    <td class="data"><input name="brewHops8Weight" type="text" id="brewHops8Weight" size="3" value="<?php if ($results == "true") echo $brewHops8Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops8Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops8IBU" type="text" id="brewHops8IBU" size="3" value="<?php if ($results == "true") echo $brewHops8IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops8IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops8Time" type="text" size="3"  value="<?php if ($results == "true") echo $brewHops8Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops8Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops8Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops8 != ""))  { if ($brewHops8Form == "Pellets") 	echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops8Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED";  ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops8Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops8 != ""))  { if ($brewHops8Form == "Leaf") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops8Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops8Form" value="Plug" 		<?php if (($results == "true") && ($brewHops8 != ""))  { if ($brewHops8Form == "Plug") 		echo "CHECKED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops8Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU8 != 0) echo "<td class=\"data\">".round ($hopsAAU8, 1)."</td>"; } ?>
  </tr>
  <tr>
    <td nowrap class="dataLabelWide">Hop 9:</td>
    <td class="data"><select name="brewHops9" >
        <option value=""></option>
        <?php do {  ?>
        <option value="<?php echo $row_hops['hopsName']; ?>" <?php if ($results == "true") { if ($brewHops9 == $row_hops['hopsName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops9'] == $row_hops['hopsName']) echo "SELECTED"; } ?>><?php echo $row_hops['hopsName']; ?></option>
        <?php } while ($row_hops = mysql_fetch_assoc($hops)); $rows = mysql_num_rows($hops); if($rows > 0) { mysql_data_seek($hops, 0); $row_hops = mysql_fetch_assoc($hops); } ?>
      </select>
    </td>
    <td class="data"><input name="brewHops9Weight" type="text" id="brewHops9Weight" size="3" value="<?php if ($results == "true") echo $brewHops9Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops9Weight']; ?>"></td>
    <td class="data"><?php if ($row_pref['measWeight1'] == "ounces") echo "oz."; if ($row_pref['measWeight1'] == "grams") echo "g."  ?></td>
    <td class="data"><input name="brewHops9IBU" type="text" id="brewHops9IBU" size="3" value="<?php if ($results == "true") echo $brewHops9IBU; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops9IBU']; ?>"></td>
    <td class="data">%</td>
    <td class="data"><input name="brewHops9Time" type="text" size="3" value="<?php if ($results == "true") echo $brewHops9Time; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewHops9Time']; ?>"></td>
    <td class="data">min.</td>
	<td class="data" nowrap><input type="radio" name="brewHops9Form" value="Pellets" 	<?php if (($results == "true") && ($brewHops9 != "")) { if ($brewHops9Form == "Pellets") echo "CHECKED"; } 	if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops9Form'] == "Pellets") echo "CHECKED"; } if (($source == "calculator") && ($results == "false")) echo "CHECKED"; ?>  /><span class="data">Pellets</span></td>
    <td class="data" nowrap><input type="radio" name="brewHops9Form" value="Leaf" 		<?php if (($results == "true") && ($brewHops9 != "")) { if ($brewHops9Form == "Leaf") echo "CHECKED"; } 	if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops9Form'] == "Leaf") echo "CHECKED"; } ?>   /><span class="data">Leaf</span></td>
	<td class="data" nowrap><input type="radio" name="brewHops9Form" value="Plug" 		<?php if (($results == "true") && ($brewHops9 != "")) { if ($brewHops9Form == "Plug") echo "CHECKED"; } 	if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewHops9Form'] == "Plug") echo "CHECKED"; } ?>   /><span class="data">Plug</span></td>
	<?php if ($results == "true") { if ($hopsAAU9 != 0) echo "<td class=\"data\">".round ($hopsAAU9, 1)."</td>"; } ?>
  </tr>
</table>
<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe's original hop is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=hops">add another to the database</a>.</em></div>
<?php } ?>
<table class="dataTable">
<tr>
<td><div class="right"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_calculate_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Calculate" class="radiobutton" value="Calculate"></div></td>
</tr>
</table>
</form>
<?php 
} //end if ($results == "true")
if ($results == "verify") include ('lib/verify.lib.php'); 
} // ends if ($action == "calculate")
else { ?>
<div id="breadcrumbWide"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<div id="subtitleWide"><?php echo $page_title; ?></div>
<div id="headerContentAdmin">Recalculated <php if ($source == "brewing") echo "BrewBlog "; ?>Recipe</div>
<table class="dataTable">
<tr>
	<td class="error">Sorry, you do not have sufficient privileges to perform this action.<br><br><br></td>
</tr>
</table>
<?php } ?>