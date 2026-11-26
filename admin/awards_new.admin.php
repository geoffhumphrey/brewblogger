<?php

// For editing, use the the $sid (secondary id) url variable for looking up the 
// record in the awards DB table.

$award_entry_name = "";
$award_competition_name = "";
$award_competition_url = "";
$award_competition_date = "";
$award_place = "";
$award_proam_name = "";
$award_proam_url = "";
$styles_dropdown = "";
$style_set_lookup = "";
$style_in_record = "";
$style_count = 0;



// Gather the brewblog's info
if ($id !="default") {
    
    include(SECTIONS.'recipe_json_decode.inc.php');
    $award_entry_name = $row_log['brewName'];
    
    if ($action == "add") {
        if (isset($_COOKIE['awardContest'])) $award_competition_name = $_COOKIE['awardContest'];
        if (isset($_COOKIE['awardContestURL'])) $award_competition_url = $_COOKIE['awardContestURL'];
        if (isset($_COOKIE['awardDate'])) $award_competition_date = $_COOKIE['awardDate'];
    }

    if ($action == "edit") {
        $award_entry_name = $row_awards['awardBrewName'];
        $award_competition_name = $row_awards['awardContest'];
        $award_competition_url = $row_awards['awardContestURL'];
        $award_competition_date = $row_awards['awardDate'];
        $award_proam_name = $row_awards['awardProamName'];
        $award_proam_url = $row_awards['awardProamURL'];
        $award_place = $row_awards['awardPlace'];
    }
        
}

if ($action == "edit") $style_set = array_merge($_SESSION['styles2008'],$_SESSION['styles2015'],$_SESSION['styles2021'],$_SESSION['stylesBA']);
else $style_set = array_merge($_SESSION['styles2021'],$_SESSION['stylesBA']); 

if (($id !="default") && (isset($style['STYLE_GUIDE']))) {
    if ((strpos($style['STYLE_GUIDE'], "BA") !== false) || (strpos($style['STYLE_GUIDE'], "Brewers Association") !== false)) {
        $style_set_lookup = "BA";
        $style_in_record .= "BA ".$style['NAME'];
    }
    if (strpos($style['STYLE_GUIDE'], "BJCP") !== false) $style_set_lookup = str_replace("BJCP ","BJCP",$style['STYLE_GUIDE']);
    if (strpos($style_set_lookup, "BJCP") !== false) $style_in_record .= $style['STYLE_GUIDE']." ".$style['CATEGORY_NUMBER'].$style['STYLE_LETTER'].": ".$style['NAME'];
}

// Build the 
foreach ($style_set as $row_styles) {
    
    $style_selected = FALSE;

    if (strpos($row_styles['brewStyleVersion'], "BJCP") !== false) $style_display = str_replace("BJCP","BJCP ",$row_styles['brewStyleVersion'])." ".$row_styles['brewStyleGroup'].$row_styles['brewStyleNum'].": ".$row_styles['brewStyle'];
    else $style_display = $row_styles['brewStyleVersion']." ".$row_styles['brewStyle'];
    $style_id = $row_styles['id'];

    if ($action == "add") {

        if (($id !="default") && (isset($style['NAME']))) {  
            if ((strpos($row_styles['brewStyle'], $style['NAME']) !== false) && ($style_set_lookup == $row_styles['brewStyleVersion'])) {
                $style_selected = TRUE;
                $style_count++;
            }
        }

    }

    if ($action == "edit") {
        if (strpos($row_styles['brewStyle'], $row_awards['awardStyle']) !== false) {
            $style_selected = TRUE;
            $style_count++;
        }
    }

    $styles_dropdown .= "<option value=\"".h($row_styles['brewStyle'])."\"";
    if ($style_selected) $styles_dropdown .= " selected";
    $styles_dropdown .= ">";
    $styles_dropdown .= $style_display;        
    $styles_dropdown .= "</option>";

} // end foreach

if (($action == "edit") && ($style_count == 0)) {
    $styles_dropdown .= "<option value=\"".h($row_awards['awardStyle'])."\" selected>";
    $styles_dropdown .= $style_in_record;        
    $styles_dropdown .= "</option>";
}

$relocate = "brewblog-admin";
if ($action == "edit") $relocate = "awards-list";

