<?php if ($row_log['brewHops1'] != "" ) { // hide entire set of hops rows if first is not present (5) ?>
<?php if (($page == "recipePrint") || ($page == "logPrint")) echo ""; else { ?><div id="help"><a href="sections/reference.inc.php?section=hops&amp;source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="Hops Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference" /></a></div><?php } ?>
<div class="headerContent"><a name="recipe" id="recipe"></a>Hops</div>
<div class="dataContainer">
<table class="dataTable">
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
  <div id="referenceHeader"><?php echo $row_hops6['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops6['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops6['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops6['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops6['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops6['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops6['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops6['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops6['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops6['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops6['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops6['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops6['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops6['hopsExample']; ?></td>
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
 
 <?php if ($row_log['brewHops10'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops10Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops10Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops10Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops10'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops10']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops10 > 0) { ?><a href="#"><?php } echo $row_log['brewHops10']."<br>"; if ($totalRows_hops10 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops10['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops10['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops10['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops10['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops10['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops10['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops10['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops10['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops10['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops10['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops10['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops10['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops10['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops10['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops10IBU'] != "" ) echo $row_log['brewHops10IBU']."% ";  
							 	if ($row_log['brewHops10Form'] != "" )  echo $row_log['brewHops10Form']." "; 
                          		if ($row_log['brewHops10Time'] != "" )  echo "@ ".$row_log['brewHops10Time']." minutes "; 
								if (($row_log['brewHops10Type'] != "" ) && ($row_log['brewHops10Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops10Type'] != "") echo  "<br>Type: ".$row_log['brewHops10Type'];
								if ($row_log['brewHops10Type'] == "") echo "";
								if ($row_log['brewHops10Use'] != "" )  echo "<br>Use: ".$row_log['brewHops10Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops10IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop10Per, 1); if ($action == "scale") echo round (($hop10Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 
 
 <?php if ($row_log['brewHops11'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops11Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops11Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops11Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops11'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops11']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops11 > 0) { ?><a href="#"><?php } echo $row_log['brewHops11']."<br>"; if ($totalRows_hops11 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops11['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops11['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops11['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops11['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops11['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops11['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops11['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops11['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops11['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops11['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops11['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops11['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops11['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops11['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops11IBU'] != "" ) echo $row_log['brewHops11IBU']."% ";  
							 	if ($row_log['brewHops11Form'] != "" )  echo $row_log['brewHops11Form']." "; 
                          		if ($row_log['brewHops11Time'] != "" )  echo "@ ".$row_log['brewHops11Time']." minutes "; 
								if (($row_log['brewHops11Type'] != "" ) && ($row_log['brewHops11Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops11Type'] != "") echo  "<br>Type: ".$row_log['brewHops11Type'];
								if ($row_log['brewHops11Type'] == "") echo "";
								if ($row_log['brewHops11Use'] != "" )  echo "<br>Use: ".$row_log['brewHops11Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops11IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop11Per, 1); if ($action == "scale") echo round (($hop11Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 
 <?php if ($row_log['brewHops12'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops12Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops12Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops12Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops12'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops12']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops12 > 0) { ?><a href="#"><?php } echo $row_log['brewHops12']."<br>"; if ($totalRows_hops12 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops12['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops12['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops12['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops12['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops12['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops12['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops12['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops12['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops12['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops12['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops12['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops12['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops12['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops12['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops12IBU'] != "" ) echo $row_log['brewHops12IBU']."% ";  
							 	if ($row_log['brewHops12Form'] != "" )  echo $row_log['brewHops12Form']." "; 
                          		if ($row_log['brewHops12Time'] != "" )  echo "@ ".$row_log['brewHops12Time']." minutes "; 
								if (($row_log['brewHops12Type'] != "" ) && ($row_log['brewHops12Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops12Type'] != "") echo  "<br>Type: ".$row_log['brewHops12Type'];
								if ($row_log['brewHops12Type'] == "") echo "";
								if ($row_log['brewHops12Use'] != "" )  echo "<br>Use: ".$row_log['brewHops12Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops12IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop12Per, 1); if ($action == "scale") echo round (($hop12Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>

<?php if ($row_log['brewHops13'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops13Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops13Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops13Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops13'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops13']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops13 > 0) { ?><a href="#"><?php } echo $row_log['brewHops13']."<br>"; if ($totalRows_hops13 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops13['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops13['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops13['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops13['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops13['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops13['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops13['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops13['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops13['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops13['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops13['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops13['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops13['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops13['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops13IBU'] != "" ) echo $row_log['brewHops13IBU']."% ";  
							 	if ($row_log['brewHops13Form'] != "" )  echo $row_log['brewHops13Form']." "; 
                          		if ($row_log['brewHops13Time'] != "" )  echo "@ ".$row_log['brewHops13Time']." minutes "; 
								if (($row_log['brewHops13Type'] != "" ) && ($row_log['brewHops13Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops13Type'] != "") echo  "<br>Type: ".$row_log['brewHops13Type'];
								if ($row_log['brewHops13Type'] == "") echo "";
								if ($row_log['brewHops13Use'] != "" )  echo "<br>Use: ".$row_log['brewHops13Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops13IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop13Per, 1); if ($action == "scale") echo round (($hop13Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?> 
 
 
 <?php if ($row_log['brewHops14'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops14Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops14Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops14Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops14'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops14']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops14 > 0) { ?><a href="#"><?php } echo $row_log['brewHops14']."<br>"; if ($totalRows_hops14 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops14['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops14['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops14['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops14['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops14['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops14['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops14['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops14['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops14['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops14['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops14['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops14['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops14['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops14['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops14IBU'] != "" ) echo $row_log['brewHops14IBU']."% ";  
							 	if ($row_log['brewHops14Form'] != "" )  echo $row_log['brewHops14Form']." "; 
                          		if ($row_log['brewHops14Time'] != "" )  echo "@ ".$row_log['brewHops14Time']." minutes "; 
								if (($row_log['brewHops14Type'] != "" ) && ($row_log['brewHops14Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops14Type'] != "") echo  "<br>Type: ".$row_log['brewHops14Type'];
								if ($row_log['brewHops14Type'] == "") echo "";
								if ($row_log['brewHops14Use'] != "" )  echo "<br>Use: ".$row_log['brewHops14Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops14IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop14Per, 1); if ($action == "scale") echo round (($hop14Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 
 <?php if ($row_log['brewHops15'] != "" ) { ?>
 <tr>
  <td class="dataLeft"><?php if ($row_log['brewHops15Weight'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format($row_log['brewHops15Weight'],2); if ($action == "scale") echo number_format(($row_log['brewHops15Weight'] * $scale), 2); }; echo " ".$row_pref['measWeight1']; ?></td>
  <td class="data">
  <?php if ($row_log['brewHops15'] != "" ) { ?>
  <?php if ((($page ==  "recipePrint") || ($page == "logPrint")) || (checkmobile())) echo $row_log['brewHops15']; else { ?>
  <div id="moreInfo"><?php if ($totalRows_hops15 > 0) { ?><a href="#"><?php } echo $row_log['brewHops15']."<br>"; if ($totalRows_hops15 > 0) { ?><span>
  <div id="moreInfoWrapper">
  <div id="referenceHeader"><?php echo $row_hops15['hopsName']; ?></div>
 	<table class="dataTable">
  	<?php if ($row_hops15['hopsGrown'] != "" ) {?>
  		<tr>
			<td class="dataLabelLeft">Region:</td>
			<td class="data"><?php echo $row_hops15['hopsGrown']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops15['hopsAAULow'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">AAU Range:</td>
			<td class="data"><?php { $AAUmin = ltrim ($row_hops15['hopsAAULow'], "0"); $AAUmax = ltrim ($row_hops15['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops15['hopsInfo'] != "" ) {?>
   		<tr>
  			<td class="dataLabelLeft">Notes:</td>
			<td class="data"><?php echo $row_hops15['hopsInfo']; ?></td>
  		</tr>
  	<?php }?>
  	<?php if ($row_hops15['hopsUse'] != "" ) {?> 
  	<tr>
  			<td class="dataLabelLeft">Typical Use:</td>
			<td class="data"><?php echo $row_hops15['hopsUse']; ?></td>
  	</tr>
  	<?php }?>
  	<?php if ($row_hops15['hopsSub'] != "" ) {?>
  		<tr>
  			<td class="dataLabelLeft">Substitution:</td>
			<td class="data"><?php echo $row_hops15['hopsSub']; ?></td>
  		</tr>    
  	<?php }?>
  		<?php if ($row_hops15['hopsExample'] != "" ) {?> 
  		<tr>
  			<td class="dataLabelLeft">Example:</td>
			<td class="data"><?php echo $row_hops15['hopsExample']; ?></td>
  		</tr>
  	<?php }?>
	</table>
  </div>
  </span>
  </a>
  </div>
  <?php } } } ?>
                          <?php 
								if ($row_log['brewHops15IBU'] != "" ) echo $row_log['brewHops15IBU']."% ";  
							 	if ($row_log['brewHops15Form'] != "" )  echo $row_log['brewHops15Form']." "; 
                          		if ($row_log['brewHops15Time'] != "" )  echo "@ ".$row_log['brewHops15Time']." minutes "; 
								if (($row_log['brewHops15Type'] != "" ) && ($row_log['brewHops15Type'] == "Both"))   echo "<br>Type: Bittering and Aroma"; elseif ($row_log['brewHops15Type'] != "") echo  "<br>Type: ".$row_log['brewHops15Type'];
								if ($row_log['brewHops15Type'] == "") echo "";
								if ($row_log['brewHops15Use'] != "" )  echo "<br>Use: ".$row_log['brewHops15Use']." ";  
							?>
  </td>
  <td class="data"><?php if ($row_log['brewHops15IBU'] != "" ) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($hop15Per, 1); if ($action == "scale") echo round (($hop15Per * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
 <?php } ?>
 
 
  <tr bgcolor="<?php if (($page == "recipePrint") || ($page == "logPrint")) echo "#dddddd"; elseif (checkmobile()) echo "#dddddd"; else echo $color1; ?>">
  <td class="dataLeft bdr1T_light_dashed"><?php if ($totalHops > 0) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo number_format ($totalHops, 2); if ($action == "scale") echo number_format (($totalHops * $scale), 2); echo "&nbsp;".$row_pref['measWeight1']; } else echo "&nbsp;"; ?></td>
  <td class="data bdr1T_light_dashed"><?php if ($totalHops > 0) echo "Total Hop Weight"; else echo "&nbsp;"; ?></td>
  <td class="data bdr1T_light_dashed"><?php if ($totalAAU > 0) { if (($action == "default") || ($action == "reset") || ($action == "print")) echo round ($totalAAU, 1); if ($action == "scale") echo round (($totalAAU * $scale), 1); echo "&nbsp;AAUs"; } else echo "&nbsp;"; ?></td>
 </tr>
</table>
</div>
<?php } // end hide Hops (5) ?>
<?php if ($row_log['brewBoilTime'] != "") { ?>
<div class="headerContent">Boil</div>
<div class="dataContainer">
<table class="dataTable">
 <tr>
   <td class="dataLabelLeft">Total Boil Time:</td>
   <td class="data"><?php echo $row_log['brewBoilTime']; ?> minutes</td>
 </tr>
</table>
</div>
<?php } ?>