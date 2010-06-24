<?php if ($row_members['userPicURL'] != "") {
$img = $row_members['userPicURL'];
$file = rtrim($images_dir."/label_images/".$img, " ");

$max_width = 225;
$max_height = 450;

list($width, $height) = getimagesize($file);
if (($width >= $max_width) || ($height >= $max_height)) {
	$ratioh = $max_height/$height;
	$ratiow = $max_width/$width;
	$ratio = min($ratioh, $ratiow);
	// New dimensions
	$width = intval($ratio*$width);
	$height = intval($ratio*$height);
} 

?>

<div align="center"><img class="bdr1_dark" src="label_images/<?php echo $row_members['userPicURL']; ?>" <?php echo $imgSize; ?> border="0" title="<?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>" alt="<?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></a></div>
<?php if (($height >= 150) && ($width >= 200)) { ?><div class="center dataLeft"><p><a href="label_images/<?php echo $row_members['userPicURL']; ?>" title="<?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>" class="thickbox">View Full Size</a></p></div><?php  } ?>
<?php } ?>
