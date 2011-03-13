<?php 
/**
 * Module: verify.lib.php
 * Description: Part of the Recipe Calculator. The user has selected the calculated/recalculated
 *              values from the "predicted.lib.php" module for updating or importing. This
 *              module will present a page allowing the user to verify the new values compared
 *              to the old values.
 */

// $assoc will either be "import" or "update"
if ($assoc == "import") $importDB = $_POST['importDB'];
?>
<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<table class="dataTable">
  <tr>
    <td><div id="subtitleAdmin"><?php echo $page_title; ?></div></td>
  </tr>
</table>
<div class="headerContentAdmin"><?php if ($assoc != "import") echo "Recalculated"; else echo "Calculated"; if ($source == "brewing") echo "BrewBlog "; echo "Recipe"; if ($assoc == "import") echo "To Import"; ?></div>
<form id="form4" action="<?php if ($assoc == "update") echo "process"; else echo "index"; ?>.php?action=<?php if ($assoc == "update") echo "update"; else echo "importCalc"; ?>&dbTable=<?php if ($assoc == "update") echo $source; else echo $importDB; if ($assoc == "import") echo "&filter=".$loginUsername; else echo "&id=".$id; ?>" method="post" name="form4">
<table class="dataTable">
  <?php if ($row_recipeRecalc['id'] != "") { ?>
    <tr>
      <td width="10%">&nbsp;</td>
      <td width="40%" class="text_12_bold data"><?php if ($assoc == "import") echo "Original"; else echo "Present Recipe"; ?></td>
      <td width="40%" class="text_12_bold data"><?php if ($assoc == "import") echo "To Import"; else echo "Recalculated Recipe"; ?></td>
    </tr>
  <?php } ?>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Recipe Name:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo $row_recipeRecalc['brewName']; ?></td><?php } ?>
    <td class="data"><?php echo $brewName; ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Style:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo $row_recipeRecalc['brewStyle']; ?></td><?php } ?>
    <td class="data"><?php echo $brewStyle; ?></td>
  </tr>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Color:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo round($row_recipeRecalc['brewLovibond'],1)." ".$row_pref['measColor']; ?></td><?php } ?>
    <td class="data"><?php echo round($brewLovibond,1)." ".$row_pref['measColor']; ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Bitterness:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php echo round($row_recipeRecalc['brewBitterness'],1); ?></td><?php } ?>
    <td class="data">
    <table>
      <tr>
        <td><input type="radio" name="brewBitterness" value="<?php echo round($ibuD, 1); echo "-Daniels"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Daniels") echo "checked"; ?> /></td>
   	<td>&nbsp;<?php echo round($ibuD,1); ?></td>
    	<td>&nbsp;(Daniels)</td>
        <td><input type="radio" name="brewBitterness" value="<?php echo round($ibuG, 1); echo "-Garetz"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Garetz") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round($ibuG,1); ?></td>
    	<td>&nbsp;(Garetz)&nbsp;</td>
      </tr>
      <tr>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round($ibuR, 1); echo "-Rager"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Rager") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round($ibuR,1); ?></td>
    	<td>&nbsp;(Rager)</td>
    	<td><input type="radio" name="brewBitterness" value="<?php echo round($ibuT, 1); echo "-Tinseth"; ?>" <?php if ($row_user['defaultBitternessFormula'] == "Tinseth") echo "checked"; ?> /></td>
    	<td>&nbsp;<?php echo round($ibuT,1); ?></td>
    	<td>&nbsp;(Tinseth)&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Yield<?php if ($assoc != "import")  echo " (Choose)"; ?>:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import") { ?><input type="radio" name="brewYield" value ="<?php echo $row_recipeRecalc['brewYield']; ?>">&nbsp;<?php } ?><?php echo $row_recipeRecalc['brewYield']; ?></td><?php } ?>
    <td class="data"><?php if ($assoc != "import") { ?><input type="radio" name="brewYield" value ="<?php echo $brewYield; ?>" checked="checked">&nbsp;<?php } ?><?php echo $brewYield; ?></td>
  </tr> 
  <tr>
    <td class="dataLabelLeft" nowrap>OG<?php if ($assoc != "import")  echo " (Choose)"; ?>:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewOG" value ="<?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetOG'], 3); elseif ($row_recipeRecalc['brewOG'] > 0) echo number_format($row_recipeRecalc['brewOG'], 3); else echo ""; ?>" checked="checked">&nbsp;<?php } ?><?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetOG'], 3); elseif ($row_recipeRecalc['brewOG'] > 0) echo number_format($row_recipeRecalc['brewOG'], 3); else echo "None entered" ?></td><?php } ?>
    <td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewOG" value ="<?php if ($brewOG > 0) echo number_format ($brewOG, 3); ?>">&nbsp;<?php } ?><?php if ($brewOG > 0) echo number_format ($brewOG, 3); ?></td>
  </tr>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>FG<?php if ($assoc != "import")  echo " (Choose)"; ?>:</td>
      <?php if ($row_recipeRecalc['id'] != "") { ?><td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewFG" value ="<?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetFG'], 3); elseif ($row_recipeRecalc['brewFG'] > 0) echo number_format($row_recipeRecalc['brewFG'], 3); else echo ""; ?>" checked="checked">&nbsp;<?php } ?><?php if ($source == "brewing") echo number_format($row_recipeRecalc['brewTargetFG'], 3); elseif ($row_recipeRecalc['brewFG'] > 0) echo number_format($row_recipeRecalc['brewFG'], 3); else echo "None entered" ?></td><?php } ?>
    <td class="data"><?php if ($assoc != "import")  { ?><input type="radio" name="brewFG" value ="<?php echo number_format ($brewFG, 3); ?>">&nbsp;<?php } ?><?php echo number_format ($brewFG, 3); ?></td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Extracts:</td>
    <?php 
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      if ($row_recipeRecalc['brewExtract1'] != "") { 
	echo $row_recipeRecalc['brewExtract1Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract1']."<br />"; 
      } 
      if ($row_recipeRecalc['brewExtract2'] != "") { 
	echo $row_recipeRecalc['brewExtract2Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract2']."<br />"; 
      } 
      if ($row_recipeRecalc['brewExtract3'] != "") { 
	echo $row_recipeRecalc['brewExtract3Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract3']."<br />"; 
      } 
      if ($row_recipeRecalc['brewExtract4'] != "") { 
	echo $row_recipeRecalc['brewExtract4Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract4']."<br />"; 
      } 
      if ($row_recipeRecalc['brewExtract5'] != "") { 
	echo $row_recipeRecalc['brewExtract5Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewExtract5'];
      }
      echo '</td>' . "\n";
    }
    echo '<td class="data">';
      if ($brewExtract1 != "") { echo $brewExtract1Weight." ".$row_pref['measWeight2']." ".$brewExtract1."<br />"; } 
      if ($brewExtract2 != "") { echo $brewExtract2Weight." ".$row_pref['measWeight2']." ".$brewExtract2."<br />"; }  
      if ($brewExtract3 != "") { echo $brewExtract3Weight." ".$row_pref['measWeight2']." ".$brewExtract3."<br />"; }  
      if ($brewExtract4 != "") { echo $brewExtract4Weight." ".$row_pref['measWeight2']." ".$brewExtract4."<br />"; }  
      if ($brewExtract5 != "") { echo $brewExtract5Weight." ".$row_pref['measWeight2']." ".$brewExtract5; }  
    ?>
    </td>
  </tr>
  <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft" nowrap>Grains:</td>
    <?php
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      if ($row_recipeRecalc['brewGrain1'] != "") echo $row_recipeRecalc['brewGrain1Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain1']."<br>";
      if ($row_recipeRecalc['brewGrain2'] != "") echo $row_recipeRecalc['brewGrain2Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain2']."<br>";
      if ($row_recipeRecalc['brewGrain3'] != "") echo $row_recipeRecalc['brewGrain3Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain3']."<br>";
      if ($row_recipeRecalc['brewGrain4'] != "") echo $row_recipeRecalc['brewGrain4Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain4']."<br>";
      if ($row_recipeRecalc['brewGrain5'] != "") echo $row_recipeRecalc['brewGrain5Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain5']."<br>";
      if ($row_recipeRecalc['brewGrain6'] != "") echo $row_recipeRecalc['brewGrain6Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain6']."<br>";
      if ($row_recipeRecalc['brewGrain7'] != "") echo $row_recipeRecalc['brewGrain7Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain7']."<br>";
      if ($row_recipeRecalc['brewGrain8'] != "") echo $row_recipeRecalc['brewGrain8Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain8']."<br>";
      if ($row_recipeRecalc['brewGrain9'] != "") echo $row_recipeRecalc['brewGrain9Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain9']."<br>";
      if ($row_recipeRecalc['brewGrain10'] != "") echo $row_recipeRecalc['brewGrain10Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain10']."<br>";
      if ($row_recipeRecalc['brewGrain11'] != "") echo $row_recipeRecalc['brewGrain11Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain11']."<br>";
      if ($row_recipeRecalc['brewGrain12'] != "") echo $row_recipeRecalc['brewGrain12Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain12']."<br>";
      if ($row_recipeRecalc['brewGrain13'] != "") echo $row_recipeRecalc['brewGrain13Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain13']."<br>";
      if ($row_recipeRecalc['brewGrain14'] != "") echo $row_recipeRecalc['brewGrain14Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain14']."<br>";
      if ($row_recipeRecalc['brewGrain15'] != "") echo $row_recipeRecalc['brewGrain15Weight']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewGrain15'];
      echo '</td>' . "\n";
    }
    echo '<td class="data">' . "\n";
      if ($brewGrain1 != "") echo $brewGrain1Weight." ".$row_pref['measWeight2']." ".$brewGrain1."<br>"; 
      if ($brewGrain2 != "") echo $brewGrain2Weight." ".$row_pref['measWeight2']." ".$brewGrain2."<br>"; 
      if ($brewGrain3 != "") echo $brewGrain3Weight." ".$row_pref['measWeight2']." ".$brewGrain3."<br>"; 
      if ($brewGrain4 != "") echo $brewGrain4Weight." ".$row_pref['measWeight2']." ".$brewGrain4."<br>"; 
      if ($brewGrain5 != "") echo $brewGrain5Weight." ".$row_pref['measWeight2']." ".$brewGrain5."<br>"; 
      if ($brewGrain6 != "") echo $brewGrain6Weight." ".$row_pref['measWeight2']." ".$brewGrain6."<br>"; 
      if ($brewGrain7 != "") echo $brewGrain7Weight." ".$row_pref['measWeight2']." ".$brewGrain7."<br>"; 
      if ($brewGrain8 != "") echo $brewGrain8Weight." ".$row_pref['measWeight2']." ".$brewGrain8."<br>";
      if ($brewGrain9 != "") echo $brewGrain9Weight." ".$row_pref['measWeight2']." ".$brewGrain9."<br>"; 
      if ($brewGrain10 != "") echo $brewGrain10Weight." ".$row_pref['measWeight2']." ".$brewGrain10."<br>"; 
      if ($brewGrain11 != "") echo $brewGrain11Weight." ".$row_pref['measWeight2']." ".$brewGrain11."<br>"; 
      if ($brewGrain12 != "") echo $brewGrain12Weight." ".$row_pref['measWeight2']." ".$brewGrain12."<br>"; 
      if ($brewGrain13 != "") echo $brewGrain13Weight." ".$row_pref['measWeight2']." ".$brewGrain13."<br>"; 
      if ($brewGrain14 != "") echo $brewGrain14Weight." ".$row_pref['measWeight2']." ".$brewGrain14."<br>"; 
      if ($brewGrain15 != "") echo $brewGrain15Weight." ".$row_pref['measWeight2']." ".$brewGrain15;
      ?>
    </td>
  </tr>
  <tr>
    <td class="dataLabelLeft" nowrap>Adjuncts:</td>
    <?php
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      if ($row_recipeRecalc['brewAddition1'] != "") echo $row_recipeRecalc['brewAddition1Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition1']."<br>";
      if ($row_recipeRecalc['brewAddition2'] != "") echo $row_recipeRecalc['brewAddition2Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition2']."<br>";
      if ($row_recipeRecalc['brewAddition3'] != "") echo $row_recipeRecalc['brewAddition3Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition3']."<br>";
      if ($row_recipeRecalc['brewAddition4'] != "") echo $row_recipeRecalc['brewAddition4Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition4']."<br>";
      if ($row_recipeRecalc['brewAddition5'] != "") echo $row_recipeRecalc['brewAddition5Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition5']."<br>";
      if ($row_recipeRecalc['brewAddition6'] != "") echo $row_recipeRecalc['brewAddition6Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition6']."<br>";
      if ($row_recipeRecalc['brewAddition7'] != "") echo $row_recipeRecalc['brewAddition7Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition7']."<br>";
      if ($row_recipeRecalc['brewAddition8'] != "") echo $row_recipeRecalc['brewAddition8Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition8']."<br>";
      if ($row_recipeRecalc['brewAddition9'] != "") echo $row_recipeRecalc['brewAddition9Amt']." ".$row_pref['measWeight2']." ".$row_recipeRecalc['brewAddition9'];
      echo '</td>' . "\n";
    }
    echo '<td class="data">';
      if ($brewAdjunct1 != "") echo $brewAdjunct1Weight." ".$row_pref['measWeight2']." ".$brewAdjunct1."<br>"; 
      if ($brewAdjunct2 != "") echo $brewAdjunct2Weight." ".$row_pref['measWeight2']." ".$brewAdjunct2."<br>"; 
      if ($brewAdjunct3 != "") echo $brewAdjunct3Weight." ".$row_pref['measWeight2']." ".$brewAdjunct3."<br>"; 
      if ($brewAdjunct4 != "") echo $brewAdjunct4Weight." ".$row_pref['measWeight2']." ".$brewAdjunct4."<br>"; 
      if ($brewAdjunct5 != "") echo $brewAdjunct5Weight." ".$row_pref['measWeight2']." ".$brewAdjunct5."<br>"; 
      if ($brewAdjunct6 != "") echo $brewAdjunct6Weight." ".$row_pref['measWeight2']." ".$brewAdjunct6."<br>"; 
      if ($brewAdjunct7 != "") echo $brewAdjunct7Weight." ".$row_pref['measWeight2']." ".$brewAdjunct7."<br>"; 
      if ($brewAdjunct8 != "") echo $brewAdjunct8Weight." ".$row_pref['measWeight2']." ".$brewAdjunct8."<br>";
      if ($brewAdjunct9 != "") echo $brewAdjunct9Weight." ".$row_pref['measWeight2']." ".$brewAdjunct9; 
    ?>
    </td>
  </tr>
  <tr class="bknd_ultra_lt">
    <?php
    echo '<td class="dataLabelLeft" nowrap>Hops:</td>' . "\n";
    if ($row_recipeRecalc['id'] != "") {
      echo '<td class="data">';
      for ($i = 1; $i <= MAX_HOPS; $i++) {
	$key0 = "brewHops" . $i;
	if ($row_recipeRecalc[$key0]) {
	  $key1 = "brewHops" . $i . "Weight";
	  echo $row_recipeRecalc[$key1] . " " . $row_pref['measWeight1'] . " " . $row_recipeRecalc[$key0] . " ";
	  $key1 = "brewHops" . $i . "IBU";
	  echo $row_recipeRecalc[$key1] . "% @ ";
	  $key1 = "brewHops" . $i . "Time";
	  echo $row_recipeRecalc[$key1] . " min.<br />";
	}
      }
      echo '</td>' . "\n";
    }

    echo '<td class="data">';
    echo '<table>';
    for ($i = 0; $i < MAX_HOPS; $i++) {
      if ($brewHopsName[$i]) {
	echo $brewHopsWeight[$i] . " " . $row_pref['measWeight1'] . " ";
	echo $brewHopsName[$i] . " ";
	echo $brewHopsAA[$i] . "% ";
	echo $brewHopsForm[$i] . " @ ";
	echo $brewHopsTime[$i] . " min.<br />";
      }
    }
    echo '</table>' . "\n";
    echo '</td>' . "\n";
    ?>
  </tr>
