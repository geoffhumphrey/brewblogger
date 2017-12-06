<?php if (($_SESSION['mashDisplayMethod'] == "1") && ($row_log['brewMashProfile'] != "")) { // Use mash profiles DB ?>
<h3>Mash Profile <small><em><?php echo $row_mash_profiles['mashProfileName']; ?></em></small></h3>
<div class="row bb-account-info">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    	<?php if (!empty($row_mash_profiles['mashGrainTemp'])) { ?>
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Ideal Grain Temp:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_mash_profiles['mashGrainTemp']."&deg;".$_SESSION['measTemp']; ; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_mash_profiles['mashTunTemp'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Ideal Tun Temp:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_mash_profiles['mashTunTemp']."&deg;".$_SESSION['measTemp']; ; ?></div>
        </div>
        <?php } ?>

    </div><!-- /column 1 -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php if (!empty($row_mash_profiles['mashSpargeTemp'])) { ?>
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Ideal Sparge Temp:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_mash_profiles['mashSpargeTemp']."&deg;".$_SESSION['measTemp']; ?></div>
        </div>
    	<?php } ?>
        <?php if (!empty($row_mash_profiles['mashPH'])) { ?>
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Ideal PH:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_mash_profiles['mashPH']; ?></div>
        </div>
    	<?php } ?>
    </div><!-- /column 2 -->
</div><!-- /row -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><strong>Notes:</strong></div>
    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6"><?php echo $row_mash_profiles['mashNotes']; ?></div>
</div>
<?php if ($totalRows_mash_steps > 0) { ?>
<h4>Mash Steps</h4>
<table class="table table-striped">
<thead>
<tr>
	<th width="5%">#</th>
	<th>Name</th>
    <th class="hidden-xs hidden-sm">Type</th>
    <th>Time</th>
    <th>Temp.</th>
    <th width="35%">Description</th>
</tr>
</thead>
<tbody>
<?php do {  ?>
<tr>
	<td><?php echo $row_mash_steps['stepNumber']; ?></td>
    <td><?php echo $row_mash_steps['stepName']; ?></td>
    <td class="hidden-xs hidden-sm"><?php echo $row_mash_steps['stepType']; ?></td>
    <td><?php echo $row_mash_steps['stepTime']; ?> min.</td>
    <td><?php if ($_SESSION['measTemp'] == "C") { echo round(((($row_mash_steps['stepTemp'] - 32) / 9) * 5), 1); } else { echo round($row_mash_steps['stepTemp'], 1); } echo "&deg;".$_SESSION['measTemp']; ?></td>
    <td><?php echo $row_mash_steps['stepDescription']; ?></td>
</tr>
<?php } while ($row_mash_steps = mysqli_fetch_assoc($mash_steps)); ?>
</tbody>
</table>
<?php } ?>
<?php } ?>
<?php if (($_SESSION['mashDisplayMethod'] == "2") || (($_SESSION['mashDisplayMethod'] == "1")  && ($row_log['brewMashProfile'] == ""))) { // unique mash profiles for every log
if ($row_log['brewMashType'] != "" ) { // hide entire set of mash rows if first is not present ?>
<h3>Mash <small><em><?php echo $row_log['brewMashType']; ?></em></small></h3>
<div class="row bb-account-info">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    	<?php if (!empty($row_log['brewMashGrainWeight'])) { ?>
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Grain Amount:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if ($action == "scale") echo number_format(($row_log['brewMashGrainWeight'] * $scale), 2); else echo $row_log['brewMashGrainWeight']; echo "&nbsp;".$_SESSION['measWeight2']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewMashPH'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>PH:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewMashPH']; ?></div>
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) { if ($_SESSION['measFluid2'] == "liters") echo "PPK:"; else echo "PPG:"; } elseif ($row_log['brewPPG'] != "") { if ($_SESSION['measFluid2'] == "liters") echo "PPK:"; else echo "PPG:"; } else echo ""; ?></strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo round ($ppg_display, 2); else echo $row_log['brewPPG']; if ($row_log['brewEfficiency'] == "") echo ""; ?></div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo "Efficiency:"; elseif ($row_log['brewEfficiency'] != "") echo "Efficiency:"; else echo ""; ?></strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_log['brewMashGravity'] != "" ) && ($row_log['brewPreBoilAmt'] != "") && ($row_log['brewGrain1'] != "")) echo round ($efficiency, 2)."%"; else echo $row_log['brewEfficiency']; if ($row_log['brewEfficiency'] != "") echo "%"; else echo "";?></div>
        </div>
        <?php if (!empty($row_log['brewMashEquipAdjust'])) { ?>
        <div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"><strong>Equipment Adjust:</strong></div>
    		<div class="col-lg-9 col-md-9 col-sm-6 col-xs-6"><?php echo $row_log['brewMashEquipAdjust']; ?></div>
    	</div>
        <?php } ?>
    </div><!-- /column 1 -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    	<?php if (!empty($row_log['brewMashGrainTemp'])) { ?>
    	<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Grain Temp:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewMashGrainTemp']."&deg; ".$_SESSION['measTemp']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewMashSpargAmt'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Sparge Amount:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if ($action == "scale") echo number_format(($row_log['brewMashSpargAmt'] * $scale), 2); else echo $row_log['brewMashSpargAmt']; echo "&nbsp;".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewMashSpargeTemp'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Sparge Temp:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewMashSpargeTemp']."&deg; ".$_SESSION['measTemp']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_log['brewMashTunTemp'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Tun Temp:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_log['brewMashTunTemp']."&deg; ".$_SESSION['measTemp']; ?></div>
        </div>
    	<?php } ?>
    </div><!-- /column 2 -->
