<?php

ob_start();
require('../paths.php');
require(CONFIG.'config.php');
session_start();

header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

// Extra security for all passwords in DB
// require(CLASSES.'phpass/PasswordHash.php');
// $hasher = new PasswordHash(8, false);

// Clean the data collected in the <form>
function sterilize ($sterilize=NULL) {
  if ($sterilize==NULL) {
    return NULL;
  }

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
$password = sterilize($_POST['loginPassword']);

if (strlen($password) > 72) {
  session_destroy();
  header(sprintf("Location: %s", $base_url."index.php?page=login&section=login-error"));
  exit;
}

mysqli_real_escape_string($connection,$loginUsername);
mysqli_real_escape_string($connection,$password);

$password = md5($password);

// $loginUsername = strtolower($loginUsername);

$query_login = sprintf("SELECT user_name,password FROM users WHERE user_name = '%s'",$loginUsername);
$login = mysqli_query($connection,$query_login) or die (mysqli_error($connection));
$row_login = mysqli_fetch_assoc($login);
$totalRows_login = mysqli_num_rows($login);

$stored_hash = $row_login['password'];

if ($totalRows_login > 0) {
  if ($password == $stored_hash) $check = 1;
  else $check = 0;
}

else $check = 0;

// If the username/password combo is valid, register a session, register a session cookie
// perform certain tasks, and redirect
if ($check == 1) {
  $_SESSION['loginUsername'] = $loginUsername;
  $location = $base_url."index.php?page=admin";
}

// If the username/password combo is incorrect or not found,
// destroy the session and relocate to the login error page.
else {
  $location = $base_url."index.php?page=login&section=login-error";
  session_destroy();
}

// Relocate
header(sprintf("Location: %s", $location, true));
exit;
?>