if (isset($referrer)) {

    if ((strpos($referrer, 'page=admin') !== false) && (strpos($referrer, 'action=manage') !== false)) {
        $relocate = "brewblog-admin";
    }

    if ((strpos($referrer, '/admin') !== false) && (strpos($referrer, '/manage') !== false)) {
        $relocate = "brewblog-admin";
    }

    elseif (strpos($referrer, 'page=brewblog-list') !== false) {
        $relocate = "brewblog-list";
    }

    elseif (strpos($referrer, '/brewblog-list') !== false) {
        $relocate = "brewblog-list";
    }

    elseif (strpos($referrer, 'page=awards-list') !== false) {
        $relocate = "awards-list";
    }

    elseif (strpos($referrer, '/awards-list') !== false) {
        $relocate = "awards-list";
    }

    elseif (strpos($referrer, 'page=brewblog') !== false) {
        $relocate = "brewblog";
    }

    elseif (strpos($referrer, '/brewblog') !== false) {
        $relocate = "brewblog";
    }

}

if ($id != "default") {

    $style = "No Style Selected";
    if (isset($row_log['brewStyle'])) {
        $style_json = json_decode($row_log['brewStyle'],true);
        if (isset($style_json['NAME'])) $style = $style_json['NAME'];
    }

    $link_log_name = pathauto_cleanstring($row_log['brewName']);
    $link_style_name = pathauto_cleanstring($style);

    if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($link_log_name,$prettify_url))), urlencode(strtolower(strtr($link_style_name,$prettify_url))), "detail", strtolower($row_log['brewBrewerID']), $row_log['id'], $base_url);
    else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_log['brewBrewerID'], $row_log['id'], $base_url);
}

?>

