<?php
require_once('../../Connections/config.php');
include ('../../includes/check_mobile.inc.php');
include ('../../includes/url_variables.inc.php');
include ('../../includes/db_connect_log.inc.php');
include ('../../includes/url_variables.inc.php');
include ('../../includes/db_connect_universal.inc.php'); 
include ('../../includes/plug-ins.inc.php'); 

$page = "icons";
$imageSrc = "../../images/";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Administration Icon Reference</title>
<link href="../../css/reference.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wideWrapperReference">
  <div id="referenceHeader">Icons: <?php echo $dbName; ?> List</div>
  <table>
       
	   <?php if (($dbTable == "brewing") || ($dbTable == "recipes") || ($dbTable == "upcoming") || ($dbTable == "awards") || ($dbTable == "reviews") || ($dbTable == "mash_profiles")) { ?>
	   <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>monitor.png" align="absmiddle" border="0" alt="View"></td>
		 <td class="data">View.  Action will take you to the selected <?php echo $msgName; ?>'s display page.</td>
    </tr>
	   <?php } ?>
       <?php if (($dbTable == "brewing") || ($dbTable == "recipes") || ($dbTable == "equip_profiles") || ($dbTable == "water_profiles") || ($dbTable == "mash_profiles") || ($dbTable == "yeast_profiles")) { ?>
	   <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>page_refresh.png" align="absmiddle" border="0" alt="Reuse"></td>
		 <td class="data"><?php if ($dbTable == "brewing") echo "Re-Use"; else echo "Copy"; ?>.  Action will copy the vital information into a new <?php echo $msgName; ?>.</td>
	   </tr>
	   <?php } ?>
       <?php if (($dbTable == "brewing") || ($dbTable == "recipes")) { ?>
       <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>page_lightning.png" align="absmiddle" border="0" alt="Import"></td>
		 <td class="data">Import.  Action will copy the selected <?php echo $msgName; ?> into a new <?php if ($dbTable == "brewing") echo "recipe"; else echo "log"; ?>.</td>
	   </tr>
       <?php } ?>
       <?php if ($dbTable == "mash_profiles") { ?>
       <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>add.png" align="absmiddle" border="0" alt="Add"></td>
		 <td class="data">Add. Function will allow you to add a mash step to the selected profile.</td>
	   </tr>
       <?php } ?>
       <?php if ($dbTable == "users") { ?>
       <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>key.png" align="absmiddle" border="0" alt="Password"></td>
		 <td class="data">Change the selected user's password.</td>
	   </tr>
       <?php } ?>
	   <tr>
	     <td class="dataLeft" width="20px"><img src="<?php echo $imageSrc; ?>pencil.png" align="absmiddle" border="0" alt="Edit"></td>
		 <td class="data">Edit.  Action will take you to the selected <?php echo $msgName; ?>'s record to make changes.</td>
    </tr>
	   <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>bin_closed.png" align="absmiddle" border="0" alt="Delete"></td>
		 <td class="data">Delete.  Action will permanently delete the selected <?php echo $msgName; ?> from the database.  Data will not be recoverable.</td>
    </tr>
	   <?php if (($dbTable == "brewing") || ($dbTable == "recipes")) { ?>
	   
	   <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>calculator.png" alt="Recalculate Icon" border="0"></td>
	     <td class="data">Recalculate.  Action will load the selected <?php echo $msgName; ?> into the BrewBlogger recipe calculator.</td>
       </tr>
       <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>medal_gold_3.png" align="absmiddle" border="0" alt="Award/Competition Entry"></td>
		 <td class="data">Add an award or competition entry for the selected <?php echo $msgName; ?>.</td>
	   </tr>
       <?php if (($dbTable == "brewing") || ($dbTable == "recipes")) { ?>
       <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>page_code.png" align="absmiddle" border="0" alt="Export BeerXML"></td>
		 <td class="data">Export a BeerXML file for the selected <?php echo $msgName; ?>.</td>
	   </tr>
       <?php } ?>
	   <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>printer.png" align="absmiddle" border="0" alt="Print"></td>
		 <td class="data">Print.  Action will pop-up the print function for the selected <?php echo $msgName; ?>.</td>
	   </tr>
       <?php if ($dbTable == "brewing") { ?>
	   <tr>
	     <td class="dataLeft"><img src="<?php echo $imageSrc; ?>award_star_add.png" align="absmiddle" border="0" alt="Print"></td>
		 <td class="data">Print a competition entry form.  Action will pop-up the print competition entry function for the selected <?php echo $msgName; ?>.</td>
	   </tr>
       <?php } ?>
	   <?php } ?>
  </table>
<p>Icons are from the <em><a href="http://www.famfamfam.com/lab/icons/silk/" target="_blank">Silk</a></em> collection provided by FamFamFam under the <a href="http://creativecommons.org/licenses/by/2.5/" target="_blank">Creative Commons Attribution License 2.5</a>.</p>
<?php include ('../../includes/footer2.inc.php'); ?>
</div>
</body>
</html>