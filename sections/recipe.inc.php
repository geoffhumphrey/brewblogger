<?php 
if ($amt != 0) $scale = $amt/$row_log['brewYield'];
mysql_select_db($database_brewing, $brewing);

$query_hops1 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops1']);
$hops1 = mysql_query($query_hops1, $brewing) or die(mysql_error());
$row_hops1 = mysql_fetch_assoc($hops1);
$totalRows_hops1 = mysql_num_rows($hops1);

$query_hops2 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops2']);
$hops2 = mysql_query($query_hops2, $brewing) or die(mysql_error());
$row_hops2 = mysql_fetch_assoc($hops2);
$totalRows_hops2 = mysql_num_rows($hops2);

$query_hops3 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops3']);
$hops3 = mysql_query($query_hops3, $brewing) or die(mysql_error());
$row_hops3 = mysql_fetch_assoc($hops3);
$totalRows_hops3 = mysql_num_rows($hops3);

$query_hops4 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops4']);
$hops4 = mysql_query($query_hops4, $brewing) or die(mysql_error());
$row_hops4 = mysql_fetch_assoc($hops4);
$totalRows_hops4 = mysql_num_rows($hops4);

$query_hops5 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops5']);
$hops5 = mysql_query($query_hops5, $brewing) or die(mysql_error());
$row_hops5 = mysql_fetch_assoc($hops5);
$totalRows_hops5 = mysql_num_rows($hops5);

$query_hops6 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops6']);
$hops6 = mysql_query($query_hops6, $brewing) or die(mysql_error());
$row_hops6 = mysql_fetch_assoc($hops6);
$totalRows_hops6 = mysql_num_rows($hops6);

$query_hops7 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops7']);
$hops7 = mysql_query($query_hops7, $brewing) or die(mysql_error());
$row_hops7 = mysql_fetch_assoc($hops7);
$totalRows_hops7 = mysql_num_rows($hops7);

$query_hops8 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops8']);
$hops8 = mysql_query($query_hops8, $brewing) or die(mysql_error());
$row_hops8 = mysql_fetch_assoc($hops8);
$totalRows_hops8 = mysql_num_rows($hops8);

$query_hops9 = sprintf("SELECT * FROM hops WHERE hopsName='%s'", $row_log['brewHops9']);
$hops9 = mysql_query($query_hops9, $brewing) or die(mysql_error());
$row_hops9 = mysql_fetch_assoc($hops9);
$totalRows_hops9 = mysql_num_rows($hops9);

//Grain DB connect
$query_malt1 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain1']);
$malt1 = mysql_query($query_malt1, $brewing) or die(mysql_error());
$row_malt1 = mysql_fetch_assoc($malt1);
$totalRows_malt1 = mysql_num_rows($malt1);

$query_malt2 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain2']);
$malt2 = mysql_query($query_malt2, $brewing) or die(mysql_error());
$row_malt2 = mysql_fetch_assoc($malt2);
$totalRows_malt2 = mysql_num_rows($malt2);

$query_malt3 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain3']);
$malt3 = mysql_query($query_malt3, $brewing) or die(mysql_error());
$row_malt3 = mysql_fetch_assoc($malt3);
$totalRows_malt3 = mysql_num_rows($malt3);

$query_malt4 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain4']);
$malt4 = mysql_query($query_malt4, $brewing) or die(mysql_error());
$row_malt4 = mysql_fetch_assoc($malt4);
$totalRows_malt4 = mysql_num_rows($malt4);

$query_malt5 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain5']);
$malt5 = mysql_query($query_malt5, $brewing) or die(mysql_error());
$row_malt5 = mysql_fetch_assoc($malt5);
$totalRows_malt5 = mysql_num_rows($malt5);

$query_malt6 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain6']);
$malt6 = mysql_query($query_malt6, $brewing) or die(mysql_error());
$row_malt6 = mysql_fetch_assoc($malt6);
$totalRows_malt6 = mysql_num_rows($malt6);

$query_malt7 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain7']);
$malt7 = mysql_query($query_malt7, $brewing) or die(mysql_error());
$row_malt7 = mysql_fetch_assoc($malt7);
$totalRows_malt7 = mysql_num_rows($malt7);

$query_malt8 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain8']);
$malt8 = mysql_query($query_malt8, $brewing) or die(mysql_error());
$row_malt8 = mysql_fetch_assoc($malt8);
$totalRows_malt8 = mysql_num_rows($malt8);

$query_malt9 = sprintf("SELECT * FROM malt WHERE maltName='%s'", $row_log['brewGrain9']);
$malt9 = mysql_query($query_malt9, $brewing) or die(mysql_error());
$row_malt9 = mysql_fetch_assoc($malt9);
$totalRows_malt9 = mysql_num_rows($malt9);

