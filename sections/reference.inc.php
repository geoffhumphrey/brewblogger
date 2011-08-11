<?php 

$section = "-1";
if (isset($_GET['section'])) {
  $section = (get_magic_quotes_gpc()) ? $_GET['section'] : addslashes($_GET['section']);
}

$source = "reference";
if (isset($_GET['source'])) {
  $source = (get_magic_quotes_gpc()) ? $_GET['source'] : addslashes($_GET['source']);
}

if ($source != "reference") { require ('../Connections/config.php'); include ('../includes/db_connect_universal.inc.php');  include ('../includes/check_mobile.inc.php'); include ('../includes/plug-ins.inc.php'); $imageSrc = "../images/"; }

// ------------------------------- Styles -------------------------------
if ($section == "styles") {
$sort = "brewStyleGroup, brewStyleNum";
if (isset($_GET['sort'])) {
  $sort = ($_GET['sort']);
}

$dir = "ASC";
if (isset($_GET['dir'])) {
  $dir = ($_GET['dir']);
}

$filterStyle = mysql_real_escape_string("brewStyleGroup");
if (isset($_GET['filterStyle'])) {
  $filterStyle = mysql_real_escape_string($_GET['filterStyle']);
}

$styleNumber = mysql_real_escape_string("LIKE '%'");
if (isset($_GET['styleNumber'])) {
  $styleNumber = mysql_real_escape_string("=".$_GET['styleNumber']);
}

mysql_select_db($database_brewing, $brewing);
$query_styles = sprintf("SELECT * FROM styles WHERE %s %s ORDER BY %s %s", $filterStyle, $styleNumber, $sort, $dir);
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
}

// ------------------------------- Hops -------------------------------
if ($section == "hops") { 

$filterHopsCategory = "hopsName";
if (isset($_GET['filterHopsCategory'])) {
  $filterHopsCategory = ($_GET['filterHopsCategory']);
}

$filterHopsFeature = "LIKE '%'";
if (isset($_GET['filterHopsFeature'])) {
  $filterHopsFeature = mysql_real_escape_string("LIKE '%".$_GET['filterHopsFeature']."%'");
}

$sortHops = "hopsName";
if (isset($_GET['sortHops'])) {
  $sortHops = ($_GET['sortHops']);
}

$dirHops = "ASC";
if (isset($_GET['dirHops'])) {
  $dirHops = ($_GET['dirHops']);
}

mysql_select_db($database_brewing, $brewing);
$query_styles = sprintf("SELECT * FROM hops WHERE %s %s ORDER BY %s %s", $filterHopsCategory, $filterHopsFeature, $sortHops, $dirHops);
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
}

// ------------------------------- Grains -------------------------------
if ($section == "grains") {
$filterMaltCategory = "maltName";
if (isset($_GET['filterMaltCategory'])) {
  $filterMaltCategory = ($_GET['filterMaltCategory']);
}

$filterMaltFeature = mysql_real_escape_string("LIKE '%'");
if (isset($_GET['filterMaltFeature'])) {
  $filterMaltFeature = mysql_real_escape_string("LIKE '%".$_GET['filterMaltFeature']."%'");
}

mysql_select_db($database_brewing, $brewing);
$query_grains = sprintf("SELECT * FROM malt WHERE %s %s ORDER BY maltName ASC", $filterMaltCategory, $filterMaltFeature);
$grains = mysql_query($query_grains, $brewing) or die(mysql_error());
$row_grains = mysql_fetch_assoc($grains);
$totalRows_grains = mysql_num_rows($grains);
}

// ------------------------------- Yeast -------------------------------
if ($section == "yeast") {

$yeastLab = "default";
if (isset($_GET['yeastLab'])) { $yeastLab = mysql_real_escape_string("LIKE '%".$_GET['yeastLab']."%'"); }

$yeastType  = "default";
if (isset($_GET['yeastType'])) { $yeastType = ($_GET['yeastType']); }

mysql_select_db($database_brewing, $brewing);
$query_yeast = "SELECT * FROM yeast_profiles";
if ($yeastLab != "default") $query_yeast .= " WHERE yeastLab $yeastLab";
if ($yeastType != "default") $query_yeast .= " WHERE yeastType='$yeastType'";
$query_yeast .= " ORDER BY yeastLab, yeastName";
$yeast = mysql_query($query_yeast, $brewing) or die(mysql_error());
$row_yeast = mysql_fetch_assoc($yeast);
$totalRows_yeast = mysql_num_rows($yeast);

}


