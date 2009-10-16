<?php
if (($dbTable == "brewing") || ($dbTable == "recipes")) $rowID = $row_log['brewBrewerID'];
else $rowID = $_SESSION['loginUsername'];
?>


<?php if (($action == "add") || ($action == "importCalc")) { ?>
<div class="right"><br><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_add_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Add" class="radiobutton" value="Add"></div>
<?php } ?>

<?php if (((($filter == $loginUsername) && ($row_user['userLevel'] == "2")) || ($row_user['userLevel'] == "1")) && ($action == "edit")) { ?>
<div class="right"><br><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_edit_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Edit" class="radiobutton" value="Edit" <?php if ($dbTable == "users") echo "onClick=\"return confirmPass()\""; ?>></div>
<?php } ?>

<?php if (($action == "import") || ($action == "importRecipe")) { ?>
<div class="right"><br><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_import_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Import" class="radiobutton" value="Import"></div>
<?php } ?>

<?php if ($dbTable == "brewing") { 
if (((($rowID == $_SESSION['loginUsername']) && ($row_user['userLevel'] == "2")) || ($row_user['userLevel'] == "1")) && ($action == "reuse")) { ?>
<div class="right"><br><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_reuse_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Reuse" class="radiobutton" value="Reuse"></div>
<?php } }

else {
if (((($rowID == $_SESSION['loginUsername']) && ($row_user['userLevel'] == "2")) || ($row_user['userLevel'] == "1")) && ($action == "reuse")) { ?>
<div class="right"><br><input type="image" src="<?php echo $imageSrc.$row_colorChoose['themeName']; ?>/button_copy_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Copy" class="radiobutton" value="Copy"></div>
<?php } } ?>