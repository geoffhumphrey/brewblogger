<div id="calculate">
<div id="calculateInner">
    <table class="dataTable">
    <tr>
    	<td colspan="2" class="text_14_bold">Predicted Results</td>
		<td class="text_14_bold data">BJCP</td>
    </tr>
	<tr>
		<td colspan="3"><hr></td>
	</tr>
	<tr>
		<td class="dataLabelWide">Name:</td>
		<td class="data"><?php echo $brewName; ?></td>
		<td class=" bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide">Style:</td>
		<td class="data"><?php echo $brewStyle; ?></td>
		<td class="data bdr1L_black"><a href="<?php echo $row_style1['brewStyleLink']; ?>" target="_blank"><?php echo $row_style1['brewStyleGroup'].$row_style1['brewStyleNum']; ?></a></td>
	</tr>
	<tr>
		<td class="dataLabelWide">Color:</td>
		<td class="data">
		<?php include ('../includes/color.inc.php'); ?>
		      <table>
		        <tr>
		          <td class="colorTable" align="center" bgcolor="<?php echo $beercolor; ?>"><?php if ($SRM >= 15) echo "<font color=\"#ffffff\">"; else echo "<font color=\"#000000\">"; echo round ($SRM, 1)."/"; echo colorconvert($SRM, "EBC"); ?></td>
		          <td class="data">SRM/EBC</td>
                </tr>
		      </table>
		</td>
		<td class="data bdr1L_black"><?php include ('../includes/colorStyle.inc.php'); ?>
		<?php
		if ($row_style1['brewStyleSRM'] == "") { echo "Varies"; }
		elseif ($row_style1['brewStyleSRM'] == "N/A") { echo "N/A"; }
		elseif ($row_style1['brewStyleSRM'] != "") 
		{ 
		$SRMmin = ltrim ($row_style1['brewStyleSRM'], "0"); 
		$SRMmax = ltrim ($row_style1['brewStyleSRMMax'], "0"); 
			echo "<table><tr><td align=\"center\" bgcolor=".$beercolorMin." class=\"colorTable\">"; 
			if ($SRMmin > "15") echo "<font color=\"#ffffff\">"; 
			else echo "<font color=\"#000000\">"; 
			echo $SRMmin."/".round(colorconvert($SRMmin, "EBC"), 0)."</font></td>
			<td width=\"2\">&ndash;</td>
			<td align=\"center\" bgcolor=".$beercolorMax." class=\"colorTable\">"; 
			if ($SRMmax > "15") echo "<font color=\"#ffffff\">"; 
			else echo "<font color=\"#000000\">"; 
			echo $SRMmax."/".round(colorconvert($SRMmax, "EBC"), 0)."</font></td></tr></table>";
		} else { echo "&nbsp;"; }
		?>
		</td>
        
	</tr>
		<tr>
		<td class="dataLabelWide" nowrap>Bitterness:</td>
		<td class="data" nowrap>
			<table>
 				<tr>
    				<td>Garetz:&nbsp;</td>
    				<td><?php echo round ($bitternessG, 1); ?>&nbsp;</td>
    				<td>IBU</td>
  				</tr>
  				<tr>
    				<td>Rager:&nbsp;</td>
    				<td><?php echo round ($bitternessR, 1); ?>&nbsp;</td>
    				<td>IBU</td>
  				</tr>
  				<tr>
    				<td>Tinseth:&nbsp;</td>
    				<td><?php echo round ($bitternessT, 1); ?>&nbsp;</td>
    				<td>IBU</td>
  				</tr>
  				<tr>
    				<td>Daniels:&nbsp;</td>
    				<td><?php echo round ($bitternessD, 1); ?>&nbsp;</td>
    				<td>IBU</td>
  				</tr>
  				<tr>
   				 	<td>Avg:&nbsp;</td>
    				<td><strong><?php echo round ($bitternessAvg, 1); ?></strong>&nbsp;</td>
    				<td>IBU</td>
  				</tr>
			</table>
        </td>
		<td class="data bdr1L_black" nowrap><?php 
		if ($row_style1['brewStyleIBU'] == "")  { echo "Varies"; }
		elseif ($row_style1['brewStyleIBU'] == "N/A") { echo "N/A"; }
		elseif ($row_style1['brewStyleIBU'] != "") { $IBUmin = ltrim ($row_style1['brewStyleIBU'], "0"); $IBUmax = ltrim ($row_style1['brewStyleIBUMax'], "0"); echo $IBUmin." - ".$IBUmax." IBU"; }
		else { echo "&nbsp;"; }
		?>
		</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>ABV:</td>
		<td class="data" nowrap><?php echo round ($abv, 1); ?>%</td>
		<td class="data bdr1L_black" nowrap>
		<?php 
		if ($row_style1['brewStyleABV'] == "") { echo "Varies"; }
		elseif ($row_style1['brewStyleABV'] != "" ) { echo $row_style1['brewStyleABV']." - ".$row_style1['brewStyleABVMax']."%"; } 
		else { echo "&nbsp;"; } ?>
		</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>ABW:</td>
		<td class="data" nowrap><?php echo round ($abw, 1); ?>%</td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>OG:</td>
		<td class="data" nowrap><?php echo number_format ($og, 3); ?></td>
		<td class="data bdr1L_black" nowrap>
		<?php 
		if ($row_style1['brewStyleOG'] == "") { echo "Varies"; }
		elseif ($row_style1['brewStyleOG'] != "") { echo $row_style1['brewStyleOG']." - ".$row_style1['brewStyleOGMax']; }
		else { echo "&nbsp;"; }
		?>
		</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>FG:</td>
		<td class="data" nowrap><?php echo number_format ($fg, 3); ?></td>
		<td class="data bdr1L_black" nowrap>
		<?php 
		if ($row_style1['brewStyleFG'] == "") { echo "Varies"; }
		elseif ($row_style1['brewStyleFG'] != "") { echo $row_style1['brewStyleFG']." - ".$row_style1['brewStyleFGMax']; }
		else { echo "&nbsp;"; }
		?>
		</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>Plato (I):</td>
		<td class="data" nowrap><?php echo round ($plato_i, 1); ?></td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>Plato (F):</td>
		<td class="data" nowrap><?php echo round ($plato_f, 1); ?></td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>Real Ext:</td>
		<td class="data" nowrap><?php echo round ($real_extract, 1); ?></td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>App. Atten.:</td>
		<td class="data" nowrap><?php echo round ($aa, 1); ?></td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>Real Atten.:</td>
		<td class="data" nowrap><?php echo round ($ra, 1); ?></td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>Calories:</td>
		<td class="data" nowrap><?php echo round ($calories, 0); ?> per 12 oz.</td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
		<td class="dataLabelWide" nowrap>BU/GU:</td>
		<td class="data" nowrap><?php echo round ($bugu, 2); ?></td>
		<td class="bdr1L_black">&nbsp;</td>
	</tr>
	</table>
