<?php 
// --------------------------- Globals ------------------------------------------------ //
$page = "admin";
$imageSrc = "../images/";
require ('../paths.php');
require_once (CONFIG.'config.php'); 
require (INCLUDES.'authentication.inc.php'); session_start(); sessionAuthenticate();
include (INCLUDES.'check_mobile.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');
include (INCLUDES.'db_connect_admin.inc.php');
include (INCLUDES.'plug-ins.inc.php'); 
include (INCLUDES.'version.inc.php');
include_once (ADMIN_INCLUDES.'constants.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" /> 
<?php 
include 'includes/formCheck.inc.php'; 
if ($page == "delWithCon") echo "<meta http-equiv=\"refresh\" content=\"0\">"; //cached page work-around
?>
<title><?php if ($row_pref['mode'] == "1") echo "BrewBlog Administration"; if ($row_pref['mode'] == "2")  echo $row_name['brewerFirstName']." ".$row_name['brewerLogName']." Administration"; ?></title>
<link rel="stylesheet" href="../css/html_elements.css" type="text/css">
<link rel="stylesheet" href="../css/universal_elements.css" type="text/css">
<?php if (checkmobile()) { ?>
<link rel="stylesheet" type="text/css" href="../css/mobile.css">
<?php } else { ?>
<link href="../css/<?php echo $row_pref['theme']; ?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js_includes/menu.js"></script>
<script type="text/javascript" src="../js_includes/jquery.js"></script>
<script type="text/javascript" src="../js_includes/thickbox.js"></script>
<link rel="stylesheet" type="text/css" href="../css/thickbox.css" media="screen">
<?php } 
if (($action == "edit") || ($action == "add") || ($action == "import") || ($action == "importRecipe") || ($action == "importCalc") || ($action == "reuse")) { ?>
<script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="js_includes/tinymce_config<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "2")) echo "_non"; ?>.js"></script>
<?php } ?>
<script language="javascript" type="text/javascript" src="js_includes/delete.js"></script>
</head>
<body <?php include (ADMIN_INCLUDES.'focus.inc.php'); ?>>
<div id="maincontainer">
	<div id="header">
		<div class="titleText"><?php if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName'];  if (($row_pref['mode'] == "1") && ($row_name['brewerFirstName'] != ""))  echo "'s"; echo "&nbsp;".$row_name['brewerLogName']; ?></div><div class="quoteText"><?php echo $row_name['brewerTagline']; ?></div>
	</div>
	<div id="nav"><?php include (ADMIN_INCLUDES.'admin_nav.inc.php'); ?></div>
	<div id="contentwrapper">
		<div id="contentWide">
		<?php  
		if ($action == "default") 								include (ADMIN_SECTIONS.'main.admin.php'); 
		if ($action == "list") 									include (ADMIN_SECTIONS.'list.admin.php');
		if (($action == "view") && ($dbTable == "mash_steps")) 	include (ADMIN_SECTIONS.'add.admin.php');
		if ($action == "chooseRecalc") 							include (ADMIN_SECTIONS.'choose_recalc.admin.php'); 
		if ($action == "exportSQL") 							include (ADMIN_INCLUDES.'sql_download.inc.php'); 
		if ($action == "calculate")								include (ADMIN_TOOLS.'recipe_calculator.php');  
		if (($action == "view") && ($dbTable == "news")) 		include (ADMIN_SECTIONS.'news_view.admin.php');
		if ($action == "importXML") 							include (ADMIN_INCLUDES.'upload_xml.inc.php');
		if ($action == "upload") 								include (ADMIN_INCLUDES.'upload_image.inc.php');
		if 
		(
		($action == "add") || 
		($action == "edit") || 
		($action == "importCalc") || 
		($action == "reuse") || 
		($action == "importRecipe") || 
		($action == "import")
		) 
		include (ADMIN_SECTIONS.'add.admin.php');
		?>
		</div>
	</div>
	<div id="footer"><?php include (INCLUDES.'footer.inc.php'); ?></div>
</div>
</body>
</html>

