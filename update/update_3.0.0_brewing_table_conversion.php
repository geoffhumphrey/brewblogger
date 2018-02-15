<?php
/**
 * Alter Tables: Brewing Table
 * Function to convert finite fermentables, hops, and misc fields
 * to a single line of text, allowing for the possibility of
 * adding unlimited amounts of each type of ingredient.
 */

// A carrot ^ separates each ingredient
// Pipes | separate each ingredient's data points (weight, type, etc)

$convert_all_brewblogs = "";
$db_table = $prefix."brewing";
$errors = "";

// Add the new table columns
if (!check_update("brewFermentables", $db_table)) {
    $updateSQL = sprintf("ALTER TABLE `%s` ADD `brewFermentables` MEDIUMTEXT NULL DEFAULT NULL AFTER `brewInfo`;",$db_table);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
}

if (!check_update("brewHops", $db_table)) {
    $updateSQL = sprintf("ALTER TABLE `%s` ADD `brewHops` MEDIUMTEXT NULL DEFAULT NULL AFTER `brewFermentables`;",$db_table);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
}

if (!check_update("brewMisc", $db_table)) {
    $updateSQL = sprintf("ALTER TABLE `%s` ADD `brewMisc` MEDIUMTEXT NULL DEFAULT NULL AFTER `brewHops`;",$db_table);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
}

