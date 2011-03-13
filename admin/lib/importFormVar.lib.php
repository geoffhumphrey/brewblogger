<?php
/**
 * Module: importFormVar.lib.php
 * Description: This module is part of the recipe calculation process. It makes form vars available
 *              for processing before they're added to the recipe or blog db.
 */

if ($action == "calculate") { ?>
  <input type="hidden" name="brewName" value="<?php echo strtr($brewName, $html_string); ?>">

  <input type="hidden" name="brewYield" value="<?php echo $brewYield; ?>">
  <input type="hidden" name="brewStyle" value="<?php echo $brewStyle; ?>">
  <input type="hidden" name="brewLovibond" value="<?php if ($row_pref['measColor'] == "EBC") echo $EBC; else echo $SRM; ?>">

  <input type="hidden" name="ibuR" value="<?php echo $ibuR; ?>">
  <input type="hidden" name="ibuG" value="<?php echo $ibuG; ?>">
  <input type="hidden" name="ibuT" value="<?php echo $ibuT; ?>">
  <input type="hidden" name="ibuD" value="<?php echo $ibuD; ?>">
  <input type="hidden" name="ibuAvg" value="<?php echo $ibuAvg; ?>">

  <input type="hidden" name="brewExtract1" value="<?php echo $brewExtract1; ?>">
  <input type="hidden" name="brewExtract2" value="<?php echo $brewExtract2; ?>">
  <input type="hidden" name="brewExtract3" value="<?php echo $brewExtract3; ?>">
  <input type="hidden" name="brewExtract4" value="<?php echo $brewExtract4; ?>">
  <input type="hidden" name="brewExtract5" value="<?php echo $brewExtract5; ?>">

  <input type="hidden" name="brewExtract1Weight" value="<?php echo $brewExtract1Weight; ?>">
  <input type="hidden" name="brewExtract2Weight" value="<?php echo $brewExtract2Weight; ?>">
  <input type="hidden" name="brewExtract3Weight" value="<?php echo $brewExtract3Weight; ?>">
  <input type="hidden" name="brewExtract4Weight" value="<?php echo $brewExtract4Weight; ?>">
  <input type="hidden" name="brewExtract5Weight" value="<?php echo $brewExtract5Weight; ?>">

  <input type="hidden" name="brewGrain1" value="<?php echo $brewGrain1; ?>">
  <input type="hidden" name="brewGrain2" value="<?php echo $brewGrain2; ?>">
  <input type="hidden" name="brewGrain3" value="<?php echo $brewGrain3; ?>">
  <input type="hidden" name="brewGrain4" value="<?php echo $brewGrain4; ?>">
  <input type="hidden" name="brewGrain5" value="<?php echo $brewGrain5; ?>">
  <input type="hidden" name="brewGrain6" value="<?php echo $brewGrain6; ?>">
  <input type="hidden" name="brewGrain7" value="<?php echo $brewGrain7; ?>">
  <input type="hidden" name="brewGrain8" value="<?php echo $brewGrain8; ?>">
  <input type="hidden" name="brewGrain9" value="<?php echo $brewGrain9; ?>">
  <input type="hidden" name="brewGrain10" value="<?php echo $brewGrain10; ?>">
  <input type="hidden" name="brewGrain11" value="<?php echo $brewGrain11; ?>">
  <input type="hidden" name="brewGrain12" value="<?php echo $brewGrain12; ?>">
  <input type="hidden" name="brewGrain13" value="<?php echo $brewGrain13; ?>">
  <input type="hidden" name="brewGrain14" value="<?php echo $brewGrain14; ?>">
  <input type="hidden" name="brewGrain15" value="<?php echo $brewGrain15; ?>">

  <input type="hidden" name="brewGrain1Weight" value="<?php echo $brewGrain1Weight; ?>">
  <input type="hidden" name="brewGrain2Weight" value="<?php echo $brewGrain2Weight; ?>">
  <input type="hidden" name="brewGrain3Weight" value="<?php echo $brewGrain3Weight; ?>">
  <input type="hidden" name="brewGrain4Weight" value="<?php echo $brewGrain4Weight; ?>">
  <input type="hidden" name="brewGrain5Weight" value="<?php echo $brewGrain5Weight; ?>">
  <input type="hidden" name="brewGrain6Weight" value="<?php echo $brewGrain6Weight; ?>">
  <input type="hidden" name="brewGrain7Weight" value="<?php echo $brewGrain7Weight; ?>">
  <input type="hidden" name="brewGrain8Weight" value="<?php echo $brewGrain8Weight; ?>">
  <input type="hidden" name="brewGrain9Weight" value="<?php echo $brewGrain9Weight; ?>">
  <input type="hidden" name="brewGrain10Weight" value="<?php echo $brewGrain10Weight; ?>">
  <input type="hidden" name="brewGrain11Weight" value="<?php echo $brewGrain11Weight; ?>">
  <input type="hidden" name="brewGrain12Weight" value="<?php echo $brewGrain12Weight; ?>">
  <input type="hidden" name="brewGrain13Weight" value="<?php echo $brewGrain13Weight; ?>">
  <input type="hidden" name="brewGrain14Weight" value="<?php echo $brewGrain14Weight; ?>">
  <input type="hidden" name="brewGrain15Weight" value="<?php echo $brewGrain15Weight; ?>">

  <input type="hidden" name="brewAdjunct1" value="<?php echo $brewAdjunct1; ?>">
  <input type="hidden" name="brewAdjunct2" value="<?php echo $brewAdjunct2; ?>">
  <input type="hidden" name="brewAdjunct3" value="<?php echo $brewAdjunct3; ?>">
  <input type="hidden" name="brewAdjunct4" value="<?php echo $brewAdjunct4; ?>">
  <input type="hidden" name="brewAdjunct5" value="<?php echo $brewAdjunct5; ?>">
  <input type="hidden" name="brewAdjunct6" value="<?php echo $brewAdjunct6; ?>">
  <input type="hidden" name="brewAdjunct7" value="<?php echo $brewAdjunct7; ?>">
  <input type="hidden" name="brewAdjunct8" value="<?php echo $brewAdjunct8; ?>">
  <input type="hidden" name="brewAdjunct9" value="<?php echo $brewAdjunct9; ?>">

  <input type="hidden" name="brewAdjunct1Weight" value="<?php echo $brewAdjunct1Weight; ?>">
  <input type="hidden" name="brewAdjunct2Weight" value="<?php echo $brewAdjunct2Weight; ?>">
  <input type="hidden" name="brewAdjunct3Weight" value="<?php echo $brewAdjunct3Weight; ?>">
  <input type="hidden" name="brewAdjunct4Weight" value="<?php echo $brewAdjunct4Weight; ?>">
  <input type="hidden" name="brewAdjunct5Weight" value="<?php echo $brewAdjunct5Weight; ?>">
  <input type="hidden" name="brewAdjunct6Weight" value="<?php echo $brewAdjunct6Weight; ?>">
  <input type="hidden" name="brewAdjunct7Weight" value="<?php echo $brewAdjunct7Weight; ?>">
  <input type="hidden" name="brewAdjunct8Weight" value="<?php echo $brewAdjunct8Weight; ?>">
  <input type="hidden" name="brewAdjunct9Weight" value="<?php echo $brewAdjunct9Weight; ?>">

  <?php
  for ($i = 0; $i < MAX_HOPS; $i++) {
    echo '<input type="hidden" name="brewHopsName['.$i.']" value="'.$brewHopsName[$i].'" />';
    echo '<input type="hidden" name="brewHopsWeight['.$i.']" value="'.$brewHopsWeight[$i].'" />';
    echo '<input type="hidden" name="brewHopsAA['.$i.']" value="'.$brewHopsAA[$i].'" />';
    echo '<input type="hidden" name="brewHopsTime['.$i.']" value="'.$brewHopsTime[$i].'" />';
    echo '<input type="hidden" name="brewHopsForm['.$i.']" value="'.$brewHopsForm[$i].'" />';
  }
  ?>

  <?php if ($assoc == "import") { ?>
    <input type="hidden" name="brewMisc1Name" value="<?php echo $row_recipeRecalc['brewMisc1Name']; ?>" />
    <input type="hidden" name="brewMisc1Time" value="<?php echo $row_recipeRecalc['brewMisc1Time']; ?>" />
    <input type="hidden" name="brewMisc1Amount" value="<?php echo $row_recipeRecalc['brewMisc1Amount']; ?>" />
    <input type="hidden" name="brewMisc2Name" value="<?php echo $row_recipeRecalc['brewMisc2Name']; ?>" />
    <input type="hidden" name="brewMisc2Time" value="<?php echo $row_recipeRecalc['brewMisc2Time']; ?>" />
    <input type="hidden" name="brewMisc2Amount" value="<?php echo $row_recipeRecalc['brewMisc2Amount']; ?>" />
    <input type="hidden" name="brewMisc3Name" value="<?php echo $row_recipeRecalc['brewMisc3Name']; ?>" />
    <input type="hidden" name="brewMisc3Time" value="<?php echo $row_recipeRecalc['brewMisc3Time']; ?>" />
    <input type="hidden" name="brewMisc3Amount" value="<?php echo $row_recipeRecalc['brewMisc3Amount']; ?>" />
    <input type="hidden" name="brewMisc4Name" value="<?php echo $row_recipeRecalc['brewMisc4Name']; ?>" />
    <input type="hidden" name="brewMisc4Time" value="<?php echo $row_recipeRecalc['brewMisc4Time']; ?>" />
    <input type="hidden" name="brewMisc4Amount" value="<?php echo $row_recipeRecalc['brewMisc4Amount']; ?>" />
  <?php } ?>

<?php
} else {
  // This code runs when we import to a recipe or blog from the calculator.
  $brewExtract1 = $_POST['brewExtract1'];
  $brewExtract2 = $_POST['brewExtract2'];
  $brewExtract3 = $_POST['brewExtract3'];
  $brewExtract4 = $_POST['brewExtract4'];
  $brewExtract5 = $_POST['brewExtract5'];

  $brewExtract1Weight = $_POST['brewExtract1Weight'];
  $brewExtract2Weight = $_POST['brewExtract2Weight'];
  $brewExtract3Weight = $_POST['brewExtract3Weight'];
  $brewExtract4Weight = $_POST['brewExtract4Weight'];
  $brewExtract5Weight = $_POST['brewExtract5Weight'];

  $brewGrain1 = $_POST['brewGrain1'];
  $brewGrain2 = $_POST['brewGrain2'];
  $brewGrain3 = $_POST['brewGrain3'];
  $brewGrain4 = $_POST['brewGrain4'];
  $brewGrain5 = $_POST['brewGrain5'];
  $brewGrain6 = $_POST['brewGrain6'];
  $brewGrain7 = $_POST['brewGrain7'];
  $brewGrain8 = $_POST['brewGrain8'];
  $brewGrain9 = $_POST['brewGrain9'];
  $brewGrain10 = $_POST['brewGrain10'];
  $brewGrain11 = $_POST['brewGrain11'];
  $brewGrain12 = $_POST['brewGrain12'];
  $brewGrain13 = $_POST['brewGrain13'];
  $brewGrain14 = $_POST['brewGrain14'];
  $brewGrain15 = $_POST['brewGrain15'];

  $brewGrain1Weight = $_POST['brewGrain1Weight'];
  $brewGrain2Weight = $_POST['brewGrain2Weight'];
  $brewGrain3Weight = $_POST['brewGrain3Weight'];
  $brewGrain4Weight = $_POST['brewGrain4Weight'];
  $brewGrain5Weight = $_POST['brewGrain5Weight'];
  $brewGrain6Weight = $_POST['brewGrain6Weight'];
  $brewGrain7Weight = $_POST['brewGrain7Weight'];
  $brewGrain8Weight = $_POST['brewGrain8Weight'];
  $brewGrain9Weight = $_POST['brewGrain9Weight'];
  $brewGrain10Weight = $_POST['brewGrain10Weight'];
  $brewGrain11Weight = $_POST['brewGrain11Weight'];
  $brewGrain12Weight = $_POST['brewGrain12Weight'];
  $brewGrain13Weight = $_POST['brewGrain13Weight'];
  $brewGrain14Weight = $_POST['brewGrain14Weight'];
  $brewGrain15Weight = $_POST['brewGrain15Weight'];

  $brewAdjunct1 = $_POST['brewAdjunct1'];
  $brewAdjunct2 = $_POST['brewAdjunct2'];
  $brewAdjunct3 = $_POST['brewAdjunct3'];
  $brewAdjunct4 = $_POST['brewAdjunct4'];
  $brewAdjunct5 = $_POST['brewAdjunct5'];
  $brewAdjunct6 = $_POST['brewAdjunct6'];
  $brewAdjunct7 = $_POST['brewAdjunct7'];
  $brewAdjunct8 = $_POST['brewAdjunct8'];
  $brewAdjunct9 = $_POST['brewAdjunct9'];

  $brewAdjunct1Amt = $_POST['brewAdjunct1Weight'];
  $brewAdjunct2Amt = $_POST['brewAdjunct2Weight'];
  $brewAdjunct3Amt = $_POST['brewAdjunct3Weight'];
  $brewAdjunct4Amt = $_POST['brewAdjunct4Weight'];
  $brewAdjunct5Amt = $_POST['brewAdjunct5Weight'];
  $brewAdjunct6Amt = $_POST['brewAdjunct6Weight'];
  $brewAdjunct7Amt = $_POST['brewAdjunct7Weight'];
  $brewAdjunct8Amt = $_POST['brewAdjunct8Weight'];
  $brewAdjunct9Amt = $_POST['brewAdjunct9Weight'];

  for ($i = 0; $i < MAX_HOPS; $i++) {
    $brewHopsName[$i]   = $_POST['brewHopsName'][$i];
    $brewHopsWeight[$i] = $_POST['brewHopsWeight'][$i];
    $brewHopsAA[$i]     = $_POST['brewHopsAA'][$i];
    $brewHopsTime[$i]   = $_POST['brewHopsTime'][$i];
    $brewHopsForm[$i]   = $_POST['brewHopsForm'][$i];
  }

  $brewBrewerID   = $_POST['brewBrewerID'];
  $brewYield      = $_POST['brewYield'];
  $brewName       = $_POST['brewName'];
  $brewStyle      = $_POST['brewStyle'];
  $brewLovibond   = $_POST['brewLovibond'];
  $brewBitterness = explode("-", $_POST['brewBitterness']);
  $brewOG         = $_POST['brewOG'];
  $brewFG         = $_POST['brewFG'];
  $brewTargetOG   = $_POST['brewTargetOG'];
  $brewTargetFG   = $_POST['brewTargetFG'];
}
?>