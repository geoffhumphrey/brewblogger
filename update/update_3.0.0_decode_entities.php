<?php
// -----------------------------------------------------------
// One-time conversion: decode HTML entities in stored plain text
// -----------------------------------------------------------
// BrewBlogger historically stored plain text HTML-encoded ("M&auml;rzen",
// "Geoff&#039;s"). Text is now stored as raw UTF-8 and escaped at output
// with h(), so existing values are decoded to match.
//
// Covers the live user data only:
//   brewblogs - plain-text columns and every string inside the JSON columns
//   awards    - plain-text columns
// NOT changed: rich-text (HTML) columns - brewInfo, brewComments,
// brewProcedure, brewSpecialProcedure - and all other tables.
//
// Runs automatically: update_3.0.0_data_checks.php (included from index.php)
// calls decode_entities_needed() and decode_entities_run().
//
// It can also be run by hand from the command line. Dry run by default:
//   C:\xampp\php\php.exe update\update_3.0.0_decode_entities.php            (dry run: report changes)
//   C:\xampp\php\php.exe update\update_3.0.0_decode_entities.php --verbose  (dry run: list every change)
//   C:\xampp\php\php.exe update\update_3.0.0_decode_entities.php --apply    (write, in one transaction)
// -----------------------------------------------------------

// Tables and columns to decode
function decode_entities_columns() {
    return array(
        'brewblogs' => array(
            'text' => array('brewName', 'brewBatchNum', 'brewCondition', 'brewStatus', 'brewMethod', 'brewIBUFormula', 'brewColorFormula', 'brewLabelImage'),
            'json' => array('brewStyle', 'brewFermentables', 'brewHops', 'brewMiscs', 'brewYeasts', 'brewMash', 'brewEquipment', 'brewWater', 'brewPrimary', 'brewSecondary', 'brewTertiary', 'brewAge', 'brewTapLocation', 'brewMashGravities', 'brewFermGravities'),
        ),
        'awards' => array(
            'text' => array('awardBrewName', 'awardContest', 'awardContestURL', 'awardStyle', 'awardProamName', 'awardProamURL'),
            'json' => array(),
        ),
    );
}

// Named, decimal or hex entity; the same pattern is used in PHP and in MySQL REGEXP
function decode_entities_pattern() {
    return '&([a-zA-Z][a-zA-Z0-9]*|#[0-9]+|#x[0-9a-fA-F]+);';
}

// Decode until stable, so double-encoded values ("&amp;apos;") are fully restored
function decode_entities_text($value) {
    for ($i = 0; $i < 3; $i++) {
        $decoded = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        if ($decoded === $value) break;
        $value = $decoded;
    }
    // Repair mojibake ("MÃ¤rzen": UTF-8 that was once read as Windows-1252). Only accept the
    // repair if it yields valid UTF-8, so genuine text such as "São" is left alone.
    if (preg_match('/[ÃÂ]/u', $value)) {
        $repaired = mb_convert_encoding($value, 'Windows-1252', 'UTF-8');
        if (($repaired !== $value) && (mb_check_encoding($repaired, 'UTF-8'))) $value = $repaired;
    }
    return $value;
}

// Decode every string (and string key, e.g., tap location names) in decoded JSON
function decode_entities_json($data) {
    if (is_string($data)) return decode_entities_text($data);
    if (!is_array($data)) return $data;
    $out = array();
    foreach ($data as $key => $value) {
        if (is_string($key)) $key = decode_entities_text($key);
        $out[$key] = decode_entities_json($value);
    }
    return $out;
}

// The configured columns that exist in this database (e.g., awardProam* were added later)
function decode_entities_existing_columns($connection) {
    $existing = array();
    foreach (decode_entities_columns() as $table => $columns) {
        $result = mysqli_query($connection, "SHOW TABLES LIKE '".$table."'");
        if (mysqli_num_rows($result) == 0) continue;
        $fields = array();
        $result = mysqli_query($connection, "SHOW COLUMNS FROM `".$table."`");
        while ($row = mysqli_fetch_assoc($result)) $fields[] = $row['Field'];
        $existing[$table] = array(
            'text' => array_values(array_intersect($columns['text'], $fields)),
            'json' => array_values(array_intersect($columns['json'], $fields)),
        );
    }
    return $existing;
}

// TRUE if any configured column still holds an HTML entity (one LIMIT 1 query per table)
function decode_entities_needed($connection) {
    foreach (decode_entities_existing_columns($connection) as $table => $columns) {
        $conditions = array();
        foreach (array_merge($columns['text'], $columns['json']) as $column) $conditions[] = "`".$column."` REGEXP '".decode_entities_pattern()."'";
        if (empty($conditions)) continue;
        $result = mysqli_query($connection, "SELECT 1 FROM `".$table."` WHERE ".implode(" OR ", $conditions)." LIMIT 1");
        if (($result) && (mysqli_num_rows($result) > 0)) return TRUE;
    }
    return FALSE;
}