</div><!-- /row -->
<?php if ($row_log['brewMashStep1Name'] != "" ) { ?>
<table class="table table-striped">
	<thead>
        <tr>
            <th width="15%">Step</th>
            <th>Description</th>
            <th>Temp.</th>
            <th width="15%">Time</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $row_log['brewMashStep1Name']; ?></td>
            <td><?php echo $row_log['brewMashStep1Desc']; ?></td>
            <td><?php echo $row_log['brewMashStep1Temp']."&deg; ".$_SESSION['measTemp']; ?></td>
            <td><?php echo $row_log['brewMashStep1Time']; ?>&nbsp;min.</td>
        </tr>
        <?php if ($row_log['brewMashStep2Name'] != "" ) { ?>
        <tr>
            <td class="dataLeft"><?php echo $row_log['brewMashStep2Name']; ?></td>
            <td><?php echo $row_log['brewMashStep2Desc']; ?></td>
            <td><?php echo $row_log['brewMashStep2Temp']."&deg; ".$_SESSION['measTemp']; ?></td>
            <td><?php echo $row_log['brewMashStep2Time']; ?>&nbsp;min.</td>
        </tr>
        <?php } ?>
        <?php if ($row_log['brewMashStep3Name'] != "" ) { ?>
        <tr>
            <td class="dataLeft"><?php echo $row_log['brewMashStep3Name']; ?></td>
            <td><?php echo $row_log['brewMashStep3Desc']; ?></td>
            <td><?php echo $row_log['brewMashStep3Temp']."&deg; ".$_SESSION['measTemp']; ?></td>
            <td><?php echo $row_log['brewMashStep3Time']; ?>&nbsp;min.</td>
        </tr>
        <?php } ?>
        <?php if ($row_log['brewMashStep4Name'] != "" ) { ?>
        <tr>
            <td class="dataLeft"><?php echo $row_log['brewMashStep4Name']; ?></td>
            <td><?php echo $row_log['brewMashStep4Desc']; ?></td>
            <td><?php echo $row_log['brewMashStep4Temp']."&deg; ".$_SESSION['measTemp']; ?></td>
            <td><?php echo $row_log['brewMashStep4Time']; ?>&nbsp;min.</td>
        </tr>
        <?php } ?>
        <?php if ($row_log['brewMashStep5Name'] != "" ) { ?>
        <tr>
            <td class="dataLeft"><?php echo $row_log['brewMashStep5Name']; ?></td>
            <td><?php echo $row_log['brewMashStep5Desc']; ?></td>
            <td><?php echo $row_log['brewMashStep5Temp']."&deg; ".$_SESSION['measTemp']; ?></td>
            <td><?php echo $row_log['brewMashStep5Time']; ?>&nbsp;min.</td>
        </tr>
        <?php } ?>
     </tbody>
</table>
<?php } ?>
<?php } ?>
<?php } ?>