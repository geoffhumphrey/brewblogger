<?php 
if (($sort == "brewStyleSRM") && (($row_styles['brewStyleSRM'] == "") || ($row_styles['brewStyleSRM'] == "N/A"))) echo ""; 
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
      switch ($row_styles['brewStyleGroup']) {
        case "01":
	  echo "Light Lager";
	  break;
        case "02":
	  echo "Pilsner";
  	  break;
        case "03":
	  echo "European Amber Lager";
	  break;
        case "04":
	  echo "Dark Lager";
	  break;
        case "05":
	  echo "Bock";
	  break;
        case "06":
	  echo "Light Hybrid Beer";
	  break;
        case "07":
	  echo "Amber Hybrid Beer";
	  break;
        case "08":
	  echo "English Pale Ale";
	  break;
        case "09":
	  echo "Scottish and Irish Ale";
	  break;
        case "10":
	  echo "American Ale";
	  break;
        case "11":
	  echo "English Brown Ale";
	  break;
        case "12":
	  echo "Porter";
	  break;
        case "13":
	  echo "Stout";
	  break;
        case "14":
	  echo "India Pale Ale (IPA)";
	  break;
        case "15":
	  echo "German Wheat and Rye Beer";
	  break;
        case "16":
	  echo "Belgian and French Ale";
	  break;
        case "17":
	  echo "Sour Ale";
	  break;
        case "18":
	  echo "Belgian Strong Ale";
	  break;
        case "19":
	  echo "Strong Ale";
	  break;
        case "20":
	  echo "Fruit Beer";
	  break;
        case "21":
	  echo "Spice/Herb/Vegetable Beer";
	  break;
        case "22":
	  echo "Smoke-Flavored and Wood-Aged Beer";
	  break;
        case "23":
	  echo "Specialty Beer";
	  break;
        case "24":
	  echo "Traditional Mead";
	  break;
        case "25":
	  echo "Melomel (Fruit Mead)";
	  break;
        case "26":
 	  echo "Other Mead";
	  break;
        case "27":
	  echo "Standard Cider and Perry";
	  break;
        case "28":
	  echo "Specialty Cider and Perry";
	  break;
      }
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
      if ($row_styles['brewStyleOG'] == "") {
	echo "Varies";
      } elseif ($row_styles['brewStyleOG'] != "") {
        echo $row_styles['brewStyleOG'] . " &ndash; " . $row_styles['brewStyleOGMax'];
      } else {
        echo "&nbsp;";
      }
      ?>
      </td>
      <td nowrap="nowrap" class="data">
      <?php 
      if ($row_styles['brewStyleFG'] == "") {
	echo "Varies";
      } elseif ($row_styles['brewStyleFG'] != "") {
        echo $row_styles['brewStyleFG'] . " &ndash; " . $row_styles['brewStyleFGMax'];
      } else {
        echo "&nbsp;";
      }
      ?>
      </td>
      <td nowrap="nowrap" class="data">
      <?php 
      if ($row_styles['brewStyleABV'] == "") {
	echo "Varies";
      } elseif ($row_styles['brewStyleABV'] != "" ) {
        echo $row_styles['brewStyleABV'] . " &ndash; " . $row_styles['brewStyleABVMax']."%";
      } else {
        echo "&nbsp;";
      }
      ?> 
      </td>
      <td nowrap="nowrap" class="data">
      <?php 
      if ($row_styles['brewStyleIBU'] == "") {
	echo "Varies";
      } elseif ($row_styles['brewStyleIBU'] == "N/A") {
        echo "N/A";
      } elseif ($row_styles['brewStyleIBU'] != "") {
        $IBUmin = ltrim ($row_styles['brewStyleIBU'], "0");
	$IBUmax = ltrim ($row_styles['brewStyleIBUMax'], "0");
	echo $IBUmin . " &ndash; " . $IBUmax . " IBU";
      } else {
        echo "&nbsp;";
      }
      ?>
      </td>
      <td nowrap="nowrap" class="data">
      <?php
      if (($page == "reference") || ($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail")  || 
	  ($page == "recipeList")  || ($page == "brewBlogList") || ($page == "awardsList")) {
	include (INCLUDES.'colorStyle.inc.php');
      } else {
	include ('../includes/colorStyle.inc.php');
      }
      if ($row_styles['brewStyleSRM'] == "") {
	echo "Varies";
      } elseif ($row_styles['brewStyleSRM'] == "N/A") {
	echo "N/A";
      } elseif ($row_styles['brewStyleSRM'] != "") {
	$SRMmin    = ltrim ($row_styles['brewStyleSRM'], "0");
	$SRMmax    = ltrim ($row_styles['brewStyleSRMMax'], "0");
	$fontColor = ($SRMmin > "15") ? "#ffffff" : "#000000";
	echo '<table width="80"><tr><td width="48%"><table class="colorTable"><tr><td style="color: ' . $fontColor . '; background: ' . $beercolorMin . ';">'; 
	echo $SRMmin . '/' . round(srm_to_ebc($SRMmin), 0) . '</td></tr></table></td><td width="4%">&nbsp;&ndash;&nbsp;</td><td width="48%">';
	$fontColor = ($SRMmax > "15") ? "#ffffff" : "#000000";
	echo '<table class="colorTable"><tr><td style="color: ' . $fontColor . '; background: ' . $beercolorMax . ';">'; 
	echo $SRMmax . '/' . round(srm_to_ebc($SRMmax), 0) . '</td></tr></table></td></tr></table>'; 
      } else {
	echo "&nbsp;";
      }
      ?></td>
    </tr>
  </table>

<?php if ($page == "reference") { ?>
  <table style="margin-bottom: 10px;">
    <tr>
      <td><a href="<?php echo $row_styles['brewStyleLink']; ?>" target="_blank">More Info</a> (link to Beer Judge Certification Program Style Guidelines)</td>
    </tr>
  </table>
<?php }
}
