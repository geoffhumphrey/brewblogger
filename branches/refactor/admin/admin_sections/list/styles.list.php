<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<?php if  ($row_user['userLevel'] == "1") include (ADMIN_INCLUDES.'list_add_link.inc.php'); 
if ($confirm == "true") { ?>
<table class="dataTable">
	<tr>
		<td class="error"><?php if ($msg == "1") echo $msg1; if ($msg == "2") echo $msg2; if ($msg == "3") echo $msg3; ?></td>
	</tr>
</table>
<?php } ?>
<table class="dataTable">
<tr>
	<td class="dataHeadingList">Name<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyle&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyle&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
	<td class="dataHeadingList" colspan="2">Category<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyleGroup,brewStyleNum&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyleGroup,brewStyleNum&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
    <td class="dataHeadingList">OG<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyleOG&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyleOG&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
	<td class="dataHeadingList">FG<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyleFG&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyleFG&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
	<td class="dataHeadingList">ABV<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyleABV&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyleABV&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
	<td class="dataHeadingList">Bitterness<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyleIBU&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyleIBU&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
	<td class="dataHeadingList">Color<?php if (!checkmobile()) { ?>&nbsp;<a href="index.php?action=list&dbTable=styles&sort=brewStyleSRM&dir=ASC"><img src="<?php  echo $imageSrc; ?>sort_up.gif" border="0"></a><a href="index.php?action=list&dbTable=styles&sort=brewStyleSRM&dir=DESC"><img src="<?php  echo $imageSrc; ?>sort_down.gif" border="0"></a><?php } ?></td>
	<?php if  ($row_user['userLevel'] == "1") { ?>
	<td class="dataHeadingList">&nbsp;</td>
	<td class="dataHeadingList"><?php if (!checkmobile()) { ?><div id="helpInline"><a href="includes/admin_icons.inc.php?dbTable=<?php echo $dbTable; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Administration Icon Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>information.png" align="absmiddle" border="0" alt="Admin Icon Reference" title="Administration Icon Reference"></a></div><?php } else echo "&nbsp;"; ?></td>
	<?php } ?>
