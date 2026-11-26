<?php 
if ((is_array($equipment)) && (!empty($equipment))) { 


$meas_fluid_equipment = convert_to_abbrev($_SESSION['measFluid2']);
?>

<h3>Equipment Profile<small class="ms-2 text-body-secondary fs-5 fw-normal"><em><?php echo h($equipment['NAME']); ?></em></small></h3>
<div class="row row-cols-2 row-cols-lg-3 g-1 pb-4">
    
    <?php if (!empty($equipment['BATCH_SIZE'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Batch Size</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($_SESSION['measFluid2'] == "liters") && ($equipment['equipBrewerID'] == "brewblogger")) echo volumeconvert($equipment['BATCH_SIZE'], "liters"); else echo h($equipment['BATCH_SIZE']); echo "<span class=\"ms-1 small text-secondary\">".$meas_fluid_equipment."</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['BOIL_SIZE'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Boil Volume</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($equipment['BOIL_SIZE'] !="") && ($_SESSION['measFluid2'] == "liters") && ($equipment['equipBrewerID'] == "brewblogger")) echo volumeconvert($equipment['BOIL_SIZE'], "liters"); else echo h($equipment['BOIL_SIZE']); echo "<span class=\"ms-1 small text-secondary\">".$meas_fluid_equipment."</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['BOIL_TIME'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Boil Time</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo h($equipment['BOIL_TIME'])."<span class=\"ms-1 small text-secondary\">min</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['EVAP_RATE'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Evaporation Rate</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo h($equipment['EVAP_RATE'])."%<span class=\"ms-1 small text-secondary\">per hour</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['HOP_UTILIZATION'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Hop Utilization</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo h($equipment['HOP_UTILIZATION'])."%"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['TUN_VOLUME'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Volume</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($equipment['TUN_VOLUME'] !="") && ($_SESSION['measFluid2'] == "liters") && ($equipment['equipBrewerID'] == "brewblogger")) echo volumeconvert($equipment['TUN_VOLUME'], "liters"); else echo h($equipment['TUN_VOLUME']); echo "<span class=\"ms-1 small text-secondary\">".$meas_fluid_equipment."</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['TUN_WEIGHT'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Weight</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($equipment['TUN_WEIGHT'] != "") && ($_SESSION['measWeight2'] == "kilograms") && ($equipment['equipBrewerID'] == "brewblogger")) echo weightconvert($equipment['TUN_WEIGHT'], "kilograms"); else echo h($equipment['TUN_WEIGHT']); echo " ".$_SESSION['measWeight2'];  ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['TUN_SPECIFIC_HEAT'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Mash Tun Specific Heat</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo h($equipment['TUN_SPECIFIC_HEAT']); ?> cal/gram per &deg;C</div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['TOP_UP_WATER'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Top Up Water</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($equipment['TOP_UP_WATER'] !="") && ($_SESSION['measFluid2'] == "liters") && ($equipment['equipBrewerID'] == "brewblogger")) echo volumeconvert($equipment['TOP_UP_WATER'], "liters"); else echo h($equipment['TOP_UP_WATER']); echo "<span class=\"ms-1 small text-secondary\">".$meas_fluid_equipment."</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($equipment['TRUB_CHILLER_LOSS'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Trub Chiller Loss</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (($equipment['TRUB_CHILLER_LOSS'] !="") && ($_SESSION['measFluid2'] == "liters") && ($equipment['equipBrewerID'] == "brewblogger")) echo volumeconvert($equipment['TRUB_CHILLER_LOSS'], "liters"); else echo h($equipment['TRUB_CHILLER_LOSS']); echo "<span class=\"ms-1 small text-secondary\">".$meas_fluid_equipment."</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

</div><!-- /row -->
<?php if (!empty($equipment['NOTES'])) { ?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Notes</strong></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($equipment['NOTES']); ?></div>
</div>
<?php } ?>
<?php } ?>














