<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": 'rfptip',
		"order": [[ 2, 'asc' ], [ 1, 'asc' ]],
		"pageLength": 50
    } );
});
</script>
<table class="table table-striped" id="sortable">
<thead>
	<tr>
    	<th class="hidden-xs hidden-sm">BeerXML</th>
		<th><span class="hidden-xs hidden-sm">Recipe </span>Name</th>
        <th>Style</th>
        <th class="hidden-xs hidden-sm">Method</th>
        <th class="hidden-xs"><?php echo $row_pref['measColor']; ?></th>
        <th class="hidden-xs">IBU</th>
        <th class="hidden-xs">ABV</th>
        <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><th>Brewer</th><?php } ?>
    </tr>
</thead>
<tbody>
	<?php do { ?>
    <?php 
	// Get real user names
	if ($row_pref['mode'] == "2") {
		
		/*
		// Get real user names
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_recipeList['brewBrewerID']);
		$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
		$row_user2 = mysqli_fetch_assoc($user2);
		$totalRows_user2 = mysqli_num_rows($user2);
		
		// Awards
		$awardNewID = "r".$row_recipeList['id'];
		$query_awards2 = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
		$awards2 = mysqli_query($connection,$query_awards2) or die (mysqli_error($connection));
		$row_awards2 = mysqli_fetch_assoc($awards2);
		$totalRows_awards2 = mysqli_num_rows($awards2);
		
		
		*/
		
		
	}
	
	$ABV = "";
	if (($row_recipeList['brewOG'] != "") && ($row_recipeList['brewFG'] != "")) $ABV = number_format(calc_abv($row_recipeList['brewOG'], $row_recipeList['brewFG']), 1);

	$bitterness = "";
	if ($row_recipeList['brewBitterness'] != "") $bitterness = number_format($row_recipeList['brewBitterness'], 1);
	
	$SRM = "";
	if (!empty($row_recipeList['brewLovibond'])) {
		if ($page == "logPrint" || $page == "recipePrint") $SRM .= round($row_recipeList['brewLovibond'], 1);
		else {
			$brewLov   = $row_recipeList['brewLovibond'];
			if ($row_pref['measColor'] == "EBC") $brewLov = ebc_to_srm($brewLov);
			$fontColor = ($brewLov >= 14) ? "#ffffff" : "#000000";
			$bkColor   = get_display_color($brewLov);
			$srm_formatted = number_format($row_recipeList['brewLovibond'], 1);
			$SRM .= "<span class=\"hidden\">".sprintf("%06s",$srm_formatted)."</span>\n";
			$SRM .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bkColor ."; color: ".$fontColor.";\">".$srm_formatted."</span>\n";
			//$SRM .= " <span class=\"badge\" style=\"background: ". $bkColor ."; color: ".$fontColor.";\">&nbsp;&nbsp;&nbsp;</span>\n";
			//$SRM .= $srm_formatted;

		}
	}
	
	?>
	<tr>
    	<td class="hidden-xs hidden-sm"><a href="<?php echo $base_url; ?>includes/output_beer_xml.inc.php?id=<?php echo $row_recipeList['id']; ?>&source=<?php echo $source; ?>&brewStyle=<?php echo $row_recipeList['brewStyle']; ?>"><span class="fa fa-file-code-o"></span></a></td>
    	<td><a href="index.php?page=<?php echo $destination; ?>&filter=<?php echo $row_recipeList['brewBrewerID']; ?>&id=<?php echo $row_recipeList['id']; ?>"><?php echo $row_recipeList['brewName']; ?></a></td>
        <td><?php echo $row_recipeList['brewStyle']; ?></td>
        <td class="hidden-xs hidden-sm"><?php if ($row_recipeList['brewMethod'] != "") echo $row_recipeList['brewMethod']; else echo "&nbsp;" ?></td>
        <td class="hidden-xs"><?php echo $SRM; ?></td>
        <td class="hidden-xs"><?php echo $bitterness; ?></td>
        <td class="hidden-xs"><?php echo $ABV; ?></td>
        <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td><a href="<?php echo $base_url; ?>index.php?page=<?php echo $page; ?>&amp;filter=<?php echo $row_user2['user_name']; ?>"><?php echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></a></td><?php } ?>
    </tr>
   	<?php } while ($row_recipeList = mysqli_fetch_assoc($recipeList)); ?>
</tbody>
</table>