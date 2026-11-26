<?php
require ('../paths.php');
require (CONFIG.'config.php');
require (ADMIN_INCLUDES.'constants.inc.php');
require (INCLUDES.'authentication_nav.inc.php');
include (INCLUDES.'db_connect_universal.inc.php');
include (INCLUDES.'url_variables.inc.php');

$page = "taplist";
include (INCLUDES.'db_connect_log_new.inc.php');
include (LIB.'common.lib.php');
include (ADMIN_LIBRARY.'color.lib.php');
$tap = 1;

$icon_color = "#000000";
$icon_background = "";
$location = "";

if ($section != "default") $location = $section;

$theme_dark = (strtolower(trim($theme)) === "dark");

$taplist_display = "";
$taplist_data = array();

// Get all of the records that are classified as "on tap"
$query_log = "SELECT * FROM brewblogs WHERE brewStatus = 'On Tap'";
$log = mysqli_query($connection,$query_log) or die (mysqli_error($connection));
$row_log = mysqli_fetch_assoc($log);
$totalRows_log = mysqli_num_rows($log);

// If records found, build the display
if ($totalRows_log > 0) {

  // First loop through the logs to get data
  do {

    $SRM = "";
    $style_name = "";
    $style_info = "";
    $tap_locations = "";
    $abv = "";
    $ibu = "";

    $awards_display = "";

    if ((isset($row_log['brewStyle'])) && (!empty($row_log['brewStyle']))) {
      $style = json_decode($row_log['brewStyle'],true);
      if ((isset($style['NAME'])) && (!empty($style['NAME']))) $style_name = $style['NAME'];
    }
    
    if ((isset($row_log['brewTapLocation'])) && (!empty($row_log['brewTapLocation']))) $tap_locations = json_decode($row_log['brewTapLocation'],true);
    // print_r($tap_locations);
    //echo "<br><br>";

    // Build one entry per tap location so a beer tapped in multiple places gets
    // a separate taplist entry for each (matching the $location filter feature
    // below, which shows one location's list at a time). Fall back to a single
    // blank-location entry so "On Tap" beers with no location data still show.
    $tap_locations_list = array();
    if ((is_array($tap_locations)) && (!empty($tap_locations))) {
      foreach ($tap_locations as $key => $value) {
        $tap_locations_list[] = array(
          "location" => h($key),
          "number" => isset($value['TAP_NUMBER']) ? h($value['TAP_NUMBER']) : "",
          "date" => isset($value['TAP_DATE']) ? $value['TAP_DATE'] : "",
          "flag" => isset($value['FLAG']) ? h($value['FLAG']) : "",
        );
      }
    } else {
      $tap_locations_list[] = array("location" => "", "number" => "", "date" => "", "flag" => "");
    }

    if ((isset($row_log['brewColor'])) && (!empty($row_log['brewColor']))) {
      $SRM .= round($row_log['brewColor'], 1);
    }

    if ((isset($style['STYLE_GUIDE'])) && (!empty($style['STYLE_GUIDE']))) { 
        
        if (strpos($style['STYLE_GUIDE'], "BA") !== false) {
            $style_info .= "Brewers Association";
            if ((isset($style['CATEGORY'])) && (!empty($style['CATEGORY']))) $style_info .= " &ndash; ".h($style['CATEGORY']);
        }

        else {
            $style_info .= h($style['STYLE_GUIDE']);
            if ((isset($style['CATEGORY_NUMBER'])) && (!empty($style['CATEGORY_NUMBER']))) $style_info .= " &ndash; ".h($style['CATEGORY_NUMBER']);
            if ((isset($style['STYLE_LETTER'])) && (!empty($style['STYLE_LETTER']))) $style_info .= h($style['STYLE_LETTER']);
        }

    }

    if (!empty($row_log['brewABV'])) $abv = number_format($row_log['brewABV'],1); 
    else $abv = calc_abv($row_log['brewOG'],$row_log['brewFG']);

    if (!empty($row_log['brewBitterness'])) $ibu = round(ltrim($row_log['brewBitterness'], "0"), 1); 
    elseif (!empty($row_log['brewIBU'])) $ibu = round(ltrim($row_log['brewIBU'], "0"), 1);

    $query_awards = sprintf("SELECT * FROM awards WHERE awardBrewID='%s' ORDER BY awardDate ASC", "b".h($row_log['id']));
    $awards = mysqli_query($connection,$query_awards) or die (mysqli_error($connection));
    $row_awards = mysqli_fetch_assoc($awards);
    $totalRows_awards = mysqli_num_rows($awards);

    // If any awards, build array for modal
    if ($totalRows_awards > 0) {

      $awards_display = array();

      do {
        
        $awards_display[] = array(
          "award-place" => h(display_place($row_awards['awardPlace'],1)),
          "award-place-num" => h($row_awards['awardPlace']),
          "award-competition" => h($row_awards['awardContest']),
          "award-date" => h(getTimeZoneDateTime($timezone, strtotime($row_awards['awardDate']), "1", "1", "short", "date-no-gmt")),
          "award-pro-am-name" => h($row_awards['awardProamName'])
        );

      } while($row_awards = mysqli_fetch_assoc($awards));
        
    }
      
    foreach ($tap_locations_list as $tap_loc) {
      $taplist_data[] = array(
        "record-id" => h($row_log['id']),
        "tap-number" => $tap_loc['number'],
        "tap-location" => $tap_loc['location'],
        "tap-date" => getTimeZoneDateTime($timezone, $tap_loc['date'], "1", "1", "short", "date-no-gmt"),
        "name" => h($row_log['brewName']),
        "style-name" => h($style_name),
        "style-info" => $style_info,
        "brew-date" => h(getTimeZoneDateTime($timezone, $row_log['brewDate'], "1", "1", "short", "date-no-gmt")),
        "abv" => h($abv),
        "ibu" => h($ibu),
        "srm" => h($SRM),
        "awards" => $awards_display,
        "country-flag" => $tap_loc['flag'],
      );
    }



  } while ($row_log = mysqli_fetch_assoc($log));

}

