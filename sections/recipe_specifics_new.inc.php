<div class="row row-cols-2 row-cols-lg-3 g-1 pb-4">

    <?php if (!empty($row_log['brewBatchNum'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Batch #</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($row_log['brewBatchNum']); ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($row_log['brewYield'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Batch Size</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php if ($action == "scale") echo $amt; else echo number_format($row_log['brewYield'],2); echo "&nbsp;<span class=\"text-body-secondary small\">".convert_to_abbrev($_SESSION['measFluid2'])."</span>"; ?></div>
        </div>
    </div>
    <?php } elseif (!empty($row_log['brewBatchSize'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Batch Size</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php if ($action == "scale") echo $amt; else echo number_format($row_log['brewBatchSize'],2); echo "&nbsp;<span class=\"text-body-secondary small\">".convert_to_abbrev($_SESSION['measFluid2'])."</span>"; ?></div>
        </div>
    </div>
    <?php } elseif ((!empty($row_log['brewEquipment'])) && (isset($equipment['BATCH_SIZE']))) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Batch Size</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php if ($action == "scale") echo $amt; else echo number_format($equipment['BATCH_SIZE'],2); echo "&nbsp;<span class=\"text-body-secondary small\">".convert_to_abbrev($_SESSION['measFluid2'])."</span>"; ?></div>
        </div>
    </div>   
    <?php } ?>
    
    <?php if (!empty($row_log['brewBoilTime'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Boil Time</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($row_log['brewBoilTime']); ?> <span class="text-body-secondary small">min</div>
        </div>
    </div>
    <?php } elseif ((!empty($row_log['brewEquipment'])) && (isset($equipment['BOIL_TIME']))) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Boil Time</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($equipment['BOIL_TIME']); ?> <span class="text-body-secondary small">min</div>
        </div>
    </div>   
    <?php } ?>

    <?php if ((!empty($row_log['brewStatus'])) && ($row_log['brewStatus'] != "Gone")) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Status</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($row_log['brewStatus']); ?></div>
        </div>
    </div>
    <?php } ?>


    <?php if (!empty($row_log['brewDate'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Brew Date</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo getTimeZoneDateTime($timezone, $row_log['brewDate'], "1", "1", "full", "date-no-gmt"); ?></div>
        </div>
    </div>
    <?php } ?>
    
    <?php if (!empty($row_log['brewTapDate'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Tap Date</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo getTimeZoneDateTime($timezone, $row_log['brewTapDate'], "1", "1", "full", "date-no-gmt"); ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($row_log['brewCondition'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Conditioning</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo h($row_log['brewCondition']); ?></div>
        </div>
    </div>
    <?php } ?>
        
    <?php if (!empty($row_log['brewCost'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Cost</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php if (isset($_SESSION['currency'])) echo $_SESSION['currency']; echo h($row_log['brewCost']); ?></div>
        </div>
    </div>
    <?php } ?>
        
    <?php if (!empty($row_log['brewSource'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><strong>Source</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?php echo h($row_log['brewSource']); ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($row_log['brewTargetOG'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Target OG</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo number_format($row_log['brewTargetOG'], 3)." <span class=\"text-body-secondary small\">".calc_plato($row_log['brewTargetOG'])."&deg; P</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($row_log['brewTargetFG'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Target FG</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo number_format($row_log['brewTargetFG'], 3)." <span class=\"text-body-secondary small\">".calc_plato($row_log['brewTargetFG'])."&deg; P</span>"; ?></div>
        </div>
    </div>

    <?php } ?> 

    <?php if (!empty($row_log['brewGravity1'])) { ?>
    <div class="col"> 
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Reading 1</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo number_format($row_log['brewGravity1'], 3)." <span class=\"text-body-secondary small\">".calc_plato($row_log['brewGravity1'])."&deg; P"; if ($row_log['brewGravity1Days'] != "" ) echo " at ".$row_log['brewGravity1Days']." days"; echo "</span>";  ?></div>
        </div>    
    </div>
    <?php } ?>

    <?php if (!empty($row_log['brewGravity2'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Reading 2</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo number_format($row_log['brewGravity2'], 3)." <span class=\"text-body-secondary small\">".calc_plato($row_log['brewGravity2'])."&deg; P"; if ($row_log['brewGravity2Days'] != "" ) echo " at ".$row_log['brewGravity2Days']." days"; echo "</span>";  ?></div>
        </div>     
    </div>
    <?php } ?>

    <?php if ((!empty($row_log['brewOG'])) && ((!empty($row_log['brewBitterness'])) || (!empty($row_log['brewIBU'])))) { 
            if (!empty($row_log['brewIBU'])) $ibu_bugu = $row_log['brewIBU'];
            else $ibu_bugu = $row_log['brewBitterness'];
    ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>BU/GU</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo calc_bugu($ibu_bugu,$row_log['brewOG']); ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if (!empty($row_log['brewCarbonation'])) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Carbonation</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo number_format($row_log['brewCarbonation'], 1)." <span class=\"text-body-secondary small\">vol</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    <?php if ((!empty($row_log['brewOG'])) && (!empty($row_log['brewFG']))) { ?>
    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>ABW</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo calc_abw($row_log['brewOG'],$row_log['brewFG']); ?>%</div>
        </div>
    </div>

    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Kcal</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo calc_calories($row_log['brewOG'],$row_log['brewFG'])." <span class=\"text-body-secondary small\">12 oz</span>"; ?></div>
        </div>
    </div>

    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Real Extract</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo calc_extract($row_log['brewOG'],$row_log['brewFG'])."&deg; P"; ?></div>
        </div>
    </div>

    <div class="col">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Attenuation</strong></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo calc_app_atten($row_log['brewOG'],$row_log['brewFG'])."% <span class=\"text-body-secondary small\">apparent</span> <br>".calc_real_atten($row_log['brewOG'],$row_log['brewFG'])."% <span class=\"text-body-secondary small\">real</span>"; ?></div>
        </div>
    </div>
    <?php } ?>

    

</div>
