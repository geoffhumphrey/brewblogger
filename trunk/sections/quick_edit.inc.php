<?php if (((isset($_SESSION["loginUsername"])) && ($row_log['brewBrewerID'] == $loginUsername)) || ((isset($_SESSION["loginUsername"])) && ($row_user['userLevel'] == "1"))) {  ?>
<script type="text/javascript" src="admin/js_includes/rounded-corners.js"></script>
<script type="text/javascript" src="admin/js_includes/form-field-tooltip.js"></script>
<script type="text/javascript" src="admin/js_includes/calendar_control.js"></script>
<link rel="stylesheet" href="admin/css/tooltip.css" media="screen" type="text/css">
<link rel="stylesheet" href="admin/css/calendar_control.css" media="screen" type="text/css">
<form action="admin/process.php?action=editPub&dbTable=<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "brewing"; if ($page == "recipeDetail") echo "recipes"; ?>&filter=<?php echo $filter; ?>&section=public&id=<?php echo $row_log['id']; ?>" method="POST" name="form1">
<div id="sidebarWrapper">
<div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>user_go.png" align="absmiddle"></span><span class="data">Admin Actions</span></div>
<div id="sidebarInnerWrapper">
<table class="dataTable">
    <tr>
        <td class="data_icon_list"><a href="admin/index.php?action=edit&dbTable=<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "brewing"; if ($page == "recipeDetail") echo "recipes"; ?>&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" alt="Edit <?php echo $row_log['brewName']; ?>" title="Edit <?php echo $row_log['brewName']; ?>" border="0" align="absmiddle"></a></td>
        <td class="data_icon_list"><a href="admin/index.php?action=reuse&dbTable=<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "brewing"; if ($page == "recipeDetail") echo "recipes"; ?>&filter=<?php echo $filter; ?>&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>page_refresh.png" alt="Reuse/Copy <?php echo $row_log['brewName']; ?>" title="Reuse/Copy <?php echo $row_log['brewName']; ?>" border="0" align="absmiddle"></a></td>
		<td class="data_icon_list"><a href="admin/index.php?action=import<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "Recipe"; ?>&dbTable=<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "recipes"; if ($page == "recipeDetail") echo "brewing"; ?>&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>page_lightning.png" alt="Import <?php echo $row_log['brewName']; ?> to <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo $row_pref['menuRecipes']; else echo $row_pref['menuBrewBlogss']; ?>" title="Import <?php echo $row_log['brewName']; ?> to <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo $row_pref['menuRecipes']; else echo $row_pref['menuBrewBlogss']; ?>" border="0" align="absmiddle"></a></td>
        <td class="data_icon_list"><a href="admin/index.php?action=calculate&source=<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "brewing"; if ($page == "recipeDetail") echo "recipes"; ?>&filter=<?php echo $filter; ?>&results=false&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>calculator.png" alt="Recalculate <?php echo $row_log['brewName']; ?>" title="Recalculate <?php echo $row_log['brewName']; ?>" border="0" align="absmiddle"></a></td>
		<td class="data_icon_list"><a href="admin/index.php?action=add&dbTable=awards&assoc=<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "brewing"; if ($page == "recipeDetail") echo "recipes"; ?>&filter=<?php echo $filter; ?>&id=<?php echo $row_log['id']; ?>"><img src="<?php echo $imageSrc; ?>medal_gold_3.png" alt="Add Awards for <?php echo $row_log['brewName']; ?>" title="Add Awards for <?php echo $row_log['brewName']; ?>" border="0" align="absmiddle"></a></td>
		<?php if (($page == "brewBlogDetail") || ($page == "brewBlogCurrent")) { ?>
        <td class="data_icon_list"><a href="sections/entry.inc.php?style=<?php echo $row_log['brewStyle']; ?>&filter=<?php if ($row_pref['mode'] == "2") echo $filter; else echo $loginUsername; ?>&id=<?php echo $row_log['id']; ?>&KeepThis=true&TB_iframe=true&height=450&width=700" class="thickbox"><img src="<?php echo $imageSrc; ?>award_star_add.png" alt="Add Awards for <?php echo $row_log['brewName']; ?>" title="Print a contest entry sheet for <?php echo $row_log['brewName']; ?>" border="0" align="absmiddle"></a></td>
		<?php } ?>
        <td class="data">&nbsp;</td>
   	</tr>
 </table>
</div>
</div>
<div id="sidebarWrapper">
<div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>page_edit.png" align="absmiddle"></span><span class="data">Quick Edit</span></div>
<div id="sidebarInnerWrapper">
<table class="dataTable quickEdit2">
   	<tr>
   		<td class="dataLabelLeft">Name:</td>
   		<td class="data" <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "colspan=\"3\""; ?>><input  name="brewName" type="text" value="<?php echo $row_log['brewName']; ?>" size="20"></td>
    	<td class="data"></td>
        <td class="data"></td>
    </tr>
    <?php if ($row_user['userLevel'] == "1") { ?>
	<tr>
		<td class="dataLabelLeft">Feat.?</td>
    	<td class="data" colspan="3">
        <input type="radio" name="brewFeatured" value="Y" id="brewFeatured_0" <?php if ($row_log['brewFeatured'] == "Y") echo "checked"; ?> />Yes&nbsp;<input type="radio" name="brewFeatured" value="No" id="brewFeatured_1"  <?php if (($row_log['brewFeatured'] == "N") || ($row_log['brewFeatured'] == "")) echo "checked"; ?> />No    	</td>
	</tr>
	<?php } ?>
   	<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { ?>
	<tr>
        <td class="dataLabelLeft">Status:</td>
		<td class="data" <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "colspan=\"3\""; ?>>
        <select name="brewStatus" id="brewStatus">
	    <option value="Primary" <?php if (!(strcmp($row_log['brewStatus'], "Primary"))) {echo "SELECTED";} ?>>Primary</option>
     		<option value="Secondary" <?php if (!(strcmp($row_log['brewStatus'], "Secondary"))) {echo "SELECTED";} ?>>Secondary</option>
     		<option value="Tertiary" <?php if (!(strcmp($row_log['brewStatus'], "Tertiary"))) {echo "SELECTED";} ?>>Tertiary</option>
     		<option value="Lagering" <?php if (!(strcmp($row_log['brewStatus'], "Lagering"))) {echo "SELECTED";} ?>>Lagering</option>
	 		<option value="Conditioning" <?php if (!(strcmp($row_log['brewStatus'], "Conditioning"))) {echo "SELECTED";} ?>>Conditioning</option>
     		<option value="On Tap" <?php if (!(strcmp($row_log['brewStatus'], "On Tap"))) {echo "SELECTED";} ?>>On Tap</option>
     		<option value="Bottled" <?php if (!(strcmp($row_log['brewStatus'], "Bottled"))) {echo "SELECTED";}  ?>>Bottled</option>
     		<option value="Planned" <?php if (!(strcmp($row_log['brewStatus'], "Planned"))) {echo "SELECTED";} ?>>Planned</option>
            <option value="" <?php if (!(strcmp($row_log['brewStatus'], ""))) {echo "SELECTED";}  ?>>Gone</option>
     	</select>        </td>
        <td class="data"></td>
        <td class="data"></td>
	</tr>
   	<tr>
   		<td class="dataLabelLeft">Batch:</td>
   		<td class="data" <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "colspan=\"3\""; ?>><input name="brewBatchNum" type="text"  value="<?php echo $row_log['brewBatchNum']; ?>" size="15"></td>
    	<td class="data"></td>
        <td class="data"></td>
    </tr>
   	<tr>
   		<td class="dataLabelLeft">Brew:</td>
   		<td class="data" <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "colspan=\"3\""; ?>><input name="brewDate" type="text" id="brewDate" value="<?php echo $row_log['brewDate']; ?>" size="15"  onfocus="showCalendarControl(this);"></td>
    	<td class="data"></td>
        <td class="data"></td>
    </tr>
   	<tr>
   		<td class="dataLabelLeft">Tap:</td>
   		<td class="data" <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "colspan=\"3\""; ?>><input name="brewTapDate" type="text" id="brewTapDate" value="<?php echo $row_log['brewTapDate']; ?>" size="15"  onfocus="showCalendarControl(this);"></td>
    	<td class="data"></td>
        <td class="data"></td>
    </tr>
    <?php }  ?>
    
    <tr>
   		<td class="dataLabelLeft">OG:</td>
   		<td class="data"><input name="brewOG" type="text" value="<?php echo $row_log['brewOG']; ?>" size="5" tooltipText="<?php echo $toolTip_gravity; ?>"></td>
	    <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { ?>
        <td class="dataLabel">Target OG:</td>
	    <td class="data"><input name="brewTargetOG" type="text" value="<?php echo $row_log['brewTargetOG']; ?>" size="5" tooltipText="<?php echo $toolTip_gravity; ?>"></td>
    	<?php } ?>
    </tr>
    <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { ?>
    <tr>
   		<td class="dataLabelLeft">Read 1:</td>
   		<td class="data"><input name="brewGravity1" type="text" id="brewGravity1" value="<?php echo $row_log['brewGravity1']; ?>" size="5" tooltipText="<?php echo $toolTip_gravity; ?>"></td>
	    <td class="dataLabel">Days:</td>
   		<td class="data"><input name="brewGravity1Days" type="text" id="brewGravity1Days" value="<?php echo $row_log['brewGravity1Days']; ?>" size="5"></td>
	</tr>
	<tr>
   		<td class="dataLabelLeft">Read 2:</td>
   		<td class="data"><input name="brewGravity2" type="text" id="brewGravity2" value="<?php echo $row_log['brewGravity2']; ?>" size="5" tooltipText="<?php echo $toolTip_gravity; ?>"></td>
	  	<td class="dataLabel">Days:</td>
   		<td class="data"><input name="brewGravity2Days" type="text" id="brewGravity2Days" value="<?php echo $row_log['brewGravity2Days']; ?>" size="5"></td>
	</tr>
    <?php } ?>
   	<tr>
   		<td class="dataLabelLeft">FG:</td>
   		<td class="data"><input name="brewFG" type="text"  value="<?php echo $row_log['brewFG']; ?>" size="5" tooltipText="<?php echo $toolTip_gravity; ?>"></td>
    	<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) { ?>
        <td class="dataLabel">Target FG:</td>
        <td class="data"><input name="brewTargetFG" type="text" value="<?php echo $row_log['brewTargetFG']; ?>" size="5" tooltipText="<?php echo $toolTip_gravity; ?>"></td>
		<?php } ?>
    </tr>
   	<tr>
   	  	<td class="dataLabelLeft">&nbsp;</td>
   	  	<td class="data" <?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail")) echo "colspan=\"3\""; ?>><input type="submit" value="Update" class="update_button"></td>
 		<td class="data"></td>
        <td class="data"></td>
    </tr>
</table>
</div>
</div>

</form>
<?php } ?>

<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('below');
tooltipObj.setPageBgColor('#ffffff');
tooltipObj.setTooltipCornerSize(6);
tooltipObj.initFormFieldTooltip();
</script>

