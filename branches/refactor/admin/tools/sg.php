<?php

if (($action == "calculate") || ($action == "entry")) {
$figure = $_POST['figure'];
$method = $_POST['method'];
if ($method == "plato") { 
$sg = 1 + ($figure / (258.6 - ($figure * 0.88)));
$brix = $figure * 1.04;
}
if ($method == "sg") { 
$plato = (-463.37) + (668.72 * $figure) - (205.35 * pow($figure,2));
$brix = $plato * 1.04;
}
if ($method == "brix") {
$sg = 1.000019 + ((0.003865613 * $figure) + (0.00001296425 * $figure) + (0.00000005701128 * $figure));
$plato = (-463.37) + (668.72 * $sg) - (205.35 * pow($sg,2));
}
}
?>

<?php if (($action == "default") || ($action == "entry")) { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.figure.value))
	{ errormessage += "\nA numerical value."; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To calculate properly, the following information is needed:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()


function WithoutContent(ss) {
if(ss.length > 0) { return false; }
return true;
}

function NoneWithContent(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].value.length > 0) { return false; }
	}
return true;
}

function NoneWithCheck(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].checked) { return false; }
	}
return true;
}

function WithoutCheck(ss) {
if(ss.checked) { return false; }
return true;
}

function WithoutSelectionValue(ss) {
for(var i = 0; i < ss.length; i++) {
	if(ss[i].selected) {
		if(ss[i].value.length) { return false; }
		}
	}
return true;
}

//-->
</script>
<?php } ?>
<form name="form1" <?php if (($action == "default") || ($action == "entry")) echo "onSubmit=\"return CheckRequiredFields()\""; ?> method="post" action="?page=<?php echo $page; ?>&section=<?php echo $section; ?>&action=<?php if (($action == "default") || ($action == "entry")) echo "calculate"; if ($action == "calculate") echo "entry"; ?>">
<div id="wideWrapper<?php if ($page == "tools") echo "Reference"; ?>">
<div id="referenceHeader">Plato/Brix/SG Calculator</div>
<table class="dataTable">
<?php if (($action == "default") || ($action == "entry")) { ?>
    <tr>
      <td class="dataLabelLeft">Number Entry:</td>
      <td class="data" width="10%"><input name="figure" type="text" id="figure" size="10" value="<?php if  ($action == "entry") echo $figure; ?>"></td>
      <td class="data">
      <input name="method" type="radio" class="radioButton" value="plato" <?php if (($action == "default") || (($action == "entry") && ($method == "plato"))) echo "checked=\"checked\""; ?> />Degrees Plato<br />
      <input name="method" type="radio" class="radioButton" value="sg" <?php if (($action == "entry") && ($method == "sg")) echo "checked=\"checked\""; ?>  />Specific Gravity<br />
      <input name="method" type="radio" class="radioButton" value="brix" <?php if (($action == "entry") && ($method == "brix")) echo "checked=\"checked\""; ?>  />Brix
      </td>
    </tr>
<?php } ?>
<?php if ($action == "calculate") { ?>
<input type="hidden" name="figure" id="figure" value="<?php echo $figure; ?>" />
<input type="hidden" name="method" id="method" value="<?php echo $method; ?>" />
    <tr>
      <td class="dataLabelLeft">Specific Gravity:</td>
      <td class="data"><?php if ($method != "sg") echo round ($sg,3); else echo $figure; ?></td>
    </tr>
	<tr>
      <td class="dataLabelLeft">Degrees Plato:</td>
      <td class="data"><?php if ($method != "plato")  echo round ($plato,1); else echo round ($figure,1); ?></td>
    </tr>
    <tr>
      <td class="dataLabelLeft">Degrees Brix:</td>
      <td class="data"><?php if ($method != "brix")  echo round ($brix,1); else echo round ($figure,1); ?></td>
    </tr>
<?php } ?>
  </table>
</div>
    	<?php if (($action == "default") || ($action == "entry")) { if (!checkmobile()) { ?><input class="calcButton" type="image" src="<?php echo $imageSrc."Brilliant" ?>/button_calculate_Brilliant.png" alt="Calculate" class="radiobutton" value="Calculate"><?php } else { ?><input type="submit" class="buttons" value="Calculate" /><?php } } ?>
		<?php if ($action == "entry") { ?><a class="calcButton" href="?page=<?php echo $page; ?>&amp;section=<?php echo $section; ?>"><?php if (!checkmobile()) { ?><img src="<?php echo $imageSrc."Brilliant" ?>/button_clear_Brilliant.png" border="0" title="Clear" alt="Clear"/><?php } else echo "Clear"; ?></a><?php } ?>
		<?php if ($action == "calculate") { if (!checkmobile()) { ?><input class="calcButton" type="image" src="<?php echo $imageSrc."Brilliant" ?>/button_back_Brilliant.png" alt="Calculate" class="radiobutton" value="Re-enter Values"><?php } else { ?><input type="submit" class="radiobutton" value="Go Back"><?php } } ?>
</form>