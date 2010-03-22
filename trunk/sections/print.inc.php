<?php 
require_once('../Connections/config.php'); 
include ('../includes/url_variables.inc.php');
include ('../includes/db_connect_log.inc.php');
$page = "logPrint";
if (isset($_GET['page'])) {
  $page = (get_magic_quotes_gpc()) ? $_GET['page'] : addslashes($_GET['page']);
}
//if ($source == "brewLog") { $page == "logPrint"; }
//if ($source == "brewLogRecipe") { $page == "recipePrint"; }
//if ($source == "recipeDB") { $page == "recipePrint"; }
$scale = $amt;
$colname_style = "-1";
if (isset($_GET['brewStyle'])) {
  $colname_style = (get_magic_quotes_gpc()) ? $_GET['brewStyle'] : addslashes($_GET['brewStyle']);
}
mysql_select_db($database_brewing, $brewing);
$query_style = sprintf("SELECT * FROM styles WHERE brewStyle = '%s'", $colname_style);
$style = mysql_query($query_style, $brewing) or die(mysql_error());
$row_style = mysql_fetch_assoc($style);
$totalRows_style = mysql_num_rows($style);

include ('../includes/db_connect_universal.inc.php');
include ('../includes/abv.inc.php');
include ('../includes/color.inc.php');
include ('../includes/check_mobile.inc.php');
include ('../includes/plug-ins.inc.php');
include ('../includes/version.inc.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php if ($view == "limited") { // Yeah, I know it's a hack to get the JS print onload event in Thickbox. But it works.?>
<meta http-equiv="refresh" content="0;URL=print.inc.php?page=<?php echo $page; ?>&source=<?php echo $source; ?>&dbTable=<?php echo $dbTable; ?>&brewStyle=<?php echo $colname_style; if ($amt != "default") echo "&amt=".$amt."&action=scale"; ?>&view=print&id=<?php echo $colname_log; ?>">
<?php } ?>
<title><?php echo $row_log['brewName']; if ($row_name['brewerFirstName'] != "") { ?>: From <?php echo $row_name['brewerFirstName']; ?> <?php echo $row_name['brewerLastName']; ?>'s BrewBlog<?php } ?></title>
<link href="../css/html_elements.css" rel="stylesheet" type="text/css">
<link href="../css/universal_elements.css" rel="stylesheet" type="text/css">
<link href="../css/print.css" rel="stylesheet" type="text/css">
</head>
<body <?php if ($view == "print") echo "onload=\"javascript:window.print()\""; ?>>
<div id="maincontainer">
<div id="contentWrapper">
<?php if ($view == "limited") { // if auto print turned off ?>
<p><img src="../images/printer.png"><span class="data"><a href="javascript:window.print()">Print</a></span></p>
<?php } ?>
   <div id="contentcolumn">
   <div id="subtitle"><?php echo $row_log['brewName']; ?></div>
  <table class="dataTable">
  <tr>
   <td><p>From the BrewBlog of <?php echo $row_name['brewerFirstName']; if ($row_name['brewerLastName'] != "" ) echo "&nbsp;".$row_name['brewerLastName'];  ?><br><?php if ($row_name['brewerCity'] != "" ) echo $row_name['brewerCity']; if ($row_name['brewerState'] != "" ) echo ", ".$row_name['brewerState']; if ($row_name['brewerCountry'] != "" )  echo " ".$row_name['brewerCountry']; ?></p></td>
  </tr>
  <tr>
   <td>Printed <?php print date ( 'F j, Y' );?></td>
  </tr>
  </table>
  		<?php
					if ($row_pref['allowSpecifics'] == "Y") { include ('specifics.inc.php'); }
					if ($row_pref['allowGeneral'] == "Y") { include ('general.inc.php'); }
					if ($row_pref['allowComments'] == "Y") { if ($page == "logPrint") include ('comments.inc.php'); if ($page == "recipePrint") include ('notes.inc.php'); }
					if ($row_pref['allowRecipe'] == "Y") { include ('recipe.inc.php'); }
					if ($row_pref['allowMash'] == "Y") { include ('mash.inc.php'); } 
					if (($page == "logPrint") && ($row_pref['allowWater'] == "Y")) { include ('water.inc.php'); } 
					if ($row_pref['allowProcedure'] == "Y") { include ('procedure.inc.php'); } 
					if (($page == "logPrint") && ($row_pref['allowSpecialProcedure'] == "Y")) { include ('special_procedure.inc.php'); } 
					if ($row_pref['allowFermentation'] == "Y") { include ('fermentation.inc.php'); } 
		?>
  
 </div>
<?php include ('water_amounts_calc.inc.php'); ?>
<div id="rightcolumn">
<div id="sidebarWrapper">
<div id="sidebarHeader">BJCP Style Info</div>
   <table class="dataTable text_10">
    <tr>
	 <td class="dataLabelWide">Style:</td>
	 <td class="data"><?php echo $row_style['brewStyle']; ?></td>
	</tr>
    <?php if ($row_style['brewStyleOG'] != "" ) {  ?>
    <tr>
     <td class="dataLabelWide">O.G.:</td>
	 <td class="data"><?php if ($row_style['brewStyleOG'] == "" ) echo "Varies"; elseif ($row_style['brewStyleOG'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleOG'] == "N/A" ) echo "N/A";  else echo $row_style['brewStyleOG']." - ".$row_style['brewStyleOGMax']; ?></td>
    </tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleFG'] != "" ) {  ?>
	<tr>
     <td class="dataLabelWide">F.G.:</td>
	 <td class="data"><?php  if ($row_style['brewStyleFG'] == "" ) echo "Varies"; elseif ($row_style['brewStyleFG'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleFG'] == "N/A" ) echo "N/A";  else echo $row_style['brewStyleFG']." - ".$row_style['brewStyleFGMax'];  ?></td>
    </tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleABV'] != "" ) {  ?>
    <tr>
     <td class="dataLabelWide">ABV:</td>
	 <td class="data"> <?php  if ($row_style['brewStyleABV'] == "" ) echo "Varies";  elseif ($row_style['brewStyleABV'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleABV'] == "N/A" ) echo "N/A"; else echo $row_style['brewStyleABV']." - ".$row_style['brewStyleABVMax']."%";  ?></td>
    </tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleIBU'] != "" ) {  ?>
    <tr>
     <td class="dataLabelWide">Bitterness:</td>
	 <td class="data"><?php  if ($row_style['brewStyleIBU'] == "" ) echo "Varies"; elseif ($row_style['brewStyleIBU'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleIBU'] == "N/A" ) echo "N/A"; else echo $row_style['brewStyleIBU']." - ".$row_style['brewStyleIBUMax']." IBUs";  ?></td>
    </tr>
	<?php }  ?>
    <?php if ($row_style['brewStyleSRM'] != "" ) {  ?>        
	<tr>
     <td class="dataLabelWide">Color:</td>
	 <td class="data"><?php if ($row_style['brewStyleSRM'] == "" ) echo "Varies"; elseif ($row_style['brewStyleSRM'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleSRM'] == "N/A" ) echo "N/A"; else echo ltrim($row_style['brewStyleSRM'], "0")." - ".ltrim($row_style['brewStyleSRMMax'], "0")." SRM"; ?></td>
	</tr>
	<?php }  ?>
	</table>
	<?php if ($row_style['brewStyleInfo'] != "" ) {  ?>
	<table class="dataTable text_10">
    <tr>
     <td class="dataLabelWide">Info:</td>
	</tr>
	<tr>
	 <td><?php echo $row_style['brewStyleInfo']; ?></td>
    </tr>
	</table>
	<?php }  ?>  
 </div>
	<div id="sidebarWrapper">
	<div id="sidebarHeader">Brew Day Data</div>
	<table class="dataTable text_10">
	<?php if ($row_log['brewMethod'] == "All Grain")  { ?>
    <tr>
	 <td class="dataLabelWide ">&nbsp;</td>
	 <td class="data">Target</td>
     <td class="data">Actual</td>
	</tr>
    <tr>
	 <td class="dataLabelWide">Str Water Amt:</td>
	 <td class="data"><?php if ($row_pref['measFluid2'] == "liters") echo round ($mashWaterMet, 1); else echo round ($mashWater, 1); ?></td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Str Water Temp:</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Mash Temp:</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Mash Time:</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Sp Water Amt:</td>
	 <td class="data"><?php if ($row_pref['measFluid2'] == "liters") echo round ($spargeWaterMet, 1); else echo round ($spargeWater, 1); ?></td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Sp Water Temp:</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Pre-Boil Grav:</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">Pre-Boil Amt:</td>
	 <td class="data"><?php echo round ($runoffVol, 1); ?></td>
     <td class="data">______</td>
	</tr>
    <tr>
	 <td class="dataLabelWide">Post-Boil Amt:</td>
	 <td class="data"><?php echo $finalBoilVol; ?></td>
     <td class="data">______</td>
	</tr>
	<?php } ?>
	<tr>
	 <td class="dataLabelWide">Boil Time:</td>
	 <td class="data"><?php echo $boilTime; ?></td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">O.G.:</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">____________</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	<tr>
	 <td class="dataLabelWide">____________</td>
	 <td class="data">______</td>
     <td class="data">______</td>
	</tr>
	</table>
	</div>
 </div>
</div>
<div id="footerInclude">Printed using BrewBlogger <?php echo $version; ?>, brewing log software for PHP and MySQL, available at http://www.brewblogger.net.</div>
</div>
</body>
</html>
