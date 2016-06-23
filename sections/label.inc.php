<?php 
$filename = LABEL_IMAGES.$row_log['brewLabelImage'];
if ((!empty($row_log['brewLabelImage'])) && (file_exists($filename))) { ?>
<img src="<?php echo $base_url; ?>label_images/<?php echo $row_log['brewLabelImage']; ?>" class="img-responsive img-rounded">
<?php } ?>