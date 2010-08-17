<?php require_once('../Connections/config.php');
include ('../includes/check_mobile.inc.php');
include ('../includes/url_variables.inc.php');
$page = "contestPrint";
include ('../includes/db_connect_universal.inc.php');
include ('../includes/db_connect_log.inc.php');
include ('../includes/plug-ins.inc.php');

$dbTable = "brewing";
if (isset($_GET['dbTable'])) {
  $dbTable = (get_magic_quotes_gpc()) ? $_GET['dbTable'] : addslashes($_GET['dbTable']);
}

if ($action == "default") {
	$style = "default";
		if (isset($_GET['style'])) {
  		$style = (get_magic_quotes_gpc()) ? $_GET['style'] : addslashes($_GET['style']);
		}
	} 
else 
$style = $_POST['style'];

if (($action == "verify") || ($action == "print")) { 
$name = $_POST['name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$homePhone = $_POST['homePhone'];
$workPhone = $_POST['workPhone'];
$email = $_POST['email'];
$brewClub = $_POST['brewClub'];
$brewName = $_POST['brewName'];
$still = $_POST['still'];
$dry = $_POST['dry'];
$hydromel = $_POST['hydromel'];
$petillant = $_POST['petillant'];
$semi = $_POST['semi'];
$standard = $_POST['standard'];
$sweet = $_POST['sweet'];
$sparkling = $_POST['sparkling'];
$sack = $_POST['sack'];
$special = $_POST['special'];
$waterTreatment = $_POST['waterTreatment'];
$yeastLiquid = $_POST['yeastLiquid'];
$yeastDried = $_POST['yeastDried'];
$starter = $_POST['starter'];
$yeastNutrients = $_POST['yeastNutrients'];
$carbonation = $_POST['carbonation'];
$volumeC02 = $_POST['volumeC02'];
$primingSugar = $_POST['primingSugar'];
$bottlingDate = $_POST['bottlingDate'];
$finingsType = $_POST['finingsType'];
$finingsAmount = $_POST['finingsAmount'];
}

mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT * FROM $dbTable WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);

$query_style1 = sprintf("SELECT * FROM styles WHERE brewStyle = '%s'", $style);
$style1 = mysql_query($query_style1, $brewing) or die(mysql_error());
$row_style1 = mysql_fetch_assoc($style1);
$totalRows_style1 = mysql_num_rows($style1);

$query_style2 = "SELECT * FROM styles";
$style2 = mysql_query($query_style2, $brewing) or die(mysql_error());
$row_style2 = mysql_fetch_assoc($style2);
$totalRows_style2 = mysql_num_rows($style2);

$query_club = "SELECT * FROM brewer WHERE id = '1'";
$club = mysql_query($query_club, $brewing) or die(mysql_error());
$row_club = mysql_fetch_assoc($club);
$totalRows_club = mysql_num_rows($club);

$query_brewer = sprintf("SELECT * FROM users WHERE user_name = '%s'", $filter);
$brewer = mysql_query($query_brewer, $brewing) or die(mysql_error());
$row_brewer = mysql_fetch_assoc($brewer);
$totalRows_brewer = mysql_num_rows($brewer);

$query_mash_profiles = sprintf("SELECT * FROM mash_profiles WHERE id='%s'", $row_log['brewMashProfile']);
$mash_profiles = mysql_query($query_mash_profiles, $brewing) or die(mysql_error());
$row_mash_profiles = mysql_fetch_assoc($mash_profiles);
$totalRows_mash_profiles = mysql_num_rows($mash_profiles);

$query_mash_steps = sprintf("SELECT * FROM mash_steps WHERE stepMashProfileID = '%s'", $row_mash_profiles['id']);
$mash_steps = mysql_query($query_mash_steps, $brewing) or die(mysql_error());
$row_mash_steps = mysql_fetch_assoc($mash_steps);
$totalRows_mash_steps = mysql_num_rows($mash_steps);

$query_yeast_profiles = sprintf("SELECT * FROM yeast_profiles WHERE id='%s'", $row_log['brewYeastProfile']);
$yeast_profiles = mysql_query($query_yeast_profiles, $brewing) or die(mysql_error());
$row_yeast_profiles = mysql_fetch_assoc($yeast_profiles);

