<?php if ($assoc == "import") $importDB = $_POST['importDB']; ?>
<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<table class="dataTable">
	<tr>
		<td><div id="subtitleAdmin"><?php echo $page_title; ?></div></td>
	</tr>
</table>
<div id="headerContentAdmin"><?php if ($assoc != "import") echo "Recalculated"; else echo "Calculated"; ?> <?php if ($source == "brewing") echo "BrewBlog "; ?>Recipe <?php if ($assoc == "import") echo "To Import"; ?></div>
<form id="form4" action="<?php if ($assoc == "update") echo "process"; if ($assoc == "import") echo "index"; ?>.php?action=<?php if ($assoc == "update") echo "update"; if ($assoc == "import") echo "importCalc"; ?>&dbTable=<?php if ($assoc == "update") echo $source; if ($assoc == "import") echo $importDB; if ($assoc == "update") echo "&id=".$id; ?>" method="post" name="form4">
<table class="dataTable">
<?php if ($row_recipeRecalc['id'] != "") { ?>
<tr>
	<td width="10%">&nbsp;</td>
	<td width="40%" class="text_12_bold data">Current Recipe</td>
	<td width="40%" class="text_12_bold data">Recalculated Recipe</td>
</tr>
<?php } ?>
<tr class="bknd_ultra_lt">
	<td class="dataLabelLeft" nowrap>Recipe Name:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo $row_recipeRecalc['brewName']; ?></td><?php } ?>
	<td class="data"><?php echo $brewName; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft" nowrap>Style:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo $row_recipeRecalc['brewStyle']; ?></td><?php } ?>
	<td class="data"><?php echo $brewStyle; ?></td>
</tr>
<tr class="bknd_ultra_lt">
	<td class="dataLabelLeft" nowrap>Color:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo round ($row_recipeRecalc['brewLovibond'],1)." ".$row_pref['measColor']; ?></td><?php } ?>
	<td class="data"><?php echo round ($brewLovibond,1)." ".$row_pref['measColor']; ?></td>
</tr>
<tr>
	<td class="dataLabelLeft" nowrap>Bitterness:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo round ($row_recipeRecalc['brewBitterness'],1); ?></td><?php } ?>
	<td class="data">
    <table>
    <tr>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round ($bitternessD, 1); echo "-Daniels"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Daniels") echo "checked"; ?> /></td>
   		<td>&nbsp;<?php echo round ($bitternessD,1); ?></td>
    	<td>&nbsp;(Daniels)</td>
        <td><input type="radio" name="brewBitterness" value="<?php echo round ($bitternessG, 1); echo "-Garetz"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Garetz") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round ($bitternessG,1); ?></td>
    	<td>&nbsp;(Garetz)&nbsp;</td>
    </tr>
    <tr>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round ($bitternessR, 1); echo "-Rager"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Rager") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round ($bitternessR,1); ?></td>
    	<td>&nbsp;(Rager)</td>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round ($bitternessT, 1); echo "-Tinseth"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Tinseth") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round ($bitternessT,1); ?></td>
    	<td>&nbsp;(Tinseth)&nbsp;</td>
    </tr>
    </table>
    </td>
</tr>
<tr class="bknd_ultra_lt">
	<td class="dataLabelLeft" nowrap>Yield<?php if ($assoc != "import")  echo " (Choose)"; ?>:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import") { ?><input type="radio" name="brewYield" value ="<?php echo $row_recipeRecalc['brewYield']; ?>">&nbsp;<?php } ?><?php echo $row_recipeRecalc['brewYield']; ?></td><?php } ?>
	<td class="data"><?php if ($assoc != "import") { ?><input type="radio" name="brewYield" value ="<?php echo $brewYield; ?>" checked="checked">&nbsp;<?php } ?><?php echo $brewYield; ?></td>
</tr> 
<tr>
	<td class="dataLabelLeft" nowrap>OG<?php if ($assoc != "import")  echo " (Choose)"; ?>:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewOG" value ="<?php echo number_format ($row_recipeRecalc['brewOG'], 3); ?>" checked="checked">&nbsp;<?php } ?><?php echo number_format ($row_recipeRecalc['brewOG'], 3); ?></td><?php } ?>
	<td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewOG" value ="<?php echo number_format ($brewOG, 3); ?>">&nbsp;<?php } ?><?php echo number_format ($brewOG, 3); ?></td>
