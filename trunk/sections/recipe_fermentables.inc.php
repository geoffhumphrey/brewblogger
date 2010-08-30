<?php if ($row_log['brewYield'] != "") { if (($page !="logPrint") && ($page !="recipePrint") && ((($row_log['brewExtract1'] != "") || ($row_log['brewGrain1'] != "")) && ($row_log['brewHops1'] != "")))  { ?>
<div class="headerContent"><a name="recipe" id="recipe"></a>Scale Recipe</div>
<div class="dataContainer">
<table>
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
</div>
<?php } } ?>

<?php if ($row_log['brewExtract1'] != "" ) { // hide entire set of extract rows if first not present (1)  ?>
<div class="headerContent"><a name="recipe" id="recipe"></a>Extract</div>
<div class="dataContainer">
<table class="dataTable">
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
</table>
</div>
<?php } // end hide extracts (1) ?>

<?php // ------------------------ GRAINS SECTION ------------------------ 
if ($row_log['brewGrain1'] != "" ) { // hide entire set of grain rows if first not present
?>
<?php if (($page == "recipePrint") || ($page == "logPrint")) echo ""; else { ?><div id="help"><a href="sections/reference.inc.php?section=grains&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Grains Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div><?php } ?>
<div class="headerContent"><a name="recipe" id="recipe"></a>Malts and Grains</div>
<div class="dataContainer">
<table class="dataTable">
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
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain8']; else { ?>
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
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain9']; else { ?>
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
<?php if ($row_log['brewGrain10'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain10Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain10Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain10']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt10 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain10']; if ($totalRows_malt10 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt10['maltName'] != "") echo $row_malt10['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt10['maltName'] != "") { ?>
		<?php if ($row_malt10['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt10['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt10['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt10['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt10['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt10['maltInfo'] == "") { ?>
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
  <td class="data"><?php if ($row_log['brewGrain10Weight'] != "") echo round ($grain10Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>

<?php if ($row_log['brewGrain11'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain11Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain11Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain11']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt11 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain11']; if ($totalRows_malt11 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt11['maltName'] != "") echo $row_malt11['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt11['maltName'] != "") { ?>
		<?php if ($row_malt11['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt11['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt11['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt11['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt11['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt11['maltInfo'] == "") { ?>
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
  <td class="data"><?php if ($row_log['brewGrain11Weight'] != "") echo round ($grain11Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>

<?php if ($row_log['brewGrain12'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain12Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain12Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain12']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt12 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain12']; if ($totalRows_malt12 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt12['maltName'] != "") echo $row_malt12['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt12['maltName'] != "") { ?>
		<?php if ($row_malt12['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt12['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt12['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt12['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt12['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt12['maltInfo'] == "") { ?>
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
  <td class="data"><?php if ($row_log['brewGrain12Weight'] != "") echo round ($grain12Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>


<?php if ($row_log['brewGrain13'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain13Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain13Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain13']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt13 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain13']; if ($totalRows_malt13 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt13['maltName'] != "") echo $row_malt13['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt13['maltName'] != "") { ?>
		<?php if ($row_malt13['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt13['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt13['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt13['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt13['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt13['maltInfo'] == "") { ?>
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
  <td class="data"><?php if ($row_log['brewGrain13Weight'] != "") echo round ($grain13Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
<?php if ($row_log['brewGrain14'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain14Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain14Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain14']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt14 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain14']; if ($totalRows_malt14 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt14['maltName'] != "") echo $row_malt14['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt14['maltName'] != "") { ?>
		<?php if ($row_malt14['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt14['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt14['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt14['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt14['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt14['maltInfo'] == "") { ?>
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
  <td class="data"><?php if ($row_log['brewGrain14Weight'] != "") echo round ($grain14Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>

<?php if ($row_log['brewGrain15'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewGrain15Weight'], 2); if ($action == "scale") echo number_format(($row_log['brewGrain15Weight'] * $scale), 2); echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data"><?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewGrain15']; else { ?>
  <div id="moreInfo">
  <?php if ($totalRows_malt15 > 0) { ?>
  <a href="#"><?php } echo $row_log['brewGrain15']; if ($totalRows_malt15 > 0) { ?>
  <span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php if ($row_malt15['maltName'] != "") echo $row_malt15['maltName']; else echo "No Information Available" ?></div>
		<table class="dataTable">
		<?php if ($row_malt15['maltName'] != "") { ?>
		<?php if ($row_malt15['maltLovibond'] != "") { ?>
  		<tr>
 			<td class="dataLabelLeft">Color (L):</td>
    		<td class="data"><?php echo $row_malt15['maltLovibond']; ?>&nbsp;&deg;L</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt15['maltLovibond'] == "") { ?>
  		<tr>
    		<td class="dataLabelLeft">Color (L):</td>
    		<td class="data">Not provided.</td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt15['maltInfo'] != "") { ?>
  		<tr align="left" valign="top">
   		<td class="dataLabelLeft">Info/Use:</td>
    	<td class="data"><?php echo $row_malt15['maltInfo']; ?></td>
  		</tr>
		<?php } ?>
		<?php if ($row_malt15['maltInfo'] == "") { ?>
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
  <td class="data"><?php if ($row_log['brewGrain15Weight'] != "") echo round ($grain15Per, 1)."% of grist"; else echo "&nbsp;"; ?></td>
 </tr>
<?php } ?>
 <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
  <td class="dataLeft bdr1T_light_dashed"><?php if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalGrain, 2); if ($action == "scale") echo number_format (($totalGrain * $scale), 2);  echo "&nbsp;".$row_pref['measWeight2']; ?></td>
  <td class="data bdr1T_light_dashed"><?php if  ((($page ==  "recipePrint") || ($page == "logPrint")) || ($row_log['brewMethod'] != "All Grain") || (checkmobile())) echo "Total Grain Weight"; else include (SECTIONS.'water_amounts_calc.inc.php'); ?></td>
  <td class="data bdr1T_light_dashed"><?php echo round ($totalGrainPer, 1); ?>% of grist</td>
 </tr>
</table>
</div>
<?php } // end hide grains ?>

<?php if ($row_log['brewAddition1'] != "") { // hide entire set of Adjunct table rows (3) ?>
<div class="headerContent"><a name="recipe" id="recipe"></a><?php if ($row_styles['brewStyleGroup'] > 23) echo "Ingredients"; else echo "Adjuncts"; ?></div>
<div class="dataContainer">
<table>
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
</table>
</div>
<?php } // end hide Adjuncts (3) ?>