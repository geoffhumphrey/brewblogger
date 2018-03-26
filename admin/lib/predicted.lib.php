<?php
/**
 * Module: predicted.lib.php
 * Description: Part of the Recipe Calculator. Presents calculated values in a small box at
 *              the top right of the Calculator page. Creates a form with options allowing
 *              the user to import or update the blog or recipe with the new values.
 */
?>

<div id="calculate">
<div id="calculateInner">
<table class="dataTable">
  <tr>
    <td colspan="2" class="text_14_bold">Predicted Results</td>
    <td class="text_14_bold data">BJCP</td>
  </tr>
  <tr>
    <td colspan="3"><hr></td>
  </tr>
  <tr>
    <td class="dataLabelWide">Name:</td>
    <td class="data"><?php echo $brewName; ?></td>
    <td class=" bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide">Style:</td>
    <td class="data"><?php echo $brewStyle; ?></td>
    <td class="data bdr1L_black"><a href="<?php echo $row_style1['brewStyleLink']; ?>" target="_blank"><?php echo $row_style1['brewStyleGroup'] . $row_style1['brewStyleNum']; ?></a></td>
  </tr>
  <tr>
    <td class="dataLabelWide">Color:</td>
    <td class="data">
      <table>
        <tr>
          <td>Morey:&nbsp;</td>
	  <?php
	  $fontColor = ($srmMorey >= 15) ? "#ffffff" : "#000000";
          $bkColor   = get_display_color($srmMorey);
          ?>
          <td class="colorTable" style="text-align: center; background: <?php echo $bkColor ?>; color: <?php echo $fontColor ?>;">
            <?php echo round($srmMorey, 1) . '/' . srm_to_ebc($srmMorey); ?></td>
	  <td>&nbsp;SRM/EBC</td>
        </tr>
        <tr>
          <td>Daniels:&nbsp;</td>
	  <?php
	  $fontColor = ($srmDaniels >= 15) ? "#ffffff" : "#000000";
          $bkColor   = get_display_color($srmDaniels);
          ?>
          <td class="colorTable" style="text-align: center; background: <?php echo $bkColor ?>; color: <?php echo $fontColor ?>;">
            <?php echo round($srmDaniels, 1) . '/' . srm_to_ebc($srmDaniels); ?></td>
	  <td>&nbsp;SRM/EBC</td>
        </tr>
        <tr>
          <td>Moser:&nbsp;</td>
	  <?php
	  $fontColor = ($srmMoser >= 15) ? "#ffffff" : "#000000";
          $bkColor   = get_display_color($srmMoser);
          ?>
	  <td class="colorTable" style="text-align: center; background: <?php echo $bkColor ?>; color: <?php echo $fontColor ?>;">
            <?php echo round($srmMoser, 1) . '/' . srm_to_ebc($srmMoser); ?></td>
	  <td>&nbsp;SRM/EBC</td>
        </tr>
      </table>
      </td>
    <td class="data bdr1L_black">
      <?php
      if ($row_style1['brewStyleSRM'] == "") {
	echo "Varies";
      } elseif ($row_style1['brewStyleSRM'] == "N/A") {
	echo "N/A";
      } elseif ($row_style1['brewStyleSRM'] != "") {
	$SRMmin        = ltrim($row_style1['brewStyleSRM'], "0");
	$SRMmax        = ltrim($row_style1['brewStyleSRMMax'], "0");
	$bkColorMin    = get_display_color($SRMmin);
	$bkColorMax    = get_display_color($SRMmax);
	$fontColor     = ($SRMmin > "15") ? "#ffffff" : "#000000";
	$fontColorMax  = ($SRMmax > "15") ? "#ffffff" : "#000000";
	echo '<table><tr><td style="text-align: center; background: ' . $bkColorMin . '; color: ' . $fontColorMin . ';" class="colorTable">';
	echo $SRMmin . '/' . round(srm_to_ebc($SRMmin), 0) . '</td>';
	echo '<td width="2">&ndash;</td>';
	echo '<td style="text-align: center; background: ' . $bkColorMax . '; color: ' . $fontColorMax . ';" class="colorTable">';
	echo $SRMmax . '/' . round(srm_to_ebc($SRMmax), 0) . '</td></tr></table>';
      } else {
	echo "&nbsp;";
      }
      ?>
      </td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>Bitterness:</td>
    <td class="data" nowrap>
      <table>
        <tr>
          <td>Garetz:&nbsp;</td>
    	  <td><?php echo round($ibuG, 1); ?>&nbsp;</td>
    	  <td>IBU</td>
  	</tr>
  	<tr>
    	  <td>Rager:&nbsp;</td>
    	  <td><?php echo round($ibuR, 1); ?>&nbsp;</td>
    	  <td>IBU</td>
  	</tr>
  	<tr>
    	  <td>Tinseth:&nbsp;</td>
    	  <td><?php echo round($ibuT, 1); ?>&nbsp;</td>
    	  <td>IBU</td>
  	</tr>
  	<tr>
    	  <td>Daniels:&nbsp;</td>
    	  <td><?php echo round($ibuD, 1); ?>&nbsp;</td>
    	  <td>IBU</td>
  	</tr>
  	<tr>
   	  <td>Avg:&nbsp;</td>
    	  <td style="font-weight: bold;"><?php echo round($ibuAvg, 1); ?>&nbsp;</td>
    	  <td>IBU</td>
  	</tr>
      </table>
      </td>
    <td class="data bdr1L_black" nowrap>
      <?php
      if ($row_style1['brewStyleIBU'] == "") {
	echo "Varies";
      } elseif ($row_style1['brewStyleIBU'] == "N/A") {
	echo "N/A";
      } elseif ($row_style1['brewStyleIBU'] != "") {
	$IBUmin = ltrim ($row_style1['brewStyleIBU'], "0");
	$IBUmax = ltrim ($row_style1['brewStyleIBUMax'], "0");
	echo $IBUmin . " - " . $IBUmax . " IBU";
      } else {
	echo "&nbsp;";
      }
      ?>
      </td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>ABV:</td>
    <td class="data" nowrap><?php echo round ($abv, 1); ?>%</td>
    <td class="data bdr1L_black" nowrap>
      <?php 
      if ($row_style1['brewStyleABV'] == "") { echo "Varies"; }
      elseif ($row_style1['brewStyleABV'] != "" ) { echo $row_style1['brewStyleABV']." - ".$row_style1['brewStyleABVMax']."%"; } 
      else { echo "&nbsp;"; }
      ?>
      </td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>ABW:</td>
    <td class="data" nowrap><?php echo round ($abw, 1); ?>%</td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>OG:</td>
    <td class="data" nowrap><?php echo number_format ($og, 3); ?></td>
    <td class="data bdr1L_black" nowrap>
      <?php 
      if ($row_style1['brewStyleOG'] == "") { echo "Varies"; }
      elseif ($row_style1['brewStyleOG'] != "") { echo $row_style1['brewStyleOG']." - ".$row_style1['brewStyleOGMax']; }
      else { echo "&nbsp;"; }
      ?>
      </td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>FG:</td>
    <td class="data" nowrap><?php echo number_format ($fg, 3); ?></td>
    <td class="data bdr1L_black" nowrap>
      <?php 
      if ($row_style1['brewStyleFG'] == "") { echo "Varies"; }
      elseif ($row_style1['brewStyleFG'] != "") { echo $row_style1['brewStyleFG']." - ".$row_style1['brewStyleFGMax']; }
      else { echo "&nbsp;"; }
      ?>
      </td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>Plato (I):</td>
    <td class="data" nowrap><?php echo round ($plato_i, 1); ?></td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>Plato (F):</td>
    <td class="data" nowrap><?php echo round ($plato_f, 1); ?></td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>Real Ext:</td>
    <td class="data" nowrap><?php echo round ($real_extract, 1); ?></td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>App. Atten.:</td>
    <td class="data" nowrap><?php echo round ($aa, 1); ?></td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>Real Atten.:</td>
    <td class="data" nowrap><?php echo round ($ra, 1); ?></td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>Calories:</td>
    <td class="data" nowrap><?php echo round ($calories, 0); ?> per 12 oz.</td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
  <tr>
    <td class="dataLabelWide" nowrap>BU/GU:</td>
    <td class="data" nowrap><?php echo round ($bugu, 2); ?></td>
    <td class="bdr1L_black">&nbsp;</td>
  </tr>
