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

$username_brewblog = "";

/* 
INSERT YOUR PASSWORD BETWEEN THE DOUBLE-QUOTATION MARKS ("").
For example, if your password is flintstone then the line should read $password_brewblog = "flintsone".
*/

$password_brewblog = "";

/*
The following line is the name of your MySQL database you set up already.  
If you haven't set up the database yet, please refer to http://www.brewblogger.net/ for setup instructions. 
*/

$database_brewing = "";

/* 
This line strings the information together and connects to MySQL.  
If MySQL is not found or the username/password combo is not correct an error will be returned.
*/

$brewblog = mysql_connect($hostname_brewblog, $username_brewblog, $password_brewblog) or trigger_error(mysql_error());

/* 
Do not change the following line.
*/
$brewing = $brewblog; 

/******End MySQL Connections*******

/*

Set up your images directory path.  This is used for label image uploading.
Change this line to your installation's home directory on the server.
Generally something like /home/your_user_name/public_html/folder_name (do NOT put a forward slash [/] at the end).

******************************************************************************

CORRECT example if installation is in the web root folder:
$images_dir = "/home/public_html";

CORRECT example installation is in a sub-folder on your site:
$images_dir = "/home/public_html/brewblogger";

******************************************************************************

*/
$images_dir = "";

?>