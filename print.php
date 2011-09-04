<?php 
require ('paths.php');
include (INCLUDES.'url_variables.inc.php');

//navbar configuration for login/logout links
require (INCLUDES.'authentication_nav.inc.php'); session_start();

//set up brewers, themes, etc.
include (INCLUDES.'db_connect_universal.inc.php');

//set up recipes, brewlogs, etc.
include (INCLUDES.'db_connect_log.inc.php');

//include function to check for mobile browsers
include (INCLUDES.'check_mobile.inc.php');

//do various abv calculations related to the currently viewed recipe (if any)
include (INCLUDES.'abv.inc.php');
include (INCLUDES.'functions.inc.php'); 

//include various conversions functions, date functions and truncate functions
//plus additional libs for 
//    titles.inc.php - set up the navigation?
//    messages.inc.php - tooltips and a few messages
//    scrubber.inc.php - a few arrays for character replacement
include (INCLUDES.'plug-ins.inc.php');

//figure out SRM and a hex value for displaying beer color
//include (INCLUDES.'color.inc.php');

// Load color library functions
require_once (ADMIN_LIBRARY.'color.lib.php');

//determine if club edition or personal edition is in use
include (INCLUDES.'version.inc.php'); 

// Load constants
require_once (ADMIN_INCLUDES.'constants.inc.php');


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

