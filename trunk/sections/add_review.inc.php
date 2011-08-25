<?php 
require ('../paths.php');
require_once (CONFIG.'config.php'); 
include ('../includes/url_variables.inc.php');
$currentPage = $_SERVER["PHP_SELF"]; 
$imageSrc = "../images/";
$page = "reviews";
	if (isset($_GET['page'])) {
  	$page = (get_magic_quotes_gpc()) ? $_GET['page'] : addslashes($_GET['page']);
	}
if ($page == "reviews") {
	
mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT id,brewName FROM brewing WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);

if ($action == "add") {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$insertSQL = sprintf("INSERT INTO reviews (brewID, brewScoreDate, brewAromaScore, brewAromaInfo, brewAppearanceScore, brewAppearanceInfo, brewFlavorScore, brewFlavorInfo, brewMouthfeelScore, brewMouthfeelInfo, brewOverallScore, brewOverallInfo, brewScorerLevel, brewScoredBy) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($id, "int"),
                       GetSQLValueString($_POST['brewScoreDate'], "date"),
                       GetSQLValueString($_POST['brewAromaScore'], "int"),
                       GetSQLValueString($_POST['brewAromaInfo'], "text"),
                       GetSQLValueString($_POST['brewAppearanceScore'], "int"),
                       GetSQLValueString($_POST['brewAppearanceInfo'], "text"),
                       GetSQLValueString($_POST['brewFlavorScore'], "int"),
                       GetSQLValueString($_POST['brewFlavorInfo'], "text"),
                       GetSQLValueString($_POST['brewMouthfeelScore'], "int"),
                       GetSQLValueString($_POST['brewMouthfeelInfo'], "text"),
                       GetSQLValueString($_POST['brewOverallScore'], "int"),
                       GetSQLValueString($_POST['brewOverallInfo'], "text"),
					   GetSQLValueString($_POST['brewScorerLevel'], "text"),
                       GetSQLValueString($_POST['brewScoredBy'], "text"));

  mysql_select_db($database_brewing, $brewing);
  $Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());

  $insertGoTo = "add_review.inc.php?page=reviewsView&id=".$id;
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_brewing, $brewing);
$query_review = "SELECT * FROM reviews";
$review = mysql_query($query_review, $brewing) or die(mysql_error());
$row_review = mysql_fetch_assoc($review);
$totalRows_review = mysql_num_rows($review);

}

