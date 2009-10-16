<?php 
if ((($action == "add") || ($action == "edit")) && (($dbTable == "brewing") || ($dbTable == "recipes"))) echo "onLoad=\"self.focus();document.form1.brewName.focus()\""; 
if ((($action == "add") || ($action == "edit")) && ($dbTable == "malt")) echo "onLoad=\"self.focus();document.form1.maltName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "hops")) echo "onLoad=\"self.focus();document.form1.hopsName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "styles")) echo "onLoad=\"self.focus();document.form1.brewStyle.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "brewerlinks")) echo "onLoad=\"self.focus();document.form1.brewerLinkName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "users")) echo "onLoad=\"self.focus();document.form1.realFirstName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "upcoming")) echo "onLoad=\"self.focus();document.form1.upcoming.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "brewer")) echo "onLoad=\"self.focus();document.form1.brewerLogName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "extract")) echo "onLoad=\"self.focus();document.form1.extractName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "adjuncts")) echo "onLoad=\"self.focus();document.form1.adjunctName.focus()\"";
if ((($action == "add") || ($action == "edit")) && ($dbTable == "awards")) echo "onLoad=\"self.focus();document.form1.awardContest.focus()\"";?>