<?php if ($page == "brewblog") { ?>
<div class="panel panel-default hidden-print">
  <div class="panel-heading">
    <h4 class="panel-title">More...</h4>
  </div>
  <div class="panel-body">
  	<?php do {

	if ($row_list['brewArchive'] != "Y") {

		$brew_name = "";
		$brew_link = "";
		$link_page = "";
		$brew_full_name = "";

		if ($row_list['id'] != $row_log['id']) {

			//$brew_link .= $base_url."index.php?page=".$page."&amp;filter=".$row_list['brewBrewerID']."&amp;id=".$row_list['id'];
            if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($row_list['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_list['brewStyle'],$prettify_url))), "detail", strtolower($row_list['brewBrewerID']), $row_list['id'], $base_url);
            else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_list['brewBrewerID'], $row_list['id'], $base_url);
			$brew_name .= "<a href=\"".$brewblog_link."\" data-toggle=\"tooltip\" data-placement=\"auto left\" title=\"".$row_list['brewStyle']."\">";
			$brew_full_name .= $brew_name;
			$brew_name .= truncate_string($row_list['brewName'],23,'...');
			$brew_full_name .= $row_list['brewName']."</a>";
			$brew_name .= "</a>";

		}

		else {
			$brew_full_name = $row_list['brewName'];
			$brew_name = truncate_string($row_list['brewName'],23,'...');
		}

		$date = dateconvert($row_list['brewDate'],3);

	?>
  	<div class="small">
        <div class="row">
            <div class="col col-lg-7 col-md-12 col-sm-8 col-xs-8">
				<span class="hidden-lg"><?php echo $brew_full_name; ?></span><span class="hidden-xs hidden-sm hidden-md"><?php echo $brew_name; ?></span>
            </div>
            <div class="col col-lg-5 col-md-12 col-sm-4 col-xs-4 text-right hidden-md">
                <?php echo $date; ?>
            </div>
        </div>
    </div>
    <?php }
	} while ($row_list = mysqli_fetch_assoc($list)); ?>
  </div>
</div>
<?php } ?>






































