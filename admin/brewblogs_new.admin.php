<?php

$brewblog_fields_enable = FALSE;
$recipe_fields_enable = FALSE;
$essentials = FALSE;
if ($filter == "essentials") $essentials = TRUE;

if ($dbTable == "recipes") $recipe_fields_enable = TRUE;
else $brewblog_fields_enable = TRUE;


if ($action == "manage") include (SECTIONS.'brewblog_list_new.inc.php');

else {

    include (SECTIONS.'recipe_json_decode.inc.php');

    // Brew Name
    $brewName = "";
    if (($action == "edit") && (isset($row_log['brewName']))) $brewName = $row_log['brewName'];

    // Batch Number
    $brewBatchNum = "";
    if (($action == "edit") && (isset($row_log['brewBatchNum']))) $brewBatchNum = $row_log['brewBatchNum'];

    // Yield
    if (($action == "edit") && (isset($row_log['brewBatchSize']))) $brewYield = $row_log['brewBatchSize'];

    // Style
    $style_set = array_merge($_SESSION['styles2008'],$_SESSION['styles2015'],$_SESSION['styles2021'],$_SESSION['stylesBA']);

    //asort($style_set);

    $styles_dropdown = "";
    $style_set_lookup = "";
    $style_in_record = "";
    
    if (isset($style['STYLE_GUIDE'])) {
        if ((strpos($style['STYLE_GUIDE'], "BA") !== false) || (strpos($style['STYLE_GUIDE'], "Brewers Association") !== false)) $style_set_lookup = "BA";
        if ((strpos($style['STYLE_GUIDE'], "BA") !== false) || (strpos($style['STYLE_GUIDE'], "Brewers Association") !== false)) $style_in_record .= "BA ".$style['NAME'];
        if (strpos($style['STYLE_GUIDE'], "BJCP") !== false) $style_set_lookup = str_replace("BJCP ","BJCP",$style['STYLE_GUIDE']);
        if (strpos($style_set_lookup, "BJCP") !== false) $style_in_record .= $style['STYLE_GUIDE']." ".$style['CATEGORY_NUMBER'].$style['STYLE_LETTER'].": ".$style['NAME'];
    }

    $style_count = 0;

    // If the recipe's style isn't found in the reference list, the "9999" option below keeps
    // the stored style; the hidden brewStyleID must match it, or saving treats it as a style
    // change to a nonexistent id and wipes brewStyle.
    $brewStyleID = "9999";
    $brewStyleName = "";

    foreach ($style_set as $row_styles) {
        
        $style_selected = FALSE;

        if (strpos($row_styles['brewStyleVersion'], "BJCP") !== false) $style_display = str_replace("BJCP","BJCP ",$row_styles['brewStyleVersion'])." ".$row_styles['brewStyleGroup'].$row_styles['brewStyleNum'].": ".$row_styles['brewStyle'];
        else $style_display = $row_styles['brewStyleVersion']." ".$row_styles['brewStyle'];
        $style_id = $row_styles['id'];


        if (($action == "edit") && (isset($style['NAME']))) {  
            // Compare decoded text: legacy data may store "M&auml;rzen" where the reference list has "Märzen"
            if ((strpos(html_entity_decode($row_styles['brewStyle'], ENT_QUOTES | ENT_HTML5, 'UTF-8'), html_entity_decode($style['NAME'], ENT_QUOTES | ENT_HTML5, 'UTF-8')) !== false) && ($style_set_lookup == $row_styles['brewStyleVersion'])) {
                $brewStyleID = $row_styles['id'];
                $brewStyleName = $row_styles['brewStyle'];
                $style_selected = TRUE;
                $style_count++;
            }
        }

        $styles_dropdown .= "<option value=\"".$style_id."\"";
        if ($style_selected) $styles_dropdown .= " selected";
        $styles_dropdown .= ">";
        $styles_dropdown .= h($style_display);
        $styles_dropdown .= "</option>";

    } // end foreach

    if (($action == "edit") && ($style_count == 0)) {
        $styles_dropdown .= "<option value=\"9999\" selected>";
        $styles_dropdown .= h($style_in_record);
        $styles_dropdown .= "</option>";
    }

    // Method
    $methods = array("Extract","Partial Mash","All Grain","Other");
    $method_dropdown = "";
    foreach ($methods as $method) {
        $method_check = strtolower($method);
        $method_selected = FALSE;
        if ((($action == "add") || ($action == "importCalc")) && (strtolower($_SESSION['defaultMethod']) == $method_check)) $method_selected = TRUE;
        if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {
            if (!(strcmp(strtolower($row_log['brewMethod']), $method_check))) $method_selected = TRUE;
        }
        if (($action == "add") && (strtolower($_SESSION['brewerPrefMethod']) == $method_check)) $method_selected = TRUE;
        $method_dropdown .= "<option value=\"".$method."\"";
        if ($method_selected) $method_dropdown .= " selected";
        $method_dropdown .= ">".$method."</option>";
    }

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
    if ($action == "edit") {
        if ((isset($row_log['brewDate'])) && (!empty($row_log['brewDate']))) $brewDate = gmdate("Y-m-d", $row_log['brewDate']);
        else $brewDate = gmdate("Y-m-d", time());
    }

    // Tap Date
    $brewTapDate = "";
    if ($action == "edit") {
        if ((isset($row_log['brewTapDate'])) && (!empty($row_log['brewTapDate']))) $brewTapDate = gmdate("Y-m-d", $row_log['brewTapDate']);
    }

    // Status
    $status_array = array("Planned","Primary","Secondary","Tertiary","Lagering","Conditioning","On Tap","Bottled","Gone");
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
    if (($action == "edit") && (isset($row_log['brewCost']))) $brewCost = $row_log['brewCost'];

    // Comments
    $brewComments = "";
    if ((($action == "edit") || ($action=="reuse")) && (isset($row_log['brewComments']))) $brewComments = $row_log['brewComments'];

    // Notes
    $brewNotes = "";
    if ($action == "edit") {
        if (isset($row_log['brewInfo'])) $brewNotes = $row_log['brewInfo'];
        if (isset($row_log['brewNotes'])) $brewNotes = $row_log['brewNotes'];
    }

    $brewProcedure = "";
    if (($action == "edit") && (isset($row_log['brewProcedure']))) $brewProcedure = $row_log['brewProcedure'];

    $brewSpecialProcedure = "";
    if (($action == "edit") && (isset($row_log['brewSpecialProcedure']))) $brewSpecialProcedure = $row_log['brewSpecialProcedure'];

    // Extracts - array of all from DB
    $extracts = $_SESSION['extracts'];
    
    // Grains - array of all from DB
    $grains = $_SESSION['grains'];
    
    // Adjucnts - array of all from DB
    $adjuncts = $_SESSION['adjuncts'];

    // Labels (move to translate file)
    $label_name = "Name";
    $label_yield = "Yield";
    $label_batch_size = "Batch Size";
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
    $label_fermentable = "Fermentable";
    $label_fermentables = "Fermentables";
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
    $label_yeasts = "Yeasts";
    $label_yeast = "Yeast";
    $label_mash_profile = "Mash Profile";
    $label_equipment_profile = "Equipment Profile";
    $label_fermentation_aging = "Fermentation and Aging";

    $style_log = "No Style Selected";
    if (isset($row_log['brewStyle'])) {
        $style_json = json_decode($row_log['brewStyle'],true);
        if (isset($style_json['NAME'])) $style_log = $style_json['NAME'];
    }

    $link_log_name = pathauto_cleanstring($row_log['brewName']);
    $link_style_name = pathauto_cleanstring($style_log);

    if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($link_log_name,$prettify_url))), urlencode(strtolower(strtr($link_style_name,$prettify_url))), "detail", strtolower($row_log['brewBrewerID']), $row_log['id'], $base_url);
    else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_log['brewBrewerID'], $row_log['id'], $base_url);

    // Tap Location suggestions - distinct location names already used by this brewer
    $tap_location_suggestions = array();
    $query_tap_locations = sprintf("SELECT brewTapLocation FROM brewblogs WHERE brewBrewerID = '%s' AND brewTapLocation IS NOT NULL AND brewTapLocation != ''", sterilize($_SESSION['loginUsername']));
    $tap_loc_result = mysqli_query($connection, $query_tap_locations) or die(mysqli_error($connection));
    while ($tap_loc_row = mysqli_fetch_assoc($tap_loc_result)) {
        $decoded_locs = json_decode($tap_loc_row['brewTapLocation'], true);
        if (is_array($decoded_locs)) foreach ($decoded_locs as $loc_name => $loc_data) $tap_location_suggestions[$loc_name] = TRUE;
    }
    $tap_location_suggestions = array_keys($tap_location_suggestions);

    include(INCLUDES.'iso_country_codes.inc.php');

?>

<style>
@media (max-width: 767px) {
    .col-form-label {
        padding-top: 10px;
    }
}
</style>

<!-- Load Flag Icons / https://github.com/lipis/flag-icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css" />

<div class="container-xxl mt-3" style="min-height: 80vh;">

<h2 class="mb-5"><?php echo ucfirst($action)." BrewBlog &ndash; ".h($row_log['brewName']); ?></h2>