<div class="container-xxl mt-3" style="min-height: 80vh;">
 
    <h2 class="mb-5"><?php echo ucfirst($action)." Award &ndash; ".$award_entry_name; ?></h2>

    <div class="mb-3" role="group">
        <a class="btn btn-dark btn-sm" href="<?php echo $base_url; if (SEF) echo "brewblog-list"; else echo "index.php?page=brewblog-list"; ?>">BrewBlog List</a>
        <a class="btn btn-dark btn-sm" href="<?php echo $base_url; if (SEF) echo "awards-list"; else echo "index.php?page=awards-list"; ?>">Awards List</a>
        <a class="btn btn-dark btn-sm" href="<?php echo $brewblog_link; ?>">BrewBlog Detail &ndash; <?php echo truncate_string($row_log['brewName'], 30, '...'); ?></a>
    </div>

    <form name="add-edit-award" method="post" data-toggle="validator" role="form" action="<?php echo $base_url; ?>includes/process_new.inc.php?action=<?php echo $action; ?>&dbTable=<?php echo $dbTable; ?>&filter=<?php echo $filter; ?>&id=<?php echo $id; if ($sid != "default") echo "&sid=".$sid; ?>" name="awards-add-edit">

        <input type="hidden" name="relocate" value="<?php echo $relocate; ?>">

        <div class="row mb-3">
            <label for="awardContest" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold">Competition Name</label>
            <div class="col-12 col-sm-9 col-md-10">
                <input class="form-control" name="awardContest" type="text" value="<?php echo h($award_competition_name); ?>" placeholder="" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="awardContestURL" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold">Website URL</label>
            <div class="col-12 col-sm-9 col-md-10">
                <input class="form-control" name="awardContestURL" type="text" value="<?php echo h($award_competition_url); ?>" placeholder="https://sitename.com">
            </div>
        </div>

        <div class="row mb-3">
            <label for="awardContestURL" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold">Competition Date</label>
            <div class="col-12 col-sm-9 col-md-10">
                <input class="form-control date-time-picker-day" name="awardDate" type="text" value="<?php echo h($award_competition_date); ?>" placeholder="" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="awardBrewName" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold">Entry Name</label>
            <div class="col-12 col-sm-9 col-md-10">
                <input class="form-control" name="awardBrewName" type="text" value="<?php echo h($award_entry_name); ?>" placeholder="" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="type" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold">Style</label>
            <div class="col-12 col-sm-9 col-md-10">
                <select class="form-select bootstrap-select-new" name="awardStyle" id="type" required>
                    <option value="">None</option>
                    <?php echo $styles_dropdown; ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="awardPlace" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold">Place</label>
            <div class="col-12 col-sm-9 col-md-10">
                <select class="form-select" name="awardPlace" id="awardPlace" required>
                    <option></option>
                    <option value="1" <?php if ($award_place =="1") echo "selected"; ?>>1st</option>
                    <option value="2" <?php if ($award_place =="2") echo "selected"; ?>>2nd</option>
                    <option value="3" <?php if ($award_place =="3") echo "selected"; ?>>3rd</option>
                    <option value="4" <?php if ($award_place =="4") echo "selected"; ?>>4th</option>
                    <option value="honMen" <?php if ($award_place =="honMen") echo "selected"; ?>>Honorable Mention</option>
                    <option value="best" <?php if ($award_place =="best") echo "selected"; ?>>Best of Show</option>
                    <option value="best1" <?php if ($award_place =="best1") echo "selected"; ?>>Best of Show - 2nd</option>
                    <option value="best2" <?php if ($award_place =="best2") echo "selected"; ?>>Best of Show - 3rd</option>
                    <option value="best3" <?php if ($award_place =="best3") echo "selected"; ?>>Best of Show - 4th/HM</option>
                    <option value="pro-am" <?php if ($award_place =="pro-am") echo "selected"; ?>>Pro-Am</option>
                    <option value="scale-up" <?php if ($award_place =="scale-up") echo "selected"; ?>>Scale-Up</option>
                </select>
            </div>
        </div>

        <section id="pro-am-scale-up">
        <div class="row mb-3">
            <label for="awardProAmName" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold"><span id="pro-am-scale-up-org"></span></label>
            <div class="col-12 col-sm-9 col-md-10">
                <input class="form-control" name="awardProAmName" type="text" value="<?php echo h($award_proam_name); ?>" placeholder="">
            </div>
        </div>
        <div class="row mb-3">
            <label for="awardProAmURL" class="col-12 col-sm-3 col-md-2 col-form-label fw-bold"><span id="pro-am-scale-up-url"></span></label>
            <div class="col-12 col-sm-9 col-md-10">
                <input class="form-control" name="awardProAmURL" type="text" value="<?php echo h($award_proam_url); ?>" placeholder="https://sitename.com">
            </div>
        </div>
        </section>

        <?php if ($action == "add") { ?>
        <div class="row mb-3">
            <label class="col-12 col-sm-3 col-md-2 col-form-label fw-bold"></label>
            <div class="col-12 col-sm-9 col-md-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="add-another-award" name="add-another-award-<?php echo $id;?>" value="1">
                    <label class="form-check-label" for="add-another-award">Add another award for this brew?</label>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-12 col-sm-3 col-md-2 col-form-label fw-bold"></label>
            <div class="col-12 col-sm-9 col-md-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="save-comp-info" name="save-comp-info" value="1">
                    <label class="form-check-label" for="save-comp-info">Save competition info for more awards?</label>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="row mb-3">
            <div class="offset-sm-3 offset-md-2 col-sm-5 d-grid">
                <input id="add-edit-award-btn" name="submit" type="submit" class="btn btn-primary" value="<?php echo ucfirst($action); ?> Award">
            </div>
        </div>


    </form>


</div>

<!-- Load Moment -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>

<!-- Load Bootstrap DateTime Picker / http://eonasdan.github.io/bootstrap-datetimepicker/ -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>
    var action = "<?php echo $action; ?>";
    var place = "<?php echo $award_place; ?>";

    $("#pro-am-scale-up").hide();

    if ((action == "edit") && ((place == "pro-am") || (place == "scale-up"))) {
        
        $("#pro-am-scale-up").show();
        
        if (place == "pro-am") {
            $("#pro-am-scale-up-org").html("Pro-Am Organization Name");
            $("#pro-am-scale-up-url").html("Pro-Am Organization Website URL");
        }

        if (place == "scale-up") {
            $("#pro-am-scale-up-org").html("Scale-Up Organization Name");
            $("#pro-am-scale-up-url").html("Scale-Up Organization Website URL");
        }
    
    }

    $("#awardPlace").change(function () {

        if (($("#awardPlace").val() == "pro-am") || ($("#awardPlace").val() == "scale-up")) {
            $("#pro-am-scale-up").show("fast");
            $("input[name='awardPlace']").prop("required", true);
            if ($("#awardPlace").val() == "pro-am") {
                $("#pro-am-scale-up-org").html("Pro-Am Organization Name");
                $("#pro-am-scale-up-url").html("Pro-Am Organization Website URL");
            }
            if ($("#awardPlace").val() == "scale-up") {
                $("#pro-am-scale-up-org").html("Scale-Up Organization Name");
                $("#pro-am-scale-up-url").html("Scale-Up Organization Website URL");
            }
        } else {
            $("#pro-am-scale-up").hide("fast");
            $("input[name='awardPlace']").prop("required", false);
        }

    });
    
    $(function(){
        $('.date-time-picker-day-time').datetimepicker({format: 'YYYY-MM-DD hh:mm A'});
        $('.date-time-picker-day').datetimepicker({format: 'YYYY-MM-DD'});
    });

</script>