<?php
if ($action == "calculate") { ?>

<input type="hidden" name="brewName" value="<?php echo strtr($brewName, $html_string); ?>">

<input type="hidden" name="brewYield" value="<?php echo $brewYield; ?>">
<input type="hidden" name="brewStyle" value="<?php echo $brewStyle; ?>">
<input type="hidden" name="brewLovibond" value="<?php if ($row_pref['measColor'] == "EBC") echo $EBC; else echo $SRM; ?>">
<input type="hidden" name="bitternessR" value="<?php echo $bitternessR; ?>">
<input type="hidden" name="bitternessG" value="<?php echo $bitternessG; ?>">
<input type="hidden" name="bitternessT" value="<?php echo $bitternessT; ?>">
<input type="hidden" name="bitternessD" value="<?php echo $bitternessD; ?>">
<input type="hidden" name="bitternessAvg" value="<?php echo $bitternessAvg; ?>">

<input type="hidden" name="brewExtract1" value="<?php echo $brewExtract1; ?>">
<input type="hidden" name="brewExtract2" value="<?php echo $brewExtract2; ?>">
<input type="hidden" name="brewExtract3" value="<?php echo $brewExtract3; ?>">
<input type="hidden" name="brewExtract4" value="<?php echo $brewExtract4; ?>">
<input type="hidden" name="brewExtract5" value="<?php echo $brewExtract5; ?>">

<input type="hidden" name="brewExtract1Weight" value="<?php echo $brewExtract1Weight; ?>">
<input type="hidden" name="brewExtract2Weight" value="<?php echo $brewExtract2Weight; ?>">
<input type="hidden" name="brewExtract3Weight" value="<?php echo $brewExtract3Weight; ?>">
<input type="hidden" name="brewExtract4Weight" value="<?php echo $brewExtract4Weight; ?>">
<input type="hidden" name="brewExtract5Weight" value="<?php echo $brewExtract5Weight; ?>">

<input type="hidden" name="brewGrain1" value="<?php echo $brewGrain1; ?>">
<input type="hidden" name="brewGrain2" value="<?php echo $brewGrain2; ?>">
<input type="hidden" name="brewGrain3" value="<?php echo $brewGrain3; ?>">
<input type="hidden" name="brewGrain4" value="<?php echo $brewGrain4; ?>">
<input type="hidden" name="brewGrain5" value="<?php echo $brewGrain5; ?>">
<input type="hidden" name="brewGrain6" value="<?php echo $brewGrain6; ?>">
<input type="hidden" name="brewGrain7" value="<?php echo $brewGrain7; ?>">
<input type="hidden" name="brewGrain8" value="<?php echo $brewGrain8; ?>">
<input type="hidden" name="brewGrain9" value="<?php echo $brewGrain9; ?>">
<input type="hidden" name="brewGrain10" value="<?php echo $brewGrain10; ?>">
<input type="hidden" name="brewGrain11" value="<?php echo $brewGrain11; ?>">
<input type="hidden" name="brewGrain12" value="<?php echo $brewGrain12; ?>">
<input type="hidden" name="brewGrain13" value="<?php echo $brewGrain13; ?>">
<input type="hidden" name="brewGrain14" value="<?php echo $brewGrain14; ?>">
<input type="hidden" name="brewGrain15" value="<?php echo $brewGrain15; ?>">

<input type="hidden" name="brewGrain1Weight" value="<?php echo $brewGrain1Weight; ?>">
<input type="hidden" name="brewGrain2Weight" value="<?php echo $brewGrain2Weight; ?>">
<input type="hidden" name="brewGrain3Weight" value="<?php echo $brewGrain3Weight; ?>">
<input type="hidden" name="brewGrain4Weight" value="<?php echo $brewGrain4Weight; ?>">
<input type="hidden" name="brewGrain5Weight" value="<?php echo $brewGrain5Weight; ?>">
<input type="hidden" name="brewGrain6Weight" value="<?php echo $brewGrain6Weight; ?>">
<input type="hidden" name="brewGrain7Weight" value="<?php echo $brewGrain7Weight; ?>">
<input type="hidden" name="brewGrain8Weight" value="<?php echo $brewGrain8Weight; ?>">
<input type="hidden" name="brewGrain9Weight" value="<?php echo $brewGrain9Weight; ?>">
<input type="hidden" name="brewGrain10Weight" value="<?php echo $brewGrain10Weight; ?>">
<input type="hidden" name="brewGrain11Weight" value="<?php echo $brewGrain11Weight; ?>">
<input type="hidden" name="brewGrain12Weight" value="<?php echo $brewGrain12Weight; ?>">
<input type="hidden" name="brewGrain13Weight" value="<?php echo $brewGrain13Weight; ?>">
<input type="hidden" name="brewGrain14Weight" value="<?php echo $brewGrain14Weight; ?>">
<input type="hidden" name="brewGrain15Weight" value="<?php echo $brewGrain15Weight; ?>">

<input type="hidden" name="brewAdjunct1" value="<?php echo $brewAdjunct1; ?>">
<input type="hidden" name="brewAdjunct2" value="<?php echo $brewAdjunct2; ?>">
<input type="hidden" name="brewAdjunct3" value="<?php echo $brewAdjunct3; ?>">
<input type="hidden" name="brewAdjunct4" value="<?php echo $brewAdjunct4; ?>">
<input type="hidden" name="brewAdjunct5" value="<?php echo $brewAdjunct6; ?>">
<input type="hidden" name="brewAdjunct6" value="<?php echo $brewAdjunct7; ?>">
<input type="hidden" name="brewAdjunct7" value="<?php echo $brewAdjunct8; ?>">
<input type="hidden" name="brewAdjunct8" value="<?php echo $brewAdjunct9; ?>">
<input type="hidden" name="brewAdjunct9" value="<?php echo $brewAdjunct5; ?>">

<input type="hidden" name="brewAdjunct1Weight" value="<?php echo $brewAdjunct1Weight; ?>">
<input type="hidden" name="brewAdjunct2Weight" value="<?php echo $brewAdjunct2Weight; ?>">
<input type="hidden" name="brewAdjunct3Weight" value="<?php echo $brewAdjunct3Weight; ?>">
<input type="hidden" name="brewAdjunct4Weight" value="<?php echo $brewAdjunct4Weight; ?>">
<input type="hidden" name="brewAdjunct5Weight" value="<?php echo $brewAdjunct5Weight; ?>">
<input type="hidden" name="brewAdjunct6Weight" value="<?php echo $brewAdjunct6Weight; ?>">
<input type="hidden" name="brewAdjunct7Weight" value="<?php echo $brewAdjunct7Weight; ?>">
<input type="hidden" name="brewAdjunct8Weight" value="<?php echo $brewAdjunct8Weight; ?>">
<input type="hidden" name="brewAdjunct9Weight" value="<?php echo $brewAdjunct9Weight; ?>">

<input type="hidden" name="brewHops1" value="<?php echo $brewHops1; ?>">
<input type="hidden" name="brewHops2" value="<?php echo $brewHops2; ?>">
<input type="hidden" name="brewHops3" value="<?php echo $brewHops3; ?>">
<input type="hidden" name="brewHops4" value="<?php echo $brewHops4; ?>">
<input type="hidden" name="brewHops5" value="<?php echo $brewHops5; ?>">
<input type="hidden" name="brewHops6" value="<?php echo $brewHops6; ?>">
<input type="hidden" name="brewHops7" value="<?php echo $brewHops7; ?>">
<input type="hidden" name="brewHops8" value="<?php echo $brewHops8; ?>">
<input type="hidden" name="brewHops9" value="<?php echo $brewHops9; ?>">
<input type="hidden" name="brewHops10" value="<?php echo $brewHops10; ?>">
<input type="hidden" name="brewHops11" value="<?php echo $brewHops11; ?>">
<input type="hidden" name="brewHops12" value="<?php echo $brewHops12; ?>">
<input type="hidden" name="brewHops13" value="<?php echo $brewHops13; ?>">
<input type="hidden" name="brewHops14" value="<?php echo $brewHops14; ?>">
<input type="hidden" name="brewHops15" value="<?php echo $brewHops15; ?>">

<input type="hidden" name="brewHops1Weight" value="<?php echo $brewHops1Weight; ?>">
<input type="hidden" name="brewHops2Weight" value="<?php echo $brewHops2Weight; ?>">
<input type="hidden" name="brewHops3Weight" value="<?php echo $brewHops3Weight; ?>">
<input type="hidden" name="brewHops4Weight" value="<?php echo $brewHops4Weight; ?>">
<input type="hidden" name="brewHops5Weight" value="<?php echo $brewHops5Weight; ?>">
<input type="hidden" name="brewHops6Weight" value="<?php echo $brewHops6Weight; ?>">
<input type="hidden" name="brewHops7Weight" value="<?php echo $brewHops7Weight; ?>">
<input type="hidden" name="brewHops8Weight" value="<?php echo $brewHops8Weight; ?>">
<input type="hidden" name="brewHops9Weight" value="<?php echo $brewHops9Weight; ?>">
<input type="hidden" name="brewHops10Weight" value="<?php echo $brewHops10Weight; ?>">
<input type="hidden" name="brewHops11Weight" value="<?php echo $brewHops11Weight; ?>">
<input type="hidden" name="brewHops12Weight" value="<?php echo $brewHops12Weight; ?>">
<input type="hidden" name="brewHops13Weight" value="<?php echo $brewHops13Weight; ?>">
<input type="hidden" name="brewHops14Weight" value="<?php echo $brewHops14Weight; ?>">
<input type="hidden" name="brewHops15Weight" value="<?php echo $brewHops15Weight; ?>">

<input type="hidden" name="brewHops1IBU" value="<?php echo $brewHops1IBU; ?>">
<input type="hidden" name="brewHops2IBU" value="<?php echo $brewHops2IBU; ?>">
<input type="hidden" name="brewHops3IBU" value="<?php echo $brewHops3IBU; ?>">
<input type="hidden" name="brewHops4IBU" value="<?php echo $brewHops4IBU; ?>">
<input type="hidden" name="brewHops5IBU" value="<?php echo $brewHops5IBU; ?>">
<input type="hidden" name="brewHops6IBU" value="<?php echo $brewHops6IBU; ?>">
<input type="hidden" name="brewHops7IBU" value="<?php echo $brewHops7IBU; ?>">
<input type="hidden" name="brewHops8IBU" value="<?php echo $brewHops8IBU; ?>">
<input type="hidden" name="brewHops9IBU" value="<?php echo $brewHops9IBU; ?>">
<input type="hidden" name="brewHops10IBU" value="<?php echo $brewHops10IBU; ?>">
<input type="hidden" name="brewHops11IBU" value="<?php echo $brewHops11IBU; ?>">
<input type="hidden" name="brewHops12IBU" value="<?php echo $brewHops12IBU; ?>">
<input type="hidden" name="brewHops13IBU" value="<?php echo $brewHops13IBU; ?>">
<input type="hidden" name="brewHops14IBU" value="<?php echo $brewHops14IBU; ?>">
<input type="hidden" name="brewHops15IBU" value="<?php echo $brewHops15IBU; ?>">

<input type="hidden" name="brewHops1Time" value="<?php echo $brewHops1Time; ?>">
<input type="hidden" name="brewHops2Time" value="<?php echo $brewHops2Time; ?>">
<input type="hidden" name="brewHops3Time" value="<?php echo $brewHops3Time; ?>">
<input type="hidden" name="brewHops4Time" value="<?php echo $brewHops4Time; ?>">
<input type="hidden" name="brewHops5Time" value="<?php echo $brewHops5Time; ?>">
<input type="hidden" name="brewHops6Time" value="<?php echo $brewHops6Time; ?>">
<input type="hidden" name="brewHops7Time" value="<?php echo $brewHops7Time; ?>">
<input type="hidden" name="brewHops8Time" value="<?php echo $brewHops8Time; ?>">
<input type="hidden" name="brewHops9Time" value="<?php echo $brewHops9Time; ?>">
<input type="hidden" name="brewHops10Time" value="<?php echo $brewHops10Time; ?>">
<input type="hidden" name="brewHops11Time" value="<?php echo $brewHops11Time; ?>">
<input type="hidden" name="brewHops12Time" value="<?php echo $brewHops12Time; ?>">
<input type="hidden" name="brewHops13Time" value="<?php echo $brewHops13Time; ?>">
<input type="hidden" name="brewHops14Time" value="<?php echo $brewHops14Time; ?>">
<input type="hidden" name="brewHops15Time" value="<?php echo $brewHops15Time; ?>">

<input type="hidden" name="brewHops1Form" value="<?php echo $brewHops1Form; ?>">
<input type="hidden" name="brewHops2Form" value="<?php echo $brewHops2Form; ?>">
<input type="hidden" name="brewHops3Form" value="<?php echo $brewHops3Form; ?>">
<input type="hidden" name="brewHops4Form" value="<?php echo $brewHops4Form; ?>">
<input type="hidden" name="brewHops5Form" value="<?php echo $brewHops5Form; ?>">
<input type="hidden" name="brewHops6Form" value="<?php echo $brewHops6Form; ?>">
<input type="hidden" name="brewHops7Form" value="<?php echo $brewHops7Form; ?>">
<input type="hidden" name="brewHops8Form" value="<?php echo $brewHops8Form; ?>">
<input type="hidden" name="brewHops9Form" value="<?php echo $brewHops9Form; ?>">
<input type="hidden" name="brewHops10Form" value="<?php echo $brewHops10Form; ?>">
<input type="hidden" name="brewHops11Form" value="<?php echo $brewHops11Form; ?>">
<input type="hidden" name="brewHops12Form" value="<?php echo $brewHops12Form; ?>">
<input type="hidden" name="brewHops13Form" value="<?php echo $brewHops13Form; ?>">
<input type="hidden" name="brewHops14Form" value="<?php echo $brewHops14Form; ?>">
<input type="hidden" name="brewHops15Form" value="<?php echo $brewHops15Form; ?>">

<?php }  

