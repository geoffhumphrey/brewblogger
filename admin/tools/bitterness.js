// This code dynamically adds hop entries to the form.
var hopEntry = 0;

function addHop(divName, maxHops, defHopForm, start) {
    hopEntry += start;
    if (hopEntry < maxHops) {
	var tr, td, txt, input, buttonRow, button;
	tr = document.createElement('tr');
	
	td = document.createElement('td');
	td.setAttribute('class','dataLabelLeft');
	txt = document.createTextNode("Hop " + (hopEntry + 1) + " Weight:");
	td.appendChild(txt);
	tr.appendChild(td);
	
	td = document.createElement('td');
	td.setAttribute('class','data');
	input = document.createElement('input');
	input.setAttribute('name','hopWeight[' + hopEntry + ']');
	input.setAttribute('type','text');
	input.setAttribute('size','5');
	input.setAttribute('value','');
	td.appendChild(input);
	tr.appendChild(td);
	
	td = document.createElement('td');
	td.setAttribute('class','dataLabel');
	txt = document.createTextNode("Hop " + (hopEntry + 1) + " AA%:");
	td.appendChild(txt);
	tr.appendChild(td);

	td = document.createElement('td');
	td.setAttribute('class','data');
	input = document.createElement('input');
	input.setAttribute('name','hopAA[' + hopEntry + ']');
	input.setAttribute('type','text');
	input.setAttribute('size','5');
	input.setAttribute('value','');
	td.appendChild(input);
	tr.appendChild(td);

	td = document.createElement('td');
	td.setAttribute('class','dataLabel');
	txt = document.createTextNode("Hop " + (hopEntry + 1) + " Time (min):");
	td.appendChild(txt);
	tr.appendChild(td);

	td = document.createElement('td');
	td.setAttribute('class','data');
	input = document.createElement('input');
	input.setAttribute('name','utilization[' + hopEntry + ']');
	input.setAttribute('type','text');
	input.setAttribute('size','5');
	input.setAttribute('value','');
	td.appendChild(input);
	tr.appendChild(td);

	td = document.createElement('td');
	td.setAttribute('class','dataLabel');
	txt = document.createTextNode("Form:");
	td.appendChild(txt);
	tr.appendChild(td);

	td = document.createElement('td');
	td.setAttribute('class','data');
	td.setAttribute('nowrap','nowrap');
	input = document.createElement('input');
	input.setAttribute('name','form[' + hopEntry + ']');
	input.setAttribute('type','radio');
	input.setAttribute('value','pellet');
	if (defHopForm == "pellet")
	    input.setAttribute('checked','CHECKED');
	txt = document.createTextNode("Pellet ");
	td.appendChild(input);
	td.appendChild(txt);
	input = document.createElement('input');
	input.setAttribute('name','form[' + hopEntry + ']');
	input.setAttribute('type','radio');
	input.setAttribute('value','whole');
	if (defHopForm == "whole")
	    input.setAttribute('checked','CHECKED');
	txt = document.createTextNode("Whole/Plug");
	td.appendChild(input);
	td.appendChild(txt);
	tr.appendChild(td);

	buttonRow = document.getElementById('addHopButtonRow');
	buttonRow.parentNode.insertBefore(tr,buttonRow);
	hopEntry -= start;
	hopEntry++;
	if ((hopEntry + start) == maxHops) {
	    button = document.getElementById('addHopButton');
	    button.setAttribute('disabled','disabled');
	    td = document.createElement('td');
	    td.setAttribute('colspan','6');
	    td.setAttribute('class','dataLabel');
	    txt = document.createTextNode("** Maximum hop entries reached **");
	    td.appendChild(txt);
	    button.parentNode.parentNode.appendChild(td);
	}
    }
}

// Sanity checks on user input
// Copyright 2003 Bontrager Connection, LLC
// Code obtained from http://WillMaster.com/
function CheckRequiredFields() {
    var errormessage = new String();
    // Put field checks below this point.
    if(WithoutContent(document.form1["hopWeight[0]"].value)) {
	errormessage += "\nAt least one hop weight.";
    }
    if(WithoutContent(document.form1["hopAA[0]"].value)) {
	errormessage += "\nAt least one hop AAU.";
    }
    if(WithoutContent(document.form1["utilization[0]"].value)) {
	errormessage += "\nAt least one hop boil time.";
    }
    if(WithoutContent(document.form1.gravity.value)) {
	errormessage += "\nGravity reading.";
    }
    // Put field checks above this point.
    if(errormessage.length > 2) {
        alert('To calculate properly, the following information is needed:\n' + errormessage);
        return false;
    }
    return true;
}

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
// End Bontrager code.