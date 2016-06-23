<?php if ($row_log['brewPrimary'] != "") { ?>
<h3>Fermentation and Aging</h3>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"><strong>Primary:</strong></div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8"><?php echo $row_log['brewPrimary']." days @ ".$row_log['brewPrimaryTemp']."&deg ".$row_pref['measTemp']; ?></div>
</div>
<?php if ($row_log['brewSecondary'] != "" ) { ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"><strong>Secondary:</strong></div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8"><?php echo $row_log['brewSecondary']." days @ ".$row_log['brewSecondaryTemp']."&deg ".$row_pref['measTemp']; ?></div>
</div>
<?php } ?>
<?php if ($row_log['brewTertiary'] != "" ) { ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"><strong>Tertiary:</strong></div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8"><?php echo $row_log['brewTertiary']." days @ "; if ($page != "recipe") echo $row_log['brewTertiaryTemp']; else echo $row_log['brewTertiaryTemp']; echo "&deg ".$row_pref['measTemp']; ?></div>
</div>
<?php } ?>
<?php if ($row_log['brewLager'] != "" ) { ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"><strong>Lager:</strong></div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8"><?php echo $row_log['brewLager']." days @ ".$row_log['brewLagerTemp']."&deg ".$row_pref['measTemp']; ?></div>
</div>
<?php } ?>
<?php if ($row_log['brewAge'] != "" ) { ?>
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4"><strong>Age:</strong></div>
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8"><?php echo $row_log['brewAge']." days @ ".$row_log['brewAgeTemp']."&deg ".$row_pref['measTemp']; ?></div>
</div>
<?php } ?>
<?php } ?>