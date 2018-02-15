<?php
$thead = "";
$tbody = "";
$show_awards = FALSE;

if ($totalRows_awardsList > 0) $show_awards = TRUE;

if ($show_awards) {

    $thead .= "<tr>";
    $thead .= "<th><span class=\"hidden-xs hidden-sm\">Entered </span>Name</th>";
    $thead .= "<th class=\"hidden-xs hidden-sm\">Style</th>";
    $thead .= "<th>Competition</th>";
    $thead .= "<th>Date</th>";
    $thead .= "<th>Place</th>";
    if (($row_pref['mode'] == "2") && ($filter == "all")) $thead .= "<th>Brewer</th>";
    $thead .= "</tr>";

    do {

        // Move the following to a function
        if ($row_pref['mode'] == "2") {
            $query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_awardsList['brewBrewerID']);
            $user2 = mysqli_query($connection,$query_user2) or die (mysqli_error($connection));
            $row_user2 = mysqli_fetch_assoc($user2);
            $totalRows_user2 = mysqli_num_rows($user2);
        }

        $dbGo = rtrim($row_awardsList['awardBrewID'], "0123456789");

        if ($dbGo == "r") $destination = "recipe";
        else $destination = "brewblog";
        $brewID = ltrim ($row_awardsList['awardBrewID'], "rb");

        $query_brewblog = sprintf("SELECT brewName,brewDate FROM brewing WHERE id = '%s'", $brewID);
        $brewblog = mysqli_query($connection,$query_brewblog);
        $row_brewblog = mysqli_fetch_assoc($brewblog);
        $totalRows_brewblog = mysqli_num_rows($brewblog);

        $real_brewblog_name = FALSE;

        if ($row_awardsList['awardBrewName'] != $row_brewblog['brewName']) $real_brewblog_name = TRUE;

        if (SEF) $award_link = build_public_url($destination, urlencode(strtolower(strtr($row_awardsList['awardBrewName'],$prettify_url))), urlencode(strtolower(strtr($row_awardsList['awardStyle'],$prettify_url))), "detail", strtolower($row_awardsList['brewBrewerID']), $brewID, $base_url);
        else $award_link = build_public_url($destination, "default", "default", "default", $row_awardsList['brewBrewerID'], $brewID, $base_url);

        $tbody .= "<tr>";
        $tbody .= "<td><a href=\"".$award_link."\">".$row_awardsList['awardBrewName']."</a>";
        if ($real_brewblog_name) $tbody .= " <a href=\"".$award_link."\" role=\"button\" data-toggle=\"popover\" data-placement=\"auto right\" data-animation=\"true\" data-trigger=\"hover\" data-content=\"BrewBlog name is ".$row_brewblog['brewName']."\"><small><span class=\"fa fa-asterisk\"></span><small></a>";
        $tbody .= "</td>";
        $tbody .= "<td class=\"hidden-xs hidden-sm\">".$row_awardsList['awardStyle']."</td>";
        $tbody .= "<td>";
        if (!empty($row_awardsList['awardContestURL'])) $tbody .= "<a href=\"".$row_awardsList['awardContestURL']."\" target=\"_blank\">".$row_awardsList['awardContest']."</a>";
        else $tbody .= $row_awardsList['awardContest'];
        $tbody .= "</td>";
        $tbody .= "<td>".dateconvert($row_awardsList['awardDate'],3)."</td>";
        $tbody .= "<td>".display_place($row_awardsList['awardPlace'],3)."</td>";
        if (($row_pref['mode'] == "2") && ($filter == "all")) $tbody .= "<td>".$row_user2['realLastName'].", ".$row_user2['realFirstName']."</td>";
        $tbody .= "</tr>";

    } while ($row_awardsList = mysqli_fetch_assoc($awardsList));

?>
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
	<?php echo $thead; ?>
</thead>
<tbody>
    <?php echo $tbody; ?>
</tbody>
</table>
<?php } else echo "<p>No awards have been entered."; ?>


















