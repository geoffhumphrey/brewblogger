<?php if ($dbTable != "preferences") { ?>
<script type="text/javascript" language="JavaScript">
<!-- Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
<?php if (($dbTable == "recipes") || ($dbTable == "brewing")) { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.brewName.value))
	{ errormessage += "\nName"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if (($dbTable == "users") && ($action == "add")) { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.realFirstName.value))
	{ errormessage += "\nFirst Name"; }
if(WithoutContent(document.form1.realLastName.value))
	{ errormessage += "\nLast Name"; }
if(WithoutContent(document.form1.user_name.value))
	{ errormessage += "\nUser Name"; }
if(WithoutContent(document.form1.password.value))
	{ errormessage += "\nPassword"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if (($dbTable == "users") && ($action == "edit")) { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.passwordOld.value))
	{ errormessage += "\nOld Password"; }
if(WithoutContent(document.form1.password.value))
	{ errormessage += "\nNew Password"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if (($dbTable == "brewer") && ($row_pref['mode'] == "1")) { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.brewerLogName.value))
	{ errormessage += "\nName"; }
//if(WithoutContent(document.form1.brewerFirstName.value))
//	{ errormessage += "\nYour First Name"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if (($dbTable == "brewer") && ($row_pref['mode'] == "2")) { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.brewerLogName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.brewerFirstName.value))
	{ errormessage += "\nBrew Club Name"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "malt") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.maltName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.maltLovibond.value))
	{ errormessage += "\nColor (Lovibond)"; }
if(WithoutContent(document.form1.maltYield.value))
	{ errormessage += "\nType"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "extract") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.extractName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.extractLovibond.value))
	{ errormessage += "\nTColor (Lovibond)"; }
if(WithoutContent(document.form1.extractYield.value))
	{ errormessage += "\nType"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "adjuncts") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.adjunctName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.adjunctLovibond.value))
	{ errormessage += "\nTColor (Lovibond)"; }
if(WithoutContent(document.form1.adjunctYield.value))
	{ errormessage += "\nType"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "hops") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.hopsName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.hopsGrown.value))
	{ errormessage += "\nCountry of Origin"; }
if(WithoutContent(document.form1.hopsUse.value))
	{ errormessage += "\nTypical Use"; }
if(WithoutContent(document.form1.hopsAAULow.value))
	{ errormessage += "\nLow AAU"; }
if(WithoutContent(document.form1.hopsAAUHigh.value))
	{ errormessage += "\nHigh AAU"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>

<?php if ($dbTable == "misc") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.miscName.value))
	{ errormessage += "\nName"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>

<?php if ($dbTable == "equip_profiles") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.equipProfileName.value))
	{ errormessage += "\nProfile Name"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>

<?php if ($dbTable == "water_profiles") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.waterName.value))
	{ errormessage += "\nProfile Name"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>

<?php if ($dbTable == "yeast_profiles") { ?>
/* function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.yeastLab.value))
	{ errormessage += "\nManufacturer/Lab"; }
if(WithoutContent(document.form1.yeastProdID.value))
	{ errormessage += "\nProduct ID/Number"; }
if(WithoutContent(document.form1.yeastName.value))
	{ errormessage += "\nName"; }	
	// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
*/
<?php  } ?>

<?php if ($dbTable == "brewerlinks") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.brewerLinkName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.brewerLinkURL.value))
	{ errormessage += "\nURL"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "upcoming") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] == "1")) { ?>
if(WithoutContent(document.form1.brewBrewerID.value))
	{ errormessage += "\nThe Brewer"; }
<?php } ?>
if(WithoutContent(document.form1.upcoming.value))
	{ errormessage += "\nName"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "styles") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.brewStyle.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.brewStyleGroup.value))
	{ errormessage += "\nCategory Number"; }
if(WithoutContent(document.form1.brewStyleNum.value))
	{ errormessage += "\nLetter"; }
if(WithoutContent(document.form1.brewStyleOG.value))
	{ errormessage += "\nMinimum OG"; }
if(WithoutContent(document.form1.brewStyleOGMax.value))
	{ errormessage += "\nMaximum OG"; }
if(WithoutContent(document.form1.brewStyleFG.value))
	{ errormessage += "\nMinimum FG"; }
if(WithoutContent(document.form1.brewStyleFGMax.value))
	{ errormessage += "\nMaximum FG"; }
if(WithoutContent(document.form1.brewStyleABV.value))
	{ errormessage += "\nMinimum ABV"; }
if(WithoutContent(document.form1.brewStyleABVMax.value))
	{ errormessage += "\nMaximum ABV"; }
if(WithoutContent(document.form1.brewStyleIBU.value))
	{ errormessage += "\nMinimum IBUs"; }
if(WithoutContent(document.form1.brewStyleIBUMax.value))
	{ errormessage += "\nMaximum IBUs"; }
if(WithoutContent(document.form1.brewStyleSRM.value))
	{ errormessage += "\nMinimum Color (SRM)"; }
if(WithoutContent(document.form1.brewStyleSRMMax.value))
	{ errormessage += "\nMaximum Color (SRM)"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('All styles are listed according to BJCP specifications.\nTo process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($page == "reviews") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.brewScoredBy.value))
	{ errormessage += "\nScored By"; }
if(WithoutContent(document.form1.brewAromaScore.value))
	{ errormessage += "\nAroma Score"; }
if(WithoutContent(document.form1.brewAppearanceScore.value))
	{ errormessage += "\nAppearance Score"; }
if(WithoutContent(document.form1.brewFlavorScore.value))
	{ errormessage += "\nFlavor Score"; }
if(WithoutContent(document.form1.brewMouthfeelScore.value))
	{ errormessage += "\nMouthfeel Score"; }
if(WithoutContent(document.form1.brewOverallScore.value))
	{ errormessage += "\nOverall Score"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if ($dbTable == "brewingcss") { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form1.themeName.value))
	{ errormessage += "\nName"; }
if(WithoutContent(document.form1.theme.value))
	{ errormessage += "\nFile Name"; }
if(WithoutContent(document.form1.themeColor1.value))
	{ errormessage += "\nRow Color 1"; }
if(WithoutContent(document.form1.themeColor2.value))
	{ errormessage += "\nRow Color 2"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To process, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>
<?php if (($action == "calculate") && ($results != "verify")) { ?>
function CheckRequiredFields() {
var errormessage = new String();
// Put field checks below this point.
if(WithoutContent(document.form3.brewYield.value))
	{ errormessage += "\nFinished Volume (Batch Size)"; }
// Put field checks above this point.
if(errormessage.length > 2) {
	alert('To calculate, the following fields cannot be empty:\n' + errormessage);
	return false;
	}
return true;
} // end of function CheckRequiredFields()
<?php } ?>

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

