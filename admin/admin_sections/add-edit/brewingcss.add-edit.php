<div id="shadowbox" style="margin-top: -25px; margin-right: 100px;">
<div id="caution"><div id="help"><img src="<?php echo $imageSrc; ?>error.png" align="left"></div><strong>This function will only add or edit the information in the database!</strong>  For the theme to display correctly, you will need to add the .css file to your BrewBlog's [root]/css/ folder via an FTP program.</div>
</div>
<table class="dataTable">
<tr>
     <td class="dataLabelLeft">Theme Name:</td>
     <td class="data"><input type="text" name="themeName" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['themeName']; ?>" size="20"></td>
</tr>
<tr>
      <td class="dataLabelLeft">File Name:</td>
      <td class="data"><input type="text" name="theme" tooltipText="<?php echo $toolTip_filename; ?>" value="<?php if ($action == "edit") echo $row_log['theme']; ?>" size="20">&nbsp;</td>
</tr>
<tr>
      <td class="dataLabelLeft">Row Color 1:</td>
      <td class="data"><input type="text" name="themeColor1" value="<?php if ($action == "edit") echo $row_log['themeColor1']; ?>" size="10">&nbsp;Use a single hex value</td>
</tr>
<tr>
      <td class="dataLabelLeft">Row Color 2:</td>
      <td class="data"><input type="text" name="themeColor2" value="<?php if ($action == "edit") echo $row_log['themeColor2']; ?>" size="10">&nbsp;Use a single hex value</td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>