// User Friendly Style Names //
if ($row_style1['brewStyleGroup'] == "01") $styleConvert = "Light Lager";
if ($row_style1['brewStyleGroup'] == "02") $styleConvert = "Pilsner";
if ($row_style1['brewStyleGroup'] == "03") $styleConvert = "European Amber Lager";
if ($row_style1['brewStyleGroup'] == "04") $styleConvert = "Dark Lager";
if ($row_style1['brewStyleGroup'] == "05") $styleConvert = "Bock";
if ($row_style1['brewStyleGroup'] == "06") $styleConvert = "Light Hybrid Beer";
if ($row_style1['brewStyleGroup'] == "07") $styleConvert = "Amber Hybrid Beer";
if ($row_style1['brewStyleGroup'] == "08") $styleConvert = "English Pale Ale";
if ($row_style1['brewStyleGroup'] == "09") $styleConvert = "Scottish and Irish Ale";
if ($row_style1['brewStyleGroup'] == "10") $styleConvert = "American Ale";
if ($row_style1['brewStyleGroup'] == "11") $styleConvert = "English Brown Ale";
if ($row_style1['brewStyleGroup'] == "12") $styleConvert = "Porter";
if ($row_style1['brewStyleGroup'] == "13") $styleConvert = "Stout";
if ($row_style1['brewStyleGroup'] == "14") $styleConvert = "India Pale Ale (IPA)";
if ($row_style1['brewStyleGroup'] == "15") $styleConvert = "German Wheat and Rye Beer";
if ($row_style1['brewStyleGroup'] == "16") $styleConvert = "Belgian and French Ale";
if ($row_style1['brewStyleGroup'] == "17") $styleConvert = "Sour Ale";
if ($row_style1['brewStyleGroup'] == "18") $styleConvert = "Belgian Strong Ale";
if ($row_style1['brewStyleGroup'] == "19") $styleConvert = "Strong Ale";
if ($row_style1['brewStyleGroup'] == "20") $styleConvert = "Fruit Beer";
if ($row_style1['brewStyleGroup'] == "21") $styleConvert = "Spice/Herb/Vegatable Beer";
if ($row_style1['brewStyleGroup'] == "22") $styleConvert = "Smoke-Flavored and Wood-Aged Beer";
if ($row_style1['brewStyleGroup'] == "23") $styleConvert = "Specialty Beer";
if ($row_style1['brewStyleGroup'] == "24") $styleConvert = "Traditional Mead";
if ($row_style1['brewStyleGroup'] == "25") $styleConvert = "Melomel (Fruit Mead)";
if ($row_style1['brewStyleGroup'] == "26") $styleConvert = "Other Mead";
if ($row_style1['brewStyleGroup'] == "27") $styleConvert = "Standard Cider and Perry";
if ($row_style1['brewStyleGroup'] == "28") $styleConvert = "Specialty Cider and Perry";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AHA/BJCP Sanctioned Competition Program Entry/Recipe Form</title>
<style type="text/css">
<!--
body {
background-color: #fff;
color: #000;
font-family: Arial;
font-size: 9px;
}
.headerTitle 			{ font-size: 1.7em; font-weight: bolder; white-space: nowrap; }
.headerTitleSm 			{ font-size: 1.5em; font-weight: bold; white-space: nowrap; }
.bottle					{ font-size: 1.2em; } 
.medium					{ font-size: .9em; } 
.small 					{ font-size: .8em; } 
.caps					{ font-style: italic; font-weight: bold;  white-space: nowrap; }
#printContainer 		{ width: 100%; }
.bdr1_thick	 			{ border: 5px solid #000000; }
.bdr1B_thick	 		{ border-bottom: 5px solid #000000; }
.bdr1B_thick_dotted 	{ border-bottom: 3px dotted #000000; }
.bdr1B 					{ border-bottom: 1px solid #000000; }
.bdr1L 					{ border-left: 1px solid #000000; }
.bdr1R 					{ border-right: 1px solid #000000; }
.bdr1T 					{ border-top: 1px solid #000000; }
input, textarea			{ font-family: Arial; font-size: 10px; border: 1px solid #cccccc;  }	
.headerItalic 		    { font-size: 1em; font-style: italic; }
table.small	td			{ padding: 1px 2px 1px 3px; }
table.bottleLabel		{ border-collapse: collapse; }
table.bottleLabel-inner	{ margin: 15px; width: 300px }
table.bottleLabel-inner	td { padding: 3px; }
.error 					{ color: #FF0000; font-size: 1em; font-weight: bold; margin: 0 0 1em 0; padding: .5em .5em .5em 1.5em; background-image: url(../images/error.png); background-position: center left; background-repeat: no-repeat; }

-->
</style>
</head>
<body <?php if ($action == "print") echo "onload=\"javascript:window.print()\""; ?>>

<div id="printContainer">
<form action="entry.inc.php?action=<?php if ($action == "default") echo "verify"; else echo "print"; ?>&style=<?php echo $style; ?>&id=<?php echo $id; ?>" method="post" name="form1">
<?php if ($action == "verify") { ?>
<table>
  <tr>
    <td><span class="error">If any items are missing, close this window and edit the log or recipe.</span></td>
    <td width="5%" align="right" nowrap="nowrap"><img src = "../images/printer.png" align="absmiddle" />&nbsp;<input type="submit" name="submit" id="submit" value="Print" /></td>
  </tr>
</table>
<?php } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="bdr1B_thick" width="10%" valign="top"><img src="../images/bjcp_logo.jpg" alt="BJCP Logo" width="65" height="60" align="left" /></td>
    <td class="bdr1B_thick" width="80%" align="left" valign="bottom">
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td class="headerTitleSm">AHA/BJCP Sanctioned Competition Program</td>
      </tr>
      <tr>
        <td class="headerTitle">ENTRY/RECIPE FORM</td>
      </tr>
    </table>    </td>
    <td class="bdr1B_thick" width="10%" valign="top"><img src="../images/aha_logo.jpg" alt="AHA Logo" width="110" height="60" border="0" align="right" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="5%" class="headerTitleSm">Brewer(s) Information</td>
        <td class="bdr1B_thick_dotted">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="10%">Name(s) </td>
    <td class="bdr1B"><?php if ($action == "default") { ?>
      <input name="name" type="text" id="name" size="30" value="<?php echo $row_brewer['realFirstName']." ".$row_brewer['realLastName']; ?>" /><?php } else echo $name; ?></td>
    <td width="10%">Street Address</td>
    <td width="40%" class="bdr1B"><?php if ($action == "default") { ?>
      <input name="address" type="text" id="address" size="30" value="<?php echo $row_brewer['userAddress']; ?>" /><?php } else echo $address; ?></td>
    </tr>
  <tr>
    <td width="10%">City</td>
    <td class="bdr1B"><?php if ($action == "default") { ?>
      <input name="city" type="text" id="city" size="30" value="<?php echo $row_brewer['userCity']; ?>" /><?php } else echo $city; ?></td>
    <td width="10%">State<?php if ($action == "default") echo "/Zip"; ?></td>
    <td width="40%" class="bdr1B">
	<?php if ($action == "default") { ?>
      <input name="state" type="text" id="state" size="10" value="<?php echo $row_brewer['userState']; ?>" /><?php } else echo $state; ?>
    <?php if ($action == "default") { ?>
    &nbsp;<input name="zip" type="text" id="zip" size="15" value="<?php echo $row_brewer['userZip']; ?>" /><?php } if ($action == "verify") echo $zip; ?>
    </td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="15%">Phone (h)</td>
    <td class="bdr1B"><?php if ($action == "default") { ?><input name="homePhone" type="text" id="homePhone" size="15" value="<?php echo $row_brewer['userPhoneH']; ?>" /><?php } else echo $homePhone; ?></td>
    <td width="60">Phone (w)</td>
    <td class="bdr1B"><?php if ($action == "default") { ?><input name="workPhone" type="text" id="workPhone" size="15" value="<?php echo $row_brewer['userPhoneW']; ?>" /><?php } else echo $workPhone; ?></td>
    <td width="75">Email Address</td>
    <td class="bdr1B"><?php if ($action == "default") { ?><input name="email" type="text" id="email" size="15" value="<?php echo $row_brewer['userEmail']; ?>" /><?php } else echo $email; ?></td>
  </tr>
  <tr>
    <td width="15%">Club Name</td>
    <td colspan="5" class="bdr1B"><?php if ($action == "default") { ?><input name="brewClub" type="text" id="brewClub" size="50" value="<?php if ($row_pref['mode'] == "2") echo $row_club['brewerFirstName']; else echo $row_club['brewerClubs']; ?>" /><?php } else echo $brewClub; ?></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="5%" class="headerTitleSm">Entry Information</td>
        <td class="bdr1B_thick_dotted">&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="10%" nowrap="nowrap">Name of Brew</td>
    <td width="30%" class="bdr1B"><?php if ($action == "default") { ?>
      <input type="text" name="brewName" id="brewName" value="<?php echo $row_log['brewName']; ?>"/><?php } else echo $brewName; ?></td>
    <td width="10%" nowrap="nowrap">Category (No.)</td>
    <td width="10%" class="bdr1B">
    <?php if ($action == "default") { ?>
    <select name="style">
		<?php do {  ?>
     	<option value="<?php echo $row_style2['brewStyle']?>" <?php  if ($row_style2['brewStyle'] == $row_style1['brewStyle']) echo "SELECTED"; ?>><?php echo $row_style2['brewStyleGroup'].$row_style2['brewStyleNum'].": ".$row_style2['brewStyle']?></option>
      <?php } while ($row_style2 = mysql_fetch_assoc($style2)); ?>
    </select>	
    <?php } else echo $row_style1['brewStyleGroup']; ?>
    </td>
    <td width="5%" nowrap="nowrap"><?php if ($action != "default") { ?>Subcategory (A-F)<?php } else echo "&nbsp;"; ?></td>
    <td class="bdr1B"><?php if ($action != "default") echo $row_style1['brewStyleNum']; ?></td>
  </tr>
  <tr>
    <td colspan="2" nowrap="nowrap">Category/Subcategory (print full names)</td>
    <td colspan="4" class="bdr1B"><?php echo $styleConvert.": "; if ($action == "default") echo $row_log['brewStyle']; else echo $row_style1['brewStyle']; ?></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="49%" align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td colspan="4">For Mead and Cider</td>
        <td colspan="2">For Mead</td>
        </tr>
      <tr>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="still" id="still" value="Y"/><?php } else { if ($still == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td width="23%">Still</td>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="dry" id="dry" value="Y" /><?php } else { if ($dry == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td width="23%">Dry</td>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="hydromel" id="hydromel"  value="Y" /><?php } else { if ($hydromel == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td>Hydromel (light mead)</td>
      </tr>
      <tr>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="petillant" id="petillant"  value="Y" /><?php } else { if ($petillant == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td width="23%">Petillant</td>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="semi" id="semi" value="Y"  /><?php } else { if ($semi == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td width="23%">Semi-Sweet</td>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="standard" id="standard" value="Y"  /><?php } else { if ($standard == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ; ?></td>
        <td>Standard Mead</td>
      </tr>
      <tr>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="sparkling" id="sparkling" value="Y" /><?php } else { if ($sparkling == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td width="23%">Sparkling</td>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="sweet" id="sweet" value="Y"  /><?php } else { if ($sweet == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td width="23%">Sweet</td>
        <td width="2%"><?php if ($action == "default") { ?><input type="checkbox" name="sack" id="sack" value="Y"  /><?php } else { if ($sack == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; }  ?></td>
        <td>Sack (strong mead)</td>
      </tr>
    </table>
    </td>
    <td width="2%" align="left" valign="top">&nbsp;</td>
    <td width="49%" align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>Special Ingredients/Classic Style</td>
      </tr>
      <tr>
        <td class="small">(required for categories 6D, 16E, 17F, 20, 21, 22B, 22C, 23, 25C, 26A, 26C, 27E, 28B-D)</td>
      </tr>
      <tr>
        <td><?php if ($action == "default") { ?><textarea name="special" cols="40" rows="3" id="special"></textarea><?php } else echo $special; ?></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="5%" class="headerTitleSm">Ingredients and Procedures</td>
            <td class="bdr1B_thick_dotted">&nbsp;</td>
          </tr>
        </table>
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td width="49%" rowspan="4" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td width="5%">Number of U.S. gallons brewed for this recipe</td>
        <td class="bdr1B"><?php echo $row_log['brewYield']; ?></td>
        </tr>
      <tr>
        <td><span class="caps">WATER TREATMENT</span> Type/Amount</td>
        <td class="bdr1B"><?php if ($action == "default") { ?><input name="waterTreatment" type="text" id="waterTreatment" size="20" /><?php } else echo $waterTreatment; ?></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td colspan="2"><span class="caps">YEAST CULTURE</span></td>
          <td width="1%"><?php if ($action == "default") { ?><input type="checkbox" name="yeastLiquid" id="yeastLiquid" value="Y" /><?php } else { if ($yeastLiquid == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">";  else echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ?></td>
          <td>Liquid</td>
          <td width="1%"><?php if ($action == "default") { ?><input type="checkbox" name="yeastDried" id="yeastDried" value="Y" /><?php } else { if ($yeastDried == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ?></td>
          <td>Dried</td>
        </tr>
        <tr>
          <td colspan="2">Did you use a starter?</td>
          <td width="1%"><?php if ($action == "default") { ?><input type="radio" name="starter" id="starter" value="Y" /><?php } else { if ($starter == "Y") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ?></td>
          <td>Yes</td>
          <td width="1%"><?php if ($action == "default") { ?><input type="radio" name="starter" id="starter" value="N" /><?php } else { if ($starter == "N") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ?></td>
          <td>No</td>
        </tr>
        <tr>
          <td width="5%">Type</td>
          <td colspan="5" class="bdr1B"><?php if ($row_log['brewYeastProfile'] == "") echo $row_log['brewYeast']; if ($row_log['brewYeastProfile'] != "") echo $row_yeast_profiles['yeastName']." (".$row_yeast_profiles['yeastProdID'].")"; ?></td>
        </tr>
        <tr>
          <td width="5%">Brand</td>
          <td colspan="5" class="bdr1B"><?php if ($row_log['brewYeastProfile'] == "") echo $row_log['brewYeastMan']; if ($row_log['brewYeastProfile'] != "") echo $row_yeast_profiles['yeastLab']; ?></td>
        </tr>
        <tr>
          <td width="5%">Amount</td>
          <td colspan="5" class="bdr1B"><?php echo $row_log['brewYeastAmount'];  ?></td>
        </tr>
        <tr>
          <td colspan="2" nowrap="nowrap"><span class="caps">YEAST NUTRIENTS </span><br />Type/Amount</td>
          <td colspan="4" class="bdr1B"><?php if ($action == "default") { ?><input type="text" name="yeastNutrients" id="yeastNutrients" /><?php } else echo $yeastNutrients; ?></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td align="left" valign="top" nowrap="nowrap"><span class="caps">CARBONATION</span></td>
          <td width="5%"><?php if ($action == "default") { ?><input type="radio" name="carbonation" id="carbonation1" value="forced" /><?php } else { if ($carbonation == "forced") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ?></td>
          <td>forced CO<sub>2</sub></td>
          <td width="5%"><?php if ($action == "default") { ?><input type="radio" name="carbonation" id="carbonation2" value="bottle" /><?php } else { if ($carbonation == "bottle") echo "<img src=\"../images/check.jpg\" border=\"0\">"; else  echo "<img src=\"../images/box.jpg\" border=\"0\">"; } ?></td>
          <td>Bottle Conditioned</td>
        </tr>
        <tr>
          <td nowrap="nowrap">Volumes of CO<sub>2</sub></td>
          <td colspan="4" class="bdr1B"><?php if ($action == "default") { ?><input type="text" name="volumeC02" id="volumeC02" /><?php } else echo $volumeC02; ?></td>
        </tr>
        <tr>
      	  <td nowrap="nowrap">Type/Amount of Priming Sugar</td>
          <td colspan="4" class="bdr1B"><?php if ($action == "default") { ?><input type="text" name="primingSugar" id="primingSugar" /><?php } else echo $primingSugar; ?></td>
          </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td nowrap="nowrap"><span class="caps">SPECIFIC GRAVITIES </span></td>
          <td width="20%" align="right">Original</td>
          <td width="50%" class="bdr1B"><?php echo $row_log['brewOG']; ?></td>
        </tr>
        <tr>
          <td nowrap="nowrap">&nbsp;</td>
          <td align="right">Terminal</td>
          <td colspan="3" class="bdr1B"><?php echo $row_log['brewFG']; ?></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td nowrap="nowrap"><span class="caps">FERMENTATION</span></td>
          <td width="5%">&nbsp;</td>
          <td align="center">Duration (days)</td>
          <td width="5%">&nbsp;</td>
          <td align="center">Temperature (&deg;F)</td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">Primary</td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewPrimary']; ?></td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewPrimaryTemp']; ?></td>
        </tr>
        <tr>
          <td align="right" nowrap="nowrap">Secondary</td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewSecondary']; ?></td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewSecondaryTemp']; ?></td>
        </tr>
        <?php if ($row_log['brewTertiary'] != "") { ?>
        <tr>
          <td align="right" nowrap="nowrap">Tertiary</td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewTertiary']; ?></td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewTertiaryTemp']; ?></td>
        </tr>
        <?php } 
		if ($row_log['brewLager'] != "") { ?>
        <tr>
          <td align="right" nowrap="nowrap">Lager</td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewLager']; ?></td>
          <td width="5%">&nbsp;</td>
          <td align="center" class="bdr1B"><?php echo $row_log['brewLagerTemp']; ?></td>
        </tr>
        <?php } ?>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td width="5%"><span class="caps">BREWING DATE</span></td>
          <td class="bdr1B"><?php $date = $row_log['brewDate']; $realdate = dateconvert($date,2); echo $realdate; ?></td>
        </tr>
        <tr>
          <td width="5%"><span class="caps">BOTTLING DATE</span></td>
          <td class="bdr1B"><?php if ($action == "default") { ?><input type="text" name="bottlingDate" id="bottlingDate"><?php } else echo $bottlingDate; ?></td>
        </tr>
      </table></td>
    <td width="2%" rowspan="4" align="left" valign="top">&nbsp;</td>
    <td width="49%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr class="medium">
        <td colspan="3" class="bdr1B"><strong>FERMENTABLES</strong> (MALT, MALT EXTRACT, ADJUNCTS, HONEY OR OTHER SUGARS)</td>
        </tr>
      <tr>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L">AMOUNT (LB.)</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L">TYPE/BRAND</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1R"><em>USE (MASH/STEEP)</em></td>
      </tr>
      <?php if ($row_log['brewGrain1'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain1Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain1Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain1']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain2'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain2Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain2Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain2']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain3'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain3Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain3Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain3']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain4'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain4Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain4Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain4']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain5'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain5Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain5Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain5']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain6'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain6Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain6Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain6']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain7'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain7Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain7Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain7']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain8'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain8Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain8Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain8']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain9'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain9Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain9Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain9']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain10'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain10Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain10Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain10']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain11'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain11Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain11Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain11']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain12'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain12Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain12Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain12']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain13'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain13Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain13Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain13']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain14'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain14Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain14Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain14']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewGrain15'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewGrain15Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewGrain15Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewGrain15']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php if ($row_log['brewMethod'] == "Extract") echo "Steep"; else echo "Mash"; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewExtract1'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewExtract1Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewExtract1Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewExtract1']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewExtract2'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewExtract2Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewExtract2Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewExtract2']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewExtract3'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewExtract3Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewExtract3Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewExtract3']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
	  <?php if ($row_log['brewExtract4'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewExtract4Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewExtract4Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewExtract4']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewExtract5'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight2'] == "kilograms") { $convert = $row_log['brewExtract5Weight'] * 2.204; echo round($convert,2); } else echo $row_log['brewExtract5Weight']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewExtract5']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition1'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition1Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition1Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition1']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition2'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition2Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition2Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition2']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition3'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition3Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition3Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition3']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition4'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition4Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition4Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition4']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition5'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition5Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition5Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition5']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition6'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition6Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition6Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition6']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition7'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition7Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition7Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition7']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition8'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition8Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition8Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition8']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewAddition9'] != "") { ?>
      <tr>
        <td width="30%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measAmt2'] == "kilograms") { $convert = $row_log['brewAddition9Amt'] * 2.204; echo round($convert,2); } else echo $row_log['brewAddition9Amt']; ?></td>
        <td width="35%" align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewAddition9']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R">Boil</td>
      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
  <tr>
    <td width="49%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr class="medium">
        <td colspan="6" align="left" valign="top"><strong>HOPS</strong></td>
        </tr>
      <tr>
        <td width="20%" align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1T">AMOUNT (OZ.)</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1T">PELLETS OR<br /> WHOLE?</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1T">TYPE</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1T">%A ACID</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1T">USE (BOIL,<br />STEEP, DRY, ETC.)</td>
        <td align="left" valign="top" class="headerItalic bdr1B bdr1L bdr1T bdr1R">MIN. FROM<br />END OF BOIL</td>
      </tr>
      <?php if ($row_log['brewHops1'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops1Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops1Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops1Form'] == "Leaf") || ($row_log['brewHops1Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops1']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops1IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops1Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops1Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops2'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops2Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops2Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops2Form'] == "Leaf") || ($row_log['brewHops2Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops2']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops2IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops2Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops2Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops3'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops3Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops3Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops3Form'] == "Leaf") || ($row_log['brewHops3Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops3']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops3IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops3Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops3Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops4'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops4Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops4Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops4Form'] == "Leaf") || ($row_log['brewHops4Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops4']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops4IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops4Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops4Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops5'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops5Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops5Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops5Form'] == "Leaf") || ($row_log['brewHops5Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops5']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops5IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops5Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops5Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops6'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops6Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops6Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops6Form'] == "Leaf") || ($row_log['brewHops6Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops6']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops6IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops6Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops6Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops7'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops7Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops7Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops7Form'] == "Leaf") || ($row_log['brewHops7Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops7']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops7IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops7Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops7Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops8'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops8Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops8Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops8Form'] == "Leaf") || ($row_log['brewHops8Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops8']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops8IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops8Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops8Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops9'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops9Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops9Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops9Form'] == "Leaf") || ($row_log['brewHops9Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops9']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops9IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops9Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops9Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops10'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops10Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops10Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops10Form'] == "Leaf") || ($row_log['brewHops10Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops10']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops10IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops10Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops10Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops11'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops11Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops11Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops11Form'] == "Leaf") || ($row_log['brewHops11Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops11']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops11IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops11Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops11Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops12'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops12Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops12Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops12Form'] == "Leaf") || ($row_log['brewHops12Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops12']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops12IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops12Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops12Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops13'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops13Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops13Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops13Form'] == "Leaf") || ($row_log['brewHops13Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops13']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops13IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops13Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops13Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops14'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops14Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops14Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops14Form'] == "Leaf") || ($row_log['brewHops14Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops14']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops14IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops14Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops14Time']; ?></td>
      </tr>
      <?php } ?>
      <?php if ($row_log['brewHops15'] != "") { ?>
      <tr>
        <td width="20%" align="left" valign="top" class="medium bdr1B bdr1L"><?php if ($row_pref['measWeight1'] == "grams") { $convert = ($row_log['brewHops15Weight'] * 0.0352); echo round ($convert,2); } else echo $row_log['brewHops15Weight']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php if (($row_log['brewHops15Form'] == "Leaf") || ($row_log['brewHops15Form'] == "Plug")) echo "Whole"; else echo "Pellets"; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops15']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops15IBU']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L"><?php echo $row_log['brewHops15Use']; ?></td>
        <td align="left" valign="top" class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewHops15Time']; ?></td>
      </tr>
      <?php } ?>
    </table>
    </td>
  </tr>
  <tr>
    <td width="49%" align="left" valign="top">
    
    <?php if ($row_log['brewMashProfile'] == "") { ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr class="medium">
        <td colspan="3"><strong>MASH SCHEDULE</strong></td>
        </tr>
      <tr>
        <td width="33%" class="headerItalic bdr1B bdr1L bdr1T">STEP</td>
        <td width="34%" class="headerItalic bdr1B bdr1L bdr1T">TEMPERATURE</td>
        <td width="33%" class="headerItalic bdr1B bdr1L bdr1T bdr1R">TIME</td>
      </tr>
      <tr>
        <td class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep1Name']."&nbsp;"; ?></td>
        <td width="34%" class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep1Temp']; ?></td>
        <td class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewMashStep1Time']; ?></td>
      </tr>
      <tr>
        <td class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep2Name']."&nbsp;"; ?></td>
        <td width="34%" class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep2Temp']; ?></td>
        <td class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewMashStep2Time']; ?></td>
      </tr>
      <tr>
        <td class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep3Name']."&nbsp;"; ?></td>
        <td width="34%" class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep3Temp']; ?></td>
        <td class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewMashStep3Time']; ?></td>
      </tr>
      <tr>
        <td class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep4Name']."&nbsp;"; ?></td>
        <td width="34%" class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep4Temp']; ?></td>
        <td class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewMashStep4Time']; ?></td>
      </tr>
      <tr>
        <td class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep5Name']."&nbsp;"; ?></td>
        <td width="34%" class="medium bdr1B bdr1L"><?php echo $row_log['brewMashStep5Temp']; ?></td>
        <td class="medium bdr1B bdr1L bdr1R"><?php echo $row_log['brewMashStep5Time']; ?></td>
      </tr>
    </table>
    <?php } ?>
    
    <?php if ($row_log['brewMashProfile'] != "") { ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="1">
      <tr class="medium">
        <td colspan="3"><strong>MASH SCHEDULE</strong></td>
        </tr>
      <tr>
        <td width="33%" class="headerItalic bdr1B bdr1L bdr1T">STEP</td>
        <td width="34%" class="headerItalic bdr1B bdr1L bdr1T">TEMPERATURE</td>
        <td width="33%" class="headerItalic bdr1B bdr1L bdr1T bdr1R">TIME</td>
      </tr>
      <?php do { ?>
      <tr>
        <td class="medium bdr1B bdr1L"><?php echo $row_mash_steps['stepName']."&nbsp;"; ?></td>
        <td width="34%" class="medium bdr1B bdr1L"><?php echo $row_mash_steps['stepTemp']; ?></td>
        <td class="medium bdr1B bdr1L bdr1R"><?php echo $row_mash_steps['stepTime']; ?></td>
      </tr>
      <?php } while ($row_mash_steps = mysql_fetch_assoc($mash_steps)); ?>
    </table>
    <?php } ?>
    
    </td>
  </tr>
  <tr>
    <td width="49%" align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td colspan="2" class="caps">Finings</td>
        </tr>
      <tr>
        <td width="5%">Type</td>
        <td class="bdr1B"><?php if ($action == "default") { ?><input type="text" name="finingsType" id="finingsType" /><?php } else echo $finingsType; ?></td>
      </tr>
      <tr>
        <td width="5%">Amount</td>
        <td class="bdr1B"><?php if ($action == "default") { ?><input type="text" name="finingsAmount" id="finingsAmount" /><?php } else echo $finingsAmount; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php if ($action != "print") { ?>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="5%"><?php if ($action == "verify") { ?><input type="button" name="Back" id="Back" value="Back" onclick="history.go(-1);return false;" /><?php } else echo "&nbsp;";?></td>
    <td>&nbsp;</td>
    <td width="5%"><input type="submit" name="submit" id="submit" value="<?php if ($action == "default") echo "Submit"; else echo "Print"; ?>" /></td>
  </tr>
</table>
<?php } else echo ""; 
if ($action == "verify") { ?>
<input name="name" type="hidden" value="<?php echo $name; ?>" />
<input name="address" type="hidden" value="<?php echo $address; ?>" />
<input name="city" type="hidden" value="<?php echo $city; ?>" />
<input name="state" type="hidden" value="<?php echo $state; ?>" />
<input name="zip" type="hidden" value="<?php echo $zip; ?>" />
<input name="homePhone" type="hidden" value="<?php echo $homePhone; ?>" />
<input name="workPhone" type="hidden" value="<?php echo $workPhone; ?>" />
<input name="email" type="hidden" value="<?php echo $email; ?>" />
<input name="brewClub" type="hidden" value="<?php echo $brewClub; ?>" />
<input name="brewName" type="hidden" value="<?php echo $brewName; ?>" />
<input name="still" type="hidden" value="<?php echo $still; ?>" />
<input name="dry" type="hidden" value="<?php echo $dry; ?>" />
<input name="hydromel" type="hidden" value="<?php echo $hydromel; ?>" />
<input name="petillant" type="hidden" value="<?php echo $petillant; ?>" />
<input name="semi" type="hidden" value="<?php echo $semi; ?>" />
<input name="standard" type="hidden" value="<?php echo $standard; ?>" />
<input name="sweet" type="hidden" value="<?php echo $sweet; ?>" />
<input name="sparkling" type="hidden" value="<?php echo $sparkling; ?>" />
<input name="sack" type="hidden" value="<?php echo $sack; ?>" />
<input name="special" type="hidden" value="<?php echo $special; ?>" />
<input name="waterTreatment" type="hidden" value="<?php echo $waterTreatment; ?>" />
<input name="yeastLiquid" type="hidden" value="<?php echo $yeastLiquid; ?>" />
<input name="yeastDried" type="hidden" value="<?php echo $yeastDried; ?>" />
<input name="starter" type="hidden" value="<?php echo $starter; ?>" />
<input name="yeastNutrients" type="hidden" value="<?php echo $yeastNutrients; ?>" />
<input name="carbonation" type="hidden" value="<?php echo $carbonation; ?>" />
<input name="volumeC02" type="hidden" value="<?php echo $volumeC02; ?>" />
<input name="primingSugar" type="hidden" value="<?php echo $primingSugar; ?>" />
<input name="bottlingDate" type="hidden" value="<?php echo $bottlingDate; ?>" />
<input name="finingsType" type="hidden" value="<?php echo $finingsType; ?>" />
<input name="finingsAmount" type="hidden" value="<?php echo $finingsAmount; ?>" />
<input name="style" type="hidden" value="<?php echo $style; ?>" />
<?php } ?>
</form>
<p class="medium">This form is emulates the BJCP Entry/Recipe Form Copyright ©2006 Beer Judge Certification Program rev. 070307</p>
<?php if (($action == "print") || ($action == "verify")) { ?>
<br style="page-break-after:always;">
<table width="600" border="0" align="center" cellspacing="15">
  <tr>
    <td>
    <table width="100%" border="0" cellpadding="8" cellspacing="8" class="bdr1_thick bottleLabel">
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID.jpg" alt="Bottle ID Form" width="230" height="20" /></div></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name</td>
        <td colspan="3" class="bdr1B"><?php echo $name; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Street Address</td>
        <td colspan="3" class="bdr1B"><?php echo $address; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">City</td>
        <td colspan="3" class="bdr1B"><?php echo $city; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">State</td>
        <td class="bdr1B"><?php echo $state; ?></td>
        <td width="5%">Zip</td>
        <td width="50%" class="bdr1B"><?php echo $zip; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Phone Number</td>
        <td colspan="3" class="bdr1B"><?php echo $homePhone; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Email Address</td>
        <td colspan="3" class="bdr1B"><?php echo $email; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name of Beer</td>
        <td colspan="3" class="bdr1B"><?php echo $brewName; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Category Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleGroup']; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Subcategory Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleNum']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap">Homebrew Club</td>
        <td colspan="3" class="bdr1B"><?php echo $brewClub; ?></td>
      </tr>
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID_attach.jpg" alt="Attach To Each Bottle" width="230" height="20" /></div></td>
      </tr>
    </table></td>
    <td width="50%"><table width="100%" border="0" cellpadding="8" cellspacing="8" class="bdr1_thick bottleLabel">
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID.jpg" alt="Bottle ID Form" width="230" height="20" /></div></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name</td>
        <td colspan="3" class="bdr1B"><?php echo $name; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Street Address</td>
        <td colspan="3" class="bdr1B"><?php echo $address; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">City</td>
        <td colspan="3" class="bdr1B"><?php echo $city; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">State</td>
        <td class="bdr1B"><?php echo $state; ?></td>
        <td width="5%">Zip</td>
        <td width="50%" class="bdr1B"><?php echo $zip; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Phone Number</td>
        <td colspan="3" class="bdr1B"><?php echo $homePhone; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Email Address</td>
        <td colspan="3" class="bdr1B"><?php echo $email; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name of Beer</td>
        <td colspan="3" class="bdr1B"><?php echo $brewName; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Category Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleGroup']; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Subcategory Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleNum']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap">Homebrew Club</td>
        <td colspan="3" class="bdr1B"><?php echo $brewClub; ?></td>
      </tr>
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID_attach.jpg" alt="Attach To Each Bottle" width="230" height="20" /></div></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="8" cellspacing="8" class="bdr1_thick bottleLabel">
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID.jpg" alt="Bottle ID Form" width="230" height="20" /></div></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name</td>
        <td colspan="3" class="bdr1B"><?php echo $name; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Street Address</td>
        <td colspan="3" class="bdr1B"><?php echo $address; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">City</td>
        <td colspan="3" class="bdr1B"><?php echo $city; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">State</td>
        <td class="bdr1B"><?php echo $state; ?></td>
        <td width="5%">Zip</td>
        <td width="50%" class="bdr1B"><?php echo $zip; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Phone Number</td>
        <td colspan="3" class="bdr1B"><?php echo $homePhone; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Email Address</td>
        <td colspan="3" class="bdr1B"><?php echo $email; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name of Beer</td>
        <td colspan="3" class="bdr1B"><?php echo $brewName; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Category Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleGroup']; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Subcategory Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleNum']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap">Homebrew Club</td>
        <td colspan="3" class="bdr1B"><?php echo $brewClub; ?></td>
      </tr>
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID_attach.jpg" alt="Attach To Each Bottle" width="230" height="20" /></div></td>
      </tr>
    </table></td>
    <td width="50%"><table width="100%" border="0" cellpadding="8" cellspacing="8" class="bdr1_thick bottleLabel">
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID.jpg" alt="Bottle ID Form" width="230" height="20" /></div></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name</td>
        <td colspan="3" class="bdr1B"><?php echo $name; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Street Address</td>
        <td colspan="3" class="bdr1B"><?php echo $address; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">City</td>
        <td colspan="3" class="bdr1B"><?php echo $city; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">State</td>
        <td class="bdr1B"><?php echo $state; ?></td>
        <td width="5%">Zip</td>
        <td width="50%" class="bdr1B"><?php echo $zip; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Phone Number</td>
        <td colspan="3" class="bdr1B"><?php echo $homePhone; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Email Address</td>
        <td colspan="3" class="bdr1B"><?php echo $email; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Name of Beer</td>
        <td colspan="3" class="bdr1B"><?php echo $brewName; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Category Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleGroup']; ?></td>
      </tr>
      <tr>
        <td width="5%" nowrap="nowrap">Subcategory Entered</td>
        <td colspan="3" class="bdr1B"><?php echo $row_style1['brewStyleNum']; ?></td>
      </tr>
      <tr>
        <td nowrap="nowrap">Homebrew Club</td>
        <td colspan="3" class="bdr1B"><?php echo $brewClub; ?></td>
      </tr>
      <tr>
        <td colspan="4"><div align="center"><img src="../images/bottleID_attach.jpg" alt="Attach To Each Bottle" width="230" height="20" /></div></td>
      </tr>
    </table></td>
  </tr>
</table>




<?php } ?>
</div>
</body>
</html>