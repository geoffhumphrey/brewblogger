<?php
require_once('admin/lib/color.lib.php');

mysql_select_db($database_brewing, $brewing);
$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_log['brewStyle']);
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
?>
<div class="headerContent">Specifics</div>
<div class="dataContainer">
<table class="dataTable">
  <tr>
    <td width="50%">
	<table>
    	<tr>
  	   	   <td class="dataLabelLeft"><?php if (($page == "recipePrint") || ($page == "logPrint")) echo ""; else { ?><div id="help"><a href="sections/reference.inc.php?section=styles&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="BJCP Style Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference"></a></div><?php } ?>Style:</td>
		   <td class="data">
		   <?php if (($page ==  "recipePrint") || ($page == "logPrint")) echo $row_log['brewStyle']; else { ?><div id="moreInfo"><?php if ($totalRows_styles > 0) { ?><a href="#"><?php } echo $row_log['brewStyle'];  if ($totalRows_styles > 0) { ?><span><div id="moreInfoWrapper"><?php include ('reference/styles.inc.php'); ?></div></span></a>&nbsp;&nbsp;<a href="<?php echo $row_styles['brewStyleLink']; ?>" target="_blank"><img src="<?php echo $imageSrc; ?>link.png" align="absmiddle" border="0" alt="Click for more information about <?php echo $row_log['brewStyle']; ?> from the BJCP website." title="Click for more information about <?php echo $row_log['brewStyle']; ?> from the BJCP website."></a><?php } ?></div><?php } ?>		   </td>
       </tr>
	   <?php if ($row_pref['mode'] == "2") { 
	  	mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
	    ?>
       <tr>
       	   <td class="dataLabelLeft"><?php if (($page =="recipeDetail") || ($page =="recipePrint")) echo "Contributor:"; else echo "Brewer:"; ?></td>
		   <td class="data"><?php if ($row_log['brewBrewerID'] == "") echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLastName']; else echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></td>
       </tr>
	   <?php } ?>
<?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>
  	   <tr>
       	   <td class="dataLabelLeft">Brew Date:</td>
		   <td class="data"><?php $date = $row_log['brewDate']; $realdate = dateconvert($date,2); echo $realdate; ?></td>
       </tr>
	   <?php if ($row_log['brewTapDate'] != "") { ?>
		<tr>
			<td class="dataLabelLeft">Tap Date:</td>
			<td class="data"><?php $date = $row_log['brewTapDate']; $realdate = dateconvert($date,2); echo $realdate; ?></td>
		</tr>
		<?php } // Tap Date ?>
<?php } ?>
	   <?php if ($row_log['brewYield'] != "" ) {  ?>
  	   <tr>
    	   <td class="dataLabelLeft">Yield:</td>
		   <td class="data"><?php if (($action == "default") || ($action == "print") || ($action == "reset")) echo $row_log['brewYield']; if ($action == "scale") echo $amt; echo "&nbsp;".$row_pref['measFluid2']; ?></td>
  	   </tr>
	   <?php } // Yield

           // Color
	   if ($row_log['brewLovibond'] != "" ) {
	     echo '<tr>' . "\n";
  	     echo '<td class="dataLabelLeft">';
	     if (($page == "recipePrint") || ($page == "logPrint")) {
	       echo "";
	     } else {
	       echo '<div id="help"><a href="sections/reference.inc.php?section=color&source=log&KeepThis=true&TB_iframe=true&height=350&width=600" title="SRM Color Reference" class="thickbox"><img src="' . $imageSrc . 'information.png" align="absmiddle" border="0" alt="Reference"></a></div>';
	     }
	     echo 'Color (' . $row_pref['measColor'] . '):</td>' . "\n";
	     echo '<td class="data">';
	     if ($page == "logPrint" || $page == "recipePrint") {
	       echo round($row_log['brewLovibond'], 1);
	     } else {
	       echo '<table><tr>' . "\n";
	       $brewLov   = $row_log['brewLovibond'];
	       if ($row_pref['measColor'] == "EBC")
		 $brewLov = ebc_to_srm($brewLov);
	       $fontColor = ($brewLov >= 15) ? "#ffffff" : "#000000";
	       $bkColor   = get_display_color($brewLov);
	       echo '<td class="colorTable" style="text-align: center; background: ' . $bkColor . '; color: ' . $fontColor . '; padding: 0 3px 0 3px">&nbsp;&nbsp;';
	       echo round($row_log['brewLovibond'], 1);
	       echo '&nbsp;&nbsp;</td>' . "\n";
	       echo '<td>&nbsp;(';
	       if ($row_log['brewColorFormula'] == "") {
		 echo "formula unknown";
	       } else {
		 echo $row_log['brewColorFormula'];
	       }
	       echo ')</td>' . "\n";
	       echo '</tr></table>' . "\n";
	     }
	     echo '</td>' . "\n";
	     echo '</tr>' . "\n";
	   }

           // Bitterness
	   if ($row_log['brewBitterness'] != "") {
	     echo '<tr>' . "\n";
  	     echo '<td class="dataLabelLeft">Bitterness:</td>' . "\n";
	     echo '<td class="data">' . round(ltrim($row_log['brewBitterness'], "0"), 1) . ' ' . $row_pref['measBitter'];
	     if ($row_log['brewIBUFormula'] != "")
	       echo " (" . $row_log['brewIBUFormula'] . ")";
	     echo '</td>' . "\n";
             echo '</tr>' . "\n";
	   }

	   if (($row_log['brewOG'] == "" ) || ($row_log['brewFG'] == "" )) 
	     echo "";
	   else {
	     if ($row_log['brewBitterness'] != "") { ?>
               <tr>
	         <td class="dataLabelLeft">BU/GU:</td>
	         <td class="data"><?php $bugu = $row_log['brewBitterness']/(($row_log['brewOG'] - 1) * 1000); echo round ($bugu, 2); ?></td>
	       </tr>
             <?php } ?>
	     <tr>
  	       <td class="dataLabelLeft">Calories:</td>
	       <td class="data"><?php echo round ($calories, 0); ?> (12 ounces)</td>
             </tr>
	   <?php } ?>

  <?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>
	   <?php if ($row_log['brewCondition'] != "" ) {  ?>
  	   <tr>
  	   	   <td class="dataLabelLeft">Conditioning:</td>
		   <td class="data"><?php echo $row_log['brewCondition']; ?></td>
       </tr>
	   <?php } // Conditioning ?>
  <?php } ?>
	   <?php if (($row_log['brewOG'] == "" ) || ($row_log['brewFG'] == "" )) echo ""; else { ?>
  	   <tr>
  	       <td class="dataLabelLeft">ABV:</td>
	       <td class="data"><?php echo round ($abv, 1); ?>%</td>
  	   </tr>
  	   <tr>
  	       <td class="dataLabelLeft">ABW:</td>
	       <td class="data"><?php echo round ($abw, 1); ?>%</td>
       </tr>
	   <?php } // ABV, ABW ?>
   <?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>
		<?php if (($row_log['brewOG'] == "" ) || ($row_log['brewFG'] == "" )) echo ""; else { ?>
  	   <tr>
  	   	   <td class="dataLabelLeft">
		   	   <?php 
		   	   if ($row_log['brewCondition'] == "Keg" ) "";
			   elseif ($row_log['brewCondition'] == "Cask" ) "";
			   elseif ($row_log['brewCondition'] == "Keg and Cask" ) "";
			   elseif ($row_log['brewCondition'] == "" ) "";
			   else echo "Bottling ABV:" 
			   ?>	       </td>
		   <td class="data">
		   	   <?php 
			   if ($row_log['brewCondition'] == "Bottles" ) echo round ($adj_abv, 1)."%";
			   elseif ($row_log['brewCondition'] == "Bottles and Keg" )  echo round ($adj_abv, 1)."%";
			   elseif ($row_log['brewCondition'] == "Bottles, Keg and Cask" )  echo round ($adj_abv, 1)."%";
			   else echo "" 
			   ?>		   </td>
  		</tr>
		<?php } // Bottling ABV ?>
   <?php } ?>	   
     </table>
	</td>
	
	<td width="50%">
	<table>
          <?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>   
  	    <?php if ($row_log['brewBatchNum'] != "" ) { ?>
	      <tr>
	        <td class="dataLabelLeft">Batch No:</td>
		<td class="data"><?php echo $row_log['brewBatchNum']; ?></td>
	      </tr>
            <?php } ?>
  	  <?php } // Batch Number ?>
  	  <?php if ($row_log['brewOG'] != "" ) {  ?>
  	    <tr>
	      <td class="dataLabelLeft">OG:</td>
	      <td class="data"><?php echo number_format($row_log['brewOG'], 3); ?> </td>
  	    </tr>
  	    <tr>
	      <td class="dataLabelLeft">OG (Plato):</td>
	      <td class="data"><?php echo round($plato_i, 2); ?>&deg; P</td>
  	    </tr>
	  <?php } ?>
          <?php if (($page != "recipeDetail") && ($page != "recipePrint")) { ?>
  	    <?php if ($row_log['brewTargetOG'] != "" ) {  ?>
  	      <tr>
	        <td class="dataLabelLeft">Target OG:</td>
	        <td class="data"><?php echo number_format($row_log['brewTargetOG'], 3); ?> </td>
  	      </tr>
  	    <?php } ?>
	    <?php if ($row_log['brewGravity1'] != "" ) {  ?>
              <tr>
	   	<td class="dataLabelLeft">Reading 1:</td>
		<td class="data"><?php echo $row_log['brewGravity1']; ?>&nbsp;<?php if ($row_log['brewGravity1Days'] != "" ) {  ?>&nbsp;(<?php echo $row_log['brewGravity1Days']; ?> days)<?php }  ?></td>
              </tr>
	    <?php } // Gravity 1 ?>
	    <?php if ($row_log['brewGravity2'] != "" ) {  ?>
              <tr>
	        <td class="dataLabelLeft">Reading 2:</td>
		<td class="data"><?php echo $row_log['brewGravity2']; ?>&nbsp;<?php if ($row_log['brewGravity2Days'] != "" ) {  ?>&nbsp;(<?php echo $row_log['brewGravity2Days']; ?> days)<?php }  ?></td>
  	      </tr>
	    <?php } // Gravity 2 ?>
          <?php } ?>
	  <?php if ($row_log['brewFG'] != "" ) {  ?>
  	    <tr>
	      <td class="dataLabelLeft">FG:</td>
	      <td class="data"><?php echo number_format($row_log['brewFG'], 3); ?></td>
  	    </tr>
  	    <tr>
	      <td class="dataLabelLeft">FG (Plato):</td>
	      <td class="data"><?php echo round($plato_f, 2); ?>&deg; P</td>
  	    </tr>
	  <?php } ?>
          <?php if (($page != "recipeDetail") && ($page != "recipePrint")) { ?>
  	    <?php if ($row_log['brewTargetFG'] != "" ) {  ?>
  	      <tr>
	        <td class="dataLabelLeft">Target FG:</td>
		<td class="data"><?php echo number_format($row_log['brewTargetFG'], 3); ?> </td>
  	      </tr>
  	    <?php } // Target FG ?>
  	  <?php } ?>
	  <?php if (($row_log['brewOG'] != "" ) && ($row_log['brewFG'] != "" )) { ?>
            <tr>
	      <td class="dataLabelLeft">Real Extract:</td>
	      <td class="data"><?php echo round ($real_extract, 2); ?>&deg; P</td>
  	    </tr>
  	    <tr>
	      <td class="dataLabelLeft">App. Atten.:</td>
	      <td class="data"><?php echo round ($aa, 1); ?>%</td>
  	    </tr>
  	    <tr>
	      <td class="dataLabelLeft">Real Atten.:</td>
	      <td class="data"><?php echo round ($ra, 1); ?>%</td>
	    </tr>
	  <?php } // FG (Plato), RE, AA, RA ?>
	  <?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>
	    <?php if ($row_log['brewStatus'] !="") { ?>
              <tr>
		 <td class="dataLabelLeft">Status:</td>
                 <td class="data"><?php echo $row_log['brewStatus']; ?></td>
	      </tr>
	    <?php } ?>
	  <?php } ?>
	</table>
	</td>
  </tr>
</table>
</div>