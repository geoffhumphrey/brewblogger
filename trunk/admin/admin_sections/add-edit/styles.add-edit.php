<div id="shadowbox">
<div id="caution"><div id="cautionIcon"><img src="<?php echo $imageSrc; ?>error.png"></div>Styles listed here reflect the official names, official categories, and general information provided by the <a href="http://www.bjcp.org" target="_blank">Beer Judge Certification Program</a>. Adding to or changing styles in your BrewBlog database will affect how data is displayed everywhere beer styles are referenced.</div>
</div>
<table class="dataTable">
<tr>
    <td class="dataLabelLeft" >Style Name:</td>
    <td class="data"><input type="text" name="brewStyle" tooltipText="<?php echo $toolTip_name; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyle']; ?>" size="70"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >Category Number:</td>
    <td class="data"><input type="text" name="brewStyleGroup" value="<?php if ($action == "edit") echo $row_log['brewStyleGroup']; ?>" size="5"></td>
</tr>
<tr>  
	<td class="dataLabelLeft" >Letter:</td>
    <td class="data"><input type="text" name="brewStyleNum" value="<?php if ($action == "edit") echo $row_log['brewStyleNum']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >OG Minimum:</td>
    <td class="data"><input type="text" name="brewStyleOG" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleOG']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >OG Maximum:</td>
    <td class="data"><input type="text" name="brewStyleOGMax" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleOGMax']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >FG Minimum:</td>
    <td class="data"><input type="text" name="brewStyleFG" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleFG']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >FG Maximum:</td>
    <td class="data"><input type="text" name="brewStyleFGMax" tooltipText="<?php echo $toolTip_gravity; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleFGMax']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >ABV Minimum:</td>
    <td class="data"><input type="text" name="brewStyleABV" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleABV']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >ABV Maximum:</td>
    <td class="data"><input type="text" name="brewStyleABVMax" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleABVMax']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >IBU Minimum:</td>
    <td class="data"><input type="text" name="brewStyleIBU" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleIBU']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >IBU Maximum:</td>
    <td class="data"><input type="text" name="brewStyleIBUMax" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleIBUMax']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >SRM Minimum:</td>
    <td class="data"><input type="text" name="brewStyleSRM" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleSRM']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >SRM Maximum:</td>
    <td class="data"><input type="text" name="brewStyleSRMMax" tooltipText="<?php echo $toolTip_decimal; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleSRMMax']; ?>" size="5"></td>
</tr>
<tr>
    <td class="dataLabelLeft" >Web Page Link:</td>
    <td class="data"><input type="text" name="brewStyleLink" tooltipText="<?php echo $toolTip_URL; ?>" value="<?php if ($action == "edit") echo $row_log['brewStyleLink']; ?>" size="70"><?php if ($action == "edit") { ?>&nbsp;<a href="<?php echo $row_log['brewStyleLink']; ?>" target="blank">View</a><?php } ?></td>
</tr>
<tr>
    <td class="dataLabelLeft" >Type:</td>
    <td class="data"><select name="brewStyleType" id="brewStyleType" class="text_area">
        <option value="Ale" <?php if ($action == "edit") { if (!(strcmp($row_log['brewStyleType'], "Ale"))) {echo "SELECTED";} } ?>>Ale</option>
        <option value="Lager" <?php if ($action == "edit") { if (!(strcmp($row_log['brewStyleType'], "Lager"))) {echo "SELECTED";} } ?>>Lager</option>
        <option value="Mixed" <?php if ($action == "edit") { if (!(strcmp($row_log['brewStyleType'], "Mixed"))) {echo "SELECTED";} } ?>>Mixed</option>
        <option value="Mead" <?php if ($action == "edit") { if (!(strcmp($row_log['brewStyleType'], "Mead"))) {echo "SELECTED";} } ?>>Mead</option>
        <option value="Cider" <?php if ($action == "edit") { if (!(strcmp($row_log['brewStyleType'], "Cider"))) {echo "SELECTED";} } ?>>Cider</option>
        <option value="N/A" <?php if ($action == "edit") { if (!(strcmp($row_log['brewStyleType'], "N/A"))) {echo "SELECTED";} } ?>>N/A</option>
        </select>
    </td>
</tr>
<tr>
    <td class="dataLabelLeft">Info:</td>
    <td class="data"><textarea name="brewStyleInfo" cols="67" rows="15"><?php if ($action == "edit") echo $row_log['brewStyleInfo']; ?></textarea></td>
</tr>
</table>
<?php include ('includes/add_edit_buttons.inc.php'); ?>