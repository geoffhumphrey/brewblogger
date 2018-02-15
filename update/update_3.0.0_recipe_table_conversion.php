<?php
/**
 * Alter Tables: Recipe Table
 * Function to convert finite fermentables, hops, and misc fields
 * to a single line of text, allowing for the possibility of
 * adding unlimited amounts of each type of ingredient.
 */

// A carrot ^ separates each ingredient
// Pipes | separate each ingredient's data points (weight, type, etc)

$convert_all_recipes = "";
$db_table = $prefix."recipes";
$errors = "";

// Add the new table columns
if (!check_update("brewFermentables", $db_table)) {
    $updateSQL = sprintf("ALTER TABLE `%s` ADD `brewFermentables` MEDIUMTEXT NULL DEFAULT NULL AFTER `brewNotes`;",$db_table);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
    if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
}

if (!check_update("brewHops", $db_table)) {
    $updateSQL = sprintf("ALTER TABLE `%s` ADD `brewHops` MEDIUMTEXT NULL DEFAULT NULL AFTER `brewFermentables`;",$db_table);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
    if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
}

if (!check_update("brewMisc", $db_table)) {
    $updateSQL = sprintf("ALTER TABLE `%s` ADD `brewMisc` MEDIUMTEXT NULL DEFAULT NULL AFTER `brewHops`;",$db_table);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
    if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
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
        $key_weight = "brewExtract".$i."Weight";

        // First, check if the extract exists in the extract DB table
        $query_extracts = sprintf("SELECT id FROM extract WHERE extractName='%s'",$row_recipes[$key_name]);
        $extracts = mysqli_query($connection,$query_extracts);
        $row_extracts = mysqli_fetch_assoc($extracts);
        $totalRows_extracts = mysqli_num_rows($extracts);

        // If not, add it to the extract DB table
        if ($totalRows_extracts == 0) {

            // If not, add it to the extract DB table
            if (!empty($row_recipes[$key_name])) {
                $insertSQL = sprintf("INSERT INTO extract  (`id`, `extractName`, `extractLovibond`, `extractInfo`, `extractCategory`, `extractYield`, `extractOrigin`, `extractSupplier`, `extractType`) VALUES (NULL, '%s', NULL, NULL, '1', NULL, NULL, NULL, 'Extract')", $row_recipes[$key_name]);
                mysqli_real_escape_string($connection,$insertSQL);
                $result = mysqli_query($connection,$insertSQL);
                if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

                // Grab its id
                $query_extract = "SELECT id FROM extract ORDER BY id DESC LIMIT 1";
                $extract = mysqli_query($connection,$query_extract);
                $row_extract = mysqli_fetch_assoc($extract);

                $extract_id .= $row_extract['id'];
            }

        }

        else $extract_id .= $row_extracts['id'];

        if ((!empty($extract_id)) && (isset($row_recipes[$key_name]))) {
            $convert_fermentables .= "e|";
            $convert_fermentables .= $extract_id."|";
            $extract_weight = number_format(filter_var($row_recipes[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($row_recipes[$key_weight] > 0) $convert_fermentables .= $extract_weight;
            else $convert_fermentables .= "0";
            $convert_fermentables .= "^";
        }

    }

    // END Extracts

    // BEGIN Grains/Malts

    for ($i = 1; $i <= MAX_GRAINS; $i++) {

        $grain_id = "";
        $key_name = "brewGrain".$i;
        $key_weight = "brewGrain".$i."Weight";

        // First, check if the grain exists in the grain DB table
        $query_grains = sprintf("SELECT id FROM malt WHERE maltName='%s'",$row_recipes[$key_name]);
        $grains = mysqli_query($connection,$query_grains);
        $row_grains = mysqli_fetch_assoc($grains);
        $totalRows_grains = mysqli_num_rows($grains);

        // If not, add it to the grain DB table
        if ($totalRows_grains == 0) {

            // If not, add it to the grain DB table
            if (!empty($row_recipes[$key_name])) {
                $insertSQL = sprintf("INSERT INTO malt (`id`, `maltName`, `maltLovibond`, `maltInfo`, `maltCategory`, `maltYield`, `maltOrigin`, `maltSupplier`, `maltType`) VALUES (NULL, '%s', NULL, NULL, '1', NULL, NULL, NULL, NULL)", $row_recipes[$key_name]);
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

        if ((!empty($grain_id)) && (isset($row_recipes[$key_name]))) {
            $convert_fermentables .= "g|";
            $convert_fermentables .= $grain_id."|";
            $grain_weight = number_format(filter_var($row_recipes[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
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
        $key_weight = "brewAddition".$i."Amt";

        // First, check if the adjunct exists in the adjunct DB table
        $query_adjuncts = sprintf("SELECT id FROM adjuncts WHERE adjunctName='%s'",$row_recipes[$key_name]);
        $adjuncts = mysqli_query($connection,$query_adjuncts);
        $row_adjuncts = mysqli_fetch_assoc($adjuncts);
        $totalRows_adjuncts = mysqli_num_rows($adjuncts);

        // If not, add it to the adjunct DB table
        if ($totalRows_adjuncts == 0) {

            // If not, add it to the adjunct DB table
            if (!empty($row_recipes[$key_name])) {
                $insertSQL = sprintf("INSERT INTO adjuncts (`id`, `adjunctName`, `adjunctLovibond`, `adjunctInfo`, `adjunctCategory`, `adjunctYield`, `adjunctOrigin`, `adjunctSupplier`, `adjunctType`) VALUES (NULL, '%s', NULL, NULL, NULL, NULL, NULL, NULL, NULL)", $row_recipes[$key_name]);
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

        if ((!empty($adjunct_id)) && (isset($row_recipes[$key_name]))) {
            $convert_fermentables .= "a|";
            $convert_fermentables .= $adjunct_id."|";
            $adjunct_weight = number_format(filter_var($row_recipes[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
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
        $key_weight = "brewHops".$i."Weight";
        $key_ibu = "brewHops".$i."IBU";
        $key_time = "brewHops".$i."Time";

        // First, check if the hop exists in the hop DB table
        $query_hops = sprintf("SELECT id FROM hops WHERE hopsName='%s'",$row_recipes[$key_name]);
        $hops = mysqli_query($connection,$query_hops);
        $row_hops = mysqli_fetch_assoc($hops);
        $totalRows_hops = mysqli_num_rows($hops);

        // If not, add it to the hop DB table
        if ($totalRows_hops == 0) {

            // If not, add it to the hop DB table
            if (!empty($row_recipes[$key_name])) {
                $insertSQL = sprintf("INSERT INTO hops (`id`, `hopsName`, `hopsGrown`, `hopsInfo`, `hopsUse`, `hopsExample`, `hopsAAULow`, `hopsAAUHigh`, `hopsSub`) VALUES (NULL, '%s', NULL, NULL, NULL, NULL, NULL, NULL, NULL)", $row_recipes[$key_name]);
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

        if ((!empty($hop_id)) && (isset($row_recipes[$key_name]))) {
            // Weight, IBU, Time
            $convert_hops .= $hop_id."|";

            $hop_weight = number_format(filter_var($row_recipes[$key_weight],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($hop_weight > 0) $convert_hops .= $hop_weight."|";
            else $convert_hops .= "0|";

            $hop_ibu = number_format(filter_var($row_recipes[$key_ibu],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);
            if ($hop_ibu > 0) $convert_hops .= $hop_ibu."|";
            else $convert_hops .= "0|";

            $hop_time = number_format(filter_var($row_recipes[$key_time],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),0);
            if ($hop_time > 0) $convert_hops .= $hop_time."|";
            else $convert_hops .= "0|";

            if (!empty($row_recipes[$key_use])) $convert_hops .= $row_recipes[$key_use]."|";
            else $convert_hops .= "*|";

            if (!empty($row_recipes[$key_type])) $convert_hops .= $row_recipes[$key_type]."|";
            else $convert_hops .= "*|";

            if (!empty($row_recipes[$key_form])) $convert_hops .= $row_recipes[$key_form];
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
        $query_miscs = sprintf("SELECT id FROM misc WHERE miscName='%s'",$row_recipes[$key_name]);
        $miscs = mysqli_query($connection,$query_miscs);
        $row_miscs = mysqli_fetch_assoc($miscs);
        $totalRows_miscs = mysqli_num_rows($miscs);

        // If not, add it to the misc DB table
        if ($totalRows_miscs == 0) {

            // If not, add it to the misc DB table
            if (!empty($row_recipes[$key_name])) {
                $insertSQL = sprintf("INSERT INTO misc (`id`, `miscName`, `miscType`, `miscUse`, `miscNotes`) VALUES (NULL, '%s', '%s', '%s', NULL)", $row_recipes[$key_name],$row_recipes[$key_type],$row_recipes[$key_use]);
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

        if ((!empty($misc_id)) && (isset($row_recipes[$key_name]))) {
            // Name, Type, Use, Time, Amount
            $convert_misc .= $misc_id."|";
            if (empty($row_recipes[$key_type])) $convert_misc .= "*|";
            else $convert_misc .= $row_recipes[$key_type]."|";

            if (empty($row_recipes[$key_use])) $convert_misc .= "*|";
            else $convert_misc .= $row_recipes[$key_use]."|";

            $misc_time = number_format(filter_var($row_recipes[$key_time],FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),0);
            if ($misc_time > 0) $convert_misc .= $misc_time."|";
            else $convert_misc .= "0|";

            if (!empty($row_recipes[$key_amt])) $convert_misc .= $row_recipes[$key_amt];
            else $convert_misc .= "0";
            $convert_misc .= "^";

        }

    }

    // END Misc

    // Bring it all together
    $convert_fermentables = rtrim($convert_fermentables,"^");
    $convert_hops = rtrim($convert_hops,"^");
    $convert_misc = rtrim($convert_misc,"^");

    $updateSQL = sprintf("UPDATE %s SET brewFermentables='%s', brewHops='%s', brewMisc='%s' WHERE id='%s'", $db_table, $convert_fermentables, $convert_hops, $convert_misc, $row_recipes['id']);
    mysqli_real_escape_string($connection,$updateSQL);
    $result = mysqli_query($connection,$updateSQL);
    if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";

    if (DEBUG) $convert_all_recipes .= "<hr><p><strong>".$row_recipes['brewName']."</strong><br>";
    else $convert_all_recipes .= "<li>".$row_recipes['brewName']." - ";

    if (!empty($convert_fermentables)) {
      if (DEBUG) $convert_all_recipes .= "Fermentables: ".$convert_fermentables."<br>";
      else $convert_all_recipes .= "fermentables, ";
    }

    if (!empty($convert_hops)) {
      if (DEBUG) $convert_all_recipes .= "Hops: ".$convert_hops."<br>";
      else $convert_all_recipes .= "hops, ";
    }

    if (!empty($convert_misc)) {
      if (DEBUG) $convert_all_recipes .= "Misc: ".$convert_misc."<br>";
      else $convert_all_recipes .= "micellaneous ingredients, ";
    }

    if (DEBUG) $convert_all_recipes .= "Query: ".$updateSQL."</p>";

    if (!DEBUG) {
      $convert_all_recipes = rtrim($convert_all_recipes,", ");
      $convert_all_recipes .= ".</li>";
    }

} while ($row_recipes = mysqli_fetch_assoc($recipes));

// Now that the items have been converted, drop the rows
for ($i = 1; $i <= MAX_EXT; $i++) {
    $key_name = "brewExtract".$i;
    $key_weight = "brewExtract".$i."Weight";
    $updateSQL = sprintf("ALTER TABLE `%s` DROP `%s`, DROP `%s`;",$db_table,$key_name,$key_weight);
    if (DEBUG) $convert_all_recipes .= $updateSQL."<br>";
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
    if (DEBUG) $convert_all_recipes .= $updateSQL."<br>";
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
    if (DEBUG) $convert_all_recipes .= $updateSQL."<br>";
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
    if (DEBUG) $convert_all_recipes .= $updateSQL."<br>";
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
    if (DEBUG) $convert_all_recipes .= $updateSQL."<br>";
    else {
        mysqli_real_escape_string($connection,$updateSQL);
        $result = mysqli_query($connection,$updateSQL);
        if (!$result) $errors .= "<li>".mysqli_error($connection)."</li>";
    }
}

if (DEBUG) echo $convert_all_recipes;
else echo "<h3>Recipe Table</h3><p>The following updates were made in the recipe database table:</p><ul>".$convert_all_recipes."</ul>";
if (!empty($errors)) echo "<div class=\"alert alert-danger\"><p><span class=\"fa fa-exclamation-triangle\"></span> <strong>The following errors occurred: </strong><ul>".$errors."</ul>";
?>