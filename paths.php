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
define('CLASSES',ROOT.'classes'.DIRECTORY_SEPARATOR);
define('IMAGES_DIR',ROOT.'images'.DIRECTORY_SEPARATOR);
define('UPDATE', ROOT.'update'.DIRECTORY_SEPARATOR);
define('DEBUG_SCRIPTS', ROOT.'includes'.DIRECTORY_SEPARATOR.'debug'.DIRECTORY_SEPARATOR);

// --------------------------------------------------------
// Global Definitions
// --------------------------------------------------------
define('MAINT', FALSE);
define('TESTING', TRUE);
define('DEBUG', TRUE);
define('DEBUG_SESSION_VARS', FALSE);
define('FORCE_UPDATE', FALSE);
define('SEF', TRUE);

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
require_once (CONFIG.'config.php');
require_once (CONFIG.'MysqliDb.php');
$db_conn = new MysqliDb($connection);

// --------------------------------------------------------
// Declare Character Set
// --------------------------------------------------------
header('Content-Type:text/html; charset=UTF-8');
ini_set('default_charset', 'UTF-8');

date_default_timezone_set('America/Denver');
$timezone = date_default_timezone_get();

/**
 * General sanitization function.
 * Needs to be top-level due to use in 
 * url_variables.inc.php file.
 */

if (!function_exists('sterilize')) {
	function sterilize($sterilize = NULL) {
	    if ($sterilize == NULL) return "";
	    elseif (empty($sterilize)) return $sterilize;
	    else {
	        $sterilize = trim($sterilize);
	        if (is_numeric($sterilize)) {
	            if (is_float($sterilize)) $sterilize = filter_var($sterilize,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	            if (is_int($sterilize)) $sterilize = filter_var($sterilize,FILTER_SANITIZE_NUMBER_INT);
	        }
	        else $sterilize = filter_var($sterilize,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	        $sterilize = strip_tags($sterilize);
	        $sterilize = stripcslashes($sterilize);
	        $sterilize = stripslashes($sterilize);
	        $sterilize = addslashes($sterilize);
	        return $sterilize;
	    }
	}
}

/**
 * Clean a plain-text value (names, notes, labels) for storage.
 * Stored as raw UTF-8 - NOT HTML-encoded - and escaped at output with h().
 * Legacy/imported entities are decoded so "M&auml;rzen" is saved as "Märzen".
 * Not for rich-text fields; those go through HTMLPurifier.
 */

if (!function_exists('clean_text')) {
	function clean_text($value = NULL) {
	    // Empty XML elements arrive from the BeerXML parser as empty arrays
	    if (($value === NULL) || (is_array($value))) return "";
	    $value = html_entity_decode((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	    $value = strip_tags($value);
	    $value = str_replace("\0", "", $value);
	    return trim($value);
	}
}

/**
 * Store empty values as NULL. Top-level (not in common.lib.php) because the
 * automatic data updates run before common.lib.php is loaded.
 */

if (!function_exists('blank_to_null')) {
	function blank_to_null($var) {
		if ((!isset($var)) || (empty($var))) $var = NULL;
		return $var;
	}
}

// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);

?>