</tr>
<tr class="bknd_ultra_lt">
	<td class="dataLabelLeft" nowrap>FG<?php if ($assoc != "import")  echo " (Choose)"; ?>:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewFG" value ="<?php if ($row_recipeRecalc['brewFG'] !="") echo number_format ($row_recipeRecalc['brewFG'], 3); else echo ""; ?>" checked="checked">&nbsp;<?php } ?><?php echo number_format ($row_recipeRecalc['brewFG'], 3); ?></td><?php } ?>
	<td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewFG" value ="<?php echo number_format ($brewFG, 3); ?>">&nbsp;<?php } ?><?php echo number_format ($brewFG, 3); ?></td>
</tr>
<tr>
	<td class="dataLabelLeft" nowrap>Extracts:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?>
    <td class="data">
	<?php 
	if ($row_recipeRecalc['brewExtract1'] != "") { 
	echo $row_recipeRecalc['brewExtract1Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract1']."<br>"; 
	} 
	if ($row_recipeRecalc['brewExtract2'] != "") { 
	echo $row_recipeRecalc['brewExtract2Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract2']."<br>"; 
	} 
	if ($row_recipeRecalc['brewExtract3'] != "") { 
	echo $row_recipeRecalc['brewExtract3Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract3']."<br>"; 
	} 
	if ($row_recipeRecalc['brewExtract4'] != "") { 
	echo $row_recipeRecalc['brewExtract4Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract4']."<br>"; 
	} 
	if ($row_recipeRecalc['brewExtract5'] != "") { 
	echo $row_recipeRecalc['brewExtract5Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract5']; 
	} 
	?>
	</td>
    <?php } ?>
	<td class="data">
	<?php 
	if ($brewExtract1 != "") { echo $brewExtract1Weight." ".$row_pref['measWeight2']." ".$brewExtract1."<br>"; } 
	if ($brewExtract2 != "") { echo $brewExtract2Weight." ".$row_pref['measWeight2']." ".$brewExtract2."<br>"; }  
	if ($brewExtract3 != "") { echo $brewExtract3Weight." ".$row_pref['measWeight2']." ".$brewExtract3."<br>"; }  
	if ($brewExtract4 != "") { echo $brewExtract4Weight." ".$row_pref['measWeight2']." ".$brewExtract4."<br>"; }  
	if ($brewExtract5 != "") { echo $brewExtract5Weight." ".$row_pref['measWeight2']." ".$brewExtract5; }  
	?>
	</td>
</tr>
<tr class="bknd_ultra_lt">
	<td class="dataLabelLeft" nowrap>Grains:</td>
	<?php if ($row_recipeRecalc['id'] != "") { ?><td class="data">
	<?php 
	if ($row_recipeRecalc['brewGrain1'] != "") echo $row_recipeRecalc['brewGrain1Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain1']."<br>";
	if ($row_recipeRecalc['brewGrain2'] != "") echo $row_recipeRecalc['brewGrain2Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain2']."<br>";
	if ($row_recipeRecalc['brewGrain3'] != "") echo $row_recipeRecalc['brewGrain3Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain3']."<br>";
	if ($row_recipeRecalc['brewGrain4'] != "") echo $row_recipeRecalc['brewGrain4Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain4']."<br>";
	if ($row_recipeRecalc['brewGrain5'] != "") echo $row_recipeRecalc['brewGrain5Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain5']."<br>";
	if ($row_recipeRecalc['brewGrain6'] != "") echo $row_recipeRecalc['brewGrain6Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain6']."<br>";
	if ($row_recipeRecalc['brewGrain7'] != "") echo $row_recipeRecalc['brewGrain7Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain7']."<br>";
	if ($row_recipeRecalc['brewGrain8'] != "") echo $row_recipeRecalc['brewGrain8Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain8']."<br>";
	if ($row_recipeRecalc['brewGrain9'] != "") echo $row_recipeRecalc['brewGrain9Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain9'];
	?>
	</td>
    <?php } ?>
	<td class="data">
	<?php 
	if ($brewGrain1 != "") echo $brewGrain1Weight." ".$row_pref['measWeight2']." ".$brewGrain1."<br>"; 
	if ($brewGrain2 != "") echo $brewGrain2Weight." ".$row_pref['measWeight2']." ".$brewGrain2."<br>"; 
	if ($brewGrain3 != "") echo $brewGrain3Weight." ".$row_pref['measWeight2']." ".$brewGrain3."<br>"; 
	if ($brewGrain4 != "") echo $brewGrain4Weight." ".$row_pref['measWeight2']." ".$brewGrain4."<br>"; 
	if ($brewGrain5 != "") echo $brewGrain5Weight." ".$row_pref['measWeight2']." ".$brewGrain5."<br>"; 
	if ($brewGrain6 != "") echo $brewGrain6Weight." ".$row_pref['measWeight2']." ".$brewGrain6."<br>"; 
	if ($brewGrain7 != "") echo $brewGrain7Weight." ".$row_pref['measWeight2']." ".$brewGrain7."<br>"; 
	if ($brewGrain8 != "") echo $brewGrain8Weight." ".$row_pref['measWeight2']." ".$brewGrain8."<br>";
	if ($brewGrain9 != "") echo $brewGrain9Weight." ".$row_pref['measWeight2']." ".$brewGrain9; 
	?>
	</td>