</table>

<div id="hide">
<input type="hidden" name="brewBoilTime" value="<?php echo $row_recipeRecalc['brewBoilTime']; ?>"  />

<?php
if ($assoc == "import") { 
  if ($importDB == "brewing") {
    echo '<input type="hidden" name="brewTargetOG" value="' . round($brewOG, 3) . '">' . "\n";
    echo '<input type="hidden" name="brewTargetFG" value="' . round($brewFG, 3) . '">' . "\n";
  } else {
    // $importDB must be "recipes"
    echo '<input type="hidden" name="brewOG" value="' . round($brewOG, 3) . '">' . "\n";
    echo '<input type="hidden" name="brewFG" value="' . round($brewFG, 3) . '">' . "\n";
  }
}
include ('importFormVar.lib.php');
?>

<input type="hidden" name="brewBrewerID" value="<?php if ($assoc == "import") echo $filter; elseif ($row_recipeRecalc['brewBrewerID'] != "") echo $row_recipeRecalc['brewBrewerID']; else echo $_SESSION['loginUsername']; ?>">
</div>
<br /><br />

<div class="right"><a href="#" onClick="history.go(-1)"><img src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_back_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Back to Calculator" class="radiobutton" /></a>&nbsp;<input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_<?php if ($assoc == "import") echo "import"; else echo "update"; ?>_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Update with New Calculations" class="radiobutton" value="Edit"></div>

</form>
