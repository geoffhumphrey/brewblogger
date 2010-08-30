<?php if ($page != "recipePrint") { ?>
<?php if ($row_log['brewComments'] != "" ) { ?>
<div class="headerContent">Comments</div>
<div class="dataContainer">
<table class="dataTable">
	<tr>
		<td valign="top"><?php echo $row_log['brewComments']; ?></td>
	</tr>
</table>
</div>
<?php } ?>
<?php } ?>
