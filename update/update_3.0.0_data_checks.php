<?php
/**
 * Automatic data updates for 3.0.0.
 *
 * Included from index.php on every request, before any recipe data is queried.
 * The checks run once per session; the work only runs when needed:
 *
 * 1. brewblogs table missing -> create it.
 * 2. brewblogs has never held any records (empty, AUTO_INCREMENT 1) and the
 *    obsolete brewing table has records -> convert them
 *    (update_3.0.0_convert_to_brewblogs.php).
 * 3. Legacy HTML entities in brewblogs/awards plain text -> decode them
 *    (update_3.0.0_decode_entities.php). Saves now store raw UTF-8, so any
 *    entity found there is legacy data.
 *
 * A MySQL named lock keeps two simultaneous requests from doing the work twice.
 * Results are written to the PHP error log.
 */

require_once (UPDATE.'update_3.0.0_decode_entities.php');

function brewblogs_table_exists($connection, $table) {
    $result = mysqli_query($connection, "SHOW TABLES LIKE '".$table."'");
    return (($result) && (mysqli_num_rows($result) > 0));
}

// Convert only into a brewblogs table that has never held records, so deleting
// every BrewBlog later doesn't bring the old brewing data back.
function brewblogs_conversion_needed($connection) {

    if ((!brewblogs_table_exists($connection, "brewing")) || (!brewblogs_table_exists($connection, "brewblogs"))) return FALSE;

    $row = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(*) FROM `brewblogs`"));
    if ($row[0] > 0) return FALSE;

    $row = mysqli_fetch_row(mysqli_query($connection, "SELECT `AUTO_INCREMENT` FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'brewblogs'"));
    if ((!empty($row[0])) && ($row[0] > 1)) return FALSE;

    $row = mysqli_fetch_row(mysqli_query($connection, "SELECT COUNT(*) FROM `brewing`"));
    return ($row[0] > 0);

}

function brewblogs_create_table($connection) {

    $sql = "CREATE TABLE IF NOT EXISTS `brewblogs` (
        `id` int(8) NOT NULL AUTO_INCREMENT,
        `brewOriginalID` int(8) DEFAULT NULL,
        `brewName` varchar(250) DEFAULT NULL,
        `brewDate` varchar(255) DEFAULT NULL,
        `brewCost` varchar(10) DEFAULT NULL,
        `brewInfo` text DEFAULT NULL,
        `brewMethod` varchar(200) DEFAULT NULL,
        `brewStyle` mediumtext DEFAULT NULL,
        `brewBrewerID` varchar(250) DEFAULT NULL,
        `brewBatchSize` float DEFAULT NULL,
        `brewBatchNum` varchar(100) DEFAULT NULL,
        `brewBoilSize` float DEFAULT NULL,
        `brewBoilTime` tinyint(4) DEFAULT NULL,
        `brewEfficiency` tinyint(4) DEFAULT NULL,
        `brewOG` mediumtext DEFAULT NULL,
        `brewFG` mediumtext DEFAULT NULL,
        `brewABV` mediumtext DEFAULT NULL,
        `brewIBU` float DEFAULT NULL,
        `brewIBUFormula` varchar(250) DEFAULT NULL,
        `brewColor` float DEFAULT NULL,
        `brewColorFormula` varchar(255) DEFAULT NULL,
        `brewCarbonation` float DEFAULT NULL,
        `brewCondition` varchar(100) DEFAULT NULL,
        `brewHops` mediumtext DEFAULT NULL,
        `brewFermentables` mediumtext DEFAULT NULL,
        `brewMiscs` mediumtext DEFAULT NULL,
        `brewYeasts` mediumtext DEFAULT NULL,
        `brewMash` mediumtext DEFAULT NULL,
        `brewMashGravities` mediumtext DEFAULT NULL,
        `brewEquipment` mediumtext DEFAULT NULL,
        `brewWater` mediumtext DEFAULT NULL,
        `brewPrimary` text DEFAULT NULL,
        `brewSecondary` text DEFAULT NULL,
        `brewTertiary` text DEFAULT NULL,
        `brewLager` text DEFAULT NULL,
        `brewAge` text DEFAULT NULL,
        `brewFermGravities` mediumtext DEFAULT NULL,
        `brewComments` text DEFAULT NULL,
        `brewProcedure` text DEFAULT NULL,
        `brewSpecialProcedure` text DEFAULT NULL,
        `brewStatus` varchar(250) DEFAULT NULL,
        `brewTapDate` varchar(250) DEFAULT NULL,
        `brewLabelImage` varchar(250) DEFAULT NULL,
        `brewFeatured` tinyint(1) DEFAULT NULL,
        `brewArchive` tinyint(1) DEFAULT NULL,
        `brewTapLocation` text DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    return mysqli_query($connection, $sql);

}

