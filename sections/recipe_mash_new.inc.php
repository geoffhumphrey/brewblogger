<?php

if ((is_array($mash)) && (!empty($mash))) {

$mash_steps_display = "";
$mash_steps_display_table = "";
$mash_step_num = 0;

if (isset($mash['MASH_STEPS'])) {
    foreach ($mash['MASH_STEPS'] as $key => $mash_step) {
        if (isset($mash_step['NAME'])) {

            $mash_step_num++;

            $mash_steps_display .= "<div class=\"row mb-2\">";
                    
            $mash_steps_display .= "<div class=\"col-3 col-md-2 col-lg-1\">";
            $mash_steps_display .= "Step ".$mash_step_num;
            $mash_steps_display .= "</div>";
            
            $mash_steps_display .= "<div class=\"col-6 col-md-4 col-lg-4\">";
            $mash_steps_display .= "<strong>".h($mash_step['NAME'])."</strong>";
            if (isset($mash_step['STEP_TIME'])) $mash_steps_display .= "<span class=\"ms-1 text-body-secondary small\">".h($mash_step['STEP_TIME'])." min";
            $mash_steps_display .= "</div>";
            
            $mash_steps_display .= "<div class=\"col-3 col-md-6 col-lg-7\">";
            if (isset($mash_step['STEP_TEMP'])) $mash_steps_display .= round($mash_step['STEP_TEMP'],0)."&deg;".$_SESSION['measTemp'];
            //if (isset($mash_step['STEP_TIME'])) $mash_steps_display .= $mash_step['STEP_TIME']." min";
            //if (isset($mash_step['STEP_TEMP'])) $mash_steps_display .= "<span class=\"ms-1 text-body-secondary small\">".round($mash_step['STEP_TEMP'],0)."&deg;".$_SESSION['measTemp']."</span>";
            $mash_steps_display .= "</div>";
            $mash_steps_display .= "</div>"; // end row




            
            $mash_steps_display_table .= "<tr>";
            $mash_steps_display_table .= "<td>".$mash_step_num."</td>";
            $mash_steps_display_table .= "<td>".h($mash_step['NAME'])."</td>";
            if (isset($mash_step['TYPE'])) $mash_steps_display_table .= "<td>".h($mash_step['TYPE'])."</td>";
            else $mash_steps_display_table .= "<td>&nbsp;</td>";
            if (isset($mash_step['STEP_TIME'])) $mash_steps_display_table .= "<td>".h($mash_step['STEP_TIME'])." minutes</td>";
            else $mash_steps_display_table .= "<td>&nbsp;</td>";
            if (isset($mash_step['STEP_TEMP'])) $mash_steps_display_table .= "<td>".round($mash_step['STEP_TEMP'],0)."&deg; ".$_SESSION['measTemp']."</td>";
            else $mash_steps_display_table .= "<td>&nbsp;</td>";
            $mash_steps_display_table .= "</tr>";
        }
        
    }
}

?>
<h3>Mash Profile <small class="ms-2 text-body-secondary fs-5 fw-normal"><em><?php echo h($mash['NAME']); ?></em></small></h3>
<?php if ((!empty($mash['GRAIN_TEMP'])) || (!empty($mash['TUN_TEMP'])) || (!empty($mash['SPARGE_TEMP'])) || (!empty($mash['PH'])) || (!empty($mash['NOTES']))) { ?>
<div class="row row-cols-2 row-cols-lg-3 g-1 pb-3">
    	<?php if (!empty($mash['GRAIN_TEMP'])) { ?>
        <div class="col">
        	<div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Ideal Grain Temp</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($mash['GRAIN_TEMP'])."&deg;".$_SESSION['measTemp']; ; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($mash['TUN_TEMP'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Ideal Tun Temp</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($mash['TUN_TEMP'])."&deg;".$_SESSION['measTemp']; ?></div>
            </div>
        </div>
        <?php } ?>
        <?php if (!empty($mash['SPARGE_TEMP'])) { ?>
        <div class="col">
        	<div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Ideal Sparge Temp</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($mash['SPARGE_TEMP'])."&deg;".$_SESSION['measTemp']; ?></div>
            </div>
        </div>
    	<?php } ?>
        <?php if (!empty($mash['PH'])) { ?>
        <div class="col">
        	<div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Ideal PH</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($mash['PH']); ?></div>
            </div>
        </div>
    	<?php } ?>
        <?php if (!empty($mash['NOTES'])) { ?>
        <div class="col">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><strong>Notes</strong></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><?php echo h($mash['NOTES']); ?></div>
            </div>
        </div>
        <?php } ?>
</div>
<?php } ?>

<?php if (!empty($mash_steps_display_table)) { ?>
<h4>Mash Steps</h4>
<div class="mb-3">
<?php echo $mash_steps_display; ?>
</div>


<!--
<table class="table table-striped">
<thead>
<tr>
	<th width="5%">#</th>
	<th>Name</th>
    <th class="hidden-xs hidden-sm">Type</th>
    <th>Time</th>
    <th>Temp.</th>
</tr>
</thead>
<tbody>
<?php // echo $mash_steps_display_table; ?>
</tbody>
</table>
-->
<?php } ?>
<?php } ?>
