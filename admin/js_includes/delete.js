// JavaScript Document

function DelWithCon(deletepage_url,field_name,field_value,messagetext) { //v1.0 - Deletes a record with confirmation
  if (confirm(messagetext)==1){
  	location.href = eval('\"'+deletepage_url+'&'+field_name+'='+field_value+'\"');
  }
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
