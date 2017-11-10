<?php
function authenticateUser($connection, $username, $password)
{
  // Test the username and password parameters
  if (!isset($username) || !isset($password))
    return false;

  // Formulate the SQL find the user
  $password = md5($password);
  $query = "SELECT password FROM users WHERE user_name = '{$username}'
            AND password = '{$password}'";

// Execute the query
  if (!$result = @ mysql_query ($query, $connection))
    showerror();

  // Is the returned result exactly one row? If so, then we have found the user
  if (mysqli_num_rows($result) != 1)
     return false;
  else
    return true;
}

// Connects to a session and checks that the user has authenticated and that the remote IP address matches the address used to create the session.
function sessionAuthenticate()
{
  // Check if the user hasn't logged in
  if (!isset($_SESSION["loginUsername"]))
  {
    header("Location: ../index.php?page=login");
    exit;
  }

}
function sessionAuthenticate2()
{
  // Check if the user hasn't logged in
  if (!isset($_SESSION["loginUsername"]))
  {
    echo("Login");
  }
  else
  {
  	echo ("Back to Administration");
  }

}
?>
