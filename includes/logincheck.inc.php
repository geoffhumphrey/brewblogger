<?php
$source = "default";
if (isset($_GET['source'])) {
  $source = (get_magic_quotes_gpc()) ? $_GET['source'] : addslashes($_GET['source']);
}
require ('../paths.php');
require 'authentication.inc.php';
//require 'login_check.inc.php';
require_once (CONFIG.'config.php'); 
$connection = $brewing;

function showerror()  {
    die("Error " . mysql_errno() . " : " . mysql_error());
}

function mysqlclean($array, $index, $maxlength, $connection) {
    if (isset($array["{$index}"])) {
        $input = substr($array["{$index}"], 0, $maxlength);
        $input = mysql_real_escape_string($input, $connection);
        return ($input);
    }
    return NULL;
}

function shellclean($array, $index, $maxlength) {
    if (isset($array["{$index}"])) {
       $input = substr($array["{$index}"], 0, $maxlength);
       $input = EscapeShellCmd($input);
       return ($input);
    }
	return NULL;
}

// Clean the data collected in the <form>
function sterilize ($sterilize=NULL) {
	if ($sterilize==NULL) {return NULL;}
	$check = array (1 => "'", 2 => '"', 3 => '<', 4 => '>');
	foreach ($check as $value) {
		$sterilize=str_replace($value, '', $sterilize);
	}
	$sterilize=strip_tags ($sterilize);
	$sterilize=stripcslashes ($sterilize);
	$sterilize=stripslashes ($sterilize);
	$sterilize=addslashes ($sterilize);
	return $sterilize;
}

$loginUsername = sterilize($_POST['loginUsername']);
$loginPassword = sterilize($_POST['loginPassword']);

//if ($source != "calc") { 
$aValid = array('-', '_', '.','*','@','!','#','$','%','^','&','+','=');
if (ctype_alnum(str_replace(($aValid), '', $loginUsername))) {
if (!mysql_selectdb($database_brewing, $connection))
  showerror();
session_start();
// Authenticate the user
	if (authenticateUser($connection, $loginUsername, $loginPassword)) {
  		// Register the loginUsername
  		$_SESSION["loginUsername"] = $loginUsername;

  		// If the username/password combo is OK, relocate to the "protected" content index page
  		header("Location: ../admin/index.php");
  		exit;
	}
else {
  		// If the username/password combo is incorrect or not found, relocate to the login error page
  		header("Location: ../index.php?page=login&section=loginError");
  		session_destroy();
  		exit;
	}
}
else {
  // If the username/password combo is incorrect or not found, relocate to the login error page
  header("Location: ../index.php?page=login&section=loginError");
  session_destroy();
  exit;
}


?>
