<?php if (($row_pref['waterDisplayMethod'] == "1") && ($row_log['brewWaterProfile'] != "")) { // Use water profiles tables ?>
<h3>Water Profile <small><em><?php echo $row_water_profiles['waterName']; ?></em></small></h3>

<div class="row bcoem-account-info">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Calcium:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterCalcium'])) echo $row_water_profiles['waterCalcium']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Bicarbonate:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterBicarbonate'])) echo $row_water_profiles['waterBicarbonate']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Sulfate:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterSulfate'])) echo $row_water_profiles['waterSulfate']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Chloride:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterChloride'])) echo $row_water_profiles['waterChloride']." ppm"; else echo "Not Provided"; ?></div>
        </div>
    </div><!-- /column 1 -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Sodium:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterSodium'])) echo $row_water_profiles['waterSodium']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Magnesium:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterMagnesium'])) echo $row_water_profiles['waterMagnesium']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>PH:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_water_profiles['waterPH'])) echo $row_water_profiles['waterPH']; else echo "Not Provided"; ?></div>
        </div>
    </div><!-- /column 1 -->
</div><!-- /row -->
<?php if ($row_water_profiles['waterNotes'] != "") { ?>
<div class="row bcoem-account-info">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><strong>Notes:</strong></div>
    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6"><?php echo $row_water_profiles['waterNotes']; ?></div>
</div>
<?php } ?>
<?php } ?>





<?php if ($row_pref['waterDisplayMethod'] == "2") { ?>
<?php if ($row_log['brewWaterName'] != "" ) { // (1) hide entire water rows if name not present ?>
<h3>Water Profile <small><em><?php echo $row_log['brewWaterName'];  ?></em></small></h3>
<div class="row bcoem-account-info">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Calcium:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterCalcium'])) echo $row_log['brewWaterCalcium']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Bicarbonate:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterBicarbonate'])) echo $row_log['brewWaterBicarbonate']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Sulfate:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterSulfate'])) echo $row_log['brewWaterSulfate']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Chloride:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterChloride'])) echo $row_log['brewWaterChloride']." ppm"; else echo "Not Provided"; ?></div>
        </div>
	</div><!-- /column 1 -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Sodium:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterSodium'])) echo $row_log['brewWaterSodium']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Magnesium:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterMagnesium'])) echo $row_log['brewWaterMagnesium']." ppm"; else echo "Not Provided"; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>PH:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (!empty($row_log['brewWaterPH'])) echo $row_log['brewWaterPH']; else echo "Not Provided"; ?></div>
        </div>
	</div><!-- /column 1 -->
</div><!-- /row -->
<?php if ($row_log['brewWaterNotes'] != "") { ?>
<div class="row bcoem-account-info">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><strong>Notes:</strong></div>
    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6"><?php echo $row_log['brewWaterNotes']; ?></div>
</div>
<?php } ?>
<?php } ?>
<?php } ?>