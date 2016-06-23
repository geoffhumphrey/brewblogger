<a name="yeasts"></a><h3>Yeasts</h3>
<?php if ((!empty($row_log['brewYeast'])) && (empty($row_log['brewYeastProfile']))) { ?>
<!-- If no yeast profile specified - legacy installations -->
<table class="table table-striped">
	<thead>
		<tr>
            <th width="25%">Name</th>
            <th>Lab/Manufacturer</th>
            <th>Form</th>
            <th width="15%">Amount</th>
        </tr>
	</thead>
    <tbody>
    	<tr>
        	<td><?php if (!empty($row_log['brewYeast'])) echo $row_log['brewYeast']; ?></td>
            <td><?php if (!empty($row_log['brewYeastMan'])) echo $row_log['brewYeastMan']; ?></td>
            <td><?php if (!empty($row_log['brewYeastForm'])) echo $row_log['brewYeastForm']; ?></td>
            <td><?php if (!empty($row_log['brewYeastAmount'])) echo $row_log['brewYeastAmount']; ?></td>
        </tr>
    </tbody>
</table>
<?php } // end hide Yeast (6) ?>
<?php if (!empty($row_log['brewYeastProfile'])) { // show yeast profile if present 
	mysql_select_db($database_brewing, $brewing);
	$query_yeast_profiles = sprintf("SELECT * FROM yeast_profiles WHERE id='%s'", $row_log['brewYeastProfile']);
	$yeast_profiles = mysql_query($query_yeast_profiles, $brewing) or die(mysql_error());
	$row_yeast_profiles = mysql_fetch_assoc($yeast_profiles);
?>
<table class="table table-striped">
	<thead>
		<tr>
            <th width="25%">Name</th>
            <th>Lab/Manufacturer</th>
            <th>Product ID</th>
            <th width="15%">Amount</th>
        </tr>
	</thead>
    <tbody>
    	<tr>
        	<td><a href="#yeastModal" data-toggle="modal"><?php if (!empty($row_yeast_profiles['yeastName'])) echo $row_yeast_profiles['yeastName']; ?></a></td>
            <td><?php if (!empty($row_yeast_profiles['yeastLab'])) echo $row_yeast_profiles['yeastLab']; ?></td>
            <td><?php if (!empty($row_yeast_profiles['yeastProdID'])) echo $row_yeast_profiles['yeastProdID']; ?></td>
            <td><?php if (!empty($row_log['brewYeastAmount'])) echo $row_log['brewYeastAmount']; ?></td>
        </tr>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="yeastModal" tabindex="-1" role="dialog" aria-labelledby="yeastModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="yeastModalLabel"><?php echo $row_yeast_profiles['yeastName']; ?></h4>
      </div>
      <div class="modal-body">
            <?php if ($row_yeast_profiles['yeastLab'] != "") { ?>
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Manufacturer:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_yeast_profiles['yeastLab']; ?></div>
            </div>
            <?php } 
            if ($row_yeast_profiles['yeastProdID'] != "") { ?>            
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Product ID:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_yeast_profiles['yeastProdID']; ?></div>
            </div>
            <?php } 
            if ($row_yeast_profiles['yeastType'] != "") { ?>            
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Type:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_yeast_profiles['yeastType']; ?></div>
            </div>
            <?php } 
            if ($row_yeast_profiles['yeastFloc'] != "") { ?>
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Flocculation:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_yeast_profiles['yeastFloc']; ?></div>
            </div>
            <?php } 
            if ($row_yeast_profiles['yeastAtten'] != "") { ?>
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Attenuation:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_yeast_profiles['yeastAtten']; ?>%</div>
            </div>
            <?php } 
            if ($row_yeast_profiles['yeastTolerance'] != "") { ?>
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Alcohol Tolerance:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_yeast_profiles['yeastTolerance']; ?></div>
            </div>
            <?php } 
            if ($row_yeast_profiles['yeastMinTemp'] != "") { ?>
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Temperature Range:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php if ($row_pref['measTemp'] == "C") { echo round(((($row_yeast_profiles['yeastMinTemp'] - 32) / 9) * 5), 0)."&ndash;"; echo round(((($row_yeast_profiles['yeastMaxTemp'] - 32) / 9) * 5), 0); } else { echo $row_yeast_profiles['yeastMinTemp']."&ndash;".$row_yeast_profiles['yeastMaxTemp']; } ?>&deg;<?php echo $row_pref['measTemp']; ?></div>
            </div>
            <?php } 
            if ($row_log['brewYeastAmount'] != "" ) { ?>
            <div class="row bcoem-account-info">
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5"><strong>Amount:</strong></div>
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7"><?php echo $row_log['brewYeastAmount']; ?></div>
            </div>
            <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
