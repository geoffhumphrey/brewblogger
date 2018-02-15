<?php
/**
 * Module:        config.php
 * Description:   This module houses configuration variables for DB connection, etc.
 *
 * Last Modified: December 13, 2017
 */

/**
 * ******************************************************************************
 * Set up MySQL connection variables
 * ******************************************************************************
 */

/**
 * Generally, this line is left alone.
 */

$hostname = "localhost";

/**
 * Change the word root to the username for your database (generally the same as
 * your login code for your web hosting company).
 * INSERT YOUR USERNAME BETWEEN THE DOUBLE-QUOTATION MARKS ("").
 * For example, if your username is fred then the line should read $username = "fred".
 */

$username = "";

/**
 * INSERT YOUR PASSWORD BETWEEN THE DOUBLE-QUOTATION MARKS ("").
 * For example, if your password is flintstone then the line should read $password = "flintsone".
 */

$password = "";

/**
 * The following line is the name of your MySQL database you set up already.
 */

$database = "";

/**
 * If the database port is different from the default then overwrite as the port integer
 * Example: $database_port = 3308;
 */

$database_port = ini_get('mysqli.default_port');

/**
 * This line strings the information together and connects to MySQL.
 * If MySQL is not found or the username/password combo is not correct an error will
 * be returned.
 */

$connection = new mysqli($hostname, $username, $password, $database, $database_port);
mysqli_set_charset($connection,'utf8mb4');
mysqli_query($connection, "SET NAMES 'utf8mb4';");
mysqli_query($connection, "SET CHARACTER SET 'utf8mb4';");
mysqli_query($connection, "SET COLLATION_CONNECTION = 'utf8mb4_unicode_ci';");

/**
 * Do not change the following lines.
 */

$brewing = $connection;
mysqli_select_db($connection,$database);

/**
 * ******************************************************************************
 * End MySQL connections variables
 * ******************************************************************************
 */

/*
 * ******************************************************************************
 * DB Prefix.
 * ******************************************************************************
 * The following variable is used to define a prefix to the database tables.
 * This is useful if you wish to have separate installations or applications share
 * the same mySQL database.
 *
 * Leave as if you have a database dedicated to your installation.
 *
 * Suggested Usage
 * If you wish to define a prefix to the database tables, it is HIGHLY suggested
 * that you use an underscore (_), after a short descriptor that identifies which
 * install is using which tables.
 * Example:
 * $prefix = "brewblog1_";
 * OR
 * $prefix = "mybrewblog_";
 */

$prefix = "";

/*
 * ******************************************************************************
 * User session time out
 * ******************************************************************************
 * Define the time (in minutes) that a user's session will be active before it
 * expires due to inactivity. Default is 30 minutes.
 */

$session_expire_after = 30;

/*
 * ******************************************************************************
 * Set the subdirector of your installation (if necessary).
 * ******************************************************************************
 * In most cases the default will be OK.
 *
 * IF YOU ARE RUNNING YOUR INSTANCE OF BCOE&M IN A SUBFOLDER...
 *
 * Add the name of the subdirectory between the quotes of the $sub_directory
 * variable.
 *
 * Be sure to INCLUDE a leading slash [/] and NO trailing slash [/]!
 *
 * Example:
 * $sub_directory = "/brewblog";
 *
 * WARNING!!!
 * IF you do enable the subdirectory variable, YOU MUST alter your .htaccess file
 * Otherwise, the URLs will not be generated correctly! Directions are in the
 * .htaccess file.
 */

$sub_directory = "";

/*
 * ******************************************************************************
 * Set the base URL of your installation.
 * ******************************************************************************
 * In most cases the default will be OK.
 *
 * IF you are installing on a server where you do not have a domain name set up,
 * you'll need to replace the last $base_url variable below with something
 * formatted like this:
 * $base_url .= "yourhostingdomain/~accountname/subdirectoryname/";
 *
 * Example:
 * $base_url .= "147.21.160.5/~brewblogger/brewblog/";
 * OR:
 * $base_url .= "www.bluehost.com/~brewblogger/brewblog/";
 */

$base_url = "";
if ((!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== "off")) || ($_SERVER['SERVER_PORT'] == 443)) $base_url .= "https://";
else $base_url .= "http://";
$base_url .= $_SERVER['SERVER_NAME'].$sub_directory."/";

/*
 * ******************************************************************************
 * Set the server root for your installation.
 * ******************************************************************************
 * In most cases the default will be OK.
 *
 * IF you are installing on a server and will access the software via a sub-domain
 * (e.g. http://subdomain.domain.com), comment out the first variable below and
 * uncomment the second variable ONLY if you are experiencing issues. Otherwise,
 * the default will suffice.
 */

$server_root = $_SERVER['DOCUMENT_ROOT'];
//$server_root = $_SERVER['SUBDOMAIN_DOCUMENT_ROOT'];
?>