// Find (and with $apply, write) every change. Returns updates, per-column counts, skipped values,
// records written, and an error message if the write was rolled back.
function decode_entities_run($connection, $apply = FALSE) {

    $report = array('updates' => array(), 'summary' => array(), 'problems' => array(), 'written' => 0, 'error' => "");
    $pattern = '/'.decode_entities_pattern().'/';

    foreach (decode_entities_existing_columns($connection) as $table => $columns) {

        $all_columns = array_merge($columns['text'], $columns['json']);
        if (empty($all_columns)) continue;
        $result = mysqli_query($connection, "SELECT `id`, `".implode("`, `", $all_columns)."` FROM `".$table."` ORDER BY `id`");

        while ($row = mysqli_fetch_assoc($result)) {

            $changes = array();

            foreach ($columns['text'] as $column) {
                $value = $row[$column];
                if (($value === NULL) || (!preg_match($pattern, $value))) continue;
                $new = decode_entities_text($value);
                if ($new !== $value) $changes[$column] = array($value, $new);
            }

            foreach ($columns['json'] as $column) {
                $value = $row[$column];
                if (($value === NULL) || (!preg_match($pattern, $value))) continue;
                $data = json_decode($value, true);
                if (!is_array($data)) {
                    $report['problems'][] = $table." id ".$row['id']." ".$column.": not valid JSON, left unchanged";
                    continue;
                }
                $decoded = decode_entities_json($data);
                if ($decoded === $data) continue;
                $new = json_encode($decoded);
                if (($new === false) || (json_decode($new, true) !== $decoded)) {
                    $report['problems'][] = $table." id ".$row['id']." ".$column.": could not re-encode, left unchanged";
                    continue;
                }
                $changes[$column] = array($value, $new);
            }

            if (!empty($changes)) {
                $report['updates'][] = array($table, $row['id'], $changes);
                foreach ($changes as $column => $pair) $report['summary'][$table.".".$column] = (isset($report['summary'][$table.".".$column])) ? $report['summary'][$table.".".$column] + 1 : 1;
            }

        }

    }

    if ((!$apply) || (empty($report['updates']))) return $report;

    mysqli_begin_transaction($connection);
    foreach ($report['updates'] as $update) {
        list($table, $id, $changes) = $update;
        $sets = array();
        $values = array();
        foreach ($changes as $column => $pair) {
            $sets[] = "`".$column."` = ?";
            $values[] = $pair[1];
        }
        $values[] = $id;
        $statement = mysqli_prepare($connection, "UPDATE `".$table."` SET ".implode(", ", $sets)." WHERE `id` = ?");
        mysqli_stmt_bind_param($statement, str_repeat("s", count($values) - 1)."i", ...$values);
        if (!mysqli_stmt_execute($statement)) {
            mysqli_rollback($connection);
            $report['error'] = "Failed on ".$table." id ".$id.": ".mysqli_stmt_error($statement)." - rolled back, no changes written";
            $report['written'] = 0;
            return $report;
        }
        $report['written']++;
    }
    mysqli_commit($connection);

    return $report;

}

// -----------------------------------------------------------
// Command line: only when this file is run directly, not when included
// -----------------------------------------------------------

if ((php_sapi_name() === 'cli') && (isset($argv[0])) && (realpath($argv[0]) === __FILE__)) {

    $apply = in_array('--apply', $argv);
    $verbose = in_array('--verbose', $argv);

    // site/config.php builds $connection; it expects a web request, so supply the server values it reads
    $_SERVER += array('SERVER_NAME' => 'localhost', 'SERVER_PORT' => 80, 'HTTP_HOST' => 'localhost');
    ob_start();
    require (dirname(__DIR__).DIRECTORY_SEPARATOR.'paths.php');
    require_once (CONFIG.'config.php');
    ob_end_clean();
    mysqli_set_charset($connection, 'utf8mb4');

    $report = decode_entities_run($connection, $apply);
    $columns = decode_entities_columns();

    echo ($apply ? "APPLYING" : "DRY RUN - nothing will be written")."\n\n";
    echo "Records to update: ".count($report['updates'])."\n";
    foreach ($report['summary'] as $column => $count) echo "  ".str_pad($column, 32).$count."\n";
    if (!empty($report['problems'])) echo "\nSkipped:\n  ".implode("\n  ", $report['problems'])."\n";

    if ($verbose) {
        echo "\nChanges (decoded text shown; JSON columns show only the changed strings):\n";
        foreach ($report['updates'] as $update) {
            list($table, $id, $changes) = $update;
            foreach ($changes as $column => $pair) {
                list($old, $new) = $pair;
                if (in_array($column, $columns[$table]['json'])) {
                    preg_match_all('/"((?:[^"\\\\]|\\\\.)*'.decode_entities_pattern().'(?:[^"\\\\]|\\\\.)*)"/', $old, $strings);
                    foreach (array_unique($strings[1]) as $string) {
                        $plain = json_decode('"'.$string.'"');
                        echo "  ".$table." ".$id." ".$column.": ".$plain."  =>  ".decode_entities_text($plain)."\n";
                    }
                }
                else echo "  ".$table." ".$id." ".$column.": ".$old."  =>  ".$new."\n";
            }
        }
    }

    if ($report['error'] !== "") die("\n".$report['error']."\n");
    if ($apply) echo "\nUpdated ".$report['written']." records.\n";
    else echo "\nRun again with --apply to write these changes (back up the database first).\n";

}
?>
