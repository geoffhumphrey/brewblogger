<?php if (($sort == "brewStyleSRM") && (($row_styles['brewStyleSRM'] == "") || ($row_styles['brewStyleSRM'] == "N/A"))) echo ""; 
elseif (($sort == "brewStyleIBU") && (($row_styles['brewStyleIBU'] == "") || ($row_styles['brewStyleIBU'] == "N/A"))) echo "";
elseif (($sort == "brewStyleOG") && ($row_styles['brewStyleOG'] == "")) echo "";
elseif (($sort == "brewStyleFG") && ($row_styles['brewStyleFG'] == "")) echo "";
elseif (($sort == "brewStyleABV") && ($row_styles['brewStyleABV'] == "")) echo "";
else { ?>
<div id="referenceHeader"><?php echo $row_styles['brewStyle']; ?> &mdash; BJCP Style Information</div>
<table>
  <tr>
  	 <td class="dataLabelLeft">Category:</td>
	 <td class="data">
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
  </tr>
  </tr>
	<td class="dataLabelLeft">Number:</td>
	<td class="data"><?php echo $row_styles['brewStyleGroup']; ?><?php echo $row_styles['brewStyleNum']; ?></td>
  </tr>
</table>
<table>
  <tr>
  	<td><?php echo $row_styles['brewStyleInfo']; ?></td>
  </tr>
</table>
<table class="dataTable">
  <tr>
  	<td class="dataHeadingLeft">OG</td>
    <td class="dataHeading">FG</td>
    <td class="dataHeading">ABV</td>
    <td class="dataHeading">Bitterness</td>
    <td class="dataHeading">Color (SRM/EBC)</td>
  </tr>
  <tr>
  	<td nowrap="nowrap" class="dataLeft">
  	<?php 
						  if ($row_styles['brewStyleOG'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleOG'] != "") { echo $row_styles['brewStyleOG']." &ndash; ".$row_styles['brewStyleOGMax']; }
						  else { echo "&nbsp;"; }
						  ?>
    </td>
    <td nowrap="nowrap" class="data">
	<?php 
						  if ($row_styles['brewStyleFG'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleFG'] != "") { echo $row_styles['brewStyleFG']." &ndash; ".$row_styles['brewStyleFGMax']; }
						  else { echo "&nbsp;"; }
						  ?>
    </td>
    <td nowrap="nowrap" class="data">
	<?php 
						  if ($row_styles['brewStyleABV'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleABV'] != "" ) { echo $row_styles['brewStyleABV']." &ndash; ".$row_styles['brewStyleABVMax']."%"; } 
						  else { echo "&nbsp;"; }
						  ?> 
    </td>
    <td nowrap="nowrap" class="data">
	<?php 
						  if ($row_styles['brewStyleIBU'] == "")  { echo "Varies"; }
						  elseif ($row_styles['brewStyleIBU'] == "N/A") { echo "N/A"; }
						  elseif ($row_styles['brewStyleIBU'] != "") { $IBUmin = ltrim ($row_styles['brewStyleIBU'], "0"); $IBUmax = ltrim ($row_styles['brewStyleIBUMax'], "0"); echo $IBUmin." &ndash; ".$IBUmax." IBU"; }
						  else { echo "&nbsp;"; }
						  ?>    </td>
    <td nowrap="nowrap" class="data">
	<?php
						  if (($page == "reference") || ($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail")  || ($page == "recipeList")  || ($page == "brewBlogList") || ($page == "awardsList")) { include ('includes/colorStyle.inc.php'); } else { include ('../includes/colorStyle.inc.php'); }
						  if ($row_styles['brewStyleSRM'] == "") { echo "Varies"; }
						  elseif ($row_styles['brewStyleSRM'] == "N/A") { echo "N/A"; }
						  elseif ($row_styles['brewStyleSRM'] != "") 
						  	{ 
						  	$SRMmin = ltrim ($row_styles['brewStyleSRM'], "0"); 
						  	$SRMmax = ltrim ($row_styles['brewStyleSRMMax'], "0"); 
						  		echo "<table width=\"80\"><tr><td width=\"48%\"><table class=\"colorTable\"><tr><td bgcolor=".$beercolorMin.">"; 
						  		if ($SRMmin > "15") echo "<font color=\"#ffffff\">"; 
								else echo "<font color=\"#000000\">"; 
								echo $SRMmin."/".round(colorconvert($SRMmin, "EBC"), 0)."</font></td></tr></table></td><td width=\"4%\">&nbsp;&ndash;&nbsp;</td><td width=\"48%\"><table class=\"colorTable\"><tr><td bgcolor=".$beercolorMax.">"; 
								if ($SRMmax > "15") echo "<font color=\"#ffffff\">"; 
								else echo "<font color=\"#000000\">"; 
								echo $SRMmax."/".round(colorconvert($SRMmax, "EBC"), 0)."</font></td></tr></table></td></tr></table>"; 
							}
						   else { echo "&nbsp;"; }
						  ?>   </td>
  </tr>
   </table>
<?php if ($page == "reference") { ?>
   <table style="margin-bottom: 10px;">
   <tr>
    <td><a href="<?php echo $row_styles['brewStyleLink']; ?>" target="_blank">More Info</a> (link to Beer Judge Certification Program Style Guidelines)</td>
   </tr>
  </table>
  <?php } ?>
<?php } ?>