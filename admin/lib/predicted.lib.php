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
<?php include ('importFormVar.lib.php'); ?>
<input type="hidden" name="brewOG" value="<?php echo $og; ?>">
<input type="hidden" name="brewFG" value="<?php echo $fg; ?>">
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
<?php include ('importFormVar.lib.php'); ?>
<input type="hidden" name="brewOG" value="<?php echo $og; ?>">
<input type="hidden" name="brewFG" value="<?php echo $fg; ?>">
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