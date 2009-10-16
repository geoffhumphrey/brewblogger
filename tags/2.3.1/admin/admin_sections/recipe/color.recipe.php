<div id="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=color&source=log&KeepThis=true&TB_iframe=true&height=370&width=600" title="Color Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>/information.png" border="0"></a></div>Color</div>
<table class="dataTable">
<tr>
   <td class="dataLabelLeft">Color:</td>
   <td class="data"><input type="text" name="brewLovibond" size="5" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) echo $row_log['brewLovibond']; if ($action == "importCalc") { if ($brewLovibond < 10) echo "0"; echo round ($brewLovibond, 1); } ?>">&nbsp;<?php echo $row_pref['measColor']; ?></td>
</tr>
</table>