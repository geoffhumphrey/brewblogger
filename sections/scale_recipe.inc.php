<?php if ((!empty($row_log['brewYield'])) && ($page != "logPrint") && ($page != "recipePrint") && ((!empty($row_log['brewExtract1'])) || (!empty($row_log['brewGrain1'] != ""))) && (!empty($row_log['brewHops1'] != ""))) { ?>
<div class="bcoem-sidebar-panel hidden-print">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Scale Recipe</h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" action="<?php echo build_public_url($page, $section, "scale", $dbTable, $row_log['brewBrewerID'], $row_log['id'], $base_url); ?>" method="post" name="form1" id="form1">
				<div class="form-group">
					<label for="amt" class="col-sm-3 control-label small">Volume: </label>
					<div class="col-sm-6 small">
					<input type="text" size="5" class="form-control" id="amt" name="amt" placeholder="<?php echo $_SESSION['measFluid2']; ?>" value="<?php if ($action == "scale") echo $amt; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
					<input type="submit" name="submit" value="Scale" class="btn btn-primary btn-sm">
					<input type="button" name="reset" value="Reset" class="btn btn-danger btn-sm" onClick="window.location='<?php echo build_public_url($page, $section, "reset", $dbTable, $row_log['brewBrewerID'], $row_log['id'], $base_url); ?>'">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php } ?>