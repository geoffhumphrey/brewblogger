<?php 
/**
 * Module: recipe_calculator.php
 * Description: Sets up the main Recipe Calculator page for calculating or recalculating a new or existing
 *              recipe or blog. Also processes the form until the user is satisfied with results and moves
 *              to next step in calculation/recalculation process.
 */

$imageSrc = "../images/";

// If recalculating an existing recipe or blog, get info from db.
if ($id != "default") {
  mysql_select_db($database_brewing, $brewing);
  $query_recipeRecalc = "SELECT * FROM ";

  if ($source == "brewing") {
    $query_recipeRecalc .= "brewing ";
  } else {
    // $source must be 'recipes'
    $query_recipeRecalc .= "recipes ";
  }

  $query_recipeRecalc .= " WHERE id='$id'";
  //echo $source;
  //echo $query_recipeRecalc;
  $recipeRecalc = mysql_query($query_recipeRecalc, $brewing) or die(mysql_error());
  $row_recipeRecalc = mysql_fetch_assoc($recipeRecalc);
}

if ($action == "calculate") {
  if (($results == "true") || ($results == "verify")) {
    // If we're verifying then all the calcs have already been done and there shouldn't be
    // any reason to include the following two libs. So, if $results == "verify" can't we 
    // skip this section?
    include 'lib/calculations.lib.php';
    include 'lib/calcFormVar.lib.php'; 

    mysql_select_db($database_brewing, $brewing);
    $query_hops = "SELECT * FROM hops";
    $hops = mysql_query($query_hops, $brewing);
    $row_hops = mysql_fetch_assoc($hops);
  }

if ($results != "verify") { ?>
<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<div id="subtitleAdmin"><?php echo $page_title; ?></div>

<?php if ($results == "true") include 'lib/predicted.lib.php'; ?>
						      
<form id="form3" action="index.php?action=calculate&results=true&filter=<?php echo $filter; if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>" method="post" name="form3" onSubmit="return CheckRequiredFields()">
<input type="hidden" name="brewBrewerID" value="<?php echo $filter; ?>">
<div class="headerContentAdmin">General Information</div>

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
								   
<!-- Extracts -->
<div class="headerContentAdmin">Malt Extracts</div>
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
	
<!-- Grains -->
<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original extract is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=extract">add another to the database</a>.</em></div>
<?php } ?>
<div class="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Grains</div>
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
	    
    <tr>
   		<td class="dataLabelLeft">Grain 10:</td>
   		<td class="data">
				<select name="brewGrain10" id="brewGrain10">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain10 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain10'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain10Weight" type="text" id="brewGrain10Weight" size="5" value="<?php if ($results == "true") echo $brewGrain10Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain10Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain10Weight != "")) { $g10Grist = $brewGrain10Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g10Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain10Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>

    <tr>
   		<td class="dataLabelLeft">Grain 11:</td>
   		<td class="data">
				<select name="brewGrain11" id="brewGrain11">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain11 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain11'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain11Weight" type="text" id="brewGrain11Weight" size="5" value="<?php if ($results == "true") echo $brewGrain11Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain11Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain11Weight != "")) { $g11Grist = $brewGrain11Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g11Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain11Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	        
    <tr>
   		<td class="dataLabelLeft">Grain 12:</td>
   		<td class="data">
				<select name="brewGrain12" id="brewGrain12">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain12 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain12'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain12Weight" type="text" id="brewGrain12Weight" size="5" value="<?php if ($results == "true") echo $brewGrain12Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain12Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain12Weight != "")) { $g12Grist = $brewGrain12Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g12Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain12Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
    
    <tr>
   		<td class="dataLabelLeft">Grain 13:</td>
   		<td class="data">
				<select name="brewGrain13" id="brewGrain13">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain13 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain13'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain13Weight" type="text" id="brewGrain13Weight" size="5" value="<?php if ($results == "true") echo $brewGrain13Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain13Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain13Weight != "")) { $g13Grist = $brewGrain13Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g13Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain13Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	        
    <tr>
   		<td class="dataLabelLeft">Grain 14:</td>
   		<td class="data">
				<select name="brewGrain14" id="brewGrain14">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain14 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain14'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain14Weight" type="text" id="brewGrain14Weight" size="5" value="<?php if ($results == "true") echo $brewGrain14Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain14Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain14Weight != "")) { $g14Grist = $brewGrain14Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g14Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain14Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
	     
    <tr>
   		<td class="dataLabelLeft">Grain 15:</td>
   		<td class="data">
				<select name="brewGrain15" id="brewGrain15">
   				<option value=""></option>
    				<?php do {  ?>
    				<option value="<?php echo $row_grains['maltName']; ?>" <?php if ($results == "true") { if ($brewGrain15 == $row_grains['maltName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewGrain15'] == $row_grains['maltName']) echo "SELECTED"; } ?>><?php echo $row_grains['maltName']; ?></option>
    				<?php } while ($row_grains = mysql_fetch_assoc($grains)); $rows = mysql_num_rows($grains); if($rows > 0) { mysql_data_seek($grains, 0); $row_grains = mysql_fetch_assoc($grains); }	?>
   				</select>
		</td>
   		<td class="dataLabel">Weight:</td>
   		<td class="data"><input name="brewGrain15Weight" type="text" id="brewGrain15Weight" size="5" value="<?php if ($results == "true") echo $brewGrain15Weight; if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) echo $row_recipeRecalc['brewGrain15Weight']; ?>">
		<td class="data"><?php echo $row_pref['measWeight2']; ?></td>
		<?php if (($results == "true") && ($brewGrain15Weight != "")) { $g15Grist = $brewGrain15Weight/$totalGrist * 100; echo "<td class=\"data\">".round ($g15Grist, 1)."%</td>"; } if (($results == "true") && ($brewGrain15Weight == "")) echo "<td>&nbsp;</td>"; ?>
	</tr>
</table>
	    
<!-- Adjuncts -->
<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original grain is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=malt">add another to the database</a>.</em></div>
<?php } ?>
<div class="headerContentAdmin">Adjuncts</div>
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
   			</select>
            </td>
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
    			<option value="<?php echo $row_adjuncts['adjunctName']; ?>" <?php if ($results == "true") { if ($brewAdjunct2 == $row_adjuncts['adjunctName']) echo "SELECTED"; } if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { if ($row_recipeRecalc['brewAddition2'] == $row_adjuncts['adjunctName']) echo "SELECTED"; } ?>><?php echo $row_adjuncts['adjunctName']; ?></option>
    			<?php } while ($row_adjuncts = mysql_fetch_assoc($adjuncts)); $rows = mysql_num_rows($adjuncts); if($rows > 0) { mysql_data_seek($adjuncts, 0); $row_adjuncts = mysql_fetch_assoc($adjuncts); } ?>
   			</select>
        </td>
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
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original adjunct is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=adjuncts">add another to the database</a>.</em></div>
<?php } ?>

