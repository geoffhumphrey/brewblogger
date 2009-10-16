<div id="headerContentAdmin">Label Image</div>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft">Image Name: </td>
   <td class="data"><input name="brewLabelImage" type="text" id="brewLabelImage" size="30" tooltipText="<?php echo $toolTip_images; ?>" value="<?php if (($action == "edit") || ($action=="reuse")) echo $row_log['brewLabelImage']; ?>">&nbsp;e.g., brew1.jpg &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text_11_bold"><a href="includes/upload_image.inc.php?KeepThis=true&TB_iframe=true&height=450&width=800" title="Upload an Image" class="thickbox">Upload</a> (new window)</span> </td>
</tr>
</table>