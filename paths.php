<?php 
/**
 * Module:      paths.php 
 * Description: This module sets global file folder paths.
 * 
 */

define('ROOT',dirname( __FILE__ ).DIRECTORY_SEPARATOR);
define('CONFIG',ROOT.'site'.DIRECTORY_SEPARATOR);
define('INCLUDES',ROOT.'includes'.DIRECTORY_SEPARATOR);
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

require(CONFIG.'config.php');
?>