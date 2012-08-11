<?php
$source = "reference";
if (isset($_GET['source'])) {
  $source = (get_magic_quotes_gpc()) ? $_GET['source'] : addslashes($_GET['source']);
}

if ($source != "reference") { 
require ('../paths.php');
require_once (CONFIG.'config.php'); 
require_once (ADMIN_LIBRARY.'color.lib.php');
include (INCLUDES.'url_variables.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');  
include (INCLUDES.'functions.inc.php'); 
$imageSrc = "../images/"; 
//echo (REFERENCE.'color.inc.php');
}

// ------------------------------- Styles -------------------------------
if ($section == "styles") { 
mysql_select_db($database_brewing, $brewing);
$query_styles = "SELECT * FROM styles ORDER BY brewStyleGroup,brewStyleNum ASC";
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
}

// ------------------------------- Hops -------------------------------
if ($section == "hops") { 
mysql_select_db($database_brewing, $brewing);
$query_styles = "SELECT * FROM hops ORDER BY hopsName ASC";
$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
$row_styles = mysql_fetch_assoc($styles);
$totalRows_styles = mysql_num_rows($styles);
}

// ------------------------------- Grains -------------------------------
if ($section == "grains") {
mysql_select_db($database_brewing, $brewing);
$query_grains = "SELECT * FROM malt ORDER BY maltName ASC";
$grains = mysql_query($query_grains, $brewing) or die(mysql_error());
$row_grains = mysql_fetch_assoc($grains);
$totalRows_grains = mysql_num_rows($grains);
}

// ------------------------------- Yeast -------------------------------
if ($section == "yeast") {
mysql_select_db($database_brewing, $brewing);
$query_yeast = "SELECT * FROM yeast_profiles ORDER BY yeastLab,yeastName";
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
<?php if ($source == "reference") { ?>
<script language="javascript">
<!-- 
function jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//--> 
</script>
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
<?php if ($section == "carbonation") { ?>
<p>Due to readability, the carbonation chart is housed in a pop-up window. To view, enable Javascript, adjust your browser's settings to allow this site to display pop-up windows, and then <?php if ($printBrowser == "IE") { ?><a href="#" onclick="window.open('reference/carbonation.php','','height=600,width=900, scrollbars=yes, toolbar=yes, resizable=yes, menubar=yes'); return false;"><?php } else { ?><a href="reference/carbonation.php?KeepThis=true&TB_iframe=true&height=550&width=900" class="thickbox" title="Carbonation Chart"><?php } ?>click here</a> to view the chart.
<?php } ?>
<div id="wideWrapperReference">
<?php if ($section == "styles") { do { include (REFERENCE.'styles.inc.php'); } while ($row_styles = mysql_fetch_assoc($styles)); } ?>	
<?php if ($section == "color") include (REFERENCE.'color.inc.php'); ?>	
<?php if ($section == "hops") { do { include (REFERENCE.'hops.inc.php'); } while ($row_styles = mysql_fetch_assoc($styles)); } ?>
<?php if ($section == "grains") { do { include (REFERENCE.'grains.inc.php'); } while ($row_grains = mysql_fetch_assoc($grains)); } ?>
<?php if ($section == "yeast") { do { include (REFERENCE.'yeast.inc.php'); } while ($row_yeast = mysql_fetch_assoc($yeast)); } ?>
</div>
<?php if ($source == "reference") { ?>
<div class="calcNav">
	<p><?php if ($section == "styles") echo "<strong>BJCP Style Information</strong>"; else echo "<a href=\"?page=reference&section=styles\">BJCP Style Information</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "carbonation") echo "<strong>Carbonation Chart</strong>"; else echo "<a href=\"?page=reference&section=carbonation\">Carbonation Chart</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "color") echo "<strong>Color Chart</strong>"; else echo "<a href=\"?page=reference&section=color\">Color Chart</a>";?>&nbsp;|&nbsp;<?php if ($section == "hops") echo "<strong>Hops</strong>"; else echo "<a href=\"?page=reference&section=hops\">Hops</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "grains") echo "<strong>Malts and Grains</strong>"; else echo "<a href=\"?page=reference&section=grains\">Malts and Grains</a>"; ?>&nbsp;|&nbsp;<?php if ($section == "yeast") echo "<strong>Yeast</strong>"; else echo "<a href=\"?page=reference&section=yeast\">Yeast</a>"; ?><p>
</div>
</body>
</html>
<?php }
if ($source != "reference") include (INCLUDES.'footer2.inc.php'); ?>