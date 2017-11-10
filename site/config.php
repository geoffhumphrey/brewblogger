<?php
/*******Set up MySQL connection variables*******
Generally, this line is left alone.
*/
$hostname_brewblog = "localhost";

/*
Change the word root to the username for your database (generally the same as your login code for your web hosting company).
INSERT YOUR USERNAME BETWEEN THE DOUBLE-QUOTATION MARKS ("").
For example, if your username is fred then the line should read $username_brewblog = "fred".
*/

$username = "zkdigita_zkdigit";

/*
INSERT YOUR PASSWORD BETWEEN THE DOUBLE-QUOTATION MARKS ("").
For example, if your password is flintstone then the line should read $password_brewblog = "flintsone".
*/

$password = "zakary";

/*
The following line is the name of your MySQL database you set up already.
If you haven't set up the database yet, please refer to http://www.brewblogger.net/ for setup instructions.
*/

$database = "zkdigita_brewblog";

/*
This line strings the information together and connects to MySQL.
If MySQL is not found or the username/password combo is not correct an error will be returned.
*/

$connection = new mysqli($hostname_brewblog, $username, $password, $database);

/*
Do not change the following two lines.
*/
$brewing = $connection;
mysqli_select_db($connection,$database);

$sub_directory = "";
$prefix = "";

$base_url = "";
if ((!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== "off")) || ($_SERVER['SERVER_PORT'] == 443)) $base_url .= "https://";
else $base_url .= "http://";

// ONLY alter this line if needed (see above):
$base_url .= $_SERVER['SERVER_NAME'].$sub_directory."/";

?>