// InnoDB doesn't roll back the AUTO_INCREMENT counter (inserting the original ids raises it), so
// reset it too - otherwise brewblogs_conversion_needed() would treat the empty table as used.
function brewblogs_rollback_conversion($connection) {
    mysqli_rollback($connection);
    mysqli_query($connection, "ALTER TABLE `brewblogs` AUTO_INCREMENT = 1");
}

// Included from a function so the conversion's many working variables stay out of page scope.
// All-or-nothing: a partial conversion would leave brewblogs non-empty, and it would never be
// retried. On any error the transaction is rolled back (as it also is if PHP dies mid-run and
// the connection closes uncommitted), so brewblogs stays empty and a later page load retries.
function brewblogs_run_conversion($connection, $db_conn, $purifier) {
    require_once (ADMIN_INCLUDES.'constants.inc.php'); // MAX_EXT, MAX_GRAINS, etc.
    mysqli_begin_transaction($connection);
    try {
        include (UPDATE.'update_3.0.0_convert_to_brewblogs.php');
    }
    catch (Throwable $e) {
        brewblogs_rollback_conversion($connection);
        return array("converted" => 0, "errors" => array($e->getMessage()." in ".basename($e->getFile()).":".$e->getLine()), "rolled_back" => TRUE);
    }
    if (!empty($convert_report['errors'])) {
        brewblogs_rollback_conversion($connection);
        $convert_report['converted'] = 0;
        $convert_report['rolled_back'] = TRUE;
        return $convert_report;
    }
    mysqli_commit($connection);
    return $convert_report;
}

if (empty($_SESSION['data_checked_'.$prefix_session])) {

    $data_update_complete = TRUE;
    $data_update_table_missing = !brewblogs_table_exists($connection, "brewblogs");

    if (($data_update_table_missing) || (brewblogs_conversion_needed($connection)) || (decode_entities_needed($connection))) {

        $data_update_lock = mysqli_query($connection, "SELECT GET_LOCK('brewblogger_data_update', 0)");
        $data_update_locked = (($data_update_lock) && (mysqli_fetch_row($data_update_lock)[0] == 1));

        // Another request is already doing the work; check again on a later page load
        if (!$data_update_locked) $data_update_complete = FALSE;

        else {

            @set_time_limit(300);

            // Re-check now that the lock is held - another request may have just finished
            if (!brewblogs_table_exists($connection, "brewblogs")) {
                if (brewblogs_create_table($connection)) error_log("BrewBlogger data update: created the brewblogs table");
                else {
                    error_log("BrewBlogger data update: could not create the brewblogs table: ".mysqli_error($connection));
                    $data_update_complete = FALSE;
                }
            }

            if (brewblogs_conversion_needed($connection)) {
                require_once (CLASSES.'htmlpurifier/HTMLPurifier.standalone.php');
                $data_update_report = brewblogs_run_conversion($connection, $db_conn, new HTMLPurifier(HTMLPurifier_Config::createDefault()));
                if (!empty($data_update_report['rolled_back'])) {
                    error_log("BrewBlogger data update: converting brewing to brewblogs FAILED and was rolled back (will retry): ".implode(" | ", $data_update_report['errors']));
                    $data_update_complete = FALSE;
                }
                else error_log("BrewBlogger data update: converted ".$data_update_report['converted']." records from brewing to brewblogs");
            }

            if (decode_entities_needed($connection)) {
                $data_update_report = decode_entities_run($connection, TRUE);
                if ($data_update_report['error'] !== "") {
                    error_log("BrewBlogger data update: decoding HTML entities failed: ".$data_update_report['error']);
                    $data_update_complete = FALSE;
                }
                else error_log("BrewBlogger data update: decoded HTML entities in ".$data_update_report['written']." records".(empty($data_update_report['problems']) ? "" : "; skipped: ".implode(" | ", $data_update_report['problems'])));
            }

            mysqli_query($connection, "SELECT RELEASE_LOCK('brewblogger_data_update')");

        }

    }

    if ($data_update_complete) $_SESSION['data_checked_'.$prefix_session] = TRUE;

}
?>