</tr>
<tr>
	<td class="dataLabelLeft" nowrap>Adjuncts:</td>
    <?php if ($row_recipeRecalc['id'] != "") { ?>
	<td class="data">
	<?php 
	if ($row_recipeRecalc['brewAddition1'] != "") echo $row_recipeRecalc['brewAddition1Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition1']."<br>";
	if ($row_recipeRecalc['brewAddition2'] != "") echo $row_recipeRecalc['brewAddition2Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition2']."<br>";
	if ($row_recipeRecalc['brewAddition3'] != "") echo $row_recipeRecalc['brewAddition3Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition3']."<br>";
	if ($row_recipeRecalc['brewAddition4'] != "") echo $row_recipeRecalc['brewAddition4Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition4']."<br>";
	if ($row_recipeRecalc['brewAddition5'] != "") echo $row_recipeRecalc['brewAddition5Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition5']."<br>";
	if ($row_recipeRecalc['brewAddition6'] != "") echo $row_recipeRecalc['brewAddition6Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition6']."<br>";
	if ($row_recipeRecalc['brewAddition7'] != "") echo $row_recipeRecalc['brewAddition7Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition7']."<br>";
	if ($row_recipeRecalc['brewAddition8'] != "") echo $row_recipeRecalc['brewAddition8Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition8']."<br>";
	if ($row_recipeRecalc['brewAddition9'] != "") echo $row_recipeRecalc['brewAddition9Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition9'];
	?>
	</td>
    <?php } ?>
	<td class="data">
	<?php 
	if ($brewAdjunct1 != "") echo $brewAdjunct1Weight." ".$row_pref['measWeight2']." ".$brewAdjunct1."<br>"; 
	if ($brewAdjunct2 != "") echo $brewAdjunct2Weight." ".$row_pref['measWeight2']." ".$brewAdjunct2."<br>"; 
	if ($brewAdjunct3 != "") echo $brewAdjunct3Weight." ".$row_pref['measWeight2']." ".$brewAdjunct3."<br>"; 
	if ($brewAdjunct4 != "") echo $brewAdjunct4Weight." ".$row_pref['measWeight2']." ".$brewAdjunct4."<br>"; 
	if ($brewAdjunct5 != "") echo $brewAdjunct5Weight." ".$row_pref['measWeight2']." ".$brewAdjunct5."<br>"; 
	if ($brewAdjunct6 != "") echo $brewAdjunct6Weight." ".$row_pref['measWeight2']." ".$brewAdjunct6."<br>"; 
	if ($brewAdjunct7 != "") echo $brewAdjunct7Weight." ".$row_pref['measWeight2']." ".$brewAdjunct7."<br>"; 
	if ($brewAdjunct8 != "") echo $brewAdjunct8Weight." ".$row_pref['measWeight2']." ".$brewAdjunct8."<br>";
	if ($brewAdjunct9 != "") echo $brewAdjunct9Weight." ".$row_pref['measWeight2']." ".$brewAdjunct9; 
	?>
	</td>