else {

$brewExtract1 = $_POST['brewExtract1'];
$brewExtract2 = $_POST['brewExtract2'];
$brewExtract3 = $_POST['brewExtract3'];
$brewExtract4 = $_POST['brewExtract4'];
$brewExtract5 = $_POST['brewExtract5'];
$brewExtract1Weight = $_POST['brewExtract1Weight'];
$brewExtract2Weight = $_POST['brewExtract2Weight'];
$brewExtract3Weight = $_POST['brewExtract3Weight'];
$brewExtract4Weight = $_POST['brewExtract4Weight'];
$brewExtract5Weight = $_POST['brewExtract5Weight'];

$brewGrain1 = $_POST['brewGrain1'];
$brewGrain2 = $_POST['brewGrain2'];
$brewGrain3 = $_POST['brewGrain3'];
$brewGrain4 = $_POST['brewGrain4'];
$brewGrain5 = $_POST['brewGrain5'];
$brewGrain6 = $_POST['brewGrain6'];
$brewGrain7 = $_POST['brewGrain7'];
$brewGrain8 = $_POST['brewGrain8'];
$brewGrain9 = $_POST['brewGrain9'];
$brewGrain10 = $_POST['brewGrain10'];
$brewGrain11 = $_POST['brewGrain11'];
$brewGrain12 = $_POST['brewGrain12'];
$brewGrain13 = $_POST['brewGrain13'];
$brewGrain14 = $_POST['brewGrain14'];
$brewGrain15 = $_POST['brewGrain15'];

$brewGrain1Weight = $_POST['brewGrain1Weight'];
$brewGrain2Weight = $_POST['brewGrain2Weight'];
$brewGrain3Weight = $_POST['brewGrain3Weight'];
$brewGrain4Weight = $_POST['brewGrain4Weight'];
$brewGrain5Weight = $_POST['brewGrain5Weight'];
$brewGrain6Weight = $_POST['brewGrain6Weight'];
$brewGrain7Weight = $_POST['brewGrain7Weight'];
$brewGrain8Weight = $_POST['brewGrain8Weight'];
$brewGrain9Weight = $_POST['brewGrain9Weight'];
$brewGrain10Weight = $_POST['brewGrain10Weight'];
$brewGrain11Weight = $_POST['brewGrain11Weight'];
$brewGrain12Weight = $_POST['brewGrain12Weight'];
$brewGrain13Weight = $_POST['brewGrain13Weight'];
$brewGrain14Weight = $_POST['brewGrain14Weight'];
$brewGrain15Weight = $_POST['brewGrain15Weight'];

$brewAddition1 = $_POST['brewAddition1'];
$brewAddition2 = $_POST['brewAddition2'];
$brewAddition3 = $_POST['brewAddition3'];
$brewAddition4 = $_POST['brewAddition4'];
$brewAddition5 = $_POST['brewAddition5'];
$brewAddition6 = $_POST['brewAddition6'];
$brewAddition7 = $_POST['brewAddition7'];
$brewAddition8 = $_POST['brewAddition8'];
$brewAddition9 = $_POST['brewAddition9'];
$brewAddition1Amt = $_POST['brewAddition1Amt'];
$brewAddition2Amt = $_POST['brewAddition2Amt'];
$brewAddition3Amt = $_POST['brewAddition3Amt'];
$brewAddition4Amt = $_POST['brewAddition4Amt'];
$brewAddition5Amt = $_POST['brewAddition5Amt'];
$brewAddition6Amt = $_POST['brewAddition6Amt'];
$brewAddition7Amt = $_POST['brewAddition7Amt'];
$brewAddition8Amt = $_POST['brewAddition8Amt'];
$brewAddition9Amt = $_POST['brewAddition9Amt'];

$brewHops1 = $_POST['brewHops1'];
$brewHops2 = $_POST['brewHops2'];
$brewHops3 = $_POST['brewHops3'];
$brewHops4 = $_POST['brewHops4'];
$brewHops5 = $_POST['brewHops5'];
$brewHops6 = $_POST['brewHops6'];
$brewHops7 = $_POST['brewHops7'];
$brewHops8 = $_POST['brewHops8'];
$brewHops9 = $_POST['brewHops9'];
$brewHops10 = $_POST['brewHops10'];
$brewHops11 = $_POST['brewHops11'];
$brewHops12 = $_POST['brewHops12'];
$brewHops13 = $_POST['brewHops13'];
$brewHops14 = $_POST['brewHops14'];
$brewHops15 = $_POST['brewHops15'];

$brewHops1Weight = $_POST['brewHops1Weight'];
$brewHops2Weight = $_POST['brewHops2Weight'];
$brewHops3Weight = $_POST['brewHops3Weight'];
$brewHops4Weight = $_POST['brewHops4Weight'];
$brewHops5Weight = $_POST['brewHops5Weight'];
$brewHops6Weight = $_POST['brewHops6Weight'];
$brewHops7Weight = $_POST['brewHops7Weight'];
$brewHops8Weight = $_POST['brewHops8Weight'];
$brewHops9Weight = $_POST['brewHops9Weight'];
$brewHops10Weight = $_POST['brewHops10Weight'];
$brewHops11Weight = $_POST['brewHops11Weight'];
$brewHops12Weight = $_POST['brewHops12Weight'];
$brewHops13Weight = $_POST['brewHops13Weight'];
$brewHops14Weight = $_POST['brewHops14Weight'];
$brewHops15Weight = $_POST['brewHops15Weight'];

$brewHops1IBU = $_POST['brewHops1IBU'];
$brewHops2IBU = $_POST['brewHops2IBU'];
$brewHops3IBU = $_POST['brewHops3IBU'];
$brewHops4IBU = $_POST['brewHops4IBU'];
$brewHops5IBU = $_POST['brewHops5IBU'];
$brewHops6IBU = $_POST['brewHops6IBU'];
$brewHops7IBU = $_POST['brewHops7IBU'];
$brewHops8IBU = $_POST['brewHops8IBU'];
$brewHops9IBU = $_POST['brewHops9IBU'];
$brewHops10IBU = $_POST['brewHops10IBU'];
$brewHops11IBU = $_POST['brewHops11IBU'];
$brewHops12IBU = $_POST['brewHops12IBU'];
$brewHops13IBU = $_POST['brewHops13IBU'];
$brewHops14IBU = $_POST['brewHops14IBU'];
$brewHops15IBU = $_POST['brewHops15IBU'];

$brewHops1Time = $_POST['brewHops1Time'];
$brewHops2Time = $_POST['brewHops2Time'];
$brewHops3Time = $_POST['brewHops3Time'];
$brewHops4Time = $_POST['brewHops4Time'];
$brewHops5Time = $_POST['brewHops5Time'];
$brewHops6Time = $_POST['brewHops6Time'];
$brewHops7Time = $_POST['brewHops7Time'];
$brewHops8Time = $_POST['brewHops8Time'];
$brewHops9Time = $_POST['brewHops9Time'];
$brewHops10Time = $_POST['brewHops10Time'];
$brewHops11Time = $_POST['brewHops11Time'];
$brewHops12Time = $_POST['brewHops12Time'];
$brewHops13Time = $_POST['brewHops13Time'];
$brewHops14Time = $_POST['brewHops14Time'];
$brewHops15Time = $_POST['brewHops15Time'];

$brewHops1Form = $_POST['brewHops1Form'];
$brewHops2Form = $_POST['brewHops2Form'];
$brewHops3Form = $_POST['brewHops3Form'];
$brewHops4Form = $_POST['brewHops4Form'];
$brewHops5Form = $_POST['brewHops5Form'];
$brewHops6Form = $_POST['brewHops6Form'];
$brewHops7Form = $_POST['brewHops7Form'];
$brewHops8Form = $_POST['brewHops8Form'];
$brewHops9Form = $_POST['brewHops9Form'];
$brewHops10Form = $_POST['brewHops10Form'];
$brewHops11Form = $_POST['brewHops11Form'];
$brewHops12Form = $_POST['brewHops12Form'];
$brewHops13Form = $_POST['brewHops13Form'];
$brewHops14Form = $_POST['brewHops14Form'];
$brewHops15Form = $_POST['brewHops15Form'];

$brewBrewerID = $_POST['brewBrewerID'];
$brewYield = $_POST['brewYield'];
$brewName = $_POST['brewName'];
$brewStyle = $_POST['brewStyle'];
$brewLovibond = $_POST['brewLovibond'];
$brewBitterness = explode("-", $_POST['brewBitterness']);
$brewOG = $_POST['brewOG'];
$brewFG = $_POST['brewFG'];
$brewTargetOG = $_POST['brewTargetOG'];
$brewTargetFG = $_POST['brewTargetFG'];

}
?>