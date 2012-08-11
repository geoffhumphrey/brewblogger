<?php
function authenticateUserNav($connection, $username, $password)
{
  // Test the username and password parameters
  if (!isset($username) || !isset($password))
    return false;

  // Formulate the SQL find the user
  $query = "SELECT password FROM users WHERE user_name = '{$username}'
            AND password = '{$password}'";

  // Execute the query
  if (!$result = @ mysql_query ($query, $connection))
    showerror();

  // Is the returned result exactly one row? If so, then we have found the user
  if (mysql_num_rows($result) != 1)
    return false;
  else
    return true;
}

// Connects to a session and checks that the user has authenticated and that the remote IP address matches the address used to create the session.

function sessionAuthenticateNav()
{
include (CONFIG.'config.php');
mysql_select_db($database_brewing, $brewing);
$query_prefs = "SELECT menuLogin, menuLogout FROM preferences";
$prefs = mysql_query($query_prefs, $brewing) or die(mysql_error());
$row_prefs = mysql_fetch_assoc($prefs);

  // Check if the user hasn't logged in
  if (!isset($_SESSION["loginUsername"]))  { echo "<li><a href=\"index.php?page=login\">".$row_prefs['menuLogin']."</a></li>"; }
  if (isset($_SESSION["loginUsername"]))   { echo "<li><div class=\"menuBar\"><a class=\"menuButton\" href=\"admin/index.php\" onclick=\"admin/index.php\" onmouseover=\"buttonMouseover(event, 'publicMenu2')\">Admin</a></div></li><li><a href=\"includes/logout.inc.php\">".$row_prefs['menuLogout']."</a></li>"; }
}

?>