if ($page == "reviewsView") {

mysql_select_db($database_brewing, $brewing);
$query_log = sprintf("SELECT id,brewName FROM brewing WHERE id = '%s'", $id);
$log = mysql_query($query_log, $brewing) or die(mysql_error());
$row_log = mysql_fetch_assoc($log);
$totalRows_log = mysql_num_rows($log);

$query_review = sprintf("SELECT * FROM reviews WHERE brewID = '%s' ORDER BY brewScoreDate DESC, id DESC", $id);
$review = mysql_query($query_review, $brewing) or die(mysql_error());
$row_review = mysql_fetch_assoc($review);
$totalRows_review = mysql_num_rows($review);

}
include ('../includes/db_connect_universal.inc.php');
include ('../includes/check_mobile.inc.php');
include ('../includes/plug-ins.inc.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $page_title." for ".$row_log['brewName'] ?></title>
<link href="../css/html_elements.css" rel="stylesheet" type="text/css">
<link href="../css/universal_elements.css" rel="stylesheet" type="text/css">
<link href="../css/reference.css" rel="stylesheet" type="text/css">
<?php include ('../admin/includes/formCheck.inc.php'); ?>
</head>
<body>
<?php if ($page == "reviews") { ?>
<form action="[TURN JAVASCRIPT ON]" method="POST" name="form1" onSubmit="return CheckRequiredFields()">
<div id="wideWrapperReference">	
<div id="referenceHeader"><img src="<?php echo $imageSrc; ?>page_edit.png" align="absmiddle" border="0"><img src="<?php echo $imageSrc; ?>spacer.gif" width="5">Submit Your Tasting Review for <?php echo $row_log['brewName']; ?></div>
<table>
  <tr class="bknd_ultra_lt">
   <td class="dataLabelLeft">Scored By:</td>
   <td colspan="2" class="data"><input name="brewScoredBy" type="text" id="brewScoredBy" size="20" maxlength="100"></td>
   </tr>
  <tr>
    <td class="dataLabelLeft">Scorer Is:</td>
    <td colspan="2" class="data"><select class="text_area"  name="brewScorerLevel">
      <option value="The Brewer" <?php if (!(strcmp("The Brewer", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>The Brewer</option>
      <option value="Friend" <?php if (!(strcmp("Friend", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Friend</option>
      <option value="Relative" <?php if (!(strcmp("Relative", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Relative</option>
      <option value="Professional Brewer" <?php if (!(strcmp("Professional Brewer", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Professional Brewer</option>
      <option value="Experienced Judge [non-BJCP]" <?php if (!(strcmp("Experienced Judge [non-BJCP]", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Experienced Judge [non-BJCP]</option>
      <option value="BJCP Apprentice Judge" <?php if (!(strcmp("BJCP Apprentice Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Apprentice Judge</option>
      <option value="BJCP Recognized Judge" <?php if (!(strcmp("BJCP Recognized Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Recognized Judge</option>
      <option value="BJCP Certified Judge" <?php if (!(strcmp("BJCP Certified Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Certified Judge</option>
      <option value="BJCP National Judge" <?php if (!(strcmp("BJCP National Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP National Judge</option>
      <option value="BJCP Grand Master Judge" <?php if (!(strcmp("BJCP Grand Master Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Grand Master Judge</option>
      <option value="BJCP Honarary Master Judge" <?php if (!(strcmp("BJCP Honarary Master Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Honarary Master Judge</option>
      <option value="BJCP Honarary Grand Master Judge" <?php if (!(strcmp("BJCP Honarary Grand Master Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Honarary Grand Master Judge</option>
      </select>    
    </td>
  </tr>
  <?php if (((isset($_SESSION["loginUsername"])) && ($row_log['brewBrewerID'] == $loginUsername))) { ?>
  <tr>
    <td class="dataLabelLeft">Date Scored:</td>
    <td colspan="2" class="data"><input name="brewDateScored" type="text" value="<?php print date ( 'Y-m-d' ); ?>" /></td>
  </tr>
  <?php } ?>
  <tr class="bknd_ultra_lt">
   <td class="dataLabelLeft">Aroma Score:</td>
   <td colspan="2" class="data"><select class="text_area"  name="brewAromaScore">
     <option value="1">1</option>
     <option value="2">2</option>
     <option value="3">3</option>
     <option value="4">4</option>
     <option value="5">5</option>
     <option value="6">6</option>
     <option value="7">7</option>
     <option value="8">8</option>
     <option value="9">9</option>
     <option value="10">10</option>
     <option value="11">11</option>
     <option value="12">12</option>
     </select>&nbsp;/ 12   </td>
   </tr>
  
  <tr class="bknd_ultra_lt">
   <td class="dataLabelLeft">Aroma Comments:</td>
   <td class="data"><textarea name="brewAromaInfo" cols="50" rows="10" class="submit"></textarea></td>
   <td class="data">Comment on malt, hops, esters, and other aromatics.</td>
  </tr>
  
  <tr>
   <td class="dataLabelLeft">Appearance Score:</td>
   <td colspan="2" class="data"><select class="text_area"  name="brewAppearanceScore">
     <option value="1">1</option>
     <option value="2">2</option>
     <option value="3">3</option>
     </select>&nbsp;/ 3   </td>
   </tr>
  
  <tr>
   <td class="dataLabelLeft">Appearance Comments:</td>
   <td class="data"><textarea name="brewAppearanceInfo" cols="50" rows="10" class="submit"></textarea></td>
   <td class="data">Comment on color, clarity, and head (retention, color, and texture).</td>
  </tr>
  
  <tr class="bknd_ultra_lt">
   <td class="dataLabelLeft">Flavor Score:</td>
   <td colspan="2" class="data"><select class="text_area"  name="brewFlavorScore">
     <option value="1">1</option>
     <option value="2">2</option>
     <option value="3">3</option>
     <option value="4">4</option>
     <option value="5">5</option>
     <option value="6">6</option>
     <option value="7">7</option>
     <option value="8">8</option>
     <option value="9">9</option>
     <option value="10">10</option>
     <option value="11">11</option>
     <option value="12">12</option>
     <option value="13">13</option>
     <option value="14">14</option>
     <option value="15">15</option>
     <option value="16">16</option>
     <option value="17">17</option>
     <option value="18">18</option>
     <option value="19">19</option>
     <option value="20">20</option>
     </select>&nbsp;/ 20</td>
    </tr>
   <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft">Flavor Comments:</td>
    <td class="data"><textarea name="brewFlavorInfo" cols="50" rows="10" class="submit"></textarea></td>
    <td class="data">Comment on malt, hops, fermentation characteristics, balance, finish/aftertaste, and other flavor characteristics. </td>
   </tr>
   
   <tr>
    <td class="dataLabelLeft">Mouthfeel Score:</td>
    <td colspan="2" class="data"><select class="text_area"  name="brewMouthfeelScore">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      </select>&nbsp;/ 5</td>
    </tr>
   
   <tr>
    <td class="dataLabelLeft">Mouthfeel Comments:</td>
    <td class="data"><textarea name="brewMouthfeelInfo" cols="50" rows="10" class="submit"></textarea></td>
    <td class="data">Comment on body, carbonation, warmth, creaminess, astringency, and other palate sensations. </td>
   </tr>
   
   <tr class="bknd_ultra_lt">
    <td class="dataLabelLeft">Overall Impression:</td>
    <td colspan="2" class="data"><select class="text_area"  name="brewOverallScore">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      </select>&nbsp;/ 10</td>
      </tr>
	 
     <tr class="bknd_ultra_lt">
      <td class="dataLabelLeft">Overall Comments:</td>
      <td class="data"><textarea name="brewOverallInfo" cols="50" rows="10" class="submit"></textarea></td>
      <td class="data">Comment on overall drinking pleasure associated with the beer; give suggesions for improvement. </td>
     </tr>
	 <tr>
	  <td colspan="3"></td>
	 </tr>
</table>
<table class="dataTable">
<tr>
<td>
<input type="submit" class="radiobutton" value="Add Your Review" alt="Add Your Review">
</td>
</tr>
</table>
<input type="hidden" name="brewID" value="<?php echo $row_log['id']; ?>">
<input type="hidden" name="brewScoreDate" value="<?php print date ( 'Y-m-d' ); ?>">
<script type="text/javascript" language="JavaScript">
var url = "?page=reviews&action=add&id=<?php echo $id; ?>";
var formname = "form1";
var s = 'document.' + formname + '.action = "' + url + '";';
setTimeout('eval(s)',500);
//--></script>
</form>
</div>
<?php } ?>
<?php if ($page == "reviewsView") { ?>
<div id="wideWrapperReference">	
<div id="referenceHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>tick.png" align="absmiddle" border="0"></span><span class="data dk">Scores</span></div>
<table class="text_10 dataTable">
 <tr>
  <td class="dataLeft" width="1%"><img src="<?php echo $imageSrc; ?>star.png" align="absmiddle" border="0" /></td>
  <td class="data" width="10%" nowrap>45-50 = Outstanding</td>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>award_star_silver_2.png" align="absmiddle" border="0" /></td>
  <td class="data" width="10%" nowrap>30-37 = Very Good</td>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>bell.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>14-20 = Fair</td>
</tr>
<tr>
  <td class="dataLeft"><img src="<?php echo $imageSrc; ?>award_star_gold_2.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>38-44 = Excellent</td>
  <td class="data"><img src="<?php echo $imageSrc; ?>award_star_bronze_2.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>21-29 = Good</td>
  <td class="data"><img src="<?php echo $imageSrc; ?>emoticon_unhappy.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>00-13 = Problematic</td>
</tr>
</table>
<?php do { ?>
<?php include ('../includes/taste_calc.inc.php'); ?>
<div id="referenceHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>page_edit.png" align="absmiddle" border="0"></span><span class="data dk">Review by <?php echo $row_review['brewScoredBy'];  if ($row_review['brewScorerLevel'] != "") echo " (".$row_review['brewScorerLevel'].")"; ?></span></div>
<table class="dataTableAltColors">
      <tr>
        <td class="dataLabelLeft"  width="5%">Aroma: </td>
        <td class="data" width="5%" nowrap><?php echo $row_review['brewAromaScore']; ?> / 12 </td>
        <td class="data"><?php echo $row_review['brewAromaInfo']; ?></td>
      </tr>
      <tr class="bknd_ultra_lt">
        <td class="dataLabelLeft">Appearance:</td>
        <td class="data" nowrap><?php echo $row_review['brewAppearanceScore']; ?> / 3 </td>
        <td class="data"><?php echo $row_review['brewAppearanceInfo']; ?></td>
      </tr>
      <tr>
        <td class="dataLabelLeft">Flavor:</td>
        <td class="data" nowrap><?php echo $row_review['brewFlavorScore']; ?> / 20 </td>
        <td class="data"><?php echo $row_review['brewFlavorInfo']; ?></td>
      </tr>
      <tr class="bknd_ultra_lt">
        <td class="dataLabelLeft">Mouthfeel:</td>
        <td class="data" nowrap><?php echo $row_review['brewMouthfeelScore']; ?> / 5 </td>
        <td class="data"><?php echo $row_review['brewMouthfeelInfo']; ?></td>
      </tr>
      <tr>
        <td class="dataLabelLeft">Overall Impression: </td>
        <td class="data" nowrap><?php echo $row_review['brewOverallScore']; ?> / 10</td>
        <td class="data"><?php echo $row_review['brewOverallInfo']; ?></td>
      </tr>
      <tr class="bknd_ultra_lt">
        <td class="dataLabelLeft">Cumulative Score:</td>
        <td class="data" nowrap><?php echo $taste_calc; ?> / 50 </td>
        <td class="data">
		<?php 
		if ($taste_calc >= 45) { ?><span class="data_icon"><img src="<?php echo $imageSrc; ?>star.png" align="absmiddle" border="0"></span><span  class="data">Outstanding</span><?php } 
		if ($taste_calc >= 38 && $taste_calc <= 44) { ?><span class="data_icon"><img src="<?php echo $imageSrc; ?>award_star_gold_2.png" align="absmiddle" border="0"></span><span class="data dk">Excellent</span><?php } 
		if ($taste_calc >= 30 && $taste_calc <= 37) { ?><span class="data_icon"><img src="<?php echo $imageSrc; ?>award_star_silver_2.png" align="absmiddle" border="0"></span><span class="data dk">Very Good</span><?php } 
		if ($taste_calc >= 21 && $taste_calc <= 29) { ?><span class="data_icon"><img src="<?php echo $imageSrc; ?>award_star_bronze_2.png" align="absmiddle" border="0"></span><span class="data dk">Good</span><?php } 
		if ($taste_calc >= 14 && $taste_calc <= 20) { ?><span class="data_icon"><img src="<?php echo $imageSrc; ?>bell.png" align="absmiddle" border="0"></span><span class="data dk">Fair</span><?php }
		if ($taste_calc >= 00 && $taste_calc <= 13) { ?><span class="data_icon"><img src="<?php echo $imageSrc; ?>bell_error.png" align="absmiddle" border="0"></span><span class="data dk">Problematic</span><?php }
		?>
		</td>
      </tr>
	  <tr>
	    <td colspan="3">&nbsp;</td>
    </table>
<?php } while ($row_review = mysql_fetch_assoc($review)); ?>
</div>
<?php include ('../includes/footer2.inc.php'); ?>
<?php } ?>
</body>
</html>
<?php
mysql_free_result($review);
mysql_free_result($log);
?>
