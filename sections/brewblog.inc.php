<?php
include (SECTIONS.'label.inc.php');

include (SECTIONS.'recipe_json_decode.inc.php');

if (($page == "current") || ($page == "brewblog")) $blog_type = "BrewBlog"; 
else $blog_type = "Recipe";

$icon_color = "#000000";
$icon_background = "";

$SRM = "";
if (!empty($row_log['brewColor'])) {

	if ($page == "logPrint" || $page == "recipePrint") $SRM .= round($row_log['brewColor'], 1);
	
    else {
		$brewLov   = $row_log['brewColor'];
		if ($_SESSION['measColor'] == "EBC") $brewLov = ebc_to_srm($brewLov);
		$fontColor = ($brewLov >= 15) ? "#ffffff" : "#000000";
		$icon_color = $fontColor;
		$bkColor   = get_display_color($brewLov);
        $SRM .= round($row_log['brewColor'], 1);
        $SRM .= "<span class=\"badge\" style=\"background: ".$bkColor."; color: ".$fontColor."; font-weight: normal; font-style: italic; margin-left: 6px; padding: 5px 8px 5px 5px;\">".$_SESSION['measColor']."</span>\n";	
	}

}

$brewStyle = "";
if ((isset($style['STYLE_GUIDE'])) && (!empty($style['STYLE_GUIDE']))) {
    
    $brewStyle .= $style['STYLE_GUIDE'];
    
    if (strpos($style['STYLE_GUIDE'], "Brewers Association") !== false) {
        if ((isset($style['CATEGORY'])) && (!empty($style['CATEGORY']))) $brewStyle .= " &ndash; ".h($style['CATEGORY']);
    }

    else {
        if ((isset($style['CATEGORY_NUMBER'])) && (!empty($style['CATEGORY_NUMBER']))) $brewStyle .= " &ndash; ".h($style['CATEGORY_NUMBER']);
        if ((isset($style['STYLE_LETTER'])) && (!empty($style['STYLE_LETTER']))) $brewStyle .= $style['STYLE_LETTER'];
    }

}

?>

<div class="container-fluid bg-black mt-0 mb-5">
  <div class="container-xxl pt-3 pb-4">
      	<h2 class="text-white-50 pb-3"><?php if (isset($style['NAME'])) echo h($style['NAME']); ?>
      	<?php if (!empty($brewStyle)) echo "<small class=\"d-none d-md-inline\"><span class=\"badge bg-dark bg-text-dark ms-3\"><span class=\"fw-medium\">".$brewStyle."</span></span></small>"; ?>
      	</h2>
  </div>
</div>

