<?php if ($row_members['userPicURL'] != "") {
function getFileSizeW($file) 
	{
		$size = getimagesize($file);
		$type = $size['mime'];
		$width = $size[0];
		return $width; 
	}
$file = "label_images/".$row_members['userPicURL']; $imgW = getFileSizeW($file);
function getFileSizeH($fileH) 
	{
		$size = getimagesize($fileH);
		$type = $size['mime'];
		$height = $size[1];
		return $height; 
	}
$file = "label_images/".$row_members['userPicURL']; $imgH = getFileSizeH($file);

if (($imgH >= 150) && ($imgW >= 200)) $imgSize = "height=\"225\"";
if (($imgH < 150) && ($imgW < 225)) $imgSize = "width=\"".$imgW."\"";
?>

<div align="center"><img class="bdr1_dark" src="label_images/<?php echo $row_members['userPicURL']; ?>" <?php echo $imgSize; ?> border="0" title="<?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>" alt="<?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>"></a></div>
<?php if (($imgH >= 150) && ($imgW >= 200)) { ?><div class="center dataLeft"><a href="label_images/<?php echo $row_members['userPicURL']; ?>" title="<?php echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName']; ?>" class="thickbox">View Full Size</a></div><?php } ?>
<?php } ?>