// Loop through the table and construct the ingredient variables for each record
do {

    $convert_misc = "";
    $convert_hops = "";
    $convert_fermentables = "";

    // BEGIN Extracts
    for ($i = 1; $i <= MAX_EXT; $i++) {

        $extract_id = "";
        $key_name = "brewExtract".$i;

        // First, check if the extract exists in the extract DB table
        $query_extracts = sprintf("SELECT id FROM extract WHERE extractName='%s'",$row_brewBlogs[$key_name]);
        $extracts = mysqli_query($connection,$query_extracts);
        $row_extracts = mysqli_fetch_assoc($extracts);
        $totalRows_extracts = mysqli_num_rows($extracts);

        // If not, add it to the extract DB table
        if ($totalRows_extracts == 0) {

            // If not, add it to the extract DB table
            if (!empty($row_brewBlogs[$key_name])) {
                $insertSQL = sprintf("INSERT INTO extract  (`id`, `extractName`, `extractLovibond`, `extractInfo`, `extractCategory`, `extractYield`, `extractOrigin`, `extractSupplier`, `extractType`) VALUES (NULL, '%s', NULL, NULL, '1', NULL, NULL, NULL, 'Extract')", $row_brewBlogs[$key_name]);
                mysqli_real_escape_string($connection,$insertSQL);
                $result = mysqli_query($connection,$insertSQL);

                // Grab its id
                $query_extract = "SELECT id FROM extract ORDER BY id DESC LIMIT 1";
                $extract = mysqli_query($connection,$query_extract);
                $row_extract = mysqli_fetch_assoc($extract);

                $extract_id .= $row_extract['id'];
            }

        }

        else $extract_id .= $row_extracts['id'];

        if ((!empty($extract_id)) && (isset($row_brewBlogs[$key_name]))) {
            $convert_fermentables .= "e|";
            $convert_fermentables .= $extract_id."|";
            $key_weight = "brewExtract".$i."Weight";
            $extract_weight = number_format(filter_var($row_brewBlogs[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($row_brewBlogs[$key_weight] > 0) $convert_fermentables .= $extract_weight;
            else $convert_fermentables .= "0";
            $convert_fermentables .= "^";
        }

    }

    // END Extracts

    // BEGIN Grains/Malts

    for ($i = 1; $i <= MAX_GRAINS; $i++) {

        $grain_id = "";
        $key_name = "brewGrain".$i;

        // First, check if the grain exists in the grain DB table
        $query_grains = sprintf("SELECT id FROM malt WHERE maltName='%s'",$row_brewBlogs[$key_name]);
        $grains = mysqli_query($connection,$query_grains);
        $row_grains = mysqli_fetch_assoc($grains);
        $totalRows_grains = mysqli_num_rows($grains);

        // If not, add it to the grain DB table
        if ($totalRows_grains == 0) {

            // If not, add it to the grain DB table
            if (!empty($row_brewBlogs[$key_name])) {
                $insertSQL = sprintf("INSERT INTO malt (`id`, `maltName`, `maltLovibond`, `maltInfo`, `maltCategory`, `maltYield`, `maltOrigin`, `maltSupplier`, `maltType`) VALUES (NULL, '%s', NULL, NULL, '1', NULL, NULL, NULL, NULL)", $row_brewBlogs[$key_name]);
                mysqli_real_escape_string($connection,$insertSQL);
                $result = mysqli_query($connection,$insertSQL);
                if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

                // Grab its id
                $query_grain = "SELECT id FROM malt ORDER BY id DESC LIMIT 1";
                $grain = mysqli_query($connection,$query_grain);
                $row_grain = mysqli_fetch_assoc($grain);

                $grain_id .= $row_grain['id'];
            }

        }

        else $grain_id .= $row_grains['id'];

        if ((!empty($grain_id)) && (isset($row_brewBlogs[$key_name]))) {
            $convert_fermentables .= "g|";
            $convert_fermentables .= $grain_id."|";
            $key_weight = "brewGrain".$i."Weight";
            $grain_weight = number_format(filter_var($row_brewBlogs[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($grain_weight > 0) $convert_fermentables .= $grain_weight;
            else $convert_fermentables .= "0";
            $convert_fermentables .= "^";
        }

    }

    // END Grains/Malts

    // BEGIN Adjuncts

    for ($i = 1; $i <= MAX_ADJ; $i++) {

        $adjunct_id = "";
        $key_name = "brewAddition".$i;

        // First, check if the adjunct exists in the adjunct DB table
        $query_adjuncts = sprintf("SELECT id FROM adjuncts WHERE adjunctName='%s'",$row_brewBlogs[$key_name]);
        $adjuncts = mysqli_query($connection,$query_adjuncts);
        $row_adjuncts = mysqli_fetch_assoc($adjuncts);
        $totalRows_adjuncts = mysqli_num_rows($adjuncts);

        // If not, add it to the adjunct DB table
        if ($totalRows_adjuncts == 0) {

            // If not, add it to the adjunct DB table
            if (!empty($row_brewBlogs[$key_name])) {
                $insertSQL = sprintf("INSERT INTO adjuncts (`id`, `adjunctName`, `adjunctLovibond`, `adjunctInfo`, `adjunctCategory`, `adjunctYield`, `adjunctOrigin`, `adjunctSupplier`, `adjunctType`) VALUES (NULL, '%s', NULL, NULL, NULL, NULL, NULL, NULL, NULL)", $row_brewBlogs[$key_name]);
                mysqli_real_escape_string($connection,$insertSQL);
                $result = mysqli_query($connection,$insertSQL);
                if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

                // Grab its id
                $query_adjunct = "SELECT id FROM adjuncts ORDER BY id DESC LIMIT 1";
                $adjunct = mysqli_query($connection,$query_adjunct);
                $row_adjunct = mysqli_fetch_assoc($adjunct);

                $adjunct_id .= $row_adjunct['id'];
            }

        }

        else $adjunct_id .= $row_adjuncts['id'];

        if ((!empty($adjunct_id)) && (isset($row_brewBlogs[$key_name]))) {
            $convert_fermentables .= "a|";
            $convert_fermentables .= $adjunct_id."|";
            $key_weight = "brewAddition".$i."Amt";
            $adjunct_weight = number_format(filter_var($row_brewBlogs[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($adjunct_weight > 0) $convert_fermentables .= $adjunct_weight;
            else $convert_fermentables .= "0";
            $convert_fermentables .= "^";
        }

    }

    // END Adjuncts

    // BEGIN Hops

    for ($i = 1; $i <= MAX_HOPS; $i++) {

        $hop_id = "";
        $key_name = "brewHops".$i;

        // First, check if the hop exists in the hop DB table
        $query_hops = sprintf("SELECT id FROM hops WHERE hopsName='%s'",$row_brewBlogs[$key_name]);
        $hops = mysqli_query($connection,$query_hops);
        $row_hops = mysqli_fetch_assoc($hops);
        $totalRows_hops = mysqli_num_rows($hops);

        // If not, add it to the hop DB table
        if ($totalRows_hops == 0) {

            // If not, add it to the hop DB table
            if (!empty($row_brewBlogs[$key_name])) {
                $insertSQL = sprintf("INSERT INTO hops (`id`, `hopsName`, `hopsGrown`, `hopsInfo`, `hopsUse`, `hopsExample`, `hopsAAULow`, `hopsAAUHigh`, `hopsSub`) VALUES (NULL, '%s', NULL, NULL, NULL, NULL, NULL, NULL, NULL)", $row_brewBlogs[$key_name]);
                mysqli_real_escape_string($connection,$insertSQL);
                $result = mysqli_query($connection,$insertSQL);
                if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

                // Grab its id
                $query_hop = "SELECT id FROM hops ORDER BY id DESC LIMIT 1";
                $hop = mysqli_query($connection,$query_hop);
                $row_hop = mysqli_fetch_assoc($hop);

                $hop_id .= $row_hop['id'];
            }

        }

        else $hop_id .= $row_hops['id'];

        if ((!empty($hop_id)) && (isset($row_brewBlogs[$key_name]))) {
            // id, Weight, IBU, Time, Use, Type, Form
            $convert_hops .= $hop_id."|";
            $key_weight = "brewHops".$i."Weight";
            $key_ibu = "brewHops".$i."IBU";
            $key_time = "brewHops".$i."Time";
            $key_use = "brewHops".$i."Use";
            $key_type = "brewHops".$i."Type";
            $key_form = "brewHops".$i."Form";

            $hop_weight = number_format(filter_var($row_brewBlogs[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($hop_weight > 0) $convert_hops .= $hop_weight."|";
            else $convert_hops .= "0|";

            $hop_ibu = number_format(filter_var($row_brewBlogs[$key_ibu],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($hop_ibu > 0) $convert_hops .= $hop_ibu."|";
            else $convert_hops .= "0|";

            $hop_time = number_format(filter_var($row_brewBlogs[$key_time],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),0);
            if ($hop_time > 0) $convert_hops .= $hop_time."|";
            else $convert_hops .= "0|";

            if (!empty($row_brewBlogs[$key_use])) $convert_hops .= $row_brewBlogs[$key_use]."|";
            else $convert_hops .= "*|";

            if (!empty($row_brewBlogs[$key_type])) $convert_hops .= $row_brewBlogs[$key_type]."|";
            else $convert_hops .= "*|";

            if (!empty($row_brewBlogs[$key_form])) $convert_hops .= $row_brewBlogs[$key_form];
            else $convert_hops .= "*";

            $convert_hops .= "^";

        }

    }

    // END Hops

    // BEGIN Misc

    for ($i = 1; $i <= MAX_MISC; $i++) {

        $misc_id = "";
        $key_name = "brewMisc".$i."Name";
        $key_type = "brewMisc".$i."Type";
        $key_use = "brewMisc".$i."Use";
        $key_time = "brewMisc".$i."Time";
        $key_amt = "brewMisc".$i."Amount";

        // First, check if the misc exists in the misc DB table
        $query_miscs = sprintf("SELECT id FROM misc WHERE miscName='%s'",$row_brewBlogs[$key_name]);
        $miscs = mysqli_query($connection,$query_miscs);
        $row_miscs = mysqli_fetch_assoc($miscs);
        $totalRows_miscs = mysqli_num_rows($miscs);

        // If not, add it to the misc DB table
        if ($totalRows_miscs == 0) {

            // If not, add it to the misc DB table
            if (!empty($row_brewBlogs[$key_name])) {
                $insertSQL = sprintf("INSERT INTO misc (`id`, `miscName`, `miscType`, `miscUse`, `miscNotes`) VALUES (NULL, '%s', '%s', '%s', NULL)", $row_brewBlogs[$key_name],$row_brewBlogs[$key_type],$row_brewBlogs[$key_use]);
                mysqli_real_escape_string($connection,$insertSQL);
                $result = mysqli_query($connection,$insertSQL);
                if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

                // Grab its id
                $query_misc = "SELECT id FROM misc ORDER BY id DESC LIMIT 1";
                $misc = mysqli_query($connection,$query_misc);
                $row_misc = mysqli_fetch_assoc($misc);

                $misc_id .= $row_misc['id'];
            }

        }

        else $misc_id .= $row_miscs['id'];

        if ((!empty($misc_id)) && (isset($row_brewBlogs[$key_name]))) {
            // Name, Type, Use, Time, Amount
            $convert_misc .= $misc_id."|";

            $key_type = "brewMisc".$i."Type";
            if (empty($row_brewBlogs[$key_type])) $convert_misc .= "*|";
            else $convert_misc .= $row_brewBlogs[$key_type]."|";

            $key_use = "brewMisc".$i."Use";
            if (empty($row_brewBlogs[$key_use])) $convert_misc .= "*|";
            else $convert_misc .= $row_brewBlogs[$key_use]."|";

            $key_time = "brewMisc".$i."Time";
            $misc_time = number_format(filter_var($row_brewBlogs[$key_time],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),0);
            if ($misc_time > 0) $convert_misc .= $misc_time."|";
            else $convert_misc .= "0|";

            $key_amt = "brewMisc".$i."Amount";
            if (!empty($row_brewBlogs[$key_amt])) $convert_misc .= $row_brewBlogs[$key_amt];
            else $convert_misc .= "0";
            $convert_misc .= "^";

        }

    }

    // END Misc

    // Bring it all together
    $convert_fermentables = rtrim($convert_fermentables,"^");
    $convert_hops = rtrim($convert_hops,"^");
    $convert_misc = rtrim($convert_misc,"^");

    $updateSQL = sprintf("UPDATE %s SET brewFermentables='%s', brewHops='%s', brewMisc='%s' WHERE id='%s'", $db_table, $convert_fermentables, $convert_hops, $convert_misc, $row_brewBlogs['id']);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
    if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

    if (DEBUG) $convert_all_brewblogs .= "<hr><p><strong>".$row_brewBlogs['brewName']."</strong> (".$row_brewBlogs['brewDate'].")<br>";
    else $convert_all_brewblogs .= "<li>".$row_brewBlogs['brewName']." (".$row_brewBlogs['brewDate'].") - ";

    if (!empty($convert_fermentables)) {
      if (DEBUG) $convert_all_brewblogs .= "Fermentables: ".$convert_fermentables."<br>";
      else $convert_all_brewblogs .= "fermentables, ";
    }

    if (!empty($convert_hops)) {
      if (DEBUG) $convert_all_brewblogs .= "Hops: ".$convert_hops."<br>";
      else $convert_all_brewblogs .= "hops, ";
    }

    if (!empty($convert_misc)) {
      if (DEBUG) $convert_all_brewblogs .= "Misc: ".$convert_misc."<br>";
      else $convert_all_brewblogs .= "micellaneous ingredients, ";
    }

    if (DEBUG) $convert_all_brewblogs .= "Query: ".$updateSQL."</p>";

    if (!DEBUG) {
      $convert_all_brewblogs = rtrim($convert_all_brewblogs,", ");
      $convert_all_brewblogs .= ".</li>";
    }

} while ($row_brewBlogs = mysqli_fetch_assoc($brewBlogs));

// Now that the items have been converted, drop the rows
for ($i = 1; $i <= MAX_EXT; $i++) {
    $key_name = "brewExtract".$i;
    $key_weight = "brewExtract".$i."Weight";
    $updateSQL = sprintf("ALTER TABLE `%s` DROP `%s`, DROP `%s`;",$db_table,$key_name,$key_weight);
    if (DEBUG) $convert_all_brewblogs .= $updateSQL."<br>";
    else {
        mysqli_real_escape_string($connection,$updateSQL);
        $result = mysqli_query($connection,$updateSQL);
        if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
    }
}

for ($i = 1; $i <= MAX_GRAINS; $i++) {
    $key_name = "brewGrain".$i;
    $key_weight = "brewGrain".$i."Weight";
    $updateSQL = sprintf("ALTER TABLE `%s` DROP `%s`, DROP `%s`;",$db_table,$key_name,$key_weight);
    if (DEBUG) $convert_all_brewblogs .= $updateSQL."<br>";
    else {
        mysqli_real_escape_string($connection,$updateSQL);
        $result = mysqli_query($connection,$updateSQL);
        if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
    }
}

for ($i = 1; $i <= MAX_ADJ; $i++) {
    $key_name = "brewAddition".$i;
    $key_weight = "brewAddition".$i."Amt";
    $updateSQL = sprintf("ALTER TABLE `%s` DROP `%s`, DROP `%s`;",$db_table,$key_name,$key_weight);
    if (DEBUG) $convert_all_brewblogs .= $updateSQL."<br>";
    else {
        mysqli_real_escape_string($connection,$updateSQL);
        $result = mysqli_query($connection,$updateSQL);
        if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
    }
}

for ($i = 1; $i <= MAX_HOPS; $i++) {
    $key_name = "brewHops".$i;
    $key_weight = "brewHops".$i."Weight";
    $key_ibu = "brewHops".$i."IBU";
    $key_time = "brewHops".$i."Time";
    $updateSQL = sprintf("ALTER TABLE `%s` DROP `%s`, DROP `%s, DROP `%s`, DROP `%s`;",$db_table,$key_name,$key_weight,$key_ibu,$key_time);
    if (DEBUG) $convert_all_brewblogs .= $updateSQL."<br>";
    else {
        mysqli_real_escape_string($connection,$updateSQL);
        $result = mysqli_query($connection,$updateSQL);
        if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
    }
}

for ($i = 1; $i <= MAX_MISC; $i++) {
    $key_name = "brewMisc".$i."Name";
    $key_type = "brewMisc".$i."Type";
    $key_use = "brewMisc".$i."Use";
    $key_time = "brewMisc".$i."Time";
    $key_amt = "brewMisc".$i."Amount";
    $updateSQL = sprintf("ALTER TABLE `%s` DROP `%s`, DROP `%s, DROP `%s`, DROP `%s`, DROP `%s`;",$db_table,$key_name,$key_type,$key_use,$key_time,$key_amt);
    if (DEBUG) $convert_all_brewblogs .= $updateSQL."<br>";
    else {
        mysqli_real_escape_string($connection,$updateSQL);
        $result = mysqli_query($connection,$updateSQL);
        if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
    }
}

if (DEBUG) echo $convert_all_brewblogs;
else echo "<h3>Brewing Table</h3><p>The following updates were made in the brewing database table:</p><ul>".$convert_all_brewblogs."</ul>";
if (!empty($errors)) echo "<div class=\"alert alert-danger\"><p><span class=\"fa fa-exclamation-triangle\"></span> <strong>The following errors occurred: </strong><ul>".$errors."</ul>";
?>