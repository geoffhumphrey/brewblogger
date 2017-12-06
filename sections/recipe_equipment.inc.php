<?php if ($row_log['brewEquipProfile'] != "") { ?>
<h3>Equipment Profile <small><em><?php echo $row_equip_profiles['equipProfileName']; ?></em></small></h3>
<div class="row bb-account-info">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php if (!empty($row_equip_profiles['equipBatchSize'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Batch Size:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($_SESSION['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipBatchSize'], "liters"); else echo $row_equip_profiles['equipBatchSize']; echo " ".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipBoilVolume'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Boil Volume:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_equip_profiles['equipBoilVolume'] !="") && ($_SESSION['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipBoilVolume'], "liters"); else echo $row_equip_profiles['equipBoilVolume']; echo " ".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipEvapRate'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Evaporation Rate:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_equip_profiles['equipEvapRate']."% per hour"; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipTypicalEfficiency'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Typical Efficiency:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_equip_profiles['equipTypicalEfficiency']."%"; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipHopUtil'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Hop Utilization:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_equip_profiles['equipHopUtil']."%"; ?></div>
        </div>
        <?php } ?>
    </div><!-- /column 2 -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <?php if (!empty($row_equip_profiles['equipMashTunVolume'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Volume:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_equip_profiles['equipMashTunVolume'] !="") && ($_SESSION['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipMashTunVolume'], "liters"); else echo $row_equip_profiles['equipMashTunVolume']; echo " ".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipMashTunWeight'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Weight:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_equip_profiles['equipMashTunWeight'] != "") && ($_SESSION['measWeight2'] == "kilograms") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo weightconvert($row_equip_profiles['equipMashTunWeight'], "kilograms"); else echo $row_equip_profiles['equipMashTunWeight']; echo " ".$_SESSION['measWeight2'];  ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipMashTunSpecificHeat'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Specific Heat:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo $row_equip_profiles['equipMashTunSpecificHeat']; ?> cal/gram per &deg;C</div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipMashTunDeadspace'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Dead Space:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_equip_profiles['equipMashTunDeadspace'] !="") && ($_SESSION['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipMashTunDeadspace'], "liters"); else echo $row_equip_profiles['equipMashTunDeadspace']; echo " ".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
        <?php if (!empty($row_equip_profiles['equipLoss'])) { ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Loss:</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($row_equip_profiles['equipLoss'] !="") && ($_SESSION['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipLoss'], "liters"); else echo $row_equip_profiles['equipLoss']; echo " ".$_SESSION['measFluid2']; ?></div>
        </div>
        <?php } ?>
    </div><!-- /column 2 -->
</div><!-- /row -->
<?php if (!empty($row_equip_profiles['equipNotes'])) { ?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6"><strong>Notes:</strong></div>
    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6"><?php echo $row_equip_profiles['equipNotes']; ?></div>
</div>
<?php } ?>
<?php } ?>