<div class="mb-3" role="group">
    <a class="btn btn-dark btn-sm" href="<?php echo $base_url; if (SEF) echo "brewblog-list"; else echo "index.php?page=brewblog-list"; ?>">BrewBlog List</a>
    <a class="btn btn-dark btn-sm" href="<?php echo $brewblog_link; ?>"><?php echo h($row_log['brewName']); ?> BrewBlog Detail</a>
</div>

<form method="post" data-toggle="validator" role="form" action="<?php echo $base_url; ?>includes/process_new.inc.php?action=<?php echo $action; ?>&dbTable=<?php echo $dbTable; ?>&filter=<?php echo $filter; ?>&id=<?php echo $id; ?>" name="brewblog-update">

<!-- Essentials Info -->

<h3>Essentials</h3>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewName" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_name; ?></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewName" type="text" value="<?php echo h($brewName); ?>" placeholder="" required>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewYield" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_batch_size; ?> <span class="text-muted small">(<?php echo ucwords($_SESSION['measFluid2']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewYield" type="text" value="<?php echo h($brewYield); ?>" placeholder="" ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <input type="hidden" name="brewStyleID" value="<?php echo h($brewStyleID); ?>">
    <input type="hidden" name="brewStyleName" value="<?php echo h($brewStyleName); ?>">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewStyle" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_style; ?></label>
            <div class="col-sm-8 col-12">
                <select class="form-select bootstrap-select-new" name="brewStyle" id="type" required>
                    <option value=""><?php echo $label_select_style; ?></option>
                    <?php echo $styles_dropdown; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewMethod" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_method; ?></label>
            <div class="col-sm-8 col-12">
                <select class="form-select" name="brewMethod" id="brewMethod">
                    <option value=""></option>
                    <?php echo $method_dropdown; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<?php if ($brewblog_fields_enable) { ?>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewDate" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_brew_date; ?></label>
            <div class="col-sm-8 col-12">
                <input class="form-control date-time-picker-day" name="brewDate" type="text" value="<?php echo $brewDate; ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewTapDate" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_tap_date; ?></label>
            <div class="col-sm-8 col-12">
                <input class="form-control date-time-picker-day" name="brewTapDate" type="text" value="<?php echo $brewTapDate; ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewBatchNum" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_batch; ?></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewBatchNum" type="text" value="<?php echo h($brewBatchNum); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewCost" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_cost; ?></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewCost" type="text" value="<?php echo h($brewCost); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewStatus" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_status; ?></label>
            <div class="col-sm-8 col-12">
                <select class="form-select" name="brewStatus" id="brewStatus">
                    <option value=""></option>
                    <?php echo $status_dropdown; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewCondition" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_conditioning; ?></label>
            <div class="col-sm-8 col-12">
                <select class="form-select" name="brewCondition" id="brewCondition">
                    <option value=""></option>
                    <?php echo $conditioning_dropdown; ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div id="tap-location-fields" style="display:none;">

<hr>

<h3>Tap Location(s)</h3>

<?php

if (!empty($tap_locations)) {
    $taplocation_num = 0;
    foreach ($tap_locations as $tap_loc_name => $tap_location) {
    $identifier = "taplocation".$taplocation_num;
    $taplocation_num++;
?>

<section id="<?php echo $identifier; ?>">

    <input type="hidden" name="<?php echo $identifier; ?>" value="<?php echo ($taplocation_num - 1); ?>">

    <h4>Tap Location <?php echo $taplocation_num; ?></h4>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $identifier; ?>-LOCATION" class="col-sm-4 col-12 col-form-label fw-bold">Location</label>
                <div class="col-sm-8 col-12">
                    <select class="form-select tap-location-select" id="<?php echo $identifier; ?>-LOCATION" name="<?php echo $identifier; ?>-LOCATION">
                        <option value=""></option>
                        <?php
                        $loc_options = $tap_location_suggestions;
                        if ((!empty($tap_loc_name)) && (!in_array($tap_loc_name, $loc_options))) $loc_options[] = $tap_loc_name;
                        foreach ($loc_options as $loc_option) {
                        ?>
                        <option value="<?php echo h($loc_option); ?>" <?php if ($loc_option == $tap_loc_name) echo "selected"; ?>><?php echo h($loc_option); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $identifier; ?>-TAP_NUMBER" class="col-sm-4 col-12 col-form-label fw-bold">Tap Number</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $identifier; ?>-TAP_NUMBER" name="<?php echo $identifier; ?>-TAP_NUMBER" type="number" value="<?php if (isset($tap_location['TAP_NUMBER'])) echo h($tap_location['TAP_NUMBER']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $identifier; ?>-TAP_DATE" class="col-sm-4 col-12 col-form-label fw-bold">Tap Date</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control date-time-picker-day" id="<?php echo $identifier; ?>-TAP_DATE" name="<?php echo $identifier; ?>-TAP_DATE" type="text" value="<?php if ((isset($tap_location['TAP_DATE'])) && (!empty($tap_location['TAP_DATE']))) echo gmdate("Y-m-d", $tap_location['TAP_DATE']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $identifier; ?>-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Amount <span class="text-muted small">(optional)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $identifier; ?>-AMOUNT" name="<?php echo $identifier; ?>-AMOUNT" type="text" value="<?php if (isset($tap_location['AMOUNT'])) echo h($tap_location['AMOUNT']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $identifier; ?>-VARIATION" class="col-sm-4 col-12 col-form-label fw-bold">Variation <span class="text-muted small">(optional)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $identifier; ?>-VARIATION" name="<?php echo $identifier; ?>-VARIATION" type="text" value="<?php if (isset($tap_location['VARIATION'])) echo h($tap_location['VARIATION']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $identifier; ?>-FLAG" class="col-sm-4 col-12 col-form-label fw-bold">Country Flag</label>
                <div class="col-sm-8 col-12">
                    <select class="form-select tap-flag-select" id="<?php echo $identifier; ?>-FLAG" name="<?php echo $identifier; ?>-FLAG">
                        <option value=""></option>
                        <?php foreach ($iso_country_codes as $cc => $cname) { ?>
                        <option value="<?php echo $cc; ?>" <?php if ((isset($tap_location['FLAG'])) && ($tap_location['FLAG'] == $cc)) echo "selected"; ?>><?php echo $cname; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // end foreach ?>

<?php } else { ?>

<section id="taplocation0">

    <input type="hidden" name="taplocation0" value="0">

    <h4>Tap Location 1</h4>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="taplocation0-LOCATION" class="col-sm-4 col-12 col-form-label fw-bold">Location</label>
                <div class="col-sm-8 col-12">
                    <select class="form-select tap-location-select" id="taplocation0-LOCATION" name="taplocation0-LOCATION">
                        <option value=""></option>
                        <?php foreach ($tap_location_suggestions as $loc_option) { ?>
                        <option value="<?php echo h($loc_option); ?>"><?php echo h($loc_option); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="taplocation0-TAP_NUMBER" class="col-sm-4 col-12 col-form-label fw-bold">Tap Number</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="taplocation0-TAP_NUMBER" name="taplocation0-TAP_NUMBER" type="number" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="taplocation0-TAP_DATE" class="col-sm-4 col-12 col-form-label fw-bold">Tap Date</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control date-time-picker-day" id="taplocation0-TAP_DATE" name="taplocation0-TAP_DATE" type="text" value="<?php echo $brewTapDate; ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="taplocation0-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Amount <span class="text-muted small">(optional)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="taplocation0-AMOUNT" name="taplocation0-AMOUNT" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="taplocation0-VARIATION" class="col-sm-4 col-12 col-form-label fw-bold">Variation <span class="text-muted small">(optional)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="taplocation0-VARIATION" name="taplocation0-VARIATION" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="taplocation0-FLAG" class="col-sm-4 col-12 col-form-label fw-bold">Country Flag</label>
                <div class="col-sm-8 col-12">
                    <select class="form-select tap-flag-select" id="taplocation0-FLAG" name="taplocation0-FLAG">
                        <option value=""></option>
                        <?php foreach ($iso_country_codes as $cc => $cname) { ?>
                        <option value="<?php echo $cc; ?>"><?php echo $cname; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // end else ?>

<div style="margin-top: 25px;" id="add-taplocation-block" class="row">
    <div style="margin-bottom: 10px;" class="col-12 col-md-3">
        <div class="d-grid">
            <a id="add-taplocation" class="btn btn-sm btn-success" onclick="addTapLocationSection();">Add Tap Location <i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="d-grid">
            <a id="remove-taplocation" class="btn btn-sm btn-danger" onclick="removeSection('taplocation');">Remove Last Tap Location <i class="fa fa-minus-circle"></i></a>
        </div>
    </div>
</div>

</div>

<?php } ?>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewOG" class="col-sm-4 col-12 col-form-label fw-bold">OG</label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewOG" type="text" value="<?php if (isset($row_log['brewOG'])) echo h($row_log['brewOG']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewFG" class="col-sm-4 col-12 col-form-label fw-bold">FG</label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewFG" type="text" value="<?php if (isset($row_log['brewFG'])) echo h($row_log['brewFG']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewColor" class="col-sm-4 col-12 col-form-label fw-bold">Color <span class="text-muted small">(<?php echo ucwords($_SESSION['measColor']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewColor" type="text" value="<?php if (isset($row_log['brewColor'])) echo h($row_log['brewColor']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewIBU" class="col-sm-4 col-12 col-form-label fw-bold">IBU</label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewIBU" type="text" value="<?php if (isset($row_log['brewIBU'])) echo h($row_log['brewIBU']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewCarbonation" class="col-sm-4 col-12 col-form-label fw-bold">Carbonation <span class="text-muted small">(Vols)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewCarbonation" type="text" value="<?php if (isset($row_log['brewCarbonation'])) echo h($row_log['brewCarbonation']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewEfficiency" class="col-sm-4 col-12 col-form-label fw-bold">Efficiency <span class="text-muted small">(%)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewEfficiency" type="text" value="<?php if (isset($row_log['brewEfficiency'])) echo h($row_log['brewEfficiency']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewBoilSize" class="col-sm-4 col-12 col-form-label fw-bold">Boil Size <span class="text-muted small">(<?php echo ucwords($_SESSION['measFluid2']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewBoilSize" type="text" value="<?php if (isset($row_log['brewBoilSize'])) echo h($row_log['brewBoilSize']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewBoilTime" class="col-sm-4 col-12 col-form-label fw-bold">Boil Time <span class="text-muted small">(Min)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" name="brewBoilTime" type="text" value="<?php if (isset($row_log['brewBoilTime'])) echo h($row_log['brewBoilTime']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="brewBoilSize" class="col-sm-4 col-12 col-form-label fw-bold">Label Image</label>
            <div class="col-sm-8 col-12">
                <select class="form-select bootstrap-select-new" name="brewLabelImage" id="brewLabelImage">
                <option value=""></option>
                <?php echo directory_contents_dropdown(LABEL_IMAGES,$row_log['brewLabelImage']); ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        
    </div>
</div>

<hr>

<h3>Notes, Comments, Procedures</h3>

<div class="row bb-admin-element">
    <div class="col-12 col-md-12">
        <div class="mb-3">
            <label for="brewNotes" class="col-sm-2 col-12 col-form-label fw-bold">Notes</label>
            <div class="col-sm-10 col-12">
                <textarea class="form-control" rows="10" name="brewNotes">
                    <?php echo $brewNotes; ?>
                </textarea>
            </div>
        </div>
    </div>
</div>

<div class="row bb-admin-element">
    <div class="col-12 col-md-12">
        <div class="mb-3">
            <label for="brewComments" class="col-sm-2 col-12 col-form-label fw-bold">Comments</label>
            <div class="col-sm-10 col-12">
                <textarea class="form-control" rows="10" name="brewComments">
                    <?php echo $brewComments; ?>
                </textarea>
            </div>
        </div>
    </div>
</div>

<div class="row bb-admin-element">
    <div class="col-12 col-md-12">
        <div class="mb-3">
            <label for="brewProcedure" class="col-sm-2 col-12 col-form-label fw-bold">Procedures</label>
            <div class="col-sm-10 col-12">
                <textarea class="form-control" rows="10" name="brewProcedure">
                    <?php echo $brewProcedure; ?>
                </textarea>
            </div>
        </div>
    </div>
</div>

<div class="row bb-admin-element">
    <div class="col-12 col-md-12">
        <div class="mb-3">
            <label for="brewSpecialProcedure" class="col-sm-2 col-12 col-form-label fw-bold">Special Procedures</label>
            <div class="col-sm-10 col-12">
                <textarea class="form-control" rows="10" name="brewSpecialProcedure">
                    <?php echo $brewSpecialProcedure; ?>
                </textarea>
            </div>
        </div>
    </div>
</div>

<?php if (($action == "edit") && (!$essentials)) { ?>

<!-- Fermentables -->

<h3><?php echo $label_fermentables; ?></h3>

<?php

if (!empty($fermentables)) {
    $fermentable_display_num = 0;
    foreach ($fermentables as $key => $fermentable) {
    $fermentable_process_num = $fermentable_display_num;
    $fermentable_display_num++;
?>

<section id="<?php echo $key; ?>">

    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $fermentable_process_num; ?>">

    <h4><?php echo $label_fermentable." ".$fermentable_display_num; ?></h4>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-NAME" name="<?php echo $key; ?>-NAME" type="text" value="<?php if (isset($fermentable['NAME'])) echo h($fermentable['NAME']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Weight <span class="text-muted small">(<?php echo ucwords($_SESSION['measWeight2']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-AMOUNT" name="<?php echo $key; ?>-AMOUNT" type="text" value="<?php if (isset($fermentable['AMOUNT'])) echo h($fermentable['AMOUNT']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-COLOR" class="col-sm-4 col-12 col-form-label fw-bold">Color <span class="text-muted small">(<?php echo ucwords($_SESSION['measColor']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-COLOR" name="<?php echo $key; ?>-COLOR" type="text" value="<?php if (isset($fermentable['COLOR'])) echo h($fermentable['COLOR']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-TYPE" name="<?php echo $key; ?>-TYPE" type="text" value="<?php if (isset($fermentable['TYPE'])) echo h($fermentable['TYPE']); ?>" placeholder=""> -->
                    <select class="form-select" id="<?php echo $key; ?>-TYPE" name="<?php echo $key; ?>-TYPE">
                        <option value="Grain" <?php if ((isset($fermentable['TYPE'])) && ($fermentable['TYPE'] == "Grain")) echo "selected"; ?>>Grain</option>
                        <option value="Sugar" <?php if ((isset($fermentable['TYPE'])) && ($fermentable['TYPE'] == "Sugar")) echo "selected"; ?>>Sugar</option>
                        <option value="Extract" <?php if ((isset($fermentable['TYPE'])) && ($fermentable['TYPE'] == "Extract")) echo "selected"; ?>>Extract</option>
                        <option value="Dry Extract" <?php if ((isset($fermentable['TYPE'])) && ($fermentable['TYPE'] == "Dry Extract")) echo "selected"; ?>>Dry Extract</option>
                        <option value="Adjunct" <?php if ((isset($fermentable['TYPE'])) && ($fermentable['TYPE'] == "Adjunct")) echo "selected"; ?>>Adjunct</option>
                        <?php if (isset($fermentable['TYPE'])) echo select_stored_option($fermentable['TYPE'], array("Grain", "Sugar", "Extract", "Dry Extract", "Adjunct")); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-ORIGIN" class="col-sm-4 col-12 col-form-label fw-bold">Orgin</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-ORIGIN" name="<?php echo $key; ?>-ORIGIN" type="text" value="<?php if (isset($fermentable['ORIGIN'])) echo h($fermentable['ORIGIN']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-SUPPLIER" class="col-sm-4 col-12 col-form-label fw-bold">Supplier</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-SUPPLIER" name="<?php echo $key; ?>-SUPPLIER" type="text" value="<?php if (isset($fermentable['SUPPLIER'])) echo h($fermentable['SUPPLIER']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-YIELD" class="col-sm-4 col-12 col-form-label fw-bold">Yield <span class="text-muted small">(%)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-YIELD" name="<?php echo $key; ?>-YIELD" type="text" value="<?php if (isset($fermentable['YIELD'])) echo h($fermentable['YIELD']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-ADD_AFTER_BOIL" class="col-sm-4 col-12 col-form-label fw-bold">Add After Boil?</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-ADD_AFTER_BOIL" name="<?php echo $key; ?>-ADD_AFTER_BOIL" type="text" value="<?php if (isset($fermentable['ADD_AFTER_BOIL'])) echo strtoupper($fermentable['ADD_AFTER_BOIL']); ?>" placeholder=""> -->
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="<?php echo $key; ?>-ADD_AFTER_BOIL1" name="<?php echo $key; ?>-ADD_AFTER_BOIL" value="TRUE" <?php if ((isset($fermentable['ADD_AFTER_BOIL'])) && (strtoupper($fermentable['ADD_AFTER_BOIL']) == "TRUE")) echo "checked"; ?>>
                      <label class="form-check-label" for="<?php echo $key; ?>-ADD_AFTER_BOIL1">True</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="<?php echo $key; ?>-ADD_AFTER_BOIL2" name="<?php echo $key; ?>-ADD_AFTER_BOIL" value="FALSE" <?php if (((isset($fermentable['ADD_AFTER_BOIL'])) && (strtoupper($fermentable['ADD_AFTER_BOIL']) == "FALSE")) || (!isset($fermentable['ADD_AFTER_BOIL']))) echo "checked"; ?>>
                      <label class="form-check-label" for="<?php echo $key; ?>-ADD_AFTER_BOIL2">False</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NOTES" class="col-sm-4 col-12 col-form-label fw-bold">Notes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-NOTES" name="<?php echo $key; ?>-NOTES" type="text" value="<?php if (isset($fermentable['NOTES'])) echo h($fermentable['NOTES']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NOT_FERMENTABLE" class="col-sm-4 col-12 col-form-label fw-bold">Not Fermentable?</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-NOT_FERMENTABLE" name="<?php echo $key; ?>-NOT_FERMENTABLE" type="text" value="<?php if (isset($fermentable['NOT_FERMENTABLE'])) echo strtoupper($fermentable['NOT_FERMENTABLE']); ?>" placeholder=""> -->
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="<?php echo $key; ?>-NOT_FERMENTABLE1" name="<?php echo $key; ?>-NOT_FERMENTABLE" value="TRUE" <?php if ((isset($fermentable['NOT_FERMENTABLE'])) && (strtoupper($fermentable['NOT_FERMENTABLE']) == "TRUE")) echo "checked"; ?>>
                      <label class="form-check-label" for="<?php echo $key; ?>-NOT_FERMENTABLE1">True</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="<?php echo $key; ?>-NOT_FERMENTABLE2" name="<?php echo $key; ?>-NOT_FERMENTABLE" value="FALSE" <?php if (((isset($fermentable['NOT_FERMENTABLE'])) && (strtoupper($fermentable['NOT_FERMENTABLE']) == "FALSE")) || (!isset($fermentable['NOT_FERMENTABLE']))) echo "checked"; ?>>
                      <label class="form-check-label" for="<?php echo $key; ?>-NOT_FERMENTABLE2">False</label>
                    </div>
                </div>
            </div>
        </div>    
    </div>

</section>

<?php } // End foreach ?>

<?php } else { ?>

    <section id="fermentable0">

    <h4><?php echo $label_fermentable." 1"; ?></h4>

    <input type="hidden" name="fermentable0" value="0">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-NAME" name="fermentable0-NAME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold"><?php echo $label_weight; ?></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-AMOUNT" name="fermentable0-AMOUNT" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-COLOR" class="col-sm-4 col-12 col-form-label fw-bold">Color <span class="text-muted small">(<?php echo ucwords($_SESSION['measColor']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-COLOR" name="fermentable0-COLOR" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-TYPE" name="fermentable0-TYPE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-ORIGIN" class="col-sm-4 col-12 col-form-label fw-bold">Orgin</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-ORIGIN" name="fermentable0-ORIGIN" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-SUPPLIER" class="col-sm-4 col-12 col-form-label fw-bold">Supplier</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-SUPPLIER" name="fermentable0-SUPPLIER" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-YIELD" class="col-sm-4 col-12 col-form-label fw-bold">Yield <span class="text-muted small">(%)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-YIELD" name="fermentable0-YIELD" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-ADD_AFTER_BOIL" class="col-sm-4 col-12 col-form-label fw-bold">Add After Boil?</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="fermentable0-ADD_AFTER_BOIL" name="fermentable0-ADD_AFTER_BOIL" type="text" value="" placeholder=""> -->
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="fermentable0-ADD_AFTER_BOIL1" name="fermentable0-ADD_AFTER_BOIL" value="TRUE">
                      <label class="form-check-label" for="fermentable0-ADD_AFTER_BOIL1">True</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="fermentable0-ADD_AFTER_BOIL2" name="fermentable0-ADD_AFTER_BOIL" value="FALSE">
                      <label class="form-check-label" for="fermentable0-ADD_AFTER_BOIL2">False</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-NOTES" class="col-sm-4 col-12 col-form-label fw-bold">Notes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="fermentable0-NOTES" name="fermentable0-NOTES" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-NOT_FERMENTABLE" class="col-sm-4 col-12 col-form-label fw-bold">Not Fermentable?</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="fermentable0-NOT_FERMENTABLE" name="fermentable0-NOT_FERMENTABLE" type="text" value="" placeholder=""> -->
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="fermentable0-NOT_FERMENTABLE1" name="fermentable0-NOT_FERMENTABLE" value="TRUE">
                      <label class="form-check-label" for="fermentable0-NOT_FERMENTABLE1">True</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="fermentable0-NOT_FERMENTABLE2" name="fermentable0-NOT_FERMENTABLE" value="FALSE">
                      <label class="form-check-label" for="fermentable0-NOT_FERMENTABLE2">False</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // end else ?>

<div style="margin-top: 25px;" id="add-fermentable-block" class="row">
    <div style="margin-bottom: 10px;" class="col-12 col-md-3">
        <div class="d-grid">
            <a id="add-fermentable" class="btn btn-sm btn-success" onclick="addSection('fermentable');">Add Fermentable <i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="d-grid">
            <a id="remove-fermentable" class="btn btn-sm btn-danger" onclick="removeSection('fermentable');">Remove Last Fermentable <i class="fa fa-minus-circle"></i></a>
        </div>
    </div>
</div>

<!-- Hops -->

<h3><?php echo $label_hops; ?></h3>

<?php
if (!empty($hops)) {
    $hop_num = 0;
    foreach ($hops as $key => $hop) {
    $hop_process_num = $hop_num;
    $hop_num++;
?>

<section id="<?php echo $key; ?>">

    <h4><?php echo $label_hop." ".$hop_num; ?></h4>

    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $hop_process_num; ?>">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-NAME" name="<?php echo $key; ?>-NAME" type="text" value="<?php if (isset($hop['NAME'])) echo h($hop['NAME']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Weight <span class="text-muted small">(<?php echo ucwords($_SESSION['measWeight1']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-AMOUNT" name="<?php echo $key; ?>-AMOUNT" type="text" value="<?php if (isset($hop['AMOUNT'])) echo h($hop['AMOUNT']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-ALPHA" class="col-sm-4 col-12 col-form-label fw-bold">Alpha Acid <span class="text-muted small">(%)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-ALPHA" name="<?php echo $key; ?>-ALPHA" type="text" value="<?php if (isset($hop['ALPHA'])) echo h($hop['ALPHA']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-USE" class="col-sm-4 col-12 col-form-label fw-bold">Use</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-USE" name="<?php echo $key; ?>-USE" type="text" value="<?php if (isset($hop['USE'])) echo h($hop['USE']); ?>" placeholder=""> -->
                    <select class="form-select" id="<?php echo $key; ?>-USE" name="<?php echo $key; ?>-USE">
                        <option value=""></option>
                        <option value="Mash" <?php if ((isset($hop['USE'])) && ($hop['USE'] == "Mash")) echo "selected"; ?>>Mash</option>
                        <option value="First Wort" <?php if ((isset($hop['USE'])) && ($hop['USE'] == "First Wort")) echo "selected"; ?>>First Wort</option>
                        <option value="Boil" <?php if ((isset($hop['USE'])) && ($hop['USE'] == "Boil")) echo "selected"; ?>>Boil</option>
                        <option value="Aroma" <?php if ((isset($hop['USE'])) && ($hop['USE'] == "Aroma")) echo "selected"; ?>>Aroma</option>
                        <option value="Dry Hop" <?php if ((isset($hop['USE'])) && ($hop['USE'] == "Dry Hop")) echo "selected"; ?>>Dry Hop</option>
                        <?php if (isset($hop['USE'])) echo select_stored_option($hop['USE'], array("Mash", "First Wort", "Boil", "Aroma", "Dry Hop")); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-TIME" class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-TIME" name="<?php echo $key; ?>-TIME" type="text" value="<?php if (isset($hop['TIME'])) echo h($hop['TIME']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-FORM" class="col-sm-4 col-12 col-form-label fw-bold">Form</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-FORM" name="<?php echo $key; ?>-FORM" type="text" value="<?php if (isset($hop['FORM'])) echo h($hop['FORM']); ?>" placeholder=""> -->
                    <select class="form-select" id="<?php echo $key; ?>-FORM" name="<?php echo $key; ?>-FORM">
                        <option value=""></option>
                        <option value="Pellet" <?php if ((isset($hop['FORM'])) && (($hop['FORM'] == "Pellet") || ($hop['FORM'] == "Pellets"))) echo "selected"; ?>>Pellet</option>
                        <option value="Plug" <?php if ((isset($hop['FORM'])) && ($hop['FORM'] == "Plug")) echo "selected"; ?>>Plug</option>
                        <option value="Leaf" <?php if ((isset($hop['FORM'])) && ($hop['FORM'] == "Leaf")) echo "selected"; ?>>Leaf</option>
                        <option value="Extract" <?php if ((isset($hop['FORM'])) && ($hop['FORM'] == "Extract")) echo "selected"; ?>>Extract</option>
                        <?php if (isset($hop['FORM'])) echo select_stored_option($hop['FORM'], array("Pellet", "Pellets", "Plug", "Leaf", "Extract")); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-TEMPERATURE" class="col-sm-4 col-12 col-form-label fw-bold">Temperature <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-TEMPERATURE" name="<?php echo $key; ?>-TEMPERATURE" type="text" value="<?php if (isset($hop['TEMPERATURE'])) echo h($hop['TEMPERATURE']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-ORIGIN" class="col-sm-4 col-12 col-form-label fw-bold">Origin</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-ORIGIN" name="<?php echo $key; ?>-ORIGIN" type="text" value="<?php if (isset($hop['ORIGIN'])) echo h($hop['ORIGIN']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-SUBSTITUTES" class="col-sm-4 col-12 col-form-label fw-bold">Substitutes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-SUBSTITUTES" name="<?php echo $key; ?>-SUBSTITUTES" type="text" value="<?php if (isset($hop['SUBSTITUTES'])) echo h($hop['SUBSTITUTES']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NOTES" class="col-sm-4 col-12 col-form-label fw-bold">Notes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-NOTES" name="<?php echo $key; ?>-NOTES" type="text" value="<?php if (isset($hop['NOTES'])) echo h($hop['NOTES']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // End foreach ?>

<?php } else { ?>

<section id="hop0">

    <h4><?php echo $label_hop." 1"; ?></h4>

    <input type="hidden" name="hop0" value="0">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-NAME" name="hop0-NAME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Weight <span class="text-muted small">(<?php echo ucwords($_SESSION['measWeight2']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-AMOUNT" name="hop0-AMOUNT" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-ALPHA" class="col-sm-4 col-12 col-form-label fw-bold">Alpha Acid <span class="text-muted small">(%)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-ALPHA" name="hop0-ALPHA" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-USE" class="col-sm-4 col-12 col-form-label fw-bold">Use</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="hop0-USE" name="hop0-USE" type="text" value="" placeholder=""> -->
                    <select class="form-select" id="hop0-USE" name="hop0-USE">
                        <option value=""></option>
                        <option value="Mash">Mash</option>
                        <option value="First Wort">First Wort</option>
                        <option value="Boil">Boil</option>
                        <option value="Aroma">Aroma</option>
                        <option value="Dry Hop">Dry Hop</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-TIME" class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-TIME" name="hop0-TIME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-FORM" class="col-sm-4 col-12 col-form-label fw-bold">Form</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="hop0-FORM" name="hop0-FORM" type="text" value="" placeholder=""> -->
                    <select class="form-select" id="hop0-FORM" name="hop0-FORM">
                        <option value=""></option>
                        <option value="Pellet">Pellet</option>
                        <option value="Plug">Plug</option>
                        <option value="Leaf">Leaf</option>
                        <option value="Extract">Extract</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-TEMPERATURE" class="col-sm-4 col-12 col-form-label fw-bold">Temperature</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-TEMPERATURE" name="hop0-TEMPERATURE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-ORIGIN" class="col-sm-4 col-12 col-form-label fw-bold">Origin</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-ORIGIN" name="hop0-ORIGIN" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-SUBSTITUTES" class="col-sm-4 col-12 col-form-label fw-bold">Substitutes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-SUBSTITUTES" name="hop0-SUBSTITUTES" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="hop0-NOTES" class="col-sm-4 col-12 col-form-label fw-bold">Notes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="hop0-NOTES" name="hop0-NOTES" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    
</section>

<?php } // end else ?>

<div style="margin-top: 25px;" id="add-hop-block" class="row">
    <div style="margin-bottom: 10px;" class="col-12 col-md-3">
        <div class="d-grid">
            <a id="add-hop" class="btn btn-sm btn-success" onclick="addSection('hop');">Add Hop <i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="d-grid">
            <a id="remove-hop" class="btn btn-sm btn-danger" onclick="removeSection('hop');">Remove Last Hop <i class="fa fa-minus-circle"></i></a>
        </div>
    </div>
</div>

<!-- Yeasts -->

<h3><?php echo $label_yeasts; ?></h3>

<?php
if (!empty($yeasts)) {
    $yeast_num = 0;
    foreach ($yeasts as $key => $yeast) {
        $yeast_process_num = $yeast_num;
        $yeast_num++;
?>

<section id="<?php echo $key; ?>">

    <h4><?php echo $label_yeast." ".$yeast_num; ?></h4>

    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $yeast_process_num; ?>">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-NAME" name="<?php echo $key; ?>-NAME" type="text" value="<?php echo h($yeast['NAME']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-LABORATORY" class="col-sm-4 col-12 col-form-label fw-bold">Lab</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-LABORATORY" name="<?php echo $key; ?>-LABORATORY" type="text" value="<?php if (isset($yeast['LABORATORY'])) echo h($yeast['LABORATORY']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-PRODUCT_ID" class="col-sm-4 col-12 col-form-label fw-bold">Product ID</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-PRODUCT_ID" name="<?php echo $key; ?>-PRODUCT_ID" type="text" value="<?php if (isset($yeast['PRODUCT_ID'])) echo h($yeast['PRODUCT_ID']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Amount <span class="text-muted small">(L)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-AMOUNT" name="<?php echo $key; ?>-AMOUNT" type="text" value="<?php if (isset($yeast['AMOUNT'])) echo h($yeast['AMOUNT']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-TYPE" name="<?php echo $key; ?>-TYPE" type="text" value="<?php if (isset($yeast['TYPE'])) echo h($yeast['TYPE']); ?>" placeholder=""> -->
                    <select class="form-select" id="<?php echo $key; ?>-TYPE" name="<?php echo $key; ?>-TYPE">
                        <option value=""></option>
                        <option value="Ale" <?php if ((isset($yeast['TYPE'])) && ($yeast['TYPE'] == "Ale")) echo "selected"; ?>>Ale</option>
                        <option value="Lager" <?php if ((isset($yeast['TYPE'])) && ($yeast['TYPE'] == "Lager")) echo "selected"; ?>>Lager</option>
                        <option value="Wheat" <?php if ((isset($yeast['TYPE'])) && ($yeast['TYPE'] == "Wheat")) echo "selected"; ?>>Wheat</option>
                        <option value="Wine" <?php if ((isset($yeast['TYPE'])) && ($yeast['TYPE'] == "Wine")) echo "selected"; ?>>Wine</option>
                        <option value="Champagne" <?php if ((isset($yeast['TYPE'])) && ($yeast['TYPE'] == "Champagne")) echo "selected"; ?>>Champagne</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-FORM" class="col-sm-4 col-12 col-form-label fw-bold">Form</label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-FORM" name="<?php echo $key; ?>-FORM" type="text" value="<?php if (isset($yeast['FORM'])) echo h($yeast['FORM']); ?>" placeholder="May be “Liquid”, “Dry”, “Slant” or “Culture”"> -->
                    <select class="form-select" id="<?php echo $key; ?>-FORM" name="<?php echo $key; ?>-FORM">
                        <option value=""></option>
                        <option value="Liquid" <?php if ((isset($yeast['FORM'])) && ($yeast['FORM'] == "Liquid")) echo "selected"; ?>>Liquid</option>
                        <option value="Dry" <?php if ((isset($yeast['FORM'])) && ($yeast['FORM'] == "Dry")) echo "selected"; ?>>Dry</option>
                        <option value="Slant" <?php if ((isset($yeast['FORM'])) && ($yeast['FORM'] == "Slant")) echo "selected"; ?>>Slant</option>
                        <option value="Culture" <?php if ((isset($yeast['FORM'])) && ($yeast['FORM'] == "Culture")) echo "selected"; ?>>Culture</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-MIN_TEMPERATURE" class="col-sm-4 col-12 col-form-label fw-bold">Min Temp <span class="text-muted small">(&deg;C)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-MIN_TEMPERATURE" name="<?php echo $key; ?>-MIN_TEMPERATURE" type="text" value="<?php if (isset($yeast['MIN_TEMPERATURE'])) echo h($yeast['MIN_TEMPERATURE']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-MAX_TEMPERATURE" class="col-sm-4 col-12 col-form-label fw-bold">Max Temp <span class="text-muted small">(&deg;C)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-MAX_TEMPERATURE" name="<?php echo $key; ?>-MAX_TEMPERATURE" type="text" value="<?php if (isset($yeast['MAX_TEMPERATURE'])) echo h($yeast['MAX_TEMPERATURE']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-ATTENUATION" class="col-sm-4 col-12 col-form-label fw-bold">Attenuation <span class="text-muted small">(%)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-ATTENUATION" name="<?php echo $key; ?>-ATTENUATION" type="text" value="<?php if (isset($yeast['ATTENUATION'])) echo h($yeast['ATTENUATION']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-FLOCCULATION" class="col-sm-4 col-12 col-form-label fw-bold">Flocculation</span></label>
                <div class="col-sm-8 col-12">
                    <!-- <input class="form-control" id="<?php echo $key; ?>-FLOCCULATION" name="<?php echo $key; ?>-FLOCCULATION" type="text" value="<?php if (isset($yeast['FLOCCULATION'])) echo h($yeast['FLOCCULATION']); ?>" placeholder=""> -->
                    <select class="form-select" id="<?php echo $key; ?>-FLOCCULATION" name="<?php echo $key; ?>-FLOCCULATION">
                        <option value=""></option>
                        <option value="Low" <?php if ((isset($yeast['FLOCCULATION'])) && ($yeast['FLOCCULATION'] == "Low")) echo "selected"; ?>>Low</option>
                        <option value="Medium" <?php if ((isset($yeast['FLOCCULATION'])) && ($yeast['FLOCCULATION'] == "Medium")) echo "selected"; ?>>Medium</option>
                        <option value="High" <?php if ((isset($yeast['FLOCCULATION'])) && ($yeast['FLOCCULATION'] == "High")) echo "selected"; ?>>High</option>
                        <option value="Very High" <?php if ((isset($yeast['FLOCCULATION'])) && ($yeast['FLOCCULATION'] == "Very High")) echo "selected"; ?>>Very High</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // End foreach ?>

<?php } else { ?>

<section id="yeast0">

    <h4><?php echo $label_yeast." 1"; ?></h4>

    <input type="hidden" name="yeast0" value="0">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-NAME" name="yeast0-NAME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-LABORATORY" class="col-sm-4 col-12 col-form-label fw-bold">Lab</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-LABORATORY" name="yeast0-LABORATORY" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-PRODUCT_ID" class="col-sm-4 col-12 col-form-label fw-bold">Product ID</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-PRODUCT_ID" name="yeast0-PRODUCT_ID" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Amount <span class="text-muted small">(L)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-AMOUNT" name="yeast0-AMOUNT" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-TYPE" name="yeast0-TYPE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-FORM" class="col-sm-4 col-12 col-form-label fw-bold">Form</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-FORM" name="yeast0-FORM" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-MIN_TEMPERATURE" class="col-sm-4 col-12 col-form-label fw-bold">Min Temp <span class="text-muted small">(C)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-MIN_TEMPERATURE" name="yeast0-MIN_TEMPERATURE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-MAX_TEMPERATURE" class="col-sm-4 col-12 col-form-label fw-bold">Max Temp <span class="text-muted small">(C)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-MAX_TEMPERATURE" name="yeast0-MAX_TEMPERATURE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-ATTENUATION" class="col-sm-4 col-12 col-form-label fw-bold">Attenuation <span class="text-muted small">(%)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-ATTENUATION" name="yeast0-ATTENUATION" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="yeast0-FLOCCULATION" class="col-sm-4 col-12 col-form-label fw-bold">Flocculation</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="yeast0-FLOCCULATION" name="yeast0-FLOCCULATION" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // end else ?>

<div style="margin-top: 25px;" id="add-yeast-block" class="row">
    <div style="margin-bottom: 10px;" class="col-12 col-md-3">
        <div class="d-grid">
            <a id="add-yeast" class="btn btn-sm btn-success" onclick="addSection('yeast');">Add Yeast <i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="d-grid">
            <a id="remove-yeast" class="btn btn-sm btn-danger" onclick="removeSection('yeast');">Remove Last Yeast <i class="fa fa-minus-circle"></i></a>
        </div>
    </div>
</div>

<!-- Misc (Non-Fermentables) -->

<h3><?php echo $label_misc_ingredients; ?></h3>

<?php 

if (!empty($non_fermentables)) {

    $non_fermentable_num = 0;
    foreach ($non_fermentables as $key => $non_fermentable) {
        $non_fermentable_process_num = $non_fermentable_num;
        $non_fermentable_num++;

?>

<section id="<?php echo $key; ?>">

    <h4><?php echo "Misc ".$non_fermentable_num; ?></h4>

    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $non_fermentable_process_num; ?>">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-NAME" name="<?php echo $key; ?>-NAME" type="text" value="<?php echo h($non_fermentable['NAME']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-TIME" class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-TIME" name="<?php echo $key; ?>-TIME" type="text" value="<?php if (isset($non_fermentable['TIME'])) echo h($non_fermentable['TIME']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label id="<?php echo $key; ?>-AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Amount <span id="misc-amt-is-weight" class="text-muted small"><?php if ((isset($non_fermentable['AMOUNT_IS_WEIGHT'])) && ($non_fermentable['AMOUNT_IS_WEIGHT'] == "TRUE")) echo "(KG)"; else echo "(L)"; ?></span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-AMOUNT" name="<?php echo $key; ?>-AMOUNT" type="text" value="<?php if (isset($non_fermentable['AMOUNT'])) echo h($non_fermentable['AMOUNT']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="fermentable0-ADD_AFTER_BOIL" class="col-sm-4 col-12 col-form-label fw-bold">Amount is Weight?</label>
                <div class="col-12 col-md-6">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="<?php echo $key; ?>-AMOUNT_IS_WEIGHT1" name="<?php echo $key; ?>-AMOUNT_IS_WEIGHT" value="TRUE" <?php if ((isset($non_fermentable['AMOUNT_IS_WEIGHT'])) && (strtoupper($non_fermentable['AMOUNT_IS_WEIGHT']) == "TRUE")) echo "checked"; ?>>
                      <label class="form-check-label" for="<?php echo $key; ?>-AMOUNT_IS_WEIGHT1">True</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="<?php echo $key; ?>-AMOUNT_IS_WEIGHT2" name="<?php echo $key; ?>-AMOUNT_IS_WEIGHT" value="FALSE" <?php if (((isset($non_fermentable['AMOUNT_IS_WEIGHT'])) && (strtoupper($non_fermentable['AMOUNT_IS_WEIGHT']) == "FALSE")) || (!isset($non_fermentable['AMOUNT_IS_WEIGHT']))) echo "checked"; ?>>
                      <label class="form-check-label" for="<?php echo $key; ?>-AMOUNT_IS_WEIGHT2">False</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-DISPLAY_AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Display Amount</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-DISPLAY_AMOUNT" name="<?php echo $key; ?>-DISPLAY_AMOUNT" type="text" value="<?php if (isset($non_fermentable['DISPLAY_AMOUNT'])) echo h($non_fermentable['DISPLAY_AMOUNT']); ?>" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-TYPE"  class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-TYPE" name="<?php echo $key; ?>-TYPE" type="text" value="<?php if (isset($non_fermentable['TYPE'])) echo h($non_fermentable['TYPE']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="<?php echo $key; ?>-USE" class="col-sm-4 col-12 col-form-label fw-bold">Use</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="<?php echo $key; ?>-USE" name="<?php echo $key; ?>-USE" type="text" value="<?php if (isset($non_fermentable['USE'])) echo h($non_fermentable['USE']); ?>" placeholder="">
                </div>
            </div>
        </div>
    </div>

</section>

<?php } // End foreach ?>

<?php } else { ?>

<section id="misc0">

    <h4>Misc 1</h4>

    <input type="hidden" name="misc0" value="0">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="misc0-NAME"  class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="misc0-NAME" name="misc0-NAME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="misc0-TIME"  class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="misc0-TIME" name="misc0-TIME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="misc0-AMOUNT"  class="col-sm-4 col-12 col-form-label fw-bold">Amount <span class="text-muted small"><?php if ((isset($non_fermentable['AMOUNT_IS_WEIGHT'])) && ($non_fermentable['AMOUNT_IS_WEIGHT'] == "TRUE")) echo "(KG)"; else echo "(L)"; ?></span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="misc0-AMOUNT" name="misc0-AMOUNT" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="misc0-DISPLAY_AMOUNT" class="col-sm-4 col-12 col-form-label fw-bold">Display Amount</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="misc0-DISPLAY_AMOUNT" name="misc0-DISPLAY_AMOUNT" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="misc0-TYPE"  class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="misc0-TYPE" name="misc0-TYPE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="misc0-USE" class="col-sm-4 col-12 col-form-label fw-bold">Use</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="misc0-USE" name="misc0-USE" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>


</section>

<?php } // end else ?>

<div style="margin-top: 25px;" id="add-misc-block" class="row">
    <div style="margin-bottom: 10px;" class="col-12 col-md-3">
        <div class="d-grid">
            <a id="add-misc" class="btn btn-sm btn-success" onclick="addSection('misc');">Add Miscellaneous Ingredient <i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="d-grid">
            <a id="remove-misc" class="btn btn-sm btn-danger" onclick="removeSection('misc');">Remove Last Miscellaneous Ingredient <i class="fa fa-minus-circle"></i></a>
        </div>
    </div>
</div>

<!-- Mash Profile and Steps -->

<div id="mash-profile">

    <h3><?php echo $label_mash_profile; ?></h3>

    <?php if (!empty($mash)) { ?>

       <div class="row">
           <div class="col-12 col-md-6">
               <div class="mb-3">
                   <label for="mash-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                   <div class="col-sm-8 col-12">
                       <input class="form-control" id="mash-NAME" name="mash-NAME" type="text" value="<?php if (isset($mash['NAME'])) echo h($mash['NAME']); ?>" placeholder="">
                   </div>
               </div>
           </div>
           <div class="col-12 col-md-6">
               <div class="mb-3">
                   <label for="mash-GRAIN_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Grain Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                   <div class="col-sm-8 col-12">
                       <input class="form-control" id="mash-GRAIN_TEMP" name="mash-GRAIN_TEMP" type="text" value="<?php if (isset($mash['GRAIN_TEMP'])) echo h($mash['GRAIN_TEMP']); ?>" placeholder="">
                   </div>
               </div>
           </div>
       </div>

       <div class="row">
           <div class="col-12 col-md-6">
               <div class="mb-3">
                   <label for="mash-TUN_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Tun Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                   <div class="col-sm-8 col-12">
                       <input class="form-control" id="mash-TUN_TEMP" name="mash-TUN_TEMP" type="text" value="<?php if (isset($mash['TUN_TEMP'])) echo h($mash['TUN_TEMP']); ?>" placeholder="">
                   </div>
               </div>
           </div>
           <div class="col-12 col-md-6">
               <div class="mb-3">
                   <label for="mash-SPARGE_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Sparge Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                   <div class="col-sm-8 col-12">
                       <input class="form-control" id="mash-SPARGE_TEMP" name="mash-SPARGE_TEMP" type="text" value="<?php if (isset($mash['SPARGE_TEMP'])) echo h($mash['SPARGE_TEMP']); ?>" placeholder="">
                   </div>
               </div>
           </div>
       </div>

       <div class="row">
           <div class="col-12 col-md-6">
               <div class="mb-3">
                   <label for="mash-PH" class="col-sm-4 col-12 col-form-label fw-bold">pH</label>
                   <div class="col-sm-8 col-12">
                       <input class="form-control" id="mash-PH" name="mash-PH" type="text" value="<?php if (isset($mash['PH'])) echo h($mash['PH']); ?>" placeholder="">
                   </div>
               </div>
           </div>
           <div class="col-12 col-md-6">
               <div class="mb-3">
                   <label for="mash-NOTES" class="col-sm-4 col-12 col-form-label fw-bold">Notes</label>
                   <div class="col-sm-8 col-12">
                       <input class="form-control" id="mash-NOTES" name="mash-NOTES" type="text" value="<?php if (isset($mash['NOTES'])) echo h($mash['NOTES']); ?>" placeholder="">
                   </div>
               </div>
           </div>
       </div>

    <?php 

        $mash_steps_display = "";
        $mash_step_num = 0;

        if (!isset($mash['MASH_STEPS'])) {

    ?>

    <section id="mash_step0">

        <input type="hidden" name="mash_step0" value="0">

        <h4>Mash Step 1</h4>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-NAME" name="mash_step0-NAME" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-TYPE" name="mash_step0-TYPE" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-STEP_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-STEP_TEMP" name="mash_step0-STEP_TEMP" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-STEP_TIME" class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</span></label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-STEP_TIME" name="mash_step0-STEP_TIME" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php

        } else {

            foreach ($mash['MASH_STEPS'] as $key => $mash_step) {
                
                if (isset($mash_step['NAME'])) {
                    $mash_step_process_num = $mash_step_num;
                    $mash_step_num++;
            
    ?>

    <section id="<?php echo $key; ?>">

        <h4><?php echo "Mash Step ".$mash_step_num; ?></h4>

        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $mash_step_process_num; ?>">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="<?php echo $key; ?>-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="<?php echo $key; ?>-NAME" name="<?php echo $key; ?>-NAME" type="text" value="<?php if (isset($mash_step['NAME'])) echo h($mash_step['NAME']); ?>" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="<?php echo $key; ?>-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="<?php echo $key; ?>-TYPE" name="<?php echo $key; ?>-TYPE" type="text" value="<?php if (isset($mash_step['TYPE'])) echo h($mash_step['TYPE']); ?>" placeholder="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="<?php echo $key; ?>-STEP_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="<?php echo $key; ?>-STEP_TEMP" name="<?php echo $key; ?>-STEP_TEMP" type="text" value="<?php if (isset($mash_step['STEP_TEMP'])) echo h($mash_step['STEP_TEMP']); ?>" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="<?php echo $key; ?>-STEP_TIME" class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</span></label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="<?php echo $key; ?>-STEP_TIME" name="<?php echo $key; ?>-STEP_TIME" type="text" value="<?php if (isset($mash_step['STEP_TIME'])) echo h($mash_step['STEP_TIME']); ?>" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <?php } // end (isset($mash_step['NAME'])) ?>
    <?php } // end foreach ?>
    <?php } // end (isset($mash_step['MASH_STEPS'])) ?>
    <?php } else { ?>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="mash-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="mash-NAME" name="mash-NAME" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="mash-GRAIN_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Grain Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="mash-GRAIN_TEMP" name="mash-GRAIN_TEMP" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="mash-TUN_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Tun Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="mash-TUN_TEMP" name="mash-TUN_TEMP" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="mash-SPARGE_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Sparge Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="mash-SPARGE_TEMP" name="mash-SPARGE_TEMP" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="mash-PH" class="col-sm-4 col-12 col-form-label fw-bold">pH</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="mash-PH" name="mash-PH" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mb-3">
                <label for="mash-NOTES" class="col-sm-4 col-12 col-form-label fw-bold">Notes</label>
                <div class="col-sm-8 col-12">
                    <input class="form-control" id="mash-NOTES" name="mash-NOTES" type="text" value="" placeholder="">
                </div>
            </div>
        </div>
    </div>

    <section id="mash_step0">

        <h4>Mash Step 1</h4>

        <input type="hidden" name="mash_step0" value="0">

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-NAME" class="col-sm-4 col-12 col-form-label fw-bold">Name</label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-NAME" name="mash_step0-NAME" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-TYPE" class="col-sm-4 col-12 col-form-label fw-bold">Type</label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-TYPE" name="mash_step0-TYPE" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-STEP_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-STEP_TEMP" name="mash_step0-STEP_TEMP" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="mash_step0-STEP_TIME" class="col-sm-4 col-12 col-form-label fw-bold">Time <span class="text-muted small">(Min)</span></label>
                    <div class="col-sm-8 col-12">
                        <input class="form-control" id="mash_step0-STEP_TIME" name="mash_step0-STEP_TIME" type="text" value="" placeholder="">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php } ?>

    <div style="margin-top: 25px;" id="add-mash_step-block" class="row">
        <div style="margin-bottom: 10px;" class="col-12 col-md-3">
            <div class="d-grid">
                <a id="add-mash_step" class="btn btn-sm btn-success" onclick="addSection('mash_step');">Add Mash Step <i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="d-grid">
                <a id="remove-mash_step" class="btn btn-sm btn-danger" onclick="removeSection('mash_step');">Remove Last Mash Step <i class="fa fa-minus-circle"></i></a>
            </div>
        </div>
    </div>

</div>

<!-- Fermentation and Aging -->

<h3>Fermentation and Aging</h3>

<h4>Primary</h4>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="PRIMARY_AGE" class="col-sm-4 col-12 col-form-label fw-bold">Age <small class="text-muted">(Days)</small></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="PRIMARY_AGE" name="PRIMARY_AGE" type="text" value="<?php if ((!empty($primary)) && (isset($primary['PRIMARY_AGE']))) echo h($primary['PRIMARY_AGE']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="PRIMARY_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="PRIMARY_TEMP" name="PRIMARY_TEMP" type="text" value="<?php if ((!empty($primary)) && (isset($primary['PRIMARY_TEMP']))) echo h($primary['PRIMARY_TEMP']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<h4>Secondary</h4>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="SECONDARY_AGE" class="col-sm-4 col-12 col-form-label fw-bold">Age <small class="text-muted">(Days)</small></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="SECONDARY_AGE" name="SECONDARY_AGE" type="text" value="<?php if ((!empty($secondary)) && (isset($secondary['SECONDARY_AGE']))) echo h($secondary['SECONDARY_AGE']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="SECONDARY_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="SECONDARY_TEMP" name="SECONDARY_TEMP" type="text" value="<?php if ((!empty($secondary)) && (isset($secondary['SECONDARY_TEMP']))) echo h($secondary['SECONDARY_TEMP']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<h4>Tertiary</h4>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="TERTIARY_AGE" class="col-sm-4 col-12 col-form-label fw-bold">Age <small class="text-muted">(Days)</small></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="TERTIARY_AGE" name="TERTIARY_AGE" type="text" value="<?php if ((!empty($tertiary)) && (isset($tertiary['TERTIARY_AGE']))) echo h($tertiary['TERTIARY_AGE']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="TERTIARY_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="TERTIARY_TEMP" name="TERTIARY_TEMP" type="text" value="<?php if ((!empty($tertiary)) && (isset($tertiary['TERTIARY_TEMP']))) echo h($tertiary['TERTIARY_TEMP']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>

<h4>Aging</h4>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="AGE" class="col-sm-4 col-12 col-form-label fw-bold">Age <small class="text-muted">(Days)</small></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="AGE" name="AGE" type="text" value="<?php if ((!empty($age)) && (isset($age['AGE']))) echo h($age['AGE']); ?>" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label for="AGE_TEMP" class="col-sm-4 col-12 col-form-label fw-bold">Temp <span class="text-muted small">(&deg;<?php echo ucwords($_SESSION['measTemp']); ?>)</span></label>
            <div class="col-sm-8 col-12">
                <input class="form-control" id="AGE_TEMP" name="AGE_TEMP" type="text" value="<?php if ((!empty($age)) && (isset($age['AGE_TEMP']))) echo h($age['AGE_TEMP']); ?>" placeholder="">
            </div>
        </div>
    </div>
</div>
<?php } // end if (($action == "edit") && (!$essentials)) ?>

<div style="margin-top: 30px;" class="mb-3">
    <div class="col-12 d-grid">
        <input id="update-brewblog-btn" name="submit" type="submit" class="btn btn-lg btn-primary" value="Update BrewBlog">
    </div>
</div>

</form>

<div class="modal fade" id="last-element-warning" tabindex="-1" role="dialog" aria-labelledby="last-element-warning-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <p style="font-size: 1.5em; font-weight: bold;" class="modal-title" id="last-element-warning-label">Please Note</p>
            </div>
            <div class="modal-body">
                <p>The first section cannot be removed. At least one section must remain. Clear the data in the remaining section to remove completely from the record.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tap-location-clear-confirm" tabindex="-1" role="dialog" aria-labelledby="tap-location-clear-confirm-label" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p style="font-size: 1.5em; font-weight: bold;" class="modal-title" id="tap-location-clear-confirm-label">Please Note</p>
            </div>
            <div class="modal-body">
                <p>You're changing this BrewBlog's Status away from "On Tap". Would you like to keep the Tap Location data you've entered?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="tap-location-keep-btn" class="btn btn-secondary">Keep Tap Location Data</button>
                <button type="button" id="tap-location-discard-btn" class="btn btn-danger">Discard Tap Location Data</button>
            </div>
        </div>
    </div>
</div>

</div>

<?php } // end else (this else is for adding/editing) ?>

<!-- Load Moment -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>

<!-- Load Bootstrap DateTime Picker / http://eonasdan.github.io/bootstrap-datetimepicker/ -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>
    
    $(function(){
        $('.date-time-picker-day-time').datetimepicker({format: 'YYYY-MM-DD hh:mm A'});
        $('.date-time-picker-day').datetimepicker({format: 'YYYY-MM-DD'});

        // Tap Location fields: init any pre-rendered searchable location and flag selects
        $('.tap-location-select').each(function() {
            initTapLocationSelect(this);
        });
        $('.tap-flag-select').each(function() {
            initTapFlagSelect(this);
        });

        // Tap Location fields: only show when Status is "On Tap"
        $("#tap-location-fields").hide();
        if ("<?php echo isset($row_log['brewStatus']) ? addslashes($row_log['brewStatus']) : ''; ?>" == "On Tap") $("#tap-location-fields").show();
        $("#brewStatus").change(function() {

            if ($(this).val() == "On Tap") {
                $("#tap-location-fields").show("fast");
                return;
            }

            // Moving away from "On Tap" - if any location has been entered, ask
            // whether to keep or discard it before hiding the section.
            var hasTapLocationData = false;
            $("#tap-location-fields .tap-location-select").each(function() {
                if ($(this).val()) hasTapLocationData = true;
            });

            if (hasTapLocationData) {
                bootstrap.Modal.getOrCreateInstance(document.getElementById('tap-location-clear-confirm')).show();
            } else {
                $("#tap-location-fields").hide("fast");
            }

        });

        $("#tap-location-keep-btn").click(function() {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('tap-location-clear-confirm')).hide();
            $("#tap-location-fields").hide("fast");
        });

        $("#tap-location-discard-btn").click(function() {
            $("#tap-location-fields section[id^='taplocation']").each(function() {
                var $section = $(this);
                $section.find('input[type="text"], input[type="number"]').val('');
                $section.find('.tap-location-select, .tap-flag-select').each(function() {
                    if (this.tomselect) this.tomselect.clear();
                    else this.value = '';
                });
            });
            bootstrap.Modal.getOrCreateInstance(document.getElementById('tap-location-clear-confirm')).hide();
            $("#tap-location-fields").hide("fast");
        });
    });

    /**
     * Init a searchable, create-on-the-fly Tom Select on a Tap Location <select>,
     * with a "Locations in Use" header above the suggestion list (a plain HTML5
     * datalist can't show a header, so this replaces that approach).
     * @param {Element} el - the raw <select class="tap-location-select"> DOM element
     */

    function initTapLocationSelect(el) {
        if (!el || el.tomselect) return;
        var hasSuggestions = Array.prototype.some.call(el.options, function(o) { return o.value !== ''; });
        new TomSelect(el, {
            create: true,
            persist: false,
            maxItems: 1,
            placeholder: hasSuggestions ? 'Search or add a location' : 'Add your first tap location',
            onInitialize: function() {
                if (!hasSuggestions) return;
                var header = document.createElement('div');
                header.className = 'dropdown-header';
                header.textContent = 'Locations in Use';
                this.dropdown.insertBefore(header, this.dropdown.firstChild);
            }
        });
    }

    /**
     * Init a searchable, flag-icon-rendered Tom Select on a Country Flag <select>
     * @param {Element} el - the raw <select class="tap-flag-select"> DOM element
     */

    function initTapFlagSelect(el) {
        if (!el || el.tomselect) return;
        new TomSelect(el, {
            maxOptions: 100,
            allowEmptyOption: true,
            render: {
                option: function(data, escape) { return '<div><span class="fi fi-' + escape(data.value) + ' me-2"></span>' + escape(data.text) + '</div>'; },
                item: function(data, escape) { return '<div><span class="fi fi-' + escape(data.value) + ' me-1"></span>' + escape(data.text) + '</div>'; }
            }
        });
    }

    /**
     * Adds a new Tap Location section, then (re)initializes the plugins that
     * addSection() doesn't know about: the datetimepicker and the two Tom
     * Select widgets (location, flag). Each source section's Tom Select
     * instance is destroyed before cloning (so the clone starts from a plain
     * <select>) and restored afterward on both the original and new section.
     */

    function addTapLocationSection() {
        var $lastSection = $('section[id^="taplocation"]').last();

        var lastLocationSelect = $lastSection.find('.tap-location-select')[0];
        var lastLocationTomSelect = lastLocationSelect ? lastLocationSelect.tomselect : null;
        var lastLocationValue = lastLocationTomSelect ? lastLocationTomSelect.getValue() : null;
        if (lastLocationTomSelect) lastLocationTomSelect.destroy();

        var lastFlagSelect = $lastSection.find('.tap-flag-select')[0];
        var lastFlagTomSelect = lastFlagSelect ? lastFlagSelect.tomselect : null;
        var lastFlagValue = lastFlagTomSelect ? lastFlagTomSelect.getValue() : null;
        if (lastFlagTomSelect) lastFlagTomSelect.destroy();

        addSection('taplocation');

        if (lastLocationSelect) {
            initTapLocationSelect(lastLocationSelect);
            if (lastLocationValue) lastLocationSelect.tomselect.setValue(lastLocationValue);
        }
        if (lastFlagSelect) {
            initTapFlagSelect(lastFlagSelect);
            if (lastFlagValue) lastFlagSelect.tomselect.setValue(lastFlagValue);
        }

        var $newSection = $('section[id^="taplocation"]').last();
        $newSection.find('.date-time-picker-day').datetimepicker({format: 'YYYY-MM-DD'});
        initTapLocationSelect($newSection.find('.tap-location-select')[0]);
        initTapFlagSelect($newSection.find('.tap-flag-select')[0]);
    }

    /**
     * Universal jQuery function to clone and add a new section
     * Automatically increments IDs, names, and clears values
     * @param {string} sectionID - The base name of the section (e.g., 'fermentable', 'hop', 'yeast')
     */
    
    function addSection(sectionID) {
        // Find all existing sections with this ID prefix
        var $sections = $('section[id^="' + sectionID + '"]');
        
        // Get the last section
        var $lastSection = $sections.last();
        
        // Extract the current number from the last section's ID
        var lastId = $lastSection.attr('id');
        var currentNum = parseInt(lastId.replace(sectionID, ''));
        var newNum = currentNum + 1;
        
        // Clone the last section
        var $newSection = $lastSection.clone();
        
        // Update the section ID
        $newSection.attr('id', sectionID + newNum);
        
        // Create a regex pattern to match the sectionID with any number
        var pattern = new RegExp(sectionID + '\\d+', 'g');
        
        // Update the heading (capitalize first letter of sectionID)
        if (sectionID == "mash_step") var displayName = "Mash Step ";
        else if (sectionID == "taplocation") var displayName = "Tap Location ";
        else var displayName = sectionID.charAt(0).toUpperCase() + sectionID.slice(1);

        $newSection.find('h4').text(displayName + ' ' + (newNum + 1));
        
        // Update all form elements: inputs, selects, textareas
        $newSection.find('input, select, textarea').each(function() {
            var $element = $(this);
            var elementType = $element.attr('type');
            
            // Update ID
            var oldId = $element.attr('id');
            if (oldId) {
                var newId = oldId.replace(pattern, sectionID + newNum);
                $element.attr('id', newId);
            }
            
            // Update name
            var oldName = $element.attr('name');
            if (oldName) {
                var newName = oldName.replace(pattern, sectionID + newNum);
                console.log(newName);
                $element.attr('name', newName);
            }
            
            // Clear/reset values based on element type
            if (elementType === 'checkbox' || elementType === 'radio') {
                // Uncheck checkboxes and radio buttons
                $element.prop('checked', false);
            } 
            else if ($element.is('select')) {
                // Reset select dropdowns to first option or empty
                $element.prop('selectedIndex', 0);
            }
            else if ($element.is('textarea')) {
                // Clear textarea content
                $element.val('');
            }
            else if (elementType === 'hidden') {
                // The bare "sectionID+N" hidden field is this section's index counter
                // (e.g. name="fermentable0", value="0") - process_new.inc.php reads its
                // value to know which numbered group to collect, so it must be kept in
                // sync with the new section number rather than cleared like other fields.
                $element.val(newNum);
            }
            else {
                // Clear standard input fields (text, number, email, etc.)
                $element.val('');
            }

        });
        
        // Update all label 'for' attributes
        $newSection.find('label[for]').each(function() {
            var $label = $(this);
            var oldFor = $label.attr('for');
            var newFor = oldFor.replace(pattern, sectionID + newNum);
            $label.attr('for', newFor);
        });
        
        // Insert the new section above the corresponding "Add" button
        $newSection.hide().insertBefore('#add-' + sectionID + '-block').fadeIn(600);
    
    }

    /**
     * Universal jQuery function to remove the last section
     * Prevents removal if only one section remains
     * @param {string} sectionID - The base name of the section (e.g., 'fermentable', 'hop', 'yeast')
     */
    
    function removeSection(sectionID) {
        // Find all existing sections with this ID prefix
        var $sections = $('section[id^="' + sectionID + '"]');
        
        // Check if there's more than one section (prevent removing the last one)
        if ($sections.length > 1) {
            // Slide up the last section, then remove it after animation completes
            $sections.last().fadeOut(200, function() {
                $(this).remove();
            });
        } else {
            // Optional: alert user that at least one section must remain
            bootstrap.Modal.getOrCreateInstance(document.getElementById('last-element-warning')).show();
            // alert('Cannot remove the last ' + sectionID + ' section. At least one must remain.');
        }
    }

</script>