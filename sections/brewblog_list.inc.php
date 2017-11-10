<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": 'rfptip',
		"order": [[ 1, 'desc' ], [ 0, 'asc' ]],
		"pageLength": 50
    } );
});
</script>

<table class="table table-striped" id="sortable">
<thead>
	<tr>
        <th width="20%">BrewBlog</th>
        <th>Date</th>
        <th class="hidden-xs hidden-sm">Batch #</th>
        <th>Style</th>
        <th class="hidden-xs hidden-sm">Method</th>
        <th class="hidden-xs"><?php echo $row_pref['measColor']; ?></th>
        <th class="hidden-xs">IBU</th>
        <th class="hidden-xs">ABV</th>
		<th class="hidden-xs"><span class="hidden-md hidden-lg fa fa-trophy"></span><span class="hidden-xs hidden-sm">Awards</span></th>
    </tr>
</thead>
<tbody>
	<?php do {
		if ($row_log['brewArchive'] != "Y") {

        if (SEF) $brewblog_link = build_public_url($destination, urlencode(strtolower(strtr($row_log['brewName'],$prettify_url))), urlencode(strtolower(strtr($row_log['brewStyle'],$prettify_url))), "detail", strtolower($row_log['brewBrewerID']), $row_log['id'], $base_url);
        else $brewblog_link = build_public_url($destination, "default", "default", "default", $row_log['brewBrewerID'], $row_log['id'], $base_url);
		// Get brew style information for all listed styles
		/*
		$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_log['brewStyle']);
		$styles = mysqli_query($connection,$query_styles) or die (mysqli_error($connection));
		$row_styles = mysqli_fetch_assoc($styles);
		$totalRows_styles = mysqli_num_rows($styles);


		// Get real user names

		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
		$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
		$row_user2 = mysqli_fetch_assoc($user2);
		$totalRows_user2 = mysqli_num_rows($user2);
		*/

		// Awards
		$awardNewID = "b".$row_log['id'];
		$query_awards2 = sprintf("SELECT COUNT(*) as 'count' FROM awards WHERE awardBrewID='%s'", $awardNewID);
		$awards2 = mysqli_query($connection,$query_awards2) or die (mysqli_error($connection));
		$row_awards2 = mysqli_fetch_assoc($awards2);

		$ABV = "";
		if (($row_log['brewOG'] != "") && ($row_log['brewFG'] != "")) $ABV = number_format(calc_abv($row_log['brewOG'], $row_log['brewFG']), 1);

		$bitterness = "";
		if ($row_log['brewBitterness'] != "") $bitterness = number_format($row_log['brewBitterness'], 1);

		$SRM = "";
		if (!empty($row_log['brewLovibond'])) {
			if ($page == "logPrint" || $page == "recipePrint") $SRM .= round($row_log['brewLovibond'], 1);
			else {
				$brewLov   = $row_log['brewLovibond'];
				if ($row_pref['measColor'] == "EBC") $brewLov = ebc_to_srm($brewLov);
				$fontColor = ($brewLov >= 14) ? "#ffffff" : "#000000";
				$bkColor   = get_display_color($brewLov);
				$srm_formatted = number_format($row_log['brewLovibond'], 1);
				$SRM .= "<span class=\"hidden\">".sprintf("%06s",$srm_formatted)."</span>\n";
				$SRM .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bkColor ."; color: ".$fontColor.";\">".$srm_formatted."</span>\n";
				//$SRM .= " <span class=\"badge\" style=\"background: ". $bkColor ."; color: ".$fontColor.";\">&nbsp;&nbsp;&nbsp;</span>\n";
				//$SRM .= $srm_formatted;

			}
		}
	?>
    <tr>
        <td><a href="<?php echo $brewblog_link; ?>"><?php echo $row_log['brewName']; ?></a></td>
        <td nowrap><?php echo dateconvert($row_log['brewDate'],3); ?></td>
        <td class="hidden-xs hidden-sm"><?php echo $row_log['brewBatchNum']; ?></td>
        <td><?php echo $row_log['brewStyle']; ?></td>
        <td class="hidden-xs hidden-sm"><?php if ($row_log['brewMethod'] != "") echo $row_log['brewMethod']; else echo "&nbsp;" ?></td>
        <td class="hidden-xs"><?php echo $SRM; ?></td>
        <td class="hidden-xs"><?php echo $bitterness; ?></td>
        <td class="hidden-xs"><?php echo $ABV; ?></td>
        <td class="hidden-xs"><?php if ($row_awards2['count'] > 0) echo $row_awards2['count']; ?></td>
    </tr>
    <?php }   // end if ($row_log['brewArchive'] != "Y")
	} while ($row_log = mysqli_fetch_assoc($log)); ?>
</tbody>
</table>