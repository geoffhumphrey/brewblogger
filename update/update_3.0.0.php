<?php

// include (UPDATE.'update_3.0.0_brewing_table_conversion.php');
// include (UPDATE.'update_3.0.0_recipe_table_conversion.php');
// include (UPDATE.'update_3.0.0_utf8mb4_fields_conversion.php');

if (!check_update("prefsLanguage", $prefix."preferences")) {
    $updateSQL = "ALTER TABLE `brewer` ADD `uid` INT(8) NULL DEFAULT NULL COMMENT 'ID of user in users table' AFTER `id`;";
    mysqli_select_db($connection,$database);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
}

?>