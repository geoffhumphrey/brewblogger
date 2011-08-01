<?php
/**
 * Module: importFormVar.lib.php
 * Description: This module is part of the recipe calculation process. It ultimately makes form vars
 *              available to fill out a new blog or recipe if the user decides to "import" the 
 *              calculated data. When $action == "calculate", either predicted.lib.php or 
 *              verify.lib.php are hiding data which is not being used in the calculations since
 *              that data won't be part of the POST data otherwise. This data gets loaded by 
 *              admin/index.php --> add.admin.php to create a new blog or recipe form in the
 *              $action = "importCalc" section.
 */

// $action == "calculate" if we're updating an existing recipe or blog; otherwise, $action = "importCalc"

if ($action == "calculate") { ?>
  // Can't a bunch of this be deleted?...not sure.
  <input type="hidden" name="brewName" value="<?php echo strtr($brewName, $html_string); ?>">
  <input type="hidden" name="brewYeastAmt" value="<?php echo $brewYeastAmt; ?>">
  <input type="hidden" name="brewYield" value="<?php echo $brewYield; ?>">
  <input type="hidden" name="brewStyle" value="<?php echo $brewStyle; ?>">

  <input type="hidden" name="srmMorey" value="<?php echo $srmMorey; ?>">
  <input type="hidden" name="srmDaniels" value="<?php echo $srmDaniels; ?>">
  <input type="hidden" name="srmMoser" value="<?php echo $srmMoser; ?>">

  <input type="hidden" name="ibuR" value="<?php echo $ibuR; ?>">
  <input type="hidden" name="ibuG" value="<?php echo $ibuG; ?>">
  <input type="hidden" name="ibuT" value="<?php echo $ibuT; ?>">
  <input type="hidden" name="ibuD" value="<?php echo $ibuD; ?>">
  <input type="hidden" name="ibuAvg" value="<?php echo $ibuAvg; ?>">

  <?php
  for ($i = 0; $i < MAX_EXT; $i++) {
    echo '<input type="hidden" name="extName['.$i.']" value="'.$extName[$i].'">' . "\n";
    echo '<input type="hidden" name="extWeight['.$i.']" value="'.$extWeight[$i].'">' . "\n";
  }

  for ($i = 0; $i < MAX_GRAINS; $i++) {
    echo '<input type="hidden" name="grainName['.$i.']" value="'.$grainName[$i].'">' . "\n";
    echo '<input type="hidden" name="grainWeight['.$i.']" value="'.$grainWeight[$i].'">' . "\n";
  }

  for ($i = 0; $i < MAX_ADJ; $i++) {
    echo '<input type="hidden" name="adjName['.$i.']" value="'.$adjName[$i].'">' . "\n";
    echo '<input type="hidden" name="adjWeight['.$i.']" value="'.$adjWeight[$i].'">' . "\n";
  }

  for ($i = 0; $i < MAX_HOPS; $i++) {
    echo '<input type="hidden" name="hopsName['.$i.']" value="'.$hopsName[$i].'" />';
    echo '<input type="hidden" name="hopsWeight['.$i.']" value="'.$hopsWeight[$i].'" />';
    echo '<input type="hidden" name="hopsAA['.$i.']" value="'.$hopsAA[$i].'" />';
    echo '<input type="hidden" name="hopsTime['.$i.']" value="'.$hopsTime[$i].'" />';
    echo '<input type="hidden" name="hopsForm['.$i.']" value="'.$hopsForm[$i].'" />';
  }

  if ($assoc == "import") { ?>
    // What's so special about this section?
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

  $brewBrewerID   = $_POST['brewBrewerID'];
  $brewYield      = $_POST['brewYield'];
  $brewName       = $_POST['brewName'];
  $brewStyle      = $_POST['brewStyle'];
  $brewOG         = $_POST['brewOG'];
  $brewFG         = $_POST['brewFG'];
  $brewTargetOG   = $_POST['brewTargetOG'];
  $brewTargetFG   = $_POST['brewTargetFG'];

  list($brewBitterness, $brewIBUFormula) = explode("-", $_POST['brewBitterness']);
  list($brewLovibond, $brewColorFormula) = explode("-", $_POST['brewLovibond']);

  for ($i = 0; $i < MAX_EXT; $i++) {
    $extName[$i] = $_POST['extName'][$i];
    $extWeight[$i] = $_POST['extWeight'][$i];
  }

  for ($i = 0; $i < MAX_GRAINS; $i++) {
    $grainName[$i]   = $_POST['grainName'][$i];
    $grainWeight[$i] = $_POST['grainWeight'][$i];
  }

  for ($i = 0; $i < MAX_ADJ; $i++) {
    $adjName[$i]   = $_POST['adjName'][$i];
    $adjWeight[$i] = $_POST['adjWeight'][$i];
  }

  for ($i = 0; $i < MAX_HOPS; $i++) {
    $hopsName[$i]   = $_POST['hopsName'][$i];
    $hopsWeight[$i] = $_POST['hopsWeight'][$i];
    $hopsAA[$i]     = $_POST['hopsAA'][$i];
    $hopsTime[$i]   = $_POST['hopsTime'][$i];
    $hopsForm[$i]   = $_POST['hopsForm'][$i];
  }
}
?>