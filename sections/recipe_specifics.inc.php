<?php

$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_log['brewStyle']);
$styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
$row_styles = mysqli_fetch_assoc($styles);
$totalRows_styles = mysqli_num_rows($styles);

if (($page == "current") || ($page == "brewblog")) $blog_type = "BrewBlog"; else $blog_type = "Recipe";

$SRM = "";
if (!empty($row_log['brewLovibond'])) {
	if ($page == "logPrint" || $page == "recipePrint") $SRM .= round($row_log['brewLovibond'], 1);
	else {
		$brewLov   = $row_log['brewLovibond'];
		if ($_SESSION['measColor'] == "EBC") $brewLov = ebc_to_srm($brewLov);
		$fontColor = ($brewLov >= 15) ? "#ffffff" : "#000000";
		$bkColor   = get_display_color($brewLov);
		$SRM .= round($row_log['brewLovibond'], 1);
		$SRM .= " <span class=\"text-muted small\"><em>".$_SESSION['measColor']."</em></span>";
		$SRM .= " <span class=\"badge\" style=\"background: ". $bkColor ."; color: ".$fontColor.";\">&nbsp;&nbsp;&nbsp;";
		$SRM .= "</span>\n";

	}
}



?>

<!--
<div class="row bb-account-info">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>XXX:</strong></div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
</div>
-->

<h3><?php echo $row_log['brewStyle']; if (!empty($row_log['brewMethod'])) echo " &ndash; ".$row_log['brewMethod']; if (!empty($row_log['brewStatus'])) echo " <small><em>".$row_log['brewStatus']."</em></small>"; ?></h3>


<div class="row bb-account-info">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<?php if (!empty($row_log['brewBatchNum'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Batch #:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewBatchNum']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewYield'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Batch Size:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if ($action == "scale") echo $amt; else echo $row_log['brewYield']; echo "&nbsp;".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
        <?php if ($row_log['brewBoilTime'] != "") { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Boil Time:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewBoilTime']; ?> min</div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewCondition'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Conditioning:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewCondition']; ?></div>
        </div>
        <?php } ?>
	</div><!-- /column 1 -->

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

		<?php if (!empty($row_log['brewDate'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Brew Date:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo dateconvert($row_log['brewDate'],2);?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewTapDate'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Tap Date:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo dateconvert($row_log['brewTapDate'],2);?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewCost'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Cost:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewCost']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewSource'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Source:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewSource']; ?></div>
        </div>
        <?php } ?>

     </div><!-- /column 2 -->

</div><!-- /row -->








<h3>Statistics</h3>
<div class="row bb-account-info">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php if (!empty($row_log['brewTargetOG'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Target OG:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo number_format($row_log['brewTargetOG'], 3)." <span class=\"text-muted small\"><em>".calc_plato($row_log['brewTargetOG'])."&deg; P</em></span>"; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewOG'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>OG:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo number_format($row_log['brewOG'], 3)." <span class=\"text-muted small\"><em>".calc_plato($row_log['brewOG'])."&deg; P</em></span>"; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewGravity1'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Reading 1:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo number_format($row_log['brewGravity1'], 3)." <span class=\"text-muted small\"><em>".calc_plato($row_log['brewGravity1'])."&deg; P"; if ($row_log['brewGravity1Days'] != "" ) echo " at ".$row_log['brewGravity1Days']." days"; echo "</em></span>";  ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewGravity2'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Reading 2:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo number_format($row_log['brewGravity2'], 3)." <span class=\"text-muted small\"><em>".calc_plato($row_log['brewGravity2'])."&deg; P"; if ($row_log['brewGravity2Days'] != "" ) echo " at ".$row_log['brewGravity2Days']." days"; echo "</em></span>";  ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewTargetFG'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Target FG:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo number_format($row_log['brewTargetFG'], 3)." <span class=\"text-muted small\"><em>".calc_plato($row_log['brewTargetFG'])."&deg; P</em></span>"; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewFG'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>FG:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo number_format($row_log['brewFG'], 3)." <span class=\"text-muted small\"><em>".calc_plato($row_log['brewFG'])."&deg; P</em></span>"; ?></div>
        </div>
        <?php } ?>
        <?php if ((!empty($row_log['brewOG'])) && (!empty($row_log['brewFG']))) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Real Extract:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo calc_extract($row_log['brewOG'],$row_log['brewFG'])."&deg; P"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Attenuation:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo calc_app_atten($row_log['brewOG'],$row_log['brewFG'])."% <span class=\"text-muted small\"><em>Apparent</em></span> &ndash; ".calc_real_atten($row_log['brewOG'],$row_log['brewFG'])."% <span class=\"text-muted small\"><em>Real</em></span>"; ?></div>
        </div>
        <?php } ?>
    </div><!-- /column 1 -->



    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    	<?php if (!empty($SRM)) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Color:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $SRM; ?></div>
        </div>
        <?php } ?>
    	<?php if (!empty($row_log['brewBitterness'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>IBU:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo round(ltrim($row_log['brewBitterness'], "0"), 1); if ($row_log['brewIBUFormula'] != "") echo " <span class=\"text-muted small\"><em>" . $row_log['brewIBUFormula'] . "</em></span>"; ?></div>
        </div>
        <?php } ?>
        <?php if ((!empty($row_log['brewOG'])) && (!empty($row_log['brewBitterness']))) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>BU/GU:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo calc_bugu($row_log['brewBitterness'],$row_log['brewOG']); ?></div>
        </div>
        <?php } ?>
        <?php if ((!empty($row_log['brewOG'])) && (!empty($row_log['brewFG']))) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>ABV:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo calc_abv($row_log['brewOG'],$row_log['brewFG']); ?>%</div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>ABW:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo calc_abw($row_log['brewOG'],$row_log['brewFG']); ?>%</div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Calories:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo calc_calories($row_log['brewOG'],$row_log['brewFG'])." <span class=\"text-muted small\"><em>12 oz</em></span>"; ?></div>
        </div>
        <?php } ?>

    </div><!-- /column 2 -->

</div><!-- /row -->






