</table>
<?php if (isset($_SESSION["loginUsername"])) { ?>
  <table class="dataTable">
  <tr>
    <td width="90%"><img src="<?php echo $imageSrc; ?>spacer.gif" width="1" height="30"></td>
    <td width="5%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
  </tr>
  <tr>
    <form id="form2"  action="index.php?action=calculate&results=verify&assoc=import&filter=<?php echo $filter;  if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>" method="post" name="form2">
    <td><input type="radio" name="importDB" value="brewing" checked="checked" />Import to BrewBlog<br />
    <input type="radio" name="importDB" value="recipes" />Import to Recipes<br /></td>
    <td>
    <div id="hide">
    <input type="hidden" name="brewBrewerID" value="<?php echo $loginUsername; ?>">
    <?php include (ADMIN_LIBRARY.'importFormVar.lib.php'); ?>
    <input type="hidden" name="brewOG" value="<?php echo $og; ?>">
    <input type="hidden" name="brewFG" value="<?php echo $fg; ?>">
    </div>
    <input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_import_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Import Calculation to Recipe Database" class="radiobutton" value="Import"></form> 
    </form>
    </td>
    <td>
    <?php if ($id !="default") { ?>
      <?php if (($row_recipeRecalc['brewBrewerID']) == ($loginUsername) || ($row_user['userLevel'] == "1")) { ?>
        <form id="form1" action="index.php?action=calculate&results=verify&assoc=update&filter=<?php echo $filter; if ($source != "default") echo "&source=".$source; if ($id != "default") echo "&id=".$id; ?>"  method="post" name="form1">
        <div id="hide">
        <input type="hidden" name="brewBrewerID" value="<?php if ($row_user['userName'] == $loginUsername) echo $loginUsername; else echo $row_recipeRecalc['brewBrewerID']; ?>">
        <?php include (ADMIN_LIBRARY.'importFormVar.lib.php'); ?>
        <input type="hidden" name="brewOG" value="<?php echo $og; ?>">
        <input type="hidden" name="brewFG" value="<?php echo $fg; ?>">
        </div>
        <input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_update_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update Recipe with New Calculations" class="radiobutton" value="Update"></form>
        </form>
      <?php }
    }?>
    </td>
  </tr>
  </table>
<?php } // end if (isset) ?>
</div>
</div>