</tr>
<?php do { ?>
<tr <?php echo " style=\"background-color:$color\"";?>>
	<td class="dataList"><?php echo $row_styles['brewStyle']; ?></td>
	<td class="dataList">
	<?php
						if ($row_styles['brewStyleGroup'] == "01") echo "Light Lager";
						if ($row_styles['brewStyleGroup'] == "02") echo "Pilsner";
						if ($row_styles['brewStyleGroup'] == "03") echo "European Amber Lager";
						if ($row_styles['brewStyleGroup'] == "04") echo "Dark Lager";
						if ($row_styles['brewStyleGroup'] == "05") echo "Bock";
						if ($row_styles['brewStyleGroup'] == "06") echo "Light Hybrid Beer";
						if ($row_styles['brewStyleGroup'] == "07") echo "Amber Hybrid Beer";
						if ($row_styles['brewStyleGroup'] == "08") echo "English Pale Ale";
						if ($row_styles['brewStyleGroup'] == "09") echo "Scottish and Irish Ale";
						if ($row_styles['brewStyleGroup'] == "10") echo "American Ale";
						if ($row_styles['brewStyleGroup'] == "11") echo "English Brown Ale";
						if ($row_styles['brewStyleGroup'] == "12") echo "Porter";
						if ($row_styles['brewStyleGroup'] == "13") echo "Stout";
						if ($row_styles['brewStyleGroup'] == "14") echo "India Pale Ale (IPA)";
						if ($row_styles['brewStyleGroup'] == "15") echo "German Wheat and Rye Beer";
						if ($row_styles['brewStyleGroup'] == "16") echo "Belgian and French Ale";
						if ($row_styles['brewStyleGroup'] == "17") echo "Sour Ale";
						if ($row_styles['brewStyleGroup'] == "18") echo "Belgian Strong Ale";
						if ($row_styles['brewStyleGroup'] == "19") echo "Strong Ale";
						if ($row_styles['brewStyleGroup'] == "20") echo "Fruit Beer";
						if ($row_styles['brewStyleGroup'] == "21") echo "Spice/Herb/Vegetable Beer";
						if ($row_styles['brewStyleGroup'] == "22") echo "Smoke-Flavored and Wood-Aged Beer";
						if ($row_styles['brewStyleGroup'] == "23") echo "Specialty Beer";
						if ($row_styles['brewStyleGroup'] == "24") echo "Traditional Mead";
						if ($row_styles['brewStyleGroup'] == "25") echo "Melomel (Fruit Mead)";
						if ($row_styles['brewStyleGroup'] == "26") echo "Other Mead";
						if ($row_styles['brewStyleGroup'] == "27") echo "Standard Cider and Perry";
						if ($row_styles['brewStyleGroup'] == "28") echo "Specialty Cider and Perry";
						?>
	</td>
	<td class="dataList" ><?php echo $row_styles['brewStyleGroup']; ?><?php echo $row_styles['brewStyleNum']; ?></td>
	<td class="dataList" >
  	<?php 
						  if ($row_styles['brewStyleOG'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleOG'] != "") { echo $row_styles['brewStyleOG']."-".$row_styles['brewStyleOGMax']; }
						  else { echo "&nbsp;"; }
						  ?>
    </td>
    <td class="dataList" >
	<?php 
						  if ($row_styles['brewStyleFG'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleFG'] != "") { echo $row_styles['brewStyleFG']."-".$row_styles['brewStyleFGMax']; }
						  else { echo "&nbsp;"; }
						  ?>
    </td>
    <td class="dataList" >
	<?php 
						  if ($row_styles['brewStyleABV'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleABV'] != "" ) { echo $row_styles['brewStyleABV']."-".$row_styles['brewStyleABVMax']."%"; } 
						  else { echo "&nbsp;"; }
						  ?>
    </td>
    <td class="dataList" >
	<?php 
						  if ($row_styles['brewStyleIBU'] == "")  { echo "Varies"; }
						  elseif ($row_styles['brewStyleIBU'] == "N/A") { echo "N/A"; }
						  elseif ($row_styles['brewStyleIBU'] != "") { $IBUmin = ltrim ($row_styles['brewStyleIBU'], "0"); $IBUmax = ltrim ($row_styles['brewStyleIBUMax'], "0"); echo $IBUmin."-".$IBUmax; }
						  else { echo "&nbsp;"; }
						  ?>
    </td>
    <td class="dataList" >
	<?php
						  if ($page == "reference") include (INCLUDES.'colorStyle.inc.php');
						  if ($row_styles['brewStyleSRM'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleSRM'] == "N/A") { echo "N/A"; }
						  elseif ($row_styles['brewStyleSRM'] != "") { $SRMmin = ltrim ($row_styles['brewStyleSRM'], "0"); $SRMmax = ltrim ($row_styles['brewStyleSRMMax'], "0"); echo $SRMmin."-".$SRMmax; }
						  else { echo "&nbsp;"; }
						  ?>
     </td>
	 <?php if  ($row_user['userLevel'] == "1") { ?>
	 <td class="data-icon_list"><a href="index.php?action=edit&dbTable=styles&id=<?php echo $row_styles['id']; ?>"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit <?php echo $row_styles['brewStyle']; ?>" title="Edit <?php echo $row_styles['brewStyle']; ?>"></a></td>
  	 <td class="data-icon_list"><a href="javascript:DelWithCon('index.php?action=delete&dbTable=styles','id',<?php echo $row_styles['id']; ?>,'Are you sure you want to delete this style?');"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete <?php echo $row_styles['brewStyle']; ?>" title="Delete <?php echo $row_styles['brewStyle']; ?>"></a></td>
	 <?php } ?>
</tr>
<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
<?php } while ($row_styles = mysql_fetch_assoc($styles)); ?>
</table>