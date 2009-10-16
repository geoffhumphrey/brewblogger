<?php 
// --------------------------- Globals ------------------------------------------------ //
$page = "admin";
$imageSrc = "../images/";
require ('../Connections/config.php');
require ('../includes/authentication.inc.php'); session_start(); sessionAuthenticate();
include ('../includes/check_mobile.inc.php');
include ('../includes/db_connect_universal.inc.php');
include ('../includes/db_connect_admin.inc.php');
include ('../includes/plug-ins.inc.php'); 
include ('../includes/version.inc.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" /> 
<?php 
include ('includes/formCheck.inc.php'); 
if ($page == "delWithCon") echo "<meta http-equiv=\"refresh\" content=\"0\">"; //cached page work-around
?>
<title><?php if ($row_pref['mode'] == "1") echo "BrewBlog Administration"; if ($row_pref['mode'] == "2")  echo $row_name['brewerFirstName']." ".$row_name['brewerLogName']." Administration"; ?></title>
<link rel="stylesheet" href="../css/html_elements.css" type="text/css">
<link rel="stylesheet" href="../css/universal_elements.css" type="text/css">
<?php if (checkmobile()) { ?>
<link rel="stylesheet" type="text/css" href="../css/mobile.css">
<?php } else { ?>
<link href="../css/<?php echo $row_pref['theme']; ?>" rel="stylesheet" type="text/css">
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
<body <?php include ('includes/focus.inc.php'); ?>>
<div id="maincontainer">
	<div id="header">
		<div class="titleText"><?php if ($row_name['brewerFirstName'] != "") echo $row_name['brewerFirstName'];  if (($row_pref['mode'] == "1") && ($row_name['brewerFirstName'] != ""))  echo "'s"; echo "&nbsp;".$row_name['brewerLogName']; ?></div><div class="quoteText"><?php echo $row_name['brewerTagline']; ?></div>
	</div>
	<div id="nav"><?php include ('includes/admin_nav.inc.php'); ?></div>
	<div id="contentwrapper">
		<div id="contentWide">
		<?php  
		if ($action == "default") 								include ('admin_sections/main.admin.php'); 
		if ($action == "list") 									include ('admin_sections/list.admin.php');
		if (($action == "view") && ($dbTable == "mash_steps")) 	include ('admin_sections/add.admin.php');
		if ($action == "chooseRecalc") 							include ('admin_sections/choose_recalc.admin.php'); 
		if ($action == "exportSQL") 							include ('includes/sql_download.inc.php'); 
		if ($action == "calculate")								include ('tools/recipe_calculator.php');  
		if (($action == "view") && ($dbTable == "news")) 		include ('admin_sections/news_view.admin.php');
		if ($action == "importXML") 							include ('includes/upload_xml.inc.php');
		if ($action == "upload") 								include ('includes/upload_image.inc.php');
		if 
		(
		($action == "add") || 
		($action == "edit") || 
		($action == "importCalc") || 
		($action == "reuse") || 
		($action == "importRecipe") || 
		($action == "import")
		) 
		include ('admin_sections/add.admin.php');
		?>
		</div>
	</div>
	<div id="footer"><?php include ('../includes/footer.inc.php'); ?></div>
</div>
</body>
</html>

