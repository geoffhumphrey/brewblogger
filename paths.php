<?php
/**
 * Module:      paths.php
 * Description: This module sets global file folder paths.
 *
 */

define('ROOT',dirname( __FILE__ ).DIRECTORY_SEPARATOR);
define('CONFIG',ROOT.'site'.DIRECTORY_SEPARATOR);
define('INCLUDES',ROOT.'includes'.DIRECTORY_SEPARATOR);
define('LIB',ROOT.'lib'.DIRECTORY_SEPARATOR);
define('DB',ROOT.'includes'.DIRECTORY_SEPARATOR.'db'.DIRECTORY_SEPARATOR);
define('BEERXML',ROOT.'includes'.DIRECTORY_SEPARATOR.'beerXMLparser'.DIRECTORY_SEPARATOR);
define('SECTIONS',ROOT.'sections'.DIRECTORY_SEPARATOR);
define('ADMIN',ROOT.'admin'.DIRECTORY_SEPARATOR);
define('ADMIN_INCLUDES',ROOT.'admin'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR);
define('ADMIN_SECTIONS',ROOT.'admin'.DIRECTORY_SEPARATOR.'admin_sections'.DIRECTORY_SEPARATOR);
define('ADMIN_TOOLS',ROOT.'admin'.DIRECTORY_SEPARATOR.'tools'.DIRECTORY_SEPARATOR);
define('ADMIN_LIBRARY',ROOT.'admin'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);
define('LABEL_IMAGES',ROOT.'label_images'.DIRECTORY_SEPARATOR);
define('REFERENCE',ROOT.'reference'.DIRECTORY_SEPARATOR);
define('RECIPE',ROOT.'sections'.DIRECTORY_SEPARATOR.'recipe'.DIRECTORY_SEPARATOR);
define('TEMPLATES',ROOT.'templates'.DIRECTORY_SEPARATOR);
define('CLASSES',ROOT.'classes'.DIRECTORY_SEPARATOR);
define('IMAGES_DIR',ROOT.'images'.DIRECTORY_SEPARATOR);
define('VENDORS_DIR', ROOT.'vendor'.DIRECTORY_SEPARATOR);
define('UPDATE', ROOT.'update'.DIRECTORY_SEPARATOR);
define('DEBUG_SCRIPTS', ROOT.'includes'.DIRECTORY_SEPARATOR.'debug'.DIRECTORY_SEPARATOR);

// --------------------------------------------------------
// Global Definitions
// --------------------------------------------------------
define('HOSTED', FALSE);
define('MAINT', FALSE);
define('TESTING', FALSE);
define('SINGLE', FALSE);
define('DEBUG', TRUE);
define('DEBUG_SESSION_VARS', TRUE);
define('FORCE_UPDATE', FALSE);
define('SEF', FALSE);

// --------------------------------------------------------
// Error Reporting
// --------------------------------------------------------

ini_set('error_reporting', E_ALL ^ E_DEPRECATED);
ini_set('log_errors','On');
if (DEBUG) ini_set('display_errors','On');
else ini_set('display_errors','Off');

// --------------------------------------------------------
// Load Configuration
// --------------------------------------------------------
require (CONFIG.'config.php');

// --------------------------------------------------------
// Declare Character Set
// --------------------------------------------------------
header('Content-Type:text/html; charset=UTF-8');
ini_set('default_charset', 'UTF-8');

?>