<?php if ((isset($row_log['brewWater'])) && (!empty($row_log['brewWater']))) { ?>
<h3>Water Profile <small class="ms-2 text-body-secondary fs-5 fw-normal"><em><?php echo $water['water0']['NAME']; ?></em></small></h3>
<div class="row row-cols-2 row-cols-lg-3 g-1 pb-3">
        <?php if (!empty($water['water0']['CALCIUM'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Calcium</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo $water['water0']['CALCIUM']; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($water['water0']['BICARBONATE'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Bicarbonate</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo $water['water0']['BICARBONATE']; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($water['water0']['SULFATE'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Sulfate</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo $water['water0']['SULFATE']; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($water['water0']['CHLORIDE'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Chloride</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo $water['water0']['CHLORIDE']; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($water['water0']['MAGNESIUM'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Magnesium</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo $water['water0']['MAGNESIUM']; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($water['water0']['PH'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Ideal PH</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo $water['water0']['PH']; ?></div>
            </div>
        </div>
        <?php } ?>
</div>
<?php } ?>