</tr>
<tr class="bknd_ultra_lt">
	<td class="dataLabelLeft" nowrap>Hops:</td>
    <?php if ($row_recipeRecalc['id'] != "") { ?>
	<td class="data">
	<?php 
	if ($row_recipeRecalc['brewHops1'] != "") echo $row_recipeRecalc['brewHops1Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops1']." ".$row_recipeRecalc['brewHops1IBU']."% @ ".$row_recipeRecalc['brewHops1Time']." min.<br>";
	if ($row_recipeRecalc['brewHops2'] != "") echo $row_recipeRecalc['brewHops2Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops2']." ".$row_recipeRecalc['brewHops2IBU']."% @ ".$row_recipeRecalc['brewHops2Time']." min.<br>";
	if ($row_recipeRecalc['brewHops3'] != "") echo $row_recipeRecalc['brewHops3Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops3']." ".$row_recipeRecalc['brewHops3IBU']."% @ ".$row_recipeRecalc['brewHops3Time']." min.<br>";
	if ($row_recipeRecalc['brewHops4'] != "") echo $row_recipeRecalc['brewHops4Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops4']." ".$row_recipeRecalc['brewHops4IBU']."% @ ".$row_recipeRecalc['brewHops4Time']." min.<br>";
	if ($row_recipeRecalc['brewHops5'] != "") echo $row_recipeRecalc['brewHops5Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops5']." ".$row_recipeRecalc['brewHops5IBU']."% @ ".$row_recipeRecalc['brewHops5Time']." min.<br>";
	if ($row_recipeRecalc['brewHops6'] != "") echo $row_recipeRecalc['brewHops6Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops6']." ".$row_recipeRecalc['brewHops6IBU']."% @ ".$row_recipeRecalc['brewHops6Time']." min.<br>";
	if ($row_recipeRecalc['brewHops7'] != "") echo $row_recipeRecalc['brewHops7Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops7']." ".$row_recipeRecalc['brewHops7IBU']."% @ ".$row_recipeRecalc['brewHops7Time']." min.<br>";
	if ($row_recipeRecalc['brewHops8'] != "") echo $row_recipeRecalc['brewHops8Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops8']." ".$row_recipeRecalc['brewHops8IBU']."% @ ".$row_recipeRecalc['brewHops8Time']." min.<br>";
	if ($row_recipeRecalc['brewHops9'] != "") echo $row_recipeRecalc['brewHops9Weight']." ".$row_pref['measWeight1']." ".$row_recipeRecalc['brewHops9']." ".$row_recipeRecalc['brewHops9IBU']."% @ ".$row_recipeRecalc['brewHops9Time']." min.";
	?>
	</td>
    <?php } ?>
	<td class="data">
	<?php 
	if ($brewHops1 != "") echo $brewHops1Weight." ".$row_pref['measWeight1']." ".$brewHops1." ".$brewHops1IBU."% @ ".$brewHops1Time." min.<br>"; 
	if ($brewHops2 != "") echo $brewHops2Weight." ".$row_pref['measWeight1']." ".$brewHops2." ".$brewHops2IBU."% @ ".$brewHops2Time." min.<br>"; 
	if ($brewHops3 != "") echo $brewHops3Weight." ".$row_pref['measWeight1']." ".$brewHops3." ".$brewHops3IBU."% @ ".$brewHops3Time." min.<br>"; 
	if ($brewHops4 != "") echo $brewHops4Weight." ".$row_pref['measWeight1']." ".$brewHops4." ".$brewHops4IBU."% @ ".$brewHops4Time." min.<br>"; 
	if ($brewHops5 != "") echo $brewHops5Weight." ".$row_pref['measWeight1']." ".$brewHops5." ".$brewHops5IBU."% @ ".$brewHops5Time." min.<br>"; 
	if ($brewHops6 != "") echo $brewHops6Weight." ".$row_pref['measWeight1']." ".$brewHops6." ".$brewHops6IBU."% @ ".$brewHops6Time." min.<br>"; 
	if ($brewHops7 != "") echo $brewHops7Weight." ".$row_pref['measWeight1']." ".$brewHops7." ".$brewHops7IBU."% @ ".$brewHops7Time." min.<br>"; 
	if ($brewHops8 != "") echo $brewHops8Weight." ".$row_pref['measWeight1']." ".$brewHops8." ".$brewHops8IBU."% @ ".$brewHops8Time." min.<br>";
	if ($brewHops9 != "") echo $brewHops9Weight." ".$row_pref['measWeight1']." ".$brewHops9." ".$brewHops9IBU."% @ ".$brewHops8Time." min."; 
	?>
	</td>
