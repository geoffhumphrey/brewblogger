<?php 
/**
 * Moudule: bb_recipe.admin.php
 * Description: 
 */

include (ADMIN_INCLUDES.'add_edit_buttons.inc.php');
if (($dbTable == "brewing") || ($dbTable == "recipes")) { ?>
  <table class="dataTable">
    <tr>
    <td class="dataListLeft">Be sure to add your <a href="index.php?action=add&dbTable=extract">extracts</a>, <a href="index.php?action=add&dbTable=malt">grains</a>, <a href="index.php?action=add&dbTable=adjuncts">adjuncts</a>, <a href="index.php?action=add&dbTable=misc">miscellaneous ingredients</a>, <a href="index.php?action=add&dbTable=hops">hops</a>, <a href="index.php?action=add&dbTable=mash_profiles">mash profiles</a>, <a href="index.php?action=add&dbTable=water_profiles">water profiles</a>, and <a href="index.php?action=add&dbTable=yeast_profiles">yeast profiles</a> <em>before</em> starting your work.</td>
    </tr>
  </table>

  <?php 
  if (($row_pref['mode'] == "1") || (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2"))) {
    echo '<input type="hidden" name="brewBrewerID" value="';
    if (($action == "add") || ($action == "importCalc") || ($action == "import") || (($action == "edit") && ($row_log['brewBrewerID'] == ""))) {
      echo $_SESSION['loginUsername'];
    } else {
      echo $row_log['brewBrewerID'];
    }
    echo '">' . "\n";
  } else {
    echo '<table class="dataTable">' . "\n";
    echo '<tr>' . "\n";
    echo '<td class="dataLabelLeft">Brewer ID:</td>' . "\n";
    echo '<td class="data"><select name="brewBrewerID">' . "\n";
    echo '<option value=""></option>' . "\n";
    do {
      echo '<option value="' . $row_users['user_name'] . '" ';
      if (($action == "add") && ($row_users['user_name'] == $loginUsername)) {
	echo "SELECTED";
      }
      if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {
	if ($row_users['user_name'] == $row_log['brewBrewerID']) {
	  echo "SELECTED"; 
	}
      }
      if ($action == "importCalc") {
	if ($row_users['user_name'] ==  $filter) {
	  echo "SELECTED";
	}
      }
      echo '>' . $row_users['realFirstName'] . ' ' . $row_users['realLastName'] . '</option>' . "\n";
    } while ($row_users = mysql_fetch_array($users));

    $rows = mysql_num_rows($users);
    if ($rows > 0) {
      mysql_data_seek($users, 0);
      $row_users = mysql_fetch_assoc($users);
    }
    echo '</select></td>' . "\n";
    echo '</tr>' . "\n";
    echo '</table>' . "\n";
  } 

  include('recipe/general.recipe.php');
  include('recipe/extracts.recipe.php');
  include('recipe/grains.recipe.php');
  include('recipe/adjuncts.recipe.php');
  include('recipe/misc.recipe.php');
  include('recipe/hops.recipe.php');
  include('recipe/bitterness.recipe.php'); 
  include('recipe/color.recipe.php');
  if ($dbTable != "recipes") {
    include('recipe/water.recipe.php');
    include('recipe/equipment.recipe.php');
    include('recipe/mash.recipe.php');
  }
  include('recipe/boil.recipe.php');
  include('recipe/yeast.recipe.php'); 
  include('recipe/gravity.recipe.php'); 
  include('recipe/procedure.recipe.php'); 
  include('recipe/fermenting.recipe.php'); 
  if ($dbTable != "recipes") {
    include('recipe/label_image.recipe.php');
  }
  include('recipe/related.recipe.php'); 
}

include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); 
?>