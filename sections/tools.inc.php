<?php
$imageSrc = "images/";
?>
<table>
<?php if (!checkmobile()) { ?>
  <tr>
    <td class="dataLabelLeft">Choose:</td>
    <td class="data">
     <form name="form" id="form">
     <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
       <option value="?page=tools"></option>
       <option value="?page=tools&section=bitterness" <?php if ($section == "bitterness") echo "SELECTED"; ?>>Bitterness Calculator</option>
       <option value="?page=tools&section=efficiency" <?php if ($section == "efficiency") echo "SELECTED"; ?>>Brewhouse Efficiency Calculator</option>
       <option value="?page=tools&section=calories" <?php if ($section == "calories") echo "SELECTED"; ?>>Calories, Alcohol, and Plato Calculator</option>
       <option value="?page=tools&section=force_carb" <?php if ($section == "force_carb") echo "SELECTED"; ?>>Force Carbonation Calculator</option>
       <option value="?page=tools&section=plato" <?php if ($section == "plato") echo "SELECTED"; ?>>Plato/Brix/SG Calculator</option>
       <option value="?page=tools&section=sugar" <?php if ($section == "sugar") echo "SELECTED"; ?>>Priming Sugar Calculator</option>
       <option value="?page=tools&section=strike" <?php if ($section == "strike") echo "SELECTED"; ?>>Strike Water Temperature Calculator</option>
       <option value="?page=tools&section=water" <?php if ($section == "water") echo "SELECTED"; ?>>Water Amounts Calculator</option>
       <option value="?page=tools&section=hyd" <?php if ($section == "hyd") echo "SELECTED"; ?>>Hydrometer Correction Calculator</option>
     </select>
     </form>
    </td>
 </tr>
<?php } ?>
 <tr>
  <td colspan="2">
    <?php 
    if ($section == "calories") include ('admin/tools/gravity.php'); 
    elseif ($section == "bitterness") include ('admin/tools/bitterness.php'); 
    elseif ($section == "efficiency") include ('admin/tools/efficiency.php'); 
    elseif ($section == "water") include ('admin/tools/water_amounts.php'); 
    elseif ($section == "sugar") include ('admin/tools/priming.php'); 
    elseif ($section == "force_carb") include ('admin/tools/force_carb.php'); 
    elseif ($section == "plato") include ('admin/tools/sg.php'); 
    elseif ($section == "strike") include ('admin/tools/strike.php'); 
    elseif ($section == "hyd") include ('admin/tools/hydrometer.php');
    // elseif ($section == "recipe") include ('admin/tools/recipe_calculator.php'); 
    ?>   
  </td>
 </tr>
</table>
<div class="calcNav">
<?php
  // Navigation links
  // First row
  if ($section == "bitterness")
    echo "<strong>Bitterness Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=bitterness\">Bitterness Calculator</a>";
  echo '&nbsp;|&nbsp;';
  if ($section == "efficiency")
    echo "<strong>Brewhouse Efficiency Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=efficiency\">Brewhouse Efficiency Calculator</a>";
  echo '&nbsp;|&nbsp;';
  if ($section == "calories")
    echo "<strong>Calories, Alcohol, and Plato Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=calories\">Calories, Alcohol, and Plato Calculator</a>";
  echo '&nbsp;|&nbsp;';
  if ($section == "force_carb")
    echo "<strong>Force Carbonation Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=force_carb\">Force Carbonation Calculator</a>";
  echo '<br />';

  // Second row
  if ($section == "plato")
    echo "<strong>Plato/Brix/SG Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=plato\">Plato/Brix/SG Calculator</a>";
  echo '&nbsp;|&nbsp;';
  if ($section == "sugar")
    echo "<strong>Priming Sugar Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=sugar\">Priming Sugar Calculator</a>";
  echo '&nbsp;|&nbsp;';
  if ($section == "strike")
    echo "<strong>Strike Water Temperature Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=strike\">Strike Water Temperature Calculator</a>";
  echo '&nbsp;|&nbsp;';
  if ($section == "water")
    echo "<strong>Water Amounts Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=water\">Water Amounts Calculator</a>"; 
  echo '&nbsp;|&nbsp;';
  if ($section == "hyd")
    echo "<strong>Hydrometer Correction Calculator</strong>";
  else
    echo "<a href=\"?page=tools&section=hyd\">Hydrometer Correction Calculator</a>";
?>
</div>

