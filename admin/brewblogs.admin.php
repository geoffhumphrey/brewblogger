<?php
$brewblog_fields_enable = FALSE;
$recipe_fields_enable = FALSE;

if ($dbTable == "recipes") {
    $recipe_fields_enable = TRUE;
}

if ($dbTable == "brewing") {
    $brewblog_fields_enable = TRUE;
}

if ($action == "manage") {
    include (SECTIONS.'brewblog_list.inc.php');
}

else {

    // Brew Name
    $brewName = "";
    if ($action == "importCalc") $brewName = $brewName;
    if ($action == "edit") $brewName = $row_log['brewName'];

    // Batch Number
    $brewBatchNum = "";
    if ($action == "edit") $brewBatchNum = $row_log['brewBatchNum'];

    // Source
    $brewSource = "";
    if ((($action == "edit") || ($action == "reuse")) && ($recipe_fields_enable)) $brewSource = $row_log['brewSource'];

    // Featured?
    $featured = FALSE;
    if ($action == "edit") {
        if ($row_log['brewFeatured'] == "Y") $featured = TRUE;
        if (($row_log['brewFeatured'] == "N") || (empty($row_log['brewFeatured']))) $featured = FALSE;
    }

    // Archived?
    $archived = FALSE;
    if ($action == "edit") {
        if ($row_log['brewArchive'] == "Y") $archived = TRUE;
        if (($row_log['brewArchive'] == "N") || (empty($row_log['brewArchive']))) $archived = FALSE;
    }

    // Style
    $style_set = array_merge($_SESSION['styles2008'],$_SESSION['styles2015']);

    asort($style_set);

    $styles_dropdown = "";

    foreach ($style_set as $row_styles) {

        $style_selected = FALSE;

        if ($action == "importCalc") {
            if ($row_styles['brewStyle'] == $brewStyle) $style_selected = TRUE;
        }

        if ($action == "edit") {
            if ($row_styles['brewStyle'] == $row_log['brewStyle']) $style_selected = TRUE;
        }

        $styles_dropdown .= "<option value=\"".$row_styles['brewStyle']."\"";
        if ($style_selected) $styles_dropdown .= " selected";
        $styles_dropdown .= ">";
        $styles_dropdown .= str_replace("BJCP","BJCP ",$row_styles['brewStyleVersion'])." ".$row_styles['brewStyleGroup'].$row_styles['brewStyleNum'].": ".$row_styles['brewStyle'];
        $styles_dropdown .= "</option>";

    } // end foreach

    // Yield
    if ($action == "importCalc") $brewYield = $brewYield;
    elseif ($action == "add") $brewYield = $_SESSION['defaultBatchSize'];
    else $brewYield = $row_log['brewYield'];

    // Method
    $methods = array("Extract","Partial Mash","All Grain","Other");
    $method_dropdown = "";
    foreach ($methods as $method) {
        $method_selected = FALSE;
        if ((($action == "add") || ($action == "importCalc")) && ($_SESSION['defaultMethod'] == $method)) $method_selected = TRUE;
        if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {
            if (!(strcmp($row_log['brewMethod'], $method))) $method_selected = TRUE;
        }
        if (($action == "add") && ($_SESSION['brewerPrefMethod'] == $method)) $method_selected = TRUE;
        $method_dropdown .= "<option value=\"".$method."\"";
        if ($method_selected) $method_dropdown .= " selected";
        $method_dropdown .= ">".$method."</option>";
    }

    if ($brewblog_fields_enable) {

        // Conditioning
        $conditioning = array("Bottles","Keg","Cask","Bottles and Keg","Bottles and Cask","Bottles, Keg, and Cask","Keg and Cask");
        $conditioning_dropdown = "";
        $conditioning_dropdown .= "<option value=\"\"";

        foreach ($conditioning as $condition) {
            $condition_selected = FALSE;
            if ($action == "edit") {
                if ($row_log['brewCondition'] == $condition) $condition_selected = TRUE;
            }
            $conditioning_dropdown .= "<option value=\"".$condition."\"";
            if ($condition_selected) $conditioning_dropdown .= " selected";
            $conditioning_dropdown .= ">".$condition."</option>";
        }

        // Brew Date
        $brewDate = date ('Y-m-d');
        if ($action == "edit") $brewDate = $row_log['brewDate'];

        // Tap Date
        $brewTapDate = "";
        if ($action == "edit") $brewTapDate = $row_log['brewTapDate'];

        // Status
        $status_array = array("Primary","Secondary","Tertiary","Lagering","Conditioning","On Tap","Bottled","Gone","Planned");
        $status_dropdown = "";
        foreach ($status_array as $stat) {
            $status_selected = FALSE;
            if ($action == "edit") {
                if (!(strcmp($row_log['brewStatus'], $stat))) $status_selected = TRUE;
            }
            $status_dropdown .= "<option value=\"".$stat."\"";
            if ($status_selected) $status_dropdown .= " selected";
            $status_dropdown .= ">".$stat."</option>";
        }

        // Cost
        $brewCost = "";
        if ($action == "edit") $brewCost = $row_log['brewCost'];

        // Comments
        $brewComments = "";
        if (($action == "edit") || ($action=="reuse")) $brewComments = $row_log['brewComments'];

    }

    // Notes
    $brewNotes = "";
    if ($action == "edit") {
        if ($brewblog_fields_enable) $brewNotes = $row_log['brewInfo'];
        if ($recipe_fields_enable) $brewNotes = $row_log['brewNotes'];
    }

    // Extracts
    $extracts = $_SESSION['extracts'];
    $grains = $_SESSION['grains'];
    $adjuncts = $_SESSION['adjuncts'];

// Labels (move to translate file)
$label_name = "Name";
$label_yield = "Yield";
$label_style = "Style";
$label_batch = "Batch #";
$label_select_style = "Select a Style";
$label_method = "Method";
$label_select_method = "Select a Brewing Method";
$label_brew_date = "Brew Date";
$label_tap_date = "Tap Date";
$label_status = "Status";
$label_select_status = "Select the Status of the Brew";
$label_cost = "Cost";
$label_conditioning = "Conditioning";
$label_select_conditioning = "Select the Conditioning Method";
$label_extract = "Extract";
$label_extract = "Extracts";
$label_weight = "Weight";
$label_grain = "Grain";
$label_grains = "Grains";
$label_adjunct = "Adjunct";
$label_adjuncts = "Adjuncts";
$label_misc_ingredients = "Miscellanoues Ingredients (Non-Fermentables)";
$label_misc = "Miscellanoues";
$label_hops = "Hops";
$label_hop = "Hop";
?>

<style>
.form-group {
    padding-bottom: 25px;
}

@media (max-width: 767px) {
    .control-label {
        padding-top: 10px;
    }
}
</style>

<!-- General Info -->
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewName" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_name; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="brewName" type="text" value="<?php echo $brewName; ?>" placeholder="" required>
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewYield" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_yield; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="brewYield" type="text" value="<?php echo $brewYield; ?>" placeholder="<?php echo ucwords($_SESSION['measFluid2']); ?>" ?>
            </div>
        </div><!-- ./Form Group -->
    </div>

</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewStyle" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_style; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="brewStyle" id="type" data-live-search="true" data-size="8" data-width="100%" data-show-tick="true" data-header="<?php echo $label_select_style; ?>" title="<?php echo $label_select_style; ?>" required>
                    <?php echo $styles_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewMethod" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_method; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="brewMethod" id="type" data-live-search="false" data-size="8" data-width="100%" data-show-tick="true" data-header="<?php echo $label_select_method; ?>" title="<?php echo $label_select_method; ?>" required>
                    <?php echo $method_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>

<?php if ($brewblog_fields_enable) { ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewDate" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_brew_date; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="brewDate" type="text" value="<?php echo $brewDate; ?>" placeholder="">
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewTapDate" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_tap_date; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="brewTapDate" type="text" value="<?php echo $brewTapDate; ?>" placeholder="">
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewBatchNum" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_batch; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="brewBatchNum" type="text" value="<?php echo $brewBatchNum; ?>" placeholder="">
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewCost" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_cost; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="brewCost" type="text" value="<?php echo $brewCost; ?>" placeholder="" required>
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewStatus" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_status; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="brewStatus" id="type" data-live-search="false" data-size="8" data-width="100%" data-show-tick="true" data-header="<?php echo $label_select_status; ?>" title="<?php echo $label_select_status; ?>" required>
                    <?php echo $status_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewCondition" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_conditioning; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="brewCondition" id="type" data-size="8" data-width="100%" data-show-tick="true" data-header="<?php echo $label_select_conditioning; ?>" title="<?php echo $label_select_conditioning; ?>" required>
                    <?php echo $conditioning_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>
<?php } ?>

<!-- Extracts -->
<h3><?php echo $label_extract; ?></h3>
<?php
for($i=1; $i<=MAX_EXT; $i++) {

    $extracts_dropdown_prefix = "";
    $extracts_dropdown = "";
    $extracts_not_found = TRUE;
    foreach ($extracts as $row_extracts) {
        $extracts_selected = FALSE;
        //if (($action != "importCalc") && ($row_extracts['extractName'] == $row_log['brewExtract$i'])) $extracts_selected = TRUE;
        //if (($action == "importCalc") && ($row_extracts['extractName'] == $extName[$i])) $extracts_selected = TRUE;
        if (($action == "edit") && ($row_extracts['extractName'] == $row_log['brewExtract'.$i])) {
            $extracts_selected = TRUE;
            $extracts_not_found = FALSE;
        }
        $extracts_dropdown .= "\t\t\t<option value=\"".$row_extracts['extractName']."\"";
        if ($extracts_selected) $extracts_dropdown .= " selected";
        $extracts_dropdown .= ">".$row_extracts['extractName']."</option>\n";
    }

    if ($extracts_not_found) {
        $extracts_dropdown_prefix .= "<option value \"".$row_log['brewExtract'.$i]."\" selected>".$row_log['brewExtract'.$i]."</option>";
        $extracts_dropdown_prefix .= "<option data-divider=\"true\"></option>";
    }

    $extracts_weight = "";
    if (!empty($row_log['brewExtract'.$i.'Weight'])) $extracts_weight = number_format($row_log['brewExtract'.$i.'Weight'],2);

    ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group form-group-sm"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewExtract<?php echo $i; ?>" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_extract." ".$i; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="<?php echo "brewExtract".$i; ?>" id="type" data-live-search="true" data-size="8" data-width="100%" data-show-tick="true">
                    <option value=""></option>
                    <?php echo $extracts_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewCost" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_weight; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="<?php echo "brewExtract".$i."Weight"; ?>" type="text" value="<?php echo $extracts_weight; ?>" placeholder="<?php echo ucwords($_SESSION['measWeight2']); ?>">
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>
<?php } // end extracts for loop ?>

<!-- Grains -->
<h3><?php echo $label_grains; ?></h3>
<?php
for($i=1; $i<=MAX_GRAINS; $i++) {

    $grains_dropdown_prefix = "";
    $grains_dropdown = "";
    $grains_not_found = TRUE;

    foreach ($grains as $row_grains) {
        $grains_selected = FALSE;
        //if (($action != "importCalc") && ($row_grains['maltName'] == $row_log['brewGrain$i'])) $grains_selected = TRUE;
        //if (($action == "importCalc") && ($row_grains['maltName'] == $extName[$i])) $grains_selected = TRUE;
        if (($action == "edit") && ($row_grains['maltName'] == $row_log['brewGrain'.$i])) {
            $grains_selected = TRUE;
            $grains_not_found = FALSE;
        }
        $grains_dropdown .= "<option value=\"".$row_grains['maltName']."\"";
        if ($grains_selected) $grains_dropdown .= " selected";
        $grains_dropdown .= ">".$row_grains['maltName']."</option>\n";
    }

    if ($grains_not_found) {
        $grains_dropdown_prefix .= "<option value \"".$row_log['brewGrain'.$i]."\" selected>".$row_log['brewGrain'.$i]."</option>";
        $grains_dropdown_prefix .= "<option data-divider=\"true\"></option>";
    }

    $grains_weight = "";
    if (!empty($row_log['brewGrain'.$i.'Weight'])) $grains_weight = number_format($row_log['brewGrain'.$i.'Weight'],2);

    ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group form-group-sm"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewGrain<?php echo $i; ?>" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_grain." ".$i; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="<?php echo "brewGrain".$i; ?>" id="type" data-live-search="true" data-size="8" data-width="100%" data-show-tick="true">
                    <option value=""></option>
                    <?php echo $grains_dropdown_prefix.$grains_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewCost" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_weight; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="<?php echo "brewGrain".$i."Weight"; ?>" type="text" value="<?php echo $grains_weight; ?>" placeholder="<?php echo ucwords($_SESSION['measWeight2']); ?>">
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>
<?php } // end grains for loop ?>

<!-- Adjuncts -->
<h3><?php echo $label_adjuncts; ?></h3>
<?php for($i=1; $i<=MAX_ADJ; $i++) {

    $adjuncts_dropdown_prefix = "";
    $adjuncts_dropdown = "";
    $adjuncts_not_found = TRUE;

    foreach ($adjuncts as $row_adjuncts) {
        $adjuncts_selected = FALSE;
        //if (($action != "importCalc") && ($row_adjuncts['adjunctName'] == $row_log['brewAddition$i'])) $adjuncts_selected = TRUE;
        //if (($action == "importCalc") && ($row_adjuncts['adjunctName'] == $extName[$i])) $adjuncts_selected = TRUE;
        if (($action == "edit") && ($row_adjuncts['adjunctName'] == $row_log['brewAddition'.$i])) {
            $adjuncts_selected = TRUE;
            $adjuncts_not_found = FALSE;
        }
        $adjuncts_dropdown .= "<option value=\"".$row_adjuncts['adjunctName']."\"";
        if ($adjuncts_selected) $adjuncts_dropdown .= " selected";
        $adjuncts_dropdown .= ">".$row_adjuncts['adjunctName']."</option>\n";
    }

    if ($adjuncts_not_found) {
        $adjuncts_dropdown_prefix .= "<option value \"".$row_log['brewAddition'.$i]."\" selected>".$row_log['brewAddition'.$i]."</option>";
        $adjuncts_dropdown_prefix .= "<option data-divider=\"true\"></option>";
    }

    $adjuncts_weight = "";
    if (!empty($row_log['brewAddition'.$i.'Amt'])) $adjuncts_weight = number_format($row_log['brewAddition'.$i.'Amt'],2);

    ?>
<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group form-group-sm"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewAddition<?php echo $i; ?>" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_adjunct." ".$i; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="selectpicker" name="<?php echo "brewAddition".$i; ?>" id="type" data-live-search="true" data-size="8" data-width="100%" data-show-tick="true">
                    <option value=""></option>
                    <?php echo $adjuncts_dropdown_prefix.$adjuncts_dropdown; ?>
                </select>
            </div>
        </div><!-- ./Form Group -->
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group"><!-- Form Group NOT REQUIRED Text Input -->
            <label for="brewCost" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"><?php echo $label_weight; ?></label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input class="form-control" name="<?php echo "brewAddition".$i."Weight"; ?>" type="text" value="<?php echo $adjuncts_weight; ?>" placeholder="<?php echo ucwords($_SESSION['measWeight2']); ?>">
            </div>
        </div><!-- ./Form Group -->
    </div>
</div>
<?php } // end adjuncts for loop ?>

<?php } // end else (~ line 9) ?>