<div class="container-xxl mt-3">

	<div class="row row-cols-2 row-cols-md-6 g-2 justify-content-center pb-4" style="margin: -65px 0 0 0;">

		<?php if (!empty($row_log['brewOG'])) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x text-orange"></i>
	                          <i class="fa-solid fa-vial fa-stack-1x text-dark"></i>
	                        </span>
	                    </span>
	                </div>
	                <div class="text-center text-secondary lh-1">OG</div>
	                <div class="text-center"><strong class="fs-5"><?php echo number_format($row_log['brewOG'], 3); ?></strong></div>
	            </div>
	        </div>
	    </div>
		<?php } ?>

		<?php if (!empty($row_log['brewFG'])) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x text-indigo"></i>
	                          <i class="fa-solid fa-vial fa-stack-1x text-white"></i>
	                        </span>
	                    </span>
	                </div>
	                <div class="text-center text-secondary lh-1">FG</div>
	                <div class="text-center"><strong class="fs-5"><?php echo number_format($row_log['brewFG'], 3); ?></strong></div>
	            </div>
	        </div>
	    </div>
		<?php } ?>

		<?php if (!empty($SRM)) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x" style="color: <?php echo $bkColor; ?>"></i>
	                          <i class="fa-solid fa-glass-water fa-stack-1x" style="color: <?php echo $fontColor; ?>"></i>
	                        </span>
	                    </span>
	                </div>
	                <div class="text-center text-secondary lh-1"><?php echo $_SESSION['measColor']; ?></div>
	                <div class="text-center"><strong class="fs-5"><?php echo $brewLov; ?></strong></div>
	            </div>
	        </div>
	    </div>
		<?php } ?>

		<?php if ((!empty($row_log['brewOG'])) && (!empty($row_log['brewFG']))) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x text-teal"></i>
	                          <i class="fa-solid fa-percent fa-stack-1x text-light"></i>
	                        </span>
	                    </span>
	                </div>
	                <div class="text-center text-secondary lh-1">ABV</div>
	                <div class="text-center"><strong class="fs-5"><?php if (!empty($row_log['brewABV'])) echo number_format($row_log['brewABV'],1); else echo calc_abv($row_log['brewOG'],$row_log['brewFG']); ?>%</strong></div>
	            </div>
	        </div>
	    </div>
	    <?php } ?>

	    <?php if (!empty($row_log['brewBitterness'])) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x text-forest-green"></i>
	                          <i class="fa-solid fa-calculator fa-stack-1x text-white"></i>
	                        </span>
	                    </span>
	                </div>
	                <div class="text-center text-secondary lh-1">IBU</div>
	                <div class="text-center"><strong class="fs-5"><?php echo round(ltrim($row_log['brewBitterness'], "0"), 1); ?></strong></div>
	            </div>
	        </div>
	    </div>
	    <?php } elseif (!empty($row_log['brewIBU'])) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x text-forest-green"></i>
	                          <i class="fa-solid fa-calculator fa-stack-1x text-light"></i>
	                        </span>
	                    </span>
	                </div>
	                <div class="text-center text-secondary lh-1">IBU</div>
	                <div class="text-center"><strong class="fs-5"><?php echo round(ltrim($row_log['brewIBU'], "0"), 1); ?></strong></div>
	            </div>
	        </div>
	    </div>
	    <?php } ?>

	    <?php if ($totalRows_awards > 0) { ?>
	    <div class="col">
	        <div class="card h-100 text-bg-dark">
	            <div class="card-body">
	                <div class="mb-2 text-center">
	                	<a data-bs-toggle="offcanvas" href="#awards-brewblogs" role="button" aria-controls="awards-brewblogs" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="View the Latest BrewBlogs List">
	                    <span class="position-absolute top-0 start-50 translate-middle">
	                        <span class="fa-stack">
	                          <i class="fa-solid fa-circle fa-stack-2x text-primary"></i>
	                          <i class="fa-solid fa-award fa-stack-1x text-white"></i>
	                        </span>
	                    </span>
	                	</a>
	                </div>
	                <div class="text-center text-secondary lh-1">Awards</div>
	                <div class="text-center"><strong class="fs-5"><?php echo $totalRows_awards; ?></strong></div>
	            </div>
	        </div>
	    </div>
	    <?php } ?>
	
	</div>
		
		<?php
			
			include (SECTIONS.'recipe_specifics_new.inc.php');
			include (SECTIONS.'recipe_fermentables_new.inc.php');
			include (SECTIONS.'recipe_hops_new.inc.php');
			include (SECTIONS.'recipe_non-fermentables_new.inc.php');
			include (SECTIONS.'recipe_yeast_new.inc.php');
			include (SECTIONS.'recipe_equipment_new.inc.php');
			include (SECTIONS.'recipe_mash_new.inc.php');
			include (SECTIONS.'recipe_fermentation_new.inc.php');
			include (SECTIONS.'recipe_water_new.inc.php');
			include (SECTIONS.'recipe_general.inc.php');
			include (SECTIONS.'recipe_notes.inc.php');
			// include (SECTIONS.'recipe_comments.inc.php');
			include (SECTIONS.'recipe_procedure.inc.php');
			include (SECTIONS.'recipe_special_procedure.inc.php');
			// include (SECTIONS.'brew_day_data_new.inc.php');
		?>

</div>


<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="more-brewblogs" aria-labelledby="more-brewblogs-label" data-bs-theme="dark">
  	<div class="offcanvas-header">
    	<h5 class="offcanvas-title" id="more-brewblogs-label">Latest BrewBlogs</h5>
    	<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  	</div>
  	<div class="offcanvas-body">
    	<?php
    		include (SECTIONS.'list_new.inc.php');
    		//include (SECTIONS.'scale_recipe_new.inc.php');
    	?>
	</div>
</div>

<?php if ($totalRows_awards > 0) include (SECTIONS.'awards_new.inc.php'); ?>