if ($source != "reference") { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>BrewBlog Reference</title>
<link href="../css/universal_elements.css" rel="stylesheet" type="text/css">
<link href="../css/html_elements.css" rel="stylesheet" type="text/css">
<link href="../css/reference.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php } ?>
<script language="javascript">
<!-- 
function jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//--> 
</script>
<?php if ($source == "reference") { ?>
<table>
	<tr>
    <td class="dataLabelLeft">Choose:</td>
    	<td class="data">
     	<form name="form" id="form">
  	 	<select name="referenceMenu" onchange="jumpMenu('parent',this,0)">
     	<option value="?page=reference"></option>
    	<option value="?page=reference&section=styles" <?php if ($section == "styles") echo "SELECTED"; ?>>BJCP Style Information</option>
    	<option value="?page=reference&section=carbonation" <?php if ($section == "carbonation") echo "SELECTED"; ?>>Carbonation Chart</option>
    	<option value="?page=reference&section=color" <?php if ($section == "color") echo "SELECTED"; ?>>Color Chart</option>
        <option value="?page=reference&section=hops" <?php if ($section == "hops") echo "SELECTED"; ?>>Hops</option>
    	<option value="?page=reference&section=grains" <?php if ($section == "grains") echo "SELECTED"; ?>>Malts and Grains</option>
    	<option value="?page=reference&section=yeast" <?php if ($section == "yeast") echo "SELECTED"; ?>>Yeast</option>
  	 	</select>
		</form>
		</td>
    </tr>
</table>
<br>
<?php } ?>
<?php if ($section == "styles") { ?>
<table class="<?php if ($source =="reference") echo "dataTable"; else echo "referenceTop"; ?>">
	<td class="dataLabelLeft">Sort By:</td>
	<td class="data" colspan="2">
		Name&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyle&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyle&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
		Category&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleGroup,brewStyleNum&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleGroup,brewStyleNum&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
		OG&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleOG&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleOG&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
		FG&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleFG&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleFG&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
        ABV&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleABV&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleABV&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
		Bitterness&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleIBU&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleIBU&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
		Color&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleSRM&dir=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&sort=brewStyleSRM&dir=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a>&nbsp;
	</td>
  </tr>
  <tr>
  <td colspan="3">OR</td>
  </tr>
  <tr> 
  <td class="dataLabelLeft">Filter By:</td>
  <td class="data" width="5%" nowrap>Style Name</td>
  <td class="data"><form name="form2" method="post" action="">
          	<select name="styleMenu" onChange="jumpMenu('self',this,0)" class="left">
		  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles">All</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=01" <?php if ($styleNumber == "=01") echo "SELECTED"; ?>>Light Lager</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=02" <?php if ($styleNumber == "=02") echo "SELECTED"; ?>>Pilsner</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=03" <?php if ($styleNumber == "=03") echo "SELECTED"; ?>>European Amber Lager</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=04" <?php if ($styleNumber == "=04") echo "SELECTED"; ?>>Dark Lager</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=05" <?php if ($styleNumber == "=05") echo "SELECTED"; ?>>Bock</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=06" <?php if ($styleNumber == "=06") echo "SELECTED"; ?>>Light Hybrid Beer</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=07" <?php if ($styleNumber == "=07") echo "SELECTED"; ?>>Amber Hybrid Beer</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=08" <?php if ($styleNumber == "=08") echo "SELECTED"; ?>>English Pale Ale</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=09" <?php if ($styleNumber == "=09") echo "SELECTED"; ?>>Scottish and Irish Ale</option>
          	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=10" <?php if ($styleNumber == "=10") echo "SELECTED"; ?>>American Ale</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=11" <?php if ($styleNumber == "=11") echo "SELECTED"; ?>>English Brown Ale</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=12" <?php if ($styleNumber == "=12") echo "SELECTED"; ?>>Porter</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=13" <?php if ($styleNumber == "=13") echo "SELECTED"; ?>>Stout</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=14" <?php if ($styleNumber == "=14") echo "SELECTED"; ?>>India Pale Ale (IPA)</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=15" <?php if ($styleNumber == "=15") echo "SELECTED"; ?>>German Wheat and Rye Beer</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=16" <?php if ($styleNumber == "=16") echo "SELECTED"; ?>>Belgian and French Ale</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=17" <?php if ($styleNumber == "=17") echo "SELECTED"; ?>>Sour Ale</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=18" <?php if ($styleNumber == "=18") echo "SELECTED"; ?>>Belgian Strong Ale</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=19" <?php if ($styleNumber == "=19") echo "SELECTED"; ?>>Strong Ale</option>
          	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=20" <?php if ($styleNumber == "=20") echo "SELECTED"; ?>>Fruit Beer</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=21" <?php if ($styleNumber == "=21") echo "SELECTED"; ?>>Spice/Herb/Vegetable Beer</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=22" <?php if ($styleNumber == "=22") echo "SELECTED"; ?>>Smoke-Flavored and Wood-Aged Beer</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=23" <?php if ($styleNumber == "=23") echo "SELECTED"; ?>>Specialty Beer</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=24" <?php if ($styleNumber == "=24") echo "SELECTED"; ?>>Traditional Mead</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=25" <?php if ($styleNumber == "=25") echo "SELECTED"; ?>>Melomel (Fruit Mead)</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=26" <?php if ($styleNumber == "=26") echo "SELECTED"; ?>>Other Mead</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=27" <?php if ($styleNumber == "=27") echo "SELECTED"; ?>>Standard Cider and Perry</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=styles&filterStyle=brewStyleGroup&styleNumber=28" <?php if ($styleNumber == "=28") echo "SELECTED"; ?>>Specialty Cider and Perry</option>
			</select>
		</form>
		</td>
	  </tr>
    </table>
<div id="wideWrapperReference">
<?php do { if ($source == "reference") include ('reference/styles.inc.php'); else include ('../reference/styles.inc.php'); } while ($row_styles = mysql_fetch_assoc($styles)); ?>
</div>
<?php } ?>
	
<?php if ($section == "color") { ?>
<div id="wideWrapperReference">
<?php if ($source == "reference") include ('reference/color.inc.php'); else include ('../reference/color.inc.php'); ?>
</div>	
<?php } ?>
	
<?php if ($section == "hops") { ?>
<table class="<?php if ($source =="reference") echo "dataTable"; else echo "referenceTop"; ?>">
<form name="form1" method="post" action="">
  <tr>
    <td class="dataLabelLeft" width="5%">Sort By:</td>
    <td class="data">AA&nbsp;<a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&sortHops=hopsAAULow&dirHops=ASC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&sortHops=hopsAAULow&dirHops=DESC"><img src="<?php if ($page != "reference") echo "../"; ?>images/sort_down.gif" border="0" alt="Sort Descending"></a></td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
  <td colspan="6">OR</td>
  </tr>
  <tr>
    <td width="5%" class="dataLabelLeft">Filter By:</td>
    <td class="data" width="5%" nowrap>Region:</td>
	<td width="5%" class="data">
  	<select name="hopsMenu" onChange="jumpMenu('self',this,0)" class="text_area">
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops">All</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=aus" <?php if ($filterHopsFeature == "LIKE '%aus%'") echo "SELECTED"; ?>>Australia</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=can" <?php if ($filterHopsFeature == "LIKE '%can%'") echo "SELECTED"; ?>>Canada</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=czech" <?php if ($filterHopsFeature == "LIKE '%czech%'") echo "SELECTED"; ?>>Czechoslovakia</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=germany" <?php if ($filterHopsFeature == "LIKE '%germany%'") echo "SELECTED"; ?>>Germany</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=zealand" <?php if ($filterHopsFeature == "LIKE '%zealand%'") echo "SELECTED"; ?>>New Zealand</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=poland" <?php if ($filterHopsFeature == "LIKE '%poland%'") echo "SELECTED"; ?>>Poland</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=states" <?php if ($filterHopsFeature == "LIKE '%states%'") echo "SELECTED"; ?>>United States</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=kingdom" <?php if ($filterHopsFeature == "LIKE '%kingdom%'") echo "SELECTED"; ?>>United Kingdom</option>
	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsGrown&filterHopsFeature=yugo" <?php if ($filterHopsFeature == "LIKE '%yugo%'") echo "SELECTED"; ?>>Yugoslavia</option>
  	</select>	</td>
    <td class="data" width="5%" nowrap>OR</td>
	<td class="data" width="5%" nowrap>Typical Use:</td>
	<td class="data">
	<select name="hopsMenu2" onChange="jumpMenu('self',this,0)" class="text_area">
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops">All</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsUse&filterHopsFeature=bitter" <?php if ($filterHopsFeature == "LIKE '%bitter%'") echo "SELECTED"; ?>>Bittering</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsUse&filterHopsFeature=flavor" <?php if ($filterHopsFeature == "LIKE '%flavor%'") echo "SELECTED"; ?>>Flavor</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsUse&filterHopsFeature=finish" <?php if ($filterHopsFeature == "LIKE '%finish%'") echo "SELECTED"; ?>>Finishing</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsUse&filterHopsFeature=aroma" <?php if ($filterHopsFeature == "LIKE '%aroma%'") echo "SELECTED"; ?>>Aroma</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=hops&filterHopsCategory=hopsUse&filterHopsFeature=dry" <?php if ($filterHopsFeature == "LIKE '%dry%'") echo "SELECTED"; ?>>Dry Hopping</option>
	</select>  
	</td>
  </tr>
</form>
</table>
<div id="wideWrapperReference">
<?php do { if ($source == "reference") include ('reference/hops.inc.php'); else include ('../reference/hops.inc.php'); } while ($row_styles = mysql_fetch_assoc($styles)); ?>
</div>	
	
<?php } ?>

<?php if ($section == "carbonation") { ?>
<p>Due to readability, the carbonation chart is housed in a pop-up window. To view, enable Javascript, adjust your browser's settings to allow this site to display pop-up windows, and then <?php if ($printBrowser == "IE") { ?><a href="#" onclick="window.open('reference/carbonation.php','','height=600,width=900, scrollbars=yes, toolbar=yes, resizable=yes, menubar=yes'); return false;"><?php } else { ?><a href="reference/carbonation.php?KeepThis=true&TB_iframe=true&height=550&width=900" class="thickbox" title="Carbonation Chart"><?php } ?>click here</a> to view the chart.
<?php } ?>

<?php if ($section == "grains") { ?>
<form name="form3" method="post" action="">
<table class="<?php if ($source =="reference") echo "dataTable"; else echo "referenceTop"; ?>">
  <tr>
	<td width="5%" class="dataLabelLeft">Filter By:</td>
    <td width="5%" class="data">Origin</td>
<td class="data">
          	<select name="grainsMenu" onChange="jumpMenu('self',this,0)" class="text_area">
		  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains">All</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltName&filterMaltFeature=belg" <?php if ($filterMaltFeature == "LIKE '%belg%'") echo "SELECTED"; ?>>Belgium</option>
			<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltName&filterMaltFeature=germ" <?php if ($filterMaltFeature == "LIKE '%germ%'") echo "SELECTED"; ?>>Germany</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltName&filterMaltFeature=scot" <?php if ($filterMaltFeature == "LIKE '%scot%'") echo "SELECTED"; ?>>Scotland</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltName&filterMaltFeature=amer" <?php if ($filterMaltFeature == "LIKE '%amer%'") echo "SELECTED"; ?>>United States</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltName&filterMaltFeature=brit" <?php if ($filterMaltFeature == "LIKE '%brit%'") echo "SELECTED"; ?>>Britain</option>
          	</select>
     </td>
	 <td width="5%" class="data">OR</td>
	 <td width="5%" nowrap class="dataLeft">Typical Use</td>
<td width="75%" class="data">
  	  <select name="grainsMenu2" onChange="jumpMenu('self',this,0)" class="text_area">
		  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains">All</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltCategory&filterMaltFeature=1" <?php if ($filterMaltFeature == "LIKE '%1%'") echo "SELECTED"; ?>>Base Malt</option>
            <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=grains&filterMaltCategory=maltCategory&filterMaltFeature=2" <?php if ($filterMaltFeature == "LIKE '%2%'") echo "SELECTED"; ?>>Specialty Malt</option>
			</select>   
	  </td>
   </tr>
</table>
</form>
<div id="wideWrapperReference">
<?php do { if ($source == "reference") include ('reference/grains.inc.php'); else include ('../reference/grains.inc.php'); } while ($row_grains = mysql_fetch_assoc($grains)); ?>
</div>		
<?php } ?>



<?php if ($section == "yeast") { ?>
<form name="form3" method="post" action="">
<table class="<?php if ($source =="reference") echo "dataTable"; else echo "referenceTop"; ?>">
<tr>
    <td width="5%" class="dataLabelLeft">Filter By:</td>
    <td class="data" width="5%" nowrap>Lab:</td>
	<td width="5%" class="data">
  	<select name="yeastMenu" onChange="jumpMenu('self',this,0)" class="text_area">
  		<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast">All</option>
       	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Brewferm" <?php if ($yeastLab == "LIKE '%Brewferm%'") echo "SELECTED"; ?>>Brewferm</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Brewtek" <?php if ($yeastLab == "LIKE '%Brewtek%'") echo "SELECTED"; ?>>Brewtek</option>
  		<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Coopers" <?php if ($yeastLab == "LIKE '%Coopers%'") echo "SELECTED"; ?>>Coopers</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Dan" <?php if ($yeastLab == "LIKE '%Dan%'") echo "SELECTED"; ?>>Danstar</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Fermentis" <?php if ($yeastLab == "LIKE '%Fermentis%'") echo "SELECTED"; ?>>Fermentis</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Danstar" <?php if ($yeastLab == "LIKE '%Danstar%'") echo "SELECTED"; ?>>Danstar</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Doric" <?php if ($yeastLab == "LIKE '%Doric%'") echo "SELECTED"; ?>>Doric</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Lallemand" <?php if ($yeastLab == "LIKE '%Lallemand%'") echo "SELECTED"; ?>>Lallemand</option>
        <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Munton" <?php if ($yeastLab == "LIKE '%Munton%'") echo "SELECTED"; ?>>Munton-Fison</option>
		<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Red" <?php if ($yeastLab == "LIKE '%Red%'") echo "SELECTED"; ?>>Red Star</option>
		<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=White" <?php if ($yeastLab == "LIKE '%White%'") echo "SELECTED"; ?>>White Labs</option>
		<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastLab=Wyeast" <?php if ($yeastLab == "LIKE '%Wyeast%'") echo "SELECTED"; ?>>Wyeast</option>
    </select>	
    </td>
    <td class="data" width="5%" nowrap>OR</td>
	<td class="data" width="5%" nowrap>Typical Use:</td>
	<td class="data">
	<select name="hopsMenu2" onChange="jumpMenu('self',this,0)" class="text_area">
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast">All</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastType=Ale" <?php if ($yeastType == "Ale") echo "SELECTED"; ?>>Ale</option>
  	<option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastType=Lager" <?php if ($yeastType == "Lager") echo "SELECTED"; ?>>Lager</option>
    <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastType=Wheat" <?php if ($yeastType == "Wheat") echo "SELECTED"; ?>>Wheat</option>
    <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastType=Wine" <?php if ($yeastType == "Wine") echo "SELECTED"; ?>>Wine</option>
    <option value="?<?php if ($source == "reference") echo "page=reference&"; ?>source=<?php echo $source; ?>&section=yeast&yeastType=Champagne" <?php if ($yeastType == "Champagne") echo "SELECTED"; ?>>Champagne</option>
    </select>  
	</td>
</tr>
</table>
</form>
<div id="wideWrapperReference">
<?php do { if ($source == "reference") include ('reference/yeast.inc.php'); else include ('../reference/yeast.inc.php'); } while ($row_yeast = mysql_fetch_assoc($yeast)); ?>
</div>		
<?php } ?>
<?php 
if ($source == "reference") {
?>
<div class="calcNav">
<p><?php if ($section == "styles") echo "<strong>BJCP Style Information</strong>"; else echo "<a href=\"?page=reference&section=styles\">BJCP Style Information</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "carbonation") echo "<strong>Carbonation Chart</strong>"; else echo "<a href=\"?page=reference&section=carbonation\">Carbonation Chart</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "color") echo "<strong>Color Chart</strong>"; else echo "<a href=\"?page=reference&section=color\">Color Chart</a>";?>&nbsp;|&nbsp;<?php if ($section == "hops") echo "<strong>Hops</strong>"; else echo "<a href=\"?page=reference&section=hops\">Hops</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "grains") echo "<strong>Malts and Grains</strong>"; else echo "<a href=\"?page=reference&section=grains\">Malts and Grains</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "yeast") echo "<strong>Yeast</strong>"; else echo "<a href=\"?page=reference&section=yeast\">Yeast</a>"; ?><p>
</div>
<?php }
if ($source != "reference") { include ('../includes/footer2.inc.php'); ?>
</body>
</html>
<?php } ?>