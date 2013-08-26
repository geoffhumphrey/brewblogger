<?php
mysql_select_db($database_brewing, $brewing);
$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_log['brewStyle']);
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
?>
<style type="text/css">
<!--
#help {
	margin: -5px 0 0 -18px;
}
-->
</style>
<div class="data-container">
	<div class="split-container">
		<div class="split-left-two-column">
    		<div class="data-item-container">
    			<div class="data-label"><?php if (($page == "recipePrint") || ($page == "logPrint")) echo ""; else { ?><div id="help"><a href="sections/reference.inc.php?section=styles&source=log&KeepThis=true&TB_iframe=true&height=450&width=800" title="BJCP Style Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Reference"></a></div><?php } ?>Style:</div>
        		<div class="data-regular">
                	<?php if (($page ==  "recipePrint") || ($page == "logPrint")) echo $row_log['brewStyle']; else { ?><div id="moreInfo"><?php if ($totalRows_styles > 0) { ?><a href="#"><?php } echo $row_log['brewStyle'];  if ($totalRows_styles > 0) { ?><span><div id="moreInfoWrapper"><?php include ('reference/styles.inc.php'); ?></div></span></a>&nbsp;&nbsp;<a href="<?php echo $row_styles['brewStyleLink']; ?>" target="_blank"><img src="<?php echo $imageSrc; ?>link.png" align="absmiddle" border="0" alt="Click for more information about <?php echo $row_log['brewStyle']; ?> from the BJCP website." title="Click for more information about <?php echo $row_log['brewStyle']; ?> from the BJCP website."></a><?php } ?></div><?php } ?>	
                </div>
        	</div>
            <?php if ($row_pref['mode'] == "2") { 
	  			mysql_select_db($database_brewing, $brewing);
				$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
				$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
				$row_user2 = mysql_fetch_assoc($user2);
				$totalRows_user2 = mysql_num_rows($user2);
	    	?>
            <div class="data-item-container">
    			<div class="data-label"><?php if (($page =="recipeDetail") || ($page =="recipePrint")) echo "Contributor:"; else echo "Brewer:"; ?></div>
        		<div class="data-regular"><?php if ($row_log['brewBrewerID'] == "") echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLastName']; else echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></div>
        	</div>
            <?php } ?>
            <?php if (($page !="recipeDetail") && ($page !="recipePrint")) { ?>
            <div class="data-item-container">
    			<div class="data-label">Brew Date:</div>
        		<div class="data-regular"><?php echo dateconvert($row_log['brewDate'],2);?></div>
        	</div>
            <?php } ?>
            <?php if (isset($row_log['brewTapDate']) && $row_log['brewTapDate'] != "") { ?>
            <div class="data-item-container">
    			<div class="data-label">Tap Date:</div>
        		<div class="data-regular"><?php echo dateconvert($row_log['brewTapDate'],2); ?></div>
        	</div>
            <?php } ?>
            <?php if ($row_log['brewYield'] != "" ) {  ?>
            <div class="data-item-container">
    			<div class="data-label">Yield:</div>
        		<div class="data-regular"><?php if (($action == "default") || ($action == "print") || ($action == "reset")) echo $row_log['brewYield']; if ($action == "scale") echo $amt; echo "&nbsp;".$row_pref['measFluid2']; ?></div>
        	</div>
            <?php } ?>
            
           
            <div class="data-item-container">
    			<div class="data-label">Bitterness:</div>
        		<div class="data-regular">
				<?php echo round(ltrim($row_log['brewBitterness'], "0"), 1) . '&nbsp;' . $row_pref['measBitter']; 
					if ($row_log['brewIBUFormula'] != "") echo " (" . $row_log['brewIBUFormula'] . ")"; 
					?>
                </div>
        	</div>
            <?php 
				if (($row_log['brewOG'] == "" ) && ($row_log['brewFG'] == "" )) echo ""; 
				else { 
					if ($row_log['brewBitterness'] != "") { ?>
            <div class="data-item-container">
    			<div class="data-label">BU/GU:</div>
        		<div class="data-regular"><?php echo calc_bugu($row_log['brewBitterness'],$row_log['brewOG']); ?></div>
        	</div>
            	<?php } ?>
            <div class="data-item-container">
    			<div class="data-label">Calories:</div>
        		<div class="data-regular"><?php echo calc_calories($row_log['brewOG'],$row_log['brewFG']); ?> (12 ounces)</div>
        	</div>
            
            <div class="data-item-container">
    			<div class="data-label">ABV:</div>
        		<div class="data-regular"><?php echo calc_abv($row_log['brewOG'],$row_log['brewFG']); ?>%</div>
        	</div>
            <div class="data-item-container">
    			<div class="data-label">ABW:</div>
        		<div class="data-regular"><?php echo calc_abw($row_log['brewOG'],$row_log['brewFG']); ?>%</div>
        	</div>
            <?php } ?>
    	</div>
    	<div class="split-right-two-column">
        <?php if ($row_log['brewLovibond'] != "" ) { ?>
            <div class="data-item-container">
    			<div class="data-label">
               	<?php if (($page == "recipePrint") || ($page == "logPrint")) { 
					echo "";
	     			} else {
	       			echo '<div id="help"><a href="sections/reference.inc.php?section=color&source=log&KeepThis=true&TB_iframe=true&height=350&width=600" title="SRM Color Reference" class="thickbox"><img src="' . $imageSrc . 'information.png" align="absmiddle" border="0" alt="Reference"></a></div>';
	     			} ?>
                	Color (<?php echo $row_pref['measColor']; ?>):
                </div>
        		<div class="data-regular">
                <?php 
					if ($page == "logPrint" || $page == "recipePrint") { echo round($row_log['brewLovibond'], 1); } 
					else {
						//echo '<table><tr>' . "\n";
	       				$brewLov   = $row_log['brewLovibond'];
	       				if ($row_pref['measColor'] == "EBC") $brewLov = ebc_to_srm($brewLov);
	       				$fontColor = ($brewLov >= 15) ? "#ffffff" : "#000000";
	      				$bkColor   = get_display_color($brewLov);
	       				echo '<span class="color-display" style="background: ' . $bkColor . '; color: ' . $fontColor . ';">';
	       				echo round($row_log['brewLovibond'], 1);
	       				echo '</span>' . "\n";
	       				echo '&nbsp;(';
	       				if ($row_log['brewColorFormula'] == "") {
		 					echo "Formula Unknown";
	      					} else {
		 					echo $row_log['brewColorFormula'];
	       					}
	       				echo ')';
	     				} ?>
	       		  </div>
        	</div>
            <?php } ?>
            <?php 
				if (($page != "recipeDetail") && ($page != "recipePrint")) { 
					if ($row_log['brewTargetOG'] != "" ) {  
			?>
    		<div class="data-item-container">
    			<div class="data-label">Target OG:</div>
        		<div class="data-regular"><?php echo number_format($row_log['brewTargetOG'], 3); ?></div>
        	</div>
            <?php } 
				} 
				if (($page != "recipeDetail") && ($page != "recipePrint")) { 
					if ($row_log['brewTargetFG'] != "" ) {  
			?>
            <div class="data-item-container">
    			<div class="data-label">Target FG:</div>
        		<div class="data-regular"><?php echo number_format($row_log['brewTargetFG'], 3); ?></div>
        	</div>
            <?php } 
				} 
			?>
            <?php if ($row_log['brewOG'] != "" ) {  ?>
            <div class="data-item-container">
    			<div class="data-label">OG:</div>
        		<div class="data-regular"><?php echo number_format($row_log['brewOG'], 3)."&nbsp;(".calc_plato($row_log['brewOG'])."&deg; P)"; ?> </div>
        	</div>
            <?php }  
				if (($page != "recipeDetail") && ($page != "recipePrint")) { 
					if ($row_log['brewGravity1'] != "" ) {  ?>
            <div class="data-item-container">
    			<div class="data-label">Reading 1:</div>
        		<div class="data-regular"><?php echo $row_log['brewGravity1']; if ($row_log['brewGravity1Days'] != "" ) echo "&nbsp;(".$row_log['brewGravity1Days']." days)";  ?></div>
        	</div>
            <?php }
				} 
				if (($page != "recipeDetail") && ($page != "recipePrint")) { 
					if ($row_log['brewGravity2'] != "" ) {  ?>
            <div class="data-item-container">
    			<div class="data-label">Reading 2:</div>
        		<div class="data-regular"><?php echo $row_log['brewGravity2']; if ($row_log['brewGravity2Days'] != "" ) echo "&nbsp;(".$row_log['brewGravity1Days']." days)";  ?></div>
        	</div>
            <?php }
				}
			 if ($row_log['brewFG'] != "" ) {  ?>
            <div class="data-item-container">
    			<div class="data-label">FG:</div>
        		<div class="data-regular"><?php echo number_format($row_log['brewFG'], 3)."&nbsp;(".calc_plato($row_log['brewFG'])."&deg; P)"; ?></div>
        	</div>
            <?php } ?>
            <?php if (($row_log['brewOG'] != "" ) && ($row_log['brewFG'] != "" )) { ?>
            <div class="data-item-container">
    			<div class="data-label">Real Extract:</div>
        		<div class="data-regular"><?php echo calc_extract($row_log['brewOG'],$row_log['brewFG'])."&deg; P"; ?></div>
        	</div>
            <div class="data-item-container">
    			<div class="data-label">Attenuation:</div>
        		<div class="data-regular"><?php echo calc_app_atten($row_log['brewOG'],$row_log['brewFG'])."% (A) / ".calc_real_atten($row_log['brewOG'],$row_log['brewFG']); ?>% (R)</div>
        	</div>
            <?php } ?>
            <?php 
				if (($page !="recipeDetail") && ($page !="recipePrint")) { 
					if ($row_log['brewStatus'] !="") { ?>
            <div class="data-item-container">
    			<div class="data-label">Status:</div>
                <div class="data-regular"><?php echo $row_log['brewStatus']; ?></div>
	      	</div>
	    	<?php 	} 
				} 
			?>
            <?php 
				if (($page !="recipeDetail") && ($page !="recipePrint")) {   
					if ($row_log['brewCondition'] != "" ) {  ?>
            <div class="data-item-container">
    			<div class="data-label">Conditioning:</div>
        		<div class="data-regular"><?php echo $row_log['brewCondition']; ?></div>
        	</div>
            <?php 	} // Conditioning 
			} ?>
    	</div>
		</div>
</div>