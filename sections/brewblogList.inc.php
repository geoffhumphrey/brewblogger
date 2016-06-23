<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": 'rftip',
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
        <th>Method</th>
        <th class="hidden-xs hidden-sm">SRM</th>
        <th class="hidden-xs hidden-sm">IBU</th>
        <th class="hidden-xs hidden-sm">ABV</th>
        <th class="hidden-xs hidden-sm">Awards</th>
    </tr>
</thead>
<tbody>
	<?php do { 
		if ($row_log['brewArchive'] != "Y") { 
		// Get brew style information for all listed styles
		/*
		$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_log['brewStyle']);
		$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
		$row_styles = mysql_fetch_assoc($styles);
		$totalRows_styles = mysql_num_rows($styles);
		
		
		// Get real user names
		mysql_select_db($database_brewing, $brewing);
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_log['brewBrewerID']);
		$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
		$row_user2 = mysql_fetch_assoc($user2);
		$totalRows_user2 = mysql_num_rows($user2);
		*/
		
		// Awards
		$awardNewID = "b".$row_log['id'];
		$query_awards2 = sprintf("SELECT COUNT(*) as 'count' FROM awards WHERE awardBrewID='%s'", $awardNewID);
		$awards2 = mysql_query($query_awards2, $brewing) or die(mysql_error());
		$row_awards2 = mysql_fetch_assoc($awards2);
	?>
    <tr>
        <td><a href="index.php?page=<?php echo $destination; ?>&filter=<?php echo $row_log['brewBrewerID']; ?>&id=<?php echo $row_log['id']; ?>"><?php echo $row_log['brewName']; ?></a></td>
        <td nowrap><?php $date = $row_log['brewDate']; $realdate = dateconvert($date,3); echo $realdate; ?></td>
        <td><?php echo $row_log['brewBatchNum']; ?></td>
        <td><?php echo $row_log['brewStyle']; ?></td>
        <td><?php if ($row_log['brewMethod'] != "") echo $row_log['brewMethod']; else echo "&nbsp;" ?></td>
        <td class="hidden-xs hidden-sm"><?php if ($row_log['brewLovibond'] != "") include (INCLUDES.'color_display.inc.php'); else echo "&nbsp;"; ?></td>
        <td class="hidden-xs hidden-sm"><?php if ($row_log['brewBitterness'] != "") { echo round ($row_log['brewBitterness'], 1); } else echo "&nbsp;" ?></td>
        <td class="hidden-xs hidden-sm"><?php if (($row_log['brewOG'] != "") && ($row_log['brewFG'] != "")) { echo number_format(calc_abv($row_log['brewOG'], $row_log['brewFG']), 1)."%"; } else echo "&nbsp;"; ?></td>
        <td class="hidden-xs hidden-sm"><?php if ($row_awards2['count'] > 0) echo $row_awards2['count']; ?></td>
    </tr>
    <?php }   // end if ($row_log['brewArchive'] != "Y")
	} while ($row_log = mysql_fetch_assoc($log)); ?>	
</tbody>
</table>



























