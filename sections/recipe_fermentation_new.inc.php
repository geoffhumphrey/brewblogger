<?php if ($fermentation_aging) { ?>

<h3>Fermentation and Aging</h3>
<div class="mb-3">
	<?php if (!empty($primary)) { ?>
	<div class="row mb-2">
		<div class="col-3 col-md-2 col-lg-1"><?php echo h($primary['PRIMARY_AGE'])." days"; ?></div>
		<div class="col-6 col-md-4 col-lg-4"><strong>Primary</strong></div>
		<div class="col-3 col-md-6 col-lg-7"><?php echo h($primary['PRIMARY_TEMP'])."&deg".$_SESSION['measTemp'];; ?></div>
	</div>
	<?php } ?>

	<?php if (!empty($secondary)) { ?>
	<div class="row mb-2">
		<div class="col-3 col-md-2 col-lg-1"><?php echo h($secondary['SECONDARY_AGE'])." days"; ?></div>
		<div class="col-6 col-md-4 col-lg-4"><strong>Secondary</strong></div>
		<div class="col-3 col-md-6 col-lg-7"><?php echo h($secondary['SECONDARY_TEMP'])."&deg".$_SESSION['measTemp']; ?></div>
	</div>
	<?php } ?>

	<?php if (!empty($tertiary)) { ?>
	<div class="row mb-2">
		<div class="col-3 col-md-2 col-lg-1"><?php echo h($tertiary['TERTIARY_AGE'])." days"; ?></div>
		<div class="col-6 col-md-4 col-lg-4"><strong>Tertiary</strong></div>
		<div class="col-3 col-md-6 col-lg-7"><?php echo h($tertiary['TERTIARY_TEMP'])."&deg".$_SESSION['measTemp']; ?></div>
	</div>
	<?php } ?>

	<?php if (!empty($age)) { ?>
	<div class="row mb-2">
		<div class="col-3 col-md-2 col-lg-1"><?php echo h($age['AGE'])." days"; ?></div>
		<div class="col-6 col-md-4 col-lg-4"><strong>Age</strong></div>
		<div class="col-3 col-md-6 col-lg-7"><?php echo h($age['AGE_TEMP'])."&deg".$_SESSION['measTemp']; ?></div>
	</div>
	<?php } ?>
</div>
<?php } // end if ($fermentation_aging) ?>