usort($taplist_data, function ($a, $b) {
    return [$a['tap-location'], $a['tap-number']] <=> [$b['tap-location'], $b['tap-number']];
});

$award_modals = "";
$award_modal_ids_built = array(); // a beer tapped in multiple locations shares one record-id; only build its awards modal once

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Load jQuery / http://jquery.com/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Load Ninja Bootstrap (REPLACES and EXTENDS Bootstrap's CSS) / https://bootstrap.ninja/ninjabootstrap/ -->
    <link href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Load Fancybox / http://www.fancyapps.com -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>

    <!-- Load Font Awesome / https://fortawesome.github.io/Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <script type="text/javascript">
        window.FontAwesomeConfig = { autoReplaceSvg: false }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/v4-shims.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <!-- Load Custom Theme CSS - Contains Bootstrap overrides and custom classes -->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/bruxellensis.css" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>css/universal_elements.css" />

    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.3.2/css/flag-icons.min.css" />

    <!-- Load Custom JS -->
    <script src="<?php echo $base_url; ?>js_includes/bb_custom.js"></script>

    <style>
    	body {
    		line-height: 20px;
    	}
    	.text-height-1 {
    	 line-height: 1rem;
    	}

    	.last-updated-readout {
    		color: #6c757d;
    	}

    	/* Dark mode -- only active when ?theme=dark */
    	body.theme-dark {
    		background-color: #111111;
    		color: #dee2e6;
    	}

      body.theme-dark a {
        color: #7dc5ff;
        text-decoration: none;
      }

    	body.theme-dark .text-muted {
    		color: rgba(222, 226, 230, 0.75) !important;
    	}

    	body.theme-dark .card {
    		background-color: #2b3035;
    		border-color: #495057;
    		color: #dee2e6;
    	}

    	body.theme-dark .card-footer {
    		background-color: rgba(255, 255, 255, 0.03);
    		border-top-color: #495057;
    	}

    	body.theme-dark .modal-content {
    		background-color: #2b3035;
    		color: #dee2e6;
    		border-color: #495057;
    	}

    	body.theme-dark .modal-header,
    	body.theme-dark .modal-footer {
    		border-color: #495057;
    	}

    	body.theme-dark .btn-close {
    		filter: invert(1) grayscale(100%) brightness(200%);
    	}
      
    	body.theme-dark .last-updated-readout {
    		color: rgba(222, 226, 230, 0.75);
    	}
    </style>
    <title>Taplist: <?php echo $row_name['brewerLogName']; ?></title>
  </head>
  <body<?php if ($theme_dark) echo ' class="theme-dark"'; ?>>
  	<div class="container-fluid">
    <h1 style="font-weight: 900;" class="text-center mt-3 mb-1"><?php echo $row_name['brewerLogName']; ?></h1>
    <h5 class="text-center mb-3"><?php echo "<span class=\"text-muted\">"; if (!empty($location)) echo ucwords($location); echo " Tap List</span>"; ?></h5>
    
      <div class="row row-cols-2 row-cols-xl-3 justify-content-center g-4 mt-2">
        
              <?php
                
                foreach ($taplist_data as $key => $value) {

                  $award_count = 0;

                  $display = FALSE;

                  if (empty($location)) $display = TRUE;
                  else {
                    if (strtolower($location) == strtolower($value['tap-location'])) $display = TRUE;
                  }

                  if ($display) {

                    $top_offset = "";
                    $bottom_left = ""; 

                    if (!empty($value['srm'])) { 
                        
                      if ($_SESSION['measColor'] == "EBC") $brewLov = ebc_to_srm($value['srm']);
                      else $brewLov = $value['srm'];
                      $fontColor = ($brewLov >= 15) ? "#ffffff" : "#000000";
                      $icon_color = $fontColor;
                      $bkColor   = get_display_color($brewLov);
                    
                    }

                    if (!empty($location)) {
                      
                      $top_offset = "<div style=\"font-variant: small-caps;\"><span class=\"badge fs-4 fw-bolder text-bg-warning\">Tap ".$value['tap-number']."</span></div>"; 
                      
                      if (!empty($value['srm'])) {
                        
                        $bottom_left .= "<span class=\"fa-stack small\">";
                        $bottom_left .= "<i class=\"fa-solid fa-circle fa-stack-2x\" style=\"color: ".$bkColor."\"></i>";
                        $bottom_left .= "<i class=\"fa-solid fa-glass-water fa-stack-1x\" style=\"color: ".$fontColor."\"></i>";
                        $bottom_left .= "</span>";
                      
                      }
                    
                    }

                    else {

                      if (!empty($value['srm'])) {
                        
                        $top_offset .= "<span class=\"fa-stack small\">";
                        $top_offset .= "<i class=\"fa-solid fa-circle fa-stack-2x\" style=\"color: ".$bkColor."\"></i>";
                        $top_offset .= "<i class=\"fa-solid fa-glass-water fa-stack-1x\" style=\"color: ".$fontColor."\"></i>";
                        $top_offset .= "</span>";
                      
                      }

                      $bottom_left .= "<ul class=\"list-unstyled\">";
                      $bottom_left .= "<li>".ucfirst($value['tap-location'])." &ndash; Tap ".$value['tap-number']."</li>";
                      $bottom_left .= "</ul>";
                    
                    }
                    
                    if (!empty($value['awards'])) {

                      $modal_body = "";

                      foreach ($value['awards'] as $k => $v) {
                        
                        $award_count += 1;

                        $modal_body .= "<section class=\"mb-4\">";

                        if (!empty($v['award-competition'])) {
                            $modal_body .= "<div class=\"row mb-1\">";
                            $modal_body .= "<div class=\"col-4\">";
                            $modal_body .= "<strong>Competition</strong>";
                            $modal_body .= "</div>";
                            $modal_body .= "<div class=\"col-8\">";
                            $modal_body .= $v['award-competition'];
                            $modal_body .= "</div>";
                            $modal_body .= "</div>";
                        }

                        if (!empty($v['award-date'])) {
                            $modal_body .= "<div class=\"row mb-1\">";
                            $modal_body .= "<div class=\"col-4\">";
                            $modal_body .= "<strong>Date</strong>";
                            $modal_body .= "</div>";
                            $modal_body .= "<div class=\"col-8\">";
                            $modal_body .= $v['award-date'];
                            $modal_body .= "</div>";
                            $modal_body .= "</div>";
                        }

                        if (!empty($v['award-place'])) {
                            $modal_body .= "<div class=\"row mb-1\">";
                            $modal_body .= "<div class=\"col-4\">";
                            $modal_body .= "<strong>Place</strong>";
                            $modal_body .= "</div>";
                            $modal_body .= "<div class=\"col-8\">";
                            $modal_body .= display_place($v['award-place-num'],2);
                            $modal_body .= "</div>";
                            $modal_body .= "</div>";

                            if (($v['award-place'] == "Pro-Am") || ($v['award-place'] == "Scale-Up")) {
                                $modal_body .= "<div class=\"row mb-1\">";
                                $modal_body .= "<div class=\"col-4\">";
                                $modal_body .= "<strong>Organization</strong>";
                                $modal_body .= "</div>";
                                $modal_body .= "<div class=\"col-8\">";
                                $modal_body .= $v['award-pro-am-name'];
                                $modal_body .= "</div>";
                                $modal_body .= "</div>";
                            }
                            
                        }

                        $modal_body .= "</section>";

                      }

                      if (!in_array($value['record-id'], $award_modal_ids_built)) {

                        $award_modals .= "
                        <div class=\"modal fade\" id=\"awards-".$value['record-id']."\" tabindex=\"-1\" aria-labelledby=\"awards-".$value['record-id']."-label\" aria-hidden=\"true\">
                          <div class=\"modal-dialog\">
                            <div class=\"modal-content\">
                              <div class=\"modal-header\">
                                <h1 class=\"modal-title fs-5\" id=\"awards-".$value['record-id']."-label\">Awards for ".$value['name']."</h1>
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                              </div>
                              <div class=\"modal-body\">".$modal_body."</div>
                              <div class=\"modal-footer\">
                                <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-bs-dismiss=\"modal\">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        ";

                        $award_modal_ids_built[] = $value['record-id'];

                      }

                    }
                    
              ?>
              
                <div class="col" style="min-height: 200px">
                  <div class="card mb-4 shadow-sm flex-fill h-100">
                      <div class="card-header bg-dark text-white align-middle">
                        <h2 class="card-title mt-2" style="font-weight: 900"><?php echo $value['name']; ?></h2>       
                      </div>
                      
                      <div class="card-body">
                        <div class="text-center">
                            <span class="position-absolute top-0 start-50 translate-middle">
                              <?php echo $top_offset; ?>
                            </span>
                        </div>

                        <p class="fs-5 fw-bolder"><?php if (isset($value['style-name'])) echo $value['style-name']; if (!empty($value['style-info'])) echo "<br><span class=\"text-muted fs-6 fw-light\">".$value['style-info']."</span>"; ?></p>

                        <div class="row mt-2">
                          <div class="col col-xs-4 text-start fs-5"><?php echo $bottom_left; ?></div>
                          <div class="col col-xs-4 text-center fs-5"><?php if (!empty($value['abv'])) echo $value['abv']; ?>%</div>
                          <div class="col col-xs-4 text-end fs-5"><?php if (!empty($value['ibu'])) echo round($value['ibu'],0); ?> IBU</div>
                        </div>
                        <!--
                        <div class="row mt-2">
                          <div class="col col-lg-7">
                            <strong>Brewed</strong>
                          </div>
                          <div class="col">
                            <span class="float-right"><?php echo $value['brew-date']; ?></span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-lg-7">
                            <strong>ABV</strong>
                          </div>
                          <div class="col">
                            <span class="float-right"><?php if (!empty($value['abv'])) echo $value['abv']; ?>%</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-lg-7">
                            <strong>IBU</strong>
                          </div>
                          <div class="col">
                            <span class="float-right"><?php if (!empty($value['ibu'])) echo $value['ibu']; ?></span>
                          </div>
                        </div>
                      -->
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col col-xs-8 text-secondary">
                            Brewed <?php echo $value['brew-date']; ?>
                          </div>
                          <div class="col col-xs-4 text-right">
                            <?php if ($award_count > 0) { ?>
                              <a href="#" data-bs-toggle="modal" data-bs-target="#awards-<?php echo $value['record-id']; ?>"><i class="fa-solid fa-award fa-lg me-2 fs-3"></i></a>
                            <?php } ?>
                            <?php if (isset($value['country-flag'])) { ?>
                            <i class="fi fi-<?php echo $value['country-flag']; ?> text-center fs-3"></i>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                
                <?php } 
                
                } // end foreach

                ?>
    	
      </div>
      
      <?php if ($award_count > 0) { ?>
      <p class="mt-5 text-center d-none d-lg-none d-xl-none d-xxl-none">Select the <i class="fa-solid fa-award fa-lg text-primary"></i> icon to see the beverage's awards list.</p>
    <?php } ?>

	</div>

  <div class="last-updated-readout d-none d-lg-block d-xl-block d-xxl-block" style="position: fixed; bottom: 8px; right: 12px; font-size: 0.8rem; z-index: 1050;">
    Last updated: <?php echo date('Y/m/d H:i'); ?>
  </div>

  <?php if (!empty($award_modals)) echo $award_modals; ?>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <!-- Auto-refresh the taplist every 15 minutes, deferring if an awards modal is open -->
    <script>

      var autorefresh = "<?php echo $autorefresh; ?>";

        (function () {
            const REFRESH_INTERVAL = 15 * 60 * 1000;
            const RETRY_DELAY = 30 * 1000;

            function attemptReload() {
                if (document.querySelector('.modal.show')) {
                    setTimeout(attemptReload, RETRY_DELAY);
                } else {
                    location.reload();
                }
            }

            if (autorefresh == "true") {
              setTimeout(attemptReload, REFRESH_INTERVAL);
            }

          })();

    </script>
  </body>
</html>