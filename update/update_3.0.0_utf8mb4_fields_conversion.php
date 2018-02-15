<?php
/**
 * Alter Tables: ALL
 * Function to convert all tables and text fields to UTF8
 * For future internationalization and translations effort
 */

$target_charset = "utf8mb4";
$target_collate = "utf8mb4_unicode_ci";
$output = "";

function MysqlError($connection) {
    if (mysqli_errno($connection)) {
        return "<li>MySQL Error: " . mysqli_error($connection) . "</li>";
    }
}

$count = array();
$tabs = array();
$res = mysqli_query($connection,"SHOW TABLES");

$output .= MysqlError($connection);

while (($row = mysqli_fetch_row($res)) != null) {
    if (!empty($prefix)) {
        if (strpos($row[0], $prefix) !== false) $tabs[] = $row[0];
    } else $tabs[] = $row[0];
}

if (!empty($tabs)) {

    // Convert tables

    foreach ($tabs as $tab) {
        $res = mysqli_query($connection,"show index from {$tab}");
        $output .= MysqlError($connection);
        $indicies = array();

        while (($row = mysqli_fetch_array($res)) != null) {

            if ($row[2] != "PRIMARY") {

                $indicies[] = array("name" => $row[2], "unique" => !($row[1] == "1"), "col" => $row[4]);
                mysqli_query($connection,"ALTER TABLE {$tab} DROP INDEX {$row[2]}");
                $output .= MysqlError($connection);
                $output .= "<li>Dropped index {$row[2]}. Unique: {$row[1]}</li>";
                $count[] = 1;

            }

            else $count[] = 0;

        }


        $res = mysqli_query($connection,"DESCRIBE {$tab}");
        $output .= MysqlError($connection);

        while (($row = mysqli_fetch_array($res)) != null) {

            $name = $row[0];
            $type = $row[1];
            $set = false;

            if (preg_match("/^varchar\((\d+)\)$/i", $type, $mat)) {

                $size = $mat[1];
                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} VARBINARY({$size})");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} VARCHAR({$size}) CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;

            }

            elseif (preg_match("/^char\((\d+)\)$/i", $type, $mat)) {

                $size = $mat[1];
                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} CHAR({$size}) CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;

            }

            elseif (!strcasecmp($type, "CHAR")) {

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} BINARY(1)");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} VARCHAR(1) CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} CHAR(1) CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;

            }

            elseif (!strcasecmp($type, "TINYTEXT")) {

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} TINYBLOB");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} TINYTEXT CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;

            }

            elseif (!strcasecmp($type, "MEDIUMTEXT")) {

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} MEDIUMBLOB");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} MEDIUMTEXT CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;

            }

            elseif (!strcasecmp($type, "LONGTEXT")) {

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} LONGBLOB");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} LONGTEXT CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;
            }

            else if (!strcasecmp($type, "TEXT")) {

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} BLOB");
                $output .= MysqlError($connection);

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} TEXT CHARACTER SET {$target_charset}");
                $output .= MysqlError($connection);

                $set = TRUE;
                $output .= "<li>Altered field {$name} on {$tab} to type {$type} {$target_collate}.</li>";
                $count[] = 1;

            }

            else $count[] = 0;

            if ($set) {

                mysqli_query($connection,"ALTER TABLE {$tab} MODIFY {$name} COLLATE {$target_collate}");
                $count[] = 1;

            }

            else $count[] = 0;
        }

        // Re-build indicies...
        foreach ($indicies as $index) {

            if ($index["unique"]) {

                mysqli_query($connection,"CREATE UNIQUE INDEX {$index["name"]} ON {$tab} ({$index["col"]})");
                $output .= MysqlError($connection);
                $count[] = 1;

            }

            else {

                mysqli_query($connection,"CREATE INDEX {$index["name"]} ON {$tab} ({$index["col"]})");
                $output .= MysqlError($connection);
                $count[] = 1;

            }

            $output .= "<li>Created index {$index["name"]} on {$tab}. Unique: {$index["unique"]}</li>";
            $count[] = 1;
        }

        // set default collate
        mysqli_query($connection,"ALTER TABLE {$tab}  DEFAULT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
        $count[] = 1;
    }

    // set database charset
    mysqli_query($connection,"ALTER DATABASE {$database} DEFAULT CHARACTER SET {$target_charset} COLLATE {$target_collate}");
    $count[] = 1;

}

echo "<h3>Update DB to Unicode</h3><p>The following fields have been updated to utf8mb4.</p><ul>".$output."</ul>";

?>