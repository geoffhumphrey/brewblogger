<?php 
$filename = $images_dir."/label_images/".$row_log['brewLabelImage'];
if (($row_log['brewLabelImage'] != "") && (file_exists($filename))) { 
function getFileSizeW($file) 
	{
		$size = getimagesize($file);
		$type = $size['mime'];
		$width = $size[0];
		return $width; 
	}
$file = "label_images/".$row_log['brewLabelImage']; $imgW = getFileSizeW($file);
function getFileSizeH($fileH) 
	{
		$size = getimagesize($fileH);
		$type = $size['mime'];
		$height = $size[1];
		return $height; 
	}
$file = "label_images/".$row_log['brewLabelImage']; $imgH = getFileSizeH($file);
?>
<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>picture.png" align="texttop"></span><span class="data">Bottle Label</span></div>
    <div id="sidebarInnerWrapper">
		 <div align="center"><img <?php if ($imgW >= 225) echo "class=\"labelImage\""; ?> src="label_images/<?php echo $row_log['brewLabelImage']; ?>" border="0" alt="The <?php echo $row_log['brewName']; ?> Label" title="The <?php echo $row_log['brewName']; ?> Label" ></div>
	 <?php if (($imgH >= 150) || ($imgW >= 225)) { ?>
     <div class="center dataLeft"><a href="label_images/<?php echo $row_log['brewLabelImage']; ?>" class="thickbox">View Full Size</a>
     <?php // echo "<br>H: ".$imgH." W: ".$imgW; ?>
     </div>
	 <?php } ?>
 	</div>
</div>
<?php } ?>