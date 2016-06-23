<?php if ($row_log['brewYield'] != "" && $page != "logPrint" && $page != "recipePrint" && (($row_log['brewExtract1'] != "" || $row_log['brewGrain1'] != "") && $row_log['brewHops1'] != ""))  { ?>
<h3><a name="recipe" id="recipe"></a>Scale Recipe</h3>
  <form class="form-inline" action="<?php echo "index.php?page=".$page."&filter=".$row_log['brewBrewerID']."&action=scale"; if ($action == "scale") echo "&amt=".$_POST['amt']; echo "&id=".$row_log['id']; ?>" method="post" name="form1" id="form1">
    <div class="form-group">
    	<label for="amt">Enter Scale Volume: </label>
    	<input type="text" size="5" class="form-control" id="amt" name="amt" placeholder="<?php echo ($row_log['brewYield'] * 2); ?>" value="<?php if ($action == "scale") echo $amt; if ($action == "reset") echo $row_log['brewYield']; ?>">
    </div>
    <div class="form-group">
    <input type="submit" name="submit" value="Scale" class="btn btn-primary btn-sm">
    <input type="button" name="reset" value="Reset" class="btn btn-danger btn-sm" onClick="window.location='<?php echo "index.php?page=".$page."&filter=".$filter."&id=".$id."&action=reset"; ?>'">
    </div>
</form>
<?php } ?>