</tr>
</table>
<div id="hide">
<?php if (($assoc == "import") && ($importDB == "brewing")) { ?>
<input type="hidden" name="brewTargetOG" value="<?php echo round ($brewOG, 3); ?>">
<input type="hidden" name="brewTargetFG" value="<?php echo round ($brewFG, 3); ?>">
<?php } ?>
<?php if (($assoc == "import") && ($importDB == "recipes")) { ?>
<input type="hidden" name="brewOG" value="<?php echo round ($brewOG, 3); ?>">
<input type="hidden" name="brewFG" value="<?php echo round ($brewFG, 3); ?>">
<?php } ?>
<input type="hidden" name="brewName" value="<?php echo $brewName; ?>">
<input type="hidden" name="brewStyle" value="<?php echo $brewStyle; ?>">
<input type="hidden" name="brewLovibond" value="<?php if ($brewLovibond < 10) echo "0"; echo $brewLovibond; ?>">
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
<input type="hidden" name="brewAddition1" value="<?php echo $brewAdjunct1; ?>">
<input type="hidden" name="brewAddition2" value="<?php echo $brewAdjunct2; ?>">
<input type="hidden" name="brewAddition3" value="<?php echo $brewAdjunct3; ?>">
<input type="hidden" name="brewAddition4" value="<?php echo $brewAdjunct4; ?>">
<input type="hidden" name="brewAddition5" value="<?php echo $brewAdjunct6; ?>">
<input type="hidden" name="brewAddition6" value="<?php echo $brewAdjunct7; ?>">
<input type="hidden" name="brewAddition7" value="<?php echo $brewAdjunct8; ?>">
<input type="hidden" name="brewAddition8" value="<?php echo $brewAdjunct9; ?>">
<input type="hidden" name="brewAddition9" value="<?php echo $brewAdjunct5; ?>">
<input type="hidden" name="brewAddition1Amt" value="<?php echo $brewAdjunct1Weight; ?>">
<input type="hidden" name="brewAddition2Amt" value="<?php echo $brewAdjunct2Weight; ?>">
<input type="hidden" name="brewAddition3Amt" value="<?php echo $brewAdjunct3Weight; ?>">
<input type="hidden" name="brewAddition4Amt" value="<?php echo $brewAdjunct4Weight; ?>">
<input type="hidden" name="brewAddition5Amt" value="<?php echo $brewAdjunct5Weight; ?>">
<input type="hidden" name="brewAddition6Amt" value="<?php echo $brewAdjunct6Weight; ?>">
<input type="hidden" name="brewAddition7Amt" value="<?php echo $brewAdjunct7Weight; ?>">
<input type="hidden" name="brewAddition8Amt" value="<?php echo $brewAdjunct8Weight; ?>">
<input type="hidden" name="brewAddition9Amt" value="<?php echo $brewAdjunct9Weight; ?>">
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
<input type="hidden" name="brewBrewerID" value="<?php if ($assoc == "import") echo $filter; elseif ($row_recipeRecalc['brewBrewerID'] != "") echo $row_recipeRecalc['brewBrewerID']; else echo $_SESSION['loginUsername']; ?>">
</div>
<br><br>
<div class="right"><a href="#" onClick="history.go(-1)"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_back_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Back to Calculator" class="radiobutton" /></a>&nbsp;<input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_<?php if ($assoc == "import") echo "import"; if ($assoc == "update") echo "update"; ?>_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update with New Calculations" class="radiobutton" value="Edit"></div>
</form>
