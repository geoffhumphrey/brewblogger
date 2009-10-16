<?php if ($page != "recipePrint") { ?>
<?php if ($row_log['brewComments'] != "" ) { ?>
<div id="headerContent">Comments</div>
<div id="dataContainer">
<table class="dataTable">
	<tr>
		<td valign="top"><?php echo $row_log['brewComments']; ?></td>
	</tr>
</table>
</div>
<?php } ?>
<?php } ?>