<?php if (isset($_SESSION["loginUsername"])) { ?>
<table class="dataTable">
<tr>
<td width="90%"><img src="<?php echo $imageSrc; ?>spacer.gif" width="1" height="30"></td>
<td width="5%">&nbsp;</td>
<td width="5%">&nbsp;</td>
</tr>
<tr>


<form id="form2"  action="index.php?action=calculate&results=verify&assoc=import&filter=<?php echo $filter;  if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>" method="post" name="form2">
<td><input type="radio" name="importDB" value="brewing" checked="checked" />Import to BrewBlog<br />
<input type="radio" name="importDB" value="recipes" />Import to Recipes<br /></td>
<td>
<div id="hide">
<input type="hidden" name="brewBrewerID" value="<?php echo $loginUsername; ?>">
<input type="hidden" name="brewName" value="<?php echo strtr($brewName, $html_string); ?>">
<input type="hidden" name="brewYield" value="<?php echo $brewYield; ?>">
<input type="hidden" name="brewStyle" value="<?php echo $brewStyle; ?>">
<input type="hidden" name="brewLovibond" value="<?php if ($row_pref['measColor'] == "EBC") echo $EBC; else echo $SRM; ?>">
<input type="hidden" name="bitternessR" value="<?php echo $bitternessR; ?>">
<input type="hidden" name="bitternessG" value="<?php echo $bitternessG; ?>">
<input type="hidden" name="bitternessT" value="<?php echo $bitternessT; ?>">
<input type="hidden" name="bitternessD" value="<?php echo $bitternessD; ?>">
<input type="hidden" name="bitternessAvg" value="<?php echo $bitternessAvg; ?>">
<input type="hidden" name="brewOG" value="<?php echo $og; ?>">
<input type="hidden" name="brewFG" value="<?php echo $fg; ?>">
<input type="hidden" name="brewExtract1" value="<?php echo $brewExtract1; ?>">
<input type="hidden" name="brewExtract2" value="<?php echo $brewExtract2; ?>">
<input type="hidden" name="brewExtract3" value="<?php echo $brewExtract3; ?>">
<input type="hidden" name="brewExtract4" value="<?php echo $brewExtract4; ?>">
<input type="hidden" name="brewExtract5" value="<?php echo $brewExtract5; ?>">
<input type="hidden" name="brewExtract1Weight" value="<?php echo $brewExtract1Weight; ?>">
<input type="hidden" name="brewExtract2Weight" value="<?php echo $brewExtract2Weight; ?>">
<input type="hidden" name="brewExtract3Weight" value="<?php echo $brewExtract3Weight; ?>">
<input type="hidden" name="brewExtract4Weight" value="<?php echo $brewExtract4Weight; ?>">
<input type="hidden" name="brewExtract5Weight" value="<?php echo $brewExtract5Weight; ?>">
<input type="hidden" name="brewGrain1" value="<?php echo $brewGrain1; ?>">
<input type="hidden" name="brewGrain2" value="<?php echo $brewGrain2; ?>">
<input type="hidden" name="brewGrain3" value="<?php echo $brewGrain3; ?>">
<input type="hidden" name="brewGrain4" value="<?php echo $brewGrain4; ?>">
<input type="hidden" name="brewGrain5" value="<?php echo $brewGrain5; ?>">
<input type="hidden" name="brewGrain6" value="<?php echo $brewGrain6; ?>">
<input type="hidden" name="brewGrain7" value="<?php echo $brewGrain7; ?>">
<input type="hidden" name="brewGrain8" value="<?php echo $brewGrain8; ?>">
<input type="hidden" name="brewGrain9" value="<?php echo $brewGrain9; ?>">
<input type="hidden" name="brewGrain1Weight" value="<?php echo $brewGrain1Weight; ?>">
<input type="hidden" name="brewGrain2Weight" value="<?php echo $brewGrain2Weight; ?>">
<input type="hidden" name="brewGrain3Weight" value="<?php echo $brewGrain3Weight; ?>">
<input type="hidden" name="brewGrain4Weight" value="<?php echo $brewGrain4Weight; ?>">
<input type="hidden" name="brewGrain5Weight" value="<?php echo $brewGrain5Weight; ?>">
<input type="hidden" name="brewGrain6Weight" value="<?php echo $brewGrain6Weight; ?>">
<input type="hidden" name="brewGrain7Weight" value="<?php echo $brewGrain7Weight; ?>">
<input type="hidden" name="brewGrain8Weight" value="<?php echo $brewGrain8Weight; ?>">
<input type="hidden" name="brewGrain9Weight" value="<?php echo $brewGrain9Weight; ?>">
<input type="hidden" name="brewAdjunct1" value="<?php echo $brewAdjunct1; ?>">
<input type="hidden" name="brewAdjunct2" value="<?php echo $brewAdjunct2; ?>">
<input type="hidden" name="brewAdjunct3" value="<?php echo $brewAdjunct3; ?>">
<input type="hidden" name="brewAdjunct4" value="<?php echo $brewAdjunct4; ?>">
<input type="hidden" name="brewAdjunct5" value="<?php echo $brewAdjunct6; ?>">
<input type="hidden" name="brewAdjunct6" value="<?php echo $brewAdjunct7; ?>">
<input type="hidden" name="brewAdjunct7" value="<?php echo $brewAdjunct8; ?>">
<input type="hidden" name="brewAdjunct8" value="<?php echo $brewAdjunct9; ?>">
<input type="hidden" name="brewAdjunct9" value="<?php echo $brewAdjunct5; ?>">
<input type="hidden" name="brewAdjunct1Weight" value="<?php echo $brewAdjunct1Weight; ?>">
<input type="hidden" name="brewAdjunct2Weight" value="<?php echo $brewAdjunct2Weight; ?>">
<input type="hidden" name="brewAdjunct3Weight" value="<?php echo $brewAdjunct3Weight; ?>">
<input type="hidden" name="brewAdjunct4Weight" value="<?php echo $brewAdjunct4Weight; ?>">
<input type="hidden" name="brewAdjunct5Weight" value="<?php echo $brewAdjunct5Weight; ?>">
<input type="hidden" name="brewAdjunct6Weight" value="<?php echo $brewAdjunct6Weight; ?>">
<input type="hidden" name="brewAdjunct7Weight" value="<?php echo $brewAdjunct7Weight; ?>">
<input type="hidden" name="brewAdjunct8Weight" value="<?php echo $brewAdjunct8Weight; ?>">
<input type="hidden" name="brewAdjunct9Weight" value="<?php echo $brewAdjunct9Weight; ?>">
<input type="hidden" name="brewHops1" value="<?php echo $brewHops1; ?>">
<input type="hidden" name="brewHops2" value="<?php echo $brewHops2; ?>">
<input type="hidden" name="brewHops3" value="<?php echo $brewHops3; ?>">
<input type="hidden" name="brewHops4" value="<?php echo $brewHops4; ?>">
<input type="hidden" name="brewHops5" value="<?php echo $brewHops5; ?>">
<input type="hidden" name="brewHops6" value="<?php echo $brewHops6; ?>">
<input type="hidden" name="brewHops7" value="<?php echo $brewHops7; ?>">
<input type="hidden" name="brewHops8" value="<?php echo $brewHops8; ?>">
<input type="hidden" name="brewHops9" value="<?php echo $brewHops9; ?>">
<input type="hidden" name="brewHops1Weight" value="<?php echo $brewHops1Weight; ?>">
<input type="hidden" name="brewHops2Weight" value="<?php echo $brewHops2Weight; ?>">
<input type="hidden" name="brewHops3Weight" value="<?php echo $brewHops3Weight; ?>">
<input type="hidden" name="brewHops4Weight" value="<?php echo $brewHops4Weight; ?>">
<input type="hidden" name="brewHops5Weight" value="<?php echo $brewHops5Weight; ?>">
<input type="hidden" name="brewHops6Weight" value="<?php echo $brewHops6Weight; ?>">
<input type="hidden" name="brewHops7Weight" value="<?php echo $brewHops7Weight; ?>">
<input type="hidden" name="brewHops8Weight" value="<?php echo $brewHops8Weight; ?>">
<input type="hidden" name="brewHops9Weight" value="<?php echo $brewHops9Weight; ?>">
<input type="hidden" name="brewHops1IBU" value="<?php echo $brewHops1IBU; ?>">
<input type="hidden" name="brewHops2IBU" value="<?php echo $brewHops2IBU; ?>">
<input type="hidden" name="brewHops3IBU" value="<?php echo $brewHops3IBU; ?>">
<input type="hidden" name="brewHops4IBU" value="<?php echo $brewHops4IBU; ?>">
<input type="hidden" name="brewHops5IBU" value="<?php echo $brewHops5IBU; ?>">
<input type="hidden" name="brewHops6IBU" value="<?php echo $brewHops6IBU; ?>">
<input type="hidden" name="brewHops7IBU" value="<?php echo $brewHops7IBU; ?>">
<input type="hidden" name="brewHops8IBU" value="<?php echo $brewHops8IBU; ?>">
<input type="hidden" name="brewHops9IBU" value="<?php echo $brewHops9IBU; ?>">
<input type="hidden" name="brewHops1Time" value="<?php echo $brewHops1Time; ?>">
<input type="hidden" name="brewHops2Time" value="<?php echo $brewHops2Time; ?>">
<input type="hidden" name="brewHops3Time" value="<?php echo $brewHops3Time; ?>">
<input type="hidden" name="brewHops4Time" value="<?php echo $brewHops4Time; ?>">
<input type="hidden" name="brewHops5Time" value="<?php echo $brewHops5Time; ?>">
<input type="hidden" name="brewHops6Time" value="<?php echo $brewHops6Time; ?>">
<input type="hidden" name="brewHops7Time" value="<?php echo $brewHops7Time; ?>">
<input type="hidden" name="brewHops8Time" value="<?php echo $brewHops8Time; ?>">
<input type="hidden" name="brewHops9Time" value="<?php echo $brewHops9Time; ?>">
<input type="hidden" name="brewHops1Form" value="<?php echo $brewHops1Form; ?>">
<input type="hidden" name="brewHops2Form" value="<?php echo $brewHops2Form; ?>">
<input type="hidden" name="brewHops3Form" value="<?php echo $brewHops3Form; ?>">
<input type="hidden" name="brewHops4Form" value="<?php echo $brewHops4Form; ?>">
<input type="hidden" name="brewHops5Form" value="<?php echo $brewHops5Form; ?>">
<input type="hidden" name="brewHops6Form" value="<?php echo $brewHops6Form; ?>">
<input type="hidden" name="brewHops7Form" value="<?php echo $brewHops7Form; ?>">
<input type="hidden" name="brewHops8Form" value="<?php echo $brewHops8Form; ?>">
<input type="hidden" name="brewHops9Form" value="<?php echo $brewHops9Form; ?>">
</div>
<input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_import_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Import Calculation to Recipe Database" class="radiobutton" value="Import"></form> 
</form>
</td>
<td>
<?php if ($id !="default") { ?>
<?php if (($row_recipeRecalc['brewBrewerID']) == ($loginUsername) || ($row_user['userLevel'] == "1")) { ?>
<form id="form1" action="index.php?action=calculate&results=verify&assoc=update&filter=<?php echo $filter; if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>"  method="post" name="form1">
<div id="hide">
<input type="hidden" name="brewBrewerID" value="<?php if ($row_user['userName'] == $loginUsername) echo $loginUsername; else echo $row_recipeRecalc['brewBrewerID']; ?>">
<input type="hidden" name="brewName" value="<?php echo strtr($brewName, $html_string); ?>">
<input type="hidden" name="brewYield" value="<?php echo $brewYield; ?>">
<input type="hidden" name="brewStyle" value="<?php echo $brewStyle; ?>">
<input type="hidden" name="brewLovibond" value="<?php if ($row_pref['measColor'] == "EBC") echo $EBC; else echo $SRM; ?>">
<input type="hidden" name="bitternessR" value="<?php echo $bitternessR; ?>">
<input type="hidden" name="bitternessG" value="<?php echo $bitternessG; ?>">
<input type="hidden" name="bitternessT" value="<?php echo $bitternessT; ?>">
<input type="hidden" name="bitternessD" value="<?php echo $bitternessD; ?>">
<input type="hidden" name="bitternessAvg" value="<?php echo $bitternessAvg; ?>">
<input type="hidden" name="brewOG" value="<?php echo $og; ?>">
<input type="hidden" name="brewFG" value="<?php echo $fg; ?>">
<input type="hidden" name="brewExtract1" value="<?php echo $brewExtract1; ?>">
<input type="hidden" name="brewExtract2" value="<?php echo $brewExtract2; ?>">
<input type="hidden" name="brewExtract3" value="<?php echo $brewExtract3; ?>">
<input type="hidden" name="brewExtract4" value="<?php echo $brewExtract4; ?>">
<input type="hidden" name="brewExtract5" value="<?php echo $brewExtract5; ?>">
<input type="hidden" name="brewExtract1Weight" value="<?php echo $brewExtract1Weight; ?>">
<input type="hidden" name="brewExtract2Weight" value="<?php echo $brewExtract2Weight; ?>">
<input type="hidden" name="brewExtract3Weight" value="<?php echo $brewExtract3Weight; ?>">
<input type="hidden" name="brewExtract4Weight" value="<?php echo $brewExtract4Weight; ?>">
<input type="hidden" name="brewExtract5Weight" value="<?php echo $brewExtract5Weight; ?>">
<input type="hidden" name="brewGrain1" value="<?php echo $brewGrain1; ?>">
<input type="hidden" name="brewGrain2" value="<?php echo $brewGrain2; ?>">
<input type="hidden" name="brewGrain3" value="<?php echo $brewGrain3; ?>">
<input type="hidden" name="brewGrain4" value="<?php echo $brewGrain4; ?>">
<input type="hidden" name="brewGrain5" value="<?php echo $brewGrain5; ?>">
<input type="hidden" name="brewGrain6" value="<?php echo $brewGrain6; ?>">
<input type="hidden" name="brewGrain7" value="<?php echo $brewGrain7; ?>">
<input type="hidden" name="brewGrain8" value="<?php echo $brewGrain8; ?>">
<input type="hidden" name="brewGrain9" value="<?php echo $brewGrain9; ?>">
<input type="hidden" name="brewGrain1Weight" value="<?php echo $brewGrain1Weight; ?>">
<input type="hidden" name="brewGrain2Weight" value="<?php echo $brewGrain2Weight; ?>">
<input type="hidden" name="brewGrain3Weight" value="<?php echo $brewGrain3Weight; ?>">
<input type="hidden" name="brewGrain4Weight" value="<?php echo $brewGrain4Weight; ?>">
<input type="hidden" name="brewGrain5Weight" value="<?php echo $brewGrain5Weight; ?>">
<input type="hidden" name="brewGrain6Weight" value="<?php echo $brewGrain6Weight; ?>">
<input type="hidden" name="brewGrain7Weight" value="<?php echo $brewGrain7Weight; ?>">
<input type="hidden" name="brewGrain8Weight" value="<?php echo $brewGrain8Weight; ?>">
<input type="hidden" name="brewGrain9Weight" value="<?php echo $brewGrain9Weight; ?>">
<input type="hidden" name="brewAdjunct1" value="<?php echo $brewAdjunct1; ?>">
<input type="hidden" name="brewAdjunct2" value="<?php echo $brewAdjunct2; ?>">
<input type="hidden" name="brewAdjunct3" value="<?php echo $brewAdjunct3; ?>">
<input type="hidden" name="brewAdjunct4" value="<?php echo $brewAdjunct4; ?>">
<input type="hidden" name="brewAdjunct5" value="<?php echo $brewAdjunct6; ?>">
<input type="hidden" name="brewAdjunct6" value="<?php echo $brewAdjunct7; ?>">
<input type="hidden" name="brewAdjunct7" value="<?php echo $brewAdjunct8; ?>">
<input type="hidden" name="brewAdjunct8" value="<?php echo $brewAdjunct9; ?>">
<input type="hidden" name="brewAdjunct9" value="<?php echo $brewAdjunct5; ?>">
<input type="hidden" name="brewAdjunct1Weight" value="<?php echo $brewAdjunct1Weight; ?>">
<input type="hidden" name="brewAdjunct2Weight" value="<?php echo $brewAdjunct2Weight; ?>">
<input type="hidden" name="brewAdjunct3Weight" value="<?php echo $brewAdjunct3Weight; ?>">
<input type="hidden" name="brewAdjunct4Weight" value="<?php echo $brewAdjunct4Weight; ?>">
<input type="hidden" name="brewAdjunct5Weight" value="<?php echo $brewAdjunct5Weight; ?>">
<input type="hidden" name="brewAdjunct6Weight" value="<?php echo $brewAdjunct6Weight; ?>">
<input type="hidden" name="brewAdjunct7Weight" value="<?php echo $brewAdjunct7Weight; ?>">
<input type="hidden" name="brewAdjunct8Weight" value="<?php echo $brewAdjunct8Weight; ?>">
<input type="hidden" name="brewAdjunct9Weight" value="<?php echo $brewAdjunct9Weight; ?>">
<input type="hidden" name="brewHops1" value="<?php echo $brewHops1; ?>">
<input type="hidden" name="brewHops2" value="<?php echo $brewHops2; ?>">
<input type="hidden" name="brewHops3" value="<?php echo $brewHops3; ?>">
<input type="hidden" name="brewHops4" value="<?php echo $brewHops4; ?>">
<input type="hidden" name="brewHops5" value="<?php echo $brewHops5; ?>">
<input type="hidden" name="brewHops6" value="<?php echo $brewHops6; ?>">
<input type="hidden" name="brewHops7" value="<?php echo $brewHops7; ?>">
<input type="hidden" name="brewHops8" value="<?php echo $brewHops8; ?>">
<input type="hidden" name="brewHops9" value="<?php echo $brewHops9; ?>">
<input type="hidden" name="brewHops1Weight" value="<?php echo $brewHops1Weight; ?>">
<input type="hidden" name="brewHops2Weight" value="<?php echo $brewHops2Weight; ?>">
<input type="hidden" name="brewHops3Weight" value="<?php echo $brewHops3Weight; ?>">
<input type="hidden" name="brewHops4Weight" value="<?php echo $brewHops4Weight; ?>">
<input type="hidden" name="brewHops5Weight" value="<?php echo $brewHops5Weight; ?>">
<input type="hidden" name="brewHops6Weight" value="<?php echo $brewHops6Weight; ?>">
<input type="hidden" name="brewHops7Weight" value="<?php echo $brewHops7Weight; ?>">
<input type="hidden" name="brewHops8Weight" value="<?php echo $brewHops8Weight; ?>">
<input type="hidden" name="brewHops9Weight" value="<?php echo $brewHops9Weight; ?>">
<input type="hidden" name="brewHops1IBU" value="<?php echo $brewHops1IBU; ?>">
<input type="hidden" name="brewHops2IBU" value="<?php echo $brewHops2IBU; ?>">
<input type="hidden" name="brewHops3IBU" value="<?php echo $brewHops3IBU; ?>">
<input type="hidden" name="brewHops4IBU" value="<?php echo $brewHops4IBU; ?>">
<input type="hidden" name="brewHops5IBU" value="<?php echo $brewHops5IBU; ?>">
<input type="hidden" name="brewHops6IBU" value="<?php echo $brewHops6IBU; ?>">
<input type="hidden" name="brewHops7IBU" value="<?php echo $brewHops7IBU; ?>">
<input type="hidden" name="brewHops8IBU" value="<?php echo $brewHops8IBU; ?>">
<input type="hidden" name="brewHops9IBU" value="<?php echo $brewHops9IBU; ?>">
<input type="hidden" name="brewHops1Time" value="<?php echo $brewHops1Time; ?>">
<input type="hidden" name="brewHops2Time" value="<?php echo $brewHops2Time; ?>">
<input type="hidden" name="brewHops3Time" value="<?php echo $brewHops3Time; ?>">
<input type="hidden" name="brewHops4Time" value="<?php echo $brewHops4Time; ?>">
<input type="hidden" name="brewHops5Time" value="<?php echo $brewHops5Time; ?>">
<input type="hidden" name="brewHops6Time" value="<?php echo $brewHops6Time; ?>">
<input type="hidden" name="brewHops7Time" value="<?php echo $brewHops7Time; ?>">
<input type="hidden" name="brewHops8Time" value="<?php echo $brewHops8Time; ?>">
<input type="hidden" name="brewHops9Time" value="<?php echo $brewHops9Time; ?>">
<input type="hidden" name="brewHops1Form" value="<?php echo $brewHops1Form; ?>">
<input type="hidden" name="brewHops2Form" value="<?php echo $brewHops2Form; ?>">
<input type="hidden" name="brewHops3Form" value="<?php echo $brewHops3Form; ?>">
<input type="hidden" name="brewHops4Form" value="<?php echo $brewHops4Form; ?>">
<input type="hidden" name="brewHops5Form" value="<?php echo $brewHops5Form; ?>">
<input type="hidden" name="brewHops6Form" value="<?php echo $brewHops6Form; ?>">
<input type="hidden" name="brewHops7Form" value="<?php echo $brewHops7Form; ?>">
<input type="hidden" name="brewHops8Form" value="<?php echo $brewHops8Form; ?>">
<input type="hidden" name="brewHops9Form" value="<?php echo $brewHops9Form; ?>">
</div>
<input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_update_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update Recipe with New Calculations" class="radiobutton" value="Update"></form>
</form>
<?php } }  ?>
</td>
</tr>
</table>
<?php } // end if (isset) ?>
</div>
</div>