<!-- Hops Section -->
<div class="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=hops&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" border="0"></a></div>Hops</div>
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

   <?php
   // Functions should be moved to the top of the file.
   function create_hop_entries($start, $end) {
    global $brewHopsName, $brewHopsWeight, $brewHopsAA, $brewHopsTime, $brewHopsForm, $hopsAAU, $hops, $row_hops,
      $row_recipeRecalc, $source, $results, $row_pref;

    for ($i = $start; $i < $end; $i++) {
      echo '<tr>'."\n";
      echo '<td nowrap class="dataLabelLeft">Hop ' . ($i + 1) . ':</td>' . "\n";

      echo '<td class="data" width="5%"><select name="brewHopsName['.$i.']">' . "\n";
      echo '<option value=""></option>' . "\n";
      do {
        echo '<option value="' . $row_hops['hopsName'] . '" ';
	$key = "brewHops" . ($i + 1);
	if ((($results == "true") && ($brewHopsName[$i] == $row_hops['hopsName'])) || 
	    ((($source == "recipes") || ($source == "brewing")) && ($row_recipeRecalc[$key] == $row_hops['hopsName']))) {
	  echo 'SELECTED';
	}
	echo '>' . $row_hops['hopsName'] . '</option>' . "\n";
      } while ($row_hops = mysql_fetch_assoc($hops));
      echo '</select></td>' . "\n";

      // Reset $row_hops to first row
      $rows = mysql_num_rows($hops);
      if ($rows > 0) { 
	mysql_data_seek($hops, 0);
	$row_hops = mysql_fetch_assoc($hops);
      }

      echo '<td class="data" width="5%"><input name="brewHopsWeight['.$i.']" type="text" size="3" value="';
      if ($results == "true") {
	echo $brewHopsWeight[$i];
      } elseif (($source == "recipes") || ($source == "brewing")) {
	$key = "brewHops" . ($i + 1) . "Weight";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";

      echo '<td class="data" width="5%" nowrap>';
      if ($row_pref['measWeight1'] == "ounces") {
	echo 'oz.';
      } else {
	echo 'g.';
      }
      echo '</td>' . "\n";

      echo '<td class="data" width="5%"><input name="brewHopsAA['.$i.']" type="text" size="3" value="';
      if ($results == "true") {
	echo $brewHopsAA[$i];
      } elseif (($source == "recipes") || ($source == "brewing")) {
	$key = "brewHops" . ($i + 1) . "IBU";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";

      echo '<td class="data" width="5%">%</td>' . "\n";

      echo '<td class="data" width="5%"><input name="brewHopsTime['.$i.']" type="text" size="3" value="';
      if ($results == "true") {
	echo $brewHopsTime[$i];
      } elseif (($source == "recipes") || ($source == "brewing")) {
	$key = "brewHops" . ($i + 1) . "Time";
	echo $row_recipeRecalc[$key];
      }
      echo '"></td>' . "\n";

      echo '<td class="data" width="5%">min.</td>' . "\n";

      echo '<td class="data" width="5%"><input type="radio" name="brewHopsForm['.$i.']" value="Pellets" ';
      if ($results == "true") {
	if (($brewHopsName[$i] != "") && ($brewHopsForm[$i] == "Pellets")) {
	  echo 'CHECKED';
	}
      } else {
	$key = "brewHops" . ($i + 1) . "Form";
	if (((($source == "recipes") || ($source == "brewing")) && ($row_recipeRecalc[$key] == "Pellets")) ||
	     ($source == "calculator")) {
	  echo 'CHECKED';
	}
      }
      echo '/><span class="data">Pellets</span></td>' . "\n";

      echo '<td class="data" width="5%"><input type="radio" name="brewHopsForm['.$i.']" value="Leaf" ';
      if ($results == "true") {
	if (($brewHopsName[$i] != "") && ($brewHopsForm[$i] == "Leaf")) {
	  echo 'CHECKED';
	}
      } else {
	$key = "brewHops" . ($i + 1) . "Form";
	if ((($source == "recipes") || ($source == "brewing")) && ($row_recipeRecalc[$key] == "Leaf")) {
	  echo 'CHECKED';
	}
      }
      echo '/><span class="data">Leaf</span></td>' . "\n";

      echo '<td class="data"';
      if ($results == "true") {
	echo ' width="5%"';
      }
      echo '><input type="radio" name="brewHopsForm['.$i.']" value="Plug" ';
      if ($results == "true") {
	if (($brewHopsName[$i] != "") && ($brewHopsForm[$i] == "Plug")) {
	  echo 'CHECKED';
	}
      } else {
	$key = "brewHops" . ($i + 1) . "Form";
	if ((($source == "recipes") || ($source == "brewing")) && ($row_recipeRecalc[$key] == "Plug")) {
	  echo "CHECKED";
	}
      }
      echo '/><span class="data">Plug</span></td>' . "\n";

      if (($results == "true") && ($hopsAAU[$i] != 0)) {
	echo '<td class="data">' . round($hopsAAU[$i], 1) . '</td>' . "\n";
      }

      echo '</tr>' . "\n";
    }
  }

  create_hop_entries(0, MAX_HOPS);
  ?>
</table>

<?php if ((($source == "recipes") || ($source == "brewing")) && ($results == "false")) { ?>
<div class="red"><em>**If any dropdown menu is blank, the recipe\'s original hop is not in the database.  For caculations to function, please choose another from the list or <a href="index.php?action=add&dbTable=hops">add another to the database</a>.</em></div>
<?php } ?>

<table class="dataTable">
<tr>
<td><div class="right"><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_calculate_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Calculate" class="radiobutton" value="Calculate"></div></td>
</tr>
</table>

</form>
<?php 
} //end if ($results == "true")
 if ($results == "verify") {
   include ('lib/verify.lib.php');
 }
} // ends if ($action == "calculate")
else { ?>
  // Doesn't $action always == "calculate" in this file? Is this block ever executed?
  <div id="breadcrumbWide"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
  <div id="subtitleWide"><?php echo $page_title; ?></div>
  <div class="headerContentAdmin">Recalculated <php if ($source == "brewing") echo "BrewBlog "; ?>Recipe</div>
  <table class="dataTable">
  <tr>
      <td class="error">Sorry, you do not have sufficient privileges to perform this action.<br><br><br></td>
  </tr>
  </table>
<?php } ?>