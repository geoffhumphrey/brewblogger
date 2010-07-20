<?php 
require_once('../../Connections/config.php');
include ('../../includes/check_mobile.inc.php');
include ('../../includes/url_variables.inc.php');
include ('../../includes/db_connect_universal.inc.php');
if ($action != "default") include ('../../includes/db_connect_log.inc.php');
include ('../../includes/abv.inc.php');
include ('../../includes/color.inc.php');
include ('../../includes/plug-ins.inc.php');
$page = "calculate";
$imageSrc = "../../images/";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (($row_pref['mode'] == "1") && ($row_name['brewerFirstName'] != "")) echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLastName']."'s"; echo "BrewBlog &gt;  Calculators"; if ($row_pref['mode'] == "2")  echo $row_name['brewerFirstName']."&nbsp;".$row_name['brewerLogName']." &gt;  Calculators"; ?></title>
<link href="../../css/html_elements.css" rel="stylesheet" type="text/css">
<link href="../../css/universal_elements.css" rel="stylesheet" type="text/css">
<link href="../../css/reference.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../js_includes/jump_menu.js"></script>
</head>
<body>
<div id="wideWrapperReference">
<?php if ($section != "default") { ?>
<table class="dataTable">
 <tr>
   <td class="dataLabelLeft">Other <?php echo $row_pref['menuCalculators']; ?>:</td>
   <td class="data">
   <form name="form" id="form">
  	 <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('self',this,0)">
    	<option value="?section=bitterness" <?php if ($section == "bitterness") echo "SELECTED"; ?>>Bitterness Calculator</option>
    	<option value="?section=efficiency" <?php if ($section == "efficiency") echo "SELECTED"; ?>>Brewhouse Efficiency Calculator</option>
    	<option value="?section=calories" <?php if ($section == "calories") echo "SELECTED"; ?>>Calories, Alcohol, and Plato Calculator</option>
    	<option value="?section=force_carb" <?php if ($section == "force_carb") echo "SELECTED"; ?>>Force Carbonation Calculator</option>
    	<option value="?section=plato" <?php if ($section == "plato") echo "SELECTED"; ?>>Plato/Brix/SG Calculator</option>
    	<option value="?section=sugar" <?php if ($section == "sugar") echo "SELECTED"; ?>>Priming Sugar Calculator</option>
    	<option value="?section=strike" <?php if ($section == "strike") echo "SELECTED"; ?>>Strike Water Temperature Calculator</option>
    	<option value="?section=water" <?php if ($section == "water") echo "SELECTED"; ?>>Water Amounts Calculator</option>
    	<option value="?section=hyd" <?php if ($section == "hyd") echo "SELECTED"; ?>>Hydrometer Correction Calculator</option>
  	 </select>
	</form>
    </td>
 </tr>
 </table>
 <?php } ?>
	<?php
	if ($section == "default") include ('main.php');
	if ($section == "calories") include ('gravity.php'); 
	if ($section == "bitterness") include ('bitterness.php'); 
	if ($section == "efficiency") include ('efficiency.php'); 
	if ($section == "water") include ('water_amounts.php'); 
	if ($section == "sugar") include ('priming.php'); 
	if ($section == "force_carb") include ('force_carb.php'); 
	if ($section == "plato") include ('sg.php'); 
	if ($section == "strike") include ('strike.php'); 
	if ($section == "hyd") include ('hydrometer.php'); 
	?>
    <?php include ('../../includes/footer2.inc.php'); ?>
</div>
</body>
</html>