$imageSrc = "images/";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php if ($view == "limited") { // Yeah, I know it's a hack to get the JS print onload event in Thickbox. But it works.?>
<meta http-equiv="refresh" content="0;URL=print.php?page=<?php echo $page; ?>&source=<?php echo $source; ?>&dbTable=<?php echo $dbTable; ?>&brewStyle=<?php echo $colname_style; if ($amt != "default") echo "&amt=".$amt."&action=scale"; ?>&view=print&id=<?php echo $colname_log; ?>">
<?php } ?>
<title><?php echo $row_log['brewName']; if ($row_name['brewerFirstName'] != "") { ?>: From <?php echo $row_name['brewerFirstName']; ?> <?php echo $row_name['brewerLastName']; ?>'s BrewBlog<?php } ?></title>
<link href="css/html_elements.css" rel="stylesheet" type="text/css">
<link href="css/universal_elements.css" rel="stylesheet" type="text/css">
<link href="css/print.css" rel="stylesheet" type="text/css">
</head>
<body <?php if ($view == "print") echo "onload=\"javascript:window.print()\""; ?>>
<div id="main-container">
<?php if ($view == "limited") { // if auto print turned off ?>
<p><img src="images/printer.png"><span class="data"><a href="javascript:window.print()">Print</a></span></p>
<?php } ?>
   <div id="subtitle"><?php echo $row_log['brewName']; ?></div>
	<p>From the BrewBlog of <?php echo $row_name['brewerFirstName']; if ($row_name['brewerLastName'] != "" ) echo "&nbsp;".$row_name['brewerLastName'];  if ($row_name['brewerCity'] != "" ) echo " &ndash; ".$row_name['brewerCity']; if ($row_name['brewerState'] != "" ) echo ", ".$row_name['brewerState']; if ($row_name['brewerCountry'] != "" )  echo " ".$row_name['brewerCountry']; ?>
	<br>Printed <?php print date ( 'F j, Y' );?></p>
  	<?php if ($row_pref['allowSpecifics'] == "Y") { include (SECTIONS.'recipe_specifics.inc.php'); } ?>
    <?php if ($totalRows_style > 0) { ?>
	<div class="headerContent">BJCP Style Info: <?php echo $row_style['brewStyle']; ?></div>
  <table>
    <?php if ($row_style['brewStyleOG'] != "" ) {  ?>
    <tr>
     <td width="15%" class="dataLabelLeft">O.G.:</td>
	 <td class="data"><?php if ($row_style['brewStyleOG'] == "" ) echo "Varies"; elseif ($row_style['brewStyleOG'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleOG'] == "N/A" ) echo "N/A";  else echo $row_style['brewStyleOG']." - ".$row_style['brewStyleOGMax']; ?></td>
    </tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleFG'] != "" ) {  ?>
	<tr>
     <td class="dataLabelLeft">F.G.:</td>
	 <td class="data"><?php  if ($row_style['brewStyleFG'] == "" ) echo "Varies"; elseif ($row_style['brewStyleFG'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleFG'] == "N/A" ) echo "N/A";  else echo $row_style['brewStyleFG']." - ".$row_style['brewStyleFGMax'];  ?></td>
    </tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleABV'] != "" ) {  ?>
    <tr>
     <td class="dataLabelLeft">ABV:</td>
	 <td class="data"> <?php  if ($row_style['brewStyleABV'] == "" ) echo "Varies";  elseif ($row_style['brewStyleABV'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleABV'] == "N/A" ) echo "N/A"; else echo $row_style['brewStyleABV']." - ".$row_style['brewStyleABVMax']."%";  ?></td>
    </tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleIBU'] != "" ) {  ?>
    <tr>
     <td class="dataLabelLeft">Bitterness:</td>
	 <td class="data"><?php  if ($row_style['brewStyleIBU'] == "" ) echo "Varies"; elseif ($row_style['brewStyleIBU'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleIBU'] == "N/A" ) echo "N/A"; else echo $row_style['brewStyleIBU']." - ".$row_style['brewStyleIBUMax']." IBUs";  ?></td>
    </tr>
	<?php }  ?>
    <?php if ($row_style['brewStyleSRM'] != "" ) {  ?>        
	<tr>
     <td class="dataLabelLeft">Color:</td>
	 <td class="data"><?php if ($row_style['brewStyleSRM'] == "" ) echo "Varies"; elseif ($row_style['brewStyleSRM'] == "Varies" ) echo "Varies"; elseif ($row_style['brewStyleSRM'] == "N/A" ) echo "N/A"; else echo ltrim($row_style['brewStyleSRM'], "0")." - ".ltrim($row_style['brewStyleSRMMax'], "0")." SRM"; ?></td>
	</tr>
	<?php }  ?>
	<?php if ($row_style['brewStyleInfo'] != "" ) {  ?>
    <tr>
     <td class="dataLabelLeft">Info:</td>
	 <td class="data"><?php echo $row_style['brewStyleInfo']; ?></td>
    </tr>
	<?php }  ?>  
    </table>
<?php } ?>
<?php 
		if ($row_pref['allowGeneral'] == "Y") { include (SECTIONS.'recipe_general.inc.php'); }
		if ($row_pref['allowComments'] == "Y") { if ($page == "logPrint") include (SECTIONS.'recipe_comments.inc.php'); if ($page == "recipePrint") 		include (SECTIONS.'recipe_notes.inc.php'); }
		if ($row_pref['allowRecipe'] == "Y") { include (SECTIONS.'recipe.inc.php'); }
		if ($row_pref['allowMash'] == "Y") { include (SECTIONS.'recipe_mash.inc.php'); } 
		if (($page == "logPrint") && ($row_pref['allowWater'] == "Y")) { include (SECTIONS.'recipe_water.inc.php'); } 
		if ($row_pref['allowProcedure'] == "Y") { include (SECTIONS.'recipe_procedure.inc.php'); } 
		if (($page == "logPrint") && ($row_pref['allowSpecialProcedure'] == "Y")) { include (SECTIONS.'recipe_special_procedure.inc.php'); } 
		if ($row_pref['allowFermentation'] == "Y") { include (SECTIONS.'recipe_fermentation.inc.php'); } 
	?>
<div id="subtitle" style="page-break-before:always;"><?php echo $row_log['brewName']; ?></div>
<table width="50%">
	<tr>
    	<td class="dataLabelLeft">Date Brewed:</td>
        <td class="data bdr1B_black">&nbsp;</td>
    </tr>
    <tr>
    	<td class="dataLabelLeft">Brewer/Assistant:</td>
        <td class="data bdr1B_black">&nbsp;</td>
    </tr>
</table>  
<div class="headerContent">Brew Day Data</div>
	<table class="dataTable" style="border: 1px solid #000000;">
    <tr>
	 <td class="dataLabel bdr1B_black">&nbsp;</td>
	 <td width="30%" class="dataLabel bdr1B_black bdr1L_black">Target</td>
     <td width="30%" class="dataLabel bdr1B_black bdr1L_black">Actual</td>
	</tr>
	<?php if ($row_log['brewMethod'] == "All Grain")  { 
	include (SECTIONS.'water_amounts_calc.inc.php');
	?>
    <tr>
	 <td class="dataLabel bdr1B_black">Strike Water Amount:</td>
	 <td class="data bdr1B_black bdr1L_black"><?php if ($row_pref['measFluid2'] == "liters") echo round ($mashWaterMet, 1); else echo round ($mashWater, 1); ?></td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Strike Water Temperature:</td>
	 <td class="data bdr1B_black bdr1L_black" bdr1L_black>&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Mash Temperature:</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Mash Time:</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Sparge Water Amount:</td>
	 <td class="data bdr1B_black bdr1L_black"><?php if ($row_pref['measFluid2'] == "liters") echo round ($spargeWaterMet, 1); else echo round ($spargeWater, 1); ?></td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Sparge Water Temperature:</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Pre-Boil Gravity:</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Pre-Boil Amount:</td>
	 <td class="data bdr1B_black bdr1L_black"><?php echo round ($runoffVol, 1); ?></td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
    <tr>
	 <td class="dataLabel bdr1B_black">Post-Boil Amount:</td>
	 <td class="data bdr1B_black bdr1L_black"><?php echo $finalBoilVol; ?></td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<?php } ?>
	<tr>
	 <td class="dataLabel bdr1B_black">Boil Time:</td>
	 <td class="data bdr1B_black bdr1L_black"><?php if ($dbTable == "recipes") echo $boilTime; else echo $row_log['brewBoilTime']; ?></td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLabel bdr1B_black">Original Gravity:</td>
	 <td class="data bdr1B_black bdr1L_black"><?php if ($row_log['brewOG'] != "") echo $row_log['brewOG']." / ".round((-463.37) + (668.72 * $row_log['brewOG']) - (205.35 * (pow($row_log['brewOG'],2))), 1)."&deg; P"; elseif ($row_log['brewTargetOG'] != "") echo $row_log['brewTargetOG']." / ".round((-463.37) + (668.72 * $row_log['brewTargetOG']) - (205.35 * (pow($row_log['brewTargetOG'],2))), 1)."&deg; P"; else echo ""; ?></td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLeft bdr1B_black">&nbsp;</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLeft bdr1B_black">&nbsp;</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
    <tr>
	 <td class="dataLeft bdr1B_black">&nbsp;</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
	<tr>
	 <td class="dataLeft bdr1B_black">&nbsp;</td>
	 <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
     <td class="data bdr1B_black bdr1L_black">&nbsp;</td>
	</tr>
  </table>
<div class="headerContent">Brew Day Notes</div>
<table class="dataTable" style="border: 1px solid #000000;">
	<tr>
    	<td style="height: 200px;">&nbsp;</td>
    </tr>
</table>
<p><div id="footerInclude">Printed using BrewBlogger <?php echo $version; ?>, brewing log software for PHP and MySQL, available at http://www.brewblogger.net.</div></p>
</div>
</body>
</html>