//Grist percentage calculations
$totalExtract = ($row_log['brewExtract1Weight'] + $row_log['brewExtract2Weight'] + $row_log['brewExtract3Weight']  + $row_log['brewExtract4Weight'] + $row_log['brewExtract5Weight']);
$totalGrain = ($row_log['brewGrain1Weight'] + $row_log['brewGrain2Weight'] + $row_log['brewGrain3Weight'] + $row_log['brewGrain4Weight'] + $row_log['brewGrain5Weight'] + $row_log['brewGrain6Weight'] + $row_log['brewGrain7Weight'] + $row_log['brewGrain8Weight'] + $row_log['brewGrain9Weight']);
$totalGrist = ($totalExtract + $totalGrain);
if (($row_log['brewExtract1Weight'] != "0") && ($row_log['brewExtract1Weight'] != "")) { $extract1Per = (($row_log['brewExtract1Weight']/$totalGrist) * 100); }
if (($row_log['brewExtract2Weight'] != "0") && ($row_log['brewExtract2Weight'] != "")) { $extract2Per = (($row_log['brewExtract2Weight']/$totalGrist) * 100); }
if (($row_log['brewExtract3Weight'] != "0") && ($row_log['brewExtract3Weight'] != "")) { $extract3Per = (($row_log['brewExtract3Weight']/$totalGrist) * 100); }
if (($row_log['brewExtract4Weight'] != "0") && ($row_log['brewExtract4Weight'] != "")) { $extract4Per = (($row_log['brewExtract4Weight']/$totalGrist) * 100); }
if (($row_log['brewExtract5Weight'] != "0") && ($row_log['brewExtract5Weight'] != "")) { $extract5Per = (($row_log['brewExtract5Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain1Weight'] != "0") && ($row_log['brewGrain1Weight'] != "")) { $grain1Per = (($row_log['brewGrain1Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain1Weight'] != "0") && ($row_log['brewGrain2Weight'] != "")) { $grain2Per = (($row_log['brewGrain2Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain3Weight'] != "0") && ($row_log['brewGrain3Weight'] != "")) { $grain3Per = (($row_log['brewGrain3Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain4Weight'] != "0") && ($row_log['brewGrain4Weight'] != "")) { $grain4Per = (($row_log['brewGrain4Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain5Weight'] != "0") && ($row_log['brewGrain5Weight'] != "")) { $grain5Per = (($row_log['brewGrain5Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain6Weight'] != "0") && ($row_log['brewGrain6Weight'] != "")) { $grain6Per = (($row_log['brewGrain6Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain7Weight'] != "0") && ($row_log['brewGrain7Weight'] != "")) { $grain7Per = (($row_log['brewGrain7Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain8Weight'] != "0") && ($row_log['brewGrain8Weight'] != "")) { $grain8Per = (($row_log['brewGrain8Weight']/$totalGrist) * 100); }
if (($row_log['brewGrain9Weight'] != "0") && ($row_log['brewGrain9Weight'] != "")) { $grain9Per = (($row_log['brewGrain9Weight']/$totalGrist) * 100); }
if (($totalExtract !=0) && ($totalGrist !=0)) { $totalExtractPer = (($totalExtract/$totalGrist) * 100); }
if (($totalGrain !=0) && ($totalGrist !=0)) { $totalGrainPer = (($totalGrain/$totalGrist) * 100); }

//Hop percentage calculations
$totalHops = ($row_log['brewHops1Weight'] + $row_log['brewHops2Weight'] + $row_log['brewHops3Weight'] + $row_log['brewHops4Weight'] + $row_log['brewHops5Weight'] + $row_log['brewHops6Weight'] + $row_log['brewHops7Weight'] + $row_log['brewHops8Weight'] + $row_log['brewHops9Weight']);
if ($row_pref['measWeight1'] == "ounces") {
$hop1Per = ($row_log['brewHops1Weight'] * $row_log['brewHops1IBU']);
$hop2Per = ($row_log['brewHops2Weight'] * $row_log['brewHops2IBU']);
$hop3Per = ($row_log['brewHops3Weight'] * $row_log['brewHops3IBU']);
$hop4Per = ($row_log['brewHops4Weight'] * $row_log['brewHops4IBU']);
$hop5Per = ($row_log['brewHops5Weight'] * $row_log['brewHops5IBU']);
$hop6Per = ($row_log['brewHops6Weight'] * $row_log['brewHops6IBU']);
$hop7Per = ($row_log['brewHops7Weight'] * $row_log['brewHops7IBU']);
$hop8Per = ($row_log['brewHops8Weight'] * $row_log['brewHops8IBU']);
$hop9Per = ($row_log['brewHops9Weight'] * $row_log['brewHops9IBU']);
};
if ($row_pref['measWeight1'] == "grams") {
$hop1Per = (($row_log['brewHops1Weight'] * 0.035) * $row_log['brewHops1IBU']);
$hop2Per = (($row_log['brewHops2Weight'] * 0.035) * $row_log['brewHops2IBU']);
$hop3Per = (($row_log['brewHops3Weight'] * 0.035) * $row_log['brewHops3IBU']);
$hop4Per = (($row_log['brewHops4Weight'] * 0.035) * $row_log['brewHops4IBU']);
$hop5Per = (($row_log['brewHops5Weight'] * 0.035) * $row_log['brewHops5IBU']);
$hop6Per = (($row_log['brewHops6Weight'] * 0.035) * $row_log['brewHops6IBU']);
$hop7Per = (($row_log['brewHops7Weight'] * 0.035) * $row_log['brewHops7IBU']);
$hop8Per = (($row_log['brewHops8Weight'] * 0.035) * $row_log['brewHops8IBU']);
$hop9Per = (($row_log['brewHops9Weight'] * 0.035) * $row_log['brewHops9IBU']);
};
$totalAAU = ($hop1Per + $hop2Per + $hop3Per + $hop4Per + $hop5Per + $hop6Per + $hop7Per + $hop8Per + $hop9Per);
?>

<div id="headerContent"><a name="recipe" id="recipe"></a>Recipe</div>
<div id="dataContainer">
<?php if ($row_log['brewYield'] != "") { if (($page !="logPrint") && ($page !="recipePrint") && ((($row_log['brewExtract1'] != "") || ($row_log['brewGrain1'] != "")) && ($row_log['brewHops1'] != "")))  { ?>
<table>
     <tr>
    	<td colspan="4" class="dataLabelLeft"><div id="help"><img src="<?php echo $imageSrc; ?>zoom.png" align="absmiddle" border="0" alt="Scale" /></div>Scale This Recipe <?php if ($action == "scale") echo "(original yield: ".$row_log['brewYield']."&nbsp;".$row_pref['measFluid2'].")"; ?></td>
     </tr>
      <tr>
    	<td class="dataLeft" width="5%" nowrap>Enter desired final yield (volume): </td>
        <form action="<?php echo "index.php?page=".$page."&filter=".$row_log['brewBrewerID']."&action=scale"; if ($action == "scale") echo "&amt=".$_POST['amt']; echo "&id=".$row_log['id']."#recipe"; ?>" method="post" name="form1" id="form1">
        <td class="data" width="5%" nowrap><input class="quickEdit" name="amt" type="text" size="5" value="<?php if ($action == "scale") echo $amt; if ($action == "reset") echo $row_log['brewYield']; ?>" /></td>
		<td class="data" width="5%" nowrap><?php echo "&nbsp;".$row_pref['measFluid2']; ?></td>
        <td class="data">&nbsp;<input class="quickEdit" name="submit" type="submit" value="Scale"/>
        <input class="quickEdit" name="reset" type="button" value="Reset" onClick="window.location='<?php echo "index.php?page=".$page."&filter=".$filter."&id=".$id."&action=reset"; ?>'">
        </td></form>
        
     </tr>
</table>
<?php } } ?>

<table class="dataTable">
<?php if ($row_log['brewExtract1'] != "" ) { // hide entire set of extract rows if first not present (1)  ?>
 <tr>
  <td colspan="3" class="dataHeadingLeft">Extracts</td>
 </tr>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewExtract1Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewExtract1Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewExtract1']; ?></td>
  <td class="data"><?php if ($row_log['brewExtract1Weight'] != "") echo round ($extract1Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php if ($row_log['brewExtract2'] != "" ) {  ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewExtract2Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewExtract2Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewExtract2']; ?></td>
  <td class="data"><?php if ($row_log['brewExtract2Weight'] != "") echo round ($extract2Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php }  ?>
 <?php if ($row_log['brewExtract3'] != "" ) {  ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewExtract3Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewExtract3Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewExtract3']; ?></td>
  <td class="data"><?php if ($row_log['brewExtract3Weight'] != "") echo round ($extract3Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php }  ?>
 <?php if ($row_log['brewExtract4'] != "" ) {  ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewExtract4Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewExtract4Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewExtract4']; ?></td>
  <td class="data"><?php if ($row_log['brewExtract4Weight'] != "") echo round ($extract4Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php }  ?>
 <?php if ($row_log['brewExtract5'] != "" ) {  ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewExtract5Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewExtract5Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewExtract5']; ?></td>
  <td class="data"><?php if ($row_log['brewExtract5Weight'] != "") echo round ($extract5Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php }  ?>
 <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
  <td class="dataLeft bdr1T_light_dashed"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalExtract, 2); if ($action == "scale") echo number_format (($totalExtract * $scale), 2); echo"&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data bdr1T_light_dashed">Total Extract Weight</td>
  <td class="data bdr1T_light_dashed"><?php echo round ($totalExtractPer, 1); ?>% of grist</td>
 </tr>
<?php } // end hide extracts (1) ?>

<?php 
// ------------------------ GRAINS SECTION ------------------------ 
if ($row_log['brewGrain1'] != "" ) { // hide entire set of grain rows if first not present
?>
 <tr>
  <td class="dataHeadingLeft" colspan="3">
  <?php if (($page == "recipePrint") || ($page == "logPrint")) echo ""; else { ?><div id="help"><a href="sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div>
  <?php } ?>Grains
  </td>
 </tr>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain1Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain1Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain1']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt1 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain1']; if ($totalRows_malt1 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt1['maltName'] != "") echo $row_malt1['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt1['maltName'] != "") { ?>
		<?php if ($row_malt1['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt1['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt1['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt1['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt1['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt1['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
 </td>
 <td class="data"><?php if ($row_log['brewGrain1Weight'] != "") echo round ($grain1Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php if ($row_log['brewGrain2'] != "" ) { ?> 
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain2Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain2Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain2']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt2 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain2']; if ($totalRows_malt2 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt2['maltName'] != "") echo $row_malt2['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt2['maltName'] != "") { ?>
		<?php if ($row_malt2['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt2['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt2['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt2['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt2['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt2['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php } else { ?>
  		<tr>
    		<td colspan="2">There is no data available for this grain.</td>
  		</tr>
		<?php } ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain2Weight'] != "") echo round ($grain2Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain3'] != "" ) { ?> 
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain3Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain3Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain3']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt3 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain3']; if ($totalRows_malt3 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt3['maltName'] != "") echo $row_malt3['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt3['maltName'] != "") { ?>
		<?php if ($row_malt3['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt3['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt3['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt3['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt3['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt3['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain3Weight'] != "") echo round ($grain3Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain4'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain4Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain4Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain4']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt4 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain4']; if ($totalRows_malt4 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt4['maltName'] != "") echo $row_malt4['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt4['maltName'] != "") { ?>
		<?php if ($row_malt4['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt4['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt4['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt4['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt4['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt4['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain4Weight'] != "") echo round ($grain4Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
  </tr>
<?php } ?>
<?php if ($row_log['brewGrain5'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain5Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain5Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain5']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt5 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain5']; if ($totalRows_malt5 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt5['maltName'] != "") echo $row_malt5['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt5['maltName'] != "") { ?>
		<?php if ($row_malt5['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt5['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt5['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt5['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt5['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt5['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain5Weight'] != "") echo round ($grain5Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain6'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain6Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain6Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain6']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt6 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain6']; if ($totalRows_malt6 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt6['maltName'] != "") echo $row_malt6['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt6['maltName'] != "") { ?>
		<?php if ($row_malt6['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt6['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt6['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt6['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt6['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt6['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain6Weight'] != "") echo round ($grain6Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain7'] != "" ) { ?> 
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain7Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain7Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain7']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt7 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain7']; if ($totalRows_malt7 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt7['maltName'] != "") echo $row_malt7['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt7['maltName'] != "") { ?>
		<?php if ($row_malt7['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt7['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt7['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt7['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt7['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt7['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain7Weight'] != "") echo round ($grain7Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain8'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain8Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain8Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain2']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt8 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain8']; if ($totalRows_malt8 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt8['maltName'] != "") echo $row_malt8['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt8['maltName'] != "") { ?>
		<?php if ($row_malt8['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt8['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt8['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt8['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt8['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt8['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain8Weight'] != "") echo round ($grain8Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain9'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain9Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain9Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain2']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt9 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain9']; if ($totalRows_malt9 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt9['maltName'] != "") echo $row_malt9['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt9['maltName'] != "") { ?>
		<?php if ($row_malt9['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt9['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt9['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt9['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt9['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt9['maltInfo'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Info/Use:</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } 
		} ?>
		</table>
  	</div>
  	</span>
  	</a>
    <?php } ?>
  </div>
  <?php } ?>
  </td>
  <td class="data"><?php if ($row_log['brewGrain9Weight'] != "") echo round ($grain9Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
 <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
  <td class="dataLeft bdr1T_light_dashed"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalGrain, 2); if ($action == "scale") echo number_format (($totalGrain * $scale), 2);  echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data bdr1T_light_dashed"><?php if  ((($page ==  "recipePrint") || ($page == "logPrint")) || ($row_log['brewMethod'] != "All Grain") || (checkmobile())) echo "Total Grain Weight"; else include ('sections/water_amounts_calc.inc.php'); ?></td>
  <td class="data bdr1T_light_dashed"><?php echo round ($totalGrainPer, 1); ?>% of grist</td>
 </tr>
<?php } // end hide grains (2) ?>

<?php if ($row_log['brewAddition1'] != "") { // hide entire set of Adjunct table rows (3) ?>
 <tr>
  <td colspan="3" class="dataHeadingLeft">Adjuncts</td>
 </tr>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition1Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition1Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition1']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php if ($row_log['brewAddition2'] != "" ) { ?>
 <tr>
 <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition2Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition2Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition2']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition3'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition3Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition3Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition3']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition4'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition4Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition4Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition4']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition5'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition5Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition5Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition5']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition6'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition6Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition6Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition6']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition7'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition7Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition7Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition7']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition8'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition8Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition8Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition8']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php if ($row_log['brewAddition9'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewAddition9Amt'], 2); if ($action == "scale") echo number_format(($row_log['brewAddition9Amt'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php echo $row_log['brewAddition9']; ?></td>
  <td>&nbsp;</td>
 </tr>
<?php } ?>
<?php } // end hide Adjuncts (3) ?>

<?php if (($row_log['brewMisc1Name'] != "") && ($row_log['brewMisc1Amount'] != "")) { // hide entire set of misc rows if first is not present (4) ?>
 <tr>
  <td colspan="3" class="dataHeadingLeft">Miscellaneous Ingredients (Non-Fermentable)</td>
 </tr>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc1Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc1Name']; if ($row_log['brewMisc1Time'] !="") echo " @ ".$row_log['brewMisc1Time']." minutes"; else echo ""; if ($row_log['brewMisc1Use'] !="") echo " (".$row_log['brewMisc1Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php if ($row_log['brewMisc2Name'] != "") { ?>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc2Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc2Name']; if ($row_log['brewMisc2Time'] !="") echo " @ ".$row_log['brewMisc2Time']." minutes"; else echo ""; if ($row_log['brewMisc2Use'] !="") echo " (".$row_log['brewMisc2Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewMisc3Name'] != "") { ?>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc3Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc3Name']; if ($row_log['brewMisc3Time'] !="") echo " @ ".$row_log['brewMisc3Time']." minutes"; else echo ""; if ($row_log['brewMisc3Use'] !="") echo " (".$row_log['brewMisc3Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewMisc4Name'] != "") { ?>
 <tr>
  <td class="dataLeft"><?php echo $row_log['brewMisc4Amount']; ?></td>
  <td class="data"><?php echo $row_log['brewMisc4Name']; if ($row_log['brewMisc4Time'] !="") echo " @ ".$row_log['brewMisc4Time']." minutes"; else echo ""; if ($row_log['brewMisc4Use'] !="") echo " (".$row_log['brewMisc4Use'].")"; else echo ""; ?></td>
  <td>&nbsp;</td>
 </tr>
 <?php } ?>
 <?php if ($action == "scale") { ?>
 <tr>
   <td colspan="3" class="text_9 red">* Amounts are NOT scaled in this section. Original yield is <?php echo $row_log['brewYield']."&nbsp;".$row_pref['measFluid2']; ?>. Adjust accordingly.</td>
 </tr>
 <?php } ?>
<?php } // end hide Misc (4) ?>

<?php if ($row_log['brewHops1'] != "" ) { // hide entire set of hops rows if first is not present (5) ?>
 <tr>
  <td colspan="3" class="dataHeadingLeft"><?php if (($page == "recipePrint") || ($page == "logPrint")) echo ""; else { ?><div id="help"><a href="sections/reference.inc.php?section=hops&amp;source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div>
  <?php } ?>Hops</td>
 <td></td></td>
 </tr>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops1Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops1Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops1Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops1'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops1']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops1 > 0) { ?><a href="#"><?php } echo $row_log['brewHops1']."<br>"; if ($totalRows_hops1 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops1['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops1['hopsGrown'] != "" ) { ?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops1['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops1['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops1['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops1['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops1['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops1['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops1['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops1['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops1['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops1['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops1['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops1['hopsExample']; ?></td>
  		</tr>
  	<?php } ?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php
								if ($row_log['brewHops1IBU'] != "" ) echo $row_log['brewHops1IBU']."% ";  
							 	if ($row_log['brewHops1Form'] != "" )  echo $row_log['brewHops1Form']." "; 
                          		if ($row_log['brewHops1Time'] != "" )  echo "@ ".$row_log['brewHops1Time']." minutes "; 
								if (($row_log['brewHops1Type'] != "" ) && ($row_log['brewHops1Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops1Type'] != "") echo  "<br>Type: ".$row_log['brewHops1Type'];
								if ($row_log['brewHops1Type'] == "") echo "";
								if ($row_log['brewHops1Use'] != "" )  echo "<br>Use: ".$row_log['brewHops1Use']." ";  
							?>
  </td>
 <td class="data"><?php if ($row_log['brewHops1IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop1Per, 1); if ($action == "scale") echo round (($hop1Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php if ($row_log['brewHops2'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops2Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops2Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops2Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops2'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops2']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops2 > 0) { ?><a href="#"><?php } echo $row_log['brewHops2']."<br>"; if ($totalRows_hops2 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops2['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops2['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops2['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops2['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops2['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops2['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops2['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops2['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops2['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops2['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops2['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops2['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops2['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops2['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops2IBU'] != "" ) echo $row_log['brewHops2IBU']."% ";  
							 	if ($row_log['brewHops2Form'] != "" )  echo $row_log['brewHops2Form']." "; 
                          		if ($row_log['brewHops2Time'] != "" )  echo "@ ".$row_log['brewHops2Time']." minutes "; 
								if (($row_log['brewHops2Type'] != "" ) && ($row_log['brewHops2Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops2Type'] != "") echo  "<br>Type: ".$row_log['brewHops2Type'];
								if ($row_log['brewHops2Type'] == "") echo "";
								if ($row_log['brewHops2Use'] != "" )  echo "<br>Use: ".$row_log['brewHops2Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops2IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop2Per, 1); if ($action == "scale") echo round (($hop2Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewHops3'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops3Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops3Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops3Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data"><?php if ($row_log['brewHops3'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops3']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops3 > 0) { ?><a href="#"><?php } echo $row_log['brewHops3']."<br>"; if ($totalRows_hops3 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops3['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops3['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops3['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops3['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops3['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops3['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops3['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops3['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops3['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops3['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops3['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops3['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops3['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops3['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops3IBU'] != "" ) echo $row_log['brewHops3IBU']."% ";  
							 	if ($row_log['brewHops3Form'] != "" )  echo $row_log['brewHops3Form']." "; 
                          		if ($row_log['brewHops3Time'] != "" )  echo "@ ".$row_log['brewHops3Time']." minutes "; 
								if (($row_log['brewHops3Type'] != "" ) && ($row_log['brewHops3Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops3Type'] != "") echo  "<br>Type: ".$row_log['brewHops3Type']; 
								if ($row_log['brewHops3Type'] == "") echo "";
								if ($row_log['brewHops3Use'] != "" )  echo "<br>Use: ".$row_log['brewHops3Use']." ";  
							?>
   </td>
   <td class="data"><?php if ($row_log['brewHops3IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop3Per, 1); if ($action == "scale") echo round (($hop3Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewHops4'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops4Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops4Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops4Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data"><?php if ($row_log['brewHops4'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops4']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops4 > 0) { ?><a href="#"><?php } echo $row_log['brewHops4']."<br>"; if ($totalRows_hops4 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops4['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops4['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops4['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops4['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops4['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops4['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops4['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops4['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops4['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops4['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops4['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops4['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops4['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops4['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php
								if ($row_log['brewHops4IBU'] != "" ) echo $row_log['brewHops4IBU']."% ";  
							 	if ($row_log['brewHops4Form'] != "" )  echo $row_log['brewHops4Form']." "; 
                          		if ($row_log['brewHops4Time'] != "" )  echo "@ ".$row_log['brewHops4Time']." minutes "; 
								if (($row_log['brewHops4Type'] != "" ) && ($row_log['brewHops4Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops4Type'] != "") echo "<br>Type: ".$row_log['brewHops4Type'];
								if ($row_log['brewHops4Use'] != "" )  echo "<br>Use: ".$row_log['brewHops4Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops4IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop4Per, 1); if ($action == "scale") echo round (($hop4Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewHops5'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops5Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops5Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops5Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>  
  <td class="data"><?php if ($row_log['brewHops5'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops5']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops5 > 0) { ?><a href="#"><?php } echo $row_log['brewHops5']."<br>"; if ($totalRows_hops5 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops5['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops5['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops5['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops5['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops5['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops5['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops5['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops5['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops5['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops5['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops5IBU'] != "" ) echo $row_log['brewHops5IBU']."% ";  
							 	if ($row_log['brewHops5Form'] != "" )  echo $row_log['brewHops5Form']." "; 
                          		if ($row_log['brewHops5Time'] != "" )  echo "@ ".$row_log['brewHops5Time']." minutes "; 
								if (($row_log['brewHops5Type'] != "" ) && ($row_log['brewHops5Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops5Type'] != "") echo  "<br>Type: ".$row_log['brewHops5Type']; 
								if ($row_log['brewHops5Type'] == "") echo "";
								if ($row_log['brewHops5Use'] != "" )  echo "<br>Use: ".$row_log['brewHops5Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops5IBU'] != "" ) echo round ($hop5Per, 1)."&nbsp;AAUs"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
  <?php if ($row_log['brewHops6'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops6Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops6Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops6Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>  
  <td class="data"><?php if ($row_log['brewHops6'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops6']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops5 > 0) { ?><a href="#"><?php } echo $row_log['brewHops6']."<br>"; if ($totalRows_hops5 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops5['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops5['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops5['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops5['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops5['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops5['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops5['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops5['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops5['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops5['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops5['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops6IBU'] != "" ) echo $row_log['brewHops6IBU']."% ";  
							 	if ($row_log['brewHops6Form'] != "" )  echo $row_log['brewHops6Form']." "; 
                          		if ($row_log['brewHops6Time'] != "" )  echo "@ ".$row_log['brewHops6Time']." minutes "; 
								if (($row_log['brewHops6Type'] != "" ) && ($row_log['brewHops6Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops6Type'] != "") echo  "<br>Type: ".$row_log['brewHops6Type']; 
								if ($row_log['brewHops6Type'] == "") echo "";
								if ($row_log['brewHops6Use'] != "" )  echo "<br>Use: ".$row_log['brewHops6Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops6IBU'] != "" ) echo round ($hop5Per, 1)."&nbsp;AAUs"; else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewHops7'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops7Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops7Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops7Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data"><?php if ($row_log['brewHops7'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops7']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops7 > 0) { ?><a href="#"><?php } echo $row_log['brewHops7']."<br>"; if ($totalRows_hops7 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops7['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops7['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops7['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops7['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops7['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops7['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops7['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops7['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops7['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops7['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops7['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops7['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops7['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops7['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php
								if ($row_log['brewHops7IBU'] != "" ) echo $row_log['brewHops7IBU']."% ";  
							 	if ($row_log['brewHops7Form'] != "" )  echo $row_log['brewHops7Form']." "; 
                          		if ($row_log['brewHops7Time'] != "" )  echo "@ ".$row_log['brewHops7Time']." minutes "; 
								if (($row_log['brewHops7Type'] != "" ) && ($row_log['brewHops7Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops7Type'] != "") echo  "<br>Type: ".$row_log['brewHops7Type'];
								if ($row_log['brewHops7Type'] == "") echo "";
								if ($row_log['brewHops7Use'] != "" )  echo "<br>Use: ".$row_log['brewHops7Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops7IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop7Per, 1); if ($action == "scale") echo round (($hop7Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_log['brewHops8'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops8Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops8Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops9Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data"><?php if ($row_log['brewHops8'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops8']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops8 > 0) { ?><a href="#"><?php } echo $row_log['brewHops8']."<br>"; if ($totalRows_hops8 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops8['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops8['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops8['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops8['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops8['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops8['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops8['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops8['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops8['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops8['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops8['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops8['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops8['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops8['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops8IBU'] != "" ) echo $row_log['brewHops8IBU']."% ";  
							 	if ($row_log['brewHops8Form'] != "" )  echo $row_log['brewHops8Form']." "; 
                          		if ($row_log['brewHops8Time'] != "" )  echo "@ ".$row_log['brewHops8Time']." minutes "; 
								if (($row_log['brewHops8Type'] != "" ) && ($row_log['brewHops8Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops8Type'] != "") echo  "<br>Type: ".$row_log['brewHops8Type'];
								if ($row_log['brewHops8Type'] == "") echo "";
								if ($row_log['brewHops8Use'] != "" )  echo "<br>Use: ".$row_log['brewHops8Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops8IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop8Per, 1); if ($action == "scale") echo round (($hop8Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
  </tr>
 <?php } ?>
 <?php if ($row_log['brewHops9'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops9Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops9Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops9Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data"><?php if ($row_log['brewHops9'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops9']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops9 > 0) { ?><a href="#"><?php } echo $row_log['brewHops9']."<br>"; if ($totalRows_hops9 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops9['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops9['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops9['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops9['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops9['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops9['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops9['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops9['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops9['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops9['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops9['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops9['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops9['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops9['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php
								
								if ($row_log['brewHops9IBU'] != "" ) echo $row_log['brewHops9IBU']."% ";  
							 	if ($row_log['brewHops9Form'] != "" )  echo $row_log['brewHops9Form']." "; 
                          		if ($row_log['brewHops9Time'] != "" )  echo "@ ".$row_log['brewHops9Time']." minutes "; 
								if (($row_log['brewHops9Type'] != "" ) && ($row_log['brewHops9Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops9Type'] != "") echo  "<br>Type: ".$row_log['brewHops9Type'];
								if ($row_log['brewHops9Type'] == "") echo "";
								if ($row_log['brewHops9Use'] != "" )  echo "<br>Use: ".$row_log['brewHops9Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops9IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop9Per, 1); if ($action == "scale") echo round (($hop9Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
  <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
  <td class="dataLeft bdr1T_light_dashed"><?php if ($totalHops > 0) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalHops, 2); if ($action == "scale") echo number_format (($totalHops * $scale), 2); echo "&nbsp;".$row_pref['measWeight1']; } else echo "&nbsp;"; ?></td>
  <td class="data bdr1T_light_dashed"><?php if ($totalHops > 0) echo "Total Hop Weight"; else echo "&nbsp;"; ?></td>
  <td class="data bdr1T_light_dashed"><?php if ($totalAAU > 0) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($totalAAU, 1); if ($action == "scale") echo round (($totalAAU * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
</table>
<?php } // end hide Hops (5) ?>
</div>

<?php if ($row_log['brewBoilTime'] != "") { ?>
<div id="headerContent">Boil</div>
<div id="dataContainer">
<table class="dataTable">
 <tr>
   <td class="dataLabelLeft">Total Boil Time:</td>
   <td class="data"><?php echo $row_log['brewBoilTime']; ?> minutes</td>
 </tr>
</table>
</div>
<?php } ?>

<?php if ((($row_log['brewYeast'] != "") && ($row_log['brewYeastProfile'] == "")) || (($row_log['brewYeast'] == "") && ($row_log['brewYeastProfile'] != ""))) { ?><div id="headerContent">Yeast</div><?php } ?>

<?php if ($row_log['brewYeast'] != "") { // hide Yeast section if none listed (6) ?>
<div id="dataContainer">
<table class="dataTable">
  <td class="dataLeft">
  <?php 
  if ($row_log['brewYeastMan'] != "" ) echo $row_log['brewYeastMan']."&nbsp;"; 
  if ($row_log['brewYeast'] != "" ) echo $row_log['brewYeast']; 
  if ($row_log['brewYeastForm'] != "" ) echo "&nbsp;&mdash;&nbsp;".$row_log['brewYeastForm']; 
  if ($row_log['brewYeastAmount'] != "" ) echo "&nbsp;&mdash;&nbsp;".$row_log['brewYeastAmount']; 
  ?>
  </td>
 </tr>
</table>
</div>
<?php } // end hide Yeast (6) ?>
<?php if ($row_log['brewYeastProfile'] != "") { // show yeast profile if present 
mysql_select_db($database_brewing, $brewing);
$query_yeast_profiles = sprintf("SELECT * FROM yeast_profiles WHERE id='%s'", $row_log['brewYeastProfile']);
$yeast_profiles = mysql_query($query_yeast_profiles, $brewing) or die(mysql_error());
$row_yeast_profiles = mysql_fetch_assoc($yeast_profiles);
?>
<div id="dataContainer">
<table class="dataTable">
<?php if ($row_yeast_profiles['yeastName'] != "") { ?>
<tr>
   <td class="dataLabelLeft">Name:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastName']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastLab'] != "") { ?>
<tr>
   <td class="dataLabelLeft">Manufacturer:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastLab']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastProdID'] != "") { ?>
<tr> 
   <td class="dataLabelLeft">Product ID:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastProdID']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastType'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Type:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastType']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastFloc'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Flocculation:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastFloc']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastAtten'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Attenuation:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastAtten']; ?>%</td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastTolerance'] != "") { ?>
<tr>  
   <td class="dataLabelLeft">Alcohol Tolerance:</td>
   <td class="data"><?php echo $row_yeast_profiles['yeastTolerance']; ?></td>
</tr>
<?php } 
if ($row_yeast_profiles['yeastMinTemp'] != "") { ?>
<tr>   
   <td class="dataLabelLeft">Temperature Range:</td>
   <td class="data"><?php if ($row_pref['measTemp'] == "C") { echo round(((($row_yeast_profiles['yeastMinTemp'] - 32) / 9) * 5), 0)."&ndash;"; echo round(((($row_yeast_profiles['yeastMaxTemp'] - 32) / 9) * 5), 0); } else { echo $row_yeast_profiles['yeastMinTemp']."&ndash;".$row_yeast_profiles['yeastMaxTemp']; } ?>&deg;<?php echo $row_pref['measTemp']; ?></td>
</tr>
<?php } 
if ($row_log['brewYeastAmount'] != "" ) { ?>
<tr>  
   <td class="dataLabelLeft">Amount:</td>
   <td class="data"><?php echo $row_log['brewYeastAmount']; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>
<!-- </div> -->
