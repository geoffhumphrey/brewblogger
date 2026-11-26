<?php 
$filename = LABEL_IMAGES.$row_log['brewLabelImage'];
if ((!empty($row_log['brewLabelImage'])) && (file_exists($filename))) { ?>
<div class="container-xxl">
	<div class="d-none d-md-block">
	<img src="<?php echo $base_url; ?>label_images/<?php echo h($row_log['brewLabelImage']); ?>" class="position-relative top-0 end-0 d-print-none float-end rounded border border-dark shadow-sm" style="max-height: 260px; margin: -75px 0 0 0; over">
	</div>
</div>
<?php } ?>