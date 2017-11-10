<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": 'rfptip',
		"order": [[ 3, 'desc' ], [ 0, 'asc' ], [ 1, 'asc' ]],
		"pageLength": 50
    } );
});
</script>
<table class="table table-striped" id="sortable">
<thead>
	<tr>
		<th><span class="hidden-xs hidden-sm">Entered </span>Name</th>
        <th class="hidden-xs hidden-sm">Style</th>
        <th>Competition</th>
        <th class="hidden-xs hidden-sm">Date</th>
        <th>Place</th>
        <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><th>Brewer</th><?php } ?>
    </tr>
</thead>
<tbody>	
	<?php do { ?>
    <?php 
	
	if ($row_pref['mode'] == "2") {
		
		$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_awardsList['brewBrewerID']);
		$user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
		$row_user2 = mysqli_fetch_assoc($user2);
		$totalRows_user2 = mysqli_num_rows($user2);
		
	}	
	
	?>
	<tr>
    	<td><?php if (isset($_SESSION["loginUsername"])) { if (($row_user['userLevel'] == "1") || ($row_recipeList['brewBrewerID'] == $loginUsername)) echo "<a href=\"admin/index.php?action=edit&dbTable=awards&id=".$row_awardsList['id']."\"><span class\"fa fa-edit\"></span></a>"; else echo "&nbsp;"; } ?> <a href="index.php?page=<?php $dbGo = rtrim($row_awardsList['awardBrewID'], "0123456789"); if ($dbGo == "r") echo "recipe"; else echo "brewblog";  ?>&filter=<?php echo $row_awardsList['brewBrewerID']; ?>&id=<?php $brewID = ltrim ($row_awardsList['awardBrewID'], "rb"); echo $brewID; ?>"><?php echo $row_awardsList['awardBrewName']; ?></a></td>
        <td class="hidden-xs hidden-sm"><?php echo $row_awardsList['awardStyle']; ?></td>
        <td><?php if ($row_awardsList['awardContestURL'] != "") { ?><a href="<?php echo $row_awardsList['awardContestURL']; ?>" target="_blank"><?php } echo $row_awardsList['awardContest']; if ($row_awardsList['awardContestURL'] != "") { ?></a><?php } ?></td>
        <td class="hidden-xs hidden-sm"><?php  $date = $row_awardsList['awardDate']; $realdate = dateconvert($date,3); echo $realdate; ?></td>
        <td><?php echo display_place($row_awardsList['awardPlace'],3); ?></td>
        <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td><a href="?page=awards-list&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $row_user2['user_name']; ?>&view=limited"><?php echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></a></td><?php } ?>
    </tr>
    <?php } while ($row_awardsList = mysqli_fetch_assoc($awardsList)); ?>
</tbody>
</table>


















